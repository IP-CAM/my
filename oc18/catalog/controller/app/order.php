<?php
class ControllerAppOrder extends Controller {
	private $e = 0;
	private $s = 0;
	private $f;
	
	public function index() {
		if (isset($this->request->get['token'])) {
			$token = $this->request->get['token'];
		} else {
			$token = '';
		}

		if ($token != $this->config->get('config_encryption')) {
			echo 'error';
		} else {		
			if (!empty($this->request->get['f'])) {
				$this->f = $this->request->get['f'];
			} else {
				$this->f = array();
			}
			
			if (isset($this->request->get['type'])) {
				$type = $this->request->get['type'];
			} else {
				$type = 'check';
			}
			
			if (!empty($this->request->get['e'])) {
				$this->e = $this->request->get['e'];
			} else {
				$this->e = '';
			}
			
			if (!empty($this->request->get['s'])) {
				$this->s = $this->request->get['s'];
			} else {
				$this->s = '';
			}
			
			switch ($type) {
				case 'check':
					$this->getList();
					break;
				case 'update':
					$this->update();
					break;
			}
		}
	}
	
	public function update() {		
		if ($this->e) {
			$e = explode(',', $this->e);
		} else {
			$e = array();
		}
		
		if ($this->s) {
			$s = explode(',', $this->s);
		} else {
			$s = array();
		}

		foreach ($e as $order_id) {
			$sql = "UPDATE `" . DB_PREFIX . "order`
						SET `auto_express` = '1'
						WHERE `order_id` = '".(int)$order_id."'";
			
			$this->db->query($sql);
			
			$sql = "INSERT INTO `" . DB_PREFIX . "order_action`
						SET `order_id` = '".(int)$order_id."',
							`type` = 'autoexpress',
							`status` = '1',
							date_added = NOW()";
			
			$this->db->query($sql);
		}

		foreach ($s as $order_id) {
			$sql = "UPDATE `" . DB_PREFIX . "order`
						SET `auto_shipping` = '1'
						WHERE `order_id` = '".(int)$order_id."'";
			
			$this->db->query($sql);
			
			$sql = "INSERT INTO `" . DB_PREFIX . "order_action`
						SET `order_id` = '".(int)$order_id."',
							`type` = 'autoshipping',
							`status` = '1',
							date_added = NOW()";
			
			$this->db->query($sql);
		}

		$c = array_merge($e, $s);
		$c = array_unique($c);

		foreach ($c as $order_id) {
			$sql = "DELETE FROM `" . DB_PREFIX . "order_print`
						WHERE `order_id` = '".(int)$order_id."'";
			
			$this->db->query($sql);
		}
		
		$this->response->setOutput('success');
	}
	
