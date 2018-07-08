<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="button" id="button-save" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i> <?php echo $button_save; ?></button>
		<a href="<?php echo $cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i> <?php echo $button_cancel; ?></a>
	  </div>
      <h1><?php echo $heading_title; ?></h1>
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
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
      </div>
      <div class="panel-body">
        <form id="form-order">
          <ul id="order" class="nav nav-tabs nav-justified">
            <li class="active"><a href="#tab-customer" data-toggle="tab"><?php echo $tab_customer; ?></a></li>
            <li><a href="#tab-payment" data-toggle="tab"><?php echo $tab_shipping; ?></a></li>
            <li><a href="#tab-cart" data-toggle="tab"><?php echo $tab_product; ?></a></li>
          </ul>
		  
		  
		  
		  
          <div class="tab-content form-horizontal">
            <div class="tab-pane active" id="tab-customer">
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-store"><?php echo $entry_store; ?></label>
                <div class="col-sm-10">
                  <select name="store_id" id="input-store" class="form-control">
                    <option value="0"><?php echo $text_default; ?></option>
                    <?php foreach ($stores as $store) { ?>
                    <?php if ($store['store_id'] == $store_id) { ?>
                    <option value="<?php echo $store['store_id']; ?>" selected="selected"><?php echo $store['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $store['store_id']; ?>"><?php echo $store['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-customer"><?php echo $entry_customer; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="customer" value="<?php echo $customer; ?>" placeholder="<?php echo $entry_customer; ?>" id="input-customer" class="form-control" />
                  <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-customer-group"><?php echo $entry_customer_group; ?></label>
                <div class="col-sm-10">
                  <select name="customer_group_id" id="input-customer-group" class="form-control">
                    <option value="0" selected="selected">guest</option>
                    <?php foreach ($customer_groups as $customer_group) { ?>
                    <?php if ($customer_group['customer_group_id'] == $customer_group_id) { ?>
                    <option value="<?php echo $customer_group['customer_group_id']; ?>" selected="selected"><?php echo $customer_group['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-firstname"><?php echo $entry_firstname; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="firstname" value="<?php echo $firstname; ?>" id="input-firstname" class="form-control" />
                </div>
              </div>
              <div class="form-group required" style="display:none;">
                <label class="col-sm-2 control-label" for="input-lastname"><?php echo $entry_lastname; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="lastname" value="<?php echo $lastname; ?>" id="input-lastname" class="form-control" />
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-email"><?php echo $entry_email; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="email" value="<?php echo $email; ?>" id="input-email" class="form-control" />
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-telephone"><?php echo $entry_telephone; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="telephone" value="<?php echo $telephone; ?>" id="input-telephone" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-fax"><?php echo $entry_fax; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="fax" value="<?php echo $fax; ?>" id="input-fax" class="form-control" />
                </div>
              </div>
              <?php foreach ($custom_fields as $custom_field) { ?>
              <?php if ($custom_field['location'] == 'account') { ?>
              <?php if ($custom_field['type'] == 'select') { ?>
              <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>">
                <label class="col-sm-2 control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
                <div class="col-sm-10">
                  <select name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control">
                    <option value=""><?php echo $text_select; ?></option>
                    <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
                    <?php if (isset($account_custom_field[$custom_field['custom_field_id']]) && $custom_field_value['custom_field_value_id'] == $account_custom_field[$custom_field['custom_field_id']]) { ?>
                    <option value="<?php echo $custom_field_value['custom_field_value_id']; ?>" selected="selected"><?php echo $custom_field_value['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $custom_field_value['custom_field_value_id']; ?>"><?php echo $custom_field_value['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <?php } ?>
              <?php if ($custom_field['type'] == 'radio') { ?>
              <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>">
                <label class="col-sm-2 control-label"><?php echo $custom_field['name']; ?></label>
                <div class="col-sm-10">
                  <div id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>">
                    <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
                    <div class="radio">
                      <?php if (isset($account_custom_field[$custom_field['custom_field_id']]) && $custom_field_value['custom_field_value_id'] == $account_custom_field[$custom_field['custom_field_id']]) { ?>
                      <label>
                        <input type="radio" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" checked="checked" />
                        <?php echo $custom_field_value['name']; ?></label>
                      <?php } else { ?>
                      <label>
                        <input type="radio" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" />
                        <?php echo $custom_field_value['name']; ?></label>
                      <?php } ?>
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <?php } ?>
              <?php if ($custom_field['type'] == 'checkbox') { ?>
              <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>">
                <label class="col-sm-2 control-label"><?php echo $custom_field['name']; ?></label>
                <div class="col-sm-10">
                  <div id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>">
                    <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
                    <div class="checkbox">
                      <?php if (isset($account_custom_field[$custom_field['custom_field_id']]) && in_array($custom_field_value['custom_field_value_id'], $account_custom_field[$custom_field['custom_field_id']])) { ?>
                      <label>
                        <input type="checkbox" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>][]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" checked="checked" />
                        <?php echo $custom_field_value['name']; ?></label>
                      <?php } else { ?>
                      <label>
                        <input type="checkbox" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>][]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" />
                        <?php echo $custom_field_value['name']; ?></label>
                      <?php } ?>
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <?php } ?>
              <?php if ($custom_field['type'] == 'text') { ?>
              <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>">
                <label class="col-sm-2 control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($account_custom_field[$custom_field['custom_field_id']]) ? $account_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
                </div>
              </div>
              <?php } ?>
              <?php if ($custom_field['type'] == 'textarea') { ?>
              <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>">
                <label class="col-sm-2 control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
                <div class="col-sm-10">
                  <textarea name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" rows="5" placeholder="<?php echo $custom_field['name']; ?>" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control"><?php echo $custom_field['value']; ?></textarea>
                </div>
              </div>
              <?php } ?>
              <?php if ($custom_field['type'] == 'file') { ?>
              <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>">
                <label class="col-sm-2 control-label"><?php echo $custom_field['name']; ?></label>
                <div class="col-sm-10">
                  <button type="button" id="button-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="btn btn-default"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>
                  <input type="hidden" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($account_custom_field[$custom_field['custom_field_id']]) ? $account_custom_field[$custom_field['custom_field_id']] : ''); ?>" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" />
                </div>
              </div>
              <?php } ?>
              <?php if ($custom_field['type'] == 'date') { ?>
              <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>">
                <label class="col-sm-2 control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
                <div class="col-sm-10">
                  <div class="input-group date">
                    <input type="text" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($account_custom_field[$custom_field['custom_field_id']]) ? $account_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="YYYY-MM-DD" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
                    <span class="input-group-btn">
                    <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                    </span></div>
                </div>
              </div>
              <?php } ?>
              <?php if ($custom_field['type'] == 'time') { ?>
              <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>">
                <label class="col-sm-2 control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
                <div class="col-sm-10">
                  <div class="input-group time">
                    <input type="text" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($account_custom_field[$custom_field['custom_field_id']]) ? $account_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="HH:mm" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
                    <span class="input-group-btn">
                    <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                    </span></div>
                </div>
              </div>
              <?php } ?>
              <?php if ($custom_field['type'] == 'datetime') { ?>
              <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>">
                <label class="col-sm-2 control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
                <div class="col-sm-10">
                  <div class="input-group datetime">
                    <input type="text" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($account_custom_field[$custom_field['custom_field_id']]) ? $account_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="YYYY-MM-DD HH:mm" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
                    <span class="input-group-btn">
                    <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                    </span></div>
                </div>
              </div>
              <?php } ?>
              <?php } ?>
              <?php } ?>
            </div>
			
			
			
			
			
			<div class="tab-pane" id="tab-cart">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <td class="text-left"><?php echo $column_product; ?></td>
                      <td class="text-left"><?php echo $column_model; ?></td>
                      <td class="text-right"><?php echo $column_quantity; ?></td>
                      <td class="text-right"><?php echo $column_price; ?></td>
                      <td class="text-right"><?php echo $column_total; ?></td>
                      <td></td>
                    </tr>
                  </thead>
                  <tbody id="cart">
				  	<div style="display:none;">
                    <?php $product_row = 0; ?>
                    <?php if ($order_products || $order_vouchers) { ?>
                    <?php foreach ($order_products as $order_product) { ?>
                    <tr>
                      <td class="text-left"><?php echo $order_product['name']; ?><br />
                        <input type="hidden" name="product[<?php echo $product_row; ?>][product_id]" value="<?php echo $order_product['product_id']; ?>" />
                        <input type="hidden" name="product[<?php echo $product_row; ?>][name]" value="<?php echo $order_product['name']; ?>" />
                        <input type="hidden" name="product[<?php echo $product_row; ?>][is_gift]" value="<?php echo $order_product['is_gift']; ?>" />
                    	<?php $option_row = 0; ?>
                        <?php foreach ($order_product['option'] as $option) { ?>
						<span id="xuan_option_<?php echo $option_row; ?>">
					  	<i class="fa fa-minus-circle" onclick="$('#xuan_option_<?php echo $option_row; ?>').remove();"></i>
                        <small><?php echo $option['name']; ?>: <?php echo $option['value']; ?></small><br />
                        
							<?php foreach ($option as $key => $opt) { ?>
							<input type="hidden" name="product[<?php echo $product_row; ?>][option][<?php echo $option_row; ?>][<?php echo $key; ?>]" value="<?php echo $opt; ?>" />
							<?php } ?>
						</span>
                    	<?php $option_row++; ?>
                        <?php } ?></td>
                      <td class="text-left"><?php echo $order_product['model']; ?>
							<input type="hidden" name="product[<?php echo $product_row; ?>][model]" value="<?php echo $order_product['model']; ?>" />
							<input type="hidden" name="product[<?php echo $product_row; ?>][tax]" value="<?php echo $order_product['tax']; ?>" />
							<input type="hidden" name="product[<?php echo $product_row; ?>][reward]" value="<?php echo $order_product['reward']; ?>" /></td>
                      <td class="text-right item-quantity">
                        <input type="text" name="product[<?php echo $product_row; ?>][quantity]" value="<?php echo $order_product['quantity']; ?>" />
                        <input type="hidden" name="product[<?php echo $product_row; ?>][product_type]" value="<?php echo $order_product['product_type']; ?>" />
					  </td>
                      <td class="text-right item-price">
                        <input type="text" name="product[<?php echo $product_row; ?>][price]" value="<?php echo $order_product['price']; ?>" /><br />
						<span><?php echo $order_product['formatprice']; ?></span></td>
                      <td class="text-right item-total">
					    <span><?php echo $order_product['formattotal']; ?></span>
                        <input type="hidden" name="product[<?php echo $product_row; ?>][total]" value="<?php echo $order_product['total']; ?>" /></td>
                      <td class="text-center" style="width: 3px;"><button type="button" data-toggle="tooltip" title="<?php echo $button_remove; ?>" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                    </tr>
                    <?php $product_row++; ?>
                    <?php } ?>
                    <?php $voucher_row = 0; ?>
                    <?php foreach ($order_vouchers as $order_voucher) { ?>
                    <tr>
                      <td class="text-left"><?php echo $order_voucher['description']; ?>
                        <input type="hidden" name="voucher[<?php echo $voucher_row; ?>][voucher_id]" value="<?php echo $order_voucher['voucher_id']; ?>" />
                        <input type="hidden" name="voucher[<?php echo $voucher_row; ?>][description]" value="<?php echo $order_voucher['description']; ?>" />
                        <input type="hidden" name="voucher[<?php echo $voucher_row; ?>][code]" value="<?php echo $order_voucher['code']; ?>" />
                        <input type="hidden" name="voucher[<?php echo $voucher_row; ?>][from_name]" value="<?php echo $order_voucher['from_name']; ?>" />
                        <input type="hidden" name="voucher[<?php echo $voucher_row; ?>][from_email]" value="<?php echo $order_voucher['from_email']; ?>" />
                        <input type="hidden" name="voucher[<?php echo $voucher_row; ?>][to_name]" value="<?php echo $order_voucher['to_name']; ?>" />
                        <input type="hidden" name="voucher[<?php echo $voucher_row; ?>][to_email]" value="<?php echo $order_voucher['to_email']; ?>" />
                        <input type="hidden" name="voucher[<?php echo $voucher_row; ?>][voucher_theme_id]" value="<?php echo $order_voucher['voucher_theme_id']; ?>" />
                        <input type="hidden" name="voucher[<?php echo $voucher_row; ?>][message]" value="<?php echo $order_voucher['message']; ?>" />
                        <input type="hidden" name="voucher[<?php echo $voucher_row; ?>][amount]" value="<?php echo $order_voucher['amount']; ?>" /></td>
                      <td class="text-left"></td>
                      <td class="text-right">1</td>
                      <td class="text-right"></td>
                      <td class="text-right"></td>
                      <td class="text-center"></td>
                    </tr>
                    <?php $voucher_row++; ?>
                    <?php } ?>
                    <?php } else { ?>
                    <tr>
                      <td class="text-center" colspan="6"><?php echo $text_no_results; ?></td>
                    </tr>
                    <?php } ?>
                  </tbody>
				  </div>
                  <tfoot id="total">
                    <?php $total_row = 0; ?>
					<?php foreach ($total_data as $total) { ?>
					<?php
						if (strpos($total['code'], 'discount') === 0) {
					?>
					<tr id="gift_discount">
					  <td class="text-right" colspan="5">
					  	<i class="fa fa-minus-circle" onclick="$('#gift_discount').remove();"></i>
						<b><?php echo $total['title']; ?></b>
						<input type="hidden" name="totals[<?php echo $total_row; ?>][title]" value="<?php echo $total['title']; ?>" />
						<input type="hidden" name="totals[<?php echo $total_row; ?>][code]" value="<?php echo $total['code']; ?>" /></td>
					  <td class="text-right">
						<input type="hidden" name="totals[<?php echo $total_row; ?>][value]" value="<?php echo $total['value']; ?>" class="value" />
					  <span><?php echo $total['text']; ?></span></td>
					</tr>
					<?php
						} elseif ($total['code'] == 'point') {

						$points = 0;
				
						$start = strpos($total['title'], '(') + 1;
						$end = strrpos($total['title'], ')');
				
						if ($start && $end) {
							$points = substr($total['title'], $start, $end - $start);
						}
					?>
					<tr id="point">
					  <td class="text-right" colspan="5">
					  	<i class="fa fa-minus-circle" onclick="$('#point').remove(); countOrder();"></i>
						<b><?php echo $entry_reward; ?></b>
						<input type="text" value="<?php echo $points; ?>" size="5" style="max-width:50px; border:1px #FFF solid; border-bottom:1px #555 dotted; padding:0; margin:0; text-align:right;" />
						<input type="hidden" name="totals[<?php echo $total_row; ?>][title]" value="<?php echo $total['title']; ?>" class="title" />
						<input type="hidden" name="totals[<?php echo $total_row; ?>][code]" value="<?php echo $total['code']; ?>" /></td>
					  <td class="text-right">
						<input type="hidden" name="totals[<?php echo $total_row; ?>][value]" value="<?php echo $total['value']; ?>" class="value" />
					  <span><?php echo $total['text']; ?></span></td>
					</tr>
					<?php
						} elseif ($total['code'] == 'shipping') {
							$cost = round((float)$total['value'], 2);
					?>
					<tr id="shipping">
					  <td class="text-right" colspan="5">
						<b><?php echo $total['title']; ?></b>
						<input type="text" name="totals[<?php echo $total_row; ?>][value]" value="<?php echo $cost; ?>" size="5" style="max-width:50px; border:1px #FFF solid; border-bottom:1px #555 dotted; padding:0; margin:0; text-align:right;" class="value" />
						<input type="hidden" name="totals[<?php echo $total_row; ?>][title]" value="<?php echo $total['title']; ?>" id="shipping_title" />
						<input type="hidden" name="totals[<?php echo $total_row; ?>][code]" value="<?php echo $total['code']; ?>" /></td>
					  <td class="text-right"><span><?php echo $total['text']; ?></span></td>
					</tr>
					<?php
						} elseif (strpos($total['code'], 'total_custom') === 0) {
					?>
					<tr id="<?php echo $total['code']; ?>">
					  <td class="text-right" colspan="5">
					  	<i class="fa fa-minus-circle" onclick="$('#<?php echo $total['code']; ?>').remove(); countOrder();"></i>
						<input type="text" name="totals[<?php echo $total_row; ?>][title]" value="<?php echo $total['title']; ?>" style="max-width:50px; border:1px #FFF solid; border-bottom:1px #555 dotted; padding:0; margin:0; text-align:right;" class="value" />
						<input type="hidden" name="totals[<?php echo $total_row; ?>][code]" value="<?php echo $total['code']; ?>" /></td>
					  <td class="text-right">
						<input type="hidden" name="totals[<?php echo $total_row; ?>][value]" value="<?php echo $total['value']; ?>" class="value" />
					  <span><?php echo $total['text']; ?></span></td>
					</tr>
					<?php } else { ?>
					<tr id="xuan_<?php echo $total['code']; ?>">
					  <td class="text-right" colspan="5"><b><?php echo $total['title']; ?></b>
						<input type="hidden" name="totals[<?php echo $total_row; ?>][title]" value="<?php echo $total['title']; ?>" />
						<input type="hidden" name="totals[<?php echo $total_row; ?>][code]" value="<?php echo $total['code']; ?>" /></td>
					  <td class="text-right">
					  	<?php if ($total['code'] != 'total') { ?>
						<input type="hidden" name="totals[<?php echo $total_row; ?>][value]" value="<?php echo $total['value']; ?>" class="value" />
					  	<?php } else { ?>
						<input type="hidden" name="totals[<?php echo $total_row; ?>][value]" value="<?php echo $total['value']; ?>" class="order_total" />
						<?php } ?>
						<span><?php echo $total['text']; ?></span></td>
					</tr>
					<?php } ?>
                    <?php $total_row++; ?>
					<?php } ?>
				  </tfoot>
                </table>
              </div>
			  
			  <fieldset id="tab-product">
				<legend><?php echo $text_product; ?></legend>
				<div class="form-group">
				  <label class="col-sm-2 control-label" for="input-product"><?php echo $entry_product; ?></label>
				  <div class="col-sm-10">
					<input type="text" name="product_filter" value="" id="input-product" class="form-control" />
					<input type="hidden" id="product_id" value="" />
					<input type="hidden" id="is_gift" value="0" />
				  </div>
				</div>
				<div id="option"></div>
			  </fieldset>
			  
			  
			  <fieldset id="tab-gift">
				<legend>订单项目</legend>
				<div class="form-group">
				  <label class="col-sm-2 control-label">项目：</label>
				  <div class="col-sm-4"><input type="text" class="xuan-dis-text form-control"></div>
				  <label class="col-sm-1 control-label">金额：</label>
				  <div class="col-sm-3"><input type="text" class="xuan-dis-value form-control"></div>
				  <div class="col-sm-1"><button type="button" id="xuan-dis-add" class="btn btn-primary"><i class="fa fa-plus-circle"></i> 添加项目</button></div>
				  <div class="col-sm-1"><button type="button" class="btn btn-primary" onclick="addPoint();"><i class="fa fa-plus-circle"></i> 积分</button></div></div>
			  </fieldset>
            </div>
			
			
			
			
			
			
			
			
			<div class="tab-pane" id="tab-payment">
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-payment-address"><?php echo $entry_address; ?></label>
                <div class="col-sm-10">
                  <select name="payment_address" id="input-payment-address" class="form-control">
                    <option value="0" selected="selected"><?php echo $text_none; ?></option>
                    <?php foreach ($addresses as $address) { ?>
                    <option value="<?php echo $address['address_id']; ?>"><?php echo $address['firstname'] . ' ' . $address['lastname'] . ', ' . $address['address_1'] . ', ' . $address['city'] . ', ' . $address['country']; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-payment-firstname"><?php echo $entry_firstname; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="payment_firstname" value="<?php echo $payment_firstname; ?>" id="input-payment-firstname" class="form-control" />
                </div>
              </div>
              <div class="form-group required" style="display:none;">
                <label class="col-sm-2 control-label" for="input-payment-lastname"><?php echo $entry_lastname; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="payment_lastname" value="<?php echo $payment_lastname; ?>" id="input-payment-lastname" class="form-control" />
                </div>
              </div>
      
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-payment-company"><?php echo $entry_company; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="payment_company" value="<?php echo $payment_company; ?>" id="input-payment-company" class="form-control" />
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-payment-address-1"><?php echo $entry_address_1; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="payment_address_1" value="<?php echo $payment_address_1; ?>" id="input-payment-address-1" class="form-control" />
                </div>
              </div>
              <div class="form-group" style="display:none;">
                <label class="col-sm-2 control-label" for="input-payment-address-2"><?php echo $entry_address_2; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="payment_address_2" value="<?php echo $payment_address_2; ?>" id="input-payment-address-2" class="form-control" />
                </div>
              </div>
 
              <div class="form-group required" style="display:none;">
                <label class="col-sm-2 control-label" for="input-payment-city"><?php echo $entry_city; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="payment_city" value="<?php echo $payment_city; ?>" id="input-payment-city" class="form-control" />
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-payment-postcode"><?php echo $entry_postcode; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="payment_postcode" value="<?php echo $payment_postcode; ?>" id="input-payment-postcode" class="form-control" />
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-payment-country"><?php echo $entry_country; ?></label>
                <div class="col-sm-10">
                  <select name="payment_country_id" id="input-payment-country" class="form-control">
                    <?php foreach ($countries as $country) { ?>
                    <?php if ($country['country_id'] == $payment_country_id) { ?>
                    <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-payment-zone"><?php echo $entry_zone; ?></label>
                <div class="col-sm-10">
                  <select name="payment_zone_id" id="input-payment-zone" class="form-control">
                  </select>
                </div>
              </div>
              <?php foreach ($custom_fields as $custom_field) { ?>
              <?php if ($custom_field['location'] == 'address') { ?>
              <?php if ($custom_field['type'] == 'select') { ?>
              <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>">
                <label class="col-sm-2 control-label" for="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
                <div class="col-sm-10">
                  <select name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" id="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control">
                    <option value=""><?php echo $text_select; ?></option>
                    <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
                    <?php if (isset($payment_custom_field[$custom_field['custom_field_id']]) && $custom_field_value['custom_field_value_id'] == $payment_custom_field[$custom_field['custom_field_id']]) { ?>
                    <option value="<?php echo $custom_field_value['custom_field_value_id']; ?>" selected="selected"><?php echo $custom_field_value['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $custom_field_value['custom_field_value_id']; ?>"><?php echo $custom_field_value['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <?php } ?>
              <?php if ($custom_field['type'] == 'radio') { ?>
              <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>">
                <label class="col-sm-2 control-label"><?php echo $custom_field['name']; ?></label>
                <div class="col-sm-10">
                  <div id="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>">
                    <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
                    <div class="radio">
                      <?php if (isset($payment_custom_field[$custom_field['custom_field_id']]) && $custom_field_value['custom_field_value_id'] == $payment_custom_field[$custom_field['custom_field_id']]) { ?>
                      <label>
                        <input type="radio" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" checked="checked" />
                        <?php echo $custom_field_value['name']; ?></label>
                      <?php } else { ?>
                      <label>
                        <input type="radio" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" />
                        <?php echo $custom_field_value['name']; ?></label>
                      <?php } ?>
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <?php } ?>
              <?php if ($custom_field['type'] == 'checkbox') { ?>
              <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>">
                <label class="col-sm-2 control-label"><?php echo $custom_field['name']; ?></label>
                <div class="col-sm-10">
                  <div id="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>">
                    <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
                    <div class="checkbox">
                      <?php if (isset($payment_custom_field[$custom_field['custom_field_id']]) && in_array($custom_field_value['custom_field_value_id'], $payment_custom_field[$custom_field['custom_field_id']])) { ?>
                      <label>
                        <input type="checkbox" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>][]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" checked="checked" />
                        <?php echo $custom_field_value['name']; ?></label>
                      <?php } else { ?>
                      <label>
                        <input type="checkbox" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>][]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" />
                        <?php echo $custom_field_value['name']; ?></label>
                      <?php } ?>
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <?php } ?>
              <?php if ($custom_field['type'] == 'text') { ?>
              <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>">
                <label class="col-sm-2 control-label" for="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($payment_custom_field[$custom_field['custom_field_id']]) ? $payment_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" id="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
                </div>
              </div>
              <?php } ?>
              <?php if ($custom_field['type'] == 'textarea') { ?>
              <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>">
                <label class="col-sm-2 control-label" for="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
                <div class="col-sm-10">
                  <textarea name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" rows="5" placeholder="<?php echo $custom_field['name']; ?>" id="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control"><?php echo (isset($payment_custom_field[$custom_field['custom_field_id']]) ? $payment_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?></textarea>
                </div>
              </div>
              <?php } ?>
              <?php if ($custom_field['type'] == 'file') { ?>
              <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>">
                <label class="col-sm-2 control-label"><?php echo $custom_field['name']; ?></label>
                <div class="col-sm-10">
                  <button type="button" id="button-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-default"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>
                  <input type="hidden" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($payment_custom_field[$custom_field['custom_field_id']]) ? $payment_custom_field[$custom_field['custom_field_id']] : ''); ?>" id="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>" />
                </div>
              </div>
              <?php } ?>
              <?php if ($custom_field['type'] == 'date') { ?>
              <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>">
                <label class="col-sm-2 control-label" for="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
                <div class="col-sm-10">
                  <div class="input-group date">
                    <input type="text" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($payment_custom_field[$custom_field['custom_field_id']]) ? $payment_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="YYYY-MM-DD" id="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
                    <span class="input-group-btn">
                    <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                    </span></div>
                </div>
              </div>
              <?php } ?>
              <?php if ($custom_field['type'] == 'time') { ?>
              <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>">
                <label class="col-sm-2 control-label" for="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
                <div class="col-sm-10">
                  <div class="input-group time">
                    <input type="text" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($payment_custom_field[$custom_field['custom_field_id']]) ? $payment_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="HH:mm" id="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
                    <span class="input-group-btn">
                    <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                    </span></div>
                </div>
              </div>
              <?php } ?>
              <?php if ($custom_field['type'] == 'datetime') { ?>
              <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>">
                <label class="col-sm-2 control-label" for="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
                <div class="col-sm-10">
                  <div class="input-group datetime">
                    <input type="text" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($payment_custom_field[$custom_field['custom_field_id']]) ? $payment_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="YYYY-MM-DD HH:mm" id="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
                    <span class="input-group-btn">
                    <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                    </span></div>
                </div>
              </div>
              <?php } ?>
              <?php } ?>
              <?php } ?>
			  
			  
			  
			  
			  
			  
			  
			  
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-shipping-method"><?php echo $entry_shipping_method; ?></label>
                  <div class="col-sm-10">
                      <select name="shipping_method" id="input-shipping-method" class="form-control">
                        <option value=""><?php echo $text_select; ?></option>
                        <?php foreach ($shipping_methods as $pm) { ?>
                        <?php if ($shipping_code == $pm['code']) { ?>
                        <option value="<?php echo $pm['code']; ?>:::<?php echo $pm['title']; ?>" selected="selected"><?php echo $pm['title']; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $pm['code']; ?>:::<?php echo $pm['title']; ?>"><?php echo $pm['title']; ?></option>
                        <?php } ?>
                        <?php } ?>
                      </select>
                  </div>
                </div>
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-currency-code">货币：</label>
                  <div class="col-sm-10">
                      <select name="currency_code" id="input-currency-code" class="form-control">
                        <?php foreach ($currencies as $currency) { ?>
                        <?php if ($currency['code'] == $currency_code) { ?>
                        <option value="<?php echo $currency['code']; ?>" selected="selected"><?php echo $currency['title']; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $currency['code']; ?>"><?php echo $currency['title']; ?></option>
                        <?php } ?>
                        <?php } ?>
                      </select>
                  </div>
                </div>
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-payment-method"><?php echo $entry_payment_method; ?></label>
                  <div class="col-sm-10">
                      <select name="payment_method" id="input-payment-method" class="form-control">
                        <?php foreach ($payment_methods as $pm) { ?>
                        <?php if ($payment_code == $pm['code']) { ?>
                        <option value="<?php echo $pm['code']; ?>:::<?php echo $pm['title']; ?>" selected="selected"><?php echo $pm['title']; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $pm['code']; ?>:::<?php echo $pm['title']; ?>"><?php echo $pm['title']; ?></option>
                        <?php } ?>
                        <?php } ?>
                      </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-order-status"><?php echo $entry_order_status; ?></label>
                  <div class="col-sm-10">
                    <select name="order_status_id" id="input-order-status" class="form-control">
                      <?php foreach ($order_statuses as $order_status) { ?>
                      <?php if ($order_status['order_status_id'] == $order_status_id) { ?>
                      <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                    <input type="hidden" name="order_id" value="<?php echo $order_id; ?>" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-comment"><?php echo $entry_comment; ?></label>
                  <div class="col-sm-10">
                    <textarea name="comment" rows="5" id="input-comment" class="form-control"><?php echo $comment; ?></textarea>
                  </div>
                </div>
            </div>
			
			
			
			
			
			
			
		  </div>
		</form>
      </div>
    </div>
  </div>
<script type="text/javascript"><!--
/*
	currency
*/
function currency($price) {
	var value = <?php echo $currency_value; ?>;
	
	$price = (parseFloat($price) * <?php echo $currency_value; ?>).toFixed(0);
	
	return parseFloat($price);
}


/*
	order total
*/
function countOrder() {
	var total_order = 0;
	
	$('#total .value').each(function(){
		total_order += parseFloat($(this).val());
	});
	
	$('#xuan_total .order_total').val(total_order);
	$('#xuan_total span').html('<?php echo $symbol_left?$symbol_left:''; ?>'+currency(total_order).toLocaleString()+'<?php echo $symbol_right?$symbol_right:''; ?>');
}

function countProducts(obj) {
	var qty = 0;
	
	$(obj).parent().parent().find('.item-quantity input[type=\'text\']').each(function(){
		qty += parseFloat($(this).val());
	});
	
	$('#item-quantity').text(qty);
	$('#input-quantity').val(qty);
	
	var price = $(obj).parent().parent().find('.item-price input').val();
	var reNum=/^[0-9]+.?[0-9]*$/;
	
	if (!reNum.test(qty)) {
		qty = 0;
	}
	
	if (!reNum.test(price)) {
		price = 0;
	}
	
	var item_total = parseFloat(qty) * parseFloat(price);
	var total_sub = 0;
	
	$(obj).parent().parent().find('.item-total input').val(item_total);
	$(obj).parent().parent().find('.item-price span').html('<?php echo $symbol_left?$symbol_left:''; ?>'+currency(price).toLocaleString()+'<?php echo $symbol_right?$symbol_right:''; ?>');
	$(obj).parent().parent().find('.item-total span').html('<?php echo $symbol_left?$symbol_left:''; ?>'+currency(item_total).toLocaleString()+'<?php echo $symbol_right?$symbol_right:''; ?>');
	
	$('.item-total input').each(function(){
		total_sub += parseFloat($(this).val());
	});
	
	$('#xuan_sub_total .value').val(total_sub);
	$('#xuan_sub_total span').html('<?php echo $symbol_left?$symbol_left:''; ?>'+currency(total_sub).toLocaleString()+'<?php echo $symbol_right?$symbol_right:''; ?>');
	
	countOrder();
}

function xuanSubTotal() {
	$('#cart input[type=\'text\']').each(function(){
		$(this).keyup(function(){
			countProducts(this);
		});
		
		$(this).blur(function(){
			countProducts(this);
		});
	});
}

xuanSubTotal();

/*
	point
*/
function countPoint(obj) {
	var point = parseInt($(obj).val());
	var rate = parseInt(<?php echo $point_fee; ?>);
	var reNum = /^[0-9]+.?[0-9]*$/;
	
	if (!reNum.test(point)) {
		point = 0;
	}
	
	if (!reNum.test(rate)) {
		rate = 1;
	}
	
	var total = parseFloat(-(point / rate)).toFixed(2);
	var title = '<?php echo $entry_reward; ?> (xxx)';
	
	$('#point .title').val(title.replace('xxx', point));
	$('#point .value').val(total);
	$('#point span').html('<?php echo $symbol_left?$symbol_left:''; ?>'+currency(total).toLocaleString()+'<?php echo $symbol_right?$symbol_right:''; ?>');
}

function xuanPoint() {
	$('#point input[type=\'text\']').keyup(function(){
		countPoint(this);
		countOrder();
	});
	
	$('#point input[type=\'text\']').blur(function(){
		countPoint(this);
		countOrder();
	});
}

xuanPoint();

/*
	shipping
*/
function countShipping(obj) {
	var cost = parseFloat($(obj).val()).toFixed(2);
	var reNum=/^[0-9]+.?[0-9]*$/;
	
	if (!reNum.test(cost)) {
		cost = 0;
	
		$(obj).val(cost);
	}
		
	$('#shipping span').html('<?php echo $symbol_left?$symbol_left:''; ?>'+currency(cost).toLocaleString()+'<?php echo $symbol_right?$symbol_right:''; ?>');
	
	countOrder();
}

function xuanShipping() {
	$('#shipping input[type=\'text\']').keyup(function(){
		countShipping(this);
	});
	
	$('#shipping input[type=\'text\']').blur(function(){
		countShipping(this);
	});
}

xuanShipping();

var total_row = <?php echo $total_row; ?>;

function addPoint() {
	var html  = '<tr id="point">';
		html += '<td class="text-right" colspan="5">';
		html += '  <i class="fa fa-minus-circle" onclick="$(\'#point\').remove(); countOrder();"></i>';
		html += '  <b><?php echo $entry_reward; ?></b>';
		html += '  <input type="text" value="0" size="5" style="max-width:50px; border:1px #FFF solid; border-bottom:1px #555 dotted; padding:0; margin:0; text-align:right;" />';
		html += '  <input type="hidden" name="totals['+total_row+'][title]" value="<?php echo $entry_reward; ?> (0)" class="title" />';
		html += '  <input type="hidden" name="totals['+total_row+'][code]" value="point" />';
		html += '</td>';
		html += '<td class="text-right">';
		html += '  <input type="hidden" name="totals['+total_row+'][value]" value="0" class="value" />';
		html += '  <span><?php echo $symbol_left?$symbol_left:''; ?>0<?php echo $symbol_right?$symbol_right:''; ?></span>';
		html += '</td>';
		html += '</tr>';
	
	if (!$('#point')[0]) {
		$('#xuan_sub_total').after(html);
		
		xuanPoint();
		countOrder();
	}
}

$('#xuan-dis-add').click(function(){
	var title = $('.xuan-dis-text').val();
	var amount = $('.xuan-dis-value').val();
	var reNum = /^[0-9-]+.?[0-9]*$/;
		
	if (!reNum.test(amount)) {
		amount = 1;
	}
	
	if (title.length > 0) {
		var html  = '<tr id="xuan_total_custom'+total_row+'">';
			html += '  <td class="text-right" colspan="5"><i class="fa fa-minus-circle" onclick="$(\'#xuan_total_custom'+total_row+'\').remove();"></i>';
			html += '  <b>'+$('.xuan-dis-text').val()+'</b>';
			html += '    <input type="hidden" name="totals['+total_row+'][title]" value="'+title+'" />';
			html += '    <input type="hidden" name="totals['+total_row+'][code]" value="total_custom'+total_row+'" /></td>';
			html += '  <td class="text-right">';
			html += '    <input type="hidden" name="totals['+total_row+'][value]" value="'+amount+'" class="value" />';
			html += '    <span><?php echo $symbol_left?$symbol_left:''; ?>'+currency(amount).toLocaleString()+'<?php echo $symbol_right?$symbol_right:''; ?></span></td>';
			html += '</tr>';
		
		$('#xuan_total').before(html);
	
		total_row ++;
		
		countOrder();
	} else {
		alert('title required!');
	}
});

// Customer
$('input[name=\'customer\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=sale/customer/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',			
			success: function(json) {
				json.unshift({
					customer_id: '0',
					customer_group_id: '<?php echo $customer_group_id; ?>',						
					name: '<?php echo $text_none; ?>',
					customer_group: '',
					firstname: '',
					lastname: '',
					email: '',
					telephone: '',
					fax: '',
					custom_field: [],
					address: []			
				});				
				
				response($.map(json, function(item) {
					return {
						category: item['customer_group'],
						label: item['name'],
						value: item['customer_id'],
						customer_group_id: item['customer_group_id'],						
						firstname: item['firstname'],
						lastname: item['lastname'],
						email: item['email'],
						telephone: item['telephone'],
						fax: item['fax'],
						custom_field: item['custom_field'],
						address: item['address']
					}
				}));
			}
		});
	},
	'select': function(item) {
		// Reset all custom fields
		$('#tab-customer input[type=\'text\'], #tab-customer input[type=\'text\'], #tab-customer textarea').not('#tab-customer input[name=\'customer\'], #tab-customer input[name=\'customer_id\']').val('');
		$('#tab-customer select option').removeAttr('selected');
		$('#tab-customer input[type=\'checkbox\'], #tab-customer input[type=\'radio\']').removeAttr('checked');
		
		$('#tab-customer input[name=\'customer\']').val(item['label']);
		$('#tab-customer input[name=\'customer_id\']').val(item['value']);
		$('#tab-customer select[name=\'customer_group_id\']').val(item['customer_group_id']);
		$('#tab-customer input[name=\'firstname\']').val(item['firstname']);
		$('#tab-customer input[name=\'lastname\']').val(item['lastname']);
		$('#tab-customer input[name=\'email\']').val(item['email']);
		$('#tab-customer input[name=\'telephone\']').val(item['telephone']);
		$('#tab-customer input[name=\'fax\']').val(item['fax']);		
				
		for (i in item.custom_field) {
			$('#tab-customer select[name=\'custom_field[' + i + ']\']').val(item.custom_field[i]);
			$('#tab-customer textarea[name=\'custom_field[' + i + ']\']').val(item.custom_field[i]);
			$('#tab-customer input[name^=\'custom_field[' + i + ']\'][type=\'text\']').val(item.custom_field[i]);
			$('#tab-customer input[name^=\'custom_field[' + i + ']\'][type=\'hidden\']').val(item.custom_field[i]);
			$('#tab-customer input[name^=\'custom_field[' + i + ']\'][type=\'radio\'][value=\'' + item.custom_field[i] + '\']').prop('checked', true);	
			
			if (item.custom_field[i] instanceof Array) {
				for (j = 0; j < item.custom_field[i].length; j++) {
					$('#tab-customer input[name^=\'custom_field[' + i + ']\'][type=\'checkbox\'][value=\'' + item.custom_field[i][j] + '\']').prop('checked', true);
				}
			}
		}
	
		$('select[name=\'customer_group_id\']').trigger('change');
		
		html = '<option value="0"><?php echo $text_none; ?></option>'; 
			
		for (i in  item['address']) {
			html += '<option value="' + item['address'][i]['address_id'] + '">' + item['address'][i]['firstname'] + ' ' + item['address'][i]['lastname'] + ', ' + item['address'][i]['address_1'] + ', ' + item['address'][i]['city'] + ', ' + item['address'][i]['country'] + '</option>';
		}
		
		$('select[name=\'payment_address\']').html(html);
		
		$('select[name=\'payment_address\']').trigger('change');
	}
});

// Custom Fields
$('select[name=\'customer_group_id\']').on('change', function() {
	$.ajax({
		url: 'index.php?route=sale/customer/customfield&token=<?php echo $token; ?>&customer_group_id=' + this.value,
		dataType: 'json',	
		success: function(json) {
			$('.custom-field').hide();
			$('.custom-field').removeClass('required');
			
			for (i = 0; i < json.length; i++) {
				custom_field = json[i];
				
				$('.custom-field' + custom_field['custom_field_id']).show();
				
				if (custom_field['required']) {
					$('.custom-field' + custom_field['custom_field_id']).addClass('required');
				}
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('select[name=\'customer_group_id\']').trigger('change');


// Change Currency Code
$('#input-currency-code').on('change', function() {
	var order_id = $('input[name=\'order_id\']').val();
	
	if (parseInt(order_id) > 0) {
		$.ajax({
			url: 'index.php?route=sale/order/updateOrderCurrency&token=<?php echo $token; ?>&order_id='+order_id+'&currency_code=' + this.value,
			dataType: 'json',
			success: function(json) {				
				if (json['error']) {
					alert(json['error']);
				} else {
					window.location.reload();
				}
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	}
});

// Change Shipping Method
$('#input-shipping-method').on('change', function() {
	var t = $(this).find("option:selected").text();
	
	alert(t);
	$('#shipping b').html(t);
	$('#shipping_title').html(t);
});


// Save Order
$('#button-save').on('click', function() {
	var order_id = $('input[name=\'order_id\']').val();
	
	if (order_id == 0) {
		var url = 'index.php?route=sale/order/saveorder&token=<?php echo $token; ?>&store_id=' + $('select[name=\'store_id\'] option:selected').val();
	} else {
		var url = 'index.php?route=sale/order/saveorder&token=<?php echo $token; ?>&store_id=' + $('select[name=\'store_id\'] option:selected').val() + '&order_id=' + order_id;
	}
	
	$.ajax({
		url: url,
		type: 'post',
		data: $('#form-order select, #tab-total textarea, #form-order input, #input-comment'),
		dataType: 'json',
		beforeSend: function() {
			$('#button-save').button('loading');	
		},	
		complete: function() {
			$('#button-save').button('reset');
		},		
		success: function(json) {
			$('.alert, .text-danger').remove();
			
			if (json['error']) {
				$('#content > .container-fluid').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
			}
			
			if (json['success']) {
				$('#content > .container-fluid').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '  <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
			}
			
			if (json['order_id']) {
				$('input[name=\'order_id\']').val(json['order_id']);
			}			
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});		
});

var product_row = <?php echo $product_row; ?>;

// Product
$('#tab-product input[name=\'product_filter\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',			
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['product_id'],
						model: item['model'],
						option: item['option'],
						price: item['price'],
						type: item['product_type']						
					}
				}));
			}
		});
	},
	'select': function(item) {
		var html = '<tr>';
		html += '<td class="text-left">'+item['label']+'<br />';
		html += '<input type="hidden" name="product['+product_row+'][product_id]" value="'+item['value']+'">';
		html += '<input type="hidden" name="product['+product_row+'][name]" value="'+item['label']+'">';
		html += '<input type="hidden" name="product['+product_row+'][is_gift]" value="0">';
		
		for (i = 0; i < item['option'].length; i++) {
			var option = item['option'][i];
			
			for (j = 0; j < option['product_option_value'].length; j++) {
				var option_value = option['product_option_value'][j];
				
				html += '  <span id="xuan_option_'+j+'">';
				html += '  <i class="fa fa-minus-circle" onclick="$(\'#xuan_option_'+product_row+'\').remove();"></i>';
				html += '  <small>'+option['name']+': '+option_value['name']+'</small><br />';
				html += '  <input type="hidden" name="product['+product_row+'][option]['+j+'][product_option_id]" value="'+option['product_option_id']+'">';
				html += '  <input type="hidden" name="product['+product_row+'][option]['+j+'][product_option_value_id]" value="'+option_value['product_option_value_id']+'">';
				html += '  <input type="hidden" name="product['+product_row+'][option]['+j+'][name]" value="'+option['name']+'">';
				html += '  <input type="hidden" name="product['+product_row+'][option]['+j+'][value]" value="'+option_value['name']+'">';
				html += '  <input type="hidden" name="product['+product_row+'][option]['+j+'][type]" value="'+option['type']+'">';
				html += '  </span>';
			}
		}		
		
		
		
		html += '</td>';
		html += '<td class="text-left">'+item['model'];
		html += '  <input type="hidden" name="product['+product_row+'][model]" value="'+item['model']+'">';
		html += '  <input type="hidden" name="product['+product_row+'][tax]" value="'+item['tax']+'">';
		html += '  <input type="hidden" name="product['+product_row+'][reward]" value="'+item['reward']+'">';
		html += '</td>';
		
		html += '<td class="text-right item-quantity">';
		html += '<input type="text" name="product['+product_row+'][quantity]" value="1" />';
		html += '<input type="hidden" name="product['+product_row+'][product_type]" value="'+item['type']+'" />';
		html += '</td>';
		
		html += '<td class="text-right item-price">';
		html += '<input type="text" name="product['+product_row+'][price]" value="'+item['price']+'" /><br />';
		html += '<span>'+currency(item['price'])+'</span>';
		html += '</td>';
		html += '<td class="text-right item-total">';
		html += '  <span>'+currency(item['price'])+'</span>';
		html += '  <input type="hidden" name="product['+product_row+'][total]" value="'+item['price']+'">';
		html += '</td>';
		html += '<td class="text-center" style="width: 3px;"><button type="button" data-toggle="tooltip" title="" data-loading-text="加載..." class="btn btn-danger" data-original-title="移除"><i class="fa fa-minus-circle"></i></button></td>';
		html += '</tr>';
		
		$('#cart').append(html);
		
		xuanSubTotal();
		
		$('#cart input[type=\'text\']').trigger('blur');
		
		product_row++;
	}
});

$('#cart').delegate('.btn-danger', 'click', function() {
	var tr = 0;
	
	$('#cart tr').each(function(){tr++});
	
	if (tr > 1) {
		$(this).parent().parent().remove();
	} else {
		alert('至少要有一个商品！');
	}
});

// Gift
$('#tab-gift input[name=\'product_filter\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=module/gift/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',			
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: '['+item['group_name']+'] '+item['name']+' '+item['model'],
						value: item['product_id'],
						model: item['model'],
						option: item['option'],
						price: item['price'],
						group: item['group']
					}
				}));
			}
		});
	},
	'select': function(item) {
		if (String(item['value']).indexOf('discount') > -1) {
			$('#tab-gift input[name=\'product_filter\']').val(item['label']);
			$('#tab-gift #discount').attr('name', 'gift_discount').val(item['value']);
		} else {
			$('#tab-gift input[name=\'product_filter\']').val(item['label']);
			$('#tab-gift #product_id').attr('name', 'product['+product_row+'][product_id]').val(item['value']);
			$('#tab-gift #is_gift').attr('name', 'product['+product_row+'][is_gift]').val('1');
			$('#tab-gift #quantity').attr('name', 'product['+product_row+'][quantity]');
			
			product_row++;
		}
	}	
});

