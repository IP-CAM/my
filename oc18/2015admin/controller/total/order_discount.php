<?php
class ControllerTotalOrderDiscount extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('total/order_discount');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('order_discount', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/total', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_percent'] = $this->language->get('text_percent');
		$data['text_amount'] = $this->language->get('text_amount');

		$data['entry_fee'] = $this->language->get('entry_fee');
		$data['entry_type'] = $this->language->get('entry_type');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		
		$data['help_fee'] = $this->language->get('help_fee');

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
			'text' => $this->language->get('text_total'),
			'href' => $this->url->link('extension/total', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('total/order_discount', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['action'] = $this->url->link('total/order_discount', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/total', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['order_discount_type'])) {
			$data['order_discount_type'] = $this->request->post['order_discount_type'];
		} elseif ($this->config->get('order_discount_type')) {
			$data['order_discount_type'] = $this->config->get('order_discount_type');
		} else {
			$data['order_discount_type'] = '';
		}

		if (isset($this->request->post['order_discount_fee'])) {
			$data['order_discount_fee'] = $this->request->post['order_discount_fee'];
		} elseif ($this->config->get('order_discount_fee')) {
			$data['order_discount_fee'] = $this->config->get('order_discount_fee');
		} else {
			$data['order_discount_fee'] = '';
		}

		if (isset($this->request->post['order_discount_status'])) {
			$data['order_discount_status'] = $this->request->post['order_discount_status'];
		} else {
			$data['order_discount_status'] = $this->config->get('order_discount_status');
		}

		if (isset($this->request->post['order_discount_sort_order'])) {
			$data['order_discount_sort_order'] = $this->request->post['order_discount_sort_order'];
		} else {
			$data['order_discount_sort_order'] = $this->config->get('order_discount_sort_order');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('total/order_discount.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'total/order_discount')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if ((int)$this->request->post['order_discount_fee'] < 1) {
			$this->error['warning'] = $this->language->get('error_fee');
		}

		return !$this->error;
	}
}