	private function getList() {
		$json = array();

		if (!$this->f) {
			echo 'error Warehouse Code';
			return false;
		}

		$sql = "SELECT * FROM `" . DB_PREFIX . "order` o
					WHERE o.order_status_id > 0
						AND 
						(
							(o.action_express = '0' AND o.auto_express = '0')
							OR
							o.action_shipping = '0'
						)";

		$ws = $this->config->get('autowarehouse');
		$wf = array();

		foreach ($ws as $w) {
			if (!empty($w['ship']) && $w['code'] == $this->f) {
				foreach ($w['ship'] as $s) {
					$wf[] = 'super.super'.$s['code'];
				}
				break;
			}
		}

		if ($wf) {
			$wf = implode('\',\'', $wf);

			$sql .= " AND o.shipping_code IN('".$wf."')";
		}
		
		$sql .= " ORDER BY o.order_id ASC";
		
		$results = $this->db->query($sql)->rows;
	
		$find = array(
			'ship_name',
			'ship_country',
			'ship_address',
			'ship_postcode',
			'ship_telphone',
			'dly_name',
			'dly_country',
			'dly_address',
			'dly_postcode',
			'dly_telphone',
			'store_name',
			'store_url',
			'tick',
			'date_year',
			'date_month',
			'date_day',
			'date_time',
			'order_id',
			'order_weight',
			'order_total_number',
			'order_total',
			'order_currency',
			'order_qty',
			'order_comment'

		);
		
		$this->load->model('setting/setting');
		$this->load->model('catalog/product');
		$this->load->model('tool/image');
		$filters = $this->filters();
		
		foreach ($results as $order) {
			$expr = 0;
			$ship = 0;

			$filter = $order['order_status_id'].'|||'.$order['shipping_code'];
			
			if (!$order['action_express'] && !$order['auto_express'] && isset($filters['express'][$filter])) {
				$express = $filters['express'][$filter];
				$expr = 1;
			} else {
				$express = array();
			}

			if (!$order['action_shipping'] && !$order['auto_shipping'] && isset($filters['shipping'][$filter])) {
				$ship = 1;
			}

			if (!$expr && !$ship) {
				continue;
			}
			
			$store_info = $this->model_setting_setting->getSetting('config', $order['store_id']);

			if ($store_info) {
				$store_address = $store_info['config_address'];
				$store_email = $store_info['config_email'];
				$store_telephone = $store_info['config_telephone'];
				$store_fax = $store_info['config_fax'];
			} else {
				$store_address = $this->config->get('config_address');
				$store_email = $this->config->get('config_email');
				$store_telephone = $this->config->get('config_telephone');
				$store_fax = $this->config->get('config_fax');
			}
			
			$order_total = $this->currency->format($order['total'], $order['currency_code']);
			$order_currency = $this->currency->getSymbolLeft($order['currency_code'])?$this->currency->getSymbolLeft($order['currency_code']):$this->currency->getSymbolRight($order['currency_code']);
			$order_total_number = str_replace($order_currency, '', $order_total);
			$order_total_number = str_replace(',', '', $order_total_number);
			
			$order_total_weight = 0;
			$order_total_qty = 0;
			
			$sql = "SELECT *, (SELECT image FROM " . DB_PREFIX . "product p
							WHERE p.product_id = op.product_id) AS image,
						(SELECT location FROM " . DB_PREFIX . "product p
							WHERE p.product_id = op.product_id) AS location
						FROM " . DB_PREFIX . "order_product op
						WHERE op.order_id = '" . (int)$order['order_id'] . "'";
			
			$products = $this->db->query($sql)->rows;
			
			$pro = array();

			foreach ($products as $product) {
				$product_info = $this->model_catalog_product->getProduct($product['product_id']);

				if ($product_info) {
					$order_total_weight += $product_info['weight'];
					$order_total_qty += $product['quantity'];
				}
				
				$pro_img = !empty($product['image'])?$this->model_tool_image->resize($product['image'], 80, 80):$this->model_tool_image->resize('no-img.jpg', 80, 80);

				$pro[] = array(
					'name'       => $product['name'],
					'model'      => $product['model'],
					'quantity'   => $product['quantity'],
					'location'   => $product['location'],
					'image'      => $pro_img
				);
			}

			$order_total_weight = $this->weight->format($order_total_weight, $this->config->get('config_weight_class_id'), $this->language->get('decimal_point'), $this->language->get('thousand_point'));
	
			$replace = array(
				'ship_name'      => $order['payment_firstname'],
				'ship_country'   => $order['payment_country'],
				'ship_address'   => $order['payment_address_1'],
				'ship_postcode'  => $order['payment_postcode'],
				'ship_telphone'  => $order['telephone'],
				
				'dly_name'       => $this->config->get('config_name'),
				'dly_country'    => $order['payment_country'],
				'dly_address'    => $store_address,
				'dly_postcode'   => $order['payment_postcode'],
				'dly_telphone'   => $store_telephone,
				
				'store_name'     => $store_telephone,
				'store_url'      => $store_telephone,
				'tick'           => '√',
				'date_year'      => date('Y', (int)time()),
				'date_month'     => date('m', (int)time()),
				'date_day'       => date('d', (int)time()),
				'date_time'      => date('H:i:s', (int)time()),
				'order_id'       => $order['order_id'],
				'order_weight'   => $order_total_weight,
				'order_total_number'=> $order_total_number,
				'order_total'    => $order_total,
				'order_currency' => $order_currency,
				'order_qty'      => $order_total_qty,
				'order_comment'  => $order['comment']
			);

			$vs = array();
			
			if ($express) {
				$values = !empty($express['value'])?unserialize($express['value']):array();
				$customs = !empty($express['custom'])?unserialize($express['custom']):array();
				
				foreach ($values as $v) {
					if ($v['font_weight'] == 'bold') {
						$bold = 1;
					} else {
						$bold = 0;
					}
					
					$content = str_replace($find, $replace, $v['key']);
					$content = $this->formatJson($content);
					
					$t = (float)$v['top'] + (float)$express['top']*3.7794;
					$l = (float)$v['left'] + (float)$express['left']*3.7794;

					$vs[] = array(
						'content'     => $content,
						'width'       => (int)$v['width'],
						'height'      => (int)$v['height'],
						'top'         => $t,
						'left'        => $l,
						'size'        => (int)$v['font_size'],
						'bold'        => (int)$bold,
					);
				}
				
				foreach ($customs as $v) {
					if ($v['font_weight'] == 'bold') {
						$bold = 1;
					} else {
						$bold = 0;
					}
					
					$content = $this->formatJson($v['text']);
					
					$t = (float)$v['top'] + (float)$express['top']*3.7794;
					$l = (float)$v['left'] + (float)$express['left']*3.7794;

					$vs[] = array(
						'content'     => $content,
						'width'       => (int)$v['width'],
						'height'      => (int)$v['height'],
						'top'         => $t,
						'left'        => $l,
						'size'        => (int)$v['font_size'],
						'bold'        => (int)$bold,
					);
				}
			}

			if ($order['shipping_postcode']) {
				$city = '['.$order['shipping_postcode'].'] '.$order['shipping_country'].' '.$order['shipping_zone'].' '.$order['shipping_city'];
			} else {
				$city = $order['shipping_country'].' '.$order['shipping_zone'].' '.$order['shipping_city'];
			}

			if ($this->config->get('config_print_shipping')) {
				$cps = $this->config->get('config_print_shipping');
			} else {
				$cps = array();
			}

			if (in_array($order['order_status_id'], $cps)) {
				$payment_info = strip_tags($order['payment_method']).': '.$order_total;
			} else {
				$payment_info = '';
			}
			
			$json[] = array(
				'order_id'       => $order['order_id'],
				'order_num'      => $order['invoice_prefix'],
				'printer'        => $express?$express['printer']:'',
				'papersize'      => $express?$express['papersize']:'',
				'ship'           => $ship, // 是否打印配送单
				'expr'           => $expr, // 是否打印快递单
				'date'           => $order['date_added'],
				'pay_info'       => $payment_info,
				'pay_comment'    => $order['comment'],
				'ship_method'    => $order['shipping_method'],
				'ship_name'      => $order['shipping_firstname'],
				'ship_phone'     => $order['telephone'],
				'ship_address'   => $order['shipping_address_1'],
				'ship_city'      => $city,
				'order_goods'    => $pro,
				'order_data'     => $vs,
				'num_total'      => $this->getTotalOrdersByTelephone($order['telephone'], 'total'),
				'num_repeat'     => $this->getTotalOrdersByTelephone($order['telephone'], 'repeat'),
				'num_turnback'   => $this->getTotalOrdersByTelephone($order['telephone'], 'turnback')
			);
		}

