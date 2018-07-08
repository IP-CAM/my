<?php
class ModelReportProduct extends Model {
	public function getProductsViewed($data = array()) {
		$sql = "SELECT pd.name, p.model, p.viewed FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.viewed > 0 ORDER BY p.viewed DESC";

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getTotalProductsViewed() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product WHERE viewed > 0");

		return $query->row['total'];
	}

	public function reset() {
		$this->db->query("UPDATE " . DB_PREFIX . "product SET viewed = '0'");
	}

	public function getUnsalable($data = array(), $total = false) {
		$start = $data['start']?$data['start']:0;
		$limit = $data['limit']?$data['limit']:0;
		
		unset($data['start']);
		unset($data['limit']);
		
		$order_products = $this->getPurchased($data);
		
		$products = array();
		
		foreach ($order_products as $product) {
			$products[] = $product['product_id'];
		}
		
		$sql = "SELECT product_id FROM " . DB_PREFIX . "product WHERE status = '1'";
		
		if ($products) {
			$sql .= " AND product_id NOT IN(" . implode(',', $products) . ")";
		}
		
		if (!$total) {
			$sql .= " ORDER BY product_id ASC LIMIT " . (int)$start . "," . (int)$limit;
		}
		
		$query = $this->db->query($sql);
		
		if (!$total) {
			$datas = array();
			
			$this->load->model('catalog/product');
			
			foreach ($query->rows as $product) {
				$product_info = $this->model_catalog_product->getProduct($product['product_id']);
				
				if ($product_info) {
					$product_info['total'] = $product_info['price'];
					$datas[] = $product_info;
				}
			}
			
			return $datas;
		} else {
			return $query->num_rows;
		}
	}

	public function getPurchased($data = array()) {
		$sql = "SELECT op.product_id, op.name, op.model, SUM(op.quantity) AS quantity, SUM((op.total + op.tax) * op.quantity) AS total, p.status FROM " . DB_PREFIX . "order_product op LEFT JOIN `" . DB_PREFIX . "order` o ON (op.order_id = o.order_id) LEFT JOIN `" . DB_PREFIX . "product` p ON(p.product_id = op.product_id)";

		if (!empty($data['filter_order_status_id'])) {
			$sql .= " WHERE p.status = '1' AND o.order_status_id = '" . (int)$data['filter_order_status_id'] . "'";
		} else {
			$sql .= " WHERE p.status = '1' AND o.order_status_id > '0'";
		}

		if (!empty($data['filter_date_start'])) {
			$sql .= " AND DATE(o.date_added) >= '" . $this->db->escape($data['filter_date_start']) . "'";
		}

		if (!empty($data['filter_date_end'])) {
			$sql .= " AND DATE(o.date_added) <= '" . $this->db->escape($data['filter_date_end']) . "'";
		}

		$sql .= " GROUP BY op.product_id";

		if (!empty($data['filter_qty'])) {
			$sql .= " HAVING quantity >= '" . (int)$data['filter_qty'] . "'";
		}

		$sql .= " ORDER BY total DESC";

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getTotalPurchased($data) {
		$sql = "SELECT op.product_id, SUM(op.quantity) AS quantity FROM " . DB_PREFIX . "order_product op LEFT JOIN `" . DB_PREFIX . "order` o ON (op.order_id = o.order_id) LEFT JOIN `" . DB_PREFIX . "product` p ON(p.product_id = op.product_id)";

		if (!empty($data['filter_order_status_id'])) {
			$sql .= " WHERE p.status = '1' AND o.order_status_id = '" . (int)$data['filter_order_status_id'] . "'";
		} else {
			$sql .= " WHERE p.status = '1' AND o.order_status_id > '0'";
		}

		if (!empty($data['filter_date_start'])) {
			$sql .= " AND DATE(o.date_added) >= '" . $this->db->escape($data['filter_date_start']) . "'";
		}

		if (!empty($data['filter_date_end'])) {
			$sql .= " AND DATE(o.date_added) <= '" . $this->db->escape($data['filter_date_end']) . "'";
		}

		$sql .= " GROUP BY op.product_id";

		if (!empty($data['filter_qty'])) {
			$sql .= " HAVING quantity >= '" . (int)$data['filter_qty'] . "'";
		}

		$query = $this->db->query($sql);

		return $query->num_rows;
	}
}