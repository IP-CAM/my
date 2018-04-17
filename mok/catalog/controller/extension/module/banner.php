<?php
class ControllerExtensionModuleBanner extends Controller {
	public function index($setting) {
		static $module = 0;

		$this->load->model('design/banner');
		$this->load->model('tool/image');
		
		/*
		$this->document->addStyle('catalog/view/javascript/jquery/owl-carousel/owl.carousel.css');
		$this->document->addStyle('catalog/view/javascript/jquery/owl-carousel/owl.transitions.css');
		$this->document->addScript('catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js');
		*/
		$data['title'] = $setting['title'];
		$data['title2'] = $setting['title2'];
		$data['title_href'] = $setting['title_href'];
		$data['title2_href'] = $setting['title2_href'];

		$data['banners'] = array();

		$results = $this->model_design_banner->getBanner($setting['banner_id']);

		foreach ($results as $result) {
			if (is_file(DIR_IMAGE . $result['image'])) {
				$data['banners'][] = array(
					'title' => $result['title'],
					'link'  => $result['link'],
					'image' => $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height'])
				);
			}
		}

		$data['module'] = $module++;
		
		
		if($setting['template_id'] == 1){
			$template = 'extension/module/banner1';
		}else if($setting['template_id'] == 2){
			$template = 'extension/module/banner2';
		}else if($setting['template_id'] == 3){
			$template = 'extension/module/banner3';
		}else{
			$template = 'extension/module/banner';
		}

		return $this->load->view($template, $data);

	}
}