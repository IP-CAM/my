<?php
class ControllerAccountAccount extends Controller {
public function getZone(){
        if(isset($this->request->post['country_id'])){
            $this->load->model('account/address');
            $json = $this->model_account_address->getZonesByCountryId($this->request->post['country_id']);
        }else{
            $json = false;
        }
        
        if(!$json){
            $json = array( 0 => array( 'name' => $this->language->get('text_none'), 'value' => 0)); 
        }
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
	/* add city */ 
	public function getCity(){
        if(isset($this->request->post['zone_id'])){
            $this->load->model('account/address');
            $json = $this->model_account_address->getCitysByZoneId($this->request->post['zone_id']);
        }else{
            $json = false;
        }
        
        if(!$json){
            $json = array( 0 => array( 'name' => $this->language->get('text_none'), 'value' => 0)); 
        }
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
	public function getDistrict(){
        if(isset($this->request->post['city_id'])){
            $this->load->model('account/address');
            $json = $this->model_account_address->getDistrictsByCityId($this->request->post['city_id']);
        }else{
            $json = false;
        }
        
        if(!$json){
            $json = array( 0 => array( 'name' => $this->language->get('text_none'), 'value' => 0)); 
        }
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
	/* end add */
	public function index() {
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/account', '', true);

			$this->response->redirect($this->url->link('account/login', '', true));
		}

		$this->load->language('account/account');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_account'),
			'href' => $this->url->link('account/account', '', true)
		);

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		} 

		$data['heading_title'] = $this->language->get('heading_title');

                $data['text_my_collect'] = $this->language->get('text_my_collect');
                $data['text_my_attention'] = $this->language->get('text_my_attention');
                $data['text_shopping_cart'] = $this->language->get('text_shopping_cart');
                $data['text_address_management'] = $this->language->get('text_address_management');
                $data['text_my_coupons'] = $this->language->get('text_my_coupons');
                $data['text_my_activities'] = $this->language->get('text_my_activities');
                $data['text_account_safe'] = $this->language->get('text_account_safe');
                $data['text_my_feedback'] = $this->language->get('text_my_feedback');
                $data['text_customer_service'] = $this->language->get('text_customer_service');
                $data['text_help_center'] = $this->language->get('text_help_center');
                $data['text_log_out'] = $this->language->get('text_log_out');
                $data['text_come_look'] = $this->language->get('text_come_look');
                $data['text_come_play'] = $this->language->get('text_come_play');
                $data['text_come_buy'] = $this->language->get('text_come_buy');
                $data['text_mine'] = $this->language->get('text_mine');
            

		$data['text_my_account'] = $this->language->get('text_my_account');
		$data['text_my_orders'] = $this->language->get('text_my_orders');
		$data['text_my_newsletter'] = $this->language->get('text_my_newsletter');
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_password'] = $this->language->get('text_password');
		$data['text_address'] = $this->language->get('text_address');
		$data['text_credit_card'] = $this->language->get('text_credit_card');
		$data['text_wishlist'] = $this->language->get('text_wishlist');
		$data['text_order'] = $this->language->get('text_order');
		$data['text_download'] = $this->language->get('text_download');
		$data['text_reward'] = $this->language->get('text_reward');
		$data['text_return'] = $this->language->get('text_return');
		$data['text_transaction'] = $this->language->get('text_transaction');
		$data['text_newsletter'] = $this->language->get('text_newsletter');

	       $data['text_coupon'] = $this->language->get('text_coupon');
			
		$data['text_recurring'] = $this->language->get('text_recurring');

		$data['edit'] = $this->url->link('account/edit', '', true);
		$data['password'] = $this->url->link('account/password', '', true);
		$data['edit_personal_info'] = $this->url->link('account/edit', '', true);
              $data['shopping_cart'] = $this->url->link('checkout/cart', '', true);
              $data['my_order'] = $this->url->link('account/order', '', true);
              $data['my_address'] = $this->url->link('account/address', '', true);
              $data['my_coupon'] = $this->url->link('account/coupon', '', true);
              $data['my_activities'] = $this->url->link('account/activities', '', true);
              $data['account_security'] = $this->url->link('weixin/account_safe', '', true);
              $data['feedback'] = $this->url->link('information/feedback', '', true);
              $data['customer_service'] = $this->url->link('account/address', '', true);
              $data['help_center'] = $this->url->link('faq/faq', '', true);
              $data['my_collect'] = $this->url->link('account/wishlist', '', true);
              $data['my_attention'] = $this->url->link('account/attention_manufacturer', '', true);
              $data['logout_href'] = $this->url->link('account/logout', '', true);
              $data['amount'] = $this->cart->countProducts();
              $this->load->model('account/customer');
              $customer_info = $this->model_account_customer->getCustomer($this->customer->getId());
              $customer_field_arr = json_decode($customer_info['custom_field'], true);
              if(isset($customer_field_arr[9])){
                $data['user_name'] = $customer_field_arr[9];
              }else{
              $data['user_name'] = '';
              }
               if ($customer_field_arr[8]) {
                        $this->load->model('tool/image');
                    $data['user_head'] = $this->model_tool_image->resize($customer_field_arr[8], 83, 83);
                } else {
                    $data['user_head'] = false;
                }
                $this->load->model('account/attention_buyer');
                $this->load->model('account/attention_manufacturer');
                $this->load->model('account/collect_article');
                $this->load->model('account/wishlist_ext');
                $buyer_num = $this->model_account_attention_buyer->getTotalAttentionManufacturer();
                $manufacturer_num = $this->model_account_attention_manufacturer->getTotalAttentionManufacturer();
                $blog_num = $this->model_account_collect_article->getTotalArticle();
                $goods_num = $this->model_account_wishlist_ext->getTotalWishlist();
                $data['attention_num'] = $buyer_num + $manufacturer_num;
                $data['collect_num'] = $goods_num + $blog_num;
		
		$data['credit_cards'] = array();
		
		$files = glob(DIR_APPLICATION . 'controller/extension/credit_card/*.php');
		
		foreach ($files as $file) {
			$code = basename($file, '.php');
			
			if ($this->config->get($code . '_status') && $this->config->get($code . '_card')) {
				$this->load->language('extension/credit_card/' . $code);

				$data['credit_cards'][] = array(
					'name' => $this->language->get('heading_title'),
					'href' => $this->url->link('extension/credit_card/' . $code, '', true)
				);
			}
		}
		

	      $data['coupon'] = $this->url->link('account/coupon');
			
		$data['wishlist'] = $this->url->link('account/wishlist');
		$data['order'] = $this->url->link('account/order', '', true);
		$data['download'] = $this->url->link('account/download', '', true);
		
		if ($this->config->get('reward_status')) {
			$data['reward'] = $this->url->link('account/reward', '', true);
		} else {
			$data['reward'] = '';
		}		
		
		$data['return'] = $this->url->link('account/return', '', true);
		$data['transaction'] = $this->url->link('account/transaction', '', true);
		$data['newsletter'] = $this->url->link('account/newsletter', '', true);
		$data['recurring'] = $this->url->link('account/recurring', '', true);
		

                 $this->document->addStyle('catalog/view/theme/default/css/my.css');

                $this->document->addScript('catalog/view/theme/default/script/zepto.min.js','footer');

                $this->document->addScript('catalog/view/theme/default/script/ok_personal_center.js','footer');
            
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('weixin/footer');
		$data['header'] = $this->load->controller('weixin/header');
		
		
                $this->response->setOutput($this->load->view('weixin/account', $data));
            
	}

	public function country() {
		$json = array();

		$this->load->model('localisation/country');

		$country_info = $this->model_localisation_country->getCountry($this->request->get['country_id']);

		if ($country_info) {
			$this->load->model('localisation/zone');

			$json = array(
				'country_id'        => $country_info['country_id'],
				'name'              => $country_info['name'],
				'iso_code_2'        => $country_info['iso_code_2'],
				'iso_code_3'        => $country_info['iso_code_3'],
				'address_format'    => $country_info['address_format'],
				'postcode_required' => $country_info['postcode_required'],
				'zone'              => $this->model_localisation_zone->getZonesByCountryId($this->request->get['country_id']),
				'status'            => $country_info['status']
			);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
