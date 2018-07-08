<?php 
class ControllerSaleOrderAutocomplete extends Controller{
	public function auto() {
		$json = array();

		if (isset($this->request->get['filter_payment_country']) || isset($this->request->get['filter_shipping_country']) || isset($this->request->get['filter_payment_method']) || isset($this->request->get['filter_shipping_method']) || isset($this->request->get['filter_ip']) || isset($this->request->get['filter_currency_code'])) {
			$request_from = '';
			
			if (isset($this->request->get['filter_payment_country'])) {
				$filter_payment_country = $this->request->get['filter_payment_country'];
				$request_from = 'payment_country';
			} else {
				$filter_payment_country = '';
			}
			
			if (isset($this->request->get['filter_shipping_country'])) {
				$filter_shipping_country = $this->request->get['filter_shipping_country'];
				$request_from = 'shipping_country';
			} else {
				$filter_shipping_country = '';
			}
			
			if (isset($this->request->get['filter_payment_method'])) {
				$filter_payment_method = $this->request->get['filter_payment_method'];
				$request_from = 'payment_method';
			} else {
				$filter_payment_method = '';
			}
			if (isset($this->request->get['filter_shipping_method'])) {
				$filter_shipping_method = $this->request->get['filter_shipping_method'];
				$request_from = 'shipping_method';
			} else {
				$filter_shipping_method = '';
			}
			if (isset($this->request->get['filter_ip'])) {
				$filter_ip = $this->request->get['filter_ip'];
				$request_from = 'ip';
			} else {
				$filter_ip = '';
			}
			if (isset($this->request->get['filter_currency_code'])) {
				$filter_currency_code = $this->request->get['filter_currency_code'];
				$request_from = 'currency_code';
			} else {
				$filter_currency_code = '';
			}
			
			$filter_data = array(
				'request_from' => $request_from,
				'payment_country' => $filter_payment_country,
				'shipping_country' => $filter_shipping_country,
				'payment_method' => $filter_payment_method,
				'shipping_method' => $filter_shipping_method,
				'ip' => $filter_ip,
				'currency_code' => $filter_currency_code
			);
			
			$this->load->model('sale/order');
			$results = $this->model_sale_order->getOrdersByAutocomplete($filter_data);

		foreach ($results as $result) {
			$json[] = array(
				'order_id' 	=> $result['order_id'],
				'payment_country_id'        => $result['payment_country_id'],
				'payment_country'              => $result['payment_country'],
				'shipping_country_id' => $result['shipping_country_id'],
				'shipping_country' => $result['shipping_country'],
				'payment_code' => $result['payment_code'],
				'payment_method' => $result['payment_method'],
				'shipping_code' => $result['shipping_code'],
				'shipping_method' => $result['shipping_method'],
				'ip' => $result['ip'],
				'currency_code' => $result['currency_code']
			);
		}
		
		}
		
		$sort_order = array();
		foreach ($json as $key=> $value){
			$sort_order[$key] = $value['order_id'];
		}
		array_multisort($sort_order, SORT_DESC, $json);

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}

?>