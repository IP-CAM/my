<?php
class ControllerWeixinPricing extends Controller {
    public function index() {
        $this->load->language('weixin/pricing');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('weixin/pricing');

        $this->load->model('catalog/product');

        $this->load->model('tool/image');

        $data = array();

        $data['text_product_info'] = $this->language->get('text_product_info');
        $data['text_join_pricing'] = $this->language->get('text_join_pricing');
        $data['text_pricing'] = $this->language->get('text_pricing');
        $data['text_latest_price'] = $this->language->get('text_latest_price');
        $data['text_placeholder'] = $this->language->get('text_placeholder');

        if(isset($this->request->get['pricing_id'])){
            $data['pricing_info'] = $this->model_weixin_pricing->getPricingInfoById($this->request->get['pricing_id']);          //按活动ID获取活动信息
        }else{
            $data['pricing_info'] = $this->model_weixin_pricing->getPricingInfo();          //最新且启用活动信息
        }

        if(empty($data['pricing_info'])){
           //跳转到错误页面
        }

        if($data['pricing_info']['show_image']){
            $data['show_image'] = $this->model_tool_image->resize($data['pricing_info']['show_image'], 750, 480);

        }else{
            $data['show_image'] = '';
        }

        //$data['pricing_join'] = $this->model_weixin_pricing->getCustomerByPricing($data['pricing_info']['pricing_id']);

        $prcing_join = $this->model_weixin_pricing->getCustomerByPricing($data['pricing_info']['pricing_id']);

        $data['pricing_join'] = array();

        if($prcing_join){

            foreach($prcing_join as $row){

                    $custom_field_arr = json_decode($row['custom_field'] , true);

                     if($custom_field_arr[8]){
                         $head_image = $this->model_tool_image->resize($custom_field_arr[8],58 ,58 );
                     }else{
                         $head_image = $this->model_tool_image->resize('no_image.png',58 ,58 );
                     }

                     if($custom_field_arr[9]){
                         $nickname = $custom_field_arr[9];
                     }else{
                         $nickname = '';
                     }

                $data['pricing_join'][] = array(
                    'price' => $row['price'],
                    'head_image' => $head_image,
                    'nickname' => $nickname,
                );

            }

        }

        $data['product_info'] = $this->model_catalog_product->getProduct($data['pricing_info']['product']);

        $data['product_href'] = $this->url->link('product/product', 'product_id=' .  $data['product_info']['product_id']);

        if ($data['product_info']['image']) {
            $data['product_image'] = $this->model_tool_image->resize($data['product_info']['image'], $this->config->get($this->config->get('config_theme') . '_image_product_width'), $this->config->get($this->config->get('config_theme') . '_image_product_height'));
        } else {
            $data['product_image'] = $this->model_tool_image->resize('placeholder.png', $this->config->get($this->config->get('config_theme') . '_image_product_width'), $this->config->get($this->config->get('config_theme') . '_image_product_height'));
        }

        $this->document->addStyle('catalog/view/theme/default/css/pricing.css');

        $this->document->addScript('catalog/view/theme/default/script/zepto.min.js','footer');
        $this->document->addScript('catalog/view/theme/default/script/zepto.lazyload.min.js','footer');
        $this->document->addScript('catalog/view/theme/default/script/ok_buyer.js','footer');
        

        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');

        $data['footer'] = $this->load->controller('weixin/footer');

        $data['header'] = $this->load->controller('weixin/header');

        $this->response->setOutput($this->load->view('weixin/pricing_info', $data));
    }

    public function add(){
        $this->load->language('weixin/pricing');
        $callback = array();
        if (!$this->customer->isLogged()) {
            $callback['status'] = 2;
            $callback['text'] = $this->language->get('error_not_login');
            echo json_encode($callback);
            exit;
        }

        $customer_id = $this->customer->getId();

        $pricing_id = $this->request->post['pricing_id'];

        $price = $this->request->post['price'];

        if(!is_numeric($price)){
            /*报价格式不正确*/
            $callback['status'] = 2;
            $callback['text'] = $this->language->get('error_not_num');
            echo json_encode($callback);
            exit;
        }

        if ((utf8_strlen($price) < 1) || (utf8_strlen($price) >6)) {
            $callback['status'] = 2;
            $callback['text'] = $this->language->get('error_strlen');
            echo json_encode($callback);
            exit;
        }

        $this->load->model('weixin/pricing');

        $is_pricing = $this->model_weixin_pricing->customerPricing($customer_id,$pricing_id);

        if($is_pricing){
            //已经报名，进行取消
            //$this->model_weixin_pricing->cancelPricing($customer_id,$pricing_id);
            $callback['status'] = 2;
            $callback['text'] = $this->language->get('text_already_offer');
            echo json_encode($callback);
            exit;
        }

        $pricing_res = $this->model_weixin_pricing->addPricing($customer_id ,$pricing_id ,$price);

        if($pricing_res){
            $this->load->model('account/customer');
            $this->load->model('tool/image');
            $customer_info = $this->model_account_customer->getCustomer($customer_id);
            $custom_field = json_decode($customer_info['custom_field'] , true);
            if (isset($custom_field[9]) && $custom_field[9]){
                $callback['nickname'] = $custom_field[9];
            }
            if (isset($custom_field[8]) && $custom_field[8]){
                $callback['head_image'] =  $head_image = $this->model_tool_image->resize($custom_field[8],32 , 32);
            }
            $callback['status'] = 1;
            $callback['text'] = $this->language->get('text_success_pricing');
            echo json_encode($callback);
        }else{
            $callback['status'] = 2;
            $callback['text'] = $this->language->get('text_error_pricing');
            echo json_encode($callback);
        }
    }

}
