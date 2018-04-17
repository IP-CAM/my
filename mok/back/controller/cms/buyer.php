<?php
class ControllerCmsBuyer extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('cms/buyer');

		$this->document->setTitle($this->language->get('buyer_blog_heading_title'));

		$this->load->model('cms/buyer');

		$this->load->model('catalog/product');

		$this->getList();
	}

	public function add() {
        $this->load->language('cms/buyer');

        $this->document->setTitle($this->language->get('buyer_blog_heading_title'));

        $this->load->model('cms/buyer');

        $this->load->model('tool/image');

        $this->load->model('localisation/language');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

			$this->model_cms_buyer->addBuyerblog($this->user->getId() , $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('cms/buyer', 'token=' . $this->session->data['token'] , true));
		}

		$this->getForm();
	}

	public function edit() {
        $this->load->language('cms/buyer');

        $this->document->setTitle($this->language->get('buyer_blog_heading_title'));

        $this->load->model('cms/buyer');

        $this->load->model('tool/image');

        $this->load->model('localisation/language');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

            $this->model_cms_buyer->editBuyerblog($this->user->getId() , $this->request->post ,$this->request->get['blog_id']);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('cms/buyer', 'token=' . $this->session->data['token'] , true));
        }

        $this->getForm();
	}

	public function delete() {
		$this->load->language('cms/buyer');

		$this->document->setTitle($this->language->get('buyer_blog_heading_title'));

		$this->load->model('cms/buyer');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {

			foreach ($this->request->post['selected'] as $buyer_id) {
				$this->model_cms_buyer->deleteBuyerBlog($buyer_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_title'])) {
				$url .= '&filter_title=' . urlencode(html_entity_decode($this->request->get['filter_title'], ENT_QUOTES, 'UTF-8'));
			}


			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('cms/buyer', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getList();
	}

	protected function getList() {

        if (isset($this->request->get['filter_title'])) {
            $data['filter_title'] = $this->request->get['filter_title'];
        } else {
            $data['filter_title'] = null;
        }

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

        if (isset($this->request->get['filter_title'])) {
            $url .= '&filter_title=' . urlencode(html_entity_decode($this->request->get['filter_title'], ENT_QUOTES, 'UTF-8'));
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
			'text' => $this->language->get('buyer_blog_heading_title'),
			'href' => $this->url->link('cms/buyer', 'token=' . $this->session->data['token'] . $url, true)
		);

        $data['buyer_info'] = $this->url->link('cms/buyer/buyerInfoList', 'token=' . $this->session->data['token'], true);

        $data['add'] = $this->url->link('cms/buyer/add', 'token=' . $this->session->data['token'], true);

		$data['delete'] = $this->url->link('cms/buyer/delete', 'token=' . $this->session->data['token'] . $url, true);

		$filter_data = array(
            'filter_title'	  => $data['filter_title'],
			'start'           => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'           => $this->config->get('config_limit_admin')
		);

		$this->load->model('tool/image');

		$buyer_total = $this->model_cms_buyer->getAllBuyerBlogTotal();

		$results = $this->model_cms_buyer->getAllBuyerBlogs($filter_data);

        $data['blogs'] = array();

        if($results){
            foreach ($results as $result) {

                $product_info = $this->model_catalog_product->getProduct($result['product_id']);
                if($product_info){
                    $product_name = $product_info['name'];
                }else{
                    $product_name = '';
                }

                $buyer_info = $this->model_cms_buyer->getBuyerInfo($result['buyer_info_id']);
                if($buyer_info){
                    $nickname = $buyer_info['nickname'];
                }else{
                    $nickname = '';
                }

                $data['blogs'][] = array(
                    'buyer_blog_id' => $result['buyer_blog_id'],
                    'title'       => $result['title'],
                    'buyer_name' => $nickname,
                    'product'       => $product_name,
                    'edit'       => $this->url->link('cms/buyer/edit', 'token=' . $this->session->data['token'] . '&blog_id=' . $result['buyer_blog_id'] . $url, true)
                );
            }
        }


		$data['heading_title'] = $this->language->get('buyer_blog_heading_title');
		
		$data['text_list'] = $this->language->get('text_list');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');
		$data['text_buyer'] = $this->language->get('text_buyer');

		$data['column_title'] = $this->language->get('column_title');
		$data['column_product'] = $this->language->get('column_product');
		$data['column_action'] = $this->language->get('column_action');
		$data['column_buyer'] = $this->language->get('column_buyer');

		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_status'] = $this->language->get('entry_status');

		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_filter'] = $this->language->get('button_filter');

		$data['token'] = $this->session->data['token'];

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

        if (isset($this->request->get['filter_title'])) {
            $url .= '&filter_title=' . urlencode(html_entity_decode($this->request->get['filter_title'], ENT_QUOTES, 'UTF-8'));
        }

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$url = '';

        if (isset($this->request->get['filter_title'])) {
            $url .= '&filter_title=' . urlencode(html_entity_decode($this->request->get['filter_title'], ENT_QUOTES, 'UTF-8'));
        }

		$pagination = new Pagination();
		$pagination->total = $buyer_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('cms/buyer', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($buyer_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($buyer_total - $this->config->get('config_limit_admin'))) ? $buyer_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $buyer_total, ceil($buyer_total / $this->config->get('config_limit_admin')));

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('cms/buyer_list', $data));
	}

	protected function getForm() {
        $data['heading_title'] = $this->language->get('buyer_blog_heading_title');
        $data['text_form'] = $this->language->get('text_form');
        $data['entry_title'] = $this->language->get('entry_title');
        $data['entry_image'] = $this->language->get('entry_image');
        $data['entry_product'] = $this->language->get('entry_product');
        $data['entry_product_related'] = $this->language->get('entry_product_related');
        $data['entry_buyer'] = $this->language->get('entry_buyer');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');


        $url = '';

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('buyer_blog_heading_title'),
            'href' => $this->url->link('cms/buyer', 'token=' . $this->session->data['token'] . $url, true)
        );

        if (!isset($this->request->get['blog_id'])) {
            $data['action'] = $this->url->link('cms/buyer/add', 'token=' . $this->session->data['token'] . $url, true);
        } else {
            $data['action'] = $this->url->link('cms/buyer/edit', 'token=' . $this->session->data['token'] . '&blog_id=' . $this->request->get['blog_id'] . $url, true);
        }

        $data['cancel'] = $this->url->link('cms/buyer', 'token=' . $this->session->data['token'] . $url, true);

        if (isset($this->request->get['blog_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $blog_info = $this->model_cms_buyer->getBuyerBlog($this->request->get['blog_id']);
        }else{
            $blog_info = array();
        }

        if (!empty($blog_info)) {
            $data['title'] = $blog_info['title'];
        } else {
            $data['title'] = '';
        }

        if (!empty($blog_info)) {
            $data['buyer_info_id'] = $blog_info['buyer_info_id'];
        } else {
            $data['buyer_info_id'] = '';
        }

        if (!empty($blog_info)) {
            $data['image'] = $blog_info['image'];
            $data['thumb'] = $data['head_thumb'] = $this->model_tool_image->resize($blog_info['image'], 100, 100);
        } else {
            $data['image'] = '';
            $data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
        }

        $this->load->model('catalog/product');

        if (!empty($blog_info)) {
            $product =  $blog_info['product_id'];
        } else {
            $product = '';
        }

        $data['all_buyers'] = $this->model_cms_buyer->getAllBuyerInfo();

        $data['product_relateds'] = array();

            $related_info = $this->model_catalog_product->getProduct($product);

            if ($related_info) {
                $data['product_relateds'] = array(
                    'product_id' => $related_info['product_id'],
                    'name'       => $related_info['name']
                );
            }else{
                $data['product_relateds'] = array(
                    'product_id' => '',
                    'name'       => ''
                );
            }


        $data['token'] = $this->session->data['token'];

        $data['languages'] = $this->model_localisation_language->getLanguages();


        $data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('cms/add_buyer', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'cms/buyer')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		/*foreach ($this->request->post['buyer_description'] as $language_id => $value) {
			if ((utf8_strlen($value['title']) < 1) || (utf8_strlen($value['title']) > 64)) {
				$this->error['title'][$language_id] = $this->language->get('error_title');
			}

			if (utf8_strlen($value['description']) < 1) {
				$this->error['description'][$language_id] = $this->language->get('error_description');
			}

			if ((utf8_strlen($value['meta_title']) < 1) || (utf8_strlen($value['meta_title']) > 255)) {
				$this->error['meta_title'][$language_id] = $this->language->get('error_meta_title');
			}
		}
		
		if (utf8_strlen($this->request->post['keyword']) > 0) {
			$this->load->model('catalog/url_alias');

			$url_alias_info = $this->model_catalog_url_alias->getUrlAlias($this->request->post['keyword']);

			if ($url_alias_info && isset($this->request->get['buyer_id']) && $url_alias_info['query'] != 'buyer_id=' . $this->request->get['buyer_id']) {
				$this->error['keyword'] = sprintf($this->language->get('error_keyword'));
			}

			if ($url_alias_info && !isset($this->request->get['buyer_id'])) {
				$this->error['keyword'] = sprintf($this->language->get('error_keyword'));
			}
		}

		

		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}*/

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'cms/buyer')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}


	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_title'])) {
			$this->load->model('cms/buyer');

			if (isset($this->request->get['filter_title'])) {
				$filter_title = $this->request->get['filter_title'];
			} else {
				$filter_title = '';
			}

			if (isset($this->request->get['limit'])) {
				$limit = $this->request->get['limit'];
			} else {
				$limit = $this->config->get('config_limit_autocomplete');
			}

			$filter_data = array(
				'filter_title'  => $filter_title,
				'start'        => 0,
				'limit'        => $limit
			);

			$results = $this->model_cms_buyer->getbuyers($filter_data);

			foreach ($results as $result) {
				$option_data = array();

				$json[] = array(
					'buyer_id' => $result['buyer_id'],
					'title'       => strip_tags(html_entity_decode($result['title'], ENT_QUOTES, 'UTF-8')),
				);
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	//买手资料列表
    public function buyerInfoList() {
        $this->load->language('cms/buyer');

        $this->document->setTitle($this->language->get('buyer_info_heading_title'));

        $this->load->model('cms/buyer');

        $this->load->model('catalog/product');

        if (isset($this->request->get['filter_title'])) {
            $data['filter_title'] = $this->request->get['filter_title'];
        } else {
            $data['filter_title'] = null;
        }

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $url = '';

        if (isset($this->request->get['filter_title'])) {
            $url .= '&filter_title=' . urlencode(html_entity_decode($this->request->get['filter_title'], ENT_QUOTES, 'UTF-8'));
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
            'text' => $this->language->get('buyer_info_heading_title'),
            'href' => $this->url->link('cms/buyer', 'token=' . $this->session->data['token'] . $url, true)
        );

        $data['add'] = $this->url->link('cms/buyer/buyer_info', 'token=' . $this->session->data['token'], true);

        $data['delete'] = $this->url->link('cms/buyer/deleteBuyerInfo', 'token=' . $this->session->data['token'] . $url, true);

        $filter_data = array(
            'filter_title'	  => $data['filter_title'],
            'start'           => ($page - 1) * $this->config->get('config_limit_admin'),
            'limit'           => $this->config->get('config_limit_admin')
        );

        $this->load->model('tool/image');

        $buyer_total = $this->model_cms_buyer->getBuyerInfoTotal();

        $results = $this->model_cms_buyer->getAllBuyerInfo($filter_data);

        $data['buyers'] = array();

        if($results){
            foreach ($results as $result) {

                $data['buyers'][] = array(
                    'buyer_info_id' => $result['buyer_info_id'],
                    'nickname'       => $result['nickname'],
                    'intro'       => $result['intro'],
                    'introduce'   => $result['introduce'],
                    'edit'       => $this->url->link('cms/buyer/buyer_info', 'token=' . $this->session->data['token'] . '&buyer_id=' . $result['buyer_info_id'] . $url, true)
                );
            }
        }


        $data['heading_title'] = $this->language->get('buyer_info_heading_title');

        $data['text_list'] = $this->language->get('text_list');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_no_results'] = $this->language->get('text_no_results');
        $data['text_confirm'] = $this->language->get('text_confirm');

        $data['column_nickname'] = $this->language->get('column_nickname');
        $data['column_intro'] = $this->language->get('column_intro');
        $data['column_introduce'] = $this->language->get('column_introduce');
        $data['column_action'] = $this->language->get('column_action');

        $data['entry_title'] = $this->language->get('entry_title');


        $data['button_add'] = $this->language->get('button_add');
        $data['button_edit'] = $this->language->get('button_edit');
        $data['button_delete'] = $this->language->get('button_delete');
        $data['button_filter'] = $this->language->get('button_filter');

        $data['token'] = $this->session->data['token'];

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

        if (isset($this->request->get['filter_title'])) {
            $url .= '&filter_title=' . urlencode(html_entity_decode($this->request->get['filter_title'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $url = '';

        if (isset($this->request->get['filter_title'])) {
            $url .= '&filter_title=' . urlencode(html_entity_decode($this->request->get['filter_title'], ENT_QUOTES, 'UTF-8'));
        }

        $pagination = new Pagination();
        $pagination->total = $buyer_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_limit_admin');
        $pagination->url = $this->url->link('cms/buyer/buyerInfoList', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($buyer_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($buyer_total - $this->config->get('config_limit_admin'))) ? $buyer_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $buyer_total, ceil($buyer_total / $this->config->get('config_limit_admin')));

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('cms/buyer_info_list', $data));
    }

	//买手资料
	public function buyer_info(){

        $this->load->language('cms/buyer');

        $this->document->setTitle($this->language->get('buyer_info_heading_title'));

        $this->load->model('cms/buyer');

        $this->load->model('tool/image');

        $this->load->model('localisation/language');

        if(isset($this->request->get['buyer_id'])){
            $buyer_info = $this->model_cms_buyer->getBuyerInfo($this->request->get['buyer_id']);
            $data['buyer_id'] = $this->request->get['buyer_id'];
        }else{
            $buyer_info = array();
            $data['buyer_id'] = '';
        }

        if (($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validateBuyerInfo())) {
            if($this->request->post['buyer_id']){
                $this->model_cms_buyer->editBuyerInfo($this->user->getId(),$this->request->post,$this->request->post['buyer_id']);
            }else{
                $this->model_cms_buyer->addBuyerInfo($this->user->getId(),$this->request->post);
          }

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('cms/buyer/buyerInfoList', 'token=' . $this->session->data['token'], true));
        }
        $data['heading_title'] = $this->language->get('buyer_info_heading_title');
        $data['text_form'] = $this->language->get('text_form');
        $data['entry_nickname'] = $this->language->get('entry_nickname');
        $data['entry_intro'] = $this->language->get('entry_intro');
        $data['entry_introduce'] = $this->language->get('entry_introduce');
        $data['entry_head_image'] = $this->language->get('entry_head_image');
        $data['entry_show_image'] = $this->language->get('entry_show_image');


        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['nickname'])) {
            $data['error_nickname'] = $this->error['nickname'];
        } else {
            $data['error_nickname'] = array();
        }

        if (isset($this->error['intro'])) {
            $data['error_intro'] = $this->error['intro'];
        } else {
            $data['error_intro'] = array();
        }

        if (isset($this->error['introduce'])) {
            $data['error_introduce'] = $this->error['introduce'];
        } else {
            $data['error_introduce'] = array();
        }

        $url = '';

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('buyer_info_heading_title'),
            'href' => $this->url->link('cms/buyer', 'token=' . $this->session->data['token'] . $url, true)
        );

        $data['action'] = $this->url->link('cms/buyer/buyer_info', 'token=' . $this->session->data['token'] . $url, true);

        $data['cancel'] = $this->url->link('cms/buyer', 'token=' . $this->session->data['token'] . $url, true);

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            $buyer_info = $this->request->post['buyer_info'];

            foreach ($buyer_info as $language_id => $row) {
                if (isset($row['nickname'])) {
                    $data['nickname'] = $row['nickname'];
                }else {
                    $data['nickname'] = '';
                }

                if (isset($row['intro'])) {
                    $data['intro'] = $row['intro'];
                }else {
                    $data['intro'] = '';
                }

                if (isset($row['introduce'])) {
                    $data['introduce'] = $row['introduce'];
                }else {
                    $data['introduce'] = '';
                }

                if (isset($row['head_image']) && is_file(DIR_IMAGE . $row['head_image'])) {
                    $data['head_image'] = $row['head_image'];
                }else {
                    $data['head_image'] = 'no_image.png';
                }

                if (isset($row['head_image']) && is_file(DIR_IMAGE . $row['head_image'])) {
                    $data['head_thumb'] = $this->model_tool_image->resize($row['head_image'], 100, 100);
                }else {
                    $data['head_thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
                }

                if (isset($row['show_image']) && is_file(DIR_IMAGE . $row['show_image'])) {
                    $data['show_image'] = $row['show_image'];
                }else {
                    $data['show_image'] = 'no_image.png';
                }

                if (isset($row['show_image']) && is_file(DIR_IMAGE . $row['show_image'])) {
                    $data['show_thumb'] = $this->model_tool_image->resize($row['show_image'], 100, 100);
                }else {
                    $data['show_thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
                }
            }

        }else{

            if (!empty($buyer_info)) {
                $data['nickname'] = $buyer_info['nickname'];
            } else {
                $data['nickname'] = '';
            }

           if (!empty($buyer_info)) {
                $data['intro'] = $buyer_info['intro'];
            } else {
                $data['intro'] = '';
            }

           if (!empty($buyer_info)) {
                $data['introduce'] = $buyer_info['introduce'];
            } else {
                $data['introduce'] = '';
            }

            if (!empty($buyer_info) && is_file(DIR_IMAGE . $buyer_info['head_image'])) {
                $data['head_image'] = $buyer_info['head_image'];
                $data['head_thumb'] = $this->model_tool_image->resize($buyer_info['head_image'], 100, 100);
            } else {
                $data['head_image'] = '';
                $data['head_thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
            }

           if (!empty($buyer_info) && is_file(DIR_IMAGE . $buyer_info['show_image'])) {
               $data['show_image'] = $buyer_info['show_image'];
                $data['show_thumb'] = $this->model_tool_image->resize($buyer_info['show_image'], 100, 100);
            } else {
               $data['show_image'] = '';
                $data['show_thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
            }

        }

        $data['token'] = $this->session->data['token'];

        $data['languages'] = $this->model_localisation_language->getLanguages();

        $data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('cms/buyer_info', $data));
	    
    }

    protected function validateBuyerInfo() {
        if (!$this->user->hasPermission('modify', 'cms/buyer')) {
            $this->error['warning'] = $this->language->get('error_permission_buyer');
        }

        foreach ($this->request->post['buyer_info'] as $language_id => $value) {

            if ((utf8_strlen($value['nickname']) <2) || (utf8_strlen($value['nickname']) > 16)) {
                $this->error['nickname'][$language_id] = $this->language->get('error_nickname');
            }

            if ((utf8_strlen($value['intro']) <2) || (utf8_strlen($value['intro']) > 16)) {
                $this->error['intro'][$language_id] = $this->language->get('error_intro');
            }

            if ((utf8_strlen($value['introduce']) < 8) || (utf8_strlen($value['introduce']) > 64)) {
                $this->error['introduce'][$language_id] = $this->language->get('error_introduce');
            }
        }


        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('error_warning');
        }

        return !$this->error;
    }


    public function deleteBuyerInfo() {
        $this->load->language('cms/buyer');

        $this->document->setTitle($this->language->get('buyer_info_heading_title'));

        $this->load->model('cms/buyer');

        if (isset($this->request->post['selected']) && $this->validateDelete()) {

            foreach ($this->request->post['selected'] as $buyer_id) {
                $blogs = $this->model_cms_buyer->getBuyerBlogByBuyer($buyer_id);
                if(!$blogs){
                    $this->model_cms_buyer->deleteBuyerInfo($buyer_id);
                    $this->session->data['success'] = $this->language->get('text_success');
                }else{
                    $this->session->data['success'] = $this->language->get('text_error');
                    break;
                }

            }



            $url = '';

            if (isset($this->request->get['filter_title'])) {
                $url .= '&filter_title=' . urlencode(html_entity_decode($this->request->get['filter_title'], ENT_QUOTES, 'UTF-8'));
            }


            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->response->redirect($this->url->link('cms/buyer/buyerInfoList', 'token=' . $this->session->data['token'] . $url, true));
        }

        $this->getList();
    }




}