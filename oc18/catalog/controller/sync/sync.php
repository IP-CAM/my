<?php
class ControllerSyncSync extends Controller {
	private $limit = 200; //循环限制
	private $output = '';
	
	public function product_down() {
		if (isset($this->request->get['product_id'])) {
			$sql = "UPDATE `" . DB_PREFIX . "product`
						SET `status` = '0'
						WHERE product_id = '".(int)$this->request->get['product_id']."'";
			
			$this->db->query($sql);
		}
	}
	
	public function index() {
		if (isset($this->request->get['type'])) {
			$t = $this->request->get['type'];
		} else {
			$t = '';
		}
		
		if (isset($this->request->get['limit'])) {
			$this->limit = (int)$this->request->get['limit'];
		}
		
		// 清空所有文件
		/*if ($t) {
			$this->delete();
		}*/
		
		if (!$this->checkTime($t)) {
			switch ($t) {
				case 'warehouse':
					$this->warehouse();
					$this->write($this->output, $t);
					break;
				case 'category':
					$this->category();
					$this->write($this->output, $t);
					break;
				case 'customer':
					$this->customer();
					$this->write($this->output, $t);
					break;
				case 'product':
					$this->product();
					$this->write($this->output, $t);
					break;
				case 'order':
					$this->order();
					$this->write($this->output, $t);
					break;
			}
		}
		
		echo 'ok';
	}
	
	public function checkTime($type) {
		$filename = DIR_ROOT.'/sync/sync_'.$type.'.sql';
		$exists   = file_exists($filename);
		
		if ($exists) {
			$date = filemtime($filename);
			
			if ($date && time() > ((int)$date + 43200)) {
				return true;
			}
		}
		
		$this->delete($type);
		
		return false;
	}
	
	public function delete($type = '') {
		$files = glob(DIR_ROOT.'/sync/sync_'.$type.'*.sql');
		
		if ($files) {
			foreach ($files as $file) {
				@unlink($file);
			}
		}
	}
	
	public function order() {		
		//统计订单总数
		if (!isset($this->session->data['order_total'])) {			
			$sql = "SELECT COUNT(customer_id) AS total FROM `" . DB_PREFIX . "order`";
			
			$this->session->data['order_total'] = $this->db->query($sql)->row['total'];
		}
		
		if (!isset($this->session->data['order_loop'])) {
			$loop = 1;
		} else {
			$loop = $this->session->data['order_loop'];
		}
		
		$this->session->data['order_loop'] = $loop + 1;
		
		$start = ($loop - 1) * $this->limit;
		//================================================================
		
		
		$status_return = $this->config->get('config_turnback_status');
		$status_complete = $this->config->get('config_complete_status');
		
		if (!$this->output) {
			$this->output = array();
		}
		
		$sql = "SELECT * FROM `" . DB_PREFIX . "order`
					WHERE order_status_id > 0
					ORDER BY order_id ASC
					LIMIT ".(int)$start.", ".(int)$this->limit;
		
		$orders = $this->db->query($sql)->rows;
			
		$row = 0;
		
		foreach ($orders as $order) {
			//调取order total数组，组合$discount, 
			$sql = "SELECT * FROM `" . DB_PREFIX . "order_total`
						WHERE order_id = '".(int)$order['order_id']."'";
			
			$totals = $this->db->query($sql)->rows;
			
			$discount = 0;
			$shipping = 0;
			
			foreach ($totals as $total) {
				if ($total['code'] == 'shipping') {
					$shipping += (float)$total['value'];
				}
				
				if ($total['code'] != 'sub_total' && $total['code'] != 'total' && $total['code'] != 'shipping') {
					$discount += (float)$total['value'];
				}
			}
			
			//获取订单状态
			$order_status = 'pending';
			
			if (in_array($order['order_status_id'], $status_return))
			{
				$order_status = 'return';
			}
			
			if (in_array($order['order_status_id'], $status_complete))
			{				
				$order_status = 'completed';
			}
			
			//调取订单商品数据，归类到仓库
			$total_items = 0;
			$warehouses = $this->formatOrder($order, $total_items);
			
			foreach ($warehouses as $warehouse_id => $warehouse) {
				//构造订单数据
				$this->output[] = array(
					'date'                 => $order['date_added'],
					'reference_no'         => $order['order_id'],
					'email'                => $order['email'],
					'customer'             => $order['firstname'],
					'warehouse_id'         => $warehouse_id,
					'note'                 => $order['comment'],
					'discount'             => -$discount,
					'shipping'             => $shipping,
					'sale_status'          => $order_status,
					'updated_at'           => $order['date_modified'],
					'products'             => $warehouse['products'],
					'total_items'          => count($warehouse['products'])
				);
			}
		}
		
		
		
		
		//================================================================		
		$end = $start + $this->limit;
		
		if ($end >= $this->session->data['order_total']) {
			unset($_SESSION['order_total']);
			unset($_SESSION['order_loop']);
			$this->output = json_encode($this->output);
		} else {
			$this->order();
		}
	}
	
