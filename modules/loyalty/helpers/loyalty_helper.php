<?php
defined('BASEPATH') or exit('No direct script access allowed');
hooks()->add_action('after_email_templates', 'add_loyalty_email_templates');
/**
 * { row loyalty options exist }
 *
 * @param      <type>   $name   The name
 *
 * @return     integer  ( 1 or 0 )
 */
function row_loyalty_options_exist($name){
    $CI = & get_instance();
    $i = count($CI->db->query('Select * from '.db_prefix().'options where name = '.$name)->result_array());
    if($i == 0){
        return 0;
    }
    if($i > 0){
        return 1;
    }
}

/**
 * handle card picture
 * @param  int $id
 * @return bool   
 */
function handle_card_picture($id){

    if (isset($_FILES['card_picture']['name']) && $_FILES['card_picture']['name'] != '') {
        
    	
        $path = LOYALTY_MODULE_UPLOAD_FOLDER .'/card_picture/'. $id . '/';
        // Get the temp file path
        $tmpFilePath = $_FILES['card_picture']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
            _maybe_create_upload_path($path);
            $filename    = unique_filename($path, $_FILES['card_picture']['name']);
            $newFilePath = $path . $filename;
            // Upload the file into the company uploads dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $CI           = & get_instance();
                $attachment   = [];
                $attachment[] = [
                    'file_name' => $filename,
                    'filetype'  => $_FILES['card_picture']['type'],
                    ];
                $CI->misc_model->add_attachment_to_database($id, 'card_picture', $attachment);

                return true;
            }
        }
    }

    return false;
}

/**
 * { name card by id }
 *
 * @param       $id     The identifier
 *
 * @return     string   
 */
function name_card_by_id($id){
    $CI = & get_instance();

    $CI->db->where('id', $id);
    $card = $CI->db->get(db_prefix().'loy_card')->row();

    if($card){
        return $card->name;
    }else{
        return '';
    }
}

/**
 * Gets the membership rule name.
 *
 * @param      <type>  $id     The identifier
 */
function get_membership_rule_name($id){
    $CI = & get_instance();

    $CI->db->where('id', $id);
    $membership_rule = $CI->db->get(db_prefix().'loy_mbs_rule')->row();
    if($membership_rule){
        return $membership_rule->name;
    }else{
        return '';
    }
}

/**
 * { client group name }
 *
 * @param        $id     The identifier
 *
 * @return     string 
 */
function client_group_name($id){
    $CI = & get_instance();
    $CI->db->where('id',$id);
    $group = $CI->db->get(db_prefix().'customers_groups')->row();

    if($group){
        return $group->name;
    }else{
        return '';
    }
}

/**
 * Adds a transation loy.
 *
 * @param         $payment_id  The payment identifier
 *
 * @return     integer  ( description_of_the_return_value )
 */
function add_transation_loy($payment_id){
    $CI = &get_instance();
    $CI->load->model('loyalty/loyalty_model');
    $result = $CI->loyalty_model->add_transation($payment_id);
    if ($result == true) {
        return 1;
    }
    return 0;
}

/**
 * Adds a credit mbs program.
 *
 * @param    $invoice_id  The invoice identifier
 *
 * @return     integer
 */
function add_credit_mbs_program($invoice_id){
    $CI = &get_instance();
    $CI->load->model('loyalty/loyalty_model');
    $result = $CI->loyalty_model->add_credit_mbs_program($invoice_id);
    if ($result == true) {
        return 1;
    }
    return 0;
}

/**
 * { client loyalty point }
 *
 * @param        $client  The client id
 *
 * @return     integer  ( total loyalty point of client )
 */
function client_loyalty_point($client){
    $CI = &get_instance();

    $CI->db->where('userid',$client);
    $client = $CI->db->get(db_prefix().'clients')->row();

    if($client){
        if(is_numeric($client->loy_point)){
            return $client->loy_point;
        }else{
            return 0;
        }
    }else{
        return 0;
    }
}


/**
 * Gets the group by item name.
 *
 * @param      <string>   $item_name  The item name
 *
 * @return     integer  The group by item name.
 */
function get_group_by_item_name($item_name, $long_des = ''){
    $CI = &get_instance();
    $CI->db->where('description',$item_name);
    $CI->db->where('long_description',$long_des);
    $item = $CI->db->get(db_prefix().'items')->row();

    if($item){
        return $item->group_id;
    }else{
        return 0;
    }
}

/**
 * Gets the item identifier by item name.
 *
 * @param      <string>   $item_name  The item name
 *
 * @return     integer  The item identifier by item name.
 */
