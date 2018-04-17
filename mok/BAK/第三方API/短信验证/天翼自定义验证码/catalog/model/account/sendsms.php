<?php
class ModelAccountSendsms extends Model{
	public function post($url,$params_array = array(),$header = array(),$getta=0){
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
	
	public function addSecurityCode($data = array()){
		$this->db->query("INSERT INTO " . DB_PREFIX . "security_code SET security_code = '" . $this->db->escape($data['security_code']) . "', user_agent = '" . $this->db->escape($data['user_agent']) . "', ip = '" . $this->db->escape($data['ip']) . "', telephone = '" . $this->db->escape($data['telephone']) . "', res_code = '" . $this->db->escape($data['res_code']) . "', send_status = '" . $this->db->escape($data['send_status']) . "', date_added = '" . $this->db->escape($data['date_added']) . "'");
	}
	
	public function getTotalTelephone($telephone,$begin=0,$end=0){
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "security_code WHERE LOWER(telephone) = '" . $this->db->escape(utf8_strtolower($telephone)) . "'";
		
		if($begin){
		$sql .= " AND unix_timestamp(date_added) > '" . (int)$begin . "'";
		}
		if($end){
		$sql .= " AND unix_timestamp(date_added) < '" . (int)$end ."'";
		}
		
		$sql .= " ORDER BY unix_timestamp(date_added) DESC";
		$query = $this->db->query($sql);
		return $query->row['total'];
	}
	
	public function getdateadded($telephone){
		$query = $this->db->query("SELECT date_added FROM " . DB_PREFIX . "security_code WHERE LOWER(telephone) = '" . $this->db->escape(utf8_strtolower($telephone)) . "'");

		return $query->row['date_added'];
	}
	
	public function getTotalTelephoneByIp($ip,$begin=0,$end=0){
		$sql = "SELECT COUNT(DISTINCT telephone) AS total FROM " . DB_PREFIX . "security_code WHERE LOWER(ip) = '" . $this->db->escape($ip) . "'";
		if($begin){
		$sql .= " AND unix_timestamp(date_added) > '" . (int)$begin . "'";
		}
		if($end){
		$sql .= " AND unix_timestamp(date_added) < '" . (int)$end ."'";
		}
		
		$query = $this->db->query($sql);
		return $query->row['total'];
	}
	
	public function getSecurityCodeByTelephone($telephone){
		$sql = "SELECT security_code FROM " . DB_PREFIX . "security_code WHERE telephone = '" . $this->db->escape($telephone) . "' ORDER BY unix_timestamp(date_added) DESC";
		
		$query = $this->db->query($sql);
		return $query->row['security_code'];
	}
	
	public function editexpiresin($expires_in){
		$sql = "DELETE FROM " . DB_PREFIX . "setting where `code` = 'tianyisms' AND `key` = 'tianyisms_expires_in' AND store_id = '0';";
		$this->db->query($sql);
		$sql = "INSERT INTO " . DB_PREFIX . "setting SET store_id = '0',`code` = 'tianyisms',`key` = 'tianyisms_expires_in',`value` = '" . $this->db->escape($expires_in) ."';";
		$this->db->query($sql);
	}
	
	public function editaccesstoken($accessToken){
		$sql = "DELETE FROM " . DB_PREFIX . "setting where `code` = 'tianyisms' AND `key` = 'tianyisms_access_token' AND store_id = '0';";
		$this->db->query($sql);
		$sql = "INSERT INTO " . DB_PREFIX . "setting SET store_id = '0',`code` = 'tianyisms',`key` = 'tianyisms_access_token',`value` = '" . $this->db->escape($accessToken) ."';";
		$this->db->query($sql);
	}
}

?>