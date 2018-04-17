<?php
class ControllerExtensionModuleCategory extends Controller {
	public function index($setting) {
		$this->load->language('extension/module/category');

		$data['heading_title'] = $this->language->get('heading_title');

		$this->load->model('tool/image');
		if($setting['category_banner']){
			foreach($setting['category_banner'] as $category_banner){
				$image = 
				$data['categories'][] = array(
					'href' => $category_banner['href'],
					'src' => $this->model_tool_image->resize($category_banner['src'], $setting['width'], $setting['height']),
					'alt' => $category_banner['alt']
				);
			}
		}
		

		return $this->load->view('extension/module/category', $data);
	}
}