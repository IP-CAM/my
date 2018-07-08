<?php
class ControllerPaymentChinaBank extends Controller {
	public function index() {
	}
	
	public function form() {
		if (isset($this->session->data['order_id'])) {
			$this->load->language('payment/chinabank');
			
			$data['text_wait'] = $this->language->get('text_wait');
			
			$data['mid'] = $this->config->get('chinabank_id');
			$data['key'] = $this->config->get('chinabank_key');
			$data['oid'] = date('Ymd',(int)time())."-".$this->config->get('chinabank_id')."-".date('His',(int)time());
	
			if ($this->request->server['HTTPS']) {
				$server = $this->config->get('config_ssl');
			} else {
				$server = $this->config->get('config_url');
			}
			
			$data['notify_url'] = '[url:='.$server.'catalog/controller/payment/alipay_direct_callback.php]';
			$data['return_url'] = $this->url->link('checkout/success');
			$data['amount'] = $this->session->data['total'];
			$data['order_id'] = $this->session->data['order_id'];
			$data['moneytype'] = "CNY";
			$data['md5info'] = strtoupper(md5($data['amount'].$data['moneytype'].$data['order_id'].$data['mid'].$data['return_url'].$data['key']));
	
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/chinabank.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/payment/chinabank.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/payment/chinabank.tpl', $data));
			}
		}
	}

	public function redirect() {
		return $this->url->link('payment/chinabank/form');
	}

	public function callback() {
		$key = $this->config->get('chinabank_key');
		
		$array = array(
			'v_oid' => isset($this->request->post['v_oid'])?$this->request->post['v_oid']:'',
			'v_pstatus' => isset($this->request->post['v_pstatus'])?$this->request->post['v_pstatus']:'',
			'v_pstring' => isset($this->request->post['v_pstring'])?$this->request->post['v_pstring']:'',
			'v_amount' => isset($this->request->post['v_amount'])?$this->request->post['v_amount']:'',
			'v_moneytype' => isset($this->request->post['v_moneytype'])?$this->request->post['v_moneytype']:'',
			'remark1' => isset($this->request->post['remark1'])?$this->request->post['remark1']:'',
			'remark2' => isset($this->request->post['remark2'])?$this->request->post['remark2']:'',
			'v_md5str' => isset($this->request->post['v_md5str'])?$this->request->post['v_md5str']:''
		);
		
		$order_id = $array['remark1'];
		
		$md5string = strtoupper(md5($array['v_oid'].$array['v_pstatus'].$array['v_amount'].$array['v_moneytype'].$key));
		
		if (!empty($array['v_md5str']) && $md5string == $array['v_md5str']) {
			// 支付成功
			if (!empty($array['v_pstatus']) && $array['v_pstatus'] == '20' && $order_id) {
				$this->model_checkout_order->addOrderHistory($order_id, $this->config->get('chinabank_order_status_id'), '', 1);
			}
			
			// 支付失败
			if (!empty($array['v_pstatus']) && $array['v_pstatus'] == '30') {
				$this->model_checkout_order->addOrderHistory($order_id, $this->config->get('chinabank_order_failure_id'));
			}
				
			$this->response->setOutput('ok');
		} else {
			$this->log->write('Chinabank payment callback error:'.print_r($array, 1));
			$this->response->setOutput('error');
		}
	}

	public function confirm() {
		if ($this->session->data['payment_method']['code'] == 'chinabank') {
			$this->load->model('checkout/order');

			$this->model_checkout_order->addOrderHistory($this->session->data['order_id'], $this->config->get('chinabank_order_status_id'));
		}
	}
}