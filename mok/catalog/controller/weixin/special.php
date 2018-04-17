<?php
class ControllerWeixinSpecial extends Controller {
	public function index() {
		if(!isset($this->request->get['special_id'])){
			$this->response->redirect($this->url->link('weixin/special_list', '', true));
		}
		$this->load->language('weixin/special');
		$this->load->model('weixin/special');
		$special_id = $this->request->get['special_id'];
		
		$special_info = $this->model_weixin_special->getSpecial($special_id);
		
		if($special_info){
		$this->document->setTitle($this->language->get('meta_title'));
		$this->document->setDescription($this->language->get('meta_description'));
		$this->document->setKeywords($this->language->get('meta_keyword'));
		
		$this->document->addStyle('catalog/view/theme/default/css/special.css');
		$this->document->addScript('catalog/view/theme/default/script/zepto.min.js','footer');
		$this->document->addScript('catalog/view/theme/default/script/zepto.lazyload.min.js','footer');

		if (isset($this->request->get['route'])) {
			$this->document->addLink($this->url->link('weixin/special','special_id=' . $special_id,true), 'canonical');
		}
		
		$this->load->model('tool/image');

		if ($special_info['image']) {
			$data['image'] = $this->model_tool_image->resize($special_info['image'], 750, 420);
		} else {
			$data['image'] = '';
		}
		$data['title'] = $special_info['name'];
		
		$data['description'] = html_entity_decode($special_info['description'], ENT_QUOTES, 'UTF-8');
		
		$result_product_ids = $this->model_weixin_special->getSpecialProducts($special_id);
		$result_category_ids = $this->model_weixin_special->getSpecialCategories($special_id);
		if($result_category_ids){
			foreach($result_category_ids as $category_id){
				$results = $this->model_weixin_special->getProductIdByCategoryId($category_id);
				if($results){
					foreach($results as $value){
						$result_ids[] = $value;
					}
				}else{
					$result_ids = array();
				}
			}
			
			$product_ids = array_unique(array_merge($result_product_ids,$result_ids));
		}else{
			$product_ids = $result_product_ids;
		}
		
		if (!empty($product_ids)) {
			$products = array_slice($product_ids, 0, (int)$this->config->get($this->config->get('config_theme') . '_product_limit'));
			
			$this->load->model('extension/module/featured');
			
			foreach ($products as $product_id) {
				$product_info = $this->model_extension_module_featured->getProduct($product_id);

				if ($product_info) {
					if ($product_info['image']) {
						$image = $this->model_tool_image->resize($product_info['image'],$this->config->get($this->config->get('config_theme') . '_image_product_width'), $this->config->get($this->config->get('config_theme') . '_image_product_height'));
					} else {
						$image = $this->model_tool_image->resize('placeholder.png', $this->config->get($this->config->get('config_theme') . '_image_product_width'), $this->config->get($this->config->get('config_theme') . '_image_product_height'));
					}

					if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
						$price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
					} else {
						$price = false;
					}

					if ((float)$product_info['special']) {
						$special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
					} else {
						$special = false;
					}

					if ($this->config->get('config_tax')) {
						$tax = $this->currency->format((float)$product_info['special'] ? $product_info['special'] : $product_info['price'], $this->session->data['currency']);
					} else {
						$tax = false;
					}

					if ($this->config->get('config_review_status')) {
						$rating = $product_info['rating'];
					} else {
						$rating = false;
					}
					

					$data['products'][] = array(
						'product_id'  => $product_info['product_id'],
						'thumb'       => $image,
						'name'        => $product_info['name'],
						'description' => utf8_substr(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get($this->config->get('config_theme') . '_product_description_length')) . '..',
						'price'       => $price,
						'special'     => $special,
						'tax'         => $tax,
						'rating'      => $rating,
						'href'        => $this->url->link('product/product', 'product_id=' . $product_info['product_id'])
					);
				}
			}
		}
		


		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		
		$data['footer'] = $this->load->controller('weixin/footer');
		$data['header'] = $this->load->controller('weixin/header');

		$this->response->setOutput($this->load->view('weixin/special', $data));
		}else{
			//404页面跳转
			$this->response->redirect($this->url->link('error/not_found', '', true));
		}
	}
}