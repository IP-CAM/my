<?php 
class ControllerExtensionPaymentAlipay extends Controller {
	private $error = array(); 
	
	public function install(){
		/*
		$this->load->model('extension/extension');
		$this->model_extension_extension->install('payment', 'alipay_paybank');
		*/
		$this->load->model('extension/event');
		/*
		$this->model_extension_event->addEvent('alipay', 'catalog/model/checkout/order/after', 'extension/payment/alipay/capture');
		$this->model_extension_event->addEvent('alipay', 'catalog/model/checkout/order/addOrderHistory/after', 'extension/payment/alipay/capture');
		*/
		
		
	}
	
	public function uninstall(){
		/*
		$this->load->model('extension/extension');
		$this->model_extension_extension->uninstall('payment', 'alipay_paybank');
		*/

		$this->load->model('extension/event');
		/*
		$this->model_extension_event->deleteEvent('alipay_capture');
		*/
	}
	public function index() {
		$this->load->language('extension/payment/alipay');
		$this->load->model('setting/setting');
		$this->load->model('localisation/order_status');
		$this->load->model('localisation/geo_zone');
		$this->document->settitle($this->language->get('heading_title'));

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			$this->model_setting_setting->editSetting('alipay', $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'], true));
		}
		
		$data['breadcrumbs'] = array();
   		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
       		'href'      => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
   		);
   		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=payment', true)
   		);
   		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/payment/alipay', 'token=' . $this->session->data['token'] . '&type=payment', true)
   		);
	
		if (isset($this->error['secrity_code'])) {
			$data['error_secrity_code'] = $this->error['secrity_code'];
		} else {
			$data['error_secrity_code'] = '';
		}
		if (isset($this->error['email'])) {
			$data['error_email'] = $this->error['email'];
		} else {
			$data['error_email'] = '';
		}
		if (isset($this->error['partner'])) {
			$data['error_partner'] = $this->error['partner'];
		} else {
			$data['error_partner'] = '';
		}
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
 		if (isset($this->error['email'])) {
			$data['error_email'] = $this->error['email'];
		} else {
			$data['error_email'] = '';
		}
		
		$language_texts = array('heading_title','text_edit','text_enabled','text_disabled','entry_seller_email','entry_security_code','entry_partner','entry_trade_type','entry_anti_phishing','entry_order_status','entry_status','entry_sort_order','button_save','button_cancel','trade_create_by_buyer','create_direct_pay_by_user','create_partner_trade_by_buyer','text_description','entry_paybank_status');

		foreach($language_texts as $language_text){
			$data[$language_text] = $this->language->get($language_text);
		}

		$data['action'] = $this->url->link('extension/payment/alipay', 'token=' . $this->session->data['token'], true);
		$data['cancel'] =  $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=payment', true);
		
		if (isset($this->request->post['alipay_seller_email'])) {
			$data['alipay_seller_email'] = $this->request->post['alipay_seller_email'];
		} else {
			$data['alipay_seller_email'] = $this->config->get('alipay_seller_email');
		}
		if (isset($this->request->post['alipay_security_code'])) {
			$data['alipay_security_code'] = $this->request->post['alipay_security_code'];
		} else {
			$data['alipay_security_code'] = $this->config->get('alipay_security_code');
		}
		if (isset($this->request->post['alipay_partner'])) {
			$data['alipay_partner'] = $this->request->post['alipay_partner'];
		} else {
			$data['alipay_partner'] = $this->config->get('alipay_partner');
		}
		if (isset($this->request->post['alipay_trade_type'])) {
			$data['alipay_trade_type'] = $this->request->post['alipay_trade_type'];
		} else {
			$data['alipay_trade_type'] = $this->config->get('alipay_trade_type');
		}
		if (isset($this->request->post['alipay_anti_phishing'])) {
			$data['alipay_anti_phishing'] = $this->request->post['alipay_anti_phishing'];
		} else {
			$data['alipay_anti_phishing'] = $this->config->get('alipay_anti_phishing');
		}
		if (isset($this->request->post['alipay_order_status_id'])) {
			$data['alipay_order_status_id'] = $this->request->post['alipay_order_status_id'];
		} else {
			$data['alipay_order_status_id'] = $this->config->get('alipay_order_status_id'); 
		}
		if (isset($this->request->post['alipay_sort_order'])) {
			$data['alipay_sort_order'] = $this->request->post['alipay_sort_order'];
		} else {
			$data['alipay_sort_order'] = $this->config->get('alipay_sort_order');
		}
		if (isset($this->request->post['alipay_status'])) {
			$data['alipay_status'] = $this->request->post['alipay_status'];
		} else {
			$data['alipay_status'] = $this->config->get('alipay_status');
		}
		if (isset($this->request->post['alipay_paybank_status'])){
			$data['alipay_paybank_status'] = $this->request->post['alipay_paybank_status'];
		}else{
			$data['alipay_paybank_status'] = $this->config->get('alipay_paybank_status');
		}
		
		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view('extension/payment/alipay.tpl', $data));
	}


	private function validate() {
		if (!$this->user->hasPermission('modify', 'extension/payment/alipay')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->request->post['alipay_seller_email']) {
			$this->error['email'] = $this->language->get('error_email');
		}

		if (!$this->request->post['alipay_security_code']) {
			$this->error['secrity_code'] = $this->language->get('error_secrity_code');
		}

		if (!$this->request->post['alipay_partner']) {
			$this->error['partner'] = $this->language->get('error_partner');
		}

		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}	
	}
}
?>