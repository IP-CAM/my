<?php
class ModelCatalogProduct extends Model {
	public function updateViewed($product_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "product SET viewed = (viewed + 1) WHERE product_id = '" . (int)$product_id . "'");
	}

	public function getOtpOptions($product_id) {
	$stock_checkout = $this->config->get('config_stock_checkout');
	$otp_option_data = '';
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
	if (!empty($otp_option_list)) {
		$otpcount = 0;
		foreach ($otp_option_list as $otp_option) {
			$otp_option_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "option_value ov LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON (ov.option_value_id = ovd.option_value_id) WHERE ov.option_id = '" . (int)$otp_option['option_id'] . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY ov.sort_order ASC");
			$otp_option_value_data = array();
			if ($otpcount == 0) {
				$this->load->model('tool/image');
				$otp_option_value_list_query = $this->db->query("SELECT ov.parent_option_value_id FROM `" . DB_PREFIX . "otp_option_value` ov INNER JOIN `" . DB_PREFIX . "otp_data` od ON ov.id = od.otp_id WHERE ov.parent_option_id = '" . (int)$otp_option['option_id'] . "' AND ov.product_id = '" . (int)$product_id . "'" . (!$stock_checkout?' AND od.quantity > 0':''));
				$otp_option_value_list = array();
				foreach ($otp_option_value_list_query->rows as $otp_option_available_value) {
					$otp_option_value_list[] = $otp_option_available_value['parent_option_value_id'];
				}
				foreach ($otp_option_value_query->rows as $otp_option_value) {
					if (in_array($otp_option_value['option_value_id'], $otp_option_value_list)) {
						$option_value_image = $otp_option_value['image'];
						if (!$this->config->get('config_otp_list_image')) {
							$otp_option_image_query = $this->db->query("SELECT `image` FROM `" . DB_PREFIX . "otp_image` WHERE `product_id` = '" . (int)$product_id . "' AND `option_value_id` = '" . (int)$otp_option_value['option_value_id'] . "' ORDER BY sort_order, id LIMIT 1");
							if ($otp_option_image_query->num_rows) {
								$option_value_image = $otp_option_image_query->row['image'];
							}
						}
						if ($option_value_image != '' && $option_value_image != 'no_image.png') {
							$option_value_image = $this->model_tool_image->resize($option_value_image, $this->config->get('config_otp_list_width'), $this->config->get('config_otp_list_height'));
						}
						$otp_option_value_data[] = array(
							'option_value_id' => $otp_option_value['option_value_id'],
							'name'            => $otp_option_value['name'],
							'image'           => $option_value_image,
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
	}
	return $otp_option_data;
}
public function getOtpChildValues($product_id, $child_option_id, $parent_option_value_id, $mode) {
	$stock_checkout = $this->config->get('config_stock_checkout');
	$otp_child_query = $this->db->query("SELECT ov.child_option_value_id FROM `" . DB_PREFIX . "otp_option_value` ov INNER JOIN `" . DB_PREFIX . "otp_data` od ON ov.id = od.otp_id WHERE ov.product_id = '" . (int)$product_id . "' AND ov.parent_option_value_id = '" . (int)$parent_option_value_id . "'" . (!$stock_checkout?' AND od.quantity > 0':''));
	foreach ($otp_child_query->rows as $child_value) {
		$otp_child_value_list[] = $child_value['child_option_value_id'];
	}
	$otp_option_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "option_value ov LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON (ov.option_value_id = ovd.option_value_id) WHERE ov.option_id = '" . (int)$child_option_id . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY ov.sort_order ASC");
	if ($mode == 'select') {
		$child_values = '<option value="">'.$this->language->get('text_select').'</option>';
		foreach ($otp_option_value_query->rows as $otp_option_value) {
			if (in_array($otp_option_value['option_value_id'], $otp_child_value_list)) {
				$child_values .= '<option value="'.$otp_option_value['option_value_id'].'">'.$otp_option_value['name'].'</option>';
			}
		}
	}
	elseif ($mode == 'list') {
		$this->load->model('tool/image');
		$child_values = '';
		foreach ($otp_option_value_query->rows as $otp_option_value) {
			if (in_array($otp_option_value['option_value_id'], $otp_child_value_list)) {
				$child_values .= '<li value="'.$otp_option_value['option_value_id'].'">';
				$option_value_image = $otp_option_value['image'];
				if (!$this->config->get('config_otp_list_image')) {
					$otp_option_image_query = $this->db->query("SELECT `image` FROM `" . DB_PREFIX . "otp_image` WHERE `product_id` = '" . (int)$product_id . "' AND `option_value_id` = '" . (int)$otp_option_value['option_value_id'] . "' ORDER BY sort_order, id LIMIT 1");
					if ($otp_option_image_query->num_rows) {
						$option_value_image = $otp_option_image_query->row['image'];
					}
				}
				if ($option_value_image != '' && $option_value_image != 'no_image.png') {
					$otp_image = $this->model_tool_image->resize($option_value_image, $this->config->get('config_otp_list_width'), $this->config->get('config_otp_list_height'));
					$child_values .= '<img src="' . $otp_image . '">';
				}
				else {
					$child_values .= '<span>' . $otp_option_value['name'] . '</span>';
				}
				$child_values .= '</li>';
			}
		}
	}
	return $child_values;
}
public function getOtpGrandchildValues($product_id, $grandchild_option_id, $parent_option_value_id, $child_option_value_id, $mode) {
	$stock_checkout = $this->config->get('config_stock_checkout');
	$otp_grandchild_query = $this->db->query("SELECT ov.grandchild_option_value_id FROM `" . DB_PREFIX . "otp_option_value` ov INNER JOIN `" . DB_PREFIX . "otp_data` od ON ov.id = od.otp_id WHERE ov.product_id = '" . (int)$product_id . "' AND ov.parent_option_value_id = '" . (int)$parent_option_value_id . "' AND ov.child_option_value_id = '" . (int)$child_option_value_id . "'" . (!$stock_checkout?' AND od.quantity > 0':''));
	foreach ($otp_grandchild_query->rows as $grandchild_value) {
		$otp_grandchild_value_list[] = $grandchild_value['grandchild_option_value_id'];
	}
	$otp_option_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "option_value ov LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON (ov.option_value_id = ovd.option_value_id) WHERE ov.option_id = '" . (int)$grandchild_option_id . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY ov.sort_order ASC");
	if ($mode == 'select') {
		$grandchild_values = '<option value="">'.$this->language->get('text_select').'</option>';
		foreach ($otp_option_value_query->rows as $otp_option_value) {
			if (in_array($otp_option_value['option_value_id'], $otp_grandchild_value_list)) {
				$grandchild_values .= '<option value="'.$otp_option_value['option_value_id'].'">'.$otp_option_value['name'].'</option>';
			}
		}
	}
	elseif ($mode == 'list') {
		$this->load->model('tool/image');
		$grandchild_values = '';
		foreach ($otp_option_value_query->rows as $otp_option_value) {
			if (in_array($otp_option_value['option_value_id'], $otp_grandchild_value_list)) {
				$grandchild_values .= '<li value="'.$otp_option_value['option_value_id'].'">';
				$option_value_image = $otp_option_value['image'];
				if (!$this->config->get('config_otp_list_image')) {
					$otp_option_image_query = $this->db->query("SELECT `image` FROM `" . DB_PREFIX . "otp_image` WHERE `product_id` = '" . (int)$product_id . "' AND `option_value_id` = '" . (int)$otp_option_value['option_value_id'] . "' ORDER BY sort_order, id LIMIT 1");
					if ($otp_option_image_query->num_rows) {
						$option_value_image = $otp_option_image_query->row['image'];
					}
				}
				if ($option_value_image != '' && $option_value_image != 'no_image.png') {
					$otp_image = $this->model_tool_image->resize($option_value_image, $this->config->get('config_otp_list_width'), $this->config->get('config_otp_list_height'));
					$grandchild_values .= '<img src="' . $otp_image . '">';
				}
				else {
					$grandchild_values .= '<span>' . $otp_option_value['name'] . '</span>';
				}
				$grandchild_values .= '</li>';
			}
		}
	}
	return $grandchild_values;
}
public function getOtp($product_id, $parent_option_value_id, $child_option_value_id, $grandchild_option_value_id) {
	$otp_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "otp_option_value` ov INNER JOIN `" . DB_PREFIX . "otp_data` od ON ov.id = od.otp_id WHERE ov.product_id = '" . (int)$product_id . "' AND ov.parent_option_value_id = '" . (int)$parent_option_value_id . "' AND ov.child_option_value_id = '" . (int)$child_option_value_id . "' AND ov.grandchild_option_value_id = '" . (int)$grandchild_option_value_id . "' LIMIT 1");
	$otp = $otp_query->rows;
	if (!empty($otp)) {
		$product_query = $this->db->query("SELECT p.price AS price, s.price AS special FROM `" . DB_PREFIX . "product` p LEFT JOIN `" . DB_PREFIX . "product_special` s ON p.product_id = s.product_id WHERE p.product_id = '" . (int)$product_id . "' LIMIT 1");
		$product_price = $product_query->rows;
		if ($product_price[0]['special'] > 0) { $product_price = $product_price[0]['special']; }
		else { $product_price = $product_price[0]['price']; }
		if ($this->config->get('config_otp_price') && $otp[0]['price'] > 0) {
			if ($otp[0]['price_prefix'] == "=") { $otp_price = $otp[0]['price']; }
			elseif ($otp[0]['price_prefix'] == "+") { $otp_price = $product_price + $otp[0]['price']; }
			else { $otp_price = $product_price - $otp[0]['price']; }
		}
		else {
			$otp_price = 0;
		}
		if ($this->config->get('config_otp_special') && $otp[0]['special'] > 0) {
			$otp_special = $otp[0]['special'];
		}
		else {
			$otp_special = 0;
		}
		$otp_data = array(
			'id' => $otp[0]['id'],
			'model' => $otp[0]['model'],
			'extra' => $otp[0]['extra'],
			'quantity' => $otp[0]['quantity'],
			'subtract' => $otp[0]['subtract'],
			'price' => $otp_price,
			'special' => $otp_special
		);
	}
	else {
		$otp_data = '';
	}
	return $otp_data;
}
public function checkSwap($product_id) {
	$query = $this->db->query("SELECT option_id FROM `" . DB_PREFIX . "otp_image` WHERE `product_id` = " . (int)$product_id . " LIMIT 1");
	if ($query->num_rows) {
		return $query->row['option_id'];
	}
	else {
		return false;
	}
}
public function getSwapBullets($product_id) {
	$query = $this->db->query("SELECT swap.option_value_id, swap.thumb, swap.image, swap.name FROM (SELECT sw.option_value_id, sw.image AS thumb, ov.image, ovd.name FROM `" . DB_PREFIX . "otp_image` sw INNER JOIN " . DB_PREFIX . "option_value ov ON (sw.option_value_id = ov.option_value_id) INNER JOIN " . DB_PREFIX . "option_value_description ovd ON (sw.option_value_id = ovd.option_value_id) WHERE sw.product_id = '" . (int)$product_id . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY sw.sort_order, sw.id ASC) AS swap GROUP BY swap.option_value_id");
	return $query->rows;
}
public function getSwapThumbs($product_id) {
	$query = $this->db->query("SELECT swap.option_value_id, swap.name, swap.image FROM (SELECT sw.option_value_id, ovd.name, sw.image FROM `" . DB_PREFIX . "otp_image` sw INNER JOIN " . DB_PREFIX . "option_value_description ovd ON (sw.option_value_id = ovd.option_value_id) WHERE sw.product_id = '" . (int)$product_id . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY sw.sort_order, sw.id ASC) AS swap GROUP BY swap.option_value_id");
	return $query->rows;
}
public function getSwapImages($product_id, $option_value_id) {
	$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "otp_image` sw INNER JOIN " . DB_PREFIX . "option_value_description ovd ON (sw.option_value_id = ovd.option_value_id) WHERE sw.product_id = '" . (int)$product_id . "' AND sw.option_value_id = '" . (int)$option_value_id . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY sw.sort_order, sw.id ASC");
	return $query->rows;
}
public function getStartingFrom($product_id) {
	$price_list = array();
	$query_otp = $this->db->query("SELECT `price_prefix`, `price`, `special` FROM `" . DB_PREFIX . "otp_data` WHERE `product_id` = '" . (int)$product_id . "' AND (`price` > 0 OR `special` > 0)");
	if ($query_otp->num_rows) {
		$price = $this->db->query("SELECT `price` FROM `" . DB_PREFIX . "product` WHERE `product_id` = '" . (int)$product_id . "'")->row['price'];
		if ($price > 0) {
			$price_list[] = $price;
		}
		$query = $this->db->query("SELECT `price` FROM " . DB_PREFIX . "product_special WHERE `product_id` = '" . (int)$product_id . "' AND `customer_group_id` = '" . (int)$this->config->get('config_customer_group_id') . "' AND ((`date_start` = '0000-00-00' OR `date_start` < NOW()) AND (`date_end` = '0000-00-00' OR `date_end` > NOW())) AND `price` > 0 ORDER BY `priority` ASC, `price` ASC LIMIT 1");
		if ($query->num_rows) {
			$price_list[] = $price;
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
public function getProduct($product_id) {
		$query = $this->db->query("SELECT DISTINCT *, pd.name AS name, p.image, m.name AS manufacturer, (SELECT price FROM " . DB_PREFIX . "product_discount pd2 WHERE pd2.product_id = p.product_id AND pd2.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount, (SELECT price FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special, (SELECT points FROM " . DB_PREFIX . "product_reward pr WHERE pr.product_id = p.product_id AND pr.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "') AS reward, (SELECT ss.name FROM " . DB_PREFIX . "stock_status ss WHERE ss.stock_status_id = p.stock_status_id AND ss.language_id = '" . (int)$this->config->get('config_language_id') . "') AS stock_status, (SELECT wcd.unit FROM " . DB_PREFIX . "weight_class_description wcd WHERE p.weight_class_id = wcd.weight_class_id AND wcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS weight_class, (SELECT lcd.unit FROM " . DB_PREFIX . "length_class_description lcd WHERE p.length_class_id = lcd.length_class_id AND lcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS length_class, (SELECT AVG(rating) AS total FROM " . DB_PREFIX . "review r1 WHERE r1.product_id = p.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating, (SELECT COUNT(*) AS total FROM " . DB_PREFIX . "review r2 WHERE r2.product_id = p.product_id AND r2.status = '1' GROUP BY r2.product_id) AS reviews, p.sort_order FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) LEFT JOIN " . DB_PREFIX . "manufacturer m ON (p.manufacturer_id = m.manufacturer_id) WHERE p.product_id = '" . (int)$product_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");

		if ($query->num_rows) {
			return array(
				'product_id'       => $query->row['product_id'],
				'name'             => $query->row['name'],
				'description'      => $query->row['description'],
				'meta_title'       => $query->row['meta_title'],
				'meta_description' => $query->row['meta_description'],
				'meta_keyword'     => $query->row['meta_keyword'],
				'tag'              => $query->row['tag'],
				'model'            => $query->row['model'],
				'sku'              => $query->row['sku'],
				'upc'              => $query->row['upc'],
				'ean'              => $query->row['ean'],
				'jan'              => $query->row['jan'],
				'isbn'             => $query->row['isbn'],
				'mpn'              => $query->row['mpn'],
				'location'         => $query->row['location'],
				'quantity'         => $query->row['quantity'],
				'stock_status'     => $query->row['stock_status'],
				'image'            => $query->row['image'],
				'manufacturer_id'  => $query->row['manufacturer_id'],
				'manufacturer'     => $query->row['manufacturer'],
				'price'            => ($query->row['discount'] ? $query->row['discount'] : $query->row['price']),
'starting_from' => $this->getStartingFrom($product_id),
				'special'          => $query->row['special'],
				'reward'           => $query->row['reward'],
				'points'           => $query->row['points'],
				'tax_class_id'     => $query->row['tax_class_id'],
				'date_available'   => $query->row['date_available'],
				'weight'           => $query->row['weight'],
				'weight_class_id'  => $query->row['weight_class_id'],
				'length'           => $query->row['length'],
				'width'            => $query->row['width'],
				'height'           => $query->row['height'],
				'length_class_id'  => $query->row['length_class_id'],
				'subtract'         => $query->row['subtract'],
				'rating'           => round($query->row['rating']),
				'reviews'          => $query->row['reviews'] ? $query->row['reviews'] : 0,
				'minimum'          => $query->row['minimum'],
				'sort_order'       => $query->row['sort_order'],
				'status'           => $query->row['status'],
				'date_added'       => $query->row['date_added'],
				'date_modified'    => $query->row['date_modified'],
				'viewed'           => $query->row['viewed']
			);
		} else {
			return false;
		}
	}

	public function getProducts($data = array()) {
		$sql = "SELECT p.product_id, (SELECT AVG(rating) AS total FROM " . DB_PREFIX . "review r1 WHERE r1.product_id = p.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating, (SELECT price FROM " . DB_PREFIX . "product_discount pd2 WHERE pd2.product_id = p.product_id AND pd2.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount, (SELECT price FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special";

		if (!empty($data['filter_category_id'])) {
			if (!empty($data['filter_sub_category'])) {
				$sql .= " FROM " . DB_PREFIX . "category_path cp LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (cp.category_id = p2c.category_id)";
			} else {
				$sql .= " FROM " . DB_PREFIX . "product_to_category p2c";
			}

			if (!empty($data['filter_filter'])) {
				$sql .= " LEFT JOIN " . DB_PREFIX . "product_filter pf ON (p2c.product_id = pf.product_id) LEFT JOIN " . DB_PREFIX . "product p ON (pf.product_id = p.product_id)";
			} else {
				$sql .= " LEFT JOIN " . DB_PREFIX . "product p ON (p2c.product_id = p.product_id)";
			}
		} else {
			$sql .= " FROM " . DB_PREFIX . "product p";
		}

		$sql .= " LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "otp_data otp ON (p.product_id = otp.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";

		if (!empty($data['filter_category_id'])) {
			if (!empty($data['filter_sub_category'])) {
				$sql .= " AND cp.path_id = '" . (int)$data['filter_category_id'] . "'";
			} else {
				$sql .= " AND p2c.category_id = '" . (int)$data['filter_category_id'] . "'";
			}

			if (!empty($data['filter_filter'])) {
				$implode = array();

				$filters = explode(',', $data['filter_filter']);

				foreach ($filters as $filter_id) {
					$implode[] = (int)$filter_id;
				}

				$sql .= " AND pf.filter_id IN (" . implode(',', $implode) . ")";
			}
		}

		if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
			$sql .= " AND (";

			if (!empty($data['filter_name'])) {
				$implode = array();

				$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_name'])));

				foreach ($words as $word) {
					$implode[] = "pd.name LIKE '%" . $this->db->escape($word) . "%'";
				}

				if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
				}

				if (!empty($data['filter_description'])) {
					$sql .= " OR pd.description LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
				}
			}

			if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
				$sql .= " OR ";
			}

			if (!empty($data['filter_tag'])) {
				$implode = array();

				$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_tag'])));

				foreach ($words as $word) {
					$implode[] = "pd.tag LIKE '%" . $this->db->escape($word) . "%'";
				}

				if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
				}
			}

			if (!empty($data['filter_name'])) {
				$sql .= " OR LCASE(p.model) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
$sql .= " OR LCASE(otp.model) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.sku) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.upc) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.ean) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.jan) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.isbn) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.mpn) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
			}

			$sql .= ")";
		}

		if (!empty($data['filter_manufacturer_id'])) {
			$sql .= " AND p.manufacturer_id = '" . (int)$data['filter_manufacturer_id'] . "'";
		}

		$sql .= " GROUP BY p.product_id";

		$sort_data = array(
			'pd.name',
			'p.model',
			'p.quantity',
			'p.price',
			'rating',
			'p.sort_order',
			'p.date_added'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			if ($data['sort'] == 'pd.name' || $data['sort'] == 'p.model') {
				$sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
			} elseif ($data['sort'] == 'p.price') {
				$sql .= " ORDER BY (CASE WHEN special IS NOT NULL THEN special WHEN discount IS NOT NULL THEN discount ELSE p.price END)";
			} else {
				$sql .= " ORDER BY " . $data['sort'];
			}
		} else {
			$sql .= " ORDER BY p.sort_order";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC, LCASE(pd.name) DESC";
		} else {
			$sql .= " ASC, LCASE(pd.name) ASC";
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

		$product_data = array();

		$query = $this->db->query($sql);

		foreach ($query->rows as $result) {
			$product_data[$result['product_id']] = $this->getProduct($result['product_id']);
		}

		return $product_data;
	}

	public function getProductSpecials($data = array()) {
		$sql = "SELECT DISTINCT ps.product_id, (SELECT AVG(rating) FROM " . DB_PREFIX . "review r1 WHERE r1.product_id = ps.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating FROM " . DB_PREFIX . "product_special ps LEFT JOIN " . DB_PREFIX . "product p ON (ps.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND ps.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) GROUP BY ps.product_id";

		$sort_data = array(
			'pd.name',
			'p.model',
			'ps.price',
			'rating',
			'p.sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			if ($data['sort'] == 'pd.name' || $data['sort'] == 'p.model') {
				$sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
			} else {
				$sql .= " ORDER BY " . $data['sort'];
			}
		} else {
			$sql .= " ORDER BY p.sort_order";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC, LCASE(pd.name) DESC";
		} else {
			$sql .= " ASC, LCASE(pd.name) ASC";
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

		$product_data = array();

		$query = $this->db->query($sql);

		foreach ($query->rows as $result) {
			$product_data[$result['product_id']] = $this->getProduct($result['product_id']);
		}

		return $product_data;
	}

	public function getLatestProducts($limit) {
		$product_data = $this->cache->get('product.latest.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $this->config->get('config_customer_group_id') . '.' . (int)$limit);

		if (!$product_data) {
			$query = $this->db->query("SELECT p.product_id FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' ORDER BY p.date_added DESC LIMIT " . (int)$limit);

			foreach ($query->rows as $result) {
				$product_data[$result['product_id']] = $this->getProduct($result['product_id']);
			}

			$this->cache->set('product.latest.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $this->config->get('config_customer_group_id') . '.' . (int)$limit, $product_data);
		}

		return $product_data;
	}

	public function getPopularProducts($limit) {
		$product_data = $this->cache->get('product.popular.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $this->config->get('config_customer_group_id') . '.' . (int)$limit);
	
		if (!$product_data) {
			$query = $this->db->query("SELECT p.product_id FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' ORDER BY p.viewed DESC, p.date_added DESC LIMIT " . (int)$limit);
	
			foreach ($query->rows as $result) {
				$product_data[$result['product_id']] = $this->getProduct($result['product_id']);
			}
			
			$this->cache->set('product.popular.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $this->config->get('config_customer_group_id') . '.' . (int)$limit, $product_data);
		}
		
		return $product_data;
	}

	public function getBestSellerProducts($limit) {
		$product_data = $this->cache->get('product.bestseller.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $this->config->get('config_customer_group_id') . '.' . (int)$limit);

		if (!$product_data) {
			$product_data = array();

			$query = $this->db->query("SELECT op.product_id, SUM(op.quantity) AS total FROM " . DB_PREFIX . "order_product op LEFT JOIN `" . DB_PREFIX . "order` o ON (op.order_id = o.order_id) LEFT JOIN `" . DB_PREFIX . "product` p ON (op.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE o.order_status_id > '0' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' GROUP BY op.product_id ORDER BY total DESC LIMIT " . (int)$limit);

			foreach ($query->rows as $result) {
				$product_data[$result['product_id']] = $this->getProduct($result['product_id']);
			}

			$this->cache->set('product.bestseller.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $this->config->get('config_customer_group_id') . '.' . (int)$limit, $product_data);
		}

		return $product_data;
	}

	public function getProductAttributes($product_id) {
		$product_attribute_group_data = array();

		$product_attribute_group_query = $this->db->query("SELECT ag.attribute_group_id, agd.name FROM " . DB_PREFIX . "product_attribute pa LEFT JOIN " . DB_PREFIX . "attribute a ON (pa.attribute_id = a.attribute_id) LEFT JOIN " . DB_PREFIX . "attribute_group ag ON (a.attribute_group_id = ag.attribute_group_id) LEFT JOIN " . DB_PREFIX . "attribute_group_description agd ON (ag.attribute_group_id = agd.attribute_group_id) WHERE pa.product_id = '" . (int)$product_id . "' AND agd.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY ag.attribute_group_id ORDER BY ag.sort_order, agd.name");

		foreach ($product_attribute_group_query->rows as $product_attribute_group) {
			$product_attribute_data = array();

			$product_attribute_query = $this->db->query("SELECT a.attribute_id, ad.name, pa.text FROM " . DB_PREFIX . "product_attribute pa LEFT JOIN " . DB_PREFIX . "attribute a ON (pa.attribute_id = a.attribute_id) LEFT JOIN " . DB_PREFIX . "attribute_description ad ON (a.attribute_id = ad.attribute_id) WHERE pa.product_id = '" . (int)$product_id . "' AND a.attribute_group_id = '" . (int)$product_attribute_group['attribute_group_id'] . "' AND ad.language_id = '" . (int)$this->config->get('config_language_id') . "' AND pa.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY a.sort_order, ad.name");

			foreach ($product_attribute_query->rows as $product_attribute) {
				$product_attribute_data[] = array(
					'attribute_id' => $product_attribute['attribute_id'],
					'name'         => $product_attribute['name'],
					'text'         => $product_attribute['text']
				);
			}

			$product_attribute_group_data[] = array(
				'attribute_group_id' => $product_attribute_group['attribute_group_id'],
				'name'               => $product_attribute_group['name'],
				'attribute'          => $product_attribute_data
			);
		}

		return $product_attribute_group_data;
	}

	public function getProductOptions($product_id) {
		$product_option_data = array();

		$product_option_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option po LEFT JOIN `" . DB_PREFIX . "option` o ON (po.option_id = o.option_id) LEFT JOIN " . DB_PREFIX . "option_description od ON (o.option_id = od.option_id) WHERE po.product_id = '" . (int)$product_id . "' AND od.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY o.sort_order");

		foreach ($product_option_query->rows as $product_option) {
			$product_option_value_data = array();

			$product_option_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option_value pov LEFT JOIN " . DB_PREFIX . "option_value ov ON (pov.option_value_id = ov.option_value_id) LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON (ov.option_value_id = ovd.option_value_id) WHERE pov.product_id = '" . (int)$product_id . "' AND pov.product_option_id = '" . (int)$product_option['product_option_id'] . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY ov.sort_order");

			foreach ($product_option_value_query->rows as $product_option_value) {
				$product_option_value_data[] = array(
					'product_option_value_id' => $product_option_value['product_option_value_id'],
					'option_value_id'         => $product_option_value['option_value_id'],
					'name'                    => $product_option_value['name'],
					'image'                   => $product_option_value['image'],
					'quantity'                => $product_option_value['quantity'],
					'subtract'                => $product_option_value['subtract'],
					'price'                   => $product_option_value['price'],
					'price_prefix'            => $product_option_value['price_prefix'],
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

	public function getProductDiscounts($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_discount WHERE product_id = '" . (int)$product_id . "' AND customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND quantity > 1 AND ((date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())) ORDER BY quantity ASC, priority ASC, price ASC");

		return $query->rows;
	}

	public function getProductImages($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int)$product_id . "' ORDER BY sort_order ASC");

		return $query->rows;
	}

	public function getProductRelated($product_id) {
		$product_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_related pr LEFT JOIN " . DB_PREFIX . "product p ON (pr.related_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE pr.product_id = '" . (int)$product_id . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");

		foreach ($query->rows as $result) {
			$product_data[$result['related_id']] = $this->getProduct($result['related_id']);
		}

		return $product_data;
	}

	public function getProductLayoutId($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_layout WHERE product_id = '" . (int)$product_id . "' AND store_id = '" . (int)$this->config->get('config_store_id') . "'");

		if ($query->num_rows) {
			return $query->row['layout_id'];
		} else {
			return 0;
		}
	}

	public function getCategories($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "'");

		return $query->rows;
	}

	public function getTotalProducts($data = array()) {
		$sql = "SELECT COUNT(DISTINCT p.product_id) AS total";

		if (!empty($data['filter_category_id'])) {
			if (!empty($data['filter_sub_category'])) {
				$sql .= " FROM " . DB_PREFIX . "category_path cp LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (cp.category_id = p2c.category_id)";
			} else {
				$sql .= " FROM " . DB_PREFIX . "product_to_category p2c";
			}

			if (!empty($data['filter_filter'])) {
				$sql .= " LEFT JOIN " . DB_PREFIX . "product_filter pf ON (p2c.product_id = pf.product_id) LEFT JOIN " . DB_PREFIX . "product p ON (pf.product_id = p.product_id)";
			} else {
				$sql .= " LEFT JOIN " . DB_PREFIX . "product p ON (p2c.product_id = p.product_id)";
			}
		} else {
			$sql .= " FROM " . DB_PREFIX . "product p";
		}

		$sql .= " LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "otp_data otp ON (p.product_id = otp.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";

		if (!empty($data['filter_category_id'])) {
			if (!empty($data['filter_sub_category'])) {
				$sql .= " AND cp.path_id = '" . (int)$data['filter_category_id'] . "'";
			} else {
				$sql .= " AND p2c.category_id = '" . (int)$data['filter_category_id'] . "'";
			}

			if (!empty($data['filter_filter'])) {
				$implode = array();

				$filters = explode(',', $data['filter_filter']);

				foreach ($filters as $filter_id) {
					$implode[] = (int)$filter_id;
				}

				$sql .= " AND pf.filter_id IN (" . implode(',', $implode) . ")";
			}
		}

		if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
			$sql .= " AND (";

			if (!empty($data['filter_name'])) {
				$implode = array();

				$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_name'])));

				foreach ($words as $word) {
					$implode[] = "pd.name LIKE '%" . $this->db->escape($word) . "%'";
				}

				if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
				}

				if (!empty($data['filter_description'])) {
					$sql .= " OR pd.description LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
				}
			}

			if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
				$sql .= " OR ";
			}

			if (!empty($data['filter_tag'])) {
				$implode = array();

				$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_tag'])));

				foreach ($words as $word) {
					$implode[] = "pd.tag LIKE '%" . $this->db->escape($word) . "%'";
				}

				if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
				}
			}

			if (!empty($data['filter_name'])) {
				$sql .= " OR LCASE(p.model) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
$sql .= " OR LCASE(otp.model) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.sku) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.upc) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.ean) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.jan) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.isbn) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.mpn) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
			}

			$sql .= ")";
		}

		if (!empty($data['filter_manufacturer_id'])) {
			$sql .= " AND p.manufacturer_id = '" . (int)$data['filter_manufacturer_id'] . "'";
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	public function getProfile($product_id, $recurring_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "recurring r JOIN " . DB_PREFIX . "product_recurring pr ON (pr.recurring_id = r.recurring_id AND pr.product_id = '" . (int)$product_id . "') WHERE pr.recurring_id = '" . (int)$recurring_id . "' AND status = '1' AND pr.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "'");

		return $query->row;
	}

	public function getProfiles($product_id) {
		$query = $this->db->query("SELECT rd.* FROM " . DB_PREFIX . "product_recurring pr JOIN " . DB_PREFIX . "recurring_description rd ON (rd.language_id = " . (int)$this->config->get('config_language_id') . " AND rd.recurring_id = pr.recurring_id) JOIN " . DB_PREFIX . "recurring r ON r.recurring_id = rd.recurring_id WHERE pr.product_id = " . (int)$product_id . " AND status = '1' AND pr.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' ORDER BY sort_order ASC");

		return $query->rows;
	}

	public function getTotalProductSpecials() {
		$query = $this->db->query("SELECT COUNT(DISTINCT ps.product_id) AS total FROM " . DB_PREFIX . "product_special ps LEFT JOIN " . DB_PREFIX . "product p ON (ps.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND ps.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW()))");

		if (isset($query->row['total'])) {
			return $query->row['total'];
		} else {
			return 0;
		}
	}
}
