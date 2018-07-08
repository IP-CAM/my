<?php
class ControllerShippingSuper extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('shipping/super');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('super', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_shipping_add'] = $this->language->get('text_shipping_add');
		
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_shipping_status'] = $this->language->get('entry_shipping_status');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$data['action'] = $this->url->link('shipping/super', 'token=' . $this->session->data['token'], 'SSL');
		$data['cancel'] = $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL');

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
			'text' => $this->language->get('text_shipping'),
			'href' => $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('shipping/super', 'token=' . $this->session->data['token'], 'SSL')
		);

		if (isset($this->request->post['super_status'])) {
			$data['super_status'] = $this->request->post['super_status'];
		} else {
			$data['super_status'] = $this->config->get('super_status');
		}

		if (isset($this->request->post['super_sort_order'])) {
			$data['super_sort_order'] = $this->request->post['super_sort_order'];
		} else {
			$data['super_sort_order'] = $this->config->get('super_sort_order');
		}

		if (isset($this->request->post['super'])) {
			$super = $this->request->post['super'];
		} elseif ($this->config->get('super')) {
			$super = $this->config->get('super');
		} else {
			$super = array();
		}
		
		$data['super'] = array();
		
		foreach ($super as $su) {
			$name = $this->config->get('super'.$su.'_name');
			
			$data['super'][] = array(
				'id'   => $su,
				'name' => $name?$name[$this->config->get('config_language_id')]:$this->language->get('heading_title')
			);
		}

		$data['token'] = $this->session->data['token'];

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('shipping/super.tpl', $data));
	}
	
	public function form() {
		if (isset($this->request->get['shipping_id'])) {
			$shipping_id = $this->request->get['shipping_id'];
		} else {
			$shipping_id = 0;
		}
		
		$data['shipping_id'] = $shipping_id;
		
		$this->load->language('shipping/super');
		
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_all_zones'] = $this->language->get('text_all_zones');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_data'] = $this->language->get('text_data');
		$data['text_payment'] = $this->language->get('text_payment');
		$data['text_store'] = $this->language->get('text_store');
		$data['text_store_add'] = $this->language->get('text_store_add');
		$data['text_store_name'] = $this->language->get('text_store_name');
		$data['text_store_address'] = $this->language->get('text_store_address');
		$data['text_store_work'] = $this->language->get('text_store_work');
		$data['text_group'] = $this->language->get('text_group');
		$data['text_group_add'] = $this->language->get('text_group_add');
		
		$data['text_custom'] = $this->language->get('text_custom');
		$data['text_custom_name'] = $this->language->get('text_custom_name');
		$data['text_custom_value'] = $this->language->get('text_custom_value');
		$data['text_custom_type'] = $this->language->get('text_custom_type');
		$data['text_custom_add'] = $this->language->get('text_custom_add');

		$data['type_text'] = $this->language->get('type_text');
		$data['type_select'] = $this->language->get('type_select');
		$data['type_date'] = $this->language->get('type_date');
		
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_description'] = $this->language->get('entry_description');
		$data['entry_weight_cost'] = $this->language->get('entry_weight_cost');
		$data['entry_price_cost'] = $this->language->get('entry_price_cost');
		$data['entry_shipping'] = $this->language->get('entry_shipping');
		$data['entry_payment'] = $this->language->get('entry_payment');
		
		$data['help_weight_cost'] = $this->language->get('help_weight_cost');
		$data['help_price_cost'] = $this->language->get('help_price_cost');
		
		$data['button_remove'] = $this->language->get('button_remove');

		if (isset($this->request->post['super'.$shipping_id.'_geo_zone_id'])) {
			$data['super'.$shipping_id.'_geo_zone_id'] = $this->request->post['super'.$shipping_id.'_geo_zone_id'];
		} else {
			$data['super'.$shipping_id.'_geo_zone_id'] = $this->config->get('super'.$shipping_id.'_geo_zone_id');
		}

		$this->load->model('localisation/geo_zone');

		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		if (isset($this->request->post['super'.$shipping_id.'_status'])) {
			$data['super'.$shipping_id.'_status'] = $this->request->post['super'.$shipping_id.'_status'];
		} else {
			$data['super'.$shipping_id.'_status'] = $this->config->get('super'.$shipping_id.'_status');
		}

		if (isset($this->request->post['super'.$shipping_id.'_name'])) {
			$data['super'.$shipping_id.'_name'] = $this->request->post['super'.$shipping_id.'_name'];
		} else {
			$data['super'.$shipping_id.'_name'] = $this->config->get('super'.$shipping_id.'_name');
		}

		if (isset($this->request->post['super'.$shipping_id.'_description'])) {
			$data['super'.$shipping_id.'_description'] = $this->request->post['super'.$shipping_id.'_description'];
		} else {
			$data['super'.$shipping_id.'_description'] = $this->config->get('super'.$shipping_id.'_description');
		}

		if (isset($this->request->post['super'.$shipping_id.'_price_cost'])) {
			$data['super'.$shipping_id.'_price_cost'] = $this->request->post['super'.$shipping_id.'_price_cost'];
		} else {
			$data['super'.$shipping_id.'_price_cost'] = $this->config->get('super'.$shipping_id.'_price_cost');
		}

		if (isset($this->request->post['super'.$shipping_id.'_weight_cost'])) {
			$data['super'.$shipping_id.'_weight_cost'] = $this->request->post['super'.$shipping_id.'_weight_cost'];
		} else {
			$data['super'.$shipping_id.'_weight_cost'] = $this->config->get('super'.$shipping_id.'_weight_cost');
		}

		if (isset($this->request->post['super'.$shipping_id.'_sort_order'])) {
			$data['super'.$shipping_id.'_sort_order'] = $this->request->post['super'.$shipping_id.'_sort_order'];
		} else {
			$data['super'.$shipping_id.'_sort_order'] = $this->config->get('super'.$shipping_id.'_sort_order');
		}

		if (isset($this->request->post['super'.$shipping_id.'_payment'])) {
			$data['super'.$shipping_id.'_payment'] = $this->request->post['super'.$shipping_id.'_payment'];
		} elseif ($this->config->get('super'.$shipping_id.'_payment') && is_array($this->config->get('super'.$shipping_id.'_payment'))) {
			$data['super'.$shipping_id.'_payment'] = $this->config->get('super'.$shipping_id.'_payment');
		} else {
			$data['super'.$shipping_id.'_payment'] = array();
		}

		if (isset($this->request->post['super'.$shipping_id.'_store'])) {
			$data['super'.$shipping_id.'_store'] = $this->request->post['super'.$shipping_id.'_store'];
		} elseif ($this->config->get('super'.$shipping_id.'_store') && is_array($this->config->get('super'.$shipping_id.'_store'))) {
			$data['super'.$shipping_id.'_store'] = $this->config->get('super'.$shipping_id.'_store');
		} else {
			$data['super'.$shipping_id.'_store'] = array();
		}

		if (isset($this->request->post['super'.$shipping_id.'_custom'])) {
			$data['super'.$shipping_id.'_custom'] = $this->request->post['super'.$shipping_id.'_custom'];
		} elseif ($this->config->get('super'.$shipping_id.'_custom') && is_array($this->config->get('super'.$shipping_id.'_custom'))) {
			$data['super'.$shipping_id.'_custom'] = $this->config->get('super'.$shipping_id.'_custom');
		} else {
			$data['super'.$shipping_id.'_custom'] = array();
		}
 
		// Language
		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();
		$data['language_id'] = $this->config->get('config_language_id');

		$this->load->model('extension/extension');

		$extensions = $this->model_extension_extension->getInstalled('payment');

		foreach ($extensions as $key => $value) {
			if (!file_exists(DIR_APPLICATION . 'controller/payment/' . $value . '.php')) {
				$this->model_extension_extension->uninstall('payment', $value);

				unset($extensions[$key]);
			}
		}

		$data['extensions'] = array();

		$files = glob(DIR_APPLICATION . 'controller/payment/*.php');

		if ($files) {
			foreach ($files as $file) {
				$extension = basename($file, '.php');
					
				if ($this->config->get($extension . '_status')) {
					$this->load->language('payment/' . $extension);
	
					$text_link = $this->language->get('text_' . $extension);
	
					if ($text_link != 'text_' . $extension) {
						$link = $this->language->get('text_' . $extension);
					} else {
						$link = '';
					}
	
					$data['extensions'][] = array(
						'name'       => $this->language->get('heading_title'),
						'code'       => $extension,
						'link'       => $link,
						'status'     => $this->config->get($extension . '_status'),
						'installed' => in_array($extension, $extensions)
					);
				}
			}
		}

		$this->response->setOutput($this->load->view('shipping/super_form.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'shipping/super')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (empty($this->request->post['super'])) {
			$this->error['warning'] = $this->language->get('error_super_empty');
		}
		
		if (!empty($this->request->post['super'])) {
			$codes = array();
			
			foreach ($this->request->post['super'] as $super) {
				if (!in_array($super, $codes)) {
					$codes[] = $super;
				} else {
					$this->error['warning'] = $this->language->get('error_super_unique');
					
					break;
				}
			}
		}

		return !$this->error;
	}
}