// Voucher
$('#button-voucher-add').on('click', function() {
	$.ajax({
		url: 'index.php?route=sale/order/api&token=<?php echo $token; ?>&api=api/voucher/add&store_id=' + $('select[name=\'store_id\'] option:selected').val(),
		type: 'post',
		data: $('#tab-voucher input[type=\'text\'], #tab-voucher input[type=\'hidden\'], #tab-voucher input[type=\'radio\']:checked, #tab-voucher input[type=\'checkbox\']:checked, #tab-voucher select, #tab-voucher textarea'),
		dataType: 'json',
		beforeSend: function() {
			$('#button-voucher-add').button('loading');
		},
		complete: function() {
			$('#button-voucher-add').button('reset');
		},
		success: function(json) {
			$('.alert, .text-danger').remove();
			$('.form-group').removeClass('has-error');
		
			if (json['error']) {
				if (json['error']['warning']) {
					$('#content > .container-fluid').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['warning'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				}

				for (i in json['error']) {
					var element = $('#input-' + i.replace('_', '-'));
					
					if (element.parent().hasClass('input-group')) {
						$(element).parent().after('<div class="text-danger">' + json['error'][i] + '</div>');
					} else {
						$(element).after('<div class="text-danger">' + json['error'][i] + '</div>');
					}
				}	

				// Highlight any found errors
				$('.text-danger').parentsUntil('.form-group').parent().addClass('has-error');					
			} else {
				$('input[name=\'from_name\']').attr('value', '');	
				$('input[name=\'from_email\']').attr('value', '');	
				$('input[name=\'to_name\']').attr('value', '');
				$('input[name=\'to_email\']').attr('value', '');	
				$('textarea[name=\'message\']').attr('value', '');	
				$('input[name=\'amount\']').attr('value', '<?php echo addslashes($voucher_min); ?>');
					
				// Refresh products, vouchers and totals
				$('#button-refresh').trigger('click');
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});				
});

// Payment Address
$('select[name=\'payment_address\']').on('change', function() {
	$.ajax({
		url: 'index.php?route=sale/customer/address&token=<?php echo $token; ?>&address_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'payment_address\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
		},
		complete: function() {
			$('#tab-payment .fa-spin').remove();
		},		
		success: function(json) {
			// Reset all fields
			$('#tab-payment input[type=\'text\'], #tab-payment input[type=\'text\'], #tab-payment textarea').val('');
			$('#tab-payment select option').not('#tab-payment select[name=\'payment_address\']').removeAttr('selected');
			$('#tab-payment input[type=\'checkbox\'], #tab-payment input[type=\'radio\']').removeAttr('checked');
					
			$('#tab-payment input[name=\'payment_firstname\']').val(json['firstname']);
			$('#tab-payment input[name=\'payment_lastname\']').val(json['lastname']);
			//$('#tab-payment input[name=\'company\']').val(json['company']);
			$('#tab-payment input[name=\'payment_address_1\']').val(json['address_1']);
			$('#tab-payment input[name=\'payment_address_2\']').val(json['address_2']);
			$('#tab-payment input[name=\'payment_city\']').val(json['city']);
			$('#tab-payment input[name=\'payment_postcode\']').val(json['postcode']);
			
			if (json['country_id']) {
				$('#tab-payment select[name=\'payment_country_id\']').val(json['country_id']);
			}
			
			payment_zone_id = json['zone_id'];
			
			for (i in json['custom_field']) {
				$('#tab-payment select[name=\'custom_field[' + i + ']\']').val(json['custom_field'][i]);
				$('#tab-payment textarea[name=\'custom_field[' + i + ']\']').val(json['custom_field'][i]);
				$('#tab-payment input[name^=\'custom_field[' + i + ']\'][type=\'text\']').val(json['custom_field'][i]);
				$('#tab-payment input[name^=\'custom_field[' + i + ']\'][type=\'hidden\']').val(json['custom_field'][i]);
				$('#tab-payment input[name^=\'custom_field[' + i + ']\'][type=\'radio\'][value=\'' + json['custom_field'][i] + '\']').prop('checked', true);	
				$('#tab-payment input[name^=\'custom_field[' + i + ']\'][type=\'checkbox\'][value=\'' + json['custom_field'][i] + '\']').prop('checked', true);
				
				if (json['custom_field'][i] instanceof Array) {
					for (j = 0; j < json['custom_field'][i].length; j++) {
						$('#tab-payment input[name^=\'custom_field[' + i + ']\'][type=\'checkbox\'][value=\'' + json['custom_field'][i][j] + '\']').prop('checked', true);
					}
				}						
			}				
			
			$('#tab-payment select[name=\'payment_country_id\']').trigger('change');
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});	
});

var payment_zone_id = '<?php echo $payment_zone_id; ?>';

$('#tab-payment select[name=\'payment_country_id\']').on('change', function() {
	$.ajax({
		url: 'index.php?route=sale/order/country&token=<?php echo $token; ?>&country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('#tab-payment select[name=\'payment_country_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
		},
		complete: function() {
			$('#tab-payment .fa-spin').remove();
		},			
		success: function(json) {
			if (json['postcode_required'] == '1') {
				$('#tab-payment input[name=\'postcode\']').parent().parent().addClass('required');
			} else {
				$('#tab-payment input[name=\'postcode\']').parent().parent().removeClass('required');
			}
			
			html = '<option value=""><?php echo $text_select; ?></option>';

			if (json['zone'] != '') {
				for (i = 0; i < json['zone'].length; i++) {
        			html += '<option value="' + json['zone'][i]['zone_id'] + '"';
	    			
					if (json['zone'][i]['zone_id'] == payment_zone_id) {
	      				html += ' selected="selected"';
	    			}
	
	    			html += '>' + json['zone'][i]['name'] + '</option>';
				}
			} else {
				html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
			}
			
			$('#tab-payment select[name=\'payment_zone_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('#tab-payment select[name=\'payment_country_id\']').trigger('change');
//--></script></div>
<?php echo $footer; ?>