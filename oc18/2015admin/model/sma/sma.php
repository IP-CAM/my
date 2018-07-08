<?php
class ModelSmaSma extends Model {
	/*
		@type string{
			currency_add
			currency_edit
			currency_delete
		}
	*/
	public function toSmaCurrency($data, $type = '') {
		if (!$this->validate()) {
			return false;
		}
		
		if ($type == 'currency_delete') {
			$sql = "SELECT `code` FROM warehouse
						WHERE id = '".(int)$data."'";
			
			$warehouse = $this->db->query($sql)->row;
			
			if ($warehouse) {
				$data = array();
				$data['code'] = $warehouse['code'];
			}
		}
		
		$this->c('POST', $data, $type);
	}
	
	/*
		@type string{
			warehouse_add
			warehouse_edit
			warehouse_delete
		}
	*/
	public function toSmaWarehouse($data, $type = '') {
		if (!$this->validate()) {
			return false;
		}
		
		if ($type == 'warehouse_delete') {
			$sql = "SELECT `code` FROM warehouse
						WHERE id = '".(int)$data."'";
			
			$warehouse = $this->db->query($sql)->row;
			
			if ($warehouse) {
				$data = array();
				$data['code'] = $warehouse['code'];
			}
		}
		
		$this->c('POST', $data, $type);
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
		if (isset($data['product']) && isset($data['payment_country_id'])) {
			$this->db->query("DELETE FROM `" . DB_PREFIX . "warehouse_to_order_product` WHERE `order_id` = '".(int)$data['order_id']."'");
			
			$sql = "SELECT * FROM `" . DB_PREFIX . "warehouse` ORDER BY warehouse_id";
			
			$warehouses = $this->db->query($sql)->rows;
			
			$warehouse_code = '';
			$default_code = '';
			
			foreach ($warehouses as $w) {
				$area = explode(',', $w['area']);
				
				if (in_array($data['payment_country_id'], $area)) {
					$warehouse_code = $w['code'];
				}
				
				if ($w['warehouse_id'] == $this->config->get('warehouse_default_id')) {
					$default_code = $w['code'];
				}
			}
			
			$warehouse_code = $warehouse_code?$warehouse_code:$default_code;
			
			if (!$warehouse_code) {
				return false;
			}
			
			$products = array();
			
			foreach ($data['product'] as $order) {
				$products[$warehouse_code]['products'][] = $this->format($order, '', $order['product_type']);
			}
			
			$sql = "SELECT lastname FROM `" . DB_PREFIX . "customer` WHERE customer_id = '".(int)$data['customer_id']."'";
			
			$customer = $this->db->query($sql)->row;
			
			$data = array(
				'order_id'         => $data['order_id'],
				'order_status_id'  => $data['order_status_id'],
				'status_return'    => $this->config->get('config_turnback_status'),
				'status_complete'  => $this->config->get('config_complete_status'),
				'email'            => $data['email'],
				'lastname'         => $customer?$customer['lastname']:'',
				'telephone'        => $data['telephone'],
				'comment'          => $data['comment'],
				'totals'           => $data['totals'],
				'warehouses'       => $products
			);
		}
		
		$this->c('POST', $data, $type);
	}
	
	private function format($data, $quantity, $type = 'standard') {
		return array(
			'product_id'     => $data['product_id'],
			'product_type'     => $type,
			'model'    => $data['model'],
			'name'     => $data['name'],
			'quantity' => $data['quantity'],
			'price'    => $data['price'],
			'total'    => $data['price'] * $data['quantity']
		);
	}
	
	protected function updateProductWarehouse($data) {
		//更新库存
		/*$sql = "UPDATE `" . DB_PREFIX . "product_warehouse`
						SET `quantity` = '".(int)$data['quantity']."'
					WHERE product_id = '".(int)$data['product_id']."'
						AND warehouse_id = '".(int)$data['warehouse_id']."'";
					
		$this->db->query($sql);*/
		
		//添加出货记录
		$sql = "INSERT INTO `" . DB_PREFIX . "warehouse_to_order_product`
						SET `order_id` = '".(int)$data['order_id']."',
							`product_id` = '".(int)$data['product_id']."',
							`warehouse_id` = '".(int)$data['warehouse_id']."',
							`warehouse_code` = '".$this->db->escape($data['warehouse_code'])."',
							`quantity` = '".(int)$data['quantity2']."'";
					
		$this->db->query($sql);
	}
	
	public function toSmaCustomerGroup() {
		if (!$this->validate()) {
			return false;
		}
	}
	
