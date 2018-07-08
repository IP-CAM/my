<?php

interface PrizmpaySecure {

    public function generatePaymentSecureHash($merchantId, $merchantKey, $time, $data);

    public function verifyPaymentDatafeed($merchantId, $merchantKey, $postData);
}
