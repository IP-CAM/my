<?php
class ModelExtensionModule extends Model {
	public function getModule($module_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "module WHERE module_id = '" . (int)$module_id . "'");
		
		$module = $query->row;
		
		if ($module) {
			$data = unserialize($module['setting']);
			
			if ($data) {
				$data['module_id'] = $module['module_id'];
			}
			
			return $data;
		} else {
			return array();	
		}
	}
	
	public function getModuleByCode($code) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "module WHERE LCASE(`code`) = '" . $this->db->escape(utf8_strtolower($code)) . "'");
		
		return $query->rows;
	}
}