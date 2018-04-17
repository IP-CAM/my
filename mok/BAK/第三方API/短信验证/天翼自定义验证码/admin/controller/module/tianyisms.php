<?php 
class ControllerModuleTianyiSms extends Controller{
	private $error = array();
	
	public function index(){
		$this->load->language('module/tianyisms');
		$this->document->setTitle($this->language->get('heading_title'));
		//Saving In Setting OR Saving In Module
		//$this->load->model('extension/module');
		$this->load->model('setting/setting');
		
		
		if(($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()){
			//$this->model_extension_module->addModule('tianyisms',$this->request->post);
			$this->model_setting_setting->editSetting('tianyisms',$this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			//$this->response->redirect($this->url->link('extension/module','token=' . $this->session->data['token'],'SSL'));
		}
		
		$language_texts = array('button_save','button_cancel','heading_title','text_edit','entry_status','text_disabled','text_enabled','entry_tianyisms','entry_api','entry_secret','entry_expire','entry_access_token','entry_get','error_config');
		foreach($language_texts as $language_text){
			$data[$language_text] = $this->language->get($language_text);
		}
		$data['cancel'] = $this->url->link('extension/module','token=' . $this->session->data['token'],'SSL');
		$data['action'] = $this->url->link('module/tianyisms','token=' . $this->session->data['token'],'SSL');
		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home','token=' . $this->session->data['token'],'SSL')
		);
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/module','token=' . $this->session->data['token'],'SSL')
		);
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('module/tianyisms','token=' . $this->session->data['token'],'SSL')
		);
		
		if(isset($this->error['warning'])){
			$data['error_warning'] = $this->error['warning'];
		}else{
			$data['error_warning'] = '';
		}
		
		if(isset($this->error['tianyisms_apiid'])){
			$data['error_tianyisms_apiid'] = $this->error['tianyisms_apiid'];
		}else{
			$data['error_tianyisms_apiid'] = '';
		}
		
		if(isset($this->error['tianyisms_apisecret'])){
			$data['error_tianyisms_apisecret'] = $this->error['tianyisms_apisecret'];
		}else{
			$data['error_tianyisms_apisecret'] = '';
		}

		if(isset($this->request->post['tianyisms_expires_in'])){
			$data['tianyisms_expires_in'] = $this->request->post['tianyisms_expires_in'];
		}else{
			$data['tianyisms_expires_in'] = $this->config->get('tianyisms_expires_in');
		}
		
		if(isset($this->request->post['tianyisms_res_code'])){
			$data['tianyisms_res_code'] = $this->request->post['tianyisms_res_code'];
		}else{
			$data['tianyisms_res_code'] = $this->config->get('tianyisms_res_code');
		}

		if(isset($this->request->post['tianyisms_access_token'])){
			$data['tianyisms_access_token'] = $this->request->post['tianyisms_access_token'];
		}else{
			$data['tianyisms_access_token'] = $this->config->get('tianyisms_access_token');
		}
		
		if(isset($this->request->post['tianyisms_status'])){
			$data['tianyisms_status'] = $this->request->post['tianyisms_status'];
		}else{
			$data['tianyisms_status'] = $this->config->get('tianyisms_status');
		}
		
		if(isset($this->request->post['tianyisms_apiid'])){
			$data['tianyisms_apiid'] = $this->request->post['tianyisms_apiid'];
		}else{
			$data['tianyisms_apiid'] = $this->config->get('tianyisms_apiid');
		}
		
		if(isset($this->request->post['tianyisms_apisecret'])){
			$data['tianyisms_apisecret'] = $this->request->post['tianyisms_apisecret'];
		}else{
			$data['tianyisms_apisecret'] = $this->config->get('tianyisms_apisecret');
		}
		
