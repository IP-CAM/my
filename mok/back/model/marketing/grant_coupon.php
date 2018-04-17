<?php
/**
 * Created by PhpStorm.
 * User: me
 * Date: 2016/12/7
 * Time: 18:23
 */
class ModelMarketingGrantCoupon extends Model {
    public function getCouponOne($coupon_code){
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "coupon WHERE code = '" . (int)$coupon_code . "'");

        return $query->row;
    }

    public function getCouponAll($customer_id){
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_coupons WHERE customer_id = '" . (int)$customer_id . "'");
        return $query->rows;
    }


    public function CustomerBindCoupon($customer_info , $coupon_info){
        $created = date('Y-m-d H:i:s',time());
        $res=$this->db->query("INSERT INTO " . DB_PREFIX . "customer_coupons SET customer_id = '" . (int)$customer_info['customer_id'] . "',coupon_id='". (int)$coupon_info['coupon_id'] ."',customer_name='".$customer_info['firstname']."',status='N' ,coupon_name='".$coupon_info['name']."',book_value='".$coupon_info['discount']."',expire_time='".$coupon_info['date_end']."',created='".$created."'" );
        return $res;
    }

    public function getCouponNum($coupon_id , $customer_id){
        $query = $this->db->query("SELECT count(*) as num FROM " . DB_PREFIX . "customer_coupons WHERE coupon_id = '" . (int)$coupon_id . "'AND customer_id='" . (int)$customer_id ."'" );

        return $query->row['num'];
    }

    public function getCouponCateInfo($coupon_id ){
        $query = $this->db->query("SELECT cd.name  FROM " . DB_PREFIX . "coupon_category cc LEFT JOIN ".DB_PREFIX."category_description cd ON cc.category_id = cd.category_id WHERE cc.coupon_id = " . (int)$coupon_id);

        return $query->rows;
    }

    public function getCouponProduct($coupon_id ){
        $query = $this->db->query("SELECT pd.name  FROM " . DB_PREFIX . "coupon_product cp LEFT JOIN ".DB_PREFIX."product_description pd ON cp.product_id = pd.product_id WHERE cp.coupon_id = " . (int)$coupon_id);

        return $query->rows;
    }

}