		$p = $this->customPrint();
		$json = array_merge($json, $p);

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	private function customPrint() {
		$json = array();

		if (!$this->f) {
			return $json;
		}
		
		$sql = "SELECT * FROM `" . DB_PREFIX . "order_print` op
					LEFT JOIN `" . DB_PREFIX . "order` o ON(o.order_id = op.order_id)
					WHERE o.order_status_id > 0";

		$ws = $this->config->get('autowarehouse');
		$wf = array();

		foreach ($ws as $w) {
			if (!empty($w['ship']) && $w['code'] == $this->f) {
				foreach ($w['ship'] as $s) {
					$wf[] = 'super.super'.$s['code'];
				}
				break;
			}
		}

		if ($wf) {
			$wf = implode('\',\'', $wf);

			$sql .= " AND o.shipping_code IN('".$wf."')";
		}
		
		$sql .= " ORDER BY o.order_id ASC";
		
		$results = $this->db->query($sql)->rows;
	
		$find = array(
			'ship_name',
			'ship_country',
			'ship_address',
			'ship_postcode',
			'ship_telphone',
			'dly_name',
			'dly_country',
			'dly_address',
			'dly_postcode',
			'dly_telphone',
			'store_name',
			'store_url',
			'tick',
			'date_year',
			'date_month',
			'date_day',
			'date_time',
			'order_id',
			'order_weight',
			'order_total_number',
			'order_total',
			'order_currency',
			'order_qty',
			'order_comment'
		);

		$filters = $this->filters();
		
		foreach ($results as $order) {
			$expr = 0;
			$ship = 0;
			$express = array();
			
			if ($order['action_expr']) {
				$sql = "SELECT * FROM `" . DB_PREFIX . "express`
							WHERE `express_id` = '".(int)$order['express_id']."'";
				$express = $this->db->query($sql)->row;
				$expr = 1;
			}

			if ($order['action_ship']) {
				$ship = 1;
			}

			if (!$expr && !$ship) {
				continue;
			}
			
			$store_info = $this->model_setting_setting->getSetting('config', $order['store_id']);

			if ($store_info) {
				$store_address = $store_info['config_address'];
				$store_email = $store_info['config_email'];
				$store_telephone = $store_info['config_telephone'];
				$store_fax = $store_info['config_fax'];
			} else {
				$store_address = $this->config->get('config_address');
				$store_email = $this->config->get('config_email');
				$store_telephone = $this->config->get('config_telephone');
				$store_fax = $this->config->get('config_fax');
			}
			
			$order_total = $this->currency->format($order['total'], $order['currency_code']);
			$order_currency = $this->currency->getSymbolLeft($order['currency_code'])?$this->currency->getSymbolLeft($order['currency_code']):$this->currency->getSymbolRight($order['currency_code']);
			$order_total_number = str_replace($order_currency, '', $order_total);
			$order_total_number = str_replace(',', '', $order_total_number);
			
			$order_total_weight = 0;
			$order_total_qty = 0;
			
			$sql = "SELECT *, (SELECT image FROM " . DB_PREFIX . "product p
							WHERE p.product_id = op.product_id) AS image,
						(SELECT location FROM " . DB_PREFIX . "product p
							WHERE p.product_id = op.product_id) AS location
						FROM " . DB_PREFIX . "order_product op
						WHERE op.order_id = '" . (int)$order['order_id'] . "'";
			
			$products = $this->db->query($sql)->rows;
			
			$pro = array();

			foreach ($products as $product) {
				$product_info = $this->model_catalog_product->getProduct($product['product_id']);

				if ($product_info) {
					$order_total_weight += $product_info['weight'];
					$order_total_qty += $product['quantity'];
				}
				
				$pro_img = !empty($product['image'])?$this->model_tool_image->resize($product['image'], 80, 80):$this->model_tool_image->resize('no-img.jpg', 80, 80);

				$pro[] = array(
					'name'       => $product['name'],
					'model'      => $product['model'],
					'quantity'   => $product['quantity'],
					'location'   => $product['location'],
					'image'      => $pro_img
				);
			}

			$order_total_weight = $this->weight->format($order_total_weight, $this->config->get('config_weight_class_id'), $this->language->get('decimal_point'), $this->language->get('thousand_point'));
	
			$replace = array(
				'ship_name'      => $order['payment_firstname'],
				'ship_country'   => $order['payment_country'],
				'ship_address'   => $order['payment_address_1'],
				'ship_postcode'  => $order['payment_postcode'],
				'ship_telphone'  => $order['telephone'],
				
				'dly_name'       => $this->config->get('config_name'),
				'dly_country'    => $order['payment_country'],
				'dly_address'    => $store_address,
				'dly_postcode'   => $order['payment_postcode'],
				'dly_telphone'   => $store_telephone,
				
				'store_name'     => $store_telephone,
				'store_url'      => $store_telephone,
				'tick'           => '√',
				'date_year'      => date('Y', (int)time()),
				'date_month'     => date('m', (int)time()),
				'date_day'       => date('d', (int)time()),
				'date_time'      => date('H:i:s', (int)time()),
				'order_id'       => $order['order_id'],
				'order_weight'   => $order_total_weight,
				'order_total_number'=> $order_total_number,
				'order_total'    => $order_total,
				'order_currency' => $order_currency,
				'order_qty'      => $order_total_qty,
				'order_comment'  => $order['comment']
			);

			$vs = array();
			
			if ($express) {
				$values = !empty($express['value'])?unserialize($express['value']):array();
				$customs = !empty($express['custom'])?unserialize($express['custom']):array();
				
				foreach ($values as $v) {
					if ($v['font_weight'] == 'bold') {
						$bold = 1;
					} else {
						$bold = 0;
					}
					
					$content = str_replace($find, $replace, $v['key']);
					$content = $this->formatJson($content);
					
					$t = (float)$v['top'] + (float)$express['top']*3.7794;
					$l = (float)$v['left'] + (float)$express['left']*3.7794;

					$vs[] = array(
						'content'     => $content,
						'width'       => (int)$v['width'],
						'height'      => (int)$v['height'],
						'top'         => $t,
						'left'        => $l,
						'size'        => (int)$v['font_size'],
						'bold'        => (int)$bold,
					);
				}
				
				foreach ($customs as $v) {
					if ($v['font_weight'] == 'bold') {
						$bold = 1;
					} else {
						$bold = 0;
					}
					
					$content = $this->formatJson($v['text']);
					
					$t = (float)$v['top'] + (float)$express['top']*3.7794;
					$l = (float)$v['left'] + (float)$express['left']*3.7794;

					$vs[] = array(
						'content'     => $content,
						'width'       => (int)$v['width'],
						'height'      => (int)$v['height'],
						'top'         => $t,
						'left'        => $l,
						'size'        => (int)$v['font_size'],
						'bold'        => (int)$bold,
					);
				}
			}

			if ($order['shipping_postcode']) {
				$city = '['.$order['shipping_postcode'].'] '.$order['shipping_country'].' '.$order['shipping_zone'].' '.$order['shipping_city'];
			} else {
				$city = $order['shipping_country'].' '.$order['shipping_zone'].' '.$order['shipping_city'];
			}

			if ($this->config->get('config_print_shipping')) {
				$cps = $this->config->get('config_print_shipping');
			} else {
				$cps = array();
			}

			if (in_array($order['order_status_id'], $cps)) {
				$payment_info = strip_tags($order['payment_method']).': '.$order_total;
			} else {
				$payment_info = '';
			}

			$json[] = array(
				'order_id'       => $order['order_id'],
				'order_num'      => $order['invoice_prefix'],
				'printer'        => $express?$express['printer']:'',
				'papersize'      => $express?$express['papersize']:'',
				'ship'           => $ship, // 是否打印配送单
				'expr'           => $expr, // 是否打印快递单
				'date'           => $order['date_added'],
				'pay_info'       => $payment_info,
				'pay_comment'    => $order['comment'],
				'ship_method'    => $order['shipping_method'],
				'ship_name'      => $order['shipping_firstname'],
				'ship_phone'     => $order['telephone'],
				'ship_address'   => $order['shipping_address_1'],
				'ship_city'      => $city,
				'order_goods'    => $pro,
				'order_data'     => $vs,
				'num_total'      => $this->getTotalOrdersByTelephone($order['telephone'], 'total'),
				'num_repeat'     => $this->getTotalOrdersByTelephone($order['telephone'], 'repeat'),
				'num_turnback'   => $this->getTotalOrdersByTelephone($order['telephone'], 'turnback')
			);
		}

