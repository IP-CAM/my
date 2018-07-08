<?php
class ModelLocalisationLink extends Model {	
	public function getLinkByName($name) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "link WHERE name = '" . $this->db->escape($name) . "' AND status = '1' LIMIT 1");

		return $query->row;
	}
}