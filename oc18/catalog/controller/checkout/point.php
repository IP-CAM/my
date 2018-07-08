<?php
class ControllerCheckoutPoint extends Controller {
	public function index() {
		$points = $this->customer->getRewardPoints();

		if ($points && $this->config->get('point_status')) {
			$this->load->language('checkout/point');

			$data['heading_title'] = sprintf($this->language->get('heading_title'), $points);

			$data['text_loading'] = $this->language->get('text_loading');

			$data['entry_point'] = $this->language->get('entry_point');

			$data['button_reward'] = $this->language->get('button_reward');

			if (isset($this->session->data['point'])) {
				$data['point'] = $this->session->data['point'];
			} else {
				$data['point'] = '';
			}

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/checkout/point.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/checkout/point.tpl', $data);
			} else {
				return $this->load->view('default/template/checkout/point.tpl', $data);
			}
		}
	}

	public function point() {
		$this->load->language('checkout/point');

		$json = array();
		
		$point_fer = $this->config->get('point_fer');
		$price = $this->cart->getSubTotal();
		$maxPoint = 0;
		
		if ($point_fer) {
			$point_fer = explode(',', $point_fer);
			
			$fer = array();
			
			foreach ($point_fer as $pf) {
				$fee = explode(':', $pf);
				
				if (isset($fee[1])) {
					$fer[$fee[0]] = $fee[1];
				}
			}
			
			ksort($fer);
	
			foreach ($fer as $k => $d) {
				if ($price <= $k) {
					
					$maxPoint = $d;
					
					break;
				}
			}
			
			if (!$maxPoint && $fer) {
				$maxPoint = end($fer);
			}
		}

		$points = $this->customer->getRewardPoints();

		if (empty($this->request->post['point'])) {
			$json['error'] = $this->language->get('error_empty');
		} elseif ($this->request->post['point'] > $points) {
			$json['error'] = sprintf($this->language->get('error_points'), $this->request->post['point']);
		} elseif ($maxPoint && $this->request->post['point'] > $maxPoint) {
			$json['error'] = sprintf($this->language->get('error_max'), $this->currency->format($price), $maxPoint);
		}

		if (!$json) {
			$this->session->data['point'] = abs($this->request->post['point']);

			$this->session->data['success'] = $this->language->get('text_success');

			if (isset($this->request->post['redirect'])) {
				$json['redirect'] = $this->url->link($this->request->post['redirect']);
			} else {
				$json['redirect'] = $this->url->link('checkout/cart');	
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
