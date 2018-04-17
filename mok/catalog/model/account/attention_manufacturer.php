<?php
class ModelAccountAttentionManufacturer extends Model {
    /*关注品牌操作*/
    public function addAttentionManufacturer($manufacturer_id) {

        $query = $this->db->query("SELECT manufacturer_id FROM " . DB_PREFIX . "customer_attention WHERE customer_id = '" . (int)$this->customer->getId() . "'");
        if ($query->rows) {
            $data = json_decode($query->row['manufacturer_id'], true);
            if(!$data){
                $data = array();
            }
            $index = array_search($manufacturer_id,$data);
            if($index !== false){
                unset($data[$index]);
                //删除
                $status = 2;
            }else{
                $data[] = $manufacturer_id;
                //增加
                $status = 1;
            }
            $this->db->query("UPDATE " . DB_PREFIX . "customer_attention SET manufacturer_id = '" . json_encode($data , true) . "' WHERE customer_id = '" . (int)$this->customer->getId() . "'");

        }else{
            $data = array();
            $data[] = $manufacturer_id;
            $this->db->query("INSERT " . DB_PREFIX . "customer_attention SET manufacturer_id = '" . json_encode($data , true) . "',customer_id = '" . (int)$this->customer->getId() . "'");
            //增加
            $status = 1;
        }

        return $status;
    }

    public function deleteAttentionManufacturer($manufacturer_id) {
        $query = $this->db->query("SELECT manufacturer_id FROM " . DB_PREFIX . "customer_attention WHERE customer_id = '" . (int)$this->customer->getId() . "'");
        $data = json_decode($query->row['manufacturer_id'], true);
        $index = array_search($manufacturer_id,$data);
        unset($data[$index]);

        $this->db->query("UPDATE " . DB_PREFIX . "customer_attention SET manufacturer_id = '" . json_encode($data , true) . "' WHERE customer_id = '" . (int)$this->customer->getId() . "'");

    }

    public function getAttentionManufacturer() {
        $query = $this->db->query("SELECT manufacturer_id FROM " . DB_PREFIX . "customer_attention WHERE customer_id = '" . (int)$this->customer->getId() . "'");

        if($query->row){
            return json_decode($query->row['manufacturer_id'], true);
        }else{
            return $data=array();
        }

    }

    public function getTotalAttentionManufacturer() {
        $query = $this->db->query("SELECT manufacturer_id FROM " . DB_PREFIX . "customer_attention WHERE customer_id = '" . (int)$this->customer->getId() . "'");
        if($query->row['manufacturer_id']){
            $data = json_decode($query->row['manufacturer_id'], true);
            return count($data);
        }else{
            return '0';
        }

    }
}
