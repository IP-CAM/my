<?php
/**
 * Created by PhpStorm.
 * User: me
 * Date: 2016/12/7
 * Time: 17:34
 */
class ControllerExtensionModuleCoupon extends Controller {
    public function getCoupon(){
        $customer_id=$this->session->data['customer_id'];
        if(!isset($customer_id) || empty($customer_id)){
            $this->response->redirect($this->url->link('account/login', '', 'SSL'));      //未登录
        }
        $this->load->model('account/customer');
        $customer_info = $this->model_account_customer->getCustomer($customer_id);

        $coupon_code = $this->request->post['couponId'];

        $this->load->model('extension/module/coupon');

        $coupon_info=  $this->model_extension_module_coupon->getCouponOne($coupon_code);

       if(!$coupon_info){                                                                             //无此优惠券
            echo "错误！无此优惠券";exit;
        }
       $coupon_max_num = $coupon_info['uses_customer'];
        $coupon_num = $this->model_extension_module_coupon->getCouponNum($coupon_info['coupon_id'],$customer_info['customer_id']);

        if($coupon_num >= $coupon_max_num){
            echo "领取此优惠券已达到上限";exit;
        }

        $flag=  $this->model_extension_module_coupon->CustomerBindCoupon($customer_info ,$coupon_info);

        if($flag){
            echo "领取成功";
        }else{
            echo "领取失败";
        }

    }

}