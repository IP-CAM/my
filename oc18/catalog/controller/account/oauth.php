<?php
class ControllerAccountOauth extends Controller {
	private $error = array();

	public function index() {
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/oauth', '', 'SSL');

			$this->response->redirect($this->url->link('account/login', '', 'SSL'));
		}

		$this->load->language('account/oauth');

		$this->document->setTitle($this->language->get('heading_title'));

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->load->model('account/customer');

			$this->model_account_customer->editoauth($this->customer->getEmail(), $this->request->post['oauth']);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('account/account', '', 'SSL'));
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),       	
			'separator' => false
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_account'),
			'href'      => $this->url->link('account/account', '', 'SSL'),
			'separator' => $this->language->get('text_separator')
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('account/oauth', '', 'SSL'),
			'separator' => $this->language->get('text_separator')
		);

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_welcome'] = $this->language->get('text_welcome');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['entry_facebook'] = $this->language->get('entry_facebook');
		$data['entry_google'] = $this->language->get('entry_google');
		$data['entry_live'] = $this->language->get('entry_live');

		$data['button_continue'] = $this->language->get('button_continue');
		$data['button_back'] = $this->language->get('button_back');
		$data['button_bind'] = $this->language->get('button_bind');
		$data['button_remove'] = $this->language->get('button_remove');

		$data['action'] = $this->url->link('account/oauth/bind', '', 'SSL');
		$data['back'] = $this->url->link('account/account', '', 'SSL');
		
		$this->load->model('account/oauth');
		
		$oauth_lists = array();
		
		if ($this->config->get('oauth')) {
			foreach ($this->config->get('oauth') as $key => $val) {
				$binded = $this->model_account_oauth->getOauthByType($key);
				
				$oauth_lists[$val['sort']] = array(
					'tag'      => $key,
					'status'   => $val['status'],
					'binded'   => $binded,
					'name'     => $binded?$binded['name']:'',
					'face'     => $binded?$binded['face']:'',
				);
			}
				
			ksort($oauth_lists);
		}
				
		$data['oauth_lists'] = $oauth_lists;

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/oauth.tpl')) {
			$template = $this->load->view($this->config->get('config_template') . '/template/account/oauth.tpl', $data);
		} else {
			$template = $this->load->view('default/template/account/oauth.tpl', $data);
		}
		
		$this->response->setOutput($template);		
	}
	
	// 绑定账户
	public function bind() {
		if (isset($this->request->get['tag'])) {
			$tag = $this->request->get['tag'];
		} else {
			$tag = '';
		}
		
		$tags = array(
			'facebook',
			'google',
			'live',
			'qq',
			'weibo',
			'baidu'
		);
		
		if (empty($tag) || !in_array($tag, $tags) || !$this->config->get('oauth')) {
			$this->response->redirect($this->url->link('common/home', '', 'SSL'));
		}
		
		$oauthInfo = $this->config->get('oauth');
		
		// 检查状态是否开启了
		if (!$oauthInfo[$tag]['status']) {
			$this->response->redirect($this->url->link('common/home', '', 'SSL'));
		}

		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}
		
		$callback  = $server.'v.aspx';
		$state = $tag.'|'.md5('getOauth'.time());
		
		$this->session->data['oauth']['state'] = $state;
		
		$url = $this->getUrl($tag, $oauthInfo[$tag]['client_id'], $callback, $state);
		
		$this->response->redirect($url);
	}
	
	// 取消绑定
	public function remove() {
		if (!$this->customer->isLogged()) {
			$this->response->redirect($this->url->link('account/login', '', 'SSL'));
		}
		
		if (!isset($this->request->get['tag'])) {
			$this->response->redirect($this->url->link('account/oauth', '', 'SSL'));
		}
		
		$this->load->model('account/oauth');
		
		$this->model_account_oauth->deleteOauth($this->request->get['tag']);
	}
	
	// 绑定返回页面
	public function callback() {
		if (!isset($this->request->get['code']) || !isset($this->request->get['state'])) {
			$this->response->redirect($this->url->link('common/home', '', 'SSL'));
		}
		
		if (!isset($this->session->data['oauth']) || $this->session->data['oauth']['state'] != $this->request->get['state']) {
			$this->response->redirect($this->url->link('common/home', '', 'SSL'));
		}

		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}
		
		$tag = explode('|', $this->session->data['oauth']['state']);
		
		$callback  = $server.'v.aspx';
		$tag       = $tag[0];
		$code      = $this->request->get['code'];
		$oauthInfo = $this->config->get('oauth');
		$appid     = $oauthInfo[$tag]['client_id'];
		$appkey    = $oauthInfo[$tag]['client_secret'];
		
		unset($this->session->data['oauth']);
		
		// 获取用户数据
		// array(openid, expires_in, access_token, name, face, email)
		$theRequest = $this->getOpenid($tag, $code, $appid, $appkey, $callback);
		
		//print_r($theRequest);
		$data['success'] = '0';
		$data['tag']     = $tag;
		$data['face']    = '';
		$data['name']    = '';
		$data['msg']     = '';
		
		if (isset($theRequest['error'])) {
			$data['msg']     = $theRequest['error_description'];
		}
		
		if (!isset($theRequest['error']) && !empty($theRequest)) {
			$this->load->model('account/oauth');
			$this->load->model('account/customer');
			
			// 查询OPENID是否已经存在
			$customer_oauth = $this->model_account_oauth->getOauthCustomerIdByOpenid($theRequest['openid'], $tag);
			
			// ------------------ 未登陆状态 ---------------
			if (!$this->customer->isLogged()) {
				if ($customer_oauth && !empty($customer_oauth['customer_id'])) {
					// 取出账户密码进行登陆
					$customer = $this->model_account_customer->getCustomer($customer_oauth['customer_id']);
					
					if ($customer) {
						$this->customer->login($customer['email'], '', true);
						$this->response->redirect($this->url->link('account/account', '', 'SSL'));
					}
				} else {
					$this->session->data['oauth'] = array();
					$this->session->data['oauth'] = $theRequest;
					$this->session->data['oauth']['tag'] = $tag;
					
					$this->response->redirect($this->url->link('account/oauth/login', '', 'SSL'));
				}
			}
			
			// ------------------ 已登陆状态 ---------------
			// OPENID 已经绑定过账户，返回错误信息
			if ($customer_oauth && !empty($customer_oauth['customer_id'])) {
				$data['success'] = '0';
				$data['tag']     = $tag;
				$data['face']    = $theRequest['face'];
				$data['name']    = $theRequest['name'];
				$data['msg']     = $this->language->get('text_error');
			}
			// 登陆状态下，OPENID 已记录，但未绑定有账户
			/*elseif ($customer_oauth && empty($customer_oauth['customer_id'])) {
				// 更新OPENID，绑定登陆的帐户
				$this->model_account_oauth->updateOauth();
				
				$data['success'] = '1';
				$data['tag']     = $tag;
				$data['face']    = $theRequest['face'];
				$data['name']    = $theRequest['name'];
				$data['msg']     = $this->language->get('text_success');
			}*/
			// OPENID 未存在，入库绑定帐户
			else {
				$data_filter = array(
					'openid'       => $theRequest['openid'],
					'type'         => $tag,
					'face'         => $theRequest['face'],
					'name'         => $theRequest['name'],
					'token'        => $theRequest['access_token'],
					'expired'      => $theRequest['expires_in'],
				);
				
				// 记录OPENID，绑定登陆的帐户
				$this->model_account_oauth->addOauth($data_filter);
				
				$data['success'] = '1';
				$data['tag']     = $tag;
				$data['face']    = $theRequest['face'];
				$data['name']    = $theRequest['name'];
				$data['msg']     = $this->language->get('text_success');
			}
		}
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/oauth_callback.tpl')) {
			$template = $this->load->view($this->config->get('config_template') . '/template/account/oauth_callback.tpl', $data);
		} else {
			$template = $this->load->view('default/template/account/oauth_callback.tpl', $data);
		}
		
		$this->response->setOutput($template);	
	}
	
	public function login() {
		if ($this->customer->isLogged()) {
			$this->response->redirect($this->url->link('account/account', '', 'SSL'));
		}
		
		if (empty($this->session->data['oauth'])) {
			$this->response->redirect($this->url->link('account/login', '', 'SSL'));
		}
		
		$info_array = $this->session->data['oauth'];
				
		$data['info'] = $info_array;
		
		$this->load->language('account/oauth');
		
		$this->document->setTitle($this->language->get('heading_login_title'));
		
		$data['breadcrumbs'] = array();

      	$data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
        	'separator' => false
      	);

      	$data['breadcrumbs'][] = array(       	
        	'text'      => $this->language->get('text_account'),
			'href'      => $this->url->link('account/account', '', 'SSL'),
        	'separator' => $this->language->get('text_separator')
      	);

      	$data['breadcrumbs'][] = array(       	
        	'text'      => $this->language->get('heading_login_title'),
			'href'      => $this->url->link('account/oauth/login', '', 'SSL'),
        	'separator' => $this->language->get('text_separator')
      	);
		
    	$data['heading_title'] = $this->language->get('heading_login_title');
		
		// Entry	
    	$data['entry_firstname'] = $this->language->get('entry_firstname');
    	$data['entry_lastname'] = $this->language->get('entry_lastname');
    	$data['entry_email'] = $this->language->get('entry_email');
    	$data['entry_telephone'] = $this->language->get('entry_telephone');
    	$data['entry_fax'] = $this->language->get('entry_fax');
		$data['entry_company'] = $this->language->get('entry_company');
		$data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$data['entry_company_id'] = $this->language->get('entry_company_id');
		$data['entry_tax_id'] = $this->language->get('entry_tax_id');
    	$data['entry_address_1'] = $this->language->get('entry_address_1');
    	$data['entry_address_2'] = $this->language->get('entry_address_2');
    	$data['entry_postcode'] = $this->language->get('entry_postcode');
    	$data['entry_city'] = $this->language->get('entry_city');
    	$data['entry_country'] = $this->language->get('entry_country');
    	$data['entry_zone'] = $this->language->get('entry_zone');
		$data['entry_newsletter'] = $this->language->get('entry_newsletter');
    	$data['entry_password'] = $this->language->get('entry_password');
    	$data['entry_confirm'] = $this->language->get('entry_confirm');
    	$data['entry_type'] = $this->language->get('entry_type');
		
		// Text
    	$data['text_user_hello'] = sprintf($this->language->get('text_user_hello'), $info_array['name']);
    	$data['text_user_tip'] = $this->language->get('text_user_tip');
    	$data['text_bind_info1'] = $this->language->get('text_bind_info1');
    	$data['text_bind_info2'] = $this->language->get('text_bind_info2');
    	$data['text_forgotten'] = $this->language->get('text_forgotten');
		$data['text_your_login'] = $this->language->get('text_your_login');
		$data['text_your_details'] = $this->language->get('text_your_details');
    	$data['text_your_address'] = $this->language->get('text_your_address');
    	$data['text_your_password'] = $this->language->get('text_your_password');
		$data['text_newsletter'] = $this->language->get('text_newsletter');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_none'] = $this->language->get('text_none');
		
		// Button
		$data['button_login'] = $this->language->get('button_login');
		$data['button_register'] = $this->language->get('button_register');
		$data['button_continue'] = $this->language->get('button_continue');
		
		// Link
		$data['forgotten'] = $this->url->link('account/forgotten', '', 'SSL');
		
		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}
		
		// 注册信息 and 登陆信息
		$data['action_register'] = $this->url->link('account/oauth/toregister', '', 'SSL');
		$data['action_login'] = $this->url->link('account/oauth/tologin', '', 'SSL');
		
		// 登陆信息
		if (isset($this->session->data['posts_login'])) {
			$posts_login = $this->session->data['posts_login'];
			unset($this->session->data['posts_login']);
		} else {
			$posts_login = array();
		}
		
		if (isset($this->session->data['error_login'])) {
			$error_login = $this->session->data['error_login'];
			unset($this->session->data['error_login']);
		} else {
			$error_login = '';
		}
		
		if ($error_login) {
			$data['error_login'] = $error_login;
		} else {
			$data['error_login'] = '';
		}
		
		if (isset($posts_login['email'])) {
			$data['login_email'] = $posts_login['email'];
		} else {
			$data['login_email'] = '';
		}

		if (isset($posts_login['password'])) {
			$data['login_password'] = $posts_login['password'];
		} else {
			$data['login_password'] = '';
		}
		
		// 注册信息
		if (isset($this->session->data['posts_register'])) {
			$posts_register = $this->session->data['posts_register'];
			unset($this->session->data['posts_register']);
		} else {
			$posts_register = array();
		}
		
		if (isset($this->session->data['error_register'])) {
			$error_register = $this->session->data['error_register'];
			unset($this->session->data['error_register']);
		} else {
			$error_register = array();
		}
		
		if (isset($error_register['warning'])) {
			$data['error_warning'] = $error_register['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($error_register['firstname'])) {
			$data['error_firstname'] = $error_register['firstname'];
		} else {
			$data['error_firstname'] = '';
		}	
		
		if (isset($error_register['lastname'])) {
			$data['error_lastname'] = $error_register['lastname'];
		} else {
			$data['error_lastname'] = '';
		}		
	
		if (isset($error_register['email'])) {
			$data['error_email'] = $error_register['email'];
		} else {
			$data['error_email'] = '';
		}
		
		if (isset($error_register['password'])) {
			$data['error_password'] = $error_register['password'];
		} else {
			$data['error_password'] = '';
		}
		
		if (isset($error_register['confirm'])) {
			$data['error_confirm'] = $error_register['confirm'];
		} else {
			$data['error_confirm'] = '';
		}
		
		if (isset($error_register['agree'])) {
			$data['error_agree'] = $error_register['agree'];
		} else {
			$data['error_agree'] = '';
		}
		
		$data['action'] = $this->url->link('account/register', '', 'SSL');
		
		if (isset($posts_register['firstname'])) {
			$data['firstname'] = $posts_register['firstname'];
		} else {
			$data['firstname'] = '';
		}

		if (isset($posts_register['lastname'])) {
			$data['lastname'] = $posts_register['lastname'];
		} else {
			$data['lastname'] = '';
		}
		
		if (isset($posts_register['email'])) {
			$data['email'] = $posts_register['email'];
		} else {
			$data['email'] = '';
		}
		
		if (isset($posts_register['password'])) {
			$data['password'] = $posts_register['password'];
		} else {
			$data['password'] = '';
		}
		
		if (isset($posts_register['confirm'])) {
			$data['confirm'] = $posts_register['confirm'];
		} else {
			$data['confirm'] = '';
		}
		
		if (isset($posts_register['newsletter'])) {
			$data['newsletter'] = $posts_register['newsletter'];
		} else {
			$data['newsletter'] = 1;
		}
		
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/oauth_login.tpl')) {
			$template = $this->load->view($this->config->get('config_template') . '/template/account/oauth_login.tpl', $data);
		} else {
			$template = $this->load->view('default/template/account/oauth_login.tpl', $data);
		}
		
		$this->response->setOutput($template);
	}
	
  	public function tologin() {
		$this->load->model('account/customer');
    	$this->load->language('account/oauth');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate_login()) {
			unset($this->session->data['guest']);
			
			// Default Shipping Address
			$this->load->model('account/address');
				
			$address_info = $this->model_account_address->getAddress($this->customer->getAddressId());
									
			if ($address_info) {
				if ($this->config->get('config_tax_customer') == 'shipping') {
					$this->session->data['shipping_country_id'] = $address_info['country_id'];
					$this->session->data['shipping_zone_id'] = $address_info['zone_id'];
					$this->session->data['shipping_postcode'] = $address_info['postcode'];	
				}
				
				if ($this->config->get('config_tax_customer') == 'payment') {
					$this->session->data['payment_country_id'] = $address_info['country_id'];
					$this->session->data['payment_zone_id'] = $address_info['zone_id'];
				}
			} else {
				unset($this->session->data['shipping_country_id']);	
				unset($this->session->data['shipping_zone_id']);	
				unset($this->session->data['shipping_postcode']);
				unset($this->session->data['payment_country_id']);	
				unset($this->session->data['payment_zone_id']);	
			}
			
			$this->load->model('account/oauth');
			
			$data_filter = array(
				'openid'       => $this->session->data['oauth']['openid'],
				'type'         => $this->session->data['oauth']['tag'],
				'face'         => $this->session->data['oauth']['face'],
				'name'         => $this->session->data['oauth']['name'],
				'token'        => $this->session->data['oauth']['access_token'],
				'expired'      => $this->session->data['oauth']['expires_in'],
			);
			
			$this->model_account_oauth->addOauth($data_filter);
		
			unset($this->session->data['oauth']);
			
			$this->response->redirect($this->url->link('account/account', '', 'SSL'));
    	} else {
			$this->session->data['posts_login'] = $this->request->post;
			$this->session->data['error_login'] = $this->error['login'];
	  		$this->response->redirect($this->url->link('account/oauth/login', '', 'SSL'));
		}
	}
	
  	public function toregister() {
		$this->load->model('account/customer');
    	$this->load->language('account/oauth');
		
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate_register()) {
			$post = $this->request->post;
			
			$post['telephone'] = '';
			$post['fax'] = '';
			$post['company'] = '';
			$post['address_1'] = '';
			$post['address_2'] = '';
			$post['city'] = '';
			$post['postcode'] = '';
			$post['country_id'] = '';
			$post['zone_id'] = '';
			$post['newsletter'] = '';
			
			$this->model_account_customer->addCustomer($post);

			$this->customer->login($this->request->post['email'], $this->request->post['password']);
			
			unset($this->session->data['guest']);
			
			// Default Shipping Address
			if ($this->config->get('config_tax_customer') == 'shipping') {
				$this->session->data['shipping_country_id'] = 0;
				$this->session->data['shipping_zone_id'] = 0;
				$this->session->data['shipping_postcode'] = '';				
			}
			
			// Default Payment Address
			if ($this->config->get('config_tax_customer') == 'payment') {
				$this->session->data['payment_country_id'] = 0;
				$this->session->data['payment_zone_id'] = 0;			
			}
			
			$this->load->model('account/oauth');
			
			$data_filter = array(
				'openid'       => $this->session->data['oauth']['openid'],
				'type'         => $this->session->data['oauth']['tag'],
				'face'         => $this->session->data['oauth']['face'],
				'name'         => $this->session->data['oauth']['name'],
				'token'        => $this->session->data['oauth']['access_token'],
				'expired'      => $this->session->data['oauth']['expires_in'],
			);
			
			$this->model_account_oauth->addOauth($data_filter);
		
			unset($this->session->data['oauth']);
							  	  
	  		$this->response->redirect($this->url->link('account/success'));
    	} else {
			$this->session->data['posts_register'] = $this->request->post;
			$this->session->data['error_register'] = $this->error['register'];
	  		$this->response->redirect($this->url->link('account/oauth/login', '', 'SSL'));
		}
	}
	
  	public function loadcss() {
		if (isset($this->request->get['file']) && is_file(DIR_APPLICATION.'view/oauth_css/'.$this->request->get['file'].'.css')) {
			$html = '<link href="catalog/view/oauth_css/'.$this->request->get['file'].'.css" rel="stylesheet" />';
			
			$html = '(function(){function l(){var html=\'' . $html . '\';document.write(html)};try{l()}catch(t){alert(t)}})();';
			
			$this->response->addHeader('Content-type: application/x-javascript');
			$this->response->setOutput($html);
			
		}
	}
	
  	public function account_js() {
		$this->load->language('account/oauth');
		
		$html = '<a href="'.$this->url->link('account/oauth', '', 'SSL').'" class="list-group-item">'.$this->language->get('heading_title').'</a>';
		
		$html = '(function(){function l(){var html=\'' . $html . '\';document.write(html)};try{l()}catch(t){alert(t)}})();';
		
		$this->response->addHeader('Content-type: application/x-javascript');
		$this->response->setOutput($html);
	}
	
  	public function login_js() {
		$html = '';
		
		$oauth_lists = array();
		
		if ($this->config->get('oauth')) {
			foreach ($this->config->get('oauth') as $key => $val) {
				if ($val['status']) {			
					$oauth_lists[$val['sort']] = array(
						'tag'      => $key,
						'status'   => $val['status'],
						'href'     => $this->url->link('account/oauth/bind', 'tag='.$key, 'SSL')
					);
				}
			}
				
			ksort($oauth_lists);
		}
		
		if ($oauth_lists) {
    		$this->load->language('account/oauth');
			
			$html .= '<div class="oauth_box_login">';
			$html .= '<ul>';
			foreach ($oauth_lists as $oauth_list) {
				$html .= '<li class="oauth_li_' . $oauth_list['tag'] . '"><a href="' . $oauth_list['href'] . '" title="' . $oauth_list['tag'] . '">' . $oauth_list['tag'] . '</a></li>';
			}
			$html .= '</ul>';
			$html .= '</div>';
		}
		
		if ($this->customer->isLogged()) {
			$html = '<div class="oauth_login">';
			$html .= $data['text_logged'] = sprintf($this->language->get('text_logged'), $this->url->link('account/account', '', 'SSL'), $this->customer->getFirstName(), $this->url->link('account/logout', '', 'SSL'));
			$html .= '</div>';
		}
		
		if (!$html) {
	  		$this->response->redirect($this->url->link('common/home', '', 'SSL'));
		}
		
		$html = '(function(){function l(){var html=\'' . $html . '\';if(typeof(c)!=\'undefined\'&&c){var css=\'<link rel="stylesheet" type="text/css" href="\'+c+\'" />\';html=css+html}document.write(html)};try{l()}catch(t){alert(t)}})();';
		
		$this->response->addHeader('Content-type: application/x-javascript');
		$this->response->setOutput($html);
	}

	private function getUrl($tag, $appid, $callback, $state) {
		switch ($tag) {
			case 'facebook':
				$host = 'https://graph.facebook.com/oauth/authorize?';
				
				$code = array();
				$code['response_type']   = 'code';
				$code['client_id']       = $appid;
				$code['state']           = $state;
				$code['redirect_uri']    = $callback;
				$code['scope']           = 'email';
				
				$url = $host . http_build_query($code);
				break;
			case 'google':
				$host = 'https://accounts.google.com/o/oauth2/auth?';
				
				$code = array();
				$code['response_type']   = 'code';
				$code['client_id']       = $appid;
				$code['state']           = $state;
				$code['redirect_uri']    = $callback;
				$code['scope']           = 'email profile';
				
				$url = $host . http_build_query($code);
				break;
			case 'live':
				$host  = 'https://login.live.com/oauth20_authorize.srf?';
				
				$code = array();
				$code['response_type']   = 'code';
				$code['client_id']       = $appid;
				$code['state']           = $state;
				$code['redirect_uri']    = $callback;
				$code['scope']           = 'wl.basic wl.emails';
				
				$url = $host . http_build_query($code);
				break;
			case 'qq':
				$host  = 'https://graph.qq.com/oauth2.0/authorize?';
				
				$code = array();
				$code['response_type']   = 'code';
				$code['client_id']       = $appid;
				$code['state']           = $state;
				$code['redirect_uri']    = $callback;
				$code['scope']           = 'get_user_info';
				
				$url = $host . http_build_query($code);
				break;
			case 'weibo':
				$host  = 'https://api.weibo.com/oauth2/authorize?';
				
				$code = array();
				$code['response_type']   = 'code';
				$code['client_id']       = $appid;
				$code['state']           = $state;
				$code['redirect_uri']    = $callback;
				$code['scope']           = '';
				
				$url = $host . http_build_query($code);
				break;
			case 'baidu':
				$host  = 'http://openapi.baidu.com/oauth/2.0/authorize?';
				
				$code = array();
				$code['response_type']   = 'code';
				$code['client_id']       = $appid;
				$code['state']           = $state;
				$code['redirect_uri']    = $callback;
				$code['scope']           = 'basic';
				
				$url = $host . http_build_query($code);
				break;
			default:
				$url = '';
		}
		
		return $url;
	}
	
	private function getOpenid($tag, $code, $appid, $appkey, $callback) {
		switch ($tag) {
			case 'facebook':
				$host = 'https://graph.facebook.com/oauth/access_token?';
		
				$param = array();			
				$param['client_id'] = $appid;
				$param['client_secret'] = $appkey;
				$param['grant_type'] = 'authorization_code';
				$param['code'] = $code;
				$param['redirect_uri'] = $callback;
			
				$url = $host . http_build_query($param);
				
				$info = $this->http($url, 'GET');
				
				if (isset($info['error']) && is_array($info['error'])) {
					$this->log->write('FACEBOOK ERROR: '.$info['error']['type'].' - '.$info['error']['message']);
					
					$data_filter = array(
						'error'               => $info['error']['type'],
						'error_description'   => $info['error']['message']
					);
					break;
				}
				
				$info = explode('&', $info);
				
				$access_token = str_replace('access_token=', '', $info[0]);
				$expires_in = str_replace('expires=', '', $info[1]);
				
				$host = 'https://graph.facebook.com/v2.1/me?';
		
				$param = array();
				$param['fields'] = 'id,name,picture.type(normal),email';
				$param['access_token'] = $access_token;
			
				$url = $host . http_build_query($param);
				
				$user_info = $this->http($url, 'GET');
				
				if (isset($user_info['error'])) {
					$this->log->write('FACEBOOK ERROR: '.$user_info['error']['type'].' - '.$user_info['error']['message']);
					
					$data_filter = array(
						'error'               => $user_info['error']['type'],
						'error_description'   => $user_info['error']['message']
					);
					break;
				}
			
				$data_filter = array(
					'openid'          => $user_info['id'],
					'expires_in'      => $expires_in,
					'access_token'    => $access_token,
					'name'            => $user_info['name'],
					'face'            => $user_info['picture']['data']['url'],
					'email'           => $user_info['email']
				);
				
				break;
			case 'google':
				$host = 'https://accounts.google.com/o/oauth2/token?';
		
				$param = array();			
				$param['client_id'] = $appid;
				$param['client_secret'] = $appkey;
				$param['grant_type'] = 'authorization_code';
				$param['code'] = $code;
				$param['redirect_uri'] = $callback;
			
				$url = $host . http_build_query($param);
				
				$info = $this->http($url, 'POST', http_build_query($param));
				
				if (isset($info['error'])) {
					$this->log->write('GOOGLE ERROR: '.$info['error']['code'].' - '.$info['error']['message']);
					
					$data_filter = array(
						'error'               => $info['error']['code'],
						'error_description'   => $info['error']['message']
					);
					break;
				}
				
				$host = 'https://www.googleapis.com/oauth2/v1/userinfo?access_token='.$info['access_token'];
				
				$user_info = $this->http($host, 'GET');
				
				if (isset($user_info['error'])) {
					$this->log->write('GOOGLE ERROR: '.$user_info['error']['code'].' - '.$user_info['error']['message']);
					
					$data_filter = array(
						'error'               => $user_info['error']['code'],
						'error_description'   => $user_info['error']['message']
					);
					break;
				}
			
				$data_filter = array(
					'openid'          => $user_info['id'],
					'expires_in'      => $info['expires_in'],
					'access_token'    => $info['access_token'],
					'name'            => $user_info['name'],
					'face'            => $user_info['picture'],
					'email'           => $user_info['email']
				);
				
				break;
			case 'live':
				$host = 'https://login.live.com/oauth20_token.srf?';
		
				$param = array();			
				$param['client_id'] = $appid;
				$param['client_secret'] = $appkey;
				$param['grant_type'] = 'authorization_code';
				$param['code'] = $code;
				$param['redirect_uri'] = $callback;
			
				$url = $host . http_build_query($param);
				
				$info = $this->http($url, 'POST', http_build_query($param));
				
				if (isset($info['error'])) {
					$this->log->write('LIVE ERROR: '.$user_info['error']['code'].' - '.$user_info['error']['message']);
					
					$data_filter = array(
						'error'               => $user_info['error']['code'],
						'error_description'   => $user_info['error']['message']
					);
					break;
				}
				
				$host = 'https://apis.live.net/v5.0/me?access_token='.$info['access_token'];
				
				$user_info = $this->http($host, 'GET');
				
				if (isset($user_info['error'])) {
					$this->log->write('LIVE ERROR: '.$user_info['error']['code'].' - '.$user_info['error']['message']);
					
					$data_filter = array(
						'error'               => $user_info['error']['code'],
						'error_description'   => $user_info['error']['message']
					);
					break;
				}
				
				$host = 'https://apis.live.net/v5.0/me/picture?access_token='.$info['access_token'];
				
				$user_picture = $this->http($host, 'GET', '', array(), true);
			
				if (strpos($user_picture, 'Location') !== false) {
					list($header, $body) = explode("\r\n\r\n", $user_picture);
					   
					preg_match("/Location:([^\r\n]*)/i", $header, $matches);
					
					if (isset($matches[1])) {
						$user_picture = $matches[1];
					}
				} else {
					$user_picture = '';
				}
				
				$data_filter = array(
					'openid'          => $user_info['id'],
					'expires_in'      => $info['expires_in'],
					'access_token'    => $info['access_token'],
					'name'            => $user_info['name'],
					'face'            => $user_picture,
					'email'           => $user_info['emails']['preferred']
				);
				
				break;
			case 'qq':
				$host = 'https://graph.qq.com/oauth2.0/token?';
		
				$param = array();			
				$param['client_id'] = $appid;
				$param['client_secret'] = $appkey;
				$param['grant_type'] = 'authorization_code';
				$param['code'] = $code;
				$param['redirect_uri'] = $callback;
			
				$url = $host . http_build_query($param);
				
				$response = $this->http($url, 'GET');
				
				if(strpos($response, "callback") !== false){
					$lpos = strpos($response, "(");
					$rpos = strrpos($response, ")");
					$response  = substr($response, $lpos + 1, $rpos - $lpos -1);
					$msg = json_decode($response, 1);
		
					if(isset($msg['error'])){
						$data_filter = array(
							'error'               => $msg['error'],
							'error_description'   => $msg['error_description']
						);
					
						$this->log->write('QQ ERROR: '.$msg['error'].' - '.$msg['error_description']);
						
						break;
					}
				}
				
				$info          = explode('&', $response);
				$access_token  = str_replace('access_token=', '', $info[0]);
				$expires_in    = str_replace('expires_in=', '', $info[1]);
				$refresh_token = str_replace('refresh_token=', '', $info[2]);
				
				$host = 'https://graph.qq.com/oauth2.0/me?access_token='.$access_token;
				
				$response = $this->http($host, 'GET');
				
				if(strpos($response, "callback") !== false){
					$lpos = strpos($response, "(");
					$rpos = strrpos($response, ")");
					$response  = substr($response, $lpos + 1, $rpos - $lpos -1);
					$msg = json_decode($response, 1);
		
					if(isset($msg['error'])){
						$data_filter = array(
							'error'               => $msg['error'],
							'error_description'   => $msg['error_description']
						);
					
						$this->log->write('QQ ERROR: '.$msg['error'].' - '.$msg['error_description']);
						
						break;
					}
				}
				
				$openid = $msg['openid'];
				
				$host = 'https://graph.qq.com/user/get_user_info?';
		
				$param = array();			
				$param['oauth_consumer_key'] = $appid;
				$param['openid'] = $openid;
				$param['access_token'] = $access_token;
			
				$url = $host . http_build_query($param);
				
				$user_info = $this->http($url, 'GET');
				
				if (isset($user_info['ret']) && $user_info['ret']) {
					$this->log->write('QQ ERROR: '.$user_info['ret'].' - '.$user_info['msg']);
					
					$data_filter = array(
						'error'               => $user_info['ret'],
						'error_description'   => $user_info['msg']
					);
					break;
				}
				
				$data_filter = array(
					'openid'          => $openid,
					'expires_in'      => $expires_in,
					'access_token'    => $access_token,
					'name'            => $user_info['nickname'],
					'face'            => $user_info['figureurl_2'],
					'email'           => ''
				);
				
				break;
			case 'weibo':
				$host = 'https://api.weibo.com/oauth2/access_token?';
		
				$param = array();			
				$param['client_id'] = $appid;
				$param['client_secret'] = $appkey;
				$param['grant_type'] = 'authorization_code';
				$param['code'] = $code;
				$param['redirect_uri'] = $callback;
			
				$url = $host . http_build_query($param);
				
				$info = $this->http($url, 'POST', http_build_query($param));
				
				if (isset($info['error'])) {
					$this->log->write('WEIBO ERROR: '.$info['error'].' - '.$info['error_description']);
					
					$data_filter = array(
						'error'               => $info['error'],
						'error_description'   => $info['error_description']
					);
					break;
				}
				
				$access_token  = $info['access_token'];
				$expires_in    = $info['expires_in'];
				$remind_in     = $info['remind_in'];
				$uid           = $info['uid'];
				
				$host = 'https://api.weibo.com/2/users/show.json?';
				
				$param = array();			
				$param['access_token'] = $access_token;
				$param['uid'] = '33'.$uid;
			
				$url = $host . http_build_query($param);
				
				$user_info = $this->http($url, 'GET');
				
				$this->log->write($url);
				$this->log->write($user_info);
				
				if (isset($user_info['error_code'])) {
					$this->log->write('WEIBO ERROR: '.$user_info['error_code'].' - '.$user_info['error']);
					
					$data_filter = array(
						'error'               => $user_info['error_code'],
						'error_description'   => $user_info['error']
					);
					break;
				}
			
				$data_filter = array(
					'openid'          => $uid,
					'expires_in'      => $expires_in,
					'access_token'    => $access_token,
					'name'            => $user_info['name'],
					'face'            => $user_info['profile_image_url'],
					'email'           => ''
				);
				
				break;
			case 'baidu':
				$host = 'https://openapi.baidu.com/oauth/2.0/token?';
		
				$param = array();			
				$param['client_id'] = $appid;
				$param['client_secret'] = $appkey;
				$param['grant_type'] = 'authorization_code';
				$param['code'] = $code;
				$param['redirect_uri'] = $callback;
			
				$url = $host . http_build_query($param);
				
				$info = $this->http($url, 'POST', http_build_query($param));
				
				if (isset($info['error'])) {
					$this->log->write('BAIDU ERROR: '.$info['error'].' - '.$info['error_description']);
					
					$data_filter = array(
						'error'               => $info['error'],
						'error_description'   => $info['error_description']
					);
					break;
				}
				
				$access_token  = $info['access_token'];
				$expires_in    = $info['expires_in'];
				$refresh_token = $info['refresh_token'];
				
				$host = 'https://openapi.baidu.com/rest/2.0/passport/users/getLoggedInUser?';
		
				$param = array();
				$param['format'] = 'json';
				$param['access_token'] = $access_token;
			
				$url = $host . http_build_query($param);
				
				$user_info = $this->http($url, 'POST', http_build_query($param));
				
				if (isset($user_info['error_code'])) {
					$this->log->write('BAIDU ERROR: '.$user_info['error_code'].' - '.$user_info['error_msg']);
					
					$data_filter = array(
						'error'               => $user_info['error_code'],
						'error_description'   => $user_info['error_msg']
					);
					break;
				}
			
				$data_filter = array(
					'openid'          => $user_info['uid'],
					'expires_in'      => $expires_in,
					'access_token'    => $access_token,
					'name'            => $user_info['uname'],
					'face'            => 'http://tb.himg.baidu.com/sys/portrait/item/'.$user_info['portrait'],
					'email'           => ''
				);
				
				break;
			default:
				$data_filter = array();
		}
		
		return $data_filter;
	}
	
  	protected function validate_login() {		
		if (!$this->error) {
			if (!$this->customer->login($this->request->post['email'], $this->request->post['password'])) {
				$this->error['login'] = $this->language->get('error_login');
			}
		
			$customer_info = $this->model_account_customer->getCustomerByEmail($this->request->post['email']);
			
			if ($customer_info && !$customer_info['approved']) {
				$this->error['login'] = $this->language->get('error_approved');
			}
		}
		
    	if (!$this->error) {
      		return true;
    	} else {
      		return false;
    	}  
	}

  	protected function validate_register() {		
		if (!$this->error) {
			/*if ((utf8_strlen($this->request->post['firstname']) < 1) || (utf8_strlen($this->request->post['firstname']) > 32)) {
				$this->error['register']['firstname'] = $this->language->get('error_firstname');
			}*/
	
			if ((utf8_strlen($this->request->post['lastname']) < 1) || (utf8_strlen($this->request->post['lastname']) > 32)) {
				$this->error['register']['lastname'] = $this->language->get('error_lastname');
			}
	
			if ((utf8_strlen($this->request->post['email']) > 96) || !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['email'])) {
				$this->error['register']['email'] = $this->language->get('error_email');
			}
	
			if ($this->model_account_customer->getTotalCustomersByEmail($this->request->post['email'])) {
				$this->error['register']['email'] = $this->language->get('error_exists');
			}
	
			if ((utf8_strlen($this->request->post['password']) < 4) || (utf8_strlen($this->request->post['password']) > 20)) {
				$this->error['register']['password'] = $this->language->get('error_password');
			}
	
			if ($this->request->post['confirm'] != $this->request->post['password']) {
				$this->error['register']['confirm'] = $this->language->get('error_confirm');
			}
		}
		
    	if (!$this->error) {
      		return true;
    	} else {
      		return false;
    	}
  	}
	
	/**
	 * Make an HTTP request 发送一个HTTP请求
	 *
	 * @return string API results   返回请求字符串数据
	 * @ignore
	 */
	private function http($url, $method = 'GET', $postfields = NULL, $headers = array(), $location = false) {
		$ci=curl_init();
		curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, FALSE); 
		curl_setopt($ci, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ci, CURLOPT_TIMEOUT, 30);
		if($method=='POST'){
			curl_setopt($ci, CURLOPT_POST, TRUE);
			if($postfields!='')curl_setopt($ci, CURLOPT_POSTFIELDS, $postfields);
		}
		$headers[]='User-Agent: Oauth.PHP(65li.com)';
		curl_setopt($ci, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ci, CURLOPT_URL, $url);
		
		if ($location) {
			curl_setopt($ci, CURLOPT_HEADER, 1);
		}
		
		$response=curl_exec($ci);
		curl_close($ci);
		
		if (!$this->is_not_json($response)) {
			return json_decode($response, 1);
		} else {
			return $response;
		}
	}
	
	private function is_not_json($str){  
		return is_null(json_decode($str));
	}
}
?>
