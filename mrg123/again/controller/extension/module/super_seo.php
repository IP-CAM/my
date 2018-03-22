<?php
class ControllerExtensionModuleSuperSeo extends Controller {
	private $error = array();
	public function index() {
		$this->load->language('extension/module/super_seo');
		$this->load->model('design/super_seo');
		$this->document->setTitle($this->language->get('heading_title'));
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$query = $this->request->post['route'];
			$keyword = $this->request->post['url'];
			$this->model_design_super_seo->addUrlAlias($query,$keyword);
			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('extension/module/super_seo', 'token=' . $this->session->data['token'], 'SSL'));
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
		'href'      => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);
		$data['breadcrumbs'][] = array(
				'text'      => $this->language->get('text_extension'),
		'href'      => $this->url->link('extension/extension', 'token=' . $this->session->data['token'], true)
		);
		$data['breadcrumbs'][] = array(
				'text'      => $this->language->get('heading_title'),
		'href'      => $this->url->link('extension/module/super_seo', 'token=' . $this->session->data['token'], true)
		);
		
		$language_texts=array('heading_title','text_edit','button_save','button_cancel','button_delete','description_route','description_url');
        foreach($language_texts as $language_text)
        {
            $data[$language_text]=$this->language->get($language_text);
        }
		
		$data['super_seo_urls'] = array();
		$results = $this->model_design_super_seo->getUrlAlias();
		foreach($results as $result) {
			$data['super_seo_urls'][] = array(
				'query' => $result['query'],
				'keyword' => $result['keyword'],
				'delete' => $this->url->link('extension/module/super_seo/delete' . '&query=' . $result['query'] . '&keyword=' . $result['keyword'],'token=' . $this->session->data['token'],'SSL')
			);
		}
		
		$data['action'] = $this->url->link('extension/module/super_seo', 'token=' . $this->session->data['token'], 'SSL');
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
						
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view('extension/module/super_seo.tpl', $data));

	}
	public function delete() {
		$this->load->language('extension/module/super_seo');
		$this->load->model('design/super_seo');
		if (!$this->user->hasPermission('modify', 'extension/module/super_seo')) {
			$this->session->data['error'] = $this->language->get('no_permission');
			$this->response->redirect($this->url->link('extension/module/super_seo', 'token=' . $this->session->data['token'], 'SSL'));
		}	
		
			$route = $this->request->get['query'];
			$url = $this->request->get['keyword'];
			$this->model_design_super_seo->deleteUrlAlias($route,$url);

			$this->session->data['success'] = $this->language->get('success_delete');
			$this->response->redirect($this->url->link('extension/module/super_seo', 'token=' . $this->session->data['token'], 'SSL'));

	}

	private function validate() {
		if (isset($this->request->post['route'])) {
			$description_route = trim($this->request->post['route']);
			$sameroute = $this->model_design_super_seo->getUrlByRoute($description_route);
			if($sameroute) {
				$this->error['warning'] = $this->language->get('same_route');
			}
		}else {
			$description_route = null;
		}
		if (isset($this->request->post['url'])) {
			$description_url = trim($this->request->post['url']);
			$samekeyword = $this->model_design_super_seo->getUrlByKeyword($description_url);
			if($samekeyword) {
				$this->error['warning'] = $this->language->get('same_keyword');
			}
		}else {
			$description_url = null;
			
		}

		if (!$this->user->hasPermission('modify', 'extension/module/super_seo')) {
			$this->error['warning'] = $this->language->get('no_permission');
		}
		if (empty($description_route) || empty($description_url) ){
			$this->error['warning'] = $this->language->get('specify');;
		}
				
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}

}
?>
