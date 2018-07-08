<?php
class ControllerModuleGift extends Controller {
	public function index($setting) {
		$this->load->language('module/gift');

		$data['heading_title'] = sprintf($this->language->get('text_title'), $this->currency->format((float)$setting['total']));

		$data['text_tax'] = $this->language->get('text_tax');

		$data['button_cart'] = $this->language->get('button_cart');
		$data['button_wishlist'] = $this->language->get('button_wishlist');
		$data['button_compare'] = $this->language->get('button_compare');
		
		$gifts = array();
		
		//$session_gifts = $this->gift->getProducts();
		
		foreach ($this->session->data['gift'] as $key => $quantity) {
			$sg = unserialize(base64_decode($key));
			
			$gifts[] = $sg['product_id'];
		}
		
		$discounts = array();
		
		foreach ($this->session->data['gift_discount'] as $k => $v) {			
			$discounts[] = $v['id'];
		}

		$this->load->model('catalog/product');

		$this->load->model('tool/image');

		$data['products'] = array();

		if (!$setting['limit']) {
			$setting['limit'] = 4;
		}
		
		$data['module_id'] = $setting['module_id'];
		
		if ((float)$setting['total'] > $this->cart->getSubTotal()) {
			$total = (float)$setting['total'] - $this->cart->getSubTotal();
			
			$total = $this->currency->format($total);
			
			$data['total'] = $total;
		} else {
			$data['total'] = '';
		}

		$products = array_slice($setting['product'], 0, (int)$setting['limit'], 1);
		
		foreach ($products as $product_id => $v) {
			$product_info = $this->model_catalog_product->getProduct($product_id);

			if ($product_info) {
				if ($product_info['image']) {
					$image = $this->model_tool_image->resize($product_info['image'], $setting['width'], $setting['height']);
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
				}

				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$price = false;
				}

				$special = $this->currency->format((float)$v['price']);

				if ($this->config->get('config_tax')) {
					$tax = $this->currency->format((float)$v['price']);
				} else {
					$tax = false;
				}

				if ($this->config->get('config_review_status')) {
					$rating = $product_info['rating'];
				} else {
					$rating = false;
				}

				$data['products'][] = array(
					'type'        => 'product',
					'product_id'  => $product_info['product_id'],
					'thumb'       => $image,
					'name'        => $product_info['name'],
					'description' => utf8_substr(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
					'price'       => $price,
					'special'     => (float)$v['price']?$special:$this->language->get('text_free'),
					'gift_price'  => (float)$v['price'],
					'tax'         => $tax,
					'rating'      => $rating,
					'href'        => $this->url->link('product/product', 'product_id=' . $product_info['product_id']),
					'selected'    => in_array($product_info['product_id'], $gifts)
				);
			}
		}
		
		if (!empty($setting['discount'])) {
			foreach ($setting['discount'] as $key => $d) {
				if ($d['image']) {
					$image = $this->model_tool_image->resize($d['image'], $setting['width'], $setting['height']);
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
				}
				
				$product_id = 'discount'.$setting['module_id'].$key;
				
				$data['products'][] = array(
					'type'        => 'discount',
					'product_id'  => $product_id,
					'thumb'       => $image,
					'name'        => $d['name'][$this->config->get('config_language_id')],
					'selected'    => in_array($product_id, $discounts)
				);
			}
		}

		if ($data['products']) {
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/gift.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/module/gift.tpl', $data);
			} else {
				return $this->load->view('default/template/module/gift.tpl', $data);
			}
		}
	}

	public function vat() {
		$json = array();
		
		$total = $this->cart->getSubTotal();
		
		$module_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "module WHERE LCASE(`code`) = 'gift'");
		
		$modules = $module_query->rows;
		
		if ($modules) {
			foreach ($modules as $module) {
				$lize = unserialize($module['setting']);
				
				if ($lize && !empty($lize['product']) && $this->cart->getSubTotal() >= (float)$lize['total']) {
					$this->load->language('module/gift');
				
					$json['msg'] = sprintf($this->language->get('text_gift'), $this->currency->format((float)$lize['total']));
				}
			}
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function add() {
		$json = array();
		$product = array();

		if (isset($this->request->post['product_id'])) {
			$product_id = $this->request->post['product_id'];
		} else {
			$product_id = 0;
		}
		
		$str = strpos($product_id, 'discount');
		
		if ($str || $str === 0) {
			$giftProduct = $this->gift->getGiftDiscount($product_id);
		} else {
			$giftProduct = $this->gift->getGiftProduct($product_id);
		}

		if ($giftProduct) {
			foreach ($this->session->data['gift'] as $key => $quantity) {
				$product = unserialize(base64_decode($key));
				
				if ($product['group'] == $giftProduct['group']) {
					$this->gift->remove($key);
				}
			}
			
			if (isset($giftProduct['price'])) {
				$this->gift->add($this->request->post['product_id'], $giftProduct['price'], $giftProduct['group']);
			}

			unset($this->session->data['shipping_method']);
			unset($this->session->data['shipping_methods']);
			unset($this->session->data['payment_method']);
			unset($this->session->data['payment_methods']);
		} else {
			$this->load->language('module/gift');
			
			$json['error'] = $this->language->get('text_alert');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function remove() {
		$json = array();
		$product = array();

		if (isset($this->request->post['product_id'])) {
			$product_id = $this->request->post['product_id'];
		} else {
			$product_id = 0;
		}
		
		$str = strpos($product_id, 'discount');
		
		if ($str || $str === 0) {
			$giftProduct = $this->gift->getGiftDiscount($product_id);
		
			if ($giftProduct) {
				$this->gift->remove($giftProduct['id']);
			}
		} else {
			$giftProduct = $this->gift->getGiftProduct($product_id);
			
			$this->gift->remove($giftProduct['key']);
		}

		unset($this->session->data['shipping_method']);
		unset($this->session->data['shipping_methods']);
		unset($this->session->data['payment_method']);
		unset($this->session->data['payment_methods']);
		
		$json['redirect'] = str_replace('&amp;', '&', $this->url->link('checkout/cart', '', 'SSL'));

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}