	public function formatOrder($order, &$total_items) {
		$sql = "SELECT * FROM `" . DB_PREFIX . "warehouse`
					ORDER BY warehouse_id";
			
		$warehouses = $this->db->query($sql)->rows;
			
		$warehouse_id = '';
		
		foreach ($warehouses as $w) {
			$area = explode(',', $w['area']);
			
			if (in_array($order['payment_country_id'], $area)) {
				$warehouse_id = $w['warehouse_id'];
				
				break;
			}
		}
			
		$w_id = $warehouse_id?$warehouse_id:$this->config->get('warehouse_default_id');
		
		$sql = "SELECT *,
				(SELECT warehouse_type FROM `" . DB_PREFIX . "product`
						WHERE product_id = op.product_id) AS product_type
					FROM `" . DB_PREFIX . "order_product` op
					WHERE op.order_id = '".$order['order_id']."'";
		
		$products = $this->db->query($sql)->rows;
		
		$warehouses = array();
		
		foreach ($products as $product) {
			$warehouses[$w_id]['products'][] = $product;
			
			$total_items++;
		}
		
		return $warehouses;
	}
	
	public function category() {
		$code = '';
		$cd = '';
		$cd2 = '';
		
		$query = $this->getCategories();
		
		if ($query) {
			foreach ($query as $category) {
				$cd .= ',(\'C'.$category['category_id'].'\', \''.$category['name'].'\')';
				
				$childs = $this->getCategories($category['category_id']);
				
				if ($childs) {
					foreach ($childs as $child) {
						$cd2 .= ',(\''.$category['category_id'].'\', \'C'.$child['category_id'].'\', \''.$child['name'].'\')';
					}
				}
			}
			
			$code .= 'TRUNCATE TABLE `sma_categories`;' . "\n";
			$code .= 'TRUNCATE TABLE `sma_subcategories`;' . "\n";
		}
		
		if ($cd) {
			$code .= 'INSERT INTO `sma_categories` (`code`, `name`) VALUES'.trim($cd, ',').';'."\n";
		}
		
		if ($cd2) {
			$code .= 'INSERT INTO `sma_subcategories` (`category_id`, `code`, `name`) VALUES'.trim($cd2, ',').';';
		}
		
		$this->output .= $code;
	}
	
	private function getCategories($id = 0) {
		$sql = "SELECT * FROM " . DB_PREFIX . "category c
					LEFT JOIN " . DB_PREFIX . "category_description cd
					ON(c.category_id = cd.category_id)
					WHERE cd.language_id = '4'
						AND c.parent_id = '".(int)$id."'
					ORDER BY c.category_id";
		
		return $this->db->query($sql)->rows;
	}

	public function warehouse() {
		$code = '';
		$w = '';
		
		$sql = "SELECT * FROM `" . DB_PREFIX . "warehouse`";
		
		$warehouses = $this->db->query($sql)->rows;
		
		if ($warehouses) {
			foreach ($warehouses as $warehouse) {
				$w .= ',(\''.$warehouse['code'].'\', \''.$warehouse['name'].'\', \''.$warehouse['address'].'\', \''.$warehouse['phone'].'\', \''.$warehouse['email'].'\')';
			}
		
			if ($w) {
			
				$code .= 'TRUNCATE TABLE `sma_warehouses`;' . "\n";
				$code .= 'INSERT INTO `sma_warehouses`(`code`, `name`, `address`, `phone`, `email`) VALUES'.trim($w, ',').';'."\n";
			}
		}
		
		$this->output .= $code;
	}

