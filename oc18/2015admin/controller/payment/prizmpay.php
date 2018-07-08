<?php

class ControllerPaymentPrizmpay extends Controller {

    private $error = array();

    public function index() {
        $this->language->load('payment/prizmpay');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
            $this->model_setting_setting->editSetting('prizmpay', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

//            $this->redirect(HTTPS_SERVER . 'index.php?route=extension/payment&token=' . $this->session->data['token']);
            $this->response->redirect($this->url->link('payment/prizmpay', 'token=' . $this->session->data['token'], 'SSL'));
        }
//        var_dump($this->language);exit;
        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_enabled']   = $this->language->get('text_enabled');
        $data['text_disabled']  = $this->language->get('text_disabled');
        $data['text_all_zones'] = $this->language->get('text_all_zones');


        $data['entry_description']      = $this->language->get('entry_description');
        $data['entry_payserverurl']     = $this->language->get('entry_payserverurl');
        $data['entry_merchant']         = $this->language->get('entry_merchant');
        $data['entry_default_currency'] = $this->language->get('entry_default_currency');
        $data['entry_merchant_cup']     = $this->language->get('entry_merchant_cup');
        $data['entry_security']         = $this->language->get('entry_security');
        $data['entry_security_cup']     = $this->language->get('entry_security_cup');
        $data['entry_callback']         = $this->language->get('entry_callback');
        $data['entry_order_status']     = $this->language->get('entry_order_status');
        $data['entry_geo_zone']         = $this->language->get('entry_geo_zone');
        $data['entry_status']           = $this->language->get('entry_status');
        $data['entry_sort_order']       = $this->language->get('entry_sort_order');

        $data['button_save']   = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

        $data['tab_general'] = $this->language->get('tab_general');
		// Language
		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['payserverurl'])) {
            $data['error_payserverurl'] = $this->error['payserverurl'];
        } else {
            $data['error_payserverurl'] = '';
        }

        if (isset($this->error['merchant'])) {
            $data['error_merchant'] = $this->error['merchant'];
        } else {
            $data['error_merchant'] = '';
        }

        if (isset($this->error['security'])) {
            $data['error_security'] = $this->error['security'];
        } else {
            $data['error_security'] = '';
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_payment'),
            'href'      => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('heading_title'),
            'href'      => $this->url->link('payment/prizmpay', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $data['action'] = $this->url->link('payment/prizmpay', 'token=' . $this->session->data['token'], 'SSL');
        $data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');
        $data['search'] = $this->url->link('payment/prizmpay', 'token=' . $this->session->data['token'], 'SSL');

        if (isset($this->request->post['prizmpay_mode'])) {
            $data['prizmpay_mode'] = $this->request->post['prizmpay_mode'];
        } else {
            $data['prizmpay_mode'] = $this->config->get('prizmpay_mode');
        }

        if (isset($this->request->post['prizmpay_default_currency'])) {
            $data['prizmpay_default_currency'] = $this->request->post['prizmpay_default_currency'];
        } else {
            $data['prizmpay_default_currency'] = $this->config->get('prizmpay_default_currency');
        }

        if (isset($this->request->post['prizmpay_merchant'])) {
            $data['prizmpay_merchant'] = $this->request->post['prizmpay_merchant'];
        } else {
            $data['prizmpay_merchant'] = $this->config->get('prizmpay_merchant');
        }

        if (isset($this->request->post['prizmpay_merchant_cup'])) {
            $data['prizmpay_merchant_cup'] = $this->request->post['prizmpay_merchant_cup'];
        } else {
            $data['prizmpay_merchant_cup'] = $this->config->get('prizmpay_merchant_cup');
        }

        if (isset($this->request->post['prizmpay_security'])) {
            $data['prizmpay_security'] = $this->request->post['prizmpay_security'];
        } else {
            $data['prizmpay_security'] = $this->config->get('prizmpay_security');
        }

        if (isset($this->request->post['prizmpay_security_cup'])) {
            $data['prizmpay_security_cup'] = $this->request->post['prizmpay_security_cup'];
        } else {
            $data['prizmpay_security_cup'] = $this->config->get('prizmpay_security_cup');
        }

        $data['callback'] = HTTP_CATALOG . 'index.php?route=payment/prizmpay/callback';

        if (isset($this->request->post['prizmpay_order_status_id'])) {
            $data['prizmpay_order_status_id'] = $this->request->post['prizmpay_order_status_id'];
        } else {
            $data['prizmpay_order_status_id'] = $this->config->get('prizmpay_order_status_id');
        }

        $this->load->model('localisation/order_status');

        $data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

        if (isset($this->request->post['prizmpay_status'])) {
            $data['prizmpay_status'] = $this->request->post['prizmpay_status'];
        } else {
            $data['prizmpay_status'] = $this->config->get('prizmpay_status');
        }

        if (isset($this->request->post['prizmpay_sort_order'])) {
            $data['prizmpay_sort_order'] = $this->request->post['prizmpay_sort_order'];
        } else {
            $data['prizmpay_sort_order'] = $this->config->get('prizmpay_sort_order');
        }
        if (isset($this->request->post['prizmpay_description'])) {
            $data['prizmpay_description'] = $this->request->post['prizmpay_description'];
        } else {
            $data['prizmpay_description'] = $this->config->get('prizmpay_description');
        }
        $this->template = 'payment/prizmpay.tpl';

        $data['header']      = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer']      = $this->load->controller('common/footer');

        if (isset($this->request->post['prizmpay_paymethod'])) {
            $data['prizmpay_paymethod'] = $this->request->post['prizmpay_paymethod'];
        } else {
            $data['prizmpay_paymethod'] = $this->config->get('prizmpay_paymethod');
        }

        $data['prizmpay_modes']      = array(
            'Test',
            'Live',
//            'API'
        );
        $data['prizmpay_paymethods'] = array(
            'Payment Page',
//            'API'
        );

//        if (isset($this->request->post['prizmpay_currency'])) {
//            $data['prizmpay_currency'] = $this->request->post['prizmpay_currency'];
//        } else {
//            $data['prizmpay_currency'] = $this->config->get('prizmpay_currency');
//        }
//
        $data['prizmpay_currencys'] = array(
            'AED',
            'AFN',
            'ALL',
            'AMD',
            'ANG',
            'AOA',
            'ARS',
            'AUD',
            'AWG',
            'AZN',
            'BAM',
            'BBD',
            'BDT',
            'BGN',
            'BHD',
            'BIF',
            'BMD',
            'BND',
            'BOB',
            'BRL',
            'BSD',
            'BTN',
            'BWP',
            'BYR',
            'BZD',
            'CAD',
            'CDF',
            'CHF',
            'CLP',
            'CNY',
            'COP',
            'CRC',
            'CUC',
            'CUP',
            'CVE',
            'CZK',
            'DJF',
            'DKK',
            'DOP',
            'DZD',
            'EGP',
            'ERN',
            'ETB',
            'EUR',
            'FJD',
            'FKP',
            'GBP',
            'GEL',
            'GGP',
            'GHS',
            'GIP',
            'GMD',
            'GNF',
            'GTQ',
            'GYD',
            'HKD',
            'HNL',
            'HRK',
            'HTG',
            'HUF',
            'IDR',
            'ILS',
            'IMP',
            'INR',
            'IQD',
            'IRR',
            'ISK',
            'JEP',
            'JMD',
            'JOD',
            'JPY',
            'KES',
            'KGS',
            'KHR',
            'KMF',
            'KPW',
            'KRW',
            'KWD',
            'KYD',
            'KZT',
            'LAK',
            'LBP',
            'LKR',
            'LRD',
            'LSL',
            'LTL',
            'LYD',
            'MAD',
            'MDL',
            'MGA',
            'MKD',
            'MMK',
            'MNT',
            'MOP',
            'MRO',
            'MUR',
            'MVR',
            'MWK',
            'MXN',
            'MYR',
            'MZN',
            'NAD',
            'NGN',
            'NIO',
            'NOK',
            'NPR',
            'NZD',
            'OMR',
            'PAB',
            'PEN',
            'PGK',
            'PHP',
            'PKR',
            'PLN',
            'PYG',
            'QAR',
            'RON',
            'RSD',
            'RUB',
            'RWF',
            'SAR',
            'SBD',
            'SCR',
            'SDG',
            'SEK',
            'SGD',
            'SHP',
            'SLL',
            'SOS',
            'SPL*',
            'SRD',
            'STD',
            'SVC',
            'SYP',
            'SZL',
            'THB',
            'TJS',
            'TMT',
            'TND',
            'TOP',
            'TRY',
            'TTD',
            'TVD',
            'TWD',
            'TZS',
            'UAH',
            'UGX',
            'USD',
            'UYU',
            'UZS',
            'VEF',
            'VND',
            'VUV',
            'WST',
            'XAF',
            'XCD',
            'XDR',
            'XOF',
            'XPF',
            'YER',
            'ZAR',
            'ZMW',
            'ZWD',
        );
//        $this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));

        $this->response->setOutput($this->load->view('payment/prizmpay.tpl', $data));
    }

    private function validate() {
        if (!$this->user->hasPermission('modify', 'payment/prizmpay')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (!$this->request->post['prizmpay_mode']) {
            $this->error['mode'] = $this->language->get('error_mode');
        }
        if (!$this->request->post['prizmpay_default_currency']) {
            $this->error['currency'] = $this->language->get('error_currency');
        }

        if (!$this->request->post['prizmpay_merchant']) {
            $this->error['merchant'] = $this->language->get('error_merchant');
        }

        if (!$this->request->post['prizmpay_merchant_cup']) {
            $this->error['merchant_cup'] = $this->language->get('error_merchant_cup');
        }

        if (!$this->request->post['prizmpay_security']) {
            $this->error['security'] = $this->language->get('error_security');
        }

        if (!$this->request->post['prizmpay_security_cup']) {
            $this->error['security'] = $this->language->get('error_security');
        }

        if (!$this->error) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}

?>