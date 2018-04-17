<?php 
class ControllerTestTry extends Controller {
	
	public function index() {
		//$this->load->model('checkout/order');
		
		/* order_status */
		/*$order_status = $this->model_checkout_order->getOrderStatus();
		foreach($order_status as $os){
			$data['order_status'][$os['name']]= $os['order_status_id'];
		}
		$data['config_complete_status'] = $this->config->get('config_complete_status');
		
		$tel = '1554654646';
		$tel1 = (int)$tel;
		$data['tel'] = $tel1;
		
		/* address default */
		/*$this->load->model('test/try');
		$count = $this->model_test_try->addAddressDefault(25);
		$data['count'] = $count;
		
		/* d_quickcheckout and city district */
		//$this->load->model('localisation/zone');
		//$this->load->model('localisation/city');

        $this->load->model('account/wishlist_ext');
        if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
            $res = $this->model_account_wishlist_ext->addWishlist($this->request->post['product_id']);exit;

        }

       $res =  $this->model_account_wishlist_ext->getTotalWishlist();
        //$res = $this->model_account_wishlist_ext->getTotalWishlist();
        //var_dump($res);exit;

        $this->response->setOutput($this->load->view('test/wishlist',$data=array()));
	}
	
}

?>