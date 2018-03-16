<?php 
class ModelExtensionPaymentAlipayPaybank extends Model {
  	public function getMethod($address) {
		$this->load->language('extension/payment/alipay');
		
		
		if ($this->session->data['currency'] == 'CNY') {
			$status = true;
		} else{
			$status = false;
		}
		
		$method_data = array();
		
		if ($status) {  
      		$method_data = array( 
        		'code'         => 'alipay_paybank',
        		'title'      => $this->language->get('text_paybank'),
				'terms'		 => '',
				'sort_order' => $this->config->get('alipay_sort_order')+1
      		);
    	}

    	return $method_data;
  	}
}
?>