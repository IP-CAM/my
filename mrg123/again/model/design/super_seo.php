<?php 
class ModelDesignSuperSeo extends Model {
	public function getUrlByRoute($route){
		$query = $this->db->query("SELECT * FROM ".DB_PREFIX."url_alias WHERE query = '".$this->db->escape($route)."'");
		return $query->num_rows;
	}
	
	public function getUrlByKeyword($url){
		$query = $this->db->query("SELECT * FROM ".DB_PREFIX."url_alias WHERE keyword = '".$this->db->escape($url)."'");
		return $query->num_rows;
	}
	
	public function deleteUrlAlias($route,$url){
		$this->db->query("DELETE FROM ".DB_PREFIX."url_alias WHERE `keyword` = '".$this->db->escape($url)."' AND `query` = '".$this->db->escape($route)."'");
	}
	
	public function getUrlAlias(){
		$query = $this->db->query("SELECT * FROM ". DB_PREFIX ."url_alias ORDER BY `query` ASC");
		if($query){
			return $query->rows;
		}else{
			return false;
		}
		
	}
	public function addUrlAlias($query,$keyword){
		$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = '" . $this->db->escape($query) . "', keyword = '" . $this->db->escape($keyword) . "'");
	}
}

?>