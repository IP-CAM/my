<?php

class paymentasiaSecure {

	/**
	 * 
	 * @param array $data
	 * @param string $merchantKey
	 * @return string
	 */
	public static function generatePaymentSecureHash($data, $merchantKey) {
		if (isset($data['sign'])) {
			unset($data['sign']);
		}
		ksort($data);
		$buffer = http_build_query($data) . $merchantKey;
		return hash('sha512', $buffer);
	}

	/**
	 * 
	 * @param array $data
	 * @param string $merchantKey
	 * @return string
	 */
	public static function verifyPaymentDatafeed($data, $merchantKey) {
		return static::generatePaymentSecureHash($data, $merchantKey);
	}

}
