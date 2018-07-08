<?php
ini_set("memory_limit","256M");
	
	$export_pdf_product_list = "<html><head>";			
	$export_pdf_product_list .= "</head>";
	$export_pdf_product_list .= "<body>";
	$export_pdf_product_list .= "<style type='text/css'>
	.list_main {
		width: 100%;
		font-family: Helvetica;
		margin-bottom: 5px;
	}
	.list_main thead td {
		border: 1px solid #DDDDDD;			
		background-color: #E5E5E5;
		padding: 0px 3px;
		font-size: 11px;
		font-weight: bold;
	}	
	.list_main tbody a {
		text-decoration: none;
	}
	.list_main tbody td {
		border: 1px solid #DDDDDD;
		padding: 3px;
		font-size: 11px;	
	}

	.list_detail {
		width: 100%;
		font-family: Helvetica;			
	}
	.list_detail thead td {
		border: 1px solid #DDDDDD;		
		background-color: #F0F0F0;
		padding: 0px 3px;
		font-size: 9px;
		font-weight: bold;
	}	
	.list_detail tbody td {
		border: 1px solid #DDDDDD;
		padding: 0px 3px;
		font-size: 9px;	
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
	foreach ($results as $result) {		
	$total_sales = $result['sub_total']+$result['handling']+$result['low_order_fee']+$result['reward']+$result['coupon']+$result['credit']+$result['voucher']+($data['adv_profit_reports_formula_sop1'] ? $result['shipping'] : 0);
	$total_costs = $result['prod_costs']+$result['commission']+($data['adv_profit_reports_formula_sop3'] ? $result['payment_cost'] : 0)+($data['adv_profit_reports_formula_sop2'] ? $result['shipping_cost'] : 0);
	$total_sales_total = $result['sub_total_total']+$result['handling_total']+$result['low_order_fee_total']+$result['reward_total']+$result['coupon_total']+$result['credit_total']+$result['voucher_total']+($data['adv_profit_reports_formula_sop1'] ? $result['shipping_total'] : 0);
	$total_costs_total = $result['prod_costs_total']+$result['commission_total']+($data['adv_profit_reports_formula_sop3'] ? $result['pay_costs_total'] : 0)+($data['adv_profit_reports_formula_sop2'] ? $result['ship_costs_total'] : 0);	
	$export_pdf_product_list .= "<div style='border:1px solid #999; padding: 3px; margin-bottom:10px; width:100%;'>";
	$export_pdf_product_list .= "<table cellspacing='0' cellpadding='0' class='list_main'>";	
	$export_pdf_product_list .="<thead>";		
	$export_pdf_product_list .= "<tr>";
	if ($filter_report == 'sales_summary') {
	if ($filter_group == 'year') {				
	$export_pdf_product_list .= "<td colspan='2' align='left' nowrap='nowrap'>".$this->language->get('column_year')."</td>";
	} elseif ($filter_group == 'quarter') {
	$export_pdf_product_list .= "<td align='left' nowrap='nowrap'>".$this->language->get('column_year')."</td>";
	$export_pdf_product_list .= "<td align='left' nowrap='nowrap'>".$this->language->get('column_quarter')."</td>";				
	} elseif ($filter_group == 'month') {
	$export_pdf_product_list .= "<td align='left' nowrap='nowrap'>".$this->language->get('column_year')."</td>";
	$export_pdf_product_list .= "<td align='left' nowrap='nowrap'>".$this->language->get('column_month')."</td>";
	} elseif ($filter_group == 'day') {
	$export_pdf_product_list .= "<td colspan='2' align='left' nowrap='nowrap'>".$this->language->get('column_date')."</td>";
	} elseif ($filter_group == 'order') {
	$export_pdf_product_list .= "<td align='left' nowrap='nowrap'>".$this->language->get('column_order_order_id')."</td>";
	$export_pdf_product_list .= "<td align='left' nowrap='nowrap'>".$this->language->get('column_order_date_added')."</td>";	
	} else {
	$export_pdf_product_list .= "<td align='left' nowrap='nowrap'>".$this->language->get('column_date_start')."</td>";
	$export_pdf_product_list .= "<td align='left' nowrap='nowrap'>".$this->language->get('column_date_end')."</td>";	
	}
	} elseif ($filter_report == 'day_of_week') {
	$export_pdf_product_list .= "<td colspan='2' align='left' nowrap='nowrap'>".$this->language->get('column_day_of_week')."</td>";
	} elseif ($filter_report == 'hour') {
	$export_pdf_product_list .= "<td colspan='2' align='left' nowrap='nowrap'>".$this->language->get('column_hour')."</td>";
	} elseif ($filter_report == 'store') {
	$export_pdf_product_list .= "<td colspan='2' align='left' nowrap='nowrap'>".$this->language->get('column_store')."</td>";
	} elseif ($filter_report == 'customer_group') {
	$export_pdf_product_list .= "<td colspan='2' align='left' nowrap='nowrap'>".$this->language->get('column_customer_group')."</td>";
	} elseif ($filter_report == 'country') {
	$export_pdf_product_list .= "<td colspan='2' align='left' nowrap='nowrap'>".$this->language->get('column_country')."</td>";
	} elseif ($filter_report == 'postcode') {
	$export_pdf_product_list .= "<td colspan='2' align='left' nowrap='nowrap'>".$this->language->get('column_postcode')."</td>";
	} elseif ($filter_report == 'region_state') {
	$export_pdf_product_list .= "<td colspan='2' align='left' nowrap='nowrap'>".$this->language->get('column_region_state')."</td>";
	} elseif ($filter_report == 'city') {
	$export_pdf_product_list .= "<td colspan='2' align='left' nowrap='nowrap'>".$this->language->get('column_city')."</td>";
	} elseif ($filter_report == 'payment_method') {
	$export_pdf_product_list .= "<td colspan='2' align='left' nowrap='nowrap'>".$this->language->get('column_payment_method')."</td>";
	} elseif ($filter_report == 'shipping_method') {
	$export_pdf_product_list .= "<td colspan='2' align='left' nowrap='nowrap'>".$this->language->get('column_shipping_method')."</td>";	
	}	
	isset($_POST['sop20']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_orders')."</td>" : '';
	isset($_POST['sop21']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_customers')."</td>" : '';
	isset($_POST['sop22']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_products')."</td>" : '';
	isset($_POST['sop23']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_sub_total')."</td>" : '';
	isset($_POST['sop24']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_handling')."</td>" : '';
	isset($_POST['sop25']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_loworder')."</td>" : '';
	isset($_POST['sop27']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_shipping')."</td>" : '';	
	isset($_POST['sop26']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_reward')."</td>" : '';
	isset($_POST['sop28']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_coupon')."</td>" : '';
	isset($_POST['sop29']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_tax')."</td>" : '';
	isset($_POST['sop30']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_credit')."</td>" : '';
	isset($_POST['sop31']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_voucher')."</td>" : '';
	isset($_POST['sop33']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_total')."</td>" : '';
	isset($_POST['sop37']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_sales')."</td>" : '';	
	isset($_POST['sop34']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_prod_costs')."</td>" : '';
	isset($_POST['sop32']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_commission')."</td>" : '';
	isset($_POST['sop391']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_payment_cost')."</td>" : '';
	isset($_POST['sop392']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_shipping_cost')."</td>" : '';
	isset($_POST['sop393']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_shipping_balance')."</td>" : '';
	isset($_POST['sop38']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_total_costs')."</td>" : '';	
	isset($_POST['sop35']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_net_profit')."</td>" : '';
	isset($_POST['sop36']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_profit_margin')."</td>" : '';
	$export_pdf_product_list .= "</tr></thead>";
	$export_pdf_product_list .= "<tbody><tr>";
	if ($filter_report == 'sales_summary') {
	if ($filter_group == 'year') {				
	$export_pdf_product_list .= "<td colspan='2' align='left' nowrap='nowrap'>".$result['year']."</td>";
	} elseif ($filter_group == 'quarter') {
	$export_pdf_product_list .= "<td align='left' nowrap='nowrap'>".$result['year']."</td>";	
	$export_pdf_product_list .= "<td align='left' nowrap='nowrap'>".'Q' . $result['quarter']."</td>";						
	} elseif ($filter_group == 'month') {
	$export_pdf_product_list .= "<td align='left' nowrap='nowrap'>".$result['year']."</td>";	
	$export_pdf_product_list .= "<td align='left' nowrap='nowrap'>".$result['month']."</td>";	
	} elseif ($filter_group == 'day') {
	$export_pdf_product_list .= "<td colspan='2' align='left' nowrap='nowrap'>".date($this->language->get('date_format_short'), strtotime($result['date_start']))."</td>";	
	} elseif ($filter_group == 'order') {
	$export_pdf_product_list .= "<td align='left' nowrap='nowrap'>".$result['order_id']."</td>";	
	$export_pdf_product_list .= "<td align='left' nowrap='nowrap'>".date($this->language->get('date_format_short'), strtotime($result['date_start']))."</td>";	
	} else {
	$export_pdf_product_list .= "<td align='left' nowrap='nowrap'>".date($this->language->get('date_format_short'), strtotime($result['date_start']))."</td>";
	$export_pdf_product_list .= "<td align='left' nowrap='nowrap'>".date($this->language->get('date_format_short'), strtotime($result['date_end']))."</td>";
	}
	} elseif ($filter_report == 'day_of_week') {
	$export_pdf_product_list .= "<td colspan='2' align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".$result['day_of_week']."</td>";
	} elseif ($filter_report == 'hour') {
	$export_pdf_product_list .= "<td colspan='2' align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".number_format($result['hour'], 2, ':', '')."</td>";
	} elseif ($filter_report == 'store') {
	$export_pdf_product_list .= "<td colspan='2' align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".html_entity_decode($result['store_name'])."</td>";
	} elseif ($filter_report == 'customer_group') {
	$export_pdf_product_list .= "<td colspan='2' align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".html_entity_decode($result['customer_group'])."</td>";
	} elseif ($filter_report == 'country') {
	$export_pdf_product_list .= "<td colspan='2' align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".$result['payment_country']."</td>";
	} elseif ($filter_report == 'postcode') {
	$export_pdf_product_list .= "<td colspan='2' align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".$result['payment_postcode']."</td>";
	} elseif ($filter_report == 'region_state') {
	$export_pdf_product_list .= "<td colspan='2' align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".$result['payment_zone']. ', ' . $result['payment_country']."</td>";
	} elseif ($filter_report == 'city') {
	$export_pdf_product_list .= "<td colspan='2' align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".$result['payment_city']. ', ' . $result['payment_country']."</td>";
	} elseif ($filter_report == 'payment_method') {
	$export_pdf_product_list .= "<td colspan='2' align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".preg_replace('~\(.*?\)~', '', $result['payment_method'])."</td>";
	} elseif ($filter_report == 'shipping_method') {
	$export_pdf_product_list .= "<td colspan='2' align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".preg_replace('~\(.*?\)~', '', $result['shipping_method'])."</td>";
	}
	isset($_POST['sop20']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap'>".$result['orders']."</td>" : '';
	isset($_POST['sop21']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap'>".$result['customers']."</td>" : '';
	isset($_POST['sop22']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap'>".$result['products']."</td>" : '';
	isset($_POST['sop23']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' style='color:#090;'>".$this->currency->format($result['sub_total'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop24']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' style='color:#090;'>".$this->currency->format($result['handling'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop25']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' style='color:#090;'>".$this->currency->format($result['low_order_fee'], $this->config->get('config_currency'))."</td>" : '';
	if ($this->config->get('adv_profit_reports_formula_sop1')) {
	isset($_POST['sop27']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' style='color:#090;'>".$this->currency->format($result['shipping'], $this->config->get('config_currency'))."</td>" : '';	
	} else {
	isset($_POST['sop27']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap'>".$this->currency->format($result['shipping'], $this->config->get('config_currency'))."</td>" : '';
	}
	isset($_POST['sop26']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' style='color:#090;'>".$this->currency->format($result['reward'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop28']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' style='color:#090;'>".$this->currency->format($result['coupon'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop29']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap'>".$this->currency->format($result['tax'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop30']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' style='color:#090;'>".$this->currency->format($result['credit'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop31']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' style='color:#090;'>".$this->currency->format($result['voucher'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop33']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap'>".$this->currency->format($result['total'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop37']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' class='sales'>".$this->currency->format($total_sales, $this->config->get('config_currency'))."</td>" : '';	
	isset($_POST['sop34']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' style='color:#F00;'>".$this->currency->format('-' . ($result['prod_costs']), $this->config->get('config_currency'))."</td>" : '';	
	isset($_POST['sop32']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' style='color:#F00;'>".$this->currency->format('-' . ($result['commission']), $this->config->get('config_currency'))."</td>" : '';
	if ($this->config->get('adv_profit_reports_formula_sop3')) {
	isset($_POST['sop391']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' style='color:#F00;'>".$this->currency->format('-' . ($result['payment_cost']), $this->config->get('config_currency'))."</td>" : '';
	} else {
	isset($_POST['sop391']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap'>".$this->currency->format('-' . ($result['payment_cost']), $this->config->get('config_currency'))."</td>" : '';
	}	
	if ($this->config->get('adv_profit_reports_formula_sop2')) {
	isset($_POST['sop392']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' style='color:#F00;'>".$this->currency->format('-' . ($result['shipping_cost']), $this->config->get('config_currency'))."</td>" : '';
	} else {
	isset($_POST['sop392']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap'>".$this->currency->format('-' . ($result['shipping_cost']), $this->config->get('config_currency'))."</td>" : '';
	}		
	isset($_POST['sop393']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap'>".$this->currency->format($result['shipping']-$result['shipping_cost'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop38']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' class='cost'>".$this->currency->format('-' . ($total_costs), $this->config->get('config_currency'))."</td>" : '';	
	if (($total_sales-$total_costs) >= 0) {
	isset($_POST['sop35']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' class='plusprofit'>".$this->currency->format(($total_sales-$total_costs), $this->config->get('config_currency'))."</td>" : '';
	} else {
	isset($_POST['sop35']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' class='minusprofit'>".$this->currency->format(($total_sales-$total_costs), $this->config->get('config_currency'))."</td>" : '';
	}
	if (($total_costs) > 0) {
	if (($total_sales-$total_costs) >= 0) {
	isset($_POST['sop36']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' class='plusprofit'>".round(100 * (($total_sales-$total_costs) / $total_sales), 2) . '%'."</td>" : '';
	} else {
	isset($_POST['sop36']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' class='minusprofit'>".round(100 * (($total_sales-$total_costs) / $total_sales), 2) . '%'."</td>" : '';
	}
	} else {
	isset($_POST['sop36']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' class='plusprofit'>".'100%'."</td>" : '';
	}							
	$export_pdf_product_list .= "</tr></tbody></table>";
	$export_pdf_product_list .="<table cellspacing='0' cellpadding='0' cellspacing='0' cellpadding='0' class='list_detail'>";
	$export_pdf_product_list .="<thead><tr>";
		isset($_POST['sop60']) ? $export_pdf_product_list .= "<td align='left'>".$this->language->get('column_prod_order_id')."</td>" : '';
		isset($_POST['sop61']) ? $export_pdf_product_list .= "<td align='left'>".$this->language->get('column_prod_date_added')."</td>" : '';
		isset($_POST['sop62']) ? $export_pdf_product_list .= "<td align='left'>".$this->language->get('column_prod_inv_no')."</td>" : '';
		isset($_POST['sop63']) ? $export_pdf_product_list .= "<td align='left'>".$this->language->get('column_prod_id')."</td>" : '';
		isset($_POST['sop64']) ? $export_pdf_product_list .= "<td align='left'>".$this->language->get('column_prod_sku')."</td>" : '';
		isset($_POST['sop65']) ? $export_pdf_product_list .= "<td align='left'>".$this->language->get('column_prod_model')."</td>" : '';		
		isset($_POST['sop66']) ? $export_pdf_product_list .= "<td align='left'>".$this->language->get('column_prod_name')."</td>" : '';
		isset($_POST['sop67']) ? $export_pdf_product_list .= "<td align='left'>".$this->language->get('column_prod_option')."</td>" : '';
		isset($_POST['sop77']) ? $export_pdf_product_list .= "<td align='left'>".$this->language->get('column_prod_attributes')."</td>" : '';		
		isset($_POST['sop68']) ? $export_pdf_product_list .= "<td align='left'>".$this->language->get('column_prod_manu')."</td>" : '';
		isset($_POST['sop79']) ? $export_pdf_product_list .= "<td align='left'>".$this->language->get('column_prod_category')."</td>" : '';
		isset($_POST['sop69']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_prod_currency')."</td>" : '';
		isset($_POST['sop70']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_prod_price')."</td>" : '';
		isset($_POST['sop71']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_prod_quantity')."</td>" : '';
		isset($_POST['sop72a']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_prod_total_excl_vat')."</td>" : '';		
		isset($_POST['sop73']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_prod_tax')."</td>" : '';
		isset($_POST['sop72b']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_prod_total_incl_vat')."</td>" : '';
		isset($_POST['sop72c']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_prod_sales')."</td>" : '';
		isset($_POST['sop74']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_prod_costs')."</td>" : '';
		isset($_POST['sop75']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_prod_profit')."</td>" : '';
		isset($_POST['sop76']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_profit_margin')."</td>" : '';
		$export_pdf_product_list .= "</tr></thead>";
		$export_pdf_product_list .= "<tbody><tr>";
		isset($_POST['sop60']) ? $export_pdf_product_list .= "<td align='left' nowrap='nowrap'>".$result['product_ord_idc']."</td>" : '';
		isset($_POST['sop61']) ? $export_pdf_product_list .= "<td align='left' nowrap='nowrap'>".$result['product_order_date']."</td>" : '';
		isset($_POST['sop62']) ? $export_pdf_product_list .= "<td align='left' nowrap='nowrap'>".$result['product_inv_no']."</td>" : '';
		isset($_POST['sop63']) ? $export_pdf_product_list .= "<td align='left' nowrap='nowrap'>".$result['product_pidc']."</td>" : '';
		isset($_POST['sop64']) ? $export_pdf_product_list .= "<td align='left' nowrap='nowrap'>".$result['product_sku']."</td>" : '';
		isset($_POST['sop65']) ? $export_pdf_product_list .= "<td align='left' nowrap='nowrap'>".$result['product_model']."</td>" : '';		
		isset($_POST['sop66']) ? $export_pdf_product_list .= "<td align='left' nowrap='nowrap'>".$result['product_name']."</td>" : '';
		isset($_POST['sop67']) ? $export_pdf_product_list .= "<td align='left' nowrap='nowrap'>".$result['product_option']."</td>" : '';
		isset($_POST['sop77']) ? $export_pdf_product_list .= "<td align='left' nowrap='nowrap'>".$result['product_attributes']."</td>" : '';		
		isset($_POST['sop68']) ? $export_pdf_product_list .= "<td align='left' nowrap='nowrap'>".$result['product_manu']."</td>" : '';
		isset($_POST['sop79']) ? $export_pdf_product_list .= "<td align='left' nowrap='nowrap'>".$result['product_category']."</td>" : '';
		isset($_POST['sop69']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap'>".$result['product_currency']."</td>" : '';
		isset($_POST['sop70']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap'>".$result['product_price']."</td>" : '';
		isset($_POST['sop71']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap'>".$result['product_quantity']."</td>" : '';
		isset($_POST['sop72a']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap'>".$result['product_total_excl_vat']."</td>" : '';		
		isset($_POST['sop73']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap'>".$result['product_tax']."</td>" : '';
		isset($_POST['sop72b']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap'>".$result['product_total_incl_vat']."</td>" : '';		
		isset($_POST['sop72c']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' class='sales'>".$result['product_sales']."</td>" : '';
		isset($_POST['sop74']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' class='cost'>-".$result['product_costs']."</td>" : '';
		isset($_POST['sop75']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' style='background-color:#c4d9ee;'>".$result['product_profit']."</td>" : '';
		isset($_POST['sop76']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' style='background-color:#c4d9ee;'>".$result['product_profit_margin_percent'] . '%'."</td>" : '';					
		$export_pdf_product_list .= "</tr></tbody></table>";
		$export_pdf_product_list .="</div>";			
	}	
	$export_pdf_product_list .="<table cellspacing='0' cellpadding='0' class='list_main'>";
	$export_pdf_product_list .="<thead><tr>";
	$export_pdf_product_list .= "<td colspan='2'></td>";
	isset($_POST['sop20']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_orders')."</td>" : '';
	isset($_POST['sop21']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_customers')."</td>" : '';
	isset($_POST['sop22']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_products')."</td>" : '';
	isset($_POST['sop23']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_sub_total')."</td>" : '';
	isset($_POST['sop24']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_handling')."</td>" : '';
	isset($_POST['sop25']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_loworder')."</td>" : '';
	isset($_POST['sop27']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_shipping')."</td>" : '';	
	isset($_POST['sop26']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_reward')."</td>" : '';
	isset($_POST['sop28']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_coupon')."</td>" : '';
	isset($_POST['sop29']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_tax')."</td>" : '';
	isset($_POST['sop30']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_credit')."</td>" : '';
	isset($_POST['sop31']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_voucher')."</td>" : '';
	isset($_POST['sop33']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_total')."</td>" : '';
	isset($_POST['sop37']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_sales')."</td>" : '';
	isset($_POST['sop34']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_prod_costs')."</td>" : '';
	isset($_POST['sop32']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_commission')."</td>" : '';
	isset($_POST['sop391']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_payment_cost')."</td>" : '';
	isset($_POST['sop392']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_shipping_cost')."</td>" : '';
	isset($_POST['sop393']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_shipping_balance')."</td>" : '';
	isset($_POST['sop38']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_total_costs')."</td>" : '';
	isset($_POST['sop35']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_net_profit')."</td>" : '';
	isset($_POST['sop36']) ? $export_pdf_product_list .= "<td align='right'>".$this->language->get('column_profit_margin')."</td>" : '';
	$export_pdf_product_list .="</tr></thead>";
	$export_pdf_product_list .="<tbody><tr>";
	$export_pdf_product_list .= "<td colspan='2' align='right' style='background-color:#E7EFEF; font-weight:bold;'>".$this->language->get('text_filter_total')."</td>";
	isset($_POST['sop20']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' class='total'>".$result['orders_total']."</td>" : '';
	isset($_POST['sop21']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' class='total'>".$result['customers_total']."</td>" : '';
	isset($_POST['sop22']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' class='total'>".$result['products_total']."</td>" : '';
	isset($_POST['sop23']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' class='total'>".$this->currency->format($result['sub_total_total'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop24']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' class='total'>".$this->currency->format($result['handling_total'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop25']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' class='total'>".$this->currency->format($result['low_order_fee_total'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop27']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' class='total'>".$this->currency->format($result['shipping_total'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop26']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' class='total'>".$this->currency->format($result['reward_total'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop28']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' class='total'>".$this->currency->format($result['coupon_total'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop29']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' class='total'>".$this->currency->format($result['tax_total'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop30']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' class='total'>".$this->currency->format($result['credit_total'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop31']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' class='total'>".$this->currency->format($result['voucher_total'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop33']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' class='total'>".$this->currency->format($result['total_total'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop37']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' class='total_sales'>".$this->currency->format($total_sales_total, $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop34']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' class='total'>".$this->currency->format('-' . ($result['prod_costs_total']), $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop32']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' class='total'>".$this->currency->format('-' . ($result['commission_total']), $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop391']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' class='total'>".$this->currency->format('-' . ($result['pay_costs_total']), $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop392']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' class='total'>".$this->currency->format('-' . ($result['ship_costs_total']), $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop393']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' class='total'>".$this->currency->format($result['shipping_total']-$result['ship_costs_total'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['sop38']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' class='total_cost'>".$this->currency->format('-' . ($total_costs_total), $this->config->get('config_currency'))."</td>" : '';
	if (($total_sales_total-$total_costs_total) >= 0) {
	isset($_POST['sop35']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' class='total_plusprofit'>".$this->currency->format(($total_sales_total-$total_costs_total), $this->config->get('config_currency'))."</td>" : '';
	} else {
	isset($_POST['sop35']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' class='total_minusprofit'>".$this->currency->format(($total_sales_total-$total_costs_total), $this->config->get('config_currency'))."</td>" : '';
	}
	if (($total_costs_total) > 0) {
	if (($total_sales_total-$total_costs_total) >= 0) {
	isset($_POST['sop36']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' class='total_plusprofit'>".round(100 * (($total_sales_total-$total_costs_total) / $total_sales_total), 2) . '%'."</td>" : '';
	} else {
	isset($_POST['sop36']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' class='total_minusprofit'>".round(100 * (($total_sales_total-$total_costs_total) / $total_sales_total), 2) . '%'."</td>" : '';
	}
	} else {
	isset($_POST['sop36']) ? $export_pdf_product_list .= "<td align='right' nowrap='nowrap' class='total_plusprofit'>".'100%'."</td>" : '';	
	}
	$export_pdf_product_list .="</tr></tbody></table>";
	$export_pdf_product_list .="</body></html>";

ini_set('mbstring.substitute_character', "none"); 
$dompdf_pdf_product_list = mb_convert_encoding($export_pdf_product_list, 'ISO-8859-1', 'UTF-8'); 
$dompdf = new DOMPDF();
$dompdf->load_html($dompdf_pdf_product_list);
$dompdf->set_paper("a3", "landscape");
$dompdf->render();
$dompdf->stream("sale_profit_report_product_list_".date("Y-m-d",time()).".pdf");
?>