<?php
class ControllerLocalisationExpress extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('localisation/express');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/express');

		$this->getList();
	}

	public function add() {
		$this->load->language('localisation/express');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/express');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_localisation_express->addExpress($this->request->post);

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

			$this->response->redirect($this->url->link('localisation/express', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('localisation/express');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/express');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_localisation_express->editExpress($this->request->get['express_id'], $this->request->post);

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

			$this->response->redirect($this->url->link('localisation/express', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('localisation/express');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/express');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $express_id) {
				$this->model_localisation_express->deleteExpress($express_id);
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

			$this->response->redirect($this->url->link('localisation/express', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('localisation/express', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);
		
		$data['allocate'] = $this->url->link('localisation/allocate', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['add'] = $this->url->link('localisation/express/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('localisation/express/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['expresses'] = array();

		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$express_total = $this->model_localisation_express->getTotalExpresses();

		$results = $this->model_localisation_express->getExpresses($filter_data);

		foreach ($results as $result) {
			$data['expresses'][] = array(
				'express_id' => $result['express_id'],
				'name'      => $result['name'],
				'status'    => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'edit'      => $this->url->link('localisation/express/edit', 'token=' . $this->session->data['token'] . '&express_id=' . $result['express_id'] . $url, 'SSL')
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_name'] = $this->language->get('column_name');
		$data['column_status'] = $this->language->get('column_status');
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

		$data['sort_name'] = $this->url->link('localisation/express', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
		$data['sort_status'] = $this->url->link('localisation/express', 'token=' . $this->session->data['token'] . '&sort=status' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $express_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('localisation/express', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($express_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($express_total - $this->config->get('config_limit_admin'))) ? $express_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $express_total, ceil($express_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('localisation/express_list.tpl', $data));
	}

	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_form'] = !isset($this->request->get['express_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_change'] = $this->language->get('text_change');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_width'] = $this->language->get('entry_width');
		$data['entry_height'] = $this->language->get('entry_height');
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_data'] = $this->language->get('entry_data');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		
		$data['value_ship_name'] = $this->language->get('value_ship_name');
		$data['value_ship_country'] = $this->language->get('value_ship_country');
		$data['value_ship_address'] = $this->language->get('value_ship_address');
		$data['value_ship_postcode'] = $this->language->get('value_ship_postcode');
		$data['value_ship_telphone'] = $this->language->get('value_ship_telphone');
		$data['value_dly_name'] = $this->language->get('value_dly_name');
		$data['value_dly_country'] = $this->language->get('value_dly_country');
		$data['value_dly_address'] = $this->language->get('value_dly_address');
		$data['value_dly_postcode'] = $this->language->get('value_dly_postcode');
		$data['value_dly_telphone'] = $this->language->get('value_dly_telphone');
		$data['value_store_name'] = $this->language->get('value_store_name');
		$data['value_store_url'] = $this->language->get('value_store_url');
		$data['value_tick'] = $this->language->get('value_tick');
		$data['value_custom'] = $this->language->get('value_custom');
		
		$data['value_date_year'] = $this->language->get('value_date_year');
		$data['value_date_month'] = $this->language->get('value_date_month');
		$data['value_date_day'] = $this->language->get('value_date_day');
		$data['value_date_time'] = $this->language->get('value_date_time');
		
		$data['value_order_id'] = $this->language->get('value_order_id');
		$data['value_order_weight'] = $this->language->get('value_order_weight');
		$data['value_order_total'] = $this->language->get('value_order_total');
		$data['value_order_total_number'] = $this->language->get('value_order_total_number');
		$data['value_order_currency'] = $this->language->get('value_order_currency');
		$data['value_order_qty'] = $this->language->get('value_order_qty');
		$data['value_order_comment'] = $this->language->get('value_order_comment');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_express_add'] = $this->language->get('button_express_add');
		$data['button_remove'] = $this->language->get('button_remove');
		
		$data['order_status'] = $this->model_localisation_express->getOrderStatus();
		$data['shipping_methods'] = $this->model_localisation_express->getShippingMethods();

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}

		if (isset($this->error['width'])) {
			$data['error_width'] = $this->error['width'];
		} else {
			$data['error_width'] = '';
		}

		if (isset($this->error['height'])) {
			$data['error_height'] = $this->error['height'];
		} else {
			$data['error_height'] = '';
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
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('localisation/express', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);
		
		if (!isset($this->request->get['express_id'])) {
			$data['action'] = $this->url->link('localisation/express/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('localisation/express/edit', 'token=' . $this->session->data['token'] . '&express_id=' . $this->request->get['express_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('localisation/express', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['express_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$express_info = $this->model_localisation_express->getExpress($this->request->get['express_id']);
		}

		$data['token'] = $this->session->data['token'];

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($express_info)) {
			$data['name'] = $express_info['name'];
		} else {
			$data['name'] = '';
		}

		if (isset($this->request->post['printer'])) {
			$data['printer'] = $this->request->post['printer'];
		} elseif (!empty($express_info)) {
			$data['printer'] = $express_info['printer'];
		} else {
			$data['printer'] = '';
		}

		if (isset($this->request->post['papersize'])) {
			$data['papersize'] = $this->request->post['papersize'];
		} elseif (!empty($express_info) && !empty($express_info['papersize'])) {
			$data['papersize'] = $express_info['papersize'];
		} else {
			$data['papersize'] = 'A4';
		}

		if (isset($this->request->post['shippings'])) {
			$shippings = $this->request->post['shippings'];
		} elseif (!empty($express_info)) {
			$shippings = $express_info['shippings']?unserialize($express_info['shippings']):array();
		} else {
			$shippings = array();
		}
		
		$data['shippings'] = array();
		
		foreach ($shippings as $shipping) {
			$shipping = explode('|||',$shipping);
			
			$data['shippings'][] = array(
				'order_status_id'  => $shipping[0],
				'shipping_code'    => $shipping[1],
				'text'             => $shipping[2]
			);
		}

		if (isset($this->request->post['left'])) {
			$data['left'] = $this->request->post['left'];
		} elseif (!empty($express_info)) {
			$data['left'] = $express_info['left'];
		} else {
			$data['left'] = 0;
		}

		if (isset($this->request->post['top'])) {
			$data['top'] = $this->request->post['top'];
		} elseif (!empty($express_info)) {
			$data['top'] = $express_info['top'];
		} else {
			$data['top'] = 0;
		}

		if (isset($this->request->post['width'])) {
			$data['width'] = $this->request->post['width'];
		} elseif (!empty($express_info)) {
			$data['width'] = $express_info['width'];
		} else {
			$data['width'] = '0';
		}

		if (isset($this->request->post['height'])) {
			$data['height'] = $this->request->post['height'];
		} elseif (!empty($express_info)) {
			$data['height'] = $express_info['height'];
		} else {
			$data['height'] = '0';
		}

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($express_info)) {
			$data['status'] = $express_info['status'];
		} else {
			$data['status'] = true;
		}
		
		if ($this->request->server['HTTPS']) {
			$server = HTTPS_CATALOG;
		} else {
			$server = HTTP_CATALOG;
		}

		if (isset($this->request->post['image'])) {
			$data['image'] = $this->request->post['image'];
			$data['thumb'] = $server . 'image/' . $this->request->post['image'];
		} elseif (!empty($express_info)) {
			$data['image'] = $express_info['image'];
			$data['thumb'] = $server . 'image/' . $express_info['image'];
		} else {
			$data['image'] = '';
			$data['thumb'] = false;
		}

		if (isset($this->request->post['value'])) {
			$data['value'] = $this->request->post['value'];
		} elseif (!empty($express_info)) {
			$data['value'] = $express_info['value']?unserialize($express_info['value']):array();
		} else {
			$data['value'] = array();
		}

		if (isset($this->request->post['custom'])) {
			$data['custom'] = $this->request->post['custom'];
		} elseif (!empty($express_info)) {
			$data['custom'] = $express_info['custom']?unserialize($express_info['custom']):array();
		} else {
			$data['custom'] = array();
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('localisation/express_form.tpl', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'localisation/express')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['name']) < 2) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'localisation/express')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}