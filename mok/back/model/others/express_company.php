<?php
class ModelOthersExpressCompany extends Model {
	public function addExpressCompany($data) {
		$this->event->trigger('pre.admin.express_company.add', $data);

		$this->db->query("INSERT INTO " . DB_PREFIX . "express_company SET name = '" . $this->db->escape($data['name']) . "', code = '" . $this->db->escape($data['code']) . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW(), date_added = NOW()");

		$express_company_id = $this->db->getLastId();


		if (isset($data['express_company_store'])) {
			foreach ($data['express_company_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "express_company_to_store SET express_company_id = '" . (int)$express_company_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		$this->cache->delete('express_company');

		$this->event->trigger('post.admin.express_company.add', $express_company_id);

		return $express_company_id;
	}

	public function editExpressCompany($express_company_id, $data) {
		$this->event->trigger('pre.admin.express_company.edit', $data);

		$this->db->query("UPDATE " . DB_PREFIX . "express_company SET name = '" . $this->db->escape($data['name']) . "', code = '" . $this->db->escape($data['code']) . "',  sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW() WHERE express_company_id = '" . (int)$express_company_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "express_company_to_store WHERE express_company_id = '" . (int)$express_company_id . "'");

		if (isset($data['express_company_store'])) {
			foreach ($data['express_company_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "express_company_to_store SET express_company_id = '" . (int)$express_company_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		$this->cache->delete('express_company');

		$this->event->trigger('post.admin.express_company.edit', $express_company_id);
	}

	public function deleteExpressCompany($express_company_id) {
		$this->event->trigger('pre.admin.express_company.delete', $express_company_id);

		$this->db->query("DELETE FROM " . DB_PREFIX . "express_company WHERE express_company_id = '" . (int)$express_company_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "express_company_to_store WHERE express_company_id = '" . (int)$express_company_id . "'");

		$this->cache->delete('express_company');

		$this->event->trigger('post.admin.express_company.delete', $express_company_id);
	}


	public function getExpressCompany($express_company_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "express_company WHERE express_company_id = '" . (int)$express_company_id . "'");

		return $query->row;
	}

	public function getExpressCompanies($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "express_company WHERE express_company_id != 0 ";

		$sort_data = array(
			'name',
			'sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY sort_order";
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


	public function getExpressCompanyStores($express_company_id) {
		$express_company_store_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "express_company_to_store WHERE express_company_id = '" . (int)$express_company_id . "'");

		foreach ($query->rows as $result) {
			$express_company_store_data[] = $result['store_id'];
		}

		return $express_company_store_data;
	}

	public function getTotalExpressCompanies() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "express_company");

		return $query->row['total'];
	}
	
}
