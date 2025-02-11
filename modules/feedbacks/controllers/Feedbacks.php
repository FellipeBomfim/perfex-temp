<?php

defined('BASEPATH') or exit('No direct script access allowed');
set_time_limit(0);

class Feedbacks extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('feedbacks_model');
    }

    /* List all feedbacks */
    public function index()
    {
        if (!has_permission('feedbacks', '', 'view')) {
            access_denied('feedbacks');
        }
        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data(module_views_path('feedbacks', 'tables/feedbacks'));
        }
        $data['title'] = _l('feedbacks');
        $this->load->view('feedbacks/all', $data);
    }

    /* Add new feedback or update existing */
    public function feedback($id = '')
    {
        if (!has_permission('feedbacks', '', 'view')) {
            access_denied('feedbacks');
        }
        if ($this->input->post()) {
            $data                    = $this->input->post();
            $data['description']     = html_purify($this->input->post('description', false));
            $data['viewdescription'] = html_purify($this->input->post('viewdescription', false));

            if ($id == '') {
                if (!has_permission('feedbacks', '', 'create')) {
                    access_denied('feedbacks');
                }
                $id = $this->feedbacks_model->add($data);
                if ($id) {
                    set_alert('success', _l('added_successfully', _l('feedback')));
                    redirect(admin_url('feedbacks/feedback/' . $id));
                }
            } else {
                if (!has_permission('feedbacks', '', 'edit')) {
                    access_denied('feedbacks');
                }
                $success = $this->feedbacks_model->update($data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('feedback')));
                }
                redirect(admin_url('feedbacks/feedback/' . $id));
            }
        }
        if ($id == '') {
            $title = _l('add_new', _l('feedback_lowercase'));
        } else {
            $this->load->model('leads_model');
            $data['leads_statuses']   = $this->leads_model->get_status();
            $data['customers_groups'] = $this->clients_model->get_groups();
            $feedback                   = $this->feedbacks_model->get($id);
            $data['send_log']         = $this->feedbacks_model->get_feedback_send_log($id);
            $data['feedback']           = $feedback;
            $title                    = $feedback->subject;
        }
        $this->load->model('feedbacks_model');
        $data['mail_lists']          = $this->feedbacks_model->get_mail_lists();
        $data['found_custom_fields'] = false;
        $i                           = 0;
        foreach ($data['mail_lists'] as $mail_list) {
            $fields = $this->feedbacks_model->get_list_custom_fields($mail_list['listid']);
            if (count($fields) > 0) {
                $data['found_custom_fields'] = true;
            }
            $data['mail_lists'][$i]['customfields'] = $fields;
            $i++;
        }

        if (is_gdpr() && (get_option('gdpr_enable_consent_for_contacts') == '1' || get_option('gdpr_enable_consent_for_leads') == '1')) {
            $this->load->model('gdpr_model');
            $data['purposes'] = $this->gdpr_model->get_consent_purposes();
        }

        $data['title'] = $title;
        $this->app_scripts->add('feedbacks-js', module_dir_url('feedbacks', 'assets/js/feedbacks.js'), 'admin', ['app-js']);
        $this->app_css->add('feedbacks-css', module_dir_url('feedbacks', 'assets/css/feedbacks.css'), 'admin', ['app-css']);

        $this->load->view('feedbacks/feedback', $data);
    }

    /* Send feedback to mail list */
    public function send($feedbackid)
    {
        if (!has_permission('feedbacks', '', 'edit')) {
            access_denied('feedbacks');
        }
        if (!$feedbackid) {
            redirect(admin_url('feedbacks'));
        }
        $this->load->model('feedbacks_model');

        $_lists      = [];
        $_all_emails = [];
        if ($this->input->post('send_feedback_to')) {
            $lists = $this->input->post('send_feedback_to');
            foreach ($lists as $key => $val) {
                // is mail list
                if (is_int($key)) {
                    $list   = $this->feedbacks_model->get_mail_lists($key);
                    $emails = $this->feedbacks_model->get_mail_list_emails($key);
                    foreach ($emails as $email) {
                        // We don't need to validate emails becuase email are already validated when added to mail list
                        array_push($_all_emails, [
                            'listid'  => $key,
                            'emailid' => $email['emailid'],
                            'email'   => $email['email'],
                        ]);
                    }

                    if (count($emails) > 0) {
                        array_push($_lists, $list->name);
                    }
                } else {
                    if ($key == 'staff') {
                        // Pass second paramter to get all active staff, we don't need inactive staff
                        // If you want adjustments feel free to pass 0 or '' for all
                        $staff = $this->staff_model->get('', ['active' => 1]);
                        foreach ($staff as $email) {
                            array_push($_all_emails, $email['email']);
                        }
                        if (count($staff) > 0) {
                            array_push($_lists, 'feedback_send_mail_list_staff');
                        }
                    } elseif ($key == 'clients') {
                        $whereConsent = '';
                        $where        = 'active=1';

                        if ($this->input->post('contacts_consent') && is_array($this->input->post('contacts_consent'))) {
                            $consents = array_map(function ($attr) {
                                return get_instance()->db->escape_str($attr);
                            }, $this->input->post('contacts_consent'));

                            $whereConsent = ' AND ' . db_prefix() . 'contacts.id IN (SELECT contact_id FROM ' . db_prefix() . 'consents WHERE purpose_id IN (' . implode(',', $consents) . ') and action="opt-in" AND date IN (SELECT MAX(date) FROM ' . db_prefix() . 'consents WHERE purpose_id IN (' . implode(', ', $consents) . ') AND contact_id=' . db_prefix() . 'contacts.id))';
                        }
						if($this->input->post('clientid')){
							$clientid=$this->input->post('clientid');
						   $where        = 'active=1';      
						   $clients = $this->clients_model->get_contacts($clientid, $where);
						   foreach ($clients as $email) {
                                $added = true;
								
                                array_push($_all_emails, $email['email']);
                            }
						}	
                        if ($this->input->post('ml_customers_all')) {
                            $where .= $whereConsent;
                            $clients = $this->clients_model->get_contacts('', $where);

                            foreach ($clients as $email) {
                                $added = true;
								
                                array_push($_all_emails, $email['email']);
                            }
                        } else {
                            foreach ($this->input->post('customer_group') as $group_id => $val) {
                                $clients = $this->clients_model->get_contacts('', 'active=1 AND userid IN (select customer_id from ' . db_prefix() . 'customer_groups where groupid =' . $this->db->escape_str($group_id) . ')' . $whereConsent);
                                foreach ($clients as $email) {
                                    $added = true;
                                    array_push($_all_emails, $email['email']);
                                }
                            }
                            $_all_emails = array_unique($_all_emails, SORT_REGULAR);
                        }

                        if (isset($added) > 0) {
                            array_push($_lists, 'feedback_send_mail_list_clients');
                        }
                    } elseif ($key == 'leads') {
                        $this->load->model('leads_model');
                        if ($this->input->post('leads_status')) {
                            $whereConsent = '';
                            if ($this->input->post('leads_consent') && is_array($this->input->post('leads_consent'))) {
                                $consents = array_map(function ($attr) {
                                    return get_instance()->db->escape_str($attr);
                                }, $this->input->post('leads_consent'));

                                $whereConsent = ' AND ' . db_prefix() . 'leads.id IN (SELECT lead_id FROM ' . db_prefix() . 'consents WHERE purpose_id IN (' . implode(',', $consents) . ') and action="opt-in" AND date IN (SELECT MAX(date) FROM ' . db_prefix() . 'consents WHERE purpose_id IN (' . implode(', ', $consents) . ') AND lead_id=' . db_prefix() . 'leads.id))';
                            }

                            $statuses = [];
                            foreach ($this->input->post('leads_status') as $status_id => $val) {
                                array_push($statuses, $this->db->escape_str($status_id));
                            }

                            $where = 'status IN (' . implode(',', $statuses) . ')' . $whereConsent;

                            $leads = $this->leads_model->get('', $where);
                            foreach ($leads as $lead) {
                                $added = true;
                                if (!empty($lead['email']) && filter_var($lead['email'], FILTER_VALIDATE_EMAIL)) {
                                    array_push($_all_emails, $lead['email']);
                                }
                            }
                            if (isset($added)) {
                                array_push($_lists, _l('leads'));
                            }
                        } elseif ($this->input->post('leads_all')) {
                            $where = 'lost=0' . $whereConsent;
                            $leads = $this->leads_model->get('', $where);
                            foreach ($leads as $lead) {
                                if (!empty($lead['email']) && filter_var($lead['email'], FILTER_VALIDATE_EMAIL)) {
                                    array_push($_all_emails, $lead['email']);
                                }
                            }
                            if (count($leads)) {
                                array_push($_lists, 'leads');
                            }
                        }
                    }
                }
            }
        } else {
            set_alert('warning', _l('feedback_no_mail_lists_selected'));
            redirect(admin_url('feedbacks/feedback/' . $feedbackid));
        }

        // We don't need to include in query CRON if 0 emails found
        $iscronfinished = 0;
        if (count($_all_emails) == 0) {
            $iscronfinished = 1;
        }
        $log_id = $this->feedbacks_model->init_feedback_send_log($feedbackid, $iscronfinished, $_lists);

        foreach ($_all_emails as $email) {
            // Is not from email lists
            if (!is_array($email)) {
                $this->db->insert(db_prefix() . 'feedbacksemailsendcron', [
                    'email'    => $email,
                    'feedbackid' => $feedbackid,
                    'log_id'   => $log_id,
                ]);
            } else {
                // Yay its a mail list
                // We will need this info for the custom fields when sending the feedback
                $this->db->insert(db_prefix() . 'feedbacksemailsendcron', [
                    'email'    => $email['email'],
                    'feedbackid' => $feedbackid,
                    'listid'   => $email['listid'],
                    'emailid'  => $email['emailid'],
                    'log_id'   => $log_id,
                ]);
            }
        }

        $total = count($_all_emails);
        if ($total > 0) {
            set_alert('success', _l('feedback_send_success_note', $total));
        } else {
            set_alert('warning', 'No emails found to send the feedback based on the selections.');
        }
        redirect(admin_url('feedbacks/feedback/' . $feedbackid . '?tab=feedback_send_tab'));
    }

    public function remove_feedback_send($id)
    {
        if (!has_permission('feedbacks', '', 'delete')) {
            access_denied('feedbacks');
        }
        $this->feedbacks_model->remove_feedback_send($id);
        redirect($_SERVER['HTTP_REFERER']);
    }

    /* View feedback participating results*/
    public function results($id)
    {
        if (!$id) {
            redirect(admin_url('feedbacks'));
        }
        $data['feedbackid']  = $id;
        $data['bodyclass'] = 'feedback_results';
        $feedback            = $this->feedbacks_model->get($id);
        $data['feedback']    = $feedback;
        $data['title']     = _l('feedback_result', $feedback->subject);
        $this->load->view('feedbacks/results', $data);
    }

    /* Delete feedback from database */
    public function delete($id)
    {
        if (!has_permission('feedbacks', '', 'delete')) {
            access_denied('feedbacks');
        }
        if (!$id) {
            redirect(admin_url('feedbacks'));
        }
        $success = $this->feedbacks_model->delete($id);
        if ($success) {
            set_alert('success', _l('deleted', _l('feedback')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('feedback')));
        }
        redirect(admin_url('feedbacks'));
    }

    // Ajax
    /* Remove feedback question */
    public function remove_question($questionid)
    {
        if (!has_permission('feedbacks', '', 'edit')) {
            echo json_encode([
                'success' => false,
                'message' => _l('access_denied'),
            ]);
            die();
        }
        if ($this->input->is_ajax_request()) {
            echo json_encode([
                'success' => $this->feedbacks_model->remove_question($questionid),
            ]);
        }
    }

    /* Removes feedback checkbox/radio description*/
    public function remove_box_description($questionboxdescriptionid)
    {
        if (!has_permission('feedbacks', '', 'edit')) {
            echo json_encode([
                'success' => false,
                'message' => _l('access_denied'),
            ]);
            die();
        }
        if ($this->input->is_ajax_request()) {
            echo json_encode([
                'success' => $this->feedbacks_model->remove_box_description($questionboxdescriptionid),
            ]);
        }
    }

    /* Add box description */
    public function add_box_description($questionid, $boxid)
    {
        if (!has_permission('feedbacks', '', 'edit')) {
            echo json_encode([
                'success' => false,
                'message' => _l('access_denied'),
            ]);
            die();
        }
        if ($this->input->is_ajax_request()) {
            $boxdescriptionid = $this->feedbacks_model->add_box_description($questionid, $boxid);
            echo json_encode([
                'boxdescriptionid' => $boxdescriptionid,
            ]);
        }
    }

    /* New feedback question */
    public function add_feedback_question()
    {
        if (!has_permission('feedbacks', '', 'edit')) {
            echo json_encode([
                'success' => false,
                'message' => _l('access_denied'),
            ]);
            die();
        }
        if ($this->input->is_ajax_request()) {
            if ($this->input->post()) {
                echo json_encode([
                    'data'                             => $this->feedbacks_model->add_feedback_question($this->input->post()),
                    'feedback_question_only_for_preview' => _l('feedback_question_only_for_preview'),
                    'feedback_question_required'         => _l('feedback_question_required'),
                    'feedback_question_string'           => _l('question_string'),
                ]);
                die();
            }
        }
    }

    /* Update question */
    public function update_question()
    {
        if (!has_permission('feedbacks', '', 'edit')) {
            echo json_encode([
                'success' => false,
                'message' => _l('access_denied'),
            ]);
            die();
        }
        if ($this->input->is_ajax_request()) {
            if ($this->input->post()) {
                $this->feedbacks_model->update_question($this->input->post());
            }
        }
    }

    /* Reorder feedbacks */
    public function update_feedback_questions_orders()
    {
        if (has_permission('feedbacks', '', 'edit')) {
            if ($this->input->is_ajax_request()) {
                if ($this->input->post()) {
                    $this->feedbacks_model->update_feedback_questions_orders($this->input->post());
                }
            }
        }
    }

    /* Change feedback status active or inactive*/
    public function change_feedback_status($id, $status)
    {
        if (has_permission('feedbacks', '', 'edit')) {
            if ($this->input->is_ajax_request()) {
                $this->feedbacks_model->change_feedback_status($id, $status);
            }
        }
    }

    // MAIL LISTS
    /* List all mail lists */
    public function mail_lists()
    {
        if (!has_permission('feedbacks', '', 'view')) {
            access_denied('feedbacks');
        }
        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data(module_views_path('feedbacks', 'tables/mail_lists'));
        }
        $data['title'] = _l('mail_lists');
        $this->load->view('feedbacks/mail_lists/manage', $data);
    }

    /* Add or update mail list */
    public function mail_list($id = '')
    {
        if ($this->input->post()) {
            if ($id == '') {
                if (!has_permission('feedbacks', '', 'create')) {
                    access_denied('feedbacks');
                }
                $id = $this->feedbacks_model->add_mail_list($this->input->post());
                if ($id) {
                    set_alert('success', _l('added_successfully', _l('mail_list')));
                    redirect(admin_url('feedbacks/mail_list/' . $id));
                }
            } else {
                if (!has_permission('feedbacks', '', 'edit')) {
                    access_denied('feedbacks');
                }
                $success = $this->feedbacks_model->update_mail_list($this->input->post(), $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('mail_list')), 'refresh');
                }
                redirect(admin_url('feedbacks/mail_list/' . $id));
            }
        }
        if ($id == '') {
            $title = _l('add_new', _l('mail_list_lowercase'));
        } else {
            $list                  = $this->feedbacks_model->get_mail_lists($id);
            $data['list']          = $list;
            $data['custom_fields'] = $this->feedbacks_model->get_list_custom_fields($list->listid);
            $title                 = _l('edit', _l('mail_list_lowercase')) . ' ' . $list->name;
        }
        $data['title'] = $title;
        $this->load->view('feedbacks/mail_lists/list', $data);
    }

    /* View mail list all added emails */
    public function mail_list_view($id)
    {
        if (!has_permission('feedbacks', '', 'view')) {
            access_denied('feedbacks');
        }
        if (!$id) {
            redirect(admin_url('feedbacks/mail_lists'));
        }
        $data       = [];
        $data['id'] = $id;
        if (is_numeric($id)) {
            $data['custom_fields'] = $this->feedbacks_model->get_list_custom_fields($id);
        }
        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data(module_views_path('feedbacks', 'tables/mail_list_view'), [
                'id'   => $id,
                'data' => $data,
            ]);
        }
        if ($id == 'staff' || $id == 'clients' || $id == 'leads') {
            $list  = new stdClass();
            $title = _l('clients_mail_lists');
            if ($id == 'clients') {
                if (is_gdpr() && get_option('gdpr_enable_consent_for_contacts') == '1') {
                    $this->load->model('gdpr_model');
                    $data['consent_purposes'] = $this->gdpr_model->get_consent_purposes();
                }

                $emails         = $this->clients_model->get_contacts();
                $data['groups'] = $this->clients_model->get_groups();
            } elseif ($id == 'staff') {
                $title = _l('staff_mail_lists');

                $emails = $this->staff_model->get();
            } elseif ($id == 'leads') {
                $title = _l('leads');
                if (is_gdpr() && get_option('gdpr_enable_consent_for_leads') == '1') {
                    $this->load->model('gdpr_model');
                    $data['consent_purposes'] = $this->gdpr_model->get_consent_purposes();
                }
                $this->load->model('leads_model');

                $data['statuses'] = $this->leads_model->get_status();
                $data['sources']  = $this->leads_model->get_source();

                $emails = $this->leads_model->get('', ['lost' => 0]);
            }
            $list->emails = [];
            $i            = 0;
            foreach ($emails as $email) {
                if (empty($email['email'])) {
                    continue;
                }
                if ($id == 'leads') {
                    $list->emails[$i]['dateadded'] = $email['dateadded'];
                } else {
                    $list->emails[$i]['dateadded'] = $email['datecreated'];
                }
                $list->emails[$i]['email'] = $email['email'];
                $i++;
            }
            $data['list']  = $list;
            $data['title'] = $title;
            $fixed_list    = true;
        } else {
            $list          = $this->feedbacks_model->get_data_for_view_list($id);
            $data['title'] = $list->name;
            $data['list']  = $list;
            $fixed_list    = false;
        }
        $data['fixedlist'] = $fixed_list;
        $this->load->view('feedbacks/mail_lists/list_view', $data);
    }

    /* Add single email to mail list / ajax*/
    public function add_email_to_list()
    {
        if (!has_permission('feedbacks', '', 'create')) {
            echo json_encode([
                'success'       => false,
                'error_message' => _l('access_denied'),
            ]);
            die();
        }
        if ($this->input->post()) {
            if ($this->input->is_ajax_request()) {
                echo json_encode($this->feedbacks_model->add_email_to_list($this->input->post()));
                die();
            }
        }
    }

    /* Remove single email from mail list / ajax */
    public function remove_email_from_mail_list($emailid)
    {
        if (!has_permission('feedbacks', '', 'delete')) {
            echo json_encode([
                'success' => false,
                'message' => _l('access_denied'),
            ]);
            die();
        }
        if (!$emailid) {
            echo json_encode([
                'success' => false,
            ]);
            die();
        }
        echo json_encode($this->feedbacks_model->remove_email_from_mail_list($emailid));
        die();
    }

    /* Remove mail list custom field */
    public function remove_list_custom_field($fieldid)
    {
        if (!has_permission('feedbacks', '', 'delete')) {
            echo json_encode([
                'success' => false,
                'message' => _l('access_denied'),
            ]);
            die;
        }
        if ($this->input->is_ajax_request()) {
            echo json_encode($this->feedbacks_model->remove_list_custom_field($fieldid));
            die();
        }
    }

    /* Import .xls file with emails */
    public function import_emails()
    {
        if (!has_permission('feedbacks', '', 'create')) {
            access_denied('feedbacks');
        }

        // Using composer
        // require_once(APPPATH . 'third_party/Excel_reader/php-excel-reader/excel_reader2.php');
        // require_once(APPPATH . 'third_party/Excel_reader/SpreadsheetReader.php');

        $filename = uniqid() . '_' . $_FILES['file_xls']['name'];
        $temp_url = TEMP_FOLDER . $filename;
        if (move_uploaded_file($_FILES['file_xls']['tmp_name'], $temp_url)) {
            try {
                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($temp_url);
            } catch (Exception $e) {
                die('Error loading file "' . pathinfo($temp_url, PATHINFO_BASENAME) . '": ' . $e->getMessage());
            }
            $total_duplicate_emails = 0;
            $total_invalid_address  = 0;
            $total_added_emails     = 0;
            $mails_failed_to_insert = 0;
            $listid                 = $this->input->post('listid');

            foreach ($spreadsheet->getActiveSheet()->toArray() as $email) {
                if (isset($email[0]) && $email[0] !== '') {
                    $data['email'] = $email[0];
                    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                        $total_invalid_address++;

                        continue;
                    }
                    $data['listid'] = $listid;
                    if (count($email) > 1) {
                        $custom_fields       = $this->feedbacks_model->get_list_custom_fields($listid);
                        $total_custom_fields = count($custom_fields);
                        for ($i = 0; $i < $total_custom_fields; $i++) {
                            if ($email[$i + 1] !== '') {
                                $data['customfields'][$custom_fields[$i]['customfieldid']] = $email[$i + 1] ?? '';
                            }
                        }
                    }
                    $success = $this->feedbacks_model->add_email_to_list($data);
                    if ($success['success'] == false && $success['duplicate'] == true) {
                        $total_duplicate_emails++;
                    } elseif ($success['success'] == false) {
                        $mails_failed_to_insert++;
                    } else {
                        $total_added_emails++;
                    }
                }
                if ($total_added_emails > 0 && $mails_failed_to_insert == 0) {
                    $_alert_type = 'success';
                } elseif ($total_added_emails == 0 && $mails_failed_to_insert > 0) {
                    $_alert_type = 'danger';
                } elseif ($total_added_emails > 0 && $mails_failed_to_insert > 0) {
                    $_alert_type = 'warning';
                } else {
                    $_alert_type = 'success';
                }
            }
            // Delete uploaded file
            unlink($temp_url);
            set_alert($_alert_type, _l('mail_list_total_imported', $total_added_emails) . '<br />' . _l('mail_list_total_duplicate', $total_duplicate_emails) . '<br />' . _l('mail_list_total_failed_to_insert', $mails_failed_to_insert) . '<br />' . _l('mail_list_total_invalid', $total_invalid_address));
        } else {
            set_alert('danger', _l('error_uploading_file'));
        }
        redirect(admin_url('feedbacks/mail_list_view/' . $listid));
    }

    /* Delete mail list from database */
    public function delete_mail_list($id)
    {
        if (!has_permission('feedbacks', '', 'delete')) {
            access_denied('feedbacks');
        }
        if (!$id) {
            redirect(admin_url('feedbacks/mail_lists'));
        }
        $success = $this->feedbacks_model->delete_mail_list($id);
        if ($success) {
            set_alert('success', _l('deleted', _l('mail_list')));
        }
        redirect(admin_url('feedbacks/mail_lists'));
    }
}