		return $json;
	}
	
	private function filters() {
		$sql = "SELECT * FROM `" . DB_PREFIX . "express`";
		$exs = $this->db->query($sql)->rows;

		$express = array();
		foreach ($exs as $ex) {
			$ships = $ex['shippings']?unserialize($ex['shippings']):array();
			
			foreach ($ships as $ship) {
				$s = explode('|||', $ship);
				
				if (count($s) === 3) {
					$key = $s[0].'|||super.'.$s[1];
					$express[$key] = $ex;
				}
			}
		}

		$shipping = array();
		$ships = $this->config->get('autoprint');

		if ($ships) {
			foreach ($ships as $ship) {
				$s = explode('[|]|[|]', $ship);
				$s = explode('|||', $s[0]);
				
				$key = $s[0].'|||super.'.$s[1];
				$shipping[$key] = true;
			}
		}
		

		$e = array(
			'express'   => $express,
			'shipping'  => $shipping
		);
		
		return $e;
	}

	private function getTotalOrdersByTelephone($telephone, $type = 'total') {
		$status = array();
		
		switch ($type) {
			case 'total':
				$configs = $this->config->get('config_totalorder_status');
				break;
			
			case 'repeat':
				$configs = $this->config->get('config_repeat_status');
				break;
			
			case 'turnback':
				$configs = $this->config->get('config_turnback_status');
				break;
		}
		
		if ($configs) {
			foreach ($configs as $cts) {
				$status[] = (int)$cts;
			}
		}
		
		if (!$status) {
			return 0;
		}
		
		$sql = "SELECT count(`order_id`) AS total FROM `" . DB_PREFIX . "order`
					WHERE telephone = '" . $this->db->escape($telephone) . "'
						AND order_status_id IN (" . implode(',', $status) . ")";
		
		if ($type == 'customer') {
			$sql = "SELECT count(`order_id`) AS total FROM `" . DB_PREFIX . "order`
						WHERE customer_id = '" . (int)$telephone . "'
							AND order_status_id IN (" . implode(',', $status) . ")";
		}
		
		$query = $this->db->query($sql);

		return $query->row['total'];
	}
	
	private function formatJson($string) {
		$string = str_replace('\\', '\\\\', $string);
		$string = str_replace('"', '\"', $string);
		
		return $string;
	}
}
?>