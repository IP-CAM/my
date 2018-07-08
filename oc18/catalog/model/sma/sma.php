<?php
class ModelSmaSma extends Model {
	/*
		@type string{
			customer_add
			customer_edit
			customer_delete
		}
	*/
	public function toSmaCustomer($data, $type = '') {
		if (!$this->validate()) {
			return false;
		}
		
		if ($data && ($type == 'customer_add' || $type == 'customer_edit') && !empty($data['address'])) {
			foreach ($data['address'] as $key => $address) {
				$data['address'][$key]['country'] = '';
				$data['address'][$key]['zone'] = '';
				
				if (isset($address['country_id'])) {
					$sql = "SELECT name FROM `" . DB_PREFIX . "country`
								WHERE `country_id` = '".(int)$address['country_id']."'
								LIMIT 1";
					
					$query = $this->db->query($sql)->row;
					
					if ($query) {
						$data['address'][$key]['country'] = $query['name'];
					}
				}
				
				if (isset($address['country_id']) && isset($address['zone_id'])) {
					$sql = "SELECT name FROM `" . DB_PREFIX . "zone`
								WHERE `zone_id` = '".(int)$address['zone_id']."'
									AND `country_id` = '".(int)$address['country_id']."'
								LIMIT 1";
					
					$query = $this->db->query($sql)->row;
					
					if ($query) {
						$data['address'][$key]['zone'] = $query['name'];
					}
				}
			}
		}
		
		// customer points
		$data['points'] = 0;
		
		if ($data && ($type == 'customer_add' || $type == 'customer_edit')) {
			$sql = "SELECT SUM(points) AS total FROM `" . DB_PREFIX . "customer_reward` cr
						LEFT JOIN `" . DB_PREFIX . "customer` c
						ON (cr.customer_id = c.customer_id)
						WHERE c.customer_id = '".(int)$data['customer_id']."'";
			
			$query = $this->db->query($sql)->row;
			
			if ($query) {
				$data['points'] = $query['total'];
			}
		}
		
		$this->c('POST', $data, $type);
	}
	
	public function toSmaCustomerAddress($data, $type = '') {
		if (!$this->validate()) {
			return false;
		}
	}
	
	/*
		@type string{
			order_add
			order_edit
			order_delete
		}
	*/
	public function toSmaOrder($data, $type = '') {
		if (!$this->validate()) {
			return false;
		}
		
		// 判断地区库存
		if (isset($data['products']) && isset($data['shipping_country_id'])) {			
			$products = array();
			
			foreach ($data['products'] as $product_data) {
				$this->formatProducts($product_data, $data['order_id'], $data['shipping_country_id'], $products);
			}
			
			$data = array(
				'order_id'   => $data['order_id'],
				'email'      => $data['email'],
				'lastname'   => isset($data['lastname'])?$data['lastname']:'',
				'telephone'  => $data['telephone'],
				'comment'    => $data['comment'],
				'totals'     => $data['totals'],
				'warehouses' => $products
			);
		}
		
		$this->c('POST', $data, $type);
	}
	
