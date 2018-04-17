<?php
class ControllerOnepagecheckoutShippingAddress extends Controller {
	private $ssl = 'SSL';
	
	public function __construct($registry){
			parent::__construct( $registry );
			$this->ssl = (defined('VERSION') && version_compare(VERSION,'2.2.0.0','>=')) ? true : 'SSL';
	}
	public function index(){
		
		$this->load->language('onepagecheckout/checkout');

		$data['text_select'] = $this->language->get('text_select');
		
		$data['text_address_existing'] = $this->language->get('text_address_existing');
		$data['text_address_new'] = $this->language->get('text_address_new');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_loading'] = $this->language->get('text_loading');
		
		$this->load->model('setting/setting');
		$onepagecheckout_info = $this->model_setting_setting->getSetting('onepagecheckout', $this->config->get('config_store_id'));
		
		if(empty($onepagecheckout_info['onepagecheckout_status'])) {
			$this->response->redirect($this->url->link('checkout/checkout'));
		}
		
		if(!$this->config->get('onepagecheckout_field_layout')){
		  $data['class1'] = 'col-sm-6';
		}else{
		 $data['class1'] = '';
		}
		
		$onepagecheckout_manage = (!empty($onepagecheckout_info['onepagecheckout_manage'])) ? $onepagecheckout_info['onepagecheckout_manage'] : array();
		
		$heading_title = (!empty($onepagecheckout_manage['general']['heading_title'][$this->config->get('config_language_id')])) ? $onepagecheckout_manage['general']['heading_title'][$this->config->get('config_language_id')] : $this->language->get('heading_title');
		
		$data['feilds']=array();
		
		//register_status
		$fields	= (isset($onepagecheckout_manage['delivery']['fields']) ? $onepagecheckout_manage['delivery']['fields'] : array());
		foreach($fields as $key => $feild){
			$required = false;
			$status = false;
			switch($feild['show']){
				case 1:
				$status = true;
				break;
				case 2:
				$status = true;
				$required = true;
				break;
				case 3:
				$status = false;
				$required = false;
				break;
			}
			if($status){
				$data['feilds'][$key]=array(
					'sort_order'	=> $feild['sort_order'],
					'status'			=> $status,
					'required'		=> $required,
					'key'					=> $key,
					'label'				=> $onepagecheckout_manage['delivery_detail'][$key]['label'][$this->config->get('config_language_id')],
					'placeholder'	=> $onepagecheckout_manage['delivery_detail'][$key]['placeholder'][$this->config->get('config_language_id')]
				);
			}
		}
		
		$data['zoneplaceholder']	= ($onepagecheckout_manage['delivery_detail']['zone']['placeholder'][$this->config->get('config_language_id')] ? $onepagecheckout_manage['delivery_detail']['zone']['placeholder'][$this->config->get('config_language_id')] : $this->language->get('text_select'));
		
		function sortaddress($a, $b){
			return $a['sort_order'] < $b['sort_order'] ? -1 : 1;
		}
		
		$data['entry_heading'] = $onepagecheckout_manage['delivery_detail']['heading_title'][$this->config->get('config_language_id')];

		usort($data['feilds'], "sortaddress");

		$data['entry_firstname'] = $this->language->get('entry_firstname');
		$data['entry_lastname'] = $this->language->get('entry_lastname');
		$data['entry_company'] = $this->language->get('entry_company');
		$data['entry_address_1'] = $this->language->get('entry_address_1');
		$data['entry_address_2'] = $this->language->get('entry_address_2');
		$data['entry_postcode'] = $this->language->get('entry_postcode');
		$data['entry_city'] = $this->language->get('entry_city');
		$data['entry_country'] = $this->language->get('entry_country');
		$data['entry_zone'] = $this->language->get('entry_zone');

		$data['button_continue'] = $this->language->get('button_continue');
		$data['button_upload'] = $this->language->get('button_upload');

		if (isset($this->session->data['shipping_address']['address_id'])) {
			$data['address_id'] = $this->session->data['shipping_address']['address_id'];
		} else {
			$data['address_id'] = $this->customer->getAddressId();
		}

		$this->load->model('account/address');

		$data['addresses'] = $this->model_account_address->getAddresses();

		
		if (isset($this->session->data['shipping_address']['postcode'])) {
			$data['postcode'] = $this->session->data['shipping_address']['postcode'];
		} else {
			$data['postcode'] = '';
		}

		if (isset($this->session->data['shipping_address']['country_id'])) {
			$data['country_id'] = $this->session->data['shipping_address']['country_id'];
		} else {
			$data['country_id'] = $this->config->get('onepagecheckout_country_id');
		}

		if (isset($this->session->data['shipping_address']['zone_id'])) {
			$data['zone_id'] = $this->session->data['shipping_address']['zone_id'];
		} else {
			$data['zone_id'] = $this->config->get('onepagecheckout_zone_id');
		}

		$this->load->model('localisation/country');

		$data['countries'] = $this->model_localisation_country->getCountries();

		// Custom Fields
		$this->load->model('account/custom_field');

		$data['custom_fields'] = $this->model_account_custom_field->getCustomFields($this->config->get('onepagecheckout_customer_group_id'));
		if (isset($this->session->data['shipping_address']['custom_field'])) {
			$data['shipping_address_custom_field'] = $this->session->data['shipping_address']['custom_field'];
		} else {
			$data['shipping_address_custom_field'] = array();
		}
		
		$data['isLogged'] = false;
		if($this->customer->isLogged()){
			$data['isLogged'] = true;
		}
		
		return $this->load->view('onepagecheckout/delivery_details', $data);
	}
}