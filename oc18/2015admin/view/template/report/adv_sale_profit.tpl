<?php echo $header; ?>
<div id="content-loading" style="position: absolute; background-color:white; layer-background-color:white; height:100%; width:100%; text-align:center;"><img src="view/image/adv_reports/page_loading.gif" border="0"></div>
<style type="text/css">
.list_main {
	border-collapse: collapse;
	width: 100%;
	border-top: 1px solid #DDDDDD;
	border-left: 1px solid #DDDDDD;	
	margin-bottom: 10px;
}
.list_main td {
	border-right: 1px solid #DDDDDD;
	border-bottom: 1px solid #DDDDDD;	
}
.list_main thead td {
	background-color: #E5E5E5;
	padding: 0px 5px;
	font-weight: bold;	
}
.list_main tbody td {
	vertical-align: middle;
	padding: 0px 5px;
}
.list_main .left {
	text-align: left;
	padding: 7px;
}
.list_main .right {
	text-align: right;
	padding: 7px;
}
.list_main .center {
	text-align: center;
	padding: 3px;
}
.list_main .noresult {
	text-align: center;
	padding: 7px;
}

.list_detail {
	border-collapse: collapse;
	width: 100%;
	border-top: 1px solid #DDDDDD;
	border-left: 1px solid #DDDDDD;
	margin-top: 10px;
	margin-bottom: 10px;
}
.list_detail td {
	border-right: 1px solid #DDDDDD;
	border-bottom: 1px solid #DDDDDD;
}
.list_detail thead td {
	background-color: #F0F0F0;
	padding: 0px 3px;
	font-size: 11px;
	font-weight: bold;
}
.list_detail tbody td {
	padding: 0px 3px;
	font-size: 11px;	
}
.list_detail .left {
	text-align: left;
	padding: 3px;
}
.list_detail .right {
	text-align: right;
	padding: 3px;
}
.list_detail .center {
	text-align: center;
	padding: 3px;
}

.columns_setting {
	float: left; 
	margin: 1px;
	padding-left: 1px;
	padding-right: 1px;
	padding-top: 3px;
	padding-right: 3px;
	border: thin dotted #666;
    -moz-border-radius: 3px; 
    border-radius: 3px;	
}
.set_unchecked {
	background-color: #ffcc99;
}

.export_item {
  text-decoration: none;
  cursor: pointer;
}
.export_item a {
  text-decoration: none;
}
.export_item :hover {
  opacity: 0.7;
  -moz-opacity: 0.7;
  -ms-filter: "alpha(opacity=70)"; /* IE 8 */
  filter: alpha(opacity=70); /* IE < 8 */
} 
.noexport_item {
  opacity: 0.5;
  -moz-opacity: 0.5;
  -ms-filter: "alpha(opacity=50)"; /* IE 8 */
  filter: alpha(opacity=50); /* IE < 8 */
} 

.btn-set {
  color: #fff;
  background-color: #777;
  border-color: #888;
}
.btn-set:hover,
.btn-set:focus,
.btn-set:active,
.btn-set.active,
.open > .dropdown-toggle.btn-set {
  color: #fff;
  background-color: #666;
  border-color: #777;
}
.btn-set:active,
.btn-set.active,
.open > .dropdown-toggle.btn-set {
  background-image: none;
}
.btn-set.disabled,
.btn-set[disabled],
fieldset[disabled] .btn-set,
.btn-set.disabled:hover,
.btn-set[disabled]:hover,
fieldset[disabled] .btn-set:hover,
.btn-set.disabled:focus,
.btn-set[disabled]:focus,
fieldset[disabled] .btn-set:focus,
.btn-set.disabled:active,
.btn-set[disabled]:active,
fieldset[disabled] .btn-set:active,
.btn-set.disabled.active,
.btn-set[disabled].active,
fieldset[disabled] .btn-set.active {
  background-color: #777;
  border-color: #888;
}
.btn-set .badge {
  color: #777;
  background-color: #fff;
}

.pagination_report {
	padding:3px;
	margin:3px;
	text-align:right;
	margin-top:10px;
}
.pagination_report a {
	padding: 4px 8px 4px 8px;
	margin-right: 2px;
	border: 1px solid #ddd;
	text-decoration: none; 
	color: #666;
}
.pagination_report a:hover, .pagination_report a:active {
	padding: 4px 8px 4px 8px;
	margin-right: 2px;
	border: 1px solid #c0c0c0;
}
.pagination_report span.current {
	padding: 4px 8px 4px 8px;
	margin-right: 2px;
	border: 1px solid #a0a0a0;
	font-weight: bold;
	background-color: #f0f0f0;
	color: #666;
}
.pagination_report span.disabled {
	padding: 4px 8px 4px 8px;
	margin-right: 2px;
	border: 1px solid #f3f3f3;
	color: #ccc;
}

.ui-dialog .ui-dialog-content {
  background: #f3f3f3 !important;
} 

.styled-select-type {
	background-color: #ffcc99;
	height: 34px;
	padding: 3px;
 	border: 1px solid #BBB;
    -moz-border-radius: 3px; 
    border-radius: 3px;
}
.styled-select {
	background-color: #E7EFEF;
	height: 34px;
	padding: 3px;
 	border: 1px solid #BBB;
    -moz-border-radius: 3px; 
    border-radius: 3px;
}
.styled-select-range {
	height: 34px;
	background-color: #F9F9F9;
 	border: 1px solid #BBB;
	padding: 2px;
    -moz-border-radius: 3px; 
    border-radius: 3px;
}
.styled-input {
	height: 34px;
	border: solid 1px #BBB;
	color: #F90;
	padding: 2px;	
	background-color: #F9F9F9;
    -moz-border-radius: 3px; 
    border-radius: 3px;	
}
.styled-input-range {
	height: 34px;
	border: solid 1px #BBB;
	color: #F90;
	padding: 2px;	
    -moz-border-radius: 3px; 
    border-radius: 3px;	
}

a.multiSelect {
	background: #F9F9F9 url(view/image/adv_reports/dropdown.png) right center no-repeat;
	border: solid 1px #BBB;
	padding: 1px;
	padding-right: 19px;
	height: 31px;
	position: relative;
	cursor: default;
	text-decoration: none;
	color: black;
	display: -moz-inline-stack;
	display: inline-block;
	vertical-align: middle;
    -moz-border-radius: 3px; 
    border-radius: 3px;	
}
a.multiSelect:link, a.multiSelect:visited, a.multiSelect:hover, a.multiSelect:active {
	color: black;
	text-decoration: none;
	padding-top: 2px;	
}
a.multiSelect span {
	margin: 4px 0px 2px 4px;
	overflow: hidden;
	display: -moz-inline-stack;
	display: inline-block;
	min-width: 105px;
	max-width: 210px;	
}
.multiSelectOptions {
	margin-top: 2px;	
	overflow-y: auto;
	overflow-x: hidden;
	border: solid 1px #B2B2B2;
	background: #F9F9F9;
	padding-top: 2px;
	padding-bottom: 2px;
	min-width: 105px;
    -moz-border-radius: 3px; 
    border-radius: 3px;		
}
.multiSelectOptions LABEL {
	padding: 0px 2px 2px 2px;
	display: block;
	padding-top: 1px;
	padding-bottom: 1px;
	padding-left: 20px;	
}
.multiSelectOptions LABEL.optGroup {
	font-weight: bold;
}
.multiSelectOptions .optGroupContainer LABEL {
	padding-left: 10px;
}
.multiSelectOptions.optGroupHasCheckboxes .optGroupContainer LABEL {
	padding-left: 18px;
}
.multiSelectOptions input {
	vertical-align: text-top;
	margin-left: -16px;
	margin-right: 3px;
}
.multiSelectOptions LABEL.checked {
	background-color: #dce5f8;
}
.multiSelectOptions LABEL.selectAll {
	border-bottom: dotted 1px #CCC;
}
.multiSelectOptions LABEL.hover {
	background-color: #ffcc99;
	color: #000;
}
</style>
<?php echo $column_left; ?>
<div id="content">
<form method="post" action="index.php?route=report/adv_sale_profit&token=<?php echo $token; ?>" id="report" name="report">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right" style="white-space:nowrap;"><span style="padding-top:5px; padding-right:5px; font-size:11px; color:#666; text-align:right;"><?php echo $heading_version; ?></span></div>    
      <h1 class="panel-title"><i class="fa fa-bar-chart"></i> <?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>      
    </div>
  </div>
  <div class="container-fluid">
    <div class="panel panel-default">
      <div class="panel-heading">
      <div align="right">
      	  <?php echo $entry_report; ?>&nbsp;
          <select name="filter_report" id="filter_report" onchange="$('#report').submit();" class="styled-select-type"> 
              <?php foreach ($report as $report) { ?>
              <?php if ($report['value'] == $filter_report) { ?>
              <option value="<?php echo $report['value']; ?>" title="<?php echo $report['text']; ?>" selected="selected"><?php echo $report['text']; ?></option>
              <?php } else { ?>
              <option value="<?php echo $report['value']; ?>" title="<?php echo $report['text']; ?>"><?php echo $report['text']; ?></option>
              <?php } ?>
              <?php } ?>
          </select>&nbsp;&nbsp;  
      	  <?php echo $entry_group; ?>&nbsp;
          <select name="filter_group" class="styled-select" <?php echo ($filter_details == 4 or $filter_report != 'sales_summary') ? 'disabled="disabled"' : '' ?>> 
			<?php foreach ($groups as $group) { ?>
			<?php if ($group['value'] == $filter_group) { ?>
			<option value="<?php echo $group['value']; ?>" selected="selected"><?php echo $group['text']; ?></option>
			<?php } else { ?>
			<option value="<?php echo $group['value']; ?>"><?php echo $group['text']; ?></option>
			<?php } ?>
			<?php } ?>
          	<?php if ($filter_details == 4 or $filter_report != 'sales_summary') { ?>
			<option selected="selected">----</option>
			<?php } ?>             
          </select>&nbsp;&nbsp; 
          <?php echo $entry_sort_by; ?>&nbsp;
		  <select name="filter_sort" class="styled-select" <?php echo ($filter_details == 4) ? 'disabled="disabled"' : '' ?>>
		  	<?php if ($filter_report == 'sales_summary') { ?>
                <?php if (!$filter_sort or $filter_sort == 'type') { ?>
            	<option value="type" selected="selected"><?php echo $column_date; ?></option>
            	<?php } else { ?>
            	<option value="type"><?php echo $column_date; ?></option>
                <?php } ?>           
		  	<?php } elseif ($filter_report == 'day_of_week') { ?>
                <?php if (!$filter_sort or $filter_sort == 'type') { ?>
            	<option value="type" selected="selected"><?php echo $column_day_of_week; ?></option>
            	<?php } else { ?>
            	<option value="type"><?php echo $column_day_of_week; ?></option>
                <?php } ?> 
		  	<?php } elseif ($filter_report == 'hour') { ?>
            	<?php if (!$filter_sort or $filter_sort == 'type') { ?>
            	<option value="type" selected="selected"><?php echo $column_hour; ?></option>
            	<?php } else { ?>
            	<option value="type"><?php echo $column_hour; ?></option>  
                <?php } ?> 
		  	<?php } elseif ($filter_report == 'store') { ?>
            	<?php if (!$filter_sort or $filter_sort == 'type') { ?>
            	<option value="type" selected="selected"><?php echo $column_store; ?></option>
            	<?php } else { ?>
            	<option value="type"><?php echo $column_store; ?></option>  
                <?php } ?>
		  	<?php } elseif ($filter_report == 'customer_group') { ?>
            	<?php if (!$filter_sort or $filter_sort == 'type') { ?>
            	<option value="type" selected="selected"><?php echo $column_customer_group; ?></option>
            	<?php } else { ?>
            	<option value="type"><?php echo $column_customer_group; ?></option>  
                <?php } ?>
		  	<?php } elseif ($filter_report == 'country') { ?>
            	<?php if (!$filter_sort or $filter_sort == 'type') { ?>
            	<option value="type" selected="selected"><?php echo $column_country; ?></option>
            	<?php } else { ?>
            	<option value="type"><?php echo $column_country; ?></option>  
                <?php } ?>
		  	<?php } elseif ($filter_report == 'postcode') { ?>
            	<?php if (!$filter_sort or $filter_sort == 'type') { ?>
            	<option value="type" selected="selected"><?php echo $column_postcode; ?></option>
            	<?php } else { ?>
            	<option value="type"><?php echo $column_postcode; ?></option>  
                <?php } ?>
		  	<?php } elseif ($filter_report == 'region_state') { ?>
            	<?php if (!$filter_sort or $filter_sort == 'type') { ?>
            	<option value="type" selected="selected"><?php echo $column_region_state; ?></option>
            	<?php } else { ?>
            	<option value="type"><?php echo $column_region_state; ?></option>  
                <?php } ?>
		  	<?php } elseif ($filter_report == 'city') { ?>
            	<?php if (!$filter_sort or $filter_sort == 'type') { ?>
            	<option value="type" selected="selected"><?php echo $column_city; ?></option>
            	<?php } else { ?>
            	<option value="type"><?php echo $column_city; ?></option>  
                <?php } ?>
		  	<?php } elseif ($filter_report == 'payment_method') { ?>
            	<?php if (!$filter_sort or $filter_sort == 'type') { ?>
            	<option value="type" selected="selected"><?php echo $column_payment_method; ?></option>
            	<?php } else { ?>
            	<option value="type"><?php echo $column_payment_method; ?></option>  
                <?php } ?> 
		  	<?php } elseif ($filter_report == 'shipping_method') { ?>
            	<?php if (!$filter_sort or $filter_sort == 'type') { ?>
            	<option value="type" selected="selected"><?php echo $column_shipping_method; ?></option>
            	<?php } else { ?>
            	<option value="type"><?php echo $column_shipping_method; ?></option>  
                <?php } ?>                                                                                                                                       
		  	<?php } ?>
            <?php if ($filter_sort == 'orders') { ?>
            <option value="orders" selected="selected"><?php echo $column_orders; ?></option>
            <?php } else { ?>
            <option value="orders"><?php echo $column_orders; ?></option>
            <?php } ?>            
            <?php if ($filter_sort == 'customers') { ?>
            <option value="customers" selected="selected"><?php echo $column_customers; ?></option>
            <?php } else { ?>
            <option value="customers"><?php echo $column_customers; ?></option>
            <?php } ?>
            <?php if ($filter_sort == 'products') { ?>
            <option value="products" selected="selected"><?php echo $column_products; ?></option>
            <?php } else { ?>
            <option value="products"><?php echo $column_products; ?></option>
            <?php } ?>
            <?php if ($filter_sort == 'sub_total') { ?>
            <option value="sub_total" selected="selected"><?php echo $column_sub_total; ?></option>
            <?php } else { ?>
            <option value="sub_total"><?php echo $column_sub_total; ?></option>
            <?php } ?> 
            <?php if ($filter_sort == 'shipping') { ?>
            <option value="shipping" selected="selected"><?php echo $column_shipping; ?></option>
            <?php } else { ?>
            <option value="shipping"><?php echo $column_shipping; ?></option>
            <?php } ?> 
            <?php if ($filter_sort == 'reward') { ?>
            <option value="reward" selected="selected"><?php echo $column_reward; ?></option>
            <?php } else { ?>
            <option value="reward"><?php echo $column_reward; ?></option>
            <?php } ?>             
            <?php if ($filter_sort == 'coupon') { ?>
            <option value="coupon" selected="selected"><?php echo $column_coupon; ?></option>
            <?php } else { ?>
            <option value="coupon"><?php echo $column_coupon; ?></option>
            <?php } ?> 
            <?php if ($filter_sort == 'tax') { ?>
            <option value="tax" selected="selected"><?php echo $column_tax; ?></option>
            <?php } else { ?>
            <option value="tax"><?php echo $column_tax; ?></option>
            <?php } ?> 
            <?php if ($filter_sort == 'credit') { ?>
            <option value="credit" selected="selected"><?php echo $column_credit; ?></option>
            <?php } else { ?>
            <option value="credit"><?php echo $column_credit; ?></option>
            <?php } ?>
            <?php if ($filter_sort == 'voucher') { ?>
            <option value="voucher" selected="selected"><?php echo $column_voucher; ?></option>
            <?php } else { ?>
            <option value="voucher"><?php echo $column_voucher; ?></option>
            <?php } ?>              
            <?php if ($filter_sort == 'total') { ?>
            <option value="total" selected="selected"><?php echo $column_total; ?></option>
            <?php } else { ?>
            <option value="total"><?php echo $column_total; ?></option>
            <?php } ?>   
            <?php if ($filter_sort == 'total_sales') { ?>
            <option value="total_sales" selected="selected"><?php echo $column_sales; ?></option>
            <?php } else { ?>
            <option value="total_sales"><?php echo $column_sales; ?></option>
            <?php } ?>  
            <?php if ($filter_sort == 'prod_costs') { ?>
            <option value="prod_costs" selected="selected"><?php echo $column_product_costs; ?></option>
            <?php } else { ?>
            <option value="prod_costs"><?php echo $column_product_costs; ?></option>
            <?php } ?>
            <?php if ($filter_sort == 'commission') { ?>
            <option value="commission" selected="selected"><?php echo $column_commission; ?></option>
            <?php } else { ?>
            <option value="commission"><?php echo $column_commission; ?></option>
            <?php } ?>    
            <?php if ($filter_sort == 'pay_costs') { ?>
            <option value="pay_costs" selected="selected"><?php echo $column_payment_cost; ?></option>
            <?php } else { ?>
            <option value="pay_costs"><?php echo $column_payment_cost; ?></option>
            <?php } ?>   
            <?php if ($filter_sort == 'ship_costs') { ?>
            <option value="ship_costs" selected="selected"><?php echo $column_shipping_cost; ?></option>
            <?php } else { ?>
            <option value="ship_costs"><?php echo $column_shipping_cost; ?></option>
            <?php } ?>
            <?php if ($filter_sort == 'ship_balance') { ?>
            <option value="ship_balance" selected="selected"><?php echo $column_shipping_balance; ?></option>
            <?php } else { ?>
            <option value="ship_balance"><?php echo $column_shipping_balance; ?></option>
            <?php } ?>                                                                       
            <?php if ($filter_sort == 'total_costs') { ?>
            <option value="total_costs" selected="selected"><?php echo $column_total_costs; ?></option>
            <?php } else { ?>
            <option value="total_costs"><?php echo $column_total_costs; ?></option>
            <?php } ?>    
            <?php if ($filter_sort == 'profit') { ?>
            <option value="profit" selected="selected"><?php echo $column_net_profit; ?></option>
            <?php } else { ?>
            <option value="profit"><?php echo $column_net_profit; ?></option>
            <?php } ?>
            <?php if ($filter_sort == 'profit_margin') { ?>
            <option value="profit_margin" selected="selected"><?php echo $column_profit_margin; ?></option>
            <?php } else { ?>
            <option value="profit_margin"><?php echo $column_profit_margin; ?></option>
            <?php } ?>
          	<?php if ($filter_details == 4) { ?>
			<option selected="selected">----</option>
			<?php } ?>             
          </select>&nbsp;&nbsp;
          <?php echo $entry_show_details; ?>&nbsp;
		  <select name="filter_details" class="styled-select">                      
            <?php if (!$filter_details or $filter_details == '0') { ?>
            <option value="0" selected="selected"><?php echo $text_no_details; ?></option>
            <?php } else { ?>
            <option value="0"><?php echo $text_no_details; ?></option>
            <?php } ?>
            <?php if ($filter_details == '1') { ?>
            <option value="1" selected="selected"><?php echo $text_order_list; ?></option>
            <?php } else { ?>
            <option value="1"><?php echo $text_order_list; ?></option>
            <?php } ?>
            <?php if ($filter_details == '2') { ?>
            <option value="2" selected="selected"><?php echo $text_product_list; ?></option>
            <?php } else { ?>
            <option value="2"><?php echo $text_product_list; ?></option>
            <?php } ?>
            <?php if ($filter_details == '3') { ?>
            <option value="3" selected="selected"><?php echo $text_customer_list; ?></option>
            <?php } else { ?>
            <option value="3"><?php echo $text_customer_list; ?></option>
            <?php } ?>
            <?php if ($filter_details == '4') { ?>
            <option value="4" selected="selected"><?php echo $text_all_details; ?></option>
            <?php } else { ?>
            <option value="4"><?php echo $text_all_details; ?></option>
            <?php } ?>
          </select>&nbsp;&nbsp; 
          <?php echo $entry_limit; ?>&nbsp;
		  <select name="filter_limit" class="styled-select"> 
            <?php if ($filter_limit == '10') { ?>
            <option value="10" selected="selected">10</option>
            <?php } else { ?>
            <option value="10">10</option>
            <?php } ?>                                
            <?php if (!$filter_limit or $filter_limit == '25') { ?>
            <option value="25" selected="selected">25</option>
            <?php } else { ?>
            <option value="25">25</option>
            <?php } ?>
            <?php if ($filter_limit == '50') { ?>
            <option value="50" selected="selected">50</option>
            <?php } else { ?>
            <option value="50">50</option>
            <?php } ?>
            <?php if ($filter_limit == '100') { ?>
            <option value="100" selected="selected">100</option>
            <?php } else { ?>
            <option value="100">100</option>
            <?php } ?>                        
          </select>&nbsp; <button onclick="$('#report').submit();" type="button" title="<?php echo $button_filter; ?>" class="btn btn-primary"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>&nbsp;<button id="show_tab_export" type="button" title="<?php echo $button_export; ?>" class="btn btn-success"><i class="fa fa-save"></i> <?php echo $button_export; ?></button>&nbsp;<?php if ($orders) { ?><?php if ((($filter_report == 'day_of_week' or $filter_report == 'hour' or $filter_report == 'store' or $filter_report == 'customer_group' or $filter_report == 'country' or $filter_report == 'payment_method' or $filter_report == 'shipping_method') && $filter_details != '4') or ($filter_report == 'sales_summary' && $filter_details != '4' && ($filter_group == 'year' or $filter_group == 'quarter' or $filter_group == 'month'))) { ?><button id="show_tab_chart" type="button" title="<?php echo $button_chart; ?>" class="btn btn-danger"><i class="fa fa-bar-chart"></i> <?php echo $button_chart; ?></button><?php } ?><?php } ?>&nbsp;<button data-toggle="modal" data-target="#myModal" type="button" title="<?php echo $button_settings; ?>" class="btn btn-set"><i class="fa fa-cog"></i> <?php echo $button_settings; ?></button>&nbsp;<button onclick="window.open('http://www.opencartreports.com/documentation/sop/index.html');" type="button" title="<?php echo $button_documentation; ?>" class="btn btn-warning"><i class="fa fa-list"></i> <?php echo $button_documentation; ?></button>
	</div>
	</div>
    <div class="panel-body">
