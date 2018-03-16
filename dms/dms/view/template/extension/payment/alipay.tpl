<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-cod" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
      <div class="col-sm-12"><?php echo $text_description; ?></div>
	  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-cod" class="form-horizontal">
		<div class="form-group required">
		<label class="col-sm-2 control-label"><?php echo $entry_trade_type; ?></label>
          <div class="col-sm-10">
			 <?php if ($alipay_trade_type=='trade_create_by_buyer') { ?>
				<?php echo $trade_create_by_buyer; ?>
				<input type="radio" name="alipay_trade_type" value="trade_create_by_buyer" checked="true"/>
				<?php echo $create_direct_pay_by_user; ?>
				<input type="radio" name="alipay_trade_type" value="create_direct_pay_by_user"/>
				<?php echo $create_partner_trade_by_buyer; ?>
				<input type="radio" name="alipay_trade_type" value="create_partner_trade_by_buyer"/>
			<?php } elseif($alipay_trade_type=='create_direct_pay_by_user') {  ?>
				<?php echo $trade_create_by_buyer; ?>
				<input type="radio" name="alipay_trade_type" value="trade_create_by_buyer"/>
				<?php echo $create_direct_pay_by_user; ?>
				<input type="radio" name="alipay_trade_type" value="create_direct_pay_by_user" checked="true"/>
				<?php echo $create_partner_trade_by_buyer; ?>
				<input type="radio" name="alipay_trade_type" value="create_partner_trade_by_buyer"/>
			<?php } elseif($alipay_trade_type=='create_partner_trade_by_buyer'){  ?>
				<?php echo $trade_create_by_buyer; ?>
				<input type="radio" name="alipay_trade_type" value="trade_create_by_buyer"/>
				<?php echo $create_direct_pay_by_user; ?>
				<input type="radio" name="alipay_trade_type" value="create_direct_pay_by_user"/>
				<?php echo $create_partner_trade_by_buyer; ?>
				<input type="radio" name="alipay_trade_type" value="create_partner_trade_by_buyer" checked="true"/>
			<?php } else { ?>
				<?php echo $trade_create_by_buyer; ?>
				<input type="radio" name="alipay_trade_type" value="trade_create_by_buyer"/>
				<?php echo $create_direct_pay_by_user; ?>
				<input type="radio" name="alipay_trade_type" value="create_direct_pay_by_user" checked="true"/>
				<?php echo $create_partner_trade_by_buyer; ?>
				<input type="radio" name="alipay_trade_type" value="create_partner_trade_by_buyer"/>
			<?php } ?>
		  </div>
        </div>
		
	  	<div class="form-group required">
          <label class="col-sm-2 control-label"><?php echo $entry_partner; ?></label>
          <div class="col-sm-10">
		  <input type="text" name="alipay_partner" value="<?php echo $alipay_partner; ?>" class="form-control"/>
			<?php if ($error_partner) { ?>
            <div class="text-danger"><?php echo $error_partner; ?></div>
            <?php } ?>
		  </div>
        </div>

		<div class="form-group required">
          <label class="col-sm-2 control-label"><?php echo $entry_security_code; ?></label>
          <div class="col-sm-10">
		  <input type="text" name="alipay_security_code" value="<?php echo $alipay_security_code; ?>" class="form-control"/>
		  <?php if ($error_secrity_code) { ?>
          <div class="text-danger"><?php echo $error_secrity_code; ?></div>
          <?php } ?>
		  </div>
        </div>
	   <div class="form-group required">
          <label class="col-sm-2 control-label"><?php echo $entry_seller_email; ?></label>
          <div class="col-sm-10">
		  <input type="text" name="alipay_seller_email" value="<?php echo $alipay_seller_email; ?>" class="form-control"/>
            <?php if ($error_email) { ?>
            <div class="text-danger"><?php echo $error_email; ?></div>
            <?php } ?>
		  </div>
        </div>
		<div class="form-group">
		  <label class="col-sm-2 control-label"><?php echo $entry_anti_phishing; ?></label>
		  <div class="col-sm-10">
		<?php if ($alipay_anti_phishing==1) { ?>
			<?php echo $text_enabled; ?><input type="radio" name="alipay_anti_phishing" value="1" checked="true"/>
			<?php echo $text_disabled; ?><input type="radio" name="alipay_anti_phishing" value="0"/>
			<?php } else { ?>
			<?php echo $text_enabled; ?><input type="radio" name="alipay_anti_phishing" value="1"/>
			<?php echo $text_disabled; ?><input type="radio" name="alipay_anti_phishing" value="0" checked="true"/>
			<?php } ?>
			</div>
		</div>
        <div class="form-group">
          <label class="col-sm-2 control-label"><?php echo $entry_order_status; ?></label>
          <div class="col-sm-10">
		    <select name="alipay_order_status_id" class="form-control">
              <?php foreach ($order_statuses as $order_status) { ?>
              <?php if ($order_status['order_status_id'] == $alipay_order_status_id) { ?>
              <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
              <?php } else { ?>
              <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
              <?php } ?>
              <?php } ?>
            </select>
		  </div>
        </div>
		<div class="form-group">
		  <label class="col-sm-2 control-label"><?php echo $entry_paybank_status; ?></label>
		  <div class="col-sm-10">
		    <select name="alipay_paybank_status" class="form-control">
			  <?php if($alipay_paybank_status) { ?>
			  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
			  <option value="0"><?php echo $text_disabled; ?></option>
			  <?php } else { ?>
			  <option value="1"><?php echo $text_enabled; ?></option>
			  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
			  <?php } ?>
			</select>
		  </div>
		</div>
        <div class="form-group">
          <label class="col-sm-2 control-label"><?php echo $entry_status; ?></label>
          <div class="col-sm-10">
		    <select name="alipay_status" class="form-control">
              <?php if ($alipay_status) { ?>
              <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
              <option value="0"><?php echo $text_disabled; ?></option>
              <?php } else { ?>
              <option value="1"><?php echo $text_enabled; ?></option>
              <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
              <?php } ?>
            </select></div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label"><?php echo $entry_sort_order; ?></label>
          <div class="col-sm-10">
		  <input type="text" name="alipay_sort_order" value="<?php echo $alipay_sort_order; ?>" class="form-control"/>
		  </div>
        </div>
    </form>
	  </div>
	</div>
  </div>
</div>
<?php echo $footer; ?>