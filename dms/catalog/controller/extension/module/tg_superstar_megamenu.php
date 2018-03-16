<?php
class ControllerExtensionModuleTGsuperstarMegamenu extends Controller {
		public function index($setting) {
		
		$this->load->model('menu/tg_superstar_megamenu');

		$data['menu'] = $this->model_menu_tg_superstar_megamenu->getMenu();

		$lang_id = $this->config->get('config_language_id');
		$data['settings'] = array(
			
			'animation' => $setting['animation'],
			'animation_time' => $setting['animation_time'],
		);

		$data['lang_id'] = $this->config->get('config_language_id');

		return $this->load->view('extension/module/tg_superstar_megamenu', $data);
	}
}
?>