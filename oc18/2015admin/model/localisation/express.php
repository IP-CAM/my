<?php
class ModelLocalisationExpress extends Model {
	public function addExpress($data) {
		$this->event->trigger('pre.admin.express.add', $data);
		
		if (isset($data['value']) && is_array($data['value'])) {
			$value = serialize($data['value']);
		} else {
			$value = '';
		}
		
		if (isset($data['custom']) && is_array($data['custom'])) {
			$custom = serialize($data['custom']);
		} else {
			$custom = '';
		}
		
		if (isset($data['shippings']) && is_array($data['shippings'])) {
			$shippings = serialize($data['shippings']);
		} else {
			$shippings = '';
		}

		$this->db->query("INSERT INTO " . DB_PREFIX . "express SET name = '" . $this->db->escape($data['name']) . "', image = '" . $this->db->escape($data['image']) . "', width = '" . (float)$data['width'] . "', height = '" . (float)$data['height'] . "', `top` = '" . (float)$data['top'] . "', `left` = '" . (float)$data['left'] . "', `value` = '" . $this->db->escape($value) . "', `custom` = '" . $this->db->escape($custom) . "', `shippings` = '" . $this->db->escape($shippings) . "', `printer` = '" . $this->db->escape(trim($data['printer'])) . "', `papersize` = '" . $this->db->escape(trim($data['papersize'])) . "', date_added = NOW()");

		$express_id = $this->db->getLastId();

		$this->event->trigger('post.admin.express.add', $express_id);

		return $express_id;
	}

	public function editExpress($express_id, $data) {
		$this->event->trigger('pre.admin.express.edit', $data);
		
		if (isset($data['value']) && is_array($data['value'])) {
			$value = serialize($data['value']);
		} else {
			$value = '';
		}
		
		if (isset($data['custom']) && is_array($data['custom'])) {
			$custom = serialize($data['custom']);
		} else {
			$custom = '';
		}
		
		if (isset($data['shippings']) && is_array($data['shippings'])) {
			$shippings = serialize($data['shippings']);
		} else {
			$shippings = '';
		}

		$this->db->query("UPDATE " . DB_PREFIX . "express SET name = '" . $this->db->escape($data['name']) . "', image = '" . $this->db->escape($data['image']) . "', width = '" . (float)$data['width'] . "', height = '" . (float)$data['height'] . "', `top` = '" . (float)$data['top'] . "', `left` = '" . (float)$data['left'] . "', `value` = '" . $this->db->escape($value) . "', `custom` = '" . $this->db->escape($custom) . "', `shippings` = '" . $this->db->escape($shippings) . "', `printer` = '" . $this->db->escape(trim($data['printer'])) . "', `papersize` = '" . $this->db->escape(trim($data['papersize'])) . "' WHERE express_id = '".(int)$express_id."'");

		$this->event->trigger('post.admin.express.edit', $express_id);
	}

	public function deleteExpress($express_id) {
		$this->event->trigger('pre.admin.express.delete', $express_id);

		$this->db->query("DELETE FROM " . DB_PREFIX . "express WHERE express_id = '" . (int)$express_id . "'");

		$this->event->trigger('post.admin.express.delete', $express_id);
	}

	public function getExpress($express_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "express WHERE express_id = '" . (int)$express_id . "' LIMIT 1");

		return $query->row;
	}

	public function getExpresses($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "express";

		$sort_data = array(
			'name'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY name";
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

	public function getTotalExpresses() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "express");

		return $query->row['total'];
	}

	public function getOrderStatus() {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "order_status` WHERE language_id = '".(int)$this->config->get('config_language_id')."'");

		return $query->rows;
	}

	public function getShippingMethods() {
		$sql = "SELECT * FROM `" . DB_PREFIX . "setting` WHERE `code` = 'super'";
		
		$results = $this->db->query($sql)->rows;
		
		$setting = array();
		$shippings = array();
		
		foreach ($results as $result) {
			if ($result['serialized']) {
				$setting[$result['key']] = unserialize($result['value']);
			} else {
				$setting[$result['key']] = $result['value'];
			}
		}
		
		if (isset($setting['super'])) {
			foreach ($setting['super'] as $code) {
				if (isset($setting['super'.$code.'_name'])) {
					$name = $setting['super'.$code.'_name'];
					
					$shippings[] = array(
						'code'  => 'super'.$code,
						'name'  => $name[$this->config->get('config_language_id')]
					);
				}
			}
		}

		return $shippings;
	}
}