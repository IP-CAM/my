<?php
class ControllerAccountQuickRegister extends Controller {
	private $error = array();

	public function index() {
		if ($this->customer->isLogged()) {
			$this->response->redirect($this->url->link('account/account', '', true));
		}
        //weixin
        if(isset($this->session->data['weixin_login_openid']) &&  isset($this->session->data['weixin_login_unionid'])){
            $weixin_login_unionid = $this->session->data['weixin_login_unionid'];
            $weixin_login_openid = $this->session->data['weixin_login_openid'];
        }elseif(isset($this->session->data['weixin_pclogin_openid']) &&  isset($this->session->data['weixin_pclogin_unionid'])){
            $weixin_login_unionid = $this->session->data['weixin_pclogin_unionid'];
            $weixin_login_openid = $this->session->data['weixin_pclogin_openid'];
        }else{
            $weixin_login_unionid = '';
            $weixin_login_openid = '';
        }

        //weibo
        if(isset($this->session->data['weibo_login_access_token']) &&  isset($this->session->data['weibo_login_uid'])) {
            $weibo_login_uid = $this->session->data['weibo_login_uid'];
            $weibo_login_access_token = $this->session->data['weibo_login_access_token'];
        }else{
            $weibo_login_uid = '';
            $weibo_login_access_token = '';
        }

        //qq
        if(isset($this->session->data['qq_openid'])) {
            $qq_openid = $this->session->data['qq_openid'];
        }else{
            $qq_openid = '';
        }

		$this->load->language('account/quick_register');
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->document->addStyle('catalog/view/theme/default/css/register.css');
		$this->document->addScript('catalog/view/theme/default/script/zepto.min.js','footer');
		$this->document->addScript('catalog/view/theme/default/script/ok_register.js','footer');
		
		
		
		$this->load->model('account/quick_register');
		$this->load->model('account/customer');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

		    $head_image_arr = array('default_boy_01.png','default_boy_02.png','default_girl_01.png','default_girl_02.png');

            $default_head_image = array_rand($head_image_arr);

            $this->request->post['custom_field']['account'][8] ='default_head_image/'.$head_image_arr[$default_head_image];

			$customer_id = $this->model_account_quick_register->addCustomer($this->request->post);

            if($weibo_login_access_token && $weibo_login_uid) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "weibo_connect SET customer_id = '" .(int)$customer_id. "', weibo_uid = '" .$this->session->data['weibo_login_uid'] . "',nickname='".$this->session->data['weibo_nickname']."',image='".$this->session->data['weibo_image']."',access_token='".$this->session->data['weibo_login_access_token']."'");

            }

            if($qq_openid) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "qq_connect SET customer_id = '" .(int)$customer_id. "', open_id = '" .$this->session->data['qq_openid'] . "',nickname='".$this->session->data['qq_nickname']."',image='".$this->session->data['qq_image']."',access_token='".$this->session->data['qq_login_access_token']."'");
            }

			// Clear any previous login attempts for unregistered accounts.
			$this->model_account_customer->deleteLoginAttempts($this->request->post['telephone']);

			$this->customer->login($this->request->post['telephone'], $this->request->post['password']);

			unset($this->session->data['guest']);
            //Unset Third party login session
            unset($this->session->data['qq_login_warning']);
            unset($this->session->data['weibo_login_warning']);
            unset($this->session->data['weixin_login_warning']);
            unset($this->session->data['qq_nickname']);

			// Add to activity log
			if ($this->config->get('config_customer_activity')) {
				$this->load->model('account/activity');

				$activity_data = array(
					'customer_id' => $customer_id,
					'telephone'        => $this->request->post['telephone']
				);

				$this->model_account_activity->addActivity('register', $activity_data);
			}
			
			$this->response->redirect($this->url->link('account/success'));
		}
		
		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_account_already'] = $this->language->get('text_account_already');
		$data['entry_telephone'] = $this->language->get('entry_telephone');
		$data['text_your_details'] = $this->language->get('text_your_details');
		$data['entry_password'] = $this->language->get('entry_password');
		$data['entry_confirm'] = $this->language->get('entry_confirm');
		$data['entry_telephone_captcha'] = $this->language->get('entry_telephone_captcha');
		$data['button_continue'] = $this->language->get('button_continue');
		$data['entry_telephone_placeholder'] = $this->language->get('entry_telephone_placeholder');
		$data['entry_password_placeholder'] = $this->language->get('entry_password_placeholder');
		$data['entry_confirm_placeholder'] = $this->language->get('entry_confirm_placeholder');
		$data['entry_telephone_captcha_placeholder'] = $this->language->get('entry_telephone_captcha_placeholder');
		$data['text_description'] = $this->language->get('text_description');
		$data['entry_captcha'] = $this->language->get('entry_captcha');
		$data['text_quick_register'] = $this->language->get('text_quick_register');
		
		$data['action'] = $this->url->link('account/quick_register','',true); 
		
		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_account'),
			'href' => $this->url->link('account/account', '', true)
		);
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_quick_register'),
			'href' => $this->url->link('account/quick_register', '', true)
		);
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		if (isset($this->error['telephone'])) {
			$data['error_warning'] = $this->error['telephone'];
		} 
		if (isset($this->error['password'])) {
			$data['error_warning'] = $this->error['password'];
		} 
		if (isset($this->error['confirm'])) {
			$data['error_warning'] = $this->error['confirm'];
		}
		if (isset($this->error['telephone_captcha'])) {
			$data['error_warning'] = $this->error['telephone_captcha'];
		} 
		if (isset($this->error['telephone_exists'])) {
			$data['error_warning'] = $this->error['telephone_exists'];
		}

		
		
		if (isset($this->request->post['telephone'])) {
			$data['telephone'] = $this->request->post['telephone'];
		} else {
			$data['telephone'] = '';
		}
		if (isset($this->request->post['password'])) {
			$data['password'] = $this->request->post['password'];
		} else {
			$data['password'] = '';
		}
		if (isset($this->request->post['confirm'])) {
			$data['confirm'] = $this->request->post['confirm'];
		} else {
			$data['confirm'] = '';
		}
		if (isset($this->request->post['agree'])) {
			$data['agree'] = $this->request->post['agree'];
		} else {
			$data['agree'] = false;
		}
		if (isset($this->request->post['telephone_captcha'])) {
			$data['telephone_captcha'] = $this->request->post['telephone_captcha'];
		} else {
			$data['telephone_captcha'] = '';
		}
		
		if ($this->config->get('config_account_id')) {
			$this->load->model('catalog/information');

			$information_info = $this->model_catalog_information->getInformation($this->config->get('config_account_id'));

			if ($information_info) {
				$data['text_agree'] = sprintf($this->language->get('text_agree'), $this->url->link('information/information/agree', 'information_id=' . $this->config->get('config_account_id'), true), $information_info['title'], $information_info['title']);
			} else {
				$data['text_agree'] = '';
			}
		} else {
			$data['text_agree'] = '';
		}
		
		

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('weixin/footer');
		$data['header'] = $this->load->controller('weixin/header');

		$this->response->setOutput($this->load->view('account/quick_register', $data));
	}

	private function validate() {

		if(isset($this->request->post['telephone_captcha']) && !empty($this->request->post['telephone_captcha'])){
            $this->load->model('extension/module/sms_meilian');
            $getSecurityCode = $this->model_extension_module_sms_meilian->getSecurityCode($this->request->post['telephone'],'register');
            if($getSecurityCode){
                if($this->request->post['telephone_captcha']!==$getSecurityCode['security_code']){
                    $this->error['telephone_captcha'] = $this->language->get('error_telephone_captcha');
                }
            }else{
                $this->error['telephone_captcha'] = $this->language->get('error_telephone_captcha');
            }
        }else{
			$this->error['telephone_captcha'] = $this->language->get('error_telephone_captcha_null');
		}
		if ((utf8_strlen($this->request->post['password']) < 6) || (utf8_strlen($this->request->post['password']) > 20)) {
			$this->error['password'] = $this->language->get('error_password');
		}

		if ($this->config->get('config_account_id')) {
			$this->load->model('catalog/information');

			$information_info = $this->model_catalog_information->getInformation($this->config->get('config_account_id'));

			if ($information_info && !isset($this->request->post['agree'])) {
				$this->error['warning'] = sprintf($this->language->get('error_agree'), $information_info['title']);
			}
		}
		/* 手机号码验证 */
		if (!preg_match('/^1[34578][0-9]{9}$/', $this->request->post['telephone'])) {
			$this->error['telephone'] = $this->language->get('error_telephone');
		}
		
		if ($this->model_account_quick_register->getTotalCustomersByTelephone($this->request->post['telephone']) && $this->request->post['telephone']!= '') {
			$this->error['telephone_exists'] = $this->language->get('error_telephone_exists');	
		}
		/* 手机验证码验证与防御 */

		return !$this->error;
	}
}