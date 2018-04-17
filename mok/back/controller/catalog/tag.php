<?php
    class ControllerCatalogTag extends Controller {
    private $error = array();
        public function index() {
            $this->load->language('catalog/tag');

            $this->document->setTitle($this->language->get('heading_title'));

            $this->load->model('catalog/tag');

            $this->getList();
        }

        protected function getList() {
            if (isset($this->request->get['sort'])) {
                $sort = $this->request->get['sort'];
            } else {
                $sort = 'name';
            }

            if (isset($this->request->get['order'])) {
                $order = $this->request->get['order'];
            } else {
                $order = 'ASC';
            }

            if (isset($this->request->get['page'])) {
                $page = $this->request->get['page'];
            } else {
                $page = 1;
            }

            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $data['breadcrumbs'] = array();

            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_home'),
                'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
            );

            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title'),
                'href' => $this->url->link('catalog/tag', 'token=' . $this->session->data['token'] . $url, true)
            );

            $data['add'] = $this->url->link('catalog/tag/addTag', 'token=' . $this->session->data['token'] . $url, true);
            $data['delete'] = $this->url->link('catalog/tag/deleteTag', 'token=' . $this->session->data['token'] . $url, true);
            $filter_data = array(
                'start' => ($page - 1) * $this->config->get('config_limit_admin'),
                'limit' => $this->config->get('config_limit_admin')
            );

            $tag_total = $this->model_catalog_tag->getTotalTag();

            $results = $this->model_catalog_tag->getTags($filter_data);

            foreach ($results as $result) {
                $data['tags'][] = array(
                    'video_tag_id' => $result['video_tag_id'],
                    'tag_name'       => $result['tag_name'],
                    'tag_type'       => $result['tag_type'],
                    'seo_title'      => $result['seo_title'],
                    'seo_desc'       => $result['seo_desc'],
                    'seo_keyword'    => $result['seo_keyword'],
                    'created' => date($this->language->get('date_format_short'), strtotime($result['created'])),
                   // 'status'     => ($result['status'] ? $this->language->get('column_reply_y') : $this->language->get('column_reply_n')),
                    //'reply'       => $this->url->link('catalog/tag/edit', 'token=' . $this->session->data['token'] . '&coupon_id=' . $result['coupon_id'] . $url, true)
                );
            }
            $data['heading_title'] = $this->language->get('heading_title');

            $data['text_list'] = $this->language->get('text_list');
            $data['text_no_results'] = $this->language->get('text_no_results');
            $data['text_confirm'] = $this->language->get('text_confirm');
            /*表格列名*/
            $data['entry_Tag_pic'] = $this->language->get('entry_Tag_pic');
            $data['entry_Tag_name'] = $this->language->get('entry_Tag_name');
            $data['entry_Tag_seoTitle'] = $this->language->get('entry_Tag_seoTitle');
            $data['entry_Tag_seoDesc'] = $this->language->get('entry_Tag_seoDesc');
            $data['entry_Tag_seoKeyword'] = $this->language->get('entry_Tag_seoKeyword');
            $data['entry_Tag_sort'] = $this->language->get('entry_Tag_sort');
            $data['entry_Tag_type'] = $this->language->get('entry_Tag_type');
            $data['entry_action'] = $this->language->get('entry_action');
            $data['button_add'] = $this->language->get('button_add');
            $data['button_delete'] = $this->language->get('button_delete');

            if (isset($this->error['warning'])) {
                $data['error_warning'] = $this->error['warning'];
            } else {
                $data['error_warning'] = '';
            }

            if (isset($this->session->data['success'])) {
                $data['success'] = $this->session->data['success'];

                unset($this->session->data['success']);
            } else {
                $data['success'] = '';
            }

            if (isset($this->request->post['selected'])) {
                $data['selected'] = (array)$this->request->post['selected'];
            } else {
                $data['selected'] = array();
            }

            $url = '';

            if ($order == 'ASC') {
                $url .= '&order=DESC';
            } else {
                $url .= '&order=ASC';
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $url = '';

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            $pagination = new Pagination();
            $pagination->total = $tag_total;
            $pagination->page = $page;
            $pagination->limit = $this->config->get('config_limit_admin');
            $pagination->url = $this->url->link('catalog/tag', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

            $data['pagination'] = $pagination->render();

            $data['results'] = sprintf($this->language->get('text_pagination'), ($tag_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($tag_total - $this->config->get('config_limit_admin'))) ? $tag_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $tag_total, ceil($tag_total / $this->config->get('config_limit_admin')));

            $data['header'] = $this->load->controller('common/header');
            $data['column_left'] = $this->load->controller('common/column_left');
            $data['footer'] = $this->load->controller('common/footer');

            $this->response->setOutput($this->load->view('catalog/tag_list', $data));
        }
        
        public function addTag() {
        $this->load->language('catalog/tag');
        $this->load->model('catalog/tag');
        //$this->load->model('customer/customer');
        //$this->load->model('customer/customer_group');

        $this->document->setTitle($this->language->get('heading_title'));

        if (($this->request->server['REQUEST_METHOD'] == 'POST') ) {

            $this->model_catalog_tag->addTag( $this->request->post);
            $this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true));
            
        }

        $data['heading_title'] = $this->language->get('heading_title');

        $data['entry_Tag_pic'] = $this->language->get('entry_Tag_pic');
        $data['entry_Tag_name'] = $this->language->get('entry_Tag_name');
        $data['entry_Tag_seoTitle'] = $this->language->get('entry_Tag_seoTitle');
        $data['entry_Tag_seoDesc'] = $this->language->get('entry_Tag_seoDesc');
        $data['entry_Tag_seoKeyword'] = $this->language->get('entry_Tag_seoKeyword');
        $data['entry_Tag_sort'] = $this->language->get('entry_Tag_sort');
        $data['entry_Tag_type'] = $this->language->get('entry_Tag_type');

        $data['button'] = $this->language->get('button');

        $data['action'] = $this->url->link('catalog/tag/addTag', 'token=' . $this->session->data['token'], true);

        $data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);


        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_module'),
            'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('extension/module/weibo_login', 'token=' . $this->session->data['token'], true)
        );

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('catalog/tag_form', $data));
    }

        public function deleteTag() {
            $this->load->language('catalog/tag');

            $this->document->setTitle($this->language->get('heading_title'));

            $this->load->model('catalog/tag');

            if (isset($this->request->post['selected']) && $this->validateDelete()) {
                foreach ($this->request->post['selected'] as $video_tag_id) {
                    $this->model_catalog_tag->deleteTag($video_tag_id);
                }

                $this->session->data['success'] = $this->language->get('text_success');

                $url = '';

                if (isset($this->request->get['page'])) {
                    $url .= '&page=' . $this->request->get['page'];
                }

                $this->response->redirect($this->url->link('catalog/tag', 'token=' . $this->session->data['token'] . $url, true));
            }

            $this->getList();
        }

        protected function validateDelete() {
            if (!$this->user->hasPermission('modify', 'catalog/tag')) {
                $this->error['warning'] = $this->language->get('error_permission');
            }

            return !$this->error;
        }



}