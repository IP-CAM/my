<?php
class ControllerWeixinReview extends Controller {
	public function index()
    {
        if (!$this->customer->isLogged()) {
            $this->session->data['redirect'] = $this->url->link('weixin/review', '', true);

            $this->response->redirect($this->url->link('account/login', '', true));
        }

        if(!isset($this->request->get['order_id'])){
            $this->response->redirect($this->url->link('account/order', '', true));
        }

        $this->load->model('account/order');

        $this->load->model('catalog/product');

        $this->load->model('tool/image');

        $this->load->language('weixin/review');

        $this->document->setTitle($this->language->get('heading_title'));

        $data['text_have_evaluation'] = $this->language->get('text_have_evaluation');

        $data['text_evaluation_view'] = $this->language->get('text_evaluation_view');

        $review_products = array();

        $orders = $this->model_account_order->getOrderInfo($this->request->get['order_id']);

        if($orders){
            if($orders['order_status_id'] == 5){

                $product_info = $this->model_account_order->getOrderProducts($orders['order_id']);

                foreach($product_info as $v){
                    if(isset($v['is_review'])){

                             $product_detail = $this->model_catalog_product->getProduct($v['product_id']);

                            if ($product_detail['image']) {
                                $image = $this->model_tool_image->resize($product_detail['image'], $this->config->get($this->config->get('config_theme') . '_image_cart_width'), $this->config->get($this->config->get('config_theme') . '_image_cart_height'));
                            } else {
                                $image = '';
                            }

                        $product_options = $this->model_account_order->getOrderOptions($v['order_id'],$v['order_product_id']);

                        $version_str = '';

                        if($product_options){
                            foreach($product_options as $row){
                                $version_str.=$row['value']."&nbsp";
                            }
                        }
                        $product_row = array(
                                'product_id'=> $product_detail['product_id'],
                                'product_name'=> $product_detail['name'],
                                'price'        =>$this->currency->format($this->tax->calculate( $v['price'], $product_detail['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']),
                                'product_image'=> $image,
                                'version'     => $version_str,
                                'is_review'    => $v['is_review'],
                                'product_href' => $this->url->link('product/product', 'product_id=' . $v['product_id'],true),
                                'review_href' => $this->url->link('weixin/review/addReview', 'order_product_id=' . $v['order_product_id'].'&product_id=' . $v['product_id'], true)
                            );
                             $review_products[] = $product_row;

                    }
                }
            }
        }
        $data['review_products']=$review_products;

        $this->document->addStyle('catalog/view/theme/default/css/confirm.css');

        $this->document->addScript('catalog/view/theme/default/script/zepto.min.js','footer');
        $this->document->addScript('catalog/view/theme/default/script/zepto.lazyload.min.js','footer');
        $this->document->addScript('catalog/view/theme/default/script/ok_vedioPlay.js','footer');
        $data['footer'] = $this->load->controller('weixin/footer');

        $data['header'] = $this->load->controller('weixin/header');

        $this->response->setOutput($this->load->view('weixin/evaluate_list', $data));

    }

    public function addReview(){
        if (!$this->customer->isLogged()) {
            $this->session->data['redirect'] = $this->url->link('weixin/review', '', true);

            $this->response->redirect($this->url->link('account/login', '', true));
        }

        $this->load->language('weixin/review');

        $data['text_evaluation_star'] = $this->language->get('text_evaluation_star');

        $data['text_evaluation_word'] = $this->language->get('text_evaluation_word');

        $data['text_evaluation_image'] = $this->language->get('text_evaluation_image');

        $data['text_submit'] = $this->language->get('text_submit');

        $this->document->setTitle($this->language->get('add_heading_title'));

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

            $this->load->model('catalog/review');

            $this->model_catalog_review->addReview($this->request->post['product_id'],$this->request->post);

            //$this->model_catalog_review->addReview($this->request->post['product_id'],$this->request->post);

            $this->response->redirect($this->url->link('account/account', '', true));
        }

        $data['action'] = $this->url->link('weixin/review/addReview', '', true);

        if (isset($this->request->get['order_product_id']) && is_numeric($this->request->get['order_product_id'])){
            $data['order_product_id'] = $this->request->get['order_product_id'];
            $data['product_id'] = $this->request->get['product_id'];
        }else{
            $data['order_product_id'] = '';
            $data['product_id'] = '';
            //跳到错误页面
        }
        $this->document->addStyle('catalog/view/theme/default/css/evaluate.css');

        $this->document->addScript('catalog/view/theme/default/script/zepto.min.js','footer');
        $this->document->addScript('catalog/view/theme/default/script/ok_evaluate.js','footer');


        $data['footer'] = $this->load->controller('weixin/footer');

        $data['header'] = $this->load->controller('weixin/header');

        $this->response->setOutput($this->load->view('weixin/review', $data));




    }

    protected function validate() {
            var_dump($this->request->post);exit;
        if ((utf8_strlen($this->request->post['text']) < 10) || (utf8_strlen($this->request->post['text']) > 3000)) {
            $this->error['enquiry'] = $this->language->get('error_enquiry');
        }

        return !$this->error;
    }

    public function uploadImage(){
        $data = $_FILES;
        //$data1 = urldecode($data);
        var_dump($data);exit;
        // Define a destination
        $this->load->language('api/uploadify');


        $targetFolder = '../resource/images'; // Relative to the root
        $allowSize = 2*1024*1024;
        $fileTypes =  array('jpg' , 'jpeg' , 'png' , 'tiff' , 'bmp'); // File extensions

        if (!empty($_FILES['image'])) {
            $tempFile = $_FILES['image']['tmp_name'];
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
            $fileName = str_replace('.','-'.time().'.',$_FILES['image']['name']);
            $targetFile = rtrim($targetPath,'/') . '/' . $fileName;

            // Validate the file type

            $fileParts = pathinfo($_FILES['image']['name']);

            if($_FILES['image']['size'] > $allowSize){
                echo $this->language->get('error_size');
            }

            if (in_array($fileParts['extension'],$fileTypes)) {
                move_uploaded_file($tempFile,$targetFile);
                echo $fileName;
            } else {
                echo $this->language->get('error_type');
            }
        }
    }
}
