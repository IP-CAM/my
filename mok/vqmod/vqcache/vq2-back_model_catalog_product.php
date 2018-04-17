<?php
class ModelCatalogProduct extends Model {
	public function checkOtp($product_id) {
	$otp_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "otp_option_value` WHERE product_id = '" . (int)$product_id . "' LIMIT 1");
	return $otp_query->num_rows;
}
public function getOtpOptions($product_id) {
	$otp_data = array();
	$otp_option_data = array();
	$otp_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "otp_option_value` WHERE product_id = '" . (int)$product_id . "' LIMIT 1");
	if ($otp_query->num_rows) {
		$options = $otp_query->row;
		if ($options['parent_option_id'] != 0) { $otp_options[] = $options['parent_option_id']; }
		if ($options['child_option_id'] != 0) { $otp_options[] = $options['child_option_id']; }
		if ($options['grandchild_option_id'] != 0) { $otp_options[] = $options['grandchild_option_id']; }
		$this->load->model('catalog/option');
		foreach ($otp_options as $otp_option_id) {
			$otp_option_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "option` o INNER JOIN `" . DB_PREFIX . "option_description` od ON (o.option_id = od.option_id) WHERE o.option_id = '$otp_option_id' AND od.language_id = '" . (int)$this->config->get('config_language_id') . "' LIMIT 1");
			$otp_option = $otp_option_query->row;
			$option_values = $this->model_catalog_option->getOptionValues($otp_option_id);
			$otp_option_data[] = array(
				'option_id'            => $otp_option_id,
				'name'                 => $otp_option['name'],
				'option_values'        => $option_values
			);
		}
	}
	$otp_option_value_data = array();
	$otp_option_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "otp_option_value ov INNER JOIN " . DB_PREFIX . "otp_data od ON ov.id = od.otp_id WHERE ov.product_id = '" . (int)$product_id . "' ORDER BY ov.id ASC");
	foreach ($otp_option_value_query->rows as $otp_option_value) {
		$otp_option_value_data[] = array(
			'id'                           => $otp_option_value['id'],
			'parent_option_id'             => $otp_option_value['parent_option_id'],
			'child_option_id'              => $otp_option_value['child_option_id'],
			'grandchild_option_id'         => $otp_option_value['grandchild_option_id'],
			'parent_option_value_id'       => $otp_option_value['parent_option_value_id'],
			'child_option_value_id'        => $otp_option_value['child_option_value_id'],
			'grandchild_option_value_id'   => $otp_option_value['grandchild_option_value_id'],
			'model'                        => $otp_option_value['model'],
			'extra'                        => $otp_option_value['extra'],
			'quantity'                     => $otp_option_value['quantity'],
			'subtract'                     => $otp_option_value['subtract'],
			'price_prefix'                 => $otp_option_value['price_prefix'],
			'price'                        => $otp_option_value['price'],
			'special'                      => $otp_option_value['special'],
			'weight_prefix'                => $otp_option_value['weight_prefix'],
			'weight'                       => $otp_option_value['weight'],
		);
	}
	if (!empty($otp_option_data)) {
		$otp_data['otp_option'] = $otp_option_data;
		$otp_data['otp_option_value'] = $otp_option_value_data;
	}
	return $otp_data;
}
public function getSwapOptions($product_id) {
	$otp_option_data = array();
	$otp_options = array();
	$otp_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "otp_option_value` WHERE product_id = '" . (int)$product_id . "' LIMIT 1");
	if ($otp_query->num_rows) {
		$options = $otp_query->row;
		if ($options['parent_option_id'] != 0) { $otp_options[] = $options['parent_option_id']; }
		if ($options['child_option_id'] != 0) { $otp_options[] = $options['child_option_id']; }
		if ($options['grandchild_option_id'] != 0) { $otp_options[] = $options['grandchild_option_id']; }
		foreach ($otp_options as $otp_option_id) {
			$otp_option_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "option` o INNER JOIN `" . DB_PREFIX . "option_description` od ON (o.option_id = od.option_id) WHERE o.option_id = '$otp_option_id' AND od.language_id = '" . (int)$this->config->get('config_language_id') . "' LIMIT 1");
			$otp_option = $otp_option_query->row;
			$otp_option_data[] = array(
				'option_id'            => $otp_option_id,
				'name'                 => $otp_option['name']
			);
		}
	}
	return $otp_option_data;
}
public function getSwapOptionValues($product_id, $option_id) {
	$pquery = $this->db->query("SELECT * FROM `" . DB_PREFIX . "otp_option_value` WHERE product_id = '" . (int)$product_id . "' AND parent_option_id = '" . (int)$option_id . "'");
	if ($pquery->num_rows) {
		$position = "parent";
	}
	else {
		$cquery = $this->db->query("SELECT * FROM `" . DB_PREFIX . "otp_option_value` WHERE product_id = '" . (int)$product_id . "' AND child_option_id = '" . (int)$option_id . "'");
		if ($cquery->num_rows) {
			$position = "child";
		}
		else {
			$position = "grandchild";
		}
	}
	$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "otp_option_value` pov INNER JOIN " . DB_PREFIX . "option_value_description ovd ON (pov.".$position."_option_value_id = ovd.option_value_id) WHERE pov.product_id = '" . (int)$product_id . "' AND pov.".$position."_option_id = '" . (int)$option_id . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY pov.".$position."_option_value_id");
	return $query->rows;
}
public function getImageSwap($product_id) {
	$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "otp_image` sw INNER JOIN " . DB_PREFIX . "option_value_description ovd ON (sw.option_value_id = ovd.option_value_id) WHERE sw.product_id = '" . (int)$product_id . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY sw.sort_order, sw.id ASC");
	return $query->rows;
}
public function getOtpOrderOptions($product_id) {
	$otp_option_data = array();
	$otp_option_list = array();
	$otp_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "otp_option_value` WHERE product_id = '" . (int)$product_id . "' LIMIT 1");
	if ($otp_query->num_rows) {
		$options = $otp_query->row;
		if ($options['parent_option_id'] != 0) { $otp_options[] = $options['parent_option_id']; }
		if ($options['child_option_id'] != 0) { $otp_options[] = $options['child_option_id']; }
		if ($options['grandchild_option_id'] != 0) { $otp_options[] = $options['grandchild_option_id']; }
		foreach ($otp_options as $otp_option_id) {
			$otp_option_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "option` o INNER JOIN `" . DB_PREFIX . "option_description` od ON (o.option_id = od.option_id) WHERE o.option_id = '$otp_option_id' AND od.language_id = '" . (int)$this->config->get('config_language_id') . "' LIMIT 1");
			$otp_option = $otp_option_query->row;
			$otp_option_list[] = array(
				'option_id'            => $otp_option_id,
				'name'                 => $otp_option['name'],
				'type'                 => $otp_option['type']
			);
		}
	}
	$otpcount = 0;
	foreach ($otp_option_list as $otp_option) {
		$otp_option_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "option_value ov LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON (ov.option_value_id = ovd.option_value_id) WHERE ov.option_id = '" . (int)$otp_option['option_id'] . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY ov.sort_order ASC");
		$otp_option_value_data = array();
		if ($otpcount == 0) {
			$otp_option_value_list_query = $this->db->query("SELECT parent_option_value_id FROM " . DB_PREFIX . "otp_option_value WHERE parent_option_id = '" . (int)$otp_option['option_id'] . "' AND product_id = '" . (int)$product_id . "'");
			$otp_option_value_list = array();
			foreach ($otp_option_value_list_query->rows as $otp_option_available_value) {
				$otp_option_value_list[] = $otp_option_available_value['parent_option_value_id'];
			}
			foreach ($otp_option_value_query->rows as $otp_option_value) {
				if (in_array($otp_option_value['option_value_id'], $otp_option_value_list)) {
					$otp_option_value_data[] = array(
					'option_value_id' => $otp_option_value['option_value_id'],
					'name'            => $otp_option_value['name'],
					'image'           => $otp_option_value['image'],
					'sort_order'      => $otp_option_value['sort_order']
					);
				}
			}
		}
		else {
			$otp_option_value_data = '';
		}
    	$otp_option_data[] = array(
			'option_id'            => $otp_option['option_id'],
			'name'                 => $otp_option['name'],
			'type'                 => $otp_option['type'],
			'option_value'         => $otp_option_value_data,
			'required'             => '1'
		);
		$otpcount++;
	}
	return $otp_option_data;
}
public function getOtpChildValues($product_id, $child_option_id, $parent_option_value_id) {
	$otp_child_query = $this->db->query("SELECT child_option_value_id FROM `" . DB_PREFIX . "otp_option_value` WHERE product_id = '" . (int)$product_id . "' AND parent_option_value_id = '" . (int)$parent_option_value_id . "'");
	foreach ($otp_child_query->rows as $child_value) {
		$otp_child_value_list[] = $child_value['child_option_value_id'];
	}
	$otp_option_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "option_value ov LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON (ov.option_value_id = ovd.option_value_id) WHERE ov.option_id = '" . (int)$child_option_id . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY ov.sort_order ASC");
	$child_values = '<option value="">'.$this->language->get('text_select').'</option>';
	foreach ($otp_option_value_query->rows as $otp_option_value) {
		if (in_array($otp_option_value['option_value_id'], $otp_child_value_list)) {
			$child_values .= '<option value="'.$otp_option_value['option_value_id'].'">'.$otp_option_value['name'].'</option>';
		}
	}
	return $child_values;
}
public function getOtpGrandchildValues($product_id, $grandchild_option_id, $parent_option_value_id, $child_option_value_id) {
	$otp_grandchild_query = $this->db->query("SELECT grandchild_option_value_id FROM `" . DB_PREFIX . "otp_option_value` WHERE product_id = '" . (int)$product_id . "' AND parent_option_value_id = '" . (int)$parent_option_value_id . "' AND child_option_value_id = '" . (int)$child_option_value_id . "'");
	foreach ($otp_grandchild_query->rows as $grandchild_value) {
		$otp_grandchild_value_list[] = $grandchild_value['grandchild_option_value_id'];
	}
	$otp_option_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "option_value ov LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON (ov.option_value_id = ovd.option_value_id) WHERE ov.option_id = '" . (int)$grandchild_option_id . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY ov.sort_order ASC");
	$grandchild_values = '<option value="">'.$this->language->get('text_select').'</option>';
	foreach ($otp_option_value_query->rows as $otp_option_value) {
		if (in_array($otp_option_value['option_value_id'], $otp_grandchild_value_list)) {
			$grandchild_values .= '<option value="'.$otp_option_value['option_value_id'].'">'.$otp_option_value['name'].'</option>';
		}
	}
	return $grandchild_values;
}
public function getOtp($product_id, $parent_option_value_id, $child_option_value_id, $grandchild_option_value_id) {
	$otp_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "otp_option_value` ov INNER JOIN `" . DB_PREFIX . "otp_data` od ON ov.id = od.otp_id WHERE ov.product_id = '" . (int)$product_id . "' AND ov.parent_option_value_id = '" . (int)$parent_option_value_id . "' AND ov.child_option_value_id = '" . (int)$child_option_value_id . "' AND ov.grandchild_option_value_id = '" . (int)$grandchild_option_value_id . "' LIMIT 1");
	$otp = $otp_query->rows;
	if (!empty($otp)) {
		return $otp[0]['id'];
	}
	else {
		return false;
	}
}
public function getStartingFrom($product_id) {
	$price_list = array();
	$query_otp = $this->db->query("SELECT `price_prefix`, `price`, `special` FROM `" . DB_PREFIX . "otp_data` WHERE `product_id` = '" . (int)$product_id . "' AND (`price` > 0 OR `special` > 0)");
	if ($query_otp->num_rows) {
		$price = $this->db->query("SELECT `price` FROM `" . DB_PREFIX . "product` WHERE `product_id` = '" . (int)$product_id . "'")->row['price'];
		$query = $this->db->query("SELECT `price` FROM `" . DB_PREFIX . "product_special` WHERE `product_id` = '" . (int)$product_id . "' AND `customer_group_id` = '" . (int)$this->config->get('config_customer_group_id') . "' AND ((`date_start` = '0000-00-00' OR `date_start` < NOW()) AND (`date_end` = '0000-00-00' OR `date_end` > NOW())) AND `price` > 0 ORDER BY `priority` ASC, `price` ASC LIMIT 1");
		if ($query->num_rows) {
			$price = $query->row['price'];
		}
		foreach ($query_otp->rows as $combination) {
			if ($combination['price'] > 0) {
				if ($combination['price_prefix'] == '=') {
					$price_list[] = $combination['price'];
				}
				else {
					if ($combination['price_prefix'] == '+') {
						$price_list[] = $price + $combination['price'];
					}
					else {
						$price_list[] = $price - $combination['price'];
					}
				}
			}
			if ($combination['special'] > 0) {
				$price_list[] = $combination['special'];
			}
		}
	}
	if (count($price_list)) {
		return min($price_list);
	}
	else {
		return false;
	}
}
public function getOtpCategories() {
	$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id) WHERE cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "'  AND c.status = '1' ORDER BY c.sort_order, LCASE(cd.name)");
	return $query->rows;
}
public function updateOtp($filename) {
	$sep = $this->config->get('config_otp_csv');
	$result = '';
	if (($csv = fopen(DIR_CACHE . $filename, "r")) !== FALSE) {
		$headers = fgetcsv($csv, 1000, $sep);
		$previous = 0;
		while (($data = fgetcsv($csv, 1000, $sep)) !== FALSE) {
			if ($data[0] != $previous) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "otp_option_value WHERE product_id = '" . (int)$data[0] . "'");
				$this->db->query("DELETE FROM " . DB_PREFIX . "otp_data WHERE product_id = '" . (int)$data[0]. "'");
			}
			$this->db->query("INSERT INTO " . DB_PREFIX . "otp_option_value SET product_id = '$data[0]', parent_option_id = '$data[2]', child_option_id = '$data[6]', grandchild_option_id = '$data[10]', parent_option_value_id = '$data[4]', child_option_value_id = '$data[8]', grandchild_option_value_id = '$data[12]'");
			$otp_id = $this->db->getLastId();
			$subtract = ($data[17] == 'yes'?'1':0);
			$this->db->query("INSERT INTO " . DB_PREFIX . "otp_data SET otp_id = '$otp_id', product_id = '$data[0]', model = '$data[14]', extra = '$data[15]', quantity = '$data[16]', subtract = '$subtract', price_prefix = '$data[18]', price = '$data[19]', special = '$data[20]', weight_prefix = '$data[21]', weight = '$data[22]'");
			$previous = $data[0];
		}
		fclose($csv);
		$result = "Your option combinations were succesfully updated!";
	}
	else {
		$result = "There was an error reading your CSV file!\n\nYour option combinations were not modified in any way.";
	}
	unlink(DIR_CACHE . $filename);
	return $result;
}
public function exportOtp($category_id) {
	if ($category_id == '0') {
		$query = $this->db->query("SELECT pd.name AS product_name, pod.name AS parent_option_name, cod.name AS child_option_name, god.name AS grandchild_option_name, povd.name AS parent_option_value_name, covd.name AS child_option_value_name, govd.name AS grandchild_option_value_name, otp.*, otpd.* FROM " . DB_PREFIX . "otp_option_value otp INNER JOIN " . DB_PREFIX . "otp_data otpd ON otp.id = otpd.otp_id INNER JOIN " . DB_PREFIX . "product_description pd ON otp.product_id = pd.product_id LEFT JOIN " . DB_PREFIX . "option_description pod ON otp.parent_option_id = pod.option_id LEFT JOIN " . DB_PREFIX . "option_value_description povd ON otp.parent_option_value_id = povd.option_value_id LEFT JOIN " . DB_PREFIX . "option_description cod ON otp.child_option_id = cod.option_id AND cod.language_id = '" . (int)$this->config->get('config_language_id') . "' LEFT JOIN " . DB_PREFIX . "option_value_description covd ON otp.child_option_value_id = covd.option_value_id AND covd.language_id = '" . (int)$this->config->get('config_language_id') . "' LEFT JOIN " . DB_PREFIX . "option_description god ON otp. grandchild_option_id = god.option_id AND god.language_id = '" . (int)$this->config->get('config_language_id') . "' LEFT JOIN " . DB_PREFIX . "option_value_description govd ON otp.grandchild_option_value_id = govd.option_value_id AND govd.language_id = '" . (int)$this->config->get('config_language_id') . "' WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND pod.language_id = '" . (int)$this->config->get('config_language_id') . "' AND povd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY pd.product_id, povd.option_value_id, covd.option_value_id, govd.option_value_id");
	}
	else {
		$query = $this->db->query("SELECT pd.name AS product_name, pod.name AS parent_option_name, cod.name AS child_option_name, god.name AS grandchild_option_name, povd.name AS parent_option_value_name, covd.name AS child_option_value_name, govd.name AS grandchild_option_value_name, otp.*, otpd.* FROM " . DB_PREFIX . "otp_option_value otp INNER JOIN " . DB_PREFIX . "otp_data otpd ON otp.id = otpd.otp_id INNER JOIN " . DB_PREFIX . "product_description pd ON otp.product_id = pd.product_id INNER JOIN " . DB_PREFIX . "product_to_category cat ON pd.product_id = cat.product_id LEFT JOIN " . DB_PREFIX . "option_description pod ON otp.parent_option_id = pod.option_id LEFT JOIN " . DB_PREFIX . "option_value_description povd ON otp.parent_option_value_id = povd.option_value_id LEFT JOIN " . DB_PREFIX . "option_description cod ON otp.child_option_id = cod.option_id AND cod.language_id = '" . (int)$this->config->get('config_language_id') . "' LEFT JOIN " . DB_PREFIX . "option_value_description covd ON otp.child_option_value_id = covd.option_value_id AND covd.language_id = '" . (int)$this->config->get('config_language_id') . "' LEFT JOIN " . DB_PREFIX . "option_description god ON otp. grandchild_option_id = god.option_id AND god.language_id = '" . (int)$this->config->get('config_language_id') . "' LEFT JOIN " . DB_PREFIX . "option_value_description govd ON otp.grandchild_option_value_id = govd.option_value_id AND govd.language_id = '" . (int)$this->config->get('config_language_id') . "' WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND pod.language_id = '" . (int)$this->config->get('config_language_id') . "' AND povd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND cat.category_id = '$category_id' ORDER BY pd.product_id, povd.option_value_id, covd.option_value_id, govd.option_value_id");
	}
	return $query->rows;
}
public function updateOtpImg($filename) {
	$sep = $this->config->get('config_otp_csv');
	$result = '';
	if (($csv = fopen(DIR_CACHE . $filename, "r")) !== FALSE) {
		$headers = fgetcsv($csv, 1000, $sep);
		$previous = 0;
		while (($data = fgetcsv($csv, 1000, $sep)) !== FALSE) {
			if ($data[0] != $previous) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "otp_image WHERE product_id = '" . (int)$data[0] . "'");
			}
			$this->db->query("INSERT INTO " . DB_PREFIX . "otp_image SET product_id = '$data[0]', option_id = '$data[2]', option_value_id = '$data[4]', image = '$data[6]', sort_order = '$data[7]'");
			$previous = $data[0];
		}
		fclose($csv);
		$result = "Your option images were succesfully updated!";
	}
	else {
		$result = "There was an error reading your CSV file!\n\nYour option images were not modified in any way.";
	}
	unlink(DIR_CACHE . $filename);
	return $result;
}
public function exportOtpImg($category_id) {
	if ($category_id == '0') {
		$query = $this->db->query("SELECT pd.name AS product_name, od.name AS option_name, ovd.name AS option_value_name, otp.* FROM " . DB_PREFIX . "otp_image otp INNER JOIN " . DB_PREFIX . "product_description pd ON otp.product_id = pd.product_id LEFT JOIN " . DB_PREFIX . "option_description od ON otp.option_id = od.option_id LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON otp.option_value_id = ovd.option_value_id WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND od.language_id = '" . (int)$this->config->get('config_language_id') . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY pd.product_id, od.option_id, ovd.option_value_id, otp.id");
	}
	else {
		$query = $this->db->query("SELECT pd.name AS product_name, od.name AS option_name, ovd.name AS option_value_name, otp.* FROM " . DB_PREFIX . "otp_image otp INNER JOIN " . DB_PREFIX . "product_description pd ON otp.product_id = pd.product_id INNER JOIN " . DB_PREFIX . "product_to_category cat ON pd.product_id = cat.product_id LEFT JOIN " . DB_PREFIX . "option_description od ON otp.option_id = od.option_id LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON otp.option_value_id = ovd.option_value_id WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND od.language_id = '" . (int)$this->config->get('config_language_id') . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND cat.category_id = '$category_id' ORDER BY pd.product_id, od.option_id, ovd.option_value_id, otp.id");
	}
	return $query->rows;
}
public function updateOtpModel($filename) {
	$sep = $this->config->get('config_otp_csv');
	$result = '';
	if (($csv = fopen(DIR_CACHE . $filename, "r")) !== FALSE) {
		$headers = fgetcsv($csv, 1000, $sep);
		$previous = 0;
		while (($data = fgetcsv($csv, 1000, $sep)) !== FALSE) {
			$subtract = ($data[3] == 'yes'?1:0);
			$this->db->query("UPDATE " . DB_PREFIX . "otp_data SET extra = '$data[1]', quantity = '$data[2]', subtract = '$subtract', price_prefix = '$data[4]', price = '$data[5]', special = '$data[6]', weight_prefix = '$data[7]', weight = '$data[8]' WHERE model = '$data[0]' LIMIT 1");
		}
		fclose($csv);
		$result = "Your option combinations were succesfully updated!";
	}
	else {
		$result = "There was an error reading your CSV file!\n\nYour option combinations were not modified in any way.";
	}
	unlink(DIR_CACHE . $filename);
	return $result;
}
public function exportOtpModel($category_id) {
	if ($category_id == '0') {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "otp_data");
	}
	else {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "otp_data otp INNER JOIN " . DB_PREFIX . "product_to_category cat ON otp.product_id = cat.product_id WHERE cat.category_id = '$category_id'");
	}
	return $query->rows;
}
public function addProduct($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "product SET model = '" . $this->db->escape($data['model']) . "', sku = '" . $this->db->escape($data['sku']) . "', upc = '" . $this->db->escape($data['upc']) . "', ean = '" . $this->db->escape($data['ean']) . "', jan = '" . $this->db->escape($data['jan']) . "', isbn = '" . $this->db->escape($data['isbn']) . "', mpn = '" . $this->db->escape($data['mpn']) . "', location = '" . $this->db->escape($data['location']) . "', quantity = '" . (int)$data['quantity'] . "', minimum = '" . (int)$data['minimum'] . "', subtract = '" . (int)$data['subtract'] . "', stock_status_id = '" . (int)$data['stock_status_id'] . "', date_available = '" . $this->db->escape($data['date_available']) . "', manufacturer_id = '" . (int)$data['manufacturer_id'] . "', shipping = '" . (int)$data['shipping'] . "', price = '" . (float)$data['price'] . "', points = '" . (int)$data['points'] . "', weight = '" . (float)$data['weight'] . "', weight_class_id = '" . (int)$data['weight_class_id'] . "', length = '" . (float)$data['length'] . "', width = '" . (float)$data['width'] . "', height = '" . (float)$data['height'] . "', length_class_id = '" . (int)$data['length_class_id'] . "', status = '" . (int)$data['status'] . "', tax_class_id = '" . (int)$data['tax_class_id'] . "', sort_order = '" . (int)$data['sort_order'] . "', date_added = NOW()");

		$product_id = $this->db->getLastId();

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "product SET image = '" . $this->db->escape($data['image']) . "' WHERE product_id = '" . (int)$product_id . "'");
		}

		foreach ($data['product_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "product_description SET product_id = '" . (int)$product_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', tag = '" . $this->db->escape($value['tag']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		if (isset($data['product_store'])) {
			foreach ($data['product_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_store SET product_id = '" . (int)$product_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		if (isset($data['product_attribute'])) {
			foreach ($data['product_attribute'] as $product_attribute) {
				if ($product_attribute['attribute_id']) {
					// Removes duplicates
					$this->db->query("DELETE FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$product_id . "' AND attribute_id = '" . (int)$product_attribute['attribute_id'] . "'");

					foreach ($product_attribute['product_attribute_description'] as $language_id => $product_attribute_description) {
						$this->db->query("DELETE FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$product_id . "' AND attribute_id = '" . (int)$product_attribute['attribute_id'] . "' AND language_id = '" . (int)$language_id . "'");

						$this->db->query("INSERT INTO " . DB_PREFIX . "product_attribute SET product_id = '" . (int)$product_id . "', attribute_id = '" . (int)$product_attribute['attribute_id'] . "', language_id = '" . (int)$language_id . "', text = '" .  $this->db->escape($product_attribute_description['text']) . "'");
					}
				}
			}
		}

		if (isset($data['otp_options']) && !empty($data['otp_options']['otp_option_value'])) {
	$otp_list = '';
	foreach ($data['otp_options']['otp_option_value'] as $option_value) {
		if (isset($option_value['otp']) && $option_value['otp'] != '') {
			$otp_list .= $option_value['otp'].",";
		}
	}
	if ($otp_list != '') {
		$otp_list = substr($otp_list, 0, -1);
		$this->db->query("DELETE FROM " . DB_PREFIX . "otp_option_value WHERE product_id = '" . (int)$product_id . "' AND `id` NOT IN ($otp_list)");
		$this->db->query("DELETE FROM " . DB_PREFIX . "otp_data WHERE product_id = '" . (int)$product_id . "' AND otp_id NOT IN ($otp_list)");
	}
	else {
		$this->db->query("DELETE FROM " . DB_PREFIX . "otp_option_value WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "otp_data WHERE product_id = '" . (int)$product_id . "'");
	}
	foreach ($data['otp_options']['otp_option_value'] as $option_value) {
		if (isset($option_value['otp']) && $option_value['otp'] != '') {
			$otp = $option_value['otp'];
			$this->db->query("UPDATE " . DB_PREFIX . "otp_option_value SET parent_option_id = '" . (int)$option_value['parent_option_id'] . "', child_option_id = '" . (int)$option_value['child_option_id'] . "', grandchild_option_id = '" . (int)$option_value['grandchild_option_id'] . "', parent_option_value_id = '" . (int)$option_value['parent_option_value_id'] . "', child_option_value_id = '" . (int)$option_value['child_option_value_id'] . "', grandchild_option_value_id = '" . (int)$option_value['grandchild_option_value_id'] . "' WHERE `id` = '$otp' LIMIT 1");
			$this->db->query("UPDATE " . DB_PREFIX . "otp_data SET model = '" . $option_value['model'] . "', extra = '" . $option_value['extra'] . "', quantity = '" . (int)$option_value['quantity'] . "', subtract = '" . (int)$option_value['subtract'] . "', price_prefix = '" . $option_value['price_prefix'] . "', price = '" . $option_value['price'] . "', special = '" . $option_value['special'] . "', weight_prefix = '" . $option_value['weight_prefix'] . "', weight = '" . $option_value['weight'] . "' WHERE otp_id = '$otp' LIMIT 1");
		}
		else {
			$this->db->query("INSERT INTO " . DB_PREFIX . "otp_option_value SET product_id = '" . (int)$product_id . "', parent_option_id = '" . (int)$option_value['parent_option_id'] . "', child_option_id = '" . (int)$option_value['child_option_id'] . "', grandchild_option_id = '" . (int)$option_value['grandchild_option_id'] . "', parent_option_value_id = '" . (int)$option_value['parent_option_value_id'] . "', child_option_value_id = '" . (int)$option_value['child_option_value_id'] . "', grandchild_option_value_id = '" . (int)$option_value['grandchild_option_value_id'] . "'");
			$otp_id = $this->db->getLastId();
			$this->db->query("INSERT INTO " . DB_PREFIX . "otp_data SET otp_id = '$otp_id', product_id = '" . (int)$product_id . "', model = '" . $option_value['model'] . "', extra = '" . $option_value['extra'] . "', quantity = '" . (int)$option_value['quantity'] . "', subtract = '" . (int)$option_value['subtract'] . "', price_prefix = '" . $option_value['price_prefix'] . "', price = '" . $option_value['price'] . "', special = '" . $option_value['special'] . "', weight_prefix = '" . $option_value['weight_prefix'] . "', weight = '" . $option_value['weight'] . "'");
		}
	}
	if (isset($data['image_swap'])) {
		$swap_list = '';
		foreach ($data['image_swap'] as $key => $swap) {
			if ($swap['id'] != '' && $swap['image'] != '') {
				$swap_list .= $swap['id'].",";
			}
		}
		if ($swap_list != '') {
			$swap_list = substr($swap_list, 0, -1);
			$this->db->query("DELETE FROM " . DB_PREFIX . "otp_image WHERE product_id = '" . (int)$product_id . "' AND `id` NOT IN ($swap_list)");
		}
		else {
			$this->db->query("DELETE FROM " . DB_PREFIX . "otp_image WHERE product_id = '" . (int)$product_id . "'");
		}
		foreach ($data['image_swap'] as $key => $swap) {
			if ($swap['id'] != '' && $swap['image'] != '' && !isset($data['otp_copy'])) {
				$swap_id = $swap['id'];
				$this->db->query("UPDATE " . DB_PREFIX . "otp_image SET product_id = '" . (int)$product_id . "', option_id = '" . (int)$swap['option_id'] . "', option_value_id = '" . (int)$swap['option_value_id'] . "', image = '" . $swap['image'] . "', sort_order = '" . (int)$swap['sort_order'] . "' WHERE `id` = '$swap_id' LIMIT 1");
			}
			elseif ($swap['image'] != '') {
				$this->db->query("INSERT INTO " . DB_PREFIX . "otp_image SET product_id = '" . (int)$product_id . "', option_id = '" . (int)$swap['option_id'] . "', option_value_id = '" . (int)$swap['option_value_id'] . "', image = '" . $swap['image'] . "', sort_order = '" . (int)$swap['sort_order'] . "'");
			}
		}
	}
	else {
		$this->db->query("DELETE FROM " . DB_PREFIX . "otp_image WHERE product_id = '" . (int)$product_id . "'");
	}
}
else {
	$this->db->query("DELETE FROM " . DB_PREFIX . "otp_option_value WHERE product_id = '" . (int)$product_id . "'");
	$this->db->query("DELETE FROM " . DB_PREFIX . "otp_data WHERE product_id = '" . (int)$product_id . "'");
	$this->db->query("DELETE FROM " . DB_PREFIX . "otp_image WHERE product_id = '" . (int)$product_id . "'");
}
if (isset($data['product_option'])) {
			foreach ($data['product_option'] as $product_option) {
				if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
					if (isset($product_option['product_option_value'])) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET product_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', required = '" . (int)$product_option['required'] . "'");

						$product_option_id = $this->db->getLastId();

						foreach ($product_option['product_option_value'] as $product_option_value) {
							$this->db->query("INSERT INTO " . DB_PREFIX . "product_option_value SET product_option_id = '" . (int)$product_option_id . "', product_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', option_value_id = '" . (int)$product_option_value['option_value_id'] . "', quantity = '" . (int)$product_option_value['quantity'] . "', subtract = '" . (int)$product_option_value['subtract'] . "', price = '" . (float)$product_option_value['price'] . "', price_prefix = '" . $this->db->escape($product_option_value['price_prefix']) . "', points = '" . (int)$product_option_value['points'] . "', points_prefix = '" . $this->db->escape($product_option_value['points_prefix']) . "', weight = '" . (float)$product_option_value['weight'] . "', weight_prefix = '" . $this->db->escape($product_option_value['weight_prefix']) . "'");
						}
					}
				} else {
					$this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET product_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', value = '" . $this->db->escape($product_option['value']) . "', required = '" . (int)$product_option['required'] . "'");
				}
			}
		}

		if (isset($data['product_discount'])) {
			foreach ($data['product_discount'] as $product_discount) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_discount SET product_id = '" . (int)$product_id . "', customer_group_id = '" . (int)$product_discount['customer_group_id'] . "', quantity = '" . (int)$product_discount['quantity'] . "', priority = '" . (int)$product_discount['priority'] . "', price = '" . (float)$product_discount['price'] . "', date_start = '" . $this->db->escape($product_discount['date_start']) . "', date_end = '" . $this->db->escape($product_discount['date_end']) . "'");
			}
		}

		if (isset($data['product_special'])) {
			foreach ($data['product_special'] as $product_special) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_special SET product_id = '" . (int)$product_id . "', customer_group_id = '" . (int)$product_special['customer_group_id'] . "', priority = '" . (int)$product_special['priority'] . "', price = '" . (float)$product_special['price'] . "', date_start = '" . $this->db->escape($product_special['date_start']) . "', date_end = '" . $this->db->escape($product_special['date_end']) . "'");
			}
		}

		if (isset($data['product_image'])) {
			foreach ($data['product_image'] as $product_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_image SET product_id = '" . (int)$product_id . "', image = '" . $this->db->escape($product_image['image']) . "', sort_order = '" . (int)$product_image['sort_order'] . "'");
			}
		}

		if (isset($data['product_download'])) {
			foreach ($data['product_download'] as $download_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_download SET product_id = '" . (int)$product_id . "', download_id = '" . (int)$download_id . "'");
			}
		}

		if (isset($data['product_category'])) {
			foreach ($data['product_category'] as $category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET product_id = '" . (int)$product_id . "', category_id = '" . (int)$category_id . "'");
			}
		}

		if (isset($data['product_filter'])) {
			foreach ($data['product_filter'] as $filter_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_filter SET product_id = '" . (int)$product_id . "', filter_id = '" . (int)$filter_id . "'");
			}
		}

		if (isset($data['product_related'])) {
			foreach ($data['product_related'] as $related_id) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$product_id . "' AND related_id = '" . (int)$related_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_related SET product_id = '" . (int)$product_id . "', related_id = '" . (int)$related_id . "'");
				$this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$related_id . "' AND related_id = '" . (int)$product_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_related SET product_id = '" . (int)$related_id . "', related_id = '" . (int)$product_id . "'");
			}
		}

		if (isset($data['product_reward'])) {
			foreach ($data['product_reward'] as $customer_group_id => $product_reward) {
				if ((int)$product_reward['points'] > 0) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "product_reward SET product_id = '" . (int)$product_id . "', customer_group_id = '" . (int)$customer_group_id . "', points = '" . (int)$product_reward['points'] . "'");
				}
			}
		}

		if (isset($data['product_layout'])) {
			foreach ($data['product_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_layout SET product_id = '" . (int)$product_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}

		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'product_id=" . (int)$product_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		if (isset($data['product_recurring'])) {
			foreach ($data['product_recurring'] as $recurring) {
				$this->db->query("INSERT INTO `" . DB_PREFIX . "product_recurring` SET `product_id` = " . (int)$product_id . ", customer_group_id = " . (int)$recurring['customer_group_id'] . ", `recurring_id` = " . (int)$recurring['recurring_id']);
			}
		}

		$this->cache->delete('product');

		return $product_id;
	}

	public function editProduct($product_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "product SET model = '" . $this->db->escape($data['model']) . "', sku = '" . $this->db->escape($data['sku']) . "', upc = '" . $this->db->escape($data['upc']) . "', ean = '" . $this->db->escape($data['ean']) . "', jan = '" . $this->db->escape($data['jan']) . "', isbn = '" . $this->db->escape($data['isbn']) . "', mpn = '" . $this->db->escape($data['mpn']) . "', location = '" . $this->db->escape($data['location']) . "', quantity = '" . (int)$data['quantity'] . "', minimum = '" . (int)$data['minimum'] . "', subtract = '" . (int)$data['subtract'] . "', stock_status_id = '" . (int)$data['stock_status_id'] . "', date_available = '" . $this->db->escape($data['date_available']) . "', manufacturer_id = '" . (int)$data['manufacturer_id'] . "', shipping = '" . (int)$data['shipping'] . "', price = '" . (float)$data['price'] . "', points = '" . (int)$data['points'] . "', weight = '" . (float)$data['weight'] . "', weight_class_id = '" . (int)$data['weight_class_id'] . "', length = '" . (float)$data['length'] . "', width = '" . (float)$data['width'] . "', height = '" . (float)$data['height'] . "', length_class_id = '" . (int)$data['length_class_id'] . "', status = '" . (int)$data['status'] . "', tax_class_id = '" . (int)$data['tax_class_id'] . "', sort_order = '" . (int)$data['sort_order'] . "', date_modified = NOW() WHERE product_id = '" . (int)$product_id . "'");

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "product SET image = '" . $this->db->escape($data['image']) . "' WHERE product_id = '" . (int)$product_id . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "product_description WHERE product_id = '" . (int)$product_id . "'");

		foreach ($data['product_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "product_description SET product_id = '" . (int)$product_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', tag = '" . $this->db->escape($value['tag']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_store WHERE product_id = '" . (int)$product_id . "'");

		if (isset($data['product_store'])) {
			foreach ($data['product_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_store SET product_id = '" . (int)$product_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$product_id . "'");

		if (!empty($data['product_attribute'])) {
			foreach ($data['product_attribute'] as $product_attribute) {
				if ($product_attribute['attribute_id']) {
					// Removes duplicates
					$this->db->query("DELETE FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$product_id . "' AND attribute_id = '" . (int)$product_attribute['attribute_id'] . "'");

					foreach ($product_attribute['product_attribute_description'] as $language_id => $product_attribute_description) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "product_attribute SET product_id = '" . (int)$product_id . "', attribute_id = '" . (int)$product_attribute['attribute_id'] . "', language_id = '" . (int)$language_id . "', text = '" .  $this->db->escape($product_attribute_description['text']) . "'");
					}
				}
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "product_option WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_option_value WHERE product_id = '" . (int)$product_id . "'");

		if (isset($data['otp_options']) && !empty($data['otp_options']['otp_option_value'])) {
	$otp_list = '';
	foreach ($data['otp_options']['otp_option_value'] as $option_value) {
		if (isset($option_value['otp']) && $option_value['otp'] != '') {
			$otp_list .= $option_value['otp'].",";
		}
	}
	if ($otp_list != '') {
		$otp_list = substr($otp_list, 0, -1);
		$this->db->query("DELETE FROM " . DB_PREFIX . "otp_option_value WHERE product_id = '" . (int)$product_id . "' AND `id` NOT IN ($otp_list)");
		$this->db->query("DELETE FROM " . DB_PREFIX . "otp_data WHERE product_id = '" . (int)$product_id . "' AND otp_id NOT IN ($otp_list)");
	}
	else {
		$this->db->query("DELETE FROM " . DB_PREFIX . "otp_option_value WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "otp_data WHERE product_id = '" . (int)$product_id . "'");
	}
	foreach ($data['otp_options']['otp_option_value'] as $option_value) {
		if (isset($option_value['otp']) && $option_value['otp'] != '') {
			$otp = $option_value['otp'];
			$this->db->query("UPDATE " . DB_PREFIX . "otp_option_value SET parent_option_id = '" . (int)$option_value['parent_option_id'] . "', child_option_id = '" . (int)$option_value['child_option_id'] . "', grandchild_option_id = '" . (int)$option_value['grandchild_option_id'] . "', parent_option_value_id = '" . (int)$option_value['parent_option_value_id'] . "', child_option_value_id = '" . (int)$option_value['child_option_value_id'] . "', grandchild_option_value_id = '" . (int)$option_value['grandchild_option_value_id'] . "' WHERE `id` = '$otp' LIMIT 1");
			$this->db->query("UPDATE " . DB_PREFIX . "otp_data SET model = '" . $option_value['model'] . "', extra = '" . $option_value['extra'] . "', quantity = '" . (int)$option_value['quantity'] . "', subtract = '" . (int)$option_value['subtract'] . "', price_prefix = '" . $option_value['price_prefix'] . "', price = '" . $option_value['price'] . "', special = '" . $option_value['special'] . "', weight_prefix = '" . $option_value['weight_prefix'] . "', weight = '" . $option_value['weight'] . "' WHERE otp_id = '$otp' LIMIT 1");
		}
		else {
			$this->db->query("INSERT INTO " . DB_PREFIX . "otp_option_value SET product_id = '" . (int)$product_id . "', parent_option_id = '" . (int)$option_value['parent_option_id'] . "', child_option_id = '" . (int)$option_value['child_option_id'] . "', grandchild_option_id = '" . (int)$option_value['grandchild_option_id'] . "', parent_option_value_id = '" . (int)$option_value['parent_option_value_id'] . "', child_option_value_id = '" . (int)$option_value['child_option_value_id'] . "', grandchild_option_value_id = '" . (int)$option_value['grandchild_option_value_id'] . "'");
			$otp_id = $this->db->getLastId();
			$this->db->query("INSERT INTO " . DB_PREFIX . "otp_data SET otp_id = '$otp_id', product_id = '" . (int)$product_id . "', model = '" . $option_value['model'] . "', extra = '" . $option_value['extra'] . "', quantity = '" . (int)$option_value['quantity'] . "', subtract = '" . (int)$option_value['subtract'] . "', price_prefix = '" . $option_value['price_prefix'] . "', price = '" . $option_value['price'] . "', special = '" . $option_value['special'] . "', weight_prefix = '" . $option_value['weight_prefix'] . "', weight = '" . $option_value['weight'] . "'");
		}
	}
	if (isset($data['image_swap'])) {
		$swap_list = '';
		foreach ($data['image_swap'] as $key => $swap) {
			if ($swap['id'] != '' && $swap['image'] != '') {
				$swap_list .= $swap['id'].",";
			}
		}
		if ($swap_list != '') {
			$swap_list = substr($swap_list, 0, -1);
			$this->db->query("DELETE FROM " . DB_PREFIX . "otp_image WHERE product_id = '" . (int)$product_id . "' AND `id` NOT IN ($swap_list)");
		}
		else {
			$this->db->query("DELETE FROM " . DB_PREFIX . "otp_image WHERE product_id = '" . (int)$product_id . "'");
		}
		foreach ($data['image_swap'] as $key => $swap) {
			if ($swap['id'] != '' && $swap['image'] != '' && !isset($data['otp_copy'])) {
				$swap_id = $swap['id'];
				$this->db->query("UPDATE " . DB_PREFIX . "otp_image SET product_id = '" . (int)$product_id . "', option_id = '" . (int)$swap['option_id'] . "', option_value_id = '" . (int)$swap['option_value_id'] . "', image = '" . $swap['image'] . "', sort_order = '" . (int)$swap['sort_order'] . "' WHERE `id` = '$swap_id' LIMIT 1");
			}
			elseif ($swap['image'] != '') {
				$this->db->query("INSERT INTO " . DB_PREFIX . "otp_image SET product_id = '" . (int)$product_id . "', option_id = '" . (int)$swap['option_id'] . "', option_value_id = '" . (int)$swap['option_value_id'] . "', image = '" . $swap['image'] . "', sort_order = '" . (int)$swap['sort_order'] . "'");
			}
		}
	}
	else {
		$this->db->query("DELETE FROM " . DB_PREFIX . "otp_image WHERE product_id = '" . (int)$product_id . "'");
	}
}
else {
	$this->db->query("DELETE FROM " . DB_PREFIX . "otp_option_value WHERE product_id = '" . (int)$product_id . "'");
	$this->db->query("DELETE FROM " . DB_PREFIX . "otp_data WHERE product_id = '" . (int)$product_id . "'");
	$this->db->query("DELETE FROM " . DB_PREFIX . "otp_image WHERE product_id = '" . (int)$product_id . "'");
}
if (isset($data['product_option'])) {
			foreach ($data['product_option'] as $product_option) {
				if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
					if (isset($product_option['product_option_value'])) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET product_option_id = '" . (int)$product_option['product_option_id'] . "', product_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', required = '" . (int)$product_option['required'] . "'");

						$product_option_id = $this->db->getLastId();

						foreach ($product_option['product_option_value'] as $product_option_value) {
							$this->db->query("INSERT INTO " . DB_PREFIX . "product_option_value SET product_option_value_id = '" . (int)$product_option_value['product_option_value_id'] . "', product_option_id = '" . (int)$product_option_id . "', product_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', option_value_id = '" . (int)$product_option_value['option_value_id'] . "', quantity = '" . (int)$product_option_value['quantity'] . "', subtract = '" . (int)$product_option_value['subtract'] . "', price = '" . (float)$product_option_value['price'] . "', price_prefix = '" . $this->db->escape($product_option_value['price_prefix']) . "', points = '" . (int)$product_option_value['points'] . "', points_prefix = '" . $this->db->escape($product_option_value['points_prefix']) . "', weight = '" . (float)$product_option_value['weight'] . "', weight_prefix = '" . $this->db->escape($product_option_value['weight_prefix']) . "'");
						}
					}
				} else {
					$this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET product_option_id = '" . (int)$product_option['product_option_id'] . "', product_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', value = '" . $this->db->escape($product_option['value']) . "', required = '" . (int)$product_option['required'] . "'");
				}
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "product_discount WHERE product_id = '" . (int)$product_id . "'");

		if (isset($data['product_discount'])) {
			foreach ($data['product_discount'] as $product_discount) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_discount SET product_id = '" . (int)$product_id . "', customer_group_id = '" . (int)$product_discount['customer_group_id'] . "', quantity = '" . (int)$product_discount['quantity'] . "', priority = '" . (int)$product_discount['priority'] . "', price = '" . (float)$product_discount['price'] . "', date_start = '" . $this->db->escape($product_discount['date_start']) . "', date_end = '" . $this->db->escape($product_discount['date_end']) . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "product_special WHERE product_id = '" . (int)$product_id . "'");

		if (isset($data['product_special'])) {
			foreach ($data['product_special'] as $product_special) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_special SET product_id = '" . (int)$product_id . "', customer_group_id = '" . (int)$product_special['customer_group_id'] . "', priority = '" . (int)$product_special['priority'] . "', price = '" . (float)$product_special['price'] . "', date_start = '" . $this->db->escape($product_special['date_start']) . "', date_end = '" . $this->db->escape($product_special['date_end']) . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int)$product_id . "'");

		if (isset($data['product_image'])) {
			foreach ($data['product_image'] as $product_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_image SET product_id = '" . (int)$product_id . "', image = '" . $this->db->escape($product_image['image']) . "', sort_order = '" . (int)$product_image['sort_order'] . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_download WHERE product_id = '" . (int)$product_id . "'");

		if (isset($data['product_download'])) {
			foreach ($data['product_download'] as $download_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_download SET product_id = '" . (int)$product_id . "', download_id = '" . (int)$download_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "'");

		if (isset($data['product_category'])) {
			foreach ($data['product_category'] as $category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET product_id = '" . (int)$product_id . "', category_id = '" . (int)$category_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "product_filter WHERE product_id = '" . (int)$product_id . "'");

		if (isset($data['product_filter'])) {
			foreach ($data['product_filter'] as $filter_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_filter SET product_id = '" . (int)$product_id . "', filter_id = '" . (int)$filter_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE related_id = '" . (int)$product_id . "'");

		if (isset($data['product_related'])) {
			foreach ($data['product_related'] as $related_id) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$product_id . "' AND related_id = '" . (int)$related_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_related SET product_id = '" . (int)$product_id . "', related_id = '" . (int)$related_id . "'");
				$this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$related_id . "' AND related_id = '" . (int)$product_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_related SET product_id = '" . (int)$related_id . "', related_id = '" . (int)$product_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "product_reward WHERE product_id = '" . (int)$product_id . "'");

		if (isset($data['product_reward'])) {
			foreach ($data['product_reward'] as $customer_group_id => $value) {
				if ((int)$value['points'] > 0) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "product_reward SET product_id = '" . (int)$product_id . "', customer_group_id = '" . (int)$customer_group_id . "', points = '" . (int)$value['points'] . "'");
				}
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_layout WHERE product_id = '" . (int)$product_id . "'");

		if (isset($data['product_layout'])) {
			foreach ($data['product_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_layout SET product_id = '" . (int)$product_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'product_id=" . (int)$product_id . "'");

		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'product_id=" . (int)$product_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->db->query("DELETE FROM `" . DB_PREFIX . "product_recurring` WHERE product_id = " . (int)$product_id);

		if (isset($data['product_recurring'])) {
			foreach ($data['product_recurring'] as $product_recurring) {
				$this->db->query("INSERT INTO `" . DB_PREFIX . "product_recurring` SET `product_id` = " . (int)$product_id . ", customer_group_id = " . (int)$product_recurring['customer_group_id'] . ", `recurring_id` = " . (int)$product_recurring['recurring_id']);
			}
		}

		$this->cache->delete('product');
	}

	public function copyProduct($product_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "product p WHERE p.product_id = '" . (int)$product_id . "'");

		if ($query->num_rows) {
			$data = $query->row;

			$data['sku'] = '';
			$data['upc'] = '';
			$data['viewed'] = '0';
			$data['keyword'] = '';
			$data['status'] = '0';

			$data['otp_options'] = $this->getOtpOptions($product_id);
$data['image_swap'] = $this->getImageSwap($product_id);
$data['otp_copy'] = true;
$data['product_attribute'] = $this->getProductAttributes($product_id);
			$data['product_description'] = $this->getProductDescriptions($product_id);
			$data['product_discount'] = $this->getProductDiscounts($product_id);
			$data['product_filter'] = $this->getProductFilters($product_id);
			$data['product_image'] = $this->getProductImages($product_id);
			$data['product_option'] = $this->getProductOptions($product_id);
			$data['product_related'] = $this->getProductRelated($product_id);
			$data['product_reward'] = $this->getProductRewards($product_id);
			$data['product_special'] = $this->getProductSpecials($product_id);
			$data['product_category'] = $this->getProductCategories($product_id);
			$data['product_download'] = $this->getProductDownloads($product_id);
			$data['product_layout'] = $this->getProductLayouts($product_id);
			$data['product_store'] = $this->getProductStores($product_id);
			$data['product_recurrings'] = $this->getRecurrings($product_id);

			$this->addProduct($data);
		}
	}

	public function deleteProduct($product_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_description WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_discount WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_filter WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_option WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_option_value WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE related_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_reward WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_special WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_download WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_layout WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_store WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_recurring WHERE product_id = " . (int)$product_id);
		$this->db->query("DELETE FROM " . DB_PREFIX . "review WHERE product_id = '" . (int)$product_id . "'");
$this->db->query("DELETE FROM " . DB_PREFIX . "otp_option_value WHERE product_id = '" . (int)$product_id . "'");
$this->db->query("DELETE FROM " . DB_PREFIX . "otp_data WHERE product_id = '" . (int)$product_id . "'");
$this->db->query("DELETE FROM " . DB_PREFIX . "otp_image WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'product_id=" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "coupon_product WHERE product_id = '" . (int)$product_id . "'");

		$this->cache->delete('product');
	}

	public function getProduct($product_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'product_id=" . (int)$product_id . "') AS keyword FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE p.product_id = '" . (int)$product_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getProducts($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND pd.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_model'])) {
			$sql .= " AND p.model LIKE '" . $this->db->escape($data['filter_model']) . "%'";
		}

		if (isset($data['filter_price']) && !is_null($data['filter_price'])) {
			$sql .= " AND p.price LIKE '" . $this->db->escape($data['filter_price']) . "%'";
		}

		if (isset($data['filter_quantity']) && !is_null($data['filter_quantity'])) {
			$sql .= " AND p.quantity = '" . (int)$data['filter_quantity'] . "'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND p.status = '" . (int)$data['filter_status'] . "'";
		}

		if (isset($data['filter_image']) && !is_null($data['filter_image'])) {
			if ($data['filter_image'] == 1) {
				$sql .= " AND (p.image IS NOT NULL AND p.image <> '' AND p.image <> 'no_image.png')";
			} else {
				$sql .= " AND (p.image IS NULL OR p.image = '' OR p.image = 'no_image.png')";
			}
		}

		$sql .= " GROUP BY p.product_id";

		$sort_data = array(
			'pd.name',
			'p.model',
			'p.price',
			'p.quantity',
			'p.status',
			'p.sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY pd.name";
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

	public function getProductsByCategoryId($category_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p.product_id = p2c.product_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p2c.category_id = '" . (int)$category_id . "' ORDER BY pd.name ASC");

		return $query->rows;
	}

	public function getProductDescriptions($product_id) {
		$product_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_description WHERE product_id = '" . (int)$product_id . "'");

		foreach ($query->rows as $result) {
			$product_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
				'description'      => $result['description'],
				'meta_title'       => $result['meta_title'],
				'meta_description' => $result['meta_description'],
				'meta_keyword'     => $result['meta_keyword'],
				'tag'              => $result['tag']
			);
		}

		return $product_description_data;
	}

	public function getProductCategories($product_id) {
		$product_category_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "'");

		foreach ($query->rows as $result) {
			$product_category_data[] = $result['category_id'];
		}

		return $product_category_data;
	}

	public function getProductFilters($product_id) {
		$product_filter_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_filter WHERE product_id = '" . (int)$product_id . "'");

		foreach ($query->rows as $result) {
			$product_filter_data[] = $result['filter_id'];
		}

		return $product_filter_data;
	}

	public function getProductAttributes($product_id) {
		$product_attribute_data = array();

		$product_attribute_query = $this->db->query("SELECT attribute_id FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$product_id . "' GROUP BY attribute_id");

		foreach ($product_attribute_query->rows as $product_attribute) {
			$product_attribute_description_data = array();

			$product_attribute_description_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$product_id . "' AND attribute_id = '" . (int)$product_attribute['attribute_id'] . "'");

			foreach ($product_attribute_description_query->rows as $product_attribute_description) {
				$product_attribute_description_data[$product_attribute_description['language_id']] = array('text' => $product_attribute_description['text']);
			}

			$product_attribute_data[] = array(
				'attribute_id'                  => $product_attribute['attribute_id'],
				'product_attribute_description' => $product_attribute_description_data
			);
		}

		return $product_attribute_data;
	}

	public function getProductOptions($product_id) {
		$product_option_data = array();

		$product_option_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "product_option` po LEFT JOIN `" . DB_PREFIX . "option` o ON (po.option_id = o.option_id) LEFT JOIN `" . DB_PREFIX . "option_description` od ON (o.option_id = od.option_id) WHERE po.product_id = '" . (int)$product_id . "' AND od.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY o.sort_order");

		foreach ($product_option_query->rows as $product_option) {
			$product_option_value_data = array();

			$product_option_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option_value pov LEFT JOIN " . DB_PREFIX . "option_value ov ON(pov.option_value_id = ov.option_value_id) WHERE pov.product_option_id = '" . (int)$product_option['product_option_id'] . "' ORDER BY ov.sort_order ASC");

			foreach ($product_option_value_query->rows as $product_option_value) {
				$product_option_value_data[] = array(
					'product_option_value_id' => $product_option_value['product_option_value_id'],
					'option_value_id'         => $product_option_value['option_value_id'],
					'quantity'                => $product_option_value['quantity'],
					'subtract'                => $product_option_value['subtract'],
					'price'                   => $product_option_value['price'],
					'price_prefix'            => $product_option_value['price_prefix'],
					'points'                  => $product_option_value['points'],
					'points_prefix'           => $product_option_value['points_prefix'],
					'weight'                  => $product_option_value['weight'],
					'weight_prefix'           => $product_option_value['weight_prefix']
				);
			}

			$product_option_data[] = array(
				'product_option_id'    => $product_option['product_option_id'],
				'product_option_value' => $product_option_value_data,
				'option_id'            => $product_option['option_id'],
				'name'                 => $product_option['name'],
				'type'                 => $product_option['type'],
				'value'                => $product_option['value'],
				'required'             => $product_option['required']
			);
		}

		return $product_option_data;
	}

	public function getProductOptionValue($product_id, $product_option_value_id) {
		$query = $this->db->query("SELECT pov.option_value_id, ovd.name, pov.quantity, pov.subtract, pov.price, pov.price_prefix, pov.points, pov.points_prefix, pov.weight, pov.weight_prefix FROM " . DB_PREFIX . "product_option_value pov LEFT JOIN " . DB_PREFIX . "option_value ov ON (pov.option_value_id = ov.option_value_id) LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON (ov.option_value_id = ovd.option_value_id) WHERE pov.product_id = '" . (int)$product_id . "' AND pov.product_option_value_id = '" . (int)$product_option_value_id . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getProductImages($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int)$product_id . "' ORDER BY sort_order ASC");

		return $query->rows;
	}

	public function getProductDiscounts($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_discount WHERE product_id = '" . (int)$product_id . "' ORDER BY quantity, priority, price");

		return $query->rows;
	}

	public function getProductSpecials($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_special WHERE product_id = '" . (int)$product_id . "' ORDER BY priority, price");

		return $query->rows;
	}

	public function getProductRewards($product_id) {
		$product_reward_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_reward WHERE product_id = '" . (int)$product_id . "'");

		foreach ($query->rows as $result) {
			$product_reward_data[$result['customer_group_id']] = array('points' => $result['points']);
		}

		return $product_reward_data;
	}

	public function getProductDownloads($product_id) {
		$product_download_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_download WHERE product_id = '" . (int)$product_id . "'");

		foreach ($query->rows as $result) {
			$product_download_data[] = $result['download_id'];
		}

		return $product_download_data;
	}

	public function getProductStores($product_id) {
		$product_store_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_store WHERE product_id = '" . (int)$product_id . "'");

		foreach ($query->rows as $result) {
			$product_store_data[] = $result['store_id'];
		}

		return $product_store_data;
	}

	public function getProductLayouts($product_id) {
		$product_layout_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_layout WHERE product_id = '" . (int)$product_id . "'");

		foreach ($query->rows as $result) {
			$product_layout_data[$result['store_id']] = $result['layout_id'];
		}

		return $product_layout_data;
	}

	public function getProductRelated($product_id) {
		$product_related_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$product_id . "'");

		foreach ($query->rows as $result) {
			$product_related_data[] = $result['related_id'];
		}

		return $product_related_data;
	}

	public function getRecurrings($product_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "product_recurring` WHERE product_id = '" . (int)$product_id . "'");

		return $query->rows;
	}

	public function getTotalProducts($data = array()) {
		$sql = "SELECT COUNT(DISTINCT p.product_id) AS total FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id)";

		$sql .= " WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND pd.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_model'])) {
			$sql .= " AND p.model LIKE '" . $this->db->escape($data['filter_model']) . "%'";
		}

		if (isset($data['filter_price']) && !is_null($data['filter_price'])) {
			$sql .= " AND p.price LIKE '" . $this->db->escape($data['filter_price']) . "%'";
		}

		if (isset($data['filter_quantity']) && !is_null($data['filter_quantity'])) {
			$sql .= " AND p.quantity = '" . (int)$data['filter_quantity'] . "'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND p.status = '" . (int)$data['filter_status'] . "'";
		}

		if (isset($data['filter_image']) && !is_null($data['filter_image'])) {
			if ($data['filter_image'] == 1) {
				$sql .= " AND (p.image IS NOT NULL AND p.image <> '' AND p.image <> 'no_image.png')";
			} else {
				$sql .= " AND (p.image IS NULL OR p.image = '' OR p.image = 'no_image.png')";
			}
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	public function getTotalProductsByTaxClassId($tax_class_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product WHERE tax_class_id = '" . (int)$tax_class_id . "'");

		return $query->row['total'];
	}

	public function getTotalProductsByStockStatusId($stock_status_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product WHERE stock_status_id = '" . (int)$stock_status_id . "'");

		return $query->row['total'];
	}

	public function getTotalProductsByWeightClassId($weight_class_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product WHERE weight_class_id = '" . (int)$weight_class_id . "'");

		return $query->row['total'];
	}

	public function getTotalProductsByLengthClassId($length_class_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product WHERE length_class_id = '" . (int)$length_class_id . "'");

		return $query->row['total'];
	}

	public function getTotalProductsByDownloadId($download_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product_to_download WHERE download_id = '" . (int)$download_id . "'");

		return $query->row['total'];
	}

	public function getTotalProductsByManufacturerId($manufacturer_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product WHERE manufacturer_id = '" . (int)$manufacturer_id . "'");

		return $query->row['total'];
	}

	public function getTotalProductsByAttributeId($attribute_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product_attribute WHERE attribute_id = '" . (int)$attribute_id . "'");

		return $query->row['total'];
	}

	public function getTotalProductsByOptionId($option_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product_option WHERE option_id = '" . (int)$option_id . "'");

		return $query->row['total'];
	}

	public function getTotalProductsByProfileId($recurring_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product_recurring WHERE recurring_id = '" . (int)$recurring_id . "'");

		return $query->row['total'];
	}

	public function getTotalProductsByLayoutId($layout_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product_to_layout WHERE layout_id = '" . (int)$layout_id . "'");

		return $query->row['total'];
	}
}
