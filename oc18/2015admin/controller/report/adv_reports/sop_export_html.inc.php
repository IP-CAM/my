<?php
ini_set("memory_limit","256M");
	
	$export_html ="<html><head>";
	$export_html .="<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
	$export_html .="</head>";
	$export_html .="<body>";
	$export_html .="<style type='text/css'>
	.list_main {
		border-collapse: collapse;
		width: 100%;
		border-top: 1px solid #DDDDDD;
		border-left: 1px solid #DDDDDD;	
		font-family: Arial, Helvetica, sans-serif;
		font-size: 12px;
	}
	.list_main td {
		border-right: 1px solid #DDDDDD;
		border-bottom: 1px solid #DDDDDD;	
	}
	.list_main thead td {
		background-color: #E5E5E5;
		padding: 3px;
		font-weight: bold;
	}
	.list_main tbody a {
		text-decoration: none;
	}
	.list_main tbody td {
		vertical-align: middle;
		padding: 3px;
	}

	.sales {
		background-color: #DCFFB9;	
	}	
	.cost {
		background-color: #ffd7d7;	
	}	
	.plusprofit {
		background-color: #c4d9ee;
		font-weight: bold;
	}
	.minusprofit {
		background-color: #F99;
		font-weight: bold;	
	}
	.total {
		background-color: #E7EFEF;
		color: #003A88;
		font-weight: bold;
	}	
	.total_sales {
		background-color: #DCFFB9;
		color: #003A88;
		font-weight: bold;
	}	
	.total_cost {
		background-color: #ffd7d7;
		color: #003A88;
		font-weight: bold;
	}	
	.total_plusprofit {
		background-color: #c4d9ee;
		color: #003A88;	
		font-weight: bold;
	}
	.total_minusprofit {
		background-color: #F99;
		color: #003A88;	
		font-weight: bold;	
	}	
	</style>";
	$export_html .="<table class='list_main'>";
	$export_html .="<thead>";
	$export_html .="<tr>";
	if ($filter_report == 'sales_summary') {
	if ($filter_group == 'year') {				
	$export_html .= "<td colspan='2' align='left' nowrap='nowrap'>".$this->language->get('column_year')."</td>";
	} elseif ($filter_group == 'quarter') {
	$export_html .= "<td align='left' nowrap='nowrap'>".$this->language->get('column_year')."</td>";
	$export_html .= "<td align='left' nowrap='nowrap'>".$this->language->get('column_quarter')."</td>";				
	} elseif ($filter_group == 'month') {
	$export_html .= "<td align='left' nowrap='nowrap'>".$this->language->get('column_year')."</td>";
	$export_html .= "<td align='left' nowrap='nowrap'>".$this->language->get('column_month')."</td>";
	} elseif ($filter_group == 'day') {
	$export_html .= "<td colspan='2' align='left' nowrap='nowrap'>".$this->language->get('column_date')."</td>";
	} elseif ($filter_group == 'order') {
	$export_html .= "<td align='left' nowrap='nowrap'>".$this->language->get('column_order_order_id')."</td>";
	$export_html .= "<td align='left' nowrap='nowrap'>".$this->language->get('column_order_date_added')."</td>";
	} else {
	$export_html .= "<td align='left' width='80' nowrap='nowrap'>".$this->language->get('column_date_start')."</td>";
	$export_html .= "<td align='left' width='80' nowrap='nowrap'>".$this->language->get('column_date_end')."</td>";	
	}
	} elseif ($filter_report == 'day_of_week') {
	$export_html .= "<td colspan='2' align='left' nowrap='nowrap'>".$this->language->get('column_day_of_week')."</td>";
	} elseif ($filter_report == 'hour') {
	$export_html .= "<td colspan='2' align='left' nowrap='nowrap'>".$this->language->get('column_hour')."</td>";
	} elseif ($filter_report == 'store') {
	$export_html .= "<td colspan='2' align='left' nowrap='nowrap'>".$this->language->get('column_store')."</td>";
	} elseif ($filter_report == 'customer_group') {
	$export_html .= "<td colspan='2' align='left' nowrap='nowrap'>".$this->language->get('column_customer_group')."</td>";
	} elseif ($filter_report == 'country') {
	$export_html .= "<td colspan='2' align='left' nowrap='nowrap'>".$this->language->get('column_country')."</td>";
	} elseif ($filter_report == 'postcode') {
	$export_html .= "<td colspan='2' align='left' nowrap='nowrap'>".$this->language->get('column_postcode')."</td>";
	} elseif ($filter_report == 'region_state') {
	$export_html .= "<td colspan='2' align='left' nowrap='nowrap'>".$this->language->get('column_region_state')."</td>";
	} elseif ($filter_report == 'city') {
	$export_html .= "<td colspan='2' align='left' nowrap='nowrap'>".$this->language->get('column_city')."</td>";
	} elseif ($filter_report == 'payment_method') {
	$export_html .= "<td colspan='2' align='left' nowrap='nowrap'>".$this->language->get('column_payment_method')."</td>";
	} elseif ($filter_report == 'shipping_method') {
	$export_html .= "<td colspan='2' align='left' nowrap='nowrap'>".$this->language->get('column_shipping_method')."</td>";	
	}
	isset($_POST['sop20']) ? $export_html .= "<td align='right'>".$this->language->get('column_orders')."</td>" : '';
	isset($_POST['sop21']) ? $export_html .= "<td align='right'>".$this->language->get('column_customers')."</td>" : '';
	isset($_POST['sop22']) ? $export_html .= "<td align='right'>".$this->language->get('column_products')."</td>" : '';
	isset($_POST['sop23']) ? $export_html .= "<td align='right'>".$this->language->get('column_sub_total')."</td>" : '';
	isset($_POST['sop24']) ? $export_html .= "<td align='right'>".$this->language->get('column_handling')."</td>" : '';
	isset($_POST['sop25']) ? $export_html .= "<td align='right'>".$this->language->get('column_loworder')."</td>" : '';
	isset($_POST['sop27']) ? $export_html .= "<td align='right'>".$this->language->get('column_shipping')."</td>" : '';	
	isset($_POST['sop26']) ? $export_html .= "<td align='right'>".$this->language->get('column_reward')."</td>" : '';
	isset($_POST['sop28']) ? $export_html .= "<td align='right'>".$this->language->get('column_coupon')."</td>" : '';
	isset($_POST['sop29']) ? $export_html .= "<td align='right'>".$this->language->get('column_tax')."</td>" : '';
	isset($_POST['sop30']) ? $export_html .= "<td align='right'>".$this->language->get('column_credit')."</td>" : '';
	isset($_POST['sop31']) ? $export_html .= "<td align='right'>".$this->language->get('column_voucher')."</td>" : '';
	isset($_POST['sop33']) ? $export_html .= "<td align='right'>".$this->language->get('column_total')."</td>" : '';
	isset($_POST['sop37']) ? $export_html .= "<td align='right'>".$this->language->get('column_sales')."</td>" : '';
	isset($_POST['sop34']) ? $export_html .= "<td align='right'>".$this->language->get('column_prod_costs')."</td>" : '';
	isset($_POST['sop32']) ? $export_html .= "<td align='right'>".$this->language->get('column_commission')."</td>" : '';
	isset($_POST['sop391']) ? $export_html .= "<td align='right'>".$this->language->get('column_payment_cost')."</td>" : '';
	isset($_POST['sop392']) ? $export_html .= "<td align='right'>".$this->language->get('column_shipping_cost')."</td>" : '';
	isset($_POST['sop393']) ? $export_html .= "<td align='right'>".$this->language->get('column_shipping_balance')."</td>" : '';
	isset($_POST['sop38']) ? $export_html .= "<td align='right'>".$this->language->get('column_total_costs')."</td>" : '';
	isset($_POST['sop35']) ? $export_html .= "<td align='right'>".$this->language->get('column_net_profit')."</td>" : '';
	isset($_POST['sop36']) ? $export_html .= "<td align='right'>".$this->language->get('column_profit_margin')."</td>" : '';
	$export_html .="</tr>";
	$export_html .="</thead><tbody>";
	foreach ($results as $result) {
	$total_sales = $result['sub_total']+$result['handling']+$result['low_order_fee']+$result['reward']+$result['coupon']+$result['credit']+$result['voucher']+($data['adv_profit_reports_formula_sop1'] ? $result['shipping'] : 0);
	$total_costs = $result['prod_costs']+$result['commission']+($data['adv_profit_reports_formula_sop3'] ? $result['payment_cost'] : 0)+($data['adv_profit_reports_formula_sop2'] ? $result['shipping_cost'] : 0);
	$total_sales_total = $result['sub_total_total']+$result['handling_total']+$result['low_order_fee_total']+$result['reward_total']+$result['coupon_total']+$result['credit_total']+$result['voucher_total']+($data['adv_profit_reports_formula_sop1'] ? $result['shipping_total'] : 0);
	$total_costs_total = $result['prod_costs_total']+$result['commission_total']+($data['adv_profit_reports_formula_sop3'] ? $result['pay_costs_total'] : 0)+($data['adv_profit_reports_formula_sop2'] ? $result['ship_costs_total'] : 0);	
	$export_html .="<tr>";
	if ($filter_report == 'sales_summary') {
	if ($filter_group == 'year') {				
	$export_html .= "<td colspan='2' align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".$result['year']."</td>";
	} elseif ($filter_group == 'quarter') {
	$export_html .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".$result['year']."</td>";	
	$export_html .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".'Q' . $result['quarter']."</td>";						
	} elseif ($filter_group == 'month') {
	$export_html .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".$result['year']."</td>";	
	$export_html .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".$result['month']."</td>";	
	} elseif ($filter_group == 'day') {
	$export_html .= "<td colspan='2' align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".date($this->language->get('date_format_short'), strtotime($result['date_start']))."</td>";
	} elseif ($filter_group == 'order') {
	$export_html .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".$result['order_id']."</td>";	
	$export_html .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".date($this->language->get('date_format_short'), strtotime($result['date_start']))."</td>";
	} else {
	$export_html .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".date($this->language->get('date_format_short'), strtotime($result['date_start']))."</td>";
	$export_html .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".date($this->language->get('date_format_short'), strtotime($result['date_end']))."</td>";
	}
	} elseif ($filter_report == 'day_of_week') {
	$export_html .= "<td colspan='2' align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".$result['day_of_week']."</td>";
	} elseif ($filter_report == 'hour') {
	$export_html .= "<td colspan='2' align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".number_format($result['hour'], 2, ':', '')."</td>";
	} elseif ($filter_report == 'store') {
	$export_html .= "<td colspan='2' align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".html_entity_decode($result['store_name'])."</td>";
	} elseif ($filter_report == 'customer_group') {
	$export_html .= "<td colspan='2' align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".html_entity_decode($result['customer_group'])."</td>";
	} elseif ($filter_report == 'country') {
	$export_html .= "<td colspan='2' align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".$result['payment_country']."</td>";
	} elseif ($filter_report == 'postcode') {
	$export_html .= "<td colspan='2' align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".$result['payment_postcode']."</td>";
	} elseif ($filter_report == 'region_state') {
	$export_html .= "<td colspan='2' align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".$result['payment_zone']. ', ' . $result['payment_country']."</td>";
	} elseif ($filter_report == 'city') {
	$export_html .= "<td colspan='2' align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".$result['payment_city']. ', ' . $result['payment_country']."</td>";
	} elseif ($filter_report == 'payment_method') {
	$export_html .= "<td colspan='2' align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".preg_replace('~\(.*?\)~', '', $result['payment_method'])."</td>";
	} elseif ($filter_report == 'shipping_method') {
	$export_html .= "<td colspan='2' align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".preg_replace('~\(.*?\)~', '', $result['shipping_method'])."</td>";
	}	
	isset($_POST['sop20']) ? $export_html .= "<td align='right' nowrap='nowrap'>".$result['orders']."</td>" : '';
	isset($_POST['sop21']) ? $export_html .= "<td align='right' nowrap='nowrap'>".$result['customers']."</td>" : '';
	isset($_POST['sop22']) ? $export_html .= "<td align='right' nowrap='nowrap'>".$result['products']."</td>" : '';
	isset($_POST['sop23']) ? $export_html .= "<td align='right' nowrap='nowrap' style='color:#090;'>".$this->currency->format($result['sub_total'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop24']) ? $export_html .= "<td align='right' nowrap='nowrap' style='color:#090;'>".$this->currency->format($result['handling'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop25']) ? $export_html .= "<td align='right' nowrap='nowrap' style='color:#090;'>".$this->currency->format($result['low_order_fee'], $this->config->get('config_currency'))."</td>" : '';
	if ($this->config->get('adv_profit_reports_formula_sop1')) {
	isset($_POST['sop27']) ? $export_html .= "<td align='right' nowrap='nowrap' style='color:#090;'>".$this->currency->format($result['shipping'], $this->config->get('config_currency'))."</td>" : '';	
	} else {
	isset($_POST['sop27']) ? $export_html .= "<td align='right' nowrap='nowrap'>".$this->currency->format($result['shipping'], $this->config->get('config_currency'))."</td>" : '';
	}
	isset($_POST['sop26']) ? $export_html .= "<td align='right' nowrap='nowrap' style='color:#090;'>".$this->currency->format($result['reward'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop28']) ? $export_html .= "<td align='right' nowrap='nowrap' style='color:#090;'>".$this->currency->format($result['coupon'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop29']) ? $export_html .= "<td align='right' nowrap='nowrap'>".$this->currency->format($result['tax'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop30']) ? $export_html .= "<td align='right' nowrap='nowrap' style='color:#090;'>".$this->currency->format($result['credit'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop31']) ? $export_html .= "<td align='right' nowrap='nowrap' style='color:#090;'>".$this->currency->format($result['voucher'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop33']) ? $export_html .= "<td align='right' nowrap='nowrap'>".$this->currency->format($result['total'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop37']) ? $export_html .= "<td align='right' nowrap='nowrap' class='sales'>".$this->currency->format($total_sales, $this->config->get('config_currency'))."</td>" : '';	
	isset($_POST['sop34']) ? $export_html .= "<td align='right' nowrap='nowrap' style='color:#F00;'>".$this->currency->format('-' . ($result['prod_costs']), $this->config->get('config_currency'))."</td>" : '';	
	isset($_POST['sop32']) ? $export_html .= "<td align='right' nowrap='nowrap' style='color:#F00;'>".$this->currency->format('-' . ($result['commission']), $this->config->get('config_currency'))."</td>" : '';
	if ($this->config->get('adv_profit_reports_formula_sop3')) {
	isset($_POST['sop391']) ? $export_html .= "<td align='right' nowrap='nowrap' style='color:#F00;'>".$this->currency->format('-' . ($result['payment_cost']), $this->config->get('config_currency'))."</td>" : '';
	} else {
	isset($_POST['sop391']) ? $export_html .= "<td align='right' nowrap='nowrap'>".$this->currency->format('-' . ($result['payment_cost']), $this->config->get('config_currency'))."</td>" : '';
	}	
	if ($this->config->get('adv_profit_reports_formula_sop2')) {
	isset($_POST['sop392']) ? $export_html .= "<td align='right' nowrap='nowrap' style='color:#F00;'>".$this->currency->format('-' . ($result['shipping_cost']), $this->config->get('config_currency'))."</td>" : '';
	} else {
	isset($_POST['sop392']) ? $export_html .= "<td align='right' nowrap='nowrap'>".$this->currency->format('-' . ($result['shipping_cost']), $this->config->get('config_currency'))."</td>" : '';
	}		
	isset($_POST['sop393']) ? $export_html .= "<td align='right' nowrap='nowrap'>".$this->currency->format($result['shipping']-$result['shipping_cost'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop38']) ? $export_html .= "<td align='right' nowrap='nowrap' class='cost'>".$this->currency->format('-' . ($total_costs), $this->config->get('config_currency'))."</td>" : '';
	if (($total_sales-$total_costs) >= 0) {
	isset($_POST['sop35']) ? $export_html .= "<td align='right' nowrap='nowrap' class='plusprofit'>".$this->currency->format(($total_sales-$total_costs), $this->config->get('config_currency'))."</td>" : '';
	} else {
	isset($_POST['sop35']) ? $export_html .= "<td align='right' nowrap='nowrap' class='minusprofit'>".$this->currency->format(($total_sales-$total_costs), $this->config->get('config_currency'))."</td>" : '';
	}
	if (($total_costs) > 0) {
	if (($total_sales-$total_costs) >= 0) {
	isset($_POST['sop36']) ? $export_html .= "<td align='right' nowrap='nowrap' class='plusprofit'>".round(100 * (($total_sales-$total_costs) / $total_sales), 2) . '%'."</td>" : '';
	} else {
	isset($_POST['sop36']) ? $export_html .= "<td align='right' nowrap='nowrap' class='minusprofit'>".round(100 * (($total_sales-$total_costs) / $total_sales), 2) . '%'."</td>" : '';
	}
	} else {
	isset($_POST['sop36']) ? $export_html .= "<td align='right' nowrap='nowrap' class='plusprofit'>".'100%'."</td>" : '';
	}						
	$export_html .="</tr>";
	}
	$export_html .="<tr>";
	$export_html .= "<td colspan='2' align='right' style='background-color:#E7EFEF; font-weight:bold;'>".$this->language->get('text_filter_total')."</td>";
	isset($_POST['sop20']) ? $export_html .= "<td align='right' nowrap='nowrap' class='total'>".$result['orders_total']."</td>" : '';
	isset($_POST['sop21']) ? $export_html .= "<td align='right' nowrap='nowrap' class='total'>".$result['customers_total']."</td>" : '';
	isset($_POST['sop22']) ? $export_html .= "<td align='right' nowrap='nowrap' class='total'>".$result['products_total']."</td>" : '';
	isset($_POST['sop23']) ? $export_html .= "<td align='right' nowrap='nowrap' class='total'>".$this->currency->format($result['sub_total_total'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop24']) ? $export_html .= "<td align='right' nowrap='nowrap' class='total'>".$this->currency->format($result['handling_total'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop25']) ? $export_html .= "<td align='right' nowrap='nowrap' class='total'>".$this->currency->format($result['low_order_fee_total'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop27']) ? $export_html .= "<td align='right' nowrap='nowrap' class='total'>".$this->currency->format($result['shipping_total'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop26']) ? $export_html .= "<td align='right' nowrap='nowrap' class='total'>".$this->currency->format($result['reward_total'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop28']) ? $export_html .= "<td align='right' nowrap='nowrap' class='total'>".$this->currency->format($result['coupon_total'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop29']) ? $export_html .= "<td align='right' nowrap='nowrap' class='total'>".$this->currency->format($result['tax_total'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop30']) ? $export_html .= "<td align='right' nowrap='nowrap' class='total'>".$this->currency->format($result['credit_total'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop31']) ? $export_html .= "<td align='right' nowrap='nowrap' class='total'>".$this->currency->format($result['voucher_total'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop33']) ? $export_html .= "<td align='right' nowrap='nowrap' class='total'>".$this->currency->format($result['total_total'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop37']) ? $export_html .= "<td align='right' nowrap='nowrap' class='total_sales'>".$this->currency->format($total_sales_total, $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop34']) ? $export_html .= "<td align='right' nowrap='nowrap' class='total'>".$this->currency->format('-' . ($result['prod_costs_total']), $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop32']) ? $export_html .= "<td align='right' nowrap='nowrap' class='total'>".$this->currency->format('-' . ($result['commission_total']), $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop391']) ? $export_html .= "<td align='right' nowrap='nowrap' class='total'>".$this->currency->format('-' . ($result['pay_costs_total']), $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop392']) ? $export_html .= "<td align='right' nowrap='nowrap' class='total'>".$this->currency->format('-' . ($result['ship_costs_total']), $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop393']) ? $export_html .= "<td align='right' nowrap='nowrap' class='total'>".$this->currency->format($result['shipping_total']-$result['ship_costs_total'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop38']) ? $export_html .= "<td align='right' nowrap='nowrap' class='total_cost'>".$this->currency->format('-' . ($total_costs_total), $this->config->get('config_currency'))."</td>" : '';
	if (($total_sales_total-$total_costs_total) >= 0) {
	isset($_POST['sop35']) ? $export_html .= "<td align='right' nowrap='nowrap' class='total_plusprofit'>".$this->currency->format(($total_sales_total-$total_costs_total), $this->config->get('config_currency'))."</td>" : '';
	} else {
	isset($_POST['sop35']) ? $export_html .= "<td align='right' nowrap='nowrap' class='total_minusprofit'>".$this->currency->format(($total_sales_total-$total_costs_total), $this->config->get('config_currency'))."</td>" : '';
	}
	if (($total_costs_total) > 0) {
	if (($total_sales_total-$total_costs_total) >= 0) {
	isset($_POST['sop36']) ? $export_html .= "<td align='right' nowrap='nowrap' class='total_plusprofit'>".round(100 * (($total_sales_total-$total_costs_total) / $total_sales_total), 2) . '%'."</td>" : '';
	} else {
	isset($_POST['sop36']) ? $export_html .= "<td align='right' nowrap='nowrap' class='total_minusprofit'>".round(100 * (($total_sales_total-$total_costs_total) / $total_sales_total), 2) . '%'."</td>" : '';
	}
	} else {
	isset($_POST['sop36']) ? $export_html .= "<td align='right' nowrap='nowrap' class='total_plusprofit'>".'100%'."</td>" : '';	
	}
	$export_html .="</tr></tbody></table>";	
	$export_html .="</body></html>";

$filename = "sale_profit_report_".date("Y-m-d",time());
header('Expires: 0');
header('Cache-control: private');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Content-Description: File Transfer');			
header('Content-Disposition: attachment; filename='.$filename.".html");
print $export_html;			
exit;
?>