<script type="text/javascript"><!--
$(document).ready(function() {
var prev = {start: 0, stop: 0},
    cont = $('#pagination_content #element');
	
$('.pagination_report').paging(cont.length, {
	format: '[< ncnnn! >]',
	perpage: '<?php echo $filter_limit; ?>',	
	lapping: 0,
	page: null, // we await hashchange() event
			onSelect: function() {

				var data = this.slice;

				cont.slice(prev[0], prev[1]).css('display', 'none');
				cont.slice(data[0], data[1]).fadeIn(0);

				prev = data;

				return true; // locate!
			},
			onFormat: function (type) {

				switch (type) {

					case 'block':

						if (!this.active)
							return '<span class="disabled">' + this.value + '</span>';
						else if (this.value != this.page)
							return '<em><a href="index.php?route=report/adv_sale_profit&token=<?php echo $token; ?>#' + this.value + '">' + this.value + '</a></em>';
						return '<span class="current">' + this.value + '</span>';

					case 'next':

						if (this.active) {
							return '<a href="index.php?route=report/adv_sale_profit&token=<?php echo $token; ?>#' + this.value + '" class="next">Next &gt;</a>';
						}
						return '';						

					case 'prev':

						if (this.active) {
							return '<a href="index.php?route=report/adv_sale_profit&token=<?php echo $token; ?>#' + this.value + '" class="prev">&lt; Previous</a>';
						}	
						return '';						

					case 'first':

						if (this.active) {
							return '<?php echo $text_pagin_page; ?> ' + this.page + ' <?php echo $text_pagin_of; ?> ' + this.pages + '&nbsp;&nbsp;<a href="index.php?route=report/adv_sale_profit&token=<?php echo $token; ?>#' + this.value + '" class="first">|&lt;</a>';
						}	
						return '<?php echo $text_pagin_page; ?> ' + this.page + ' <?php echo $text_pagin_of; ?> ' + this.pages + '&nbsp;&nbsp';
							
					case 'last':

						if (this.active) {
							return '<a href="index.php?route=report/adv_sale_profit&token=<?php echo $token; ?>#' + this.value + '" class="prev">&gt;|</a>&nbsp;&nbsp;(' + cont.length + ' <?php echo $text_pagin_results; ?>)';
						}
						return '&nbsp;&nbsp;(' + cont.length + ' <?php echo $text_pagin_results; ?>)';					

				}
				return ''; // return nothing for missing branches
			}
});
});		
//--></script>         
<script type="text/javascript"><!--
function getStorage(key_prefix) {
    // this function will return us an object with a "set" and "get" method
    if (window.localStorage) {
        // use localStorage:
        return {
            set: function(id, data) {
                localStorage.setItem(key_prefix+id, data);
            },
            get: function(id) {
                return localStorage.getItem(key_prefix+id);
            }
        };
    }
}

$(document).ready(function() {
    // a key must is used for the cookie/storage
    var storedData = getStorage('com_mysite_checkboxes_'); 
    
    $('div.check input:checkbox').bind('change',function(){
        $('#'+this.id+'_filter').toggle($(this).is(':checked'));
        $('#'+this.id+'_title').toggle($(this).is(':checked'));
			<?php if ($orders) {
					foreach ($orders as $key => $order) {
						echo "$('#'+this.id+'_" . $order['order_id'] . "_title').toggle($(this).is(':checked')); ";
						echo "$('#'+this.id+'_" . $order['order_id'] . "').toggle($(this).is(':checked')); ";						
					}			
			} 
			;?>		
        $('#'+this.id+'_total').toggle($(this).is(':checked'));			
        // save the data on change
        storedData.set(this.id, $(this).is(':checked')?'checked':'not');
    }).each(function() {
        // on load, set the value to what we read from storage:
        var val = storedData.get(this.id);
        if (val == 'checked') $(this).attr('checked', 'checked');
        if (val == 'not') $(this).removeAttr('checked');
        if (val) $(this).trigger('change');
    });
});
//--></script>
<div class="modal bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#ffcc99;">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title"><?php echo $button_settings; ?></h4>
      </div>
      <div class="modal-body">
<div class="check">
<table align="center" cellspacing="0" cellpadding="0">   
    <tr><td>
    <table width="100%" cellspacing="0" cellpadding="0" style="background:#FFEFDF; border:1px solid #CCCCCC; padding:3px;"> 
    <tr><td width="1%" nowrap="nowrap">&nbsp;<?php echo $text_formula_setting1; ?> &nbsp;</td>
    <td width="1%" nowrap="nowrap"><select name="adv_profit_reports_formula_sop1" class="styled-select-range">
    <?php if ($adv_profit_reports_formula_sop1) { ?>
	<option value="1" selected="selected"><?php echo $text_yes; ?></option>
	<option value="0"><?php echo $text_no; ?></option>
	<?php } else { ?>
	<option value="1"><?php echo $text_yes; ?></option>
	<option value="0" selected="selected"><?php echo $text_no; ?></option>
	<?php } ?>
	</select></td>
    <td rowspan="3" align="center">
        <button type="button" onclick="$('#report').submit();" class="btn btn-primary" data-dismiss="modal"><?php echo $button_save; ?></button>
        <button type="button" onclick="location = '<?php echo $settings; ?>'" class="btn btn-warning"><?php echo $button_module_settings; ?></button></td></tr> 
    <tr><td width="1%" nowrap="nowrap">&nbsp;<?php echo $text_formula_setting2; ?> &nbsp;</td>
    <td width="1%" nowrap="nowrap"><select name="adv_profit_reports_formula_sop2" class="styled-select-range">
    <?php if ($adv_profit_reports_formula_sop2) { ?>
	<option value="1" selected="selected"><?php echo $text_yes; ?></option>
	<option value="0"><?php echo $text_no; ?></option>
	<?php } else { ?>
	<option value="1"><?php echo $text_yes; ?></option>
	<option value="0" selected="selected"><?php echo $text_no; ?></option>
	<?php } ?>
	</select></td></tr> 
    <tr><td width="1%" nowrap="nowrap">&nbsp;<?php echo $text_formula_setting3; ?> &nbsp;</td>
    <td width="1%" nowrap="nowrap"><select name="adv_profit_reports_formula_sop3" class="styled-select-range">
    <?php if ($adv_profit_reports_formula_sop3) { ?>
	<option value="1" selected="selected"><?php echo $text_yes; ?></option>
	<option value="0"><?php echo $text_no; ?></option>
	<?php } else { ?>
	<option value="1"><?php echo $text_yes; ?></option>
	<option value="0" selected="selected"><?php echo $text_no; ?></option>
	<?php } ?>
	</select></td></tr> 
    </table>
    </td></tr> 
    <tr><td><br />
      &nbsp;<span style="font-size:14px; font-weight:bold;"><?php echo $text_filtering_options; ?></span><br />        
      <table width="100%" cellspacing="0" cellpadding="3" style="background:#E7EFEF; border:1px solid #DDDDDD; margin-top:3px;">
        <tr>
          <td>
			<div class="columns_setting"><input id="sop2" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo substr($entry_store,0,-1); ?></div>
			<div class="columns_setting"><input id="sop3" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo substr($entry_currency,0,-1); ?></div>
			<div class="columns_setting"><input id="sop4a" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo substr($entry_tax,0,-1); ?></div>
			<div class="columns_setting"><input id="sop4c" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo substr($entry_tax_classes,0,-1); ?></div>
			<div class="columns_setting"><input id="sop4b" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo substr($entry_geo_zone,0,-1); ?></div>
			<div class="columns_setting"><input id="sop5" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo substr($entry_customer_group,0,-1); ?></div>
			<div class="columns_setting"><input id="sop7" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo substr($entry_customer_name,0,-1); ?></div>
			<div class="columns_setting"><input id="sop8a" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo substr($entry_customer_email,0,-1); ?></div>
			<div class="columns_setting"><input id="sop8b" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo substr($entry_customer_telephone,0,-1); ?></div>
            <div class="columns_setting"><input id="sop8c" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo substr($entry_ip,0,-1); ?></div>
			<div class="columns_setting"><input id="sop17a" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo substr($entry_payment_company,0,-1); ?></div>
			<div class="columns_setting"><input id="sop17b" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo substr($entry_payment_address,0,-1); ?></div>
			<div class="columns_setting"><input id="sop17c" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo substr($entry_payment_city,0,-1); ?></div>
			<div class="columns_setting"><input id="sop17d" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo substr($entry_payment_zone,0,-1); ?></div>
			<div class="columns_setting"><input id="sop17e" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo substr($entry_payment_postcode,0,-1); ?></div>
            <div class="columns_setting"><input id="sop17f" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo substr($entry_payment_country,0,-1); ?></div>
            <div class="columns_setting"><input id="sop13" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo substr($entry_payment_method,0,-1); ?></div>
			<div class="columns_setting"><input id="sop16a" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo substr($entry_shipping_company,0,-1); ?></div>
			<div class="columns_setting"><input id="sop16b" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo substr($entry_shipping_address,0,-1); ?></div>
			<div class="columns_setting"><input id="sop16c" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo substr($entry_shipping_city,0,-1); ?></div>
			<div class="columns_setting"><input id="sop16d" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo substr($entry_shipping_zone,0,-1); ?></div>
			<div class="columns_setting"><input id="sop16e" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo substr($entry_shipping_postcode,0,-1); ?></div>
			<div class="columns_setting"><input id="sop16f" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo substr($entry_shipping_country,0,-1); ?></div>
            <div class="columns_setting"><input id="sop14" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo substr($entry_shipping_method,0,-1); ?></div>
			<div class="columns_setting"><input id="sop9d" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo substr($entry_category,0,-1); ?></div>
            <div class="columns_setting"><input id="sop9e" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo substr($entry_manufacturer,0,-1); ?></div>
            <div class="columns_setting"><input id="sop9a" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo substr($entry_sku,0,-1); ?></div>
            <div class="columns_setting"><input id="sop9b" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo substr($entry_product,0,-1); ?></div>
            <div class="columns_setting"><input id="sop9c" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo substr($entry_model,0,-1); ?></div>
            <div class="columns_setting"><input id="sop10" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo substr($entry_option,0,-1); ?></div>
            <div class="columns_setting"><input id="sop18" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo substr($entry_attributes,0,-1); ?></div>
            <div class="columns_setting"><input id="sop11" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo substr($entry_location,0,-1); ?></div>
            <div class="columns_setting"><input id="sop12a" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo substr($entry_affiliate_name,0,-1); ?></div>
            <div class="columns_setting"><input id="sop12b" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo substr($entry_affiliate_email,0,-1); ?></div>
            <div class="columns_setting"><input id="sop15a" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo substr($entry_coupon_name,0,-1); ?></div>
            <div class="columns_setting"><input id="sop15b" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo substr($entry_coupon_code,0,-1); ?></div>
            <div class="columns_setting"><input id="sop19" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo substr($entry_voucher_code,0,-1); ?></div>
          </td>                                                                                                                        
        </tr>        
      </table><br />         
      &nbsp;<span style="font-size:14px; font-weight:bold;"><?php echo $text_column_settings; ?></span><br />  
      <table width="100%" cellspacing="0" cellpadding="3" style="background:#E5E5E5; border:1px solid #DDDDDD; margin-top:3px;">
        <tr>
          <td>
            &nbsp;<span style="font-size:11px; font-weight:bold;"><?php echo $text_mv_columns; ?></span><br />           
			<div class="columns_setting"><input id="sop20" name="sop20" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_orders; ?></div>
			<div class="columns_setting"><input id="sop21" name="sop21" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_customers; ?></div>
			<div class="columns_setting"><input id="sop22" name="sop22" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_products; ?></div>
			<div class="columns_setting"><input id="sop23" name="sop23" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_sub_total; ?></div>
			<div class="columns_setting"><input id="sop24" name="sop24" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_handling; ?></div>
			<div class="columns_setting"><input id="sop25" name="sop25" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_loworder; ?></div>
			<div class="columns_setting"><input id="sop27" name="sop27" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_shipping; ?></div>
			<div class="columns_setting"><input id="sop26" name="sop26" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_reward; ?></div>
            <div class="columns_setting"><input id="sop28" name="sop28" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_coupon; ?></div>
            <div class="columns_setting"><input id="sop29" name="sop29" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_tax; ?></div>
            <div class="columns_setting"><input id="sop30" name="sop30" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_credit; ?></div>
            <div class="columns_setting"><input id="sop31" name="sop31" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_voucher; ?></div>
            <div class="columns_setting"><input id="sop33" name="sop33" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_total; ?></div>   
			<div class="columns_setting"><input id="sop37" name="sop37" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_sales; ?></div>
            <div class="columns_setting"><input id="sop34" name="sop34" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_product_costs; ?></div>
            <div class="columns_setting"><input id="sop32" name="sop32" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_commission; ?></div>
			<div class="columns_setting"><input id="sop391" name="sop391" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_payment_cost; ?></div>
			<div class="columns_setting"><input id="sop392" name="sop392" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_shipping_cost; ?></div>  
			<div class="columns_setting"><input id="sop393" name="sop393" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_shipping_balance; ?></div>
            <div class="columns_setting"><input id="sop38" name="sop38" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_total_costs; ?></div>
            <div class="columns_setting"><input id="sop35" name="sop35" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_net_profit; ?></div>
            <div class="columns_setting"><input id="sop36" name="sop36" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_net_profit; ?> [%]</div>
          </td>                                                                                                                        
        </tr>
		<tr><td>
		<span style="font-size:11px; color:#390;">* <?php echo $text_export_note; ?></span>  
		</td></tr>          
      </table>
      <table width="100%" cellspacing="0" cellpadding="3" style="background:#F0F0F0; border:1px solid #DDDDDD; margin-top:3px;">
        <tr>
          <td>
            &nbsp;<span style="font-size:11px; font-weight:bold;"><?php echo $text_ol_columns; ?></span><br />            
			<div class="columns_setting"><input id="sop40" name="sop40" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_order_order_id; ?></div>
			<div class="columns_setting"><input id="sop41" name="sop41" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_order_date_added; ?></div>
			<div class="columns_setting"><input id="sop42" name="sop42" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_order_inv_no; ?></div>
			<div class="columns_setting"><input id="sop43" name="sop43" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_order_customer; ?></div>
			<div class="columns_setting"><input id="sop44" name="sop44" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_order_email; ?></div>
			<div class="columns_setting"><input id="sop45" name="sop45" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_order_customer_group; ?></div>
			<div class="columns_setting"><input id="sop46" name="sop46" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_order_shipping_method; ?></div>	
            <div class="columns_setting"><input id="sop47" name="sop47" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_order_payment_method; ?></div>
            <div class="columns_setting"><input id="sop48" name="sop48" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_order_status; ?></div>
            <div class="columns_setting"><input id="sop49" name="sop49" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_order_store; ?></div>
            <div class="columns_setting"><input id="sop50" name="sop50" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_order_currency; ?></div>
            <div class="columns_setting"><input id="sop51" name="sop51" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_order_quantity; ?></div>
            <div class="columns_setting"><input id="sop52" name="sop52" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_order_sub_total; ?></div>
            <div class="columns_setting"><input id="sop54" name="sop54" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_order_shipping; ?></div>
            <div class="columns_setting"><input id="sop55" name="sop55" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_order_tax; ?></div>
            <div class="columns_setting"><input id="sop56" name="sop56" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_order_value; ?></div>
            <div class="columns_setting"><input id="sop53" name="sop53" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_order_sales; ?></div>
            <div class="columns_setting"><input id="sop57" name="sop57" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_order_costs; ?></div>
            <div class="columns_setting"><input id="sop58" name="sop58" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_order_profit; ?></div>
            <div class="columns_setting"><input id="sop59" name="sop59" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_order_profit; ?> [%]</div>
          </td>                                                                                                                        
        </tr>
		<tr><td>
		<span style="font-size:11px; color:#390;">* <?php echo $text_export_note; ?> - <strong><?php echo strip_tags($text_export_order_list); ?></strong></span>  
		</td></tr>          
      </table>
      <table width="100%" cellspacing="0" cellpadding="3" style="background:#F0F0F0; border:1px solid #DDDDDD; margin-top:3px;">
        <tr>
          <td>
            &nbsp;<span style="font-size:11px; font-weight:bold;"><?php echo $text_pl_columns; ?></span><br />              
			<div class="columns_setting"><input id="sop60" name="sop60" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_prod_order_id; ?></div>
			<div class="columns_setting"><input id="sop61" name="sop61" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_prod_date_added; ?></div>
			<div class="columns_setting"><input id="sop62" name="sop62" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_prod_inv_no; ?></div>
			<div class="columns_setting"><input id="sop63" name="sop63" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_prod_id; ?></div>
			<div class="columns_setting"><input id="sop64" name="sop64" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_prod_sku; ?></div>
			<div class="columns_setting"><input id="sop65" name="sop65" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_prod_model; ?></div>
			<div class="columns_setting"><input id="sop66" name="sop66" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_prod_name; ?></div>
			<div class="columns_setting"><input id="sop67" name="sop67" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_prod_option; ?></div>
			<div class="columns_setting"><input id="sop77" name="sop77" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_prod_attributes; ?></div>
            <div class="columns_setting"><input id="sop68" name="sop68" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_prod_manu; ?></div> 
            <div class="columns_setting"><input id="sop79" name="sop79" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_prod_category; ?></div>
            <div class="columns_setting"><input id="sop69" name="sop69" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_prod_currency; ?></div>
            <div class="columns_setting"><input id="sop70" name="sop70" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_prod_price; ?></div>
            <div class="columns_setting"><input id="sop71" name="sop71" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_prod_quantity; ?></div>
            <div class="columns_setting"><input id="sop72a" name="sop72a" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_prod_total_excl_vat; ?></div>
            <div class="columns_setting"><input id="sop73" name="sop73" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_prod_tax; ?></div>
            <div class="columns_setting"><input id="sop72b" name="sop72b" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_prod_total_incl_vat; ?></div>
            <div class="columns_setting"><input id="sop72c" name="sop72c" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_prod_sales; ?></div>
            <div class="columns_setting"><input id="sop74" name="sop74" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_prod_costs; ?></div>
            <div class="columns_setting"><input id="sop75" name="sop75" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_prod_profit; ?></div>
            <div class="columns_setting"><input id="sop76" name="sop76" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_prod_profit; ?> [%]</div>
          </td>                                                                                                                        
        </tr>
		<tr><td>
		<span style="font-size:11px; color:#390;">* <?php echo $text_export_note; ?> - <strong><?php echo strip_tags($text_export_product_list); ?></strong></span>  
		</td></tr>          
      </table>
      <table width="100%" cellspacing="0" cellpadding="3" style="background:#F0F0F0; border:1px solid #DDDDDD; margin-top:3px;">
        <tr>
          <td>
            &nbsp;<span style="font-size:11px; font-weight:bold;"><?php echo $text_cl_columns; ?></span><br />             
			<div class="columns_setting"><input id="sop80" name="sop80" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_customer_order_id; ?></div>
			<div class="columns_setting"><input id="sop81" name="sop81" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_customer_date_added; ?></div>
			<div class="columns_setting"><input id="sop82" name="sop82" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_customer_inv_no; ?></div>
			<div class="columns_setting"><input id="sop83" name="sop83" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_customer_cust_id; ?></div>
			<div class="columns_setting"><input id="sop84" name="sop84" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo strip_tags($column_billing_name); ?></div>
			<div class="columns_setting"><input id="sop85" name="sop85" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo strip_tags($column_billing_company); ?></div>
			<div class="columns_setting"><input id="sop86" name="sop86" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo strip_tags($column_billing_address_1); ?></div>
			<div class="columns_setting"><input id="sop87" name="sop87" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo strip_tags($column_billing_address_2); ?></div>			
            <div class="columns_setting"><input id="sop88" name="sop88" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo strip_tags($column_billing_city); ?></div>
            <div class="columns_setting"><input id="sop89" name="sop89" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo strip_tags($column_billing_zone); ?></div>
            <div class="columns_setting"><input id="sop90" name="sop90" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo strip_tags($column_billing_postcode); ?></div>
            <div class="columns_setting"><input id="sop91" name="sop91" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo strip_tags($column_billing_country); ?></div>
            <div class="columns_setting"><input id="sop92" name="sop92" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_customer_telephone; ?></div>
			<div class="columns_setting"><input id="sop93" name="sop93" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo strip_tags($column_shipping_name); ?></div>
			<div class="columns_setting"><input id="sop94" name="sop94" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo strip_tags($column_shipping_company); ?></div>
			<div class="columns_setting"><input id="sop95" name="sop95" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo strip_tags($column_shipping_address_1); ?></div>
			<div class="columns_setting"><input id="sop96" name="sop96" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo strip_tags($column_shipping_address_2); ?></div>
            <div class="columns_setting"><input id="sop97" name="sop97" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo strip_tags($column_shipping_city); ?></div>
            <div class="columns_setting"><input id="sop98" name="sop98" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo strip_tags($column_shipping_zone); ?></div>
            <div class="columns_setting"><input id="sop99" name="sop99" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo strip_tags($column_shipping_postcode); ?></div>
            <div class="columns_setting"><input id="sop100" name="sop100" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo strip_tags($column_shipping_country); ?></div>
          </td>                                                                                                                        
        </tr>
		<tr><td>
		<span style="font-size:11px; color:#390;">* <?php echo $text_export_note; ?> - <strong><?php echo strip_tags($text_export_customer_list); ?></strong></span>  
		</td></tr>         
      </table>
      <table width="100%" cellspacing="0" cellpadding="3" style="background:#F0F0F0; border:1px solid #DDDDDD; margin-top:3px;">
        <tr>
          <td>
            &nbsp;<span style="font-size:11px; font-weight:bold;"><?php echo $text_all_columns; ?></span><br />
			<div class="columns_setting"><input id="sop1000" name="sop1000" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_order_inv_no; ?></div>
			<div class="columns_setting"><input id="sop1001" name="sop1001" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_order_customer_name; ?></div>
			<div class="columns_setting"><input id="sop1002" name="sop1002" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_order_email; ?></div>
			<div class="columns_setting"><input id="sop1003" name="sop1003" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_order_customer_group; ?></div>
			<div class="columns_setting"><input id="sop1004" name="sop1004" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_prod_id; ?></div>
			<div class="columns_setting"><input id="sop1005" name="sop1005" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_prod_sku; ?></div>
			<div class="columns_setting"><input id="sop1006" name="sop1006" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_prod_model; ?></div>
			<div class="columns_setting"><input id="sop1007" name="sop1007" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_prod_name; ?></div>
			<div class="columns_setting"><input id="sop1008" name="sop1008" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_prod_option; ?></div>
			<div class="columns_setting"><input id="sop1009" name="sop1009" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_prod_attributes; ?></div>
			<div class="columns_setting"><input id="sop1010" name="sop1010" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_prod_manu; ?></div>
			<div class="columns_setting"><input id="sop1011" name="sop1011" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_prod_category; ?></div>            
			<div class="columns_setting"><input id="sop1012" name="sop1012" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_prod_currency; ?></div>
			<div class="columns_setting"><input id="sop1062" name="sop1062" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_order_quantity; ?></div>
			<div class="columns_setting"><input id="sop1013" name="sop1013" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_prod_price; ?></div>
			<div class="columns_setting"><input id="sop1014" name="sop1014" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_prod_quantity; ?></div>
            <div class="columns_setting"><input id="sop1016a" name="sop1016a" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_prod_total_excl_vat; ?></div>
            <div class="columns_setting"><input id="sop1015" name="sop1015" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_prod_tax; ?></div>            
            <div class="columns_setting"><input id="sop1016b" name="sop1016b" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_prod_total_incl_vat; ?></div>
            <div class="columns_setting"><input id="sop1016c" name="sop1016c" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_prod_sales; ?></div>            
            <div class="columns_setting"><input id="sop1017" name="sop1017" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_prod_costs; ?></div>
            <div class="columns_setting"><input id="sop1018" name="sop1018" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_prod_profit; ?></div>
            <div class="columns_setting"><input id="sop1019" name="sop1019" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_prod_profit; ?> [%]</div>
            <div class="columns_setting"><input id="sop1020" name="sop1020" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_sub_total; ?></div>
            <div class="columns_setting"><input id="sop1021" name="sop1021" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_handling; ?></div>
            <div class="columns_setting"><input id="sop1022" name="sop1022" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_loworder; ?></div>
            <div class="columns_setting"><input id="sop1023" name="sop1023" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_shipping; ?></div>
            <div class="columns_setting"><input id="sop1024" name="sop1024" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_reward; ?></div>
            <div class="columns_setting"><input id="sop1025" name="sop1025" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_coupon; ?></div>
            <div class="columns_setting"><input id="sop1026" name="sop1026" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_coupon_code; ?></div>
            <div class="columns_setting"><input id="sop1027" name="sop1027" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_order_tax; ?></div>
            <div class="columns_setting"><input id="sop1028" name="sop1028" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_credit; ?></div>
            <div class="columns_setting"><input id="sop1029" name="sop1029" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_voucher; ?></div>
            <div class="columns_setting"><input id="sop1030" name="sop1030" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_voucher_code; ?></div>
            <div class="columns_setting"><input id="sop1031" name="sop1031" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_order_value; ?></div>
            <div class="columns_setting"><input id="sop1032" name="sop1032" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_order_sales; ?></div>
            <div class="columns_setting"><input id="sop1033" name="sop1033" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_order_prod_costs; ?></div>
            <div class="columns_setting"><input id="sop1034" name="sop1034" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_order_commission; ?></div>
            <div class="columns_setting"><input id="sop1035" name="sop1035" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_order_payment_cost; ?></div>
            <div class="columns_setting"><input id="sop1036" name="sop1036" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_order_shipping_cost; ?></div>
            <div class="columns_setting"><input id="sop1063" name="sop1063" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_shipping_balance; ?></div>
			<div class="columns_setting"><input id="sop1037" name="sop1037" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_order_costs; ?></div>
            <div class="columns_setting"><input id="sop1038" name="sop1038" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_order_profit; ?></div>
            <div class="columns_setting"><input id="sop1039" name="sop1039" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_order_profit; ?> [%]</div>
			<div class="columns_setting"><input id="sop1040" name="sop1040" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_order_shipping_method; ?></div>
			<div class="columns_setting"><input id="sop1041" name="sop1041" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_order_payment_method; ?></div>
			<div class="columns_setting"><input id="sop1042" name="sop1042" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_order_status; ?></div>
			<div class="columns_setting"><input id="sop1043" name="sop1043" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_order_store; ?></div>
			<div class="columns_setting"><input id="sop1044" name="sop1044" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_customer_cust_id; ?></div>
			<div class="columns_setting"><input id="sop1045" name="sop1045" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo strip_tags($column_billing_name); ?></div>
			<div class="columns_setting"><input id="sop1046" name="sop1046" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo strip_tags($column_billing_company); ?></div>
			<div class="columns_setting"><input id="sop1047" name="sop1047" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo strip_tags($column_billing_address_1); ?></div>
			<div class="columns_setting"><input id="sop1048" name="sop1048" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo strip_tags($column_billing_address_2); ?></div>
            <div class="columns_setting"><input id="sop1049" name="sop1049" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo strip_tags($column_billing_city); ?></div>
            <div class="columns_setting"><input id="sop1050" name="sop1050" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo strip_tags($column_billing_zone); ?></div>
            <div class="columns_setting"><input id="sop1051" name="sop1051" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo strip_tags($column_billing_postcode); ?></div>
            <div class="columns_setting"><input id="sop1052" name="sop1052" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo strip_tags($column_billing_country); ?></div>
            <div class="columns_setting"><input id="sop1053" name="sop1053" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_customer_telephone; ?></div>
			<div class="columns_setting"><input id="sop1054" name="sop1054" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo strip_tags($column_shipping_name); ?></div>
			<div class="columns_setting"><input id="sop1055" name="sop1055" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo strip_tags($column_shipping_company); ?></div>
			<div class="columns_setting"><input id="sop1056" name="sop1056" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo strip_tags($column_shipping_address_1); ?></div>
			<div class="columns_setting"><input id="sop1057" name="sop1057" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo strip_tags($column_shipping_address_2); ?></div>
            <div class="columns_setting"><input id="sop1058" name="sop1058" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo strip_tags($column_shipping_city); ?></div>
            <div class="columns_setting"><input id="sop1059" name="sop1059" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo strip_tags($column_shipping_zone); ?></div>
            <div class="columns_setting"><input id="sop1060" name="sop1060" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo strip_tags($column_shipping_postcode); ?></div>
            <div class="columns_setting"><input id="sop1061" name="sop1061" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo strip_tags($column_shipping_country); ?></div>
            <div class="columns_setting"><input id="sop1064" name="sop1064" checked="checked" type="checkbox" style="vertical-align: text-top;"> <?php echo $column_order_comment; ?></div>
          </td>                                                                                                                        
        </tr>
		<tr><td>
		<span style="font-size:11px; color:#390;">* <?php echo $text_export_note; ?> - <strong><?php echo strip_tags($text_export_all_details); ?></strong></span>  
		</td></tr>         
      </table>     
	</td></tr>              
