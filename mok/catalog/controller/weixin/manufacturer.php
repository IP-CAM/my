<?php
class ControllerWeixinManufacturer extends Controller {
    public function index() {
        $this->load->language('weixin/manufacturer');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('weixin/manufacturer');

        $this->load->model('tool/image');

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

        $data['manufacturers'] = array();

        $filter_data = array(
            'sort'  => $sort,
            'order' => $order,
            'start' => ($page - 1) * $this->config->get('config_limit_admin'),
            'limit' => $this->config->get('config_limit_admin')
        );

        $manufacturer_total = $this->model_weixin_manufacturer->getTotalManufacturers();

        $results = $this->model_weixin_manufacturer->getManufacturers($filter_data);
        foreach ($results as $result) {

            if ($result['image']) {
                $logo_image = $this->model_tool_image->resize($result['image'], 110, 110);
            } else {
                $logo_image = '';
            }

            $data['manufacturers'][] = array(
                'manufacturer_id' => $result['manufacturer_id'],
                'name'            => $result['name'],
                'image'           => $logo_image,
                'sort_order'      => $result['sort_order'],
                'href'             => $this->url->link('weixin/manufacturer/detail', 'manufacturer_id=' . $result['manufacturer_id']),
            );
        }

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_list'] = $this->language->get('text_list');
        $data['text_no_results'] = $this->language->get('text_no_results');
        $data['text_confirm'] = $this->language->get('text_confirm');

        $data['column_name'] = $this->language->get('column_name');
        $data['column_sort_order'] = $this->language->get('column_sort_order');
        $data['column_action'] = $this->language->get('column_action');

        $data['button_add'] = $this->language->get('button_add');
        $data['button_edit'] = $this->language->get('button_edit');
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

        $data['sort_name'] = $this->url->link('catalog/manufacturer',  'sort=name' . $url, true);
        $data['sort_sort_order'] = $this->url->link('catalog/manufacturer','sort=sort_order' . $url, true);

        $url = '';

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        $pagination = new Pagination();
        $pagination->total = $manufacturer_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_limit_admin');
        $pagination->url = $this->url->link('weixin/manufacturer', '&page={page}', true);

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($manufacturer_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($manufacturer_total - $this->config->get('config_limit_admin'))) ? $manufacturer_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $manufacturer_total, ceil($manufacturer_total / $this->config->get('config_limit_admin')));

        $data['sort'] = $sort;
        $data['order'] = $order;
        /**/
        $this->document->addStyle('catalog/view/theme/default/css/brand_index.css');

        $this->document->addScript('catalog/view/theme/default/script/zepto.min.js','footer');
        $this->document->addScript('catalog/view/theme/default/script/zepto.lazyload.min.js','footer');
        $this->document->addScript('catalog/view/theme/default/script/ok_manufacturer.js','footer');

        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');

