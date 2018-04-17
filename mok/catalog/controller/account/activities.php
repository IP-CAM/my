<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2016/12/22
 * Time: 11:34
 */
class ControllerAccountActivities extends Controller {
    public function index(){
        if (!$this->customer->isLogged()) {
            $this->session->data['redirect'] = $this->url->link('account/wishlist', '', true);

            $this->response->redirect($this->url->link('account/login', '', true));
        }
        $this->load->language('account/activities');

        $this->load->model('weixin/pricing');

        //$this->load->model('weixin/presell');          //预售

        $this->document->setTitle($this->language->get('heading_title'));

        $data['text_my_pricing'] = $this->language->get('text_my_pricing');
        $data['text_my_presell'] = $this->language->get('text_my_presell');
        $data['text_pricing_start'] = $this->language->get('text_pricing_start');
        $data['text_pricing_end'] = $this->language->get('text_pricing_end');
        $data['text_support'] = $this->language->get('text_support');
        $data['text_yuan'] = $this->language->get('text_yuan');
        $data['text_no_activities'] = $this->language->get('text_no_activities');

        $data['continue'] = $this->url->link('account/account', '', true);

        $customer_id = $this->session->data['customer_id'];

        $my_pricings = $this->model_weixin_pricing->getPricingByCustomer($customer_id);

        if($my_pricings){
            foreach($my_pricings as &$row){
               $row['pricing_href'] = $this->url->link('weixin/pricing', 'pricing_id=' . $row['pricing_id'] ,true);
            }
        }
        $data['activities'] = $my_pricings;

        $this->document->addStyle('catalog/view/theme/default/css/price_active.css');

        $this->document->addScript('catalog/view/theme/default/script/zepto.min.js','footer');
        $this->document->addScript('catalog/view/theme/default/script/zepto.lazyload.min.js','footer');
        $this->document->addScript('catalog/view/theme/default/script/ok_vedioPlay.js','footer');


        //页面其余部分
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer'] = $this->load->controller('weixin/footer');
        $data['header'] = $this->load->controller('weixin/header');

        $this->response->setOutput($this->load->view('weixin/activities', $data));

    }



}