</table>     
</div>
      </div>
    </div>
  </div>
</div> 
<script type="text/javascript"><!--
$("input[type='checkbox']").change(function() {
    if ($(this).is(":checked")) {
        $(this).parent().removeClass("set_unchecked"); 
    } else {
        $(this).parent().addClass("set_unchecked");  
    }
});
//--></script>  
<script type="text/javascript">$(function(){ 
$('#show_tab_export').click(function() {
		$('#tab_export').slideToggle('fast');
	});
});
</script>    
  <div id="tab_export" style="background:#E7EFEF; border:1px solid #C6D7D7; padding:3px; margin-bottom:10px; -moz-border-radius: 3px; border-radius: 3px; display:none">
      <table width="100%" cellspacing="0" cellpadding="3">
        <tr>
          <td width="6%">&nbsp;</td>
          <td width="23%" align="center" nowrap="nowrap">
          	<span id="export_xls" class="export_item"><img src="view/image/adv_reports/XLS.png" width="48" height="48" border="0" title="XLS (Excel 97/2000)" /></span>
            <span id="export_xlsx" class="export_item"><img src="view/image/adv_reports/XLSX.png" width="48" height="48" border="0" title="XLSX (Excel 2007/2010)" /></span>
            <span id="export_csv" class="export_item"><img src="view/image/adv_reports/CSV.png" width="48" height="48" border="0" title="CSV" /></span>
            <span id="export_html" class="export_item"><img src="view/image/adv_reports/HTML.png" width="48" height="48" border="0" title="HTML" /></span>
            <span id="export_pdf" class="export_item"><img src="view/image/adv_reports/PDF.png" width="48" height="48" border="0" title="PDF" /></span></td>
          <td width="23%" align="center" nowrap="nowrap">
          	<span id="export_xls_all_details" class="export_item"><img src="view/image/adv_reports/XLS.png" width="48" height="48" border="0" title="XLS (Excel 97/2000)" /></span>
            <span id="export_xlsx_all_details" class="export_item"><img src="view/image/adv_reports/XLSX.png" width="48" height="48" border="0" title="XLSX (Excel 2007/2010)" /></span>
          	<span id="export_csv_all_details" class="export_item"><img src="view/image/adv_reports/CSV.png" width="48" height="48" border="0" title="CSV" /></span>
          	<span id="export_html_all_details" class="export_item"><img src="view/image/adv_reports/HTML.png" width="48" height="48" border="0" title="HTML" /></span>
          	<span id="export_pdf_all_details" class="export_item"><img src="view/image/adv_reports/PDF.png" width="48" height="48" border="0" title="PDF" /></span></td>
          <td width="14%" align="center" nowrap="nowrap">
            <span id="export_html_order_list" class="export_item"><img src="view/image/adv_reports/HTML.png" width="48" height="48" border="0" title="HTML" /></span>
            <span id="export_pdf_order_list" class="export_item"><img src="view/image/adv_reports/PDF.png" width="48" height="48" border="0" title="PDF" /></span></td>
          <td width="14%" align="center" nowrap="nowrap">
            <span id="export_html_product_list" class="export_item"><img src="view/image/adv_reports/HTML.png" width="48" height="48" border="0" title="HTML" /></span>
            <span id="export_pdf_product_list" class="export_item"><img src="view/image/adv_reports/PDF.png" width="48" height="48" border="0" title="PDF" /></span></td>
          <td width="14%" align="center" nowrap="nowrap">
          	<span id="export_html_customer_list" class="export_item"><img src="view/image/adv_reports/HTML.png" width="48" height="48" border="0" title="HTML" /></span>
          	<span id="export_pdf_customer_list" class="export_item"><img src="view/image/adv_reports/PDF.png" width="48" height="48" border="0" title="PDF" /></span></td>
          <td width="6%">&nbsp;</td>
        </tr>
        <tr>
          <td width="6%">&nbsp;</td>
          <td width="23%" align="center" nowrap="nowrap"><?php echo $text_export_no_details; ?></td>
          <td width="23%" align="center" nowrap="nowrap"><?php echo $text_export_all_details; ?></td>          
          <td width="14%" align="center" nowrap="nowrap"><?php echo $text_export_order_list; ?></td>
          <td width="14%" align="center" nowrap="nowrap"><?php echo $text_export_product_list; ?></td>
          <td width="14%" align="center" nowrap="nowrap"><?php echo $text_export_customer_list; ?></td>
          <td width="6%">&nbsp;</td>
        </tr>     
        <tr>
          <td colspan="7">*<span style="font-size:10px"><?php echo $text_export_notice1; ?> <a href="http://www.opencartreports.com/documentation/sop/index.html#req_limit" target="_blank"><strong><?php echo $text_export_limit; ?></strong></a> <?php echo $text_export_notice2; ?></span></td>
        </tr>        
      </table>
  <input type="hidden" id="export" name="export" value="" />
  </div> 
