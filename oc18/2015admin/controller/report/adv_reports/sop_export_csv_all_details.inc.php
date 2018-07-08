<?php
ini_set("memory_limit","256M");

	$data['decimal_point'] = $this->language->get('decimal_point');
	if ($data['decimal_point'] == ',') {
	$csv_separator = ";";
	} else {
	$csv_separator = ",";
	}
	$csv_enclosed = '"';
	$csv_row = "\n";
	
	$export_csv_all_details = $csv_enclosed . $this->language->get('column_order_order_id') . $csv_enclosed;
	$export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_order_date_added') . $csv_enclosed;
	isset($_POST['sop1000']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_order_inv_no') . $csv_enclosed : '';	
	isset($_POST['sop1001']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_order_customer_name') . $csv_enclosed : '';
	isset($_POST['sop1002']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_order_email') . $csv_enclosed : '';	
	isset($_POST['sop1003']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_order_customer_group') . $csv_enclosed : '';	
	isset($_POST['sop1004']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_prod_id') . $csv_enclosed : '';
	isset($_POST['sop1005']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_prod_sku') . $csv_enclosed : '';
	isset($_POST['sop1006']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_prod_model') . $csv_enclosed : '';
	isset($_POST['sop1007']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_prod_name') . $csv_enclosed : '';
	isset($_POST['sop1008']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_prod_option') . $csv_enclosed : '';
	isset($_POST['sop1009']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_prod_attributes') . $csv_enclosed : '';
	isset($_POST['sop1010']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_prod_manu') . $csv_enclosed : '';
	isset($_POST['sop1011']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_prod_category') . $csv_enclosed : '';	
	isset($_POST['sop1012']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_prod_currency') . $csv_enclosed : '';
	isset($_POST['sop1013']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_prod_price') . $csv_enclosed : '';
	isset($_POST['sop1014']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_prod_quantity') . $csv_enclosed : '';
	isset($_POST['sop1016a']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_prod_total_excl_vat') . $csv_enclosed : '';		
	isset($_POST['sop1015']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_prod_tax') . $csv_enclosed : '';
	isset($_POST['sop1016b']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_prod_total_incl_vat') . $csv_enclosed : '';
	isset($_POST['sop1016c']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_prod_sales') . $csv_enclosed : '';	
	isset($_POST['sop1017']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_prod_costs') . $csv_enclosed : '';
	isset($_POST['sop1018']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_prod_profit') . $csv_enclosed : '';
	isset($_POST['sop1019']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_prod_profit') . ' [%]' . $csv_enclosed : '';
	isset($_POST['sop1020']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_sub_total') . $csv_enclosed : '';
	isset($_POST['sop1021']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_handling') . $csv_enclosed : '';
	isset($_POST['sop1022']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_loworder') . $csv_enclosed : '';	
	isset($_POST['sop1023']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_shipping') . $csv_enclosed : '';
	isset($_POST['sop1024']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_reward') . $csv_enclosed : '';
	isset($_POST['sop1025']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_coupon') . $csv_enclosed : '';	
	isset($_POST['sop1026']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_coupon_code') . $csv_enclosed : '';	
	isset($_POST['sop1027']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_order_tax') . $csv_enclosed : '';
	isset($_POST['sop1028']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_credit') . $csv_enclosed : '';
	isset($_POST['sop1029']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_voucher') . $csv_enclosed : '';
	isset($_POST['sop1030']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_voucher_code') . $csv_enclosed : '';		
	isset($_POST['sop1031']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_order_value') . $csv_enclosed : '';
	isset($_POST['sop1032']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_order_sales') . $csv_enclosed : '';
	isset($_POST['sop1033']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_order_prod_costs') . $csv_enclosed : '';
	isset($_POST['sop1034']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_order_commission') . $csv_enclosed : '';
	isset($_POST['sop1035']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_order_payment_cost') . $csv_enclosed : '';
	isset($_POST['sop1036']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_order_shipping_cost') . $csv_enclosed : '';	
	isset($_POST['sop1063']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_shipping_balance') . $csv_enclosed : '';		
	isset($_POST['sop1037']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_order_costs') . $csv_enclosed : '';
	isset($_POST['sop1038']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_order_profit') . $csv_enclosed : '';
	isset($_POST['sop1039']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_order_profit') . ' [%]' . $csv_enclosed : '';
	isset($_POST['sop1040']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_order_shipping_method') . $csv_enclosed : '';
	isset($_POST['sop1041']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_order_payment_method') . $csv_enclosed : '';
	isset($_POST['sop1042']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_order_status') . $csv_enclosed : '';
	isset($_POST['sop1043']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_order_store') . $csv_enclosed : '';
	isset($_POST['sop1044']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_customer_cust_id') . $csv_enclosed : '';	
	isset($_POST['sop1045']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . strip_tags($this->language->get('column_billing_name')) . $csv_enclosed : '';
	isset($_POST['sop1046']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . strip_tags($this->language->get('column_billing_company')) . $csv_enclosed : '';				
	isset($_POST['sop1047']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . strip_tags($this->language->get('column_billing_address_1')) . $csv_enclosed : '';
	isset($_POST['sop1048']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . strip_tags($this->language->get('column_billing_address_2')) . $csv_enclosed : '';
	isset($_POST['sop1049']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . strip_tags($this->language->get('column_billing_city')) . $csv_enclosed : '';
	isset($_POST['sop1050']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . strip_tags($this->language->get('column_billing_zone')) . $csv_enclosed : '';
	isset($_POST['sop1051']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . strip_tags($this->language->get('column_billing_postcode')) . $csv_enclosed : '';
	isset($_POST['sop1052']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . strip_tags($this->language->get('column_billing_country')) . $csv_enclosed : '';
	isset($_POST['sop1053']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_customer_telephone') . $csv_enclosed : '';
	isset($_POST['sop1054']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . strip_tags($this->language->get('column_shipping_name')) . $csv_enclosed : '';
	isset($_POST['sop1055']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . strip_tags($this->language->get('column_shipping_company')) . $csv_enclosed : '';
	isset($_POST['sop1056']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . strip_tags($this->language->get('column_shipping_address_1')) . $csv_enclosed : '';
	isset($_POST['sop1057']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . strip_tags($this->language->get('column_shipping_address_2')) . $csv_enclosed : '';
	isset($_POST['sop1058']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . strip_tags($this->language->get('column_shipping_city')) . $csv_enclosed : '';
	isset($_POST['sop1059']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . strip_tags($this->language->get('column_shipping_zone')) . $csv_enclosed : '';
	isset($_POST['sop1060']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . strip_tags($this->language->get('column_shipping_postcode')) . $csv_enclosed : '';
	isset($_POST['sop1061']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . strip_tags($this->language->get('column_shipping_country')) . $csv_enclosed : '';
	isset($_POST['sop1064']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $this->language->get('column_order_comment') . $csv_enclosed : '';
	$export_csv_all_details .= $csv_row;
	
	foreach ($rows as $row) {	
	if ($row['product_id']) {
	$order_sales = $row['order_sub_total']+$row['order_handling']+$row['order_low_order_fee']+$row['order_reward']+$row['order_coupon']+$row['order_credit']+$row['order_voucher']+($data['adv_profit_reports_formula_sop1'] ? $row['order_shipping'] : 0);
	$order_costs = $row['order_product_costs']+$row['order_commission']+($data['adv_profit_reports_formula_sop3'] ? $row['order_payment_cost'] : 0)+($data['adv_profit_reports_formula_sop2'] ? $row['order_shipping_cost'] : 0);	
	
	$export_csv_all_details .= $csv_enclosed . $row['order_id'] . $csv_enclosed;
	$export_csv_all_details .= $csv_separator . $csv_enclosed . date($this->language->get('date_format_short'), strtotime($row['date_added'])) . $csv_enclosed;
	isset($_POST['sop1000']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $row['invoice_prefix'] . $row['invoice_no'] . $csv_enclosed : '';
	isset($_POST['sop1001']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $row['firstname'] . ' ' . $row['lastname'] . $csv_enclosed : '';	
	isset($_POST['sop1002']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $row['email'] . $csv_enclosed : '';	
	isset($_POST['sop1003']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $row['order_group'] . $csv_enclosed : '';	
	isset($_POST['sop1004']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $row['product_id'] . $csv_enclosed : '';
	isset($_POST['sop1005']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $row['product_sku'] . $csv_enclosed : '';
	isset($_POST['sop1006']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $row['product_model'] . $csv_enclosed : '';	
	isset($_POST['sop1007']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $row['product_name'] . $csv_enclosed : '';
	isset($_POST['sop1008']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . html_entity_decode($row['product_option']) . $csv_enclosed : '';
	isset($_POST['sop1009']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . html_entity_decode($row['product_attributes']) . $csv_enclosed : '';
	isset($_POST['sop1010']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . html_entity_decode($row['product_manu']) . $csv_enclosed : '';
	isset($_POST['sop1011']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . html_entity_decode($row['product_category']) . $csv_enclosed : '';	
	isset($_POST['sop1012']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $row['currency_code'] . $csv_enclosed : '';
	isset($_POST['sop1013']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . round($row['product_price'], 2) . $csv_enclosed : '';
	isset($_POST['sop1014']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $row['product_quantity'] . $csv_enclosed : '';
	isset($_POST['sop1016a']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . round($row['product_total_excl_vat'], 2) . $csv_enclosed : '';	
	isset($_POST['sop1015']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . round($row['product_tax'], 2) . $csv_enclosed : '';		
	isset($_POST['sop1016b']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . round($row['product_total_incl_vat'], 2) . $csv_enclosed : '';
	isset($_POST['sop1016c']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . round($row['product_sales'], 2) . $csv_enclosed : '';	
	isset($_POST['sop1017']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . round(-$row['product_costs'], 2) . $csv_enclosed : '';
	isset($_POST['sop1018']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . round($row['product_profit'], 2) . $csv_enclosed : '';
	if ($row['product_costs'] > 0) {		
	isset($_POST['sop1019']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . round($row['product_profit_margin_percent'], 2) . '%' . $csv_enclosed : '';
	} else {
	isset($_POST['sop1019']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . '100%' . $csv_enclosed : '';
	}
	if ($row['order_sub_total'] != NULL) {		
	isset($_POST['sop1020']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . round($row['order_sub_total'], 2) . $csv_enclosed : '';
	} else {
	isset($_POST['sop1020']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . '0' . $csv_enclosed : '';
	}	
	if ($row['order_handling'] != NULL) {		
	isset($_POST['sop1021']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . round($row['order_handling'], 2) . $csv_enclosed : '';
	} else {
	isset($_POST['sop1021']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . '0' . $csv_enclosed : '';
	}	
	if ($row['order_low_order_fee'] != NULL) {		
	isset($_POST['sop1022']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . round($row['order_low_order_fee'], 2) . $csv_enclosed : '';
	} else {
	isset($_POST['sop1022']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . '0' . $csv_enclosed : '';
	}			
	if ($row['order_shipping'] != NULL) {		
	isset($_POST['sop1023']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . round($row['order_shipping'], 2) . $csv_enclosed : '';
	} else {
	isset($_POST['sop1023']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . '0' . $csv_enclosed : '';
	}	
	if ($row['order_reward'] != NULL) {		
	isset($_POST['sop1024']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . round($row['order_reward'], 2) . $csv_enclosed : '';
	} else {
	isset($_POST['sop1024']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . '0' . $csv_enclosed : '';
	}		
	if ($row['order_coupon'] != NULL) {		
	isset($_POST['sop1025']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . round($row['order_coupon'], 2) . $csv_enclosed : '';
	} else {
	isset($_POST['sop1025']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . '0' . $csv_enclosed : '';
	}
	isset($_POST['sop1026']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $row['order_coupon_code'] . $csv_enclosed : '';	
	if ($row['order_tax'] != NULL) {		
	isset($_POST['sop1027']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . round($row['order_tax'], 2) . $csv_enclosed : '';
	} else {
	isset($_POST['sop1027']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . '0' . $csv_enclosed : '';
	}	
	if ($row['order_credit'] != NULL) {		
	isset($_POST['sop1028']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . round($row['order_credit'], 2) . $csv_enclosed : '';	
	} else {
	isset($_POST['sop1028']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . '0' . $csv_enclosed : '';
	}	
	if ($row['order_voucher'] != NULL) {		
	isset($_POST['sop1029']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . round($row['order_voucher'], 2) . $csv_enclosed : '';
	} else {
	isset($_POST['sop1029']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . '0' . $csv_enclosed : '';
	}	
	isset($_POST['sop1030']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $row['order_voucher_code'] . $csv_enclosed : '';	
	isset($_POST['sop1031']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . round($row['order_value'], 2) . $csv_enclosed : '';
	isset($_POST['sop1032']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . round($order_sales, 2) . $csv_enclosed : '';
	isset($_POST['sop1033']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . ('-' . round($row['order_product_costs'], 2)) . $csv_enclosed : '';	
	isset($_POST['sop1034']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . round(-$row['order_commission'], 2) . $csv_enclosed : '';	
	isset($_POST['sop1035']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . round(-$row['order_payment_cost'], 2) . $csv_enclosed : '';
	isset($_POST['sop1036']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . round(-$row['order_shipping_cost'], 2) . $csv_enclosed : '';
	isset($_POST['sop1063']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . (round($row['order_shipping']-$row['order_shipping_cost'], 2)) . $csv_enclosed : '';	
	isset($_POST['sop1037']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . ('-' . round($order_costs, 2)) . $csv_enclosed : '';
	isset($_POST['sop1038']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . round(($order_sales-$order_costs), 2) . $csv_enclosed : '';
	if ($order_costs > 0) {	
	isset($_POST['sop1039']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . round(100 * (($order_sales-$order_costs) / $order_sales), 2) . '%' . $csv_enclosed : '';
	} else {
	isset($_POST['sop1039']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . '100%' . $csv_enclosed : '';
	}		
	isset($_POST['sop1040']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . strip_tags($row['shipping_method']) . $csv_enclosed : '';
	isset($_POST['sop1041']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . strip_tags($row['payment_method']) . $csv_enclosed : '';
	isset($_POST['sop1042']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $row['order_status'] . $csv_enclosed : '';
	isset($_POST['sop1043']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . html_entity_decode($row['store_name']) . $csv_enclosed : '';
	isset($_POST['sop1044']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $row['customer_id'] . $csv_enclosed : '';	
	isset($_POST['sop1045']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $row['payment_firstname'] . ' ' . $row['payment_lastname'] . $csv_enclosed : '';
	isset($_POST['sop1046']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $row['payment_company'] . $csv_enclosed : '';
	isset($_POST['sop1047']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $row['payment_address_1'] . $csv_enclosed : '';
	isset($_POST['sop1048']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $row['payment_address_2'] . $csv_enclosed : '';
	isset($_POST['sop1049']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $row['payment_city'] . $csv_enclosed : '';
	isset($_POST['sop1050']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $row['payment_zone'] . $csv_enclosed : '';
	isset($_POST['sop1051']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $row['payment_postcode'] . $csv_enclosed : '';
	isset($_POST['sop1052']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $row['payment_country'] . $csv_enclosed : '';
	isset($_POST['sop1053']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $row['telephone'] . $csv_enclosed : '';
	isset($_POST['sop1054']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $row['shipping_firstname'] . ' ' . $row['shipping_lastname'] . $csv_enclosed : '';
	isset($_POST['sop1055']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $row['shipping_company'] . $csv_enclosed : '';
	isset($_POST['sop1056']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $row['shipping_address_1'] . $csv_enclosed : '';
	isset($_POST['sop1057']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $row['shipping_address_2'] . $csv_enclosed : '';
	isset($_POST['sop1058']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $row['shipping_city'] . $csv_enclosed : '';
	isset($_POST['sop1059']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $row['shipping_zone'] . $csv_enclosed : '';
	isset($_POST['sop1060']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $row['shipping_postcode'] . $csv_enclosed : '';
	isset($_POST['sop1061']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . $row['shipping_country'] . $csv_enclosed : '';
	isset($_POST['sop1064']) ? $export_csv_all_details .= $csv_separator . $csv_enclosed . html_entity_decode($row['comment']) . $csv_enclosed : '';
	$export_csv_all_details .= $csv_row;
	}
	}

$filename = "sale_profit_report_all_details_".date("Y-m-d",time());
header('Pragma: public');
header('Expires: 0');
header('Content-Description: File Transfer');
header('Content-Type: text/csv; charset=utf-8');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');		
header('Content-Disposition: attachment; filename='.$filename.".csv");
print $export_csv_all_details;			
exit;
?>