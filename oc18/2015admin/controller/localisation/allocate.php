<?php
class ControllerLocalisationAllocate extends Controller {
	public function index() {
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_express_add'] = $this->language->get('button_express_add');
		$data['button_remove'] = $this->language->get('button_remove');
		
		$this->load->model('localisation/express');
		$data['order_status'] = $this->model_localisation_express->getOrderStatus();
		$data['shipping_methods'] = $this->model_localisation_express->getShippingMethods();

		$data['action1'] = $this->url->link('localisation/allocate/form1', 'token=' . $this->session->data['token'], 'SSL');
		$data['action2'] = $this->url->link('localisation/allocate/form2', 'token=' . $this->session->data['token'], 'SSL');
		$data['cancel'] = $this->url->link('localisation/express', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['autoprint'])) {
			$allocate = $this->request->post['autoprint'];
		} elseif ($this->config->get('autoprint')) {
			$allocate = $this->config->get('autoprint');
		} else {
			$allocate = array();
		}
		
		$data['allocates'] = array();
		
		foreach ($allocate as $a) {
			$a = explode('|||',$a);
			$t = explode('[|]|[|]',$a[1]);
			
			$data['allocates'][] = array(
				'order_status_id'  => $a[0],
				'shipping_code'    => $t[0],
				'text'             => $t[1]
			);
		}

		if ($this->config->get('autowarehouse')) {
			$data['www'] = $this->config->get('autowarehouse');
		} else {
			$data['www'] = array();
		}

		$super = $this->config->get('super');
		
		$data['supers'] = array();
		
		foreach ($super as $su) {
			$name = $this->config->get('super'.$su.'_name');
			
			$data['supers'][] = array(
				'id'   => $su,
				'name' => $name?$name[$this->config->get('config_language_id')]:$this->language->get('heading_title')
			);
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('localisation/allocate.tpl', $data));
	}

	public function form1() {
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			$this->load->model('setting/setting');

			$this->model_setting_setting->editSetting('autoprint', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->response->redirect($this->url->link('localisation/allocate', 'token=' . $this->session->data['token'], 'SSL'));
		}
	}

	public function form2() {
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			$this->load->model('setting/setting');

			$this->model_setting_setting->editSetting('autowarehouse', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->response->redirect($this->url->link('localisation/allocate', 'token=' . $this->session->data['token'], 'SSL'));
		}
	}
}
?>