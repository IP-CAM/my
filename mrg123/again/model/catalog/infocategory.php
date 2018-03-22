<?php
class ModelCatalogInfocategory extends Model {
	
	public function addInfocategory($data){
		$this->db->query("INSERT INTO " . DB_PREFIX . "infocategory SET parent_id = '" . (int)$data['parent_id'] . "', `top` = '" . (isset($data['top']) ? (int)$data['top'] : 0) . "', `column` = '" . (int)$data['column'] . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW(), date_added = NOW()");

		$infocategory_id = $this->db->getLastId();

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "infocategory SET image = '" . $this->db->escape($data['image']) . "' WHERE infocategory_id = '" . (int)$infocategory_id . "'");
		}

		foreach ($data['infocategory_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "infocategory_description SET infocategory_id = '" . (int)$infocategory_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		// MySQL Hierarchical Data Closure Table Pattern
		$level = 0;

		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "infocategory_path` WHERE infocategory_id = '" . (int)$data['parent_id'] . "' ORDER BY `level` ASC");

		foreach ($query->rows as $result) {
			$this->db->query("INSERT INTO `" . DB_PREFIX . "infocategory_path` SET `infocategory_id` = '" . (int)$infocategory_id . "', `path_id` = '" . (int)$result['path_id'] . "', `level` = '" . (int)$level . "'");

			$level++;
		}

		$this->db->query("INSERT INTO `" . DB_PREFIX . "infocategory_path` SET `infocategory_id` = '" . (int)$infocategory_id . "', `path_id` = '" . (int)$infocategory_id . "', `level` = '" . (int)$level . "'");

		if (isset($data['infocategory_filter'])) {
			foreach ($data['infocategory_filter'] as $filter_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "infocategory_filter SET infocategory_id = '" . (int)$infocategory_id . "', filter_id = '" . (int)$filter_id . "'");
			}
		}

