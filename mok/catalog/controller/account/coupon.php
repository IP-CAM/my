<?php
/**
 * Created by PhpStorm.
 * User: me
 * Date: 2016/12/7
 * Time: 17:34
 */
class ControllerAccountCoupon extends Controller {
    public function index(){
        if (!$this->customer->isLogged()) {
            $this->session->data['redirect'] = $this->url->link('account/wishlist', '', true);

            $this->response->redirect($this->url->link('account/login', '', true));
        }
        $this->load->language('account/coupon');
        $this->load->model('account/coupon');

        $this->document->setTitle($this->language->get('heading_title'));

        $data['text_input_info'] = $this->language->get('text_input_info');
        $data['text_search'] = $this->language->get('text_search');
        $data['text_use_directions'] = $this->language->get('text_use_directions');

        $data['text_full'] = $this->language->get('text_full');
        $data['text_minus'] = $this->language->get('text_minus');
        $data['text_valid_time'] = $this->language->get('text_valid_time');
        $data['text_expire'] = $this->language->get('text_expire');

        $data['continue'] = $this->url->link('account/account', '', true);

        $data['heading_title'] = $this->language->get('heading_title');
        $data['button_continue'] = $this->language->get('button_continue');
        $customer_id = $this->customer->getId();

        $coupons =  $this->model_account_coupon->getCouponAll($customer_id);

       foreach($coupons as $k=>&$v){
            $coupon_id = $v['coupon_id'];                                                            //优惠券ID
            $coupons_cate_info =  $this->model_account_coupon->getCouponCateInfo($coupon_id);       //在coupon_category中查找限定的分类若有则找出分类信息
            if($coupons_cate_info){
                $use_conditions_str = '';
                foreach ($coupons_cate_info as $row){
                    $use_conditions_str.=$row['name'].',';
                }
                $use_conditions_str = rtrim($use_conditions_str , ',');
                $v['use_conditions_str'] = $use_conditions_str;
            }else{
                $v['use_conditions_str'] = $this->language->get('text_use_general');
            }

           $coupons_product_info =  $this->model_account_coupon-> getCouponProduct($coupon_id);       //在coupon_category中查找限定的分类若有则找出分类信息
           if($coupons_product_info){
               $use_product_str = '';
               foreach ($coupons_product_info as $row){
                   $use_product_str.=$row['name'].',';
               }
               $use_product_str = rtrim($use_product_str , ',');
               $v['use_product_str'] = $use_product_str;
           }else{
               $v['use_product_str'] = $this->language->get('text_use_general');
           }

           $coupon_info =  $this->model_account_coupon->getCouponOne($v['coupon_code']);

           if($coupon_info){
               $v['date_start'] = $coupon_info['date_start'];
               $v['date_end'] = $coupon_info['date_end'];
               $v['coupon_name'] = $coupon_info['name'];
               $v['discount'] = $coupon_info['discount'];
               $v['price_conditions'] = $coupon_info['total'];
           }else{
               $this->model_account_coupon->deleteBindCoupon($customer_id,$v['coupon_code']);
               unset($coupons[$k]);
           }

       }

        $data['coupons'] = $coupons;

        $this->document->addStyle('catalog/view/theme/default/css/coupons.css');

        $this->document->addScript('catalog/view/theme/default/script/zepto.min.js','footer');
        $this->document->addScript('catalog/view/theme/default/script/zepto.lazyload.min.js','footer');
        $this->document->addScript('catalog/view/theme/default/script/ok_vedioPlay.js','footer');
        $this->document->addScript('catalog/view/theme/default/script/ok_bindCoupon.js','footer');

        //页面其余部分
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer'] = $this->load->controller('weixin/footer');
        $data['header'] = $this->load->controller('weixin/header');

        $this->response->setOutput($this->load->view('weixin/coupon', $data));

    }

    public function getCoupon(){

        if (!$this->customer->isLogged()) {

            echo  json_encode($this->language->get('error_not_logged_in'));exit;
        }

        $this->load->language('account/coupon');

        if(isset($this->request->post['couponId']) && !empty($this->request->post['couponId'])){
            $coupon_code = $this->request->post['couponId'];
        }else{
            echo  json_encode($this->language->get('hint_empty'));exit;
        }

        if(!is_numeric($coupon_code)){
            echo  json_encode($this->language->get('hint_format'));exit;
        }

        $this->load->model('account/coupon');

        $coupon_info=  $this->model_account_coupon->getCouponOne($coupon_code);

       if(empty($coupon_info) || $coupon_info['status']!== "1"){

            echo  json_encode($this->language->get('error_no_this'));exit;
        }

       $coupon_max_num = $coupon_info['uses_customer'];

       $coupon_num = $this->model_account_coupon->getCouponNum($coupon_info['coupon_id'],$this->customer->getId());

        if($coupon_num >= $coupon_max_num){
            echo  json_encode($this->language->get('error_limit'));exit;
        }

        $flag=  $this->model_account_coupon->CustomerBindCoupon($this->customer->getNickname() ,$coupon_info);

        if($flag){
            echo  json_encode($this->language->get('error_success'));exit;
        }else{
            echo  json_encode($this->language->get('error_fail'));exit;
        }

    }

}