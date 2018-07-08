<?php echo $header; ?>
<style type="text/css">
#showPrint{
	display:none;
	position:fixed;
	top:40%;
	left:50%;
	width:300px;
	padding:20px;
	border:1px #DDD solid;
	background:#F9F9F9;
	border-radius:3px;
	overflow:hidden;
	z-index:999999;
	transform:translate(-50%, -40%);
}
.print-title{
	margin-bottom: 20px;
	font-size: 14px;
	overflow: hidden;
}
.print-title i{
	float: right;
	cursor: pointer;
}
.print-express{
	width: 250px;
	margin-bottom: 20px;
	overflow: hidden;
}
.print-express select{
	width: 250px;
	height: 35px;
	line-height: 35px;
	font-size: 13px;
}
</style>
<div id="showPrint">
	<div class="print-title">订单 #<span id="print-id"></span> 加入快递单打印列表<i class="fa fa-remove" onClick="hidePrintBox();"></i></div>
	<div class="print-express">
		<select name="print_express_id">
			<?php foreach ($expresses as $key => $value) { ?>
			<option value="<?php echo $value['express_id']; ?>"><?php echo $value['name']; ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="print-btn">
		<button type="botton" title="加入配送单打印列表" class="btn btn-primary" onClick="addPrint('shipping');"><i class="fa fa-truck"></i></button>

		<button type="botton" title="加入快递单打印列表" class="btn btn-primary" onClick="addPrint('express');"><i class="fa fa-check-circle-o"></i></button>
		<input type="hidden" name="print_order_id" value="" />
		<input type="hidden" name="print_type" value="" />
	</div>
</div>
<?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" id="button-shipping" form="form-order" formaction="<?php echo $shipping; ?>" data-toggle="tooltip" title="<?php echo $button_shipping_print; ?>" class="btn btn-info"><i class="fa fa-truck"></i></button>
        <button type="submit" id="button-express" form="form-order" formaction="<?php echo $express; ?>" data-toggle="tooltip" title="<?php echo $button_express_print; ?>" class="btn btn-info"><i class="fa fa-check-circle-o"></i></button>
        <button type="submit" id="button-invoice" form="form-order" formaction="<?php echo $invoice; ?>" data-toggle="tooltip" title="<?php echo $button_invoice_print; ?>" class="btn btn-info"><i class="fa fa-print"></i></button>
        <a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
      </div>
      <div class="panel-body">
        <div class="well">
          <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-order-id"><?php echo $entry_order_id; ?></label>
                <input type="text" name="filter_order_id" value="<?php echo $filter_order_id; ?>" placeholder="<?php echo $entry_order_id; ?>" id="input-order-id" class="form-control" />
              </div>
              <div class="form-group">
                <label class="control-label" for="input-customer"><?php echo $entry_customer; ?></label>
                <input type="text" name="filter_customer" value="<?php echo $filter_customer; ?>" placeholder="<?php echo $entry_customer; ?>" id="input-customer" class="form-control" />
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-order-status"><?php echo $entry_order_status; ?></label>
				<style type="text/css">
				.xuan_order_status{
					height:35px;
					border:1px #CCC solid;
					background:#FFF;
					box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
					border-radius: 3px;
					position:relative;
					z-index:9999;
				}
				.xuan_order_status ul{
					position:absolute;
					top:35px; left:0;
					display:none;
					min-width:150px;
					height:200px;
					padding:10px 0;
					margin:0;
					list-style:none;
					border:1px #CCC solid;
					background:#FFF;
					overflow-y:scroll;
					box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
					border-radius: 3px;
				}
				.xuan_order_status ul li{
					padding:0px 15px;
				}
				.xuan_order_status ul li:hover{
					background:#CCCCFF;
				}
				.xuan_order_status ul li label{
					display:block;
					line-height:15px;
					padding:5px;
					margin:0;
					overflow:hidden;
				}
				.xuan_order_status ul li span{
					float:left;
					margin-right:7px;
					line-height:15px;
				}
				.xuan_order_status_text{
					height:35px;
					line-height:35px;
					padding:0 10px;
					color:#999;
					overflow:hidden;
				}
				</style>
				<div class="xuan_order_status">
					<div class="xuan_order_status_text">
						<?php
							$t = '';
							
							foreach ($order_statuses as $order_status) {
								if (in_array($order_status['order_status_id'], $filter_order_status)) {
									$t .= ', '.$order_status['name'].'';
								}
							}
							
							echo trim($t, ', ');
						?>
					</div>
					<ul id="xuan_order_status_list">
						<?php foreach ($order_statuses as $order_status) { ?>
                  		<?php if (in_array($order_status['order_status_id'], $filter_order_status)) { ?>
						<li><label for="xuan_filter_status<?php echo $order_status['order_status_id']; ?>"><span><input type="checkbox" name="filter_order_status" id="xuan_filter_status<?php echo $order_status['order_status_id']; ?>" value="<?php echo $order_status['order_status_id']; ?>" checked="checked" /></span><span><?php echo $order_status['name']; ?></span></label></li>
                  		<?php } else { ?>
						<li><label for="xuan_filter_status<?php echo $order_status['order_status_id']; ?>"><span><input type="checkbox" name="filter_order_status" id="xuan_filter_status<?php echo $order_status['order_status_id']; ?>" value="<?php echo $order_status['order_status_id']; ?>" /></span><span><?php echo $order_status['name']; ?></span></label></li>
						<?php } ?>
						<?php } ?>
					</ul>
				</div>
              </div>
              <div class="form-group">
                <label class="control-label" for="input-total"><?php echo $entry_total; ?></label>
                <input type="text" name="filter_total" value="<?php echo $filter_total; ?>" placeholder="<?php echo $entry_total; ?>" id="input-total" class="form-control" />
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-date-added"><?php echo $entry_date_added; ?></label>
                <div class="input-group date">
                  <input type="text" name="filter_date_added" value="<?php echo $filter_date_added; ?>" placeholder="<?php echo $entry_date_added; ?>" data-date-format="YYYY-MM-DD" id="input-date-added" class="form-control" />
                  <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span></div>
              </div>
              <div class="form-group">
                <label class="control-label" for="input-date-modified"><?php echo $entry_date_modified; ?></label>
                <div class="input-group date">
                  <input type="text" name="filter_date_modified" value="<?php echo $filter_date_modified; ?>" placeholder="<?php echo $entry_date_modified; ?>" data-date-format="YYYY-MM-DD" id="input-date-modified" class="form-control" />
                  <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span></div>
              </div>
              <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
            </div>
          </div>
        </div>
        <form method="post" enctype="multipart/form-data" target="_blank" id="form-order">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked); $('input[name^=\'selected\']:first').trigger('change');" /></td>
                  <td class="text-right"><?php if ($sort == 'o.order_id') { ?>
                    <a href="<?php echo $sort_order; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_order_id; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_order; ?>"><?php echo $column_order_id; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'customer') { ?>
                    <a href="<?php echo $sort_customer; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_customer; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_customer; ?>"><?php echo $column_customer; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'status') { ?>
                    <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
					
                    <?php } else { ?>
                    <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
                    <?php } ?>
					
					
					</td>
                  <td class="text-right"><?php if ($sort == 'o.total') { ?>
                    <a href="<?php echo $sort_total; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_total; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_total; ?>"><?php echo $column_total; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'o.date_added') { ?>
                    <a href="<?php echo $sort_date_added; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date_added; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_date_added; ?>"><?php echo $column_date_added; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'o.date_modified') { ?>
                    <a href="<?php echo $sort_date_modified; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date_modified; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_date_modified; ?>"><?php echo $column_date_modified; ?></a>
                    <?php } ?></td>
                  <td class="text-right"><?php echo $column_action; ?></td>
                </tr>
              </thead>
              <tbody>
			    <style type="text/css">
				.btn-default{
					background:#EEE;
				}
				.x-css{
					display:inline-block;
					padding:2px 6px;
					font-size:12px;
					color:#FFF;
					border-radius: 5px;
				}
				.x-css a{
					color:#FFF;
				}
				.x-repeat{
					background:#F00;
				}
				.x-turnback{
					background:#9900CC;
				}
				.x-total{
					background:#009933;
				}
				</style>
                <?php if ($orders) { ?>
                <?php foreach ($orders as $order) { ?>
                <tr>
                  <td class="text-center"><?php if (in_array($order['order_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $order['order_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $order['order_id']; ?>" />
                    <?php } ?>
                    <input type="hidden" name="shipping_code[]" value="<?php echo $order['shipping_code']; ?>" /></td>
                  <td class="text-right"><?php echo $order['order_id']; ?></td>
                  <td class="text-left"><?php echo $order['customer']; ?><?php if ($order['customer_group_id']) { ?><font color="#0066FF">[<?php echo $order['group']; ?>]</font><?php } else { ?><font color="#CCC">[<?php echo $order['group']; ?>]</font><?php } ?><br />
				  <?php if ($order['turnback']) { ?>
				    <div class="x-css x-turnback" data-toggle="tooltip" title="有回退<?php echo $order['turnback']; ?>个订單使用该电话号码">退(<?php echo $order['turnback']; ?>)</div>
				  <?php } ?>
				  <?php if ($order['totals']) { ?>
				    <div class="x-css x-total" data-toggle="tooltip" title="有<?php echo $order['totals']; ?>个订單使用该电话号码"><a href="<?php echo $order['all_orders']; ?>">單(<?php echo $order['totals']; ?>)</a></div>
				  <?php } ?>
				  <?php if ($order['repeat'] > 1) { ?>
				  	<div class="x-css x-repeat" data-toggle="tooltip" title="该电话最近有重复订單">复</div>
				  <?php } ?></td>
                  <td class="text-left"><?php echo $order['status']; ?><br /><a href="<?php echo $order['shipping']; ?>" target="_blank" data-toggle="tooltip" title="<?php echo $button_shipping_print; ?>" class="btn btn-<?php echo $order['action_shipping']?'default':'primary'; ?>" id="btn-shipping"><i class="fa fa-truck"></i> <?php echo $order['auto_shipping']?'<i class="fa fa-retweet"></i>':''; ?></a>

                  	<a href="<?php echo $order['express']; ?>" target="_blank" data-toggle="tooltip" title="<?php echo $button_express_print; ?>" class="btn btn-<?php echo $order['action_express']?'default':'primary'; ?>" id="btn-express"><i class="fa fa-check-circle-o"></i> <?php echo $order['auto_express']?'<i class="fa fa-retweet"></i>':''; ?></a></td>
                  <td class="text-right"><?php echo $order['total']; ?></td>
                  <td class="text-left"><?php echo $order['date_added']; ?></td>
                  <td class="text-left"><?php echo $order['date_modified']; ?></td>
                  <td class="text-right"><a href="<?php echo $order['invoice']; ?>" target="_blank" data-toggle="tooltip" title="<?php echo $button_invoice_print; ?>" class="btn btn-<?php echo $order['action_invoice']?'default':'primary'; ?>" id="btn-invoice"><i class="fa fa-print"></i></a><a href="<?php echo $order['view']; ?>" data-toggle="tooltip" title="<?php echo $button_view; ?>" class="btn btn-<?php echo $order['action_viewed']?'default':'primary'; ?>"><i class="fa fa-eye"></i></a><a href="<?php echo $order['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a><a href="<?php echo $order['delete']; ?>" id="button-delete<?php echo $order['order_id']; ?>" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i></a></td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="8"><?php echo $text_no_results; ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </form>
        <div class="row">
          <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
          <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript"><!--
$(document).on("click",function(e){
	var target  = $(e.target);
	
	if (target.closest(".xuan_order_status").length == 0){
		$("#xuan_order_status_list").hide();
	} else {
		$("#xuan_order_status_list").show();
	}
});

$('i.fa-truck, i.fa-print, i.fa-check-circle-o').each(function() {
	$(this).parent().click(function() {
		$(this).removeClass('btn-primary').addClass('btn-default');
	});
});

$('#button-filter').on('click', function() {
	url = 'index.php?route=sale/order&token=<?php echo $token; ?>';
	
	var filter_order_id = $('input[name=\'filter_order_id\']').val();
	
	if (filter_order_id) {
		url += '&filter_order_id=' + encodeURIComponent(filter_order_id);
	}
	
	var filter_customer = $('input[name=\'filter_customer\']').val();
	
	if (filter_customer) {
		url += '&filter_customer=' + encodeURIComponent(filter_customer);
	}
	
	var filter_order_status = new Array();
	
	$('#xuan_order_status_list input[type=\'checkbox\']:checked').each(function(i, e){
		filter_order_status[i] = $(e).val();
	});
	
	if (filter_order_status.length > 0) {
		url += '&filter_order_status=' + filter_order_status.join(',');
	} else {
		url += '&filter_order_status=all';
	}

	var filter_total = $('input[name=\'filter_total\']').val();

	if (filter_total) {
		url += '&filter_total=' + encodeURIComponent(filter_total);
	}	
	
	var filter_date_added = $('input[name=\'filter_date_added\']').val();
	
	if (filter_date_added) {
		url += '&filter_date_added=' + encodeURIComponent(filter_date_added);
	}
	
	var filter_date_modified = $('input[name=\'filter_date_modified\']').val();
	
	if (filter_date_modified) {
		url += '&filter_date_modified=' + encodeURIComponent(filter_date_modified);
	}
				
	location = url;
});
//--></script> 
  <script type="text/javascript"><!--
$('input[name=\'filter_customer\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=sale/customer/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',			
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['customer_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter_customer\']').val(item['label']);
	}	
});
//--></script> 
  <script type="text/javascript"><!--
$('input[name^=\'selected\']').on('change', function() {
	$('#button-express, #button-shipping, #button-invoice').prop('disabled', true);
	
	var selected = $('input[name^=\'selected\']:checked');
	
	if (selected.length) {
		$('#button-express').prop('disabled', false);
		$('#button-invoice').prop('disabled', false);
	}
	
	for (i = 0; i < selected.length; i++) {
		if ($(selected[i]).parent().find('input[name^=\'shipping_code\']').val()) {
			$('#button-shipping').prop('disabled', false);
			
			break;
		}
	}
});

$('input[name^=\'selected\']:first').trigger('change');

$('a[id^=\'button-delete\']').on('click', function(e) {
	e.preventDefault();
	
	if (confirm('<?php echo $text_confirm; ?>')) {
		location = $(this).attr('href');
	}
});
//--></script> 
  <script src="view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
  <link href="view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet" media="screen" />
  <script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});
//--></script>
<script type="text/javascript"><!--
function hidePrintBox() {
	$('#showPrint').hide();
}

function showPrintBox(id) {
	$('#print-id').html(id);
	$('input[name="print_order_id"]').val(id);
	$('#showPrint').show();
}

var printStatus = true;

function addPrint(type) {
	if (!printStatus) {
		alert('服务器响应缓慢，请稍后操作');
		return false;
	}

	printStatus = false;

	$('input[name="print_type"]').val(type);

	$.ajax({
		url: 'index.php?route=sale/order/setprint&token=<?php echo $token; ?>',
		type: 'POST',
		data: $('#showPrint input, #showPrint select'),
		dataType: 'json',			
		success: function(json) {
			if (json['success']) {
				alert('成功加入打印列表');
			}

			if (json['exist']) {
				alert('订单正在等待打印');
			}

			if (json['error']) {
				alert(json['error']);
			}

			printStatus = true;
		}
	});
}
//--></script></div>
<?php echo $footer; ?>