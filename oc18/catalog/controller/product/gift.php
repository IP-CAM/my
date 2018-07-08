<?php
class ControllerProductGift extends Controller {
	public function index() {
		$this->load->language('product/gift');

		$this->load->model('catalog/product');

		$this->load->model('tool/image');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('product/gift')
		);

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_empty'] = $this->language->get('text_empty');
		$data['text_quantity'] = $this->language->get('text_quantity');
		$data['text_manufacturer'] = $this->language->get('text_manufacturer');
		$data['text_model'] = $this->language->get('text_model');
		$data['text_price'] = $this->language->get('text_price');
		$data['text_tax'] = $this->language->get('text_tax');
		$data['text_points'] = $this->language->get('text_points');
		$data['text_compare'] = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));
		$data['text_sort'] = $this->language->get('text_sort');
		$data['text_limit'] = $this->language->get('text_limit');
		$data['text_point_text'] = $this->language->get('text_point_text');

		$data['button_cart'] = $this->language->get('button_cart');
		$data['button_wishlist'] = $this->language->get('button_wishlist');
		$data['button_compare'] = $this->language->get('button_compare');
		$data['button_list'] = $this->language->get('button_list');
		$data['button_grid'] = $this->language->get('button_grid');
		$data['button_continue'] = $this->language->get('button_continue');
		
		$data['compare'] = $this->url->link('product/compare');

		$data['modules'] = array();
		
		$module_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "module WHERE LCASE(`code`) = 'gift'");
		
		foreach ($module_query->rows as $module) {
			$setting = unserialize($module['setting']);
			
			if ($setting) {
				$products = array();
				
				if (!empty($setting['product'])) {
					foreach ($setting['product'] as $key => $val) {
						$result = $this->model_catalog_product->getProduct($key);
						
						if ($result) {
							if ($result['image']) {
								$image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
							} else {
								$image = $this->model_tool_image->resize('placeholder.png', $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
							}

							if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
								$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
							} else {
								$price = false;
							}
				
							$special = $this->currency->format((float)$val['price']);
							
							$products[] = array(
								'type'       => 'product',
								'product_id' => $key,
								'thumb'      => $image,
								'name'       => $result['name'],
								'description'=> html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'),
								'price'      => $price,
								'special'    => $special,
								'href'       => $this->url->link('product/product', 'product_id=' . $result['product_id'])
							);
						}
					}
				}
				
				if (!empty($setting['discount'])) {
					foreach ($setting['discount'] as $key => $val) {
						if ($result['image']) {
							$image = $this->model_tool_image->resize($val['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
						} else {
							$image = $this->model_tool_image->resize('placeholder.png', $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
						}
						
						$products[] = array(
							'type'       => 'discount',
							'product_id' => $key,
							'thumb'      => $image,
							'name'       => $val['name'][$this->config->get('config_language_id')],
							'href'       => ''
						);
					}
				}
				
				$data['modules'][] = array(
					'title'    => sprintf($this->language->get('text_title'), $this->currency->format($setting['total'])),
					'product'  => $products
				);
			}
		}

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/gift.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/product/gift.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/product/gift.tpl', $data));
		}
	}
}
