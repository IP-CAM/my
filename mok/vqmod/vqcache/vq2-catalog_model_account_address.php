<?php
class ModelAccountAddress extends Model {
public function getZonesByCountryId($country_id) {
            $this->load->model('localisation/zone');
            $zones = $this->model_localisation_zone->getZonesByCountryId($country_id);
            $options = array();
            foreach ($zones as $zone) {
                $zone['value'] = $zone['zone_id'];
                unset($zone['zone_id']);
                $options[] = $zone;
            }
            return $options;
        }
/* add city and district */
	public function getCitysByZoneId($zone_id){
		$this->load->model('localisation/city');
            $citys = $this->model_localisation_city->getCitysByZoneId($zone_id);
            $options = array();
            foreach ($citys as $city) {
                $city['value'] = $city['city_id'];
                unset($city['city_id']);
                $options[] = $city;
            }
            return $options;
		
	}
	public function getDistrictsByCityId($city_id){
		$this->load->model('localisation/district');
            $districts = $this->model_localisation_district->getDistrictsByCityId($city_id);
            $options = array();
            foreach ($districts as $district) {
                $district['value'] = $district['district_id'];
                unset($district['district_id']);
                $options[] = $district;
            }
            return $options;
		
	}
	public function addAddress($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "address SET customer_id = '" . (int)$this->customer->getId() . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', company = '" . $this->db->escape($data['company']) . "', address_1 = '" . $this->db->escape($data['address_1']) . "', address_2 = '" . $this->db->escape($data['address_2']) . "', postcode = '" . $this->db->escape($data['postcode']) . "', city = '" . $this->db->escape($data['city']) . "', zone_id = '" . (int)$data['zone_id'] . "', country_id = '" . (int)$data['country_id'] . "', custom_field = '" . $this->db->escape(isset($data['custom_field']) ? json_encode($data['custom_field']) : '') . "'");

		$address_id = $this->db->getLastId();
if(isset($data['district_id']) && isset($data['city_id'])){
                $this->db->query("INSERT INTO " . DB_PREFIX . "address_ext SET address_id = '" . (int)$address_id . "', city_id = '".(int)$data['city_id']."', district_id = '".(int)$data['district_id']."'");
				}
				$total_address = $this->getTotalAddresses();

		if($total_address == 1) {

			$this->db->query("UPDATE " . DB_PREFIX . "customer SET address_id = '" . (int)$address_id . "' WHERE customer_id = '" . (int)$this->customer->getId() . "'");

		}else{

		if (!empty($data['default'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "customer SET address_id = '" . (int)$address_id . "' WHERE customer_id = '" . (int)$this->customer->getId() . "'");
		}

}
		return $address_id;
	}

	public function editAddress($address_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "address SET firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', company = '" . $this->db->escape($data['company']) . "', address_1 = '" . $this->db->escape($data['address_1']) . "', address_2 = '" . $this->db->escape($data['address_2']) . "', postcode = '" . $this->db->escape($data['postcode']) . "', city = '" . $this->db->escape($data['city']) . "', zone_id = '" . (int)$data['zone_id'] . "', country_id = '" . (int)$data['country_id'] . "', custom_field = '" . $this->db->escape(isset($data['custom_field']) ? json_encode($data['custom_field']) : '') . "' WHERE address_id  = '" . (int)$address_id . "' AND customer_id = '" . (int)$this->customer->getId() . "'");

if(isset($data['district_id']) && isset($data['city_id'])){
                $this->db->query("UPDATE " . DB_PREFIX . "address_ext SET city_id = '".(int)$data['city_id']."', district_id = '".(int)$data['district_id']."'");
				}
		if (!empty($data['default'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "customer SET address_id = '" . (int)$address_id . "' WHERE customer_id = '" . (int)$this->customer->getId() . "'");
		}
	}

	public function deleteAddress($address_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "address WHERE address_id = '" . (int)$address_id . "' AND customer_id = '" . (int)$this->customer->getId() . "'");
$this->db->query("DELETE FROM " . DB_PREFIX . "address_ext WHERE address_id = '" . (int)$address_id . "'");
	}

	public function getAddress($address_id) {
		$address_query = $this->db->query("SELECT a.*,ae.city_id as city_id,ae.district_id as district_id FROM " . DB_PREFIX . "address a LEFT JOIN " . DB_PREFIX . "address_ext ae ON (a.address_id = ae.address_id) WHERE a.address_id = '" . (int)$address_id . "' AND a.customer_id = '" . (int)$this->customer->getId() . "'");

		if ($address_query->num_rows) {
$city_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "city` WHERE city_id = '" . (int)$address_query->row['city_id'] . "'");

			if ($city_query->num_rows) {
				$city = $city_query->row['name'];
				$country_id = $city_query->row['country_id'];
			} else {
				$city = '';
				$country_id = '44';
			}

			$district_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "district` WHERE district_id = '" . (int)$address_query->row['district_id'] . "'");

