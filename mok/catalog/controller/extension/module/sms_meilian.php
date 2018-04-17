<?php
class ControllerExtensionModuleSmsMeilian extends Controller {
    /*发送注册验证码*/
    public function getValidateMessage(){
        $this->load->language('extension/module/sms_meilian');

        $json = array();

       /* if(!isset($this->request->post['token'])|| ($this->request->post['token'] !== $this->session->data['token'])){
            $json['error']['token'] = $this->language->get('error_token');
        }*/

        if(isset($this->request->request['type'])) {
            $behavior = $this->request->request['type'];
        }else{
            $behavior = 'register';
        }

        $behavior_arr = array('register','forgotten');

        if(!in_array($behavior , $behavior_arr)){
            $json['error']['behavior'] = $this->language->get('error_behavior');
        }


        if(isset($this->request->post['telephone'])){
            $telephone = $this->request->post['telephone'];
        }else{
            $telephone = '';
            $json['error']['telephone'] = $this->language->get('error_telephone_empty');
        }

        if(!preg_match('/^1[34578][0-9]{9}$/',$telephone)){
            $json['error']['telephone'] = $this->language->get('error_telephone_format');
        }

        $this->load->model('account/customer');

        $telephone_is_exist = $this->model_account_customer->getTotalCustomersByTelephone($telephone);

        if($behavior == 'register'){
            if ($telephone_is_exist) {
                $json['error']['telephone'] = $this->language->get('error_telephone_exist');
            }
        }
        if($behavior == 'forgotten'){
            if (!$telephone_is_exist) {
                $json['error']['no_customer'] = $this->language->get('error_no_customer');
            }
        }

     //防止恶意点击1小时内同一号码仅5次短信验证机会
        $this->load->model('extension/module/sms_meilian');
        $now_date = time();
        $begin = (int)$now_date - 3600;
        $total_telephone = $this->model_extension_module_sms_meilian->getTotalTelephone($telephone,$begin,'success',$behavior);
        if($total_telephone > 4){
            $json['error']['telephone'] = $this->language->get('error_telephone_again');
        }
        // 同IP下仅10个手机号码可用
        // ADD sql
        if (isset($this->request->server['HTTP_USER_AGENT'])) {
            $user_agent = $this->request->server['HTTP_USER_AGENT'];
        } else {
            $user_agent = '';
        }
        if (isset($_SERVER['REMOTE_ADDR'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
        } else {
            $ip = '';
        }
        if (isset($_SERVER['HTTP_X_REAL_FORWARDED_FOR']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/',$_SERVER['HTTP_X_REAL_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_REAL_FORWARDED_FOR'];
        }elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/',$_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }elseif (isset($_SERVER['HTTP_CLIENT_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/',$_SERVER['HTTP_CLIENT_IP'])){
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }

        $total_ip_telephone = $this->model_extension_module_sms_meilian->getTotalTelephoneByIp($ip,$begin,$behavior);
        if($total_ip_telephone > 10){
            $json['error']['telephone'] = $this->language->get('error_ip_telephone');
        }
        if(empty($json)){
            //发送短信
            $output= $this->getrandchar(4);
            $mobile= $telephone;
            $contentUrlEncode='【数一数二空间】您的验证码是' . $output;
            $encode='utf-8';
            $res=$this->sendSMS($mobile,$contentUrlEncode,$encode);
            $security_data = array(
                'security_code' => $output,
                'user_agent' => $user_agent,
                'ip' => $ip,
                'telephone' => $mobile,
                'date_added' => $now_date
            );
            $security_data['res_code']=ltrim(strrchr($res,':'),':');
            if (stristr($res, 'success')) {
                $security_data['send_status']='success';
                $json['error']['telephone'] = $this->language->get('error_telephone_status_s');
            }else{
                $security_data['send_status']='error';
                $json['error']['telephone'] = $this->language->get('error_telephone_status');
            }
            $this->model_extension_module_sms_meilian->addSecurityCode($security_data,$behavior);
        }
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }



    /*生成随机验证码*/
	public function getrandchar($len) {
		$chars = array( "0", "1", "2", "3", "4", "5", "6", "7", "8", "9" ); 
		$charslen = count($chars) - 1; 
		shuffle($chars);   
		$output = ""; 
		for ($i=0; $i<$len; $i++) 
		{ 
			$output .= $chars[mt_rand(0, $charslen)]; 
		}
        $this->session->data['validate_message_code'] = $output;
		return $output;
	}

    public function sendSMS($mobile,$contentUrlEncode,$encode)
    {
        $url = "http://m.5c.com.cn/api/send/index.php?";

        $meilian_account = $this->config->get('meilian_account');
        $meilian_password = $this->config->get('meilian_password');
        $meilian_apikey = $this->config->get('meilian_apikey');

        $data=array
        (
            'username'=> 'huaqiangbei',
            'password_md5'=> md5('mlrt888'),
            'apikey'=>  'd960ba07b9e8578dccb05ba0c8696426',
            'mobile'=>$mobile,
            'content'=>$contentUrlEncode,
            'encode'=>$encode,
        );
        $result = $this->curlSMS($url,$data);
        //print_r($data); //????
        return $result;
    }
    public function curlSMS($url,$post_fields=array())
    {
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_TIMEOUT,30);
        curl_setopt($ch,CURLOPT_HEADER,1);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$post_fields);
        $data = curl_exec($ch);
        curl_close($ch);
        $res = explode("\r\n\r\n",$data);
        return $res[2]; 
    }


}