<script type="text/javascript">
$(document).ready(function() {
var $filter_range = $('#filter_range'), $date_start = $('#date-start'), $date_end = $('#date-end');
$filter_range.change(function () {
    if ($filter_range.val() == 'custom') {
        $date_start.removeAttr('disabled');
        $date_end.removeAttr('disabled');
    } else {	
        $date_start.attr('disabled', 'disabled').val('');
        $date_end.attr('disabled', 'disabled').val('');
    }
}).trigger('change');
});
</script>   
<div style="background: #E7EFEF; border: 1px solid #C6D7D7; margin-bottom: 15px; -moz-border-radius: 3px; border-radius: 3px;">
	<table width="100%" cellspacing="0" cellpadding="3">
	<tr>
	<td>
	 <table cellspacing="0" cellpadding="0">
  	 <tr>
     <td style="background:#C6D7D7;">
	 <table align="right" border="0" cellspacing="0" cellpadding="0" style="margin:3px; background:#C6D7D7; border:1px solid #E7EFEF;">
	 <tr><td colspan="3" align="center"><span style="font-weight:bold; color:#333;"><?php echo $entry_order_created; ?></span></td></tr>
  	 <tr><td>
       <table cellpadding="0" cellspacing="0" style="margin:3px;">
       <tr><td align="left"><?php echo $entry_range; ?><br />    
            <select name="filter_range" id="filter_range" class="styled-select-range">
              <?php foreach ($ranges as $range) { ?>
              <?php if ($range['value'] == $filter_range) { ?>
              <option value="<?php echo $range['value']; ?>" title="<?php echo $range['text']; ?>" style="<?php echo $range['style']; ?>" selected="selected"><?php echo $range['text']; ?></option>
              <?php } else { ?>
              <option value="<?php echo $range['value']; ?>" title="<?php echo $range['text']; ?>" style="<?php echo $range['style']; ?>"><?php echo $range['text']; ?></option>
              <?php } ?>
              <?php } ?>
            </select>
       </td><td width="5"></td></tr></table>
     </td><td>      
       <table cellpadding="0" cellspacing="0" style="margin:3px;">
       <tr><td align="left">&nbsp;<?php echo $entry_date_start; ?><br />
          <input type="text" name="filter_date_start" value="<?php echo $filter_date_start; ?>" data-date-format="YYYY-MM-DD" id="date-start" size="12" class="styled-input-range" />
       </td><td width="5"></td></tr></table>
     </td><td>
       <table cellpadding="0" cellspacing="0" style="margin:3px;">
       <tr><td align="left">&nbsp;<?php echo $entry_date_end; ?><br />
          <input type="text" name="filter_date_end" value="<?php echo $filter_date_end; ?>" data-date-format="YYYY-MM-DD" id="date-end" size="12" class="styled-input-range" />
       </td><td></td></tr></table>
     </td></tr></table>  
     </td>
     <td align="center" style="background:#C6D7D7;">      
	 <table border="0" cellspacing="0" cellpadding="0" style="margin:3px; background:#C6D7D7; border:1px solid #E7EFEF;">
	 <tr><td colspan="3" align="center"><span style="font-weight:bold; color:#333;"><?php echo $entry_status_changed; ?></span></td></tr>
  	 <tr><td>
       <table cellpadding="0" cellspacing="0" style="margin:3px;">
       <tr><td align="left">&nbsp;<?php echo $entry_date_start; ?><br />
          <input type="text" name="filter_status_date_start" value="<?php echo $filter_status_date_start; ?>" data-date-format="YYYY-MM-DD" id="status-date-start" size="12" class="styled-input" />
       </td><td width="5"></td></tr></table>
     </td><td> 
       <table cellpadding="0" cellspacing="0" style="margin:3px;">
       <tr><td align="left">&nbsp;<?php echo $entry_date_end; ?><br />
          <input type="text" name="filter_status_date_end" value="<?php echo $filter_status_date_end; ?>" data-date-format="YYYY-MM-DD" id="status-date-end" size="12" class="styled-input" />
       </td><td width="5"></td></tr></table>
     </td><td> 
       <table cellpadding="0" cellspacing="0" style="margin:3px;">
       <tr><td align="left"><?php echo $entry_status; ?><br />
          <span <?php echo (!$filter_order_status_id) ? '' : 'class="vtip"' ?> title="<?php foreach ($order_statuses as $order_status) { ?><?php if (isset($filter_order_status_id[$order_status['order_status_id']])) { ?><?php echo $order_status['name']; ?><br /><?php } ?><?php } ?>">
          <select name="filter_order_status_id" id="filter_order_status_id" multiple="multiple" size="1">
            <?php foreach ($order_statuses as $order_status) { ?>
            <?php if (isset($filter_order_status_id[$order_status['order_status_id']])) { ?>
            <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
            <?php } ?>
            <?php } ?>
          </select></span>
       </td></tr></table>
     </td></tr></table>
	 </td>
     <td style="background:#C6D7D7;">        
	 <table align="left" border="0" cellspacing="0" cellpadding="0" style="margin:3px; background:#C6D7D7; border:1px solid #E7EFEF;">
	 <tr><td colspan="2" align="center"><span style="font-weight:bold; color:#333;"><?php echo $entry_order_id; ?></span></td></tr>
  	 <tr><td>  
       <table cellpadding="0" cellspacing="0" style="margin:3px;">
       <tr><td align="left">&nbsp;<?php echo $entry_order_id_from; ?><br />
          <input type="text" name="filter_order_id_from" value="<?php echo $filter_order_id_from; ?>" size="12" class="styled-input" />
       </td><td width="5"></td></tr></table>
     </td><td> 
       <table cellpadding="0" cellspacing="0" style="margin:3px;">
       <tr><td align="left">&nbsp;<?php echo $entry_order_id_to; ?><br />
          <input type="text" name="filter_order_id_to" value="<?php echo $filter_order_id_to; ?>" size="12" class="styled-input" />
       </td><td></td></tr></table>
    </td></tr></table>
    </td></tr>
	<tr>
    <td colspan="3" valign="top" style="padding:5px;">  
      <table cellpadding="0" cellspacing="0" style="float:left; height:70px;" id="sop2_filter">
        <tr><td><span style="font-weight:bold; color:#333;"><?php echo $entry_store; ?></span><br />
          <span <?php echo (!$filter_store_id) ? '' : 'class="vtip"' ?> title="<?php foreach ($stores as $store) { ?><?php if (isset($filter_store_id[$store['store_id']])) { ?><?php echo $store['store_name']; ?><br /><?php } ?><?php } ?>">
          <select name="filter_store_id" id="filter_store_id" multiple="multiple" size="1">
            <?php foreach ($stores as $store) { ?>
            <?php if (isset($filter_store_id[$store['store_id']])) { ?>            
            <option value="<?php echo $store['store_id']; ?>" selected="selected"><?php echo $store['store_name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $store['store_id']; ?>"><?php echo $store['store_name']; ?></option>
            <?php } ?>
            <?php } ?>
          </select></span></td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>    
      <table cellpadding="0" cellspacing="0" style="float:left; height:70px;" id="sop3_filter">
        <tr><td><span style="font-weight:bold; color:#333;"><?php echo $entry_currency; ?></span><br />
          <span <?php echo (!$filter_currency) ? '' : 'class="vtip"' ?> title="<?php foreach ($currencies as $currency) { ?><?php if (isset($filter_currency[$currency['currency_id']])) { ?><?php echo $currency['title']; ?> (<?php echo $currency['code']; ?>)<br /><?php } ?><?php } ?>">
          <select name="filter_currency" id="filter_currency" multiple="multiple" size="1">
            <?php foreach ($currencies as $currency) { ?>
            <?php if (isset($filter_currency[$currency['currency_id']])) { ?>
            <option value="<?php echo $currency['currency_id']; ?>" selected="selected"><?php echo $currency['title']; ?> (<?php echo $currency['code']; ?>)</option>
            <?php } else { ?>
            <option value="<?php echo $currency['currency_id']; ?>"><?php echo $currency['title']; ?> (<?php echo $currency['code']; ?>)</option>
            <?php } ?>
            <?php } ?>
          </select></span></td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>          
	  </tr></table>
      <table cellpadding="0" cellspacing="0" style="float:left; height:70px;" id="sop4a_filter">
        <tr><td><span style="font-weight:bold; color:#333;"><?php echo $entry_tax; ?></span><br />
          <span <?php echo (!$filter_taxes) ? '' : 'class="vtip"' ?> title="<?php foreach ($taxes as $tax) { ?><?php if (isset($filter_taxes[$tax['tax']])) { ?><?php echo $tax['tax_title']; ?><br /><?php } ?><?php } ?>">
		  <select name="filter_taxes" id="filter_taxes" multiple="multiple" size="1">
            <?php foreach ($taxes as $tax) { ?>
            <?php if (isset($filter_taxes[$tax['tax']])) { ?>              
            <option value="<?php echo $tax['tax']; ?>" selected="selected"><?php echo $tax['tax_title']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $tax['tax']; ?>"><?php echo $tax['tax_title']; ?></option>
            <?php } ?>
            <?php } ?>
          </select></span></td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>
      <table cellpadding="0" cellspacing="0" style="float:left; height:70px;" id="sop4c_filter">
        <tr><td><span style="font-weight:bold; color:#333;"><?php echo $entry_tax_classes; ?></span><br />
          <span <?php echo (!$filter_tax_classes) ? '' : 'class="vtip"' ?> title="<?php foreach ($tax_classes as $tax_class) { ?><?php if (isset($filter_tax_classes[$tax_class['tax_class']])) { ?><?php echo $tax_class['tax_class_title']; ?><br /><?php } ?><?php } ?>">
		  <select name="filter_tax_classes" id="filter_tax_classes" multiple="multiple" size="1">
            <?php foreach ($tax_classes as $tax_class) { ?>
            <?php if (isset($filter_tax_classes[$tax_class['tax_class']])) { ?>              
            <option value="<?php echo $tax_class['tax_class']; ?>" selected="selected"><?php echo $tax_class['tax_class_title']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $tax_class['tax_class']; ?>"><?php echo $tax_class['tax_class_title']; ?></option>
            <?php } ?>
            <?php } ?>
          </select></span></td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>      
      <table cellpadding="0" cellspacing="0" style="float:left; height:70px;" id="sop4b_filter">
        <tr><td><span style="font-weight:bold; color:#333;"><?php echo $entry_geo_zone; ?></span><br />
          <span <?php echo (!$filter_geo_zones) ? '' : 'class="vtip"' ?> title="<?php foreach ($geo_zones as $geo_zone) { ?><?php if (isset($filter_geo_zones[$geo_zone['geo_zone_country_id']])) { ?><?php echo $geo_zone['geo_zone_name']; ?><br /><?php } ?><?php } ?>">
		  <select name="filter_geo_zones" id="filter_geo_zones" multiple="multiple" size="1">
            <?php foreach ($geo_zones as $geo_zone) { ?>
            <?php if (isset($filter_geo_zones[$geo_zone['geo_zone_country_id']])) { ?>              
            <option value="<?php echo $geo_zone['geo_zone_country_id']; ?>" selected="selected"><?php echo $geo_zone['geo_zone_name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $geo_zone['geo_zone_country_id']; ?>"><?php echo $geo_zone['geo_zone_name']; ?></option>
            <?php } ?>
            <?php } ?>
          </select></span></td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>
      <table cellpadding="0" cellspacing="0" style="float:left; height:70px;" id="sop5_filter">
        <tr><td><span style="font-weight:bold; color:#333;"><?php echo $entry_customer_group; ?></span><br />
          <span <?php echo (!$filter_customer_group_id) ? '' : 'class="vtip"' ?> title="<?php foreach ($customer_groups as $customer_group) { ?><?php if (isset($filter_customer_group_id[$customer_group['customer_group_id']])) { ?><?php echo $customer_group['name']; ?><br /><?php } ?><?php } ?>">
          <select name="filter_customer_group_id" id="filter_customer_group_id" multiple="multiple" size="1">
            <?php foreach ($customer_groups as $customer_group) { ?>
            <?php if (isset($filter_customer_group_id[$customer_group['customer_group_id']])) { ?>              
            <option value="<?php echo $customer_group['customer_group_id']; ?>" selected="selected"><?php echo $customer_group['name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>
            <?php } ?>
            <?php } ?>
          </select></span></td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>
      <table cellpadding="0" cellspacing="0" style="float:left; height:70px;" id="sop7_filter">
        <tr><td>&nbsp;<span style="font-weight:bold; color:#333;"><?php echo $entry_customer_name; ?></span><br />
        <input type="text" name="filter_customer_name" value="<?php echo $filter_customer_name; ?>" size="20" class="styled-input" onclick="this.value = '';">
		</td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>  
      <table cellpadding="0" cellspacing="0" style="float:left; height:70px;" id="sop8a_filter">
        <tr><td>&nbsp;<span style="font-weight:bold; color:#333;"><?php echo $entry_customer_email; ?></span><br />
        <input type="text" name="filter_customer_email" value="<?php echo $filter_customer_email; ?>" size="20" class="styled-input" onclick="this.value = '';">
        </td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>  
      <table cellpadding="0" cellspacing="0" style="float:left; height:70px;" id="sop8b_filter">
        <tr><td>&nbsp;<span style="font-weight:bold; color:#333;"><?php echo $entry_customer_telephone; ?></span><br />
        <input type="text" name="filter_customer_telephone" value="<?php echo $filter_customer_telephone; ?>" size="20" class="styled-input" onclick="this.value = '';">
        </td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table> 
      <table cellpadding="0" cellspacing="0" style="float:left; height:70px;" id="sop8c_filter">
        <tr><td>&nbsp;<span style="font-weight:bold; color:#333;"><?php echo $entry_ip; ?></span><br />
        <input type="text" name="filter_ip" value="<?php echo $filter_ip; ?>" size="20" class="styled-input" onclick="this.value = '';">
        </td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>       
      <table cellpadding="0" cellspacing="0" style="float:left; height:70px;" id="sop17a_filter">
        <tr><td>&nbsp;<span style="font-weight:bold; color:#333;"><?php echo $entry_payment_company; ?></span><br />
        <input type="text" name="filter_payment_company" value="<?php echo $filter_payment_company; ?>" size="20" class="styled-input" onclick="this.value = '';">
        </td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table> 
      <table cellpadding="0" cellspacing="0" style="float:left; height:70px;" id="sop17b_filter">
        <tr><td>&nbsp;<span style="font-weight:bold; color:#333;"><?php echo $entry_payment_address; ?></span><br />
        <input type="text" name="filter_payment_address" value="<?php echo $filter_payment_address; ?>" size="20" class="styled-input" onclick="this.value = '';">
        </td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table> 
      <table cellpadding="0" cellspacing="0" style="float:left; height:70px;" id="sop17c_filter">
        <tr><td>&nbsp;<span style="font-weight:bold; color:#333;"><?php echo $entry_payment_city; ?></span><br />
        <input type="text" name="filter_payment_city" value="<?php echo $filter_payment_city; ?>" size="20" class="styled-input" onclick="this.value = '';">
		</td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table> 
      <table cellpadding="0" cellspacing="0" style="float:left; height:70px;" id="sop17d_filter">
        <tr><td>&nbsp;<span style="font-weight:bold; color:#333;"><?php echo $entry_payment_zone; ?></span><br />
        <input type="text" name="filter_payment_zone" value="<?php echo $filter_payment_zone; ?>" size="20" class="styled-input" onclick="this.value = '';">
		</td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>  
      <table cellpadding="0" cellspacing="0" style="float:left; height:70px;" id="sop17e_filter">
        <tr><td>&nbsp;<span style="font-weight:bold; color:#333;"><?php echo $entry_payment_postcode; ?></span><br />
        <input type="text" name="filter_payment_postcode" value="<?php echo $filter_payment_postcode; ?>" size="20" class="styled-input" onclick="this.value = '';">
        </td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table> 
      <table cellpadding="0" cellspacing="0" style="float:left; height:70px;" id="sop17f_filter">
        <tr><td>&nbsp;<span style="font-weight:bold; color:#333;"><?php echo $entry_payment_country; ?></span><br />
        <input type="text" name="filter_payment_country" value="<?php echo $filter_payment_country; ?>" size="20" class="styled-input" onclick="this.value = '';">
        </td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table> 
      <table cellpadding="0" cellspacing="0" style="float:left; height:70px;" id="sop13_filter">
        <tr><td><span style="font-weight:bold; color:#333;"><?php echo $entry_payment_method; ?></span><br />
          <span <?php echo (!$filter_payment_method) ? '' : 'class="vtip"' ?> title="<?php foreach ($payment_methods as $payment_method) { ?><?php if (isset($filter_payment_method[$payment_method['payment_title']])) { ?><?php echo $payment_method['payment_name']; ?><br /><?php } ?><?php } ?>">
		  <select name="filter_payment_method" id="filter_payment_method" multiple="multiple" size="1">
            <?php foreach ($payment_methods as $payment_method) { ?>
            <?php if (isset($filter_payment_method[$payment_method['payment_title']])) { ?>              
            <option value="<?php echo $payment_method['payment_title']; ?>" selected="selected"><?php echo preg_replace('~\(.*?\)~', '', $payment_method['payment_name']); ?></option>
            <?php } else { ?>
            <option value="<?php echo $payment_method['payment_title']; ?>"><?php echo preg_replace('~\(.*?\)~', '', $payment_method['payment_name']); ?></option>
            <?php } ?>
            <?php } ?>
          </select></span></td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>   
      <table cellpadding="0" cellspacing="0" style="float:left; height:70px;" id="sop16a_filter">
        <tr><td>&nbsp;<span style="font-weight:bold; color:#333;"><?php echo $entry_shipping_company; ?></span><br />
        <input type="text" name="filter_shipping_company" value="<?php echo $filter_shipping_company; ?>" size="20" class="styled-input" onclick="this.value = '';">
        </td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table> 
      <table cellpadding="0" cellspacing="0" style="float:left; height:70px;" id="sop16b_filter">
        <tr><td>&nbsp;<span style="font-weight:bold; color:#333;"><?php echo $entry_shipping_address; ?></span><br />
        <input type="text" name="filter_shipping_address" value="<?php echo $filter_shipping_address; ?>" size="20" class="styled-input" onclick="this.value = '';">
        </td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table> 
      <table cellpadding="0" cellspacing="0" style="float:left; height:70px;" id="sop16c_filter">
        <tr><td>&nbsp;<span style="font-weight:bold; color:#333;"><?php echo $entry_shipping_city; ?></span><br />
        <input type="text" name="filter_shipping_city" value="<?php echo $filter_shipping_city; ?>" size="20" class="styled-input" onclick="this.value = '';">
        </td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table> 
      <table cellpadding="0" cellspacing="0" style="float:left; height:70px;" id="sop16d_filter">
        <tr><td>&nbsp;<span style="font-weight:bold; color:#333;"><?php echo $entry_shipping_zone; ?></span><br />
        <input type="text" name="filter_shipping_zone" value="<?php echo $filter_shipping_zone; ?>" size="20" class="styled-input" onclick="this.value = '';">
        </td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>                     
      <table cellpadding="0" cellspacing="0" style="float:left; height:70px;" id="sop16e_filter">
        <tr><td>&nbsp;<span style="font-weight:bold; color:#333;"><?php echo $entry_shipping_postcode; ?></span><br />
        <input type="text" name="filter_shipping_postcode" value="<?php echo $filter_shipping_postcode; ?>" size="20" class="styled-input" onclick="this.value = '';">
        </td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table> 
      <table cellpadding="0" cellspacing="0" style="float:left; height:70px;" id="sop16f_filter">
        <tr><td>&nbsp;<span style="font-weight:bold; color:#333;"><?php echo $entry_shipping_country; ?></span><br />
        <input type="text" name="filter_shipping_country" value="<?php echo $filter_shipping_country; ?>" size="20" class="styled-input" onclick="this.value = '';">
        </td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>           
      <table cellpadding="0" cellspacing="0" style="float:left; height:70px;" id="sop14_filter">
        <tr><td><span style="font-weight:bold; color:#333;"><?php echo $entry_shipping_method; ?></span><br />
          <span <?php echo (!$filter_shipping_method) ? '' : 'class="vtip"' ?> title="<?php foreach ($shipping_methods as $shipping_method) { ?><?php if (isset($filter_shipping_method[$shipping_method['shipping_title']])) { ?><?php echo $shipping_method['shipping_name']; ?><br /><?php } ?><?php } ?>">
		  <select name="filter_shipping_method" id="filter_shipping_method" multiple="multiple" size="1">
            <?php foreach ($shipping_methods as $shipping_method) { ?>
            <?php if (isset($filter_shipping_method[$shipping_method['shipping_title']])) { ?>              
            <option value="<?php echo $shipping_method['shipping_title']; ?>" selected="selected"><?php echo preg_replace('~\(.*?\)~', '', $shipping_method['shipping_name']); ?></option>
            <?php } else { ?>
            <option value="<?php echo $shipping_method['shipping_title']; ?>"><?php echo preg_replace('~\(.*?\)~', '', $shipping_method['shipping_name']); ?></option>
            <?php } ?>
            <?php } ?>
          </select></span></td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>
      <table cellpadding="0" cellspacing="0" style="float:left; height:70px;" id="sop9d_filter">
        <tr><td><span style="font-weight:bold; color:#333;"><?php echo $entry_category; ?></span><br />
          <span <?php echo (!$filter_category) ? '' : 'class="vtip"' ?> title="<?php foreach ($categories as $category) { ?><?php if (isset($filter_category[$category['category_id']])) { ?><?php echo $category['name']; ?><br /><?php } ?><?php } ?>">
          <select name="filter_category" id="filter_category" multiple="multiple" size="1">
            <?php foreach ($categories as $category) { ?>
            <?php if (isset($filter_category[$category['category_id']])) { ?>               
            <option value="<?php echo $category['category_id']; ?>" selected="selected"><?php echo $category['name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option> 
            <?php } ?>
            <?php } ?>
          </select></span></td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>                               
      <table cellpadding="0" cellspacing="0" style="float:left; height:70px;" id="sop9e_filter">
        <tr><td><span style="font-weight:bold; color:#333;"><?php echo $entry_manufacturer; ?></span><br />
          <span <?php echo (!$filter_manufacturer) ? '' : 'class="vtip"' ?> title="<?php foreach ($manufacturers as $manufacturer) { ?><?php if (isset($filter_manufacturer[$manufacturer['manufacturer_id']])) { ?> <?php echo $manufacturer['name']; ?><br /><?php } ?><?php } ?>">
          <select name="filter_manufacturer" id="filter_manufacturer" multiple="multiple" size="1">
            <?php foreach ($manufacturers as $manufacturer) { ?>
            <?php if (isset($filter_manufacturer[$manufacturer['manufacturer_id']])) { ?>               
            <option value="<?php echo $manufacturer['manufacturer_id']; ?>" selected="selected"><?php echo $manufacturer['name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $manufacturer['manufacturer_id']; ?>"><?php echo $manufacturer['name']; ?></option> 
            <?php } ?>
            <?php } ?>
          </select></span></td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>            
      <table cellpadding="0" cellspacing="0" style="float:left; height:70px;" id="sop9a_filter">
        <tr><td>&nbsp;<span style="font-weight:bold; color:#333;"><?php echo $entry_sku; ?></span><br />
        <input type="text" name="filter_sku" value="<?php echo $filter_sku; ?>" size="20" class="styled-input" onclick="this.value = '';">
        </td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table> 
      <table cellpadding="0" cellspacing="0" style="float:left; height:70px;" id="sop9b_filter">
        <tr><td>&nbsp;<span style="font-weight:bold; color:#333;"><?php echo $entry_product; ?></span><br />
        <input type="text" name="filter_product_id" value="<?php echo $filter_product_id; ?>" size="40" class="styled-input" onclick="this.value = '';">
        </td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table> 
      <table cellpadding="0" cellspacing="0" style="float:left; height:70px;" id="sop9c_filter">
        <tr><td>&nbsp;<span style="font-weight:bold; color:#333;"><?php echo $entry_model; ?></span><br />
        <input type="text" name="filter_model" value="<?php echo $filter_model; ?>" size="20" class="styled-input" onclick="this.value = '';">
        </td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>  
	  <table cellpadding="0" cellspacing="0" style="float:left; height:70px;" id="sop10_filter">
        <tr><td><span style="font-weight:bold; color:#333;"><?php echo $entry_option; ?></span><br />
          <span <?php echo (!$filter_option) ? '' : 'class="vtip"' ?> title="<?php foreach ($order_options as $order_option) { ?><?php if (isset($filter_option[$order_option['options']])) { ?><?php echo $order_option['option_name']; ?>: <?php echo $order_option['option_value']; ?><br /><?php } ?><?php } ?>">        
          <select name="filter_option" id="filter_option" multiple="multiple" size="1">
            <?php foreach ($order_options as $order_option) { ?>
            <?php if (isset($filter_option[$order_option['options']])) { ?>              
            <option value="<?php echo $order_option['options']; ?>" selected="selected"><?php echo $order_option['option_name']; ?>: <?php echo $order_option['option_value']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $order_option['options']; ?>"><?php echo $order_option['option_name']; ?>: <?php echo $order_option['option_value']; ?></option>
            <?php } ?>
            <?php } ?>
          </select></span></td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>  
      <table cellpadding="0" cellspacing="0" style="float:left; height:70px;" id="sop18_filter">
        <tr><td><span style="font-weight:bold; color:#333;"><?php echo $entry_attributes; ?></span><br />
          <span <?php echo (!$filter_attribute) ? '' : 'class="vtip"' ?> title="<?php foreach ($attributes as $attribute) { ?><?php if (isset($filter_attribute[$attribute['attribute_title']])) { ?><?php echo $attribute['attribute_name']; ?><br /><?php } ?><?php } ?>">
		  <select name="filter_attribute" id="filter_attribute" multiple="multiple" size="1">
            <?php foreach ($attributes as $attribute) { ?>
            <?php if (isset($filter_attribute[$attribute['attribute_title']])) { ?>              
            <option value="<?php echo $attribute['attribute_title']; ?>" selected="selected"><?php echo $attribute['attribute_name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $attribute['attribute_title']; ?>"><?php echo $attribute['attribute_name']; ?></option>
            <?php } ?>
            <?php } ?>
          </select></span></td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>                    
      <table cellpadding="0" cellspacing="0" style="float:left; height:70px;" id="sop11_filter">
        <tr><td><span style="font-weight:bold; color:#333;"><?php echo $entry_location; ?></span><br />
          <span <?php echo (!$filter_location) ? '' : 'class="vtip"' ?> title="<?php foreach ($locations as $location) { ?><?php if (isset($filter_location[$location['location_title']])) { ?><?php echo $location['location_name']; ?><br /><?php } ?><?php } ?>">
		  <select name="filter_location" id="filter_location" multiple="multiple" size="1">
            <?php foreach ($locations as $location) { ?>
            <?php if (isset($filter_location[$location['location_title']])) { ?>              
            <option value="<?php echo $location['location_title']; ?>" selected="selected"><?php echo $location['location_name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $location['location_title']; ?>"><?php echo $location['location_name']; ?></option>
            <?php } ?>
            <?php } ?>
          </select></span></td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>
	  <table cellpadding="0" cellspacing="0" style="float:left; height:70px;" id="sop12a_filter">
        <tr><td><span style="font-weight:bold; color:#333;"><?php echo $entry_affiliate_name; ?></span><br />
          <span <?php echo (!$filter_affiliate_name) ? '' : 'class="vtip"' ?> title="<?php foreach ($affiliate_names as $affiliate_name) { ?><?php if (isset($filter_affiliate_name[$affiliate_name['affiliate_id']])) { ?><?php echo $affiliate_name['affiliate_name']; ?><br /><?php } ?><?php } ?>">        
          <select name="filter_affiliate_name" id="filter_affiliate_name" multiple="multiple" size="1">
            <?php foreach ($affiliate_names as $affiliate_name) { ?>
            <?php if (isset($filter_affiliate_name[$affiliate_name['affiliate_id']])) { ?>              
            <option value="<?php echo $affiliate_name['affiliate_id']; ?>" selected="selected"><?php echo $affiliate_name['affiliate_name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $affiliate_name['affiliate_id']; ?>"><?php echo $affiliate_name['affiliate_name']; ?></option>
            <?php } ?>
            <?php } ?>
          </select></span></td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>
	  <table cellpadding="0" cellspacing="0" style="float:left; height:70px;" id="sop12b_filter">
        <tr><td><span style="font-weight:bold; color:#333;"><?php echo $entry_affiliate_email; ?></span><br />
          <span <?php echo (!$filter_affiliate_email) ? '' : 'class="vtip"' ?> title="<?php foreach ($affiliate_emails as $affiliate_email) { ?><?php if (isset($filter_affiliate_email[$affiliate_email['affiliate_id']])) { ?><?php echo $affiliate_email['affiliate_email']; ?><br /><?php } ?><?php } ?>">
          <select name="filter_affiliate_email" id="filter_affiliate_email" multiple="multiple" size="1">
            <?php foreach ($affiliate_emails as $affiliate_email) { ?>
            <?php if (isset($filter_affiliate_email[$affiliate_email['affiliate_id']])) { ?>              
            <option value="<?php echo $affiliate_email['affiliate_id']; ?>" selected="selected"><?php echo $affiliate_email['affiliate_email']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $affiliate_email['affiliate_id']; ?>"><?php echo $affiliate_email['affiliate_email']; ?></option>
            <?php } ?>
            <?php } ?>
          </select></span></td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>
	  <table cellpadding="0" cellspacing="0" style="float:left; height:70px;" id="sop15a_filter">
        <tr><td><span style="font-weight:bold; color:#333;"><?php echo $entry_coupon_name; ?></span><br />
          <span <?php echo (!$filter_coupon_name) ? '' : 'class="vtip"' ?> title="<?php foreach ($coupon_names as $coupon_name) { ?><?php if (isset($filter_coupon_name[$coupon_name['coupon_id']])) { ?><?php echo $coupon_name['coupon_name']; ?><br /><?php } ?><?php } ?>">        
          <select name="filter_coupon_name" id="filter_coupon_name" multiple="multiple" size="1">
            <?php foreach ($coupon_names as $coupon_name) { ?>
            <?php if (isset($filter_coupon_name[$coupon_name['coupon_id']])) { ?>              
            <option value="<?php echo $coupon_name['coupon_id']; ?>" selected="selected"><?php echo $coupon_name['coupon_name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $coupon_name['coupon_id']; ?>"><?php echo $coupon_name['coupon_name']; ?></option>
            <?php } ?>
            <?php } ?>
          </select></span></td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>
      <table cellpadding="0" cellspacing="0" style="float:left; height:70px;" id="sop15b_filter">
        <tr><td>&nbsp;<span style="font-weight:bold; color:#333;"><?php echo $entry_coupon_code; ?></span><br />
        <input type="text" name="filter_coupon_code" value="<?php echo $filter_coupon_code; ?>" size="20" class="styled-input" onclick="this.value = '';">
        </td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>  
      <table cellpadding="0" cellspacing="0" style="float:left; height:70px;" id="sop19_filter">
        <tr><td>&nbsp;<span style="font-weight:bold; color:#333;"><?php echo $entry_voucher_code; ?></span><br />
        <input type="text" name="filter_voucher_code" value="<?php echo $filter_voucher_code; ?>" size="20" class="styled-input" onclick="this.value = '';">
        </td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>  
	   </td>
	  </tr>
	 </table>
	</td>
	</tr>
	</table>      
</div>
<?php if ($orders) { ?>
<script type="text/javascript">$(function(){ 
$('#show_tab_chart').click(function() {
		$('#tab_chart').slideToggle('slow');
	});
});
</script> 
	<?php if ($filter_report == 'sales_summary') { ?> 
	<?php if ($filter_details != '4' && ($filter_group == 'year' or $filter_group == 'quarter' or $filter_group == 'month')) { ?>     
    <div id="tab_chart">
      <table align="center" cellspacing="0" cellpadding="3">
        <tr>
          <td><div style="float:left;" id="chart1_sales_summary"></div><div style="float:left;" id="chart2_sales_summary"></div></td>
        </tr>
      </table>
    </div>
	<?php } ?> 
	<?php } elseif ($filter_report == 'day_of_week') { ?>
    <div id="tab_chart">
      <table align="center" cellspacing="0" cellpadding="3">    
        <tr>
          <td><div style="float:left;" id="chart1_day_of_week"></div><div style="float:left;" id="chart2_day_of_week"></div></td>
        </tr>
      </table>
    </div>
    <?php } elseif ($filter_report == 'hour') { ?>
    <div id="tab_chart">
      <table align="center" cellspacing="0" cellpadding="3">    
        <tr>
          <td><div style="float:left;" id="chart1_hour"></div><div style="float:left;" id="chart2_hour"></div></td>
        </tr>
      </table>
    </div>
	<?php } elseif ($filter_report == 'store') { ?>
    <div id="tab_chart">
      <table align="center" cellspacing="0" cellpadding="3">    
        <tr>
          <td><div style="float:left;" id="chart1_store"></div><div style="float:left;" id="chart2_store"></div></td>
        </tr>
      </table>
    </div>
	<?php } elseif ($filter_report == 'customer_group') { ?>
    <div id="tab_chart">
      <table align="center" cellspacing="0" cellpadding="3">    
        <tr>
          <td><div style="float:left;" id="chart1_customer_group"></div><div style="float:left;" id="chart2_customer_group"></div></td>
        </tr>
      </table>
    </div>
	<?php } elseif ($filter_report == 'country') { ?>
    <div id="tab_chart">
      <table align="center" cellspacing="0" cellpadding="3">
        <tr>
          <td><div style="float:center;" id="chart_country"></div></td>
        </tr>
      </table>
    </div> 
	<?php } elseif ($filter_report == 'payment_method') { ?>
    <div id="tab_chart">
      <table align="center" cellspacing="0" cellpadding="3">
        <tr>
          <td><div style="float:center; width:605px; height:350px;" id="chart_payment_method"></div></td>
        </tr>
      </table>
    </div>   
	<?php } elseif ($filter_report == 'shipping_method') { ?>
    <div id="tab_chart">
      <table align="center" cellspacing="0" cellpadding="3">
        <tr>
          <td><div style="float:center; width:605px; height:350px;" id="chart_shipping_method"></div></td>
        </tr>
      </table>
    </div>   
	<?php } ?>
	<?php } ?> 
	<?php if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false) { ?>
    <div id="pagination_content" style="overflow:scroll; padding:1px;"> 
    <?php } else { ?>
    <div id="pagination_content" style="overflow:auto; padding:1px;">     
    <?php } ?>
<?php if ($filter_details == 4) { ?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">       
	<tr> 
    <td> 
	<?php if ($orders) { ?>
	<?php foreach ($orders as $order) { ?>
    <?php if ($order['product_pidc']) { ?>           
		<table class="list_detail" id="element" style="border-bottom:2px solid #999; border-top:2px solid #999;">
		<thead>
		<tr>
          <td class="left" nowrap="nowrap"><?php echo $column_order_order_id; ?></td>        
          <td class="left" nowrap="nowrap"><?php echo $column_order_date_added; ?></td> 
          <td id="sop1000_<?php echo $order['order_id']; ?>_title" class="left"><?php echo $column_order_inv_no; ?></td>
          <td id="sop1001_<?php echo $order['order_id']; ?>_title" class="left"><?php echo $column_order_customer; ?></td>
          <td id="sop1002_<?php echo $order['order_id']; ?>_title" class="left"><?php echo $column_order_email; ?></td>
          <td id="sop1003_<?php echo $order['order_id']; ?>_title" class="left"><?php echo $column_order_customer_group; ?></td>
          <td id="sop1040_<?php echo $order['order_id']; ?>_title" class="left"><?php echo $column_order_shipping_method; ?></td>
          <td id="sop1041_<?php echo $order['order_id']; ?>_title" class="left"><?php echo $column_order_payment_method; ?></td>          
          <td id="sop1042_<?php echo $order['order_id']; ?>_title" class="left"><?php echo $column_order_status; ?></td>
          <td id="sop1043_<?php echo $order['order_id']; ?>_title" class="left"><?php echo $column_order_store; ?></td>
          <td id="sop1012_<?php echo $order['order_id']; ?>_title" class="right"><?php echo $column_order_currency; ?></td>
          <td id="sop1062_<?php echo $order['order_id']; ?>_title" class="right"><?php echo $column_order_quantity; ?></td>  
          <td id="sop1020_<?php echo $order['order_id']; ?>_title" class="right"><?php echo $column_order_sub_total; ?></td>                               
          <td id="sop1023_<?php echo $order['order_id']; ?>_title" class="right"><?php echo $column_order_shipping; ?></td>         
          <td id="sop1027_<?php echo $order['order_id']; ?>_title" class="right"><?php echo $column_order_tax; ?></td>
          <td id="sop1031_<?php echo $order['order_id']; ?>_title" class="right"><?php echo $column_order_value; ?></td>  
          <td id="sop1032_<?php echo $order['order_id']; ?>_title" class="right"><?php echo $column_order_sales; ?></td>                    
          <td id="sop1037_<?php echo $order['order_id']; ?>_title" class="right"><?php echo $column_order_costs; ?></td> 
          <td id="sop1038_<?php echo $order['order_id']; ?>_title" class="right"><?php echo $column_order_profit; ?></td>
          <td id="sop1039_<?php echo $order['order_id']; ?>_title" class="right"><?php echo $column_profit_margin; ?></td>         
		</tr>
		</thead>
        <tbody>
		<tr bgcolor="#FFFFFF">
          <td class="left" nowrap="nowrap" style="background-color:#FFC;"><a><?php echo $order['order_ord_id']; ?></a></td>        
          <td class="left" nowrap="nowrap" style="background-color:#FFC;"><?php echo $order['order_order_date']; ?></td>
          <td id="sop1000_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['order_inv_no']; ?></td>
          <td id="sop1001_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['order_name']; ?></td>
          <td id="sop1002_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['order_email']; ?></td>
          <td id="sop1003_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['order_group']; ?></td>
          <td id="sop1040_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['order_shipping_method']; ?></td>
          <td id="sop1041_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['order_payment_method']; ?></td>          
          <td id="sop1042_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['order_status']; ?></td>
          <td id="sop1043_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['order_store']; ?></td> 
          <td id="sop1012_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap"><?php echo $order['order_currency']; ?></td>          
          <td id="sop1062_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap"><?php echo $order['order_products']; ?></td> 
          <td id="sop1020_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap"><?php echo $order['order_sub_total']; ?></td>                    
          <td id="sop1023_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap"><?php echo $order['order_shipping']; ?></td>           
          <td id="sop1027_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap"><?php echo $order['order_tax']; ?></td>                              
          <td id="sop1031_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap"><?php echo $order['order_value']; ?></td>
          <td id="sop1032_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap" style="background-color:#DCFFB9;"><?php echo $order['order_sales']; ?></td>           
          <td id="sop1037_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap" style="background-color:#ffd7d7;">-<?php echo $order['order_costs']; ?></td>
          <td id="sop1038_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap" <?php echo ($order['order_profit'] >= 0) ? 'style="background-color:#c4d9ee; font-weight:bold;"' : 'style="background-color:#F99; font-weight:bold;"' ?> ><?php echo $order['order_profit']; ?></td> 
          <td id="sop1039_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap" <?php echo ($order['order_profit'] >= 0) ? 'style="background-color:#c4d9ee; font-weight:bold;"' : 'style="background-color:#F99; font-weight:bold;"' ?> ><?php echo $order['order_profit_margin_percent']; ?>%</td>      
		</tr>  
		<tr>
		<td colspan="20">
		  <table class="list_detail">
          <thead>
          <tr>
          <td id="sop1004_<?php echo $order['order_id']; ?>_title" class="left"><?php echo $column_prod_id; ?></td>                                          
		  <td id="sop1005_<?php echo $order['order_id']; ?>_title" class="left"><?php echo $column_prod_sku; ?></td>
		  <td id="sop1006_<?php echo $order['order_id']; ?>_title" class="left"><?php echo $column_prod_model; ?></td>            
          <td id="sop1007_<?php echo $order['order_id']; ?>_title" class="left"><?php echo $column_prod_name; ?></td> 
          <td id="sop1008_<?php echo $order['order_id']; ?>_title" class="left"><?php echo $column_prod_option; ?></td>           
          <td id="sop1009_<?php echo $order['order_id']; ?>_title" class="left"><?php echo $column_prod_attributes; ?></td>                      
          <td id="sop1010_<?php echo $order['order_id']; ?>_title" class="left"><?php echo $column_prod_manu; ?></td> 
          <td id="sop1011_<?php echo $order['order_id']; ?>_title" class="left"><?php echo $column_prod_category; ?></td>           
          <td id="sop1013_<?php echo $order['order_id']; ?>_title" class="right"><?php echo $column_prod_price; ?></td>                     
          <td id="sop1014_<?php echo $order['order_id']; ?>_title" class="right"><?php echo $column_prod_quantity; ?></td>
          <td id="sop1016a_<?php echo $order['order_id']; ?>_title" class="right"><?php echo $column_prod_total_excl_vat; ?></td>          
          <td id="sop1015_<?php echo $order['order_id']; ?>_title" class="right"><?php echo $column_prod_tax; ?></td>           
          <td id="sop1016b_<?php echo $order['order_id']; ?>_title" class="right"><?php echo $column_prod_total_incl_vat; ?></td>
          <td id="sop1016c_<?php echo $order['order_id']; ?>_title" class="right"><?php echo $column_prod_sales; ?></td>                  
          <td id="sop1017_<?php echo $order['order_id']; ?>_title" class="right"><?php echo $column_prod_costs; ?></td>           
          <td id="sop1018_<?php echo $order['order_id']; ?>_title" class="right"><?php echo $column_prod_profit; ?></td>
          <td id="sop1019_<?php echo $order['order_id']; ?>_title" class="right"><?php echo $column_profit_margin; ?></td>  
          </tr>
          </thead>
          <tr bgcolor="#FFFFFF">
          <td id="sop1004_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['product_pid']; ?></td>  
          <td id="sop1005_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['product_sku']; ?></td>
          <td id="sop1006_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['product_model']; ?></td>                 
          <td id="sop1007_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['product_name']; ?></td> 
          <td id="sop1008_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['product_option']; ?></td>            
          <td id="sop1009_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['product_attributes']; ?></td>                    
          <td id="sop1010_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['product_manu']; ?></td> 
          <td id="sop1011_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['product_category']; ?></td> 
          <td id="sop1013_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap"><?php echo $order['product_price']; ?></td> 
          <td id="sop1014_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap"><?php echo $order['product_quantity']; ?></td>
          <td id="sop1016a_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap"><?php echo $order['product_total_excl_vat']; ?></td>  
          <td id="sop1015_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap"><?php echo $order['product_tax']; ?></td>  
          <td id="sop1016b_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap"><?php echo $order['product_total_incl_vat']; ?></td>                                
          <td id="sop1016c_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap" style="background-color:#DCFFB9;"><?php echo $order['product_sales']; ?></td>        
          <td id="sop1017_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap" style="background-color:#ffd7d7;">-<?php echo $order['product_costs']; ?></td>         
          <td id="sop1018_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap" style="background-color:#c4d9ee; font-weight:bold;"><?php echo $order['product_profit']; ?></td>
          <td id="sop1019_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap" style="background-color:#c4d9ee; font-weight:bold;"><?php echo $order['product_profit_margin_percent']; ?>%</td>  
          </tr>                  
	      </table>
          <table class="list_detail">
          <thead>
          <tr>
          <td id="sop1044_<?php echo $order['order_id']; ?>_title" class="left"><?php echo $column_customer_cust_id; ?></td>           
          <td id="sop1045_<?php echo $order['order_id']; ?>_title" class="left"><?php echo $column_billing_name; ?></td> 
          <td id="sop1046_<?php echo $order['order_id']; ?>_title" class="left"><?php echo $column_billing_company; ?></td> 
          <td id="sop1047_<?php echo $order['order_id']; ?>_title" class="left"><?php echo $column_billing_address_1; ?></td> 
          <td id="sop1048_<?php echo $order['order_id']; ?>_title" class="left"><?php echo $column_billing_address_2; ?></td> 
          <td id="sop1049_<?php echo $order['order_id']; ?>_title" class="left"><?php echo $column_billing_city; ?></td>
          <td id="sop1050_<?php echo $order['order_id']; ?>_title" class="left"><?php echo $column_billing_zone; ?></td> 
          <td id="sop1051_<?php echo $order['order_id']; ?>_title" class="left"><?php echo $column_billing_postcode; ?></td>
          <td id="sop1052_<?php echo $order['order_id']; ?>_title" class="left"><?php echo $column_billing_country; ?></td>
          <td id="sop1053_<?php echo $order['order_id']; ?>_title" class="left"><?php echo $column_customer_telephone; ?></td>
          <td id="sop1054_<?php echo $order['order_id']; ?>_title" class="left"><?php echo $column_shipping_name; ?></td> 
          <td id="sop1055_<?php echo $order['order_id']; ?>_title" class="left"><?php echo $column_shipping_company; ?></td> 
          <td id="sop1056_<?php echo $order['order_id']; ?>_title" class="left"><?php echo $column_shipping_address_1; ?></td> 
          <td id="sop1057_<?php echo $order['order_id']; ?>_title" class="left"><?php echo $column_shipping_address_2; ?></td> 
          <td id="sop1058_<?php echo $order['order_id']; ?>_title" class="left"><?php echo $column_shipping_city; ?></td>
          <td id="sop1059_<?php echo $order['order_id']; ?>_title" class="left"><?php echo $column_shipping_zone; ?></td> 
          <td id="sop1060_<?php echo $order['order_id']; ?>_title" class="left"><?php echo $column_shipping_postcode; ?></td>
          <td id="sop1061_<?php echo $order['order_id']; ?>_title" class="left"><?php echo $column_shipping_country; ?></td>          
          </tr>
          </thead>
          <tr bgcolor="#FFFFFF">
          <td id="sop1044_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['customer_cust_id']; ?></td>             
          <td id="sop1045_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['billing_name']; ?></td>         
          <td id="sop1046_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['billing_company']; ?></td> 
          <td id="sop1047_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['billing_address_1']; ?></td> 
          <td id="sop1048_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['billing_address_2']; ?></td> 
          <td id="sop1049_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['billing_city']; ?></td> 
          <td id="sop1050_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['billing_zone']; ?></td> 
          <td id="sop1051_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['billing_postcode']; ?></td>                    
          <td id="sop1052_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['billing_country']; ?></td>
          <td id="sop1053_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['customer_telephone']; ?></td> 
          <td id="sop1054_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['shipping_name']; ?></td>         
          <td id="sop1055_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['shipping_company']; ?></td> 
          <td id="sop1056_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['shipping_address_1']; ?></td> 
          <td id="sop1057_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['shipping_address_2']; ?></td> 
          <td id="sop1058_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['shipping_city']; ?></td> 
          <td id="sop1059_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['shipping_zone']; ?></td> 
          <td id="sop1060_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['shipping_postcode']; ?></td>                    
          <td id="sop1061_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['shipping_country']; ?></td>  
          </tr>                  
	      </table>            
		</td>               
		</tr> 
    	</tbody>         
		</table>       
	<?php } ?>
	<?php } ?> 
	<?php } else { ?>
		<table width="100%">    
		<tr>
		<td align="center"><?php echo $text_no_results; ?></td>
		</tr>
        </table>          
	<?php } ?>      
    </td></tr>
    </table>
<br />     
<?php } ?>
<?php if ($filter_details != '4') { ?>               
    <table class="list_main">
        <thead>
          <tr>
          <?php if ($filter_report == 'sales_summary') { ?> 
		  <?php if ($filter_group == 'year') { ?>           
          <td class="left" colspan="2" nowrap="nowrap"><?php echo $column_year; ?></td>
		  <?php } elseif ($filter_group == 'quarter') { ?> 
          <td class="left" nowrap="nowrap"><?php echo $column_year; ?></td>
          <td class="left" nowrap="nowrap"><?php echo $column_quarter; ?></td>       
		  <?php } elseif ($filter_group == 'month') { ?> 
          <td class="left" nowrap="nowrap"><?php echo $column_year; ?></td>
          <td class="left" nowrap="nowrap"><?php echo $column_month; ?></td> 
		  <?php } elseif ($filter_group == 'day') { ?> 
          <td class="left" colspan="2" nowrap="nowrap"><?php echo $column_date; ?></td>
		  <?php } elseif ($filter_group == 'order') { ?> 
          <td class="left" nowrap="nowrap"><?php echo $column_order_order_id; ?></td>
          <td class="left" nowrap="nowrap"><?php echo $column_order_date_added; ?></td>             
		  <?php } else { ?>    
          <td class="left" width="70" nowrap="nowrap"><?php echo $column_date_start; ?></td>
          <td class="left" width="70" nowrap="nowrap"><?php echo $column_date_end; ?></td>           
		  <?php } ?> 
		  <?php } elseif ($filter_report == 'day_of_week') { ?>
          <td class="left" colspan="2" nowrap="nowrap"><?php echo $column_day_of_week; ?></td>
		  <?php } elseif ($filter_report == 'hour') { ?>
          <td class="left" colspan="2" nowrap="nowrap"><?php echo $column_hour; ?></td>  
		  <?php } elseif ($filter_report == 'store') { ?>
          <td class="left" colspan="2" nowrap="nowrap"><?php echo $column_store; ?></td>  
		  <?php } elseif ($filter_report == 'customer_group') { ?>
          <td class="left" colspan="2" nowrap="nowrap"><?php echo $column_customer_group; ?></td>  
		  <?php } elseif ($filter_report == 'country') { ?>
          <td class="left" colspan="2" nowrap="nowrap"><?php echo $column_country; ?></td>  
		  <?php } elseif ($filter_report == 'postcode') { ?>
          <td class="left" colspan="2" nowrap="nowrap"><?php echo $column_postcode; ?></td>  
		  <?php } elseif ($filter_report == 'region_state') { ?>
          <td class="left" colspan="2" nowrap="nowrap"><?php echo $column_region_state; ?></td>  
		  <?php } elseif ($filter_report == 'city') { ?>
          <td class="left" colspan="2" nowrap="nowrap"><?php echo $column_city; ?></td>  
		  <?php } elseif ($filter_report == 'payment_method') { ?>
          <td class="left" colspan="2" nowrap="nowrap"><?php echo $column_payment_method; ?></td>
		  <?php } elseif ($filter_report == 'shipping_method') { ?>
          <td class="left" colspan="2" nowrap="nowrap"><?php echo $column_shipping_method; ?></td>                                                                                                            
		  <?php } ?>
          <td id="sop20_title" class="right"><?php echo $column_orders; ?></td>
          <td id="sop21_title" class="right"><?php echo $column_customers; ?></td>    
          <td id="sop22_title" class="right"><?php echo $column_products; ?></td>
          <td id="sop23_title" class="right"><?php echo $column_sub_total; ?></td>
          <td id="sop24_title" class="right"><?php echo $column_handling; ?></td>
          <td id="sop25_title" class="right"><?php echo $column_loworder; ?></td>
          <td id="sop27_title" class="right"><?php echo $column_shipping; ?></td>          
          <td id="sop26_title" class="right"><?php echo $column_reward; ?></td>
          <td id="sop28_title" class="right"><?php echo $column_coupon; ?></td>          
          <td id="sop29_title" class="right"><?php echo $column_tax; ?></td>
          <td id="sop30_title" class="right"><?php echo $column_credit; ?></td>           
          <td id="sop31_title" class="right"><?php echo $column_voucher; ?></td>
          <td id="sop33_title" class="right"><?php echo $column_total; ?></td>
          <td id="sop37_title" class="right"><?php echo $column_sales; ?></td>          
          <td id="sop34_title" class="right"><?php echo $column_product_costs; ?></td>
          <td id="sop32_title" class="right"><?php echo $column_commission; ?></td>
          <td id="sop391_title" class="right"><?php echo $column_payment_cost; ?></td>
          <td id="sop392_title" class="right"><?php echo $column_shipping_cost; ?></td>
          <td id="sop393_title" class="right"><?php echo $column_shipping_balance; ?></td>          
          <td id="sop38_title" class="right"><?php echo $column_total_costs; ?></td>
          <td id="sop35_title" class="right"><?php echo $column_net_profit; ?></td>   
          <td id="sop36_title" class="right"><?php echo $column_profit_margin; ?></td>                             
          <?php if ($filter_details == 1 OR $filter_details == 2 OR $filter_details == 3) { ?><td class="right" nowrap="nowrap"><?php echo $column_action; ?></td><?php } ?> 
          </tr>
      	  </thead>
          <?php if ($orders) { ?>
          <?php foreach ($orders as $order) { ?>
      	  <tbody id="element">
          <tr <?php echo ($filter_details == 1 OR $filter_details == 2 OR $filter_details == 3) ? 'style="cursor:pointer;" title="' . $text_detail . '"' : '' ?> id="show_details_<?php echo $order['order_id']; ?>">  
          <?php if ($filter_report == 'sales_summary') { ?>        
		  <?php if ($filter_group == 'year') { ?>           
          <td class="left" colspan="2" nowrap="nowrap" style="background-color:#F0F0F0;"><?php echo $order['year']; ?></td>
		  <?php } elseif ($filter_group == 'quarter') { ?> 
          <td class="left" nowrap="nowrap" style="background-color:#F0F0F0;"><?php echo $order['year']; ?></td>
          <td class="left" nowrap="nowrap" style="background-color:#F0F0F0;"><?php echo $order['quarter']; ?></td>  
		  <?php } elseif ($filter_group == 'month') { ?> 
          <td class="left" nowrap="nowrap" style="background-color:#F0F0F0;"><?php echo $order['year']; ?></td>
          <td class="left" nowrap="nowrap" style="background-color:#F0F0F0;"><?php echo $order['month']; ?></td>
		  <?php } elseif ($filter_group == 'day') { ?> 
          <td class="left" colspan="2" nowrap="nowrap" style="background-color:#F0F0F0;"><?php echo $order['date_start']; ?></td>
		  <?php } elseif ($filter_group == 'order') { ?> 
          <td class="left" nowrap="nowrap" style="background-color:#F0F0F0;"><?php echo $order['order_id']; ?></td>
          <td class="left" nowrap="nowrap" style="background-color:#F0F0F0;"><?php echo $order['date_start']; ?></td>         
		  <?php } else { ?>    
          <td class="left" nowrap="nowrap" style="background-color:#F0F0F0;"><?php echo $order['date_start']; ?></td>
          <td class="left" nowrap="nowrap" style="background-color:#F0F0F0;"><?php echo $order['date_end']; ?></td>         
		  <?php } ?>
		  <?php } elseif ($filter_report == 'day_of_week') { ?>
          <td class="left" colspan="2" nowrap="nowrap" style="background-color:#F0F0F0;"><?php echo $order['day_of_week']; ?></td> 
		  <?php } elseif ($filter_report == 'hour') { ?>    
          <td class="left" colspan="2" nowrap="nowrap" style="background-color:#F0F0F0;"><?php echo $order['hour']; ?></td>  
		  <?php } elseif ($filter_report == 'store') { ?>    
          <td class="left" colspan="2" nowrap="nowrap" style="background-color:#F0F0F0;"><?php echo $order['store_name']; ?></td> 
		  <?php } elseif ($filter_report == 'customer_group') { ?>    
          <td class="left" colspan="2" nowrap="nowrap" style="background-color:#F0F0F0;"><?php echo $order['customer_group']; ?></td> 
		  <?php } elseif ($filter_report == 'country') { ?>    
          <td class="left" colspan="2" nowrap="nowrap" style="background-color:#F0F0F0;"><?php echo $order['payment_country']; ?></td> 
		  <?php } elseif ($filter_report == 'postcode') { ?>    
          <td class="left" colspan="2" nowrap="nowrap" style="background-color:#F0F0F0;"><?php echo $order['payment_postcode']; ?></td> 
		  <?php } elseif ($filter_report == 'region_state') { ?>    
          <td class="left" colspan="2" nowrap="nowrap" style="background-color:#F0F0F0;"><?php echo $order['payment_zone']; ?></td> 
		  <?php } elseif ($filter_report == 'city') { ?>    
          <td class="left" colspan="2" nowrap="nowrap" style="background-color:#F0F0F0;"><?php echo $order['payment_city']; ?></td> 
		  <?php } elseif ($filter_report == 'payment_method') { ?>    
          <td class="left" colspan="2" nowrap="nowrap" style="background-color:#F0F0F0;"><?php echo $order['payment_method']; ?></td> 
		  <?php } elseif ($filter_report == 'shipping_method') { ?>
          <td class="left" colspan="2" nowrap="nowrap" style="background-color:#F0F0F0;"><?php echo $order['shipping_method']; ?></td>
		  <?php } ?>            
          <td id="sop20_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap"><?php echo $order['orders']; ?></td>
          <td id="sop21_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap"><?php echo $order['customers']; ?></td>    
          <td id="sop22_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap"><?php echo $order['products']; ?></td>
          <td id="sop23_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap"><span style="color:#090"><?php echo $order['sub_total']; ?></span></td>
          <td id="sop24_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap"><span style="color:#090"><?php echo $order['handling']; ?></span></td>
          <td id="sop25_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap"><span style="color:#090"><?php echo $order['low_order_fee']; ?></span></td>
          <td id="sop27_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap"><span <?php if ($adv_profit_reports_formula_sop1) { echo 'style="color:#090"'; } ?>><?php echo $order['shipping']; ?></span></td>
          <td id="sop26_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap"><span style="color:#090"><?php echo $order['reward']; ?></span></td>
          <td id="sop28_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap"><span style="color:#090"><?php echo $order['coupon']; ?></span></td>          
          <td id="sop29_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap"><?php echo $order['tax']; ?></td>
          <td id="sop30_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap"><span style="color:#090"><?php echo $order['credit']; ?></span></td>            
          <td id="sop31_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap"><span style="color:#090"><?php echo $order['voucher']; ?></span></td>                      
          <td id="sop33_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap"><?php echo $order['total']; ?></td>
          <td id="sop37_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap" style="background-color:#DCFFB9;"><?php echo $order['total_sales']; ?></td>            
          <td id="sop34_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap"><span style="color:#F00"><?php echo $order['prod_costs']; ?></span></td>           
          <td id="sop32_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap"><span style="color:#F00"><?php echo $order['commission']; ?></span></td>   
          <td id="sop391_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap"><span <?php if ($adv_profit_reports_formula_sop3) { echo 'style="color:#F00"'; } ?>><?php echo $order['pay_costs']; ?></span></td>
          <td id="sop392_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap"><span <?php if ($adv_profit_reports_formula_sop2) { echo 'style="color:#F00"'; } ?>><?php echo $order['ship_costs']; ?></span></td>  
          <td id="sop393_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap"><?php echo $order['ship_balance']; ?></td>                                               
          <td id="sop38_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap" style="background-color:#ffd7d7;"><?php echo $order['total_costs']; ?></td>         
          <td id="sop35_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap" <?php echo ($order['netprofit_raw'] >= 0) ? 'style="background-color:#c4d9ee; font-weight:bold;"' : 'style="background-color:#F99; font-weight:bold;"' ?> ><?php echo $order['netprofit']; ?></td>     
          <td id="sop36_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap" <?php echo ($order['netprofit_raw'] >= 0) ? 'style="background-color:#c4d9ee; font-weight:bold;"' : 'style="background-color:#F99; font-weight:bold;"' ?> ><?php echo $order['profit_margin_percent']; ?></td>                            
          <?php if ($filter_details == 1 OR $filter_details == 2 OR $filter_details == 3) { ?><td class="right" nowrap="nowrap">[ <a><?php echo $text_detail; ?></a> ]</td><?php } ?> 
          </tr>        
<tr class="detail">
<td colspan="25" class="center">
<?php if ($filter_details == 1) { ?>
<script type="text/javascript">$(function(){ 
$('#show_details_<?php echo $order["order_id"]; ?>').click(function() {
		$('#tab_details_<?php echo $order["order_id"]; ?>').slideToggle('slow');
	});
});
</script>
<div id="tab_details_<?php echo $order['order_id']; ?>" style="display:none">
    <table class="list_detail">
      <thead>
        <tr>
          <td id="sop40_<?php echo $order['order_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_order_order_id; ?></td>        
          <td id="sop41_<?php echo $order['order_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_order_date_added; ?></td>
          <td id="sop42_<?php echo $order['order_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_order_inv_no; ?></td>                  
          <td id="sop43_<?php echo $order['order_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_order_customer; ?></td>
          <td id="sop44_<?php echo $order['order_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_order_email; ?></td>
          <td id="sop45_<?php echo $order['order_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_order_customer_group; ?></td>
          <td id="sop46_<?php echo $order['order_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_order_shipping_method; ?></td>
          <td id="sop47_<?php echo $order['order_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_order_payment_method; ?></td>          
          <td id="sop48_<?php echo $order['order_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_order_status; ?></td>
          <td id="sop49_<?php echo $order['order_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_order_store; ?></td>
          <td id="sop50_<?php echo $order['order_id']; ?>_title" class="right" nowrap="nowrap"><?php echo $column_order_currency; ?></td>
          <td id="sop51_<?php echo $order['order_id']; ?>_title" class="right" nowrap="nowrap"><?php echo $column_order_quantity; ?></td>  
          <td id="sop52_<?php echo $order['order_id']; ?>_title" class="right" nowrap="nowrap"><?php echo $column_order_sub_total; ?></td>                               
          <td id="sop54_<?php echo $order['order_id']; ?>_title" class="right" nowrap="nowrap"><?php echo $column_order_shipping; ?></td>         
          <td id="sop55_<?php echo $order['order_id']; ?>_title" class="right" nowrap="nowrap"><?php echo $column_order_tax; ?></td>
          <td id="sop56_<?php echo $order['order_id']; ?>_title" class="right" nowrap="nowrap"><?php echo $column_order_value; ?></td>  
          <td id="sop53_<?php echo $order['order_id']; ?>_title" class="right" nowrap="nowrap"><?php echo $column_order_sales; ?></td>                    
          <td id="sop57_<?php echo $order['order_id']; ?>_title" class="right" nowrap="nowrap"><?php echo $column_order_costs; ?></td> 
          <td id="sop58_<?php echo $order['order_id']; ?>_title" class="right" nowrap="nowrap"><?php echo $column_order_profit; ?></td>
          <td id="sop59_<?php echo $order['order_id']; ?>_title" class="right" nowrap="nowrap"><?php echo $column_profit_margin; ?></td>         
        </tr>
      </thead>
        <tr bgcolor="#FFFFFF">
          <td id="sop40_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><a><?php echo $order['order_ord_id']; ?></a></td>        
          <td id="sop41_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['order_order_date']; ?></td>
          <td id="sop42_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['order_inv_no']; ?></td>
          <td id="sop43_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['order_name']; ?></td>
          <td id="sop44_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['order_email']; ?></td>
          <td id="sop45_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['order_group']; ?></td>
          <td id="sop46_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['order_shipping_method']; ?></td>
          <td id="sop47_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['order_payment_method']; ?></td>          
          <td id="sop48_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['order_status']; ?></td>
          <td id="sop49_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['order_store']; ?></td> 
          <td id="sop50_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap"><?php echo $order['order_currency']; ?></td>          
          <td id="sop51_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap"><?php echo $order['order_products']; ?></td> 
          <td id="sop52_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap"><?php echo $order['order_sub_total']; ?></td>                    
          <td id="sop54_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap"><?php echo $order['order_shipping']; ?></td>           
          <td id="sop55_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap"><?php echo $order['order_tax']; ?></td>                              
          <td id="sop56_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap"><?php echo $order['order_value']; ?></td>
          <td id="sop53_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap" style="background-color:#DCFFB9;"><?php echo $order['order_sales']; ?></td>           
          <td id="sop57_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap" style="background-color:#ffd7d7;">-<?php echo $order['order_costs']; ?></td>
          <td id="sop58_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap" style="background-color:#c4d9ee; font-weight:bold;"><?php echo $order['order_profit']; ?></td> 
          <td id="sop59_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap" style="background-color:#c4d9ee; font-weight:bold;"><?php echo $order['order_profit_margin_percent']; ?>%</td>      
         </tr>
    </table>  
</div>
<?php } ?>    
<?php if ($filter_details == 2) { ?>
<script type="text/javascript">$(function(){ 
$('#show_details_<?php echo $order["order_id"]; ?>').click(function() {
		$('#tab_details_<?php echo $order["order_id"]; ?>').slideToggle('slow');
	});
});
</script>
<div id="tab_details_<?php echo $order['order_id']; ?>" style="display:none">
    <table class="list_detail">
      <thead>
        <tr>
          <td id="sop60_<?php echo $order['order_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_prod_order_id; ?></td>  
          <td id="sop61_<?php echo $order['order_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_prod_date_added; ?></td>
          <td id="sop62_<?php echo $order['order_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_prod_inv_no; ?></td> 
          <td id="sop63_<?php echo $order['order_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_prod_id; ?></td>                                          
          <td id="sop64_<?php echo $order['order_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_prod_sku; ?></td>
          <td id="sop65_<?php echo $order['order_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_prod_model; ?></td>            
          <td id="sop66_<?php echo $order['order_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_prod_name; ?></td> 
          <td id="sop67_<?php echo $order['order_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_prod_option; ?></td>           
          <td id="sop77_<?php echo $order['order_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_prod_attributes; ?></td>                      
          <td id="sop68_<?php echo $order['order_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_prod_manu; ?></td> 
          <td id="sop79_<?php echo $order['order_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_prod_category; ?></td>           
          <td id="sop69_<?php echo $order['order_id']; ?>_title" class="right" nowrap="nowrap"><?php echo $column_prod_currency; ?></td>   
          <td id="sop70_<?php echo $order['order_id']; ?>_title" class="right" nowrap="nowrap"><?php echo $column_prod_price; ?></td>                     
          <td id="sop71_<?php echo $order['order_id']; ?>_title" class="right" nowrap="nowrap"><?php echo $column_prod_quantity; ?></td> 
          <td id="sop72a_<?php echo $order['order_id']; ?>_title" class="right" nowrap="nowrap"><?php echo $column_prod_total_excl_vat; ?></td>                    
          <td id="sop73_<?php echo $order['order_id']; ?>_title" class="right" nowrap="nowrap"><?php echo $column_prod_tax; ?></td>                   
          <td id="sop72b_<?php echo $order['order_id']; ?>_title" class="right" nowrap="nowrap"><?php echo $column_prod_total_incl_vat; ?></td>
          <td id="sop72c_<?php echo $order['order_id']; ?>_title" class="right" nowrap="nowrap"><?php echo $column_prod_sales; ?></td>             
          <td id="sop74_<?php echo $order['order_id']; ?>_title" class="right" nowrap="nowrap"><?php echo $column_prod_costs; ?></td>           
          <td id="sop75_<?php echo $order['order_id']; ?>_title" class="right" nowrap="nowrap"><?php echo $column_prod_profit; ?></td>
          <td id="sop76_<?php echo $order['order_id']; ?>_title" class="right" nowrap="nowrap"><?php echo $column_profit_margin; ?></td>  
        </tr>
      </thead>
        <tr bgcolor="#FFFFFF">
          <td id="sop60_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><a><?php echo $order['product_ord_id']; ?></a></td>  
          <td id="sop61_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['product_order_date']; ?></td>
          <td id="sop62_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['product_inv_no']; ?></td>
          <td id="sop63_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['product_pid']; ?></td>  
          <td id="sop64_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['product_sku']; ?></td>
          <td id="sop65_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['product_model']; ?></td>                 
          <td id="sop66_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['product_name']; ?></td> 
          <td id="sop67_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['product_option']; ?></td>            
          <td id="sop77_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['product_attributes']; ?></td>                    
          <td id="sop68_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['product_manu']; ?></td> 
          <td id="sop79_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['product_category']; ?></td>           
          <td id="sop69_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap"><?php echo $order['product_currency']; ?></td> 
          <td id="sop70_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap"><?php echo $order['product_price']; ?></td> 
          <td id="sop71_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap"><?php echo $order['product_quantity']; ?></td> 
          <td id="sop72a_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap"><?php echo $order['product_total_excl_vat']; ?></td>  
          <td id="sop73_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap"><?php echo $order['product_tax']; ?></td>  
          <td id="sop72b_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap"><?php echo $order['product_total_incl_vat']; ?></td>
          <td id="sop72c_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap" style="background-color:#DCFFB9;"><?php echo $order['product_sales']; ?></td>                       
          <td id="sop74_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap" style="background-color:#ffd7d7;">-<?php echo $order['product_costs']; ?></td>         
          <td id="sop75_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap" style="background-color:#c4d9ee; font-weight:bold;"><?php echo $order['product_profit']; ?></td>
          <td id="sop76_<?php echo $order['order_id']; ?>" class="right" nowrap="nowrap" style="background-color:#c4d9ee; font-weight:bold;"><?php echo $order['product_profit_margin_percent']; ?>%</td>   
         </tr>       
    </table>
</div> 
<?php } ?>  
<?php if ($filter_details == 3) { ?>
<script type="text/javascript">$(function(){ 
$('#show_details_<?php echo $order["order_id"]; ?>').click(function() {
		$('#tab_details_<?php echo $order["order_id"]; ?>').slideToggle('slow');
	});
});
</script>
<div id="tab_details_<?php echo $order['order_id']; ?>" style="display:none">
    <table class="list_detail">
      <thead>
        <tr>
          <td id="sop80_<?php echo $order['order_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_customer_order_id; ?></td>        
          <td id="sop81_<?php echo $order['order_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_customer_date_added; ?></td>
          <td id="sop82_<?php echo $order['order_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_customer_inv_no; ?></td>           
          <td id="sop83_<?php echo $order['order_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_customer_cust_id; ?></td>           
          <td id="sop84_<?php echo $order['order_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_billing_name; ?></td> 
          <td id="sop85_<?php echo $order['order_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_billing_company; ?></td> 
          <td id="sop86_<?php echo $order['order_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_billing_address_1; ?></td> 
          <td id="sop87_<?php echo $order['order_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_billing_address_2; ?></td> 
          <td id="sop88_<?php echo $order['order_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_billing_city; ?></td>
          <td id="sop89_<?php echo $order['order_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_billing_zone; ?></td> 
          <td id="sop90_<?php echo $order['order_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_billing_postcode; ?></td>
          <td id="sop91_<?php echo $order['order_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_billing_country; ?></td>
          <td id="sop92_<?php echo $order['order_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_customer_telephone; ?></td>
          <td id="sop93_<?php echo $order['order_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_shipping_name; ?></td> 
          <td id="sop94_<?php echo $order['order_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_shipping_company; ?></td> 
          <td id="sop95_<?php echo $order['order_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_shipping_address_1; ?></td> 
          <td id="sop96_<?php echo $order['order_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_shipping_address_2; ?></td> 
          <td id="sop97_<?php echo $order['order_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_shipping_city; ?></td>
          <td id="sop98_<?php echo $order['order_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_shipping_zone; ?></td> 
          <td id="sop99_<?php echo $order['order_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_shipping_postcode; ?></td>
          <td id="sop100_<?php echo $order['order_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_shipping_country; ?></td>          
        </tr>
      </thead>
        <tr bgcolor="#FFFFFF">
          <td id="sop80_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['customer_ord_id']; ?></td>        
          <td id="sop81_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['customer_order_date']; ?></td>
          <td id="sop82_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['customer_inv_no']; ?></td>
          <td id="sop83_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['customer_cust_id']; ?></td>             
          <td id="sop84_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['billing_name']; ?></td>         
          <td id="sop85_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['billing_company']; ?></td> 
          <td id="sop86_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['billing_address_1']; ?></td> 
          <td id="sop87_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['billing_address_2']; ?></td> 
          <td id="sop88_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['billing_city']; ?></td> 
          <td id="sop89_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['billing_zone']; ?></td> 
          <td id="sop90_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['billing_postcode']; ?></td>                    
          <td id="sop91_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['billing_country']; ?></td>
          <td id="sop92_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['customer_telephone']; ?></td> 
          <td id="sop93_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['shipping_name']; ?></td>         
          <td id="sop94_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['shipping_company']; ?></td> 
          <td id="sop95_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['shipping_address_1']; ?></td> 
          <td id="sop96_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['shipping_address_2']; ?></td> 
          <td id="sop97_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['shipping_city']; ?></td> 
          <td id="sop98_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['shipping_zone']; ?></td> 
          <td id="sop99_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['shipping_postcode']; ?></td>                    
          <td id="sop100_<?php echo $order['order_id']; ?>" class="left" nowrap="nowrap"><?php echo $order['shipping_country']; ?></td>          
         </tr>
    </table>
</div> 
<?php } ?>
</td>
</tr>          
        <?php } ?>
        <tr>
        <td colspan="25"></td>
        </tr>       
        <tr>
          <td colspan="2" class="right" style="background-color:#E7EFEF;"><strong><?php echo $text_filter_total; ?></strong></td>
          <td id="sop20_total" class="right" nowrap="nowrap" style="background-color:#E7EFEF; color:#003A88;"><strong><?php echo $order['orders_total']; ?></strong></td> 
          <td id="sop21_total" class="right" nowrap="nowrap" style="background-color:#E7EFEF; color:#003A88;"><strong><?php echo $order['customers_total']; ?></strong></td> 
          <td id="sop22_total" class="right" nowrap="nowrap" style="background-color:#E7EFEF; color:#003A88;"><strong><?php echo $order['products_total']; ?></strong></td> 
          <td id="sop23_total" class="right" nowrap="nowrap" style="background-color:#E7EFEF; color:#003A88;"><strong><?php echo $order['sub_total_total']; ?></strong></td> 
          <td id="sop24_total" class="right" nowrap="nowrap" style="background-color:#E7EFEF; color:#003A88;"><strong><?php echo $order['handling_total']; ?></strong></td> 
          <td id="sop25_total" class="right" nowrap="nowrap" style="background-color:#E7EFEF; color:#003A88;"><strong><?php echo $order['low_order_fee_total']; ?></strong></td> 
          <td id="sop27_total" class="right" nowrap="nowrap" style="background-color:#E7EFEF; color:#003A88;"><strong><?php echo $order['shipping_total']; ?></strong></td>
          <td id="sop26_total" class="right" nowrap="nowrap" style="background-color:#E7EFEF; color:#003A88;"><strong><?php echo $order['reward_total']; ?></strong></td> 
          <td id="sop28_total" class="right" nowrap="nowrap" style="background-color:#E7EFEF; color:#003A88;"><strong><?php echo $order['coupon_total']; ?></strong></td> 
          <td id="sop29_total" class="right" nowrap="nowrap" style="background-color:#E7EFEF; color:#003A88;"><strong><?php echo $order['tax_total']; ?></strong></td>
          <td id="sop30_total" class="right" nowrap="nowrap" style="background-color:#E7EFEF; color:#003A88;"><strong><?php echo $order['credit_total']; ?></strong></td> 
          <td id="sop31_total" class="right" nowrap="nowrap" style="background-color:#E7EFEF; color:#003A88;"><strong><?php echo $order['voucher_total']; ?></strong></td>    
          <td id="sop33_total" class="right" nowrap="nowrap" style="background-color:#E7EFEF; color:#003A88;"><strong><?php echo $order['total_total']; ?></strong></td> 
          <td id="sop37_total" class="right" nowrap="nowrap" style="background-color:#DCFFB9; color:#003A88;"><strong><?php echo $order['total_sales_total']; ?></strong></td>           
          <td id="sop34_total" class="right" nowrap="nowrap" style="background-color:#E7EFEF; color:#003A88;"><strong><?php echo $order['prod_costs_total']; ?></strong></td>                              
          <td id="sop32_total" class="right" nowrap="nowrap" style="background-color:#E7EFEF; color:#003A88;"><strong><?php echo $order['commission_total']; ?></strong></td>   
          <td id="sop391_total" class="right" nowrap="nowrap" style="background-color:#E7EFEF; color:#003A88;"><strong><?php echo $order['pay_costs_total']; ?></strong></td> 
          <td id="sop392_total" class="right" nowrap="nowrap" style="background-color:#E7EFEF; color:#003A88;"><strong><?php echo $order['ship_costs_total']; ?></strong></td> 
          <td id="sop393_total" class="right" nowrap="nowrap" style="background-color:#E7EFEF; color:#003A88;"><strong><?php echo $order['ship_balance_total']; ?></strong></td>                                       
          <td id="sop38_total" class="right" nowrap="nowrap" style="background-color:#ffd7d7; color:#003A88;"><strong><?php echo $order['total_costs_total']; ?></strong></td>           
          <td id="sop35_total" class="right" nowrap="nowrap" <?php echo ($order['netprofit_total_raw'] >= 0) ? 'style="background-color:#c4d9ee; color:#003A88;"' : 'style="background-color:#F99; color:#003A88;"' ?> ><strong><?php echo $order['netprofit_total']; ?></strong></td>           
          <td id="sop36_total" class="right" nowrap="nowrap" <?php echo ($order['netprofit_total_raw'] >= 0) ? 'style="background-color:#c4d9ee; color:#003A88;"' : 'style="background-color:#F99; color:#003A88;"' ?> ><strong><?php echo $order['profit_margin_total_percent']; ?></strong></td>          
          <?php if ($filter_details == 1 OR $filter_details == 2 OR $filter_details == 3) { ?><td></td><?php } ?>                  
        </tr>           
          <?php } else { ?>
          <tr>
          <td class="noresult" colspan="25"><?php echo $text_no_results; ?></td>
          </tr>
          <?php } ?>  
          </tbody>                     
      </table>
<?php } ?>
    </div>
      <?php if ($orders) { ?>    
      <div class="pagination_report"></div>
      <?php } ?>       
    </div>
    </div>    
  </div>
</div>  
</form>
<script type="text/javascript" src="view/javascript/jquery/jquery.multiselect.js"></script>
<script type="text/javascript" src="view/javascript/jquery/jquery.paging.min.js"></script>
<script type="text/javascript" src="view/javascript/jquery/vtip.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#filter_order_status_id').multiSelect({
      selectAll:'true', selectAllText:'<?php echo $text_all; ?>', noneSelected:'<?php echo $text_all_status; ?>', oneOrMoreSelected:'<?php echo $text_selected; ?>'
      });
	
    $('#filter_store_id').multiSelect({
      selectAll:'true', selectAllText:'<?php echo $text_all; ?>', noneSelected:'<?php echo $text_all_stores; ?>', oneOrMoreSelected:'<?php echo $text_selected; ?>'
      });
	
    $('#filter_currency').multiSelect({
      selectAll:'true', selectAllText:'<?php echo $text_all; ?>', noneSelected:'<?php echo $text_all_currencies; ?>', oneOrMoreSelected:'<?php echo $text_selected; ?>'
      });

    $('#filter_taxes').multiSelect({
      selectAll:'true', selectAllText:'<?php echo $text_all; ?>', noneSelected:'<?php echo $text_all_taxes; ?>', oneOrMoreSelected:'<?php echo $text_selected; ?>'
      });

    $('#filter_tax_classes').multiSelect({
      selectAll:'true', selectAllText:'<?php echo $text_all; ?>', noneSelected:'<?php echo $text_all_tax_classes; ?>', oneOrMoreSelected:'<?php echo $text_selected; ?>'
      });
	
    $('#filter_geo_zones').multiSelect({
      selectAll:'true', selectAllText:'<?php echo $text_all; ?>', noneSelected:'<?php echo $text_all_zones; ?>', oneOrMoreSelected:'<?php echo $text_selected; ?>'
      });
	
    $('#filter_customer_group_id').multiSelect({
      selectAll:'true', selectAllText:'<?php echo $text_all; ?>', noneSelected:'<?php echo $text_all_groups; ?>', oneOrMoreSelected:'<?php echo $text_selected; ?>'
      });

    $('#filter_payment_method').multiSelect({
      selectAll:'true', selectAllText:'<?php echo $text_all; ?>', noneSelected:'<?php echo $text_all_payment_methods; ?>', oneOrMoreSelected:'<?php echo $text_selected; ?>'
      });

    $('#filter_shipping_method').multiSelect({
      selectAll:'true', selectAllText:'<?php echo $text_all; ?>', noneSelected:'<?php echo $text_all_shipping_methods; ?>', oneOrMoreSelected:'<?php echo $text_selected; ?>'
      });

    $('#filter_category').multiSelect({
      selectAll:'true', selectAllText:'<?php echo $text_all; ?>', noneSelected:'<?php echo $text_all_categories; ?>', oneOrMoreSelected:'<?php echo $text_selected; ?>'
      });

    $('#filter_manufacturer').multiSelect({
      selectAll:'true', selectAllText:'<?php echo $text_all; ?>', noneSelected:'<?php echo $text_all_manufacturers; ?>', oneOrMoreSelected:'<?php echo $text_selected; ?>'
      });
	
    $('#filter_option').multiSelect({
      selectAll:'true', selectAllText:'<?php echo $text_all; ?>', noneSelected:'<?php echo $text_all_options; ?>', oneOrMoreSelected:'<?php echo $text_selected; ?>'
      });

    $('#filter_attribute').multiSelect({
      selectAll:'true', selectAllText:'<?php echo $text_all; ?>', noneSelected:'<?php echo $text_all_attributes; ?>', oneOrMoreSelected:'<?php echo $text_selected; ?>'
      });
	
    $('#filter_location').multiSelect({
      selectAll:'true', selectAllText:'<?php echo $text_all; ?>', noneSelected:'<?php echo $text_all_locations; ?>', oneOrMoreSelected:'<?php echo $text_selected; ?>'
      });

    $('#filter_affiliate_name').multiSelect({
      selectAll:'true', selectAllText:'<?php echo $text_all; ?>', noneSelected:'<?php echo $text_all_affiliate_names; ?>', oneOrMoreSelected:'<?php echo $text_selected; ?>'
      });

    $('#filter_affiliate_email').multiSelect({
      selectAll:'true', selectAllText:'<?php echo $text_all; ?>', noneSelected:'<?php echo $text_all_affiliate_emails; ?>', oneOrMoreSelected:'<?php echo $text_selected; ?>'
      });
	
    $('#filter_coupon_name').multiSelect({
      selectAll:'true', selectAllText:'<?php echo $text_all; ?>', noneSelected:'<?php echo $text_all_coupon_names; ?>', oneOrMoreSelected:'<?php echo $text_selected; ?>'
      });
	
    $('#export_xls').click(function() {
      $('#export').val('1') ; // export_xls: #1
      $('#report').attr('target', '_blank'); // opening file in a new window
      $('#report').submit() ;
      $('#report').attr('target', '_self'); // preserve current form      
      $('#export').val('') ; 
      return(false)
    });	
	
    $('#export_xls_order_list').click(function() {
      $('#export').val('2') ; // export_xls_order_list: #2
      $('#report').attr('target', '_blank'); // opening file in a new window
      $('#report').submit() ;
      $('#report').attr('target', '_self'); // preserve current form      
      $('#export').val('') ; 
      return(false)
    });	

    $('#export_xls_product_list').click(function() {
      $('#export').val('3') ; // export_xls_product_list: #3
      $('#report').attr('target', '_blank'); // opening file in a new window
      $('#report').submit() ;
      $('#report').attr('target', '_self'); // preserve current form      
      $('#export').val('') ; 
      return(false)
    });	

    $('#export_xls_customer_list').click(function() {
      $('#export').val('4') ; // export_xls_customer_list: #4
      $('#report').attr('target', '_blank'); // opening file in a new window
      $('#report').submit() ;
      $('#report').attr('target', '_self'); // preserve current form      
      $('#export').val('') ; 
      return(false)
    });	
	
    $('#export_xls_all_details').click(function() {
      $('#export').val('5') ; // export_xls_all_details: #5
      $('#report').attr('target', '_blank'); // opening file in a new window
      $('#report').submit() ;
      $('#report').attr('target', '_self'); // preserve current form      
      $('#export').val('') ; 
      return(false)
    });	
	
    $('#export_html').click(function() {
      $('#export').val('6') ; // export_html: #6
      $('#report').attr('target', '_blank'); // opening file in a new window
      $('#report').submit() ;
      $('#report').attr('target', '_self'); // preserve current form      
      $('#export').val('') ; 
      return(false)
    });	
	
    $('#export_html_order_list').click(function() {
      $('#export').val('7') ; // export_html_order_list: #7
      $('#report').attr('target', '_blank'); // opening file in a new window
      $('#report').submit() ;
      $('#report').attr('target', '_self'); // preserve current form      
      $('#export').val('') ; 
      return(false)
    });	
	
    $('#export_html_product_list').click(function() {
      $('#export').val('8') ; // export_html_product_list: #8
      $('#report').attr('target', '_blank'); // opening file in a new window
      $('#report').submit() ;
      $('#report').attr('target', '_self'); // preserve current form      
      $('#export').val('') ; 
      return(false)
    });		
	
    $('#export_html_customer_list').click(function() {
      $('#export').val('9') ; // export_html_customer_list: #9
      $('#report').attr('target', '_blank'); // opening file in a new window
      $('#report').submit() ;
      $('#report').attr('target', '_self'); // preserve current form      
      $('#export').val('') ; 
      return(false)
    });	
	
    $('#export_html_all_details').click(function() {
      $('#export').val('10') ; // export_html_all_details: #10
      $('#report').attr('target', '_blank'); // opening file in a new window
      $('#report').submit() ;
      $('#report').attr('target', '_self'); // preserve current form      
      $('#export').val('') ; 
      return(false)
    });	
	
    $('#export_pdf').click(function() {
      $('#export').val('11') ; // export_pdf: #11
      $('#report').attr('target', '_blank'); // opening file in a new window
      $('#report').submit() ;
      $('#report').attr('target', '_self'); // preserve current form      
      $('#export').val('') ; 
      return(false)
    });	
	
    $('#export_pdf_order_list').click(function() {
      $('#export').val('12') ; // export_pdf_order_list: #12
      $('#report').attr('target', '_blank'); // opening file in a new window
      $('#report').submit() ;
      $('#report').attr('target', '_self'); // preserve current form      
      $('#export').val('') ; 
      return(false)
    });	
	
    $('#export_pdf_product_list').click(function() {
      $('#export').val('13') ; // export_pdf_product_list: #13
      $('#report').attr('target', '_blank'); // opening file in a new window
      $('#report').submit() ;
      $('#report').attr('target', '_self'); // preserve current form      
      $('#export').val('') ; 
      return(false)
    });		
	
    $('#export_pdf_customer_list').click(function() {
      $('#export').val('14') ; // export_pdf_customer_list: #14
      $('#report').attr('target', '_blank'); // opening file in a new window
      $('#report').submit() ;
      $('#report').attr('target', '_self'); // preserve current form      
      $('#export').val('') ; 
      return(false)
    });	
	
    $('#export_pdf_all_details').click(function() {
      $('#export').val('15') ; // export_pdf_all_details: #15
      $('#report').attr('target', '_blank'); // opening file in a new window
      $('#report').submit() ;
      $('#report').attr('target', '_self'); // preserve current form      
      $('#export').val('') ; 
      return(false)
    });	
	
    $('#export_csv').click(function() {
      $('#export').val('16') ; // export_csv: #16
      $('#report').attr('target', '_blank'); // opening file in a new window
      $('#report').submit() ;
      $('#report').attr('target', '_self'); // preserve current form      
      $('#export').val('') ; 
      return(false)
    });
	
    $('#export_csv_all_details').click(function() {
      $('#export').val('17') ; // export_csv_all_details: #17
      $('#report').attr('target', '_blank'); // opening file in a new window
      $('#report').submit() ;
      $('#report').attr('target', '_self'); // preserve current form      
      $('#export').val('') ; 
      return(false)
    });	
	
    $('#export_xlsx').click(function() {
      $('#export').val('18') ; // export_xlsx: #18
      $('#report').attr('target', '_blank'); // opening file in a new window
      $('#report').submit() ;
      $('#report').attr('target', '_self'); // preserve current form      
      $('#export').val('') ; 
      return(false)
    });
	
    $('#export_xlsx_all_details').click(function() {
      $('#export').val('19') ; // export_xlsx_all_details: #19
      $('#report').attr('target', '_blank'); // opening file in a new window
      $('#report').submit() ;
      $('#report').attr('target', '_self'); // preserve current form      
      $('#export').val('') ; 
      return(false)
    });		
});
</script>  
<script type="text/javascript"><!--
$('input[name=\'filter_customer_name\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=report/adv_sale_profit/customer_autocomplete&token=<?php echo $token; ?>&filter_customer_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['cust_name'],
						value: item['customer_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_customer_name\']').val(item['label']);
	}
});

$('input[name=\'filter_customer_email\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=report/adv_sale_profit/customer_autocomplete&token=<?php echo $token; ?>&filter_customer_email=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['cust_email'],
						value: item['customer_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_customer_email\']').val(item['label']);
	}
});

