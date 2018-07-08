<?php

class ControllerPaymentPrizmpay extends Controller {

    public function index() {
        $this->language->load('payment/prizmpay');

        $data['button_continue']        = $this->language->get('button_continue');
        $data['button_continue_action'] = $this->url->link('payment/prizmpay/checkout', '', 'SSL');

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/prizmpay.tpl')) {
            return $this->load->view($this->config->get('config_template') . '/template/payment/prizmpay.tpl', $data);
        } else {
            return $this->load->view('default/template/payment/prizmpay.tpl', $data);
        }
    }

    public function redirect() {
        return $this->url->link('payment/prizmpay/checkout');
    }

    public function checkout() {

//        $this->load->library('encryption');
        $this->language->load('payment/prizmpay');
        $this->load->model('checkout/order');
//        $this->load->model('setting/setting');

        $this->document->setTitle($this->language->get('heading_title'));

        $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);

        if ($order_info['currency_code'] != $this->config->get('prizmpay_default_currency')) {
            $merchantId  = $this->config->get('prizmpay_merchant_cup');
            $merchantKey = $this->config->get('prizmpay_security_cup');
        } else {
            $this->config->get('prizmpay_merchant');
            $merchantId  = $this->config->get('prizmpay_merchant');
            $merchantKey = $this->config->get('prizmpay_security');
        }

        $orderRef = sprintf("%010d", $this->session->data['order_id']);
        $amount   = $this->currency->format($order_info ['total'], $order_info ['currency_code'], '', FALSE);

        $data['merchant_referenceCode']          = (string) $orderRef;
        $data['merchant_invoiceId']              = '';
        $data['purchaseTotals_grandTotalAmount'] = (string) $amount;
        $data['purchaseTotals_currency']         = (string) $order_info['currency_code'];
        $data['billTo']['firstName']             = (string) $order_info['payment_firstname'];
        $data['billTo']['lastName']              = ($order_info['payment_lastname'] !== '') ? (string) $order_info['payment_lastname'] : (string) $order_info['payment_firstname'];
        $data['billTo']['email']                 = (string) $order_info['email'];
        $data['billTo']['phoneNumber']           = (string) $order_info['telephone'];
        $data['billTo']['street1']               = (string) $order_info['payment_address_1'];
        $data['billTo']['street2']               = (string) $order_info['payment_address_2'];
        $data['billTo']['city']                  = ((string) $order_info['payment_city'] !== '') ? (string) $order_info['payment_city'] : (string) $order_info['payment_iso_code_2'];
        $data['billTo']['state']                 = ((string) $order_info['payment_zone_code'] !== '') ? (string) $order_info['payment_zone_code'] : (string) $order_info['payment_iso_code_2'];
        $data['billTo']['country']               = (string) $order_info['payment_iso_code_2'];
        $data['billTo']['postalCode']            = $order_info['payment_postcode'] ? (string) $order_info['payment_postcode'] : '000000';

        if (isset($order_info['shipping_firstname']) && $order_info['shipping_firstname']) {
            $data['shipTo']['firstName']   = (string) $order_info['shipping_firstname'];
            $data['shipTo']['lastName']    = ((string) $order_info['shipping_lastname'] !== '') ? (string) $order_info['shipping_lastname'] : (string) $order_info['shipping_firstname'];
            $data['shipTo']['email']       = (string) $order_info['email'];
            $data['shipTo']['phoneNumber'] = (string) $order_info['telephone'];
            $data['shipTo']['street1']     = (string) $order_info['shipping_address_1'];
            $data['shipTo']['street2']     = (string) $order_info['shipping_address_2'];
            $data['shipTo']['city']        = ((string) $order_info['shipping_city'] !== '') ? (string) $order_info['shipping_city'] : (string) $order_info['shipping_iso_code_2'];
            $data['shipTo']['state']       = ((string) $order_info['shipping_zone_code'] !== '') ? (string) $order_info['shipping_zone_code'] : (string) $order_info['shipping_iso_code_2'];
            $data['shipTo']['country']     = (string) $order_info['shipping_iso_code_2'];
            $data['shipTo']['postalCode']  = $order_info['shipping_postcode'] ? (string) $order_info['shipping_postcode'] : '000000';
        } else {
            $data['shipTo'] = $data['billTo'];
        }
        $data['item'][0]['name']      = (string) $this->session->data['order_id'];
        $data['item'][0]['quantity']  = (string) 1;
        $data['item'][0]['unitPrice'] = (string) $amount;

        $dataJSON = json_encode($data);

        $secureHashSecret = trim($this->config->get('prizmpay_security'));
        if ($secureHashSecret) {
            require_once ('SHAPrizmpaySecure.php');
            $prizmpaySecure = new SHAPrizmpaySecure();
            $time           = time();
            $secureHash     = $prizmpaySecure->generatePaymentSecureHash($merchantId, $merchantKey, $time, $dataJSON);
            $data['time']   = $time;
            $data['hash']   = $secureHash;
        } else {
            $data['hash'] = '';
        }
