<?php
class ControllerExtensionModuleWxSlideshow extends Controller {
	public function index($setting) {
		static $module = 0;		

		$this->load->model('design/banner');
		$this->load->model('tool/image');

		$this->document->addStyle('catalog/view/javascript/jquery/owl-carousel/owl.carousel.css');
		$this->document->addScript('catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js');

		$data['banners'] = array();

		$results0 = $this->model_design_banner->getBanner($setting['banner_id0']);
		$results1 = $this->model_design_banner->getBanner($setting['banner_id1']);
		$results2 = $this->model_design_banner->getBanner($setting['banner_id2']);

		foreach ($results0 as $result) {
			if (is_file(DIR_IMAGE . $result['image'])) {
				$data['banners0'][] = array(
					'title' => $result['title'],
					'link'  => $result['link'],
					'image' => HTTP_SERVER.'image/' . $result['image']
				);
			}
		}
		foreach ($results1 as $result) {
			if (is_file(DIR_IMAGE . $result['image'])) {
				$data['banners1'][] = array(
					'title' => $result['title'],
					'link'  => $result['link'],
					'image' => $this->model_tool_image->resize($result['image'],375,242)
				);
			}
		}
		foreach ($results2 as $result) {
			if (is_file(DIR_IMAGE . $result['image'])) {
				$data['banners2'][] = array(
					'title' => $result['title'],
					'link'  => $result['link'],
					'image' => $this->model_tool_image->resize($result['image'],375,484)
				);
			}
		}

		$data['module'] = $module++;

		return $this->load->view('extension/module/wx_slideshow', $data);
	}
}
