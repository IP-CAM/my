<?php
class ControllerInformationLink extends Controller {	
	public function index() {
		if (isset($this->request->get['name'])) {
			$link_name = $this->request->get['name'];
		} else {
			$link_name = '';
		}
		
		if ($link_name) {
			$this->load->model('localisation/link');
	
			$link = $this->model_localisation_link->getLinkByName($link_name);
			
			if ($link) {
				$referer = isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:0;
				
				setcookie('marketLink[link_id]', $link['link_id'], (int)time() + (24 * 60 * 60 * (int)$link['expire']));
				setcookie('marketLink[name]', $link['name'], (int)time() + (24 * 60 * 60 * (int)$link['expire']));
				setcookie('marketLink[url]', $referer, (int)time() + (24 * 60 * 60 * (int)$link['expire']));
				
				$this->response->redirect($link['url']);
			}
		} else {
			$this->response->redirect($this->url->link('common/home', '', 'SSL'));
		}
	}
}