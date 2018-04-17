<?php
/**
 * Created by PhpStorm.
 * User: me
 * Date: 2016/12/1
 * Time: 16:41
 */
class ModelExtensionModuleSmsMeilian extends Model {
    public function getTotalTelephone($telephone,$begin=0,$send_status='success' , $behavior){
        $sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "telephone_captcha WHERE telephone = '" . $this->db->escape($telephone) . "' AND behavior = '".$behavior."' AND unix_timestamp(date_added) >" .(int)$begin."  AND send_status='".$this->db->escape($send_status)."' ORDER BY unix_timestamp(date_added) DESC";
        $query = $this->db->query($sql);
        return $query->row['total'];
    }
    public function getTotalTelephoneByIp($ip,$begin=0 ,$behavior){
        $sql = "SELECT COUNT(DISTINCT telephone) AS total FROM " . DB_PREFIX . "telephone_captcha WHERE LOWER(ip) = '" . $this->db->escape($ip) . "' AND behavior = '".$behavior."'";
        if($begin){
            $sql .= " AND unix_timestamp(date_added) > '" . (int)$begin . "'";
        }
        $query = $this->db->query($sql);
        return $query->row['total'];
    }
    public function addSecurityCode($data = array(),$behavior){
        $this->db->query("INSERT INTO " . DB_PREFIX . "telephone_captcha SET security_code = '" . $this->db->escape($data['security_code']) . "', user_agent = '" . $this->db->escape($data['user_agent']) . "', ip = '" . $this->db->escape($data['ip']) . "', telephone = '" . $this->db->escape($data['telephone']) . "', res_code = '" . $this->db->escape($data['res_code']) . "', send_status = '" . $this->db->escape($data['send_status']) . "', behavior = '".$behavior."',date_added = NOW()");
    }
    public function getSecurityCode($telephone ,$behavior,$send_status='success'){
        $sql = "SELECT security_code FROM " . DB_PREFIX . "telephone_captcha WHERE telephone = '" . $this->db->escape($telephone) . "' AND send_status='".$this->db->escape($send_status)."' AND behavior ='".$behavior."' ORDER BY telephone_captcha_id DESC LIMIT 1";
        $query = $this->db->query($sql);
        return $query->row;
    }

}