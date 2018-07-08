<?php
static $config = NULL;
static $log = NULL;

// Error Handler
function error_handler_for_export($errno, $errstr, $errfile, $errline) {
	global $config;
	global $log;
	
	switch ($errno) {
		case E_NOTICE:
		case E_USER_NOTICE:
			$errors = "Notice";
			break;
		case E_WARNING:
		case E_USER_WARNING:
			$errors = "Warning";
			break;
		case E_ERROR:
		case E_USER_ERROR:
			$errors = "Fatal Error";
			break;
		default:
			$errors = "Unknown";
			break;
	}
		
	if (($errors=='Warning') || ($errors=='Unknown')) {
		return true;
	}

	if ($config->get('config_error_display')) {
		echo '<b>' . $errors . '</b>: ' . $errstr . ' in <b>' . $errfile . '</b> on line <b>' . $errline . '</b>';
	}
	
	if ($config->get('config_error_log')) {
		$log->write('PHP ' . $errors . ':  ' . $errstr . ' in ' . $errfile . ' on line ' . $errline);
	}

	return true;
}

function fatal_error_shutdown_handler_for_export() {
	$last_error = error_get_last();
	if ($last_error['type'] === E_ERROR) {
		// fatal error
		error_handler_for_export(E_ERROR, $last_error['message'], $last_error['file'], $last_error['line']);
	}
}

class ControllerReportAdvSaleProfit extends Controller { 
	private $error = array();
	
