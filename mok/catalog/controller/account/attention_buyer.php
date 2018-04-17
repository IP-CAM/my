<?php
class ControllerAccountAttentionBuyer extends Controller {
    public function index() {
        if (!$this->customer->isLogged()) {
            $this->session->data['redirect'] = $this->url->link('account/attention_buyer', '', true);

            $this->response->redirect($this->url->link('account/login', '', true));
        }

       $this->load->language('account/attention_buyer');

        $this->load->model('account/attention_buyer');

        $this->load->model('extension/module/buyer');

        $this->load->model('tool/image');

        if (isset($this->request->get['remove'])) {
            // Remove Attention
            $this->model_account_attention_buyer->deleteAttentionBuyer($this->request->get['remove']);

            $this->session->data['success'] = $this->language->get('text_remove');

            $this->response->redirect($this->url->link('account/attention_buyer'));
        }

        $this->document->setTitle($this->language->get('heading_title'));

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_empty'] = $this->language->get('text_empty');
        $data['text_manufacturer'] = $this->language->get('text_manufacturer');
        $data['text_buyer'] = $this->language->get('text_buyer');

        $data['manufacturer_href'] = $this->url->link('account/attention_manufacturer', '', true);
        $data['buyer_href'] = $this->url->link('account/attention_buyer', '', true);

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        $data['buyers'] = array();

        $results = $this->model_account_attention_buyer->getAttentionBuyers();

        if($results) {
            foreach ($results as $result) {

                $buyer_info = $this->model_extension_module_buyer->getBuyerInfo($result);

                if ($buyer_info) {


                     if ($buyer_info['head_image']) {
                         $head_image = $this->model_tool_image->resize($buyer_info['head_image'],94 , 94);
                     } else {
                         $head_image = false;
                     }

                    $data['buyers'][] = array(
                        'buyer_id' => $buyer_info['user_id'],
                         'thumb'            => $head_image,
                        'nickname' => $buyer_info['nickname'],
                        'href' => $this->url->link('weixin/buyer', 'buyer_id=' . $buyer_info['user_id']),
                        'remove' => $this->url->link('account/attention_buyer', 'remove=' . $buyer_info['user_id'])
                    );
                } else {
                    $this->model_account_attention_buyer->deleteAttentionBuyer($result);
                }
            }
        }
        $this->document->addStyle('catalog/view/theme/default/css/focus_list.css');

        $this->document->addScript('catalog/view/theme/default/script/zepto.min.js','footer');
        $this->document->addScript('catalog/view/theme/default/script/zepto.lazyload.min.js','footer');
        $this->document->addScript('catalog/view/theme/default/script/ok_contentCollect.js','footer');


        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer'] = $this->load->controller('weixin/footer');
        $data['header'] = $this->load->controller('weixin/header');

        $this->response->setOutput($this->load->view('weixin/attention_buyer', $data));
    }

    public function add() {

        $json = array();

        if (isset($this->request->post['buyer_id'])) {
            $buyer_id = $this->request->post['buyer_id'];
        } else {
            $buyer_id = 0;
        }

        $this->load->model('extension/module/buyer');

        $buyer_info = $this->model_extension_module_buyer->getBuyerInfo($buyer_id);

        if ($buyer_info) {
            if ($this->customer->isLogged()) {
                // Edit customers cart
                $this->load->model('account/attention_buyer');

                $status = $this->model_account_attention_buyer->addAttentionBuyer($buyer_id);

                $json['status'] = $status;
            } else {
                if (!isset($this->session->data['attention_buyer'])) {
                    $this->session->data['attention_buyer'] = array();
                }

                $is_exist = array_search($this->request->post['buyer_id'], $this->session->data['attention_buyer']);

                if($is_exist !== false){
                    unset( $this->session->data['attention_buyer'][$is_exist]);
                    $json['status'] = 4;

                }else{
                    $this->session->data['attention_buyer'][] = $this->request->post['buyer_id'];
                    $json['status'] = 3;
                }

                $this->session->data['attention_buyer'] = array_unique($this->session->data['attention_buyer']);


            }
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

}