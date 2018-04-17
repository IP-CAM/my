<?php
class ModelAccountWishlistExt extends Model {
	public function addWishlist($product_id) {

        $query = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "customer_collect WHERE customer_id = '" . (int)$this->customer->getId() . "'");
        if ($query->rows) {
            $data = json_decode($query->row['product_id'], true);
            if(!$data){
                $data = array();
            }
            $index = array_search($product_id,$data);
            if($index !== false){
                unset($data[$index]);
                //删除
                $status = 2;
            }else{
                $data[] = $product_id;
                //增加
                $status = 1;
            }
            $this->db->query("UPDATE " . DB_PREFIX . "customer_collect SET product_id = '" . json_encode($data , true) . "' WHERE customer_id = '" . (int)$this->customer->getId() . "'");

        }else{
            $data = array();
            $data[] = $product_id;
            $this->db->query("INSERT " . DB_PREFIX . "customer_collect SET product_id = '" . json_encode($data , true) . "',customer_id = '" . (int)$this->customer->getId() . "'");
            //增加
            $status = 1;
        }

        return $status;

    }

    public function deleteWishlist($product_id) {
        $query = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "customer_collect WHERE customer_id = '" . (int)$this->customer->getId() . "'");
        $data = json_decode($query->row['product_id'], true);
        $index = array_search($product_id,$data);
        unset($data[$index]);

        $this->db->query("UPDATE " . DB_PREFIX . "customer_collect SET product_id = '" . json_encode($data , true) . "' WHERE customer_id = '" . (int)$this->customer->getId() . "'");
    }

	public function getWishlist() {
        $query = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "customer_collect WHERE customer_id = '" . (int)$this->customer->getId() . "'");
        if($query->row){
            return json_decode($query->row['product_id'], true);
        }else{
            return $data=array();
        }

	}

	public function getTotalWishlist() {
        $query = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "customer_collect WHERE customer_id = '" . (int)$this->customer->getId() . "'");
       if($query->row){
           $data = json_decode($query->row['product_id'], true);
           return count($data);
       }else{
           return '0';
       }

	}
	
	public function getWishProduct($product_id){
		$query = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "customer_collect WHERE customer_id = '" . (int)$this->customer->getId() . "'");
		if ($query->row['product_id']) {
            $data = json_decode($query->row['product_id'], true);
            $index = array_search($product_id,$data);
            if($index !== false){
                return true;
            }else{
                return false;
            }
        }else{
			return false;
		}
	}

    public function is_attention($product_id) {
        $query = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "customer_collect WHERE customer_id = '" . (int)$this->customer->getId() . "'");
        if ($query->rows) {
            $data = json_decode($query->row['product_id'], true);
            if(in_array($product_id ,$data)){
                $status = 1;
            }else{
                $status = 2;
            }
        }else{
            $status = 2;
        }

        return $status;
    }


}
