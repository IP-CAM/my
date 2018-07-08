<?php
class Gift {
	private $config;
	private $db;
	private $data = array();

	public function __construct($registry) {
		$this->config = $registry->get('config');
		$this->customer = $registry->get('customer');
		$this->session = $registry->get('session');
		$this->db = $registry->get('db');
		$this->tax = $registry->get('tax');
		$this->weight = $registry->get('weight');
		$this->cart = $registry->get('cart');

		if (!isset($this->session->data['gift']) || !is_array($this->session->data['gift'])) {
			$this->session->data['gift'] = array();
		} else {
			// 过滤赠品列表 防止恶意添加赠品			
			foreach ($this->getProducts() as $key => $p) {
				if (!$this->getGiftProduct($p['product_id'])) {
					$this->remove($key);
				}
			}
		}
		
		
		if (!isset($this->session->data['gift_discount']) || !is_array($this->session->data['gift_discount'])) {
			$this->session->data['gift_discount'] = array();
		}
	}

	public function getGiftDiscount($product_id) {
		//$this->session->data['gift_discount'] = array();
		
		$r = array();
		
		$module_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "module WHERE LCASE(`code`) = 'gift'");
		
		$modules = $module_query->rows;
		
		if ($modules) {
			foreach ($modules as $module) {
				$lize = unserialize($module['setting']);
				
				if ($lize && !empty($lize['discount']) && $this->cart->getSubTotal() >= (float)$lize['total']) {
					
					foreach ($lize['discount'] as $key => $val) {
						if ('discount'.$module['module_id'].$key == $product_id) {
							$r = array(
								'id'     => $product_id,
								'name'   => $val['name'][$this->config->get('config_language_id')],
								'type'   => $val['type'],
								'amount' => $val['amount'],
								'total'  => $lize['total'],
								'group'  => $module['module_id']
							);
							
							$this->session->data['gift_discount'][$product_id] = $r;
							
							break 2;
						}
					}
				}
			}
		}
		
