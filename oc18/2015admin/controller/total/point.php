<?php
class ControllerTotalPoint extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('total/point');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('point', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/total', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['entry_fer'] = $this->language->get('entry_fer');
		$data['entry_fee'] = $this->language->get('entry_fee');
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
			'href' => $this->url->link('total/point', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['action'] = $this->url->link('total/point', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/total', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['point_fee'])) {
			$data['point_fee'] = (int)$this->request->post['point_fee'];
		} elseif ($this->config->get('point_fee')) {
			$data['point_fee'] = (int)$this->config->get('point_fee');
		} else {
			$data['point_fee'] = '1';
		}

		if (isset($this->request->post['point_fer'])) {
			$data['point_fer'] = $this->request->post['point_fer'];
		} else {
			$data['point_fer'] = $this->config->get('point_fer');
		}

		if (isset($this->request->post['point_status'])) {
			$data['point_status'] = $this->request->post['point_status'];
		} else {
			$data['point_status'] = $this->config->get('point_status');
		}

		if (isset($this->request->post['point_sort_order'])) {
			$data['point_sort_order'] = $this->request->post['point_sort_order'];
		} else {
			$data['point_sort_order'] = $this->config->get('point_sort_order');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('total/point.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'total/point')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if ((int)$this->request->post['point_fee'] < 1) {
			$this->error['warning'] = $this->language->get('error_fee');
		}

		return !$this->error;
	}
}