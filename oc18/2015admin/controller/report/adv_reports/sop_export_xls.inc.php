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
		$workbook->send('sale_profit_report_'.date("Y-m-d",time()).'.xls');
		
		$worksheet =& $workbook->addWorksheet('Sales Orders Report + Profit');
		$worksheet->setInputEncoding('UTF-8');
		$worksheet->setZoom(90);

		// Set the column widths
		$j = 0;
		if ($filter_report == 'sales_summary') {
		if ($filter_group == 'year') {	
		$worksheet->setMerge(0, 1, 0, 1);
		$worksheet->setColumn($j,$j++,10); // A,B
		} elseif ($filter_group == 'quarter') {
		$worksheet->setColumn($j,$j++,10); // A
		$worksheet->setColumn($j,$j++,10); // B			
		} elseif ($filter_group == 'month') {
		$worksheet->setColumn($j,$j++,10); // A
		$worksheet->setColumn($j,$j++,13); // B
		} elseif ($filter_group == 'day') {
		$worksheet->setMerge(0, 1, 0, 1);
		$worksheet->setColumn($j,$j++,13); // A,B
		} elseif ($filter_group == 'order') {
		$worksheet->setColumn($j,$j++,10); // A
		$worksheet->setColumn($j,$j++,13); // B
		} else {
		$worksheet->setColumn($j,$j++,13); // A
		$worksheet->setColumn($j,$j++,13); // B
		}
		} elseif ($filter_report == 'day_of_week') {
		$worksheet->setMerge(0, 1, 0, 1);
		$worksheet->setColumn($j,$j++,15); // A,B
		} elseif ($filter_report == 'hour') {
		$worksheet->setMerge(0, 1, 0, 1);
		$worksheet->setColumn($j,$j++,10); // A,B
		} elseif ($filter_report == 'store') {
		$worksheet->setMerge(0, 1, 0, 1);
		$worksheet->setColumn($j,$j++,20); // A,B
		} elseif ($filter_report == 'customer_group') {
		$worksheet->setMerge(0, 1, 0, 1);
		$worksheet->setColumn($j,$j++,15); // A,B
		} elseif ($filter_report == 'country') {
		$worksheet->setMerge(0, 1, 0, 1);
		$worksheet->setColumn($j,$j++,15); // A,B
		} elseif ($filter_report == 'postcode') {
		$worksheet->setMerge(0, 1, 0, 1);
		$worksheet->setColumn($j,$j++,18); // A,B
		} elseif ($filter_report == 'region_state') {
		$worksheet->setMerge(0, 1, 0, 1);
		$worksheet->setColumn($j,$j++,25); // A,B
		} elseif ($filter_report == 'city') {
		$worksheet->setMerge(0, 1, 0, 1);
		$worksheet->setColumn($j,$j++,25); // A,B
		} elseif ($filter_report == 'payment_method') {
		$worksheet->setMerge(0, 1, 0, 1);
		$worksheet->setColumn($j,$j++,20); // A,B
		} elseif ($filter_report == 'shipping_method') {
		$worksheet->setMerge(0, 1, 0, 1);
		$worksheet->setColumn($j,$j++,20); // A,B	
		}			
		isset($_POST['sop20']) ? $worksheet->setColumn($j,$j++,10) : ''; // C
		isset($_POST['sop21']) ? $worksheet->setColumn($j,$j++,10) : ''; // D
		isset($_POST['sop22']) ? $worksheet->setColumn($j,$j++,10) : ''; // E
		isset($_POST['sop23']) ? $worksheet->setColumn($j,$j++,13) : ''; // F
		isset($_POST['sop24']) ? $worksheet->setColumn($j,$j++,15) : ''; // G
		isset($_POST['sop25']) ? $worksheet->setColumn($j,$j++,15) : ''; // H
		isset($_POST['sop27']) ? $worksheet->setColumn($j,$j++,13) : ''; // I
		isset($_POST['sop26']) ? $worksheet->setColumn($j,$j++,15) : ''; // J
		isset($_POST['sop28']) ? $worksheet->setColumn($j,$j++,13) : ''; // K
		isset($_POST['sop29']) ? $worksheet->setColumn($j,$j++,13) : ''; // L
		isset($_POST['sop30']) ? $worksheet->setColumn($j,$j++,15) : ''; // M
		isset($_POST['sop31']) ? $worksheet->setColumn($j,$j++,15) : ''; // N
		isset($_POST['sop33']) ? $worksheet->setColumn($j,$j++,15) : ''; // O
		isset($_POST['sop37']) ? $worksheet->setColumn($j,$j++,15) : ''; // P
		isset($_POST['sop34']) ? $worksheet->setColumn($j,$j++,13) : ''; // Q
		isset($_POST['sop32']) ? $worksheet->setColumn($j,$j++,20) : ''; // R
		isset($_POST['sop391']) ? $worksheet->setColumn($j,$j++,13) : ''; // S	
		isset($_POST['sop392']) ? $worksheet->setColumn($j,$j++,13) : ''; // T		
		isset($_POST['sop393']) ? $worksheet->setColumn($j,$j++,16) : ''; // U
		isset($_POST['sop38']) ? $worksheet->setColumn($j,$j++,15) : ''; // V
		isset($_POST['sop35']) ? $worksheet->setColumn($j,$j++,13) : ''; // W
		isset($_POST['sop36']) ? $worksheet->setColumn($j,$j++,13) : ''; // X
		
		// The order headings row
		$i = 0;
		$j = 0;
		if ($filter_report == 'sales_summary') {
		if ($filter_group == 'year') {	
		$worksheet->writeString($i, $j++, $this->language->get('column_year'), $boxFormatText); // A,B
		} elseif ($filter_group == 'quarter') {
		$worksheet->writeString($i, $j++, $this->language->get('column_year'), $boxFormatText); // A
		$worksheet->writeString($i, $j++, $this->language->get('column_quarter'), $boxFormatText); // B		
		} elseif ($filter_group == 'month') {
		$worksheet->writeString($i, $j++, $this->language->get('column_year'), $boxFormatText); // A
		$worksheet->writeString($i, $j++, $this->language->get('column_month'), $boxFormatText); // B
		} elseif ($filter_group == 'day') {
		$worksheet->writeString($i, $j++, $this->language->get('column_date'), $boxFormatText); // A,B
		} elseif ($filter_group == 'order') {
		$worksheet->writeString($i, $j++, $this->language->get('column_order_order_id'), $boxFormatText); // A
		$worksheet->writeString($i, $j++, $this->language->get('column_order_date_added'), $boxFormatText); // B
		} else {
		$worksheet->writeString($i, $j++, $this->language->get('column_date_start'), $boxFormatText); // A
		$worksheet->writeString($i, $j++, $this->language->get('column_date_end'), $boxFormatText); // B
		}
		} elseif ($filter_report == 'day_of_week') {
		$worksheet->writeString($i, $j++, $this->language->get('column_day_of_week'), $boxFormatText); // A,B
		} elseif ($filter_report == 'hour') {
		$worksheet->writeString($i, $j++, $this->language->get('column_hour'), $boxFormatText); // A,B
		} elseif ($filter_report == 'store') {
		$worksheet->writeString($i, $j++, $this->language->get('column_store'), $boxFormatText); // A,B
		} elseif ($filter_report == 'customer_group') {
		$worksheet->writeString($i, $j++, $this->language->get('column_customer_group'), $boxFormatText); // A,B
		} elseif ($filter_report == 'country') {
		$worksheet->writeString($i, $j++, $this->language->get('column_country'), $boxFormatText); // A,B
		} elseif ($filter_report == 'postcode') {
		$worksheet->writeString($i, $j++, $this->language->get('column_postcode'), $boxFormatText); // A,B
		} elseif ($filter_report == 'region_state') {
		$worksheet->writeString($i, $j++, $this->language->get('column_region_state'), $boxFormatText); // A,B
		} elseif ($filter_report == 'city') {
		$worksheet->writeString($i, $j++, $this->language->get('column_city'), $boxFormatText); // A,B
		} elseif ($filter_report == 'payment_method') {
		$worksheet->writeString($i, $j++, $this->language->get('column_payment_method'), $boxFormatText); // A,B
		} elseif ($filter_report == 'shipping_method') {
		$worksheet->writeString($i, $j++, $this->language->get('column_shipping_method'), $boxFormatText); // A,B	
		}		
		isset($_POST['sop20']) ? $worksheet->writeString($i, $j++, $this->language->get('column_orders'), $boxFormatNumber) : ''; // C
		isset($_POST['sop21']) ? $worksheet->writeString($i, $j++, $this->language->get('column_customers'), $boxFormatNumber) : ''; // D
		isset($_POST['sop22']) ? $worksheet->writeString($i, $j++, $this->language->get('column_products'), $boxFormatNumber) : ''; // E
		isset($_POST['sop23']) ? $worksheet->writeString($i, $j++, $this->language->get('column_sub_total'), $boxFormatNumber) : ''; // F
		isset($_POST['sop24']) ? $worksheet->writeString($i, $j++, $this->language->get('column_handling'), $boxFormatNumber) : ''; // G
		isset($_POST['sop25']) ? $worksheet->writeString($i, $j++, $this->language->get('column_loworder'), $boxFormatNumber) : ''; // H
		isset($_POST['sop27']) ? $worksheet->writeString($i, $j++, $this->language->get('column_shipping'), $boxFormatNumber) : ''; // I
		isset($_POST['sop26']) ? $worksheet->writeString($i, $j++, $this->language->get('column_reward'), $boxFormatNumber) : ''; // J
		isset($_POST['sop28']) ? $worksheet->writeString($i, $j++, $this->language->get('column_coupon'), $boxFormatNumber) : ''; // K
		isset($_POST['sop29']) ? $worksheet->writeString($i, $j++, $this->language->get('column_tax'), $boxFormatNumber) : ''; // L		
		isset($_POST['sop30']) ? $worksheet->writeString($i, $j++, $this->language->get('column_credit'), $boxFormatNumber) : ''; // M
		isset($_POST['sop31']) ? $worksheet->writeString($i, $j++, $this->language->get('column_voucher'), $boxFormatNumber) : ''; // N
		isset($_POST['sop33']) ? $worksheet->writeString($i, $j++, $this->language->get('column_total'), $boxFormatNumber) : ''; // O
		isset($_POST['sop37']) ? $worksheet->writeString($i, $j++, $this->language->get('column_sales'), $boxFormatNumber) : ''; // P
		isset($_POST['sop34']) ? $worksheet->writeString($i, $j++, $this->language->get('column_prod_costs'), $boxFormatNumber) : ''; // Q
		isset($_POST['sop32']) ? $worksheet->writeString($i, $j++, $this->language->get('column_commission'), $boxFormatNumber) : ''; // R		
		isset($_POST['sop391']) ? $worksheet->writeString($i, $j++, $this->language->get('column_payment_cost'), $boxFormatNumber) : ''; // S
		isset($_POST['sop392']) ? $worksheet->writeString($i, $j++, $this->language->get('column_shipping_cost'), $boxFormatNumber) : ''; // T
		isset($_POST['sop393']) ? $worksheet->writeString($i, $j++, $this->language->get('column_shipping_balance'), $boxFormatNumber) : ''; // U
		isset($_POST['sop38']) ? $worksheet->writeString($i, $j++, $this->language->get('column_total_costs'), $boxFormatNumber) : ''; // V
		isset($_POST['sop35']) ? $worksheet->writeString($i, $j++, $this->language->get('column_net_profit'), $boxFormatNumber) : ''; // W
		isset($_POST['sop36']) ? $worksheet->writeString($i, $j++, $this->language->get('column_profit_margin'), $boxFormatNumber) : ''; // X
		
		// The actual orders data
		$i += 1;
		$j = 0;
		
			foreach ($results as $result) {
			$total_sales = $result['sub_total']+$result['handling']+$result['low_order_fee']+$result['reward']+$result['coupon']+$result['credit']+$result['voucher']+($data['adv_profit_reports_formula_sop1'] ? $result['shipping'] : 0);
			$total_costs = $result['prod_costs']+$result['commission']+($data['adv_profit_reports_formula_sop3'] ? $result['payment_cost'] : 0)+($data['adv_profit_reports_formula_sop2'] ? $result['shipping_cost'] : 0);
			$total_sales_total = $result['sub_total_total']+$result['handling_total']+$result['low_order_fee_total']+$result['reward_total']+$result['coupon_total']+$result['credit_total']+$result['voucher_total']+($data['adv_profit_reports_formula_sop1'] ? $result['shipping_total'] : 0);
			$total_costs_total = $result['prod_costs_total']+$result['commission_total']+($data['adv_profit_reports_formula_sop3'] ? $result['pay_costs_total'] : 0)+($data['adv_profit_reports_formula_sop2'] ? $result['ship_costs_total'] : 0);
		
			$excelRow = $i+1;
				if ($filter_report == 'sales_summary') {
				if ($filter_group == 'year') {	
				$worksheet->write($i, $j++, $result['year'], $textFormat); // A,B
				} elseif ($filter_group == 'quarter') {
				$worksheet->write($i, $j++, $result['year'], $textFormat); // A
				$worksheet->write($i, $j++, 'Q' . $result['quarter'], $textFormat); // B				
				} elseif ($filter_group == 'month') {
				$worksheet->write($i, $j++, $result['year'], $textFormat); // A
				$worksheet->write($i, $j++, $result['month'], $textFormat); // B
				} elseif ($filter_group == 'day') {
				$worksheet->write($i, $j++, date($this->language->get('date_format_short'), strtotime($result['date_start'])), $textFormat); // A,B
				} elseif ($filter_group == 'order') {
				$worksheet->write($i, $j++, $result['order_id'], $textFormat); // A
				$worksheet->write($i, $j++, date($this->language->get('date_format_short'), strtotime($result['date_start'])), $textFormat); // B
				} else {
				$worksheet->write($i, $j++, date($this->language->get('date_format_short'), strtotime($result['date_start'])), $textFormat); // A
				$worksheet->write($i, $j++, date($this->language->get('date_format_short'), strtotime($result['date_end'])), $textFormat); // B	
				}	
				} elseif ($filter_report == 'day_of_week') {
				$worksheet->write($i, $j++, $result['day_of_week'], $textFormat); // A,B
				} elseif ($filter_report == 'hour') {
				$worksheet->write($i, $j++, number_format($result['hour'], 2, ':', ''), $textFormat); // A,B
				} elseif ($filter_report == 'store') {
				$worksheet->write($i, $j++, html_entity_decode($result['store_name']), $textFormat); // A,B
				} elseif ($filter_report == 'customer_group') {
				$worksheet->write($i, $j++, html_entity_decode($result['customer_group']), $textFormat); // A,B
				} elseif ($filter_report == 'country') {
				$worksheet->write($i, $j++, $result['payment_country'], $textFormat); // A,B
				} elseif ($filter_report == 'postcode') {
				$worksheet->write($i, $j++, $result['payment_postcode'], $textFormat); // A,B
				} elseif ($filter_report == 'region_state') {
				$worksheet->write($i, $j++, $result['payment_zone']. ', ' . $result['payment_country'], $textFormat); // A,B
				} elseif ($filter_report == 'city') {
				$worksheet->write($i, $j++, $result['payment_city']. ', ' . $result['payment_country'], $textFormat); // A,B
				} elseif ($filter_report == 'payment_method') {
				$worksheet->write($i, $j++, preg_replace('~\(.*?\)~', '', $result['payment_method']), $textFormat); // A,B
				} elseif ($filter_report == 'shipping_method') {
				$worksheet->write($i, $j++, preg_replace('~\(.*?\)~', '', $result['shipping_method']), $textFormat); // A,B
				}
				isset($_POST['sop20']) ? $worksheet->write($i, $j++, $result['orders']) : ''; // C
				isset($_POST['sop21']) ? $worksheet->write($i, $j++, $result['customers']) : ''; // D
				isset($_POST['sop22']) ? $worksheet->write($i, $j++, $result['products']) : ''; // E
				isset($_POST['sop23']) ? $worksheet->write($i, $j++, $result['sub_total'], $saleFormat) : ''; // F
				isset($_POST['sop24']) ? $worksheet->write($i, $j++, $result['handling'] != NULL ? $result['handling'] : '0.00', $saleFormat) : ''; // G
				isset($_POST['sop25']) ? $worksheet->write($i, $j++, $result['low_order_fee'] != NULL ? $result['low_order_fee'] : '0.00', $saleFormat) : ''; // H
				if ($this->config->get('adv_profit_reports_formula_sop1')) {
				isset($_POST['sop27']) ? $worksheet->write($i, $j++, $result['shipping'] != NULL ? $result['shipping'] : '0.00', $saleFormat) : ''; // I
				} else {
				isset($_POST['sop27']) ? $worksheet->write($i, $j++, $result['shipping'] != NULL ? $result['shipping'] : '0.00', $priceFormat) : ''; // I
				}
				isset($_POST['sop26']) ? $worksheet->write($i, $j++, $result['reward'] != NULL ? $result['reward'] : '0.00', $saleFormat) : ''; // J
				isset($_POST['sop28']) ? $worksheet->write($i, $j++, $result['coupon'] != NULL ? $result['coupon'] : '0.00', $saleFormat) : ''; // K
				isset($_POST['sop29']) ? $worksheet->write($i, $j++, $result['tax'] != NULL ? $result['tax'] : '0.00', $priceFormat) : ''; // L
				isset($_POST['sop30']) ? $worksheet->write($i, $j++, $result['credit'] != NULL ? $result['credit'] : '0.00', $saleFormat) : ''; // M
				isset($_POST['sop31']) ? $worksheet->write($i, $j++, $result['voucher'] != NULL ? $result['voucher'] : '0.00', $saleFormat) : ''; // N
				isset($_POST['sop33']) ? $worksheet->write($i, $j++, $result['total'], $priceFormat) : ''; // O
				isset($_POST['sop37']) ? $worksheet->write($i, $j++, $total_sales, $salesColumnFormat) : ''; // P
				isset($_POST['sop34']) ? $worksheet->write($i, $j++, '-' . $result['prod_costs'], $costFormat) : ''; // Q
				isset($_POST['sop32']) ? $worksheet->write($i, $j++, -$result['commission'], $costFormat) : ''; // R
				if ($this->config->get('adv_profit_reports_formula_sop3')) {
				isset($_POST['sop391']) ? $worksheet->write($i, $j++, -$result['payment_cost'], $costFormat) : ''; // S
				} else {
				isset($_POST['sop391']) ? $worksheet->write($i, $j++, -$result['payment_cost'], $priceFormat) : ''; // S
				}
				if ($this->config->get('adv_profit_reports_formula_sop2')) {
				isset($_POST['sop392']) ? $worksheet->write($i, $j++, -$result['shipping_cost'], $costFormat) : ''; // T
				} else {
				isset($_POST['sop392']) ? $worksheet->write($i, $j++, -$result['shipping_cost'], $priceFormat) : ''; // T
				}				
				isset($_POST['sop393']) ? $worksheet->write($i, $j++, $result['shipping']-$result['shipping_cost'], $priceFormat) : ''; // U
				isset($_POST['sop38']) ? $worksheet->write($i, $j++, '-' . $total_costs, $costsColumnFormat) : ''; // V
				if (($total_sales-$total_costs) >= 0) {
				isset($_POST['sop35']) ? $worksheet->write($i, $j++, $total_sales-$total_costs, $profitColumnFormat) : ''; // W
				} else {
				isset($_POST['sop35']) ? $worksheet->write($i, $j++, $total_sales-$total_costs, $noprofitColumnFormat) : ''; // W
				}
				if ($total_costs > 0) {
				if (($total_sales-$total_costs) >= 0) {
				isset($_POST['sop36']) ? $worksheet->write($i, $j++, round(100 * (($total_sales-$total_costs) / $total_sales), 2) / 100, $percentColumnFormat) : ''; // X
				} else {
				isset($_POST['sop36']) ? $worksheet->write($i, $j++, round(100 * (($total_sales-$total_costs) / $total_sales), 2) / 100, $nopercentColumnFormat) : ''; // X
				}					
				} else {
				isset($_POST['sop36']) ? $worksheet->write($i, $j++, '1', $percentColumnFormat) : ''; // X
				}

				$i += 1;
				$j = 0;
			}
		
		$worksheet->freezePanes(array(1, 0, 1, 0));
		
		// Let's send the file		
		$workbook->close();
		
		// Clear the spreadsheet caches
		$this->clearSpreadsheetCache();
		exit;
?>