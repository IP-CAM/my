<?php
class ControllerDesignGeoAd extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('design/geo_ad');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('design/geo_ad');

		$this->getList();
	}

	public function add() {
		$this->load->language('design/geo_ad');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('design/geo_ad');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_design_geo_ad->addGeoAd($this->request->post);

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

			$this->response->redirect($this->url->link('design/geo_ad', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('design/geo_ad');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('design/geo_ad');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_design_geo_ad->editGeoAd($this->request->get['geo_ad_id'], $this->request->post);

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

			$this->response->redirect($this->url->link('design/geo_ad', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('design/geo_ad');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('design/geo_ad');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $geo_ad_id) {
				$this->model_design_geo_ad->deleteGeoAd($geo_ad_id);
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

			$this->response->redirect($this->url->link('design/geo_ad', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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
			'href' => $this->url->link('design/geo_ad', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);
		
		$data['add'] = $this->url->link('design/geo_ad/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('design/geo_ad/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['geo_ads'] = array();

		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$geo_ad_total = $this->model_design_geo_ad->getTotalGeoAds();

		$results = $this->model_design_geo_ad->getGeoAds($filter_data);

		foreach ($results as $result) {
			$data['geo_ads'][] = array(
				'geo_ad_id' => $result['geo_ad_id'],
				'name'      => $result['name'],
				'status'    => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'edit'      => $this->url->link('design/geo_ad/edit', 'token=' . $this->session->data['token'] . '&geo_ad_id=' . $result['geo_ad_id'] . $url, 'SSL')
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

		$data['sort_name'] = $this->url->link('design/geo_ad', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
		$data['sort_status'] = $this->url->link('design/geo_ad', 'token=' . $this->session->data['token'] . '&sort=status' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $geo_ad_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('design/geo_ad', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($geo_ad_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($geo_ad_total - $this->config->get('config_limit_admin'))) ? $geo_ad_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $geo_ad_total, ceil($geo_ad_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('design/geo_ad_list.tpl', $data));
	}

	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_form'] = !isset($this->request->get['geo_ad_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_add'] = $this->language->get('text_add');
		$data['text_group'] = $this->language->get('text_group');
		$data['text_group_add'] = $this->language->get('text_group_add');
		$data['text_image'] = $this->language->get('text_image');
		$data['text_image_add'] = $this->language->get('text_image_add');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_size'] = $this->language->get('entry_size');
		$data['entry_width'] = $this->language->get('entry_width');
		$data['entry_height'] = $this->language->get('entry_height');
		$data['entry_country'] = $this->language->get('entry_country');
		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_title_show'] = $this->language->get('entry_title_show');
		$data['entry_description'] = $this->language->get('entry_description');
		$data['entry_description_show'] = $this->language->get('entry_description_show');
		$data['entry_link'] = $this->language->get('entry_link');
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_code'] = $this->language->get('entry_code');
		
		$data['help_country'] = $this->language->get('help_country');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_geo_ad_add'] = $this->language->get('button_geo_ad_add');
		$data['button_remove'] = $this->language->get('button_remove');

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

		if (isset($this->error['geo_ad_image'])) {
			$data['error_geo_ad_image'] = $this->error['geo_ad_image'];
		} else {
			$data['error_geo_ad_image'] = array();
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
			'href' => $this->url->link('design/geo_ad', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);
		
		if (!isset($this->request->get['geo_ad_id'])) {
			$data['action'] = $this->url->link('design/geo_ad/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('design/geo_ad/edit', 'token=' . $this->session->data['token'] . '&geo_ad_id=' . $this->request->get['geo_ad_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('design/geo_ad', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['geo_ad_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$geo_ad_info = $this->model_design_geo_ad->getGeoAd($this->request->get['geo_ad_id']);
		}

		$this->load->model('tool/image');

		$data['token'] = $this->session->data['token'];

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($geo_ad_info)) {
			$data['name'] = $geo_ad_info['name'];
		} else {
			$data['name'] = '';
		}

		if (isset($this->request->post['width'])) {
			$data['width'] = $this->request->post['width'];
		} elseif (!empty($geo_ad_info)) {
			$data['width'] = $geo_ad_info['width'];
		} else {
			$data['width'] = '';
		}

		if (isset($this->request->post['height'])) {
			$data['height'] = $this->request->post['height'];
		} elseif (!empty($geo_ad_info)) {
			$data['height'] = $geo_ad_info['height'];
		} else {
			$data['height'] = '';
		}

		if (isset($this->request->post['path'])) {
			$data['path'] = $this->request->post['path'];
		} elseif (!empty($geo_ad_info)) {
			$data['path'] = $geo_ad_info['path'];
		} else {
			$data['path'] = '';
		}

		if (isset($this->request->post['path']) && is_file(DIR_IMAGE . $this->request->post['path'])) {
			$data['path_logo'] = $this->model_tool_image->resize($this->request->post['config_logo'], 100, 100);
		} elseif (!empty($geo_ad_info) && is_file(DIR_IMAGE . $geo_ad_info['path'])) {
			$data['path_logo'] = $this->model_tool_image->resize($geo_ad_info['path'], 100, 100);
		} else {
			$data['path_logo'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($geo_ad_info)) {
			$data['status'] = $geo_ad_info['status'];
		} else {
			$data['status'] = false;
		}

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['geo_ad_image'])) {
			$geo_ad_images = $this->request->post['geo_ad_image'];
		} elseif (isset($this->request->get['geo_ad_id'])) {
			$geo_ad_images = $this->model_design_geo_ad->getGeoAdImages($this->request->get['geo_ad_id']);
		} else {
			$geo_ad_images = array();
		}

		$data['geo_ad_images'] = array();

		foreach ($geo_ad_images as $geo_key => $geo_ad_image) {			
			$geo_ad_image_descriptions = array();
			
			if (!empty($geo_ad_image['geo_ad_image_description'])) {
				foreach ($geo_ad_image['geo_ad_image_description'] as $geo_ad_image_description) {
					$image = array();
					$thumb = array();
					
					foreach ($geo_ad_image_description['image'] as $key => $path) {
						if (is_file(DIR_IMAGE . $path)) {
							$image[$key] = $path;
							$thumb[$key] = $this->model_tool_image->resize($path, 100, 100);
						} else {
							$image[$key] = '';
							$thumb[$key] = $this->model_tool_image->resize('no_image.png', 100, 100);
						}
					}
					
					$geo_ad_image_descriptions[] = array(
						'geo_ad_image_id'          => isset($geo_ad_image_description['geo_ad_image_id'])?$geo_ad_image_description['geo_ad_image_id']:$geo_key,
						'title'                    => $geo_ad_image_description['title'],
						'link'                     => $geo_ad_image_description['link'],
						'image'                    => $image,
						'thumb'                    => $thumb,
						'sort_order'               => $geo_ad_image_description['sort_order']
					);
				}
			}
			
			$country = is_array($geo_ad_image['country'])?$geo_ad_image['country']:explode(',', $geo_ad_image['country']);

			$data['geo_ad_images'][] = array(
				'geo_ad_image_id'          => isset($geo_ad_image['geo_ad_image_id'])?$geo_ad_image['geo_ad_image_id']:$geo_key,
				'country'                  => $country,
				'geo_ad_image_description' => $geo_ad_image_descriptions
			);
		}

		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		
		if (isset($this->request->get['geo_ad_id'])) {
			$link = html_entity_decode($this->url->link('information/geo_ad', 'id='.$this->request->get['geo_ad_id']), ENT_QUOTES, 'UTF-8');
			$link = str_replace(HTTP_SERVER, HTTPS_CATALOG, $link);
			$code = '<script src="'.$link.'" type="text/javascript"></script>';
			
			$data['code'] = htmlentities($code, ENT_QUOTES, 'UTF-8');
		} else {
			$data['code'] = '';
		}

		$this->load->model('localisation/country');
		
		$data['countries'] = array();

		$countries = $this->model_localisation_country->getCountries();
		
		foreach ($countries as $c) {
			$data['countries'][] = array(
				'country_id' => $c['country_id'],
				'name'       => $c['name'],
				'iso_code_2' => $c['iso_code_2'],
				'iso_code_3' => $c['iso_code_3'],
				'address_format' => $c['address_format']
			);
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('design/geo_ad_form.tpl', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'design/geo_ad')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['name']) < 2) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}

		if ((int)$this->request->post['width'] < 1) {
			$this->error['warning'] = 'width error';
		}

		if ((int)$this->request->post['height'] < 1) {
			$this->error['warning'] = 'height error';
		}

		/*if (isset($this->request->post['geo_ad_image'])) {
			foreach ($this->request->post['geo_ad_image'] as $geo_ad_image_id => $geo_ad_image) {
				foreach ($geo_ad_image['geo_ad_image_description'] as $language_id => $geo_ad_image_description) {
					if ((utf8_strlen($geo_ad_image_description['title']) < 2) || (utf8_strlen($geo_ad_image_description['title']) > 64)) {
						$this->error['geo_ad_image'][$geo_ad_image_id][$language_id] = $this->language->get('error_title');
					}
				}
			}
		}*/

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'design/geo_ad')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}