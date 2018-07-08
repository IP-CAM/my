<?php
ini_set("memory_limit","256M");

	$this->objPHPExcel = new PHPExcel();
	$this->objPHPExcel->getActiveSheet()->setTitle('Sales Orders Report + Profit');
	$this->mainCounter = 1;
	if ($this->mainCounter == 1) {
		 $this->objPHPExcel->getProperties()->setCreator("ADV Reports & Statistics")
										 	->setLastModifiedBy("ADV Reports & Statistics")
										 	->setTitle("ADV Sales Orders Report + Profit")
										 	->setSubject("ADV Sales Orders Report + Profit")
										 	->setDescription("Export of ADV Sales Orders Report + Profit without details.")
										 	->setKeywords("office 2007 excel")
										 	->setCategory("www.opencartreports.com");
											   
		 $this->objPHPExcel->setActiveSheetIndex(0);

		 if ($filter_report == 'sales_summary') {
		 if ($filter_group == 'year') {
		 $this->objPHPExcel->getActiveSheet()->mergeCells('A' . $this->mainCounter.":".'B' . $this->mainCounter);
		 $this->objPHPExcel->getActiveSheet()->getStyle('A' . $this->mainCounter)->getFont()->setBold(true);
		 $this->objPHPExcel->getActiveSheet()->getStyle('A' . $this->mainCounter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);		 
		 $this->objPHPExcel->getActiveSheet()->setCellValue('A' . $this->mainCounter, $this->language->get('column_year'));
		 $this->objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);		 
		 } elseif ($filter_group == 'quarter') {
		 $this->objPHPExcel->getActiveSheet()->setCellValue('A' . $this->mainCounter, $this->language->get('column_year'));
		 $this->objPHPExcel->getActiveSheet()->getStyle('A' . $this->mainCounter)->getFont()->setBold(true);
		 $this->objPHPExcel->getActiveSheet()->getStyle('A' . $this->mainCounter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);		 
		 $this->objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);		 
		 $this->objPHPExcel->getActiveSheet()->setCellValue('B' . $this->mainCounter, $this->language->get('column_quarter'));
		 $this->objPHPExcel->getActiveSheet()->getStyle('B' . $this->mainCounter)->getFont()->setBold(true);		 
		 $this->objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);		 
		 } elseif ($filter_group == 'month') {
		 $this->objPHPExcel->getActiveSheet()->setCellValue('A' . $this->mainCounter, $this->language->get('column_year'));
		 $this->objPHPExcel->getActiveSheet()->getStyle('A' . $this->mainCounter)->getFont()->setBold(true);
		 $this->objPHPExcel->getActiveSheet()->getStyle('A' . $this->mainCounter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);		 
		 $this->objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);		 
		 $this->objPHPExcel->getActiveSheet()->setCellValue('B' . $this->mainCounter, $this->language->get('column_month'));
		 $this->objPHPExcel->getActiveSheet()->getStyle('B' . $this->mainCounter)->getFont()->setBold(true);		 
		 $this->objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);		 
		 } elseif ($filter_group == 'day') {
		 $this->objPHPExcel->getActiveSheet()->mergeCells('A' . $this->mainCounter.":".'B' . $this->mainCounter);
		 $this->objPHPExcel->getActiveSheet()->getStyle('A' . $this->mainCounter)->getFont()->setBold(true);		 
		 $this->objPHPExcel->getActiveSheet()->setCellValue('A' . $this->mainCounter, $this->language->get('column_date'));
		 $this->objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);		 
		 } elseif ($filter_group == 'order') {
		 $this->objPHPExcel->getActiveSheet()->setCellValue('A' . $this->mainCounter, $this->language->get('column_order_order_id'));
		 $this->objPHPExcel->getActiveSheet()->getStyle('A' . $this->mainCounter)->getFont()->setBold(true);
		 $this->objPHPExcel->getActiveSheet()->getStyle('A' . $this->mainCounter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);		 
		 $this->objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);		 
		 $this->objPHPExcel->getActiveSheet()->setCellValue('B' . $this->mainCounter, $this->language->get('column_order_date_added'));
		 $this->objPHPExcel->getActiveSheet()->getStyle('B' . $this->mainCounter)->getFont()->setBold(true);		 
		 $this->objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);		 
		 } else {
		 $this->objPHPExcel->getActiveSheet()->setCellValue('A' . $this->mainCounter, $this->language->get('column_date_start'));
		 $this->objPHPExcel->getActiveSheet()->getStyle('A' . $this->mainCounter)->getFont()->setBold(true);		 
		 $this->objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);		 
		 $this->objPHPExcel->getActiveSheet()->setCellValue('B' . $this->mainCounter, $this->language->get('column_date_end'));	
		 $this->objPHPExcel->getActiveSheet()->getStyle('B' . $this->mainCounter)->getFont()->setBold(true);		 
		 $this->objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);		 
		 }
		 } elseif ($filter_report == 'day_of_week') {
		 $this->objPHPExcel->getActiveSheet()->mergeCells('A' . $this->mainCounter.":".'B' . $this->mainCounter);
		 $this->objPHPExcel->getActiveSheet()->getStyle('A' . $this->mainCounter)->getFont()->setBold(true);		 
		 $this->objPHPExcel->getActiveSheet()->setCellValue('A' . $this->mainCounter, $this->language->get('column_day_of_week'));
		 $this->objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		 } elseif ($filter_report == 'hour') {
		 $this->objPHPExcel->getActiveSheet()->mergeCells('A' . $this->mainCounter.":".'B' . $this->mainCounter);
		 $this->objPHPExcel->getActiveSheet()->getStyle('A' . $this->mainCounter)->getFont()->setBold(true);		 
		 $this->objPHPExcel->getActiveSheet()->setCellValue('A' . $this->mainCounter, $this->language->get('column_hour'));
		 $this->objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		 } elseif ($filter_report == 'store') {
		 $this->objPHPExcel->getActiveSheet()->mergeCells('A' . $this->mainCounter.":".'B' . $this->mainCounter);
		 $this->objPHPExcel->getActiveSheet()->getStyle('A' . $this->mainCounter)->getFont()->setBold(true);		 
		 $this->objPHPExcel->getActiveSheet()->setCellValue('A' . $this->mainCounter, $this->language->get('column_store'));
		 $this->objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		 } elseif ($filter_report == 'customer_group') {
		 $this->objPHPExcel->getActiveSheet()->mergeCells('A' . $this->mainCounter.":".'B' . $this->mainCounter);
		 $this->objPHPExcel->getActiveSheet()->getStyle('A' . $this->mainCounter)->getFont()->setBold(true);		 
		 $this->objPHPExcel->getActiveSheet()->setCellValue('A' . $this->mainCounter, $this->language->get('column_customer_group'));
		 $this->objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		 } elseif ($filter_report == 'country') {
		 $this->objPHPExcel->getActiveSheet()->mergeCells('A' . $this->mainCounter.":".'B' . $this->mainCounter);
		 $this->objPHPExcel->getActiveSheet()->getStyle('A' . $this->mainCounter)->getFont()->setBold(true);		 
		 $this->objPHPExcel->getActiveSheet()->setCellValue('A' . $this->mainCounter, $this->language->get('column_country'));
		 $this->objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		 } elseif ($filter_report == 'postcode') {
		 $this->objPHPExcel->getActiveSheet()->mergeCells('A' . $this->mainCounter.":".'B' . $this->mainCounter);
		 $this->objPHPExcel->getActiveSheet()->getStyle('A' . $this->mainCounter)->getFont()->setBold(true);		 
		 $this->objPHPExcel->getActiveSheet()->setCellValue('A' . $this->mainCounter, $this->language->get('column_postcode'));
		 $this->objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		 } elseif ($filter_report == 'region_state') {
		 $this->objPHPExcel->getActiveSheet()->mergeCells('A' . $this->mainCounter.":".'B' . $this->mainCounter);
		 $this->objPHPExcel->getActiveSheet()->getStyle('A' . $this->mainCounter)->getFont()->setBold(true);		 
		 $this->objPHPExcel->getActiveSheet()->setCellValue('A' . $this->mainCounter, $this->language->get('column_region_state'));
		 $this->objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		 } elseif ($filter_report == 'city') {
		 $this->objPHPExcel->getActiveSheet()->mergeCells('A' . $this->mainCounter.":".'B' . $this->mainCounter);
		 $this->objPHPExcel->getActiveSheet()->getStyle('A' . $this->mainCounter)->getFont()->setBold(true);		 
		 $this->objPHPExcel->getActiveSheet()->setCellValue('A' . $this->mainCounter, $this->language->get('column_city'));
		 $this->objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		 } elseif ($filter_report == 'payment_method') {
		 $this->objPHPExcel->getActiveSheet()->mergeCells('A' . $this->mainCounter.":".'B' . $this->mainCounter);
		 $this->objPHPExcel->getActiveSheet()->getStyle('A' . $this->mainCounter)->getFont()->setBold(true);		 
		 $this->objPHPExcel->getActiveSheet()->setCellValue('A' . $this->mainCounter, $this->language->get('column_payment_method'));
		 $this->objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		 } elseif ($filter_report == 'shipping_method') {
		 $this->objPHPExcel->getActiveSheet()->mergeCells('A' . $this->mainCounter.":".'B' . $this->mainCounter);
		 $this->objPHPExcel->getActiveSheet()->getStyle('A' . $this->mainCounter)->getFont()->setBold(true);		 
		 $this->objPHPExcel->getActiveSheet()->setCellValue('A' . $this->mainCounter, $this->language->get('column_shipping_method'));
		 $this->objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		 }	
		
		 $this->objPHPExcel->getActiveSheet()->setCellValue('C' . $this->mainCounter, $this->language->get('column_orders'));
		 $this->objPHPExcel->getActiveSheet()->getStyle('C' . $this->mainCounter)->getFont()->setBold(true);
		 $this->objPHPExcel->getActiveSheet()->getStyle('C' . $this->mainCounter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);		 
		 $this->objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);	
		  
		 $this->objPHPExcel->getActiveSheet()->setCellValue('D' . $this->mainCounter, $this->language->get('column_customers'));
		 $this->objPHPExcel->getActiveSheet()->getStyle('D' . $this->mainCounter)->getFont()->setBold(true);
		 $this->objPHPExcel->getActiveSheet()->getStyle('D' . $this->mainCounter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);		 
		 $this->objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);	
		 
		 $this->objPHPExcel->getActiveSheet()->setCellValue('E' . $this->mainCounter, $this->language->get('column_products'));
		 $this->objPHPExcel->getActiveSheet()->getStyle('E' . $this->mainCounter)->getFont()->setBold(true);
		 $this->objPHPExcel->getActiveSheet()->getStyle('E' . $this->mainCounter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);		 
		 $this->objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
		 
		 $this->objPHPExcel->getActiveSheet()->setCellValue('F' . $this->mainCounter, $this->language->get('column_sub_total'));
		 $this->objPHPExcel->getActiveSheet()->getStyle('F' . $this->mainCounter)->getFont()->setBold(true);
		 $this->objPHPExcel->getActiveSheet()->getStyle('F' . $this->mainCounter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);		 
		 $this->objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
		 
		 $this->objPHPExcel->getActiveSheet()->setCellValue('G' . $this->mainCounter, $this->language->get('column_handling'));
		 $this->objPHPExcel->getActiveSheet()->getStyle('G' . $this->mainCounter)->getFont()->setBold(true);
		 $this->objPHPExcel->getActiveSheet()->getStyle('G' . $this->mainCounter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);		 
		 $this->objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
		 
		 $this->objPHPExcel->getActiveSheet()->setCellValue('H' . $this->mainCounter, $this->language->get('column_loworder'));
		 $this->objPHPExcel->getActiveSheet()->getStyle('H' . $this->mainCounter)->getFont()->setBold(true);
		 $this->objPHPExcel->getActiveSheet()->getStyle('H' . $this->mainCounter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);		 
		 $this->objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
		 
		 $this->objPHPExcel->getActiveSheet()->setCellValue('I' . $this->mainCounter, $this->language->get('column_shipping'));
		 $this->objPHPExcel->getActiveSheet()->getStyle('I' . $this->mainCounter)->getFont()->setBold(true);
		 $this->objPHPExcel->getActiveSheet()->getStyle('I' . $this->mainCounter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);		 
		 $this->objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
		 
		 $this->objPHPExcel->getActiveSheet()->setCellValue('J' . $this->mainCounter, $this->language->get('column_reward'));
		 $this->objPHPExcel->getActiveSheet()->getStyle('J' . $this->mainCounter)->getFont()->setBold(true);
		 $this->objPHPExcel->getActiveSheet()->getStyle('J' . $this->mainCounter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);		 
		 $this->objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
		 
		 $this->objPHPExcel->getActiveSheet()->setCellValue('K' . $this->mainCounter, $this->language->get('column_coupon'));
		 $this->objPHPExcel->getActiveSheet()->getStyle('K' . $this->mainCounter)->getFont()->setBold(true);
		 $this->objPHPExcel->getActiveSheet()->getStyle('K' . $this->mainCounter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);		 
		 $this->objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
		 
		 $this->objPHPExcel->getActiveSheet()->setCellValue('L' . $this->mainCounter, $this->language->get('column_tax'));
		 $this->objPHPExcel->getActiveSheet()->getStyle('L' . $this->mainCounter)->getFont()->setBold(true);
		 $this->objPHPExcel->getActiveSheet()->getStyle('L' . $this->mainCounter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);		 
		 $this->objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
		 
		 $this->objPHPExcel->getActiveSheet()->setCellValue('M' . $this->mainCounter, $this->language->get('column_credit'));
		 $this->objPHPExcel->getActiveSheet()->getStyle('M' . $this->mainCounter)->getFont()->setBold(true);
		 $this->objPHPExcel->getActiveSheet()->getStyle('M' . $this->mainCounter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);		 
		 $this->objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
		 
		 $this->objPHPExcel->getActiveSheet()->setCellValue('N' . $this->mainCounter, $this->language->get('column_voucher'));
		 $this->objPHPExcel->getActiveSheet()->getStyle('N' . $this->mainCounter)->getFont()->setBold(true);
		 $this->objPHPExcel->getActiveSheet()->getStyle('N' . $this->mainCounter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);		 
		 $this->objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
		 
		 $this->objPHPExcel->getActiveSheet()->setCellValue('O' . $this->mainCounter, $this->language->get('column_total'));
		 $this->objPHPExcel->getActiveSheet()->getStyle('O' . $this->mainCounter)->getFont()->setBold(true);
		 $this->objPHPExcel->getActiveSheet()->getStyle('O' . $this->mainCounter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);		 
		 $this->objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
		 
		 $this->objPHPExcel->getActiveSheet()->setCellValue('P' . $this->mainCounter, $this->language->get('column_sales'));
		 $this->objPHPExcel->getActiveSheet()->getStyle('P' . $this->mainCounter)->getFont()->setBold(true);
		 $this->objPHPExcel->getActiveSheet()->getStyle('P' . $this->mainCounter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);		 
		 $this->objPHPExcel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
		 
		 $this->objPHPExcel->getActiveSheet()->setCellValue('Q' . $this->mainCounter, $this->language->get('column_prod_costs'));
		 $this->objPHPExcel->getActiveSheet()->getStyle('Q' . $this->mainCounter)->getFont()->setBold(true);
		 $this->objPHPExcel->getActiveSheet()->getStyle('Q' . $this->mainCounter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);		 
		 $this->objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
		 
		 $this->objPHPExcel->getActiveSheet()->setCellValue('R' . $this->mainCounter, $this->language->get('column_commission'));
		 $this->objPHPExcel->getActiveSheet()->getStyle('R' . $this->mainCounter)->getFont()->setBold(true);
		 $this->objPHPExcel->getActiveSheet()->getStyle('R' . $this->mainCounter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);		 
		 $this->objPHPExcel->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
		 
		 $this->objPHPExcel->getActiveSheet()->setCellValue('S' . $this->mainCounter, $this->language->get('column_payment_cost'));
		 $this->objPHPExcel->getActiveSheet()->getStyle('S' . $this->mainCounter)->getFont()->setBold(true);
		 $this->objPHPExcel->getActiveSheet()->getStyle('S' . $this->mainCounter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);		 
		 $this->objPHPExcel->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
		 
		 $this->objPHPExcel->getActiveSheet()->setCellValue('T' . $this->mainCounter, $this->language->get('column_shipping_cost'));
		 $this->objPHPExcel->getActiveSheet()->getStyle('T' . $this->mainCounter)->getFont()->setBold(true);
		 $this->objPHPExcel->getActiveSheet()->getStyle('T' . $this->mainCounter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);		 
		 $this->objPHPExcel->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
		 
		 $this->objPHPExcel->getActiveSheet()->setCellValue('U' . $this->mainCounter, $this->language->get('column_shipping_balance'));
		 $this->objPHPExcel->getActiveSheet()->getStyle('U' . $this->mainCounter)->getFont()->setBold(true);
		 $this->objPHPExcel->getActiveSheet()->getStyle('U' . $this->mainCounter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);		 
		 $this->objPHPExcel->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
		 
		 $this->objPHPExcel->getActiveSheet()->setCellValue('V' . $this->mainCounter, $this->language->get('column_total_costs'));
		 $this->objPHPExcel->getActiveSheet()->getStyle('V' . $this->mainCounter)->getFont()->setBold(true);
		 $this->objPHPExcel->getActiveSheet()->getStyle('V' . $this->mainCounter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);		 
		 $this->objPHPExcel->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);
		 
		 $this->objPHPExcel->getActiveSheet()->setCellValue('W' . $this->mainCounter, $this->language->get('column_net_profit'));
		 $this->objPHPExcel->getActiveSheet()->getStyle('W' . $this->mainCounter)->getFont()->setBold(true);
		 $this->objPHPExcel->getActiveSheet()->getStyle('W' . $this->mainCounter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);		 
		 $this->objPHPExcel->getActiveSheet()->getColumnDimension('W')->setAutoSize(true);
		 
		 $this->objPHPExcel->getActiveSheet()->setCellValue('X' . $this->mainCounter, $this->language->get('column_profit_margin'));
		 $this->objPHPExcel->getActiveSheet()->getStyle('X' . $this->mainCounter)->getFont()->setBold(true);
		 $this->objPHPExcel->getActiveSheet()->getStyle('X' . $this->mainCounter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);		 
		 $this->objPHPExcel->getActiveSheet()->getColumnDimension('X')->setAutoSize(true);

		$this->objPHPExcel->getActiveSheet()->freezePane('A2');		 
	}
	
	$counter  = $this->mainCounter+1;
		
	foreach ($results as $result) {
		$total_sales = $result['sub_total']+$result['handling']+$result['low_order_fee']+$result['reward']+$result['coupon']+$result['credit']+$result['voucher']+($data['adv_profit_reports_formula_sop1'] ? $result['shipping'] : 0);
		$total_costs = $result['prod_costs']+$result['commission']+($data['adv_profit_reports_formula_sop3'] ? $result['payment_cost'] : 0)+($data['adv_profit_reports_formula_sop2'] ? $result['shipping_cost'] : 0);
		$total_sales_total = $result['sub_total_total']+$result['handling_total']+$result['low_order_fee_total']+$result['reward_total']+$result['coupon_total']+$result['credit_total']+$result['voucher_total']+($data['adv_profit_reports_formula_sop1'] ? $result['shipping_total'] : 0);
		$total_costs_total = $result['prod_costs_total']+$result['commission_total']+($data['adv_profit_reports_formula_sop3'] ? $result['pay_costs_total'] : 0)+($data['adv_profit_reports_formula_sop2'] ? $result['ship_costs_total'] : 0);	

		if ($filter_report == 'sales_summary') {
		if ($filter_group == 'year') {
		$this->objPHPExcel->getActiveSheet()->mergeCells('A' . $counter.":".'B' . $counter);
		$this->objPHPExcel->getActiveSheet()->setCellValue('A' . $counter, $result['year']);
		} elseif ($filter_group == 'quarter') {
		$this->objPHPExcel->getActiveSheet()->setCellValue('A' . $counter, $result['year']);
		$this->objPHPExcel->getActiveSheet()->setCellValue('B' . $counter, 'Q' . $result['quarter']);			
		} elseif ($filter_group == 'month') {
		$this->objPHPExcel->getActiveSheet()->setCellValue('A' . $counter, $result['year']);
		$this->objPHPExcel->getActiveSheet()->setCellValue('B' . $counter, $result['month']);
		} elseif ($filter_group == 'day') {
		$this->objPHPExcel->getActiveSheet()->mergeCells('A' . $counter.":".'B' . $counter);
		$this->objPHPExcel->getActiveSheet()->setCellValue('A' . $counter, date($this->language->get('date_format_short'), strtotime($result['date_start'])));
		} elseif ($filter_group == 'order') {
		$this->objPHPExcel->getActiveSheet()->setCellValue('A' . $counter, $result['order_id']);
		$this->objPHPExcel->getActiveSheet()->setCellValue('B' . $counter, date($this->language->get('date_format_short'), strtotime($result['date_start'])));
		} else {
		$this->objPHPExcel->getActiveSheet()->setCellValue('A' . $counter, date($this->language->get('date_format_short'), strtotime($result['date_start'])));
		$this->objPHPExcel->getActiveSheet()->setCellValue('B' . $counter, date($this->language->get('date_format_short'), strtotime($result['date_end'])));			 
		}
		} elseif ($filter_report == 'day_of_week') {
		$this->objPHPExcel->getActiveSheet()->mergeCells('A' . $counter.":".'B' . $counter);
		$this->objPHPExcel->getActiveSheet()->setCellValue('A' . $counter, $result['day_of_week']);
		} elseif ($filter_report == 'hour') {
		$this->objPHPExcel->getActiveSheet()->mergeCells('A' . $counter.":".'B' . $counter);
		$this->objPHPExcel->getActiveSheet()->setCellValue('A' . $counter, number_format($result['hour'], 2, ':', ''));
		} elseif ($filter_report == 'store') {
		$this->objPHPExcel->getActiveSheet()->mergeCells('A' . $counter.":".'B' . $counter);
		$this->objPHPExcel->getActiveSheet()->setCellValue('A' . $counter, html_entity_decode($result['store_name']));
		} elseif ($filter_report == 'customer_group') {
		$this->objPHPExcel->getActiveSheet()->mergeCells('A' . $counter.":".'B' . $counter);
		$this->objPHPExcel->getActiveSheet()->setCellValue('A' . $counter, html_entity_decode($result['customer_group']));
		} elseif ($filter_report == 'country') {
		$this->objPHPExcel->getActiveSheet()->mergeCells('A' . $counter.":".'B' . $counter);
		$this->objPHPExcel->getActiveSheet()->setCellValue('A' . $counter, $result['payment_country']);
		} elseif ($filter_report == 'postcode') {
		$this->objPHPExcel->getActiveSheet()->mergeCells('A' . $counter.":".'B' . $counter);
		$this->objPHPExcel->getActiveSheet()->getStyle('A' . $counter)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
		$this->objPHPExcel->getActiveSheet()->setCellValue('A' . $counter, $result['payment_postcode']);
		} elseif ($filter_report == 'region_state') {
		$this->objPHPExcel->getActiveSheet()->mergeCells('A' . $counter.":".'B' . $counter);
		$this->objPHPExcel->getActiveSheet()->setCellValue('A' . $counter, $result['payment_zone']. ', ' . $result['payment_country']);
		} elseif ($filter_report == 'city') {
		$this->objPHPExcel->getActiveSheet()->mergeCells('A' . $counter.":".'B' . $counter);
		$this->objPHPExcel->getActiveSheet()->setCellValue('A' . $counter, $result['payment_city']. ', ' . $result['payment_country']);
		} elseif ($filter_report == 'payment_method') {
		$this->objPHPExcel->getActiveSheet()->mergeCells('A' . $counter.":".'B' . $counter);
		$this->objPHPExcel->getActiveSheet()->setCellValue('A' . $counter, preg_replace('~\(.*?\)~', '', $result['payment_method']));
		} elseif ($filter_report == 'shipping_method') {
		$this->objPHPExcel->getActiveSheet()->mergeCells('A' . $counter.":".'B' . $counter);
		$this->objPHPExcel->getActiveSheet()->setCellValue('A' . $counter, preg_replace('~\(.*?\)~', '', $result['shipping_method']));
		}
				
		$this->objPHPExcel->getActiveSheet()->setCellValue('C' . $counter, $result['orders']);
		 
		$this->objPHPExcel->getActiveSheet()->setCellValue('D' . $counter, $result['customers']);
		
		$this->objPHPExcel->getActiveSheet()->setCellValue('E' . $counter, $result['products']);
		
		$this->objPHPExcel->getActiveSheet()->getStyle('F' . $counter)->getNumberFormat()->setFormatCode('0.00');
		$this->objPHPExcel->getActiveSheet()->setCellValue('F' . $counter, $result['sub_total']);
		
		$this->objPHPExcel->getActiveSheet()->getStyle('G' . $counter)->getNumberFormat()->setFormatCode('0.00');
		$this->objPHPExcel->getActiveSheet()->setCellValue('G' . $counter, $result['handling']);
		
		$this->objPHPExcel->getActiveSheet()->getStyle('H' . $counter)->getNumberFormat()->setFormatCode('0.00');
		$this->objPHPExcel->getActiveSheet()->setCellValue('H' . $counter, $result['low_order_fee']);
		
		$this->objPHPExcel->getActiveSheet()->getStyle('I' . $counter)->getNumberFormat()->setFormatCode('0.00');
		$this->objPHPExcel->getActiveSheet()->setCellValue('I' . $counter, $result['shipping']);
		
		$this->objPHPExcel->getActiveSheet()->getStyle('J' . $counter)->getNumberFormat()->setFormatCode('0.00');
		$this->objPHPExcel->getActiveSheet()->setCellValue('J' . $counter, $result['reward']);
		
		$this->objPHPExcel->getActiveSheet()->getStyle('K' . $counter)->getNumberFormat()->setFormatCode('0.00');
		$this->objPHPExcel->getActiveSheet()->setCellValue('K' . $counter, $result['coupon']);
		
		$this->objPHPExcel->getActiveSheet()->getStyle('L' . $counter)->getNumberFormat()->setFormatCode('0.00');
		$this->objPHPExcel->getActiveSheet()->setCellValue('L' . $counter, $result['tax']);
		
		$this->objPHPExcel->getActiveSheet()->getStyle('M' . $counter)->getNumberFormat()->setFormatCode('0.00');
		$this->objPHPExcel->getActiveSheet()->setCellValue('M' . $counter, $result['credit']);
		
		$this->objPHPExcel->getActiveSheet()->getStyle('N' . $counter)->getNumberFormat()->setFormatCode('0.00');
		$this->objPHPExcel->getActiveSheet()->setCellValue('N' . $counter, $result['voucher']);
		
		$this->objPHPExcel->getActiveSheet()->getStyle('O' . $counter)->getNumberFormat()->setFormatCode('0.00');
		$this->objPHPExcel->getActiveSheet()->setCellValue('O' . $counter, $result['total']);
		
		$this->objPHPExcel->getActiveSheet()->getStyle('P' . $counter)->getNumberFormat()->setFormatCode('0.00');
		$this->objPHPExcel->getActiveSheet()->setCellValue('P' . $counter, $total_sales);
		
		$this->objPHPExcel->getActiveSheet()->getStyle('Q' . $counter)->getNumberFormat()->setFormatCode('0.00');
		$this->objPHPExcel->getActiveSheet()->setCellValue('Q' . $counter, '-' . $result['prod_costs']);
		
		$this->objPHPExcel->getActiveSheet()->getStyle('R' . $counter)->getNumberFormat()->setFormatCode('0.00');
		$this->objPHPExcel->getActiveSheet()->setCellValue('R' . $counter, -$result['commission']);
		
		$this->objPHPExcel->getActiveSheet()->getStyle('S' . $counter)->getNumberFormat()->setFormatCode('0.00');
		$this->objPHPExcel->getActiveSheet()->setCellValue('S' . $counter, -$result['payment_cost']);
		
		$this->objPHPExcel->getActiveSheet()->getStyle('T' . $counter)->getNumberFormat()->setFormatCode('0.00');
		$this->objPHPExcel->getActiveSheet()->setCellValue('T' . $counter, -$result['shipping_cost']);
		
		$this->objPHPExcel->getActiveSheet()->getStyle('U' . $counter)->getNumberFormat()->setFormatCode('0.00');
		$this->objPHPExcel->getActiveSheet()->setCellValue('U' . $counter, $result['shipping']-$result['shipping_cost']);
		
		$this->objPHPExcel->getActiveSheet()->getStyle('V' . $counter)->getNumberFormat()->setFormatCode('0.00');
		$this->objPHPExcel->getActiveSheet()->setCellValue('V' . $counter, '-' . $total_costs);
		
		$this->objPHPExcel->getActiveSheet()->getStyle('W' . $counter)->getNumberFormat()->setFormatCode('0.00');
		$this->objPHPExcel->getActiveSheet()->setCellValue('W' . $counter, $total_sales-$total_costs);
		
		if ($total_costs > 0) {
		$this->objPHPExcel->getActiveSheet()->getStyle('X' . $counter)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00));		
		$this->objPHPExcel->getActiveSheet()->setCellValue('X' . $counter, round(100 * (($total_sales-$total_costs) / $total_sales), 2)/100);
		} else {
		$this->objPHPExcel->getActiveSheet()->getStyle('X' . $counter)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00));			
		$this->objPHPExcel->getActiveSheet()->setCellValue('X' . $counter, '1');
		}
		
		$counter++;
		$this->mainCounter++;
	}
		
	if (!isset($_POST['sop36'])) {
		$this->objPHPExcel->getActiveSheet()->removeColumn('X');
	}

	if (!isset($_POST['sop35'])) {
		$this->objPHPExcel->getActiveSheet()->removeColumn('W');	
	}
	
	if (!isset($_POST['sop38'])) {
		$this->objPHPExcel->getActiveSheet()->removeColumn('V');	
	}
	
	if (!isset($_POST['sop393'])) {
		$this->objPHPExcel->getActiveSheet()->removeColumn('U');	
	}	
	
	if (!isset($_POST['sop392'])) {
		$this->objPHPExcel->getActiveSheet()->removeColumn('T');	
	}
	
	if (!isset($_POST['sop391'])) {
		$this->objPHPExcel->getActiveSheet()->removeColumn('S');	
	}
	
	if (!isset($_POST['sop32'])) {
		$this->objPHPExcel->getActiveSheet()->removeColumn('R');	
	}
	
	if (!isset($_POST['sop34'])) {
		$this->objPHPExcel->getActiveSheet()->removeColumn('Q');	
	}
	
	if (!isset($_POST['sop37'])) {
		$this->objPHPExcel->getActiveSheet()->removeColumn('P');	
	}
	
	if (!isset($_POST['sop33'])) {
		$this->objPHPExcel->getActiveSheet()->removeColumn('O');	
	}
	
	if (!isset($_POST['sop31'])) {
		$this->objPHPExcel->getActiveSheet()->removeColumn('N');	
	}
	
	if (!isset($_POST['sop30'])) {
		$this->objPHPExcel->getActiveSheet()->removeColumn('M');	
	}
	
	if (!isset($_POST['sop29'])) {
		$this->objPHPExcel->getActiveSheet()->removeColumn('L');	
	}
	
	if (!isset($_POST['sop28'])) {
		$this->objPHPExcel->getActiveSheet()->removeColumn('K');	
	}
	
	if (!isset($_POST['sop26'])) {
		$this->objPHPExcel->getActiveSheet()->removeColumn('J');	
	}
	
	if (!isset($_POST['sop27'])) {
		$this->objPHPExcel->getActiveSheet()->removeColumn('I');	
	}
	
	if (!isset($_POST['sop25'])) {
		$this->objPHPExcel->getActiveSheet()->removeColumn('H');	
	}
	
	if (!isset($_POST['sop24'])) {
		$this->objPHPExcel->getActiveSheet()->removeColumn('G');	
	}
	
	if (!isset($_POST['sop23'])) {
		$this->objPHPExcel->getActiveSheet()->removeColumn('F');	
	}
	
	if (!isset($_POST['sop22'])) {
		$this->objPHPExcel->getActiveSheet()->removeColumn('E');	
	}
	
	if (!isset($_POST['sop21'])) {
		$this->objPHPExcel->getActiveSheet()->removeColumn('D');	
	}
	
	if (!isset($_POST['sop20'])) {
		$this->objPHPExcel->getActiveSheet()->removeColumn('C');	
	}

	if (!isset($_POST['sop36'])) {
		$lastCellA = $this->objPHPExcel->getActiveSheet()->getHighestDataColumn();	
		$lastCellB = $this->objPHPExcel->getActiveSheet()->getHighestDataRow();
		$this->objPHPExcel->getActiveSheet()->getCellCacheController()->deleteCacheData($lastCellA . $lastCellB);
	}
	
$filename = "sale_profit_report_".date("Y-m-d",time());
header('Expires: 0');
header('Cache-control: private');
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=UTF-8; encoding=UTF-8');
header('Content-Disposition: attachment;filename='.$filename.".xlsx");
header('Content-Transfer-Encoding: UTF-8');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit();
?>