	/*
		@type string{
			category
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
		
		if ($type == 'customer_add' || $type == 'customer_edit') {
			$sql = "SELECT SUM(points) AS total FROM `" . DB_PREFIX . "customer_reward` cr
						LEFT JOIN `" . DB_PREFIX . "customer` c
						ON (cr.customer_id = c.customer_id)
						WHERE c.customer_id = '".(int)$data['customer_id']."'";
			
			$query = $this->db->query($sql)->row;
			
			if ($query) {
				$data['points'] = $query['total'];
			}
		}
		
		// delete customer
		if ($type == 'customer_delete') {
			$sql = "SELECT email FROM `" . DB_PREFIX . "customer`
						WHERE customer_id = '".(int)$data['customer_id']."'";
			
			$query = $this->db->query($sql)->row;
			
			if ($query) {
				$data['email'] = $query['email'];
			}
		}
		
		$this->c('POST', $data, $type);
	}
	
	public function toSmaCustomerPoints($customer_id) {
		if (!$this->validate()) {
			return false;
		}
		
		$sql = "SELECT SUM(cr.points) AS total, c.email, c.telephone FROM `" . DB_PREFIX . "customer_reward` cr
					LEFT JOIN `" . DB_PREFIX . "customer` c
					ON (cr.customer_id = c.customer_id)
					WHERE c.customer_id = '".(int)$customer_id."'";
		
		$query = $this->db->query($sql)->row;
		
		$data = array(
			'email'      => $query?$query['email']:'',
			'telephone'  => $query?$query['telephone']:'',
			'points'     => $query?$query['total']:0
		);
		
		$this->c('POST', $data, 'customer_points');
	}
	
	public function deltePointsByOrderId($order_id) {
		if (!$this->validate()) {
			return false;
		}
		
		$sql = "SELECT customer_id FROM `" . DB_PREFIX . "customer_reward`
					WHERE order_id = '".(int)$order_id."'
					LIMIT 1";
		
		$query = $this->db->query($sql)->row;
		
		if ($query) {
			$this->toSmaCustomerPoints($query['customer_id']);
		}
	}
	
	/*
		@type string{
			category
			product_add
			product_edit
			product_delete
		}
	*/
	public function toSmaProduct($data, $type = '') {
		if (!$this->validate()) {
			return false;
		}
		
		if ($data && ($type == 'product_add' || $type == 'product_edit')) {
			$data['product_description'] = $data['product_description'][4];
			
			$categories = array();
			
			if (!empty($data['product_category'])) {
				foreach ($data['product_category'] as $pc) {
					$categories[] = $pc;
				}
			}
			
			// format Categories
			if ($categories) {
				$sql = "SELECT path_id,
							(SELECT category_id FROM " . DB_PREFIX . "category
								WHERE `parent_id` = path_id
									AND category_id IN(".implode(',', $categories).")
								LIMIT 1
							) AS child_id
							FROM " . DB_PREFIX . "category_path
								WHERE `level` = 0
									AND path_id IN(".implode(',', $categories).")
								LIMIT 1";
		
				$query = $this->db->query($sql)->row;
				
				if ($query) {
					$data['product_category'] = array(
						0 => !empty($query['path_id'])?$query['path_id']:0,
						1 => !empty($query['child_id'])?$query['child_id']:0
					);
				}
			}
			
			// formart
			
			$this->c('POST', $data, $type);
		}
	}
	
	public function toSmaCategory() {
		if (!$this->validate()) {
			return false;
		}
		
		$categories = $this->getCategories(0);
		
		//$this->log->write($categories);
		
		if ($categories){
			$this->c('POST', $categories, 'category');
		}
	}
	
	private function getCategories($id = 0) {
		$sql = "SELECT * FROM " . DB_PREFIX . "category c
					LEFT JOIN " . DB_PREFIX . "category_description cd
					ON(c.category_id = cd.category_id)
					WHERE cd.language_id = '4'
						AND c.parent_id = '".(int)$id."'
					ORDER BY c.category_id";
		
		$query = $this->db->query($sql);
		
		$data['categories'] = array();
		
		foreach ($query->rows as $category) {
			$data['categories'][] = array(
				'category_id' => $category['category_id'],
				'name'        => $category['name'],
				'parent_id'   => $category['parent_id'],
				'childs'      => $category['parent_id']?array():$this->getCategories($category['category_id'])
			);
		}
		
		return $data;
	}
	
	protected function validate() {
		return $this->config->get('sma_status');
	}
	
	// 远程抓取代码
	private function c($method = 'GET', $data = '', $type = 'category', $timeout = '5') {		
		switch ($type) {
			case 'warehouse_add':
				$url = DIR_SMAHOST.'warehouse.php?t=add';
			break;
			case 'warehouse_edit':
				$url = DIR_SMAHOST.'warehouse.php?t=edit';
			break;
			case 'warehouse_delete':
				$url = DIR_SMAHOST.'warehouse.php?t=delete';
			break;
			case 'customer_add':
				$url = DIR_SMAHOST.'customer.php?t=add';
			break;
			case 'customer_edit':
				$url = DIR_SMAHOST.'customer.php?t=edit';
			break;
			case 'customer_delete':
				$url = DIR_SMAHOST.'customer.php?t=delete';
			break;
			case 'customer_points':
				$url = DIR_SMAHOST.'customer.php?t=points';
			break;
			case 'category':
				$url = DIR_SMAHOST.'category.php';
			break;
			case 'product_add':
				$url = DIR_SMAHOST.'product.php?t=add';
			break;
			case 'product_edit':
				$url = DIR_SMAHOST.'product.php?t=edit';
			break;
			case 'product_delete':
				$url = DIR_SMAHOST.'product.php?t=delete';
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