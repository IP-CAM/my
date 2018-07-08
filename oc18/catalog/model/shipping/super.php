<?php
class ModelShippingSuper extends Model {
	function getQuote($address) {
		$this->load->language('shipping/super');
				
		$quote_data = array();
		
		$shippings = ($this->config->get('super') && is_array($this->config->get('super')))?$this->config->get('super'):array();

		foreach ($shippings as $code) {
			$shipping_status = $this->config->get('super'.$code.'_status');
			
			if ($shipping_status) {
				$geo_zone_id = $this->config->get('super'.$code.'_geo_zone_id');
			
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$geo_zone_id . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");
		
				if (!$geo_zone_id) {
					$status = true;
				} elseif ($query->num_rows) {
					$status = true;
				} else {
					$status = false;
				}
		
				$method_data = array();
		
				if ($status) {
					$cost = 0;
					
					$weight_cost = $this->config->get('super'.$code.'_weight_cost');
					
					if ($weight_cost) {
						$weight = $this->cart->getWeight();
						//$weight += $this->gift->getWeight();
			
						/*$rates = explode(',', $weight_cost);
						$codes = array();
			
						foreach ($rates as $rate) {
							$data = explode(':', $rate);
							
							if (isset($data[1])) {
								$codes[$data[0]] = $data[1];
							}
						}
						
						ksort($codes);
						
						foreach ($codes as $v1 => $v2) {
							if ($weight <= (float)$v1) {
								$cost = (float)$v2;
			
								break;
							}
						}*/
						
						$rates = explode(':', $weight_cost);
						
						$weight_a = (float)$rates[0];
						$cost_a = (float)$rates[1];
						$weight_b = (float)$rates[2];
						$cost_b = (float)$rates[3];
						
						if ($weight <= $weight_a) {
							$cost = $cost_a;
						} else {
							$weight_ext = ($weight - $weight_a) / $weight_b;
							$weight_ext = ceil($weight_ext) * $cost_b;
							
							$cost = $cost_a + $weight_ext;
						}
					}
					
					$price_cost = $this->config->get('super'.$code.'_price_cost');
					
					if ($price_cost) {
						$price = $this->cart->getSubTotal();
						//$price += $this->gift->getSubTotal();
			
						$rates = explode(',', $price_cost);
						$codes = array();
			
						foreach ($rates as $rate) {
							$data = explode(':', $rate);
							
							if (isset($data[1])) {
								$codes[$data[0]] = $data[1];
							}
						}
						
						krsort($codes);
						
						foreach ($codes as $v1 => $v2) {
							if ($price >= (float)$v1) {
								$cost = (float)$v2;
			
								break;
							}
						}
					}
					
					$name = $this->config->get('super'.$code.'_name');
					$descrption = $this->config->get('super'.$code.'_description');
		
					$quote_data['super'.$code] = array(
						'code'         => 'super.super'.$code,
						'title'        => $name?$name[$this->config->get('config_language_id')]:'',
						'description'  => !empty($descrption)?html_entity_decode($descrption[$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8'):'',
						'cost'         => $cost,
						'tax_class_id' => $this->config->get('super'.$code.'_tax_class_id'),
						'text'         => $this->currency->format($this->tax->calculate($cost, $this->config->get('super'.$code.'_tax_class_id'), $this->config->get('config_tax')))
					);
				}
			}
		}
	
		$method_data = array(
			'code'       => 'super',
			'title'      => $this->language->get('text_title'),
			'quote'      => $quote_data,
			'sort_order' => $this->config->get('super_sort_order'),
			'address'    => false,
			'error'      => false
		);

		return $method_data;
	}
}