		$data['token'] = $this->session->data['token'];
		$data['security_code'] = $this->getSecurityCode();

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('module/tianyisms.tpl',$data));

	}
	
	protected function validate() {
		if(!$this->user->hasPermission('modify','module/tianyisms')){
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if($this->request->post['tianyisms_apiid']==''){
			$this->error['tianyisms_apiid'] = $this->language->get('error_tianyisms_apiid');
		}
		
		if($this->request->post['tianyisms_apisecret']==''){
			$this->error['tianyisms_apisecret'] = $this->language->get('error_tianyisms_apisecret');
		}	
		
		return !$this->error;
		
	}
	
	public function getAccessToken(){
		
	$this->load->language('module/tianyisms');
	$json = array();
	/*设置UTF编码*/
	header("Content-type: text/html; charset=utf-8"); 
	/*默认时区设置，避免时间戳误差，本地程序有设置则无须重复设置*/
	function_exists('date_default_timezone_set') && date_default_timezone_set('Etc/GMT-8');
	
	if($this->config->get('tianyisms_apiid')){
	
	$appId = $this->config->get('tianyisms_apiid');
    $appSecret = $this->config->get('tianyisms_apisecret');
	$accessToken = '';
	$accessTokenExpTime = $this->config->get('tianyisms_expires_in');
	$granttype = 'client_credentials';
	$accessTokenUrl = "https://oauth.api.189.cn/emp/oauth2/v3/access_token";
	
	$now = time();
	if($accessTokenExpTime == null || ($now >= strtotime($accessTokenExpTime))){
	$params_array_at = array(
		'grant_type' => $granttype,
		'app_id' => $appId,
		'app_secret' => $appSecret
	);
	ksort($params_array_at);
	$accessTokenJson = json_decode($this->post($accessTokenUrl,$params_array_at,array(),1),true);
	$accessToken = $accessTokenJson['access_token'];
	$res_code = $accessTokenJson['res_code'];
	$expires_in = date('Y-m-d H:i:s',$now + $accessTokenJson['expires_in']);
	}else{
	$accessToken = $this->config->get('tianyisms_access_token');
	$res_code = $this->config->get('tianyisms_res_code');
	$expires_in = $this->config->get('tianyisms_expires_in');	
	}

	$json['tianyisms_res_code'] = $res_code;
	$json['tianyisms_access_token'] = $accessToken;
	$json['tianyisms_expires_in'] = $expires_in;
	}else{
		$json['tianyisms_res_code'] = $this->language->get('error_config');
	}
	
	
	$this->response->addHeader('Content-Type: application/json');
	$this->response->setOutput(json_encode($json));
	
	}
	
	private function post($url,$params_array = array(),$header = array(),$getta=0){
		$ch = curl_init(); //初始化CURL 抓取网页 POST数据
		curl_setopt($ch,CURLOPT_URL,$url); //请求URL
		curl_setopt($ch,CURLOPT_POST,1); // POST提交查询
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); // curl_exec() 结果转化为字符串,而不是输出到屏幕
		$postdata = '';
		if(!empty($params_array)){
			foreach($params_array as $k=>$v){
				$postdata .= $k.'='.rawurlencode($v).'&';
				// 将字符串转成 URL 专用格式, rawurlencode,比 urlencode更安全
			}
			$postdata = substr($postdata,0,-1);
		}
		curl_setopt($ch,CURLOPT_POSTFIELDS,$postdata);//设置POST提交的请求参数
		curl_setopt($ch,CURLOPT_HTTPHEADER,$header); //设置HTTP头信息
		curl_setopt($ch,CURLOPT_TIMEOUT,15); //设置请求超时
		if($getta){
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);//跟上面的POST唯一不同的地方,不进行SSL的验证
		}
		$response = curl_exec($ch); //执行curl会话
		curl_close($ch);

		return $response;	
		
	}
	
	private function getSecurityCode(){
		$sql = "SELECT * FROM " . DB_PREFIX . "security_code ORDER BY security_code_id DESC";
		$query = $this->db->query($sql);
		
		if($query->rows){
		$results = $query->rows;
		
		}else{
		$results = null;
		}
		return $results;
	}
}

?>