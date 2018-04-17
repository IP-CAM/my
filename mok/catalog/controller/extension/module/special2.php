<?php
class ControllerExtensionModuleSpecial2 extends Controller {
	public function index($setting) {

		$data['specials'] = array();
		$this->load->model('tool/image');
		if($setting['special2_banner']){
			foreach($setting['special2_banner'] as $special2_banner){
				$image = 
				$data['specials'][] = array(
					'href' => $special2_banner['href'],
					'href2' => $special2_banner['href2'],
					'src' => $this->model_tool_image->resize($special2_banner['src'], $setting['width'], $setting['height']),
					'alt' => $special2_banner['alt'],
					'alt2' => $special2_banner['alt2']
				);
			}
		}
		

		return $this->load->view('extension/module/special2', $data);
	}
}