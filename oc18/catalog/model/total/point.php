<?php
class ModelTotalPoint extends Model {
	public function getTotal(&$total_data, &$total, &$taxes) {
		if (isset($this->session->data['point'])) {				
			$this->load->language('total/point');

			$points = $this->customer->getRewardPoints();

			if ($points >= $this->session->data['point']) {				
				$discount = $this->session->data['point'] * (1 / (int)$this->config->get('point_fee'));

				$total_data[] = array(
					'code'       => 'point',
					'title'      => sprintf($this->language->get('text_point'), $this->session->data['point']),
					'value'      => -$discount,
					'sort_order' => $this->config->get('point_sort_order')
				);

				$total -= $discount;
			}
		}
	}

	public function confirm($order_info, $order_total) {
		$this->load->language('total/point');

		$points = 0;

		$start = strpos($order_total['title'], '(') + 1;
		$end = strrpos($order_total['title'], ')');

		if ($start && $end) {
			$points = substr($order_total['title'], $start, $end - $start);
		}

		if ($points) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "customer_reward SET customer_id = '" . (int)$order_info['customer_id'] . "', order_id = '" . (int)$order_info['order_id'] . "', description = '" . $this->db->escape(sprintf($this->language->get('text_order_id'), (int)$order_info['order_id'])) . "', points = '" . (float)-$points . "', date_added = NOW()");
		}
	}

	public function unconfirm($order_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "customer_reward WHERE order_id = '" . (int)$order_id . "' AND points < 0");
	}
}