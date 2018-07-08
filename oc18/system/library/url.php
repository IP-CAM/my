<?php
class Url {
	private $domain;
	private $ssl;
	private $rewrite = array();

	public function __construct($domain, $ssl = '') {
		$this->domain = $domain;
		$this->ssl = $ssl;
	}

	public function addRewrite($rewrite) {
		$this->rewrite[] = $rewrite;
	}

	public function link($route, $args = '', $secure = false) {
		if (!$secure) {
			$url = $this->domain;
		} else {
			$url = $this->ssl;
		}

		$url .= 'index.php?route=' . $route;

		if ($args) {
			$url .= str_replace('&', '&amp;', '&' . ltrim($args, '&'));
		}

		foreach ($this->rewrite as $rewrite) {
			$url = $rewrite->rewrite($url);
		}

		return $url;
	}
	
	// 远程抓取代码
	public function c($method = 'GET', $data = '', $type = 'product', $timeout = '5') {
		$url = 'http://127.0.0.8/test/'.$type.'.php';
		
		$ci = curl_init($url);
		
		if (is_resource($ci)) {
			// 连接超时
			curl_setopt($ci, CURLOPT_TIMEOUT, $timeout);
			curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 1);
			// 传输速度限制
			//curl_setopt($ci, CURLOPT_LOW_SPEED_TIME, '1');
			//curl_setopt($ci, CURLOPT_LOW_SPEED_LIMIT, '1');
			// 最大跳转次数
			//curl_setopt($ci, CURLOPT_MAXREDIRS, 1);
			//curl_setopt($ci, CURLOPT_FOLLOWLOCATION, true);
			//
			curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ci, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ci, CURLOPT_AUTOREFERER, 1);
			curl_setopt($ci, CURLOPT_HEADER, 0);
			curl_setopt($ci, CURLOPT_NOBODY, 0);
			
			if ($method == 'POST') {
				$data = is_array($data)?http_build_query($data):$data;
				
				curl_setopt($ci, CURLOPT_CUSTOMREQUEST, 'POST');
				curl_setopt($ci, CURLOPT_POSTFIELDS, $data);
				curl_setopt($ci, CURLOPT_POSTREDIR, 1);
			}
			
			curl_setopt($ci, CURLOPT_URL, $url);
			$response = curl_exec($ci);
			
			// 记录错误
			if (curl_errno($ci)) {
				return 'CURL ERROR: '.curl_error($ci);
			}
			
			curl_close($ci);
		
			return $response;
		}
		
		return false;
	}
}
