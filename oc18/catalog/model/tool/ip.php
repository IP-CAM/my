<?php
class ModelToolIp extends Model {
	public function getInfo($ip = false) {
		$ip = $ip?$ip:$this->request->server['REMOTE_ADDR'];
		
		//$ip = '104.20.14.19'; // 美国
		//$ip = '61.142.206.227'; // 中国
		//$ip = '27.109.200.154'; // 澳门
		
		$reader = new Geoip();
		
		$info = $reader->get($ip);
		
		if (is_array($info) && !empty($info['iso_code'])) {
			return $info['iso_code'];
		}

		return false;
	}
}