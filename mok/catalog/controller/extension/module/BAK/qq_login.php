<?php
class ControllerExtensionModuleQQLogin extends Controller {
	private $error = array();

	public function index() {
		if (!$this->customer->isLogged()) {
			$data['qq_login_url'] = $this->url->link('extension/module/qq_login/login', '', true);

			$this->load->language('extension/module/qq_login');
			
			$data['text_qq_login'] = $this->language->get('text_qq_login');

			if ($this->customer->isLogged()) {
				$data['logged'] = 1;
			} else {
				$data['logged'] = 0;
			}
			if(isset($this->session->data['qq_login_openid'])) {
				$data['qq_login_authorized'] = 1;
			} else {
				$data['qq_login_authorized'] = 0;
			}
			$this->load->helper('mobile');
			if(is_weixin()) {
				$data['is_weixin'] = 1;
				
			}else{
				$data['is_weixin'] = 0;
			}

			
			return $this->load->view('extension/module/qq_login', $data);

		}
	}
	
	public function callback() {
         define('QQ_LOGIN_APPID', $this->config->get('qq_login_appid'));
         define('QQ_LOGIN_APPKEY', $this->config->get('qq_login_appkey'));
         define('QQ_CALLBACK_URI', HTTP_SERVER.'qq');
         require_once(DIR_SYSTEM.'library/qq/qq_sdk.php');
        $qq_sdk = new qq_sdk();
        $token = $qq_sdk->qq_callback($_GET['code']);
        $openid = $qq_sdk->get_open_id($token['access_token']);
        $user_info = $qq_sdk->get_user_info($token['access_token'], $openid['openid']);
         $this->session->data['qq_nickname'] = $user_info['nickname'];
        $this->session->data['qq_image'] = $user_info["figureurl_2"];
         $this->load->language('extension/module/qq_login');
         $data['text_qq_login'] = $this->language->get('text_qq_login');
         if (stristr($openid['openid'], 'error')) {
             echo $this->language->get('error_openid');
         } elseif ($openid) {
             $this->session->data['qq_openid'] = $openid['openid'];
             $this->session->data['qq_login_access_token'] = $token['access_token'];
             if ($this->customer->login_qq($this->session->data['qq_openid'])) {

                 unset($this->session->data['guest']);

                 // Default Addresses
                 $this->load->model('account/address');

                 if ($this->config->get('config_tax_customer') == 'payment') {
                     $this->session->data['payment_address'] = $this->model_account_address->getAddress($this->customer->getAddressId());
                 }

                 if ($this->config->get('config_tax_customer') == 'shipping') {
                     $this->session->data['shipping_address'] = $this->model_account_address->getAddress($this->customer->getAddressId());
                 }

                 $this->response->redirect($this->url->link('account/account', '', 'SSL'));
             }else{

                 $this->session->data['qq_login_warning'] = sprintf($this->language->get('text_qq_login_warning'), $this->config->get('config_name'));

                 $this->response->redirect($this->url->link('account/login', '', 'SSL'));
             }

         }else{
             echo $this->language->get('text_qq_fail');
         }

	
	}
	
	public function login() {
		$qq_login_appid=$this->config->get('qq_login_appid');
        $qq_login_appkey=$this->config->get('qq_login_appkey');
		$qq_callback_back=HTTP_SERVER.'qq';
        $login_url ="https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id=$qq_login_appid&redirect_uri=$qq_callback_back";
        header("Location:$login_url");
	}

}