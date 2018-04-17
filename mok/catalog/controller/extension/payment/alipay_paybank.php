<?php

require_once("alipay.php");
require_once("alipay_function.php");
require_once("alipay_notify.php");
require_once("alipay_service.php");
class ControllerExtensionPaymentAlipayPaybank extends Controller {
	
	public function index() {
    	$data['button_confirm'] = $this->language->get('button_confirm');
		$data['button_back'] = $this->language->get('button_back');
		$data['text_loading'] = $this->language->get('text_loading');

		$data['return'] = HTTPS_SERVER . 'index.php?route=checkout/success';

		$data['cancel_return'] = $this->url->link('checkout/checkout', '', true);

		$data['custom'] = $encryption->encrypt($this->session->data['order_id']);

		$data['back'] = $this->url->link('checkout/checkout', '', true);

		$this->load->model('checkout/order');

		$order_id = $this->session->data['order_id'];

		$order_info = $this->model_checkout_order->getOrder($order_id);
		
		$product_name = '';
		if($this->cart->getProducts()){
		$NumProduct = 0;
		foreach ($this->cart->getProducts() as $product) {
			if($NumProduct >= 1) {
				$product_name .= '...等商品';
				break;
			}else{
				$product_name .= $product['name'];
				$NumProduct++;
			}	
		}
		}else{
			$product_name .= $this->config->get('config_name').' Order:' . $order_id ;
		}

		$seller_email = $this->config->get('alipay_seller_email');
		$security_code = $this->config->get('alipay_security_code');
		$trade_type = 'create_direct_pay_by_user';
		$partner = $this->config->get('alipay_partner');
		$currency_code ='CNY';
		$item_name = $product_name;
		$first_name = $order_info['payment_firstname'];
		$last_name = $order_info['payment_lastname'];

		$total = $order_info['total'];

		$currency_value = $this->currency->getValue($currency_code);
		$amount = $total * $currency_value;
		$amount = number_format($amount,2,'.','');

		$_input_charset = "utf-8";
		$sign_type      = "MD5";
		$transport      = "https";
		$notify_url     = HTTP_SERVER . 'catalog/controller/payment/alipay_callback.php';
		$return_url		=HTTPS_SERVER . 'index.php?route=checkout/success';
		$show_url       = "";
		
		if ($this->cart->hasShipping()) {
			$receive_name = $order_info['shipping_firstname'].' '.$order_info['shipping_lastname'];
			$receive_address = $order_info['shipping_city'].' '.$order_info['shipping_address_1'];
			$receive_zip = $order_info['shipping_postcode'];
			$receive_phone = $order_info['telephone'];
		} else {
			$receive_name = $order_info['payment_firstname'] . ' ' . $order_info['payment_lastname'];
			$receive_address = $order_info['payment_city'].' '.$order_info['payment_address_1'];
			$receive_zip = $order_info['payment_postcode'];
			$receive_phone = $order_info['telephone'];
		}

		if($this->session->data['bankcode']){
		$paymethod = 'bankPay';
		$defaultbank = $this->session->data['bankcode'];
		$parameter = array(
			"service"        => $trade_type,
			"partner"        => $partner,
			"return_url"     => $return_url,
			"notify_url"     => $notify_url,
			"_input_charset" => $_input_charset,
			"subject"        => $item_name,
			/* "body"           => 商品描述*/
			"paymethod"	=> $paymethod,
			"defaultbank"	=> $defaultbank,
			"out_trade_no"   => $order_id,
			"price"          => $amount,
			"payment_type"   => "1",
			"quantity"       => "1",
			"logistics_fee"      =>'0.00',
			"logistics_payment"  =>'SELLER_PAY',
			"logistics_type"     =>'EXPRESS',
			"show_url"       => $show_url,
			"seller_email"   => $seller_email,
			"receive_name"	=> $receive_name,
			"receive_address"	=> $receive_address,
			"receive_zip"	=> $receive_zip,
			"receive_phone"	=> $receive_phone,
			"receive_mobile"	=> $receive_phone
		);
		}else{
			$parameter = array(
			"service"        => $trade_type,
			"partner"        => $partner,
			"return_url"     => $return_url,
			"notify_url"     => $notify_url,
			"_input_charset" => $_input_charset,
			"subject"        => $item_name,
			/* "body"           => 商品描述*/
			"out_trade_no"   => $order_id,
			"price"          => $amount,
			"payment_type"   => "1",
			"quantity"       => "1",
			"logistics_fee"      =>'0.00',
			"logistics_payment"  =>'SELLER_PAY',
			"logistics_type"     =>'EXPRESS',
			"show_url"       => $show_url,
			"seller_email"   => $seller_email,
			"receive_name"	=> $receive_name,
			"receive_address"	=> $receive_address,
			"receive_zip"	=> $receive_zip,
			"receive_phone"	=> $receive_phone,
			"receive_mobile"	=> $receive_phone
		);
			
		}

		$alipay = new alipay_service($parameter,$security_code,$sign_type);
		$action=$alipay->build_url();

		$data['action'] = $action;
		$this->id = 'payment';



		return $this->load->view('extension/payment/alipay_paybank', $data);
	}

