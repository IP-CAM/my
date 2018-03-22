<?php
class ModelCatalogInformation extends Model {
	public function addInformation($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "information SET sort_order = '" . (int)$data['sort_order'] . "', bottom = '" . (isset($data['bottom']) ? (int)$data['bottom'] : 0) . "', status = '" . (int)$data['status'] . "'");

		$information_id = $this->db->getLastId();

		foreach ($data['information_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "information_description SET information_id = '" . (int)$information_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "', description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		if (isset($data['information_store'])) {
			foreach ($data['information_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "information_to_store SET information_id = '" . (int)$information_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		if (isset($data['information_layout'])) {
			foreach ($data['information_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "information_to_layout SET information_id = '" . (int)$information_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}
		/* replace keyword */
		if (isset($data['keyword'])) {
			if(!empty($data['keyword'])){
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'information_id=" . (int)$information_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
			}else{
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'information_id=" . (int)$information_id . "', keyword = '" . 'information-' . (int)$information_id . "'");
			}
		}
		
		/* original
		if (isset($data['keyword'])) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'information_id=" . (int)$information_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
		*/
		/* end replace */
		
		/* add image date_release */
		if (isset($data['image'])){
			$image = $data['image'];
		}else{
			$image = '';
		}
		
		if (isset($data['date_release'])){
			$date_release = $data['date_release'];
		}else{
			$date_release = '';
		}
		
		if (isset($data['author'])){
			$author = $data['author'];
		}else{
			$author = '';
		}
		
		if (isset($data['source'])){
			$source = $data['source'];
		}else{
			$source = '';
		}
		$this->db->query("INSERT INTO " . DB_PREFIX . "information_extra SET information_id = '" . (int)$information_id . "', image = '" . $this->db->escape($image) . "', date_release = '" . $this->db->escape($date_release) . "', author = '" . $this->db->escape($author) . "', source = '" . $this->db->escape($source) . "', date_modified = NOW(), date_added = NOW()");
		
		if(isset($data['infocategory'])){
			foreach($data['infocategory'] as $infocategory_id){
				$this->db->query("INSERT INTO " . DB_PREFIX . "information_to_infocategory SET information_id = '" . (int)$information_id . "', infocategory_id = '" . (int)$infocategory_id . "'");
			}
		}
		
		/* end add */

		$this->cache->delete('information');

		return $information_id;
	}

	public function editInformation($information_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "information SET sort_order = '" . (int)$data['sort_order'] . "', bottom = '" . (isset($data['bottom']) ? (int)$data['bottom'] : 0) . "', status = '" . (int)$data['status'] . "' WHERE information_id = '" . (int)$information_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "information_description WHERE information_id = '" . (int)$information_id . "'");

		foreach ($data['information_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "information_description SET information_id = '" . (int)$information_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "', description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "information_to_store WHERE information_id = '" . (int)$information_id . "'");

		if (isset($data['information_store'])) {
			foreach ($data['information_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "information_to_store SET information_id = '" . (int)$information_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "information_to_layout WHERE information_id = '" . (int)$information_id . "'");

		if (isset($data['information_layout'])) {
			foreach ($data['information_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "information_to_layout SET information_id = '" . (int)$information_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'information_id=" . (int)$information_id . "'");

		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'information_id=" . (int)$information_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
		
		/* add image */
		$this->db->query("DELETE FROM " . DB_PREFIX . "information_extra WHERE information_id = '" . (int)$information_id . "'");
		
		if (isset($data['image'])){
			$image = $data['image'];
		}else{
			$image = '';
		}
		
		if (isset($data['date_release'])){
			$date_release = $data['date_release'];
		}else{
			$date_release = '';
		}
		if (isset($data['author'])){
			$author = $data['author'];
		}else{
			$author = '';
		}
		
		if (isset($data['source'])){
			$source = $data['source'];
		}else{
			$source = '';
		}
		$this->db->query("INSERT INTO " . DB_PREFIX . "information_extra SET information_id = '" . (int)$information_id . "', image = '" . $this->db->escape($image) . "', date_release = '" . $this->db->escape($date_release) . "', author = '" . $this->db->escape($author) . "', source = '" . $this->db->escape($source) . "', date_modified = NOW()");
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "information_to_infocategory WHERE information_id = '" . (int)$information_id . "'");
		if(isset($data['infocategory'])){
			foreach($data['infocategory'] as $infocategory_id){
				$this->db->query("INSERT INTO " . DB_PREFIX . "information_to_infocategory SET information_id = '" . (int)$information_id . "', infocategory_id = '" . (int)$infocategory_id . "'");
			}
		}
		/* end add */

		$this->cache->delete('information');
	}

	public function deleteInformation($information_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "information WHERE information_id = '" . (int)$information_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "information_description WHERE information_id = '" . (int)$information_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "information_to_store WHERE information_id = '" . (int)$information_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "information_to_layout WHERE information_id = '" . (int)$information_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'information_id=" . (int)$information_id . "'");
		
		/* add image */
		$this->db->query("DELETE FROM " . DB_PREFIX . "information_extra WHERE information_id = '" . (int)$information_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "information_to_infocategory WHERE information_id = '" . (int)$information_id . "'");
		/* end add */
		
		$this->cache->delete('information');
	}

	public function getInformation($information_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'information_id=" . (int)$information_id . "') AS keyword FROM " . DB_PREFIX . "information WHERE information_id = '" . (int)$information_id . "'");

		return $query->row;
	}

	public function getInformations($data = array()) {
		if ($data) {
			$sql = "SELECT * FROM " . DB_PREFIX . "information i LEFT JOIN " . DB_PREFIX . "information_description id ON (i.information_id = id.information_id) WHERE id.language_id = '" . (int)$this->config->get('config_language_id') . "'";

			$sort_data = array(
				'id.title',
				'i.sort_order'
			);

			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];
			} else {
				$sql .= " ORDER BY id.title";
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
		} else {
			$information_data = $this->cache->get('information.' . (int)$this->config->get('config_language_id'));

			if (!$information_data) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "information i LEFT JOIN " . DB_PREFIX . "information_description id ON (i.information_id = id.information_id) WHERE id.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY id.title");

				$information_data = $query->rows;

				$this->cache->set('information.' . (int)$this->config->get('config_language_id'), $information_data);
			}

			return $information_data;
		}
	}

	public function getInformationDescriptions($information_id) {
		$information_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "information_description WHERE information_id = '" . (int)$information_id . "'");

		foreach ($query->rows as $result) {
			$information_description_data[$result['language_id']] = array(
				'title'            => $result['title'],
				'description'      => $result['description'],
				'meta_title'       => $result['meta_title'],
				'meta_description' => $result['meta_description'],
				'meta_keyword'     => $result['meta_keyword']
			);
		}

		return $information_description_data;
	}

	public function getInformationStores($information_id) {
		$information_store_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "information_to_store WHERE information_id = '" . (int)$information_id . "'");

		foreach ($query->rows as $result) {
			$information_store_data[] = $result['store_id'];
		}

		return $information_store_data;
	}

	public function getInformationLayouts($information_id) {
		$information_layout_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "information_to_layout WHERE information_id = '" . (int)$information_id . "'");

		foreach ($query->rows as $result) {
			$information_layout_data[$result['store_id']] = $result['layout_id'];
		}

		return $information_layout_data;
	}

	public function getTotalInformations() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "information");

		return $query->row['total'];
	}

	public function getTotalInformationsByLayoutId($layout_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "information_to_layout WHERE layout_id = '" . (int)$layout_id . "'");

		return $query->row['total'];
	}
	
