<?php
class ModelWeixinPricing extends Model {
    /*最新且启用的活动信息*/
    public function getPricingInfo(){
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "pricing WHERE status = 1 order by pricing_id desc LIMIT 1");
        return $query->row;
    }

    /*根据活动ID获取活动信息*/
    public function getPricingInfoById($pricing_id){
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "pricing WHERE pricing_id='".(int)$pricing_id."'");
        return $query->row;
    }

    public function customerPricing($customer_id ,$pricing_id){
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "pricing_customer WHERE customer_id = '" . (int)$customer_id. "'AND pricing_id='".(int)$pricing_id."'");
        return $query->num_rows;
    }

    public function addPricing($customer_id ,$pricing_id , $price){
        $res = $this->db->query("INSERT INTO " . DB_PREFIX . "pricing_customer SET customer_id = '" .(int)$customer_id . "',pricing_id = '" . (int)$pricing_id . "',price='".(int)$price."',status=0 ,created = NOW()");
        return $res;
    }

    public function cancelPricing($customer_id ,$pricing_id){
        $this->db->query("DELETE FROM " . DB_PREFIX . "pricing_customer WHERE customer_id = '" . (int)$customer_id . "' AND pricing_id = '".$pricing_id."'");

    }

    public function getCustomerByPricing($pricing_id) {
        $query = $this->db->query("SELECT pc.*,c.custom_field  FROM " . DB_PREFIX . "pricing_customer pc LEFT JOIN ". DB_PREFIX ."customer c ON pc.customer_id = c.customer_id WHERE  pc.pricing_id = '" . (int)$pricing_id . "'");

        return $query->rows;
    }

    public function getPricingByCustomer($customer_id)
     {
        $query = $this->db->query("SELECT pc.* ,p.name , p.show_image  FROM " . DB_PREFIX . "pricing_customer pc LEFT JOIN ". DB_PREFIX ."pricing p ON pc.pricing_id = p.pricing_id WHERE  pc.customer_id = '" . (int)$customer_id . "'");

        return $query->rows;
    }
}
