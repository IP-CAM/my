<?php
class ControllerAccountQqConnect extends Controller{
	private $error = array();
	
	public function index(){
		
		if($this->config->get('qq_connect_status') !=='1'){
			$this->response->redirect($this->url->link('account/login','','SSL'));
		}
		
		$this->language->load('account/qq_connect');
		$this->load->model('account/customer');
		$this->load->model('account/qq_connect');
		
		$open_id = '';$nickname='';$nickimage = '';
		if($this->request->server['REQUEST_METHOD'] == 'GET'){
			if(isset($_REQUEST['code'])){
				
				include_once(DIR_APPLICATION . 'model/account/qq_sdk.php');
				$appid = $this->config->get('qq_connect_appid');
				$appkey = $this->config->get('qq_connect_appkey');
				$return_url = $this->config->get('qq_connect_return_url');
				
				$qq_sdk = new Qq_sdk($appid,$appkey,$return_url);
				$token = $qq_sdk->qq_callback($_REQUEST['code']);
				if(isset($token['access_token'])){
				$open_info = $qq_sdk->get_open_id($token['access_token']);
				$open_id = $open_info['openid'];
				$user_info = $qq_sdk->get_user_info($token['access_token'],$open_id);
				$nickname = $user_info['nickname'];
				$nickimage = $user_info['figureurl_1'];
				if(!isset($this->session->data['qq_nickname'])){
					$this->session->data['qq_nickname'] = $nickname;
				}
				if(!isset($this->session->data['qq_nickimage'])){
					$this->session->data['qq_nickimage'] = $nickimage;
				}
				
				}
				
			}else{
				$this->response->redirect($this->url->link('account/login','','SSL'));	
			}	
		}elseif($this->request->server['REQUEST_METHOD'] == 'POST' && $this->request->post['open_id']){
			$open_id = $this->request->post['open_id'];
			if(isset($this->session->data['qq_nickname'])){
				$nickname = $this->session->data['qq_nickname'];
			}
			if(isset($this->session->data['qq_nickimage'])){
				$nickimage = $this->session->data['qq_nickimage'];
			}
		}else{
			$this->response->redirect($this->url->link('account/login','','SSL'));
		}
		
		if(empty($open_id)){
			$this->response->redirect($this->url->link('account/login','','SSL'));	
		}
		
		if($this->model_account_qq_connect->checkTotalOpenId($open_id)){
			unset($this->session->data['guest']);
			
			$customer_id = $this->model_account_qq_connect->getCustomerIdByopenId($open_id);
			$this->session->data['customer_id'] = $customer_id;
			$this->response->redirect($this->url->link('account/account','','SSL'));
		}
		
		
		$data['heading_title_h1'] = sprintf($this->language->get('heading_title_h1'),$nickname);
		if(isset($this->request->post['bind_email']) && isset($this->request->post['bind_password']) && $this->validate()){
			if($this->customer->isLogged() && !$this->model_account_qq_connect->checkTotalOpenId('',$this->customer->isLogged())){
				$this->model_account_qq_connect->bindCustomer($open_id,$this->customer->isLogged(),$nickname);
				unset($this->session->data['qq_nickname']);
				unset($this->session->data['qq_nickimage']);
				$this->response->redirect($this->url->link('account/connect_success','','SSL'));
			}else{
				$this->customer->logout();
				$this->error['warning'] = $this->language->get('error_open_id');
			}
		}
		
		if(isset($this->request->post['email']) && $this->validate2()){
			
			$this->model_account_qq_connect->addCustomer($this->request->post,$open_id);
			$this->customer->login($this->request->post['email'],$this->request->post['password']);
			$this->model_account_qq_connect->bindCustomer($open_id,$this->customer->isLogged(),$nickname);
			unset($this->session->data['qq_nickname']);
			unset($this->session->data['qq_nickimage']);
			$this->response->redirect($this->url->link('account/connect_success','','SSL'));
		}
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$data['action'] = $this->url->link('account/qq_connect','','SSL');
		
		$language_texts = array('heading_title','entry_binding','entry_create','entry_firstname','entry_telephone','entry_email','entry_password','entry_confirm','button_register','pre_email','pre_password','pre_confirm','pre_firstname','pre_telephone','button_bind');
		foreach($language_texts as $language_text){
			$data[$language_text] = $this->language->get($language_text);
		}
		
		if(isset($this->error['warning'])){
			$data['error_warning'] = $this->error['warning'];
		}else{
			$data['error_warning'] = '';
		}
		
		if(isset($this->error['email'])){
			$data['error_email'] = $this->error['email'];
		}else{
			$data['error_email'] = '';
		}
		
		if(isset($this->error['password'])){
			$data['error_password'] = $this->error['password'];
		}else{
			$data['error_password'] = '';
		}
		
		if(isset($this->error['confirm'])){
			$data['error_confirm'] = $this->error['confirm'];
		}else{
			$data['error_confirm'] = '';
		}
		
		if(isset($this->error['firstname'])){
			$data['error_firstname'] = $this->error['firstname'];
		}else{
			$data['error_firstname'] = '';
		}
		
		if(isset($this->error['telephone'])){
			$data['error_telephone'] = $this->error['telephone'];
		}else{
			$data['error_telephone'] = '';
		}
		
		
		$data['open_id'] = $open_id;
		
		if(isset($this->request->post['firstname'])){
			$data['firstname'] = $this->request->post['firstname'];
		}else{
			$data['firstname'] = '';
		}
		
		if (isset($this->request->post['email'])) {
    		$data['email'] = $this->request->post['email'];
		} else {
			$data['email'] = '';
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
		
		if ($this->request->server['HTTPS']) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}
		if (is_file(DIR_IMAGE . $this->config->get('config_logo'))) {
			$data['logo'] = $server . 'image/' . 'catalog/mall-logo.png';
		} else {
			$data['logo'] = '';
		}
		$data['name'] = $this->config->get('config_name');
		$data['home'] = $this->url->link('common/home');
		$data['text_welcome'] = sprintf($this->language->get('text_welcome'),$nickname);
		$data['nickimage'] = $nickimage;
		$data['text_welcome_description'] = $this->language->get('text_welcome_description');
		$data['entry_bind_email'] = $this->language->get('entry_bind_email');
		/* add */
		if (isset($this->request->post['email'])){
			$data['typesubmit'] = true;
		}else{
			$data['typesubmit'] = false;
		}
		if (isset($this->request->post['bind_email'])) {
    		$data['bind_email'] = $this->request->post['bind_email'];
		} else {
			$data['bind_email'] = '';
		}
		if (isset($this->request->post['bind_password'])) {
    		$data['bind_password'] = $this->request->post['bind_password'];
		} else {
			$data['bind_password'] = '';
		}
		
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/connectfooter');
		$data['header'] = $this->load->controller('common/connectheader');
		
		if(file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/qq_connect.tpl')){
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/account/qq_connect.tpl',$data));
		} else{
			$this->response->setOutput($this->load->view('default/template/account/qq_connect.tpl',$data));
		}
		
	}
	
