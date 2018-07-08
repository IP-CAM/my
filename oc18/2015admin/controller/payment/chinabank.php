<?php
class ControllerPaymentChinaBank extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('payment/chinabank');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('chinabank', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_all_zones'] = $this->language->get('text_all_zones');

		$data['entry_description'] = $this->language->get('entry_description');
		$data['entry_id'] = $this->language->get('entry_id');
		$data['entry_key'] = $this->language->get('entry_key');
		$data['entry_order_status'] = $this->language->get('entry_order_status');
		$data['entry_order_failure'] = $this->language->get('entry_order_failure');
		$data['entry_total'] = $this->language->get('entry_total');
		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$data['help_total'] = $this->language->get('help_total');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_payment'),
			'href' => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('payment/chinabank', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['action'] = $this->url->link('payment/chinabank', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['chinabank_description'])) {
			$data['chinabank_description'] = $this->request->post['chinabank_description'];
		} else {
			$data['chinabank_description'] = $this->config->get('chinabank_description');
		}

		if (isset($this->request->post['chinabank_id'])) {
			$data['chinabank_id'] = $this->request->post['chinabank_id'];
		} else {
			$data['chinabank_id'] = $this->config->get('chinabank_id');
		}

		if (isset($this->request->post['chinabank_key'])) {
			$data['chinabank_key'] = $this->request->post['chinabank_key'];
		} else {
			$data['chinabank_key'] = $this->config->get('chinabank_key');
		}

		if (isset($this->request->post['chinabank_total'])) {
			$data['chinabank_total'] = $this->request->post['chinabank_total'];
		} else {
			$data['chinabank_total'] = $this->config->get('chinabank_total');
		}

		if (isset($this->request->post['chinabank_total'])) {
			$data['chinabank_total'] = $this->request->post['chinabank_total'];
		} else {
			$data['chinabank_total'] = $this->config->get('chinabank_total');
		}

		if (isset($this->request->post['chinabank_order_status_id'])) {
			$data['chinabank_order_status_id'] = $this->request->post['chinabank_order_status_id'];
		} else {
			$data['chinabank_order_status_id'] = $this->config->get('chinabank_order_status_id');
		}

		if (isset($this->request->post['chinabank_order_failure_id'])) {
			$data['chinabank_order_failure_id'] = $this->request->post['chinabank_order_failure_id'];
		} else {
			$data['chinabank_order_failure_id'] = $this->config->get('chinabank_order_failure_id');
		}

		$this->load->model('localisation/order_status');

		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		if (isset($this->request->post['chinabank_geo_zone_id'])) {
			$data['chinabank_geo_zone_id'] = $this->request->post['chinabank_geo_zone_id'];
		} else {
			$data['chinabank_geo_zone_id'] = $this->config->get('chinabank_geo_zone_id');
		}

		$this->load->model('localisation/geo_zone');

		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		if (isset($this->request->post['chinabank_status'])) {
			$data['chinabank_status'] = $this->request->post['chinabank_status'];
		} else {
			$data['chinabank_status'] = $this->config->get('chinabank_status');
		}

		if (isset($this->request->post['chinabank_sort_order'])) {
			$data['chinabank_sort_order'] = $this->request->post['chinabank_sort_order'];
		} else {
			$data['chinabank_sort_order'] = $this->config->get('chinabank_sort_order');
		}
 
		// Language
		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('payment/chinabank.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'payment/chinabank')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}