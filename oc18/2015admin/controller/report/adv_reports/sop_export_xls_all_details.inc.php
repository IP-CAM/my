<?php
ini_set("memory_limit","256M");

		// we use our own error handler
		global $config;
		global $log;
		$config = $this->config;
		$log = $this->log;
		set_error_handler('error_handler_for_export',E_ALL);
		register_shutdown_function('fatal_error_shutdown_handler_for_export');
		
		// Creating a workbook
		$workbook = new Spreadsheet_Excel_Writer();
		$workbook->setTempDir(DIR_CACHE);
		$workbook->setVersion(8); // Use Excel97/2000 BIFF8 Format

		// Formating a workbook
		$textFormat =& $workbook->addFormat(array('Align' => 'left', 'NumFormat' => "@"));
		
		$numberFormat =& $workbook->addFormat(array('Align' => 'left'));	

		$priceFormat =& $workbook->addFormat(array('Align' => 'right'));
		$priceFormat->setNumFormat('0.00');

		$saleFormat =& $workbook->addFormat(array('Align' => 'right'));
		$saleFormat->setColor('green');	
		$saleFormat->setNumFormat('0.00');

		$workbook->setCustomColor(42, 220, 255, 185);
		$salesColumnFormat =& $workbook->addFormat(array('Align' => 'right', 'FgColor' => '42', 'bordercolor' => 'silver'));
		$salesColumnFormat->setBorder(1);	
		$salesColumnFormat->setNumFormat('0.00');
		
		$costFormat =& $workbook->addFormat(array('Align' => 'right'));
		$costFormat->setColor('red');		
		$costFormat->setNumFormat('0.00');

		$workbook->setCustomColor(29, 255, 215, 215);
		$costsColumnFormat =& $workbook->addFormat(array('Align' => 'right', 'FgColor' => '29', 'bordercolor' => 'silver'));
		$costsColumnFormat->setBorder(1);		
		$costsColumnFormat->setNumFormat('0.00');

		$workbook->setCustomColor(44, 196, 217, 238);
		$profitColumnFormat =& $workbook->addFormat(array('Align' => 'right', 'FgColor' => '44', 'bold' => 1, 'bordercolor' => 'silver'));
		$profitColumnFormat->setBorder(1);		
		$profitColumnFormat->setNumFormat('0.00');
		$percentColumnFormat =& $workbook->addFormat(array('Align' => 'right', 'FgColor' => '44', 'bold' => 1, 'bordercolor' => 'silver'));
		$percentColumnFormat->setBorder(1);		
		$percentColumnFormat->setNumFormat('0.00%');

		$workbook->setCustomColor(45, 249, 153, 153);
		$noprofitColumnFormat =& $workbook->addFormat(array('Align' => 'right', 'FgColor' => '45', 'bold' => 1, 'bordercolor' => 'silver'));
		$noprofitColumnFormat->setBorder(1);		
		$noprofitColumnFormat->setNumFormat('0.00');
		$nopercentColumnFormat =& $workbook->addFormat(array('Align' => 'right', 'FgColor' => '45', 'bold' => 1, 'bordercolor' => 'silver'));
		$nopercentColumnFormat->setBorder(1);		
		$nopercentColumnFormat->setNumFormat('0.00%');
		
		$boxFormatText =& $workbook->addFormat(array('bold' => 1));
		$boxFormatNumber =& $workbook->addFormat(array('Align' => 'right', 'bold' => 1));
		
		// sending HTTP headers
		$workbook->send('sale_profit_report_all_details_'.date("Y-m-d",time()).'.xls');
		
		$worksheet =& $workbook->addWorksheet('Sales Orders Report + Profit');
		$worksheet->setInputEncoding('UTF-8');
		$worksheet->setZoom(90);

		// Set the column widths
		$j = 0;
		$worksheet->setColumn($j,$j++,10); // A
		$worksheet->setColumn($j,$j++,13); // B
		isset($_POST['sop1000']) ? $worksheet->setColumn($j,$j++,15) : ''; // C
		isset($_POST['sop1001']) ? $worksheet->setColumn($j,$j++,20) : ''; // D
		isset($_POST['sop1002']) ? $worksheet->setColumn($j,$j++,20) : ''; // E
		isset($_POST['sop1003']) ? $worksheet->setColumn($j,$j++,15) : ''; // F
		isset($_POST['sop1004']) ? $worksheet->setColumn($j,$j++,10) : ''; // G
		isset($_POST['sop1005']) ? $worksheet->setColumn($j,$j++,13) : ''; // H
		isset($_POST['sop1006']) ? $worksheet->setColumn($j,$j++,13) : ''; // I
		isset($_POST['sop1007']) ? $worksheet->setColumn($j,$j++,25) : ''; // J
		isset($_POST['sop1008']) ? $worksheet->setColumn($j,$j++,20) : ''; // K
		isset($_POST['sop1009']) ? $worksheet->setColumn($j,$j++,20) : ''; // L
		isset($_POST['sop1010']) ? $worksheet->setColumn($j,$j++,20) : ''; // M
		isset($_POST['sop1011']) ? $worksheet->setColumn($j,$j++,20) : ''; // N
		isset($_POST['sop1012']) ? $worksheet->setColumn($j,$j++,10) : ''; // O
		isset($_POST['sop1013']) ? $worksheet->setColumn($j,$j++,13) : ''; // P
		isset($_POST['sop1014']) ? $worksheet->setColumn($j,$j++,15) : ''; // Q
		isset($_POST['sop1016a']) ? $worksheet->setColumn($j,$j++,13) : ''; // R
		isset($_POST['sop1015']) ? $worksheet->setColumn($j,$j++,13) : ''; // S	
		isset($_POST['sop1016b']) ? $worksheet->setColumn($j,$j++,13) : ''; // T		
		isset($_POST['sop1016c']) ? $worksheet->setColumn($j,$j++,15) : ''; // U
		isset($_POST['sop1017']) ? $worksheet->setColumn($j,$j++,13) : ''; // V
		isset($_POST['sop1018']) ? $worksheet->setColumn($j,$j++,13) : ''; // W
		isset($_POST['sop1019']) ? $worksheet->setColumn($j,$j++,16) : ''; // X
		isset($_POST['sop1020']) ? $worksheet->setColumn($j,$j++,13) : ''; // Y
		isset($_POST['sop1021']) ? $worksheet->setColumn($j,$j++,13) : ''; // Z
		isset($_POST['sop1022']) ? $worksheet->setColumn($j,$j++,13) : ''; // AA
		isset($_POST['sop1023']) ? $worksheet->setColumn($j,$j++,13) : ''; // AB
		isset($_POST['sop1024']) ? $worksheet->setColumn($j,$j++,13) : ''; // AC
		isset($_POST['sop1025']) ? $worksheet->setColumn($j,$j++,13) : ''; // AD
		isset($_POST['sop1026']) ? $worksheet->setColumn($j,$j++,19) : ''; // AE
		isset($_POST['sop1027']) ? $worksheet->setColumn($j,$j++,13) : ''; // AF
		isset($_POST['sop1028']) ? $worksheet->setColumn($j,$j++,13) : ''; // AG
		isset($_POST['sop1029']) ? $worksheet->setColumn($j,$j++,13) : ''; // AH
		isset($_POST['sop1030']) ? $worksheet->setColumn($j,$j++,15) : ''; // AI
		isset($_POST['sop1031']) ? $worksheet->setColumn($j,$j++,13) : ''; // AJ
		isset($_POST['sop1032']) ? $worksheet->setColumn($j,$j++,14) : ''; // AK
		isset($_POST['sop1033']) ? $worksheet->setColumn($j,$j++,19) : ''; // AL
		isset($_POST['sop1034']) ? $worksheet->setColumn($j,$j++,19) : ''; // AM
		isset($_POST['sop1035']) ? $worksheet->setColumn($j,$j++,19) : ''; // AN
		isset($_POST['sop1036']) ? $worksheet->setColumn($j,$j++,19) : ''; // AO
		isset($_POST['sop1063']) ? $worksheet->setColumn($j,$j++,19) : ''; // AP
		isset($_POST['sop1037']) ? $worksheet->setColumn($j,$j++,15) : ''; // AQ
		isset($_POST['sop1038']) ? $worksheet->setColumn($j,$j++,13) : ''; // AR
		isset($_POST['sop1039']) ? $worksheet->setColumn($j,$j++,15) : ''; // AS
		isset($_POST['sop1040']) ? $worksheet->setColumn($j,$j++,18) : ''; // AT
		isset($_POST['sop1041']) ? $worksheet->setColumn($j,$j++,18) : ''; // AU
		isset($_POST['sop1042']) ? $worksheet->setColumn($j,$j++,13) : ''; // AV
		isset($_POST['sop1043']) ? $worksheet->setColumn($j,$j++,18) : ''; // AW
		isset($_POST['sop1044']) ? $worksheet->setColumn($j,$j++,11) : ''; // AX
		isset($_POST['sop1045']) ? $worksheet->setColumn($j,$j++,20) : ''; // AY
		isset($_POST['sop1046']) ? $worksheet->setColumn($j,$j++,20) : ''; // AZ
		isset($_POST['sop1047']) ? $worksheet->setColumn($j,$j++,20) : ''; // BA
		isset($_POST['sop1048']) ? $worksheet->setColumn($j,$j++,20) : ''; // BB
		isset($_POST['sop1049']) ? $worksheet->setColumn($j,$j++,20) : ''; // BC
		isset($_POST['sop1050']) ? $worksheet->setColumn($j,$j++,21) : ''; // BD
		isset($_POST['sop1051']) ? $worksheet->setColumn($j,$j++,17) : ''; // BE
		isset($_POST['sop1052']) ? $worksheet->setColumn($j,$j++,20) : ''; // BF
		isset($_POST['sop1053']) ? $worksheet->setColumn($j,$j++,15) : ''; // BG
		isset($_POST['sop1054']) ? $worksheet->setColumn($j,$j++,20) : ''; // BH
		isset($_POST['sop1055']) ? $worksheet->setColumn($j,$j++,20) : ''; // BI
		isset($_POST['sop1056']) ? $worksheet->setColumn($j,$j++,20) : ''; // BJ
		isset($_POST['sop1057']) ? $worksheet->setColumn($j,$j++,20) : ''; // BK
		isset($_POST['sop1058']) ? $worksheet->setColumn($j,$j++,20) : ''; // BL
		isset($_POST['sop1059']) ? $worksheet->setColumn($j,$j++,21) : ''; // BM
		isset($_POST['sop1060']) ? $worksheet->setColumn($j,$j++,17) : ''; // BN
		isset($_POST['sop1061']) ? $worksheet->setColumn($j,$j++,20) : ''; // BO
		isset($_POST['sop1064']) ? $worksheet->setColumn($j,$j++,15) : ''; // BP
		
		// The order headings row
		$i = 0;
		$j = 0;	
		$worksheet->writeString($i, $j++, $this->language->get('column_order_order_id'), $boxFormatText); // A
		$worksheet->writeString($i, $j++, $this->language->get('column_order_date_added'), $boxFormatText); // B
		isset($_POST['sop1000']) ? $worksheet->writeString($i, $j++, $this->language->get('column_order_inv_no'), $boxFormatText) : ''; // C
		isset($_POST['sop1001']) ? $worksheet->writeString($i, $j++, $this->language->get('column_order_customer_name'), $boxFormatText) : ''; // D
		isset($_POST['sop1002']) ? $worksheet->writeString($i, $j++, $this->language->get('column_order_email'), $boxFormatText) : ''; // E
		isset($_POST['sop1003']) ? $worksheet->writeString($i, $j++, $this->language->get('column_order_customer_group'), $boxFormatText) : ''; // F
		isset($_POST['sop1004']) ? $worksheet->writeString($i, $j++, $this->language->get('column_prod_id'), $boxFormatText) : ''; // G
		isset($_POST['sop1005']) ? $worksheet->writeString($i, $j++, $this->language->get('column_prod_sku'), $boxFormatText) : ''; // H
		isset($_POST['sop1006']) ? $worksheet->writeString($i, $j++, $this->language->get('column_prod_model'), $boxFormatText) : ''; // I
		isset($_POST['sop1007']) ? $worksheet->writeString($i, $j++, $this->language->get('column_prod_name'), $boxFormatText) : ''; // J
		isset($_POST['sop1008']) ? $worksheet->writeString($i, $j++, $this->language->get('column_prod_option'), $boxFormatText) : ''; // K
		isset($_POST['sop1009']) ? $worksheet->writeString($i, $j++, $this->language->get('column_prod_attributes'), $boxFormatText) : ''; // L
		isset($_POST['sop1010']) ? $worksheet->writeString($i, $j++, $this->language->get('column_prod_manu'), $boxFormatText) : ''; // M
		isset($_POST['sop1011']) ? $worksheet->writeString($i, $j++, $this->language->get('column_prod_category'), $boxFormatText) : ''; // N
		isset($_POST['sop1012']) ? $worksheet->writeString($i, $j++, $this->language->get('column_prod_currency'), $boxFormatText) : ''; // O
		isset($_POST['sop1013']) ? $worksheet->writeString($i, $j++, $this->language->get('column_prod_price'), $boxFormatNumber) : ''; // P
		isset($_POST['sop1014']) ? $worksheet->writeString($i, $j++, $this->language->get('column_prod_quantity'), $boxFormatNumber) : ''; // Q
		isset($_POST['sop1016a']) ? $worksheet->writeString($i, $j++, $this->language->get('column_prod_total_excl_vat'), $boxFormatNumber) : ''; // R		
		isset($_POST['sop1015']) ? $worksheet->writeString($i, $j++, $this->language->get('column_prod_tax'), $boxFormatNumber) : ''; // S
		isset($_POST['sop1016b']) ? $worksheet->writeString($i, $j++, $this->language->get('column_prod_total_incl_vat'), $boxFormatNumber) : ''; // T
		isset($_POST['sop1016c']) ? $worksheet->writeString($i, $j++, $this->language->get('column_prod_sales'), $boxFormatNumber) : ''; // U
		isset($_POST['sop1017']) ? $worksheet->writeString($i, $j++, $this->language->get('column_prod_costs'), $boxFormatNumber) : ''; // V
		isset($_POST['sop1018']) ? $worksheet->writeString($i, $j++, $this->language->get('column_prod_profit'), $boxFormatNumber) : ''; // W
		isset($_POST['sop1019']) ? $worksheet->writeString($i, $j++, $this->language->get('column_prod_profit') . ' [%]', $boxFormatNumber) : ''; // X
		isset($_POST['sop1020']) ? $worksheet->writeString($i, $j++, $this->language->get('column_sub_total'), $boxFormatNumber) : ''; // Y
		isset($_POST['sop1021']) ? $worksheet->writeString($i, $j++, $this->language->get('column_handling'), $boxFormatNumber) : ''; // Z
		isset($_POST['sop1022']) ? $worksheet->writeString($i, $j++, $this->language->get('column_loworder'), $boxFormatNumber) : ''; // AA
		isset($_POST['sop1023']) ? $worksheet->writeString($i, $j++, $this->language->get('column_shipping'), $boxFormatNumber) : ''; // AB
		isset($_POST['sop1024']) ? $worksheet->writeString($i, $j++, $this->language->get('column_reward'), $boxFormatNumber) : ''; // AC
		isset($_POST['sop1025']) ? $worksheet->writeString($i, $j++, $this->language->get('column_coupon'), $boxFormatNumber) : ''; // AD
		isset($_POST['sop1026']) ? $worksheet->writeString($i, $j++, $this->language->get('column_coupon_code'), $boxFormatText) : ''; // AE
		isset($_POST['sop1027']) ? $worksheet->writeString($i, $j++, $this->language->get('column_order_tax'), $boxFormatNumber) : ''; // AF
		isset($_POST['sop1028']) ? $worksheet->writeString($i, $j++, $this->language->get('column_credit'), $boxFormatNumber) : ''; // AG
		isset($_POST['sop1029']) ? $worksheet->writeString($i, $j++, $this->language->get('column_voucher'), $boxFormatNumber) : ''; // AH
		isset($_POST['sop1030']) ? $worksheet->writeString($i, $j++, $this->language->get('column_voucher_code'), $boxFormatText) : ''; // AI
		isset($_POST['sop1031']) ? $worksheet->writeString($i, $j++, $this->language->get('column_order_value'), $boxFormatNumber) : ''; // AJ
		isset($_POST['sop1032']) ? $worksheet->writeString($i, $j++, $this->language->get('column_order_sales'), $boxFormatNumber) : ''; // AK
		isset($_POST['sop1033']) ? $worksheet->writeString($i, $j++, $this->language->get('column_order_prod_costs'), $boxFormatNumber) : ''; // AL
		isset($_POST['sop1034']) ? $worksheet->writeString($i, $j++, $this->language->get('column_order_commission'), $boxFormatNumber) : ''; // AM
		isset($_POST['sop1035']) ? $worksheet->writeString($i, $j++, $this->language->get('column_order_payment_cost'), $boxFormatNumber) : ''; // AN
		isset($_POST['sop1036']) ? $worksheet->writeString($i, $j++, $this->language->get('column_order_shipping_cost'), $boxFormatNumber) : ''; // AO
		isset($_POST['sop1063']) ? $worksheet->writeString($i, $j++, $this->language->get('column_shipping_balance'), $boxFormatNumber) : ''; // AP
		isset($_POST['sop1037']) ? $worksheet->writeString($i, $j++, $this->language->get('column_order_costs'), $boxFormatNumber) : ''; // AQ
		isset($_POST['sop1038']) ? $worksheet->writeString($i, $j++, $this->language->get('column_order_profit'), $boxFormatNumber) : ''; // AR
		isset($_POST['sop1039']) ? $worksheet->writeString($i, $j++, $this->language->get('column_order_profit') . ' [%]', $boxFormatNumber) : ''; // AS
		isset($_POST['sop1040']) ? $worksheet->writeString($i, $j++, $this->language->get('column_order_shipping_method'), $boxFormatText) : ''; // AT
		isset($_POST['sop1041']) ? $worksheet->writeString($i, $j++, $this->language->get('column_order_payment_method'), $boxFormatText) : ''; // AU
		isset($_POST['sop1042']) ? $worksheet->writeString($i, $j++, $this->language->get('column_order_status'), $boxFormatText) : ''; // AV
		isset($_POST['sop1043']) ? $worksheet->writeString($i, $j++, $this->language->get('column_order_store'), $boxFormatText) : ''; // AW
		isset($_POST['sop1044']) ? $worksheet->writeString($i, $j++, $this->language->get('column_customer_cust_id'), $boxFormatText) : ''; // AX
		isset($_POST['sop1045']) ? $worksheet->writeString($i, $j++, strip_tags($this->language->get('column_billing_name')), $boxFormatText) : ''; // AY
		isset($_POST['sop1046']) ? $worksheet->writeString($i, $j++, strip_tags($this->language->get('column_billing_company')), $boxFormatText) : ''; // AZ
		isset($_POST['sop1047']) ? $worksheet->writeString($i, $j++, strip_tags($this->language->get('column_billing_address_1')), $boxFormatText) : ''; // BA
		isset($_POST['sop1048']) ? $worksheet->writeString($i, $j++, strip_tags($this->language->get('column_billing_address_2')), $boxFormatText) : ''; // BB
		isset($_POST['sop1049']) ? $worksheet->writeString($i, $j++, strip_tags($this->language->get('column_billing_city')), $boxFormatText) : ''; // BC
		isset($_POST['sop1050']) ? $worksheet->writeString($i, $j++, strip_tags($this->language->get('column_billing_zone')), $boxFormatText) : ''; // BD
		isset($_POST['sop1051']) ? $worksheet->writeString($i, $j++, strip_tags($this->language->get('column_billing_postcode')), $boxFormatText) : ''; // BE
		isset($_POST['sop1052']) ? $worksheet->writeString($i, $j++, strip_tags($this->language->get('column_billing_country')), $boxFormatText) : ''; // BF
		isset($_POST['sop1053']) ? $worksheet->writeString($i, $j++, $this->language->get('column_customer_telephone'), $boxFormatText) : ''; // BG
		isset($_POST['sop1054']) ? $worksheet->writeString($i, $j++, strip_tags($this->language->get('column_shipping_name')), $boxFormatText) : ''; // BH
		isset($_POST['sop1055']) ? $worksheet->writeString($i, $j++, strip_tags($this->language->get('column_shipping_company')), $boxFormatText) : ''; // BI
		isset($_POST['sop1056']) ? $worksheet->writeString($i, $j++, strip_tags($this->language->get('column_shipping_address_1')), $boxFormatText) : ''; // BJ
		isset($_POST['sop1057']) ? $worksheet->writeString($i, $j++, strip_tags($this->language->get('column_shipping_address_2')), $boxFormatText) : ''; // BK
		isset($_POST['sop1058']) ? $worksheet->writeString($i, $j++, strip_tags($this->language->get('column_shipping_city')), $boxFormatText) : ''; // BL
		isset($_POST['sop1059']) ? $worksheet->writeString($i, $j++, strip_tags($this->language->get('column_shipping_zone')), $boxFormatText) : ''; // BM
		isset($_POST['sop1060']) ? $worksheet->writeString($i, $j++, strip_tags($this->language->get('column_shipping_postcode')), $boxFormatText) : ''; // BN
		isset($_POST['sop1061']) ? $worksheet->writeString($i, $j++, strip_tags($this->language->get('column_shipping_country')), $boxFormatText) : ''; // BO
		isset($_POST['sop1064']) ? $worksheet->writeString($i, $j++, $this->language->get('column_order_comment'), $boxFormatText) : ''; // BP

		// The actual orders data
		$i += 1;
		$j = 0;
		
			foreach ($rows as $row) {
			$order_sales = $row['order_sub_total']+$row['order_handling']+$row['order_low_order_fee']+$row['order_reward']+$row['order_coupon']+$row['order_credit']+$row['order_voucher']+($data['adv_profit_reports_formula_sop1'] ? $row['order_shipping'] : 0);
			$order_costs = $row['order_product_costs']+$row['order_commission']+($data['adv_profit_reports_formula_sop3'] ? $row['order_payment_cost'] : 0)+($data['adv_profit_reports_formula_sop2'] ? $row['order_shipping_cost'] : 0);
		
			$excelRow = $i+1;			
				$worksheet->write($i, $j++, $row['order_id'], $numberFormat); // A
				$worksheet->write($i, $j++, date($this->language->get('date_format_short'), strtotime($row['date_added'])), $textFormat); // B
				isset($_POST['sop1000']) ? $worksheet->write($i, $j++, $row['invoice_prefix'] . $row['invoice_no'], $textFormat) : ''; // C
				isset($_POST['sop1001']) ? $worksheet->write($i, $j++, $row['firstname'] . ' ' . $row['lastname'], $textFormat) : ''; // D
				isset($_POST['sop1002']) ? $worksheet->write($i, $j++, $row['email'], $textFormat) : ''; // E
				isset($_POST['sop1003']) ? $worksheet->write($i, $j++, $row['order_group'], $textFormat) : ''; // F
				isset($_POST['sop1004']) ? $worksheet->write($i, $j++, $row['product_id'], $numberFormat) : ''; // G
				isset($_POST['sop1005']) ? $worksheet->write($i, $j++, $row['product_sku'], $textFormat) : ''; // H
				isset($_POST['sop1006']) ? $worksheet->write($i, $j++, $row['product_model'], $textFormat) : ''; // I
				isset($_POST['sop1007']) ? $worksheet->write($i, $j++, html_entity_decode($row['product_name']), $textFormat) : ''; // J
				isset($_POST['sop1008']) ? $worksheet->write($i, $j++, html_entity_decode($row['product_option']), $textFormat) : ''; // K
				isset($_POST['sop1009']) ? $worksheet->write($i, $j++, html_entity_decode($row['product_attributes']), $textFormat) : ''; // L
				isset($_POST['sop1010']) ? $worksheet->write($i, $j++, html_entity_decode($row['product_manu']), $textFormat) : ''; // M
				isset($_POST['sop1011']) ? $worksheet->write($i, $j++, html_entity_decode($row['product_category']), $textFormat) : ''; // N
				isset($_POST['sop1012']) ? $worksheet->write($i, $j++, $row['currency_code'], $textFormat) : ''; // O
				isset($_POST['sop1013']) ? $worksheet->write($i, $j++, $row['product_price'], $priceFormat) : ''; // P
				isset($_POST['sop1014']) ? $worksheet->write($i, $j++, $row['product_quantity']) : ''; // Q
				isset($_POST['sop1016a']) ? $worksheet->write($i, $j++, $row['product_total_excl_vat'], $priceFormat) : ''; // R
				isset($_POST['sop1015']) ? $worksheet->write($i, $j++, $row['product_tax'], $priceFormat) : ''; // S
				isset($_POST['sop1016b']) ? $worksheet->write($i, $j++, $row['product_total_incl_vat'], $priceFormat) : ''; // T
				isset($_POST['sop1016c']) ? $worksheet->write($i, $j++, $row['product_sales'], $salesColumnFormat) : ''; // U
				isset($_POST['sop1017']) ? $worksheet->write($i, $j++, '-' . $row['product_costs'], $costsColumnFormat) : ''; // V
				if ($row['product_profit'] >= 0) {
				isset($_POST['sop1018']) ? $worksheet->write($i, $j++, $row['product_profit'], $profitColumnFormat) : ''; // W
				isset($_POST['sop1019']) ? $worksheet->write($i, $j++, $row['product_profit_margin_percent'] / 100, $percentColumnFormat) : ''; // X
				} else {
				isset($_POST['sop1018']) ? $worksheet->write($i, $j++, $row['product_profit'], $noprofitColumnFormat) : ''; // W
				isset($_POST['sop1019']) ? $worksheet->write($i, $j++, $row['product_profit_margin_percent'] / 100, $nopercentColumnFormat) : ''; // X
				}
				isset($_POST['sop1020']) ? $worksheet->write($i, $j++, $row['order_sub_total'], $saleFormat) : ''; // Y
				isset($_POST['sop1021']) ? $worksheet->write($i, $j++, $row['order_handling'] != NULL ? $row['order_handling'] : '0.00', $saleFormat) : ''; // Z
				isset($_POST['sop1022']) ? $worksheet->write($i, $j++, $row['order_low_order_fee'] != NULL ? $row['order_low_order_fee'] : '0.00', $saleFormat) : ''; // AA
				if ($this->config->get('adv_profit_reports_formula_sop1')) {
				isset($_POST['sop1023']) ? $worksheet->write($i, $j++, $row['order_shipping'] != NULL ? $row['order_shipping'] : '0.00', $saleFormat) : ''; // AB
				} else {
				isset($_POST['sop1023']) ? $worksheet->write($i, $j++, $row['order_shipping'] != NULL ? $row['order_shipping'] : '0.00', $priceFormat) : ''; // AB
				}
				isset($_POST['sop1024']) ? $worksheet->write($i, $j++, $row['order_reward'] != NULL ? $row['order_reward'] : '0.00', $saleFormat) : ''; // AC
				isset($_POST['sop1025']) ? $worksheet->write($i, $j++, $row['order_coupon'] != NULL ? $row['order_coupon'] : '0.00', $saleFormat) : ''; // AD
				isset($_POST['sop1026']) ? $worksheet->write($i, $j++, $row['order_coupon_code'], $textFormat) : ''; // AE
				isset($_POST['sop1027']) ? $worksheet->write($i, $j++, $row['order_tax'] != NULL ? $row['order_tax'] : '0.00', $priceFormat) : ''; // AF
				isset($_POST['sop1028']) ? $worksheet->write($i, $j++, $row['order_credit'] != NULL ? $row['order_credit'] : '0.00', $saleFormat) : ''; // AG
				isset($_POST['sop1029']) ? $worksheet->write($i, $j++, $row['order_voucher'] != NULL ? $row['order_voucher'] : '0.00', $saleFormat) : ''; // AH
				isset($_POST['sop1030']) ? $worksheet->write($i, $j++, $row['order_voucher_code'], $textFormat) : ''; // AI
				isset($_POST['sop1031']) ? $worksheet->write($i, $j++, $row['order_value'], $priceFormat) : ''; // AJ
				isset($_POST['sop1032']) ? $worksheet->write($i, $j++, $order_sales, $salesColumnFormat) : ''; // AK
				isset($_POST['sop1033']) ? $worksheet->write($i, $j++, '-' . $row['order_product_costs'], $costFormat) : ''; // AL
				isset($_POST['sop1034']) ? $worksheet->write($i, $j++, -$row['order_commission'], $costFormat) : ''; // AM
				if ($this->config->get('adv_profit_reports_formula_sop3')) {
				isset($_POST['sop1035']) ? $worksheet->write($i, $j++, -$row['order_payment_cost'], $costFormat) : ''; // AN
				} else {
				isset($_POST['sop1035']) ? $worksheet->write($i, $j++, -$row['order_payment_cost'], $priceFormat) : ''; // AN
				}
				if ($this->config->get('adv_profit_reports_formula_sop2')) {
				isset($_POST['sop1036']) ? $worksheet->write($i, $j++, -$row['order_shipping_cost'], $costFormat) : ''; // AO
				} else {
				isset($_POST['sop1036']) ? $worksheet->write($i, $j++, -$row['order_shipping_cost'], $priceFormat) : ''; // AO
				}
				isset($_POST['sop1063']) ? $worksheet->write($i, $j++, $row['order_shipping']-$row['order_shipping_cost'], $priceFormat) : ''; // AP
				isset($_POST['sop1037']) ? $worksheet->write($i, $j++, '-' . $order_costs, $costsColumnFormat) : ''; // AQ
				if (($order_sales-$order_costs) >= 0) {
				isset($_POST['sop1038']) ? $worksheet->write($i, $j++, $order_sales-$order_costs, $profitColumnFormat) : ''; // AR
				} else {
				isset($_POST['sop1038']) ? $worksheet->write($i, $j++, $order_sales-$order_costs, $noprofitColumnFormat) : ''; // AR
				}
				if ($order_costs > 0) {
				if (($order_sales-$order_costs) >= 0) {
				isset($_POST['sop1039']) ? $worksheet->write($i, $j++, round(100 * (($order_sales-$order_costs) / $order_sales), 2) / 100, $percentColumnFormat) : ''; // AS
				} else {
				isset($_POST['sop1039']) ? $worksheet->write($i, $j++, round(100 * (($order_sales-$order_costs) / $order_sales), 2) / 100, $nopercentColumnFormat) : ''; // AS
				}					
				} else {
				isset($_POST['sop1039']) ? $worksheet->write($i, $j++, '1', $percentColumnFormat) : ''; // AS
				}
				isset($_POST['sop1040']) ? $worksheet->write($i, $j++, strip_tags($row['shipping_method']), $textFormat) : ''; // AT
				isset($_POST['sop1041']) ? $worksheet->write($i, $j++, strip_tags($row['payment_method']), $textFormat) : ''; // AU
				isset($_POST['sop1042']) ? $worksheet->write($i, $j++, $row['order_status'], $textFormat) : ''; // AV
				isset($_POST['sop1043']) ? $worksheet->write($i, $j++, html_entity_decode($row['store_name']), $textFormat) : ''; // AW
				isset($_POST['sop1044']) ? $worksheet->write($i, $j++, $row['customer_id'], $numberFormat) : ''; // AX
				isset($_POST['sop1045']) ? $worksheet->write($i, $j++, $row['payment_firstname'] . ' ' . $row['payment_lastname'], $textFormat) : ''; // AY
				isset($_POST['sop1046']) ? $worksheet->write($i, $j++, $row['payment_company'], $textFormat) : ''; // AZ
				isset($_POST['sop1047']) ? $worksheet->write($i, $j++, $row['payment_address_1'], $textFormat) : ''; // BA
				isset($_POST['sop1048']) ? $worksheet->write($i, $j++, $row['payment_address_2'], $textFormat) : ''; // BB
				isset($_POST['sop1049']) ? $worksheet->write($i, $j++, $row['payment_city'], $textFormat) : ''; // BC
				isset($_POST['sop1050']) ? $worksheet->write($i, $j++, $row['payment_zone'], $textFormat) : ''; // BD
				isset($_POST['sop1051']) ? $worksheet->write($i, $j++, $row['payment_postcode'], $textFormat) : ''; // BE
				isset($_POST['sop1052']) ? $worksheet->write($i, $j++, $row['payment_country'], $textFormat) : ''; // BF
				isset($_POST['sop1053']) ? $worksheet->write($i, $j++, $row['telephone'], $textFormat) : ''; // BG
				isset($_POST['sop1054']) ? $worksheet->write($i, $j++, $row['shipping_firstname'] . ' ' . $row['shipping_lastname'], $textFormat) : ''; // BH
				isset($_POST['sop1055']) ? $worksheet->write($i, $j++, $row['shipping_company'], $textFormat) : ''; // BI
				isset($_POST['sop1056']) ? $worksheet->write($i, $j++, $row['shipping_address_1'], $textFormat) : ''; // BJ
				isset($_POST['sop1057']) ? $worksheet->write($i, $j++, $row['shipping_address_2'], $textFormat) : ''; // BK
				isset($_POST['sop1058']) ? $worksheet->write($i, $j++, $row['shipping_city'], $textFormat) : ''; // BL
				isset($_POST['sop1059']) ? $worksheet->write($i, $j++, $row['shipping_zone'], $textFormat) : ''; // BM
				isset($_POST['sop1060']) ? $worksheet->write($i, $j++, $row['shipping_postcode'], $textFormat) : ''; // BN
				isset($_POST['sop1061']) ? $worksheet->write($i, $j++, $row['shipping_country'], $textFormat) : ''; // BO
				isset($_POST['sop1064']) ? $worksheet->write($i, $j++, html_entity_decode($row['comment']), $textFormat) : ''; // BP

				$i += 1;
				$j = 0;
			}
		
		$worksheet->freezePanes(array(1, 1, 1, 1));
		
		// Let's send the file		
		$workbook->close();
		
		// Clear the spreadsheet caches
		$this->clearSpreadsheetCache();
		exit;
?>