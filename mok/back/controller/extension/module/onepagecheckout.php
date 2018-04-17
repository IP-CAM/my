<?php
	class ControllerExtensionModuleOnePageCheckout extends Controller {
		private $error = array();
		private $ssl = 'SSL';
		private $tpl = '.tpl';
	 
	 public function __construct($registry){
		 parent::__construct( $registry );
		 $this->ssl = (defined('VERSION') && version_compare(VERSION,'2.2.0.0','>=')) ? true : 'SSL';
		 $this->tpl = (defined('VERSION') && version_compare(VERSION,'2.2.0.0','>=')) ? false : '.tpl';
	 }

	public function index() {
		$this->load->language('extension/module/onepagecheckout');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');
		
		$this->load->model('localisation/language');
		
		$this->load->model('extension/module');
		
		
		if(isset($this->request->get['store_id'])) {
			$data['store_id'] = $this->request->get['store_id'];
		}else{
			$data['store_id']	= 0;
		}
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('onepagecheckout', $this->request->post, $data['store_id']);
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->response->redirect($this->url->link('extension/module/onepagecheckout', 'token=' . $this->session->data['token'], $this->ssl . '&type=module'));
		}
		
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_row'] = $this->language->get('text_row');
		$data['text_block'] = $this->language->get('text_block');
		
		
		$data['entry_heading'] = $this->language->get('entry_heading');
		$data['entry_heading_title'] = $this->language->get('entry_heading_title');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_firstname'] = $this->language->get('entry_firstname');
		$data['entry_lastname'] = $this->language->get('entry_lastname');
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_telephone'] = $this->language->get('entry_telephone');
		$data['entry_fax'] = $this->language->get('entry_fax');
		$data['entry_company'] = $this->language->get('entry_company');
		$data['entry_address_1'] = $this->language->get('entry_address_1');
		$data['entry_address_2'] = $this->language->get('entry_address_2');
		$data['entry_postcode'] = $this->language->get('entry_postcode');
		$data['entry_city'] = $this->language->get('entry_city');
		$data['entry_country'] = $this->language->get('entry_country');
		$data['entry_zone'] = $this->language->get('entry_zone');
		$data['entry_newsletter'] = $this->language->get('entry_newsletter');
		$data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$data['entry_password'] = $this->language->get('entry_password');
		$data['entry_guest_order'] = $this->language->get('entry_guest_order');
		$data['entry_registeration_order_status'] = $this->language->get('entry_registeration_order_status');
		$data['entry_btn_text'] = $this->language->get('entry_btn_text');
		$data['entry_enable_login'] = $this->language->get('entry_enable_login');
		$data['entry_confirm'] = $this->language->get('entry_confirm');
		$data['entry_label'] = $this->language->get('entry_label');
		$data['entry_placeholder'] = $this->language->get('entry_placeholder');
		$data['entry_error'] = $this->language->get('entry_error');
		$data['entry_lastname_label'] = $this->language->get('entry_lastname_label');
		$data['entry_lastname_placeholder'] = $this->language->get('entry_lastname_placeholder');
		$data['entry_lastname_error'] = $this->language->get('entry_lastname_error');
		$data['entry_email_label'] = $this->language->get('entry_email_label');
		$data['entry_email_placeholder'] = $this->language->get('entry_email_placeholder');
		$data['entry_email_error'] = $this->language->get('entry_email_error');
		$data['entry_telephone_label'] = $this->language->get('entry_telephone_label');
		$data['entry_telephone_placeholder'] = $this->language->get('entry_telephone_placeholder');
		$data['entry_telephone_error'] = $this->language->get('entry_telephone_error');
		$data['entry_fax_label'] = $this->language->get('entry_fax_label');
		$data['entry_fax_placeholder'] = $this->language->get('entry_fax_placeholder');
		$data['entry_fax_error'] = $this->language->get('entry_fax_error');
		$data['entry_company_label'] = $this->language->get('entry_company_label');
		$data['entry_company_placeholder'] = $this->language->get('entry_company_placeholder');
		$data['entry_company_error'] = $this->language->get('entry_company_error');
		$data['entry_address_1_label'] = $this->language->get('entry_address_1_label');
		$data['entry_address_1_placeholder'] = $this->language->get('entry_address_1_placeholder');
		$data['entry_address_1_error'] = $this->language->get('entry_address_1_error');
		$data['entry_address_2_label'] = $this->language->get('entry_address_2_label');
		$data['entry_address_2_placeholder'] = $this->language->get('entry_address_2_placeholder');
		$data['entry_address_2_error'] = $this->language->get('entry_address_2_error');
		$data['entry_city_label'] = $this->language->get('entry_city_label');
		$data['entry_city_placeholder'] = $this->language->get('entry_city_placeholder');
		$data['entry_city_error'] = $this->language->get('entry_city_error');
		$data['entry_postcode_label'] = $this->language->get('entry_postcode_label');
		$data['entry_postcode_placeholder'] = $this->language->get('entry_postcode_placeholder');
		$data['entry_postcode_error'] = $this->language->get('entry_postcode_error');
		$data['entry_country_label'] = $this->language->get('entry_country_label');
		$data['entry_country_placeholder'] = $this->language->get('entry_country_placeholder');
		$data['entry_country_error'] = $this->language->get('entry_country_error');
		$data['entry_zone_label'] = $this->language->get('entry_zone_label');
		$data['entry_zone_placeholder'] = $this->language->get('entry_zone_placeholder');
		$data['entry_zone_error'] = $this->language->get('entry_zone_error');
		$data['entry_password_label'] = $this->language->get('entry_password_label');
		$data['entry_password_placeholder'] = $this->language->get('entry_password_placeholder');
		$data['entry_password_error'] = $this->language->get('entry_password_error');
		$data['entry_confirm_label'] = $this->language->get('entry_confirm_label');
		$data['entry_confirm_placeholder'] = $this->language->get('entry_confirm_placeholder');
		$data['entry_confirm_error'] = $this->language->get('entry_confirm_error');
		$data['entry_newsletter_label'] = $this->language->get('entry_newsletter_label');
		$data['entry_newsletter_placeholder'] = $this->language->get('entry_newsletter_placeholder');
		$data['entry_newsletter_error'] = $this->language->get('entry_newsletter_error');
		$data['entry_register_account'] = $this->language->get('entry_register_account');
		$data['entry_guest_checkout'] = $this->language->get('entry_guest_checkout');
		$data['entry_shopping_cart_order'] = $this->language->get('entry_shopping_cart_order');
		$data['entry_use_coupon_order'] = $this->language->get('entry_use_coupon_order');
		$data['entry_gift_voucher_order'] = $this->language->get('entry_gift_voucher_order');
		$data['entry_billing_order'] = $this->language->get('entry_billing_order');
		$data['entry_delivery_order'] = $this->language->get('entry_delivery_order');
		$data['entry_delivery_method_order'] = $this->language->get('entry_delivery_method_order');
		$data['entry_delivery_method'] = $this->language->get('entry_delivery_method');
		$data['entry_comment'] = $this->language->get('entry_comment');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_payment_method'] = $this->language->get('entry_payment_method');
		$data['entry_show_image'] = $this->language->get('entry_show_image');
		$data['entry_show_title'] = $this->language->get('entry_show_title');
		$data['entry_show_model'] = $this->language->get('entry_show_model');
		$data['entry_show_sku'] = $this->language->get('entry_show_sku');
		$data['entry_show_qnty_update'] = $this->language->get('entry_show_qnty_update');
		$data['entry_show_unit'] = $this->language->get('entry_show_unit');
		$data['entry_show_total_price'] = $this->language->get('entry_show_total_price');
		$data['entry_show_weight'] = $this->language->get('entry_show_weight');
		$data['entry_width'] = $this->language->get('entry_width');
		$data['entry_height'] = $this->language->get('entry_height');
		$data['entry_popup_status'] = $this->language->get('entry_popup_status');
		$data['entry_popup_btn_text'] = $this->language->get('entry_popup_btn_text');
		$data['entry_payment_method_order'] = $this->language->get('entry_payment_method_order');
		$data['entry_confirm_button'] = $this->language->get('entry_confirm_button');
		$data['entry_shopping_button'] = $this->language->get('entry_shopping_button');
		$data['entry_comment_status'] = $this->language->get('entry_comment_status');
		$data['entry_logged'] = $this->language->get('entry_logged');
		$data['entry_paymentdetails'] = $this->language->get('entry_paymentdetails');
		$data['entry_payment_setting'] = $this->language->get('entry_payment_setting');
		
		$data['help_register_account'] = $this->language->get('help_register_account');
		$data['help_guest_checkout'] = $this->language->get('help_guest_checkout');
		$data['help_enable_login'] = $this->language->get('help_enable_login');
		
		$data['placeholder_heading_title'] = $this->language->get('placeholder_heading_title');
		$data['placeholder_heading'] = $this->language->get('placeholder_heading');
		$data['placeholder_confirm_button'] = $this->language->get('placeholder_confirm_button');
		$data['placeholder_shopping_button'] = $this->language->get('placeholder_shopping_button');
		
		//tab names
		$data['field_manage'] = $this->language->get('field_manage');
		$data['help_customer_group'] = $this->language->get('help_customer_group');
		$data['entry_register'] = $this->language->get('entry_register');
		$data['entry_login'] = $this->language->get('entry_login');
		$data['entry_guest'] = $this->language->get('entry_guest');
		$data['entry_billing_detail_setting'] = $this->language->get('entry_billing_detail_setting');
		$data['entry_delivery_setting'] = $this->language->get('entry_delivery_setting');
		$data['entry_delivery_method'] = $this->language->get('entry_delivery_method');
		$data['entry_payment_method'] = $this->language->get('entry_payment_method');
		$data['entry_confirm_order'] = $this->language->get('entry_confirm_order');
		$data['entry_shopping_cart'] = $this->language->get('entry_shopping_cart');
		$data['entry_use_coupon'] = $this->language->get('entry_use_coupon');
		$data['entry_gift_voucher'] = $this->language->get('entry_gift_voucher');
		$data['entry_language'] = $this->language->get('entry_language');
		$data['entry_general'] = $this->language->get('entry_general');
		$data['entry_description'] = $this->language->get('entry_description');
		$data['entry_description_bottom'] = $this->language->get('entry_description_bottom');
		$data['entry_account_open'] = $this->language->get('entry_account_open');
		$data['entry_continue_shopping'] = $this->language->get('entry_continue_shopping');
		$data['entry_and_required'] = $this->language->get('entry_and_required');
		$data['entry_personaldetails'] = $this->language->get('entry_personaldetails');
		$data['entry_show_image'] = $this->language->get('entry_show_image');
		$data['entry_show_product_name'] = $this->language->get('entry_show_product_name');
		$data['entry_show_model'] = $this->language->get('entry_show_model');
		$data['entry_show_quantity'] = $this->language->get('entry_show_quantity');
		$data['entry_show_unit_price'] = $this->language->get('entry_show_unit_price');
		$data['entry_show_total_price'] = $this->language->get('entry_show_total_price');
		$data['enty_module_name'] = $this->language->get('enty_module_name');
		$data['entry_coupon'] = $this->language->get('entry_coupon');
		$data['entry_reward'] = $this->language->get('entry_reward');
		$data['entry_voucher'] = $this->language->get('entry_voucher');
		$data['entry_newsletter'] = $this->language->get('entry_newsletter');
		$data['entry_wrong'] = $this->language->get('entry_wrong');
		$data['entry_approved_message'] = $this->language->get('entry_approved_message');
		$data['entry_field_name'] = $this->language->get('entry_field_name');
		$data['entry_payment_details_setting'] = $this->language->get('entry_payment_details_setting');
		$data['entry_require_comment_status'] = $this->language->get('entry_require_comment_status');
		$data['entry_comment_error'] = $this->language->get('entry_comment_error');
		$data['entry_country'] = $this->language->get('entry_country');
		$data['entry_zone'] = $this->language->get('entry_zone');
		
		
		$data['show_image'] = $this->language->get('show_image');
		$data['show_title'] = $this->language->get('show_title');
		$data['show_model'] = $this->language->get('show_model');
		$data['show_sku'] = $this->language->get('show_sku');
		$data['show_qnty_update'] = $this->language->get('show_qnty_update');
		$data['show_unit'] = $this->language->get('show_unit');
		$data['show_total_price'] = $this->language->get('show_total_price');
		$data['show_weight'] = $this->language->get('show_weight');
		$data['show_image_width'] = $this->language->get('show_image_width');
		$data['show_image_width'] = $this->language->get('show_image_width');
		
		$data['text_yes'] = $this->language->get('text_yes');
		$data['entry_agree'] = $this->language->get('entry_agree');
		$data['entry_image'] = $this->language->get('entry_image');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_default'] = $this->language->get('text_default');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['show'] = $this->language->get('show');
		$data['register'] = $this->language->get('required');
		
		// 新增
		$data['entry_payment_details_order'] = $this->language->get('entry_payment_details_order');

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}
		
		if (isset($this->session->data['warning'])) {
			$data['error_warning'] = $this->session->data['warning'];
			unset($this->session->data['warning']);
		} elseif (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		}else{
			$data['error_warning'] = '';
		}
		
		$data['token'] = $this->session->data['token'];
		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], $this->ssl . '&type=module')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'], $this->ssl . '&type=module')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/onepagecheckout', 'token=' . $this->session->data['token'], $this->ssl . '&type=module')
		);

		$data['store_action'] =  $this->url->link('extension/module/onepagecheckout','token=' . $this->session->data['token'], $this->ssl . '&type=module');
		
		$data['action'] = $this->url->link('extension/module/onepagecheckout', 'token=' . $this->session->data['token'] . '&store_id='. $data['store_id'], $this->ssl . '&type=module');

		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'], $this->ssl . '&type=module');
		
		$data['restoresetting'] = $this->url->link('extension/module/onepagecheckout/restoresetting', 'token=' . $this->session->data['token'].'&store_id='. $data['store_id'], $this->ssl . '&type=module');
		
		$store_info = $this->model_setting_setting->getSetting('onepagecheckout', $data['store_id']);
	
		$languages = $this->model_localisation_language->getLanguages();
		
		$data['languages'] = $languages;
		
		if (isset($this->request->post['onepagecheckout_status'])) {
			$data['onepagecheckout_status'] = $this->request->post['onepagecheckout_status'];
		}else if(isset($store_info['onepagecheckout_status'])){
			$data['onepagecheckout_status'] = $store_info['onepagecheckout_status'];
		} else {
			$data['onepagecheckout_status'] = '';
		}
		
		if (isset($this->request->post['onepagecheckout_country_id'])) {
			$data['onepagecheckout_country_id'] = $this->request->post['onepagecheckout_country_id'];
		}else if(isset($store_info['onepagecheckout_country_id'])){
			$data['onepagecheckout_country_id'] = $store_info['onepagecheckout_country_id'];
		} else {
			$data['onepagecheckout_country_id'] = '';
		}
		
		if (isset($this->request->post['onepagecheckout_zone_id'])) {
			$data['onepagecheckout_zone_id'] = $this->request->post['onepagecheckout_zone_id'];
		}else if(isset($store_info['onepagecheckout_zone_id'])){
			$data['onepagecheckout_zone_id'] = $store_info['onepagecheckout_zone_id'];
		} else {
			$data['onepagecheckout_zone_id'] = '';
		}
		
		if (isset($this->request->post['onepagecheckout_default_shipping'])) {
			$data['onepagecheckout_default_shipping'] = $this->request->post['onepagecheckout_default_shipping'];
		}else if(isset($store_info['onepagecheckout_default_shipping'])){
			$data['onepagecheckout_default_shipping'] = $store_info['onepagecheckout_default_shipping'];
		} else {
			$data['onepagecheckout_default_shipping'] = '';
		}
		
		if (isset($this->request->post['onepagecheckout_default_payment'])) {
			$data['onepagecheckout_default_payment'] = $this->request->post['onepagecheckout_default_payment'];
		}else if(isset($store_info['onepagecheckout_default_payment'])){
			$data['onepagecheckout_default_payment'] = $store_info['onepagecheckout_default_payment'];
		} else {
			$data['onepagecheckout_default_payment'] = '';
		}
		
		if (isset($this->request->post['onepagecheckout_customer_group_id'])) {
			$data['onepagecheckout_customer_group_id'] = $this->request->post['onepagecheckout_customer_group_id'];
		}else if(isset($store_info['onepagecheckout_customer_group_id'])){
			$data['onepagecheckout_customer_group_id'] = $store_info['onepagecheckout_customer_group_id'];
		} else {
			$data['onepagecheckout_customer_group_id'] = '';
		}
		
		if (isset($this->request->post['onepagecheckout_autotrigger'])) {
			$data['onepagecheckout_autotrigger'] = $this->request->post['onepagecheckout_autotrigger'];
		}else if(isset($store_info['onepagecheckout_autotrigger'])){
			$data['onepagecheckout_autotrigger'] = $store_info['onepagecheckout_autotrigger'];
		} else {
			$data['onepagecheckout_autotrigger'] = '';
		}
		
		if (isset($this->request->post['onepagecheckout_field_layout'])) {
			$data['onepagecheckout_field_layout'] = $this->request->post['onepagecheckout_field_layout'];
		}else if(isset($store_info['onepagecheckout_field_layout'])){
			$data['onepagecheckout_field_layout'] = $store_info['onepagecheckout_field_layout'];
		} else {
			$data['onepagecheckout_field_layout'] = '';
		}
		
		if (isset($this->request->post['onepagecheckout_manage'])) {
			$data['onepagecheckout_manage'] = $this->request->post['onepagecheckout_manage'];
		}else if(isset($store_info['onepagecheckout_manage'])){
			$data['onepagecheckout_manage'] = $store_info['onepagecheckout_manage'];
		} else {
			$data['onepagecheckout_manage'] = array();
		}

		// Personal Details
		if(empty($data['onepagecheckout_manage']['personaldetails']['fields'])) {
			$data['onepagecheckout_manage']['personaldetails']['fields']['firstname'] = array(
				'sort_order'	=> '0',
				'label'				=> $this->language->get('entry_firstname'),
				'show'				=> '2',
			);
			
			$data['onepagecheckout_manage']['personaldetails']['fields']['lastname'] = array(
				'sort_order'	=> '1',
				'label'				=> $this->language->get('entry_lastname'),
				'show'				=> '2',
			);
			$data['onepagecheckout_manage']['personaldetails']['fields']['email'] = array(
				'sort_order'	=> '2',
				'label'				=> $this->language->get('entry_email'),
				'show'				=> '2',
			);
			$data['onepagecheckout_manage']['personaldetails']['fields']['telephone'] = array(
				'sort_order'	=> '3',
				'label'				=> $this->language->get('entry_telephone'),
				'show'				=> '2',
			);
			$data['onepagecheckout_manage']['personaldetails']['fields']['fax'] = array(
				'sort_order'	=> '4',
				'label'				=> $this->language->get('entry_fax'),
				'show'				=> '2',
			);
			$data['onepagecheckout_manage']['personaldetails']['fields']['company'] = array(
				'sort_order'	=> '5',
				'label'				=> $this->language->get('entry_company'),
				'show'				=> '2',
			);
			$data['onepagecheckout_manage']['personaldetails']['fields']['address_1'] = array(
				'sort_order'	=> '6',
				'label'				=> $this->language->get('entry_address_1'),
				'show'				=> '2',
			);
			$data['onepagecheckout_manage']['personaldetails']['fields']['address_2'] = array(
				'sort_order'	=> '7',
				'label'				=> $this->language->get('entry_address_2'),
				'show'				=> '2',
			);
			$data['onepagecheckout_manage']['personaldetails']['fields']['city'] = array(
				'sort_order'	=> '8',
				'label'				=> $this->language->get('entry_city'),
				'show'				=> '2',
			);
			$data['onepagecheckout_manage']['personaldetails']['fields']['postcode'] = array(
				'sort_order'	=> '9',
				'label'				=> $this->language->get('entry_postcode'),
				'show'				=> '2',
			);
			$data['onepagecheckout_manage']['personaldetails']['fields']['country'] = array(
				'sort_order'	=> '10',
				'label'				=> $this->language->get('entry_country'),
				'show'				=> '2',
			);
			$data['onepagecheckout_manage']['personaldetails']['fields']['zone'] = array(
				'sort_order'	=> '11',
				'label'				=> $this->language->get('entry_zone'),
				'show'				=> '2',
			);
			$data['onepagecheckout_manage']['personaldetails']['fields']['password'] = array(
				'sort_order'	=> '12',
				'label'				=> $this->language->get('entry_password'),
				'show'				=> '2',
			);
			$data['onepagecheckout_manage']['personaldetails']['fields']['confirm'] = array(
				'sort_order'	=> '13',
				'label'				=> $this->language->get('entry_confirm'),
				'show'				=> '2',
			);
		}
		
		// Delivery Details
		if(empty($data['onepagecheckout_manage']['delivery']['fields'])) {
			$data['onepagecheckout_manage']['delivery']['fields']['firstname'] = array(
				'sort_order'	=> '0',
				'label'				=> $this->language->get('entry_firstname'),
				'show'				=> '2',
			);
			
			$data['onepagecheckout_manage']['delivery']['fields']['lastname'] = array(
				'sort_order'	=> '1',
				'label'				=> $this->language->get('entry_lastname'),
				'show'				=> '2',
			);
			$data['onepagecheckout_manage']['delivery']['fields']['company'] = array(
				'sort_order'	=> '5',
				'label'				=> $this->language->get('entry_company'),
				'show'				=> '2',
			);
			$data['onepagecheckout_manage']['delivery']['fields']['address_1'] = array(
				'sort_order'	=> '6',
				'label'				=> $this->language->get('entry_address_1'),
				'show'				=> '2',
			);
			$data['onepagecheckout_manage']['delivery']['fields']['address_2'] = array(
				'sort_order'	=> '7',
				'label'				=> $this->language->get('entry_address_2'),
				'show'				=> '2',
			);
			$data['onepagecheckout_manage']['delivery']['fields']['city'] = array(
				'sort_order'	=> '8',
				'label'				=> $this->language->get('entry_city'),
				'show'				=> '2',
			);
			$data['onepagecheckout_manage']['delivery']['fields']['postcode'] = array(
				'sort_order'	=> '9',
				'label'				=> $this->language->get('entry_postcode'),
				'show'				=> '2',
			);
			$data['onepagecheckout_manage']['delivery']['fields']['country'] = array(
				'sort_order'	=> '10',
				'label'				=> $this->language->get('entry_country'),
				'show'				=> '2',
			);
			$data['onepagecheckout_manage']['delivery']['fields']['zone'] = array(
				'sort_order'	=> '11',
				'label'				=> $this->language->get('entry_zone'),
				'show'				=> '2',
			);
		}
		
		// Payment Details
		if(empty($data['onepagecheckout_manage']['payment_details']['fields'])) {
			$data['onepagecheckout_manage']['payment_details']['fields']['firstname'] = array(
				'sort_order'	=> '0',
				'label'				=> $this->language->get('entry_firstname'),
				'show'				=> '2',
			);
			
			$data['onepagecheckout_manage']['payment_details']['fields']['lastname'] = array(
				'sort_order'	=> '1',
				'label'				=> $this->language->get('entry_lastname'),
				'show'				=> '2',
			);
			$data['onepagecheckout_manage']['payment_details']['fields']['company'] = array(
				'sort_order'	=> '5',
				'label'				=> $this->language->get('entry_company'),
				'show'				=> '2',
			);
			$data['onepagecheckout_manage']['payment_details']['fields']['address_1'] = array(
				'sort_order'	=> '6',
				'label'				=> $this->language->get('entry_address_1'),
				'show'				=> '2',
			);
			$data['onepagecheckout_manage']['payment_details']['fields']['address_2'] = array(
				'sort_order'	=> '7',
				'label'				=> $this->language->get('entry_address_2'),
				'show'				=> '2',
			);
			$data['onepagecheckout_manage']['payment_details']['fields']['city'] = array(
				'sort_order'	=> '8',
				'label'				=> $this->language->get('entry_city'),
				'show'				=> '2',
			);
			$data['onepagecheckout_manage']['payment_details']['fields']['postcode'] = array(
				'sort_order'	=> '9',
				'label'				=> $this->language->get('entry_postcode'),
				'show'				=> '2',
			);
			$data['onepagecheckout_manage']['payment_details']['fields']['country'] = array(
				'sort_order'	=> '10',
				'label'				=> $this->language->get('entry_country'),
				'show'				=> '2',
			);
			$data['onepagecheckout_manage']['payment_details']['fields']['zone'] = array(
				'sort_order'	=> '11',
				'label'				=> $this->language->get('entry_zone'),
				'show'				=> '2',
			);
		}
		
		$data['customfeilds'] = $this->url->link('customer/custom_field','&token='.$this->session->data['token']);
		
		$this->load->model('tool/image');	
		$this->load->model('extension/extension');

		$delivery_methods = $this->model_extension_extension->getInstalled('shipping');
		$payment_methods = $this->model_extension_extension->getInstalled('payment');
		
		$data['delivery_methods'] = array();
		foreach($delivery_methods as $delivery_method_code){
			$this->load->language('extension/shipping/'. $delivery_method_code);
			
			if (isset($data['onepagecheckout_manage']['delivery_method'][$delivery_method_code]['image']) && is_file(DIR_IMAGE . $data['onepagecheckout_manage']['delivery_method'][$delivery_method_code]['image'])) {
				$thumb = $this->model_tool_image->resize($data['onepagecheckout_manage']['delivery_method'][$delivery_method_code]['image'], 100, 100);
			} else {
				$thumb = $this->model_tool_image->resize('no_image.png', 100, 100);
			}
			
			$data['delivery_methods'][] = array(
				'title' 		=> $this->language->get('heading_title'),
				'code'			=> $delivery_method_code,
				'thumb'			=> $thumb,
			);
		}
		
		$data['payment_methods'] = array();
		foreach($payment_methods as $payment_method_code) {
			$this->load->language('extension/payment/'. $payment_method_code);
			if (isset($data['onepagecheckout_manage']['payment_method'][$payment_method_code]['image']) && is_file(DIR_IMAGE . $data['onepagecheckout_manage']['payment_method'][$payment_method_code]['image'])) {
				$thumb = $this->model_tool_image->resize($data['onepagecheckout_manage']['payment_method'][$payment_method_code]['image'], 100, 100);
			} else {
				$thumb = $this->model_tool_image->resize('no_image.png', 100, 100);
			}
			
			$data['payment_methods'][] = array(
				'title' 		=> $this->language->get('heading_title'),
				'code'			=> $payment_method_code,
				'thumb'			=> $thumb,
			);
		}
		
		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		
		$this->load->model('setting/store');
		$data['stores'] = $this->model_setting_store->getStores();
		
		$this->load->model('localisation/country');
		$data['countries'] = $this->model_localisation_country->getCountries();
	
		$this->load->model('catalog/information');
		$data['informations'] = $this->model_catalog_information->getInformations();
		
		$this->load->model('customer/customer_group');
		$data['customer_groups'] = $this->model_customer_customer_group->getCustomerGroups();
		
		// Dashboard Extensions

		$dashboards = array();



		$this->load->model('extension/extension');



		// Get a list of installed modules

		$extensions = $this->model_extension_extension->getInstalled('dashboard');
		
		// Add all the modules which have multiple settings for each module
		
		$ignores=array('activity','customer','online','recent');

		foreach ($extensions as $code) {
			if(!in_array($code,$ignores)){

				if ($this->config->get('dashboard_' . $code . '_status') && $this->user->hasPermission('access', 'extension/dashboard/' . $code)) {

					$output = $this->load->controller('extension/dashboard/' . $code . '/dashboard');

					

					if ($output) {

						$dashboards[] = array(

							'code'       => $code,

							'width'      => $this->config->get('dashboard_' . $code . '_width'),

							'sort_order' => $this->config->get('dashboard_' . $code . '_sort_order'),

							'output'     => $output

						);

					}

				}
			}

		}



		$sort_order = array();



		foreach ($dashboards as $key => $value) {

			$sort_order[$key] = $value['sort_order'];

		}



		array_multisort($sort_order, SORT_ASC, $dashboards);

		

		// Split the array so the columns width is not more than 12 on each row.

		$width = 0;

		$column = array();

		$data['rows'] = array();

		

		foreach ($dashboards as $dashboard) {
			if($dashboard['width']==3){
				$dashboard['width']=6;
			}

			$column[] = $dashboard;

			

			$width = ($width + $dashboard['width']);

			

			if ($width >= 12) {

				$data['rows'][] = $column;

				

				$width = 0;

				$column = array();

			}

		}
		
				
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view('extension/module/onepagecheckout'.$this->tpl, $data));
	}

	protected function validate(){
		if (!$this->user->hasPermission('modify', 'extension/module/onepagecheckout')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		return !$this->error;
	}
	
	public function Restoresetting(){
		$this->load->language('extension/module/onepagecheckout');
		if($this->validate()){
			if(isset($this->request->get['store_id'])) {
				$store_id = $this->request->get['store_id'];
			}else{
				$store_id	= 0;
			}
			
			$code = 'onepagecheckout';
			$file = DIR_SYSTEM.'onepagechekout/onepagecheckout.sql';
			if(file_exists($file)){
				$this->db->query("DELETE FROM " . DB_PREFIX . "setting WHERE store_id = '" . (int)$store_id . "' AND `code` = '" . $this->db->escape($code) . "'");
				$replace = DB_PREFIX.'setting';
				$content = file_get_contents($file);
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "setting WHERE store_id = '" . (int)$store_id . "' AND `code` = '" . $this->db->escape($code) . "'");
				$content1 = str_replace("ocxd_setting",$replace,$content);
				foreach (explode(";\n", $content1) as $sql) {
					$sql = trim($sql);

					if ($sql) {
						$this->db->query($sql);
					}
				}
				$this->session->data['success'] = 'Success: You have restored default extension settings!';
			}else{
				$this->session->data['warning'] = 'Sql File Missing !';
			}
		}else{
			$this->session->data['warning'] = $this->language->get('error_permission');
		}
		$this->response->redirect($this->url->link('extension/module/onepagecheckout', 'token=' . $this->session->data['token'], $this->ssl . '&type=module'));
	}
}