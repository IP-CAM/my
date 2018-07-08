<?php
class ControllerCheckoutQuickCheckout extends Controller {
	private $error = array();
	private $redirect;
	
	public function index() {
		// Validate cart has products and has stock.
		if ((!$this->cart->hasProducts() && empty($this->session->data['vouchers'])) || (!$this->cart->hasStock() && !$this->config->get('config_stock_checkout'))) {
			$this->response->redirect($this->url->link('checkout/cart'));
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
				$this->response->redirect($this->url->link('checkout/cart'));
			}
		}

		$this->load->language('checkout/quick_checkout');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment.js');
		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js');
		$this->document->addStyle('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css');
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/stylesheet/quick_checkout/qc.css')) {
			$qc_css = 'catalog/view/theme/'.$this->config->get('config_template').'/stylesheet/quick_checkout/qc.css';
			$this->document->addStyle($qc_css);
		}

		// Required by klarna
		if ($this->config->get('klarna_account') || $this->config->get('klarna_invoice')) {
			$this->document->addScript('http://cdn.klarna.com/public/kitt/toc/v1.0/js/klarna.terms.min.js');
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_cart'),
			'href' => $this->url->link('checkout/cart')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('checkout/quick_checkout', '', 'SSL')
		);

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_checkout_option'] = $this->language->get('text_checkout_option');
		$data['text_checkout_account'] = $this->language->get('text_checkout_account');
		$data['text_checkout_payment_address'] = $this->language->get('text_checkout_payment_address');
		$data['text_checkout_shipping_address'] = $this->language->get('text_checkout_shipping_address');
		$data['text_checkout_shipping_method'] = $this->language->get('text_checkout_shipping_method');
		$data['text_checkout_payment_method'] = $this->language->get('text_checkout_payment_method');
		$data['text_checkout_confirm'] = $this->language->get('text_checkout_confirm');
		
		$data['text_checkout_text'] = $this->language->get('text_checkout_text');
		$data['text_login_text'] = $this->language->get('text_login_text');
		$data['text_register_text'] = $this->language->get('text_register_text');
		
		$data['text_shipping_zone'] = $this->language->get('text_shipping_zone');
		$data['text_address_existing'] = $this->language->get('text_address_existing');
		$data['text_address_new'] = $this->language->get('text_address_new');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_loading'] = $this->language->get('text_loading');

		$data['text_recurring_item'] = $this->language->get('text_recurring_item');
		$data['text_payment_recurring'] = $this->language->get('text_payment_recurring');
		$data['text_payment_method'] = $this->language->get('text_payment_method');
		$data['text_comments'] = $this->language->get('text_comments');
		
		$data['text_login'] = $this->language->get('text_login');
		$data['text_register'] = $this->language->get('text_register');
		
		$data['entry_firstname'] = $this->language->get('entry_firstname');
		$data['entry_lastname'] = $this->language->get('entry_lastname');
		$data['entry_company'] = $this->language->get('entry_company');
		$data['entry_address_1'] = $this->language->get('entry_address_1');
		$data['entry_address_2'] = $this->language->get('entry_address_2');
		$data['entry_postcode'] = $this->language->get('entry_postcode');
		$data['entry_city'] = $this->language->get('entry_city');
		$data['entry_country'] = $this->language->get('entry_country');
		$data['entry_zone'] = $this->language->get('entry_zone');

		$data['column_name'] = $this->language->get('column_name');
		$data['column_model'] = $this->language->get('column_model');
		$data['column_quantity'] = $this->language->get('column_quantity');
		$data['column_price'] = $this->language->get('column_price');
		$data['column_total'] = $this->language->get('column_total');
		
		$data['button_confirm'] = $this->language->get('button_confirm');
		
		$data['action'] = $this->url->link('checkout/quick_checkout', '', 'SSL');
		$data['login'] = $this->url->link('account/login', 'redirect='.$this->url->link('checkout/cart', '', 'SSL'), 'SSL');
		$data['register'] = $this->url->link('account/register', '', 'SSL');

		if (isset($this->session->data['error'])) {
			$data['error_warning'] = $this->session->data['error'];
			unset($this->session->data['error']);
		} else {
			$data['error_warning'] = '';
		}

		$data['logged'] = $this->customer->isLogged();
		$data['shipping_required'] = $this->cart->hasShipping();

		if (isset($this->session->data['account'])) {
			$data['account'] = $this->session->data['account'];
		} else {
			$data['account'] = '';
		}
		
		
		
		// ================================================================== //
		// Reset Shipping & Payment Method
		// ================================================================== //
		unset($this->session->data['payment_address']);
		unset($this->session->data['payment_method']);
		unset($this->session->data['shipping_address']);
		unset($this->session->data['shipping_method']);
		unset($this->session->data['shipping_method_payment']);
		unset($this->session->data['shipping_method_store']);
		unset($this->session->data['shipping_method_custom']);
		unset($this->session->data['shipping_method_custom']);
		
		unset($this->session->data['coupon']);
		unset($this->session->data['reward']);
		unset($this->session->data['point']);
		unset($this->session->data['voucher']);
		unset($this->session->data['vouchers']);
		
		//$this->load->model('account/address');
		$this->load->model('localisation/country');
		$this->load->model('localisation/zone');
		
		/*$address = $this->model_account_address->getAddress($this->customer->getAddressId());
		$data['addresses'] = $this->model_account_address->getAddresses();

		if ($address) {
			$this->session->data['shipping_address']['zone'] = $address['zone'];
			$this->session->data['shipping_address']['zone_id'] = $address['zone_id'];
			$this->session->data['shipping_address']['country'] = $address['country'];
			$this->session->data['shipping_address']['country_id'] = $address['country_id'];
			
			$this->session->data['payment_address']['zone'] = $address['zone'];
			$this->session->data['payment_address']['zone_id'] = $address['zone_id'];
			$this->session->data['payment_address']['country'] = $address['country'];
			$this->session->data['payment_address']['country_id'] = $address['country_id'];
		} else {
			$country = $this->model_localisation_country->getCountry($this->config->get('config_country_id'));
			$zone = $this->model_localisation_zone->getZone($this->config->get('config_zone_id'));
			
			$this->session->data['shipping_address']['zone'] = $zone?$zone['name']:'';
			$this->session->data['shipping_address']['zone_id'] = $this->config->get('config_zone_id');
			$this->session->data['shipping_address']['country'] = $country?$country['name']:'';
			$this->session->data['shipping_address']['country_id'] = $this->config->get('config_country_id');
			
			$this->session->data['payment_address']['zone'] = $zone?$zone['name']:'';
			$this->session->data['payment_address']['zone_id'] = $this->config->get('config_zone_id');
			$this->session->data['payment_address']['country'] = $country?$country['name']:'';
			$this->session->data['payment_address']['country_id'] = $this->config->get('config_country_id');
		}
		
		if ($address) {
			$data['country_id'] = $address['country_id'];
			$data['zone_id'] = $address['zone_id'];
		} else {
			$data['country_id'] = $this->config->get('config_country_id');
			$data['zone_id'] = $this->config->get('config_zone_id');
		}*/

		$data['countries'] = $this->model_localisation_country->getCountries();
		$data['zones'] = $this->model_localisation_zone->getZonesByCountryId($this->config->get('config_country_id'));
		
		// ================================================================== //	
		
		$data['tags'] = array();
		
		$comment_text = $this->config->get('order_comment_text');
		
		if ($comment_text && !empty($comment_text[$this->config->get('config_language_id')]) && $this->config->get('order_comment_status')) {
			$comment_text = trim($comment_text[$this->config->get('config_language_id')]);
			
			$tags = explode("\r\n", $comment_text);
			
			foreach ($tags as $tag) {				 
				 $data['tags'][] = trim($tag);
			}
		}
		
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/checkout/quick_checkout.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/checkout/quick_checkout.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/checkout/quick_checkout.tpl', $data));
		}
	}
	
	public function location() {
	}
	
	public function order() {
		$json = array();

		if ($this->validate()) {
			$order_data = array();

			$order_data['totals'] = array();
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

					$this->{'model_total_' . $result['code']}->getTotal($order_data['totals'], $total, $taxes);
				}
			}

			$sort_order = array();

			foreach ($order_data['totals'] as $key => $value) {
				$sort_order[$key] = $value['sort_order'];
			}

			array_multisort($sort_order, SORT_ASC, $order_data['totals']);

			$this->load->language('checkout/checkout');

			$order_data['invoice_prefix'] = $this->config->get('config_invoice_prefix');
			$order_data['store_id'] = $this->config->get('config_store_id');
			$order_data['store_name'] = $this->config->get('config_name');

			if ($order_data['store_id']) {
				$order_data['store_url'] = $this->config->get('config_url');
			} else {
				$order_data['store_url'] = HTTP_SERVER;
			}

			if ($this->customer->isLogged()) {
				$this->load->model('account/customer');

				$customer_info = $this->model_account_customer->getCustomer($this->customer->getId());

				$order_data['customer_id'] = $this->customer->getId();
				$order_data['customer_group_id'] = $customer_info['customer_group_id'];
				$order_data['firstname'] = $customer_info['firstname'];
				$order_data['lastname'] = $customer_info['lastname'];
				$order_data['email'] = $customer_info['email'];
				$order_data['telephone'] = $this->session->data['payment_address']['telephone'];
				$order_data['fax'] = $customer_info['fax'];
				$order_data['custom_field'] = unserialize($customer_info['custom_field']);
			} else {
				$this->session->data['guest']['firstname'] = $this->session->data['payment_address']['firstname'];
				
				$order_data['customer_id'] = 0;
				$order_data['customer_group_id'] = $this->config->get('config_group_id');
				$order_data['firstname'] = $this->session->data['payment_address']['firstname'];
				$order_data['email'] = $this->session->data['payment_address']['email'];
				$order_data['telephone'] = $this->session->data['payment_address']['telephone'];
				$order_data['fax'] = '';
				$order_data['custom_field'] = isset($this->session->data['payment_address']['custom_field'])?$this->session->data['payment_address']['custom_field']:array();
			}

			$order_data['payment_firstname'] = $this->session->data['payment_address']['firstname'];
			$order_data['payment_lastname'] = '';
			$order_data['payment_company'] = '';
			$order_data['payment_address_1'] = $this->session->data['payment_address']['address_1'];
			$order_data['payment_address_2'] = '';
			$order_data['payment_city'] = '';
			$order_data['payment_postcode'] = isset($this->session->data['payment_address']['postcode'])?$this->session->data['payment_address']['postcode']:'';
			$order_data['payment_zone'] = $this->session->data['payment_address']['zone'];
			$order_data['payment_zone_id'] = $this->session->data['payment_address']['zone_id'];
			$order_data['payment_country'] = $this->session->data['payment_address']['country'];
			$order_data['payment_country_id'] = $this->session->data['payment_address']['country_id'];
			$order_data['payment_address_format'] = '';
			$order_data['payment_custom_field'] = (isset($this->session->data['payment_address']['custom_field']) ? $this->session->data['payment_address']['custom_field'] : array());

			if (isset($this->session->data['payment_method']['title'])) {
				$order_data['payment_method'] = $this->session->data['payment_method']['title'];
			} else {
				$order_data['payment_method'] = '';
			}

			if (isset($this->session->data['payment_method']['code'])) {
				$order_data['payment_code'] = $this->session->data['payment_method']['code'];
				
				$redirect = $this->load->controller('payment/'.$this->session->data['payment_method']['code'].'/redirect');
				
				if ($redirect) {
					$this->redirect = $redirect;
				}
			} else {
				$order_data['payment_code'] = '';
			}

			if ($this->cart->hasShipping()) {
				$order_data['shipping_firstname'] = $this->session->data['shipping_address']['firstname'];
				$order_data['shipping_lastname'] = '';
				$order_data['shipping_company'] = '';
				$order_data['shipping_address_1'] = $this->session->data['shipping_address']['address_1'];
				$order_data['shipping_address_2'] = '';
				$order_data['shipping_city'] = '';
				$order_data['shipping_postcode'] = isset($this->session->data['shipping_address']['postcode'])?$this->session->data['shipping_address']['postcode']:'';
				$order_data['shipping_zone'] = $this->session->data['shipping_address']['zone'];
				$order_data['shipping_zone_id'] = $this->session->data['shipping_address']['zone_id'];
				$order_data['shipping_country'] = $this->session->data['shipping_address']['country'];
				$order_data['shipping_country_id'] = $this->session->data['shipping_address']['country_id'];
				$order_data['shipping_address_format'] = '';
				$order_data['shipping_custom_field'] = (isset($this->session->data['shipping_address']['custom_field']) ? $this->session->data['shipping_address']['custom_field'] : array());

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

			$order_data['comment'] = $this->request->post['custom'] . ' - ' . $this->request->post['comment'];
			$order_data['total'] = $total;
			$this->session->data['total'] = $total;

			if (isset($this->request->cookie['tracking'])) {
				$order_data['tracking'] = $this->request->cookie['tracking'];

				$subtotal = $this->cart->getSubTotal();

				// Affiliate
				$this->load->model('affiliate/affiliate');

				$affiliate_info = $this->model_affiliate_affiliate->getAffiliateByCode($this->request->cookie['tracking']);

				if ($affiliate_info) {
					$order_data['affiliate_id'] = $affiliate_info['affiliate_id'];
					$order_data['commission'] = ($subtotal / 100) * $affiliate_info['commission'];
				} else {
					$order_data['affiliate_id'] = 0;
					$order_data['commission'] = 0;
				}

				// Marketing
				$this->load->model('checkout/marketing');

				$marketing_info = $this->model_checkout_marketing->getMarketingByCode($this->request->cookie['tracking']);

				if ($marketing_info) {
					$order_data['marketing_id'] = $marketing_info['marketing_id'];
				} else {
					$order_data['marketing_id'] = 0;
				}
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

			$this->session->data['order_id'] = $this->model_checkout_order->addOrder($order_data);
			
			$order_status_id = $this->config->get($this->session->data['payment_method']['code'].'_order_status_id');
			
			if ($this->redirect || !$order_status_id) {
				$order_status_id = $this->config->get('config_order_status_id');
			}
			
			$this->model_checkout_order->addOrderHistory($this->session->data['order_id'], $order_status_id, $order_data['comment']);
		}
		
		if ($this->redirect) {
			$json['redirect'] = $this->redirect;
		} elseif ($this->error) {
			$json['error'] = $this->error;
		} else {
			$json['redirect'] = $this->url->link('checkout/success');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function validate() {
		$this->load->language('checkout/quick_checkout');
		
		if ($this->cart->hasShipping()) {
			// Validate if shipping address has been set.
			if (!isset($this->session->data['shipping_address'])) {
				$this->error['warning'] = $this->language->get('error_address');
			}

			// Validate if shipping method has been set.
			if (!isset($this->session->data['shipping_method'])) {
				$this->error['warning'] = $this->language->get('error_shipping');
			}
		} else {
			unset($this->session->data['shipping_address']);
			unset($this->session->data['shipping_method']);
			unset($this->session->data['shipping_methods']);
			unset($this->session->data['shipping_method_payment']);
			unset($this->session->data['shipping_method_store']);
			unset($this->session->data['shipping_method_custom']);
		}

		// Validate if payment address has been set.
		if (!isset($this->session->data['payment_address'])) {
			$this->error['warning'] = $this->language->get('error_payment');
		}

		// Validate if payment method has been set.
		if (!isset($this->session->data['payment_method'])) {
			$this->error['warning'] = $this->language->get('error_payment');
		}

		// Validate cart has products and has stock.
		if ((!$this->cart->hasProducts() && empty($this->session->data['vouchers'])) || (!$this->cart->hasStock() && !$this->config->get('config_stock_checkout'))) {
			$this->redirect = $this->url->link('checkout/cart');
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
				$this->redirect = $this->url->link('checkout/cart');

				break;
			}
		}

		if (isset($this->request->post['address_id']) && isset($this->request->post['payment_address']) && $this->request->post['payment_address'] == 'existing') {
			$this->load->model('account/address');
			
			$addresses = $this->model_account_address->getAddresses();
			
			if (!in_array($this->request->post['address_id'], array_keys($addresses))) {
				$this->error['address_1'] = $this->language->get('error_address_1');
			} else {
				$address_id = $this->request->post['address_id'];
				
				if ((utf8_strlen(trim($this->customer->getTelephone())) < 1) || (utf8_strlen(trim($this->customer->getTelephone())) > 32)) {
					$this->error['telephone'] = $this->language->get('error_telephone');
				}
				
				$this->load->model('localisation/country');
		
				$country_info = $this->model_localisation_country->getCountry($this->request->post['country_id']);
	
				if ($country_info && $country_info['postcode_required'] && (utf8_strlen(trim($addresses[$address_id]['postcode'])) < 2 || utf8_strlen(trim($addresses[$address_id]['postcode'])) > 10)) {
					$this->error['postcode'] = $this->language->get('error_postcode');
				}
				
				if (!$this->error) {
					$address = array(
						'country_id'     => $addresses[$address_id]['country_id'],
						'country'        => $addresses[$address_id]['country'],
						'zone_id'        => $addresses[$address_id]['zone_id'],
						'zone'           => $addresses[$address_id]['zone'],
						'postcode'       => $addresses[$address_id]['postcode'],
						'firstname'      => $addresses[$address_id]['firstname'],
						'email'          => $this->customer->getEmail(),
						'telephone'      => $this->customer->getTelephone(),
						'address_1'      => $addresses[$address_id]['address_1'],
						'custom_field'   => $addresses[$address_id]['custom_field']
					);
				
					$this->session->data['shipping_address'] = $address;
					$this->session->data['payment_address'] = $address;
				}
			}
		} else {
			if (!isset($this->request->post['country_id']) || !$this->request->post['country_id']) {
				$this->error['country'] = $this->language->get('error_shipping_zone');
			}
	
			if (isset($this->request->post['country_id'])) {
				$this->load->model('localisation/country');
	
				$country_info = $this->model_localisation_country->getCountry($this->request->post['country_id']);
	
				if ($country_info && $country_info['postcode_required'] && isset($this->request->post['postcode']) && (utf8_strlen(trim($this->request->post['postcode'])) < 2 || utf8_strlen(trim($this->request->post['postcode'])) > 10)) {
					$this->error['postcode'] = $this->language->get('error_postcode');
				}
				
				$this->load->model('localisation/zone');
		
				$zones = $this->model_localisation_zone->getZonesByCountryId($this->request->post['country_id']);
				
				if ($zones) {
					if (empty($this->request->post['zone_id'])) {
						$this->error['zone'] = $this->language->get('error_zone');
					}
				}
			}
			
			if (!isset($this->request->post['firstname']) || utf8_strlen($this->request->post['firstname']) < 1) {
				$this->error['firstname'] = $this->language->get('error_firstname');
			}
			
			if ((utf8_strlen($this->request->post['email']) > 96) || !preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $this->request->post['email'])) {
				$this->error['email'] = $this->language->get('error_email');
			}
					
			if ((utf8_strlen(trim($this->request->post['telephone'])) < 1) || (utf8_strlen(trim($this->request->post['telephone'])) > 32)) {
				$this->error['telephone'] = $this->language->get('error_telephone');
			}
			
			if (!isset($this->request->post['address_1']) || utf8_strlen($this->request->post['address_1']) < 1) {
				$this->error['address_1'] = $this->language->get('error_address_1');
			} else {				
				$this->session->data['shipping_address']['address_1'] = $this->request->post['address_1'];
				$this->session->data['payment_address']['address_1'] = $this->request->post['address_1'];
			}

			if (isset($this->request->post['custom_field'])) {
				// Custom field validation
				$this->load->model('account/custom_field');
		
				$custom_fields = $this->model_account_custom_field->getCustomFields($this->config->get('config_customer_group_id'));
		
				foreach ($custom_fields as $custom_field) {
					if (($custom_field['location'] == 'address') && $custom_field['required'] && empty($this->request->post['custom_field'][$custom_field['custom_field_id']])) {
						$this->error['custom_field' . $custom_field['custom_field_id']] = sprintf($this->language->get('error_custom_field'), $custom_field['name']);
					}
				}
			}
			
			if (!$this->error) {
				$address = array(
					'country_id'     => $this->request->post['country_id'],
					'country'        => $country_info?$country_info['name']:'',
					'postcode'       => isset($this->request->post['postcode'])?$this->request->post['postcode']:'',
					'zone_id'        => $this->request->post['zone_id'],
					'zone'           => $zones?$zones['name']:'',
					'firstname'      => $this->request->post['firstname'],
					'email'          => $this->request->post['email'],
					'telephone'      => $this->request->post['telephone'],
					'address_1'      => $this->request->post['address_1'],
					'custom_field'   => isset($this->request->post['custom_field'])?$this->request->post['custom_field']:array()
				);
				
				$this->session->data['shipping_address'] = $address;
				$this->session->data['payment_address'] = $address;
			}
		}
		
		return !$this->error;
	}
}