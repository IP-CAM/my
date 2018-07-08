<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-generator" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
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
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <div class="well">
          <div class="row">
            <div class="col-sm-3">
              <div class="form-group">
                <label class="control-label" for="text-last-order-id"><?php echo $text_last_order_id; ?></label>
                <input type="text" name="last_order_id" id="input-last-order-id" value="<?php echo $last_order_id; ?>" class="form-control" readonly />
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label class="control-label" for="text-next-order-id"><?php echo $text_next_order_id; ?></label>
                <input type="text" name="next_order_id" id="input-next-order-id" value="<?php echo $next_order_id; ?>" class="form-control" readonly />
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label class="control-label" for="text-invoice-prefix"><?php echo $text_invoice_prefix; ?></label>
                <select name="select_invoice_prefix" id="input-invoice-prefix" class="form-control">
                  <?php foreach ($invoice_prefixs as $invoice_prefix) { ?>
                  <?php if ($invoice_prefix['invoice_prefix'] == $select_invoice_prefix) { ?>
                  <option value="<?php echo $invoice_prefix['invoice_prefix']; ?>" selected="selected"><?php echo $invoice_prefix['invoice_prefix']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $invoice_prefix['invoice_prefix']; ?>"><?php echo $invoice_prefix['invoice_prefix']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label class="control-label" for="text-last-invoice-no"><?php echo $text_last_invoice_no; ?></label>
                <input type="text" name="last_invoice_no" id="input-invoice-no" class="form-control" readonly />
              </div>
              <div class="form-group">
                <div class="pull-right">
                  <button type="button" id="button-refresh" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-default"><i class="fa fa-refresh"></i> <?php echo $button_refresh; ?></button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-generator" class="form-horizontal">
          <legend><?php echo $text_order_id; ?></legend>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-id-push"><?php echo $entry_id_push; ?></label>
            <div class="col-sm-4">
              <div class="input-group">
                <input type="text" name="id_push" value="<?php echo $id_push; ?>" placeholder="<?php echo $entry_id_push; ?>" id="input-id-push" class="form-control" />
                <span class="input-group-btn">
                <button type="button" id="button-id-push" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-default"><i class="fa fa-upload"></i> <?php echo $button_id_push; ?></button>
                </span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-order-min"><span data-toggle="tooltip" title="<?php echo $help_minimum; ?>"><?php echo $entry_minimum; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="generator_order_min" value="<?php echo $generator_order_min; ?>" placeholder="<?php echo $entry_minimum; ?>" id="input-order-min" class="form-control" />
                <?php if ($error_generator_order_min) { ?>
                  <div class="text-danger"><?php echo $error_generator_order_min; ?></div>
                <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-order-max"><span data-toggle="tooltip" title="<?php echo $help_maximum; ?>"><?php echo $entry_maximum; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="generator_order_max" value="<?php echo $generator_order_max; ?>" placeholder="<?php echo $entry_maximum; ?>" id="input-order-max" class="form-control" />
                <?php if ($error_generator_order_max) { ?>
                  <div class="text-danger"><?php echo $error_generator_order_max; ?></div>
                <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-order-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="generator_order_status" id="input-order-status" class="form-control">
                <?php if ($generator_order_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <legend><?php echo $text_invoice_no; ?></legend>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-invoice-type"><?php echo $entry_type; ?></label>
            <div class="col-sm-10">
              <select name="generator_invoice_type" id="input-invoice-type" class="form-control">
                <?php if ($generator_invoice_type) { ?>
                <option value="0"><?php echo $text_random; ?></option>
                <option value="1" selected="selected"><?php echo $text_same; ?></option>
                <?php } else { ?>
                <option value="0" selected="selected"><?php echo $text_random; ?></option>
                <option value="1"><?php echo $text_same; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group random">
            <label class="col-sm-2 control-label" for="input-invoice-min"><span data-toggle="tooltip" title="<?php echo $help_minimum; ?>"><?php echo $entry_minimum; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="generator_invoice_min" value="<?php echo $generator_invoice_min; ?>" placeholder="<?php echo $entry_minimum; ?>" id="input-invoice-min" class="form-control" />
                <?php if ($error_generator_invoice_min) { ?>
                  <div class="text-danger"><?php echo $error_generator_invoice_min; ?></div>
                <?php } ?>
            </div>
          </div>
          <div class="form-group random">
            <label class="col-sm-2 control-label" for="input-invoice-max"><span data-toggle="tooltip" title="<?php echo $help_maximum; ?>"><?php echo $entry_maximum; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="generator_invoice_max" value="<?php echo $generator_invoice_max; ?>" placeholder="<?php echo $entry_maximum; ?>" id="input-invoice-max" class="form-control" />
                <?php if ($error_generator_invoice_max) { ?>
                  <div class="text-danger"><?php echo $error_generator_invoice_max; ?></div>
                <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-invoice-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="generator_invoice_status" id="input-invoice-status" class="form-control">
                <?php if ($generator_invoice_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript"><!--
$('select[name=\'generator_invoice_type\']').on('change', function() {
	$('.random').hide();
	
	if (this.value == 0) {
	   $('.random').show();
     }
});

$('select[name=\'generator_invoice_type\']').trigger('change');
//--></script>
  <script type="text/javascript"><!--
$('select[name=\'select_invoice_prefix\']').on('change', function() {
	$.ajax({
		url: 'index.php?route=module/generator/getLastInvoiceNo&token=<?php echo $token; ?>&invoice_prefix=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'select_invoice_prefix\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
		},
		complete: function() {
			$('.fa-spin').remove();
		},
		success: function(json) {
            $('#input-invoice-no').val(json['last_invoice_no']);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('select[name=\'select_invoice_prefix\']').trigger('change');
//--></script>
  <script type="text/javascript"><!--
$('button[id^=\'button-id-push\']').on('click', function() {
	$.ajax({
		url: 'index.php?route=module/generator/push&token=<?php echo $token; ?>&order_id=' + $('#input-id-push').val(),
		dataType: 'json',
		beforeSend: function() {
            $('#button-id-push').button('loading');
		},
		complete: function() {
            $('#button-id-push').button('reset');
		},
		success: function(json) {
			$('.alert').remove();

			if (json['error']) {
				$('#content > .container-fluid').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
			}

			if (json['success']) {
                $('#content > .container-fluid').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');

                $('#input-next-order-id').val(json['next_order_id']);
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});
//--></script>
  <script type="text/javascript"><!--
$('button[id^=\'button-refresh\']').on('click', function() {
	$.ajax({
		url: 'index.php?route=module/generator/refresh&token=<?php echo $token; ?>&invoice_prefix=' + $('select[name=\'select_invoice_prefix\'] option:selected').val(),
		dataType: 'json',
		beforeSend: function() {
            $('#button-refresh').button('loading');
		},
		complete: function() {
            $('#button-refresh').button('reset');
		},
		success: function(json) {
            $('#input-last-order-id').val(json['last_order_id']);
            $('#input-next-order-id').val(json['next_order_id']);
            $('#input-invoice-no').val(json['last_invoice_no']);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});
//--></script></div>
<?php echo $footer; ?>
