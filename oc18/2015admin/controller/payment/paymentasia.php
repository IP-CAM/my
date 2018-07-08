<?php

class ControllerPaymentPaymentasia extends Controller {

	private $error = array();

	public function index() {
		$this->language->load('payment/paymentasia');

		$this->document->setTitle($this->language->get('heading_title'));


		// Language
		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();


		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			$this->model_setting_setting->editSetting('paymentasia', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

//            $this->redirect(HTTPS_SERVER . 'index.php?route=extension/payment&token=' . $this->session->data['token']);
			$this->response->redirect($this->url->link('payment/paymentasia', 'token=' . $this->session->data['token'], 'SSL'));
		}
//        var_dump($this->language);exit;
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_enabled']	 = $this->language->get('text_enabled');
		$data['text_disabled']	 = $this->language->get('text_disabled');
		$data['text_all_zones']	 = $this->language->get('text_all_zones');

		$data['entry_payserverurl']	 = $this->language->get('entry_payserverurl');
		$data['entry_merchant']		 = $this->language->get('entry_merchant');
		$data['entry_security']		 = $this->language->get('entry_security');
		$data['entry_callback']		 = $this->language->get('entry_callback');
		$data['entry_order_status']	 = $this->language->get('entry_order_status');
		$data['entry_geo_zone']		 = $this->language->get('entry_geo_zone');
		$data['entry_status']		 = $this->language->get('entry_status');
		$data['entry_sort_order']	 = $this->language->get('entry_sort_order');
		$data['entry_display_name']	 = $this->language->get('entry_display_name');
		$data['entry_description']	 = $this->language->get('entry_description');
		$data['button_save']		 = $this->language->get('button_save');
		$data['button_cancel']		 = $this->language->get('button_cancel');
		$data['tab_merchant']		 = $this->language->get('tab_merchant');
		$data['tab_display_name']	 = $this->language->get('tab_display_name');
		$data['tab_description']	 = $this->language->get('tab_description');

		$data['tab_general'] = $this->language->get('tab_general');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['payserverurl'])) {
			$data['error_payserverurl'] = $this->error['payserverurl'];
		} else {
			$data['error_payserverurl'] = '';
		}

		if (isset($this->error['merchant'])) {
			$data['error_merchant'] = $this->error['merchant'];
		} else {
			$data['error_merchant'] = '';
		}

		if (isset($this->error['security'])) {
			$data['error_security'] = $this->error['security'];
		} else {
			$data['error_security'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'		 => $this->language->get('text_home'),
			'href'		 => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL'),
			'separator'	 => false
		);

		$data['breadcrumbs'][] = array(
			'text'		 => $this->language->get('text_payment'),
			'href'		 => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
			'separator'	 => ' :: '
		);

		$data['breadcrumbs'][] = array(
			'text'		 => $this->language->get('heading_title'),
			'href'		 => $this->url->link('payment/paymentasia', 'token=' . $this->session->data['token'], 'SSL'),
			'separator'	 => ' :: '
		);

		$data['action']	 = $this->url->link('payment/paymentasia', 'token=' . $this->session->data['token'], 'SSL');
		$data['cancel']	 = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');
		$data['search']	 = $this->url->link('payment/paymentasia', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['paymentasia_mode'])) {
			$data['paymentasia_mode'] = $this->request->post['paymentasia_mode'];
		} else {
			$data['paymentasia_mode'] = $this->config->get('paymentasia_mode');
		}

		if (isset($this->request->post['paymentasia_merchant'])) {
			$data['paymentasia_merchant'] = $this->request->post['paymentasia_merchant'];
		} else {
			$data['paymentasia_merchant'] = $this->config->get('paymentasia_merchant');
		}

		if (isset($this->request->post['paymentasia_security'])) {
			$data['paymentasia_security'] = $this->request->post['paymentasia_security'];
		} else {
			$data['paymentasia_security'] = $this->config->get('paymentasia_security');
		}

		$data['callback'] = HTTP_CATALOG . 'index.php?route=payment/paymentasia/callback';

		if (isset($this->request->post['paymentasia_order_status_id'])) {
			$data['paymentasia_order_status_id'] = $this->request->post['paymentasia_order_status_id'];
		} else {
			$data['paymentasia_order_status_id'] = $this->config->get('paymentasia_order_status_id');
		}

		$this->load->model('localisation/order_status');

		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		if (isset($this->request->post['paymentasia_status'])) {
			$data['paymentasia_status'] = $this->request->post['paymentasia_status'];
		} else {
			$data['paymentasia_status'] = $this->config->get('paymentasia_status');
		}

		if (isset($this->request->post['paymentasia_sort_order'])) {
			$data['paymentasia_sort_order'] = $this->request->post['paymentasia_sort_order'];
		} else {
			$data['paymentasia_sort_order'] = $this->config->get('paymentasia_sort_order');
		}

		$this->template = 'payment/paymentasia.tpl';

		$data['header']		 = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer']		 = $this->load->controller('common/footer');

		if (isset($this->request->post['paymentasia_paymethod'])) {
			$data['paymentasia_paymethod'] = $this->request->post['paymentasia_paymethod'];
		} else {
			$data['paymentasia_paymethod'] = $this->config->get('paymentasia_paymethod');
		}

		if (isset($this->request->post['paymentasia_display_name'])) {
			$data['paymentasia_display_name'] = $this->request->post['paymentasia_display_name'];
		} else {
			$data['paymentasia_display_name'] = $this->config->get('paymentasia_display_name');
		}


		if (isset($this->request->post['paymentasia_description'])) {
			$data['paymentasia_description'] = $this->request->post['paymentasia_description'];
		} else {
			$data['paymentasia_description'] = $this->config->get('paymentasia_description');
		}




		$data['paymentasia_modes']		 = array(
			'Test',
			'Live',
//            'API'
		);
		$data['paymentasia_paymethods']	 = array(
			'Payment Page',
//            'API'
		);

//        if (isset($this->request->post['paymentasia_currency'])) {
//            $data['paymentasia_currency'] = $this->request->post['paymentasia_currency'];
//        } else {
//            $data['paymentasia_currency'] = $this->config->get('paymentasia_currency');
//        }
//
//        $data['paymentasia_currencys'] = array(
//            'HKD',
//            'USD',
//            'SGD',
//            'CNY (RMB)',
//            'JPY',
//            'TWD',
//            'AUD',
//            'EUR',
//            'GBP',
//            'CAD',
//            'MOP',
//            'PHP',
//            'THB',
//            'MYR',
//            'IDR',
//            'KRW',
//            'SAR',
//            'NZD',
//            'AED',
//            'BND',
//        );
//        $this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));

		$this->response->setOutput($this->load->view('payment/paymentasia.tpl', $data));
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'payment/paymentasia')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->request->post['paymentasia_mode']) {
			$this->error['mode'] = $this->language->get('error_mode');
		}

		if (!$this->request->post['paymentasia_merchant']) {
			$this->error['merchant'] = $this->language->get('error_merchant');
		}

		if (!$this->request->post['paymentasia_security']) {
			$this->error['security'] = $this->language->get('error_security');
		}

		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

}

?>