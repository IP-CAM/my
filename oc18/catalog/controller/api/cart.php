<?php
class ControllerApiCart extends Controller {
	private $error = array();
	
	public function add() {
		$this->load->language('api/cart');

		$json = array();
		
		if (isset($this->request->post['currency_code'])) {
			$this->currency->set($this->request->post['currency_code']);
		}

		if (!isset($this->session->data['api_id'])) {
			$json['error']['warning'] = $this->language->get('error_permission');
		} else {
			$this->load->model('catalog/product');
			
			if (isset($this->request->post['product'])) {				
				$this->cart->clear();
				
				foreach ($this->request->post['product'] as $product) {
					$product_info = $this->model_catalog_product->getProduct($product['product_id']);
					
					if ($product_info) {
						if (isset($product['option'])) {
							$option = array_filter($product['option']);
						} else {
							$option = array();
						}
						
						if (!(int)$product['is_gift']) {
							$this->cart->add($product['product_id'], $product['quantity'], $option);
						}
					} else {
						$json['error']['store'] = $this->language->get('error_store');
					}
				}
				
				$this->gift->clear();
				
				foreach ($this->request->post['product'] as $product) {
					if ((int)$product['is_gift']) {
						$giftProduct = $this->gift->getGiftProduct($product['product_id']);
						
						if ($giftProduct) {
							$this->gift->add($product['product_id'], $giftProduct['price'], $giftProduct['group']);
						}
					}
				}
				
				if (isset($this->request->post['gift_discount'])) {
					$this->gift->getGiftDiscount($this->request->post['gift_discount']);
				}
				
				if (isset($this->request->post['point'])) {
					$this->session->data['point'] = (int)$this->request->post['point'];
				} else {
					unset($this->session->data['point']);
				}
			}
			
			if (isset($this->request->post['product_id'])) {
				$product_info = $this->model_catalog_product->getProduct($this->request->post['product_id']);

				if ($product_info) {
					if (isset($this->request->post['quantity'])) {
						$quantity = $this->request->post['quantity'];
					} else {
						$quantity = 1;
					}

					if (isset($this->request->post['option'])) {
						$option = array_filter($this->request->post['option']);
					} else {
						$option = array();
					}

					$product_options = $this->model_catalog_product->getProductOptions($this->request->post['product_id']);

					foreach ($product_options as $product_option) {
						if ($product_option['required'] && empty($option[$product_option['product_option_id']])) {
							$json['error']['option'][$product_option['product_option_id']] = sprintf($this->language->get('error_required'), $product_option['name']);
						}
					}

					if (!isset($json['error']['option'])) {
						$this->cart->add($this->request->post['product_id'], $quantity, $option);

						$json['success'] = $this->language->get('text_success');

						unset($this->session->data['shipping_method']);
						unset($this->session->data['shipping_methods']);
						unset($this->session->data['payment_method']);
						unset($this->session->data['payment_methods']);
					}
				} else {
					$json['error']['store'] = $this->language->get('error_store');
				}
			}
			
			if (!$this->checkCustomer() || !$this->checkAddress() || !$this->checkPaymentMethod() || !$this->checkShippingMethod()) {
				$json['error']['warning'] = $this->error['error'];
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function edit() {
		$this->load->language('api/cart');

		$json = array();

		if (!isset($this->session->data['api_id'])) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			$this->cart->update($this->request->post['key'], $this->request->post['quantity']);

			$json['success'] = $this->language->get('text_success');

			unset($this->session->data['shipping_method']);
			unset($this->session->data['shipping_methods']);
			unset($this->session->data['payment_method']);
			unset($this->session->data['payment_methods']);
			unset($this->session->data['reward']);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function remove() {
		$this->load->language('api/cart');

		$json = array();

		if (!isset($this->session->data['api_id'])) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			// Remove
			if (isset($this->request->post['key'])) {
				$this->cart->remove($this->request->post['key']);

				unset($this->session->data['vouchers'][$this->request->post['key']]);

				$json['success'] = $this->language->get('text_success');

				unset($this->session->data['shipping_method']);
				unset($this->session->data['shipping_methods']);
				unset($this->session->data['payment_method']);
				unset($this->session->data['payment_methods']);
				unset($this->session->data['reward']);
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function products() {
		$this->load->language('api/cart');

		$json = array();

		if (!isset($this->session->data['api_id'])) {
			$json['error']['warning'] = $this->language->get('error_permission');
		} else {
			// Stock
			if (!$this->cart->hasStock() && (!$this->config->get('config_stock_checkout') || $this->config->get('config_stock_warning'))) {
				$json['error']['stock'] = $this->language->get('error_stock');
			}

			// Products
			$json['products'] = array();

			$products = $this->cart->getProducts();

			foreach ($products as $product) {
				$product_total = 0;

				foreach ($products as $product_2) {
					if ($product_2['product_id'] == $product['product_id']) {
						$product_total += $product_2['quantity'];
					}
				}

				if ($product['minimum'] > $product_total) {
					$json['error']['minimum'][] = sprintf($this->language->get('error_minimum'), $product['name'], $product['minimum']);
				}

				$option_data = array();

				foreach ($product['option'] as $option) {
					$option_data[] = array(
						'product_option_id'       => $option['product_option_id'],
						'product_option_value_id' => $option['product_option_value_id'],
						'name'                    => $option['name'],
						'value'                   => $option['value'],
						'type'                    => $option['type']
					);
				}

				$json['products'][] = array(
					'key'        => $product['key'],
					'product_id' => $product['product_id'],
					'is_gift'    => '0',
					'name'       => $product['name'],
					'model'      => $product['model'],
					'option'     => $option_data,
					'quantity'   => $product['quantity'],
					'stock'      => $product['stock'] ? true : !(!$this->config->get('config_stock_checkout') || $this->config->get('config_stock_warning')),
					'shipping'   => $product['shipping'],
					'price'      => $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax'))),
					'total'      => $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')) * $product['quantity']),
					'reward'     => $product['reward']
				);
			}

			$products = $this->gift->getProducts();

			foreach ($products as $key => $product) {
				$product_total = 0;

				foreach ($products as $product_2) {
					if ($product_2['product_id'] == $product['product_id']) {
						$product_total += $product_2['quantity'];
					}
				}

				if ($product['minimum'] > $product_total) {
					$json['error']['minimum'][] = sprintf($this->language->get('error_minimum'), $product['name'], $product['minimum']);
				}

				$option_data = array();

				foreach ($product['option'] as $option) {
					$option_data[] = array(
						'product_option_id'       => $option['product_option_id'],
						'product_option_value_id' => $option['product_option_value_id'],
						'name'                    => $option['name'],
						'value'                   => $option['value'],
						'type'                    => $option['type']
					);
				}

				$json['products'][] = array(
					'key'        => $key,
					'product_id' => $product['product_id'],
					'is_gift'    => '1',
					'name'       => $product['name'],
					'model'      => $product['model'],
					'option'     => $option_data,
					'quantity'   => $product['quantity'],
					'stock'      => $product['stock'] ? true : !(!$this->config->get('config_stock_checkout') || $this->config->get('config_stock_warning')),
					'shipping'   => $product['shipping'],
					'price'      => $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax'))),
					'total'      => $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')) * $product['quantity']),
					'reward'     => 0
				);
			}

			// Voucher
			$json['vouchers'] = array();

			if (!empty($this->session->data['vouchers'])) {
				foreach ($this->session->data['vouchers'] as $key => $voucher) {
					$json['vouchers'][] = array(
						'code'             => $voucher['code'],
						'description'      => $voucher['description'],
						'from_name'        => $voucher['from_name'],
						'from_email'       => $voucher['from_email'],
						'to_name'          => $voucher['to_name'],
						'to_email'         => $voucher['to_email'],
						'voucher_theme_id' => $voucher['voucher_theme_id'],
						'message'          => $voucher['message'],
						'amount'           => $this->currency->format($voucher['amount'])
					);
				}
			}

			// Totals
			$this->load->model('extension/extension');

			$total_data = array();
			$total = 0;
			$taxes = $this->cart->getTaxes();

			$sort_order = array();

			$results = $this->model_extension_extension->getExtensions('total');

			foreach ($results as $key => $value) {
				$sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
			}

			array_multisort($sort_order, SORT_ASC, $results);

			foreach ($results as $result) {
				if ($this->config->get($result['code'] . '_status')) {
					$this->load->model('total/' . $result['code']);

					$this->{'model_total_' . $result['code']}->getTotal($total_data, $total, $taxes);
				}
			}

			$sort_order = array();

			foreach ($total_data as $key => $value) {
				$sort_order[$key] = $value['sort_order'];
			}

			array_multisort($sort_order, SORT_ASC, $total_data);

			$json['totals'] = array();

			foreach ($total_data as $total) {
				$json['totals'][] = array(
					'title' => $total['title'],
					'code'  => $total['code'],
					'value' => $total['value'],
					'text'  => $this->currency->format($total['value'])
				);
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	private function checkCustomer() {
		if ($this->error) {
			return false;
		}
		
		$this->load->language('api/customer');
		
		// Customer
		if ($this->request->post['customer_id']) {
			$this->load->model('account/customer');

			$customer_info = $this->model_account_customer->getCustomer($this->request->post['customer_id']);

			if (!$customer_info || !$customer_info['status'] || !$customer_info['approved']) {
				$this->error['error'] = $this->language->get('error_customer');
			} else {
				$this->session->data['customer_id'] = $this->request->post['customer_id'];
			}
		}

		if ((utf8_strlen(trim($this->request->post['firstname'])) < 1) || (utf8_strlen(trim($this->request->post['firstname'])) > 32)) {
			$this->error['error'] = $this->language->get('error_firstname');
		}
		
		if ((utf8_strlen($this->request->post['email']) > 96) || (!preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $this->request->post['email']))) {
			$this->error['error'] = $this->language->get('error_email');
		}

		if ((utf8_strlen($this->request->post['telephone']) < 3) || (utf8_strlen($this->request->post['telephone']) > 32)) {
			$this->error['error'] = $this->language->get('error_telephone');
		}
		
		if (isset($this->request->post['customer_group_id'])) {
			$customer_group_id = $this->request->post['customer_group_id'];
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

		// Custom field validation
		$this->load->model('account/custom_field');

		$custom_fields = $this->model_account_custom_field->getCustomFields($customer_group_id);

		foreach ($custom_fields as $custom_field) {
			if (($custom_field['location'] == 'account') && $custom_field['required'] && empty($this->request->post['custom_field'][$custom_field['custom_field_id']])) {
				$this->error['error'] = sprintf($this->language->get('error_custom_field'), $custom_field['name']);
			}
		}

		if (!$this->error) {
			$this->session->data['customer'] = array(
				'customer_id'       => $this->request->post['customer_id'],
				'customer_group_id' => $customer_group_id,
				'firstname'         => $this->request->post['firstname'],
				'lastname'          => $this->request->post['lastname'],
				'email'             => $this->request->post['email'],
				'telephone'         => $this->request->post['telephone'],
				'fax'               => $this->request->post['fax'],
				'custom_field'      => isset($this->request->post['custom_field']) ? $this->request->post['custom_field'] : array()
			);
			
			return true;
		} else {
			return false;
		}
	}

	private function checkAddress() {
		if ($this->error) {
			return false;
		}
		
		$this->load->language('api/payment');
		
		if ((utf8_strlen(trim($this->request->post['firstname'])) < 1) || (utf8_strlen(trim($this->request->post['firstname'])) > 32)) {
			$this->error['error'] = $this->language->get('error_firstname');
		}

		if ((utf8_strlen(trim($this->request->post['address_1'])) < 3) || (utf8_strlen(trim($this->request->post['address_1'])) > 128)) {
			$this->error['error'] = $this->language->get('error_address_1');
		}

		$this->load->model('localisation/country');

		$country_info = $this->model_localisation_country->getCountry($this->request->post['country_id']);

		if ($country_info && $country_info['postcode_required'] && (utf8_strlen(trim($this->request->post['postcode'])) < 2 || utf8_strlen(trim($this->request->post['postcode'])) > 10)) {
			$this->error['error'] = $this->language->get('error_postcode');
		}

		if ($this->request->post['country_id'] == '') {
			$this->error['error'] = $this->language->get('error_country');
		}

		if (!isset($this->request->post['zone_id']) || $this->request->post['zone_id'] == '') {
			$this->error['error'] = $this->language->get('error_zone');
		}

		// Custom field validation
		$this->load->model('account/custom_field');

		$custom_fields = $this->model_account_custom_field->getCustomFields($this->config->get('config_customer_group_id'));

		foreach ($custom_fields as $custom_field) {
			if (($custom_field['location'] == 'address') && $custom_field['required'] && empty($this->request->post['custom_field'][$custom_field['custom_field_id']])) {
				$this->error['error'] = sprintf($this->language->get('error_custom_field'), $custom_field['name']);
			}
		}
		
		if (!$this->error) {
			$this->load->model('localisation/country');

			$country_info = $this->model_localisation_country->getCountry($this->request->post['country_id']);

			if ($country_info) {
				$country = $country_info['name'];
				$iso_code_2 = $country_info['iso_code_2'];
				$iso_code_3 = $country_info['iso_code_3'];
				$address_format = $country_info['address_format'];
			} else {
				$country = '';
				$iso_code_2 = '';
				$iso_code_3 = '';
				$address_format = '';
			}

			$this->load->model('localisation/zone');

			$zone_info = $this->model_localisation_zone->getZone($this->request->post['zone_id']);

			if ($zone_info) {
				$zone = $zone_info['name'];
				$zone_code = $zone_info['code'];
			} else {
				$zone = '';
				$zone_code = '';
			}

			$this->session->data['payment_address'] = array(
				'firstname'      => $this->request->post['firstname'],
				'lastname'       => $this->request->post['lastname'],
				'company'        => $this->request->post['company'],
				'address_1'      => $this->request->post['address_1'],
				'address_2'      => $this->request->post['address_2'],
				'postcode'       => $this->request->post['postcode'],
				'city'           => $this->request->post['city'],
				'zone_id'        => $this->request->post['zone_id'],
				'zone'           => $zone,
				'zone_code'      => $zone_code,
				'country_id'     => $this->request->post['country_id'],
				'country'        => $country,
				'iso_code_2'     => $iso_code_2,
				'iso_code_3'     => $iso_code_3,
				'address_format' => $address_format,
				'custom_field'   => isset($this->request->post['custom_field']) ? $this->request->post['custom_field'] : array()
			);
			
			return true;
		} else {
			return false;
		}
	}

	private function checkPaymentMethod() {
		if ($this->error) {
			return false;
		}
		
		$this->load->language('api/payment');
		
		if (!isset($this->session->data['payment_address'])) {
			$this->error['error'] = $this->language->get('error_address');
		}
		
		if (!$this->error) {
			// Totals
			$total_data = array();
			$total = 0;
			$taxes = $this->cart->getTaxes();

			$this->load->model('extension/extension');

			$sort_order = array();

			$results = $this->model_extension_extension->getExtensions('total');

			foreach ($results as $key => $value) {
				$sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
			}

			array_multisort($sort_order, SORT_ASC, $results);

			foreach ($results as $result) {
				if ($this->config->get($result['code'] . '_status')) {
					$this->load->model('total/' . $result['code']);

					$this->{'model_total_' . $result['code']}->getTotal($total_data, $total, $taxes);
				}
			}

			// Payment Methods
			$payment_methods = array();

			$results = $this->model_extension_extension->getExtensions('payment');

			$recurring = $this->cart->hasRecurringProducts();

			foreach ($results as $result) {
				if ($this->config->get($result['code'] . '_status')) {
					$this->load->model('payment/' . $result['code']);

					$method = $this->{'model_payment_' . $result['code']}->getMethod($this->session->data['payment_address'], $total);

					if ($method) {
						if ($recurring) {
							if (method_exists($this->{'model_payment_' . $result['code']}, 'recurringPayments') && $this->{'model_payment_' . $result['code']}->recurringPayments()) {
								$payment_methods[$result['code']] = $method;
							}
						} else {
							$payment_methods[$result['code']] = $method;
						}
					}
				}
			}

			$sort_order = array();

			foreach ($payment_methods as $key => $value) {
				$sort_order[$key] = $value['sort_order'];
			}

			array_multisort($sort_order, SORT_ASC, $payment_methods);

			if ($payment_methods) {
				$this->session->data['payment_methods'] = $payment_methods;
				
				// Payment Method
				if (!isset($this->request->post['payment_method'])) {
					$this->error['error'] = $this->language->get('error_method');
				} elseif (!isset($this->session->data['payment_methods'][$this->request->post['payment_method']])) {
					$this->error['error'] = $this->language->get('error_method');
				} else {
					$this->session->data['payment_method'] = $this->session->data['payment_methods'][$this->request->post['payment_method']];
				}
			} else {
				$this->error['error'] = $this->language->get('error_no_payment');
			}
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
	
	private function checkShippingMethod() {
		if ($this->error) {
			return false;
		}
		
		$this->load->language('api/shipping');
		
		if (!isset($this->session->data['payment_address'])) {
			$this->error['error'] = $this->language->get('payment_address');
		}
				
		if (!$this->error) {
			$shipping_methods = array();
			
			$this->load->model('extension/extension');

			$results = $this->model_extension_extension->getExtensions('shipping');

			foreach ($results as $result) {
				if ($this->config->get($result['code'] . '_status')) {
					$this->load->model('shipping/' . $result['code']);

					$quote = $this->{'model_shipping_' . $result['code']}->getQuote($this->session->data['payment_address']);

					if ($quote) {
						$shipping_methods[$result['code']] = array(
							'title'      => $quote['title'],
							'quote'      => $quote['quote'],
							'sort_order' => $quote['sort_order'],
							'error'      => $quote['error']
						);
					}
				}
			}

			$sort_order = array();

			foreach ($shipping_methods as $key => $value) {
				$sort_order[$key] = $value['sort_order'];
			}

			array_multisort($sort_order, SORT_ASC, $shipping_methods);

			if ($shipping_methods) {
				$this->session->data['shipping_methods'] = $shipping_methods;
				
				if (!isset($this->request->post['shipping_method'])) {
					$this->error['error'] = $this->language->get('error_method');
				} else {
					$shipping = explode('.', $this->request->post['shipping_method']);

					if (!isset($shipping[0]) || !isset($shipping[1]) || !isset($this->session->data['shipping_methods'][$shipping[0]]['quote'][$shipping[1]])) {
						$this->error['error'] = $this->language->get('error_method');
					} else {
						$this->session->data['shipping_method'] = $this->session->data['shipping_methods'][$shipping[0]]['quote'][$shipping[1]];
					}
				}
			} else {
				$this->error['error'] = $this->language->get('error_no_shipping');
			}
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
}