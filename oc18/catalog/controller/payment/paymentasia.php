<?php

class ControllerPaymentpaymentasia extends Controller {

	CONST PAYMENT_PENDING	 = 0;
	CONST PAYMENT_SUCCESS	 = 1;
	CONST PAYMENT_FAIL	 = 2;

	public function index() {
		$this->language->load('payment/paymentasia');

//		$this->load->model('checkout/order');		
//		$data['available'] = TRUE;
//		$currency					 = isset($order_info['currency_code']) ? self::convertCurrency($order_info['currency_code']) : FALSE;
//		if (!$currency) {
//			$data['available'] = FALSE;
//		}

		$data['button_continue']		 = $this->language->get('button_continue');
		$data['button_continue_action']	 = $this->url->link('payment/paymentasia/checkout', '', 'SSL');
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/paymentasia.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/payment/paymentasia.tpl', $data);
		} else {
			return $this->load->view('default/template/payment/paymentasia.tpl', $data);
		}
	}

	public function redirect() {
		return $this->url->link('payment/paymentasia/checkout');
	}

	public function checkout() {

		require_once ('PaymentasiaSecure.php');
//        $this->load->library('encryption');
		$this->language->load('payment/paymentasia');
		$this->load->model('checkout/order');
//        $this->load->model('setting/setting');

		$display_name = $this->language->get('paymentasia_display_name') ?: $this->language->get('heading_title');
		$this->document->setTitle($display_name);

		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);


		$merchantId	 = $this->config->get('paymentasia_merchant');
		$merchantKey = $this->config->get('paymentasia_security');


		$orderRef	 = sprintf("%010d", $this->session->data['order_id']);
		$amount		 = $this->currency->format($order_info ['total'], $order_info ['currency_code'], '', FALSE);
		
//		$currency					 = isset($order_info['currency_code']) ? self::convertCurrency($order_info['currency_code']) : '';
		$data['merchant_reference']	 = (string) $orderRef;
		$data['amount']				 = (string) $amount;
		$data['currency']			 = isset($order_info['currency_code']) ? $order_info['currency_code'] : '';
		$data['customer_name']		 = (string) isset($order_info['firstname']) ? $order_info['firstname'] : '';
		$data['customer_address']	 = (string) isset($order_info['payment_address_1']) ? $order_info['payment_address_1'] : '';
		$data['customer_email']		 = (string) isset($order_info['email']) ? $order_info['email'] : '';
		$data['customer_phone']		 = (string) isset($order_info['telephone']) ? $order_info['telephone'] : '';
		$data['customer_ip']		 = (string) isset($order_info['ip']) ? $order_info['ip'] : '';
		$data['return_url']			 = $this->url->link('payment/paymentasia/payment_return', '', 'SSL');