function get_item_id_by_item_name($item_name, $long_des = ''){
    $CI = &get_instance();
    $CI->db->where('description',$item_name);
    $CI->db->where('long_description',$long_des);
    $item = $CI->db->get(db_prefix().'items')->row();
    if($item){
        return $item->id;
    }else{
        return 0;
    }
}

/**
 * { client membership }
 *
 * @param  $client  The client
 */
function client_membership($client){
    $CI = &get_instance();
    $point = client_loyalty_point($client);
    $mbs_rule = $CI->db->query('select * from '.db_prefix().'loy_mbs_rule where ((loyalty_point_from <= '.$point.' and loyalty_point_to >= '.$point.') OR loyalty_point_to <= '.$point.') and ( find_in_set('.$client.', client) or client_group IN (SELECT groupid FROM '.db_prefix().'customer_groups WHERE customer_id = '.$client.') ) order by loyalty_point_to DESC')->row();

    if($mbs_rule){
        return $mbs_rule->name;
    }else{
        return '';
    }
}

/**
 * { client_rank }
 *
 * @param  $client  The client
 */
function client_rank($client){
    $CI = &get_instance();
    $point = client_loyalty_point($client);
    $mbs_rule = $CI->db->query('select * from '.db_prefix().'loy_mbs_rule where ((loyalty_point_from <= '.$point.' and loyalty_point_to >= '.$point.') OR loyalty_point_to <= '.$point.') and ( find_in_set('.$client.', client) or client_group IN (SELECT groupid FROM '.db_prefix().'customer_groups WHERE customer_id = '.$client.') ) order by loyalty_point_to DESC')->row();
    return $mbs_rule;
}

/**
 * { client next rank }
 *
 * @param  $client  The client
 */
function client_next_rank($client){
    $CI = &get_instance();

    $client_rank = client_rank($client);

    $point_to = 0;
    if($client_rank){
        $point_to = $client_rank->loyalty_point_to;
    }

    if($point_to > 0){
        $mbs_rule = $CI->db->query('select * from '.db_prefix().'loy_mbs_rule where ((loyalty_point_from >= '.$point_to.' and loyalty_point_to >= '.$point_to.') or loyalty_point_from > '.$point_to.' ) and ( find_in_set('.$client.', client) or client_group IN (SELECT groupid FROM '.db_prefix().'customer_groups WHERE customer_id = '.$client.') ) order by loyalty_point_to ASC')->row();
    }else{
        $mbs_rule = $CI->db->query('select * from '.db_prefix().'loy_mbs_rule where find_in_set('.$client.', client) or client_group IN (SELECT groupid FROM '.db_prefix().'customer_groups WHERE customer_id = '.$client.')  order by loyalty_point_to DESC')->row();
    }
    return $mbs_rule;
  
}

/**
 * { product category by id }
 *
 * @param        $group  The group
 *
 * @return     string   
 */
function product_category_by_id($group){
    $CI = &get_instance();
    $CI->db->where('id',$group);
    $gr = $CI->db->get(db_prefix().'items_groups')->row();
    if($gr){
        return $gr->name;
    }else{
        return '';
    }
}

/**
 * { product by id }
 *
 * @param        $id     The identifier
 *
 * @return       string
 */
function product_by_id($id){
    $CI = &get_instance();
    $CI->db->where('id',$id);
    $pr = $CI->db->get(db_prefix().'items')->row();
    if($pr){
        return $pr->description;
    }else{
        return '';
    }
}

/**
 * Gets the redemp rule client.
 *
 * @param        $client  The client
 */
