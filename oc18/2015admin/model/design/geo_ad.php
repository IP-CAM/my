<?php
class ModelDesignGeoAd extends Model {
	public function addGeoAd($data) {
		$this->event->trigger('pre.admin.geo_ad.add', $data);

		$this->db->query("INSERT INTO " . DB_PREFIX . "geo_ad SET name = '" . $this->db->escape($data['name']) . "', path = '" . $this->db->escape($data['path']) . "', width = '" . $this->db->escape($data['width']) . "', height = '" . $this->db->escape($data['height']) . "', status = '" . (int)$data['status'] . "', date_added = NOW()");

		$geo_ad_id = $this->db->getLastId();

		if (isset($data['geo_ad_image'])) {
			foreach ($data['geo_ad_image'] as $geo_ad_image) {
				if (!empty($geo_ad_image['country'])) {
					$country = implode(',', $geo_ad_image['country']);
				} else {
					$country = '';
				}
				
				$this->db->query("INSERT INTO " . DB_PREFIX . "geo_ad_image SET geo_ad_id = '" . (int)$geo_ad_id . "', country = '" .  $this->db->escape($country) . "'");

				$geo_ad_image_id = $this->db->getLastId();
				
				if (!empty($geo_ad_image['geo_ad_image_description'])) {
					foreach ($geo_ad_image['geo_ad_image_description'] as $geo_ad_image_description) {
						$geo_ad_image_description['title'] = $geo_ad_image_description['title']?serialize($geo_ad_image_description['title']):'';
						$geo_ad_image_description['link'] = $geo_ad_image_description['link']?serialize($geo_ad_image_description['link']):'';
						$geo_ad_image_description['image'] = $geo_ad_image_description['image']?serialize($geo_ad_image_description['image']):'';
						$geo_ad_image_description['sort_order'] = $geo_ad_image_description['sort_order']?serialize($geo_ad_image_description['sort_order']):'';
						
						$this->db->query("INSERT INTO " . DB_PREFIX . "geo_ad_image_description SET geo_ad_id = '" . (int)$geo_ad_id . "', geo_ad_image_id = '" . (int)$geo_ad_image_id . "', title = '" .  $this->db->escape($geo_ad_image_description['title']) . "', link = '" .  $this->db->escape($geo_ad_image_description['link']) . "', image = '" .  $this->db->escape($geo_ad_image_description['image']) . "', sort_order = '" . (int)$geo_ad_image_description['sort_order'] . "'");
					}
				}
			}
		}

		$this->event->trigger('post.admin.geo_ad.add', $geo_ad_id);

		return $geo_ad_id;
	}

