<?php
class ModelMarketingSpecial extends Model {
	public function getTotalSpecials() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "special");

		return $query->row['total'];
	}
	
	public function getSpecials($data = array()) {
		$sql = "SELECT s.special_id, sd.name, s.code, s.date_start, s.date_end, s.status FROM " . DB_PREFIX . "special s LEFT JOIN " . DB_PREFIX . "special_description sd ON (s.special_id = sd.special_id)";
		
		$sql .= " WHERE sd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		$sort_data = array(
			'sd.name',
			's.code',
			's.date_start',
			's.date_end',
			's.status'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY s.date_added";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

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
	
	public function deleteSpecial($special_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "special WHERE special_id = '" . (int)$special_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "special_product WHERE special_id = '" . (int)$special_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "special_category WHERE special_id = '" . (int)$special_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "special_history WHERE special_id = '" . (int)$special_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "special_description WHERE special_id = '" . (int)$special_id . "'");
	}
	
	public function editSpecial($special_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "special SET code = '" . $this->db->escape($data['code']) . "', discount = '" . (float)$data['discount'] . "', type = '" . $this->db->escape($data['type']) . "', total = '" . (float)$data['total'] . "', logged = '" . (int)$data['logged'] . "', shipping = '" . (int)$data['shipping'] . "', date_start = '" . $this->db->escape($data['date_start']) . "', date_end = '" . $this->db->escape($data['date_end']) . "', uses_total = '" . (int)$data['uses_total'] . "', uses_customer = '" . (int)$data['uses_customer'] . "', status = '" . (int)$data['status'] . "' WHERE special_id = '" . (int)$special_id . "'");
		
		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "special SET image = '" . $this->db->escape($data['image']) . "' WHERE special_id = '" . (int)$special_id . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "special_description WHERE special_id = '" . (int)$special_id . "'");

		foreach ($data['special_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "special_description SET special_id = '" . (int)$special_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', tag = '" . $this->db->escape($value['tag']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "special_product WHERE special_id = '" . (int)$special_id . "'");

		if (isset($data['special_product'])) {
			foreach ($data['special_product'] as $product_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "special_product SET special_id = '" . (int)$special_id . "', product_id = '" . (int)$product_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "special_category WHERE special_id = '" . (int)$special_id . "'");

		if (isset($data['special_category'])) {
			foreach ($data['special_category'] as $category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "special_category SET special_id = '" . (int)$special_id . "', category_id = '" . (int)$category_id . "'");
			}
		}
	}
	
	public function addSpecial($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "special SET code = '" . $this->db->escape($data['code']) . "', discount = '" . (float)$data['discount'] . "', type = '" . $this->db->escape($data['type']) . "', total = '" . (float)$data['total'] . "', logged = '" . (int)$data['logged'] . "', shipping = '" . (int)$data['shipping'] . "', date_start = '" . $this->db->escape($data['date_start']) . "', date_end = '" . $this->db->escape($data['date_end']) . "', uses_total = '" . (int)$data['uses_total'] . "', uses_customer = '" . (int)$data['uses_customer'] . "', status = '" . (int)$data['status'] . "', date_added = NOW()");

		$special_id = $this->db->getLastId();
		
		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "special SET image = '" . $this->db->escape($data['image']) . "' WHERE special_id = '" . (int)$special_id . "'");
		}
		
		foreach ($data['special_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "special_description SET special_id = '" . (int)$special_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', tag = '" . $this->db->escape($value['tag']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		if (isset($data['special_product'])) {
			foreach ($data['special_product'] as $product_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "special_product SET special_id = '" . (int)$special_id . "', product_id = '" . (int)$product_id . "'");
			}
		}

		if (isset($data['special_category'])) {
			foreach ($data['special_category'] as $category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "special_category SET special_id = '" . (int)$special_id . "', category_id = '" . (int)$category_id . "'");
			}
		}

		return $special_id;
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

}