		if (isset($data['infocategory_store'])) {
			foreach ($data['infocategory_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "infocategory_to_store SET infocategory_id = '" . (int)$infocategory_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		// Set which layout to use with this category
		if (isset($data['infocategory_layout'])) {
			foreach ($data['infocategory_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "infocategory_to_layout SET infocategory_id = '" . (int)$infocategory_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}

		if (isset($data['keyword'])) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'infocategory_id=" . (int)$infocategory_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->cache->delete('infocategory');

		return $infocategory_id;
		
	}
	
	public function editInfocategory($infocategory_id,$data){
		$this->db->query("UPDATE " . DB_PREFIX . "infocategory SET parent_id = '" . (int)$data['parent_id'] . "', `top` = '" . (isset($data['top']) ? (int)$data['top'] : 0) . "', `column` = '" . (int)$data['column'] . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW() WHERE infocategory_id = '" . (int)$infocategory_id . "'");

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "infocategory SET image = '" . $this->db->escape($data['image']) . "' WHERE infocategory_id = '" . (int)$infocategory_id . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "infocategory_description WHERE infocategory_id = '" . (int)$infocategory_id . "'");

		foreach ($data['infocategory_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "infocategory_description SET infocategory_id = '" . (int)$infocategory_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		// MySQL Hierarchical Data Closure Table Pattern
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "infocategory_path` WHERE path_id = '" . (int)$infocategory_id . "' ORDER BY level ASC");

		if ($query->rows) {
			foreach ($query->rows as $infocategory_path) {
				// Delete the path below the current one
				$this->db->query("DELETE FROM `" . DB_PREFIX . "infocategory_path` WHERE infocategory_id = '" . (int)$infocategory_path['infocategory_id'] . "' AND level < '" . (int)$infocategory_path['level'] . "'");

				$path = array();

				// Get the nodes new parents
				$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "infocategory_path` WHERE infocategory_id = '" . (int)$data['parent_id'] . "' ORDER BY level ASC");

				foreach ($query->rows as $result) {
					$path[] = $result['path_id'];
				}

				// Get whats left of the nodes current path
				$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "infocategory_path` WHERE infocategory_id = '" . (int)$infocategory_path['infocategory_id'] . "' ORDER BY level ASC");

				foreach ($query->rows as $result) {
					$path[] = $result['path_id'];
				}

				// Combine the paths with a new level
				$level = 0;

				foreach ($path as $path_id) {
					$this->db->query("REPLACE INTO `" . DB_PREFIX . "infocategory_path` SET infocategory_id = '" . (int)$infocategory_path['infocategory_id'] . "', `path_id` = '" . (int)$path_id . "', level = '" . (int)$level . "'");

					$level++;
				}
			}
		} else {
			// Delete the path below the current one
			$this->db->query("DELETE FROM `" . DB_PREFIX . "infocategory_path` WHERE infocategory_id = '" . (int)$infocategory_id . "'");

			// Fix for records with no paths
			$level = 0;

			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "infocategory_path` WHERE infocategory_id = '" . (int)$data['parent_id'] . "' ORDER BY level ASC");

			foreach ($query->rows as $result) {
				$this->db->query("INSERT INTO `" . DB_PREFIX . "infocategory_path` SET infocategory_id = '" . (int)$infocategory_id . "', `path_id` = '" . (int)$result['path_id'] . "', level = '" . (int)$level . "'");

				$level++;
			}

			$this->db->query("REPLACE INTO `" . DB_PREFIX . "infocategory_path` SET infocategory_id = '" . (int)$infocategory_id . "', `path_id` = '" . (int)$infocategory_id . "', level = '" . (int)$level . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "infocategory_filter WHERE infocategory_id = '" . (int)$infocategory_id . "'");

		if (isset($data['infocategory_filter'])) {
			foreach ($data['infocategory_filter'] as $filter_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "infocategory_filter SET infocategory_id = '" . (int)$infocategory_id . "', filter_id = '" . (int)$filter_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "infocategory_to_store WHERE infocategory_id = '" . (int)$infocategory_id . "'");

		if (isset($data['infocategory_store'])) {
			foreach ($data['infocategory_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "infocategory_to_store SET infocategory_id = '" . (int)$infocategory_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "infocategory_to_layout WHERE infocategory_id = '" . (int)$infocategory_id . "'");

		if (isset($data['infocategory_layout'])) {
			foreach ($data['infocategory_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "infocategory_to_layout SET infocategory_id = '" . (int)$infocategory_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'infocategory_id=" . (int)$infocategory_id . "'");

		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'infocategory_id=" . (int)$infocategory_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->cache->delete('infocategory');
	}
	
	public function deleteInfocategory($infocategory_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "infocategory_path WHERE infocategory_id = '" . (int)$infocategory_id . "'");

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category_path WHERE path_id = '" . (int)$infocategory_id . "'");

		foreach ($query->rows as $result) {
			$this->deleteInfocategory($result['infocategory_id']);
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "infocategory WHERE infocategory_id = '" . (int)$infocategory_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "infocategory_description WHERE infocategory_id = '" . (int)$infocategory_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "infocategory_filter WHERE infocategory_id = '" . (int)$infocategory_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "infocategory_to_store WHERE infocategory_id = '" . (int)$infocategory_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "infocategory_to_layout WHERE infocategory_id = '" . (int)$infocategory_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "information_to_infocategory WHERE infocategory_id = '" . (int)$infocategory_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'infocategory_id=" . (int)$infocategory_id . "'");

		$this->cache->delete('infocategory');

	}
	
	public function repairInfocategories($parent_id = 0) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "infocategory WHERE parent_id = '" . (int)$parent_id . "'");

		foreach ($query->rows as $infocategory) {
			// Delete the path below the current one
			$this->db->query("DELETE FROM `" . DB_PREFIX . "infocategory_path` WHERE infocategory_id = '" . (int)$infocategory['infocategory_id'] . "'");

			// Fix for records with no paths
			$level = 0;

			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "infocategory_path` WHERE infocategory_id = '" . (int)$parent_id . "' ORDER BY level ASC");

			foreach ($query->rows as $result) {
				$this->db->query("INSERT INTO `" . DB_PREFIX . "infocategory_path` SET infocategory_id = '" . (int)$infocategory['infocategory_id'] . "', `path_id` = '" . (int)$result['path_id'] . "', level = '" . (int)$level . "'");

				$level++;
			}

			$this->db->query("REPLACE INTO `" . DB_PREFIX . "infocategory_path` SET infocategory_id = '" . (int)$infocategory['infocategory_id'] . "', `path_id` = '" . (int)$infocategory['infocategory_id'] . "', level = '" . (int)$level . "'");

			$this->repairInfocategories($infocategory['infocategory_id']);
		}
	}
	
	public function getInfocategory($infocategory_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT GROUP_CONCAT(id1.name ORDER BY level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') FROM " . DB_PREFIX . "infocategory_path ip LEFT JOIN " . DB_PREFIX . "infocategory_description id1 ON (ip.path_id = id1.infocategory_id AND ip.infocategory_id != ip.path_id) WHERE ip.infocategory_id = i.infocategory_id AND id1.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY ip.infocategory_id) AS path, (SELECT DISTINCT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'infocategory_id=" . (int)$infocategory_id . "') AS keyword FROM " . DB_PREFIX . "infocategory i LEFT JOIN " . DB_PREFIX . "infocategory_description id2 ON (i.infocategory_id = id2.infocategory_id) WHERE i.infocategory_id = '" . (int)$infocategory_id . "' AND id2.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}
	
	public function getInfocategories($data = array()) {
		$sql = "SELECT ip.infocategory_id AS infocategory_id, GROUP_CONCAT(id1.name ORDER BY ip.level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') AS name, i1.parent_id, i1.sort_order FROM " . DB_PREFIX . "infocategory_path ip LEFT JOIN " . DB_PREFIX . "infocategory i1 ON (ip.infocategory_id = i1.infocategory_id) LEFT JOIN " . DB_PREFIX . "infocategory i2 ON (ip.path_id = i2.infocategory_id) LEFT JOIN " . DB_PREFIX . "infocategory_description id1 ON (ip.path_id = id1.infocategory_id) LEFT JOIN " . DB_PREFIX . "infocategory_description id2 ON (ip.infocategory_id = id2.infocategory_id) WHERE id1.language_id = '" . (int)$this->config->get('config_language_id') . "' AND id2.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND id2.name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}

		$sql .= " GROUP BY ip.infocategory_id";

		$sort_data = array(
			'sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY sort_order";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC, LCASE(id1.name) ASC";
		} else {
			$sql .= " ASC, LCASE(id1.name) ASC";
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

	public function getInfocategoryDescriptions($infocategory_id) {
		$infocategory_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "infocategory_description WHERE infocategory_id = '" . (int)$infocategory_id . "'");

		foreach ($query->rows as $result) {
			$infocategory_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
				'meta_title'       => $result['meta_title'],
				'meta_description' => $result['meta_description'],
				'meta_keyword'     => $result['meta_keyword'],
				'description'      => $result['description']
			);
		}

		return $infocategory_description_data;
	}
	
	public function getInfocategoryPath($infocategory_id) {
		$query = $this->db->query("SELECT infocategory_id, path_id, level FROM " . DB_PREFIX . "infocategory_path WHERE infocategory_id = '" . (int)$infocategory_id . "'");

		return $query->rows;
	}
	
	public function getInfocategoryFilters($infocategory_id) {
		$infocategory_filter_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "infocategory_filter WHERE infocategory_id = '" . (int)$infocategory_id . "'");

		foreach ($query->rows as $result) {
			$infocategory_filter_data[] = $result['filter_id'];
		}

		return $infocategory_filter_data;
	}
	
	public function getInfocategoryStores($infocategory_id) {
		$infocategory_store_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "infocategory_to_store WHERE infocategory_id = '" . (int)$infocategory_id . "'");

		foreach ($query->rows as $result) {
			$infocategory_store_data[] = $result['store_id'];
		}

		return $infocategory_store_data;
	}

	public function getInfocategoryLayouts($infocategory_id) {
		$infocategory_layout_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "infocategory_to_layout WHERE infocategory_id = '" . (int)$infocategory_id . "'");

		foreach ($query->rows as $result) {
			$infocategory_layout_data[$result['store_id']] = $result['layout_id'];
		}

		return $infocategory_layout_data;
	}
	
	public function getTotalInfocategories() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "infocategory");

		return $query->row['total'];
	}
	
	public function getTotalInfocategoriesByLayoutId($layout_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "infocategory_to_layout WHERE layout_id = '" . (int)$layout_id . "'");

		return $query->row['total'];
	}
	
}