$('input[name=\'filter_customer_telephone\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=report/adv_sale_profit/customer_autocomplete&token=<?php echo $token; ?>&filter_customer_telephone=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['cust_telephone'],
						value: item['customer_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_customer_telephone\']').val(item['label']);
	}
});

$('input[name=\'filter_ip\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=report/adv_sale_profit/customer_autocomplete&token=<?php echo $token; ?>&filter_ip=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['cust_ip'],
						value: item['customer_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_ip\']').val(item['label']);
	}
});

$('input[name=\'filter_payment_company\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=report/adv_sale_profit/customer_autocomplete&token=<?php echo $token; ?>&filter_payment_company=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['payment_company'],
						value: item['customer_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_payment_company\']').val(item['label']);
	}
});

$('input[name=\'filter_payment_address\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=report/adv_sale_profit/customer_autocomplete&token=<?php echo $token; ?>&filter_payment_address=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['payment_address'],
						value: item['customer_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_payment_address\']').val(item['label']);
	}
});

$('input[name=\'filter_payment_city\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=report/adv_sale_profit/customer_autocomplete&token=<?php echo $token; ?>&filter_payment_city=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['payment_city'],
						value: item['customer_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_payment_city\']').val(item['label']);
	}
});

$('input[name=\'filter_payment_zone\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=report/adv_sale_profit/customer_autocomplete&token=<?php echo $token; ?>&filter_payment_zone=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['payment_zone'],
						value: item['customer_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_payment_zone\']').val(item['label']);
	}
});