	public function index() { 			
		$this->load->language('report/adv_sale_profit');

		$query1 = $this->db->query("SELECT * FROM " . DB_PREFIX . "extension WHERE code = 'adv_profit_module'");
		if (empty($query1->num_rows)) {	
			$this->session->data['success'] = $this->language->get('error_installed1');
			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));		
		}

		$query2 = $this->db->query("SELECT * FROM " . DB_PREFIX . "extension WHERE code = 'adv_profit_reports'");
		if (empty($query2->num_rows)) {	
			$this->session->data['success'] = $this->language->get('error_installed2');
			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));		
		}
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('report/adv_sale_profit');
		
		if (isset($this->request->post['filter_date_start'])) {
			$filter_date_start = $this->request->post['filter_date_start'];
		} else {
			$filter_date_start = '';
		}

		if (isset($this->request->post['filter_date_end'])) {
			$filter_date_end = $this->request->post['filter_date_end'];
		} else {
			$filter_date_end = '';
		}

		$data['ranges'] = array();
		
		$data['ranges'][] = array(
			'text'  => $this->language->get('stat_custom'),
			'value' => 'custom',
			'style' => 'color:#666',
		);			
		$data['ranges'][] = array(
			'text'  => $this->language->get('stat_today'),
			'value' => 'today',
			'style' => 'color:#090',
		);
		$data['ranges'][] = array(
			'text'  => $this->language->get('stat_yesterday'),
			'value' => 'yesterday',
			'style' => 'color:#090',
		);
		$data['ranges'][] = array(
			'text'  => $this->language->get('stat_week'),
			'value' => 'week',
			'style' => 'color:#090',
		);
		$data['ranges'][] = array(
			'text'  => $this->language->get('stat_month'),
			'value' => 'month',
			'style' => 'color:#090',
		);					
		$data['ranges'][] = array(
			'text'  => $this->language->get('stat_quarter'),
			'value' => 'quarter',
			'style' => 'color:#090',
		);
		$data['ranges'][] = array(
			'text'  => $this->language->get('stat_year'),
			'value' => 'year',
			'style' => 'color:#090',
		);
		$data['ranges'][] = array(
			'text'  => $this->language->get('stat_current_week'),
			'value' => 'current_week',
			'style' => 'color:#06C',
		);
		$data['ranges'][] = array(
			'text'  => $this->language->get('stat_current_month'),
			'value' => 'current_month',
			'style' => 'color:#06C',
		);	
		$data['ranges'][] = array(
			'text'  => $this->language->get('stat_current_quarter'),
			'value' => 'current_quarter',
			'style' => 'color:#06C',
		);			
		$data['ranges'][] = array(
			'text'  => $this->language->get('stat_current_year'),
			'value' => 'current_year',
			'style' => 'color:#06C',
		);			
		$data['ranges'][] = array(
			'text'  => $this->language->get('stat_last_week'),
			'value' => 'last_week',
			'style' => 'color:#F90',
		);
		$data['ranges'][] = array(
			'text'  => $this->language->get('stat_last_month'),
			'value' => 'last_month',
			'style' => 'color:#F90',
		);	
		$data['ranges'][] = array(
			'text'  => $this->language->get('stat_last_quarter'),
			'value' => 'last_quarter',
			'style' => 'color:#F90',
		);			
		$data['ranges'][] = array(
			'text'  => $this->language->get('stat_last_year'),
			'value' => 'last_year',
			'style' => 'color:#F90',
		);			
		$data['ranges'][] = array(
			'text'  => $this->language->get('stat_all_time'),
			'value' => 'all_time',
			'style' => 'color:#F00',
		);
		
		if (isset($this->request->post['filter_range'])) {
			$filter_range = $this->request->post['filter_range'];
		} else {
			$filter_range = 'current_year'; //show Current Year in Statistical Range by default
		}

		$data['report'] = array();
		
		$data['report'][] = array(
			'text'  => $this->language->get('text_sales_summary'),
			'value' => 'sales_summary',
		);			
		$data['report'][] = array(
			'text'  => $this->language->get('text_day_of_week'),
			'value' => 'day_of_week',
		);		
		$data['report'][] = array(
			'text'  => $this->language->get('text_hour'),
			'value' => 'hour',
		);	
		$data['report'][] = array(
			'text'  => $this->language->get('text_store'),
			'value' => 'store',
		);
		$data['report'][] = array(
			'text'  => $this->language->get('text_customer_group'),
			'value' => 'customer_group',
		);
		$data['report'][] = array(
			'text'  => $this->language->get('text_country'),
			'value' => 'country',
		);
		$data['report'][] = array(
			'text'  => $this->language->get('text_postcode'),
			'value' => 'postcode',
		);
		$data['report'][] = array(
			'text'  => $this->language->get('text_region_state'),
			'value' => 'region_state',
		);
		$data['report'][] = array(
			'text'  => $this->language->get('text_city'),
			'value' => 'city',
		);
		$data['report'][] = array(
			'text'  => $this->language->get('text_payment_method'),
			'value' => 'payment_method',
		);
		$data['report'][] = array(
			'text'  => $this->language->get('text_shipping_method'),
			'value' => 'shipping_method',
		);
		
		if (isset($this->request->post['filter_report'])) {
			$filter_report = $this->request->post['filter_report'];
		} else {
			$filter_report = 'sales_summary'; //show Sales Summary in Report By default
		}
		
		$data['groups'] = array();
		
		$data['groups'][] = array(
			'text'  => $this->language->get('text_year'),
			'value' => 'year',
		);

		$data['groups'][] = array(
			'text'  => $this->language->get('text_quarter'),
			'value' => 'quarter',
		);
		
		$data['groups'][] = array(
			'text'  => $this->language->get('text_month'),
			'value' => 'month',
		);
		
		$data['groups'][] = array(
			'text'  => $this->language->get('text_week'),
			'value' => 'week',
		);

		$data['groups'][] = array(
			'text'  => $this->language->get('text_day'),
			'value' => 'day',
		);
		
		$data['groups'][] = array(
			'text'  => $this->language->get('text_order'),
			'value' => 'order',
		);
		
		if (isset($this->request->post['filter_group']) && (isset($this->request->post['filter_report']) && $this->request->post['filter_report'] == 'sales_summary')) {
			$filter_group = $this->request->post['filter_group'];
		} elseif (isset($this->request->post['filter_report']) && $this->request->post['filter_report'] != 'sales_summary') {
			$filter_group = '';	
		} elseif (!isset($this->request->post['filter_group']) && (isset($this->request->post['filter_report']) && $this->request->post['filter_report'] == 'sales_summary')) {
			$filter_group = 'month'; //show Month in Group Report by default		
		} elseif (!isset($this->request->post['filter_group']) && !isset($this->request->post['filter_report'])) {
			$filter_group = 'month'; //show Month in Group Report by default
		}			

		if (isset($this->request->post['filter_sort'])) {
			$filter_sort = $this->request->post['filter_sort'];
		} else {
			$filter_sort = 'type';
		}	

		if (isset($this->request->post['filter_details'])) {
			$filter_details = $this->request->post['filter_details'];
		} else {
			$filter_details = 0;
		}	

		if (isset($this->request->post['filter_limit'])) {
			$filter_limit = $this->request->post['filter_limit'];
		} else {
			$filter_limit = 25;
		}

		if (isset($this->request->post['filter_status_date_start'])) {
			$filter_status_date_start = $this->request->post['filter_status_date_start'];
		} else {
			$filter_status_date_start = '';
		}

		if (isset($this->request->post['filter_status_date_end'])) {
			$filter_status_date_end = $this->request->post['filter_status_date_end'];
		} else {
			$filter_status_date_end = '';
		}
		
		$data['order_statuses'] = $this->model_report_adv_sale_profit->getOrderStatuses(); 			
		if (isset($this->request->post['filter_order_status_id']) && is_array($this->request->post['filter_order_status_id'])) {
			$filter_order_status_id = array_flip($this->request->post['filter_order_status_id']);
		} else {
			$filter_order_status_id = '';
		}

		if (isset($this->request->post['filter_order_id_from'])) {
			if (is_numeric(trim($this->request->post['filter_order_id_from']))) {
				$filter_order_id_from = trim($this->request->post['filter_order_id_from']);
			} else {
				$filter_order_id_from = '';
			}
		} else {
			$filter_order_id_from = '';
		}
		
		if (isset($this->request->post['filter_order_id_to'])) {
			if (is_numeric(trim($this->request->post['filter_order_id_to']))) {
				$filter_order_id_to = trim($this->request->post['filter_order_id_to']);
			} else {
				$filter_order_id_to = '';
			}
		} else {
			$filter_order_id_to = '';
		}
		
		$data['stores'] = $this->model_report_adv_sale_profit->getOrderStores();						
		if (isset($this->request->post['filter_store_id']) && is_array($this->request->post['filter_store_id'])) {
			$filter_store_id = array_flip($this->request->post['filter_store_id']);
		} else {
			$filter_store_id = '';			
		}
		
		$data['currencies'] = $this->model_report_adv_sale_profit->getOrderCurrencies();	
		if (isset($this->request->post['filter_currency']) && is_array($this->request->post['filter_currency'])) {
			$filter_currency = array_flip($this->request->post['filter_currency']);
		} else {
			$filter_currency = '';		
		}

		$data['taxes'] = $this->model_report_adv_sale_profit->getOrderTaxes();					
		if (isset($this->request->post['filter_taxes']) && is_array($this->request->post['filter_taxes'])) {
			$filter_taxes = array_flip($this->request->post['filter_taxes']);
		} else {
			$filter_taxes = '';		
		}

		$data['tax_classes'] = $this->model_report_adv_sale_profit->getOrderTaxClasses();					
		if (isset($this->request->post['filter_tax_classes']) && is_array($this->request->post['filter_tax_classes'])) {
			$filter_tax_classes = array_flip($this->request->post['filter_tax_classes']);
		} else {
			$filter_tax_classes = '';		
		}
		
		$data['geo_zones'] = $this->model_report_adv_sale_profit->getOrderGeoZones();					
		if (isset($this->request->post['filter_geo_zones']) && is_array($this->request->post['filter_geo_zones'])) {
			$filter_geo_zones = array_flip($this->request->post['filter_geo_zones']);
		} else {
			$filter_geo_zones = '';		
		}
		
		$data['customer_groups'] = $this->model_report_adv_sale_profit->getOrderCustomerGroups();		
		if (isset($this->request->post['filter_customer_group_id']) && is_array($this->request->post['filter_customer_group_id'])) {
			$filter_customer_group_id = array_flip($this->request->post['filter_customer_group_id']);
		} else {
			$filter_customer_group_id = '';
		}
		
		if (isset($this->request->post['filter_customer_name'])) {
			$filter_customer_name = $this->request->post['filter_customer_name'];
		} else {
			$filter_customer_name = '';
		}

		if (isset($this->request->post['filter_customer_email'])) {
			$filter_customer_email = $this->request->post['filter_customer_email'];
		} else {
			$filter_customer_email = '';
		}

		if (isset($this->request->post['filter_customer_telephone'])) {
			$filter_customer_telephone = $this->request->post['filter_customer_telephone'];
		} else {
			$filter_customer_telephone = '';
		}

		if (isset($this->request->post['filter_ip'])) {
			$filter_ip = $this->request->post['filter_ip'];
		} else {
			$filter_ip = '';
		}
		
		if (isset($this->request->post['filter_payment_company'])) {
			$filter_payment_company = $this->request->post['filter_payment_company'];
		} else {
			$filter_payment_company = '';
		}
		
		if (isset($this->request->post['filter_payment_address'])) {
			$filter_payment_address = $this->request->post['filter_payment_address'];
		} else {
			$filter_payment_address = '';
		}

		if (isset($this->request->post['filter_payment_city'])) {
			$filter_payment_city = $this->request->post['filter_payment_city'];
		} else {
			$filter_payment_city = '';
		}
		
		if (isset($this->request->post['filter_payment_zone'])) {
			$filter_payment_zone = $this->request->post['filter_payment_zone'];
		} else {
			$filter_payment_zone = '';
		}
		
		if (isset($this->request->post['filter_payment_postcode'])) {
			$filter_payment_postcode = $this->request->post['filter_payment_postcode'];
		} else {
			$filter_payment_postcode = '';
		}

		if (isset($this->request->post['filter_payment_country'])) {
			$filter_payment_country = $this->request->post['filter_payment_country'];
		} else {
			$filter_payment_country = '';
		}

		$data['payment_methods'] = $this->model_report_adv_sale_profit->getOrderPaymentMethods();	
		if (isset($this->request->post['filter_payment_method']) && is_array($this->request->post['filter_payment_method'])) {
			$filter_payment_method = array_flip($this->request->post['filter_payment_method']);
		} else {
			$filter_payment_method = '';		
		}
		
		if (isset($this->request->post['filter_shipping_company'])) {
			$filter_shipping_company = $this->request->post['filter_shipping_company'];
		} else {
			$filter_shipping_company = '';
		}
		
		if (isset($this->request->post['filter_shipping_address'])) {
			$filter_shipping_address = $this->request->post['filter_shipping_address'];
		} else {
			$filter_shipping_address = '';
		}

		if (isset($this->request->post['filter_shipping_city'])) {
			$filter_shipping_city = $this->request->post['filter_shipping_city'];
		} else {
			$filter_shipping_city = '';
		}
		
		if (isset($this->request->post['filter_shipping_zone'])) {
			$filter_shipping_zone = $this->request->post['filter_shipping_zone'];
		} else {
			$filter_shipping_zone = '';
		}
		
		if (isset($this->request->post['filter_shipping_postcode'])) {
			$filter_shipping_postcode = $this->request->post['filter_shipping_postcode'];
		} else {
			$filter_shipping_postcode = '';
		}

		if (isset($this->request->post['filter_shipping_country'])) {
			$filter_shipping_country = $this->request->post['filter_shipping_country'];
		} else {
			$filter_shipping_country = '';
		}

		$data['shipping_methods'] = $this->model_report_adv_sale_profit->getOrderShippingMethods();			
		if (isset($this->request->post['filter_shipping_method']) && is_array($this->request->post['filter_shipping_method'])) {
			$filter_shipping_method = array_flip($this->request->post['filter_shipping_method']);
		} else {
			$filter_shipping_method = '';		
		}
		
		$data['categories'] = $this->model_report_adv_sale_profit->getProductsCategories(0);	
		if (isset($this->request->post['filter_category']) && is_array($this->request->post['filter_category'])) {
			$filter_category = array_flip($this->request->post['filter_category']);
		} else {
			$filter_category = '';
		}
		
		$data['manufacturers'] = $this->model_report_adv_sale_profit->getProductsManufacturers(); 
		if (isset($this->request->post['filter_manufacturer']) && is_array($this->request->post['filter_manufacturer'])) {
			$filter_manufacturer = array_flip($this->request->post['filter_manufacturer']);
		} else {
			$filter_manufacturer = '';
		}
		
		if (isset($this->request->post['filter_sku'])) {
			$filter_sku = $this->request->post['filter_sku'];
		} else {
			$filter_sku = '';
		}

		if (isset($this->request->post['filter_product_id'])) {
			$filter_product_id = $this->request->post['filter_product_id'];
		} else {
			$filter_product_id = '';
		}
		
		if (isset($this->request->post['filter_model'])) {
			$filter_model = $this->request->post['filter_model'];
		} else {
			$filter_model = '';
		}

		$data['order_options'] = $this->model_report_adv_sale_profit->getOrderOptions();
		if (isset($this->request->post['filter_option']) && is_array($this->request->post['filter_option'])) {
			$filter_option = array_flip($this->request->post['filter_option']);
		} else {
			$filter_option = '';
		}

		$data['attributes'] = $this->model_report_adv_sale_profit->getProductAttributes();
		if (isset($this->request->post['filter_attribute']) && is_array($this->request->post['filter_attribute'])) {
			$filter_attribute = array_flip($this->request->post['filter_attribute']);
		} else {
			$filter_attribute = '';
		}
		
		$data['locations'] = $this->model_report_adv_sale_profit->getProductLocations();			
		if (isset($this->request->post['filter_location']) && is_array($this->request->post['filter_location'])) {
			$filter_location = array_flip($this->request->post['filter_location']);
		} else {
			$filter_location = '';		
		}
		
		$data['affiliate_names'] = $this->model_report_adv_sale_profit->getOrderAffiliates();
		if (isset($this->request->post['filter_affiliate_name']) && is_array($this->request->post['filter_affiliate_name'])) {
			$filter_affiliate_name = array_flip($this->request->post['filter_affiliate_name']);
		} else {
			$filter_affiliate_name = '';
		}

		$data['affiliate_emails'] = $this->model_report_adv_sale_profit->getOrderAffiliates();
		if (isset($this->request->post['filter_affiliate_email']) && is_array($this->request->post['filter_affiliate_email'])) {
			$filter_affiliate_email = array_flip($this->request->post['filter_affiliate_email']);
		} else {
			$filter_affiliate_email = '';
		}

		$data['coupon_names'] = $this->model_report_adv_sale_profit->getOrderCouponNames();
		if (isset($this->request->post['filter_coupon_name']) && is_array($this->request->post['filter_coupon_name'])) {
			$filter_coupon_name = array_flip($this->request->post['filter_coupon_name']);
		} else {
			$filter_coupon_name = '';
		}

		if (isset($this->request->post['filter_coupon_code'])) {
			$filter_coupon_code = $this->request->post['filter_coupon_code'];
		} else {
			$filter_coupon_code = '';
		}

		if (isset($this->request->post['filter_voucher_code'])) {
			$filter_voucher_code = $this->request->post['filter_voucher_code'];
		} else {
			$filter_voucher_code = '';
		}
		
   		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('report/adv_sale_profit', 'token=' . $this->session->data['token'], 'SSL')
   		);

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "extension WHERE `type` = 'module' AND `code` = 'adv_profit_module'");
			if (!$query->rows) {
				$data['settings'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
			} else {	
				$data['settings'] = $this->url->link('module/adv_profit_module', 'token=' . $this->session->data['token'], 'SSL');
			}	
		
		if (isset($this->request->post['adv_profit_reports_formula_sop1']) && $this->request->post['adv_profit_reports_formula_sop1'] == 1) { 
			if ($this->config->get('adv_profit_reports_formula_sop1') == 0) { 
				$this->db->query("DELETE FROM " . DB_PREFIX . "setting WHERE store_id = '0' AND `code` = 'adv' AND `key` = 'adv_profit_reports_formula_sop1'");	
				$this->db->query("INSERT INTO " . DB_PREFIX . "setting SET store_id = '0', `code` = 'adv', `key` = 'adv_profit_reports_formula_sop1', `value` = '1'");
			}		
		} elseif (isset($this->request->post['adv_profit_reports_formula_sop1']) && $this->request->post['adv_profit_reports_formula_sop1'] == 0) { 
			if ($this->config->get('adv_profit_reports_formula_sop1') == 1) { 
				$this->db->query("DELETE FROM " . DB_PREFIX . "setting WHERE store_id = '0' AND `code` = 'adv' AND `key` = 'adv_profit_reports_formula_sop1'");	
				$this->db->query("INSERT INTO " . DB_PREFIX . "setting SET store_id = '0', `code` = 'adv', `key` = 'adv_profit_reports_formula_sop1', `value` = '0'");
			}			
		}
		
		if (isset($this->request->post['adv_profit_reports_formula_sop2']) && $this->request->post['adv_profit_reports_formula_sop2'] == 1) { 
			if ($this->config->get('adv_profit_reports_formula_sop2') == 0) { 
				$this->db->query("DELETE FROM " . DB_PREFIX . "setting WHERE store_id = '0' AND `code` = 'adv' AND `key` = 'adv_profit_reports_formula_sop2'");	
				$this->db->query("INSERT INTO " . DB_PREFIX . "setting SET store_id = '0', `code` = 'adv', `key` = 'adv_profit_reports_formula_sop2', `value` = '1'");
			}		
		} elseif (isset($this->request->post['adv_profit_reports_formula_sop2']) && $this->request->post['adv_profit_reports_formula_sop2'] == 0) { 
			if ($this->config->get('adv_profit_reports_formula_sop2') == 1) { 
				$this->db->query("DELETE FROM " . DB_PREFIX . "setting WHERE store_id = '0' AND `code` = 'adv' AND `key` = 'adv_profit_reports_formula_sop2'");	
				$this->db->query("INSERT INTO " . DB_PREFIX . "setting SET store_id = '0', `code` = 'adv', `key` = 'adv_profit_reports_formula_sop2', `value` = '0'");
			}			
		}
		
		if (isset($this->request->post['adv_profit_reports_formula_sop3']) && $this->request->post['adv_profit_reports_formula_sop3'] == 1) { 
			if ($this->config->get('adv_profit_reports_formula_sop3') == 0) { 
				$this->db->query("DELETE FROM " . DB_PREFIX . "setting WHERE store_id = '0' AND `code` = 'adv' AND `key` = 'adv_profit_reports_formula_sop3'");	
				$this->db->query("INSERT INTO " . DB_PREFIX . "setting SET store_id = '0', `code` = 'adv', `key` = 'adv_profit_reports_formula_sop3', `value` = '1'");
			}		
		} elseif (isset($this->request->post['adv_profit_reports_formula_sop3']) && $this->request->post['adv_profit_reports_formula_sop3'] == 0) { 
			if ($this->config->get('adv_profit_reports_formula_sop3') == 1) { 
				$this->db->query("DELETE FROM " . DB_PREFIX . "setting WHERE store_id = '0' AND `code` = 'adv' AND `key` = 'adv_profit_reports_formula_sop3'");	
				$this->db->query("INSERT INTO " . DB_PREFIX . "setting SET store_id = '0', `code` = 'adv', `key` = 'adv_profit_reports_formula_sop3', `value` = '0'");
			}			
		}

		if (isset($this->request->post['adv_profit_reports_formula_sop1'])) {
			$data['adv_profit_reports_formula_sop1'] = $this->request->post['adv_profit_reports_formula_sop1'];
		} else {
			$data['adv_profit_reports_formula_sop1'] = $this->config->get('adv_profit_reports_formula_sop1');
		}

		if (isset($this->request->post['adv_profit_reports_formula_sop2'])) {
			$data['adv_profit_reports_formula_sop2'] = $this->request->post['adv_profit_reports_formula_sop2'];
		} else {
			$data['adv_profit_reports_formula_sop2'] = $this->config->get('adv_profit_reports_formula_sop2');
		}
		
		if (isset($this->request->post['adv_profit_reports_formula_sop3'])) {
			$data['adv_profit_reports_formula_sop3'] = $this->request->post['adv_profit_reports_formula_sop3'];
		} else {
			$data['adv_profit_reports_formula_sop3'] = $this->config->get('adv_profit_reports_formula_sop3');
		}
		
		$data['orders'] = array();
		
		$filter_data = array(
			'filter_date_start'	     		=> $filter_date_start, 
			'filter_date_end'	     		=> $filter_date_end,
			'filter_range'           		=> $filter_range,
			'filter_report'           		=> $filter_report,
			'filter_group'           		=> $filter_group,
			'filter_status_date_start'		=> $filter_status_date_start, 
			'filter_status_date_end'		=> $filter_status_date_end, 			
			'filter_order_status_id'		=> $filter_order_status_id,
			'filter_order_id_from'			=> $filter_order_id_from,
			'filter_order_id_to'			=> $filter_order_id_to,			
			'filter_store_id'				=> $filter_store_id,
			'filter_currency'				=> $filter_currency,
			'filter_taxes'					=> $filter_taxes,
			'filter_tax_classes'			=> $filter_tax_classes,
			'filter_geo_zones'				=> $filter_geo_zones,			
			'filter_customer_group_id'		=> $filter_customer_group_id,
			'filter_customer_name'	 	 	=> $filter_customer_name,			
			'filter_customer_email'			=> $filter_customer_email,
			'filter_customer_telephone'		=> $filter_customer_telephone,
			'filter_ip' 	 				=> $filter_ip,			
			'filter_payment_company'		=> $filter_payment_company,
			'filter_payment_address'		=> $filter_payment_address,
			'filter_payment_city'			=> $filter_payment_city,
			'filter_payment_zone'			=> $filter_payment_zone,			
			'filter_payment_postcode'		=> $filter_payment_postcode,
			'filter_payment_country'		=> $filter_payment_country,
			'filter_payment_method'  		=> $filter_payment_method,
			'filter_shipping_company'		=> $filter_shipping_company,
			'filter_shipping_address'		=> $filter_shipping_address,
			'filter_shipping_city'			=> $filter_shipping_city,
			'filter_shipping_zone'			=> $filter_shipping_zone,			
			'filter_shipping_postcode'		=> $filter_shipping_postcode,
			'filter_shipping_country'		=> $filter_shipping_country,
			'filter_shipping_method'  		=> $filter_shipping_method,
			'filter_category'				=> $filter_category,
			'filter_manufacturer'			=> $filter_manufacturer,
			'filter_sku' 	 				=> $filter_sku,
			'filter_product_id'				=> $filter_product_id,
			'filter_model' 	 				=> $filter_model,
			'filter_option'  				=> $filter_option,
			'filter_attribute' 	 		 	=> $filter_attribute,
			'filter_location'  				=> $filter_location,
			'filter_affiliate_name'			=> $filter_affiliate_name,
			'filter_affiliate_email'		=> $filter_affiliate_email,
			'filter_coupon_name'			=> $filter_coupon_name,
			'filter_coupon_code'			=> $filter_coupon_code,
			'filter_voucher_code'			=> $filter_voucher_code,			
			'filter_sort'  					=> $filter_sort,
			'filter_details'  				=> $filter_details,
			'filter_limit'  				=> $filter_limit
		);

		if ($filter_details != 4) {
		$results = $this->model_report_adv_sale_profit->getSaleProfit($filter_data);
			
		foreach ($results as $result) {
			$total_sales = $result['sub_total']+$result['handling']+$result['low_order_fee']+$result['reward']+$result['coupon']+$result['credit']+$result['voucher']+($data['adv_profit_reports_formula_sop1'] ? $result['shipping'] : 0);
			$total_costs = $result['prod_costs']+$result['commission']+($data['adv_profit_reports_formula_sop3'] ? $result['payment_cost'] : 0)+($data['adv_profit_reports_formula_sop2'] ? $result['shipping_cost'] : 0);
			$total_sales_total = $result['sub_total_total']+$result['handling_total']+$result['low_order_fee_total']+$result['reward_total']+$result['coupon_total']+$result['credit_total']+$result['voucher_total']+($data['adv_profit_reports_formula_sop1'] ? $result['shipping_total'] : 0);
			$total_costs_total = $result['prod_costs_total']+$result['commission_total']+($data['adv_profit_reports_formula_sop3'] ? $result['pay_costs_total'] : 0)+($data['adv_profit_reports_formula_sop2'] ? $result['ship_costs_total'] : 0);

			if ($result['prod_costs']) {
				$profit_margin_percent = ($total_costs) > 0 ? round(100 * (($total_sales-$total_costs) / $total_sales), 2) . '%' : '100%';
				$profit_margin_total_percent = ($total_costs_total) > 0 ? round(100 * (($total_sales_total-$total_costs_total) / $total_sales_total), 2) . '%' : '100%';						
			} else {
				$profit_margin_percent = '100%';
				$profit_margin_total_percent = '100%';				
			}
			
			$data['orders'][] = array(
				'year'		       				=> $result['year'],
				'quarter'		       			=> 'Q' . $result['quarter'],	
				'year_quarter'		       		=> 'Q' . $result['quarter']. ' ' . $result['year'],
				'month'		       				=> $result['month'],
				'year_month'		       		=> substr($result['month'],0,3) . ' ' . $result['year'],			
				'date_start' 					=> date($this->language->get('date_format_short'), strtotime($result['date_start'])),
				'date_end'   					=> date($this->language->get('date_format_short'), strtotime($result['date_end'])),	
				'day_of_week'   				=> $result['day_of_week'],
				'hour'   						=> number_format($result['hour'], 2, ':', ''),
				'store_name'   					=> html_entity_decode($result['store_name']),
				'customer_group'   				=> html_entity_decode($result['customer_group']),
				'payment_country'   			=> $result['payment_country'],
				'payment_postcode'   			=> $result['payment_postcode'],
				'payment_zone'   				=> $result['payment_zone']. ', ' . $result['payment_country'],
				'payment_city'   				=> $result['payment_city']. ', ' . $result['payment_country'],
				'payment_method'   				=> preg_replace('~\(.*?\)~', '', $result['payment_method']),
				'shipping_method'   			=> preg_replace('~\(.*?\)~', '', $result['shipping_method']),
				'order_id'   					=> $result['order_id'],	
				'orders'     					=> $result['orders'],
				'customers'   					=> $result['customers'],				
				'products'   					=> $result['products'],	
				'sub_total'        				=> $this->currency->format($result['sub_total'], $this->config->get('config_currency')),	
				'handling'        				=> $this->currency->format($result['handling'], $this->config->get('config_currency')),
				'low_order_fee'        			=> $this->currency->format($result['low_order_fee'], $this->config->get('config_currency')),
				'shipping'        				=> $this->currency->format($result['shipping'], $this->config->get('config_currency')),				
				'reward'      					=> $this->currency->format($result['reward'], $this->config->get('config_currency')),
				'coupon'      					=> $this->currency->format($result['coupon'], $this->config->get('config_currency')),
				'tax'        					=> $this->currency->format($result['tax'], $this->config->get('config_currency')),
				'credit'      					=> $this->currency->format($result['credit'], $this->config->get('config_currency')),
				'voucher'        				=> $this->currency->format($result['voucher'], $this->config->get('config_currency')),			
				'total'      					=> $this->currency->format($result['total'], $this->config->get('config_currency')),
				'total_sales'      				=> $this->currency->format($total_sales, $this->config->get('config_currency')),
				'prod_costs'      				=> $this->currency->format('-' . ($result['prod_costs']), $this->config->get('config_currency')),
				'commission'      				=> $this->currency->format('-' . ($result['commission']), $this->config->get('config_currency')),	
				'pay_costs'      				=> $this->currency->format('-' . ($result['payment_cost']), $this->config->get('config_currency')),
				'ship_costs'      				=> $this->currency->format('-' . ($result['shipping_cost']), $this->config->get('config_currency')),
				'ship_balance'      			=> $this->currency->format($result['shipping']-$result['shipping_cost'], $this->config->get('config_currency')),
				'total_costs'      				=> $this->currency->format('-' . ($total_costs), $this->config->get('config_currency')),
				'netprofit'      				=> $this->currency->format(($total_sales-$total_costs), $this->config->get('config_currency')),
				'netprofit_raw'      			=> $total_sales-$total_costs,
				'profit_margin_percent' 		=> $profit_margin_percent,
				'gsales'      					=> round($total_sales, 2),
				'gcosts'      					=> round($total_costs, 2),
				'gnetprofit'      				=> round($total_sales-$total_costs, 2),
				'order_ord_id'     				=> $filter_details == 1 ? $result['order_ord_id'] : '',
				'order_ord_idc'     			=> $filter_details == 1 ? $result['order_ord_idc'] : '',					
				'order_order_date'    			=> $filter_details == 1 ? $result['order_order_date'] : '',
				'order_inv_no'     				=> $filter_details == 1 ? $result['order_inv_no'] : '',
				'order_name'   					=> $filter_details == 1 ? $result['order_name'] : '',
				'order_email'   				=> $filter_details == 1 ? $result['order_email'] : '',
				'order_group'   				=> $filter_details == 1 ? $result['order_group'] : '',
				'order_shipping_method' 		=> $filter_details == 1 ? strip_tags($result['order_shipping_method'], '<br>') : '',
				'order_payment_method'  		=> $filter_details == 1 ? strip_tags($result['order_payment_method'], '<br>') : '',
				'order_status'  				=> $filter_details == 1 ? $result['order_status'] : '',
				'order_store'      				=> $filter_details == 1 ? $result['order_store'] : '',	
				'order_currency' 				=> $filter_details == 1 ? $result['order_currency'] : '',				
				'order_products' 				=> $filter_details == 1 ? $result['order_products'] : '',
				'order_sub_total'  				=> $filter_details == 1 ? $result['order_sub_total'] : '',				
				'order_shipping'  				=> $filter_details == 1 ? $result['order_shipping'] : '',
				'order_tax'  					=> $filter_details == 1 ? $result['order_tax'] : '',					
				'order_value'  					=> $filter_details == 1 ? $result['order_value'] : '',
				'order_sales'   				=> $filter_details == 1 ? $result['order_sales'] : '',
				'order_costs'   				=> $filter_details == 1 ? $result['order_costs'] : '',				
				'order_profit'   				=> $filter_details == 1 ? $result['order_profit'] : '',	
				'order_profit_margin_percent' 	=> $filter_details == 1 ? $result['order_profit_margin_percent'] : '',				
				'product_ord_id'  				=> $filter_details == 2 ? $result['product_ord_id'] : '',
				'product_ord_idc'  				=> $filter_details == 2 ? $result['product_ord_idc'] : '',
				'product_order_date'    		=> $filter_details == 2 ? $result['product_order_date'] : '',
				'product_inv_no'     			=> $filter_details == 2 ? $result['product_inv_no'] : '',					
				'product_pid'  					=> $filter_details == 2 ? $result['product_pid'] : '',	
				'product_pidc'  				=> $filter_details == 2 ? $result['product_pidc'] : '',	
				'product_sku'  					=> $filter_details == 2 ? $result['product_sku'] : '',
				'product_model'  				=> $filter_details == 2 ? $result['product_model'] : '',				
				'product_name'  				=> $filter_details == 2 ? $result['product_name'] : '',	
				'product_option'  				=> $filter_details == 2 ? $result['product_option'] : '',					
				'product_attributes'  			=> $filter_details == 2 ? $result['product_attributes'] : '',
				'product_manu'  				=> $filter_details == 2 ? $result['product_manu'] : '',
				'product_category'  			=> $filter_details == 2 ? $result['product_category'] : '',				
				'product_currency'  			=> $filter_details == 2 ? $result['product_currency'] : '',
				'product_price'  				=> $filter_details == 2 ? $result['product_price'] : '',
				'product_quantity'  			=> $filter_details == 2 ? $result['product_quantity'] : '',
				'product_total_excl_vat'  		=> $filter_details == 2 ? $result['product_total_excl_vat'] : '',				
				'product_tax'  					=> $filter_details == 2 ? $result['product_tax'] : '',
				'product_total_incl_vat'  		=> $filter_details == 2 ? $result['product_total_incl_vat'] : '',				
				'product_sales'  				=> $filter_details == 2 ? $result['product_sales'] : '',
				'product_costs'   				=> $filter_details == 2 ? $result['product_costs'] : '',			
				'product_profit'   				=> $filter_details == 2 ? $result['product_profit'] : '',
				'product_profit_margin_percent' => $filter_details == 2 ? $result['product_profit_margin_percent'] : '',
				'customer_ord_id' 				=> $filter_details == 3 ? $result['customer_ord_id'] : '',	
				'customer_order_date' 			=> $filter_details == 3 ? $result['customer_order_date'] : '',
				'customer_inv_no' 				=> $filter_details == 3 ? $result['customer_inv_no'] : '',
				'customer_cust_id' 				=> $filter_details == 3 ? $result['customer_cust_id'] : '',	
				'customer_cust_idc' 			=> $filter_details == 3 ? $result['customer_cust_idc'] : '',	
				'billing_name' 					=> $filter_details == 3 ? $result['billing_name'] : '',
				'billing_company' 				=> $filter_details == 3 ? $result['billing_company'] : '',
				'billing_address_1' 			=> $filter_details == 3 ? $result['billing_address_1'] : '',
				'billing_address_2' 			=> $filter_details == 3 ? $result['billing_address_2'] : '',
				'billing_city' 					=> $filter_details == 3 ? $result['billing_city'] : '',
				'billing_zone' 					=> $filter_details == 3 ? $result['billing_zone'] : '',
				'billing_postcode' 				=> $filter_details == 3 ? $result['billing_postcode'] : '',	
				'billing_country' 				=> $filter_details == 3 ? $result['billing_country'] : '',
				'customer_telephone' 			=> $filter_details == 3 ? $result['customer_telephone'] : '',
				'shipping_name' 				=> $filter_details == 3 ? $result['shipping_name'] : '',
				'shipping_company' 				=> $filter_details == 3 ? $result['shipping_company'] : '',
				'shipping_address_1' 			=> $filter_details == 3 ? $result['shipping_address_1'] : '',
				'shipping_address_2' 			=> $filter_details == 3 ? $result['shipping_address_2'] : '',
				'shipping_city' 				=> $filter_details == 3 ? $result['shipping_city'] : '',
				'shipping_zone' 				=> $filter_details == 3 ? $result['shipping_zone'] : '',
				'shipping_postcode' 			=> $filter_details == 3 ? $result['shipping_postcode'] : '',	
				'shipping_country' 				=> $filter_details == 3 ? $result['shipping_country'] : '',				
				'orders_total'      			=> $result['orders_total'],	
				'customers_total'      			=> $result['customers_total'],
				'products_total'      			=> $result['products_total'],				
				'sub_total_total'      			=> $this->currency->format($result['sub_total_total'], $this->config->get('config_currency')),
				'handling_total'      			=> $this->currency->format($result['handling_total'], $this->config->get('config_currency')),
				'low_order_fee_total'      		=> $this->currency->format($result['low_order_fee_total'], $this->config->get('config_currency')),
				'reward_total'      			=> $this->currency->format($result['reward_total'], $this->config->get('config_currency')),
				'shipping_total'      			=> $this->currency->format($result['shipping_total'], $this->config->get('config_currency')),
				'coupon_total'      			=> $this->currency->format($result['coupon_total'], $this->config->get('config_currency')),
				'tax_total'      				=> $this->currency->format($result['tax_total'], $this->config->get('config_currency')),
				'credit_total'      			=> $this->currency->format($result['credit_total'], $this->config->get('config_currency')),
				'voucher_total'      			=> $this->currency->format($result['voucher_total'], $this->config->get('config_currency')),
				'total_total'      				=> $this->currency->format($result['total_total'], $this->config->get('config_currency')),
				'total_sales_total'      		=> $this->currency->format($total_sales_total, $this->config->get('config_currency')),
				'prod_costs_total'      		=> $this->currency->format('-' . ($result['prod_costs_total']), $this->config->get('config_currency')),
				'commission_total'      		=> $this->currency->format('-' . ($result['commission_total']), $this->config->get('config_currency')),	
				'pay_costs_total'      			=> $this->currency->format('-' . ($result['pay_costs_total']), $this->config->get('config_currency')),
				'ship_costs_total'      		=> $this->currency->format('-' . ($result['ship_costs_total']), $this->config->get('config_currency')),
				'ship_balance_total'      		=> $this->currency->format($result['shipping_total']-$result['ship_costs_total'], $this->config->get('config_currency')),
				'total_costs_total'      		=> $this->currency->format('-' . ($total_costs_total), $this->config->get('config_currency')),
				'netprofit_total'      			=> $this->currency->format(($total_sales_total-$total_costs_total), $this->config->get('config_currency')),
				'netprofit_total_raw'      		=> $total_sales_total-$total_costs_total,
				'profit_margin_total_percent' 	=> $profit_margin_total_percent				
			);
		}

		} elseif ($filter_details == 4) {
			$this->load->model('report/adv_sale_profit_export_all');
			$results = $this->model_report_adv_sale_profit_export_all->getSaleProfitExportAll($filter_data);
			
		foreach ($results as $result) {
			
			$data['orders'][] = array(
				'order_id'   					=> $result['order_id'],	
				'order_ord_id'     				=> $result['order_ord_id'],
				'order_ord_idc'     			=> $result['order_ord_idc'],					
				'order_order_date'    			=> $result['order_order_date'],
				'order_inv_no'     				=> $result['order_inv_no'],
				'order_name'   					=> $result['order_name'],
				'order_email'   				=> $result['order_email'],
				'order_group'   				=> $result['order_group'],
				'order_shipping_method' 		=> strip_tags($result['order_shipping_method'], '<br>'),
				'order_payment_method'  		=> strip_tags($result['order_payment_method'], '<br>'),
				'order_status'  				=> $result['order_status'],
				'order_store'      				=> $result['order_store'],	
				'order_currency' 				=> $result['order_currency'],				
				'order_products' 				=> $result['order_products'],
				'order_sub_total'  				=> $result['order_sub_total'],				
				'order_shipping'  				=> $result['order_shipping'],
				'order_tax'  					=> $result['order_tax'],					
				'order_value'  					=> $result['order_value'],
				'order_sales'   				=> $result['order_sales'],
				'order_costs'   				=> $result['order_costs'],				
				'order_profit'   				=> $result['order_profit'],	
				'order_profit_margin_percent' 	=> $result['order_profit_margin_percent'],			
				'product_pid'  					=> $result['product_pid'],	
				'product_pidc'  				=> $result['product_pidc'],	
				'product_sku'  					=> $result['product_sku'],
				'product_model'  				=> $result['product_model'],				
				'product_name'  				=> $result['product_name'],	
				'product_option'  				=> $result['product_option'],					
				'product_attributes'  			=> $result['product_attributes'],
				'product_manu'  				=> $result['product_manu'],
				'product_category'  			=> $result['product_category'],
				'product_price'  				=> $result['product_price'],
				'product_quantity'  			=> $result['product_quantity'],
				'product_total_excl_vat'  		=> $result['product_total_excl_vat'],				
				'product_tax'  					=> $result['product_tax'],
				'product_total_incl_vat'  		=> $result['product_total_incl_vat'],
				'product_sales'  				=> $result['product_sales'],				
				'product_costs'   				=> $result['product_costs'],			
				'product_profit'   				=> $result['product_profit'],
				'product_profit_margin_percent' => $result['product_profit_margin_percent'],
				'customer_cust_id' 				=> $result['customer_cust_id'],	
				'customer_cust_idc' 			=> $result['customer_cust_idc'],	
				'billing_name' 					=> $result['billing_name'],
				'billing_company' 				=> $result['billing_company'],
				'billing_address_1' 			=> $result['billing_address_1'],
				'billing_address_2' 			=> $result['billing_address_2'],
				'billing_city' 					=> $result['billing_city'],
				'billing_zone' 					=> $result['billing_zone'],
				'billing_postcode' 				=> $result['billing_postcode'],	
				'billing_country' 				=> $result['billing_country'],
				'customer_telephone' 			=> $result['customer_telephone'],
				'shipping_name' 				=> $result['shipping_name'],
				'shipping_company' 				=> $result['shipping_company'],
				'shipping_address_1' 			=> $result['shipping_address_1'],
				'shipping_address_2' 			=> $result['shipping_address_2'],
				'shipping_city' 				=> $result['shipping_city'],
				'shipping_zone' 				=> $result['shipping_zone'],
				'shipping_postcode' 			=> $result['shipping_postcode'],	
				'shipping_country' 				=> $result['shipping_country']		
			);
		}
		
		}
		
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_no_details'] = $this->language->get('text_no_details');
		$data['text_order_list'] = $this->language->get('text_order_list');
		$data['text_product_list'] = $this->language->get('text_product_list');
		$data['text_customer_list'] = $this->language->get('text_customer_list');	
		$data['text_all_details'] = $this->language->get('text_all_details');			
		$data['text_no_results'] = $this->language->get('text_no_results');	
		$data['text_all'] = $this->language->get('text_all');
		$data['text_all_status'] = $this->language->get('text_all_status');		
		$data['text_all_stores'] = $this->language->get('text_all_stores');
		$data['text_all_currencies'] = $this->language->get('text_all_currencies');
		$data['text_all_taxes'] = $this->language->get('text_all_taxes');	
		$data['text_all_tax_classes'] = $this->language->get('text_all_tax_classes');			
		$data['text_all_zones'] = $this->language->get('text_all_zones');			
		$data['text_all_groups'] = $this->language->get('text_all_groups');
		$data['text_all_payment_methods'] = $this->language->get('text_all_payment_methods');	
		$data['text_all_shipping_methods'] = $this->language->get('text_all_shipping_methods');
		$data['text_all_categories'] = $this->language->get('text_all_categories');
		$data['text_all_manufacturers'] = $this->language->get('text_all_manufacturers');		
		$data['text_all_options'] = $this->language->get('text_all_options');
		$data['text_all_attributes'] = $this->language->get('text_all_attributes');
		$data['text_all_locations'] = $this->language->get('text_all_locations');	
		$data['text_all_affiliate_names'] = $this->language->get('text_all_affiliate_names');
		$data['text_all_affiliate_emails'] = $this->language->get('text_all_affiliate_emails');
		$data['text_all_coupon_names'] = $this->language->get('text_all_coupon_names');
		$data['text_none_selected'] = $this->language->get('text_none_selected');
		$data['text_selected'] = $this->language->get('text_selected');		
		$data['text_detail'] = $this->language->get('text_detail');
		$data['text_export_no_details'] = $this->language->get('text_export_no_details');
		$data['text_export_order_list'] = $this->language->get('text_export_order_list');
		$data['text_export_product_list'] = $this->language->get('text_export_product_list');	
		$data['text_export_customer_list'] = $this->language->get('text_export_customer_list');
		$data['text_export_all_details'] = $this->language->get('text_export_all_details');				
		$data['text_filter_total'] = $this->language->get('text_filter_total');
		$data['text_profit_help'] = $this->language->get('text_profit_help');	
		$data['text_formula_setting1'] = $this->language->get('text_formula_setting1');
		$data['text_formula_setting2'] = $this->language->get('text_formula_setting2');
		$data['text_formula_setting3'] = $this->language->get('text_formula_setting3');	
		$data['text_filtering_options'] = $this->language->get('text_filtering_options');
		$data['text_column_settings'] = $this->language->get('text_column_settings');		
		$data['text_mv_columns'] = $this->language->get('text_mv_columns');		
		$data['text_ol_columns'] = $this->language->get('text_ol_columns');	
		$data['text_pl_columns'] = $this->language->get('text_pl_columns');	
		$data['text_cl_columns'] = $this->language->get('text_cl_columns');
		$data['text_all_columns'] = $this->language->get('text_all_columns');		
		$data['text_export_note'] = $this->language->get('text_export_note');
		$data['text_export_notice1'] = $this->language->get('text_export_notice1');
		$data['text_export_notice2'] = $this->language->get('text_export_notice2');		
		$data['text_export_limit'] = $this->language->get('text_export_limit');
		$data['text_pagin_page'] = $this->language->get('text_pagin_page');
		$data['text_pagin_of'] = $this->language->get('text_pagin_of');
		$data['text_pagin_results'] = $this->language->get('text_pagin_results');			
		
		$data['column_date'] = $this->language->get('column_date');
		$data['column_date_start'] = $this->language->get('column_date_start');
		$data['column_date_end'] = $this->language->get('column_date_end');
    	$data['column_orders'] = $this->language->get('column_orders');
    	$data['column_customers'] = $this->language->get('column_customers');		
		$data['column_products'] = $this->language->get('column_products');		
		$data['column_sub_total'] = $this->language->get('column_sub_total');
		$data['column_handling'] = $this->language->get('column_handling');	
		$data['column_loworder'] = $this->language->get('column_loworder');
		$data['column_shipping'] = $this->language->get('column_shipping');
		$data['column_reward'] = $this->language->get('column_reward');
		$data['column_coupon'] = $this->language->get('column_coupon');
		$data['column_coupon_code'] = $this->language->get('column_coupon_code');
		$data['column_tax'] = $this->language->get('column_tax');		
		$data['column_credit'] = $this->language->get('column_credit');	
		$data['column_voucher'] = $this->language->get('column_voucher');	
		$data['column_voucher_code'] = $this->language->get('column_voucher_code');		
		$data['column_total'] = $this->language->get('column_total');			
		$data['column_sales'] = $this->language->get('column_sales');			
		$data['column_product_costs'] = $this->language->get('column_product_costs');		
		$data['column_commission'] = $this->language->get('column_commission');	
		$data['column_payment_cost'] = $this->language->get('column_payment_cost');
		$data['column_shipping_cost'] = $this->language->get('column_shipping_cost');
		$data['column_shipping_balance'] = $this->language->get('column_shipping_balance');
		$data['column_total_costs'] = $this->language->get('column_total_costs');			
		$data['column_net_profit'] = $this->language->get('column_net_profit');
		$data['column_profit_margin'] = $this->language->get('column_profit_margin');		
		$data['column_action'] = $this->language->get('column_action');
		$data['column_order_date_added'] = $this->language->get('column_order_date_added');
		$data['column_order_order_id'] = $this->language->get('column_order_order_id');
		$data['column_order_inv_date'] = $this->language->get('column_order_inv_date');
		$data['column_order_inv_no'] = $this->language->get('column_order_inv_no');
		$data['column_order_customer_name'] = $this->language->get('column_order_customer_name');
		$data['column_order_customer'] = $this->language->get('column_order_customer');
		$data['column_order_email'] = $this->language->get('column_order_email');		
		$data['column_order_customer_group'] = $this->language->get('column_order_customer_group');		
		$data['column_order_shipping_method'] = $this->language->get('column_order_shipping_method');
		$data['column_order_payment_method'] = $this->language->get('column_order_payment_method');		
		$data['column_order_status'] = $this->language->get('column_order_status');
		$data['column_order_store'] = $this->language->get('column_order_store');
		$data['column_order_currency'] = $this->language->get('column_order_currency');		
		$data['column_order_quantity'] = $this->language->get('column_order_quantity');	
		$data['column_order_sub_total'] = $this->language->get('column_order_sub_total');	
		$data['column_order_shipping'] = $this->language->get('column_order_shipping');
		$data['column_order_tax'] = $this->language->get('column_order_tax');			
		$data['column_order_value'] = $this->language->get('column_order_value');	
		$data['column_order_sales'] = $this->language->get('column_order_sales');
		$data['column_order_prod_costs'] = $this->language->get('column_order_prod_costs');		
		$data['column_order_commission'] = $this->language->get('column_order_commission');	
		$data['column_order_payment_cost'] = $this->language->get('column_order_payment_cost');
		$data['column_order_shipping_cost'] = $this->language->get('column_order_shipping_cost');		
		$data['column_order_costs'] = $this->language->get('column_order_costs');
		$data['column_order_profit'] = $this->language->get('column_order_profit');
		$data['column_prod_order_id'] = $this->language->get('column_prod_order_id');		
		$data['column_prod_date_added'] = $this->language->get('column_prod_date_added');	
		$data['column_prod_inv_no'] = $this->language->get('column_prod_inv_no');			
		$data['column_prod_id'] = $this->language->get('column_prod_id');
		$data['column_prod_sku'] = $this->language->get('column_prod_sku');		
		$data['column_prod_model'] = $this->language->get('column_prod_model');		
		$data['column_prod_name'] = $this->language->get('column_prod_name');	
		$data['column_prod_option'] = $this->language->get('column_prod_option');	
		$data['column_prod_attributes'] = $this->language->get('column_prod_attributes');			
		$data['column_prod_manu'] = $this->language->get('column_prod_manu');
		$data['column_prod_category'] = $this->language->get('column_prod_category');		
		$data['column_prod_currency'] = $this->language->get('column_prod_currency');
		$data['column_prod_price'] = $this->language->get('column_prod_price');
		$data['column_prod_quantity'] = $this->language->get('column_prod_quantity');
		$data['column_prod_total_excl_vat'] = $this->language->get('column_prod_total_excl_vat');
		$data['column_prod_tax'] = $this->language->get('column_prod_tax');
		$data['column_prod_total_incl_vat'] = $this->language->get('column_prod_total_incl_vat');
		$data['column_prod_sales'] = $this->language->get('column_prod_sales');
		$data['column_prod_costs'] = $this->language->get('column_prod_costs');	
		$data['column_prod_profit'] = $this->language->get('column_prod_profit');	
		$data['column_customer_order_id'] = $this->language->get('column_customer_order_id');
		$data['column_customer_date_added'] = $this->language->get('column_customer_date_added');
		$data['column_customer_inv_no'] = $this->language->get('column_customer_inv_no');
		$data['column_customer_cust_id'] = $this->language->get('column_customer_cust_id');
		$data['column_billing_name'] = $this->language->get('column_billing_name');
		$data['column_billing_company'] = $this->language->get('column_billing_company');
		$data['column_billing_address_1'] = $this->language->get('column_billing_address_1');
		$data['column_billing_address_2'] = $this->language->get('column_billing_address_2');
		$data['column_billing_city'] = $this->language->get('column_billing_city');
		$data['column_billing_zone'] = $this->language->get('column_billing_zone');
		$data['column_billing_postcode'] = $this->language->get('column_billing_postcode');		
		$data['column_billing_country'] = $this->language->get('column_billing_country');
		$data['column_customer_telephone'] = $this->language->get('column_customer_telephone');
		$data['column_shipping_name'] = $this->language->get('column_shipping_name');
		$data['column_shipping_company'] = $this->language->get('column_shipping_company');
		$data['column_shipping_address_1'] = $this->language->get('column_shipping_address_1');
		$data['column_shipping_address_2'] = $this->language->get('column_shipping_address_2');
		$data['column_shipping_city'] = $this->language->get('column_shipping_city');
		$data['column_shipping_zone'] = $this->language->get('column_shipping_zone');
		$data['column_shipping_postcode'] = $this->language->get('column_shipping_postcode');		
		$data['column_shipping_country'] = $this->language->get('column_shipping_country');
		$data['column_order_comment'] = $this->language->get('column_order_comment');
		
		$data['column_year'] = $this->language->get('column_year');
		$data['column_quarter'] = $this->language->get('column_quarter');
		$data['column_month'] = $this->language->get('column_month');
		$data['column_day_of_week'] = $this->language->get('column_day_of_week');
		$data['column_hour'] = $this->language->get('column_hour');
		$data['column_store'] = $this->language->get('column_store');
		$data['column_customer_group'] = $this->language->get('column_customer_group');
		$data['column_country'] = $this->language->get('column_country');
		$data['column_postcode'] = $this->language->get('column_postcode');
		$data['column_region_state'] = $this->language->get('column_region_state');
		$data['column_city'] = $this->language->get('column_city');
		$data['column_payment_method'] = $this->language->get('column_payment_method');
		$data['column_shipping_method'] = $this->language->get('column_shipping_method');
		
		$data['column_grevenue'] = $this->language->get('column_grevenue');
		$data['column_gexpenses'] = $this->language->get('column_gexpenses');
		$data['column_gprofit'] = $this->language->get('column_gprofit');
			
		$data['entry_order_created'] = $this->language->get('entry_order_created');
		$data['entry_status_changed'] = $this->language->get('entry_status_changed');	
		$data['entry_date_start'] = $this->language->get('entry_date_start');
		$data['entry_date_end'] = $this->language->get('entry_date_end');
		$data['entry_range'] = $this->language->get('entry_range');	
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_order_id'] = $this->language->get('entry_order_id');
		$data['entry_order_id_from'] = $this->language->get('entry_order_id_from');
		$data['entry_order_id_to'] = $this->language->get('entry_order_id_to');		
		$data['entry_store'] = $this->language->get('entry_store');
		$data['entry_currency'] = $this->language->get('entry_currency');	
		$data['entry_tax'] = $this->language->get('entry_tax');
		$data['entry_tax_classes'] = $this->language->get('entry_tax_classes');		
		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');		
		$data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$data['entry_company'] = $this->language->get('entry_company');
		$data['entry_customer_name'] = $this->language->get('entry_customer_name');		
		$data['entry_customer_email'] = $this->language->get('entry_customer_email'); 
		$data['entry_customer_telephone'] = $this->language->get('entry_customer_telephone');
		$data['entry_ip'] = $this->language->get('entry_ip');
		$data['entry_payment_company'] = $this->language->get('entry_payment_company');
		$data['entry_payment_address'] = $this->language->get('entry_payment_address');
		$data['entry_payment_city'] = $this->language->get('entry_payment_city');
		$data['entry_payment_zone'] = $this->language->get('entry_payment_zone');		
		$data['entry_payment_postcode'] = $this->language->get('entry_payment_postcode');
		$data['entry_payment_country'] = $this->language->get('entry_payment_country');		
		$data['entry_payment_method'] = $this->language->get('entry_payment_method');
		$data['entry_shipping_company'] = $this->language->get('entry_shipping_company');
		$data['entry_shipping_address'] = $this->language->get('entry_shipping_address');
		$data['entry_shipping_city'] = $this->language->get('entry_shipping_city');
		$data['entry_shipping_zone'] = $this->language->get('entry_shipping_zone');		
		$data['entry_shipping_postcode'] = $this->language->get('entry_shipping_postcode');
		$data['entry_shipping_country'] = $this->language->get('entry_shipping_country');
		$data['entry_shipping_method'] = $this->language->get('entry_shipping_method');		
		$data['entry_category'] = $this->language->get('entry_category'); 
		$data['entry_manufacturer'] = $this->language->get('entry_manufacturer');
		$data['entry_sku'] = $this->language->get('entry_sku');
		$data['entry_product'] = $this->language->get('entry_product');
		$data['entry_model'] = $this->language->get('entry_model');
		$data['entry_option'] = $this->language->get('entry_option');
		$data['entry_attributes'] = $this->language->get('entry_attributes');
		$data['entry_location'] = $this->language->get('entry_location');
		$data['entry_affiliate_name'] = $this->language->get('entry_affiliate_name');
		$data['entry_affiliate_email'] = $this->language->get('entry_affiliate_email');
		$data['entry_coupon_name'] = $this->language->get('entry_coupon_name');
		$data['entry_coupon_code'] = $this->language->get('entry_coupon_code');
		$data['entry_voucher_code'] = $this->language->get('entry_voucher_code');		

		$data['entry_report'] = $this->language->get('entry_report');
		$data['entry_group'] = $this->language->get('entry_group');		
		$data['entry_sort_by'] = $this->language->get('entry_sort_by');
		$data['entry_show_details'] = $this->language->get('entry_show_details');	
		$data['entry_limit'] = $this->language->get('entry_limit');		

		$data['button_filter'] = $this->language->get('button_filter');
		$data['button_chart'] = $this->language->get('button_chart');		
		$data['button_export'] = $this->language->get('button_export');
		$data['button_settings'] = $this->language->get('button_settings');
		$data['button_documentation'] = $this->language->get('button_documentation');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_module_settings'] = $this->language->get('button_module_settings');
		
		$data['heading_title'] = $this->language->get('heading_title');
		$data['heading_version'] = $this->language->get('heading_version');		
		
		$data['token'] = $this->session->data['token'];
			
		$data['filter_date_start'] = $filter_date_start;
		$data['filter_date_end'] = $filter_date_end;
		$data['filter_range'] = $filter_range;
		$data['filter_report'] = $filter_report;
		$data['filter_group'] = $filter_group;		
		$data['filter_sort'] = $filter_sort;	
		$data['filter_details'] = $filter_details;
		$data['filter_limit'] = $filter_limit;		
		$data['filter_status_date_start'] = $filter_status_date_start;
		$data['filter_status_date_end'] = $filter_status_date_end;
		$data['filter_order_status_id'] = $filter_order_status_id;		
		$data['filter_order_id_from'] = $filter_order_id_from;
		$data['filter_order_id_to'] = $filter_order_id_to;
		$data['filter_store_id'] = $filter_store_id;
		$data['filter_currency'] = $filter_currency;
		$data['filter_taxes'] = $filter_taxes;
		$data['filter_tax_classes'] = $filter_tax_classes;		
		$data['filter_geo_zones'] = $filter_geo_zones;
		$data['filter_customer_group_id'] = $filter_customer_group_id;
		$data['filter_customer_name'] = $filter_customer_name; 
		$data['filter_customer_email'] = $filter_customer_email; 		
		$data['filter_customer_telephone'] = $filter_customer_telephone;
		$data['filter_ip'] = $filter_ip;
		$data['filter_payment_company'] = $filter_payment_company; 
		$data['filter_payment_address'] = $filter_payment_address; 
		$data['filter_payment_city'] = $filter_payment_city; 
		$data['filter_payment_postcode'] = $filter_payment_postcode; 
		$data['filter_payment_zone'] = $filter_payment_zone; 
		$data['filter_payment_country'] = $filter_payment_country; 
		$data['filter_payment_method'] = $filter_payment_method; 		
		$data['filter_shipping_company'] = $filter_shipping_company; 
		$data['filter_shipping_address'] = $filter_shipping_address; 
		$data['filter_shipping_city'] = $filter_shipping_city; 
		$data['filter_shipping_postcode'] = $filter_shipping_postcode; 
		$data['filter_shipping_zone'] = $filter_shipping_zone; 
		$data['filter_shipping_country'] = $filter_shipping_country; 
		$data['filter_shipping_method'] = $filter_shipping_method; 
		$data['filter_manufacturer'] = $filter_manufacturer; 
		$data['filter_category'] = $filter_category; 
		$data['filter_sku'] = $filter_sku; 
		$data['filter_product_id'] = $filter_product_id; 
		$data['filter_model'] = $filter_model; 
		$data['filter_option'] = $filter_option;
		$data['filter_attribute'] = $filter_attribute;
		$data['filter_location'] = $filter_location;
		$data['filter_affiliate_name'] = $filter_affiliate_name; 
		$data['filter_affiliate_email'] = $filter_affiliate_email; 
		$data['filter_coupon_name'] = $filter_coupon_name; 
		$data['filter_coupon_code'] = $filter_coupon_code; 
		$data['filter_voucher_code'] = $filter_voucher_code;		
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('report/adv_sale_profit.tpl', $data));

    	if (isset($this->request->post['export']) && $this->request->post['export'] == 1) { // export_xls
			$this->load->model('report/adv_sale_profit_export');
    		$results = $this->model_report_adv_sale_profit_export->getSaleProfitExport($filter_data);
			$cwd = getcwd();			
			chdir(DIR_SYSTEM . 'library/pear');
			require_once('Spreadsheet/Excel/Writer.php');
			chdir($cwd);			
			include(DIR_APPLICATION . 'controller/report/adv_reports/sop_export_xls.inc.php');

		} elseif (isset($this->request->post['export']) && $this->request->post['export'] == 2) { // export_xls_order_list
			$this->load->model('report/adv_sale_profit_export');
    		$results = $this->model_report_adv_sale_profit_export->getSaleProfitExport($filter_data);
			include(DIR_APPLICATION . 'controller/report/adv_reports/sop_export_xls_order_list.inc.php');
			
		} elseif (isset($this->request->post['export']) && $this->request->post['export'] == 3) { // export_xls_product_list
			$this->load->model('report/adv_sale_profit_export');
    		$results = $this->model_report_adv_sale_profit_export->getSaleProfitExport($filter_data);
			include(DIR_APPLICATION . 'controller/report/adv_reports/sop_export_xls_product_list.inc.php');

		} elseif (isset($this->request->post['export']) && $this->request->post['export'] == 4) { // export_xls_customer_list
			$this->load->model('report/adv_sale_profit_export');
    		$results = $this->model_report_adv_sale_profit_export->getSaleProfitExport($filter_data);
			include(DIR_APPLICATION . 'controller/report/adv_reports/sop_export_xls_customer_list.inc.php');
			
		} elseif (isset($this->request->post['export']) && $this->request->post['export'] == 5) { // export_xls_all_details
			$this->load->model('report/adv_sale_profit_export_all');
    		$rows = $this->model_report_adv_sale_profit_export_all->getSaleProfitExportAllExcel($filter_data);	
			$cwd = getcwd();			
			chdir(DIR_SYSTEM . 'library/pear');
			require_once('Spreadsheet/Excel/Writer.php');
			chdir($cwd);			
			include(DIR_APPLICATION . 'controller/report/adv_reports/sop_export_xls_all_details.inc.php');
				
		} elseif (isset($this->request->post['export']) && $this->request->post['export'] == 6) { // export_html
			$this->load->model('report/adv_sale_profit_export');
    		$results = $this->model_report_adv_sale_profit_export->getSaleProfitExport($filter_data);
			include(DIR_APPLICATION . 'controller/report/adv_reports/sop_export_html.inc.php');
			
		} elseif (isset($this->request->post['export']) && $this->request->post['export'] == 7) { // export_html_order_list
			$this->load->model('report/adv_sale_profit_export');
    		$results = $this->model_report_adv_sale_profit_export->getSaleProfitExport($filter_data);
			include(DIR_APPLICATION . 'controller/report/adv_reports/sop_export_html_order_list.inc.php');
				
		} elseif (isset($this->request->post['export']) && $this->request->post['export'] == 8) { // export_html_product_list
			$this->load->model('report/adv_sale_profit_export');
    		$results = $this->model_report_adv_sale_profit_export->getSaleProfitExport($filter_data);
			include(DIR_APPLICATION . 'controller/report/adv_reports/sop_export_html_product_list.inc.php');
							
		} elseif (isset($this->request->post['export']) && $this->request->post['export'] == 9) { // export_html_customer_list
			$this->load->model('report/adv_sale_profit_export');
    		$results = $this->model_report_adv_sale_profit_export->getSaleProfitExport($filter_data);
			include(DIR_APPLICATION . 'controller/report/adv_reports/sop_export_html_customer_list.inc.php');

		} elseif (isset($this->request->post['export']) && $this->request->post['export'] == 10) { // export_html_all_details
			$this->load->model('report/adv_sale_profit_export_all');
    		$results = $this->model_report_adv_sale_profit_export_all->getSaleProfitExportAll($filter_data);
			include(DIR_APPLICATION . 'controller/report/adv_reports/sop_export_html_all_details.inc.php');

		} elseif (isset($this->request->post['export']) && $this->request->post['export'] == 11) { // export_pdf
			$this->load->model('report/adv_sale_profit_export');
    		$results = $this->model_report_adv_sale_profit_export->getSaleProfitExport($filter_data);
			require_once(DIR_SYSTEM . 'library/dompdf/dompdf_config.inc.php');
			include(DIR_APPLICATION . 'controller/report/adv_reports/sop_export_pdf.inc.php');
		
		} elseif (isset($this->request->post['export']) && $this->request->post['export'] == 12) { // export_pdf_order_list
			$this->load->model('report/adv_sale_profit_export');
    		$results = $this->model_report_adv_sale_profit_export->getSaleProfitExport($filter_data);
			require_once(DIR_SYSTEM . 'library/dompdf/dompdf_config.inc.php');
			include(DIR_APPLICATION . 'controller/report/adv_reports/sop_export_pdf_order_list.inc.php');
			
		} elseif (isset($this->request->post['export']) && $this->request->post['export'] == 13) { // export_pdf_product_list
			$this->load->model('report/adv_sale_profit_export');
    		$results = $this->model_report_adv_sale_profit_export->getSaleProfitExport($filter_data);
			require_once(DIR_SYSTEM . 'library/dompdf/dompdf_config.inc.php');
			include(DIR_APPLICATION . 'controller/report/adv_reports/sop_export_pdf_product_list.inc.php');
			
		} elseif (isset($this->request->post['export']) && $this->request->post['export'] == 14) { // export_pdf_customer_list
			$this->load->model('report/adv_sale_profit_export');
    		$results = $this->model_report_adv_sale_profit_export->getSaleProfitExport($filter_data);
			require_once(DIR_SYSTEM . 'library/dompdf/dompdf_config.inc.php');
			include(DIR_APPLICATION . 'controller/report/adv_reports/sop_export_pdf_customer_list.inc.php');
			
		} elseif (isset($this->request->post['export']) && $this->request->post['export'] == 15) { // export_pdf_all_details
			$this->load->model('report/adv_sale_profit_export_all');
    		$results = $this->model_report_adv_sale_profit_export_all->getSaleProfitExportAll($filter_data);
			require_once(DIR_SYSTEM . 'library/dompdf/dompdf_config.inc.php');
			include(DIR_APPLICATION . 'controller/report/adv_reports/sop_export_pdf_all_details.inc.php');			
		
		} elseif (isset($this->request->post['export']) && $this->request->post['export'] == 16) { // export_csv
			$this->load->model('report/adv_sale_profit_export');
    		$results = $this->model_report_adv_sale_profit_export->getSaleProfitExport($filter_data);
			include(DIR_APPLICATION . 'controller/report/adv_reports/sop_export_csv.inc.php');
			
		} elseif (isset($this->request->post['export']) && $this->request->post['export'] == 17) { // export_csv_all_details
			$this->load->model('report/adv_sale_profit_export_all');
    		$rows = $this->model_report_adv_sale_profit_export_all->getSaleProfitExportAllExcel($filter_data);		
			include(DIR_APPLICATION . 'controller/report/adv_reports/sop_export_csv_all_details.inc.php');
			
		} elseif (isset($this->request->post['export']) && $this->request->post['export'] == 18) { // export_xlsx
			$this->load->model('report/adv_sale_profit_export');
    		$results = $this->model_report_adv_sale_profit_export->getSaleProfitExport($filter_data);	
			require_once(DIR_SYSTEM . 'library/PHPExcel/Classes/PHPExcel.php');
			require_once(DIR_SYSTEM . 'library/PHPExcel/Classes/PHPExcel/IOFactory.php');			
			include(DIR_APPLICATION . 'controller/report/adv_reports/sop_export_xlsx.inc.php');
			
		} elseif (isset($this->request->post['export']) && $this->request->post['export'] == 19) { // export_xlsx_all_details
			$this->load->model('report/adv_sale_profit_export_all');
    		$rows = $this->model_report_adv_sale_profit_export_all->getSaleProfitExportAllExcel($filter_data);	
			require_once(DIR_SYSTEM . 'library/PHPExcel/Classes/PHPExcel.php');
			require_once(DIR_SYSTEM . 'library/PHPExcel/Classes/PHPExcel/IOFactory.php');			
			include(DIR_APPLICATION . 'controller/report/adv_reports/sop_export_xlsx_all_details.inc.php');
		}
	}
	
	public function customer_autocomplete() {
		$json = array();

		$data['token'] = $this->session->data['token'];
		
		if (isset($this->request->get['filter_customer_name']) or isset($this->request->get['filter_customer_email']) or isset($this->request->get['filter_customer_telephone']) or isset($this->request->get['filter_ip']) or isset($this->request->get['filter_payment_company']) or isset($this->request->get['filter_payment_address']) or isset($this->request->get['filter_payment_city']) or isset($this->request->get['filter_payment_zone']) or isset($this->request->get['filter_payment_postcode']) or isset($this->request->get['filter_payment_country']) or isset($this->request->get['filter_shipping_company']) or isset($this->request->get['filter_shipping_address']) or isset($this->request->get['filter_shipping_city']) or isset($this->request->get['filter_shipping_zone']) or isset($this->request->get['filter_shipping_postcode']) or isset($this->request->get['filter_shipping_country'])) {
			
		$this->load->model('report/adv_sale_profit');
		
		if (isset($this->request->get['filter_customer_name'])) {
			$filter_customer_name = $this->request->get['filter_customer_name'];
		} else {
			$filter_customer_name = '';
		}

		if (isset($this->request->get['filter_customer_email'])) {
			$filter_customer_email = $this->request->get['filter_customer_email'];
		} else {
			$filter_customer_email = '';
		}	

		if (isset($this->request->get['filter_customer_telephone'])) {
			$filter_customer_telephone = $this->request->get['filter_customer_telephone'];
		} else {
			$filter_customer_telephone = '';
		}

		if (isset($this->request->get['filter_ip'])) {
			$filter_ip = $this->request->get['filter_ip'];
		} else {
			$filter_ip = '';
		}
		
		if (isset($this->request->get['filter_payment_company'])) {
			$filter_payment_company = $this->request->get['filter_payment_company'];
		} else {
			$filter_payment_company = '';
		}
		
		if (isset($this->request->get['filter_payment_address'])) {
			$filter_payment_address = $this->request->get['filter_payment_address'];
		} else {
			$filter_payment_address = '';
		}

		if (isset($this->request->get['filter_payment_city'])) {
			$filter_payment_city = $this->request->get['filter_payment_city'];
		} else {
			$filter_payment_city = '';
		}
		
		if (isset($this->request->get['filter_payment_zone'])) {
			$filter_payment_zone = $this->request->get['filter_payment_zone'];
		} else {
			$filter_payment_zone = '';
		}
		
		if (isset($this->request->get['filter_payment_postcode'])) {
			$filter_payment_postcode = $this->request->get['filter_payment_postcode'];
		} else {
			$filter_payment_postcode = '';
		}

		if (isset($this->request->get['filter_payment_country'])) {
			$filter_payment_country = $this->request->get['filter_payment_country'];
		} else {
			$filter_payment_country = '';
		}
		
		if (isset($this->request->get['filter_shipping_company'])) {
			$filter_shipping_company = $this->request->get['filter_shipping_company'];
		} else {
			$filter_shipping_company = '';
		}
		
		if (isset($this->request->get['filter_shipping_address'])) {
			$filter_shipping_address = $this->request->get['filter_shipping_address'];
		} else {
			$filter_shipping_address = '';
		}

		if (isset($this->request->get['filter_shipping_city'])) {
			$filter_shipping_city = $this->request->get['filter_shipping_city'];
		} else {
			$filter_shipping_city = '';
		}
		
		if (isset($this->request->get['filter_shipping_zone'])) {
			$filter_shipping_zone = $this->request->get['filter_shipping_zone'];
		} else {
			$filter_shipping_zone = '';
		}
		
		if (isset($this->request->get['filter_shipping_postcode'])) {
			$filter_shipping_postcode = $this->request->get['filter_shipping_postcode'];
		} else {
			$filter_shipping_postcode = '';
		}

		if (isset($this->request->get['filter_shipping_country'])) {
			$filter_shipping_country = $this->request->get['filter_shipping_country'];
		} else {
			$filter_shipping_country = '';
		}

		if (isset($this->request->get['limit'])) {
			$limit = $this->request->get['limit'];
		} else {
			$limit = 10;
		}
		
		$filter_data = array(		
			'filter_customer_name' 	 		=> $filter_customer_name,
			'filter_customer_email' 	 	=> $filter_customer_email,			
			'filter_customer_telephone' 	=> $filter_customer_telephone,
			'filter_ip' 					=> $filter_ip,			
			'filter_payment_company' 		=> $filter_payment_company,
			'filter_payment_address' 		=> $filter_payment_address,
			'filter_payment_city' 			=> $filter_payment_city,
			'filter_payment_zone' 			=> $filter_payment_zone,			
			'filter_payment_postcode' 		=> $filter_payment_postcode,
			'filter_payment_country' 		=> $filter_payment_country,			
			'filter_shipping_company' 		=> $filter_shipping_company,
			'filter_shipping_address' 		=> $filter_shipping_address,
			'filter_shipping_city' 			=> $filter_shipping_city,
			'filter_shipping_zone' 			=> $filter_shipping_zone,			
			'filter_shipping_postcode' 		=> $filter_shipping_postcode,
			'filter_shipping_country' 		=> $filter_shipping_country,
			'start'        					=> 0,
			'limit'        					=> $limit
		);
						
		$results = $this->model_report_adv_sale_profit->getCustomerAutocomplete($filter_data);
			
			foreach ($results as $result) {
				$json[] = array(
					'customer_id'     		=> $result['customer_id'],				
					'cust_name'     		=> html_entity_decode($result['cust_name'], ENT_QUOTES, 'UTF-8'),
					'cust_email'     		=> $result['cust_email'],
					'cust_telephone'     	=> $result['cust_telephone'],
					'cust_ip'     			=> $result['cust_ip'],
					'payment_company'     	=> html_entity_decode($result['payment_company'], ENT_QUOTES, 'UTF-8'),	
					'payment_address'     	=> html_entity_decode($result['payment_address'], ENT_QUOTES, 'UTF-8'),	
					'payment_city'     		=> html_entity_decode($result['payment_city'], ENT_QUOTES, 'UTF-8'),	
					'payment_zone'     		=> html_entity_decode($result['payment_zone'], ENT_QUOTES, 'UTF-8'),						
					'payment_postcode'     	=> $result['payment_postcode'],
					'payment_country'     	=> html_entity_decode($result['payment_country'], ENT_QUOTES, 'UTF-8'),					
					'shipping_company'     	=> html_entity_decode($result['shipping_company'], ENT_QUOTES, 'UTF-8'),	
					'shipping_address'     	=> html_entity_decode($result['shipping_address'], ENT_QUOTES, 'UTF-8'),
					'shipping_city'     	=> html_entity_decode($result['shipping_city'], ENT_QUOTES, 'UTF-8'),
					'shipping_zone'     	=> html_entity_decode($result['shipping_zone'], ENT_QUOTES, 'UTF-8'),					
					'shipping_postcode'     => $result['shipping_postcode'],
					'shipping_country'     	=> html_entity_decode($result['shipping_country'], ENT_QUOTES, 'UTF-8')			
				);
			}
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function product_autocomplete() {
		$json = array();

		$data['token'] = $this->session->data['token'];
		
		if (isset($this->request->get['filter_sku']) or isset($this->request->get['filter_product_id']) or isset($this->request->get['filter_model'])) {
		
		$this->load->model('report/adv_sale_profit');
					
		if (isset($this->request->get['filter_sku'])) {
			$filter_sku = $this->request->get['filter_sku'];
		} else {
			$filter_sku = '';
		}

		if (isset($this->request->get['filter_product_id'])) {
			$filter_product_id = $this->request->get['filter_product_id'];
		} else {
			$filter_product_id = '';
		}
		
		if (isset($this->request->get['filter_model'])) {
			$filter_model = $this->request->get['filter_model'];
		} else {
			$filter_model = '';
		}

		if (isset($this->request->get['limit'])) {
			$limit = $this->request->get['limit'];
		} else {
			$limit = 10;
		}
		
		$filter_data = array(				
			'filter_sku' 	 				=> $filter_sku,
			'filter_product_id' 	 		=> $filter_product_id,
			'filter_model' 	 				=> $filter_model,
			'start'        					=> 0,
			'limit'        					=> $limit	
		);
						
		$results = $this->model_report_adv_sale_profit->getProductAutocomplete($filter_data);
			
			foreach ($results as $result) {
				$json[] = array(
					'product_id'     		=> $result['product_id'],
					'prod_sku'     			=> html_entity_decode($result['prod_sku'], ENT_QUOTES, 'UTF-8'),					
					'prod_name'     		=> html_entity_decode($result['prod_name'], ENT_QUOTES, 'UTF-8'),
					'prod_model'     		=> html_entity_decode($result['prod_model'], ENT_QUOTES, 'UTF-8')				
				);
			}
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function coupon_autocomplete() {
		$json = array();

		$data['token'] = $this->session->data['token'];
		
		if (isset($this->request->get['filter_coupon_code'])) {
			
		$this->load->model('report/adv_sale_profit');

		if (isset($this->request->get['filter_coupon_code'])) {
			$filter_coupon_code = $this->request->get['filter_coupon_code'];
		} else {
			$filter_coupon_code = '';
		}

		if (isset($this->request->get['limit'])) {
			$limit = $this->request->get['limit'];
		} else {
			$limit = 10;
		}
		
		$filter_data = array(		
			'filter_coupon_code' 	 		=> $filter_coupon_code,
			'start'        					=> 0,
			'limit'        					=> $limit			
		);
						
		$results = $this->model_report_adv_sale_profit->getCouponAutocomplete($filter_data);
			
			foreach ($results as $result) {
				$json[] = array(
					'coupon_id'     		=> $result['coupon_id'],
					'coupon_code'     		=> html_entity_decode($result['coupon_code'], ENT_QUOTES, 'UTF-8')
				);
			}
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function voucher_autocomplete() {
		$json = array();

		$data['token'] = $this->session->data['token'];
		
		if (isset($this->request->get['filter_voucher_code'])) {
			
		$this->load->model('report/adv_sale_profit');

		if (isset($this->request->get['filter_voucher_code'])) {
			$filter_voucher_code = $this->request->get['filter_voucher_code'];
		} else {
			$filter_voucher_code = '';
		}

		if (isset($this->request->get['limit'])) {
			$limit = $this->request->get['limit'];
		} else {
			$limit = 10;
		}
		
		$filter_data = array(		
			'filter_voucher_code' 	 		=> $filter_voucher_code,
			'start'        					=> 0,
			'limit'        					=> $limit
		);
						
		$results = $this->model_report_adv_sale_profit->getVoucherAutocomplete($filter_data);
			
			foreach ($results as $result) {
				$json[] = array(
					'voucher_id'     		=> $result['voucher_id'],
					'voucher_code'     		=> html_entity_decode($result['voucher_code'], ENT_QUOTES, 'UTF-8')
				);
			}
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	protected function clearSpreadsheetCache() {
		$files = glob(DIR_CACHE . 'Spreadsheet_Excel_Writer' . '*');
		
		if ($files) {
			foreach ($files as $file) {
				if (file_exists($file)) {
					@unlink($file);
					clearstatcache();
				}
			}
		}
	}		
}