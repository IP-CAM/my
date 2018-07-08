<?php
class ControllerModuleGenerator extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('module/generator');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('generator', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_loading'] = $this->language->get('text_loading');
		$data['text_order_id'] = $this->language->get('text_order_id');
		$data['text_invoice_no'] = $this->language->get('text_invoice_no');
		$data['text_last_order_id'] = $this->language->get('text_last_order_id');
		$data['text_next_order_id'] = $this->language->get('text_next_order_id');
		$data['text_invoice_prefix'] = $this->language->get('text_invoice_prefix');
		$data['text_last_invoice_no'] = $this->language->get('text_last_invoice_no');
		$data['text_random'] = $this->language->get('text_random');
		$data['text_same'] = $this->language->get('text_same');

		$data['entry_id_push'] = $this->language->get('entry_id_push');
		$data['entry_minimum'] = $this->language->get('entry_minimum');
		$data['entry_maximum'] = $this->language->get('entry_maximum');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_type'] = $this->language->get('entry_type');

		$data['help_minimum'] = $this->language->get('help_minimum');
		$data['help_maximum'] = $this->language->get('help_maximum');

		$data['button_refresh'] = $this->language->get('button_refresh');
		$data['button_id_push'] = $this->language->get('button_id_push');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['generator_order_min'])) {
			$data['error_generator_order_min'] = $this->error['generator_order_min'];
		} else {
			$data['error_generator_order_min'] = '';
		}

		if (isset($this->error['generator_order_max'])) {
			$data['error_generator_order_max'] = $this->error['generator_order_max'];
		} else {
			$data['error_generator_order_max'] = '';
		}

		if (isset($this->error['generator_invoice_min'])) {
			$data['error_generator_invoice_min'] = $this->error['generator_invoice_min'];
		} else {
			$data['error_generator_invoice_min'] = '';
		}

		if (isset($this->error['generator_invoice_max'])) {
			$data['error_generator_invoice_max'] = $this->error['generator_invoice_max'];
		} else {
			$data['error_generator_invoice_max'] = '';
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('module/generator', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['action'] = $this->url->link('module/generator', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		$this->load->model('module/generator');

		$data['last_order_id'] = $this->model_module_generator->getLastOrderID();
		$data['next_order_id'] = $this->model_module_generator->getNextOrderID();
		$data['invoice_prefixs'] = $this->model_module_generator->getInvoicePrefix();

		$data['select_invoice_prefix'] = $this->config->get('config_invoice_prefix');

		$data['token'] = $this->session->data['token'];

		if (isset($this->request->post['id_push'])) {
			$data['id_push'] = $this->request->post['id_push'];
        } else {
			$data['id_push'] = '';
        }

		if (isset($this->request->post['generator_order_min'])) {
			$data['generator_order_min'] = $this->request->post['generator_order_min'];
		} elseif ($this->config->get('generator_order_min')) {
			$data['generator_order_min'] = $this->config->get('generator_order_min');
        } else {
			$data['generator_order_min'] = '1';
        }

		if (isset($this->request->post['generator_order_max'])) {
			$data['generator_order_max'] = $this->request->post['generator_order_max'];
		} elseif ($this->config->get('generator_order_max')) {
			$data['generator_order_max'] = $this->config->get('generator_order_max');
        } else {
			$data['generator_order_max'] = '1';
        }

		if (isset($this->request->post['generator_order_status'])) {
			$data['generator_order_status'] = $this->request->post['generator_order_status'];
		} else {
			$data['generator_order_status'] = $this->config->get('generator_order_status');
		}

		if (isset($this->request->post['generator_invoice_type'])) {
			$data['generator_invoice_type'] = $this->request->post['generator_invoice_type'];
		} else {
			$data['generator_invoice_type'] = $this->config->get('generator_invoice_type');
		}

		if (isset($this->request->post['generator_invoice_min'])) {
			$data['generator_invoice_min'] = $this->request->post['generator_invoice_min'];
		} elseif ($this->config->get('generator_invoice_min')) {
			$data['generator_invoice_min'] = $this->config->get('generator_invoice_min');
        } else {
			$data['generator_invoice_min'] = '1';
        }

		if (isset($this->request->post['generator_invoice_max'])) {
			$data['generator_invoice_max'] = $this->request->post['generator_invoice_max'];
		} elseif ($this->config->get('generator_invoice_max')) {
			$data['generator_invoice_max'] = $this->config->get('generator_invoice_max');
        } else {
			$data['generator_invoice_max'] = '1';
        }

		if (isset($this->request->post['generator_invoice_status'])) {
			$data['generator_invoice_status'] = $this->request->post['generator_invoice_status'];
		} else {
			$data['generator_invoice_status'] = $this->config->get('generator_invoice_status');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/generator.tpl', $data));
	}

	public function getLastInvoiceNo() {
		$json = array();

        $this->load->model('module/generator');

		$last_invoice_no = $this->model_module_generator->getLastInvoiceNo($this->request->get['invoice_prefix']);

        if ($last_invoice_no) {
           $json['last_invoice_no'] = $last_invoice_no;
        }

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function push() {
		$json = array();

		$this->load->language('module/generator');
        $this->load->model('module/generator');

		$last_order_id = $this->model_module_generator->getLastOrderID();

		if (!$this->user->hasPermission('modify', 'module/generator')) {
			$json['error'] = $this->language->get('error_permission');
        } else {
          if ((!preg_match('/^[0-9]*$/', $this->request->get['order_id'])) || ($this->request->get['order_id'] < 1) || ($this->request->get['order_id'] > 99999999)) {
             $json['error'] = $this->language->get('error_valid');
          } else {
            if ($this->request->get['order_id'] > $last_order_id) {
               $push_order_id = $this->model_module_generator->setNextOrderID($this->request->get['order_id']);

               if ($push_order_id) {
                  $json['next_order_id'] = $push_order_id;
                  $json['success'] = $this->language->get('text_success');
               } else {
                 $json['error'] = $this->language->get('error_action');
               }
            } else {
              $json['error'] = $this->language->get('error_order_id');
            }
          }
        }
        
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function refresh() {
		$json = array();

        $this->load->model('module/generator');

		$json['last_order_id'] = $this->model_module_generator->getLastOrderID();
		$json['next_order_id'] = $this->model_module_generator->getNextOrderID();
		$json['last_invoice_no'] = $this->model_module_generator->getLastInvoiceNo($this->request->get['invoice_prefix']);

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/generator')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

        if ((!preg_match('/^[0-9]*$/', $this->request->post['generator_order_min'])) || ($this->request->post['generator_order_min'] < 1) || ($this->request->post['generator_order_min'] > 999)) {
            $this->error['generator_order_min'] = $this->language->get('error_number');
        }

        if ((!preg_match('/^[0-9]*$/', $this->request->post['generator_order_max'])) || ($this->request->post['generator_order_max'] < 1) || ($this->request->post['generator_order_max'] > 999)) {
            $this->error['generator_order_max'] = $this->language->get('error_number');
        }

        if ((!preg_match('/^[0-9]*$/', $this->request->post['generator_invoice_min'])) || ($this->request->post['generator_invoice_min'] < 1) || ($this->request->post['generator_invoice_min'] > 999)) {
            $this->error['generator_invoice_min'] = $this->language->get('error_number');
        }

        if ((!preg_match('/^[0-9]*$/', $this->request->post['generator_invoice_max'])) || ($this->request->post['generator_invoice_max'] < 1) || ($this->request->post['generator_invoice_max'] > 999)) {
            $this->error['generator_invoice_max'] = $this->language->get('error_number');
        }

        if ($this->request->post['generator_order_min'] > $this->request->post['generator_order_max']) {
            $this->error['generator_order_min'] = $this->language->get('error_maximum');
            $this->error['generator_order_max'] = $this->language->get('error_maximum');
        }

        if ($this->request->post['generator_invoice_min'] > $this->request->post['generator_invoice_max']) {
            $this->error['generator_invoice_min'] = $this->language->get('error_maximum');
            $this->error['generator_invoice_max'] = $this->language->get('error_maximum');
        }

		return !$this->error;
	}
}