$('input[name=\'filter_payment_postcode\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=report/adv_sale_profit/customer_autocomplete&token=<?php echo $token; ?>&filter_payment_postcode=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['payment_postcode'],
						value: item['customer_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_payment_postcode\']').val(item['label']);
	}
});

$('input[name=\'filter_payment_country\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=report/adv_sale_profit/customer_autocomplete&token=<?php echo $token; ?>&filter_payment_country=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['payment_country'],
						value: item['customer_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_payment_country\']').val(item['label']);
	}
});

$('input[name=\'filter_shipping_company\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=report/adv_sale_profit/customer_autocomplete&token=<?php echo $token; ?>&filter_shipping_company=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['shipping_company'],
						value: item['customer_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_shipping_company\']').val(item['label']);
	}
});

$('input[name=\'filter_shipping_address\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=report/adv_sale_profit/customer_autocomplete&token=<?php echo $token; ?>&filter_shipping_address=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['shipping_address'],
						value: item['customer_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_shipping_address\']').val(item['label']);
	}
});

$('input[name=\'filter_shipping_city\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=report/adv_sale_profit/customer_autocomplete&token=<?php echo $token; ?>&filter_shipping_city=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['shipping_city'],
						value: item['customer_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_shipping_city\']').val(item['label']);
	}
});