//		$data['item'][0]['name']		 = (string) $this->session->data['order_id'];
//		$data['item'][0]['quantity']	 = (string) 1;
//		$data['item'][0]['unitPrice']	 = (string) $amount;

		$mode = $this->config->get('paymentasia_mode');
		if ($mode == 'Live') {
			$request_url = 'https://payment.pa-sys.com';
		} else {
			$request_url = 'http://payment-sandbox.pa-sys.com';
		}

		$this->id		 = 'payment';
		$key			 = $this->config->get('paymentasia_security');
		$data['sign']	 = paymentasiaSecure::generatePaymentSecureHash($data, $merchantKey);

		$request_url .= '/app/page/' . $merchantId;
		echo self::buildHiddenHTMLForm($request_url, $data);
		return;
	}

	public function payment_return() {
		require_once ('PaymentasiaSecure.php');

		$sign = paymentasiaSecure::verifyPaymentDatafeed($_POST, $this->config->get('paymentasia_security'));



		//verify & update order
		if ($sign === filter_input(INPUT_POST, 'sign')) {
			$this->_updateOrder('payment return');
		}

		// redirect to opencart static return page
		$this->response->redirect($this->url->link('checkout/success', '', 'SSL'));
		return FALSE;
	}

	public function callback() {
		require_once ('PaymentasiaSecure.php');
		// return true ;  output blank page
		// return false ; output not found page
		// always return true;
		// 

		/**
		 * verify information
		 */
		$sign = paymentasiaSecure::verifyPaymentDatafeed($_POST, $this->config->get('paymentasia_security'));
		if ($sign !== filter_input(INPUT_POST, 'sign')) {
			return TRUE;
		}

		/**
		 * update order
		 */
		if ($this->_updateOrder('datafeed notify') === FALSE) {
			return TRUE;
		}

		//echo response
		echo json_encode(array(
			'response'	 => (string) '200',
			'sign'		 => $sign,
		));
		return TRUE;
	}

	/**
	 * verify order information
	 * and update order when verify successfull
	 * @param string $action
	 * @return boolean
	 */
	private function _updateOrder($action = '') {
		// Note: Datafeed URL?
		// E.g. http://localhost/opencart_1_5_1/index.php?route=payment/paymentasia/callback
		// get post data start

		$order_id	 = filter_input(INPUT_POST, 'merchant_reference');
		$status		 = filter_input(INPUT_POST, 'status');
		$sign		 = filter_input(INPUT_POST, 'sign');
		$amount		 = filter_input(INPUT_POST, 'amount');


		$this->load->model('checkout/order');
		$order_info = $this->model_checkout_order->getOrder($order_id);

		$convertedAmount = $this->currency->format($order_info ['total'], $order_info ['currency_code'], '', FALSE);

		if (!$order_info) {
			return FALSE; // order not found
		}
		if (intval($status) !== self::PAYMENT_SUCCESS) {
			return FALSE; // payment not success 
		}

		if (!isset($order_info['total']) || sprintf('%.2f', $amount) !== sprintf('%.2f', $convertedAmount)) {
			return FALSE; // verify amount fail
		}

		$initialOrderStatusDefined	 = trim($this->config->get('paymentasia_order_status_id'));
//            $this->model_checkout_order->confirm($order_id, $initialOrderStatusDefined, "Order has been placed");
		$comment					 = "Transaction accepted on Paymentasia. Payment Transaction ID: " . $order_id;
		$comment					 .= " [ update by $action ]";

//            $this->model_checkout_order->update($order_id, $Processing, $comment, TRUE);
		$this->model_checkout_order->addOrderHistory($order_id, $initialOrderStatusDefined, $comment, false);
		return TRUE;
	}

	/**
	 * opencart currency to paymentasia currency
	 * @param string $code
	 * @return string
	 */
	private static function convertCurrency($code) {
		$map = array(
			'CNY'	 => 'CNY',
			'HKD'	 => 'HKD',
			'MOP'	 => 'MOP',
			'JPY'	 => 'JPY',
			'USD'	 => 'USD',
		);
		return isset($map[$code]) ? $map[$code] : FALSE;
	}

	/**
	 * Front-end redirection
	 * Return HTML hidden form and onload submit
	 *
	 * @param $request_url
	 * @param $params
	 * @param string $method
	 * @return string
	 */
	private static function buildHiddenHTMLForm($request_url, $params) {
		$html = array();

		$unexpected_val = array('submit');

		$html[] = '<form style="display:hidden" method="post" name="paymentform" id="paymentform" action="' . $request_url . '" accept-charset="utf-8">';

		foreach ($params as $key => $value) {
			if (in_array(strtolower($key), $unexpected_val)) {
				$key = "_" . $key;
			}
			$html[] = '<input type="hidden" name="' . $key . '" value="' . $value . '"/>' . "\n\r";
		}

		$html[]	 = '</form>';
		$html[]	 = '<script type="text/javascript">
    document.forms["paymentform"].submit();
</script>';


		return implode('', $html);
	}

}