//
//        var_dump($merchantId, $merchantKey, $time, $dataJSON);
//        exit;

        $data['merchantId']     = $merchantId;
        $data['button_confirm'] = $this->language->get('button_confirm');
        $mode                   = $this->config->get('prizmpay_mode');
        if ($mode == 'Live') {
            $data['action'] = 'https://pp.prizmmpay.com';
        } else {
            $data['action'] = 'https://pp-test.prizmmpay.com';
        }

        $this->id = 'payment';

        $dataJSONencoded = htmlentities($dataJSON);
        
        
//        var_dump($data);
        
        echo <<<HTML
<form style="display:hidden" method="post" name="paymentform" id="paymentform" action="{$data['action']}/pay?mid={$data['merchantId']}&time={$data['time']}&hash={$data['hash']}">
    <input type="hidden" name="data" value="{$dataJSONencoded}" />
</form>
<script type="text/javascript">
    document.forms["paymentform"].submit();
</script>
HTML;

//        var_dump($data);exit;
//        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/prizmpay.tpl')) {
////            $this->template = $this->config->get('config_template') . '/template/payment/prizmpay.tpl';
//            return $this->load->view($this->config->get('config_template') . '/template/payment/prizmpay.tpl', $data);
//        } else {
////            $this->template = 'default/template/payment/prizmpay.tpl';
//            return $this->load->view('default/template/payment/prizmpay.tpl', $data);
//        }
    }

    public function callback() {
        // Note: Datafeed URL?
        // E.g. http://localhost/opencart_1_5_1/index.php?route=payment/prizmpay/callback
        // get post data start
        $jsonData = filter_input(INPUT_POST, 'data');
        $data     = json_decode($jsonData, TRUE);


//        $order_id   = substr($data['client_ref'], 0, strpos($data['client_ref'], '-'));
        $order_id = trim($data['client_ref']);

        $this->load->model('checkout/order');
        $order_info = $this->model_checkout_order->getOrder($order_id);

        $temp = json_decode($data['details'], true);
        if ($temp['currency'] != $this->config->get('prizmpay_default_currency')) {
            $merchantId  = $this->config->get('prizmpay_merchant_cup');
            $merchantKey = $this->config->get('prizmpay_security_cup');
        } else {
            $merchantId  = $this->config->get('prizmpay_merchant');
            $merchantKey = $this->config->get('prizmpay_security');
        }

        //list of order status from opencart start
        $Processing = 2;
        $Failed     = 10;
        //list of order status from opencart end

        require_once ('SHAPrizmpaySecure.php');
        $prizmpaySecure = new SHAPrizmpaySecure();
        $result         = $prizmpaySecure->verifyPaymentDatafeed($merchantId, $merchantKey, $_POST);

//        echo "<pre>", var_dump($result), "</pre>";

        if ($result && $temp['status'] === 1) {
            
            echo 'PRIZMPAY';
            $initialOrderStatusDefined = trim($this->config->get('prizmpay_order_status_id'));

//            $this->model_checkout_order->confirm($order_id, $initialOrderStatusDefined, "Order has been placed");
            $comment = "Transaction accepted on Prizm Pay. Payment Transaction ID: " . $data['transaction_id'];

//            $this->model_checkout_order->update($order_id, $Processing, $comment, TRUE);
            $this->model_checkout_order->addOrderHistory($order_id, $initialOrderStatusDefined, $comment, false);

//            echo "Order status updated to: Processing";
//            echo "<pre>", var_dump($result);
//            exit;
        } else {


            echo "Order Failed.";
        }
    }

}

?>