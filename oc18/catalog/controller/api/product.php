<?php
class ControllerApiProduct extends Controller {
	public function index() {
		
		$json = false;
		
		if($this->request->server['REQUEST_METHOD'] == 'POST'){
			if(isset($this->request->post['id']) && isset($this->request->post['status'])){
				
				if($this->request->post['status'] == 1){
					$status = 1;
				}else{
					$status = 0;
				}
				
				$this->db->query("UPDATE " . DB_PREFIX . "product SET status = '" . $status . "' WHERE product_id = '" . (int)$this->request->post['id'] . "'");
				
				$json = true;
			}
			
			if(isset($this->request->post['id']) && isset($this->request->post['location'])){
				
				$this->db->query("UPDATE " . DB_PREFIX . "product SET location = '" . $this->db->escape($this->request->post['location']) . "' WHERE product_id = '" . (int)$this->request->post['id'] . "'");
				
				$json = true;
			}
			
			
		}
		
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function get_status(){
		$json = false;
		
		if($this->request->server['REQUEST_METHOD'] == 'POST'){
			if(isset($this->request->post['id'])){
				
				$result = $this->db->query("Select status FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$this->request->post['id'] . "'");
				if($result->row){
				$json = $result->row;				
				}else{
				$json = false;	
				}
				
			}
		}
	
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function get_orders(){
		
		$json = false;
		
		if($this->request->server['REQUEST_METHOD'] == 'POST'){
			if(isset($this->request->post['pwd']) && $this->request->post['pwd']=='4EbgrYS@'){
				
				$result = $this->db->query("Select order_id,order_status_id FROM " . DB_PREFIX . "order");
				if($result->rows){
				$json = $result->rows;				
				}else{
				$json = false;	
				}
				
			}
		}
	
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function edit_order(){
		
		$json = false;
		
		if($this->request->server['REQUEST_METHOD'] == 'POST'){
			if(isset($this->request->post['order_id']) && isset($this->request->post['order_status_id']) && isset($this->request->post['pwd']) && $this->request->post['pwd']=='3Hg@fHKz'){
				
				$order_id = (int)$this->request->post['order_id'];
				$order_status_id = (int)$this->request->post['order_status_id'];
				
				$this->load->model('checkout/order');
				$order_info = $this->model_checkout_order->getOrder($order_id);
				
				if(isset($order_info['order_status_id']) && $order_info['order_status_id'] == $order_status_id){
					$json = true;	
				}
				
				if($order_info && $order_info['order_status_id'] != $order_status_id){
					/* $this->model_checkout_order->addOrderHistory($order_id, $order_status_id); */
					
					$this->db->query("UPDATE `" . DB_PREFIX . "order` SET order_status_id = '" . (int)$order_status_id . "', date_modified = NOW() WHERE order_id = '" . (int)$order_id . "'");

					$this->db->query("INSERT INTO " . DB_PREFIX . "order_history SET order_id = '" . (int)$order_id . "', order_status_id = '" . (int)$order_status_id . "', notify = '0', comment = '', date_added = NOW()");
					$json = true;
				}
				
			}
		}
	
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));	
	}
}