	public function editGeoAd($geo_ad_id, $data) {
		$this->event->trigger('pre.admin.geo_ad.edit', $data);

		$this->db->query("UPDATE " . DB_PREFIX . "geo_ad SET name = '" . $this->db->escape($data['name']) . "', path = '" . $this->db->escape($data['path']) . "', width = '" . $this->db->escape($data['width']) . "', height = '" . $this->db->escape($data['height']) . "', status = '" . (int)$data['status'] . "' WHERE geo_ad_id = '" . (int)$geo_ad_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "geo_ad_image WHERE geo_ad_id = '" . (int)$geo_ad_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "geo_ad_image_description WHERE geo_ad_id = '" . (int)$geo_ad_id . "'");

		if (isset($data['geo_ad_image'])) {
			$country = '';
			
			foreach ($data['geo_ad_image'] as $geo_ad_image) {
				if (!empty($geo_ad_image['country'])) {
					$country = implode(',', $geo_ad_image['country']);
				}
				
				$this->db->query("INSERT INTO " . DB_PREFIX . "geo_ad_image SET geo_ad_id = '" . (int)$geo_ad_id . "', country = '" .  $this->db->escape($country) . "'");

				$geo_ad_image_id = $this->db->getLastId();
				
				if (!empty($geo_ad_image['geo_ad_image_description'])) {
					foreach ($geo_ad_image['geo_ad_image_description'] as $geo_ad_image_description) {
						$geo_ad_image_description['title'] = $geo_ad_image_description['title']?serialize($geo_ad_image_description['title']):'';
						$geo_ad_image_description['link'] = $geo_ad_image_description['link']?serialize($geo_ad_image_description['link']):'';
						$geo_ad_image_description['image'] = $geo_ad_image_description['image']?serialize($geo_ad_image_description['image']):'';
						$geo_ad_image_description['sort_order'] = $geo_ad_image_description['sort_order']?serialize($geo_ad_image_description['sort_order']):'';
						
						$this->db->query("INSERT INTO " . DB_PREFIX . "geo_ad_image_description SET geo_ad_id = '" . (int)$geo_ad_id . "', geo_ad_image_id = '" . (int)$geo_ad_image_id . "', title = '" .  $this->db->escape($geo_ad_image_description['title']) . "', link = '" .  $this->db->escape($geo_ad_image_description['link']) . "', image = '" .  $this->db->escape($geo_ad_image_description['image']) . "', sort_order = '" . (int)$geo_ad_image_description['sort_order'] . "'");
					}
				}
			}
		}

		$this->event->trigger('post.admin.geo_ad.edit', $geo_ad_id);
	}

	public function deleteGeoAd($geo_ad_id) {
		$this->event->trigger('pre.admin.geo_ad.delete', $geo_ad_id);

		$this->db->query("DELETE FROM " . DB_PREFIX . "geo_ad WHERE geo_ad_id = '" . (int)$geo_ad_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "geo_ad_image WHERE geo_ad_id = '" . (int)$geo_ad_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "geo_ad_image_description WHERE geo_ad_id = '" . (int)$geo_ad_id . "'");

		$this->event->trigger('post.admin.geo_ad.delete', $geo_ad_id);
	}

	public function getGeoAd($geo_ad_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "geo_ad WHERE geo_ad_id = '" . (int)$geo_ad_id . "'");

		return $query->row;
	}

	public function getGeoAds($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "geo_ad";

		$sort_data = array(
			'name',
			'status'
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

	public function getGeoAdImages($geo_ad_id) {		
		$geo_ad_image_data = array();

		$geo_ad_image_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "geo_ad_image WHERE geo_ad_id = '" . (int)$geo_ad_id . "' ORDER BY geo_ad_image_id ASC");

		foreach ($geo_ad_image_query->rows as $geo_ad_image) {
			$geo_ad_image_description_data = array();

			$geo_ad_image_description_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "geo_ad_image_description WHERE geo_ad_image_id = '" . (int)$geo_ad_image['geo_ad_image_id'] . "' AND geo_ad_id = '" . (int)$geo_ad_id . "' ORDER BY title ASC");
			
			foreach ($geo_ad_image_description_query->rows as $geo_ad_image_description) {				
				$geo_ad_image_description_data[] = array(
					'geo_ad_image_id'  => $geo_ad_image_description['geo_ad_image_id'],
					'title'            => $geo_ad_image_description['title']?unserialize($geo_ad_image_description['title']):array(),
					'link'             => $geo_ad_image_description['link']?unserialize($geo_ad_image_description['link']):array(),
					'image'            => $geo_ad_image_description['image']?unserialize($geo_ad_image_description['image']):array(),
					'sort_order'       => $geo_ad_image_description['sort_order']?unserialize($geo_ad_image_description['sort_order']):array()
				);
			}

			$geo_ad_image_data[] = array(
				'geo_ad_image_id'          => $geo_ad_image['geo_ad_image_id'],
				'country'                  => $geo_ad_image['country'],
				'geo_ad_image_description' => $geo_ad_image_description_data
			);
		}

		return $geo_ad_image_data;
	}

	public function getTotalGeoAds() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "geo_ad");

		return $query->row['total'];
	}
}