$('input[name=\'filter_shipping_zone\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=report/adv_sale_profit/customer_autocomplete&token=<?php echo $token; ?>&filter_shipping_zone=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['shipping_zone'],
						value: item['customer_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_shipping_zone\']').val(item['label']);
	}
});

$('input[name=\'filter_shipping_postcode\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=report/adv_sale_profit/customer_autocomplete&token=<?php echo $token; ?>&filter_shipping_postcode=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['shipping_postcode'],
						value: item['customer_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_shipping_postcode\']').val(item['label']);
	}
});

$('input[name=\'filter_shipping_country\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=report/adv_sale_profit/customer_autocomplete&token=<?php echo $token; ?>&filter_shipping_country=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['shipping_country'],
						value: item['customer_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_shipping_country\']').val(item['label']);
	}
});

$('input[name=\'filter_sku\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=report/adv_sale_profit/product_autocomplete&token=<?php echo $token; ?>&filter_sku=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['prod_sku'],
						value: item['product_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_sku\']').val(item['label']);
	}
});

$('input[name=\'filter_product_id\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=report/adv_sale_profit/product_autocomplete&token=<?php echo $token; ?>&filter_product_id=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['prod_name'],
						value: item['product_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_product_id\']').val(item['label']);
	}
});

$('input[name=\'filter_model\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=report/adv_sale_profit/product_autocomplete&token=<?php echo $token; ?>&filter_model=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['prod_model'],
						value: item['product_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_model\']').val(item['label']);
	}
});

