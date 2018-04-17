<?php
class ModelMarketingTopic extends Model {
	public function getTotalTopics() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "topic");

		return $query->row['total'];
	}
	
	public function getTopics($data = array()) {
		$sql = "SELECT s.topic_id, sd.name, s.code, s.date_start, s.date_end, s.status FROM " . DB_PREFIX . "topic s LEFT JOIN " . DB_PREFIX . "topic_description sd ON (s.topic_id = sd.topic_id)";
		
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
	
	public function getTopic($topic_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "topic s LEFT JOIN " .DB_PREFIX . "topic_description sd ON (s.topic_id = sd.topic_id) WHERE s.topic_id = '" . (int)$topic_id . "' AND sd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}
	
	public function getTopicProducts($topic_id) {
		$topic_product_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "topic_product WHERE topic_id = '" . (int)$topic_id . "'");

		foreach ($query->rows as $result) {
			$topic_product_data[] = $result['product_id'];
		}

		return $topic_product_data;
	}
	
	public function getTopicCategories($topic_id) {
		$topic_category_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "topic_category WHERE topic_id = '" . (int)$topic_id . "'");

		foreach ($query->rows as $result) {
			$topic_category_data[] = $result['category_id'];
		}

		return $topic_category_data;
	}
	
	public function getTopicByCode($code) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "topic WHERE code = '" . $this->db->escape($code) . "'");

		return $query->row;
	}
	
	public function getTopicHistories($topic_id, $start = 0, $limit = 10) {
		if ($start < 0) {
			$start = 0;
		}

		if ($limit < 1) {
			$limit = 10;
		}

		$query = $this->db->query("SELECT sh.order_id, CONCAT(c.firstname, ' ', c.lastname) AS customer, sh.amount, sh.date_added FROM " . DB_PREFIX . "topic_history sh LEFT JOIN " . DB_PREFIX . "customer c ON (sh.customer_id = c.customer_id) WHERE sh.topic_id = '" . (int)$topic_id . "' ORDER BY sh.date_added ASC LIMIT " . (int)$start . "," . (int)$limit);

		return $query->rows;
	}
	
	public function getTotalTopicHistories($topic_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "topic_history WHERE topic_id = '" . (int)$topic_id . "'");

		return $query->row['total'];
	}
	
	public function deleteTopic($topic_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "topic WHERE topic_id = '" . (int)$topic_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "topic_product WHERE topic_id = '" . (int)$topic_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "topic_category WHERE topic_id = '" . (int)$topic_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "topic_history WHERE topic_id = '" . (int)$topic_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "topic_description WHERE topic_id = '" . (int)$topic_id . "'");
	}
	
	public function editTopic($topic_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "topic SET code = '" . $this->db->escape($data['code']) . "', discount = '" . (float)$data['discount'] . "', type = '" . $this->db->escape($data['type']) . "', total = '" . (float)$data['total'] . "', logged = '" . (int)$data['logged'] . "', shipping = '" . (int)$data['shipping'] . "', date_start = '" . $this->db->escape($data['date_start']) . "', date_end = '" . $this->db->escape($data['date_end']) . "', uses_total = '" . (int)$data['uses_total'] . "', uses_customer = '" . (int)$data['uses_customer'] . "', status = '" . (int)$data['status'] . "' WHERE topic_id = '" . (int)$topic_id . "'");
		
		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "topic SET image = '" . $this->db->escape($data['image']) . "' WHERE topic_id = '" . (int)$topic_id . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "topic_description WHERE topic_id = '" . (int)$topic_id . "'");

		foreach ($data['topic_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "topic_description SET topic_id = '" . (int)$topic_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', tag = '" . $this->db->escape($value['tag']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "topic_product WHERE topic_id = '" . (int)$topic_id . "'");

		if (isset($data['topic_product'])) {
			foreach ($data['topic_product'] as $product_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "topic_product SET topic_id = '" . (int)$topic_id . "', product_id = '" . (int)$product_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "topic_category WHERE topic_id = '" . (int)$topic_id . "'");

		if (isset($data['topic_category'])) {
			foreach ($data['topic_category'] as $category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "topic_category SET topic_id = '" . (int)$topic_id . "', category_id = '" . (int)$category_id . "'");
			}
		}
	}
	
	public function addTopic($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "topic SET code = '" . $this->db->escape($data['code']) . "', discount = '" . (float)$data['discount'] . "', type = '" . $this->db->escape($data['type']) . "', total = '" . (float)$data['total'] . "', logged = '" . (int)$data['logged'] . "', shipping = '" . (int)$data['shipping'] . "', date_start = '" . $this->db->escape($data['date_start']) . "', date_end = '" . $this->db->escape($data['date_end']) . "', uses_total = '" . (int)$data['uses_total'] . "', uses_customer = '" . (int)$data['uses_customer'] . "', status = '" . (int)$data['status'] . "', date_added = NOW()");

		$topic_id = $this->db->getLastId();
		
		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "topic SET image = '" . $this->db->escape($data['image']) . "' WHERE topic_id = '" . (int)$topic_id . "'");
		}
		
		foreach ($data['topic_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "topic_description SET topic_id = '" . (int)$topic_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', tag = '" . $this->db->escape($value['tag']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		if (isset($data['topic_product'])) {
			foreach ($data['topic_product'] as $product_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "topic_product SET topic_id = '" . (int)$topic_id . "', product_id = '" . (int)$product_id . "'");
			}
		}

		if (isset($data['topic_category'])) {
			foreach ($data['topic_category'] as $category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "topic_category SET topic_id = '" . (int)$topic_id . "', category_id = '" . (int)$category_id . "'");
			}
		}

		return $topic_id;
	}
	
	public function getTopicDescriptions($topic_id) {
		$topic_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "topic_description WHERE topic_id = '" . (int)$topic_id . "'");

		foreach ($query->rows as $result) {
			$topic_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
				'description'      => $result['description'],
				'meta_title'       => $result['meta_title'],
				'meta_description' => $result['meta_description'],
				'meta_keyword'     => $result['meta_keyword'],
				'tag'              => $result['tag']
			);
		}

		return $topic_description_data;
	}

}