<?php
class ControllerModuleWarehouse extends Controller {
	private $error = array();
	
	public function index() {
		$this->load->language('module/warehouse');
		
		$this->document->setTitle($this->language->get('text_edit'));
		
		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_alert_delete'] = $this->language->get('text_alert_delete');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_add'] = $this->language->get('button_add');
		$data['button_remove'] = $this->language->get('button_remove');
		$data['button_cancel'] = $this->language->get('button_cancel');
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		$data['breadcrumbs'] = array();
		
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);
		
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
		);
		
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_edit'),
			'href' => $this->url->link('module/warehouse', 'token=' . $this->session->data['token'], 'SSL')
		);
		
		$data['action'] = $this->url->link('module/warehouse', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view('module/warehouse.tpl', $data));
	}
	
	public function whlist(){
		$this->load->language('module/warehouse');
		
		$data['text_edit'] = $this->language->get('text_edit');
		
		$data['column_name'] = $this->language->get('column_name');
		$data['column_address'] = $this->language->get('column_address');
		$data['column_action'] = $this->language->get('column_action');
		
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_remove'] = $this->language->get('button_remove');
		
		if (isset($this->request->get['page'])) {
			$page = (int)$this->request->get['page'];
		} else {
			$page = 1;
		}
		
		$limit = 20;
		$start = ($page - 1 ) * $limit;
		$pagination = '';
		$pagetext = '';
		$warehouses = array();
		
		$query_total = $this->db->query("SELECT warehouse_id FROM `" . DB_PREFIX . "warehouse`");
		
		if ($total = $query_total->num_rows) {
			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "warehouse` ORDER BY name LIMIT ".(int)$start.",".(int)$limit);
			
			if ($query->num_rows) {
				foreach ($query->rows as $warehouse) {
					$warehouses[] = array(
						'default'          => $warehouse['warehouse_id'] == $this->config->get('warehouse_default_id'),
						'warehouse_id'     => $warehouse['warehouse_id'],
						'code'             => $warehouse['code'],
						'name'             => $warehouse['name'],
						'address'          => $warehouse['address'],
						'phone'            => $warehouse['phone'],
						'email'            => $warehouse['email']
					);
				}
			}
			
			
			// pagination =============
			$total_page = ceil($total / $limit);
			
			if ($total_page > 1) {
				if ($total_page <= 5) {
					$s = 1;
					$e = $total_page;
				} else {
					$s = $page - 5;
					$e = $page + 5;
	
					if ($s < 1) {
						$e += abs($s) + 1;
						$s = 1;
					}
	
					if ($e > $total_page) {
						$s -= ($e - $total_page);
						$e = $total_page;
					}
				}
	
				for ($i = $s; $i <= $e; $i++) {
					if ($page == $i) {
						$pagination .= '<li class="active"><span>' . $i . '</span></li>';
					} else {
						$pagination .= '<li><a href="#" onclick="list('.$i.'); return false;">' . $i . '</a></li>';
					}
				}
			}
			
			$pagination = '<ul class="pagination">'.$pagination.'</ul>';
			$pagetext = $page.' / '.$total_page.' ::: '.$total;
		}
		
		$data['warehouses'] = $warehouses;
		$data['pagination'] = $pagination;
		$data['pagetext'] = $pagetext;
		$data['token'] = $this->session->data['token'];
		
		$this->response->setOutput($this->load->view('module/warehouse_list.tpl', $data));
	}
	
	public function whform(){
		$this->load->language('module/warehouse');
		
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		
		$data['entry_code'] = $this->language->get('entry_code');
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_address'] = $this->language->get('entry_address');
		$data['entry_phone'] = $this->language->get('entry_phone');
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_area'] = $this->language->get('entry_area');
		$data['entry_priority'] = $this->language->get('entry_priority');
		$data['entry_default'] = $this->language->get('entry_default');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		
		if (isset($this->request->get['id'])) {
			$warehouse_id = $this->request->get['id'];
		} else {
			$warehouse_id = 0;
		}
		
		$sql = "SELECT *,
					(SELECT priority FROM `" . DB_PREFIX . "warehouse_priority` wp
					WHERE wp.warehouse_id = '".(int)$warehouse_id."'
					AND wp.spare_id = w.warehouse_id) AS priority
					FROM `" . DB_PREFIX . "warehouse` w
					WHERE w.warehouse_id != '".(int)$warehouse_id."'
					ORDER BY priority DESC";
		
		$data['warehouses'] = $this->db->query($sql)->rows;
		
		$sql = "SELECT * FROM `" . DB_PREFIX . "warehouse` WHERE warehouse_id = '".(int)$warehouse_id."'";
		
		$warehouse = $this->db->query($sql)->row;
		
		if (isset($this->request->get['id'])) {
			$data['warehouse_id'] = (int)$this->request->get['id'];
		} else {
			$data['warehouse_id'] = 0;
		}
		
		if (isset($this->request->post['code'])) {
			$data['code'] = $this->request->post['code'];
		} elseif ($warehouse) {
			$data['code'] = $warehouse['code'];
		} else {
			$data['code'] = '';
		}
		
		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif ($warehouse) {
			$data['name'] = $warehouse['name'];
		} else {
			$data['name'] = '';
		}
		
		if (isset($this->request->post['address'])) {
			$data['address'] = $this->request->post['address'];
		} elseif ($warehouse) {
			$data['address'] = $warehouse['address'];
		} else {
			$data['address'] = '';
		}
		
		if (isset($this->request->post['phone'])) {
			$data['phone'] = $this->request->post['phone'];
		} elseif ($warehouse) {
			$data['phone'] = $warehouse['phone'];
		} else {
			$data['phone'] = '';
		}
		
		if (isset($this->request->post['email'])) {
			$data['email'] = $this->request->post['email'];
		} elseif ($warehouse) {
			$data['email'] = $warehouse['email'];
		} else {
			$data['email'] = '';
		}
		
		$this->load->model('localisation/country');
		
		$data['countries'] = $this->model_localisation_country->getCountries();
		
		if (isset($this->request->post['area'])) {
			$data['area'] = $this->request->post['area'];
		} elseif ($warehouse) {
			$data['area'] = explode(',', $warehouse['area']);
		} else {
			$data['area'] = array();
		}
		
		if (isset($this->request->post['default'])) {
			$data['default'] = $this->request->post['default'];
		} elseif ($warehouse && $this->config->get('warehouse_default_id')) {
			$data['default'] = ((int)$this->config->get('warehouse_default_id') === (int)$warehouse['warehouse_id']) ? 1 : 0;
		} else {
			$data['default'] = 0;
		}
		
		
		$this->response->setOutput($this->load->view('module/warehouse_form.tpl', $data));
	}
	
	public function whdel(){
		$json = array();
		
		if (isset($this->request->get['id']) && $this->user->hasPermission('modify', 'module/warehouse')) {
			$ids = explode(',', $this->request->get['id']);
			
			if (!in_array($this->config->get('warehouse_default_id'), $ids)) {
				$this->load->model('sma/sma');
				
				foreach ($ids as $warehouse_id) {
					$this->model_sma_sma->toSmaWarehouse($warehouse_id, 'warehouse_delete');
					
					$this->db->query("DELETE FROM `" . DB_PREFIX . "warehouse` WHERE warehouse_id = '".(int)$warehouse_id."'");
					$this->db->query("DELETE FROM `" . DB_PREFIX . "warehouse_priority` WHERE warehouse_id = '".(int)$warehouse_id."'");
					$this->db->query("DELETE FROM `" . DB_PREFIX . "product_warehouse` WHERE warehouse_id = '".(int)$warehouse_id."'");
				}
				
				$json['success'] = 'Data deleted.';
			} else {
				$json['error'] = 'can not remove default id';
			}
		} else {
			$json['error'] = 'error permission';
		}
		
		$this->response->setOutput(json_encode($json));
	}
	
	public function save(){
		$json = array();
		
		$this->load->language('module/warehouse');
		
		if (!$this->user->hasPermission('modify', 'module/warehouse')) {
			$json['error_permission'] = $this->language->get('error_permission');
		}
		
		if (utf8_strlen($this->request->post['code']) < 1 || utf8_strlen($this->request->post['code']) > 32) {
			$json['error_code'] = $this->language->get('error_code');
		}
		
		if (utf8_strlen($this->request->post['name']) < 1 || utf8_strlen($this->request->post['name']) > 32) {
			$json['error_name'] = $this->language->get('error_name');
		}
		
		if (utf8_strlen($this->request->post['address']) < 1 || utf8_strlen($this->request->post['address']) > 150) {
			$json['error_address'] = $this->language->get('error_address');
		}
		
		if (utf8_strlen($this->request->post['phone']) < 1 || utf8_strlen($this->request->post['phone']) > 32) {
			$json['error_phone'] = $this->language->get('error_phone');
		}
		
		if (utf8_strlen($this->request->post['email']) < 1 || utf8_strlen($this->request->post['email']) > 96 || !preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $this->request->post['email'])) {
			$json['error_email'] = $this->language->get('error_email');
		}
		
		if (!$json) {
			$sql = "`" . DB_PREFIX . "warehouse` SET `code` = '".$this->db->escape($this->request->post['code'])."',
						name = '".$this->db->escape($this->request->post['name'])."',
						address = '".$this->db->escape($this->request->post['address'])."',
						phone = '".$this->db->escape($this->request->post['phone'])."',
						email = '".$this->db->escape($this->request->post['email'])."',
						area = '".$this->db->escape(implode(',', $this->request->post['area']))."'";
			
			$this->load->model('sma/sma');
			
			$sma_data = array(
				'code'      => $this->db->escape($this->request->post['code']),
				'name'      => $this->db->escape($this->request->post['name']),
				'address'   => $this->db->escape($this->request->post['address']),
				'phone'     => $this->db->escape($this->request->post['phone']),
				'email'     => $this->db->escape($this->request->post['email'])
			);
						
			if (isset($this->request->post['warehouse_id'])) {
				$sql = "UPDATE ".$sql." WHERE warehouse_id = '".(int)$this->request->post['warehouse_id']."'";
				
				$this->model_sma_sma->toSmaWarehouse($sma_data, 'warehouse_edit');
			} else {
				$sql = "INSERT INTO ".$sql;
				
				$this->model_sma_sma->toSmaWarehouse($sma_data, 'warehouse_add');
			}
			
			$this->db->query($sql);
			
			if (isset($this->request->post['warehouse_id'])) {
				$warehouse_id = (int)$this->request->post['warehouse_id'];
			} else {
				$warehouse_id = $this->db->getLastId();
			}
			
			$xsql = "SELECT warehouse_id `" . DB_PREFIX . "warehouse`";
			
			if (!empty($this->request->post['default']) && $warehouse_id || $this->db->query($xsql)->num_rows == 1) {
				$this->load->model('setting/setting');
				
				$warehouse = array(
					'warehouse_default_id' => $warehouse_id
				);
				
				$this->model_setting_setting->editSetting('warehouse', $warehouse);
			}
			
			if (!empty($this->request->post['other_warehouses'])) {
				$this->db->query("DELETE FROM `" . DB_PREFIX . "warehouse_priority` WHERE warehouse_id = '".(int)$warehouse_id."'");
				
				foreach ($this->request->post['other_warehouses'] as $other_warehouse) {
					$sql = "INSERT INTO `" . DB_PREFIX . "warehouse_priority` SET
								warehouse_id = '".(int)$warehouse_id."',
								spare_id = '".(int)$other_warehouse['spare_id']."',
								priority = '".(int)$other_warehouse['priority']."'";
								
					$this->db->query($sql);
				}
			}
			
			$json['success'] = $this->language->get('success_save');
		}
		
		$this->response->setOutput(json_encode($json));
	}
	
	public function install(){
        $query = $this->db->query("SHOW TABLES LIKE '" . DB_PREFIX . "warehouse'");
        	if (!$query->num_rows) {
            	$this->db->query("
                	CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "warehouse` (
					  `warehouse_id` int(11) NOT NULL AUTO_INCREMENT,
					  `code` varchar(50) NOT NULL,
					  `name` varchar(255) NOT NULL,
					  `address` varchar(255) NOT NULL,
					  `phone` varchar(55) NOT NULL,
					  `email` varchar(55) NOT NULL,
					  `area` text NOT NULL,
					  PRIMARY KEY (`warehouse_id`),
					  INDEX `warehouse_id` (`warehouse_id`)
					) ENGINE=MyISAM DEFAULT CHARSET=utf8;
            	");
			}
			
        $query = $this->db->query("SHOW TABLES LIKE '" . DB_PREFIX . "warehouse_priority'");
        	if (!$query->num_rows) {
            	$this->db->query("
                	CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "warehouse_priority` (
					  `warehouse_id` int(11) NOT NULL,
					  `spare_id` int(11) NOT NULL,
					  `priority` int(5) NOT NULL,
					  INDEX `warehouse_id` (`warehouse_id`)
					) ENGINE=MyISAM DEFAULT CHARSET=utf8;
            	");
			}
			
        $query = $this->db->query("SHOW TABLES LIKE '" . DB_PREFIX . "product_warehouse'");
        	if (!$query->num_rows) {
            	$this->db->query("
                	CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "product_warehouse` (
					  `product_warehouse_id` int(11) NOT NULL AUTO_INCREMENT,
					  `product_id` int(11) NOT NULL,
					  `warehouse_id` int(11) NOT NULL,
					  `priority` int(5) NOT NULL,
					  `quantity` int(11) NOT NULL,
					  `rack` varchar(55) NOT NULL,
					  PRIMARY KEY (`product_warehouse_id`), 
					  INDEX `product_id` (`product_id`) 
					) ENGINE=MyISAM DEFAULT CHARSET=utf8;
            	");
			}
			
        $query = $this->db->query("SHOW TABLES LIKE '" . DB_PREFIX . "warehouse_to_order_product'");
        	if (!$query->num_rows) {
            	$this->db->query("
                	CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "warehouse_to_order_product` (
					  `id` int(11) NOT NULL AUTO_INCREMENT,
					  `order_id` int(11) NOT NULL,
					  `product_id` int(11) NOT NULL,
					  `warehouse_id` int(11) NOT NULL,
					  `warehouse_code` varchar(55) NOT NULL,
					  `quantity` int(11) NOT NULL,
					  PRIMARY KEY (`id`),
					  INDEX `product_id` (`product_id`),
					  INDEX `warehouse_id` (`warehouse_id`)
					) ENGINE=MyISAM DEFAULT CHARSET=utf8;
            	");
			}
			
        $query = $this->db->query("SHOW COLUMNS FROM `" . DB_PREFIX . "product` LIKE 'warehouse_priority'");
        	if (!$query->num_rows) {
            	$this->db->query("
                	ALTER TABLE `" . DB_PREFIX . "product`
					  ADD `warehouse_priority` tinyint(1) NOT NULL AFTER `status`;
            	");
			}
			
        $query = $this->db->query("SHOW COLUMNS FROM `" . DB_PREFIX . "product` LIKE 'warehouse_type'");
        	if (!$query->num_rows) {
            	$this->db->query("
                	ALTER TABLE `" . DB_PREFIX . "product`
					  ADD `warehouse_type` varchar(55) NOT NULL DEFAULT 'standard' AFTER `warehouse_priority`;
            	");
			}
			
        $query = $this->db->query("SHOW COLUMNS FROM `" . DB_PREFIX . "product` LIKE 'warehouse_combo'");
        	if (!$query->num_rows) {
            	$this->db->query("
                	ALTER TABLE `" . DB_PREFIX . "product`
					  ADD `warehouse_combo` text NOT NULL AFTER `warehouse_type`;
            	");
			}
	}
	
	public function uninstall(){
        $query = $this->db->query("SHOW TABLES LIKE '" . DB_PREFIX . "warehouse'");
        	if ($query->num_rows) {
            	$this->db->query("DROP TABLE `" . DB_PREFIX . "warehouse`");
			}
        $query = $this->db->query("SHOW TABLES LIKE '" . DB_PREFIX . "warehouse_priority'");
        	if ($query->num_rows) {
            	$this->db->query("DROP TABLE `" . DB_PREFIX . "warehouse_priority`");
			}
        $query = $this->db->query("SHOW TABLES LIKE '" . DB_PREFIX . "product_warehouse'");
        	if ($query->num_rows) {
            	$this->db->query("DROP TABLE `" . DB_PREFIX . "product_warehouse`");
			}
        $query = $this->db->query("SHOW TABLES LIKE '" . DB_PREFIX . "product_warehouse'");
        	if ($query->num_rows) {
            	$this->db->query("DROP TABLE `" . DB_PREFIX . "product_warehouse`");
			}
        $query = $this->db->query("SHOW COLUMNS FROM `" . DB_PREFIX . "product` LIKE 'warehouse_priority'");
        	if ($query->num_rows) {
            	$this->db->query("ALTER TABLE `" . DB_PREFIX . "product` DROP COLUMN `warehouse_priority`");
			}
        $query = $this->db->query("SHOW COLUMNS FROM `" . DB_PREFIX . "product` LIKE 'warehouse_type'");
        	if ($query->num_rows) {
            	$this->db->query("ALTER TABLE `" . DB_PREFIX . "product` DROP COLUMN `warehouse_type`");
			}
        $query = $this->db->query("SHOW COLUMNS FROM `" . DB_PREFIX . "product` LIKE 'warehouse_combo'");
        	if ($query->num_rows) {
            	$this->db->query("ALTER TABLE `" . DB_PREFIX . "product` DROP COLUMN `warehouse_combo`");
			}
	}
}