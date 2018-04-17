<?php
class ControllerExtensionModuleSmsMeilian extends Controller {
    /*发送注册验证码*/
    public function getValidateMessage(){
       $json = array();
        $this->load->language('extension/module/sms_meilian');
       //验证手机号是否已注册
       if(isset($this->request->post['telephone'])){
          $telephone = $this->request->post['telephone'];
      }else{
          $telephone = '';
           $json['error']['telephone'] = $this->language->get('error_telephone_empty');
      }
       //$telephone = '18627812025';

        $this->load->model('account/customer');
      if ($this->model_account_customer->getTotalCustomersByTelephone($telephone) && $telephone!= '') {
          $json['error']['telephone'] = $this->language->get('error_telephone_exist');
      }
      if(!preg_match('/^1[34578][0-9]{9}$/',$telephone)){
          $json['error']['telephone'] = $this->language->get('error_telephone_format');
      }
     //防止恶意点击1小时内同一号码仅5次短信验证机会
        $this->load->model('extension/module/sms_meilian');
        $now_date = time();
        $begin = (int)$now_date - 3600;
        $total_telephone = $this->model_extension_module_sms_meilian->getTotalTelephone($telephone,$begin);
        if($total_telephone > 5){
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

        $total_ip_telephone = $this->model_extension_module_sms_meilian->getTotalTelephoneByIp($ip,$begin);
        if($total_ip_telephone > 10){
            $json['error']['telephone'] = $this->language->get('error_ip_telephone');
        }
        if(empty($json)){
            //发送短信
            $output= $this->getrandchar(4);
            $mobile= $telephone;
            $contentUrlEncode='此次注册华强北商城的验证码为'.$output.'若不是本人，请忽略此信息，谢谢合作';
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
            $this->model_extension_module_sms_meilian->addSecurityCode($security_data);
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
	
	public function create_mobile_code() {
		
		$this->load->language('extension/module/meilian');
		
		$this->load->model('account/smsmobile');
		
		$this->load->model('account/customer');

		$json = array();

		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			if ((utf8_strlen(trim($this->request->post['telephone'])) != 11) || (!is_numeric($this->request->post['telephone']))) {
				$json['error'] = $this->language->get('error_telephone');
			}
			
			// if telephone already registered:
			if ($this->model_account_customer->getTotalCustomersByTelephone($this->request->post['telephone'])) {
				$json['error'] = $this->language->get('error_telephone_registered');
			}

			if (!isset($json['error'])) {
				
				$verify_code = $this->getrandchar(6);
				
				$this->model_account_smsmobile->deleteSmsMobile(trim($this->request->post['telephone']));
				
				$this->model_account_smsmobile->addSmsMobile(trim($this->request->post['telephone']), $verify_code);

				$post_data = array();
				$post_data['account'] = $this->config->get('chuanglan_account');
				$post_data['pswd'] = $this->config->get('chuanglan_password');
				$post_data['mobile'] = trim($this->request->post['telephone']);
				$post_data['msg'] = sprintf($this->language->get('text_content'), $verify_code);
				$post_data['needstatus'] = 'true';
				
				//$url = 'http://222.73.117.156/msg/HttpBatchSendSM';
				//safe url
				$url = 'https://zapi.253.com/msg/HttpBatchSendSM';

				$o = "";
				foreach ($post_data as $k=>$v) {
				   $o.= "$k=".urlencode($v)."&";
				}
				
				$post_data=substr($o,0,-1);
				
				$result = $this->sms_post($post_data, $url);
				
				if ($result == 0) {
					$json['success'] = $this->language->get('text_success');
				} else {
					$json['error'] = $this->language->get('text_error');
				}
			}
		}

		$this->response->setOutput(json_encode($json));
	}

    public function sendSMS($mobile,$contentUrlEncode,$encode)
    {
        //????????????????????apikey?????????????
        $url = "http://m.5c.com.cn/api/send/index.php?";

        $meilian_account = $this->config->get('meilian_account');
        $meilian_password = $this->config->get('meilian_password');
        $meilian_apikey = $this->config->get('meilian_apikey');
        $data=array
        (
            'username'=> $meilian_account,
            'password_md5'=> md5($meilian_password),
            'apikey'=>  $meilian_apikey,
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
        curl_setopt($ch,CURLOPT_URL,$url);//??PHP????URL????????????????????
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);//???curl_setopt?????????????????????????????????????????????????????????????????????????????????????
        curl_setopt($ch,CURLOPT_TIMEOUT,30);//30???????
        curl_setopt($ch,CURLOPT_HEADER,1);//????????????????
        curl_setopt($ch,CURLOPT_POST,1);//???????????????????????post???????application/x-www-from-urlencoded???????????HTTP???????
        curl_setopt($ch,CURLOPT_POSTFIELDS,$post_fields);//post??????????????????????
        $data = curl_exec($ch);//??URL????????????????
        curl_close($ch);//??????
        $res = explode("\r\n\r\n",$data);//explode??????????????
        return $res[2]; //???????????????
    }


}