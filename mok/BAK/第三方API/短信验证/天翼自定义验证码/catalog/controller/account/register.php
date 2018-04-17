<?php
class ControllerAccountRegister extends Controller {
	private $error = array();

	public function index() {
		if ($this->customer->isLogged()) {
			$this->response->redirect($this->url->link('account/account', '', 'SSL'));
		}

		$this->load->language('account/register');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment.js');
		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js');
		$this->document->addStyle('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css');
		
		$this->load->model('account/customer');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->request->post['typesubmit'] == 'email-register' && $this->validate()) {
			if(!isset($this->request->post['lastname'])){
				$this->request->post['lastname'] = '';
			}
			if(!isset($this->request->post['fax'])){
				$this->request->post['fax'] = '';
			}
			if(!isset($this->request->post['newsletter'])){
				$this->request->post['newsletter'] = 1;
			}
			if(!isset($this->request->post['telephone'])){
				$this->request->post['telephone'] = '';
			}
			
			$this->model_account_customer->addCustomer($this->request->post);
			
			// Clear any previous login attempts for unregistered accounts.
			$this->model_account_customer->deleteLoginAttempts($this->request->post['email']);
			
			$this->customer->login($this->request->post['email'], $this->request->post['password']);

			unset($this->session->data['guest']);

			// Add to activity log
			$this->load->model('account/activity');

			$activity_data = array(
				'customer_id' => $this->customer->getId(),
				'name'        => $this->request->post['lastname'] . ' ' . $this->request->post['firstname']  
			);

			$this->model_account_activity->addActivity('register', $activity_data);

			$this->response->redirect($this->url->link('account/success'));
		}
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->request->post['typesubmit'] == 'telephone-register' && $this->validate2()) {
			if(!isset($this->request->post['lastname'])){
				$this->request->post['lastname'] = '';
			}
			if(!isset($this->request->post['fax'])){
				$this->request->post['fax'] = '';
			}
			if(!isset($this->request->post['newsletter'])){
				$this->request->post['newsletter'] = 1;
			}
			if(!isset($this->request->post['email'])){
				$this->request->post['email'] = '';
			}
			
			$this->model_account_customer->addCustomer($this->request->post);
			
			// Clear any previous login attempts for unregistered accounts.
			$this->model_account_customer->deleteLoginAttempts($this->request->post['telephone']);
			
			$this->customer->login($this->request->post['telephone'], $this->request->post['password']);

			unset($this->session->data['guest']);

			// Add to activity log
			$this->load->model('account/activity');

			$activity_data = array(
				'customer_id' => $this->customer->getId(),
				'name'        => $this->request->post['lastname'] . ' ' . $this->request->post['firstname']  
			);

			$this->model_account_activity->addActivity('register', $activity_data);

			$this->response->redirect($this->url->link('account/success'));
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_account'),
			'href' => $this->url->link('account/account', '', 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_register'),
			'href' => $this->url->link('account/register', '', 'SSL')
		);

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_account_already'] = sprintf($this->language->get('text_account_already'), $this->url->link('account/login', '', 'SSL'));
		$data['text_your_details'] = $this->language->get('text_your_details');
		$data['text_your_address'] = $this->language->get('text_your_address');
		$data['text_your_password'] = $this->language->get('text_your_password');
		$data['text_newsletter'] = $this->language->get('text_newsletter');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_loading'] = $this->language->get('text_loading');

		$data['entry_customer_group'] = $this->language->get('entry_customer_group');
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
		$data['entry_password'] = $this->language->get('entry_password');
		$data['entry_confirm'] = $this->language->get('entry_confirm');
		$data['entry_captcha'] = $this->language->get('entry_captcha');
		
		//add
		$data['pre_lastname'] = $this->language->get('pre_lastname');
		$data['pre_firstname'] = $this->language->get('pre_firstname');
		$data['pre_telephone'] = $this->language->get('pre_telephone');
		$data['pre_email'] = $this->language->get('pre_email');
		$data['pre_password'] = $this->language->get('pre_password');
		$data['pre_confirm'] = $this->language->get('pre_confirm');
		$data['button_submit'] = $this->language->get('button_submit');
		$data['pre_securitycode'] = $this->language->get('pre_securitycode');
		$data['text_welcome'] = $this->language->get('text_welcome');
		$data['text_email_change'] = $this->language->get('text_email_change');
		$data['text_telephone_change'] = $this->language->get('text_telephone_change');
		$data['text_sendsms'] = $this->language->get('text_sendsms');
		$data['text_sendsms_success'] = $this->language->get('text_sendsms_success');
		$data['text_sendsms_again'] = $this->language->get('text_sendsms_again');
		$data['text_telephone_error'] = $this->language->get('text_telephone_error');
		$data['text_sendsmsing'] = $this->language->get('text_sendsmsing');
		$data['text_firstname_error'] = $this->language->get('text_firstname_error');
		$data['text_password_error'] = $this->language->get('text_password_error');
		$data['text_confirm_error'] = $this->language->get('text_confirm_error');
 
		$data['button_continue'] = $this->language->get('button_continue');
		$data['button_upload'] = $this->language->get('button_upload');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['firstname'])) {
			$data['error_firstname'] = $this->error['firstname'];
		} else {
			$data['error_firstname'] = '';
		}

		if (isset($this->error['lastname'])) {
			$data['error_lastname'] = $this->error['lastname'];
		} else {
			$data['error_lastname'] = '';
		}

		if (isset($this->error['email'])) {
			$data['error_email'] = $this->error['email'];
		} else {
			$data['error_email'] = '';
		}

		if (isset($this->error['telephone'])) {
			$data['error_telephone'] = $this->error['telephone'];
		} else {
			$data['error_telephone'] = '';
		}
		
		if (isset($this->error['securitycode'])) {
			$data['error_securitycode'] = $this->error['securitycode'];
		} else {
			$data['error_securitycode'] = '';
		}

		if (isset($this->error['address_1'])) {
			$data['error_address_1'] = $this->error['address_1'];
		} else {
			$data['error_address_1'] = '';
		}

		if (isset($this->error['city'])) {
			$data['error_city'] = $this->error['city'];
		} else {
			$data['error_city'] = '';
		}

		if (isset($this->error['postcode'])) {
			$data['error_postcode'] = $this->error['postcode'];
		} else {
			$data['error_postcode'] = '';
		}

		if (isset($this->error['country'])) {
			$data['error_country'] = $this->error['country'];
		} else {
			$data['error_country'] = '';
		}

		if (isset($this->error['zone'])) {
			$data['error_zone'] = $this->error['zone'];
		} else {
			$data['error_zone'] = '';
		}

		if (isset($this->error['custom_field'])) {
			$data['error_custom_field'] = $this->error['custom_field'];
		} else {
			$data['error_custom_field'] = array();
		}

		if (isset($this->error['password'])) {
			$data['error_password'] = $this->error['password'];
		} else {
			$data['error_password'] = '';
		}

		if (isset($this->error['confirm'])) {
			$data['error_confirm'] = $this->error['confirm'];
		} else {
			$data['error_confirm'] = '';
		}
		
		if (isset($this->error['captcha'])) {
			$data['error_captcha'] = $this->error['captcha'];
		} else {
			$data['error_captcha'] = '';
		}
		
		if (isset($this->error['securitycode'])) {
			$data['error_securitycode'] = $this->error['securitycode'];
		} else {
			$data['error_securitycode'] = '';
		}

		$data['action'] = $this->url->link('account/register', '', 'SSL');

		$data['customer_groups'] = array();

		if (is_array($this->config->get('config_customer_group_display'))) {
			$this->load->model('account/customer_group');

			$customer_groups = $this->model_account_customer_group->getCustomerGroups();

			foreach ($customer_groups as $customer_group) {
				if (in_array($customer_group['customer_group_id'], $this->config->get('config_customer_group_display'))) {
					$data['customer_groups'][] = $customer_group;
				}
			}
		}

		if (isset($this->request->post['customer_group_id'])) {
			$data['customer_group_id'] = $this->request->post['customer_group_id'];
		} else {
			$data['customer_group_id'] = $this->config->get('config_customer_group_id');
		}

		if (isset($this->request->post['firstname'])) {
			$data['firstname'] = $this->request->post['firstname'];
		} else {
			$data['firstname'] = '';
		}

		if (isset($this->request->post['lastname'])) {
			$data['lastname'] = $this->request->post['lastname'];
		} else {
			$data['lastname'] = '';
		}

		if (isset($this->request->post['email'])) {
			$data['email'] = $this->request->post['email'];
		} else {
			$data['email'] = '';
		}

		if (isset($this->request->post['telephone'])) {
			$data['telephone'] = $this->request->post['telephone'];
		} else {
			$data['telephone'] = '';
		}
		
		if (isset($this->request->post['securitycode'])) {
			$data['securitycode'] = $this->request->post['securitycode'];
		} else {
			$data['securitycode'] = '';
		}

		if (isset($this->request->post['fax'])) {
			$data['fax'] = $this->request->post['fax'];
		} else {
			$data['fax'] = '';
		}

		if (isset($this->request->post['company'])) {
			$data['company'] = $this->request->post['company'];
		} else {
			$data['company'] = '';
		}

		if (isset($this->request->post['address_1'])) {
			$data['address_1'] = $this->request->post['address_1'];
		} else {
			$data['address_1'] = '';
		}

		if (isset($this->request->post['address_2'])) {
			$data['address_2'] = $this->request->post['address_2'];
		} else {
			$data['address_2'] = '';
		}

		if (isset($this->request->post['postcode'])) {
			$data['postcode'] = $this->request->post['postcode'];
		} elseif (isset($this->session->data['shipping_address']['postcode'])) {
			$data['postcode'] = $this->session->data['shipping_address']['postcode'];
		} else {
			$data['postcode'] = '';
		}

		if (isset($this->request->post['city'])) {
			$data['city'] = $this->request->post['city'];
		} else {
			$data['city'] = '';
		}

		if (isset($this->request->post['country_id'])) {
			$data['country_id'] = (int)$this->request->post['country_id'];
		} elseif (isset($this->session->data['shipping_address']['country_id'])) {
			$data['country_id'] = $this->session->data['shipping_address']['country_id'];
		} else {
			$data['country_id'] = $this->config->get('config_country_id');
		}

		if (isset($this->request->post['zone_id'])) {
			$data['zone_id'] = (int)$this->request->post['zone_id'];
		} elseif (isset($this->session->data['shipping_address']['zone_id'])) {
			$data['zone_id'] = $this->session->data['shipping_address']['zone_id'];
		} else {
			$data['zone_id'] = '';
		}
		/* add */
		if (isset($this->request->post['typesubmit'])){
			if($this->request->post['typesubmit'] == 'telphone-register'){
				$data['typesubmit'] = 'telphone-register';
			}else if($this->request->post['typesubmit'] == 'email-register'){
				$data['typesubmit'] = 'email-register';
			}else{
				$data['typesubmit'] = false;
			}
		}else{
			$data['typesubmit'] = false;
		}
		

		$this->load->model('localisation/country');

		$data['countries'] = $this->model_localisation_country->getCountries();

		// Custom Fields
		$this->load->model('account/custom_field');

		$data['custom_fields'] = $this->model_account_custom_field->getCustomFields();

		if (isset($this->request->post['custom_field'])) {
			if (isset($this->request->post['custom_field']['account'])) {
				$account_custom_field = $this->request->post['custom_field']['account'];
			} else {
				$account_custom_field = array();
			}
			
			if (isset($this->request->post['custom_field']['address'])) {
				$address_custom_field = $this->request->post['custom_field']['address'];
			} else {
				$address_custom_field = array();
			}			
			
			$data['register_custom_field'] = $account_custom_field + $address_custom_field;
		} else {
			$data['register_custom_field'] = array();
		}

		if (isset($this->request->post['password'])) {
			$data['password'] = $this->request->post['password'];
		} else {
			$data['password'] = '';
		}

		if (isset($this->request->post['confirm'])) {
			$data['confirm'] = $this->request->post['confirm'];
		} else {
			$data['confirm'] = '';
		}

		if (isset($this->request->post['newsletter'])) {
			$data['newsletter'] = $this->request->post['newsletter'];
		} else {
			$data['newsletter'] = '';
		}

		if ($this->config->get('config_account_id')) {
			$this->load->model('catalog/information');

			$information_info = $this->model_catalog_information->getInformation($this->config->get('config_account_id'));

			if ($information_info) {
				$data['text_agree'] = sprintf($this->language->get('text_agree'), $this->url->link('information/information/agree', 'information_id=' . $this->config->get('config_account_id'), 'SSL'), $information_info['title'], $information_info['title']);
			} else {
				$data['text_agree'] = '';
			}
		} else {
			$data['text_agree'] = '';
		}

		if (isset($this->request->post['agree'])) {
			$data['agree'] = $this->request->post['agree'];
		} else {
			$data['agree'] = false;
		}
		
		if (isset($this->request->post['captcha'])) {
			$data['captcha'] = $this->request->post['captcha'];
		} else {
			$data['captcha'] = '';
		}

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['minfooter'] = $this->load->controller('common/minfooter');
		$data['minheader'] = $this->load->controller('common/minheader');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/register.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/account/register.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/account/register.tpl', $data));
		}
	}

	public function validate() {
		if ((utf8_strlen(trim($this->request->post['firstname'])) < 1) || (utf8_strlen(trim($this->request->post['firstname'])) > 32)) {
			$this->error['firstname'] = $this->language->get('error_firstname');
		}

		/*
		if ((utf8_strlen(trim($this->request->post['lastname'])) < 1) || (utf8_strlen(trim($this->request->post['lastname'])) > 32)) {
			$this->error['lastname'] = $this->language->get('error_lastname');
		}
		*/

		if ((utf8_strlen($this->request->post['email']) > 96) || !preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $this->request->post['email'])) {
			$this->error['email'] = $this->language->get('error_email');
		}

		if ($this->model_account_customer->getTotalCustomersByEmail($this->request->post['email']) && $this->request->post['email']!= '') {
			$this->error['warning'] = $this->language->get('error_exists');
		}
		/*
		if ((utf8_strlen($this->request->post['telephone']) < 7) || (utf8_strlen($this->request->post['telephone']) > 32)) {
			$this->error['telephone'] = $this->language->get('error_telephone');
		}
		
		if ((utf8_strlen(trim($this->request->post['address_1'])) < 3) || (utf8_strlen(trim($this->request->post['address_1'])) > 128)) {
			$this->error['address_1'] = $this->language->get('error_address_1');
		}

		if ((utf8_strlen(trim($this->request->post['city'])) < 2) || (utf8_strlen(trim($this->request->post['city'])) > 128)) {
			$this->error['city'] = $this->language->get('error_city');
		}

		$this->load->model('localisation/country');

		$country_info = $this->model_localisation_country->getCountry($this->request->post['country_id']);

		if ($country_info && $country_info['postcode_required'] && (utf8_strlen(trim($this->request->post['postcode'])) < 2 || utf8_strlen(trim($this->request->post['postcode'])) > 10)) {
			$this->error['postcode'] = $this->language->get('error_postcode');
		}

		if ($this->request->post['country_id'] == '') {
			$this->error['country'] = $this->language->get('error_country');
		}

		if (!isset($this->request->post['zone_id']) || $this->request->post['zone_id'] == '' || !is_numeric($this->request->post['zone_id'])) {
			$this->error['zone'] = $this->language->get('error_zone');
		}
		*/
		// Customer Group
		if (isset($this->request->post['customer_group_id']) && is_array($this->config->get('config_customer_group_display')) && in_array($this->request->post['customer_group_id'], $this->config->get('config_customer_group_display'))) {
			$customer_group_id = $this->request->post['customer_group_id'];
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

		// Custom field validation
		$this->load->model('account/custom_field');

		$custom_fields = $this->model_account_custom_field->getCustomFields($customer_group_id);

		foreach ($custom_fields as $custom_field) {
			if ($custom_field['required'] && empty($this->request->post['custom_field'][$custom_field['location']][$custom_field['custom_field_id']])) {
				$this->error['custom_field'][$custom_field['custom_field_id']] = sprintf($this->language->get('error_custom_field'), $custom_field['name']);
			}
		}

		if ((utf8_strlen($this->request->post['password']) < 6) || (utf8_strlen($this->request->post['password']) > 20)) {
			$this->error['password'] = $this->language->get('error_password');
		}

		if ($this->request->post['confirm'] != $this->request->post['password']) {
			$this->error['confirm'] = $this->language->get('error_confirm');
		}

		// Agree to terms
		if ($this->config->get('config_account_id')) {
			$this->load->model('catalog/information');

			$information_info = $this->model_catalog_information->getInformation($this->config->get('config_account_id'));

			if ($information_info && !isset($this->request->post['agree'])) {
				$this->error['warning'] = sprintf($this->language->get('error_agree'), $information_info['title']);
			}
		}
		
		if (empty($this->session->data['captcha']) || ($this->session->data['captcha'] != $this->request->post['captcha'])) {
			$this->error['captcha'] = $this->language->get('error_captcha');
		}

		return !$this->error;
	}
	
	public function validate2() {
		if ((utf8_strlen(trim($this->request->post['firstname'])) < 1) || (utf8_strlen(trim($this->request->post['firstname'])) > 32)) {
			$this->error['firstname'] = $this->language->get('error_firstname');
		}
		
		if (!preg_match('/^1[3458][0-9]{9}$/', $this->request->post['telephone'])) {
			$this->error['telephone'] = $this->language->get('error_telephone');
		}
		
		if ($this->model_account_customer->getTotalCustomersByTelephone($this->request->post['telephone']) && $this->request->post['telephone']!= '') {
			$this->error['warning'] = $this->language->get('error_telephone_exists');	
		}
		
		if ($this->request->post['telephone']!=''){
		$this->load->model('account/sendsms');
		$securitycode = $this->model_account_sendsms->getSecurityCodeByTelephone($this->request->post['telephone']);
		if($securitycode != $this->request->post['securitycode']){
			$this->error['securitycode'] = $this->language->get('error_securitycode');
		}
		}
		
		
		
		
		
		// Customer Group
		if (isset($this->request->post['customer_group_id']) && is_array($this->config->get('config_customer_group_display')) && in_array($this->request->post['customer_group_id'], $this->config->get('config_customer_group_display'))) {
			$customer_group_id = $this->request->post['customer_group_id'];
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

		// Custom field validation
		$this->load->model('account/custom_field');

		$custom_fields = $this->model_account_custom_field->getCustomFields($customer_group_id);

		foreach ($custom_fields as $custom_field) {
			if ($custom_field['required'] && empty($this->request->post['custom_field'][$custom_field['location']][$custom_field['custom_field_id']])) {
				$this->error['custom_field'][$custom_field['custom_field_id']] = sprintf($this->language->get('error_custom_field'), $custom_field['name']);
			}
		}

		if ((utf8_strlen($this->request->post['password']) < 6) || (utf8_strlen($this->request->post['password']) > 20)) {
			$this->error['password'] = $this->language->get('error_password');
		}

		if ($this->request->post['confirm'] != $this->request->post['password']) {
			$this->error['confirm'] = $this->language->get('error_confirm');
		}

		// Agree to terms
		if ($this->config->get('config_account_id')) {
			$this->load->model('catalog/information');

			$information_info = $this->model_catalog_information->getInformation($this->config->get('config_account_id'));

			if ($information_info && !isset($this->request->post['agree'])) {
				$this->error['warning'] = sprintf($this->language->get('error_agree'), $information_info['title']);
			}
		}

		return !$this->error;
	}

	public function customfield() {
		$json = array();

		$this->load->model('account/custom_field');

		// Customer Group
		if (isset($this->request->get['customer_group_id']) && is_array($this->config->get('config_customer_group_display')) && in_array($this->request->get['customer_group_id'], $this->config->get('config_customer_group_display'))) {
			$customer_group_id = $this->request->get['customer_group_id'];
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

		$custom_fields = $this->model_account_custom_field->getCustomFields($customer_group_id);

		foreach ($custom_fields as $custom_field) {
			$json[] = array(
				'custom_field_id' => $custom_field['custom_field_id'],
				'required'        => $custom_field['required']
			);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function sendsms(){
	/*设置UTF编码*/
	header("Content-type: text/html; charset=utf-8"); 
	/*默认时区设置，避免时间戳误差，本地程序有设置则无须重复设置*/
	function_exists('date_default_timezone_set') && date_default_timezone_set('Etc/GMT-8');
	$this->load->model('account/sendsms');
	$this->load->language('account/register');
	$this->load->model('account/customer');
	
	$json = array();
	
	if(isset($this->request->post['telephone'])){
		$telephone = $this->request->post['telephone'];
	}else{
		$telephone = '';
		$json['error']['telephone'] = $this->language->get('text_telephone_error');
	}
	
	if ($this->model_account_customer->getTotalCustomersByTelephone($this->request->post['telephone']) && $this->request->post['telephone']!= '') {
		$json['error']['telephone'] = $this->language->get('error_telephone_exists');
	}
	
	/* 防止恶意点击1小时内同一号码仅5次短信验证机会 */
	$now_date = time();
	$begin = (int)$now_date - 1800;
	$end = (int)$now_date + 1800;
	$total_telephone = $this->model_account_sendsms->getTotalTelephone($telephone,$begin,$end);
	if($total_telephone > 5){	
		$json['error']['telephone'] = $this->language->get('error_telephone_again');
	}
	
	/* 同IP下仅10个手机号码可用 */
	/* ADD sql */
	if (isset($this->request->server['HTTP_USER_AGENT'])) {
		$user_agent = $this->request->server['HTTP_USER_AGENT'];
	} else {
		$user_agent = '';
	}
			if (isset($_SERVER['REMOTE_ADDR'])) {
				$ip = $_SERVER['REMOTE_ADDR'];
			} else {
				$ip = '';
			}                 
			if (isset($_SERVER['HTTP_X_REAL_FORWARDED_FOR']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/',$_SERVER['HTTP_X_REAL_FORWARDED_FOR'])) {                       
				$ip = $_SERVER['HTTP_X_REAL_FORWARDED_FOR'];                
			}elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/',$_SERVER['HTTP_X_FORWARDED_FOR'])) {                       
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];                
			}elseif (isset($_SERVER['HTTP_CLIENT_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/',$_SERVER['HTTP_CLIENT_IP'])){                
				$ip = $_SERVER['HTTP_CLIENT_IP'];                
			} 
	
	$total_ip_telephone = $this->model_account_sendsms->getTotalTelephoneByIp($ip,$begin,$end);
	if($total_ip_telephone > 10){
		$json['error']['telephone'] = $this->language->get('error_ip_telephone');
	}
	
	if ((utf8_strlen(trim($this->request->post['firstname'])) < 1) || (utf8_strlen(trim($this->request->post['firstname'])) > 32)) {
		$json['error']['firstname'] = $this->language->get('text_firstname_error');
	}
	
	if ((utf8_strlen($this->request->post['password']) < 6) || (utf8_strlen($this->request->post['password']) > 20)) {
		$json['error']['password'] = $this->language->get('text_password_error');
	}

	if ($this->request->post['confirm'] != $this->request->post['password']) {
		$json['error']['confirm'] = $this->language->get('text_confirm_error');
	}
	/* error all */
	
	if(!$json){
    $appId = $this->config->get('tianyisms_apiid');
    $appSecret = $this->config->get('tianyisms_apisecret');
	$accessToken = '';
	$accessTokenExpTime = $this->config->get('tianyisms_expires_in');
	$token = '';
	$granttype = 'client_credentials';
	$timestamp = date('Y-m-d H:i:s');
	

	$randcode = rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9);
	$expTime = 5;
	
	// API URL
	$accessTokenUrl = "https://oauth.api.189.cn/emp/oauth2/v3/access_token";
	$tokenUrl = "http://api.189.cn/v2/dm/randcode/token";
	$sendSmsUrl = "http://api.189.cn/v2/dm/randcode/sendSms";
	
	//result
	$accessTokenJson = '';
	$tokenJson = '';
	$sendSmsJson = '';
	
	$Sms = $this->model_account_sendsms;
	
	$now = time();
	if($accessTokenExpTime == null || ($now >= strtotime($accessTokenExpTime))){
	$params_array_at = array(
		'grant_type' => $granttype,
		'app_id' => $appId,
		'app_secret' => $appSecret
	);
	ksort($params_array_at);
	$accessTokenJson = json_decode($Sms->post($accessTokenUrl,$params_array_at,array(),1),true);
	$accessToken = $accessTokenJson['access_token'];
	$expires_in = date('Y-m-d H:i:s',$now + $accessTokenJson['expires_in']);
	$Sms->editexpiresin($expires_in);
	$Sms->editaccesstoken($accessToken);
	
	}else{
	$accessToken = $this->config->get('tianyisms_access_token');
	}
	/* 获取token 对查询参数进行加密 */
	$params_array_to = array(
		'app_id' => $appId,
		'access_token' => $accessToken,
		'timestamp' => $timestamp
	);
	ksort($params_array_to);
	$params_str_to = '';
	foreach($params_array_to as $k=>$v){
		$params_str_to .= '&'.$k.'='.$v;
	}
	$params_str_to = substr($params_str_to,1);
	$sign = base64_encode(hash_hmac("sha1",$params_str_to,$appSecret,true));
	$params_array_to['sign'] = $sign;
	$tokenJson = json_decode($Sms->post($tokenUrl,$params_array_to),true);
	$token = $tokenJson['token'];
	
	/* Sms */
	$params_array_sm = array(
		'app_id' => $appId,
		'access_token' => $accessToken,
		'token' => $token,
		'phone' => $telephone,
		'randcode' => $randcode,
		'exp_time' => $expTime,
		'timestamp' => $timestamp
	);
	ksort($params_array_sm);
	$params_str_sm = '';
	foreach($params_array_sm as $k=>$v){
		$params_str_sm .= '&'.$k.'='.$v;
	}
	$params_str_sm = substr($params_str_sm,1);
	$sign = base64_encode(hash_hmac("sha1",$params_str_sm,$appSecret,true));
	$params_array_sm['sign'] = $sign;
	
	$sendSmsJson = json_decode($Sms->post($sendSmsUrl,$params_array_sm),true);
		
	$res_code = 'sendSmsJson:' . $sendSmsJson['res_code'];
	$json['res_code'] = $res_code;
	$send_status = (int)!$sendSmsJson['res_code'];
	
	$security_data = array(
		'security_code' => $randcode,
		'user_agent' => $user_agent,
		'ip' => $ip,
		'telephone' => $telephone,
		'res_code' => $res_code,
		'send_status' => $send_status,
		'date_added' => $timestamp
	);

	$Sms->addSecurityCode($security_data);
	
	/* end */
	}
	$this->response->addHeader('Content-Type: application/json');
	$this->response->setOutput(json_encode($json));
	}
}