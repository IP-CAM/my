<?php 
class ControllerTestTry extends Controller {
	
	public function index() {
		$this->load->model('checkout/order');
		$order_status = $this->model_checkout_order->getOrderStatus();
		foreach($order_status as $os){
			$data['order_status'][$os['name']]= $os['order_status_id'];
		}
		$data['config_complete_status'] = $this->config->get('config_complete_status');
		
		$this->response->setOutput($this->load->view('test/try',$data));
	}
	
}

?>