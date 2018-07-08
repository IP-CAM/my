<?php
class ControllerModuleSma extends Controller {
	private $error = array();
	
	public function index() {
		$this->load->language('module/sma');
		
		$this->document->setTitle($this->language->get('text_edit'));
		
		$data['heading_title'] = $this->language->get('heading_title');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->load->model('setting/setting');
			
			$this->model_setting_setting->editSetting('sma', $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('module/sma', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
		$data['text_confirm'] = $this->language->get('text_confirm');
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_log'] = $this->language->get('entry_log');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_add'] = $this->language->get('button_add');
		$data['button_clear'] = $this->language->get('button_clear');
		$data['button_cancel'] = $this->language->get('button_cancel');
		
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
			'text' => $this->language->get('text_edit'),
			'href' => $this->url->link('module/sma', 'token=' . $this->session->data['token'], 'SSL')
		);
		
		$data['action'] = $this->url->link('module/sma', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		if (isset($this->request->post['sma_status'])) {
			$data['sma_status'] = $this->request->post['sma_status'];
		} else {
			$data['sma_status'] = $this->config->get('sma_status');
		}

		$data['clear'] = $this->url->link('module/sma/clear', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['log'] = '';

		$file = DIR_LOGS . 'sma_log.log';

		if (file_exists($file)) {
			$size = filesize($file);

			if ($size >= 5242880) {
				$suffix = array(
					'B',
					'KB',
					'MB',
					'GB',
					'TB',
					'PB',
					'EB',
					'ZB',
					'YB'
				);

				$i = 0;

				while (($size / 1024) > 1) {
					$size = $size / 1024;
					$i++;
				}

				$data['error_warning'] = sprintf($this->language->get('error_warning'), basename($file), round(substr($size, 0, strpos($size, '.') + 4), 2) . $suffix[$i]);
			} else {
				$data['log'] = file_get_contents($file, FILE_USE_INCLUDE_PATH, null);
			}
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view('module/sma.tpl', $data));
	}

	public function clear() {
		$this->load->language('module/sma');

		if (!$this->user->hasPermission('modify', 'module/sma')) {
			$this->session->data['error'] = $this->language->get('error_permission');
		} else {
			$file = DIR_LOGS . 'sma_log.log';

			$handle = fopen($file, 'w+');

			fclose($handle);

			$this->session->data['success'] = $this->language->get('text_success');
		}

		$this->response->redirect($this->url->link('module/sma', 'token=' . $this->session->data['token'], 'SSL'));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/banner')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}