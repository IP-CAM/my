<?php
class ControllerMarketingPricing extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('marketing/pricing');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('marketing/pricing');

		$this->getList();
	}

	public function add() {
		$this->load->language('marketing/pricing');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('marketing/pricing');

		if (($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validateForm()) ) {

			$this->model_marketing_pricing->addPricing($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			$this->response->redirect($this->url->link('marketing/pricing', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('marketing/pricing');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('marketing/pricing');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_marketing_pricing->editPricing($this->request->get['pricing_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			$this->response->redirect($this->url->link('marketing/pricing', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('marketing/pricing');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('marketing/pricing');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $pricing_id) {
				$this->model_marketing_pricing->deletePricing($pricing_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

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

			$this->response->redirect($this->url->link('marketing/pricing', 'token=' . $this->session->data['token'] . $url, true));
		}

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
			'href' => $this->url->link('marketing/pricing', 'token=' . $this->session->data['token'] . $url, true)
		);

		$data['add'] = $this->url->link('marketing/pricing/add', 'token=' . $this->session->data['token'] . $url, true);
        $data['delete']  = $this->url->link('marketing/pricing/delete', 'token=' . $this->session->data['token'] . $url, true);


		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$pricing_total = $this->model_marketing_pricing->getTotalPricings();

		$results = $this->model_marketing_pricing->getPricings($filter_data);

        $data['pricings'] = array();

        $this->load->model('catalog/product');

		foreach ($results as $result) {
            $product_info = $this->model_catalog_product->getProduct($result['product']);

           if($product_info){
               $product_name = $product_info['name'];
           }else{
               $product_name = '';
           }

			$data['pricings'][] = array(
				'pricing_id'  => $result['pricing_id'],
				'name'       => $result['name'],
				'description' => htmlspecialchars_decode($result['description']),
				'product_id'   => $result['product'],
                'product_name'   => $product_name,
				'date_start' => date($this->language->get('date_format_short'), strtotime($result['date_start'])),
				'date_end'   => date($this->language->get('date_format_short'), strtotime($result['date_end'])),
                'created'   => date($this->language->get('date_format_short'), strtotime($result['created'])),
				'status'     => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'edit'       => $this->url->link('marketing/pricing/edit', 'token=' . $this->session->data['token'] . '&pricing_id=' . $result['pricing_id'] . $url, true),
                'control'       => $this->url->link('marketing/pricing/control', 'token=' . $this->session->data['token'] . '&pricing_id=' . $result['pricing_id'] . $url, true),
			);
		}
        
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_success'] = $this->language->get('text_success');
		$data['text_list'] = $this->language->get('text_list');
		$data['text_add'] = $this->language->get('text_add');
        $data['text_edit'] = $this->language->get('text_edit');
        $data['text_view'] = $this->language->get('text_view');

		$data['column_name'] = $this->language->get('column_name');
		$data['column_description'] = $this->language->get('column_description');
		$data['column_product'] = $this->language->get('column_product');
		$data['column_persons'] = $this->language->get('column_persons');
		$data['column_date_start'] = $this->language->get('column_date_start');
		$data['column_date_end'] = $this->language->get('column_date_end');
		$data['column_status'] = $this->language->get('column_status');
        $data['column_date_added'] = $this->language->get('column_date_added');
        $data['column_action'] = $this->language->get('column_action');

		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');
        $data['button_view'] = $this->language->get('button_view');
        $data['text_confirm'] = $this->language->get('text_confirm');

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

		$data['sort_pricing_id'] = $this->url->link('marketing/pricing', 'token=' . $this->session->data['token'] . '&sort=pricing_id' . $url, true);
		$data['sort_created'] = $this->url->link('marketing/pricing', 'token=' . $this->session->data['token'] . '&sort=created' . $url, true);
		$data['sort_date_start'] = $this->url->link('marketing/pricing', 'token=' . $this->session->data['token'] . '&sort=date_start' . $url, true);
		$data['sort_date_end'] = $this->url->link('marketing/pricing', 'token=' . $this->session->data['token'] . '&sort=date_end' . $url, true);
		$data['sort_status'] = $this->url->link('marketing/pricing', 'token=' . $this->session->data['token'] . '&sort=status' . $url, true);

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $pricing_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('marketing/pricing', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($pricing_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($pricing_total - $this->config->get('config_limit_admin'))) ? $pricing_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $pricing_total, ceil($pricing_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('marketing/pricing_list', $data));
	}

	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = !isset($this->request->get['pricing_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['entry_name'] = $this->language->get('entry_name');
        $data['entry_show_image'] = $this->language->get('entry_show_image');
        $data['entry_product_image_description'] = $this->language->get('entry_product_image_description');
		$data['entry_description'] = $this->language->get('entry_description');
        $data['entry_product_description'] = $this->language->get('entry_product_description');
		$data['entry_date_start'] = $this->language->get('entry_date_start');
        $data['entry_product'] = $this->language->get('entry_product');
		$data['entry_date_end'] = $this->language->get('entry_date_end');
		$data['entry_status'] = $this->language->get('entry_status');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$data['token'] = $this->session->data['token'];

        $this->load->model('localisation/language');

        $data['languages'] = $this->model_localisation_language->getLanguages();

        $this->load->model('tool/image');

        $data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);

		if (isset($this->request->get['pricing_id'])) {
			$data['pricing_id'] = $this->request->get['pricing_id'];
		} else {
			$data['pricing_id'] = 0;
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['date_start'])) {
			$data['error_date_start'] = $this->error['date_start'];
		} else {
			$data['error_date_start'] = '';
		}

		if (isset($this->error['date_end'])) {
			$data['error_date_end'] = $this->error['date_end'];
		} else {
			$data['error_date_end'] = '';
		}

		$url = '';

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('marketing/pricing', 'token=' . $this->session->data['token'] . $url, true)
		);

		if (!isset($this->request->get['pricing_id'])) {
			$data['action'] = $this->url->link('marketing/pricing/add', 'token=' . $this->session->data['token'] . $url, true);
		} else {
			$data['action'] = $this->url->link('marketing/pricing/edit', 'token=' . $this->session->data['token'] . '&pricing_id=' . $this->request->get['pricing_id'] . $url, true);
		}

		$data['cancel'] = $this->url->link('marketing/pricing', 'token=' . $this->session->data['token'] . $url, true);

		if (isset($this->request->get['pricing_id']) && (!$this->request->server['REQUEST_METHOD'] != 'POST')) {
			$pricing_info = $this->model_marketing_pricing->getInfo($this->request->get['pricing_id']);
		}

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($pricing_info)) {
			$data['name'] = $pricing_info['name'];
		} else {
			$data['name'] = '';
		}

        if (isset($this->request->post['show_image'])) {
            $data['show_image'] = $this->request->post['show_image'];
        } elseif (!empty($pricing_info)) {
            $data['show_image'] = $pricing_info['show_image'];
        } else {
            $data['show_image'] = '';
        }

        if (isset($this->request->post['product_image_description'])) {
            $data['product_image_description'] = $this->request->post['product_image_description'];
        } elseif (!empty($pricing_info)) {
            $data['product_image_description'] = $pricing_info['product_image_description'];
        } else {
            $data['product_image_description'] = '';
        }

        if (isset($this->request->post['description'])) {
            $data['description'] = $this->request->post['description'];
        } elseif (!empty($pricing_info)) {
            $data['description'] = $pricing_info['description'];
        } else {
            $data['name'] = '';
        }

        if (isset($this->request->post['product_description'])) {
            $data['product_description'] = $this->request->post['product_description'];
        } elseif (!empty($pricing_info)) {
            $data['product_description'] = $pricing_info['product_description'];
        } else {
            $data['product_description'] = '';
        }

		if (isset($this->request->post['pricing_product'])) {
			$products = $this->request->post['pricing_product'];
		} elseif (isset($this->request->get['pricing_id'])) {
			$products = $pricing_info['product'];
		} else {
			$products = array();
		}

        if (isset($this->request->post['show_image']) && is_file(DIR_IMAGE . $this->request->post['show_image'])) {
            $data['show_thumb'] = $this->model_tool_image->resize($this->request->post['show_image'], 100, 100);
        } elseif (!empty($pricing_info) && is_file(DIR_IMAGE . $pricing_info['show_image'])) {
            $data['show_thumb'] = $this->model_tool_image->resize($pricing_info['show_image'], 100, 100);
        } else {
            $data['show_thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
        }

        if (isset($this->request->post['product_image_description']) && is_file(DIR_IMAGE . $this->request->post['product_image_description'])) {
            $data['product_thumb_description'] = $this->model_tool_image->resize($this->request->post['product_image_description'], 100, 100);
        } elseif (!empty($pricing_info) && is_file(DIR_IMAGE . $pricing_info['product_image_description'])) {
            $data['product_thumb_description'] = $this->model_tool_image->resize($pricing_info['product_image_description'], 100, 100);
        } else {
            $data['product_thumb_description'] = $this->model_tool_image->resize('no_image.png', 100, 100);
        }

		$this->load->model('catalog/product');

		$data['pricing_product'] = array();

		//foreach ($products as $product_id) {
			$product_info = $this->model_catalog_product->getProduct($products);

			if ($product_info) {
				$data['pricing_product'][] = array(
					'product_id' => $product_info['product_id'],
					'name'       => $product_info['name']
				);
			}
		//}


		if (isset($this->request->post['date_start'])) {
			$data['date_start'] = $this->request->post['date_start'];
		} elseif (!empty($pricing_info)) {
			$data['date_start'] = ($pricing_info['date_start'] != '0000-00-00' ? $pricing_info['date_start'] : '');
		} else {
			$data['date_start'] = date('Y-m-d', time());
		}

		if (isset($this->request->post['date_end'])) {
			$data['date_end'] = $this->request->post['date_end'];
		} elseif (!empty($pricing_info)) {
			$data['date_end'] = ($pricing_info['date_end'] != '0000-00-00' ? $pricing_info['date_end'] : '');
		} else {
			$data['date_end'] = date('Y-m-d', strtotime('+1 month'));
		}

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($pricing_info)) {
			$data['status'] = $pricing_info['status'];
		} else {
			$data['status'] = true;
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('marketing/pricing_form', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'marketing/pricing')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'marketing/pricing')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	public function control(){
        $this->load->language('marketing/pricing');

        $this->document->setTitle($this->language->get('heading_title_customer'));

        $this->load->model('marketing/pricing');

        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'pricing_customer_id';
        }

        if (isset($this->request->get['order'])) {
            $order = $this->request->get['order'];
        } else {
            $order = 'DESC';
        }

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        if (isset($this->request->get['pricing_id'])) {
            $pricing_id = $this->request->get['pricing_id'];
        } else {
            $pricing_id = '';
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

        if (isset($this->request->get['pricing_id'])) {
            $url .= '&pricing_id=' . $this->request->get['pricing_id'];
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('marketing/pricing', 'token=' . $this->session->data['token'] . $url, true)
        );

        $pricing_info = $this->model_marketing_pricing->getInfo($pricing_id);
        $pricing_name = $pricing_info['name'];

        $data['breadcrumbs'][] = array(
            'text' => $pricing_name,
            'href' => 'javascript:;'
        );

        $data['add'] = $this->url->link('marketing/pricing/add', 'token=' . $this->session->data['token'] . $url, true);

        $data['control'] = $this->url->link('marketing/pricing/control', 'token=' . $this->session->data['token'] . $url, true);

        $filter_data = array(
            'sort'  => $sort,
            'order' => $order,
            'pricing_id' => $pricing_id,
            'start' => ($page - 1) * $this->config->get('config_limit_admin'),
            'limit' => $this->config->get('config_limit_admin')
        );

        $pricing_total = $this->model_marketing_pricing->getTotalCustomerByPricing($pricing_id);

        $results = $this->model_marketing_pricing->getCustomersByPricing($filter_data);

        $data['customers_info'] = array();

        foreach ($results as $result) {

            $data['customers_info'][] = array(
                'customer_id'  => $result['customer_id'],
                'nickname'       => $result['firstname'],
                'price'       => $result['price'],
                'created'   => $result['created'],

                'status'     => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
               // 'edit'       => $this->url->link('marketing/pricing/edit', 'token=' . $this->session->data['token'] . '&pricing_id=' . $result['pricing_id'] . $url, true),
               // 'control'       => $this->url->link('marketing/pricing/control', 'token=' . $this->session->data['token'] . '&pricing_id=' . $result['pricing_id'] . $url, true)
            );
        }

        $data['heading_title'] = $this->language->get('heading_title_customer');

        $data['text_success'] = $this->language->get('text_success');
        $data['text_customer_list'] = $this->language->get('text_customer_list');


        $data['text_no_results'] = $this->language->get('text_no_results');

        $data['column_customer_id'] = $this->language->get('column_customer_id');
        $data['column_customer_nickname'] = $this->language->get('column_customer_nickname');
        $data['column_customer_price'] = $this->language->get('column_customer_price');
        $data['column_customer_status'] = $this->language->get('column_customer_status');
        $data['column_customer_time'] = $this->language->get('column_customer_time');
        $data['column_customer_action'] = $this->language->get('column_customer_action');

        $data['button_add'] = $this->language->get('button_add');

        $data['button_view'] = $this->language->get('button_view');

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
            $url .= '&order=ASC';
        } else {
            $url .= '&order=DESC';
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data['sort_pricing_id'] = $this->url->link('marketing/pricing', 'token=' . $this->session->data['token'] . '&sort=pricing_id' . $url, true);
        $data['sort_created'] = $this->url->link('marketing/pricing', 'token=' . $this->session->data['token'] . '&sort=created' . $url, true);
        $data['sort_date_start'] = $this->url->link('marketing/pricing', 'token=' . $this->session->data['token'] . '&sort=date_start' . $url, true);
        $data['sort_date_end'] = $this->url->link('marketing/pricing', 'token=' . $this->session->data['token'] . '&sort=date_end' . $url, true);
        $data['sort_status'] = $this->url->link('marketing/pricing', 'token=' . $this->session->data['token'] . '&sort=status' . $url, true);

        $url = '';

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        $pagination = new Pagination();
        $pagination->total = $pricing_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_limit_admin');
        $pagination->url = $this->url->link('marketing/pricing', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($pricing_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($pricing_total - $this->config->get('config_limit_admin'))) ? $pricing_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $pricing_total, ceil($pricing_total / $this->config->get('config_limit_admin')));

        $data['sort'] = $sort;
        $data['order'] = $order;

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('marketing/pricing_customers_info', $data));

    }

}