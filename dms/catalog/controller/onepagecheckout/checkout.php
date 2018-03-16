<?php
class ControllerOnepagecheckoutCheckout extends Controller {
	private $error=array();
	private $ssl = 'SSL';
	private $json=array();
	
	public function __construct($registry){
		parent::__construct( $registry );
		$this->ssl = (defined('VERSION') && version_compare(VERSION,'2.2.0.0','>=')) ? true : 'SSL';
	}
	
	public function index(){
		$this->load->language('onepagecheckout/checkout');
		//Validate cart has products and has stock.
		if ((!$this->cart->hasProducts() && empty($this->session->data['vouchers'])) || (!$this->cart->hasStock() && !$this->config->get('config_stock_checkout'))) {
			$error_warning = $this->language->get('error_stock');
		}

		// Validate minimum quantity requirements.
		$products = $this->cart->getProducts();

		foreach ($products as $product){
			$product_total = 0;

			foreach ($products as $product_2) {
				if ($product_2['product_id'] == $product['product_id']) {
					$product_total += $product_2['quantity'];
				}
			}

			if ($product['minimum'] > $product_total) {
				$this->response->redirect($this->url->link('checkout/cart'));
			}
		}
		
		
		$this->load->model('setting/setting');
		
		$onepagecheckout_info = $this->model_setting_setting->getSetting('onepagecheckout', $this->config->get('config_store_id'));
		
		if(empty($onepagecheckout_info['onepagecheckout_status'])){
			$this->response->redirect($this->url->link('checkout/checkout'));
		}
		
		
		
		$onepagecheckout_manage = (!empty($onepagecheckout_info['onepagecheckout_manage'])) ? $onepagecheckout_info['onepagecheckout_manage'] : array();
		
		$heading_title = (!empty($onepagecheckout_manage['general']['heading_title'][$this->config->get('config_language_id')])) ? $onepagecheckout_manage['general']['heading_title'][$this->config->get('config_language_id')] : $this->language->get('heading_title');
		
		
		$data['header_description'] = (!empty($onepagecheckout_manage['general']['description'][$this->config->get('config_language_id')]) ? html_entity_decode($onepagecheckout_manage['general']['description'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8') : '');
		
		$data['bottom_description'] = (!empty($onepagecheckout_manage['general']['description_bottom'][$this->config->get('config_language_id')]) ? html_entity_decode($onepagecheckout_manage['general']['description_bottom'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8') : '');
		
		
		$data['register_status'] = (!empty($onepagecheckout_manage['personaldetails']['register_status']) ? $onepagecheckout_manage['personaldetails']['register_status'] : '');
		$data['guest_status'] = (!empty($onepagecheckout_manage['personaldetails']['guest_status']) ? $onepagecheckout_manage['personaldetails']['guest_status'] : '');
		$data['enable_login'] = (!empty($onepagecheckout_manage['login']['enable_login']) ? $onepagecheckout_manage['login']['enable_login'] : '');
		
		$data['text_payment_methods'] = (!empty($onepagecheckout_manage['payment_method']['heading_title'][$this->config->get('config_language_id')]) ? $onepagecheckout_manage['payment_method']['heading_title'][$this->config->get('config_language_id')] : $this->language->get('text_payment_methods'));
		
		$data['text_shipping_method'] = (!empty($onepagecheckout_manage['delivery_method']['heading_title'][$this->config->get('config_language_id')]) ? $onepagecheckout_manage['delivery_method']['heading_title'][$this->config->get('config_language_id')] : $this->language->get('text_shipping_method'));
		
		$data['text_shopping_cart'] = $this->language->get('text_shopping_cart');
		
		
		if(!empty($onepagecheckout_manage['shopping_cart']['shopping_cart_status'])) {
			$data['shopping_cart_status'] = true;
		} else {
			$data['shopping_cart_status'] = false;
		}
		
		if($this->config->get('onepagecheckout_field_layout')){
		  $data['class1'] = 'extsm-4';
		  $data['class2'] = 'extsm-8';
		}else{
		 $data['class1'] = 'extsm-5';
		  $data['class2'] = 'extsm-7';
		}
		
		$data['error_field_layout'] = $this->config->get('onepagecheckout_field_layout');
		
		$this->document->setTitle($heading_title);
		
		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment.js');
		$this->document->addScript('catalog/view/javascript/onepagecheckout/js/onepagecheckout.js');
		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js');
		$this->document->addStyle('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css');

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $heading_title,
			'href' => $this->url->link('onepagecheckout/checkout', '', true)
		);

		$data['heading_title'] = $heading_title;
		
		

		if ($this->cart->hasProducts() || !empty($this->session->data['vouchers'])) {
			if(isset($error_warning)){
				$data['error_warning'] = $error_warning;
			}elseif (isset($this->session->data['error'])){
				$data['error_warning'] = $this->session->data['error'];
				unset($this->session->data['error']);
			} else {
				$data['error_warning'] = '';
			}
			
			$data['logged'] = $this->customer->isLogged();
			
			$data['account_open'] = (!empty($onepagecheckout_manage['general']['account_open']) ? $onepagecheckout_manage['general']['account_open'] : 'register');
			
			//CART START
			$data['weight'] = (!empty($onepagecheckout_manage['shopping_cart']['show_product_weight']) ? $this->weight->format($this->cart->getWeight(), $this->config->get('config_weight_class_id'), $this->language->get('decimal_point'), $this->language->get('thousand_point')) : '');
			
			if(isset($this->request->post['account_type'])) {
				$account_type = $this->request->post['account_type'];
			} else {
				$account_type = 'login';
			}
			
			if($account_type == 'register') {
				$coupon_status 	= 'coupon_register_status';
				$reward_status 	= 'reward_register_status';
				$voucher_status = 'voucher_register_status';
			}else if($account_type == 'guest') {
				$coupon_status 	= 'coupon_guest_status';
				$reward_status 	= 'reward_guest_status';
				$voucher_status = 'voucher_guest_status';
			}else{
				$coupon_status 	= 'coupon_login_status';
				$reward_status 	= 'reward_login_status';
				$voucher_status = 'voucher_login_status';
			}
			
			if(!empty($onepagecheckout_manage['shopping_cart'][$coupon_status])) {
				$data['coupon_module'] = $this->load->controller('onepagecheckout/coupon');	
			}else{
				$data['coupon_module'] = '';
			}
			
			if(!empty($onepagecheckout_manage['shopping_cart'][$reward_status])) {
				$data['reward_module'] = $this->load->controller('onepagecheckout/reward');
			}else{
				$data['reward_module'] = '';
			}
			
			if(!empty($onepagecheckout_manage['shopping_cart'][$voucher_status])) {
				$data['voucher_module'] = $this->load->controller('onepagecheckout/voucher');
			}else{
				$data['voucher_module'] = '';
			}
			
			$data['shipping'] = false;
			if ($this->cart->hasShipping()){
				$data['shipping'] = $this->cart->hasShipping();
			}
			//CART END
			
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');
			$data['login'] = $this->load->controller('onepagecheckout/login');
			$data['personal_details'] = $this->load->controller('onepagecheckout/personal_details');
			$data['payment_details'] = $this->load->controller('onepagecheckout/payment_details');
			$data['delivery_details'] = $this->load->controller('onepagecheckout/shipping_address');
			
			$this->response->setOutput($this->load->view('onepagecheckout/checkout', $data));
		}else{
			$data['heading_title'] = $heading_title;

			$data['text_error'] = $this->language->get('text_empty');

			$data['button_continue'] = $this->language->get('button_continue');

			$data['continue'] = $this->url->link('common/home');

			unset($this->session->data['success']);

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');
			
			$this->response->setOutput($this->load->view('error/not_found', $data));
		}
	}
	
	public function country(){
		$json = array();

		$this->load->model('localisation/country');

		$country_info = $this->model_localisation_country->getCountry($this->request->get['country_id']);

		if ($country_info){
			$this->load->model('localisation/zone');

			$json = array(
				'country_id'        => $country_info['country_id'],
				'name'              => $country_info['name'],
				'iso_code_2'        => $country_info['iso_code_2'],
				'iso_code_3'        => $country_info['iso_code_3'],
				'address_format'    => $country_info['address_format'],
				'postcode_required' => $country_info['postcode_required'],
				'zone'              => $this->model_localisation_zone->getZonesByCountryId($this->request->get['country_id']),
				'status'            => $country_info['status']
			);
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}