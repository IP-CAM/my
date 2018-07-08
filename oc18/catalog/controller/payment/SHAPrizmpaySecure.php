<?php

require_once('PrizmpaySecure.php');

class SHAPrizmpaySecure implements PrizmpaySecure {

    public function generatePaymentSecureHash($merchantId, $merchantKey, $time, $data) {
        if (is_array($data)) {
            $jsonData = json_encode($data);
        } else {
            $jsonData = $data;
        }
        
        $buffer   = $merchantKey . $time . $merchantId . $jsonData;

        return hash('sha256', $buffer);
    }

    public function verifyPaymentDatafeed($merchantId, $merchantKey, $postData) {
        $expiry = 900;
        $time   = $postData['time'];

        // check timeout
        if ($time && (abs($time - time()) > $expiry)) {
            return FALSE;
        }

        $data = json_decode(str_replace('&quot;', '"', $postData['data']), TRUE);
        $hash = $postData['hash'];
        
        // check secret hash
        $localHash = self::generatePaymentSecureHash($merchantId, $merchantKey, $time, $data);

        if ($localHash != $hash) {
            return FALSE;
        }

        // return decoded datafeed
        return $data;
    }

}
