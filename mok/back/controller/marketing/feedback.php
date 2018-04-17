<?php
class ControllerMarketingFeedback extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('marketing/feedback');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('marketing/feedback');

		$this->getList();
	}

	public function reply() {
            $this->load->model('marketing/feedback');

            $feedback_id= $this->request->post['feedback_id'];
            $content= $this->request->post['content'];
            $email = $this->model_marketing_feedback->getEmail($feedback_id);
            $email= $email['email'];

            $mail = new Mail($content);
            $mail->protocol = $this->config->get('config_mail_protocol');
            $mail->parameter = $this->config->get('config_mail_parameter');
            $mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
            $mail->smtp_username = $this->config->get('config_mail_smtp_username');
            $mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
            $mail->smtp_port = $this->config->get('config_mail_smtp_port');
            $mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

            $mail->setTo($this->config->get('config_email'));
            $mail->setFrom($this->request->post['email']);
            $mail->setSender(html_entity_decode($this->request->post['name'], ENT_QUOTES, 'UTF-8'));
            $mail->setSubject(html_entity_decode(sprintf($this->language->get('email_subject'), $this->request->post['name']), ENT_QUOTES, 'UTF-8'));
            $mail->setText($this->request->post['enquiry']);
            $res = $mail->send();
            if(res){
                echo $this->language->get('text_send_status1');
            }else{
                echo $this->language->get('text_send_status2');
            }

	}

	public function delete() {
		$this->load->language('marketing/feedback');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('marketing/feedback');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $feedback) {
				$this->model_marketing_feedback->deleteFeedback($feedback);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('marketing/feedback', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getList();
	}

	protected function getList() {
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('marketing/feedback', 'token=' . $this->session->data['token'] . $url, true)
		);

		$data['delete'] = $this->url->link('marketing/feedback/delete', 'token=' . $this->session->data['token'] . $url, true);

		$filter_data = array(
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$feedback_total = $this->model_marketing_feedback->getTotalFeedback();

		$results = $this->model_marketing_feedback->getFeedbacks($filter_data);

		foreach ($results as $result) {
			$data['feedbacks'][] = array(
			    'feedback_id' => $result['feedback_id'],
				'content'  => $result['content'],
				'email'       => $result['email'],
				'created' => date($this->language->get('date_format_short'), strtotime($result['created'])),
				'status'     => ($result['status'] ? $this->language->get('column_reply_y') : $this->language->get('column_reply_n')),
				//'reply'       => $this->url->link('marketing/feedback/edit', 'token=' . $this->session->data['token'] . '&coupon_id=' . $result['coupon_id'] . $url, true)
			);
		}
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');
        /*表格列名*/
		$data['column_email'] = $this->language->get('column_email');
        $data['column_content'] = $this->language->get('column_content');
        $data['column_created'] = $this->language->get('column_created');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_action'] = $this->language->get('column_action');

        $data['button_delete'] = $this->language->get('button_delete');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		$url = '';
		$pagination = new Pagination();
		$pagination->total = $feedback_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('marketing/feedback', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($feedback_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($feedback_total - $this->config->get('config_limit_admin'))) ? $feedback_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $feedback_total, ceil($feedback_total / $this->config->get('config_limit_admin')));

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('marketing/feedback', $data));
	}


	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'marketing/feedback')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

}