	public function validate(){
		if($this->request->post['bind_email'] == '' || $this->request->post['bind_password'] == ''){
			$this->error['warning'] = $this->language->get('error_null');
			
		}else{
		
		// Check how many login attempts have been made.
		$login_info = $this->model_account_customer->getLoginAttempts($this->request->post['bind_email']);
				
		if ($login_info && ($login_info['total'] >= $this->config->get('config_login_attempts')) && strtotime('-1 hour') < strtotime($login_info['date_modified'])) {
			$this->error['warning'] = $this->language->get('error_attempts');
		}
		
		// Check if customer has been approved.
		$customer_info = $this->model_account_customer->getCustomerByEmail($this->request->post['bind_email']);

		if ($customer_info && !$customer_info['approved']) {
			$this->error['warning'] = $this->language->get('error_approved');
		}
		
		if (!$this->error) {
			if (!$this->customer->login($this->request->post['bind_email'], $this->request->post['bind_password'])) {
				$this->error['warning'] = $this->language->get('error_login');
			
				$this->model_account_customer->addLoginAttempt($this->request->post['bind_email']);
			} else {
				$this->model_account_customer->deleteLoginAttempts($this->request->post['bind_email']);
			}			
		}
		}
			
		return !$this->error;
	}
	
	public function validate2(){
		if (!preg_match('/^1[3458][0-9]{9}$/', $this->request->post['telephone'])) {
      		$this->error['telephone'] = $this->language->get('error_telephone');
    	}
		
		if ($this->model_account_customer->getTotalCustomersByTelephone($this->request->post['telephone']) && $this->request->post['telephone']!= '') {
			$this->error['telephone'] = $this->language->get('error_telephone_exists');	
		}

    	if ((utf8_strlen(trim($this->request->post['firstname'])) < 1) || (utf8_strlen(trim($this->request->post['firstname'])) > 32)) {
      		$this->error['firstname'] = $this->language->get('error_firstname');
    	}

    	if ($this->request->post['confirm'] != $this->request->post['password']) {
      		$this->error['confirm'] = $this->language->get('error_confirm');
    	}
		
    	if ((utf8_strlen($this->request->post['password']) < 6) || (utf8_strlen($this->request->post['password']) > 20)) {
      		$this->error['password'] = $this->language->get('error_password');
    	}
		
    	if ((utf8_strlen($this->request->post['email']) > 96) || !preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $this->request->post['email'])) {
      		$this->error['email'] = $this->language->get('error_email');
    	}

    	if ($this->model_account_customer->getTotalCustomersByEmail($this->request->post['email']) && $this->request->post['email']!= '') {
      		$this->error['email'] = $this->language->get('error_exists');
    	}
		
		return !$this->error;
	}
	
}

?>