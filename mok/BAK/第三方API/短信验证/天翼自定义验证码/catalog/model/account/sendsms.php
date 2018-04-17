<?php
class ModelAccountSendsms extends Model{
	public function post($url,$params_array = array(),$header = array(),$getta=0){
		$ch = curl_init(); //��ʼ��CURL ץȡ��ҳ POST����
		curl_setopt($ch,CURLOPT_URL,$url); //����URL
		curl_setopt($ch,CURLOPT_POST,1); // POST�ύ��ѯ
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); // curl_exec() ���ת��Ϊ�ַ���,�������������Ļ
		$postdata = '';
		if(!empty($params_array)){
			foreach($params_array as $k=>$v){
				$postdata .= $k.'='.rawurlencode($v).'&';
				// ���ַ���ת�� URL ר�ø�ʽ, rawurlencode,�� urlencode����ȫ
			}
			$postdata = substr($postdata,0,-1);
		}
		curl_setopt($ch,CURLOPT_POSTFIELDS,$postdata);//����POST�ύ���������
		curl_setopt($ch,CURLOPT_HTTPHEADER,$header); //����HTTPͷ��Ϣ
		curl_setopt($ch,CURLOPT_TIMEOUT,15); //��������ʱ
		if($getta){
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);//�������POSTΨһ��ͬ�ĵط�,������SSL����֤
		}
		$response = curl_exec($ch); //ִ��curl�Ự
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