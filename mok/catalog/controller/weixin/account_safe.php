<?php
class ControllerWeixinAccountSafe extends Controller {
	public function index() {
        if (!$this->customer->isLogged()) {
            $this->session->data['redirect'] = $this->url->link('weixin/account_safe', '', true);

            $this->response->redirect($this->url->link('account/login', '', true));
        }

        $data['modified_password'] = $this->url->link('account/password', '', true);

        $data['forgotten'] = $this->url->link('account/forgotten', '', true);

        $data['bound_phone'] = $this->url->link('weixin/bound_phone', '', true);


        $this->document->addStyle('catalog/view/theme/default/css/help.css');

        $this->document->addScript('catalog/view/theme/default/script/ok_account_safe.js','footer');

        //页面其余部分
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer'] = $this->load->controller('weixin/footer');
        $data['header'] = $this->load->controller('weixin/header');

        $this->response->setOutput($this->load->view('weixin/account_safe', $data));
	}
}
