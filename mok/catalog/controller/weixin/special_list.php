<?php
class ControllerWeixinSpecialList extends Controller {
	public function index() {
		
		$this->load->language('weixin/special_list');
		$this->document->setTitle($this->language->get('meta_title'));
		$this->document->setDescription($this->language->get('meta_description'));
		$this->document->setKeywords($this->language->get('meta_keyword'));

		if (isset($this->request->get['route'])) {
			$this->document->addLink($this->url->link('weixin/special_list','',true), 'canonical');
		}
		
		$this->document->addStyle('catalog/view/theme/default/css/special_index.css');
		$this->document->addStyle('catalog/view/theme/default/css/home.css');
		
		$this->document->addScript('catalog/view/theme/default/script/zepto.min.js','footer');
		$this->document->addScript('catalog/view/theme/default/script/zepto.lazyload.min.js','footer');


		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		
		$data['footer'] = $this->load->controller('weixin/footer');
		$data['header'] = $this->load->controller('weixin/header');

		$this->response->setOutput($this->load->view('weixin/special_list', $data));
	}
}