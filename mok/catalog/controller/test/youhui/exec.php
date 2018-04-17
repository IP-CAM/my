<?php
/**
 * Created by PhpStorm.
 * User: me
 * Date: 2016/12/7
 * Time: 17:34
 */
class ControllerTestYouhuiExec extends Controller {
    public function get(){
      $customer_id=$this->session->data['customer_id'];
      if(!isset($customer_id) || empty($customer_id)){
          $this->response->redirect($this->url->link('account/login', '', 'SSL'));      //未登录
      }

       $num = $this->request->post['couponId'];

        $this->load->model('/product');


    }

}