<?php
class ModelTotalSubTotal extends Model {
	public function getTotal(&$total_data, &$total, &$taxes) {
		$this->load->language('total/sub_total');
		$this->load->language('total/order_discount');

		$sub_total = $this->cart->getSubTotal();

		if (isset($this->session->data['vouchers']) && $this->session->data['vouchers']) {
			foreach ($this->session->data['vouchers'] as $voucher) {
				$sub_total += $voucher['amount'];
			}
		}
		
		if ($this->gift->getSubTotal()) {			
			$sub_total += $this->gift->getSubTotal();
		}

		$total_data[] = array(
			'code'       => 'sub_total',
			'title'      => $this->language->get('text_sub_total'),
			'value'      => $sub_total,
			'sort_order' => $this->config->get('sub_total_sort_order')
		);
		
		if (!empty($this->session->data['gift_discount'])) {
			foreach ($this->session->data['gift_discount'] as $k => $v) {
				if ($v['type'] == 'P') {
					$s = $sub_total;
					$sub_total *= $v['amount'];
	
					$total_data[] = array(
						'code'       => $v['id'],
						'title'      => sprintf($this->language->get('text_order_discount'), $v['total']),
						'value'      => -($s - $sub_total),
						'sort_order' => (int)$this->config->get('sub_total_sort_order') + 0.2
					);
				}
				
				if ($v['type'] == 'F') {
					$s = $sub_total;
					$sub_total -= $v['amount'];
	
					$total_data[] = array(
						'code'       => $v['id'],
						'title'      => sprintf($this->language->get('text_order_discount'), $v['total']),
						'value'      => -($s - $sub_total),
						'sort_order' => (int)$this->config->get('sub_total_sort_order') + 0.2
					);
				}
			}
		}

		$total += $sub_total;
	}
}