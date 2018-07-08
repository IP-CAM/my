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
            <li><a href="#tab-cart" data-toggle="tab" onclick="$('#button-product-add').trigger('click');"><?php echo $tab_product; ?></a></li>
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
                        <input type="hidden" name="product[<?php echo $product_row; ?>][is_gift]" value="<?php echo $order_product['is_gift']; ?>" />
                        <?php foreach ($order_product['option'] as $option) { ?>
                        - <small><?php echo $option['name']; ?>: <?php echo $option['value']; ?></small><br />
                        <?php if ($option['type'] == 'select' || $option['type'] == 'radio' || $option['type'] == 'image') { ?>
                        <input type="hidden" name="product[<?php echo $product_row; ?>][option][<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['product_option_value_id']; ?>" />
                        <?php } ?>
                        <?php if ($option['type'] == 'checkbox') { ?>
                        <input type="hidden" name="product[<?php echo $product_row; ?>][option][<?php echo $option['product_option_id']; ?>][]" value="<?php echo $option['product_option_value_id']; ?>" />
                        <?php } ?>
                        <?php if ($option['type'] == 'text' || $option['type'] == 'textarea' || $option['type'] == 'file' || $option['type'] == 'date' || $option['type'] == 'datetime' || $option['type'] == 'time') { ?>
                        <input type="hidden" name="product[<?php echo $product_row; ?>][option][<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" />
                        <?php } ?>
                        <?php } ?></td>
                      <td class="text-left"><?php echo $order_product['model']; ?></td>
                      <td class="text-right"><?php echo $order_product['quantity']; ?>
                        <input type="hidden" name="product[<?php echo $product_row; ?>][quantity]" value="<?php echo $order_product['quantity']; ?>" /></td>
                      <td class="text-right"><?php echo $order_product['price']; ?>
                        <input type="hidden" name="product[<?php echo $product_row; ?>][price]" value="<?php echo $order_product['price']; ?>" /></td>
                      <td class="text-right"><?php echo $order_product['total']; ?>
                        <input type="hidden" name="product[<?php echo $product_row; ?>][total]" value="<?php echo $order_product['total']; ?>" /></td>
                      <td class="text-center" style="width: 3px;"></td>
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
					<?php foreach ($total_data as $total) { ?>
					<?php if (strpos($total['code'], 'discount') === 0) { ?>
					<tr id="gift_discount">
					  <td class="text-right" colspan="5">
					  	<i class="fa fa-minus-circle" onclick="$('#gift_discount').remove();"></i>
						<b><?php echo $total['title']; ?></b></td>
					  <td class="text-right">
						<input type="hidden" name="gift_discount" value="<?php echo $total['code']; ?>" />
					  <?php echo $total['text']; ?></td>
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
					  	<i class="fa fa-minus-circle" onclick="$('#point').remove();"></i>
						<b><?php echo $total['title']; ?></b></td>
					  <td class="text-right">
						<input type="hidden" name="point" value="<?php echo $points; ?>" />
					  <?php echo $total['text']; ?></td>
					</tr>
					<?php } else { ?>
					<tr>
					  <td class="text-right" colspan="5"><b><?php echo $total['title']; ?></b></td>
					  <td class="text-right"><?php echo $total['text']; ?></td>
					</tr>
					<?php } ?>
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
				<div class="form-group">
				  <label class="col-sm-2 control-label" for="quantity"><?php echo $entry_quantity; ?></label>
				  <div class="col-sm-10">
					<input type="text" value="1" id="quantity" class="form-control" />
				  </div>
				</div>
				<div id="option"></div>
			  </fieldset>
			  
			  
			  <fieldset id="tab-gift">
				<legend>添加赠品</legend>
				<div class="form-group">
				  <label class="col-sm-2 control-label" for="input-gift-product"><?php echo $entry_product; ?></label>
				  <div class="col-sm-10">
					<input type="text" name="product_filter" value="" id="input-product" class="form-control" />
					<input type="hidden" id="product_id" value="" />
					<input type="hidden" id="is_gift" value="0" />
					<input type="hidden" id="quantity" value="1" />
					<input type="hidden" id="discount" value="" />
				  </div>
				</div>
			  </fieldset>
			  
			  
			  <fieldset id="tab-point">
				<legend>修改积分</legend>
				<div class="form-group">
				  <label class="col-sm-2 control-label" for="input-gift-product"><?php echo $entry_reward; ?></label>
				  <div class="col-sm-10">
					<input type="text" value="" id="input-point" onfocus="$(this).attr('name', 'point');" onblur="($(this).val() == '')?$(this).attr('name', ''):'';" class="form-control" />
				  </div>
				</div>
			    <div class="text-right">
				  <button type="button" id="button-product-add" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?php echo $text_product; ?></button>
			    </div>
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
                  <input type="text" name="company" value="<?php echo $payment_company; ?>" id="input-payment-company" class="form-control" />
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-payment-address-1"><?php echo $entry_address_1; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="address_1" value="<?php echo $payment_address_1; ?>" id="input-payment-address-1" class="form-control" />
                </div>
              </div>
              <div class="form-group" style="display:none;">
                <label class="col-sm-2 control-label" for="input-payment-address-2"><?php echo $entry_address_2; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="address_2" value="<?php echo $payment_address_2; ?>" id="input-payment-address-2" class="form-control" />
                </div>
              </div>
 
              <div class="form-group required" style="display:none;">
                <label class="col-sm-2 control-label" for="input-payment-city"><?php echo $entry_city; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="city" value="<?php echo $payment_city; ?>" id="input-payment-city" class="form-control" />
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-payment-postcode"><?php echo $entry_postcode; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="postcode" value="<?php echo $payment_postcode; ?>" id="input-payment-postcode" class="form-control" />
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-payment-country"><?php echo $entry_country; ?></label>
                <div class="col-sm-10">
                  <select name="country_id" id="input-payment-country" class="form-control">
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
                  <select name="zone_id" id="input-payment-zone" class="form-control">
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
                        <option value="<?php echo $pm['code']; ?>" selected="selected"><?php echo $pm['title']; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $pm['code']; ?>"><?php echo $pm['title']; ?></option>
                        <?php } ?>
                        <?php } ?>
                      </select>
                  </div>
                </div>
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-payment-method"><?php echo $entry_payment_method; ?></label>
                  <div class="col-sm-10">
                      <select name="payment_method" id="input-payment-method" class="form-control">
                        <option value=""><?php echo $text_select; ?></option>
                        <?php foreach ($payment_methods as $pm) { ?>
                        <?php if ($payment_code == $pm['code']) { ?>
                        <option value="<?php echo $pm['code']; ?>" selected="selected"><?php echo $pm['title']; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $pm['code']; ?>"><?php echo $pm['title']; ?></option>
                        <?php } ?>
                        <?php } ?>
                      </select>
					  <input type="hidden" name="currency_code" value="<?php echo $currency_code; ?>" />
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
function getRefresh() {
	$.ajax({
		url: 'index.php?route=sale/order/api&token=<?php echo $token; ?>&api=api/cart/products&store_id=' + $('select[name=\'store_id\'] option:selected').val(),
		dataType: 'json',
		success: function(json) {
			$('.alert-danger, .text-danger').remove();
			
			// Check for errors
			if (json['error']) {
				if (json['error']['warning']) {
					$('#content > .container-fluid').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['warning'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				}
									
				if (json['error']['stock']) {
					$('#content > .container-fluid').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['stock'] + '</div>');
				}
								
				if (json['error']['minimum']) {
					for (i in json['error']['minimum']) {
						$('#content > .container-fluid').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['minimum'][i] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
					}
				}
			}
			
			html = '';
			
			if (json['products']) {
				for (i = 0; i < json['products'].length; i++) {
					product = json['products'][i];
					
					html += '<tr>';
					html += '  <td class="text-left">' + product['name'] + ' ' + (!product['stock'] ? '<span class="text-danger">***</span>' : '') + '<br />';
					html += '  <input type="hidden" name="product[' + i + '][product_id]" value="' + product['product_id'] + '" />';
					html += '  <input type="hidden" name="product[' + i + '][is_gift]" value="' + product['is_gift'] + '" />';
					
					if (product['option']) {
						for (j = 0; j < product['option'].length; j++) {
							option = product['option'][j];
							
							html += '  - <small>' + option['name'] + ': ' + option['value'] + '</small><br />';
							
							if (option['type'] == 'select' || option['type'] == 'radio' || option['type'] == 'image') {
								html += '<input type="hidden" name="product[' + i + '][option][' + option['product_option_id'] + ']" value="' + option['product_option_value_id'] + '" />';
							}
							
							if (option['type'] == 'checkbox') {
								html += '<input type="hidden" name="product[' + i + '][option][' + option['product_option_id'] + '][]" value="' + option['product_option_value_id'] + '" />';
							}
							
							if (option['type'] == 'text' || option['type'] == 'textarea' || option['type'] == 'file' || option['type'] == 'date' || option['type'] == 'datetime' || option['type'] == 'time') {
								html += '<input type="hidden" name="product[' + i + '][option][' + option['product_option_id'] + ']" value="' + option['value'] + '" />';
							}
						}
					}
					
					html += '</td>';
					html += '  <td class="text-left">' + product['model'] + '</td>';
					html += '  <td class="text-right">' + product['quantity'] + '<input type="hidden" name="product[' + i + '][quantity]" value="' + product['quantity'] + '" /></td>';
					html += '  <td class="text-right">' + product['price'] + '</td>';
					html += '  <td class="text-right">' + product['total'] + '</td>';
					html += '  <td class="text-center" style="width: 3px;"><button type="button" value="' + product['key'] + '" data-toggle="tooltip" title="<?php echo $button_remove; ?>" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
					html += '</tr>';
				}
			}
					
			if (json['vouchers']) {
				for (i in json['vouchers']) {
					voucher = json['vouchers'][i];
					
					html += '<tr>';
					html += '  <td class="text-left">' + voucher['description'];
                    html += '    <input type="hidden" name="voucher[' + i + '][code]" value="' + voucher['code'] + '" />';
					html += '    <input type="hidden" name="voucher[' + i + '][description]" value="' + voucher['description'] + '" />';
                    html += '    <input type="hidden" name="voucher[' + i + '][from_name]" value="' + voucher['from_name'] + '" />';
                    html += '    <input type="hidden" name="voucher[' + i + '][from_email]" value="' + voucher['from_email'] + '" />';
                    html += '    <input type="hidden" name="voucher[' + i + '][to_name]" value="' + voucher['to_name'] + '" />';
                    html += '    <input type="hidden" name="voucher[' + i + '][to_email]" value="' + voucher['to_email'] + '" />';
                    html += '    <input type="hidden" name="voucher[' + i + '][voucher_theme_id]" value="' + voucher['voucher_theme_id'] + '" />';
                    html += '    <input type="hidden" name="voucher[' + i + '][message]" value="' + voucher['message'] + '" />';
                    html += '    <input type="hidden" name="voucher[' + i + '][amount]" value="' + voucher['amount'] + '" />';
					html += '  </td>';
					html += '  <td class="text-left"></td>';
					html += '  <td class="text-right">1</td>';
					html += '  <td class="text-right">' + voucher['amount'] + '</td>';
					html += '  <td class="text-right">' + voucher['amount'] + '</td>';
					html += '  <td class="text-center" style="width: 3px;"><button type="button" value="' + voucher['code'] + '" data-toggle="tooltip" title="<?php echo $button_remove; ?>" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
					html += '</tr>';	
				}
			}
			
			if (json['products'] == '' && json['vouchers'] == '') {				
				html += '<tr>';
				html += '  <td colspan="6" class="text-center"><?php echo $text_no_results; ?></td>';
				html += '</tr>';	
			}

			$('#cart').html(html);

			// Totals
			html = '';
			
			if (json['totals']) {
				for (i in json['totals']) {
					total = json['totals'][i];
					
					if (total['code'].indexOf('discount') == 0) {
					html += '<tr id="gift_discount">';
					html += '  <td class="text-right" colspan="5">';
					html += '    <i class="fa fa-minus-circle" onclick="$(\'#gift_discount\').remove();"></i>';
					html += '    <b>' + total['title'] + '</b>';
					html += '  </td>';
					html += '  <td class="text-right">' + total['text'] + '<input type="hidden" name="gift_discount" value="' + total['code'] + '" /></td>';
					html += '</tr>';
					} else if (total['code'].indexOf('point') == 0) {
					html += '<tr id="point">';
					html += '  <td class="text-right" colspan="5">';
					html += '    <i class="fa fa-minus-circle" onclick="$(\'#point\').remove();"></i>';
					html += '    <b>' + total['title'] + '</b>';
					
					var start = total['title'].indexOf('(')+1;
					var end = total['title'].indexOf(')');
					var points = total['title'].substr(start, end - start);
					
					html += '  </td>';
					html += '  <td class="text-right">' + total['text'] + '<input type="hidden" name="point" value="' + points + '" /></td>';
					html += '</tr>';
					} else {
					html += '<tr>';
					html += '  <td class="text-right" colspan="5"><b>' + total['title'] + '</b></td>';
					html += '  <td class="text-right">' + total['text'] + '</td>';
					html += '</tr>';
					}
				}
			}
			
			if (!json['totals'] && !json['products'] && !json['vouchers']) {				
				html += '<tr>';
				html += '  <td colspan="5" class="text-center"><?php echo $text_no_results; ?></td>';
				html += '</tr>';	
			}
						
			$('#total').html(html);
		},	
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
}

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

// Checkout
$('#button-save').on('click', function() {
	var order_id = $('input[name=\'order_id\']').val();
	
	if (order_id == 0) {
		var url = 'index.php?route=sale/order/api&token=<?php echo $token; ?>&api=api/order/add&store_id=' + $('select[name=\'store_id\'] option:selected').val();
	} else {
		var url = 'index.php?route=sale/order/api&token=<?php echo $token; ?>&api=api/order/edit&store_id=' + $('select[name=\'store_id\'] option:selected').val() + '&order_id=' + order_id;
	}
	
	$.ajax({
		url: url,
		type: 'post',
		data: $('#form-order select, #tab-total textarea, #form-order input'),
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
						price: item['price']						
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('#tab-product input[name=\'product_filter\']').val(item['label']);
		$('#tab-product #product_id').attr('name', 'product['+product_row+'][product_id]').val(item['value']);
		$('#tab-product #is_gift').attr('name', 'product['+product_row+'][is_gift]');
		$('#tab-product #quantity').attr('name', 'product['+product_row+'][quantity]');
		
		if (item['option'] != '') {
 			html  = '<fieldset>';
            html += '  <legend><?php echo $entry_option; ?></legend>';
			  
			for (i = 0; i < item['option'].length; i++) {
				option = item['option'][i];
				
				if (option['type'] == 'select') {
					html += '<div class="form-group' + (option['required'] ? ' required' : '') + '">';
					html += '  <label class="col-sm-2 control-label" for="input-option' + option['product_option_id'] + '">' + option['name'] + '</label>';
					html += '  <div class="col-sm-10">';
					html += '    <select name="product['+product_row+'][option][' + option['product_option_id'] + ']" id="input-option' + option['product_option_id'] + '" class="form-control">';
					html += '      <option value=""><?php echo $text_select; ?></option>';
				
					for (j = 0; j < option['product_option_value'].length; j++) {
						option_value = option['product_option_value'][j];
						
						html += '<option value="' + option_value['product_option_value_id'] + '">' + option_value['name'];
						
						if (option_value['price']) {
							html += ' (' + option_value['price_prefix'] + option_value['price'] + ')';
						}
						
						html += '</option>';
					}
						
					html += '    </select>';
					html += '  </div>';
					html += '</div>';
				}
				
				if (option['type'] == 'radio') {
					html += '<div class="form-group' + (option['required'] ? ' required' : '') + '">';
					html += '  <label class="col-sm-2 control-label" for="input-option' + option['product_option_id'] + '">' + option['name'] + '</label>';
					html += '  <div class="col-sm-10">';
					html += '    <select name="product['+product_row+'][option][' + option['product_option_id'] + ']" id="input-option' + option['product_option_id'] + '" class="form-control">';
					html += '      <option value=""><?php echo $text_select; ?></option>';
				
					for (j = 0; j < option['product_option_value'].length; j++) {
						option_value = option['product_option_value'][j];
						
						html += '<option value="' + option_value['product_option_value_id'] + '">' + option_value['name'];
						
						if (option_value['price']) {
							html += ' (' + option_value['price_prefix'] + option_value['price'] + ')';
						}
						
						html += '</option>';
					}
						
					html += '    </select>';
					html += '  </div>';
					html += '</div>';
				}
					
				if (option['type'] == 'checkbox') {
					html += '<div class="form-group' + (option['required'] ? ' required' : '') + '">';
					html += '  <label class="col-sm-2 control-label">' + option['name'] + '</label>';
					html += '  <div class="col-sm-10">';
					html += '    <div id="input-option' + option['product_option_id'] + '">';
					
					for (j = 0; j < option['product_option_value'].length; j++) {
						option_value = option['product_option_value'][j];
						
						html += '<div class="checkbox">';
						
						html += '  <label><input type="checkbox" name="product['+product_row+'][option][' + option['product_option_id'] + '][]" value="' + option_value['product_option_value_id'] + '" /> ' + option_value['name'];
						
						if (option_value['price']) {
							html += ' (' + option_value['price_prefix'] + option_value['price'] + ')';
						}
						
						html += '  </label>';
						html += '</div>';
					}
										
					html += '    </div>';
					html += '  </div>';
					html += '</div>';
				}
			
				if (option['type'] == 'image') {
					html += '<div class="form-group' + (option['required'] ? ' required' : '') + '">';
					html += '  <label class="col-sm-2 control-label" for="input-option' + option['product_option_id'] + '">' + option['name'] + '</label>';
					html += '  <div class="col-sm-10">';
					html += '    <select name="product['+product_row+'][option][' + option['product_option_id'] + ']" id="input-option' + option['product_option_id'] + '" class="form-control">';
					html += '      <option value=""><?php echo $text_select; ?></option>';
				
					for (j = 0; j < option['product_option_value'].length; j++) {
						option_value = option['product_option_value'][j];
						
						html += '<option value="' + option_value['product_option_value_id'] + '">' + option_value['name'];
						
						if (option_value['price']) {
							html += ' (' + option_value['price_prefix'] + option_value['price'] + ')';
						}
						
						html += '</option>';
					}
						
					html += '    </select>';					
					html += '  </div>';
					html += '</div>';
				}
						
				if (option['type'] == 'text') {
					html += '<div class="form-group' + (option['required'] ? ' required' : '') + '">';
					html += '  <label class="col-sm-2 control-label" for="input-option' + option['product_option_id'] + '">' + option['name'] + '</label>';
					html += '  <div class="col-sm-10"><input type="text" name="product['+product_row+'][option][' + option['product_option_id'] + ']" value="' + option['value'] + '" id="input-option' + option['product_option_id'] + '" class="form-control" /></div>';
					html += '</div>';					
				}
				
				if (option['type'] == 'textarea') {
					html += '<div class="form-group' + (option['required'] ? ' required' : '') + '">';
					html += '  <label class="col-sm-2 control-label" for="input-option' + option['product_option_id'] + '">' + option['name'] + '</label>';
					html += '  <div class="col-sm-10"><textarea name="product['+product_row+'][option][' + option['product_option_id'] + ']" rows="5" id="input-option' + option['product_option_id'] + '" class="form-control">' + option['value'] + '</textarea></div>';
					html += '</div>';
				}
				
				if (option['type'] == 'file') {
					html += '<div class="form-group' + (option['required'] ? ' required' : '') + '">';
					html += '  <label class="col-sm-2 control-label">' + option['name'] + '</label>';
					html += '  <div class="col-sm-10">';
					html += '    <button type="button" id="button-upload' + option['product_option_id'] + '" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-default"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>';
					html += '    <input type="hidden" name="product['+product_row+'][option][' + option['product_option_id'] + ']" value="' + option['value'] + '" id="input-option' + option['product_option_id'] + '" />';
					html += '  </div>';
					html += '</div>';
				}
				
				if (option['type'] == 'date') {
					html += '<div class="form-group' + (option['required'] ? ' required' : '') + '">';
					html += '  <label class="col-sm-2 control-label" for="input-option' + option['product_option_id'] + '">' + option['name'] + '</label>';
					html += '  <div class="col-sm-3"><div class="input-group date"><input type="text" name="product['+product_row+'][option][' + option['product_option_id'] + ']" value="' + option['value'] + '" placeholder="' + option['name'] + '" data-date-format="YYYY-MM-DD" id="input-option' + option['product_option_id'] + '" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></div>';
					html += '</div>';
				}
				
				if (option['type'] == 'datetime') {
					html += '<div class="form-group' + (option['required'] ? ' required' : '') + '">';
					html += '  <label class="col-sm-2 control-label" for="input-option' + option['product_option_id'] + '">' + option['name'] + '</label>';
					html += '  <div class="col-sm-3"><div class="input-group datetime"><input type="text" name="product['+product_row+'][option][' + option['product_option_id'] + ']" value="' + option['value'] + '" placeholder="' + option['name'] + '" data-date-format="YYYY-MM-DD HH:mm" id="input-option' + option['product_option_id'] + '" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></div>';
					html += '</div>';					
				}
				
				if (option['type'] == 'time') {
					html += '<div class="form-group' + (option['required'] ? ' required' : '') + '">';
					html += '  <label class="col-sm-2 control-label" for="input-option' + option['product_option_id'] + '">' + option['name'] + '</label>';
					html += '  <div class="col-sm-3"><div class="input-group time"><input type="text" name="product['+product_row+'][option][' + option['product_option_id'] + ']" value="' + option['value'] + '" placeholder="' + option['name'] + '" data-date-format="HH:mm" id="input-option' + option['product_option_id'] + '" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></div>';
					html += '</div>';					
				}
			}
			
			html += '</fieldset>';
			
			$('#option').html(html);
			
			$('.date').datetimepicker({
				pickTime: false
			});
			
			$('.datetime').datetimepicker({
				pickDate: true,
				pickTime: true
			});
			
			$('.time').datetimepicker({
				pickDate: false
			});
		} else {
			$('#option').html('');
		}
		
		product_row++;
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

$('#button-product-add').on('click', function() {
	$.ajax({
		url: 'index.php?route=sale/order/api&token=<?php echo $token; ?>&api=api/cart/add&store_id=' + $('select[name=\'store_id\'] option:selected').val(),
		type: 'post',
		data: $('#form-order select, #tab-total textarea, #form-order input'),
		dataType: 'json',
		beforeSend: function() {
			$('#button-product-add').button('loading');
		},
		complete: function() {
			$('#button-product-add').button('reset');
		},
		success: function(json) {
			$('.alert, .text-danger').remove();
			$('.form-group').removeClass('has-error');
		
			if (json['error']) {
				if (json['error']['warning']) {
					$('#content > .container-fluid').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['warning'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				}
				
				if (json['error']['option']) {	
					for (i in json['error']['option']) {
						var element = $('#input-option' + i.replace('_', '-'));
						
						if (element.parent().hasClass('input-group')) {
							$(element).parent().after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
						} else {
							$(element).after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
						}
					}
				}
				
				if (json['error']['store']) {
					$('#content > .container-fluid').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['store'] + '</div>');
				}

				// Highlight any found errors
				$('.text-danger').parentsUntil('.form-group').parent().addClass('has-error');				
			} else {
				// Refresh products, vouchers and totals
				getRefresh();
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
	
	$('#tab-product input[name=\'product_filter\']').val('');
	$('#tab-product #product_id').attr('name', '').val('');
	$('#tab-product #is_gift').attr('name', '');
	$('#tab-product #quantity').attr('name', '').val('1');
	$('#tab-gift input[name=\'product_filter\']').val('');
	$('#tab-gift #product_id').attr('name', '').val('');
	$('#tab-gift #is_gift').attr('name', '');
	$('#tab-gift #quantity').attr('name', '');
	$('#tab-gift #discount').attr('name', '').val('');
	$('#tab-point #input-point').attr('name', '').val('');
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
					
			$('#tab-payment input[name=\'firstname\']').val(json['firstname']);
			$('#tab-payment input[name=\'lastname\']').val(json['lastname']);
			//$('#tab-payment input[name=\'company\']').val(json['company']);
			$('#tab-payment input[name=\'address_1\']').val(json['address_1']);
			$('#tab-payment input[name=\'address_2\']').val(json['address_2']);
			$('#tab-payment input[name=\'city\']').val(json['city']);
			$('#tab-payment input[name=\'postcode\']').val(json['postcode']);
			
			if (json['country_id']) {
				$('#tab-payment select[name=\'country_id\']').val(json['country_id']);
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
			
			$('#tab-payment select[name=\'country_id\']').trigger('change');
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});	
});

var payment_zone_id = '<?php echo $payment_zone_id; ?>';

$('#tab-payment select[name=\'country_id\']').on('change', function() {
	$.ajax({
		url: 'index.php?route=sale/order/country&token=<?php echo $token; ?>&country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('#tab-payment select[name=\'country_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
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
			
			$('#tab-payment select[name=\'zone_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('#tab-payment select[name=\'country_id\']').trigger('change');

$('#cart').delegate('.btn-danger', 'click', function() {
	var node = this;
	
	$.ajax({
		url: 'index.php?route=sale/order/api&token=<?php echo $token; ?>&api=api/cart/remove&store_id=' + $('select[name=\'store_id\'] option:selected').val(),
		type: 'post',
		data: 'key=' + encodeURIComponent(this.value),
		dataType: 'json',
		beforeSend: function() {
			$(node).button('loading');
		},
		complete: function() {
			$(node).button('reset');
		},
		success: function(json) {
			$('.alert, .text-danger').remove();
		
			// Check for errors
			if (json['error']) {
				$('#content > .container-fluid').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
			} else {
				// Refresh products, vouchers and totals
				$(node).parent().parent().remove();
				$('#button-product-add').trigger('click');
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});				
});
//--></script></div>
<?php echo $footer; ?>