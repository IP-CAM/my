<?php
class ModelOthersExpressCompany extends Model {
	

	public function getExpressCompany($express_company_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "express_company WHERE express_company_id = '" . (int)$express_company_id . "'");

		return $query->row;
	}

    public function getExpressCompanyByCode($express_code) {

        $query = $this->db->query("SELECT name FROM " . DB_PREFIX . "express_company WHERE code = '" . $this->db->escape($express_code) . "'");

        return $query->row;
    }

	
}