        $data['footer'] = $this->load->controller('weixin/footer');
        $data['header'] = $this->load->controller('weixin/header');
        /**/
        $this->response->setOutput($this->load->view('weixin/manufacturer_list', $data));
    }
    public function detail(){
        $this->load->model('weixin/manufacturer');

        $this->load->model('catalog/product');

        $this->load->model('tool/image');

        $this->load->model('blog/blog');

        $this->load->language('weixin/manufacturer');

        $manufacturer_id =  $this->request->get['manufacturer_id'];

        $data['manufacturer_info']= $this->model_weixin_manufacturer->getManufacturer($manufacturer_id);

        if ($this->customer->isLogged()) {

            $data['is_attention']= $this->model_weixin_manufacturer->is_attention($manufacturer_id);
        }else{
            $data['is_attention']= 2;
        }
        /*start*/
        if ( $data['manufacturer_info']) {
            $this->document->setTitle( $data['manufacturer_info']['name']);

            $url = '';

            if ($data['manufacturer_info']['image']) {
                $data['logo_image'] = $this->model_tool_image->resize($data['manufacturer_info']['image'], 113, 113);
            } else {
                $data['logo_image'] = '';
            }

            if ($data['manufacturer_info']['show_image']) {
                $data['show_image'] = $this->model_tool_image->resize($data['manufacturer_info']['show_image'], 750, 250);
            } else {
                $data['show_image'] = '';
            }


            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }else{
                $sort = 'p.quantity';
                $url .= '&sort=p.quantity';
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }else{
                $order = 'DESC';
                $url .= '&order=DESC';
            }


            $data['heading_title'] = $data['manufacturer_info']['name'];

            $data['text_empty'] = $this->language->get('text_empty');
            $data['text_goods'] = $this->language->get('text_goods');
            $data['text_about'] = $this->language->get('text_about');
            $data['text_manufacturer_content'] = $this->language->get('text_manufacturer_content');


            $data['products'] = array();

            $filter_data = array(
                'filter_manufacturer_id' => $manufacturer_id,
                'sort'                   => $sort,
                'order'                  => $order,
            );

            $data['product_total'] = $this->model_catalog_product->getTotalProducts($filter_data);

            $results = $this->model_catalog_product->getProducts($filter_data);

            foreach ($results as $result) {
                if ($result['image']) {
                    $image = $this->model_tool_image->resize($result['image'], $this->config->get($this->config->get('config_theme') . '_image_product_width'), $this->config->get($this->config->get('config_theme') . '_image_product_height'));
                } else {
                    $image = $this->model_tool_image->resize('placeholder.png', $this->config->get($this->config->get('config_theme') . '_image_product_width'), $this->config->get($this->config->get('config_theme') . '_image_product_height'));
                }

                if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
                    $price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
                } else {
                    $price = false;
                }

                if ((float)$result['special']) {
                    $special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
                } else {
                    $special = false;
                }

                if ($this->config->get('config_tax')) {
                    $tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price'], $this->session->data['currency']);
                } else {
                    $tax = false;
                }

                if ($this->config->get('config_review_status')) {
                    $rating = (int)$result['rating'];
                } else {
                    $rating = false;
                }

                $data['products'][] = array(
                    'product_id'  => $result['product_id'],
                    'thumb'       => $image,
                    'name'        => $result['name'],
                    'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get($this->config->get('config_theme') . '_product_description_length')) . '..',
                    'price'       => $price,
                    'quantity'    =>  $result['quantity'],
                    'special'     => $special,
                    'tax'         => $tax,
                    'minimum'     => $result['minimum'] > 0 ? $result['minimum'] : 1,
                    'rating'      => $result['rating'],
                    'href'        => $this->url->link('product/product', 'manufacturer_id=' . $result['manufacturer_id'] . '&product_id=' . $result['product_id'] . $url)
                );
            }
                $blogs = array();
                $blogs_arr = $this->model_blog_blog->getBlogsByManufacturer($manufacturer_id);
                if ($blogs_arr){
                    foreach($blogs_arr as $row){
                        if ($row['image']) {
                            $blog_image = $this->model_tool_image->resize($row['image'], 196, 110);
                        } else {
                            $blog_image = $this->model_tool_image->resize('placeholder.png', $this->config->get($this->config->get('config_theme') . '_image_product_width'), $this->config->get($this->config->get('config_theme') . '_image_product_height'));
                        }
                        $blogs[] = array(
                            'title' => $row['title'],
                            'image' => $blog_image,
                            'blog_id' => $row['blog_id'],
                            'blog_href' => $this->url->link('blog/blog', 'blog_id='.$row['blog_id'],true)
                        );
                    }
                }

                $data['blogs'] = $blogs;

                $this->document->addStyle('catalog/view/theme/default/css/brand.css');

                $this->document->addScript('catalog/view/theme/default/script/zepto.min.js','footer');
                $this->document->addScript('catalog/view/theme/default/script/zepto.lazyload.min.js','footer');
                $this->document->addScript('catalog/view/theme/default/script/ok_brand.js','footer');

                $data['footer'] = $this->load->controller('weixin/footer');
                $data['header'] = $this->load->controller('weixin/header');
                $this->response->setOutput($this->load->view('weixin/manufacturer_detail', $data));

        } else {
            $url = '';

            if (isset($this->request->get['manufacturer_id'])) {
                $url .= '&manufacturer_id=' . $this->request->get['manufacturer_id'];
            }

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            if (isset($this->request->get['limit'])) {
                $url .= '&limit=' . $this->request->get['limit'];
            }

            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_error'),
                'href' => $this->url->link('product/manufacturer/info', $url)
            );

            $this->document->setTitle($this->language->get('text_error'));

            $data['heading_title'] = $this->language->get('text_error');

            $data['text_error'] = $this->language->get('text_error');

            $data['button_continue'] = $this->language->get('button_continue');

            $data['continue'] = $this->url->link('common/home');

            $this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');

            $data['header'] = $this->load->controller('common/header');
            $data['footer'] = $this->load->controller('common/footer');
            $data['column_left'] = $this->load->controller('common/column_left');
            $data['column_right'] = $this->load->controller('common/column_right');
            $data['content_top'] = $this->load->controller('common/content_top');
            $data['content_bottom'] = $this->load->controller('common/content_bottom');

            $this->response->setOutput($this->load->view('error/not_found', $data));
        }
    }

}