	/* add */
	public function getInformationExtra($information_id){
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "information_extra WHERE information_id = '" . (int)$information_id . "'");

		return $query->row;
	}
	
	public function getInfocategoryIdByInformationId($information_id){
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "information_to_infocategory WHERE information_id = '" . (int)$information_id . "'");
		return $query->row;
	}
	
	public function getInfocategory($infocategory_id) {
		$sql = "SELECT ip.infocategory_id AS infocategory_id, GROUP_CONCAT(id1.name ORDER BY ip.level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') AS name, i1.parent_id, i1.sort_order FROM " . DB_PREFIX . "infocategory_path ip LEFT JOIN " . DB_PREFIX . "infocategory i1 ON (ip.infocategory_id = i1.infocategory_id) LEFT JOIN " . DB_PREFIX . "infocategory i2 ON (ip.path_id = i2.infocategory_id) LEFT JOIN " . DB_PREFIX . "infocategory_description id1 ON (ip.path_id = id1.infocategory_id) LEFT JOIN " . DB_PREFIX . "infocategory_description id2 ON (ip.infocategory_id = id2.infocategory_id) WHERE ip.infocategory_id = '" . (int)$infocategory_id . "' AND id1.language_id = '" . (int)$this->config->get('config_language_id') . "' AND id2.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		$sql .= " GROUP BY ip.infocategory_id";

		$sql .= " ORDER BY sort_order";
		
		$sql .= " ASC";

		$query = $this->db->query($sql);

		return $query->rows;
	}
	
	
	public function getInfocategories($information_id) {
		$information_category_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "information_to_infocategory WHERE information_id = '" . (int)$information_id . "'");

		foreach ($query->rows as $result) {
			$information_category_data[] = $result['infocategory_id'];
		}

		return $information_category_data;
	}
	/* end add */
}