	public function customer() {
		$code = '';
		
		
		//统计用户总数
		if (!isset($this->session->data['customer_total'])) {
			//$code .= 'TRUNCATE TABLE `sma_companies`;' . "\n";
			$code .= 'DELETE FROM `sma_companies` WHERE `group_name` = "customer" AND `id` > 1;' . "\n";
			
			$sql = "SELECT COUNT(customer_id) AS total FROM `" . DB_PREFIX . "customer`";
			
			$this->session->data['customer_total'] = $this->db->query($sql)->row['total'];
		}
		
		if (!isset($this->session->data['customer_loop'])) {
			$loop = 1;
		} else {
			$loop = $this->session->data['customer_loop'];
		}
		
		$this->session->data['customer_loop'] = $loop + 1;
		
		$start = ($loop - 1) * $this->limit;
		
		//调取客户数据
		$sql = "SELECT lastname, telephone, email, address_id, (SELECT SUM(points) FROM `" . DB_PREFIX . "customer_reward` cr
							WHERE cr.customer_id = c.customer_id) AS pionts
					FROM `" . DB_PREFIX . "customer` c
					LIMIT ".(int)$start.", ".(int)$this->limit;
		
		$customers = $this->db->query($sql)->rows;
		
		$cd = '';
		
		foreach ($customers as $customer) {
			$sql = "SELECT *,
				(SELECT name FROM `" . DB_PREFIX . "country` c
					WHERE c.country_id = a.country_id) AS country,
				(SELECT name FROM `" . DB_PREFIX . "zone` z
					WHERE z.zone_id = a.zone_id) AS zone
			FROM `" . DB_PREFIX . "address` a
			WHERE a.address_id = '".(int)$customer['address_id']."'";
			
			$ads = $this->db->query($sql)->row;
			
			$formartCustomer = array(
				'group_id' => '3',
				'group_name' => 'customer',
				'customer_group_id' => '1',
				'customer_group_name' => 'customer',
				'name' => $customer['lastname'],
				'company' => $ads?$ads['company']:'',
				'vat_no' => '',
				'address' => $ads?$ads['address_1']:'',
				'city' => $ads?$ads['city']:'',
				'state' => $ads?$ads['zone']:'',
				'postal_code' => $ads?$ads['postcode']:'',
				'country' => $ads?$ads['country']:'',
				'phone' => isset($customer['telephone'])?$customer['telephone']:'',
				'email' => $customer['email'],
				'cf1' => '',
				'cf2' => '',
				'cf3' => '',
				'cf4' => '',
				'cf5' => '',
				'cf6' => '',
				'payment_term' => '0',
				'logo' => 'logo.png',
				'award_points' => !empty($customer['points'])?$customer['points']:0
			);

			$values = '';

			foreach (array_values($formartCustomer) as $value) {
				$values .= '\'' . $this->formartData($value) . '\', ';
			}

			$cd .= ',(' . preg_replace('/, $/', '', $values) . ')';
		}
		
		if ($cd) {
			$formartCustomer = array(
				'group_id',
				'group_name',
				'customer_group_id',
				'customer_group_name',
				'name',
				'company',
				'vat_no',
				'address',
				'city',
				'state',
				'postal_code',
				'country',
				'phone',
				'email',
				'cf1',
				'cf2',
				'cf3',
				'cf4',
				'cf5',
				'cf6',
				'payment_term',
				'logo',
				'award_points'
			);
			
			$fields = '';
	
			foreach ($formartCustomer as $value) {
				$fields .= '`' . $value . '`, ';
			}
			
			$code .= 'INSERT INTO `sma_companies` (' . preg_replace('/, $/', '', $fields) . ') VALUES'.trim($cd, ',').';'."\n";
		}
		
		$this->output .= $code;
		
		$end = $start + $this->limit;
		
