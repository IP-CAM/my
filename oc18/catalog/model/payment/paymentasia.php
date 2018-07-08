<?php

class ModelPaymentpaymentasia extends Model {

    public function getMethod($address) {
        $this->language->load('payment/paymentasia');

        if ($this->config->get('paymentasia_status')) {
//            $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int) $this->config->get('paymentasia_geo_zone_id') . "' AND country_id = '" . (int) $address['country_id'] . "' AND (zone_id = '" . (int) $address['zone_id'] . "' OR zone_id = '0')");
            $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE country_id = '" . (int) $address['country_id'] . "' AND (zone_id = '" . (int) $address['zone_id'] . "' OR zone_id = '0')");

            if (!$this->config->get('paymentasia_geo_zone_id')) {
                $status = true;
            } elseif ($query->num_rows) {
                $status = true;
            } else {
                $status = false;
            }
        } else {
            $status = false;
        }

        $method_data = array();
	
	
        if ($status) {
            $method_data = array(
                'code'       => 'paymentasia',
//                'title'      => $this->language->get('text_title'),
                'title'      => $this->_getDisplayName(),
                'terms'      => '',
                'sort_order' => $this->config->get('paymentasia_sort_order')
            );
        }

        return $method_data;
    }
	
	private function _getDisplayName() {
		// Language
		$default = 'Credit Card';
		$displayNameSetting	 = $this->config->get('paymentasia_display_name');
		$language_id = $this->config->get('config_language_id');
		if (!$language_id || !isset($displayNameSetting[$language_id])) {
			return $default;
		}
		return $displayNameSetting[$language_id];
	}

}