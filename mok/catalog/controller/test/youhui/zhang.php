<?php
/**
 * Created by PhpStorm.
 * User: me
 * Date: 2016/12/7
 * Time: 18:17
 */
class ModelTestYouhuiZhang extends Model {
    public function zi(){
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");

        return $query->row;
    }

}