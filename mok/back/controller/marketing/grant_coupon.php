<?php
class ControllerMarketingGrantCoupon extends Controller
{
    private $error = array();

    public function index()
    {
        $this->load->language('marketing/grant_coupon');
        $this->load->model('marketing/grant_coupon');
        $this->load->model('customer/customer');
        $this->load->model('customer/customer_group');

        $this->document->setTitle($this->language->get('heading_title'));

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $customer_id = $this->request->post['customer'];
            $customer_group_id = $this->request->post['customer_group'];
            $is_all = $this->request->post['is_all_customer'];
            $coupon_code = $this->request->post['coupon_code'];
            $coupon_num = $this->request->post['coupon_num'];
            if (!empty($customer_id)) {
                $flag = $this->deliverCoupon($customer_id, $coupon_code, $coupon_num);
            }
            if ($customer_group_id !== "0") {
                $group_customer_info = $this->model_customer_customer->getCustomersByCustomerGroupId($customer_group_id);
                foreach ($group_customer_info as $g) {
                    $customer_id = $g['customer_id'];
                    $flag = $this->deliverCoupon($customer_id, $coupon_code, $coupon_num);
                }
            }

            if ($is_all !== "0") {
                $all_customer_info = $this->model_customer_customer->getAllCustomers();
                foreach ($all_customer_info as $a) {
                    $customer_id = $a['customer_id'];
                    $flag = $this->deliverCoupon($customer_id, $coupon_code, $coupon_num);
                }
            }

            $this->response->redirect($this->url->link('marketing/coupon', 'token=' . $this->session->data['token'] . '&type=module', true));
        }

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_edit'] = $this->language->get('text_edit');

        $data['entry_customer'] = $this->language->get('entry_customer');
        $data['entry_customer_group'] = $this->language->get('entry_customer_group');
        $data['entry_customer_all'] = $this->language->get('entry_customer_all');
        $data['entry_coupon_code'] = $this->language->get('entry_coupon_code');
        $data['entry_coupon_num'] = $this->language->get('entry_coupon_num');
        $data['button'] = $this->language->get('button');

        if (isset($this->error['customer'])) {
            $data['error_customer'] = $this->error['customer'];
        } else {
            $data['error_customer'] = '';
        }

        if (isset($this->error['coupon_code'])) {
            $data['error_coupon_code'] = $this->error['coupon_code'];
        } else {
            $data['error_coupon_code'] = '';
        }

        if (isset($this->error['coupon_num'])) {
            $data['error_coupon_num'] = $this->error['coupon_num'];
        } else {
            $data['error_coupon_num'] = '';
        }

        if (isset($this->error['delivering_way'])) {
            $data['error_delivering_way'] = $this->error['delivering_way'];
        } else {
            $data['error_delivering_way'] = '';
        }

        $data['action'] = $this->url->link('marketing/grant_coupon', 'token=' . $this->session->data['token'], true);

        $data['cancel'] = $this->url->link('marketing/coupon', 'token=' . $this->session->data['token'] . '&type=module', true);


        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_module'),
            'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('extension/module/weibo_login', 'token=' . $this->session->data['token'], true)
        );

        if (isset($this->request->post['coupon_num'])) {
            $data['value_coupon_num'] = $this->request->post['coupon_num'];
        } else {
            $data['value_coupon_num'] = '';
        }

        if (isset($this->request->post['customer'])) {
            $data['value_customer'] = $this->request->post['customer'];
        } else {
            $data['value_customer'] = '';
        }

        if (isset($this->request->post['coupon_code'])) {
            $data['value_coupon_code'] = $this->request->post['coupon_code'];
        } else {
            $data['value_coupon_code'] = '';
        }

        $data['customer_group'] = $this->model_customer_customer_group->getCustomerGroups();


        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->error['coupon_code'] = $this->language->get('error_coupon_code');

        $this->response->setOutput($this->load->view('marketing/grant_coupon', $data));
    }

    public function validate(){
        if (!$this->user->hasPermission('modify', 'marketing/grant_coupon')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        $customer_id = $this->request->post['customer'];
        $customer_group = $this->request->post['customer_group'];
        $is_all = $this->request->post['is_all_customer'];
        if (!empty($customer_id) && $customer_group !== "0") {
            $this->error['delivering_way'] = $this->language->get('error_delivering_way');
        }

        if (!empty($customer_id) && $is_all !== "0") {
            $this->error['delivering_way'] = $this->language->get('error_delivering_way');
        }

        if ($customer_group !== "0" && $is_all !== "0") {
            $this->error['delivering_way'] = $this->language->get('error_delivering_way');
        }

        if (!empty($customer_id)) {
            $customer_info = $this->model_customer_customer->getCustomer($customer_id);
            if (!$customer_info) {
                $this->error['customer'] = $this->language->get('error_customer');
            }
        }
        $coupon_info = $this->model_marketing_grant_coupon->getCouponOne($this->request->post['coupon_code']);
        if (!$coupon_info) {
            $this->error['coupon_code'] = $this->language->get('error_coupon_code');
        }
        if (empty($this->request->post['coupon_num'])) {
            $this->error['coupon_num'] = $this->language->get('error_coupon_num1');
        } else {
            if (!is_numeric($this->request->post['coupon_num'])) {
                $this->error['coupon_num'] = $this->language->get('error_coupon_num2');
            }
        }
        return !$this->error;
    }

    public function deliverCoupon($customer_id, $coupon_code, $coupon_num)
    {
        $customer_info = $this->model_customer_customer->getCustomer($customer_id);
        $coupon_info = $this->model_marketing_grant_coupon->getCouponOne($coupon_code);
        for ($i = 0; $i < $coupon_num; $i++) {
            $flag = $this->model_marketing_grant_coupon->CustomerBindCoupon($customer_info, $coupon_info);
        }
        return $flag;
    }
}
?>