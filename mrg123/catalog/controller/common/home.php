<?php
class ControllerCommonHome extends Controller {
	public function index() {
		$this->document->setTitle($this->config->get('config_meta_title'));
		$this->document->setDescription($this->config->get('config_meta_description'));
		$this->document->setKeywords($this->config->get('config_meta_keyword'));

		if (isset($this->request->get['route'])) {
			$this->document->addLink($this->config->get('config_url'), 'canonical');
		}
		/* add informations */
		$this->load->model('catalog/information');
		$this->load->model('tool/image');
		$data['informations'] = array();
		
		$sort = 'date_added';
		$order = 'ASC';
		$filter_data = array(
			'sort' => $sort,
			'order'=> $order,
			'start' =>0,
			'limit' => 1000
		);
		$results = $this->model_catalog_information->getLatestInformations($filter_data);
		foreach($results as $result) {
			if($result['image']){
				$image = $this->model_tool_image->resize($result['image'],60,60);
			}else{
				$image = false;
			}
			$summary = utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get($this->config->get('config_theme') . '_product_description_length'));
		
			$data['informations'][] = array(
				'title' => $result['title'],
				'image' => $image, 
				'href' => $this->url->link('information/information','information_id=' . $result['information_id'],true),
				'summary' => $summary
			);
		}
		
		
		/* end add */
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('common/home', $data));
	}
}