			if ($district_query->num_rows) {
				$district = $district_query->row['name'];

			} else {
				$district = '';

			}
			$country_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "country` WHERE country_id = '" . (int)$country_id. "'");

			if ($country_query->num_rows) {
				$country = $country_query->row['name'];
				$iso_code_2 = $country_query->row['iso_code_2'];
				$iso_code_3 = $country_query->row['iso_code_3'];
				$address_format = $country_query->row['address_format'];
			} else {
				$country = '';
				$iso_code_2 = '';
				$iso_code_3 = '';
				$address_format = '';
			}

			$zone_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "zone` WHERE zone_id = '" . (int)$address_query->row['zone_id'] . "'");

			if ($zone_query->num_rows) {
				$zone = $zone_query->row['name'];
				$zone_code = $zone_query->row['code'];
			} else {
				$zone = '';
				$zone_code = '';
			}

			$address_data = array(
				'address_id'     => $address_query->row['address_id'],
				'firstname'      => $address_query->row['firstname'],
				'lastname'       => $address_query->row['lastname'],
				'company'        => $address_query->row['company'],
				'address_1'      => $address_query->row['address_1'],
				'address_2'      => $address_query->row['address_2'],
				'postcode'       => $address_query->row['postcode'],
				'city_id'           => $address_query->row['city_id'],
                'city'           => $city,
                'district_id'           => $address_query->row['district_id'],
                 'district'           =>$district,
				'zone_id'        => $address_query->row['zone_id'],
				'zone'           => $zone,
				'zone_code'      => $zone_code,
				'country_id'     => $address_query->row['country_id'],
				'country'        => $country,
				'iso_code_2'     => $iso_code_2,
				'iso_code_3'     => $iso_code_3,
				'address_format' => $address_format,
				'custom_field'   => json_decode($address_query->row['custom_field'], true)
			);

			return $address_data;
		} else {
			return false;
		}
	}

	public function getAddresses() {
		$address_data = array();

		$query = $this->db->query("SELECT a.*,ae.city_id as city_id,ae.district_id as district_id FROM " . DB_PREFIX . "address a LEFT JOIN " . DB_PREFIX . "address_ext ae ON (a.address_id = ae.address_id) WHERE a.customer_id = '" . (int)$this->customer->getId() . "'");

		foreach ($query->rows as $result) {
$city_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "city` WHERE city_id = '" . (int)$result['city_id'] . "'");

			if ($city_query->num_rows) {
				$city = $city_query->row['name'];
				$country_id = $city_query->row['country_id'];
			} else {
				$city = '';
				$country_id = '44';
			}

			$district_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "district` WHERE district_id = '" . (int)$result['district_id'] . "'");

			if ($district_query->num_rows) {
				$district = $district_query->row['name'];

			} else {
				$district = '';

			}
			$country_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "country` WHERE country_id = '" . (int)$result['country_id'] . "'");

			if ($country_query->num_rows) {
				$country = $country_query->row['name'];
				$iso_code_2 = $country_query->row['iso_code_2'];
				$iso_code_3 = $country_query->row['iso_code_3'];
				$address_format = $country_query->row['address_format'];
			} else {
				$country = '';
				$iso_code_2 = '';
				$iso_code_3 = '';
				$address_format = '';
			}

			$zone_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "zone` WHERE zone_id = '" . (int)$result['zone_id'] . "'");

			if ($zone_query->num_rows) {
				$zone = $zone_query->row['name'];
				$zone_code = $zone_query->row['code'];
			} else {
				$zone = '';
				$zone_code = '';
			}

			$address_data[$result['address_id']] = array(
				'address_id'     => $result['address_id'],
				'firstname'      => $result['firstname'],
				'lastname'       => $result['lastname'],
				'company'        => $result['company'],
				'address_1'      => $result['address_1'],
				'address_2'      => $result['address_2'],
				'postcode'       => $result['postcode'],
				'city_id'           => $result['city_id'],
                'city'           => $city,
                'district_id'           => $result['district_id'],
                 'district'           =>$district,
				'zone_id'        => $result['zone_id'],
				'zone'           => $zone,
				'zone_code'      => $zone_code,
				'country_id'     => $result['country_id'],
				'country'        => $country,
				'iso_code_2'     => $iso_code_2,
				'iso_code_3'     => $iso_code_3,
				'address_format' => $address_format,
				'custom_field'   => json_decode($result['custom_field'], true)

			);
		}

		return $address_data;
	}

	public function getTotalAddresses() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "address WHERE customer_id = '" . (int)$this->customer->getId() . "'");

		return $query->row['total'];
	}
}