	public function callback() {
		/*trade_create_by_buyer 双接口 ,create_direct_pay_by_user 直接到帐，create_partner_trade_by_buyer 担保接口 */
		$trade_type = $this->config->get('alipay_trade_type');
		$oder_success = FALSE;
		$this->load->library('encryption');

		$seller_email = $this->config->get('alipay_seller_email');
		$partner = $this->config->get('alipay_partner'); 
		$security_code = $this->config->get('alipay_security_code'); 

		$_input_charset = "utf-8";
		$sign_type = "MD5";
		$transport = 'https';

		$alipay = new alipay_notify($partner,$security_code,$sign_type,$_input_charset,$transport);
		$verify_result = $alipay->notify_verify();
		
		/* get order_status */
		$order_status = array();
		$this->load->model('checkout/order');
		$result_order_status = $this->model_checkout_order->getOrderStatus();
		foreach($result_order_status as $ros){
			$order_status[$ros['name']]= $ros['order_status_id'];
		}
		/* end order_status */

		if($verify_result) {
			$order_id   = $_POST['out_trade_no'];   
			$trade_status=$_POST['trade_status'];
			$this->load->model('checkout/order');
			$order_info = $this->model_checkout_order->getOrder($order_id);

			if ($order_info) {
				$order_status_id = $order_info["order_status_id"];
				/* 是否完成订单 */
				if ($order_status_id != $order_status['Complete']) {
					$currency_code = 'CNY';
					$total = $order_info['total'];
					$currency_value = $this->currency->getValue($currency_code);
					$amount = $total * $currency_value;
					$total  =  $_POST['total_fee'];    
					if($total < $amount){
						$this->model_checkout_order->addOrderHistory($order_id, $order_status['Canceled']);
						echo "success";
					}else{
						if($trade_type=='create_direct_pay_by_user'){
							$this->func_create_direct_pay_by_user($order_id,$order_status_id,$order_status,$trade_status);
							echo "success";
						}
					 }
					}else {
						echo "fail";
					}
			}else{
				echo "fail";
			}
		}
	}
	/* create_direct_pay_by_user 即时到账*/
	private function func_create_direct_pay_by_user($order_id,$order_status_id,$order_status,$trade_status){
			if($trade_status == 'TRADE_FINISHED' ||$trade_status == 'TRADE_SUCCESS') {
				if($this->config->get('alipay_order_status_id')> $order_status_id){
					$this->model_checkout_order->addOrderHistory($order_id, $this->config->get('alipay_order_status_id'));
				}
			}
	}
	
	public function save(){
		if(isset($this->request->post['bankcode'])){
			$this->session->data['bankcode'] = $this->request->post['bankcode'];
		}
		if(isset($this->request->post['banktitle'])){
			$this->session->data['banktitle'] = $this->request->post['banktitle'];
		}
	}
	}

?>