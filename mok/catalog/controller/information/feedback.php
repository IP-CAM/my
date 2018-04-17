<?php
class ControllerInformationFeedback extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('information/feedback');
        $this->load->model('information/feedback');

		$this->document->setTitle($this->language->get('heading_title'));

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

            $this->model_information_feedback->addFeedback($this->request->post);

			$this->response->redirect($this->url->link('account/account', '', true));
		}


		$data['heading_title'] = $this->language->get('heading_title');

		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_enquiry'] = $this->language->get('entry_enquiry');

		$data['button_map'] = $this->language->get('button_map');

		if (isset($this->error['email'])) {
			$data['error_email'] = $this->error['email'];
		} else {
			$data['error_email'] = '';
		}

		if (isset($this->error['enquiry'])) {
			$data['error_enquiry'] = $this->error['enquiry'];
		} else {
			$data['error_enquiry'] = '';
		}

		$data['button_submit'] = $this->language->get('button_submit');

		$data['action'] = $this->url->link('information/feedback', '', true);

		$data['locations'] = array();

		if (isset($this->request->post['email'])) {
			$data['email'] = $this->request->post['email'];
		} else {
			$data['email'] = $this->customer->getEmail();
		}

		if (isset($this->request->post['enquiry'])) {
			$data['enquiry'] = $this->request->post['enquiry'];
		} else {
			$data['enquiry'] = '';
		}

        $this->document->addStyle('catalog/view/theme/default/css/feedback.css');

        $this->document->addScript('catalog/view/theme/default/script/zepto.min.js','footer');
        $this->document->addScript('catalog/view/theme/default/script/ok_evaluate.js','footer');
        $this->document->addScript('catalog/view/theme/default/script/ok_addFeedback.js','footer');


		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer'] = $this->load->controller('weixin/footer');

        $data['header'] = $this->load->controller('weixin/header');

		$this->response->setOutput($this->load->view('information/new_feedback', $data));
	}

	protected function validate() {
		if (!filter_var($this->request->post['email'], FILTER_VALIDATE_EMAIL)) {
			$this->error['email'] = $this->language->get('error_email');
		}

		if ((utf8_strlen($this->request->post['content']) < 10) || (utf8_strlen($this->request->post['content']) > 3000)) {
			$this->error['enquiry'] = $this->language->get('error_enquiry');
		}

		return !$this->error;
	}

}