function get_redemp_rule_client($client, $type){
    $CI = &get_instance();
    $CI->load->model('client_groups_model');
    $point = client_loyalty_point($client);
    $groups = $CI->client_groups_model->get_customer_groups($client);

    $date = date('Y-m-d');
    if($type == 'portal'){
        if(count($groups) > 0){
            $groups_lst = array();
            foreach($groups as $gr){
                $groups_lst[] = $gr['groupid'];
            }
            $rule = $CI->db->query('select * from '.db_prefix().'loy_rule where (find_in_set('.$client.', client) or client_group IN ('.implode(',', $groups_lst).') ) and min_poin_to_redeem <= '.$point.' and start_date <= "'.$date.'" and end_date >= "'.$date.'" and enable = 1 and redeem_portal = 1 order by date_create desc')->row();
        }else{
            $rule = $CI->db->query('select * from '.db_prefix().'loy_rule where find_in_set('.$client.', client) and min_poin_to_redeem <= '.$point.' and start_date <= "'.$date.'" and end_date >= "'.$date.'" and enable = 1 and redeem_portal = 1 order by date_create desc')->row();
        }
    }else{
        if(count($groups) > 0){
            $groups_lst = array();
            foreach($groups as $gr){
                $groups_lst[] = $gr['groupid'];
            }

            $rule = $CI->db->query('select * from '.db_prefix().'loy_rule where (find_in_set('.$client.', client) or client_group IN ('.implode(',', $groups_lst).')) and min_poin_to_redeem <= '.$point.' and start_date <= "'.$date.'" and end_date >= "'.$date.'" and enable = 1 and redeem_pos = 1 order by date_create desc')->row();
        }else{
            $rule = $CI->db->query('select * from '.db_prefix().'loy_rule where find_in_set('.$client.', client) and min_poin_to_redeem <= '.$point.' and start_date <= "'.$date.'" and end_date >= "'.$date.'" and enable = 1 and redeem_pos = 1 order by date_create desc')->row();
        }
    }
    
    if($rule){
        $rule_detail = $CI->db->query('select * from '.db_prefix().'loy_redemp_detail where loy_rule = '.$rule->id.' and status = "enable" and ((point_from <= '.$point.' and point_to >= '.$point.') OR point_to <= '.$point.') order by point_to desc')->row();
        if($rule_detail){
            return $rule_detail;
        }else{
            return '';
        }
    }else{
        return '';
    }
}

/**
 * Gets the redemp rule client.
 *
 * @param        $client  The client
 */
function get_redemp_rule_client_inv($client){
    $CI = &get_instance();
    $CI->load->model('client_groups_model');
    $point = client_loyalty_point($client);
    $groups = $CI->client_groups_model->get_customer_groups($client);

    $date = date('Y-m-d');
    
    if(count($groups) > 0){
        $groups_lst = array();
        foreach($groups as $gr){
            $groups_lst[] = $gr['groupid'];
        }
        $rule = $CI->db->query('select * from '.db_prefix().'loy_rule where (find_in_set('.$client.', client) or client_group IN ('.implode(',', $groups_lst).') ) and min_poin_to_redeem <= '.$point.' and start_date <= "'.$date.'" and end_date >= "'.$date.'" and enable = 1 order by date_create desc')->row();
    }else{
        $rule = $CI->db->query('select * from '.db_prefix().'loy_rule where find_in_set('.$client.', client) and min_poin_to_redeem <= '.$point.' and start_date <= "'.$date.'" and end_date >= "'.$date.'" and enable = 1 order by date_create desc')->row();
    }
    
    
    if($rule){
        $rule_detail = $CI->db->query('select * from '.db_prefix().'loy_redemp_detail where loy_rule = '.$rule->id.' and status = "enable" and ((point_from <= '.$point.' and point_to >= '.$point.') OR point_to <= '.$point.') order by point_to desc')->row();
        if($rule_detail){
            return $rule_detail;
        }else{
            return '';
        }
    }else{
        return '';
    }
}

/**
 * Gets the rule by identifier.
 *
 * @param        $id     The identifier
 */
function get_rule_by_id($id){
    $CI = &get_instance();
    $CI->db->where('id',$id);
    return $CI->db->get(db_prefix().'loy_rule')->row();
}

/**
 * Gets the base currency loy.
 *
 * @return     <type>  The base currency loy.
 */
function get_base_currency_loy(){
    $CI = &get_instance();
    $CI->load->model('currencies_model');
    return $CI->currencies_model->get_base_currency();
}

/**
 * Gets the invoice hash.
 *
 * @param        $inv    The inv
 *
 * @return     string  The inv hash.
 */
function get_inv_hash($inv){
    $CI = &get_instance();
    $CI->db->where('id',$inv);
    $invoice = $CI->db->get(db_prefix().'invoices')->row();
    if($invoice){
        return $invoice->hash;
    }else{
        return '';
    }
}

/**
 * Gets the program ids by client.
 *
 * @param      <type>  $client  The client
 */
function program_ids_client($client){
    $CI = &get_instance();
    $point = client_loyalty_point($client);
    $rank = client_rank($client);
    $date = date('Y-m-d');
    $program_ids = [];
    if($rank){
        
        $list_program = $CI->db->query('select * from '.db_prefix().'loy_mbs_program where find_in_set('.$rank->id.', membership) and ((loyalty_point_from <= '.$point.' and loyalty_point_to >= '.$point.' ) OR loyalty_point_to <= '.$point.' ) and ( start_date <= "'.$date.'" and end_date >= "'.$date.'" )')->result_array();

        foreach ($list_program as $val) {
            $program_ids[] = $val['id'];
        }
    }

    return $program_ids;
}

