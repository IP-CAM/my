<?php
class ControllerModuleGift extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('module/gift');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('extension/module');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if (!isset($this->request->get['module_id'])) {
				$this->model_extension_module->addModule('gift', $this->request->post);
			} else {
				$this->model_extension_module->editModule($this->request->get['module_id'], $this->request->post);
			}
						
			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_add'] = $this->language->get('text_add');
		$data['text_percent'] = $this->language->get('text_percent');
		$data['text_amount'] = $this->language->get('text_amount');
		$data['text_group'] = $this->language->get('text_group');
		
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_product'] = $this->language->get('entry_product');
		$data['entry_limit'] = $this->language->get('entry_limit');
		$data['entry_width'] = $this->language->get('entry_width');
		$data['entry_height'] = $this->language->get('entry_height');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_total'] = $this->language->get('entry_total');
		$data['entry_discount'] = $this->language->get('entry_discount');
		$data['entry_type'] = $this->language->get('entry_type');

		$data['help_product'] = $this->language->get('help_product');
		$data['help_total'] = $this->language->get('help_total');
		$data['help_type'] = $this->language->get('help_type');
		$data['help_discount_type'] = $this->language->get('help_discount_type');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_remove'] = $this->language->get('button_remove');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}
		
		if (isset($this->error['width'])) {
			$data['error_width'] = $this->error['width'];
		} else {
			$data['error_width'] = '';
		}
		
		if (isset($this->error['height'])) {
			$data['error_height'] = $this->error['height'];
		} else {
			$data['error_height'] = '';
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

		if (!isset($this->request->get['module_id'])) {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('module/gift', 'token=' . $this->session->data['token'], 'SSL')
			);
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('module/gift', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL')
			);			
		}

		if (!isset($this->request->get['module_id'])) {
			$data['action'] = $this->url->link('module/gift', 'token=' . $this->session->data['token'], 'SSL');
		} else {
			$data['action'] = $this->url->link('module/gift', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL');
		}
		
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$module_info = $this->model_extension_module->getModule($this->request->get['module_id']);
		}
		
		$data['token'] = $this->session->data['token'];

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($module_info)) {
			$data['name'] = $module_info['name'];
		} else {
			$data['name'] = '';
		}
 
		// Language
		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['title'])) {
			$data['title'] = $this->request->post['title'];
		} elseif (!empty($module_info)) {
			$data['title'] = $module_info['title'];
		} else {
			$data['title'] = '';
		}
		
		if (isset($this->request->post['total'])) {
			$data['total'] = $this->request->post['total'];
		} elseif (!empty($module_info)) {
			$data['total'] = $module_info['total'];
		} else {
			$data['total'] = 0;
		}
		
		if (isset($this->request->post['limit'])) {
			$data['limit'] = $this->request->post['limit'];
		} elseif (!empty($module_info)) {
			$data['limit'] = $module_info['limit'];
		} else {
			$data['limit'] = 5;
		}	
				
		if (isset($this->request->post['width'])) {
			$data['width'] = $this->request->post['width'];
		} elseif (!empty($module_info)) {
			$data['width'] = $module_info['width'];
		} else {
			$data['width'] = 200;
		}	
			
		if (isset($this->request->post['height'])) {
			$data['height'] = $this->request->post['height'];
		} elseif (!empty($module_info)) {
			$data['height'] = $module_info['height'];
		} else {
			$data['height'] = 200;
		}		
		
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($module_info)) {
			$data['status'] = $module_info['status'];
		} else {
			$data['status'] = '';
		}

		$this->load->model('catalog/product');
		$this->load->model('tool/image');
		
		$data['products'] = array();
		
		if (isset($this->request->post['product']) && is_array($this->request->post['product'])) {
			$products = $this->request->post['product'];
		} elseif (!empty($module_info) && !empty($module_info['product'])) {
			$products = $module_info['product'];
		} else {
			$products = array();
		}
		
		foreach ($products as $product_id => $v) {
			$product_info = $this->model_catalog_product->getProduct($product_id);

			if ($product_info) {
				if (is_file(DIR_IMAGE . $product_info['image'])) {
					$image = $this->model_tool_image->resize($product_info['image'], 30, 30);
				} else {
					$image = $this->model_tool_image->resize('no_image.png', 30, 30);
				}
				
				$data['products'][] = array(
					'product_id' => $product_info['product_id'],
					'name'       => $product_info['name'],
					'price'      => $product_info['price'],
					'image'      => $image,
					'newprice'   => $v['price']
				);
			}
		}
		
		if (isset($this->request->post['discount']) && is_array($this->request->post['discount'])) {
			$discounts = $this->request->post['discount'];
		} elseif (!empty($module_info) && !empty($module_info['discount'])) {
			$discounts = $module_info['discount'];
		} else {
			$discounts = array();
		}
		
		$data['discounts'] = array();
		
		foreach ($discounts as $d) {
			if (is_file(DIR_IMAGE . $d['image'])) {
				$thumb = $this->model_tool_image->resize($d['image'], 100, 100);
			} else {
				$thumb = $this->model_tool_image->resize('no_image.png', 100, 100);
			}
				
			$data['discounts'][] = array(
				'name'       => $d['name'],
				'type'       => $d['type'],
				'amount'     => $d['amount'],
				'image'      => $d['image'],
				'thumb'      => $thumb
			);
		}

		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
				
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/gift.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/gift')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}
		
		if (!$this->request->post['width']) {
			$this->error['width'] = $this->language->get('error_width');
		}
		
		if (!$this->request->post['height']) {
			$this->error['height'] = $this->language->get('error_height');
		}
		
		if (empty($this->request->post['product'])) {
			$this->error['warning'] = $this->language->get('error_product');
		}
		
		return !$this->error;
	}

	public function autocomplete() {
		$json = array();
		
		if (isset($this->request->get['size']) && (int)$this->request->get['size'] > 0) {
			$size = (int)$this->request->get['size'];
		} else {
			$size = 40;
		}

		if (isset($this->request->get['filter_name']) || isset($this->request->get['filter_model'])) {
			$this->load->model('catalog/product');
			$this->load->model('catalog/option');
			$this->load->model('tool/image');

			if (isset($this->request->get['filter_name'])) {
				$filter_name = $this->request->get['filter_name'];
			} else {
				$filter_name = '';
			}

			if (isset($this->request->get['filter_model'])) {
				$filter_model = $this->request->get['filter_model'];
			} else {
				$filter_model = '';
			}

			if (isset($this->request->get['limit'])) {
				$limit = $this->request->get['limit'];
			} else {
				$limit = 5;
			}
			
			$json = array();
		
			$module_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "module WHERE LCASE(`code`) = 'gift'");
			
			$modules = $module_query->rows;
			
			if ($modules) {
				foreach ($modules as $module) {
					$lize = unserialize($module['setting']);
					
					if ($lize && !empty($lize['product'])) {
						foreach ($lize['product'] as $key => $val) {
							$product = $this->model_catalog_product->getProduct($key);
							
							if ($filter_name && strpos(utf8_strtolower($product['name']), utf8_strtolower($filter_name)) === false)
							{
								$show = false;
							}
							elseif ($filter_model && strpos(utf8_strtolower($product['model']), utf8_strtolower($filter_model)) === false)
							{
								$show = false;
							} else {
								$show = true;
							}
							
							if ($product && $show) {
								$option_data = array();
				
								$product_options = $this->model_catalog_product->getProductOptions($product['product_id']);
				
								foreach ($product_options as $product_option) {
									$option_info = $this->model_catalog_option->getOption($product_option['option_id']);
				
									if ($option_info) {
										$product_option_value_data = array();
				
										foreach ($product_option['product_option_value'] as $product_option_value) {
											$option_value_info = $this->model_catalog_option->getOptionValue($product_option_value['option_value_id']);
				
											if ($option_value_info) {
												$product_option_value_data[] = array(
													'product_option_value_id' => $product_option_value['product_option_value_id'],
													'option_value_id'         => $product_option_value['option_value_id'],
													'name'                    => $option_value_info['name'],
													'price'                   => (float)$product_option_value['price'] ? $this->currency->format($product_option_value['price'], $this->config->get('config_currency')) : false,
													'price_prefix'            => $product_option_value['price_prefix']
												);
											}
										}
				
										$option_data[] = array(
											'product_option_id'    => $product_option['product_option_id'],
											'product_option_value' => $product_option_value_data,
											'option_id'            => $product_option['option_id'],
											'name'                 => $option_info['name'],
											'type'                 => $option_info['type'],
											'value'                => $product_option['value'],
											'required'             => $product_option['required']
										);
									}
								}
				
								if (is_file(DIR_IMAGE . $product['image'])) {
									$image = $this->model_tool_image->resize($product['image'], $size, $size);
								} else {
									$image = $this->model_tool_image->resize('no_image.png', $size, $size);
								}
								
								$json[] = array(
									'product_id'  => (int)$product['product_id'],
									'name'        => strip_tags(html_entity_decode($product['name'], ENT_QUOTES, 'UTF-8')),
									'model'       => $product['model'],
									'image'       => $image,
									'option'      => $option_data,
									'price'       => (float)$val['price'],
									'group'       => (int)$module['module_id'],
									'group_name'  => (int)$lize['name'],
								);
							}
						}
					}
					
					if ($lize && !empty($lize['discount'])) {						
						foreach ($lize['discount'] as $key => $val) {
							if ($filter_name && strpos(utf8_strtolower($val['name'][$this->config->get('config_language_id')]), utf8_strtolower($filter_name)) === false)
							{
								$show = false;
							} else {
								$show = true;
							}
							
							if ($show) {
								if (is_file(DIR_IMAGE . $val['image'])) {
									$image = $this->model_tool_image->resize($val['image'], $size, $size);
								} else {
									$image = $this->model_tool_image->resize('no_image.png', $size, $size);
								}
								
								$json[] = array(
									'product_id'  => 'discount'.$module['module_id'].$key,
									'name'        => $val['name'][$this->config->get('config_language_id')],
									'model'       => '',
									'image'       => $image,
									'option'      => array(),
									'price'       => (float)$val['amount'],
									'group'       => (int)$module['module_id'],
									'group_name'  => (int)$lize['name'],
								);
							}
						}
					}
				}
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}