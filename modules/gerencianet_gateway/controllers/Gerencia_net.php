<?php

defined('BASEPATH') or exit('No direct script access allowed');

require FCPATH . '/modules/gerencianet_gateway/vendor/autoload.php';

use Gerencianet\Gerencianet;
use Gerencianet\Exception\GerencianetException;

class Gerencia_net extends App_Controller
{

    protected $ci;
    protected $gn_gateway;

    public function __construct()
    {

        parent::__construct();

        $CI = &get_instance();

        $this->load->library("gerencianet_gateway/gerencianet_gateway");

        $this->load->helper('gerencianet_gateway/gerencianet_gateway');

        $this->ci = $CI;

        $this->gn_gateway = $this->gerencianet_gateway;
    }

    public function invoice($invoice_id, $invoice_hash)
    {
        check_invoice_restrictions($invoice_id, $invoice_hash);

        $this->load->model('invoices_model');

        $invoice = $this->invoices_model->get($invoice_id);

        if ($this->input->server('REQUEST_METHOD') === 'GET') {
            $this->gerar_html($invoice);
        } elseif ($this->input->server('REQUEST_METHOD') === 'POST') {

            $tipo = [1 => 'billet', 2 => 'pix', 3 => 'credit_card'];

            $tipo_pagamento = $this->input->post('gerencianet_pagamento_input_tipo');

            if ($tipo_pagamento == null) {
                set_alert('warning', "Por favar, selecione alguma modo de pagamento do gerência net.");
                redirect(site_url('gerencianet_gateway/gerencia_net/invoice/' . $invoice->id . '/' . $invoice->hash));
            }

            $options = $this->get_gn_options();

            $invoice->post_data = true;

            $this->gerar_html($invoice);

            switch ($tipo[$tipo_pagamento]) {
                case 'billet':
                    $charge = $this->fetch_payment($invoice);

                    if ($charge) {

                        redirect($charge["data"]["payment"]["banking_billet"]["link"]);
                    } else {
                        $charge = $this->create_billet($invoice);

                        redirect($charge["data"]["payment"]["banking_billet"]["link"]);
                    }
                    break;
                case 'pix':
                    $this->do_pix($options, $invoice);
                    break;
                default:
                    set_alert('warning', "Por favar, selecione alguma modo de pagamento do gerência net.");
                    redirect(site_url('gerencianet_gateway/gerencia_net/invoice/' . $invoice->id . '/' . $invoice->hash));
                    break;
            }
        }
    }

    public function fetch_payment($data = null)
    {

        if (empty($data)) {
            return;
        }

        if ($this->gn_gateway->getSetting('test_mode_enabled') == 1) {
            $clientId = $this->gn_gateway->decryptSetting('dev_client_id');
            $clientSecret = $this->gn_gateway->decryptSetting('dev_client_secret');
            $sandbox = true;
        } else {
            $clientId = $this->gn_gateway->decryptSetting('production_client_id');
            $clientSecret = $this->gn_gateway->decryptSetting('production_client_secret');
            $sandbox = false;
        }

        $options = [
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'sandbox' => $sandbox
        ];

        $gateway = new Gerencianet($options);

        $params = [
            'id' => (int) $data->token
        ];

        $charge = $gateway->detailCharge($params, []);

        return $charge;
    }

