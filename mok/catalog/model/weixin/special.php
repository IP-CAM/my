<?php
class ModelWeixinSpecial extends Model {
	public function getTotalSpecials() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "special");

		return $query->row['total'];
	}
	
	public function getSpecial($special_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "special s LEFT JOIN " .DB_PREFIX . "special_description sd ON (s.special_id = sd.special_id) WHERE s.special_id = '" . (int)$special_id . "' AND sd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}
	
	public function getSpecialProducts($special_id) {
		$special_product_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "special_product WHERE special_id = '" . (int)$special_id . "'");

		foreach ($query->rows as $result) {
			$special_product_data[] = $result['product_id'];
		}

		return $special_product_data;
	}
	
	public function getSpecialCategories($special_id) {
		$special_category_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "special_category WHERE special_id = '" . (int)$special_id . "'");

		foreach ($query->rows as $result) {
			$special_category_data[] = $result['category_id'];
		}

		return $special_category_data;
	}
	
	public function getSpecialByCode($code) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "special WHERE code = '" . $this->db->escape($code) . "'");

		return $query->row;
	}
	
	public function getSpecialHistories($special_id, $start = 0, $limit = 10) {
		if ($start < 0) {
			$start = 0;
		}

		if ($limit < 1) {
			$limit = 10;
		}

		$query = $this->db->query("SELECT sh.order_id, CONCAT(c.firstname, ' ', c.lastname) AS customer, sh.amount, sh.date_added FROM " . DB_PREFIX . "special_history sh LEFT JOIN " . DB_PREFIX . "customer c ON (sh.customer_id = c.customer_id) WHERE sh.special_id = '" . (int)$special_id . "' ORDER BY sh.date_added ASC LIMIT " . (int)$start . "," . (int)$limit);

		return $query->rows;
	}
	
	public function getTotalSpecialHistories($special_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "special_history WHERE special_id = '" . (int)$special_id . "'");

		return $query->row['total'];
	}
	
	public function getSpecialDescriptions($special_id) {
		$special_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "special_description WHERE special_id = '" . (int)$special_id . "'");

		foreach ($query->rows as $result) {
			$special_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
				'description'      => $result['description'],
				'meta_title'       => $result['meta_title'],
				'meta_description' => $result['meta_description'],
				'meta_keyword'     => $result['meta_keyword'],
				'tag'              => $result['tag']
			);
		}

		return $special_description_data;
	}
	
	public function getProductIdByCategoryId($category_id) {
		$special_product_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_category WHERE category_id = '" . (int)$category_id . "'");

		foreach ($query->rows as $result) {
			$special_product_data[] = $result['product_id'];
		}

		return $special_product_data;
	}

}