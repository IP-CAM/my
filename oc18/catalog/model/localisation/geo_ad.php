<?php
class ModelLocalisationGeoAd extends Model {
	public function addViewed($geo_ad_image_id) {
	}
	
	public function addClicked($geo_ad_image_id) {
	}
	
	public function getGeoAd($geo_ad_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "geo_ad WHERE geo_ad_id = '" . (int)$geo_ad_id . "'");
		
		$geoAd = $query->row;
		
		$this->load->model('tool/ip');
		
		$code = $this->model_tool_ip->getInfo();
		
		if ($geoAd && $code) {
			$data = array(
				'width'  => $geoAd['width'],
				'height' => $geoAd['height'],
				'path'   => $geoAd['path'],
				'images' => $this->getGeoAdImages($geo_ad_id, $code)
			);
			
			return $data;
		}

		return false;
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
	
	public function getGeoAdImages($geo_ad_id, $code) {
		$geo_ad_image_data = array();

		$geo_ad_image_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "geo_ad_image WHERE geo_ad_id = '" . (int)$geo_ad_id . "' ORDER BY geo_ad_image_id ASC");

		foreach ($geo_ad_image_query->rows as $geo_ad_image) {
			$geo_ad_image_description_data = array();
			
			$geo_country = explode(',', $geo_ad_image['country']);
			
			if (in_array($code, $geo_country)) {
				$geo_ad_image_description_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "geo_ad_image_description WHERE geo_ad_image_id = '" . (int)$geo_ad_image['geo_ad_image_id'] . "' AND geo_ad_id = '" . (int)$geo_ad_id . "' ORDER BY title ASC");
	
				foreach ($geo_ad_image_description_query->rows as $geo_ad_image_description) {
					$geo_ad_image_description_data[] = array(
						'geo_ad_image_description_id' => $geo_ad_image_description['geo_ad_image_description_id'],
						'geo_ad_image_id' => $geo_ad_image_description['geo_ad_image_id'],
						'title' => $geo_ad_image_description['title']?unserialize($geo_ad_image_description['title']):'',
						'link' => $geo_ad_image_description['link']?unserialize($geo_ad_image_description['link']):'',
						'image' => $geo_ad_image_description['image']?unserialize($geo_ad_image_description['image']):'',
						'sort_order' => $geo_ad_image_description['sort_order']?unserialize($geo_ad_image_description['sort_order']):''
					);
				}
	
				$geo_ad_image_data[] = array(
					'geo_ad_image_id'          => $geo_ad_image['geo_ad_image_id'],
					'country'                  => $geo_ad_image['country'],
					'geo_ad_image_description' => $geo_ad_image_description_data
				);
			}
		}

		return $geo_ad_image_data;
	}
	
	public function getGeoAdImageLink($geo_ad_image_description_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "geo_ad_image_description gaid LEFT JOIN " . DB_PREFIX . "geo_ad ga ON(gaid.geo_ad_id = ga.geo_ad_id) WHERE geo_ad_image_description_id = '" . (int)$geo_ad_image_description_id . "' LIMIT 1");
		
		return $query->row;
	}
}