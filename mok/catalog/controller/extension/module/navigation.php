<?php 
class ControllerExtensionModuleNavigation extends Controller {
	
	public function index($setting) {
		
		$data = array();
		$data['setting'] = $setting;
		$this->load->language('extension/module/navigation');
		$data['text_search_placeholder'] = $this->language->get('text_search_placeholder');
		
		$data['amount'] = $this->cart->countProducts();
		
		$data['cart'] = $this->url->link('checkout/cart','',true);
		$data['search'] = $this->url->link('product/search','',true);
		$data['ok_head_on_url'] = $this->request->get['route'];
		if(isset($this->request->get['way'])){
			$data['ok_head_on_url'] = 'way='.$this->request->get['way'];
		}
		
		$navs = $setting['module_description'];
		$data['navs'] = array();
		$language_id = $this->config->get('config_language_id');
		$data['language_id'] = $language_id;
		foreach($navs as $nav){
			$data['navs'][] = $nav[$language_id];
		}
		
		if($setting['template_id'] == 1){
			$template = 'extension/module/navigation1';
		}else if($setting['template_id'] == 2){
			$template = 'extension/module/navigation2';
		}else if($setting['template_id'] == 3){
			$template = 'extension/module/navigation3';
		}else{
			$template = 'extension/module/navigation';
		}

		return $this->load->view($template, $data);
	}
	
}

?>