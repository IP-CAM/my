<?php
class ControllerModuleAdvProfitReports extends Controller {
	private $error = array(); 

	public function index() {  		
		$this->load->language('module/adv_profit_reports');
		
		$this->document->setTitle($this->language->get('heading_title_main'));

		$data['heading_title_main'] = $this->language->get('heading_title_main');
		$data['text_edit'] = $this->language->get('text_edit');
			
		$data['tab_about'] = $this->language->get('tab_about');
		
		$data['text_help_request'] = $this->language->get('text_help_request');
		$data['text_asking_help'] = $this->language->get('text_asking_help');		
		$data['text_terms'] = $this->language->get('text_terms');		

		$data['adv_sop_ext_version'] = '';
		$data['adv_ppp_ext_version'] = '';
		$data['adv_cop_ext_version'] = '';
		$data['adv_invsv_ext_version'] = '';
		$data['adv_sop_version'] = '';
		$data['adv_ppp_version'] = '';
		$data['adv_cop_version'] = '';
		$data['adv_invsv_version'] = '';

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['button_cancel'] = $this->language->get('button_cancel');	
		
		$data['token'] = $this->session->data['token'];
		
  		$data['breadcrumbs'] = array();
		
   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')

   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/adv_profit_reports', 'token=' . $this->session->data['token'], 'SSL')
   		);
		
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
				
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/adv_profit_reports.tpl', $data));
	}
	
	public function install(){
		$this->load->model('user/user_group');
		$this->model_user_user_group->addPermission($this->user->getId(), 'access', 'module/adv_profit_reports');
		$this->model_user_user_group->addPermission($this->user->getId(), 'modify', 'module/adv_profit_reports');	
	}

	public function uninstall(){
		$this->load->model('extension/extension');
		$this->model_extension_extension->uninstall('module', 'adv_profit_reports');
	}
}