    public function callback_check_pix_pago(string $txid, int $id_fatura)
    {
        if ($this->input->server('REQUEST_METHOD') === 'GET') {
            $params = ['txid' => $txid];
            try {
                $options = $this->get_gn_options();
                $api = Gerencianet::getInstance($options);
                $pix = $api->pixDetailCharge($params);

                if (isset($pix['pix'])) {
                    $arr = $pix['pix'][0];
                    $data['amount'] = $arr['valor'];
                    $data['invoiceid'] = $id_fatura;
                    $data['paymentmethod'] = 'pix';
                    $data['transactionid'] = $arr['txid'];
                    $this->fazerPagamento($data);
                    echo '1';
                    die;
                }
                echo 'false';
            } catch (GerencianetException $e) {
                return $e->error;
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }
    }

    private function get_bairro(int $user_id)
    {

        $db = $this->ci->db;
        $db->where('name', 'Bairro');
        $db->where('relid', $user_id);
        $db->from(db_prefix() . 'customfields');
        $db->join(db_prefix() . 'customfieldsvalues', db_prefix() .
            'customfieldsvalues.fieldid = ' . db_prefix() . 'customfields.id');
        $query = $db->get();
        return $query->row()->value;
    }

    private function formatar_message(bool $erro, string $message)
    {
        echo json_encode(['erro' => $erro, 'message' => $message]);
        die;
    }

    public function gerar_cartao_credito($invoice_id, $invoice_hash)
    {
        check_invoice_restrictions($invoice_id, $invoice_hash);

        $options = $this->get_gn_options();

        unset($options['pix_cert']);

        $this->load->model('invoices_model');

        $this->load->model('custom_fields_model');

        $invoice = $this->invoices_model->get($invoice_id);

        $paymentToken = $this->input->post('payament_token');

        $nome_cliente = $this->input->post('nome_cliente');

        $birth = $this->input->post('birth');

        $cpf = $this->input->post('cpf');

        $email = $this->input->post('email');

        $callbackUrl = site_url('gerencianet_gateway/gerencia_net/callback_cartao?invoiceid=' . $invoice_id . '&hash=' . $invoice_hash);

        $invoiceNumber = format_invoice_number($invoice_id);

        $description = str_replace('{invoice_number}', $invoiceNumber, $this->gn_gateway->getSetting('description_dashboard'));

        if (mb_strlen($description, 'UTF-8') > 255) {
            $this->formatar_message(true, 'O campo descrição não pode ser superior a 255 caracteres.');
        }

        $valor_cobrado = (int) number_format($invoice->total, 2, '', '');

        $item_1 = [
            'name' => $description, // nome do item, produto ou serviço
            'amount' => 1, // quantidade
            'value' => $valor_cobrado  // valor (1000 = R$ 10,00) (Obs: É possível a criação de itens com valores negativos. Porém, o valor total da fatura deve ser superior ao valor mínimo para geração de transações.)
        ];

        $items = [
            $item_1
        ];

        $metadata = ['notification_url' => $callbackUrl];

        if ($this->gn_gateway->getSetting('test_mode_enabled') == 1) { // Teste
            $metadata = ['notification_url' => 'http://api.webhookinbox.com/i/0ZyGtASW/in/'];
        };

        if (str_word_count(trim($nome_cliente)) < 2) {
            $this->formatar_message(true, 'O nome do cliente deve ter no mínimo duas palavras.');
        }

        $cpf = trim(preg_replace('/\D/', '', $cpf));

        if (mb_strlen($cpf) != 11) {
            $this->formatar_message(true, 'O CPF deve ter 11 números somente.');
        }

        if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $birth)) {
            $this->formatar_message(true, 'A data não está em um formato correto. Formato correto: YYYY-MM-DD.');
        }

        $customer = [
            'name' => $nome_cliente, // nome do cliente
            'cpf' => $cpf, // cpf do cliente
            'phone_number' => $invoice->client->phonenumber, // telefone do cliente
            'email' => $email, // endereço de email do cliente
            'birth' => $birth // data de nascimento do cliente
        ];

        $cep = $invoice->client->billing_zip;

        $cep = preg_replace('/\D/', '', $cep);

        if (!$cep) {
            $this->formatar_message(true, 'Não foi possível encontrar o CEP.');
        }

        if (!$this->get_bairro($invoice->client->userid)) {
            $this->formatar_message(true, 'O bairro é obrigatório.');
        }

        if (mb_strlen($invoice->client->billing_state, 'UTF-8') != 2) {
            $this->formatar_message(true, 'A UF deve ter dois caracteres, por exemplo: SP.');
        }

        if (!mb_strlen($invoice->client->billing_street, 'UTF-8')) {
            $this->formatar_message(true, 'O nome da rua é obrigatório.');
        }

        $billingAddress = [
            'street' => $invoice->client->billing_street,
            'neighborhood' => $this->get_bairro($invoice->client->userid),
            'zipcode' => $cep,
            'number' => 0,
            'city' => $invoice->client->billing_city,
            'state' => $invoice->client->billing_state
        ];

