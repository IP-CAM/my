<?php
class ModelDesignLink extends Model {
	public function addLink($data) {
		$this->event->trigger('pre.admin.link.add', $data);

		$this->db->query("INSERT INTO " . DB_PREFIX . "link SET name = '" . $this->db->escape($data['name']) . "', url = '" . $this->db->escape($data['url']) . "',  expire = '" . (int)$data['expire'] . "', status = '" . (int)$data['status'] . "', date_added = NOW()");

		$link_id = $this->db->getLastId();

		$this->event->trigger('post.admin.link.add', $link_id);

		return $link_id;
	}

	public function editLink($link_id, $data) {
		$this->event->trigger('pre.admin.link.edit', $data);

		$this->db->query("UPDATE " . DB_PREFIX . "link SET name = '" . $this->db->escape($data['name']) . "', url = '" . $this->db->escape($data['url']) . "',  expire = '" . (int)$data['expire'] . "', status = '" . (int)$data['status'] . "' WHERE link_id = '" . (int)$link_id . "'");

		$this->event->trigger('post.admin.link.edit', $link_id);
	}

	public function deleteLink($link_id) {
		$this->event->trigger('pre.admin.link.delete', $link_id);

		$this->db->query("DELETE FROM " . DB_PREFIX . "link WHERE link_id = '" . (int)$link_id . "'");

		$this->event->trigger('post.admin.link.delete', $link_id);
	}

	public function getLink($link_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "link WHERE link_id = '" . (int)$link_id . "'");

		return $query->row;
	}

	public function getLinks($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "link";

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

	public function getLinkImages($link_id) {
		$link_image_data = array();

		$link_image_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "link_image WHERE link_id = '" . (int)$link_id . "' ORDER BY link_image_id ASC");

		foreach ($link_image_query->rows as $link_image) {
			$link_image_description_data = array();

			$link_image_description_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "link_image_description WHERE link_image_id = '" . (int)$link_image['link_image_id'] . "' AND link_id = '" . (int)$link_id . "' ORDER BY title ASC");

			foreach ($link_image_description_query->rows as $link_image_description) {
				$link_image_description_data[] = array(
					'link_image_id' => $link_image_description['link_image_id'],
					'title' => $link_image_description['title'],
					'link' => $link_image_description['link'],
					'image' => $link_image_description['image'],
					'sort_order' => $link_image_description['sort_order']
				);
			}

			$link_image_data[] = array(
				'link_image_id'          => $link_image['link_image_id'],
				'country'                  => $link_image['country'],
				'link_image_description' => $link_image_description_data
			);
		}

		return $link_image_data;
	}

	public function getTotalLinks() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "link");

		return $query->row['total'];
	}
}