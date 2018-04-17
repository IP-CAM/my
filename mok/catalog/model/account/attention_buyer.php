<?php
class ModelAccountAttentionBuyer extends Model {
    public function addAttentionBuyer($buyer_id) {

        $query = $this->db->query("SELECT buyer_id FROM " . DB_PREFIX . "customer_attention WHERE customer_id = '" . (int)$this->customer->getId() . "'");
        if ($query->rows) {
            $data = json_decode($query->row['buyer_id'], true);
            if(!$data){
                $data = array();
            }
            $index = array_search($buyer_id,$data);
            if($index !== false){
                unset($data[$index]);
                //删除
                $status = 2;
            }else{
                $data[] = $buyer_id;
                //增加
                $status = 1;
            }
            $this->db->query("UPDATE " . DB_PREFIX . "customer_attention SET buyer_id = '" . json_encode($data , true) . "' WHERE customer_id = '" . (int)$this->customer->getId() . "'");

        }else{
            $data = array();
            $data[] = $buyer_id;
            $this->db->query("INSERT " . DB_PREFIX . "customer_attention SET buyer_id = '" . json_encode($data , true) . "',customer_id = '" . (int)$this->customer->getId() . "'");
            //增加
            $status = 1;
        }

        return $status;
    }

    public function deleteAttentionBuyer($buyer_id) {
        $query = $this->db->query("SELECT buyer_id FROM " . DB_PREFIX . "customer_attention WHERE customer_id = '" . (int)$this->customer->getId() . "'");
        $data = json_decode($query->row['buyer_id'], true);
        $index = array_search($buyer_id,$data);
        unset($data[$index]);

        $this->db->query("UPDATE " . DB_PREFIX . "customer_attention SET buyer_id = '" . json_encode($data , true) . "' WHERE customer_id = '" . (int)$this->customer->getId() . "'");

    }

    public function getAttentionBuyers() {
        $query = $this->db->query("SELECT buyer_id FROM " . DB_PREFIX . "customer_attention WHERE customer_id = '" . (int)$this->customer->getId() . "'");

        if($query->row){
            return json_decode($query->row['buyer_id'], true);
        }else{
            return $data=array();
        }

    }

    public function getTotalAttentionManufacturer() {
        $query = $this->db->query("SELECT buyer_id FROM " . DB_PREFIX . "customer_attention WHERE customer_id = '" . (int)$this->customer->getId() . "'");
        if($query->row['buyer_id']){
            $data = json_decode($query->row['buyer_id'], true);
            return count($data);
        }else{
            return '0';
        }

    }
}
