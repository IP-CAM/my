<?php 
class ModelExtensionPaymentAlipay extends Model {
  	public function getMethod($address, $total) {
		$this->load->language('extension/payment/alipay');

		
		
		if ($this->session->data['currency'] == 'CNY') {
			$status = true;
		}else{
			$status = false;
		}
		

		$method_data = array();
	
		if ($status) {  
      		$method_data = array( 
        		'code'         => 'alipay',
        		'title'      => $this->language->get('text_title'),
				'image' => $this->language->get('text_image'),
				'terms'		 => '',
				'sort_order' => $this->config->get('alipay_sort_order')
      		);
    	}
	
    	return $method_data;
  	}
}
?>