<?php

class ModelToolExportSma extends Model {
	
	public function getProductByStatus(){
		$query = $this->db->query("SELECT p.product_id,pd.name FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE p.status = '0' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");
		
		$results =  $query->rows;
	
	if(!empty($results)){
		$codes=[];
	foreach($results as $k=>$arr){
		$codes[]=$arr['product_id'];
	}
	$code = implode(',',$codes);
	
		$sma_db = new DB('mysqli', 'localhost', 'root', 'root', 'oc18_wms');
		$results2 = $sma_db->query("SELECT code,quantity,name FROM sma_products WHERE quantity > 0 AND code in (".$code.")");
		
	
		return $results2->rows;
	}else{
		
		return false;
	}
	
	}

	
}
?>