<?php
class ModelMarketingPricing extends Model {
    public function getInfo($pricing_id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "pricing WHERE pricing_id = '" . (int)$pricing_id . "'");

        return $query->row;
    }

	public function addPricing($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "pricing SET name = '" . $this->db->escape($data['name']) . "', description = '" . $this->db->escape($data['description']) . "', product = '" . (int)$data['pricing_product'] . "', product_description = '" . $this->db->escape($data['product_description']) . "', date_start = '" . $this->db->escape($data['date_start']) . "', date_end = '" . $this->db->escape($data['date_end']) . "', status = '" . (int)$data['status'] . "', show_image='".$data['show_image']."', product_image_description='".$data['product_image_description']."' ,created = NOW()");

		$coupon_id = $this->db->getLastId();

		return $coupon_id;
	}

	public function editPricing($pricing_id, $data) {

        $this->db->query("UPDATE " . DB_PREFIX . "pricing SET name = '" . $this->db->escape($data['name']) . "', description = '" . $this->db->escape($data['description']) . "', product = '" . (int)$data['pricing_product'] . "', product_description = '" . $this->db->escape($data['product_description']) . "', date_start = '" . $this->db->escape($data['date_start']) . "', date_end = '" . $this->db->escape($data['date_end']) . "', status = '" . (int)$data['status'] . "', show_image='".$data['show_image']."', product_image_description='".$data['product_image_description']."' WHERE pricing_id='".(int)$pricing_id."'");

    }

	public function getPricings($data = array()) {
		$sql = "SELECT pricing_id , name, description, product, date_start, date_end, status , created , show_image ,product_image_description FROM " . DB_PREFIX . "pricing";

		$sort_data = array(
		    'pricing_id',
			'created',
			'date_start',
			'date_end',
			'status'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
            $sql .= " ORDER BY pricing_id";
        }

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " DESC";
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

	public function getTotalPricings() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "pricing");

		return $query->row['total'];
	}

    public function deletePricing($pricing_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "pricing WHERE pricing_id = '" . (int)$pricing_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "pricing_customer WHERE pricing_id = '" . (int)$pricing_id . "'");
    }

    public function getTotalCustomerByPricing($pricing_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "pricing_customer WHERE pricing_id='".(int)$pricing_id."'");

        return $query->row['total'];
    }

    public function getCustomersByPricing($data = array()) {
        $sql = "SELECT pc.*,c.firstname  FROM " . DB_PREFIX . "pricing_customer pc LEFT JOIN ". DB_PREFIX ."customer c ON pc.customer_id = c.customer_id WHERE  pc.pricing_id = '" . (int)$data['pricing_id'] . "'";
        $sort_data = array(
            'pricing_customer_id',
            'price',
            'status'
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY pc." . $data['sort'];
        } else {
            $sql .= " ORDER BY pc.status";
        }

        if (isset($data['order']) && ($data['order'] == 'DESC')) {
            $sql .= " DESC";
        } else {
            $sql .= " DESC";
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
}