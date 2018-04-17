<?php
class ModelTestTry extends Model {
	public function addAddressDefault($id) {
		$address_query = $this->db->query("SELECT COUNT(address_id) AS total FROM " . DB_PREFIX . "address WHERE customer_id = '" . (int)$id . "'");
		
		if($address_query->row['total'] ==1){
			$result = $this->db->query("UPDATE " . DB_PREFIX . "customer SET address_id = '111' WHERE customer_id = '" . (int)$id . "'");
		}
		
		return $address_query->row['total'];
	}
}
?>