		if ($end >= $this->session->data['customer_total']) {
			unset($_SESSION['customer_total']);
			unset($_SESSION['customer_loop']);
		} else {
			$this->customer();
		}
	}

	public function product() {		
		$code = '';
		$code_product = '';
		$code_photo = '';
		$code_purchase = '';
		$code_warehouse = '';
		
		//统计商品总数
		if (!isset($this->session->data['product_total'])) {
			$code .= 'TRUNCATE TABLE `sma_products`;' . "\n";
			$code .= 'TRUNCATE TABLE `sma_product_photos`;' . "\n";
			//$code .= 'TRUNCATE TABLE `sma_warehouses_products`;' . "\n";
			//$code .= 'TRUNCATE TABLE `sma_purchase_items`;' . "\n";
			
			$sql = "SELECT COUNT(product_id) AS total FROM `" . DB_PREFIX . "product`";
			
			$this->session->data['product_total'] = $this->db->query($sql)->row['total'];
		}
		
		if (!isset($this->session->data['product_loop'])) {
			$loop = 1;
		} else {
			$loop = $this->session->data['product_loop'];
		}
		
		$this->session->data['product_loop'] = $loop + 1;
		
		$start = ($loop - 1) * $this->limit;
		
		//调取商品数据
		$sql = "SELECT * FROM `" . DB_PREFIX . "product` p LIMIT ".$start.", ".$this->limit;
		
		$products = $this->db->query($sql)->rows;
		
		foreach ($products as $product) {
			$category    = $this->getCategory($product['product_id']);
			$description = $this->getProductDescriptions($product['product_id']);
			
			$formartProduct = array(
				'product_id'       => $product['product_id'],
				'code'             => $product['model'],
				'name'             => $description?$description[4]['name']:'',
				'unit'             => 'piece',
				'cost'             => $product['cost'],
				'price'            => $product['price'],
				'alert_quantity'   => '1',
				'image'            => $product['image'],
				'category_id'      => !empty($category)?(int)$category[0]:0,
				'subcategory_id'   => !empty($category)?(int)$category[1]:0,
				//'quantity'         => 1, //$product['quantity'],
				'tax_rate'         => '1',
				'track_quantity'   => '1',
				'details'          => '',
				'barcode_symbology'=> 'code128',
				'product_details'  => $description?$description[4]['description']:'',
				'cf1'              => '',
				'cf2'              => '',
				'cf3'              => '',
				'cf4'              => '',
				'cf5'              => '',
				'cf6'              => '',
				'supplier1'        => '',
			);
	
			$values = '';

			foreach (array_values($formartProduct) as $value) {
				$values .= '\'' . $this->formartData($value) . '\', ';
			}
			
			$code_product .= ',(' . preg_replace('/, $/', '', $values) . ')';
			
			//商品附图
			$sql = "SELECT * FROM `" . DB_PREFIX . "product_image`
						WHERE product_id = '".(int)$product['product_id']."'";
			
			$images = $this->db->query($sql)->rows;
			
			if ($images) {				
				$c = '';
				
				foreach ($images as $image) {
					$c .= ',(\''.(int)$product['product_id'].'\', \''.$this->formartData($image['image']).'\')';
				}
				
				$code_photo .= $c;
			}
			
			//仓库商品
			/*$sql = "SELECT * FROM `" . DB_PREFIX . "product_warehouse` pw
							LEFT JOIN `" . DB_PREFIX . "warehouse` w ON(pw.warehouse_id = w.warehouse_id)
						WHERE pw.product_id = '".(int)$product['product_id']."'";
			
			$warehouses = $this->db->query($sql)->rows;
			
			foreach ($warehouses as $warehouse) {
				$code_warehouse .= ',(\''.(int)$product['product_id'].'\', \''.$warehouse['warehouse_id'].'\', \''.$warehouse['quantity'].'\', \''.$this->formartData($warehouse['rack']).'\')';
			
				//purchase
				$purchase_items_data = array(
					'product_id'           => (int)$product['product_id'],
					'product_code'         => $product['model'],
					'product_name'         => $description?$description[4]['name']:'',
					'option_id'            => NULL,
					'net_unit_cost'        => (float)$product['cost'],
					'quantity'             => (int)$warehouse['quantity'],
					'warehouse_id'         => $warehouse['code'],
					'tax_rate_id'          => '1',
					'subtotal'             => (float)$product['cost'] * (int)$warehouse['quantity'],
					'quantity_balance'     => (int)$warehouse['quantity'],
					'date'                 => date('Y-m-d'),
					'status'               => 'received',
					'unit_cost'            => (float)$product['cost']
				);
	
				$values = '';
	
				foreach (array_values($purchase_items_data) as $value) {
					$values .= '\'' . $this->formartData($value) . '\', ';
				}
	
				$code_purchase .= ',(' . preg_replace('/, $/', '', $values) . ')';
			}*/
		}
		
		
		// 组合sql
		if ($code_product) {
			$col = array(
				'product_id',
				'code',
				'name',
				'unit',
				'cost',
				'price',
				'alert_quantity',
				'image',
				'category_id',
				'subcategory_id',
				//'quantity',
				'tax_rate',
				'track_quantity',
				'details',
				'barcode_symbology',
				'product_details',
				'cf1',
				'cf2',
				'cf3',
				'cf4',
				'cf5',
				'cf6',
				'supplier1',
			);
				
			$fields = '';

			foreach ($col as $value) {
				$fields .= '`' . $value . '`, ';
			}
			
			$code .= 'INSERT INTO `sma_products` (' . preg_replace('/, $/', '', $fields) . ') VALUES'.trim($code_product, ',').';'."\n";
		}
		
		if ($code_photo) {
			$code .= 'INSERT INTO `sma_product_photos` (`product_id`, `photo`) VALUES'.trim($code_photo, ',').';'."\n";
		}
		
		if ($code_warehouse) {
			$code .= 'INSERT INTO `sma_warehouses_products` (`product_id`, `warehouse_id`, `quantity`, `rack`) VALUES'.trim($code_warehouse, ',').';'."\n";
		}
		
		if ($code_purchase) {
			//purchase
			$col = array(
				'product_id',
				'product_code',
				'product_name',
				'option_id',
				'net_unit_cost',
				'quantity',
				'warehouse_id',
				'tax_rate_id',
				'subtotal',
				'quantity_balance',
				'date',
				'status',
				'unit_cost'
			);
				
			$fields = '';

			foreach ($col as $value) {
				$fields .= '`' . $value . '`, ';
			}
			
			$code .= 'INSERT INTO `sma_purchase_items` (' . preg_replace('/, $/', '', $fields) . ') VALUES'.trim($code_purchase, ',').';';
		}
		
		$this->output .= $code;
		
		$end = $start + $this->limit;
		
		if ($end >= $this->session->data['product_total']) {
			unset($_SESSION['product_total']);
			unset($_SESSION['product_loop']);
		} else {
			$this->product();
		}
	}
	
	public function getCategory($product_id) {
		//商品分类
		$data = '';
		
		$sql = "SELECT path_id,
						(SELECT path_id FROM " . DB_PREFIX . "category_path c
								LEFT JOIN `" . DB_PREFIX . "product_to_category` ptc1 ON(c.category_id = ptc1.category_id)
							WHERE cp.level = '1'
								AND ptc1.product_id = '".(int)$product_id."'
							LIMIT 1
						) AS child_id
					FROM `" . DB_PREFIX . "category_path` cp
						LEFT JOIN `" . DB_PREFIX . "product_to_category` ptc ON(cp.category_id = ptc.category_id)
					WHERE cp.level = '0'
						AND ptc.product_id = '".(int)$product_id."'
					LIMIT 1";

		$query = $this->db->query($sql)->row;
		
		if ($query) {
			$data = array(
				0 => !empty($query['path_id'])?$query['path_id']:0,
				1 => !empty($query['child_id'])?$query['child_id']:0
			);
		}
		
		return $data;
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
	
	public function formartData($value) {
		$value = str_replace(array("\x00", "\x0a", "\x0d", "\x1a"), array('\0', '\n', '\r', '\Z'), $value);
		$value = str_replace(array("\n", "\r", "\t"), array('\n', '\r', '\t'), $value);
		$value = str_replace('\\', '\\\\',	$value);
		$value = str_replace('\'', '\\\'',	$value);
		$value = str_replace('\\\n', '\n',	$value);
		$value = str_replace('\\\r', '\r',	$value);
		$value = str_replace('\\\t', '\t',	$value);
		
		return $value;
	}
	
	public function write($data, $type) {
		$handle = fopen($_SERVER['DOCUMENT_ROOT'].'/sync/sync_'.$type.'.sql', 'w');
		
		fwrite($handle, print_r($data, true));
		
		fclose($handle);
	}
}
?>