<?php
class ControllerExtensionModuleSettingUpdate extends Controller {
	private $error = array();
	public function index() {
		$this->load->language('extension/module/setting_update');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('setting/setting');
		if (($this->request->server['REQUEST_METHOD'] == 'POST')&& $this->validate()) {
			$this->model_setting_setting->editSetting('setdiy',$this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('extension/module/setting_update', 'token=' . $this->session->data['token'], 'SSL'));
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->session->data['error'])) {
			$data['error'] = $this->session->data['error'];
			unset($this->session->data['error']);
		} else {
			$data['error'] = '';
		}
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
				'text'      => $this->language->get('text_home'),
		'href'      => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
				
		);
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true)
		);
		$data['breadcrumbs'][] = array(
				'text'      => $this->language->get('heading_title'),
		'href'      => $this->url->link('extension/module/setting_update', 'token=' . $this->session->data['token'], 'SSL')
				
		);

        $language_texts=array('heading_title','text_edit','button_save','button_cancel','image_src','image_alt','image_href','text_move','text_add','image_sort','text_enabled','text_disabled','text_search_tags');
        foreach($language_texts as $language_text)
        {
            $data[$language_text]=$this->language->get($language_text);
        }

		$data['setdiy_search_tags']=array();
		if(isset($this->request->post['setdiy_search_tag'])){
			$data['setdiy_search_tags']=$this->request->post['setdiy_search_tag'];
		}elseif($this->config->get('setdiy_search_tag')){
			$data['setdiy_search_tags']=$this->config->get('setdiy_search_tag');
		}

		/*
		//表单提交数组数据存储
		$data['xxxs']=array();
		if(isset($this->request->post['xxx'])){
			$data['xxxs']=$this->request->post['xxx'];
		}elseif($this->config->get('xxx')){
			$data['xxxs']=$this->config->get('xxx');
		}
		*/
		/* action cancel */
		$data['action'] = $this->url->link('extension/module/setting_update', 'token=' . $this->session->data['token'], true);
		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);


		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/setting_update',$data));

	}

	public function validate() {
		if(!$this->user->hasPermission('modify','extension/module/setting_update')){
			$this->error['warning'] = $this->language->get('error_permission');
		}
		return !$this->error;
	}
	}
?>
