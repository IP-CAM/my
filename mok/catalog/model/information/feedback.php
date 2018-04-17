<?php
class ModelInformationFeedback extends Model {
	public function addFeedback($info){
	    $time = time();
        $this->db->query("INSERT INTO " . DB_PREFIX . "feedback SET content = '" . $info['content'] . "', email = '" . $info['email'] . "', created = '" . $time . "',status=0");
    }
}