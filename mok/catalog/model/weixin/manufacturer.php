<?php
class ModelWeixinManufacturer extends Model {
    public function getManufacturer($manufacturer_id) {

        $query = $this->db->query("SELECT m.*, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'manufacturer_id=" . (int)$manufacturer_id . "') AS keyword , me.introduce ,me.show_image FROM " . DB_PREFIX . "manufacturer m LEFT JOIN " . DB_PREFIX . "manufacturer_ext me ON  m.manufacturer_id = me.manufacturer_id WHERE m.manufacturer_id = '" . (int)$manufacturer_id . "'");

       // var_dump($query->row);exit;
        return $query->row;
    }

    public function getManufacturers($data = array()) {

        $sql = "SELECT m.* , me.show_image , me.introduce FROM " . DB_PREFIX . "manufacturer m LEFT JOIN " . DB_PREFIX . "manufacturer_ext me on m.manufacturer_id = me.manufacturer_id";


        if (!empty($data['filter_name'])) {
            $sql .= " WHERE name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
        }

        $sort_data = array(
            'name',
            'sort_order'
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY name";
        }

        if (isset($data['order']) && ($data['order'] == 'DESC')) {
            $sql .= " DESC";
        } else {
            $sql .= " ASC";
        }

        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        }

        $query = $this->db->query($sql);

        return $query->rows;
    }

    public function getManufacturerStores($manufacturer_id) {
        $manufacturer_store_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "manufacturer_to_store WHERE manufacturer_id = '" . (int)$manufacturer_id . "'");

        foreach ($query->rows as $result) {
            $manufacturer_store_data[] = $result['store_id'];
        }

        return $manufacturer_store_data;
    }

    public function getTotalManufacturers() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "manufacturer");

        return $query->row['total'];
    }

    public function is_attention($manufacturer_id) {
        $query = $this->db->query("SELECT manufacturer_id FROM " . DB_PREFIX . "customer_attention WHERE customer_id = '" . (int)$this->customer->getId() . "'");
        if ($query->row['manufacturer_id']) {
            $data = json_decode($query->row['manufacturer_id'], true);
            if(in_array($manufacturer_id ,$data)){
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