	private function formatProducts($order, $order_id, $shipping_country_id, &$products, $qty = 0) {
		$sql = "SELECT area FROM `" . DB_PREFIX . "warehouse`";
		
		$warehouses = $this->db->query($sql)->rows;
		
		$yes = false;
		
		foreach ($warehouses as $warehouse) {
			$area = explode(',', $warehouse['area']);
			
			if (in_array($shipping_country_id, $area)) {
				$yes = true;
				break;
			}
		}
		
		//查询订单配送国家地区是否有对应仓库，没有则使用默认国家地区
		if (!$yes) {
			$shipping_country_id = $this->config->get('config_country_id');
		}
		
		// 查询产品类型
		$sql = "SELECT warehouse_type, warehouse_combo,
					(SELECT `code` FROM `" . DB_PREFIX . "warehouse`
							WHERE ".(int)$shipping_country_id." IN(area)
							LIMIT 1) AS `code`
					FROM `" . DB_PREFIX . "product`";
					
		if (is_array($order)) {
			$sql .= " WHERE product_id = '".(int)$order['product_id']."'";
		} else {
			$sql .= " WHERE product_id = '".(int)$order."'";
		}
		
		$warehouse = $this->db->query($sql)->row;
		
		if ($warehouse['warehouse_type'] == 'combo' && !empty($warehouse['warehouse_combo'])) {
			$warehouse_combos = unserialize($warehouse['warehouse_combo']);
			
			$products[$warehouse['code']]['products'][] = $this->format($order, $order['quantity'], 'combo');
			
			foreach ($warehouse_combos as $warehouse_combo) {
				$this->formatProducts($warehouse_combo['product_id'], $order_id, $shipping_country_id, $products, $order['quantity'] * $warehouse_combo['quantity']);
			}
			
			return true;
		}
		
		if (!is_array($order)) {
			$sql = "SELECT pw.quantity,
							pw.warehouse_id,
							w.code,
							pd.name,
							p.model,
							p.price,
							p.warehouse_priority,
							p.warehouse_type,
							p.warehouse_combo
						FROM `" . DB_PREFIX . "product_warehouse` pw
							LEFT JOIN `" . DB_PREFIX . "warehouse` w ON(pw.warehouse_id = w.warehouse_id)
							LEFT JOIN `" . DB_PREFIX . "product` p ON(pw.product_id = p.product_id)
							LEFT JOIN `" . DB_PREFIX . "product_description` pd ON(pw.product_id = pd.product_id)
						WHERE pw.product_id = '".(int)$order."'
							AND ".(int)$shipping_country_id." IN(w.area)";
		} else {
			$sql = "SELECT pw.quantity,
							pw.warehouse_id,
							w.code,
							p.warehouse_priority,
							p.warehouse_type,
							p.warehouse_combo
						FROM `" . DB_PREFIX . "product_warehouse` pw
							LEFT JOIN `" . DB_PREFIX . "warehouse` w ON(pw.warehouse_id = w.warehouse_id)
							LEFT JOIN `" . DB_PREFIX . "product` p ON(pw.product_id = p.product_id)
						WHERE pw.product_id = '".(int)$order['product_id']."'
							AND ".(int)$shipping_country_id." IN(w.area)";
		}
		
		$warehouse = $this->db->query($sql)->row;
		
		if ($warehouse) {
			//删除仓库出货记录
			//$this->db->query("DELETE FROM `" . DB_PREFIX . "warehouse_to_order_product` WHERE `order_id` = '".(int)$order_id."'");
			
			if (!is_array($order)) {
				$order = array(
					'model'        => $warehouse['model'],
					'name'         => $warehouse['name'],
					'price'        => 0,
					'quantity'     => $qty
				);
			}
				
			$leftQuantity = $order['quantity'] - $warehouse['quantity'];
			
			// 配送地区库存不足
			if ($leftQuantity > 0) {
				// 更新仓库商品数量
				$data = array(
					'quantity'       => 0,
					'quantity2'      => $warehouse['quantity'], //订单商品数量
					'warehouse_id'   => $warehouse['warehouse_id'],
					'warehouse_code' => $warehouse['code'],
					'product_id'     => $order['product_id'],
					'order_id'       => $order_id,
				);
				$this->updateProductWarehouse($data);
				
				if ($warehouse['quantity']) {
					$products[$warehouse['code']]['products'][] = $this->format($order, $warehouse['quantity']);
				}
				
				// 按优先级查找其他仓库
				if ($warehouse['warehouse_priority']) {
					// 使用商品页设置的优先级
					$sql = "SELECT w.warehouse_id, w.code, pw.quantity FROM `" . DB_PREFIX . "product_warehouse` pw
								LEFT JOIN `" . DB_PREFIX . "warehouse` w ON(pw.warehouse_id = w.warehouse_id)
								WHERE pw.product_id = '".(int)$order['product_id']."'
									AND pw.warehouse_id != '".(int)$warehouse['warehouse_id']."'
								ORDER BY pw.priority ASC";
					
					$warehouses = $this->db->query($sql)->rows;
					
					$this->loopWarehouse($order, $order_id, $warehouses, $products, $leftQuantity);
				} else {
					// 使用仓库统一优先级
					$sql = "SELECT w.warehouse_id, w.code, pw.quantity FROM `" . DB_PREFIX . "warehouse_priority` wp
								LEFT JOIN `" . DB_PREFIX . "product_warehouse` pw ON(wp.warehouse_id = pw.warehouse_id)
								LEFT JOIN `" . DB_PREFIX . "warehouse` w ON(wp.warehouse_id = w.warehouse_id)
								WHERE pw.product_id = '".(int)$order['product_id']."'
									AND wp.warehouse_id != '".(int)$warehouse['warehouse_id']."'
								ORDER BY wp.priority ASC";
					
					$warehouses = $this->db->query($sql)->rows;
					
					$this->loopWarehouse($order, $order_id, $warehouses, $products, $leftQuantity);
				}
			} else {
				// 更新仓库商品数量
				$stock_qty = $warehouse['quantity'] - $order['quantity'];
				
				$data = array(
					'quantity'       => $stock_qty,
					'quantity2'      => $order['quantity'], //订单商品数量
					'warehouse_id'   => $warehouse['warehouse_id'],
					'warehouse_code' => $warehouse['code'],
					'product_id'     => $order['product_id'],
					'order_id'       => $order_id,
				);
				
				$this->updateProductWarehouse($data);
				
				$products[$warehouse['code']]['products'][] = $this->format($order, $order['quantity']);
			}
		}
	}
	
	private function format($data, $quantity, $type = 'standard') {
		return array(
			'product_id'     => $data['product_id'],
			'product_type'     => $type,
			'model'    => $data['model'],
			'name'     => $data['name'],
			'quantity' => $quantity,
			'price'    => $data['price'],
			'total'    => $data['price'] * $quantity
		);
	}
	
