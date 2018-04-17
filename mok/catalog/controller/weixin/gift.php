<?php
class ControllerWeixinGift extends Controller {
	public function index()
    {
        $this->load->language('weixin/gift');

        $this->document->setTitle($this->language->get('heading_title'));



        $this->document->addStyle('catalog/view/theme/default/css/confirm.css');

        $this->document->addScript('catalog/view/theme/default/script/zepto.min.js','footer');
        $this->document->addScript('catalog/view/theme/default/script/zepto.lazyload.min.js','footer');
        $this->document->addScript('catalog/view/theme/default/script/ok_vedioPlay.js','footer');
        $data['footer'] = $this->load->controller('weixin/footer');

        $data['header'] = $this->load->controller('weixin/header');

        $this->response->setOutput($this->load->view('weixin/evaluate_list', $data));

    }

    public function getGift(){
        if (!$this->customer->isLogged()) {
            $this->session->data['redirect'] = $this->url->link('weixin/gift', '', true);

            $this->response->redirect($this->url->link('account/login', '', true));
        }

        //是否有完成的订单
        $this->load->model('weixin/gift');

        $this->load->language('weixin/gift');

        $orders = $this->model_weixin_gift->getTotalDoneOrders();

        if($orders){
            foreach($orders as $row){
                if($row['order_status_id']!==0){
                    echo  json_encode($this->language->get('not_new_customer'));
                    exit;
                }
            }
        }

        $is_exist = $this->model_weixin_gift->getGiftIsExist();

        if($is_exist!=="0"){
            echo  json_encode($this->language->get('have_to_receive'));
            exit;
        }

        $this->load->model('account/coupon');

        $gift_coupons = array(111111111);

        $customer_coupons_ids = array();

        foreach($gift_coupons as $v){
            $coupon_info=  $this->model_account_coupon->getCouponOne($v);

            if(!$coupon_info || $coupon_info['status']!=="1"){
                foreach ($customer_coupons_ids as $row){
                    $this->model_account_coupon->deleteBindCoupon($this->customer->getId(),$row);
                }
                echo  json_encode($this->language->get('get_gift_error'));exit;
            }

            $customer_coupons_id = $this->model_account_coupon->CustomerBindCoupon($this->customer->getNickname() ,$coupon_info);
            $customer_coupons_ids[] = $customer_coupons_id;

        }

        $this->model_weixin_gift->getGift($this->customer->getNickname(),json_encode($customer_coupons_ids));
        echo  json_encode($this->language->get('get_gift_success'));exit;
    }


}