$('input[name=\'filter_coupon_code\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=report/adv_sale_profit/coupon_autocomplete&token=<?php echo $token; ?>&filter_coupon_code=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['coupon_code'],
						value: item['coupon_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_coupon_code\']').val(item['label']);
	}
});

$('input[name=\'filter_voucher_code\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=report/adv_sale_profit/voucher_autocomplete&token=<?php echo $token; ?>&filter_voucher_code=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['voucher_code'],
						value: item['voucher_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_voucher_code\']').val(item['label']);
	}
});
//--></script> 
<?php if ($orders) { ?> 
	<?php if ($filter_report == 'sales_summary') { ?> 
	<?php if ($filter_details != '4' && ($filter_group == 'year' or $filter_group == 'quarter' or $filter_group == 'month')) { ?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript"><!--
	google.load('visualization', '1', {packages: ['corechart']});
      google.setOnLoadCallback(drawChart);      
	  function drawChart() {        
	  	var data = google.visualization.arrayToDataTable([
			<?php if ($orders && $filter_group == 'month') {
				echo "['" . $column_month . "','". $column_orders . "','" . $column_customers . "','" . $column_products . "'],";
					foreach ($orders as $key => $order) {
						if (count($orders)==($key+1)) {
							echo "['" . $order['year_month'] . "',". $order['orders'] . ",". $order['customers'] . ",". $order['products'] . "]";
						} else {
							echo "['" . $order['year_month'] . "',". $order['orders'] . ",". $order['customers'] . ",". $order['products'] . "],";
						}
					}	
			} elseif ($orders && $filter_group == 'quarter') {
				echo "['" . $column_quarter . "','". $column_orders . "','" . $column_customers . "','" . $column_products . "'],";
					foreach ($orders as $key => $order) {
						if (count($orders)==($key+1)) {
							echo "['" . $order['year_quarter'] . "',". $order['orders'] . ",". $order['customers'] . ",". $order['products'] . "]";
						} else {
							echo "['" . $order['year_quarter'] . "',". $order['orders'] . ",". $order['customers'] . ",". $order['products'] . "],";
						}
					}	
			} elseif ($orders && $filter_group == 'year') {
				echo "['" . $column_year . "','". $column_orders . "','" . $column_customers . "','" . $column_products . "'],";
					foreach ($orders as $key => $order) {
						if (count($orders)==($key+1)) {
							echo "['" . $order['year'] . "',". $order['orders'] . ",". $order['customers'] . ",". $order['products'] . "]";
						} else {
							echo "['" . $order['year'] . "',". $order['orders'] . ",". $order['customers'] . ",". $order['products'] . "],";
						}
					}	
			} 
			;?>
		]);

        var options = {
			<?php if ($orders && $filter_group == 'month') {
				echo "title: 'Sales Summary by Month'";
			} elseif ($orders && $filter_group == 'quarter') {
				echo "title: 'Sales Summary by Quarter'";	
			} elseif ($orders && $filter_group == 'year') {
				echo "title: 'Sales Summary by Year'";	
			} 
			;?>,
			width: 605,	
			height: 266,  
			colors: ['#edc240', '#9dc7e8', '#CCCCCC'],
			chartArea: {left: 45, top: 30, width: "75%", height: "70%"},
			hAxis: {direction: -1},
			pointSize: '4',
			legend: {position: 'right', alignment: 'start', textStyle: {color: '#666666', fontSize: 12}}
		};

			var chart = new google.visualization.LineChart(document.getElementById('chart1_sales_summary'));
			chart.draw(data, options);
	}
//--></script>
<script type="text/javascript"><!--
	google.load('visualization', '1', {packages: ['corechart']});
      google.setOnLoadCallback(drawChart);      
	  function drawChart() { 
   		var data = google.visualization.arrayToDataTable([
			<?php if ($orders && $filter_group == 'month') {
				echo "['" . $column_month . "','". $column_grevenue . "','" . $column_gexpenses . "','" . $column_gprofit . "'],";
					foreach ($orders as $key => $order) {
						if (count($orders)==($key+1)) {
							echo "['" . $order['year_month'] . "',". $order['gsales'] . ",". $order['gcosts'] . ",". $order['gnetprofit'] . "]";
						} else {
							echo "['" . $order['year_month'] . "',". $order['gsales'] . ",". $order['gcosts'] . ",". $order['gnetprofit'] . "],";
						}
					}	
			} elseif ($orders && $filter_group == 'quarter') {
				echo "['" . $column_quarter . "','". $column_grevenue . "','" . $column_gexpenses . "','" . $column_gprofit . "'],";
					foreach ($orders as $key => $order) {
						if (count($orders)==($key+1)) {
							echo "['" . $order['year_quarter'] . "',". $order['gsales'] . ",". $order['gcosts'] . ",". $order['gnetprofit'] . "]";
						} else {
							echo "['" . $order['year_quarter'] . "',". $order['gsales'] . ",". $order['gcosts'] . ",". $order['gnetprofit'] . "],";
						}
					}	
			} elseif ($orders && $filter_group == 'year') {
				echo "['" . $column_year . "','". $column_grevenue . "','" . $column_gexpenses . "','" . $column_gprofit . "'],";
					foreach ($orders as $key => $order) {
						if (count($orders)==($key+1)) {
							echo "['" . $order['year'] . "',". $order['gsales'] . ",". $order['gcosts'] . ",". $order['gnetprofit'] . "]";
						} else {
							echo "['" . $order['year'] . "',". $order['gsales'] . ",". $order['gcosts'] . ",". $order['gnetprofit'] . "],";
						}
					}	
			} 
			;?>
		]);

        var options = {
			<?php if ($orders && $filter_group == 'month') {
				echo "title: 'Sales Summary by Month'";
			} elseif ($orders && $filter_group == 'quarter') {
				echo "title: 'Sales Summary by Quarter'";	
			} elseif ($orders && $filter_group == 'year') {
				echo "title: 'Sales Summary by Year'";	
			} 
			;?>,				
			width: 605,	
			height: 266,  
			colors: ['#b5e08b', '#ed9999', '#739cc3'],
			chartArea: {left: 45, top: 30, width: "75%", height: "70%"},
			hAxis: {direction: -1},
			legend: {position: 'right', alignment: 'start', textStyle: {color: '#666666', fontSize: 12}},				
			seriesType: "bars",
			series: {2: {type: "area", lineWidth: '3', pointSize: '5'}}
		};

			var chart = new google.visualization.ComboChart(document.getElementById('chart2_sales_summary'));
			chart.draw(data, options);
	}
//--></script>
	<?php } ?>
	<?php } elseif ($filter_report == 'day_of_week') { ?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript"><!--
	google.load('visualization', '1', {packages: ['corechart']});
      google.setOnLoadCallback(drawChart);      
	  function drawChart() {        
	  	var data = google.visualization.arrayToDataTable([
			<?php echo "['" . $column_day_of_week . "','". $column_orders . "','" . $column_customers . "','" . $column_products . "'],";
					foreach ($orders as $key => $order) {
						if (count($orders)==($key+1)) {
							echo "['" . $order['day_of_week'] . "',". $order['orders'] . ",". $order['customers'] . ",". $order['products'] . "]";
						} else {
							echo "['" . $order['day_of_week'] . "',". $order['orders'] . ",". $order['customers'] . ",". $order['products'] . "],";
						}
					}
			;?>
		]);

        var options = {
			title: 'Sales by Day of Week',			
			width: 605,	
			height: 266,  
			colors: ['#edc240', '#9dc7e8', '#CCCCCC'],
			chartArea: {left: 45, top: 30, width: "75%", height: "70%"},
			pointSize: '4',
			legend: {position: 'right', alignment: 'start', textStyle: {color: '#666666', fontSize: 12}}
		};

			var chart = new google.visualization.LineChart(document.getElementById('chart1_day_of_week'));
			chart.draw(data, options);
	}
//--></script>
<script type="text/javascript"><!--
	google.load('visualization', '1', {packages: ['corechart']});
      google.setOnLoadCallback(drawChart);      
	  function drawChart() { 
   		var data = google.visualization.arrayToDataTable([
			<?php echo "['" . $column_day_of_week . "','". $column_grevenue . "','" . $column_gexpenses . "','" . $column_gprofit . "'],";
					foreach ($orders as $key => $order) {
						if (count($orders)==($key+1)) {
							echo "['" . $order['day_of_week'] . "',". $order['gsales'] . ",". $order['gcosts'] . ",". $order['gnetprofit'] . "]";
						} else {
							echo "['" . $order['day_of_week'] . "',". $order['gsales'] . ",". $order['gcosts'] . ",". $order['gnetprofit'] . "],";
						}
					}
			;?>
		]);

        var options = {
			title: 'Sales by Day of Week',				
			width: 605,	
			height: 266,  
			colors: ['#b5e08b', '#ed9999', '#739cc3'],
			chartArea: {left: 45, top: 30, width: "75%", height: "70%"},
			legend: {position: 'right', alignment: 'start', textStyle: {color: '#666666', fontSize: 12}},				
			seriesType: "bars",
			series: {2: {type: "area", lineWidth: '3', pointSize: '5'}}
		};

			var chart = new google.visualization.ComboChart(document.getElementById('chart2_day_of_week'));
			chart.draw(data, options);
	}
//--></script>
    <?php } elseif ($filter_report == 'hour') { ?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript"><!--
	google.load('visualization', '1', {packages: ['corechart']});
      google.setOnLoadCallback(drawChart);      
	  function drawChart() {        
	  	var data = google.visualization.arrayToDataTable([
			<?php echo "['" . $column_hour . "','". $column_orders . "','" . $column_customers . "','" . $column_products . "'],";
					foreach ($orders as $key => $order) {
						if (count($orders)==($key+1)) {
							echo "['" . $order['hour'] . "',". $order['orders'] . ",". $order['customers'] . ",". $order['products'] . "]";
						} else {
							echo "['" . $order['hour'] . "',". $order['orders'] . ",". $order['customers'] . ",". $order['products'] . "],";
						}
					}
			;?>
		]);

        var options = {
			title: 'Sales by Hour',			
			width: 605,	
			height: 266,  
			colors: ['#edc240', '#9dc7e8', '#CCCCCC'],
			chartArea: {left: 45, top: 30, width: "75%", height: "70%"},
			pointSize: '4',
			legend: {position: 'right', alignment: 'start', textStyle: {color: '#666666', fontSize: 12}}
		};

			var chart = new google.visualization.LineChart(document.getElementById('chart1_hour'));
			chart.draw(data, options);
	}
//--></script>
<script type="text/javascript"><!--
	google.load('visualization', '1', {packages: ['corechart']});
      google.setOnLoadCallback(drawChart);      
	  function drawChart() { 
   		var data = google.visualization.arrayToDataTable([
			<?php echo "['" . $column_hour . "','". $column_grevenue . "','" . $column_gexpenses . "','" . $column_gprofit . "'],";
					foreach ($orders as $key => $order) {
						if (count($orders)==($key+1)) {
							echo "['" . $order['hour'] . "',". $order['gsales'] . ",". $order['gcosts'] . ",". $order['gnetprofit'] . "]";
						} else {
							echo "['" . $order['hour'] . "',". $order['gsales'] . ",". $order['gcosts'] . ",". $order['gnetprofit'] . "],";
						}
					}
			;?>
		]);

        var options = {
			title: 'Sales by Hour',				
			width: 605,	
			height: 266,  
			colors: ['#b5e08b', '#ed9999', '#739cc3'],
			chartArea: {left: 45, top: 30, width: "75%", height: "70%"},
			legend: {position: 'right', alignment: 'start', textStyle: {color: '#666666', fontSize: 12}},				
			seriesType: "bars",
			series: {2: {type: "area", lineWidth: '3', pointSize: '5'}}
		};

			var chart = new google.visualization.ComboChart(document.getElementById('chart2_hour'));
			chart.draw(data, options);
	}
//--></script>
	<?php } elseif ($filter_report == 'store') { ?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript"><!--
	google.load('visualization', '1', {packages: ['corechart']});
      google.setOnLoadCallback(drawChart);      
	  function drawChart() {        
	  	var data = google.visualization.arrayToDataTable([
			<?php echo "['" . $column_store . "','". $column_orders . "','" . $column_customers . "','" . $column_products . "'],";
					foreach ($orders as $key => $order) {
						if (count($orders)==($key+1)) {
							echo "['" . $order['store_name'] . "',". $order['orders'] . ",". $order['customers'] . ",". $order['products'] . "]";
						} else {
							echo "['" . $order['store_name'] . "',". $order['orders'] . ",". $order['customers'] . ",". $order['products'] . "],";
						}
					}
			;?>
		]);

        var options = {
			title: 'Sales by Store',			
			width: 605,	
			height: 266,  
			colors: ['#edc240', '#9dc7e8', '#CCCCCC'],
			chartArea: {left: 45, top: 30, width: "75%", height: "70%"},
			pointSize: '4',
			legend: {position: 'right', alignment: 'start', textStyle: {color: '#666666', fontSize: 12}}
		};

			var chart = new google.visualization.LineChart(document.getElementById('chart1_store'));
			chart.draw(data, options);
	}
//--></script>
<script type="text/javascript"><!--
	google.load('visualization', '1', {packages: ['corechart']});
      google.setOnLoadCallback(drawChart);      
	  function drawChart() { 
   		var data = google.visualization.arrayToDataTable([
			<?php echo "['" . $column_store . "','". $column_grevenue . "','" . $column_gexpenses . "','" . $column_gprofit . "'],";
					foreach ($orders as $key => $order) {
						if (count($orders)==($key+1)) {
							echo "['" . $order['store_name'] . "',". $order['gsales'] . ",". $order['gcosts'] . ",". $order['gnetprofit'] . "]";
						} else {
							echo "['" . $order['store_name'] . "',". $order['gsales'] . ",". $order['gcosts'] . ",". $order['gnetprofit'] . "],";
						}
					}
			;?>
		]);

        var options = {
			title: 'Sales by Store',				
			width: 605,	
			height: 266,  
			colors: ['#b5e08b', '#ed9999', '#739cc3'],
			chartArea: {left: 45, top: 30, width: "75%", height: "70%"},
			legend: {position: 'right', alignment: 'start', textStyle: {color: '#666666', fontSize: 12}},				
			seriesType: "bars",
			series: {2: {type: "area", lineWidth: '3', pointSize: '5'}}
		};

			var chart = new google.visualization.ComboChart(document.getElementById('chart2_store'));
			chart.draw(data, options);
	}
//--></script>
	<?php } elseif ($filter_report == 'customer_group') { ?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript"><!--
	google.load('visualization', '1', {packages: ['corechart']});
      google.setOnLoadCallback(drawChart);      
	  function drawChart() {        
	  	var data = google.visualization.arrayToDataTable([
			<?php echo "['" . $column_customer_group . "','". $column_orders . "','" . $column_customers . "','" . $column_products . "'],";
					foreach ($orders as $key => $order) {
						if (count($orders)==($key+1)) {
							echo "['" . $order['customer_group'] . "',". $order['orders'] . ",". $order['customers'] . ",". $order['products'] . "]";
						} else {
							echo "['" . $order['customer_group'] . "',". $order['orders'] . ",". $order['customers'] . ",". $order['products'] . "],";
						}
					}
			;?>
		]);

        var options = {
			title: 'Sales by Customer Group',			
			width: 605,	
			height: 266,  
			colors: ['#edc240', '#9dc7e8', '#CCCCCC'],
			chartArea: {left: 45, top: 30, width: "75%", height: "70%"},
			pointSize: '4',
			legend: {position: 'right', alignment: 'start', textStyle: {color: '#666666', fontSize: 12}}
		};

			var chart = new google.visualization.LineChart(document.getElementById('chart1_customer_group'));
			chart.draw(data, options);
	}
//--></script>
<script type="text/javascript"><!--
	google.load('visualization', '1', {packages: ['corechart']});
      google.setOnLoadCallback(drawChart);      
	  function drawChart() { 
   		var data = google.visualization.arrayToDataTable([
			<?php echo "['" . $column_customer_group . "','". $column_grevenue . "','" . $column_gexpenses . "','" . $column_gprofit . "'],";
					foreach ($orders as $key => $order) {
						if (count($orders)==($key+1)) {
							echo "['" . $order['customer_group'] . "',". $order['gsales'] . ",". $order['gcosts'] . ",". $order['gnetprofit'] . "]";
						} else {
							echo "['" . $order['customer_group'] . "',". $order['gsales'] . ",". $order['gcosts'] . ",". $order['gnetprofit'] . "],";
						}
					}
			;?>
		]);

        var options = {
			title: 'Sales by Customer Group',				
			width: 605,	
			height: 266,  
			colors: ['#b5e08b', '#ed9999', '#739cc3'],
			chartArea: {left: 45, top: 30, width: "75%", height: "70%"},
			legend: {position: 'right', alignment: 'start', textStyle: {color: '#666666', fontSize: 12}},				
			seriesType: "bars",
			series: {2: {type: "area", lineWidth: '3', pointSize: '5'}}
		};

			var chart = new google.visualization.ComboChart(document.getElementById('chart2_customer_group'));
			chart.draw(data, options);
	}
//--></script>
	<?php } elseif ($filter_report == 'country') { ?>
  <script type='text/javascript' src='https://www.google.com/jsapi'></script>
  <script type='text/javascript'>
   google.load('visualization', '1', {'packages': ['geomap']});
   google.setOnLoadCallback(drawMap);
    function drawMap() {
      var data = google.visualization.arrayToDataTable([
			<?php echo "['" . $column_country ."','". $column_orders . "'],";
					foreach ($orders as $key => $order) {
						if (count($orders)==($key+1)) {
							echo "['". $order['payment_country'] . "',". $order['orders'] . "]";
						} else {
							echo "['". $order['payment_country'] . "',". $order['orders'] . "],";
						}
					}
			;?>
		]);

     	var options = {};
      		options['dataMode'] = 'regions';

      var container = document.getElementById('chart_country');
      var geomap = new google.visualization.GeoMap(container);
      geomap.draw(data, options);
  };
  </script>
	<?php } elseif ($filter_report == 'payment_method') { ?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript"><!--
	google.load('visualization', '1', {packages: ['corechart']});
      google.setOnLoadCallback(drawChart);      
	  function drawChart() { 
   		var data = google.visualization.arrayToDataTable([
			<?php echo "['" . $column_payment_method ."','". $column_orders . "'],";
					foreach ($orders as $key => $order) {
						if (count($orders)==($key+1)) {
							echo "['". $order['payment_method'] . "',". $order['orders'] . "]";
						} else {
							echo "['". $order['payment_method'] . "',". $order['orders'] . "],";
						}
					}
			;?>
		]);


        var options = {
			title: 'Sales by Payment Method',
			pieSliceText: 'none',
			tooltip: {text: 'value'},
			chartArea: {left: 45, top: 55, width: "75%", height: "65%"},
        };

			var chart = new google.visualization.PieChart(document.getElementById('chart_payment_method'));
			chart.draw(data, options);
	}
//--></script>
	<?php } elseif ($filter_report == 'shipping_method') { ?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript"><!--
	google.load('visualization', '1', {packages: ['corechart']});
      google.setOnLoadCallback(drawChart);      
	  function drawChart() { 
   		var data = google.visualization.arrayToDataTable([
			<?php echo "['" . $column_shipping_method ."','". $column_orders . "'],";
					foreach ($orders as $key => $order) {
						if (count($orders)==($key+1)) {
							echo "['". $order['shipping_method'] . "',". $order['orders'] . "]";
						} else {
							echo "['". $order['shipping_method'] . "',". $order['orders'] . "],";
						}
					}
			;?>
		]);


        var options = {
			title: 'Sales by Shipping Method',
			pieSliceText: 'none',
			tooltip: {text: 'value'},
			chartArea: {left: 45, top: 55, width: "75%", height: "65%"},
        };

			var chart = new google.visualization.PieChart(document.getElementById('chart_shipping_method'));
			chart.draw(data, options);
	}
//--></script>
	<?php } ?>
<?php } ?>
  <script type="text/javascript"><!--
$('#date-start').datetimepicker({
	pickTime: false
});
$('#date-end').datetimepicker({
	pickTime: false
});
$('#status-date-start').datetimepicker({
	pickTime: false
});
$('#status-date-end').datetimepicker({
	pickTime: false
});
//--></script>
<script type="text/javascript">
$(document).ready(function() { 
  $("#content").hide(); 
  $(window).load(function() { 
    	$("#content").show(); 
    	$("#content-loading").hide(); 
  	});
});
</script></div>
<?php echo $footer; ?>