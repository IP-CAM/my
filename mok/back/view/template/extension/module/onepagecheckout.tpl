<?php echo $header; ?>
<link type="text/css" href="view/stylesheet/onepagecheckout.css" rel="stylesheet" media="screen" />
<?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
		<button type="submit" form="form-onepagecheckout" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-success1"><i class="fa fa-save"></i> Save & Stay</button>
		<a href="<?php echo $restoresetting; ?>" class="btn btn-success">Restore Default Setting</a>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
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
		<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-OnePageCheackout" class="form-horizontal">
          
    <div class="panel panel-default" id="onepagecheackout">
      <div class="panel-heading clearfix">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
				<div class="pull-right">
					<b>Stores : </b><select onchange="location = this.options[this.selectedIndex].value;" name="store_id">
					<option value="<?php echo $store_action.'&store_id=0'; ?>"><?php echo $text_default; ?></option>
					<?php foreach($stores as $store){ 
						if($store['store_id']==$store_id){
							 $select = 'selected=selected';
						}else{
							 $select = '';
						}
					?>
					<option <?php echo $select; ?> value="<?php echo $store_action .'&store_id='. $store['store_id']; ?>"><?php echo $store['name']; ?></option>
					<?php } ?>
					</select>
				</div>
      </div>
      <div class="panel-body">
					<ul class="nav nav-tabs">
						<li class="active"><a data-target="#tab-general" data-toggle="tab"><i class="fa fa-cog"></i> <?php echo $entry_general; ?></a></li>
						<li class="dropdown"><a href="#" data-toggle="dropdown"><i class="fa fa-eye"></i> Layout Setting <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="#tab-layout" data-toggle="tab"><i class="fa fa-eye"></i> Layout Setting</a></li>
								<li><a href="#tab-shopping-cart-setting" data-toggle="tab"><i class="fa fa-shopping-cart"></i> <?php echo $entry_shopping_cart; ?></a></li>
								<li><a href="#tab-delivery_method-setting" data-toggle="tab"><i class="fa fa-truck" aria-hidden="true"></i> <?php echo $entry_delivery_method; ?></a></li>
								<li><a href="#tab-payment_method-setting" data-toggle="tab"><i class="fa fa-credit-card" aria-hidden="true"></i> <?php echo $entry_payment_method; ?></a></li>
								<li><a href="#tab-confirm_order-setting" data-toggle="tab"><i class="fa fa-cart-plus" aria-hidden="true"></i> <?php echo $entry_confirm_order; ?></a></li>
							</ul>
						</li>
						<li class="dropdown"><a href="#" data-toggle="dropdown"><i class="fa fa-cog"></i> <?php echo $field_manage; ?> <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="#tab-personaldetails-setting" data-toggle="tab"><i class="fa fa-cogs"></i> <?php echo $entry_personaldetails; ?></a></li>
								<li><a href="#tab-payment-setting" data-toggle="tab"><i class="fa fa-cogs"></i> <?php echo $entry_paymentdetails; ?></a></li>
								<li><a href="#tab-delivery-setting" data-toggle="tab"><i class="fa fa-cogs"></i> <?php echo $entry_delivery_setting; ?></a></li>
								<li><a target="_new" href="<?php echo $customfeilds; ?>"><i class="fa fa-cogs"></i> OpenCart Custom Feilds Settings</a></li>
							</ul>
						</li>
						<li class="dropdown"><a href="#" data-toggle="dropdown"><i class="fa fa-language"></i> <?php echo $entry_language; ?> <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="#tab-general-language-setting" data-toggle="tab"><i class="fa fa-language"></i> <?php echo $entry_general; ?></a></li>
								<li><a href="#tab-personaldetails-language-setting" data-toggle="tab"><i class="fa fa-language"></i> <?php echo $entry_personaldetails; ?></a></li>
								<li><a href="#tab-paymentdetails-language-setting" data-toggle="tab"><i class="fa fa-language"></i> <?php echo $entry_paymentdetails; ?></a></li>
								<li><a href="#tab-delivery_detail-language-setting" data-toggle="tab"><i class="fa fa-language"></i> <?php echo $entry_delivery_setting; ?></a></li>
								<li><a href="#tab-login-language-setting" data-toggle="tab"><i class="fa fa-language"></i> <?php echo $entry_login; ?></a></li>
								<li><a href="#tab-delivery_method-language-setting" data-toggle="tab"><i class="fa fa-language"></i> <?php echo $entry_delivery_method; ?></a></li>
								<li><a href="#tab-payment_method-language-setting" data-toggle="tab"><i class="fa fa-language"></i> <?php echo $entry_payment_method; ?></a></li>
								<li><a href="#tab-shopping-cart-language-setting" data-toggle="tab"><i class="fa fa-language"></i> <?php echo $entry_shopping_cart; ?></a></li>
								<li><a href="#tab-confirm_order-language-setting" data-toggle="tab"><i class="fa fa-language"></i> <?php echo $entry_confirm_order; ?></a></li>
							</ul>
						</li>
						<li><a href="#tab-analytics" data-toggle="tab"><i class="fa fa-line-chart"></i> Analytics</a></li>
						<li><a href="#tab-support" data-toggle="tab"><i class="fa fa-user"></i> Support</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane" id="tab-analytics">
						   <?php foreach ($rows as $row) { ?>

									<div class="row">

									  <?php foreach ($row as $dashboard_1) { ?>

									  <?php $class = 'col-lg-' . $dashboard_1['width'] . ' col-md-3 col-sm-6'; ?>

									  <?php foreach ($row as $dashboard_2) { ?>

									  <?php if ($dashboard_2['width'] > 3) { ?>

									  <?php $class = 'col-lg-' . $dashboard_1['width'] . ' col-md-12 col-sm-12'; ?>

									  <?php } ?>

									  <?php } ?>

									  <div class="<?php echo $class; ?>"><?php echo $dashboard_1['output']; ?></div>

									  <?php } ?>

									</div>

								<?php } ?>
						</div>
						<div class="tab-pane" id="tab-layout">
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-status"><span  data-toggle="tooltip" title="<?php echo $help_register_account; ?> "><?php echo $entry_register_account ; ?></span></label>
								<div class="col-sm-10">
									<div class="btn-group" data-toggle="buttons">
										<?php 
										if(!isset($onepagecheckout_manage['personaldetails']['register_status'])) { 
											$onepagecheckout_manage['personaldetails']['register_status'] = '1';
										}
										?>
										<label class="btn btn-success btn-sm button-account-type <?php echo (!empty($onepagecheckout_manage['personaldetails']['register_status'])) ? 'active' : ''; ?>">	
											<input type="radio"  name="onepagecheckout_manage[personaldetails][register_status]" <?php echo (!empty($onepagecheckout_manage['personaldetails']['register_status'])) ? 'checked="checked"' : ''; ?> value="1" autocomplete="off"><?php echo $text_yes; ?>
										</label>											
										<label class="btn btn-success btn-sm button-account-type <?php echo (empty($onepagecheckout_manage['personaldetails']['register_status'])) ? 'active' : ''; ?>">
											<input type="radio" name="onepagecheckout_manage[personaldetails][register_status]" <?php echo (empty($onepagecheckout_manage['personaldetails']['register_status'])) ? 'checked="checked"' : ''; ?> value="0" autocomplete="off"><?php echo $text_no; ?>
										</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-status"><span  data-toggle="tooltip" title="<?php echo $help_guest_checkout; ?> "><?php echo $entry_guest_checkout ; ?></span></label>
								<div class="col-sm-10">
									<div class="btn-group" data-toggle="buttons">
										<?php 
										if(!isset($onepagecheckout_manage['personaldetails']['guest_status'])) { 
											$onepagecheckout_manage['personaldetails']['guest_status'] = '1';
										}
										?>
										<label class="btn btn-success btn-sm  <?php echo (!empty($onepagecheckout_manage['personaldetails']['guest_status'])) ? 'active' : ''; ?>">	
											<input type="radio"  name="onepagecheckout_manage[personaldetails][guest_status]" <?php echo (!empty($onepagecheckout_manage['personaldetails']['guest_status'])) ? 'checked="checked"' : ''; ?> value="1" autocomplete="off"><?php echo $text_yes; ?>
										</label>											
										<label class="btn btn-success btn-sm <?php echo (empty($onepagecheckout_manage['personaldetails']['guest_status'])) ? 'active' : ''; ?>">
											<input type="radio" name="onepagecheckout_manage[personaldetails][guest_status]" <?php echo (empty($onepagecheckout_manage['personaldetails']['guest_status'])) ? 'checked="checked"' : ''; ?> value="0" autocomplete="off"><?php echo $text_no; ?>
										</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-status"><span  data-toggle="tooltip" title="<?php echo $help_enable_login; ?> "><?php echo $entry_enable_login; ?></span></label>
								<div class="col-sm-10">
								<?php 
									if(!isset($onepagecheckout_manage['login']['enable_login'])){ 
											$onepagecheckout_manage['login']['enable_login'] = '1';
										}	?>
									<div class="btn-group" data-toggle="buttons">
										<label class="btn btn-success btn-sm  <?php if(isset($onepagecheckout_manage['login']['enable_login']) && $onepagecheckout_manage['login']['enable_login']=='1'){ ?> active <?php } ?>" >	
											<input type="radio"  name="onepagecheckout_manage[login][enable_login]" <?php if(isset($onepagecheckout_manage['login']['enable_login']) && $onepagecheckout_manage['login']['enable_login']=='1'){ ?> checked="checked" <?php } ?> value="1" autocomplete="off"><?php echo $text_yes; ?>
										</label>
										
										<label class="btn btn-success btn-sm  <?php if(!isset($onepagecheckout_manage['login']['enable_login']) || $onepagecheckout_manage['login']['enable_login']=='0'){ ?> active <?php } ?>">
											<input type="radio"  name="onepagecheckout_manage[login][enable_login]" <?php if(!isset($onepagecheckout_manage['login']['enable_login']) || $onepagecheckout_manage['login']['enable_login']=='0'){ ?> checked="checked" <?php } ?> value="0" autocomplete="off"><?php echo $text_no; ?>
										</label>
									</div>
								</div>
							</div>
							<div class="form-group">	
								<label class="col-sm-2 control-label" for="input-account_open"><span data-toggle="tooltip" title="" data-original-title="Default select section"><?php echo $entry_account_open; ?></span></label>
								<div class="col-sm-3">
									<div class="btn-group btn-group-justified" data-toggle="buttons">	
										<?php if(!isset($onepagecheckout_manage['general']['account_open'])) {
												$onepagecheckout_manage['general']['account_open'] = 'register';
											} 
										?>
										<label class="btn btn-success btn-sm <?php if(isset($onepagecheckout_manage['general']['account_open']) && $onepagecheckout_manage['general']['account_open']=='register') { ?> active <?php } ?>">
										<input type="radio" name="onepagecheckout_manage[general][account_open]" <?php if(isset($onepagecheckout_manage['general']['account_open']) && $onepagecheckout_manage['general']['account_open']=='register') { ?> checked="checked" <?php } ?> value="register" autocomplete="off" /><?php echo $entry_register; ?>
										</label>
										<label class="btn btn-success btn-sm <?php if(isset($onepagecheckout_manage['general']['account_open']) && $onepagecheckout_manage['general']['account_open']=='guest') { ?> active <?php } ?>">
										<input type="radio" name="onepagecheckout_manage[general][account_open]" <?php if(isset($onepagecheckout_manage['general']['account_open']) && $onepagecheckout_manage['general']['account_open']=='guest') { ?> checked="checked" <?php } ?> value="guest" autocomplete="off" /><?php echo $entry_guest; ?>
										</label>
										<label class="btn btn-success btn-sm <?php if(isset($onepagecheckout_manage['general']['account_open']) && $onepagecheckout_manage['general']['account_open']=='login') { ?> active <?php } ?>">
										<input type="radio" name="onepagecheckout_manage[general][account_open]" <?php if(isset($onepagecheckout_manage['general']['account_open']) && $onepagecheckout_manage['general']['account_open']=='login') { ?> checked="checked" <?php } ?> value="login" autocomplete="off" /><?php echo $entry_login; ?>
										</label>		
									</div>	 
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="Set the Field Layout. Row = the labels will be on one line with the input. Block style = the labels will be above the inputs.">Field Layout</span></label>
								<div class="col-sm-3">
									<div class="btn-group" data-toggle="buttons">
											<label class="btn btn-success btn-sm <?php if(!empty($onepagecheckout_field_layout)){ ?> active <?php } ?>">	
												<input type="radio"  name="onepagecheckout_field_layout" <?php if(!empty($onepagecheckout_field_layout)){ ?> checked="checked" <?php } ?> value="1" autocomplete="off"><?php echo $text_row; ?>
											</label>
											<label class="btn btn-success btn-sm <?php if(empty($onepagecheckout_field_layout)){ ?> active <?php } ?>">
												<input type="radio"  name="onepagecheckout_field_layout" <?php if(empty($onepagecheckout_field_layout)){ ?> checked="checked" <?php } ?> value="0" autocomplete="off"><?php echo $text_block; ?>
											</label>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane active" id="tab-general">
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-status"><span data-toggle="tooltip" title="" data-original-title="Checkout status"><?php echo $entry_status; ?></span></label>
								<div class="col-sm-3">
									<select name="onepagecheckout_status" id="input-status" class="form-control">
										<?php if ($onepagecheckout_status) { ?>
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
								<label class="col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="Confirm Order auto trigger">Auto Trigger</span></label>
								<div class="col-sm-3">
									<div class="btn-group" data-toggle="buttons">
											<label class="btn btn-success btn-sm <?php if(!empty($onepagecheckout_autotrigger)){ ?> active <?php } ?>">	
												<input type="radio"  name="onepagecheckout_autotrigger" <?php if(!empty($onepagecheckout_autotrigger)){ ?> checked="checked" <?php } ?> value="1" autocomplete="off"><?php echo $text_yes; ?>
											</label>
											<label class="btn btn-success btn-sm <?php if(empty($onepagecheckout_autotrigger)){ ?> active <?php } ?>">
												<input type="radio"  name="onepagecheckout_autotrigger" <?php if(empty($onepagecheckout_autotrigger)){ ?> checked="checked" <?php } ?> value="0" autocomplete="off"><?php echo $text_no; ?>
											</label>
									</div>
								</div>
							</div>
							<div class="form-group">
                <label class="col-sm-2 control-label" for="input-country"><span data-toggle="tooltip" title="" data-original-title="Set Default Country"><?php echo $entry_country; ?></span></label>
                <div class="col-sm-3">
                  <select name="onepagecheckout_country_id" id="input-country" class="form-control">
                    <?php foreach ($countries as $country) { ?>
                    <?php if ($country['country_id'] == $onepagecheckout_country_id) { ?>
                    <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-zone"><span data-toggle="tooltip" title="" data-original-title="Set Default zone"><?php echo $entry_zone; ?></span></label>
                <div class="col-sm-3">
                  <select name="onepagecheckout_zone_id" id="input-zone" class="form-control">
                  </select>
                </div>
              </div>
							<div class="form-group">
                  <label class="col-sm-2 control-label" for="input-customer-group"><span data-toggle="tooltip" title="<?php echo $help_customer_group; ?>"><?php echo $entry_customer_group; ?></span></label>
                  <div class="col-sm-3">
                    <select name="onepagecheckout_customer_group_id" id="input-customer-group" class="form-control">
                      <?php foreach ($customer_groups as $customer_group) { ?>
                      <?php if ($customer_group['customer_group_id'] == $onepagecheckout_customer_group_id) { ?>
                      <option value="<?php echo $customer_group['customer_group_id']; ?>" selected="selected"><?php echo $customer_group['name']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
               </div>
						</div>
						<div class="tab-pane" id="tab-delivery_method-setting">
							<fieldset>
								<legend><?php echo $entry_delivery_method; ?></legend>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="input-customer-group"><span data-toggle="tooltip" title="Default selected Shipping Method"><?php echo $entry_delivery_method; ?></span></label>
									<div class="col-md-5">
										<select class="form-control" name="onepagecheckout_default_shipping">
										<?php foreach($delivery_methods as $delivery_method){
											if($delivery_method['code']==$onepagecheckout_default_shipping){
												$select ="selected=selected";
											}else{
												$select ='';
											}	
										?>
										  <option <?php echo $select; ?> value="<?php  echo $delivery_method['code']; ?>"><?php echo $delivery_method['title']; ?></option>
										<?php } ?>
										</select>
									</div>
								</div>
								<?php if($delivery_methods){ ?> 
								<table class="table table-bordered">
									<thead>
										<tr>
											<th class="text-left"><?php echo $entry_delivery_method; ?></th>
											<th class="text-center"><?php echo $entry_image; ?></th>
											<th class="text-right"><?php echo $entry_status; ?></th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($delivery_methods as $delivery_method){ ?>
										<tr>
											<td class="text-left"><?php echo $delivery_method['title']; ?></td>
											<td class="text-center">
												<div class="col-sm-12"><a href="" id="thumb-logo<?php echo $delivery_method['code']; ?>" data-toggle="image" class="img-thumbnail"><img src="<?php echo $delivery_method['thumb']; ?> " alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
													<input type="hidden" name="onepagecheckout_manage[delivery_method][<?php echo $delivery_method['code']; ?>][image]" value="<?php echo isset($onepagecheckout_manage['delivery_method'][$delivery_method['code']]['image']) ? $onepagecheckout_manage['delivery_method'][$delivery_method['code']]['image'] : ''; ?>" id="input-logo<?php echo $delivery_method['code']; ?>" />
												</div>
											</td>
											<td class="text-right">
												<div class="col-md-12">
													<div class="form-group">
														<div class="btn-group" data-toggle="buttons">
															<?php if(!isset($onepagecheckout_manage['delivery_method'][$delivery_method['code']]['status'])) {
																	$onepagecheckout_manage['delivery_method'][$delivery_method['code']]['status'] = 'register';
																} 
															?>
															<label class="btn btn-success btn-sm <?php if(!empty($onepagecheckout_manage['delivery_method'][$delivery_method['code']]['status'])) { ?> active <?php } ?>">	
																<input type="radio"  name="onepagecheckout_manage[delivery_method][<?php echo $delivery_method['code']; ?>][status]" <?php if(!empty($onepagecheckout_manage['delivery_method'][$delivery_method['code']]['status'])) { ?> checked="checked" <?php } ?> value="1" autocomplete="off"><?php echo $text_yes; ?>
															</label>
															<label class="btn btn-success btn-sm <?php if(empty($onepagecheckout_manage['delivery_method'][$delivery_method['code']]['status'])) { ?> active <?php } ?>">
																<input type="radio"  name="onepagecheckout_manage[delivery_method][<?php echo $delivery_method['code']; ?>][status]" <?php if(empty($onepagecheckout_manage['delivery_method'][$delivery_method['code']]['status'])) { ?> checked="checked" <?php } ?> value="0" autocomplete="off"><?php echo $text_no; ?>
															</label>
														</div>
													</div>
												</div>
											</td>
										</tr>	
									<?php } ?>
									</tbody>
								</table>
								<?php } ?>
							</fieldset>
						</div>
						<div class="tab-pane" id="tab-payment_method-setting">
								<fieldset>
									<legend><?php echo $entry_payment_method; ?></legend>
									<div class="form-group">
									<label class="col-sm-2 control-label" for="input-customer-group"><span data-toggle="tooltip" title="Default selected Payment Method"><?php echo $entry_payment_method; ?></span></label>
										<div class="col-md-5">
											<select class="form-control" name="onepagecheckout_default_payment">
											<?php foreach($payment_methods as $payment_method){
												if($payment_method['code']==$onepagecheckout_default_payment){
													$select ="selected=selected";
												}else{
													$select ='';
												}	
											?>
											  <option <?php echo $select; ?> value="<?php  echo $payment_method['code']; ?>"><?php echo $payment_method['title']; ?></option>
											<?php } ?>
											</select>
										</div>
									</div>
									<?php if($payment_methods) { ?>
									<table class="table table-bordered">
										<thead>
											<tr>
												<th class="text-left"><?php echo $entry_payment_method; ?></th>
												<th class="text-center"><?php echo $entry_image; ?></th>
												<th class="text-right"><?php echo $entry_status; ?></th>
											</tr>
										</thead>
										<tbody>
										<?php foreach($payment_methods as $payment_method){ ?>
										<tr>
											<td class="text-left"><?php echo $payment_method['title']; ?></td>
											<td class="text-center">
												<div class="col-sm-12"><a href="" id="thumb-logo<?php echo $payment_method['code']; ?>" data-toggle="image" class="img-thumbnail"><img src="<?php echo $payment_method['thumb']; ?> " alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
													<input type="hidden" name="onepagecheckout_manage[payment_method][<?php echo $payment_method['code']; ?>][image]" value="<?php echo isset($onepagecheckout_manage['payment_method'][$payment_method['code']]['image']) ? $onepagecheckout_manage['payment_method'][$payment_method['code']]['image'] : ''; ?>" id="input-logo<?php echo $payment_method['code']; ?>" />
												</div>
											</td>
											<td class="text-right">
												<div class="col-md-12">
													<div class="form-group">
													<?php 
													if(!isset($onepagecheckout_manage['payment_method'][$payment_method['code']]['status'])) { 
															$onepagecheckout_manage['payment_method'][$payment_method['code']]['status'] = '1';
														}	?>
														<div class="btn-group" data-toggle="buttons">
															<label class="btn btn-success btn-sm  <?php if(isset($onepagecheckout_manage['payment_method'][$payment_method['code']]['status']) && $onepagecheckout_manage['payment_method'][$payment_method['code']]['status']=='1'){ ?> active <?php } ?>" >	
																<input type="radio"  name="onepagecheckout_manage[payment_method][<?php echo $payment_method['code']; ?>][status]" <?php if(isset($onepagecheckout_manage['payment_method'][$payment_method['code']]['status']) && $onepagecheckout_manage['payment_method'][$payment_method['code']]['status']=='1'){ ?> checked="checked" <?php } ?> value="1" autocomplete="off"><?php echo $text_yes; ?>
															</label>
															
															<label class="btn btn-success btn-sm  <?php if(!isset($onepagecheckout_manage['payment_method'][$payment_method['code']]['status']) || $onepagecheckout_manage['payment_method'][$payment_method['code']]['status']=='0'){ ?> active <?php } ?>">
																<input type="radio"  name="onepagecheckout_manage[payment_method][<?php echo $payment_method['code']; ?>][status]" <?php if(!isset($onepagecheckout_manage['payment_method'][$payment_method['code']]['status']) ){ ?> checked="checked" <?php } ?> value="0" autocomplete="off"><?php echo $text_no; ?>
															</label>
														</div>
													</div>
												</div>
											</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
								<?php } ?>
							</fieldset>
						</div>
						<div class="tab-pane" id="tab-confirm_order-setting">
							<fieldset>
								<legend><?php echo $entry_confirm_order; ?></legend>
								<div class="form-group">	
									<label class="col-sm-2 control-label " for="input-terms"><?php echo $entry_agree; ?></label>
									<div class="col-sm-3">
										<select name="onepagecheckout_manage[confirm_order][terms]" class="form-control">
											<option value="0"><?php echo $text_none; ?></option>
											<?php foreach ($informations as $information) { ?>
											<?php if ($information['information_id'] == $onepagecheckout_manage['confirm_order']['terms']) { ?>
											<option value="<?php echo $information['information_id']; ?>" selected="selected"><?php echo $information['title']; ?></option>
											<?php } else { ?>
											<option value="<?php echo $information['information_id']; ?>"><?php echo $information['title']; ?></option>
											<?php } ?>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="input-status"><?php echo $entry_comment_status; ?></label>
									<div class="col-sm-10">
										<div class="btn-group" data-toggle="buttons">
											<?php 
											if(!isset($onepagecheckout_manage['confirm_order']['comment_status'])) { 
												$onepagecheckout_manage['confirm_order']['comment_status'] = '1';
											}
											?>
											<label class="btn btn-success btn-sm  <?php if(!empty($onepagecheckout_manage['confirm_order']['comment_status'])) { ?> active <?php } ?>" >	
												<input type="radio"  name="onepagecheckout_manage[confirm_order][comment_status]" <?php if(!empty($onepagecheckout_manage['confirm_order']['comment_status'])) { ?> checked="checked" <?php } ?> value="1" autocomplete="off"><?php echo $text_yes; ?>
											</label>										
											<label class="btn btn-success btn-sm  <?php if(empty($onepagecheckout_manage['confirm_order']['comment_status']) || $onepagecheckout_manage['confirm_order']['comment_status'] =='0'){ ?> active <?php } ?>">
												<input type="radio"  name="onepagecheckout_manage[confirm_order][comment_status]" <?php if(!isset($onepagecheckout_manage['confirm_order']['comment_status']) || $onepagecheckout_manage['confirm_order']['comment_status']=='0'){ ?> checked="checked" <?php } ?> value="0" autocomplete="off"><?php echo $text_no; ?>
											</label>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="input-status"><?php echo $entry_require_comment_status; ?></label>
									<div class="col-sm-10">
										<div class="btn-group" data-toggle="buttons">
											<?php 
											if(!isset($onepagecheckout_manage['confirm_order']['require_comment_status'])) { 
												$onepagecheckout_manage['confirm_order']['require_comment_status'] = '1';
											}
											?>
											<label class="btn btn-success btn-sm  <?php if(!empty($onepagecheckout_manage['confirm_order']['require_comment_status'])) { ?> active <?php } ?>" >	
												<input type="radio"  name="onepagecheckout_manage[confirm_order][require_comment_status]" <?php if(!empty($onepagecheckout_manage['confirm_order']['require_comment_status'])) { ?> checked="checked" <?php } ?> value="1" autocomplete="off"><?php echo $text_yes; ?>
											</label>										
											<label class="btn btn-success btn-sm  <?php if(empty($onepagecheckout_manage['confirm_order']['require_comment_status']) || $onepagecheckout_manage['confirm_order']['require_comment_status'] =='0'){ ?> active <?php } ?>">
												<input type="radio"  name="onepagecheckout_manage[confirm_order][require_comment_status]" <?php if(!isset($onepagecheckout_manage['confirm_order']['require_comment_status']) || $onepagecheckout_manage['confirm_order']['require_comment_status']=='0'){ ?> checked="checked" <?php } ?> value="0" autocomplete="off"><?php echo $text_no; ?>
											</label>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="input-shopping-button"><?php echo $entry_shopping_button; ?></label>
									<div class="col-sm-10">
										<?php 
										if(!isset($onepagecheckout_manage['confirm_order']['shopping_button_status'])) { 
												$onepagecheckout_manage['confirm_order']['shopping_button_status'] = '1';
											} ?>
										<div class="btn-group" data-toggle="buttons">
											<label class="btn btn-success btn-sm <?php if(!empty($onepagecheckout_manage['confirm_order']['shopping_button_status'])) { ?> active <?php } ?>" >	
												<input type="radio"  name="onepagecheckout_manage[confirm_order][shopping_button_status]" <?php if(!empty($onepagecheckout_manage['confirm_order']['shopping_button_status'])) { ?> checked="checked" <?php } ?> value="1" autocomplete="off"><?php echo $text_yes; ?>
											</label>										
											<label class="btn btn-success btn-sm  <?php if(empty($onepagecheckout_manage['confirm_order']['shopping_button_status']) || $onepagecheckout_manage['confirm_order']['shopping_button_status'] =='0'){ ?> active <?php } ?>">
												<input type="radio"  name="onepagecheckout_manage[confirm_order][shopping_button_status]" <?php if(!isset($onepagecheckout_manage['confirm_order']['shopping_button_status']) || $onepagecheckout_manage['confirm_order']['shopping_button_status']=='0'){ ?> checked="checked" <?php } ?> value="0" autocomplete="off"><?php echo $text_no; ?>
											</label>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="input-confirm-button"><?php echo $entry_confirm_button; ?></label>
									<div class="col-sm-10">
										<?php 
										if(!isset($onepagecheckout_manage['confirm_order']['confirm_button_status'])) { 
												$onepagecheckout_manage['confirm_order']['confirm_button_status'] = '1';
											} ?>
										<div class="btn-group" data-toggle="buttons">
											<label class="btn btn-success btn-sm <?php if(!empty($onepagecheckout_manage['confirm_order']['confirm_button_status'])) { ?> active <?php } ?>" >	
												<input type="radio"  name="onepagecheckout_manage[confirm_order][confirm_button_status]" <?php if(!empty($onepagecheckout_manage['confirm_order']['confirm_button_status'])) { ?> checked="checked" <?php } ?> value="1" autocomplete="off"><?php echo $text_yes; ?>
											</label>										
											<label class="btn btn-success btn-sm  <?php if(!isset($onepagecheckout_manage['confirm_order']['confirm_button_status']) || $onepagecheckout_manage['confirm_order']['confirm_button_status'] =='0'){ ?> active <?php } ?>">
												<input type="radio"  name="onepagecheckout_manage[confirm_order][confirm_button_status]" <?php if(empty($onepagecheckout_manage['confirm_order']['confirm_button_status']) || $onepagecheckout_manage['confirm_order']['confirm_button_status']=='0'){ ?> checked="checked" <?php } ?> value="0" autocomplete="off"><?php echo $text_no; ?>
											</label>
										</div>
									</div>
								</div>
							</fieldset>
						</div>
						<div class="tab-pane" id="tab-shopping-cart-setting">
							<fieldset>
								<legend><?php echo $entry_shopping_cart; ?></legend>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="input-status"><span  data-toggle="tooltip" title="<?php echo $entry_shopping_cart_order ; ?>" ><?php echo $entry_status; ?></span></label>
									<div class="col-sm-10">
										<?php 
										if(!isset($onepagecheckout_manage['shopping_cart']['shopping_cart_status'])) { 
												$onepagecheckout_manage['shopping_cart']['shopping_cart_status'] = '1';
											} ?>
										<div class="btn-group" data-toggle="buttons">
											<label class="btn btn-success btn-sm  <?php if(isset($onepagecheckout_manage['shopping_cart']['shopping_cart_status']) && $onepagecheckout_manage['shopping_cart']['shopping_cart_status']=='1'){ ?> active <?php } ?>" >	
												<input type="radio"  name="onepagecheckout_manage[shopping_cart][shopping_cart_status]" <?php if(!empty($onepagecheckout_manage['shopping_cart']['shopping_cart_status']) && $onepagecheckout_manage['shopping_cart']['shopping_cart_status']=='1'){ ?> checked="checked" <?php } ?> value="1" autocomplete="off"><?php echo $text_yes; ?>
											</label>
											
											<label class="btn btn-success btn-sm  <?php if(!isset($onepagecheckout_manage['shopping_cart']['shopping_cart_status']) || $onepagecheckout_manage['shopping_cart']['shopping_cart_status']=='0'){ ?> active <?php } ?>">
												<input type="radio"  name="onepagecheckout_manage[shopping_cart][shopping_cart_status]" <?php if(empty($onepagecheckout_manage['shopping_cart']['shopping_cart_status']) || $onepagecheckout_manage['shopping_cart']['shopping_cart_status']=='0'){ ?> checked="checked" <?php } ?> value="0" autocomplete="off"><?php echo $text_no; ?>
											</label>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="input-weight"><span  data-toggle="tooltip" title="<?php echo $entry_show_weight ; ?>" ><?php echo $show_weight; ?></span></label>
									<div class="col-sm-10">
										<?php 
										if(!isset($onepagecheckout_manage['shopping_cart']['show_product_weight'])) { 
												$onepagecheckout_manage['shopping_cart']['show_product_weight'] = '1';
											} ?>
										<div class="btn-group" data-toggle="buttons">
											<label class="btn btn-success btn-sm  <?php if(isset($onepagecheckout_manage['shopping_cart']['show_product_weight']) && $onepagecheckout_manage['shopping_cart']['show_product_weight']=='1'){ ?> active <?php } ?>" >	
												<input type="radio"  name="onepagecheckout_manage[shopping_cart][show_product_weight]" <?php if(!empty($onepagecheckout_manage['shopping_cart']['show_product_weight']) && $onepagecheckout_manage['shopping_cart']['show_product_weight']=='1'){ ?> checked="checked" <?php } ?> value="1" autocomplete="off"><?php echo $text_yes; ?>
											</label>
											
											<label class="btn btn-success btn-sm  <?php if(!isset($onepagecheckout_manage['shopping_cart']['show_product_weight']) || $onepagecheckout_manage['shopping_cart']['show_product_weight']=='0'){ ?> active <?php } ?>">
												<input type="radio"  name="onepagecheckout_manage[shopping_cart][show_product_weight]" <?php if(empty($onepagecheckout_manage['shopping_cart']['show_product_weight']) || $onepagecheckout_manage['shopping_cart']['show_product_weight']=='0'){ ?> checked="checked" <?php } ?> value="0" autocomplete="off"><?php echo $text_no; ?>
											</label>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="input-qnty_update"><span  data-toggle="tooltip" title="<?php echo $entry_show_qnty_update ; ?>"><?php echo $show_qnty_update; ?></span></label>
									<div class="col-sm-10">
										<?php 
										if(!isset($onepagecheckout_manage['shopping_cart']['show_product_qnty_update'])) { 
												$onepagecheckout_manage['shopping_cart']['show_product_qnty_update'] = '1';
											} ?>
										<div class="btn-group" data-toggle="buttons">
											<label class="btn btn-success btn-sm  <?php if(isset($onepagecheckout_manage['shopping_cart']['show_product_qnty_update']) && $onepagecheckout_manage['shopping_cart']['show_product_qnty_update']=='1'){ ?> active <?php } ?>" >	
												<input type="radio"  name="onepagecheckout_manage[shopping_cart][show_product_qnty_update]" <?php if(isset($onepagecheckout_manage['shopping_cart']['show_product_qnty_update']) && $onepagecheckout_manage['shopping_cart']['show_product_qnty_update']=='1'){ ?> checked="checked" <?php } ?> value="1" autocomplete="off"><?php echo $text_yes; ?>
											</label>
											
											<label class="btn btn-success btn-sm  <?php if(!isset($onepagecheckout_manage['shopping_cart']['show_product_qnty_update']) || $onepagecheckout_manage['shopping_cart']['show_product_qnty_update']=='0'){ ?> active <?php } ?>">
												<input type="radio"  name="onepagecheckout_manage[shopping_cart][show_product_qnty_update]" <?php if(!isset($onepagecheckout_manage['shopping_cart']['show_product_qnty_update']) || $onepagecheckout_manage['shopping_cart']['show_product_qnty_update']=='0'){ ?> checked="checked" <?php } ?> value="0" autocomplete="off"><?php echo $text_no; ?>
											</label>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="input-image_width"><?php echo $show_image_width; ?></label>
									<?php 
										if(!isset($onepagecheckout_manage['shopping_cart']['show_product_image_width'])) { 
												$onepagecheckout_manage['shopping_cart']['show_product_image_width'] = '50';
											}
										if(!isset($onepagecheckout_manage['shopping_cart']['show_product_image_height'])) { 
												$onepagecheckout_manage['shopping_cart']['show_product_image_height'] = '50';
											}	
											?>
									<div class="col-sm-3">
										<input type="text"  value="<?php if(isset($onepagecheckout_manage['shopping_cart']['show_product_image_width'])){ echo $onepagecheckout_manage['shopping_cart']['show_product_image_width']; } ?>"  name="onepagecheckout_manage[shopping_cart][show_product_image_width]" class="form-control" Placeholder="<?php  echo $entry_width; ?>"; >
									</div>
									<div class="col-sm-3">
										<input type="text"  value="<?php if(isset($onepagecheckout_manage['shopping_cart']['show_product_image_height'])){ echo $onepagecheckout_manage['shopping_cart']['show_product_image_height']; } ?>"  name="onepagecheckout_manage[shopping_cart][show_product_image_height]" class="form-control" Placeholder="<?php  echo $entry_height; ?>"; >
									</div>
								</div>
								<table class="table table-bordered">
									<thead>
										<tr>
											<th class="text-left"><?php echo $entry_show_image; ?></th>
											<th class="text-center"><?php echo $entry_show_product_name; ?></th>
											<th class="text-center"><?php echo $entry_show_model; ?></th>
											<th class="text-center"><?php echo $entry_show_quantity; ?></th>
											<th class="text-center"><?php echo $entry_show_unit_price; ?></th>
											<th class="text-right"><?php echo $entry_show_total_price; ?></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="text-left">
												<div class="col-sm-12">
													<?php 
													if(!isset($onepagecheckout_manage['shopping_cart']['show_product_image'])) { 
															$onepagecheckout_manage['shopping_cart']['show_product_image'] = '1';
														} ?>
													<div class="btn-group" data-toggle="buttons">
														<label class="btn btn-success btn-sm  <?php if(isset($onepagecheckout_manage['shopping_cart']['show_product_image']) && $onepagecheckout_manage['shopping_cart']['show_product_image']=='1'){ ?> active <?php } ?>" >	
															<input type="radio"  name="onepagecheckout_manage[shopping_cart][show_product_image]" <?php if(isset($onepagecheckout_manage['shopping_cart']['show_product_image']) && $onepagecheckout_manage['shopping_cart']['show_product_image']=='1'){ ?> checked="checked" <?php } ?> value="1" autocomplete="off"><?php echo $text_yes; ?>
														</label>
														
														<label class="btn btn-success btn-sm  <?php if(!isset($onepagecheckout_manage['shopping_cart']['show_product_image']) || $onepagecheckout_manage['shopping_cart']['show_product_image']=='0') { ?> active <?php } ?>">
															<input type="radio"  name="onepagecheckout_manage[shopping_cart][show_product_image]" <?php if(!isset($onepagecheckout_manage['shopping_cart']['show_product_image']) || $onepagecheckout_manage['shopping_cart']['show_product_image']=='0'){ ?> checked="checked" <?php } ?> value="0" autocomplete="off"><?php echo $text_no; ?>
														</label>
													</div>
												</div>
											</td>
											<td class="text-center">
												<div class="col-sm-12">
												<?php 
													if(!isset($onepagecheckout_manage['shopping_cart']['show_product_title'])) { 
															$onepagecheckout_manage['shopping_cart']['show_product_title'] = '1';
														} ?>
													<div class="btn-group" data-toggle="buttons">
														<label class="btn btn-success btn-sm  <?php if(isset($onepagecheckout_manage['shopping_cart']['show_product_title']) && $onepagecheckout_manage['shopping_cart']['show_product_title']=='1'){ ?> active <?php } ?>" >	
															<input type="radio"  name="onepagecheckout_manage[shopping_cart][show_product_title]" <?php if(isset($onepagecheckout_manage['shopping_cart']['show_product_title']) && $onepagecheckout_manage['shopping_cart']['show_product_title']=='1'){ ?> checked="checked" <?php } ?> value="1" autocomplete="off"><?php echo $text_yes; ?>
														</label>
														
														<label class="btn btn-success btn-sm  <?php if(!isset($onepagecheckout_manage['shopping_cart']['show_product_title']) || $onepagecheckout_manage['shopping_cart']['show_product_title']=='0'){ ?> active <?php } ?>">
															<input type="radio"  name="onepagecheckout_manage[shopping_cart][show_product_title]" <?php if(!isset($onepagecheckout_manage['shopping_cart']['show_product_title']) || $onepagecheckout_manage['shopping_cart']['show_product_title']=='0'){ ?> checked="checked" <?php } ?> value="0" autocomplete="off"><?php echo $text_no; ?>
														</label>
													</div>
												</div>
											</td>
											<td class="text-center">
												<div class="col-sm-12">
													<?php 
													if(!isset($onepagecheckout_manage['shopping_cart']['show_product_model'])) { 
															$onepagecheckout_manage['shopping_cart']['show_product_model'] = '1';
														} ?>
													<div class="btn-group" data-toggle="buttons">
														<label class="btn btn-success btn-sm  <?php if(isset($onepagecheckout_manage['shopping_cart']['show_product_model']) && $onepagecheckout_manage['shopping_cart']['show_product_model']=='1'){ ?> active <?php } ?>" >	
															<input type="radio"  name="onepagecheckout_manage[shopping_cart][show_product_model]" <?php if(isset($onepagecheckout_manage['shopping_cart']['show_product_model']) && $onepagecheckout_manage['shopping_cart']['show_product_model']=='1'){ ?> checked="checked" <?php } ?> value="1" autocomplete="off"><?php echo $text_yes; ?>
														</label>
														
														<label class="btn btn-success btn-sm  <?php if(!isset($onepagecheckout_manage['shopping_cart']['show_product_model']) || $onepagecheckout_manage['shopping_cart']['show_product_model']=='0'){ ?> active <?php } ?>">
															<input type="radio"  name="onepagecheckout_manage[shopping_cart][show_product_model]" <?php if(!isset($onepagecheckout_manage['shopping_cart']['show_product_model']) || $onepagecheckout_manage['shopping_cart']['show_product_model']=='0'){ ?> checked="checked" <?php } ?> value="0" autocomplete="off"><?php echo $text_no; ?>
														</label>
													</div>
												</div>
											</td>
											<td class="text-center">
												<div class="col-sm-12">
													<?php 
													if(!isset($onepagecheckout_manage['shopping_cart']['show_product_quantity'])) { 
															$onepagecheckout_manage['shopping_cart']['show_product_quantity'] = '1';
														} ?>
													<div class="btn-group" data-toggle="buttons">
														<label class="btn btn-success btn-sm  <?php if(isset($onepagecheckout_manage['shopping_cart']['show_product_quantity']) && $onepagecheckout_manage['shopping_cart']['show_product_quantity']=='1'){ ?> active <?php } ?>" >	
															<input type="radio"  name="onepagecheckout_manage[shopping_cart][show_product_quantity]" <?php if(isset($onepagecheckout_manage['shopping_cart']['show_product_quantity']) && $onepagecheckout_manage['shopping_cart']['show_product_quantity']=='1'){ ?> checked="checked" <?php } ?> value="1" autocomplete="off"><?php echo $text_yes; ?>
														</label>
														
														<label class="btn btn-success btn-sm  <?php if(!isset($onepagecheckout_manage['shopping_cart']['show_product_quantity']) || $onepagecheckout_manage['shopping_cart']['show_product_quantity']=='0'){ ?> active <?php } ?>">
															<input type="radio"  name="onepagecheckout_manage[shopping_cart][show_product_quantity]" <?php if(!isset($onepagecheckout_manage['shopping_cart']['show_product_quantity']) || $onepagecheckout_manage['shopping_cart']['show_product_quantity']=='0'){ ?> checked="checked" <?php } ?> value="0" autocomplete="off"><?php echo $text_no; ?>
														</label>
													</div>
												</div>
											</td>
											<td class="text-center">
												<div class="col-sm-12">
												<?php 
													if(!isset($onepagecheckout_manage['shopping_cart']['show_product_unit'])) { 
															$onepagecheckout_manage['shopping_cart']['show_product_unit'] = '1';
														} ?>
													<div class="btn-group" data-toggle="buttons">
														<label class="btn btn-success btn-sm  <?php if(isset($onepagecheckout_manage['shopping_cart']['show_product_unit']) && $onepagecheckout_manage['shopping_cart']['show_product_unit']=='1'){ ?> active <?php } ?>" >	
															<input type="radio"  name="onepagecheckout_manage[shopping_cart][show_product_unit]" <?php if(isset($onepagecheckout_manage['shopping_cart']['show_product_unit']) && $onepagecheckout_manage['shopping_cart']['show_product_unit']=='1'){ ?> checked="checked" <?php } ?> value="1" autocomplete="off"><?php echo $text_yes; ?>
														</label>
														
														<label class="btn btn-success btn-sm  <?php if(!isset($onepagecheckout_manage['shopping_cart']['show_product_unit']) || $onepagecheckout_manage['shopping_cart']['show_product_unit']=='0'){ ?> active <?php } ?>">
															<input type="radio"  name="onepagecheckout_manage[shopping_cart][show_product_unit]" <?php if(!isset($onepagecheckout_manage['shopping_cart']['show_product_unit']) || $onepagecheckout_manage['shopping_cart']['show_product_unit']=='0'){ ?> checked="checked" <?php } ?> value="0" autocomplete="off"><?php echo $text_no; ?>
														</label>
													</div>
												</div>
											</td>
											<td class="text-right">
												<div class="col-sm-12">
													<?php 
													if(!isset($onepagecheckout_manage['shopping_cart']['show_product_total_price'])) { 
															$onepagecheckout_manage['shopping_cart']['show_product_total_price'] = '1';
														} ?>
													<div class="btn-group" data-toggle="buttons">
														<label class="btn btn-success btn-sm  <?php if(isset($onepagecheckout_manage['shopping_cart']['show_product_total_price']) && $onepagecheckout_manage['shopping_cart']['show_product_total_price']=='1'){ ?> active <?php } ?>" >	
															<input type="radio"  name="onepagecheckout_manage[shopping_cart][show_product_total_price]" <?php if(isset($onepagecheckout_manage['shopping_cart']['show_product_total_price']) && $onepagecheckout_manage['shopping_cart']['show_product_total_price']=='1'){ ?> checked="checked" <?php } ?> value="1" autocomplete="off"><?php echo $text_yes; ?>
														</label>
														
														<label class="btn btn-success btn-sm  <?php if(!isset($onepagecheckout_manage['shopping_cart']['show_product_total_price']) || $onepagecheckout_manage['shopping_cart']['show_product_total_price']=='0'){ ?> active <?php } ?>">
															<input type="radio"  name="onepagecheckout_manage[shopping_cart][show_product_total_price]" <?php if(!isset($onepagecheckout_manage['shopping_cart']['show_product_total_price']) || $onepagecheckout_manage['shopping_cart']['show_product_total_price']=='0'){ ?> checked="checked" <?php } ?> value="0" autocomplete="off"><?php echo $text_no; ?>
														</label>
													</div>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</fieldset>
							<fieldset>
								<table class="table table-bordered">
									<thead>
										<tr>
											<td class="text-left"><?php echo $enty_module_name; ?></td>
											<th class="text-center"><?php echo $entry_logged; ?></th>
											<th class="text-center"><?php echo $entry_register_account; ?></th>
											<th class="text-right"><?php echo $entry_guest_order; ?></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="text-left"><?php echo $entry_coupon; ?></td>
											<td class="text-center">
												<div class="col-sm-12">
												<?php 
													if(!isset($onepagecheckout_manage['shopping_cart']['coupon_login_status'])) { 
															$onepagecheckout_manage['shopping_cart']['coupon_login_status'] = '1';
														} ?>
													<div class="btn-group" data-toggle="buttons">
														<label class="btn btn-success btn-sm <?php if(!empty($onepagecheckout_manage['shopping_cart']['coupon_login_status'])) { ?> active <?php } ?>" >	
															<input type="radio"  name="onepagecheckout_manage[shopping_cart][coupon_login_status]" <?php if(!empty($onepagecheckout_manage['shopping_cart']['coupon_login_status'])) { ?> checked="checked" <?php } ?> value="1" autocomplete="off"><?php echo $text_yes; ?>
														</label>
														
														<label class="btn btn-success btn-sm  <?php if(!isset($onepagecheckout_manage['shopping_cart']['coupon_login_status']) || $onepagecheckout_manage['shopping_cart']['coupon_login_status']=='0') { ?> active <?php } ?>">
															<input type="radio" name="onepagecheckout_manage[shopping_cart][coupon_login_status]" <?php if(!isset($onepagecheckout_manage['shopping_cart']['coupon_login_status']) || $onepagecheckout_manage['shopping_cart']['coupon_login_status']=='0'){ ?> checked="checked" <?php } ?> value="0" autocomplete="off"><?php echo $text_no; ?>
														</label>
													</div>
												</div>
											</td>	
											<td class="text-center">
												<div class="col-sm-12">
												<?php 
													if(!isset($onepagecheckout_manage['shopping_cart']['coupon_register_status'])) { 
															$onepagecheckout_manage['shopping_cart']['coupon_register_status'] = '1';
														} ?>
													<div class="btn-group" data-toggle="buttons">
														<label class="btn btn-success btn-sm <?php if(!empty($onepagecheckout_manage['shopping_cart']['coupon_register_status'])) { ?> active <?php } ?>" >	
															<input type="radio"  name="onepagecheckout_manage[shopping_cart][coupon_register_status]" <?php if(!empty($onepagecheckout_manage['shopping_cart']['coupon_register_status'])) { ?> checked="checked" <?php } ?> value="1" autocomplete="off"><?php echo $text_yes; ?>
														</label>
														
														<label class="btn btn-success btn-sm  <?php if(!isset($onepagecheckout_manage['shopping_cart']['coupon_register_status']) || $onepagecheckout_manage['shopping_cart']['coupon_register_status']=='0') { ?> active <?php } ?>">
															<input type="radio" name="onepagecheckout_manage[shopping_cart][coupon_register_status]" <?php if(!isset($onepagecheckout_manage['shopping_cart']['coupon_register_status']) || $onepagecheckout_manage['shopping_cart']['coupon_register_status']=='0'){ ?> checked="checked" <?php } ?> value="0" autocomplete="off"><?php echo $text_no; ?>
														</label>
													</div>
												</div>
											</td>
											<td class="text-right">
												<div class="col-sm-12">
												<?php 
													if(!isset($onepagecheckout_manage['shopping_cart']['coupon_guest_status'])) { 
															$onepagecheckout_manage['shopping_cart']['coupon_guest_status'] = '1';
														} ?>
													<div class="btn-group" data-toggle="buttons">
														<label class="btn btn-success btn-sm <?php if(!empty($onepagecheckout_manage['shopping_cart']['coupon_guest_status'])) { ?> active <?php } ?>" >	
															<input type="radio"  name="onepagecheckout_manage[shopping_cart][coupon_guest_status]" <?php if(!empty($onepagecheckout_manage['shopping_cart']['coupon_guest_status'])) { ?> checked="checked" <?php } ?> value="1" autocomplete="off"><?php echo $text_yes; ?>
														</label>
														
														<label class="btn btn-success btn-sm  <?php if(!isset($onepagecheckout_manage['shopping_cart']['coupon_guest_status']) || $onepagecheckout_manage['shopping_cart']['coupon_guest_status']=='0') { ?> active <?php } ?>">
															<input type="radio" name="onepagecheckout_manage[shopping_cart][coupon_guest_status]" <?php if(!isset($onepagecheckout_manage['shopping_cart']['coupon_guest_status']) || $onepagecheckout_manage['shopping_cart']['coupon_guest_status']=='0'){ ?> checked="checked" <?php } ?> value="0" autocomplete="off"><?php echo $text_no; ?>
														</label>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td class="text-left"><?php echo $entry_reward ?></td>
											<td class="text-center">
												<div class="col-sm-12">
												<?php 
													if(!isset($onepagecheckout_manage['shopping_cart']['reward_login_status'])) { 
															$onepagecheckout_manage['shopping_cart']['reward_login_status'] = '1';
														} ?>
													<div class="btn-group" data-toggle="buttons">
														<label class="btn btn-success btn-sm <?php if(!empty($onepagecheckout_manage['shopping_cart']['reward_login_status'])) { ?> active <?php } ?>" >	
															<input type="radio"  name="onepagecheckout_manage[shopping_cart][reward_login_status]" <?php if(!empty($onepagecheckout_manage['shopping_cart']['reward_login_status'])) { ?> checked="checked" <?php } ?> value="1" autocomplete="off"><?php echo $text_yes; ?>
														</label>
														
														<label class="btn btn-success btn-sm  <?php if(!isset($onepagecheckout_manage['shopping_cart']['reward_login_status']) || $onepagecheckout_manage['shopping_cart']['reward_login_status']=='0') { ?> active <?php } ?>">
															<input type="radio" name="onepagecheckout_manage[shopping_cart][reward_login_status]" <?php if(!isset($onepagecheckout_manage['shopping_cart']['reward_login_status']) || $onepagecheckout_manage['shopping_cart']['reward_login_status']=='0'){ ?> checked="checked" <?php } ?> value="0" autocomplete="off"><?php echo $text_no; ?>
														</label>
													</div>
												</div>
											</td>	
											<td class="text-center">
												<div class="col-sm-12">
													<?php 
													if(!isset($onepagecheckout_manage['shopping_cart']['reward_register_status'])) { 
															$onepagecheckout_manage['shopping_cart']['reward_register_status'] = '1';
														} ?>
													<div class="btn-group" data-toggle="buttons">
														<label class="btn btn-success btn-sm <?php if(!empty($onepagecheckout_manage['shopping_cart']['reward_register_status'])) { ?> active <?php } ?>" >	
															<input type="radio"  name="onepagecheckout_manage[shopping_cart][reward_register_status]" <?php if(!empty($onepagecheckout_manage['shopping_cart']['reward_register_status'])) { ?> checked="checked" <?php } ?> value="1" autocomplete="off"><?php echo $text_yes; ?>
														</label>
														
														<label class="btn btn-success btn-sm  <?php if(!isset($onepagecheckout_manage['shopping_cart']['reward_register_status']) || $onepagecheckout_manage['shopping_cart']['reward_register_status']=='0') { ?> active <?php } ?>">
															<input type="radio" name="onepagecheckout_manage[shopping_cart][reward_register_status]" <?php if(!isset($onepagecheckout_manage['shopping_cart']['reward_register_status']) || $onepagecheckout_manage['shopping_cart']['reward_register_status']=='0'){ ?> checked="checked" <?php } ?> value="0" autocomplete="off"><?php echo $text_no; ?>
														</label>
													</div>
												</div>
											</td>
											<td class="text-right">
												<div class="col-sm-12">
												<?php 
													if(!isset($onepagecheckout_manage['shopping_cart']['reward_guest_status'])) { 
															$onepagecheckout_manage['shopping_cart']['reward_guest_status'] = '1';
														} ?>
													<div class="btn-group" data-toggle="buttons">
														<label class="btn btn-success btn-sm <?php if(!empty($onepagecheckout_manage['shopping_cart']['reward_guest_status'])) { ?> active <?php } ?>" >	
															<input type="radio"  name="onepagecheckout_manage[shopping_cart][reward_guest_status]" <?php if(!empty($onepagecheckout_manage['shopping_cart']['reward_guest_status'])) { ?> checked="checked" <?php } ?> value="1" autocomplete="off"><?php echo $text_yes; ?>
														</label>
														
														<label class="btn btn-success btn-sm  <?php if(!isset($onepagecheckout_manage['shopping_cart']['reward_guest_status']) || $onepagecheckout_manage['shopping_cart']['reward_guest_status']=='0') { ?> active <?php } ?>">
															<input type="radio" name="onepagecheckout_manage[shopping_cart][reward_guest_status]" <?php if(!isset($onepagecheckout_manage['shopping_cart']['reward_guest_status']) || $onepagecheckout_manage['shopping_cart']['reward_guest_status']=='0'){ ?> checked="checked" <?php } ?> value="0" autocomplete="off"><?php echo $text_no; ?>
														</label>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td class="text-left"><?php echo $entry_voucher; ?></td>
											<td class="text-center">
												<div class="col-sm-12">
												<?php 
													if(!isset($onepagecheckout_manage['shopping_cart']['voucher_login_status'])) { 
															$onepagecheckout_manage['shopping_cart']['voucher_login_status'] = '1';
														} ?>
													<div class="btn-group" data-toggle="buttons">
														<label class="btn btn-success btn-sm <?php if(!empty($onepagecheckout_manage['shopping_cart']['voucher_login_status'])) { ?> active <?php } ?>" >	
															<input type="radio"  name="onepagecheckout_manage[shopping_cart][voucher_login_status]" <?php if(!empty($onepagecheckout_manage['shopping_cart']['voucher_login_status'])) { ?> checked="checked" <?php } ?> value="1" autocomplete="off"><?php echo $text_yes; ?>
														</label>
														
														<label class="btn btn-success btn-sm  <?php if(!isset($onepagecheckout_manage['shopping_cart']['voucher_login_status']) || $onepagecheckout_manage['shopping_cart']['voucher_login_status']=='0') { ?> active <?php } ?>">
															<input type="radio" name="onepagecheckout_manage[shopping_cart][voucher_login_status]" <?php if(!isset($onepagecheckout_manage['shopping_cart']['voucher_login_status']) || $onepagecheckout_manage['shopping_cart']['voucher_login_status']=='0'){ ?> checked="checked" <?php } ?> value="0" autocomplete="off"><?php echo $text_no; ?>
														</label>
													</div>
												</div>
											</td>	
											<td class="text-center">
												<div class="col-sm-12">
												<?php 
													if(!isset($onepagecheckout_manage['shopping_cart']['voucher_register_status'])) { 
															$onepagecheckout_manage['shopping_cart']['voucher_register_status'] = '1';
														} ?>
													<div class="btn-group" data-toggle="buttons">
														<label class="btn btn-success btn-sm <?php if(!empty($onepagecheckout_manage['shopping_cart']['voucher_register_status'])) { ?> active <?php } ?>" >	
															<input type="radio"  name="onepagecheckout_manage[shopping_cart][voucher_register_status]" <?php if(!empty($onepagecheckout_manage['shopping_cart']['voucher_register_status'])) { ?> checked="checked" <?php } ?> value="1" autocomplete="off"><?php echo $text_yes; ?>
														</label>
														
														<label class="btn btn-success btn-sm  <?php if(!isset($onepagecheckout_manage['shopping_cart']['voucher_register_status']) || $onepagecheckout_manage['shopping_cart']['voucher_register_status']=='0') { ?> active <?php } ?>">
															<input type="radio" name="onepagecheckout_manage[shopping_cart][voucher_register_status]" <?php if(!isset($onepagecheckout_manage['shopping_cart']['voucher_register_status']) || $onepagecheckout_manage['shopping_cart']['voucher_register_status']=='0'){ ?> checked="checked" <?php } ?> value="0" autocomplete="off"><?php echo $text_no; ?>
														</label>
													</div>
												</div>
											</td>
											<td class="text-right">
												<div class="col-sm-12">
												<?php 
													if(!isset($onepagecheckout_manage['shopping_cart']['voucher_guest_status'])) { 
															$onepagecheckout_manage['shopping_cart']['voucher_guest_status'] = '1';
														} ?>
													<div class="btn-group" data-toggle="buttons">
														<label class="btn btn-success btn-sm <?php if(!empty($onepagecheckout_manage['shopping_cart']['voucher_guest_status'])) { ?> active <?php } ?>" >	
															<input type="radio"  name="onepagecheckout_manage[shopping_cart][voucher_guest_status]" <?php if(!empty($onepagecheckout_manage['shopping_cart']['voucher_guest_status'])) { ?> checked="checked" <?php } ?> value="1" autocomplete="off"><?php echo $text_yes; ?>
														</label>
														
														<label class="btn btn-success btn-sm  <?php if(!isset($onepagecheckout_manage['shopping_cart']['voucher_guest_status']) || $onepagecheckout_manage['shopping_cart']['voucher_guest_status']=='0') { ?> active <?php } ?>">
															<input type="radio" name="onepagecheckout_manage[shopping_cart][voucher_guest_status]" <?php if(!isset($onepagecheckout_manage['shopping_cart']['voucher_guest_status']) || $onepagecheckout_manage['shopping_cart']['voucher_guest_status']=='0'){ ?> checked="checked" <?php } ?> value="0" autocomplete="off"><?php echo $text_no; ?>
														</label>
													</div>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</fieldset>
						</div>
						<div class="tab-pane" id="tab-personaldetails-setting">
							<fieldset>
								<legend><?php echo $entry_personaldetails; ?></legend>
								
								<div class="form-group register_newsletter">
									<label class="col-sm-2 control-label" for="input-newsletter"><?php echo $entry_newsletter; ?></label>
									<div class="col-sm-10">
										<div class="btn-group" data-toggle="buttons">
											<?php 
											if(!isset($onepagecheckout_manage['personaldetails']['newsletter_status'])) { 
												$onepagecheckout_manage['personaldetails']['newsletter_status'] = '1';
											}
											?>
											<label class="btn btn-success btn-sm <?php echo (!empty($onepagecheckout_manage['personaldetails']['newsletter_status'])) ? 'active' : ''; ?>">	
												<input type="radio"  name="onepagecheckout_manage[personaldetails][newsletter_status]" <?php echo (!empty($onepagecheckout_manage['personaldetails']['newsletter_status'])) ? 'checked="checked"' : ''; ?> value="1" autocomplete="off"><?php echo $text_yes; ?>
											</label>											
											<label class="btn btn-success btn-sm <?php echo (empty($onepagecheckout_manage['personaldetails']['newsletter_status'])) ? 'active' : ''; ?>">
												<input type="radio" name="onepagecheckout_manage[personaldetails][newsletter_status]" <?php echo (empty($onepagecheckout_manage['personaldetails']['newsletter_status'])) ? 'checked="checked"' : ''; ?> value="0" autocomplete="off"><?php echo $text_no; ?>
											</label>
										</div>
									</div>
								</div>
								<div class="table-responsive">
									<table id="table-personal" class="table table-bordered table-hover">
										<thead>
											<tr>
												<th class="text-left"><?php echo $entry_field_name ?></th>
												<th class="text-right"><?php echo $entry_status; ?></th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($onepagecheckout_manage['personaldetails']['fields'] as $key => $fields) { ?>
											<tr class="row-group">
												<td class="text-left">
													<i class="fa fa-arrows" aria-hidden="true"></i>
													<span><?php echo isset($onepagecheckout_manage['personaldetails']['fields'][$key]['label']) ? $onepagecheckout_manage['personaldetails']['fields'][$key]['label'] : ''; ?></span>
													<input type="hidden" name="onepagecheckout_manage[personaldetails][fields][<?php echo $key; ?>][sort_order]" value="<?php echo isset($onepagecheckout_manage['personaldetails']['fields'][$key]['sort_order']) ? $onepagecheckout_manage['personaldetails']['fields'][$key]['sort_order'] : '0'; ?>" class="form-control mydragsort" />
													<input type="hidden" name="onepagecheckout_manage[personaldetails][fields][<?php echo $key; ?>][label]" value="<?php echo isset($onepagecheckout_manage['personaldetails']['fields'][$key]['label']) ? $onepagecheckout_manage['personaldetails']['fields'][$key]['label'] : ''; ?>" class="form-control" />
												</td>
												<td class="text-right">
													<div class="btn-group" data-toggle="buttons">	
														<?php 
														if(!isset($onepagecheckout_manage['personaldetails']['fields'][$key]['show'])) { 
															$onepagecheckout_manage['personaldetails']['fields'][$key]['show'] = '2';
														}
														?>
														<label class="btn btn-success btn-sm <?php echo (isset($onepagecheckout_manage['personaldetails']['fields'][$key]['show']) && $onepagecheckout_manage['personaldetails']['fields'][$key]['show']=='1') ? 'active' : ''; ?>">
														<input type="radio" name="onepagecheckout_manage[personaldetails][fields][<?php echo $key; ?>][show]" <?php echo (isset($onepagecheckout_manage['personaldetails']['fields'][$key]['show']) && $onepagecheckout_manage['personaldetails']['fields'][$key]['show']=='1') ? 'checked="checked"' : ''; ?> value="1" autocomplete="off" /><?php echo $text_yes; ?>
														</label>
														<label class="btn btn-success btn-sm <?php echo (isset($onepagecheckout_manage['personaldetails']['fields'][$key]['show']) && $onepagecheckout_manage['personaldetails']['fields'][$key]['show']=='2') ? 'active' : ''; ?>">
														<input type="radio" name="onepagecheckout_manage[personaldetails][fields][<?php echo $key; ?>][show]" <?php echo (isset($onepagecheckout_manage['personaldetails']['fields'][$key]['show']) && $onepagecheckout_manage['personaldetails']['fields'][$key]['show']=='2') ? 'checked="checked"' : ''; ?> value="2" autocomplete="off" /><?php echo $entry_and_required; ?>
														</label>
														<label class="btn btn-success btn-sm <?php echo (empty($onepagecheckout_manage['personaldetails']['fields'][$key]['show'])) ? 'active' : ''; ?>">
														<input type="radio" name="onepagecheckout_manage[personaldetails][fields][<?php echo $key; ?>][show]" <?php echo (empty($onepagecheckout_manage['personaldetails']['fields'][$key]['show'])) ? 'checked="checked"' : ''; ?> value="0" autocomplete="off" /><?php echo $text_no; ?>
														</label>		
													</div>
												</td>
											</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</fieldset>
						</div>
						<div class="tab-pane" id="tab-payment-setting">
							<fieldset>
								<legend><?php echo $entry_payment_details_setting; ?></legend>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="input-status"><span  data-toggle="tooltip" title="<?php echo $entry_payment_details_order; ?> "><?php echo $entry_status; ?></span></label>
									<div class="col-sm-10">
										<?php 
										if(!isset($onepagecheckout_manage['payment_details']['payment_details_status'])){ 
											$onepagecheckout_manage['payment_details']['payment_details_status'] = '1';
										}	?>
										<div class="btn-group" data-toggle="buttons">
											<label class="btn btn-success btn-sm <?php if(isset($onepagecheckout_manage['payment_details']['payment_details_status']) && $onepagecheckout_manage['payment_details']['payment_details_status']=='1'){ ?> active <?php } ?>" >	
												<input type="radio"  name="onepagecheckout_manage[payment_details][payment_details_status]" <?php if(isset($onepagecheckout_manage['payment_details']['payment_details_status']) && $onepagecheckout_manage['payment_details']['payment_details_status']=='1'){ ?> checked="checked" <?php } ?> value="1" autocomplete="off"><?php echo $text_yes; ?>
											</label>
											
											<label class="btn btn-success btn-sm <?php if(!isset($onepagecheckout_manage['payment_details']['payment_details_status']) || $onepagecheckout_manage['payment_details']['payment_details_status']=='0') { ?> active <?php } ?>">
												<input type="radio"  name="onepagecheckout_manage[payment_details][payment_details_status]" <?php if(!isset($onepagecheckout_manage['payment_details']['payment_details_status']) || $onepagecheckout_manage['payment_details']['payment_details_status']=='0'){ ?> checked="checked" <?php } ?> value="0" autocomplete="off"><?php echo $text_no; ?>
											</label>
										</div>
									</div>
								</div>
								<div class="table-responsive">
									<table id="table-payment_details" class="table table-bordered table-hover">
										<thead>
											<tr>
												<th class="text-left"><?php echo $entry_field_name; ?></th>
												<th class="text-right"><?php echo $entry_status; ?></th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($onepagecheckout_manage['payment_details']['fields'] as $key => $fields) { ?>
											<tr class="row-group">
												<td class="text-left">
													<i class="fa fa-arrows" aria-hidden="true"></i>
													<span><?php echo isset($onepagecheckout_manage['payment_details']['fields'][$key]['label']) ? $onepagecheckout_manage['payment_details']['fields'][$key]['label'] : ''; ?></span>
													<input type="hidden" name="onepagecheckout_manage[payment_details][fields][<?php echo $key; ?>][sort_order]" value="<?php echo isset($onepagecheckout_manage['payment_details']['fields'][$key]['sort_order']) ? $onepagecheckout_manage['payment_details']['fields'][$key]['sort_order'] : '0'; ?>" class="form-control mydragsort" />
													<input type="hidden" name="onepagecheckout_manage[payment_details][fields][<?php echo $key; ?>][label]" value="<?php echo isset($onepagecheckout_manage['payment_details']['fields'][$key]['label']) ? $onepagecheckout_manage['payment_details']['fields'][$key]['label'] : ''; ?>" class="form-control" />
												</td>
												<td class="text-right">
													<div class="btn-group" data-toggle="buttons">	
														<?php 
														if(!isset($onepagecheckout_manage['payment_details']['fields'][$key]['show'])) { 
															$onepagecheckout_manage['payment_details']['fields'][$key]['show'] = '2';
														}
														?>
														<label class="btn btn-success btn-sm <?php echo (isset($onepagecheckout_manage['payment_details']['fields'][$key]['show']) && $onepagecheckout_manage['payment_details']['fields'][$key]['show']=='1') ? 'active' : ''; ?>">
														<input type="radio" name="onepagecheckout_manage[payment_details][fields][<?php echo $key; ?>][show]" <?php echo (isset($onepagecheckout_manage['payment_details']['fields'][$key]['show']) && $onepagecheckout_manage['payment_details']['fields'][$key]['show']=='1') ? 'checked="checked"' : ''; ?> value="1" autocomplete="off" /><?php echo $text_yes; ?>
														</label>
														<label class="btn btn-success btn-sm <?php echo (isset($onepagecheckout_manage['payment_details']['fields'][$key]['show']) && $onepagecheckout_manage['payment_details']['fields'][$key]['show']=='2') ? 'active' : ''; ?>">
														<input type="radio" name="onepagecheckout_manage[payment_details][fields][<?php echo $key; ?>][show]" <?php echo (isset($onepagecheckout_manage['payment_details']['fields'][$key]['show']) && $onepagecheckout_manage['payment_details']['fields'][$key]['show']=='2') ? 'checked="checked"' : ''; ?> value="2" autocomplete="off" /><?php echo $entry_and_required; ?>
														</label>
														<label class="btn btn-success btn-sm <?php echo (empty($onepagecheckout_manage['payment_details']['fields'][$key]['show'])) ? 'active' : ''; ?>">
														<input type="radio" name="onepagecheckout_manage[payment_details][fields][<?php echo $key; ?>][show]" <?php echo (empty($onepagecheckout_manage['payment_details']['fields'][$key]['show'])) ? 'checked="checked"' : ''; ?> value="0" autocomplete="off" /><?php echo $text_no; ?>
														</label>		
													</div>
												</td>
											</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</fieldset>
						</div>
						<div class="tab-pane" id="tab-delivery-setting">
							<fieldset>
								<legend><?php echo $entry_delivery_setting; ?></legend>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="input-status"><span  data-toggle="tooltip" title="<?php echo $entry_delivery_order; ?> "><?php echo $entry_status; ?></span></label>
									<div class="col-sm-10">
										<?php 
										if(!isset($onepagecheckout_manage['delivery']['delivery_status'])){ 
												$onepagecheckout_manage['delivery']['delivery_status'] = '1';
											}	?>
										<div class="btn-group" data-toggle="buttons">
											<label class="btn btn-success btn-sm <?php if(isset($onepagecheckout_manage['delivery']['delivery_status']) && $onepagecheckout_manage['delivery']['delivery_status']=='1'){ ?> active <?php } ?>" >	
												<input type="radio"  name="onepagecheckout_manage[delivery][delivery_status]" <?php if(isset($onepagecheckout_manage['delivery']['delivery_status']) && $onepagecheckout_manage['delivery']['delivery_status']=='1'){ ?> checked="checked" <?php } ?> value="1" autocomplete="off"><?php echo $text_yes; ?>
											</label>
											
											<label class="btn btn-success btn-sm <?php if(!isset($onepagecheckout_manage['delivery']['delivery_status']) || $onepagecheckout_manage['delivery']['delivery_status']=='0') { ?> active <?php } ?>">
												<input type="radio"  name="onepagecheckout_manage[delivery][delivery_status]" <?php if(!isset($onepagecheckout_manage['delivery']['delivery_status']) || $onepagecheckout_manage['delivery']['delivery_status']=='0'){ ?> checked="checked" <?php } ?> value="0" autocomplete="off"><?php echo $text_no; ?>
											</label>
										</div>
									</div>
								</div>
								<div class="table-responsive">
									<table id="table-delivery" class="table table-bordered table-hover">
										<thead>
											<tr>
												<th class="text-left"><?php echo $entry_field_name; ?></th>
												<th class="text-right"><?php echo $entry_status; ?></th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($onepagecheckout_manage['delivery']['fields'] as $key => $fields) { ?>
											<tr class="row-group">
												<td class="text-left">
													<i class="fa fa-arrows" aria-hidden="true"></i>
													<span><?php echo isset($onepagecheckout_manage['delivery']['fields'][$key]['label']) ? $onepagecheckout_manage['delivery']['fields'][$key]['label'] : ''; ?></span>
													<input type="hidden" name="onepagecheckout_manage[delivery][fields][<?php echo $key; ?>][sort_order]" value="<?php echo isset($onepagecheckout_manage['delivery']['fields'][$key]['sort_order']) ? $onepagecheckout_manage['delivery']['fields'][$key]['sort_order'] : '0'; ?>" class="form-control mydragsort" />
													<input type="hidden" name="onepagecheckout_manage[delivery][fields][<?php echo $key; ?>][label]" value="<?php echo isset($onepagecheckout_manage['delivery']['fields'][$key]['label']) ? $onepagecheckout_manage['delivery']['fields'][$key]['label'] : ''; ?>" class="form-control" />
												</td>
												<td class="text-right">
													<div class="btn-group" data-toggle="buttons">	
														<?php 
														if(!isset($onepagecheckout_manage['delivery']['fields'][$key]['show'])) { 
															$onepagecheckout_manage['delivery']['fields'][$key]['show'] = '2';
														}
														?>
														<label class="btn btn-success btn-sm <?php echo (isset($onepagecheckout_manage['delivery']['fields'][$key]['show']) && $onepagecheckout_manage['delivery']['fields'][$key]['show']=='1') ? 'active' : ''; ?>">
														<input type="radio" name="onepagecheckout_manage[delivery][fields][<?php echo $key; ?>][show]" <?php echo (isset($onepagecheckout_manage['delivery']['fields'][$key]['show']) && $onepagecheckout_manage['delivery']['fields'][$key]['show']=='1') ? 'checked="checked"' : ''; ?> value="1" autocomplete="off" /><?php echo $text_yes; ?>
														</label>
														<label class="btn btn-success btn-sm <?php echo (isset($onepagecheckout_manage['delivery']['fields'][$key]['show']) && $onepagecheckout_manage['delivery']['fields'][$key]['show']=='2') ? 'active' : ''; ?>">
														<input type="radio" name="onepagecheckout_manage[delivery][fields][<?php echo $key; ?>][show]" <?php echo (isset($onepagecheckout_manage['delivery']['fields'][$key]['show']) && $onepagecheckout_manage['delivery']['fields'][$key]['show']=='2') ? 'checked="checked"' : ''; ?> value="2" autocomplete="off" /><?php echo $entry_and_required; ?>
														</label>
														<label class="btn btn-success btn-sm <?php echo (empty($onepagecheckout_manage['delivery']['fields'][$key]['show'])) ? 'active' : ''; ?>">
														<input type="radio" name="onepagecheckout_manage[delivery][fields][<?php echo $key; ?>][show]" <?php echo (empty($onepagecheckout_manage['delivery']['fields'][$key]['show'])) ? 'checked="checked"' : ''; ?> value="0" autocomplete="off" /><?php echo $text_no; ?>
														</label>		
													</div>
												</td>
											</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</fieldset>
						</div>						
						<div class="tab-pane" id="tab-login-setting">
							<fieldset>
								<legend><?php echo $entry_login; ?></legend>
								
							</fieldset>
						</div>
						<div class="tab-pane" id="tab-general-language-setting">
							<fieldset>
									<legend><?php echo $entry_general; ?></legend>
							</fieldset>
							<ul class="nav nav-tabs" id="general-language">
								<?php foreach ($languages as $language) { ?>
								<li>
									<a href="#checkout-language<?php echo $language['language_id']; ?>" data-toggle="tab">
										<?php if(VERSION >= '2.2.0.0') { ?>
										<img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> 
										<?php } else { ?> 
										<img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> 
										<?php } ?>
										<?php echo $language['name']; ?>
									</a>
								</li>
								<?php } ?>
							</ul>
							<div class="tab-content">
							<?php foreach ($languages as $language) { ?>
								<div class="tab-pane" id="checkout-language<?php echo $language['language_id']; ?>">	
									<div class="form-group ">	
										<label class="col-sm-2 control-label " for="input-heading">
											<?php echo $entry_heading_title; ?></label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="onepagecheckout_manage[general][heading_title][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $placeholder_heading_title; ?>" value="<?php if(isset($onepagecheckout_manage['general']['heading_title'][$language['language_id']])){ echo $onepagecheckout_manage['general']['heading_title'][$language['language_id']]; } ?>">
											</div>
									</div>
									<div class="form-group ">	
										
											<label class="col-sm-2 control-label " for="input-description<?php echo $language['language_id']; ?>" >
											<?php echo $entry_description; ?></label>
											<div class="col-sm-10">
												<textarea class="form-control summernote"  name="onepagecheckout_manage[general][description][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_description; ?>" id="input-description<?php echo $language['language_id']; ?>" >
												<?php if(isset($onepagecheckout_manage['general']['description'][$language['language_id']])){ echo $onepagecheckout_manage['general']['description'][$language['language_id']]; } ?>
												</textarea>
											</div>
									</div>
									<div class="form-group ">	
										
											<label class="col-sm-2 control-label " for="input-description_bottom<?php echo $language['language_id']; ?>" >
											<?php echo $entry_description_bottom; ?></label>
											<div class="col-sm-10">
												<textarea class="form-control summernote"  name="onepagecheckout_manage[general][description_bottom][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_description_bottom; ?>" id="input-description_bottom<?php echo $language['language_id']; ?>" >
												<?php if(isset($onepagecheckout_manage['general']['description_bottom'][$language['language_id']])){ echo $onepagecheckout_manage['general']['description_bottom'][$language['language_id']]; } ?>
												</textarea>
											</div>
									</div>
								</div>
							<?php } ?>
						</div>
						</div>
						<div class="tab-pane" id="tab-personaldetails-language-setting">
							<fieldset>
								<legend><?php echo $entry_personaldetails; ?></legend>
								<ul class="nav nav-tabs" id="checkout-personal">
									<?php foreach ($languages as $language) { ?>
									<li>
										<a href="#checkout-personal<?php echo $language['language_id']; ?>" data-toggle="tab">
											<?php if(VERSION >= '2.2.0.0') { ?>
											<img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> 
											<?php } else { ?> 
											<img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> 
											<?php } ?>
											<?php echo $language['name']; ?>
										</a>
									</li>
									<?php } ?>
								</ul>	
								<div class="tab-content">
									<?php foreach ($languages as $language) { ?>
									<div class="tab-pane" id="checkout-personal<?php echo $language['language_id']; ?>">	
										<div class="form-group">	
											<label class="col-sm-2 control-label " for="input-heading">
											<?php echo $entry_heading; ?></label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="onepagecheckout_manage[register][heading_title][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $placeholder_heading; ?>" value="<?php if(isset($onepagecheckout_manage['register']['heading_title'][$language['language_id']])){ echo $onepagecheckout_manage['register']['heading_title'][$language['language_id']]; } ?>">
											</div>
										</div>
										<div class="table-responsive">
											<table class="table table-bordered table-hover">
												<thead>
													<tr>
														<th class="text-left"><?php echo $entry_field_name; ?></th>
														<th class="text-left"><?php echo $entry_label; ?></th>
														<th class="text-left"><?php echo $entry_placeholder; ?></th>
														<th class="text-left"><?php echo $entry_error; ?></th>
													</tr>
												</thead>
												<tbody>
													<?php foreach($onepagecheckout_manage['personaldetails']['fields'] as $key => $fields) { ?>
													<tr>
														<td class="text-left"><?php echo isset($onepagecheckout_manage['personaldetails']['fields'][$key]['label']) ? $onepagecheckout_manage['personaldetails']['fields'][$key]['label'] : ''; ?></td>
														<td class="text-left"><input type="text" class="form-control" name="onepagecheckout_manage[register][<?php echo $key; ?>][label][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_label; ?>" value="<?php if(isset($onepagecheckout_manage['register'][$key]['label'][$language['language_id']])){ echo $onepagecheckout_manage['register'][$key]['label'][$language['language_id']]; } ?>"></td>
														<td class="text-left"><input type="text" class="form-control" name="onepagecheckout_manage[register][<?php echo $key; ?>][placeholder][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_placeholder; ?>" value="<?php if(isset($onepagecheckout_manage['register'][$key]['placeholder'][$language['language_id']])){ echo $onepagecheckout_manage['register'][$key]['placeholder'][$language['language_id']]; } ?>"></td>
														<td class="text-left"><input type="text" class="form-control" name="onepagecheckout_manage[register][<?php echo $key; ?>][error][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_error; ?>" value="<?php if(isset($onepagecheckout_manage['register'][$key]['error'][$language['language_id']])){ echo $onepagecheckout_manage['register'][$key]['error'][$language['language_id']]; } ?>"></td>
													</tr>
													<?php } ?>
												</tbody>
											</table>
										</div>
									</div>
									<?php }?>
								</div>
							</fieldset>
						</div>
						<div class="tab-pane" id="tab-login-language-setting">
							<fieldset>
								<legend><?php echo $entry_login; ?></legend>
								<ul class="nav nav-tabs" id="checkout-language6">
									<?php foreach ($languages as $language) { ?>
									<li>
										<a href="#checkout-language6<?php echo $language['language_id']; ?>" data-toggle="tab">
											<?php if(VERSION >= '2.2.0.0') { ?>
											<img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> 
											<?php } else { ?> 
											<img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> 
											<?php } ?>
											<?php echo $language['name']; ?>
										</a>
									</li>
									<?php } ?>
								</ul>	
								<div class="tab-content">
									<?php foreach ($languages as $language) { ?>
									<div class="tab-pane" id="checkout-language6<?php echo $language['language_id']; ?>">
										<div class="form-group">	
											<label class="col-sm-2 control-label " for="input-heading">
											<?php echo $entry_heading; ?></label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="onepagecheckout_manage[login][heading_title][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $placeholder_heading; ?>" value="<?php if(isset($onepagecheckout_manage['login']['heading_title'][$language['language_id']])){ echo $onepagecheckout_manage['login']['heading_title'][$language['language_id']]; } ?>">
											</div>
										</div>
										<div class="form-group">	
											<label class="col-sm-2 control-label " for="input-heading">
											<?php echo $entry_btn_text; ?></label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="onepagecheckout_manage[login][button_text][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_btn_text; ?>" value="<?php if(isset($onepagecheckout_manage['login']['button_text'][$language['language_id']])){ echo $onepagecheckout_manage['login']['button_text'][$language['language_id']]; } ?>">
											</div>
										</div>
										<div class="form-group">	
											<label class="col-sm-2 control-label " for="input-heading">
											<?php echo $entry_wrong; ?></label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="onepagecheckout_manage[login][wrong_message][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_wrong; ?>" value="<?php if(isset($onepagecheckout_manage['login']['wrong_message'][$language['language_id']])){ echo $onepagecheckout_manage['login']['wrong_message'][$language['language_id']]; } ?>">
											</div>
										</div>
										<div class="form-group">	
											<label class="col-sm-2 control-label " for="input-heading">
											<?php echo $entry_approved_message; ?></label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="onepagecheckout_manage[login][approved_message][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_approved_message; ?>" value="<?php if(isset($onepagecheckout_manage['login']['approved_message'][$language['language_id']])){ echo $onepagecheckout_manage['login']['approved_message'][$language['language_id']]; } ?>">
											</div>
										</div>
										<div class="table-responsive">
											<table class="table table-bordered table-hover">
												<thead>
													<tr>
														<th class="text-left"><?php echo $entry_field_name; ?></th>
														<th class="text-left"><?php echo $entry_label; ?></th>
														<th class="text-left"><?php echo $entry_placeholder; ?></th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td class="text-left"><?php echo $entry_email; ?></td>
														<td class="text-left"><input type="text" class="form-control" name="onepagecheckout_manage[login][email][label][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_email_label; ?>" value="<?php if(isset($onepagecheckout_manage['login']['email']['label'][$language['language_id']])){ echo $onepagecheckout_manage['login']['email']['label'][$language['language_id']]; } ?>"></td>
														<td class="text-left"><input type="text" class="form-control" name="onepagecheckout_manage[login][email][placeholder][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_email_placeholder; ?>" value="<?php if(isset($onepagecheckout_manage['login']['email']['placeholder'][$language['language_id']])){ echo $onepagecheckout_manage['login']['email']['placeholder'][$language['language_id']]; } ?>"></td>
													</tr>
													<tr>
														<td class="text-left"><?php echo $entry_password; ?></td>
														<td class="text-center"><input type="text" class="form-control" name="onepagecheckout_manage[login][password][placeholder][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_password_placeholder; ?>" value="<?php if(isset($onepagecheckout_manage['login']['password']['placeholder'][$language['language_id']])){ echo $onepagecheckout_manage['login']['password']['placeholder'][$language['language_id']]; } ?>"></td>
														<td class="text-left"><input type="text" class="form-control" name="onepagecheckout_manage[login][password][label][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_password_label; ?>" value="<?php if(isset($onepagecheckout_manage['login']['password']['label'][$language['language_id']])){ echo $onepagecheckout_manage['login']['password']['label'][$language['language_id']]; } ?>"></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<?php } ?>
								</div>
							</fieldset>
						</div>
						<div class="tab-pane" id="tab-delivery_detail-language-setting">
							<fieldset>
								<legend><?php echo $entry_delivery_setting; ?></legend>
								<ul class="nav nav-tabs" id="checkout-deliverydetail">
									<?php foreach ($languages as $language) { ?>
									<li>
										<a href="#checkout-deliverydetail<?php echo $language['language_id']; ?>" data-toggle="tab">
											<?php if(VERSION >= '2.2.0.0') { ?>
											<img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> 
											<?php } else { ?> 
											<img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> 
											<?php } ?>
											<?php echo $language['name']; ?>
										</a>
									</li>
								<?php } ?>
								</ul>
								<div class="tab-content">
									<?php foreach ($languages as $language) { ?>
									<div class="tab-pane" id="checkout-deliverydetail<?php echo $language['language_id']; ?>">
										<div class="form-group ">	
											<label class="col-sm-2 control-label " for="input-heading"><?php echo $entry_heading; ?></label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="onepagecheckout_manage[delivery_detail][heading_title][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $placeholder_heading; ?>" value="<?php if(isset($onepagecheckout_manage['delivery_detail']['heading_title'][$language['language_id']])){ echo $onepagecheckout_manage['delivery_detail']['heading_title'][$language['language_id']]; } ?>">
											</div>
										</div>
										<div class="table-responsive">
											<table class="table table-bordered table-hover">
												<thead>
													<tr>
														<th class="text-left"><?php echo $entry_field_name; ?></th>
														<th class="text-left"><?php echo $entry_label; ?></th>
														<th class="text-left"><?php echo $entry_placeholder; ?></th>
														<th class="text-left"><?php echo $entry_error; ?></th>
													</tr>
												</thead>
												<tbody>
													<?php foreach($onepagecheckout_manage['delivery']['fields'] as $key => $fields) { ?>
													<tr>
														<td class="text-left"><?php echo isset($onepagecheckout_manage['delivery']['fields'][$key]['label']) ? $onepagecheckout_manage['delivery']['fields'][$key]['label'] : ''; ?></td>
														<td class="text-left"><input type="text" class="form-control" name="onepagecheckout_manage[delivery_detail][<?php echo $key; ?>][label][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_label; ?>" value="<?php if(isset($onepagecheckout_manage['delivery_detail'][$key]['label'][$language['language_id']])){ echo $onepagecheckout_manage['delivery_detail'][$key]['label'][$language['language_id']]; } ?>"></td>
														<td class="text-left"><input type="text" class="form-control" name="onepagecheckout_manage[delivery_detail][<?php echo $key; ?>][placeholder][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_placeholder; ?>" value="<?php if(isset($onepagecheckout_manage['delivery_detail'][$key]['placeholder'][$language['language_id']])){ echo $onepagecheckout_manage['delivery_detail'][$key]['placeholder'][$language['language_id']]; } ?>"></td>
														<td class="text-left"><input type="text" class="form-control" name="onepagecheckout_manage[delivery_detail][<?php echo $key; ?>][error][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_error; ?>" value="<?php if(isset($onepagecheckout_manage['delivery_detail'][$key]['error'][$language['language_id']])){ echo $onepagecheckout_manage['delivery_detail'][$key]['error'][$language['language_id']]; } ?>"></td>
													</tr>
													<?php } ?>
												</tbody>
											</table>
										</div>
									</div>
									<?php } ?>
								</div>
							</fieldset>
						</div>
						<div class="tab-pane" id="tab-paymentdetails-language-setting">
							<fieldset>
								<legend><?php echo $entry_payment_details_setting; ?></legend>
								<ul class="nav nav-tabs" id="checkout-paymentdetail">
									<?php foreach ($languages as $language) { ?>
									<li>
										<a href="#checkout-paymentdetail<?php echo $language['language_id']; ?>" data-toggle="tab">
											<?php if(VERSION >= '2.2.0.0') { ?>
											<img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> 
											<?php } else { ?> 
											<img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> 
											<?php } ?>
											<?php echo $language['name']; ?>
										</a>
									</li>
								<?php } ?>
								</ul>
								<div class="tab-content">
									<?php foreach ($languages as $language) { ?>
									<div class="tab-pane" id="checkout-paymentdetail<?php echo $language['language_id']; ?>">
										<div class="form-group ">	
											<label class="col-sm-2 control-label " for="input-heading"><?php echo $entry_heading; ?></label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="onepagecheckout_manage[payment_details_language][heading_title][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $placeholder_heading; ?>" value="<?php if(isset($onepagecheckout_manage['payment_details_language']['heading_title'][$language['language_id']])){ echo $onepagecheckout_manage['payment_details_language']['heading_title'][$language['language_id']]; } ?>">
											</div>
										</div>
										<div class="table-responsive">
											<table class="table table-bordered table-hover">
												<thead>
													<tr>
														<th class="text-left"><?php echo $entry_field_name; ?></th>
														<th class="text-left"><?php echo $entry_label; ?></th>
														<th class="text-left"><?php echo $entry_placeholder; ?></th>
														<th class="text-left"><?php echo $entry_error; ?></th>
													</tr>
												</thead>
												<tbody>
													<?php foreach($onepagecheckout_manage['payment_details']['fields'] as $key => $fields) { ?>
													<tr>
														<td class="text-left"><?php echo isset($onepagecheckout_manage['payment_details']['fields'][$key]['label']) ? $onepagecheckout_manage['payment_details']['fields'][$key]['label'] : ''; ?></td>
														<td class="text-left"><input type="text" class="form-control" name="onepagecheckout_manage[payment_details_language][<?php echo $key; ?>][label][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_label; ?>" value="<?php if(isset($onepagecheckout_manage['payment_details_language'][$key]['label'][$language['language_id']])){ echo $onepagecheckout_manage['payment_details_language'][$key]['label'][$language['language_id']]; } ?>"></td>
														<td class="text-left"><input type="text" class="form-control" name="onepagecheckout_manage[payment_details_language][<?php echo $key; ?>][placeholder][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_placeholder; ?>" value="<?php if(isset($onepagecheckout_manage['payment_details_language'][$key]['placeholder'][$language['language_id']])){ echo $onepagecheckout_manage['payment_details_language'][$key]['placeholder'][$language['language_id']]; } ?>"></td>
														<td class="text-left"><input type="text" class="form-control" name="onepagecheckout_manage[payment_details_language][<?php echo $key; ?>][error][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_error; ?>" value="<?php if(isset($onepagecheckout_manage['payment_details_language'][$key]['error'][$language['language_id']])){ echo $onepagecheckout_manage['payment_details_language'][$key]['error'][$language['language_id']]; } ?>"></td>
													</tr>
													<?php } ?>
												</tbody>
											</table>
										</div>
									</div>
									<?php } ?>
								</div>
							</fieldset>
						</div>
						<div class="tab-pane" id="tab-delivery_method-language-setting">
							<fieldset>
								<legend><?php echo $entry_delivery_method; ?></legend>
								<ul class="nav nav-tabs" id="checkout-language3">
									<?php foreach ($languages as $language) { ?>
									<li>
										<a href="#checkout-language3<?php echo $language['language_id']; ?>" data-toggle="tab">
											<?php if(VERSION >= '2.2.0.0') { ?>
											<img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> 
											<?php } else { ?> 
											<img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> 
											<?php } ?>
											<?php echo $language['name']; ?>
										</a>
									</li>
									<?php } ?>
								</ul>
								<div class="tab-content">
								<?php foreach ($languages as $language) { ?>
								<div class="tab-pane" id="checkout-language3<?php echo $language['language_id']; ?>">
									<div class="form-group">	
											<label class="col-sm-2 control-label" for="input-heading"><?php echo $entry_heading; ?></label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="onepagecheckout_manage[delivery_method][heading_title][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $placeholder_heading; ?>" value="<?php if(isset($onepagecheckout_manage['delivery_method']['heading_title'][$language['language_id']])){ echo $onepagecheckout_manage['delivery_method']['heading_title'][$language['language_id']]; } ?>">
											</div>
									</div>
									<?php if($delivery_methods){ ?> 
									<table class="table table-bordered">
										<thead>
											<tr>
												<th><?php echo $entry_delivery_method; ?></th>
												<th><?php echo $entry_label; ?></th>
											</tr>
										</thead>
										<tbody>
											
											<?php foreach($delivery_methods as $delivery_method){ ?>
											<tr>
												<td><?php echo $delivery_method['title']; ?></td>
												
												<td>
													<div class="col-md-12">
														<div class="form-group">
															<input type="text" class="form-control"  value="<?php if(isset($onepagecheckout_manage['delivery_method'][$delivery_method['code']]['label'][$language['language_id']])){ echo $onepagecheckout_manage['delivery_method'][$delivery_method['code']]['label'][$language['language_id']]; }else{ echo $delivery_method['title']; } ?>" name="onepagecheckout_manage[delivery_method][<?php echo $delivery_method['code']; ?>][label][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_label; ?>" >
														</div>
													</div>
												</td>
											</tr>
										
										<?php } ?>
										</tbody>
									</table>
									<?php } ?>
								</div>
								<?php } ?>
								</div>
							</fieldset>
						</div>
						<div class="tab-pane" id="tab-payment_method-language-setting">
							<fieldset>
								<legend><?php echo $entry_payment_method; ?></legend>
							
							<ul class="nav nav-tabs" id="checkout-paymentmethod">
								<?php foreach ($languages as $language) { ?>
								<li>
									<a href="#checkout-paymentmethod<?php echo $language['language_id']; ?>" data-toggle="tab">
										<?php if(VERSION >= '2.2.0.0') { ?>
										<img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> 
										<?php } else { ?> 
										<img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> 
										<?php } ?>
										<?php echo $language['name']; ?>
									</a>
								</li>
								<?php } ?>
							</ul>
							<div class="tab-content">
							<?php foreach ($languages as $language) { ?>
							<div class="tab-pane" id="checkout-paymentmethod<?php echo $language['language_id']; ?>">
							<div class="form-group ">	
								
									<label class="col-sm-2 control-label " for="input-heading"><?php echo $entry_heading; ?></label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="onepagecheckout_manage[payment_method][heading_title][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $placeholder_heading; ?>" value="<?php if(isset($onepagecheckout_manage['payment_method']['heading_title'][$language['language_id']])){ echo $onepagecheckout_manage['payment_method']['heading_title'][$language['language_id']]; } ?>">
									</div>
								
							</div>
							<?php if($payment_methods){ ?> 
							<table class="table table-bordered">
								<thead>
									<tr>
										<th><?php echo $entry_payment_method; ?></th>
										<th><?php echo $entry_label; ?></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($payment_methods as $payment_method){ ?>
									
									<tr>
										<td><?php echo $payment_method['title']; ?></td>
										
										<td>
											<div class="col-md-12">
												<div class="form-group">
													<input type="text" class="form-control"  value="<?php if(isset($onepagecheckout_manage['payment_method'][$payment_method['code']]['label'][$language['language_id']])) { echo $onepagecheckout_manage['payment_method'][$payment_method['code']]['label'][$language['language_id']]; }else{ echo $payment_method['title']; } ?>" name="onepagecheckout_manage[payment_method][<?php echo $payment_method['code']; ?>][label][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_label; ?>" >
												</div>
											</div>
										</td>
									</tr>
								<?php } ?>
								</tbody>
							</table>
							<?php } ?>
							</div>
							<?php } ?>
							</div>
							</fieldset>
						</div>
						<div class="tab-pane" id="tab-confirm_order-language-setting">
							<fieldset>
								<legend><?php echo $entry_confirm_order; ?></legend>
							
							<ul class="nav nav-tabs" id="checkout-confirm">
								<?php foreach ($languages as $language) { ?>
								<li>
									<a href="#checkout-confirm<?php echo $language['language_id']; ?>" data-toggle="tab">
										<?php if(VERSION >= '2.2.0.0') { ?>
										<img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> 
										<?php } else { ?> 
										<img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> 
										<?php } ?>
										<?php echo $language['name']; ?>
									</a>
								</li>
								<?php } ?>
							</ul>
							<div class="tab-content">
							<?php foreach($languages as $language){ ?>
							<div class="tab-pane" id="checkout-confirm<?php echo $language['language_id']; ?>">
							<div class="form-group ">	
						
								<label class="col-sm-2 control-label " for="input-confirm-button"><?php echo $entry_confirm_button; ?></label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="onepagecheckout_manage[confirm_order][confirm_button][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $placeholder_confirm_button; ?>" value="<?php if(isset($onepagecheckout_manage['confirm_order']['confirm_button'][$language['language_id']])) { echo $onepagecheckout_manage['confirm_order']['confirm_button'][$language['language_id']]; } ?>">
								</div>
						
							</div>
							<div class="form-group ">	
						
								<label class="col-sm-2 control-label " for="input-confirm-button"><?php echo $entry_comment_error; ?></label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="onepagecheckout_manage[confirm_order][comment_error][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_comment_error; ?>" value="<?php if(isset($onepagecheckout_manage['confirm_order']['comment_error'][$language['language_id']])) { echo $onepagecheckout_manage['confirm_order']['comment_error'][$language['language_id']]; } ?>">
								</div>
						
							</div>
							<div class="form-group ">	
							
								<label class="col-sm-2 control-label " for="input-shopping-button"><?php echo $entry_shopping_button; ?></label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="onepagecheckout_manage[confirm_order][shopping_button][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $placeholder_shopping_button; ?>" value="<?php if(isset($onepagecheckout_manage['confirm_order']['shopping_button'][$language['language_id']])) { echo $onepagecheckout_manage['confirm_order']['shopping_button'][$language['language_id']]; } ?>">
								</div>
					
							</div>
							</div>
							<?php } ?>
							</div>
							</fieldset>
						</div>
						<div class="tab-pane" id="tab-shopping-cart-language-setting">
							<fieldset>
								<legend><?php echo $entry_shopping_cart; ?></legend>
							
							<ul class="nav nav-tabs" id="checkout-language8">
								<?php foreach ($languages as $language) { ?>
								<li>
									<a href="#checkout-language8<?php echo $language['language_id']; ?>" data-toggle="tab">
										<?php if(VERSION >= '2.2.0.0') { ?>
										<img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> 
										<?php } else { ?> 
										<img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> 
										<?php } ?>
										<?php echo $language['name']; ?>
									</a>
								</li>
								<?php } ?>
							</ul>	
							<div class="tab-content">
								<?php foreach ($languages as $language) { ?>
									<div class="tab-pane" id="checkout-language8<?php echo $language['language_id']; ?>">
										<div class="form-group ">	
											<label class="col-sm-2 control-label " for="input-heading">
											<?php echo $entry_heading; ?></label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="onepagecheckout_manage[shopping_cart][heading_title][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $placeholder_heading; ?>" value="<?php if(isset($onepagecheckout_manage['shopping_cart']['heading_title'][$language['language_id']])){ echo $onepagecheckout_manage['shopping_cart']['heading_title'][$language['language_id']]; } ?>">
											</div>
										</div>
									</div>
								<?php }?>
							</div>
							</fieldset>
						</div>
						<div class="tab-pane" id="tab-support">
							<p class="text-center">For Support and Query Feel Free to contact:<br /><strong>extensionsbazaar@gmail.com</strong></p>
						</div>
					</div>
			</div>
    </div>
</form>
</div>
</div>
<script type="text/javascript" src="view/javascript/summernote/summernote.js"></script>
<link href="view/javascript/summernote/summernote.css" rel="stylesheet" />
<script type="text/javascript" src="view/javascript/summernote/opencart.js"></script>
<script type="text/javascript">
$('#general-language a:first').tab('show');
$('#checkout-language a:first').tab('show');
$('#checkout-language1 a:first').tab('show');
$('#checkout-language2 a:first').tab('show');
$('#checkout-language3 a:first').tab('show');
$('#checkout-language4 a:first').tab('show');
$('#checkout-language5 a:first').tab('show');
$('#checkout-language6 a:first').tab('show');
$('#checkout-language7 a:first').tab('show');
$('#checkout-language8 a:first').tab('show');
$('#checkout-language9 a:first').tab('show');
$('#checkout-language10 a:first').tab('show');
$('#checkout-language11 a:first').tab('show');
$('#checkout-personal a:first').tab('show');
$('#checkout-deliverydetail a:first').tab('show');
$('#checkout-paymentdetail a:first').tab('show');
$('#checkout-deliverymethod a:first').tab('show');
$('#checkout-paymentmethod a:first').tab('show');
$('#checkout-confirm a:first').tab('show');
//--></script>
<script type="text/javascript">
// Drag Personal Details
$(document).ready(function() {
$("#table-personal tbody").sortable({
	cursor: "move",
	stop: function() {
		$('#table-personal tbody .row-group').each(function() {
			$(this).find('.mydragsort').val($(this).index());
		});
	}
});

// Drag Delivery Details	
$("#table-delivery tbody").sortable({
	cursor: "move",
	stop: function() {
		$('#table-delivery tbody .row-group').each(function() {
			$(this).find('.mydragsort').val($(this).index());
		});
	}
});
	
// Drag Payment Details	
$("#table-payment_details tbody").sortable({
	cursor: "move",
	stop: function() {
		$('#table-payment_details tbody .row-group').each(function() {
			$(this).find('.mydragsort').val($(this).index());
		});
	}
});
});
</script>
  <script type="text/javascript"><!--
$('select[name=\'onepagecheckout_country_id\']').on('change', function() {
	$.ajax({
		url: 'index.php?route=localisation/country/country&token=<?php echo $token; ?>&country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'onepagecheckout_country_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
		},
		complete: function() {
			$('.fa-spin').remove();
		},
		success: function(json) {
			html = '<option value=""><?php echo $text_select; ?></option>';

			if (json['zone'] && json['zone'] != '') {
				for (i = 0; i < json['zone'].length; i++) {
          			html += '<option value="' + json['zone'][i]['zone_id'] + '"';

					if (json['zone'][i]['zone_id'] == '<?php echo $onepagecheckout_zone_id; ?>') {
            			html += ' selected="selected"';
					}

					html += '>' + json['zone'][i]['name'] + '</option>';
				}
			} else {
				html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
			}

			$('select[name=\'onepagecheckout_zone_id\']').html(html);
			
			$('#button-save').prop('disabled', false);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('select[name=\'onepagecheckout_country_id\']').trigger('change');
//--></script>
<script>
$('.button-account-type').click(function() {
	setTimeout(function() {
		var account_type = $('input[name=\'onepagecheckout_manage[personaldetails][register_status]\']:checked').val();
		if(account_type == '1') {
			$('.register_newsletter').removeClass('hide');
		}else{
			$('.register_newsletter').addClass('hide');
		}
	}, 300);
});
$(document).ready(function() {
	$('.active.button-account-type').trigger('click');
});
</script>
<style>
.btn-success1{
    background-color:#8fbb6c;
    border-color:#7aae50;
    color:#fff;
}
</style>
<?php echo $footer; ?>