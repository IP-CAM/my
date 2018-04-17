<?php
class ControllerAccountAttentionManufacturer extends Controller {
    public function index() {
        if (!$this->customer->isLogged()) {
            $this->session->data['redirect'] = $this->url->link('account/attention_manufacturer', '', true);

            $this->response->redirect($this->url->link('account/login', '', true));
        }

       $this->load->language('account/attention_manufacturer');

        $this->load->model('account/attention_manufacturer');

        $this->load->model('weixin/manufacturer');

        $this->load->model('tool/image');

        if (isset($this->request->get['remove'])) {
            // Remove Attention
            $this->model_account_attention_manufacturer->deleteAttentionManufacturer($this->request->get['remove']);

            $this->session->data['success'] = $this->language->get('text_remove');

            $this->response->redirect($this->url->link('account/attention_manufacturer'));
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

        $data['manufacturers'] = array();

        $results = $this->model_account_attention_manufacturer->getAttentionManufacturer();
        if($results) {
            foreach ($results as $result) {

                $manufacturer_info = $this->model_weixin_manufacturer->getManufacturer($result);

                if ($manufacturer_info) {
                    if ($manufacturer_info['image']) {
                        $image = $this->model_tool_image->resize($manufacturer_info['image'], $this->config->get($this->config->get('config_theme') . '_image_wishlist_width'), $this->config->get($this->config->get('config_theme') . '_image_wishlist_height'));
                    } else {
                        $image = false;
                    }

                    $data['manufacturers'][] = array(
                        'manufacturer_id' => $manufacturer_info['manufacturer_id'],
                        'thumb' => $image,
                        'name' => $manufacturer_info['name'],
                        'introduce' => $manufacturer_info['introduce'],
                        'href' => $this->url->link('weixin/manufacturer/detail', 'manufacturer_id=' . $manufacturer_info['manufacturer_id']),
                        'remove' => $this->url->link('account/attention_manufacturer', 'remove=' . $manufacturer_info['manufacturer_id'])
                    );
                } else {
                    $this->model_account_attention_manufacturer->deleteAttentionManufacturer($result);
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

        $this->response->setOutput($this->load->view('weixin/attention_manufacturer', $data));
    }

    public function add() {
        $this->load->language('account/attention_manufacturer');

        $json = array();

        if (isset($this->request->post['manufacturer_id'])) {
            $manufacturer_id = $this->request->post['manufacturer_id'];
        } else {
            $manufacturer_id = 0;
        }
        
        $this->load->model('weixin/manufacturer');

        $manufacturer_info = $this->model_weixin_manufacturer->getManufacturer($manufacturer_id);

        if ($manufacturer_info) {
            if ($this->customer->isLogged()) {
                // Edit customers cart
                $this->load->model('account/attention_manufacturer');

                $status = $this->model_account_attention_manufacturer->addAttentionManufacturer($manufacturer_id);

                $json['status'] = $status;
            } else {
                if (!isset($this->session->data['attention_manufacturer'])) {
                    $this->session->data['attention_manufacturer'] = array();
                }

                $is_exist = array_search($this->request->post['manufacturer_id'], $this->session->data['attention_manufacturer']);

                if($is_exist !== false){
                    unset( $this->session->data['attention_manufacturer'][$is_exist]);
                    $json['status'] = 4;
                }else{
                    $this->session->data['attention_manufacturer'][] = $this->request->post['manufacturer_id'];
                    $json['status'] = 3;
                }

                $this->session->data['attention_manufacturer'] = array_unique($this->session->data['attention_manufacturer']);


            }
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

}