	protected function loopWarehouse($order, $order_id, $warehouses, &$products, $leftQuantity) {
		foreach ($warehouses as $w) {								
			// 如果该仓库库存还是不足，继续找其他仓库
			if ($leftQuantity > $w['quantity']) {
				if ($w['quantity']) {
					$products[$w['code']]['products'][] = $this->format($order, $w['quantity']);
				}
				
				$leftQuantity -= $w['quantity'];
				
				// 更新仓库商品数量
				$data = array(
					'quantity'       => 0, //仓库存量
					'quantity2'      => $w['quantity'], //订单商品数量
					'warehouse_id'   => $w['warehouse_id'],
					'warehouse_code' => $w['code'],
					'product_id'     => $order['product_id'],
					'order_id'       => $order_id,
				);
				
				$this->updateProductWarehouse($data);
			} else {
				$products[$w['code']]['products'][] = $this->format($order, $leftQuantity);
				
				// 更新仓库商品数量
				$stock_qty = $w['quantity'] - $leftQuantity;
				
				$data = array(
					'quantity'       => $stock_qty,
					'quantity2'      => $leftQuantity, //订单商品数量
					'warehouse_id'   => $w['warehouse_id'],
					'warehouse_code' => $w['code'],
					'product_id'     => $order['product_id'],
					'order_id'       => $order_id,
				);
				
				$this->updateProductWarehouse($data);
				break;
			}
		}
	}
	
	protected function updateProductWarehouse($data) {
		$sql = "UPDATE `" . DB_PREFIX . "product_warehouse`
						SET `quantity` = '".(int)$data['quantity']."'
					WHERE product_id = '".(int)$data['product_id']."'
						AND warehouse_id = '".(int)$data['warehouse_id']."'";
					
		$this->db->query($sql);
		
		$sql = "INSERT INTO `" . DB_PREFIX . "warehouse_to_order_product`
						SET `order_id` = '".(int)$data['order_id']."',
							`product_id` = '".(int)$data['product_id']."',
							`warehouse_id` = '".(int)$data['warehouse_id']."',
							`warehouse_code` = '".$this->db->escape($data['warehouse_code'])."',
							`quantity` = '".(int)$data['quantity2']."'";
					
		$this->db->query($sql);
	}
	
	protected function validate() {
		return $this->config->get('sma_status');
	}
	
	// 远程抓取代码
	private function c($method = 'GET', $data = '', $type = 'category', $timeout = '5') {		
		switch ($type) {
			case 'customer_add':
				$url = DIR_SMAHOST.'customer.php?t=add';
			break;
			case 'customer_edit':
				$url = DIR_SMAHOST.'customer.php?t=edit';
			break;
			case 'customer_delete':
				$url = DIR_SMAHOST.'customer.php?t=delete';
			break;
			case 'order_add':
				$url = DIR_SMAHOST.'order.php?t=add';
			break;
			case 'order_edit':
				$url = DIR_SMAHOST.'order.php?t=edit';
			break;
			case 'order_delete':
				$url = DIR_SMAHOST.'order.php?t=delete';
			break;
			default:
				$url = '';
		}
		
		$response = false;
		
		$ci = $url?curl_init($url):'';
		
		if (is_resource($ci)) {
			// 连接超时
			curl_setopt($ci, CURLOPT_TIMEOUT, $timeout);
			curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 1);
			// 传输速度限制
			//curl_setopt($ci, CURLOPT_LOW_SPEED_TIME, '1');
			//curl_setopt($ci, CURLOPT_LOW_SPEED_LIMIT, '1');
			// 最大跳转次数
			//curl_setopt($ci, CURLOPT_MAXREDIRS, 1);
			//curl_setopt($ci, CURLOPT_FOLLOWLOCATION, true);
			//
			curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ci, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ci, CURLOPT_AUTOREFERER, 1);
			curl_setopt($ci, CURLOPT_HEADER, 0);
			curl_setopt($ci, CURLOPT_NOBODY, 0);
			
			if ($method == 'POST') {
				$data = is_array($data)?http_build_query($data):$data;
				
				curl_setopt($ci, CURLOPT_CUSTOMREQUEST, 'POST');
				curl_setopt($ci, CURLOPT_POSTFIELDS, $data);
				curl_setopt($ci, CURLOPT_POSTREDIR, 1);
			}
			
			curl_setopt($ci, CURLOPT_URL, $url);
			$response = curl_exec($ci);
			
			// 记录错误
			if (curl_errno($ci)) {
				return 'CURL ERROR: '.curl_error($ci);
			}
			
			curl_close($ci);
		}
		
		if ($response) {
			$rlog = new Log('sma_log.log');
			
			if ($response == 'ok!') {
				$rlog->write(date('Y-m-d').' ['.$type.'] - 出现意外错误，请查看sma接口下的错误日志。');
			} else {
				$rlog->write(date('Y-m-d').' ['.$type.'] - '.print_r($response, true));
			}
		}
		
		return $response;
	}
}