/**
 * { product ids by cate }
 *
 * @param       $category  The category
 */
function product_ids_by_cate($category){
    $CI = &get_instance();
    $CI->db->where('group_id', $category);
    $items = $CI->db->get(db_prefix().'items')->result_array();
    $item_ids = [];
    if(count($items) > 0){
        foreach($items as $it){
            $item_ids[] = $it['id'];
        }
    }
    return $item_ids;
}

/**
 * Adds a custom field loy.
 *
 * @param        $data   The data
 *
 * @return     bool    
 */
function add_custom_field_loy($data){
    $CI = & get_instance();
    $CI->load->model('custom_fields_model');

    $data['slug'] = slug_it($data['fieldto'] . '_' . $data['name'], [
        'separator' => '_',
    ]);

    $slugs_total = total_rows(db_prefix().'customfields', ['slug' => $data['slug']]);

    if ($slugs_total > 0) {
        return false;
    }else{
        $id = $CI->custom_fields_model->add($data);
        if($id){
            return true;
        }else{
            return false;
        }
    }
}

if (!function_exists('add_loyalty_email_templates')) {
    /**
     * Init appointly email templates and assign languages
     * @return void
     */
    function add_loyalty_email_templates() {
        $CI = &get_instance();

        $data['loyalty_templates'] = $CI->emails_model->get(['type' => 'loyalty', 'language' => 'english']);

        $CI->load->view('loyalty/email_templates', $data);
    }
}

/**
 * Get primary contact user id for specific customer
 * @param  mixed $userid
 * @return mixed
 */
function get_primary_contact_user_id_loy($userid)
{
    $CI = & get_instance();
    $CI->db->where('userid', $userid);
    $CI->db->where('is_primary', 1);
    $row = $CI->db->get(db_prefix() . 'contacts')->row();

    if ($row) {
        return $row;
    }
    return false;
}

/**
 * loyalty get currency name symbol
 * @param  [type] $id     
 * @param  string $column 
 * @return [type]         
 */
function loy_get_currency_name_symbol($id, $column='')
{
    $CI   = & get_instance();
    $currency_value='';

    if($column == ''){
        $column = 'name';
    }

    $CI->db->select($column);
    $CI->db->from(db_prefix() . 'currencies');
    $CI->db->where('id', $id);
    $currency = $CI->db->get()->row();
    if($currency){
        $currency_value = $currency->$column;
    }

    return $currency_value;
}

/**
 * get currency rate
 * @param  [type] $from
 * @param  [type] $to
 * @return [type]           
 */
function loy_get_currency_rate($from, $to)
{
    $CI   = & get_instance();
    if($from == $to){
        return 1;
    }

    $amount_after_convertion = 1;

    $CI->db->where('from_currency_name', strtoupper($from));
    $CI->db->where('to_currency_name', strtoupper($to));
    $currency_rates = $CI->db->get(db_prefix().'currency_rates')->row();
    
    if($currency_rates){
        $amount_after_convertion = $currency_rates->to_currency_rate;
    }

    return $amount_after_convertion;
}

/**
 * Gets the sale note by inv identifier.
 *
 * @param        $inv_id  The inv identifier
 */
function get_sale_note_by_inv_id($inv_id){
    $CI   = & get_instance();

    if (!$CI->db->table_exists(db_prefix() . 'cart')) {
        return '';
    }

    $CI->db->where('id', $inv_id);
    $invoice = $CI->db->get(db_prefix().'invoices')->row();
    if($invoice){
        $CI->db->where('number_invoice', $invoice->number);
        $cart = $CI->db->get(db_prefix().'cart')->row();
        if($cart){
            return $cart->notes;
        }
    }
    return '';
}

/**
 * { loy get currency by id }
 */
function loy_get_currency_by_id($currency_id){
    $CI   = & get_instance();
    $CI->db->where('id', $currency_id);
    $currency = $CI->db->get(db_prefix().'currencies')->row();
    if($currency){
        return $currency;
    }

    return '';

}

/**
 * { loy_html_entity_decode }
 *
 * @param      string  $str    The string
 *
 * @return       ( string )
 */
function loy_html_entity_decode($str){
    return html_entity_decode($str ?? '');
}