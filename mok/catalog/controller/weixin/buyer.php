<?php
class ControllerWeixinBuyer extends Controller {
    public function index() {
        $this->load->language('weixin/buyer');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('weixin/buyer');

        $this->load->model('tool/image');

        $this->load->model('extension/module/buyer');

        $this->getList();
    }

    protected function getList() {
        if(isset($this->request->get['buyer_id'])){
            $buyer_id = $this->request->get['buyer_id'];
        }else{
            $this->response->redirect($this->url->link('error/not_found', '', true));
        }

        $buyer_info = $this->model_extension_module_buyer->getBuyerInfo($buyer_id);

        if(!$buyer_info){
            $this->response->redirect($this->url->link('error/not_found', '', true));
        }

        if ($buyer_info['head_image'] ) {
            $head_image = $this->model_tool_image->resize($buyer_info['head_image'], 128, 128);
        } else {
            $head_image = $this->model_tool_image->resize('no_image.png', 128, 128);
        }

        if ($buyer_info['show_image']) {
            $show_image = $this->model_tool_image->resize($buyer_info['show_image'], 750, 480);
        } else {
            $show_image = $this->model_tool_image->resize('no_image.png', 750, 480);
        }

        if ($this->customer->isLogged()) {
            $data['is_attention'] =  $this->model_weixin_buyer->is_attention($buyer_id);
        }else{
            $data['is_attention'] = 2;
        }

        //var_dump($data['is_attention']);exit;
        $data['buyer_info'] = array();

       $data['buyer_info']['nickname'] = $buyer_info['nickname'];

       $data['buyer_info']['intro'] = $buyer_info['intro'];

        $data['buyer_info']['introduce'] = $buyer_info['introduce'];

        $data['buyer_info']['head_image'] = $head_image;

        $data['buyer_info']['show_image'] = $show_image;

        $data['buyer_info']['buyer_id'] = $buyer_id;

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $url = '';

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data['blogs'] = array();

        $filter_data = array(
            'start' => ($page - 1) * $this->config->get('config_limit_admin'),
            'limit' => $this->config->get('config_limit_admin')
        );

        $article_total = $this->model_extension_module_buyer->getBuyerBlogTotal($buyer_id);

        $results = $this->model_extension_module_buyer->getBuyerBlogs($buyer_id);

        $year_time = 60*60*24*365;

        $month_time = 60*60*24*30;

        $day_time = 60*60*24;

        $hour_time = 60*60;

        $minute_time = 60;


        foreach ($results as $result) {

            if ($result['image']) {
                $image = $this->model_tool_image->resize($result['image'], 750, 420);
            } else {
                $image = '';
            }

            $publish_time = strtotime( $result['add_date']);

            $now_time = time();

            if($now_time - $publish_time > $year_time){
                $date = ($now_time - $publish_time)/$year_time;
                $show_time = floor($date).$this->language->get('year_time');
            }else if($now_time - $publish_time > $month_time){
                $date = ($now_time - $publish_time)/$month_time;
                $show_time = floor($date).$this->language->get('month_time');
            }else if($now_time - $publish_time > $day_time){
                $date = ($now_time - $publish_time)/$day_time;
                $show_time = floor($date).$this->language->get('day_time');
            }else if($now_time - $publish_time >$hour_time){
                $date = ($now_time - $publish_time)/$hour_time;
                $show_time = floor($date).$this->language->get('hour_time');
            }else if($now_time - $publish_time >$minute_time){
                $date = ($now_time - $publish_time)/$minute_time;
                $show_time = floor($date).$this->language->get('minute_time');
            }else{
                $show_time = $this->language->get('just_now_time');
            }


            $data['blogs'][] = array(
                'buyer_id'        => $buyer_id,
                'thumb'            => $image,
                'title'             =>$result['title'],
                'published_time'  => $show_time,
                'href'             => $this->url->link('product/product', 'product_id=' . $result['product_id'],'',true),
            );
        }

        $data['product_total']  = $this->model_extension_module_buyer->getBuyerBlogTotal($buyer_id);

        $data['attention_total']  = $this->model_weixin_buyer->getAttentionTotal($buyer_id);
        $url = '';

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }
        $pagination = new Pagination();
        $pagination->total = $article_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_limit_admin');
        $pagination->url = $this->url->link('weixin/buyer', '&page={page}', true);

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($article_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($article_total - $this->config->get('config_limit_admin'))) ? $article_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $article_total, ceil($article_total / $this->config->get('config_limit_admin')));

        $data['entry_product'] = $this->language->get('entry_product');
        $data['entry_attention'] = $this->language->get('entry_attention');

        /**/
        $this->document->addStyle('catalog/view/theme/default/css/buyer.css');

        $this->document->addScript('catalog/view/theme/default/script/zepto.min.js','footer');
        $this->document->addScript('catalog/view/theme/default/script/zepto.lazyload.min.js','footer');
        $this->document->addScript('catalog/view/theme/default/script/ok_buyer.js','footer');

        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');

        $data['footer'] = $this->load->controller('weixin/footer');
        $data['header'] = $this->load->controller('weixin/header');
        /**/
        $this->response->setOutput($this->load->view('weixin/buyer', $data));
    }

}
