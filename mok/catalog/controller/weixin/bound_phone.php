<?php
class ControllerWeixinBoundPhone extends Controller {
	public function index() {
        if (!$this->customer->isLogged()) {
            $this->session->data['redirect'] = $this->url->link('weixin/bound_phone', '', true);

            $this->response->redirect($this->url->link('account/login', '', true));
        }
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {


        }




        $this->document->addStyle('catalog/view/theme/default/css/bound.css');

        $this->document->addScript('catalog/view/theme/default/script/ok_bound.js','footer');

        $this->document->addScript('catalog/view/theme/default/lib/zepto.min.js','footer');

        //页面其余部分
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer'] = $this->load->controller('weixin/footer');
        $data['header'] = $this->load->controller('weixin/header');

        $this->response->setOutput($this->load->view('weixin/bound_phone', $data));
	}
}
