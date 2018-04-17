<?php
class ModelWeixinBuyer extends Model {
    public function getAttentionTotal($buyer_id) {
        $query = $this->db->query("SELECT buyer_id FROM " . DB_PREFIX . "customer_attention ");
        $attention_total = 0;
       foreach($query->rows as $row){
           if(in_array($buyer_id,json_decode($row['buyer_id'],true))){
               $attention_total+=1;
           }
       }

       return $attention_total;

    }

    public function is_attention($buyer_id) {
        $query = $this->db->query("SELECT buyer_id FROM " . DB_PREFIX . "customer_attention WHERE customer_id = '" . (int)$this->customer->getId() . "'");
        if ($query->row['buyer_id']) {
            $data = json_decode($query->row['buyer_id'], true);
            if(in_array($buyer_id ,$data)){
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