        $credit_card = [
            'customer' => $customer,
            'installments' => 1, // número de parcelas em que o pagamento deve ser dividido
            'billing_address' => $billingAddress,
            'payment_token' => $paymentToken,
            'message' => 'FATURA ' . $invoiceNumber
        ];

        $payment = [
            'credit_card' => $credit_card // forma de pagamento (credit_card = cartão)
        ];

        $body = [
            'items' => $items,
            'metadata' => $metadata,
            'payment' => $payment
        ];

        try {
            $api = new Gerencianet($options);

            $pay_charge = $api->oneStep([], $body);

            if ($pay_charge['code'] == 200) {
                $this->ci->db->where('id', $invoice_id);

                $this->ci->db->update(db_prefix() . 'invoices', [
                    'token' => $pay_charge['data']['charge_id'],
                ]);

                $this->formatar_message(!true, 'success');
            } else {
                $this->formatar_message(!true, json_encode($pay_charge));
            }
        } catch (GerencianetException $e) {
            print_r($e->code);
            print_r($e->error);
            print_r($e->errorDescription);
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    private function gerar_html($data)
    {
        $pix                 = $this->gn_gateway->getSetting('tipo_pagamento_pix');
        $cartao              = $this->gn_gateway->getSetting('tipo_pagamento_cartaocredito');
        $boleto              = $this->gn_gateway->getSetting('tipo_pagamento_boleto');
        $identificador_conta = $this->gn_gateway->decryptSetting('codigo_identificador_conta');
        $test_mode_enabled   = $this->gn_gateway->getSetting('test_mode_enabled');
        $arr = ['active', '', '', 1];
        // BOLETO
        if (($boleto && !$pix && !$cartao) || ($boleto && $pix && !$cartao) || ($boleto && !$pix && $cartao)) {
            $arr[0] = ''; // PIX
            $arr[1] = ''; // CARTAO
            $arr[2] = 'active'; // BOLETO
            $arr[3] = 1; // INDICADOR
        }

        // PIX
        if (($pix && !$cartao && !$boleto) || ($pix && $cartao && !$boleto) || ($pix && !$cartao && $boleto)) {
            $arr[0] = 'active'; // PIX
            $arr[1] = ''; // CARTAO
            $arr[2] = ''; // BOLETO
            $arr[3] = 2; // INDICADOR
        }

        // CARTÃO
        if (($cartao && !$boleto && !$pix) || ($cartao && $boleto && !$pix) || ($cartao && !$boleto && $pix)) {
            $arr[0] = 'active'; // PIX
            $arr[1] = ''; // CARTAO
            $arr[2] = ''; // BOLETO
            $arr[3] = 3; // INDICADOR
        }

        $data->arr                 = $arr;
        $data->pix                 = $pix;
        $data->cartao              = $cartao;
        $data->boleto              = $boleto;
        $data->data                = $data;
        $data->identificador_conta = $identificador_conta;
        $data->test_mode_enabled   = $test_mode_enabled;
        $this->ci->load->view('gerencianet_gateway/invoice', $data);
    }

    public function view_converter_certificado_p12_para_pem()
    {
        $this->ci->load->view('gerencianet_gateway/gerencia_net');
    }

    private function do_pix($options, $data)
    {
        try {

            if (!file_exists($options['pix_cert'])) {
                return $this->getResponse(['error' => true, 'message' => 'O arquivo do certificado não existe ou o caminho está incorreto.']);
            }

            $infoAdicionais = [
                [
                    "nome" => "FATURA",
                    "valor" => format_invoice_number($data->id),
                ],
                [
                    "nome" => "CÓDIGO",
                    "valor" => $data->id,
                ]
            ];

            foreach ($data->items as $value) {
                $infoAdicionais[] = ['nome' => substr($value['description'], 0, 50), 'valor' => (int) $value['qty'] . 'x' . $value['rate']];
            }

            $body = [
                "calendario" => [
                    "expiracao" => 3600
                ],
                "valor" => [
                    "original" => $data->total
                ],
                "chave" => $this->gn_gateway->getSetting('pagamento_pix_chave'),
                "solicitacaoPagador" => "Cobrança dos serviços prestados.",
                "infoAdicionais" => $infoAdicionais
            ];

            $api = Gerencianet::getInstance($options);

            $pix = $api->pixCreateImmediateCharge([], $body);

            if ($pix['txid']) {

                $params = [
                    'id' => $pix['loc']['id']
                ];

                $api->pixGenerateQRCode($params);
            }
        } catch (GerencianetException $e) {
            return $this->getResponse(['error' => true, 'message' => $e->errorDescription]);
        } catch (Exception $e) {
            return $this->getResponse(['error' => true, 'message' => $e->getMessage()]);
        }
    }

    private function getResponse($data)
    {
        echo json_encode($data);
        die;
    }

    public function gerar_pix_por_javascript($invoice_id, $invoice_hash)
    {
        try {

            check_invoice_restrictions($invoice_id, $invoice_hash);

            $this->load->model('invoices_model');

            $invoice = $this->invoices_model->get($invoice_id);

            $options = $this->get_gn_options();
            if (!file_exists($options['pix_cert'])) {
                return $this->getResponse(['error' => true, 'message' => "O certificado não foi configurado corretamente ou há algum problema relacionado a ele."]);
            }
            $infoAdicionais = [
                [
                    "nome" => "FATURA",
                    "valor" => format_invoice_number($invoice->id),
                ],
                [
                    "nome" => "CÓDIGO",
                    "valor" => $invoice->id,
                ]
            ];

            foreach ($invoice->items as $value) {
                $infoAdicionais[] = ['nome' => substr($value['description'], 0, 50), 'valor' => (int) $value['qty'] . 'x' . $value['rate']];
            }

            $body = [
                "calendario" => [
                    "expiracao" => 3600
                ],
                "valor" => [
                    "original" => $invoice->total
                ],
                "chave" => $this->gn_gateway->getSetting('pagamento_pix_chave'),
                "solicitacaoPagador" => "Cobrança dos serviços prestados.",
                "infoAdicionais" => $infoAdicionais
            ];

            $api = Gerencianet::getInstance($options);

            $pix = $api->pixCreateImmediateCharge([], $body);

            if ($pix['txid']) {

                $params = [
                    'id' => $pix['loc']['id']
                ];

                $qrcode = $api->pixGenerateQRCode($params);

                $qrcode['txid'] = $pix['txid'];

                return $this->getResponse(['error' => false, 'message' => $qrcode]);
                // echo json_encode($qrcode);
            }
        } catch (GerencianetException $e) {
            return $this->getResponse(['error' => true, 'message' => $e->errorDescription]);
        } catch (Exception $e) {
            return $this->getResponse(['error' => true, 'message' => $e->errorDescription]);
        }
    }

    private function calcularMulta($x)
    {
        return $x * 100;
    }

    private function calcularJuros($x)
    {
        if ($x < 10) {
            return (int) 1000 * $x;
        }
        return 1000;
    }

    private function create_billet($data = null)
    {
        if (empty($data)) {
            return;
        }

        $gerencia_net = $this->gn_gateway;

        if ($gerencia_net->getSetting('test_mode_enabled') == 1) {
            $clientId = $gerencia_net->decryptSetting('dev_client_id');
            $clientSecret = $gerencia_net->decryptSetting('dev_client_secret');
            $sandbox = true;
        } else {
            $clientId = $gerencia_net->decryptSetting('production_client_id');
            $clientSecret = $gerencia_net->decryptSetting('production_client_secret');
            $sandbox = false;
        }

        $options = [
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'sandbox' => $sandbox
        ];

        $invoiceNumber = format_invoice_number($data->id);

        $description = str_replace('{invoice_number}', $invoiceNumber, $gerencia_net->getSetting('description_dashboard'));

        $callbackUrl = site_url('gerencianet_gateway/gerencia_net/callback_boleto?invoiceid=' . $data->id . '&hash=' . $data->hash);

        $valor_cobrado = (int) number_format($data->total, 2, '', '');

        if ($valor_cobrado < 5) {
            set_alert('warning', "O valor não pode ser inferior a R$ 5,00");
            redirect(site_url('gerencianet_gateway/gerencia_net/invoice/' . $data->id . '/' . $data->hash));
        }

        $item_1 = [
            'name' => $description,
            'amount' => 1,
            'value' => $valor_cobrado
        ];

        $items = [
            $item_1
        ];

        if ($_SERVER['SERVER_NAME'] == 'localhost') {
            $callbackUrl = $gerencia_net->getSetting('url_webhook_localhost');
        }

        $metadata = [
            'custom_id' => $data->id,
            'notification_url' => $callbackUrl
        ];

        $body = [
            'items' => $items,
            'metadata' => $metadata
        ];

        $juros = (int) $this->calcularJuros($gerencia_net->getSetting('juros'));
        $multa = (int) $this->calcularMulta($gerencia_net->getSetting('multa'));

        if ($juros > 330) {
            set_alert('warning', "O valor mínimo deve ser 0 e máximo 330.");
            redirect(site_url('gerencianet_gateway/gerencia_net/invoice/' . $data->id . '/' . $data->hash));
            die;
        }

        if ($multa > 1000) {
            set_alert('warning', "O valor mínimo deve ser 0 e máximo 1000.");
            redirect(site_url('gerencianet_gateway/gerencia_net/invoice/' . $data->id . '/' . $data->hash));
            die;
        }

        try {
            $gateway = new Gerencianet($options);

            $charge = $gateway->createCharge([], $body);

            if ($charge["code"] == 200) {

                $params = ['id' => $charge["data"]["charge_id"]];

                $vat = $data->client->vat;

                $vat = preg_replace("/[^0-9]/", "", $vat);

                if (!$data->client->phonenumber) {
                    set_alert('warning', "O telefone do cliente é obrigatório.");
                    redirect(site_url('gerencianet_gateway/gerencia_net/invoice/' . $data->id . '/' . $data->hash));
                    die;
                }

                $phone_number = $data->client->phonenumber;

                $phone_number = preg_replace("/[^0-9]/", "", $phone_number);

                if (strlen($data->client->company) <= 1) {
                    set_alert('warning', "O nome do cliente é obrigatório.    ");
                    redirect(site_url('gerencianet_gateway/gerencia_net/invoice/' . $data->id . '/' . $data->hash));
                    die;
                }

                if (strlen($vat) == 11) {
                    $customer = [
                        'name' => $data->client->company,
                        'cpf' => $vat,
                        'phone_number' => $phone_number
                    ];
                } elseif (strlen($vat) == 14) {
                    $customer = [
                        'phone_number' => $phone_number,
                        'juridical_person' => [
                            'corporate_name' => $data->client->company,
                            'cnpj' => $vat
                        ]
                    ];
                }

                if (strtotime(date("Y-m-d")) > strtotime($data->duedate)) {
                    $expire_at = date('Y-m-d', strtotime("+1 days", strtotime(date("Y-m-d"))));
                } else {
                    $expire_at = $data->duedate;
                }

                $configurations = [ // configurações de juros e mora
                    'fine' => $multa, // porcentagem de multa
                    'interest' => $juros
                ];

                $bankingBillet = [
                    'expire_at' => $expire_at,
                    'message' => 'Esse boleto pode ser protestado após 30 dias de vencimento.',
                    'customer' => $customer,
                    'configurations' => $configurations
                ];

                $payment = ['banking_billet' => $bankingBillet];

                $body = ['payment' => $payment];

                $gateway = new Gerencianet($options);

                $pay_charge = $gateway->payCharge($params, $body);

                if ($pay_charge["code"] == 200) {

                    $this->ci->db->where('id', $data->id);

                    $this->ci->db->update(db_prefix() . 'invoices', [
                        'token' => $pay_charge["data"]["charge_id"],
                    ]);

                    return $pay_charge;
                } else {
                    return $charge;
                }
            } else {
                return $charge;
            }
        } catch (GerencianetException $e) {
            set_alert('warning', $e->errorDescription);
            redirect(site_url('gerencianet_gateway/gerencia_net/invoice/' . $data->id . '/' . $data->hash));
        } catch (Exception $e) {
            set_alert('warning', $e->getMessage());
            redirect(site_url('gerencianet_gateway/gerencia_net/invoice/' . $data->id . '/' . $data->hash));
        }
    }

    public function callback_boleto()
    {
        log_activity('[EFI] Entrou no callback do boleto');

        $invoiceid = $this->input->get('invoiceid');

        $hash = $this->input->get('hash');

        check_invoice_restrictions($invoiceid, $hash);

        $this->db->where('id', $invoiceid);

        $this->db->where('hash', $hash);

        $invoice = $this->db->get(db_prefix() . 'invoices')->row();

        if ($invoice) {
            $charge = $this->fetch_payment($invoice);
            if (isset($charge['data'])) {
                if ($invoice->status != 2) {
                    if ($charge["code"] == 200) {
                        if ($charge["data"]["status"] == "paid") {
                            $this->gn_gateway->addPayment(
                                [
                                    'amount' => $invoice->total,
                                    'invoiceid' => $invoiceid,
                                    'paymentmode' => 'gerencianet',
                                    'paymentmethod' => 'Boleto',
                                    'transactionid' => $charge["data"]["charge_id"],
                                ]
                            );
                            log_activity('[Gerencianet 1]: Confirmação de pagamento para a fatura ' . $invoice->id . ', com o ID: ' . $charge["data"]["charge_id"]);
                            echo '1) Gerencianet: Confirmação de pagamento para a fatura ' . $invoice->id . ', com o ID: ' . $charge["data"]["charge_id"];
                        } else {
                            log_activity('[Gerencianet 2]: Estado do pagamento da fatura ' . $invoice->id . ', com o ID: ' . $charge["data"]["charge_id"] . ', Status: ' . $charge["data"]["status"]);
                            echo '2) Gerencianet: Estado do pagamento da fatura ' . $invoice->id . ', com o ID: ' . $charge["data"]["charge_id"] . ', Status: ' . $charge["data"]["status"];
                        }
                    } else {
                        echo '3) Gerencianet: Falha ao receber callback para a fatura ' . $invoice->id . ', com o ID: ' . $charge["data"]["charge_id"];
                        log_activity('[Gerencianet 3]: Falha ao receber callback para a fatura ' . $invoice->id . ', com o ID: ' . $charge["data"]["charge_id"]);
                    }
                } else {
                    echo '4) Gerencianet: Estado do pagamento da fatura ' . $invoice->id . ', com o ID: ' . $charge["data"]["charge_id"] . ', Status: ' . $charge["data"]["status"];
                    log_activity('[Gerencianet 4]: Estado do pagamento da fatura ' . $invoice->id . ', com o ID: ' . $charge["data"]["charge_id"] . ', Status: ' . $charge["data"]["status"]);
                }
            }
            else{
                echo '5) Gerencianet: Falha ao receber callback para a fatura ' . $invoiceid . ', com o hash: ' . $hash . ', fatura não encontrada.';
                log_activity('[Gerencianet 5]: Falha ao receber callback para a fatura ' . $invoiceid . ', com o hash: ' . $hash . ', fatura não encontrada.');
            }
        } else {
            echo '5) Gerencianet: Falha ao receber callback para a fatura ' . $invoiceid . ', com o hash: ' . $hash . ', fatura não encontrada.';
            log_activity('Gerencianet: Falha ao receber callback para a fatura ' . $invoiceid . ', com o hash: ' . $hash . ', fatura não encontrada.');
        }
    }

    public function callback_cartao()
    {

        $invoiceid = $this->input->get('invoiceid');

        $hash = $this->input->get('hash');

        check_invoice_restrictions($invoiceid, $hash);

        $this->db->where('id', $invoiceid);

        $this->db->where('hash', $hash);

        $invoice = $this->db->get(db_prefix() . 'invoices')->row();

        if (count($invoice) > 0) {

            // $data = array('invoice' => $invoice);

            $charge = $this->fetch_payment($invoice);

            if ($invoice->status != 2) {

                if ($charge["code"] == 200) {
                    if ($charge["data"]["status"] == "paid") {
                        $this->gn_gateway->addPayment(
                            [
                                'amount' => $invoice->total,
                                'invoiceid' => $invoiceid,
                                'paymentmode' => 'gerencianet',
                                'paymentmethod' => 'Cartão',
                                'transactionid' => $charge["data"]["charge_id"],
                            ]
                        );
                        echo '1) Gerencianet: Confirmação de pagamento para a fatura ' . $invoice->id . ', com o ID: ' . $charge["data"]["charge_id"];
                    } else {
                        echo '2) Gerencianet: Estado do pagamento da fatura ' . $invoice->id . ', com o ID: ' . $charge["data"]["charge_id"] . ', Status: ' . $charge["data"]["status"];
                    }
                } else {
                    echo '3) Gerencianet: Falha ao receber callback para a fatura ' . $invoice->id . ', com o ID: ' . $charge["data"]["charge_id"];
                }
            } else {
                echo '4) Gerencianet: Estado do pagamento da fatura ' . $invoice->id . ', com o ID: ' . $charge["data"]["charge_id"] . ', Status: ' . $charge["data"]["status"];
            }
        } else {
            echo '5) Gerencianet: Falha ao receber callback para a fatura ' . $invoiceid . ', com o hash: ' . $hash . ', fatura não encontrada.';
        }
    }

    private function get_gn_options()
    {
        $gerencia_net = $this->gn_gateway;

        if ($gerencia_net->getSetting('test_mode_enabled') == 1) {
            $clientId = $gerencia_net->decryptSetting('dev_client_id');
            $clientSecret = $gerencia_net->decryptSetting('dev_client_secret');
            $sandbox = true;
            $debug = false;
            $timeout = 30;
            $pix_cert = $gerencia_net->getSetting('tipo_pagamento_pix_certificado_pem_homologacao');
        } else {
            $clientId = $gerencia_net->decryptSetting('production_client_id');
            $clientSecret = $gerencia_net->decryptSetting('production_client_secret');
            $sandbox = false;
            $debug = false;
            $timeout = 30;
            $pix_cert = $gerencia_net->getSetting('tipo_pagamento_pix_certificado_pem_producao');
        }

        // $path_cert = $_SERVER['DOCUMENT_ROOT'] . dirname($_SERVER['PHP_SELF']);
        $path_cert = FCPATH;

        if (substr($pix_cert, 0, 1) === "/") {
            $path_cert = rtrim(FCPATH, "/");
        }

        $options = [
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'sandbox' => $sandbox,
            'pix_cert' => $path_cert . $pix_cert,
            'debug' => $debug,
            'timeout' => $timeout
        ];

        return $options;
    }

    public function fetch_pixes()
    {

        $data_final = date('Y-m-d\Th:i:s\Z', (strtotime('+1 day', time())));

        $data_inicial = date('Y-m-d\Th:i:s\Z', (strtotime('-30 day', strtotime($data_final))));

        $params = ['inicio' => $data_inicial, 'fim' => $data_final];

        try {

            $options = $this->get_gn_options();

            $api = Gerencianet::getInstance($options);

            $pix = $api->pixListCharges($params);

            foreach ($pix['cobs'] as $cobracanca) {
                if (isset($cobracanca['pix'])) {
                    if ($cobracanca['infoAdicionais'][1]['nome'] == 'CÓDIGO') {
                        if ($cobracanca['status'] == 'CONCLUIDA') {
                            $id_fatura = (int) $cobracanca['infoAdicionais'][1]['valor'];
                            $data['amount'] = $cobracanca['pix'][0]['valor'];
                            $data['invoiceid'] = $id_fatura;
                            $data['paymentmethod'] = 'pix';
                            $data['transactionid'] = $cobracanca['txid'];
                            $this->fazerPagamento($data);
                        }
                    }
                }
            }
        } catch (GerencianetException $e) {
            set_alert('warning', $e->code);
            set_alert('warning', $e->error);
            set_alert('warning', $e->errorDescription);
            set_alert('warning', $e->error);
        } catch (Exception $e) {
            set_alert('danger', $e->getMessage());
        }
    }

    private function fazerPagamento($data)
    {

        $data['paymentmode'] = $this->gn_gateway->getId();

        $this->ci->load->model('payments_model');

        $this->ci->load->model('invoices_model');

        $invoice = $this->ci->invoices_model->get($data['invoiceid']);

        if ($invoice->status != 2) {
            return $this->ci->payments_model->add($data);
        }
    }
}
