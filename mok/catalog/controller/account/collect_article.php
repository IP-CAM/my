<?php
class ControllerAccountCollectArticle extends Controller {
    public function index() {
        if (!$this->customer->isLogged()) {
            $this->session->data['redirect'] = $this->url->link('account/collect_article', '', true);

            $this->response->redirect($this->url->link('account/login', '', true));
        }

        $this->load->language('account/collect_article');

        $this->load->model('account/collect_article');


        $this->load->model('tool/image');

        if (isset($this->request->get['remove'])) {
            // Remove collect_article
            $this->model_account_collect_article->deleteArticle($this->request->get['remove']);

            $this->session->data['success'] = $this->language->get('text_remove');

            $this->response->redirect($this->url->link('account/collect_article'));
        }

        $this->document->setTitle($this->language->get('heading_title'));

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_empty'] = $this->language->get('text_empty');

        $data['text_goods'] = $this->language->get('text_goods');
        $data['text_article'] = $this->language->get('text_article');

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        $data['articles'] = array();

        $results = $this->model_account_collect_article->getArticle();

        if($results){
            foreach ($results as $result) {

            $article_info = $this->model_account_collect_article->getArticleInfo($result);

           if ($article_info) {

               if ($article_info['image']) {
                   $image = $this->model_tool_image->resize($article_info['image'], 677, 390);
               } else {
                   $image = false;
               }

               $data['articles'][] = array(
                   'article_id' => $result,
                   'thumb'      =>  $image,
                   'title'       => $article_info['title'],
                   'href'       => $this->url->link('blog/blog', 'blog_id=' . $result),
                   'remove'     => $this->url->link('account/collect_article', 'remove=' . $result)
               );
           } else {
               $this->model_account_collect_article->deleteArticle($result);
           }
       }

        }

        $this->document->addStyle('catalog/view/theme/default/css/content_collect.css');

        $this->document->addScript('catalog/view/theme/default/script/zepto.min.js','footer');
        $this->document->addScript('catalog/view/theme/default/script/zepto.lazyload.min.js','footer');
        $this->document->addScript('catalog/view/theme/default/script/ok_contentCollect.js','footer');

        $data['goods_href'] = $this->url->link('account/wishlist', '', true);
        $data['article_href'] = $this->url->link('account/collect_article', '', true);

        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer'] = $this->load->controller('weixin/footer');
        $data['header'] = $this->load->controller('weixin/header');



        $this->response->setOutput($this->load->view('weixin/collect_article', $data));

    }

    public function add() {
        $this->load->language('account/collect_article');

        $json = array();

        if (isset($this->request->post['article_id'])) {
            $article_id = $this->request->post['article_id'];
        } else {
            $article_id = 0;
        }

        $this->load->model('account/collect_article');

        $this->load->model('blog/blog');

        $article_info = $this->model_blog_blog->getBlog($article_id);

        if ($article_info) {
            if ($this->customer->isLogged()) {
                // Edit customers cart
                $this->load->model('account/attention_manufacturer');

                $status = $this->model_account_collect_article->addArticle($article_id);

                $json['status'] = $status;
            } else {
                if (!isset($this->session->data['collect_article'])) {
                    $this->session->data['collect_article'] = array();
                }

                $is_exist = array_search($this->request->post['article_id'], $this->session->data['collect_article']);

                if($is_exist !== false){
                    unset( $this->session->data['collect_article'][$is_exist]);
                    $json['status'] = 4;
                }else{
                    $this->session->data['collect_article'][] = $this->request->post['article_id'];
                    $json['status'] = 3;
                }


                $this->session->data['collect_article'] = array_unique($this->session->data['collect_article']);


            }
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
}