		return $r;
	}

	public function getGiftProduct($product_id) {		
		$product = array();
		
		$module_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "module WHERE LCASE(`code`) = 'gift'");
		
		$modules = $module_query->rows;
		
		if ($modules && $product_id) {
			foreach ($modules as $module) {
				$lize = unserialize($module['setting']);
				
				if ($lize && !empty($lize['product']) && $this->cart->getSubTotal() >= (float)$lize['total']) {
					foreach ($lize['product'] as $key => $val) {
						if ($key == $product_id) {
							$product = array(
								'product_id'  => (int)$product_id,
								'price'       => (float)$val['price'],
								'group'       => (int)$module['module_id']
							);
							
							if (!empty($this->session->data['gift_discount'])) {
								foreach ($this->session->data['gift_discount'] as $k => $v) {
									if ($v['group'] == $module['module_id']) {
										unset($this->session->data['gift_discount'][$k]);
										break;
									}
								}
							}
							
							$product['key'] = base64_encode(serialize($product));
							
							break 2;
						}
					}
				}
			}
		}
		
		return $product;
	}

	public function getProducts() {
		if (!$this->data && isset($this->session->data['gift'])) {
			foreach ($this->session->data['gift'] as $key => $quantity) {
				$product = unserialize(base64_decode($key));

				$product_id = $product['product_id'];

				$stock = true;

				// Options
				if (!empty($product['option'])) {
					$options = $product['option'];
				} else {
					$options = array();
				}

				// Group
				if (!empty($product['group'])) {
					$group = $product['group'];
				} else {
					$group = 0;
				}

				// Price
				if (!empty($product['price'])) {
					$price = $product['price'];
				} else {
					$price = '';
				}

				// Profile
				if (!empty($product['recurring_id'])) {
					$recurring_id = $product['recurring_id'];
				} else {
					$recurring_id = 0;
				}

				$product_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE p.product_id = '" . (int)$product_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.date_available <= NOW() AND p.status = '1'");

				if ($product_query->num_rows) {
					$option_price = 0;
					$option_points = 0;
					$option_weight = 0;

					$option_data = array();

					foreach ($options as $product_option_id => $value) {
						$option_query = $this->db->query("SELECT po.product_option_id, po.option_id, od.name, o.type FROM " . DB_PREFIX . "product_option po LEFT JOIN `" . DB_PREFIX . "option` o ON (po.option_id = o.option_id) LEFT JOIN " . DB_PREFIX . "option_description od ON (o.option_id = od.option_id) WHERE po.product_option_id = '" . (int)$product_option_id . "' AND po.product_id = '" . (int)$product_id . "' AND od.language_id = '" . (int)$this->config->get('config_language_id') . "'");

						if ($option_query->num_rows) {
							if ($option_query->row['type'] == 'select' || $option_query->row['type'] == 'radio' || $option_query->row['type'] == 'image') {
								$option_value_query = $this->db->query("SELECT pov.option_value_id, ovd.name, pov.quantity, pov.subtract, pov.price, pov.price_prefix, pov.points, pov.points_prefix, pov.weight, pov.weight_prefix FROM " . DB_PREFIX . "product_option_value pov LEFT JOIN " . DB_PREFIX . "option_value ov ON (pov.option_value_id = ov.option_value_id) LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON (ov.option_value_id = ovd.option_value_id) WHERE pov.product_option_value_id = '" . (int)$value . "' AND pov.product_option_id = '" . (int)$product_option_id . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

								if ($option_value_query->num_rows) {
									if ($option_value_query->row['price_prefix'] == '+') {
										$option_price += $option_value_query->row['price'];
									} elseif ($option_value_query->row['price_prefix'] == '-') {
										$option_price -= $option_value_query->row['price'];
									}

									if ($option_value_query->row['points_prefix'] == '+') {
										$option_points += $option_value_query->row['points'];
									} elseif ($option_value_query->row['points_prefix'] == '-') {
										$option_points -= $option_value_query->row['points'];
									}

									if ($option_value_query->row['weight_prefix'] == '+') {
										$option_weight += $option_value_query->row['weight'];
									} elseif ($option_value_query->row['weight_prefix'] == '-') {
										$option_weight -= $option_value_query->row['weight'];
									}

									if ($option_value_query->row['subtract'] && (!$option_value_query->row['quantity'] || ($option_value_query->row['quantity'] < $quantity))) {
										$stock = false;
									}

									$option_data[] = array(
										'product_option_id'       => $product_option_id,
										'product_option_value_id' => $value,
										'option_id'               => $option_query->row['option_id'],
										'option_value_id'         => $option_value_query->row['option_value_id'],
										'name'                    => $option_query->row['name'],
										'value'                   => $option_value_query->row['name'],
										'type'                    => $option_query->row['type'],
										'quantity'                => $option_value_query->row['quantity'],
										'subtract'                => $option_value_query->row['subtract'],
										'price'                   => $option_value_query->row['price'],
										'price_prefix'            => $option_value_query->row['price_prefix'],
										'points'                  => $option_value_query->row['points'],
										'points_prefix'           => $option_value_query->row['points_prefix'],
										'weight'                  => $option_value_query->row['weight'],
										'weight_prefix'           => $option_value_query->row['weight_prefix']
									);
								}
							} elseif ($option_query->row['type'] == 'checkbox' && is_array($value)) {
								foreach ($value as $product_option_value_id) {
									$option_value_query = $this->db->query("SELECT pov.option_value_id, ovd.name, pov.quantity, pov.subtract, pov.price, pov.price_prefix, pov.points, pov.points_prefix, pov.weight, pov.weight_prefix FROM " . DB_PREFIX . "product_option_value pov LEFT JOIN " . DB_PREFIX . "option_value ov ON (pov.option_value_id = ov.option_value_id) LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON (ov.option_value_id = ovd.option_value_id) WHERE pov.product_option_value_id = '" . (int)$product_option_value_id . "' AND pov.product_option_id = '" . (int)$product_option_id . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

									if ($option_value_query->num_rows) {
										if ($option_value_query->row['price_prefix'] == '+') {
											$option_price += $option_value_query->row['price'];
										} elseif ($option_value_query->row['price_prefix'] == '-') {
											$option_price -= $option_value_query->row['price'];
										}

										if ($option_value_query->row['points_prefix'] == '+') {
											$option_points += $option_value_query->row['points'];
										} elseif ($option_value_query->row['points_prefix'] == '-') {
											$option_points -= $option_value_query->row['points'];
										}

										if ($option_value_query->row['weight_prefix'] == '+') {
											$option_weight += $option_value_query->row['weight'];
										} elseif ($option_value_query->row['weight_prefix'] == '-') {
											$option_weight -= $option_value_query->row['weight'];
										}

										if ($option_value_query->row['subtract'] && (!$option_value_query->row['quantity'] || ($option_value_query->row['quantity'] < $quantity))) {
											$stock = false;
										}

										$option_data[] = array(
											'product_option_id'       => $product_option_id,
											'product_option_value_id' => $product_option_value_id,
											'option_id'               => $option_query->row['option_id'],
											'option_value_id'         => $option_value_query->row['option_value_id'],
											'name'                    => $option_query->row['name'],
											'value'                   => $option_value_query->row['name'],
											'type'                    => $option_query->row['type'],
											'quantity'                => $option_value_query->row['quantity'],
											'subtract'                => $option_value_query->row['subtract'],
											'price'                   => $option_value_query->row['price'],
											'price_prefix'            => $option_value_query->row['price_prefix'],
											'points'                  => $option_value_query->row['points'],
											'points_prefix'           => $option_value_query->row['points_prefix'],
											'weight'                  => $option_value_query->row['weight'],
											'weight_prefix'           => $option_value_query->row['weight_prefix']
										);
									}
								}
							} elseif ($option_query->row['type'] == 'text' || $option_query->row['type'] == 'textarea' || $option_query->row['type'] == 'file' || $option_query->row['type'] == 'date' || $option_query->row['type'] == 'datetime' || $option_query->row['type'] == 'time') {
								$option_data[] = array(
									'product_option_id'       => $product_option_id,
									'product_option_value_id' => '',
									'option_id'               => $option_query->row['option_id'],
									'option_value_id'         => '',
									'name'                    => $option_query->row['name'],
									'value'                   => $value,
									'type'                    => $option_query->row['type'],
									'quantity'                => '',
									'subtract'                => '',
									'price'                   => '',
									'price_prefix'            => '',
									'points'                  => '',
									'points_prefix'           => '',
									'weight'                  => '',
									'weight_prefix'           => ''
								);
							}
						}
					}

					// Reward Points
					$product_reward_query = $this->db->query("SELECT points FROM " . DB_PREFIX . "product_reward WHERE product_id = '" . (int)$product_id . "' AND customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "'");

					if ($product_reward_query->num_rows) {
						$reward = $product_reward_query->row['points'];
					} else {
						$reward = 0;
					}

					// Downloads
					$download_data = array();

					$download_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_download p2d LEFT JOIN " . DB_PREFIX . "download d ON (p2d.download_id = d.download_id) LEFT JOIN " . DB_PREFIX . "download_description dd ON (d.download_id = dd.download_id) WHERE p2d.product_id = '" . (int)$product_id . "' AND dd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

					foreach ($download_query->rows as $download) {
						$download_data[] = array(
							'download_id' => $download['download_id'],
							'name'        => $download['name'],
							'filename'    => $download['filename'],
							'mask'        => $download['mask']
						);
					}

					// Stock
					if (!$product_query->row['quantity'] || ($product_query->row['quantity'] < $quantity)) {
						$stock = false;
					}

					$recurring_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "recurring` `p` JOIN `" . DB_PREFIX . "product_recurring` `pp` ON `pp`.`recurring_id` = `p`.`recurring_id` AND `pp`.`product_id` = " . (int)$product_query->row['product_id'] . " JOIN `" . DB_PREFIX . "recurring_description` `pd` ON `pd`.`recurring_id` = `p`.`recurring_id` AND `pd`.`language_id` = " . (int)$this->config->get('config_language_id') . " WHERE `pp`.`recurring_id` = " . (int)$recurring_id . " AND `status` = 1 AND `pp`.`customer_group_id` = " . (int)$this->config->get('config_customer_group_id'));

					if ($recurring_query->num_rows) {
						$recurring = array(
							'recurring_id'    => $recurring_id,
							'name'            => $recurring_query->row['name'],
							'frequency'       => $recurring_query->row['frequency'],
							'price'           => $recurring_query->row['price'],
							'cycle'           => $recurring_query->row['cycle'],
							'duration'        => $recurring_query->row['duration'],
							'trial'           => $recurring_query->row['trial_status'],
							'trial_frequency' => $recurring_query->row['trial_frequency'],
							'trial_price'     => $recurring_query->row['trial_price'],
							'trial_cycle'     => $recurring_query->row['trial_cycle'],
							'trial_duration'  => $recurring_query->row['trial_duration']
						);
					} else {
						$recurring = false;
					}

					$this->data[$key] = array(
						'group'           => $group,
						'product_id'      => $product_query->row['product_id'],
						'name'            => $product_query->row['name'],
						'model'           => $product_query->row['model'],
						'shipping'        => $product_query->row['shipping'],
						'image'           => $product_query->row['image_http'] ? 'http://'.$product_query->row['image'] : $product_query->row['image'],
						'option'          => $option_data,
						'download'        => $download_data,
						'quantity'        => $quantity,
						'minimum'         => $product_query->row['minimum'],
						'subtract'        => $product_query->row['subtract'],
						'stock'           => $stock,
						'price'           => $price,
						'total'           => $price * $quantity,
						'reward'          => 0,
						'points'          => 0,
						'tax_class_id'    => $product_query->row['tax_class_id'],
						'weight'          => ($product_query->row['weight'] + $option_weight) * $quantity,
						'weight_class_id' => $product_query->row['weight_class_id'],
						'length'          => $product_query->row['length'],
						'width'           => $product_query->row['width'],
						'height'          => $product_query->row['height'],
						'length_class_id' => $product_query->row['length_class_id'],
						'recurring'       => $recurring
					);
				} else {
					$this->remove($key);
				}
			}
		}

		return $this->data;
	}

	public function add($product_id, $price, $group, $qty = 1, $option = array(), $recurring_id = 0) {
		$this->data = array();
		$product = array();

		$product['product_id'] = (int)$product_id;
		$product['price'] = (float)$price;
		$product['group'] = (int)$group;

		if ($option) {
			$product['option'] = $option;
		}

		if ($recurring_id) {
			$product['recurring_id'] = (int)$recurring_id;
		}

		$key = base64_encode(serialize($product));

		if ((int)$qty && ((int)$qty > 0)) {
			if (!isset($this->session->data['gift'][$key])) {
				$this->session->data['gift'][$key] = (int)$qty;
			} else {
				$this->session->data['gift'][$key] = (int)$qty;
			}
		}
	}

	public function remove($key) {
		$this->data = array();
		
		if (isset($this->session->data['gift_discount'])) {
			//unset($this->session->data['gift_discount']);
			
			foreach ($this->session->data['gift_discount'] as $k => $v) {
				if ($key == $k) {
					unset($this->session->data['gift_discount'][$k]);
					break;
				}
			}
		}
		
		if (isset($this->session->data['gift'])) {
			unset($this->session->data['gift'][$key]);
		}
	}

	public function clear() {
		$this->data = array();

		$this->session->data['gift'] = array();
		$this->session->data['gift_discount'] = array();
	}

	public function getWeight() {
		$weight = 0;

		foreach ($this->getProducts() as $product) {
			if ($product['shipping']) {
				$weight += $this->weight->convert($product['weight'], $product['weight_class_id'], $this->config->get('config_weight_class_id'));
			}
		}

		return $weight;
	}

	public function getSubTotal() {
		$total = 0;

		foreach ($this->getProducts() as $product) {
			$total += $product['total'];
		}

		return $total;
	}

	public function getTaxes() {
		$tax_data = array();

		foreach ($this->getProducts() as $product) {
			if ($product['tax_class_id']) {
				$tax_rates = $this->tax->getRates($product['price'], $product['tax_class_id']);

				foreach ($tax_rates as $tax_rate) {
					if (!isset($tax_data[$tax_rate['tax_rate_id']])) {
						$tax_data[$tax_rate['tax_rate_id']] = ($tax_rate['amount'] * $product['quantity']);
					} else {
						$tax_data[$tax_rate['tax_rate_id']] += ($tax_rate['amount'] * $product['quantity']);
					}
				}
			}
		}

		return $tax_data;
	}

	public function getTotal() {
		$total = 0;

		foreach ($this->getProducts() as $product) {
			$total += $this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')) * $product['quantity'];
		}

		return $total;
	}

	public function countProducts() {
		$product_total = 0;

		$products = $this->getProducts();

		foreach ($products as $product) {
			$product_total += $product['quantity'];
		}

		return $product_total;
	}

	public function hasProducts() {
		return count($this->session->data['gift']);
	}

	public function hasStock() {
		$stock = true;

		foreach ($this->getProducts() as $product) {
			if (!$product['stock']) {
				$stock = false;
			}
		}

		return $stock;
	}

	public function hasShipping() {
		$shipping = false;

		foreach ($this->getProducts() as $product) {
			if ($product['shipping']) {
				$shipping = true;

				break;
			}
		}

		return $shipping;
	}

	public function hasDownload() {
		$download = false;

		foreach ($this->getProducts() as $product) {
			if ($product['download']) {
				$download = true;

				break;
			}
		}

		return $download;
	}
}