<?php  
/**  
* QQ开发平台 SDK  
* 作者：偶尔陶醉  
* blog: www.stutostu.com  
*/ 
 
class Qq_sdk{  
 
    //配置APP参数  
    private $appid     = QQ_LOGIN_APPID;
    private $appkey = QQ_LOGIN_APPKEY;
    private $return_url   =QQ_CALLBACK_URI;
    /*
	function __construct($appid,$appkey,$return_url){  
		$this->appid = $appid;
		$this->appkey = $appkey;
		$this->return_url = $return_url;
    } 
	*/
	function __construct(){}
    /**  
     * [qq_callback  获取access_token]  
     * @param  [string] $code [登陆后返回的$_GET['code']]  
     * @return [array] [expires_in 为有效时间 , access_token 为授权码 ; 失败返回 error , error_description ]  
     */ 
    public function qq_callback($code){
		$keysArr = array(
			"grant_type" => "authorization_code",
			"client_id" => $this->appid,
			"redirect_uri" => urlencode($this->return_url),
			"client_secret" => $this->appkey,
			"code" => $code
		);
		$GET_ACCESS_TOKEN_URL = "https://graph.qq.com/oauth2.0/token";
		$token_url = $this->combineURL($GET_ACCESS_TOKEN_URL,$keysArr);
        $token =  array();  
        parse_str($this->get_contents($token_url), $token);  
        return $token;  
    }  
 
    /**  
     * [get_open_id 获取用户唯一ID，openid]  
     * @param  [string] $token [授权码]  
     * @return [array] [成功返回client_id 和 openid ;失败返回error 和 error_msg]  
     */ 
    public function get_open_id($token){  
		$keysArr = array(
			"access_token" => $token
		);
		$GET_OPENID_URL = "https://graph.qq.com/oauth2.0/me";
		$graph_url = $this->combineURL($GET_OPENID_URL,$keysArr);
		$response = $this->get_contents($graph_url);
		
		 //--------检测错误是否发生
		if(strpos($response, "callback") !== false){
            $lpos = strpos($response, "(");
            $rpos = strrpos($response, ")");
            $response = substr($response, $lpos + 1, $rpos - $lpos -1);
        }

        $user = json_decode($response,true);
        if(isset($user['error'])){
            die($user['error']);
        }
        return $user ;
    }  
 
    /**  
     * [get_user_info 获取用户信息]  
     * @param  [string] $token   [授权码]  
     * @param  [string] $open_id [用户唯一ID]  
     * @return [array]          [ret：返回码，为0时成功。msg为错误信息,正确返回时为空。...params]  
     */ 
    public function get_user_info($token, $open_id) {  
       $keysArr = array(
			"access_token" => $token,
			"oauth_consumer_key" => $this->appid,
			"openid" => $open_id,
			"format" => 'json'
		);
		$USER_INFO_URL = "https://graph.qq.com/user/get_user_info";
		$info_url = $this->combineURL($USER_INFO_URL,$keysArr);
        $info = json_decode($this->get_contents($info_url), TRUE);  
        return $info;  
    }  
    /* url */
    private function get_contents($url){  
        if (ini_get("allow_url_fopen") == "1") {
            $response = file_get_contents($url);
        }else{
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_URL, $url);
            $response =  curl_exec($ch);
            curl_close($ch);
        }

        //-------请求为空
        if(empty($response)){
			die("<h2>可能是服务器无法请求https协议</h2>可能未开启curl支持,请尝试开启curl支持，重启web服务器，如果问题仍未解决，请联系我们");
        }

        return $response;
    }  
	
	private function combineURL($baseURL,$keysArr){
		$combined = $baseURL . "?";
        $valueArr = array();

        foreach($keysArr as $key => $val){
            $valueArr[] = "$key=$val";
        }

        $keyStr = implode("&",$valueArr);
        $combined .= ($keyStr);
        
        return $combined;
	}
 
}  
?>