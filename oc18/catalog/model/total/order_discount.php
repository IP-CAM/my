<?php
class ModelTotalOrderDiscount extends Model {
	public function getTotal(&$total_data, &$total, &$taxes) {
		$this->load->language('total/order_discount');

		$order_discounts = $this->config->get('order_discount_fee');
		$order_discounts = explode(',', $order_discounts);
		
		$ds = array();
		
		foreach ($order_discounts as $od) {
			$fee = explode(':', $od);
			
			if (isset($fee[1])) {
				$ds[$fee[0]] = $fee[1];
			}
		}
		
		ksort($ds);
		$discount = 0;
		$j = 0;
		$price = $this->cart->getSubTotal();
		
		foreach ($ds as $k => $d) {
			if ($price >= $k) {
				if ($this->config->get('order_discount_type') == 'P') {
					$discount = $price - ($price * $d);
				}
				
				if ($this->config->get('order_discount_type') == 'F') {
					$discount = $d;
				}
				
				$j = $k;
				break;
			}
		}
		
		if ($discount) {
			$total_data[] = array(
				'code'       => 'order_discount',
				'title'      => sprintf($this->language->get('text_order_discount'), $j),
				'value'      => -$discount,
				'sort_order' => $this->config->get('order_discount_sort_order')
			);
			
			$total -= $discount;
		}
	}
}