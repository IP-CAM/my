<?php
class ControllerApiOrder extends Controller {
	private $error = array();
	
	public function add() {
		$this->load->language('api/cart');
		$this->load->language('api/order');

		$json = array();

		if (!isset($this->session->data['api_id'])) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			if (isset($this->request->post['product'])) {
				$this->cart->clear();
				
				foreach ($this->request->post['product'] as $product) {
					if (isset($product['option'])) {
						$option = $product['option'];
					} else {
						$option = array();
					}
					
					if (!(int)$product['is_gift']) {
						$this->cart->add($product['product_id'], $product['quantity'], $option);
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
			
			if ($this->checkCustomer() && $this->checkAddress() && $this->checkPaymentMethod() && $this->checkShippingMethod()) {
				$this->load->language('api/order');
				
				// Customer
				if (!isset($this->session->data['customer'])) {
					$json['error'] = $this->language->get('error_customer');
				}
	
				// Payment Address
				if (!isset($this->session->data['payment_address'])) {
					$json['error'] = $this->language->get('error_payment_address');
				}
	
				// Payment Method
				if (!isset($this->session->data['payment_method'])) {
					$json['error'] = $this->language->get('error_payment_method');
				}
	
				// Shipping
				if ($this->cart->hasShipping()) {
					// Shipping Address
					/*if (!isset($this->session->data['payment_address'])) {
						$json['error'] = $this->language->get('error_shipping_address');
					}*/
	
					// Shipping Method
					if (!isset($this->request->post['shipping_method'])) {
						$json['error'] = $this->language->get('error_shipping_method');
					}
				} else {
					unset($this->session->data['shipping_address']);
					unset($this->session->data['shipping_method']);
					unset($this->session->data['shipping_methods']);
				}
	
				// Cart
				if ((!$this->cart->hasProducts() && empty($this->session->data['vouchers'])) || (!$this->cart->hasStock() && !$this->config->get('config_stock_checkout'))) {
					$json['error'] = $this->language->get('error_stock');
				}
	
				// Validate minimum quantity requirements.
				$products = $this->cart->getProducts();
	
				foreach ($products as $product) {
					$product_total = 0;
	
					foreach ($products as $product_2) {
						if ($product_2['product_id'] == $product['product_id']) {
							$product_total += $product_2['quantity'];
						}
					}
	
					if ($product['minimum'] > $product_total) {
						$json['error'] = sprintf($this->language->get('error_minimum'), $product['name'], $product['minimum']);
	
						break;
					}
				}
	
				if (!$json) {
					$order_data = array();
	
					// Store Details
					$order_data['invoice_prefix'] = $this->config->get('config_invoice_prefix');
					$order_data['store_id'] = $this->config->get('config_store_id');
					$order_data['store_name'] = $this->config->get('config_name');
					$order_data['store_url'] = $this->config->get('config_url');
	
					// Customer Details
					$order_data['customer_id'] = $this->session->data['customer']['customer_id'];
					$order_data['customer_group_id'] = $this->session->data['customer']['customer_group_id'];
					$order_data['firstname'] = $this->session->data['customer']['firstname'];
					$order_data['lastname'] = $this->session->data['customer']['lastname'];
					$order_data['email'] = $this->session->data['customer']['email'];
					$order_data['telephone'] = $this->session->data['customer']['telephone'];
					$order_data['fax'] = $this->session->data['customer']['fax'];
					$order_data['custom_field'] = $this->session->data['customer']['custom_field'];
	
					// Payment Details
					$order_data['payment_firstname'] = $this->session->data['payment_address']['firstname'];
					$order_data['payment_lastname'] = $this->session->data['payment_address']['lastname'];
					$order_data['payment_company'] = $this->session->data['payment_address']['company'];
					$order_data['payment_address_1'] = $this->session->data['payment_address']['address_1'];
					$order_data['payment_address_2'] = $this->session->data['payment_address']['address_2'];
					$order_data['payment_city'] = $this->session->data['payment_address']['city'];
					$order_data['payment_postcode'] = $this->session->data['payment_address']['postcode'];
					$order_data['payment_zone'] = $this->session->data['payment_address']['zone'];
					$order_data['payment_zone_id'] = $this->session->data['payment_address']['zone_id'];
					$order_data['payment_country'] = $this->session->data['payment_address']['country'];
					$order_data['payment_country_id'] = $this->session->data['payment_address']['country_id'];
					$order_data['payment_address_format'] = $this->session->data['payment_address']['address_format'];
					$order_data['payment_custom_field'] = (isset($this->session->data['payment_address']['custom_field']) ? $this->session->data['payment_address']['custom_field'] : array());
	
					if (isset($this->session->data['payment_method']['title'])) {
						$order_data['payment_method'] = $this->session->data['payment_method']['title'];
					} else {
						$order_data['payment_method'] = '';
					}
	
					if (isset($this->session->data['payment_method']['code'])) {
						$order_data['payment_code'] = $this->session->data['payment_method']['code'];
					} else {
						$order_data['payment_code'] = '';
					}
	
					// Shipping Details
					if ($this->cart->hasShipping()) {
						$order_data['shipping_firstname'] = $this->session->data['payment_address']['firstname'];
						$order_data['shipping_lastname'] = $this->session->data['payment_address']['lastname'];
						$order_data['shipping_company'] = $this->session->data['payment_address']['company'];
						$order_data['shipping_address_1'] = $this->session->data['payment_address']['address_1'];
						$order_data['shipping_address_2'] = $this->session->data['payment_address']['address_2'];
						$order_data['shipping_city'] = $this->session->data['payment_address']['city'];
						$order_data['shipping_postcode'] = $this->session->data['payment_address']['postcode'];
						$order_data['shipping_zone'] = $this->session->data['payment_address']['zone'];
						$order_data['shipping_zone_id'] = $this->session->data['payment_address']['zone_id'];
						$order_data['shipping_country'] = $this->session->data['payment_address']['country'];
						$order_data['shipping_country_id'] = $this->session->data['payment_address']['country_id'];
						$order_data['shipping_address_format'] = $this->session->data['payment_address']['address_format'];
						$order_data['shipping_custom_field'] = (isset($this->session->data['payment_address']['custom_field']) ? $this->session->data['payment_address']['custom_field'] : array());
	
						if (isset($this->session->data['shipping_method']['title'])) {
							$order_data['shipping_method'] = $this->session->data['shipping_method']['title'];
						} else {
							$order_data['shipping_method'] = '';
						}
	
						if (isset($this->session->data['shipping_method']['code'])) {
							$order_data['shipping_code'] = $this->session->data['shipping_method']['code'];
						} else {
							$order_data['shipping_code'] = '';
						}
					} else {
						$order_data['shipping_firstname'] = '';
						$order_data['shipping_lastname'] = '';
						$order_data['shipping_company'] = '';
						$order_data['shipping_address_1'] = '';
						$order_data['shipping_address_2'] = '';
						$order_data['shipping_city'] = '';
						$order_data['shipping_postcode'] = '';
						$order_data['shipping_zone'] = '';
						$order_data['shipping_zone_id'] = '';
						$order_data['shipping_country'] = '';
						$order_data['shipping_country_id'] = '';
						$order_data['shipping_address_format'] = '';
						$order_data['shipping_custom_field'] = array();
						$order_data['shipping_method'] = '';
						$order_data['shipping_code'] = '';
					}
	
					// Products
					$order_data['products'] = array();
	
					foreach ($this->cart->getProducts() as $product) {
						$option_data = array();
	
						foreach ($product['option'] as $option) {
							$option_data[] = array(
								'product_option_id'       => $option['product_option_id'],
								'product_option_value_id' => $option['product_option_value_id'],
								'option_id'               => $option['option_id'],
								'option_value_id'         => $option['option_value_id'],
								'name'                    => $option['name'],
								'value'                   => $option['value'],
								'type'                    => $option['type']
							);
						}
	
						$order_data['products'][] = array(
							'product_id' => $product['product_id'],
							'is_gift'    => '0',
							'name'       => $product['name'],
							'model'      => $product['model'],
							'option'     => $option_data,
							'download'   => $product['download'],
							'quantity'   => $product['quantity'],
							'subtract'   => $product['subtract'],
							'price'      => $product['price'],
							'total'      => $product['total'],
							'tax'        => $this->tax->getTax($product['price'], $product['tax_class_id']),
							'reward'     => $product['reward']
						);
					}
	
					foreach ($this->gift->getProducts() as $product) {
						$option_data = array();

						foreach ($product['option'] as $option) {
							$option_data[] = array(
								'product_option_id'       => $option['product_option_id'],
								'product_option_value_id' => $option['product_option_value_id'],
								'option_id'               => $option['option_id'],
								'option_value_id'         => $option['option_value_id'],
								'name'                    => $option['name'],
								'value'                   => $option['value'],
								'type'                    => $option['type']
							);
						}

						$order_data['products'][] = array(
							'product_id' => $product['product_id'],
							'is_gift'    => '1',
							'name'       => $product['name'],
							'model'      => $product['model'],
							'option'     => $option_data,
							'download'   => $product['download'],
							'quantity'   => $product['quantity'],
							'subtract'   => $product['subtract'],
							'price'      => $product['price'],
							'total'      => $product['total'],
							'tax'        => $this->tax->getTax($product['price'], $product['tax_class_id']),
							'reward'     => 0
						);
					}
	
					// Gift Voucher
					$order_data['vouchers'] = array();
	
					if (!empty($this->session->data['vouchers'])) {
						foreach ($this->session->data['vouchers'] as $voucher) {
							$order_data['vouchers'][] = array(
								'description'      => $voucher['description'],
								'code'             => substr(md5(mt_rand()), 0, 10),
								'to_name'          => $voucher['to_name'],
								'to_email'         => $voucher['to_email'],
								'from_name'        => $voucher['from_name'],
								'from_email'       => $voucher['from_email'],
								'voucher_theme_id' => $voucher['voucher_theme_id'],
								'message'          => $voucher['message'],
								'amount'           => $voucher['amount']
							);
						}
					}
	
					// Order Totals
					$this->load->model('extension/extension');
	
					$order_data['totals'] = array();
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
	
							$this->{'model_total_' . $result['code']}->getTotal($order_data['totals'], $total, $taxes);
						}
					}
	
					$sort_order = array();
	
					foreach ($order_data['totals'] as $key => $value) {
						$sort_order[$key] = $value['sort_order'];
					}
	
					array_multisort($sort_order, SORT_ASC, $order_data['totals']);
	
					if (isset($this->request->post['comment'])) {
						$order_data['comment'] = $this->request->post['comment'];
					} else {
						$order_data['comment'] = '';
					}
	
					$order_data['total'] = $total;
	
					if (isset($this->request->post['affiliate_id'])) {
						$subtotal = $this->cart->getSubTotal();
	
						// Affiliate
						$this->load->model('affiliate/affiliate');
	
						$affiliate_info = $this->model_affiliate_affiliate->getAffiliate($this->request->post['affiliate_id']);
	
						if ($affiliate_info) {
							$order_data['affiliate_id'] = $affiliate_info['affiliate_id'];
							$order_data['commission'] = ($subtotal / 100) * $affiliate_info['commission'];
						} else {
							$order_data['affiliate_id'] = 0;
							$order_data['commission'] = 0;
						}
	
						// Marketing
						$order_data['marketing_id'] = 0;
						$order_data['tracking'] = '';
					} else {
						$order_data['affiliate_id'] = 0;
						$order_data['commission'] = 0;
						$order_data['marketing_id'] = 0;
						$order_data['tracking'] = '';
					}
	
					$order_data['language_id'] = $this->config->get('config_language_id');
					$order_data['currency_id'] = $this->currency->getId();
					$order_data['currency_code'] = $this->currency->getCode();
					$order_data['currency_value'] = $this->currency->getValue($this->currency->getCode());
					$order_data['ip'] = $this->request->server['REMOTE_ADDR'];
	
					if (!empty($this->request->server['HTTP_X_FORWARDED_FOR'])) {
						$order_data['forwarded_ip'] = $this->request->server['HTTP_X_FORWARDED_FOR'];
					} elseif (!empty($this->request->server['HTTP_CLIENT_IP'])) {
						$order_data['forwarded_ip'] = $this->request->server['HTTP_CLIENT_IP'];
					} else {
						$order_data['forwarded_ip'] = '';
					}
	
					if (isset($this->request->server['HTTP_USER_AGENT'])) {
						$order_data['user_agent'] = $this->request->server['HTTP_USER_AGENT'];
					} else {
						$order_data['user_agent'] = '';
					}
	
					if (isset($this->request->server['HTTP_ACCEPT_LANGUAGE'])) {
						$order_data['accept_language'] = $this->request->server['HTTP_ACCEPT_LANGUAGE'];
					} else {
						$order_data['accept_language'] = '';
					}
					
					$this->load->model('checkout/order');
		
					$json['order_id'] = $this->model_checkout_order->addOrder($order_data);
		
					// Set the order history
					if (isset($this->request->post['order_status_id'])) {
						$order_status_id = $this->request->post['order_status_id'];
					} else {
						$order_status_id = $this->config->get('config_order_status_id');
					}
		
					$this->model_checkout_order->addOrderHistory($json['order_id'], $order_status_id, $order_data['comment']);
		
					$json['success'] = $this->language->get('text_success');				
				}
			} else {
				$json['error'] = $this->error;
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function edit() {
		$this->load->language('api/cart');
		$this->load->language('api/order');

		$json = array();

		if (!isset($this->session->data['api_id'])) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			if (isset($this->request->post['product'])) {
				$this->cart->clear();
				
				foreach ($this->request->post['product'] as $product) {
					if (isset($product['option'])) {
						$option = $product['option'];
					} else {
						$option = array();
					}
					
					if (!(int)$product['is_gift']) {
						$this->cart->add($product['product_id'], $product['quantity'], $option);
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
			
			if (!$json) {
				$this->load->model('checkout/order');
	
				if (isset($this->request->get['order_id'])) {
					$order_id = $this->request->get['order_id'];
				} else {
					$order_id = 0;
				}
	
				$order_info = $this->model_checkout_order->getOrder($order_id);
	
				if ($order_info) {
					// Customer
					if (!isset($this->request->post['customer'])) {
						$json['error'] = $this->language->get('error_customer');
					}
	
					// Payment Address
					if (!isset($this->request->post['payment_address'])) {
						$json['error'] = $this->language->get('error_payment_address');
					}
	
					// Payment Method
					if (!isset($this->request->post['payment_method'])) {
						$json['error'] = $this->language->get('error_payment_method');
					}
	
					// Shipping
					if ($this->cart->hasShipping()) {
						// Shipping Address
						/*if (!isset($this->session->data['shipping_address'])) {
							$json['error'] = $this->language->get('error_shipping_address');
						}*/
	
						// Shipping Method
						if (!isset($this->request->post['shipping_method'])) {
							$json['error'] = $this->language->get('error_shipping_method');
						}
					} else {
						unset($this->session->data['shipping_address']);
						unset($this->session->data['shipping_method']);
						unset($this->session->data['shipping_methods']);
					}
	
					// Cart
					if ((!$this->cart->hasProducts() && empty($this->session->data['vouchers'])) || (!$this->cart->hasStock() && !$this->config->get('config_stock_checkout'))) {
						$json['error'] = $this->language->get('error_stock');
					}
	
					// Validate minimum quantity requirements.
					$products = $this->cart->getProducts();
	
					foreach ($products as $product) {
						$product_total = 0;
	
						foreach ($products as $product_2) {
							if ($product_2['product_id'] == $product['product_id']) {
								$product_total += $product_2['quantity'];
							}
						}
	
						if ($product['minimum'] > $product_total) {
							$json['error'] = sprintf($this->language->get('error_minimum'), $product['name'], $product['minimum']);
	
							break;
						}
					}
	
					if (!$json && $this->checkCustomer() && $this->checkAddress() && $this->checkPaymentMethod() && $this->checkShippingMethod()) {
						$this->load->language('api/order');
						
						$order_data = array();
	
						// Store Details
						$order_data['invoice_prefix'] = $this->config->get('config_invoice_prefix');
						$order_data['store_id'] = $this->config->get('config_store_id');
						$order_data['store_name'] = $this->config->get('config_name');
						$order_data['store_url'] = $this->config->get('config_url');
	
						// Customer Details
						$order_data['customer_id'] = $this->session->data['customer']['customer_id'];
						$order_data['customer_group_id'] = $this->session->data['customer']['customer_group_id'];
						$order_data['firstname'] = $this->session->data['customer']['firstname'];
						$order_data['lastname'] = $this->session->data['customer']['lastname'];
						$order_data['email'] = $this->session->data['customer']['email'];
						$order_data['telephone'] = $this->session->data['customer']['telephone'];
						$order_data['fax'] = $this->session->data['customer']['fax'];
						$order_data['custom_field'] = $this->session->data['customer']['custom_field'];
						
						// Payment Details
						$order_data['payment_firstname'] = $this->session->data['payment_address']['firstname'];
						$order_data['payment_lastname'] = $this->session->data['payment_address']['lastname'];
						$order_data['payment_company'] = $this->session->data['payment_address']['company'];
						$order_data['payment_address_1'] = $this->session->data['payment_address']['address_1'];
						$order_data['payment_address_2'] = $this->session->data['payment_address']['address_2'];
						$order_data['payment_city'] = $this->session->data['payment_address']['city'];
						$order_data['payment_postcode'] = $this->session->data['payment_address']['postcode'];
						$order_data['payment_zone'] = $this->session->data['payment_address']['zone'];
						$order_data['payment_zone_id'] = $this->session->data['payment_address']['zone_id'];
						$order_data['payment_country'] = $this->session->data['payment_address']['country'];
						$order_data['payment_country_id'] = $this->session->data['payment_address']['country_id'];
						$order_data['payment_address_format'] = $this->session->data['payment_address']['address_format'];
						$order_data['payment_custom_field'] = $this->session->data['payment_address']['custom_field'];
						
						if (isset($this->session->data['payment_method']['title'])) {
							$order_data['payment_method'] = $this->session->data['payment_method']['title'];
						} else {
							$order_data['payment_method'] = '';
						}
	
						if (isset($this->session->data['payment_method']['code'])) {
							$order_data['payment_code'] = $this->session->data['payment_method']['code'];
						} else {
							$order_data['payment_code'] = '';
						}
						
						if ($this->cart->hasShipping()) {
							$order_data['shipping_firstname'] = $this->session->data['payment_address']['firstname'];
							$order_data['shipping_lastname'] = $this->session->data['payment_address']['lastname'];
							$order_data['shipping_company'] = $this->session->data['payment_address']['company'];
							$order_data['shipping_address_1'] = $this->session->data['payment_address']['address_1'];
							$order_data['shipping_address_2'] = $this->session->data['payment_address']['address_2'];
							$order_data['shipping_city'] = $this->session->data['payment_address']['city'];
							$order_data['shipping_postcode'] = $this->session->data['payment_address']['postcode'];
							$order_data['shipping_zone'] = $this->session->data['payment_address']['zone'];
							$order_data['shipping_zone_id'] = $this->session->data['payment_address']['zone_id'];
							$order_data['shipping_country'] = $this->session->data['payment_address']['country'];
							$order_data['shipping_country_id'] = $this->session->data['payment_address']['country_id'];
							$order_data['shipping_address_format'] = $this->session->data['payment_address']['address_format'];
							$order_data['shipping_custom_field'] = $this->session->data['payment_address']['custom_field'];
							
							if (isset($this->session->data['shipping_method']['title'])) {
								$order_data['shipping_method'] = $this->session->data['shipping_method']['title'];
							} else {
								$order_data['shipping_method'] = '';
							}
	
							if (isset($this->session->data['shipping_method']['code'])) {
								$order_data['shipping_code'] = $this->session->data['shipping_method']['code'];
							} else {
								$order_data['shipping_code'] = '';
							}
						} else {
							$order_data['shipping_firstname'] = '';
							$order_data['shipping_lastname'] = '';
							$order_data['shipping_company'] = '';
							$order_data['shipping_address_1'] = '';
							$order_data['shipping_address_2'] = '';
							$order_data['shipping_city'] = '';
							$order_data['shipping_postcode'] = '';
							$order_data['shipping_zone'] = '';
							$order_data['shipping_zone_id'] = '';
							$order_data['shipping_country'] = '';
							$order_data['shipping_country_id'] = '';
							$order_data['shipping_address_format'] = '';
							$order_data['shipping_custom_field'] = array();
							$order_data['shipping_method'] = '';
							$order_data['shipping_code'] = '';
						}
	
						// Products
						$order_data['products'] = array();
	
						foreach ($this->cart->getProducts() as $product) {
							$option_data = array();
	
							foreach ($product['option'] as $option) {
								$option_data[] = array(
									'product_option_id'       => $option['product_option_id'],
									'product_option_value_id' => $option['product_option_value_id'],
									'option_id'               => $option['option_id'],
									'option_value_id'         => $option['option_value_id'],
									'name'                    => $option['name'],
									'value'                   => $option['value'],
									'type'                    => $option['type']
								);
							}
	
							$order_data['products'][] = array(
								'product_id' => $product['product_id'],
								'is_gift'    => '0',
								'name'       => $product['name'],
								'model'      => $product['model'],
								'option'     => $option_data,
								'download'   => $product['download'],
								'quantity'   => $product['quantity'],
								'subtract'   => $product['subtract'],
								'price'      => $product['price'],
								'total'      => $product['total'],
								'tax'        => $this->tax->getTax($product['price'], $product['tax_class_id']),
								'reward'     => $product['reward']
							);
						}
	
						foreach ($this->gift->getProducts() as $product) {
							$option_data = array();
	
							foreach ($product['option'] as $option) {
								$option_data[] = array(
									'product_option_id'       => $option['product_option_id'],
									'product_option_value_id' => $option['product_option_value_id'],
									'option_id'               => $option['option_id'],
									'option_value_id'         => $option['option_value_id'],
									'name'                    => $option['name'],
									'value'                   => $option['value'],
									'type'                    => $option['type']
								);
							}
	
							$order_data['products'][] = array(
								'product_id' => $product['product_id'],
								'is_gift'    => '1',
								'name'       => $product['name'],
								'model'      => $product['model'],
								'option'     => $option_data,
								'download'   => $product['download'],
								'quantity'   => $product['quantity'],
								'subtract'   => $product['subtract'],
								'price'      => $product['price'],
								'total'      => $product['total'],
								'tax'        => $this->tax->getTax($product['price'], $product['tax_class_id']),
								'reward'     => 0
							);
						}
	
						// Gift Voucher
						$order_data['vouchers'] = array();
	
						if (!empty($this->session->data['vouchers'])) {
							foreach ($this->session->data['vouchers'] as $voucher) {
								$order_data['vouchers'][] = array(
									'description'      => $voucher['description'],
									'code'             => substr(md5(mt_rand()), 0, 10),
									'to_name'          => $voucher['to_name'],
									'to_email'         => $voucher['to_email'],
									'from_name'        => $voucher['from_name'],
									'from_email'       => $voucher['from_email'],
									'voucher_theme_id' => $voucher['voucher_theme_id'],
									'message'          => $voucher['message'],
									'amount'           => $voucher['amount']
								);
							}
						}
	
						// Order Totals
						$this->load->model('extension/extension');
	
						$order_data['totals'] = array();
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
	
								$this->{'model_total_' . $result['code']}->getTotal($order_data['totals'], $total, $taxes);
							}
						}
	
						$sort_order = array();
	
						foreach ($order_data['totals'] as $key => $value) {
							$sort_order[$key] = $value['sort_order'];
						}
	
						array_multisort($sort_order, SORT_ASC, $order_data['totals']);
	
						if (isset($this->request->post['comment'])) {
							$order_data['comment'] = $this->request->post['comment'];
						} else {
							$order_data['comment'] = '';
						}
	
						$order_data['total'] = $total;
	
						if (isset($this->request->post['affiliate_id'])) {
							$subtotal = $this->cart->getSubTotal();
	
							// Affiliate
							$this->load->model('affiliate/affiliate');
	
							$affiliate_info = $this->model_affiliate_affiliate->getAffiliate($this->request->post['affiliate_id']);
	
							if ($affiliate_info) {
								$order_data['affiliate_id'] = $affiliate_info['affiliate_id'];
								$order_data['commission'] = ($subtotal / 100) * $affiliate_info['commission'];
							} else {
								$order_data['affiliate_id'] = 0;
								$order_data['commission'] = 0;
							}
						} else {
							$order_data['affiliate_id'] = 0;
							$order_data['commission'] = 0;
						}
	
						$this->model_checkout_order->editOrder($order_id, $order_data);
	
						// Set the order history
						if (isset($this->request->post['order_status_id'])) {
							$order_status_id = $this->request->post['order_status_id'];
						} else {
							$order_status_id = $this->config->get('config_order_status_id');
						}
	
						$this->model_checkout_order->addOrderHistory($order_id, $order_status_id, $order_data['comment']);
	
						$json['success'] = $this->language->get('text_success');
					} else {
						$json['error'] = $this->error['error'];
					}
				} else {
					$json['error'] = $this->language->get('error_not_found');
				}
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function delete() {
		$this->load->language('api/order');

		$json = array();

		if (!isset($this->session->data['api_id'])) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			$this->load->model('checkout/order');

			if (isset($this->request->get['order_id'])) {
				$order_id = $this->request->get['order_id'];
			} else {
				$order_id = 0;
			}

			$order_info = $this->model_checkout_order->getOrder($order_id);

			if ($order_info) {
				$this->model_checkout_order->deleteOrder($order_id);

				$json['success'] = $this->language->get('text_success');
			} else {
				$json['error'] = $this->language->get('error_not_found');
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function history() {
		$this->load->language('api/order');

		$json = array();

		if (!isset($this->session->data['api_id'])) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			// Add keys for missing post vars
			$keys = array(
				'order_status_id',
				'notify',
				'append',
				'comment'
			);

			foreach ($keys as $key) {
				if (!isset($this->request->post[$key])) {
					$this->request->post[$key] = '';
				}
			}

			$this->load->model('checkout/order');

			if (isset($this->request->get['order_id'])) {
				$order_id = $this->request->get['order_id'];
			} else {
				$order_id = 0;
			}

			$order_info = $this->model_checkout_order->getOrder($order_id);

			if ($order_info) {
				$this->model_checkout_order->addOrderHistory($order_id, $this->request->post['order_status_id'], $this->request->post['comment'], $this->request->post['notify']);

				$json['success'] = $this->language->get('text_success');
			} else {
				$json['error'] = $this->language->get('error_not_found');
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
				'firstname'      => $this->request->post['payment_firstname'],
				'lastname'       => $this->request->post['payment_lastname'],
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
						$this->error['error'] = $this->language->get('error_method_city');
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