<?php echo $header; ?>
<style type="text/css">
.form-control {
	border: solid 1px #CCC;
	background-color: #fcfcfc;
}
.btn-select {
	background-color: #fcfcfc;
	border: 1px solid #CCC;
}
.btn-group-ms {
	width: 100%;
	height: 35px;	
}
.btn-group-ms > .multiselect.btn {
	width: 100%;
	height: 35px;	
}
.multiselect ul {
	width: 100%;
	height: 35px;	
}
.wrapper { 
	float: left; 
	clear: left; 
	display: table; 
	table-layout: fixed; 
}
img.img-responsive { 
	display: table-cell; 
	max-width: 100%; 
}
.col-md-12 { 
	width: 100%; 
}
.wrap-url {
	-ms-word-break: break-all;
	word-break: break-all;
	word-break: break-word;
	-webkit-hyphens: auto;
   	-moz-hyphens: auto;
	hyphens: auto;
}
</style>
<?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-adv" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title_main; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
  <?php if ($success) { ?>
  <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
  <button type="button" class="close" data-dismiss="alert">&times;</button></div>
  <?php } ?>  
  <?php if ($warning) { ?>
  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $warning; ?>
  <button type="button" class="close" data-dismiss="alert">&times;</button></div>
  <?php } ?>  
  <?php if ($error_warning) { ?>
  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
  <button type="button" class="close" data-dismiss="alert">&times;</button></div>
  <?php } ?>         
  <?php foreach ($sc_geo_zones as $sc_geo_zone) { ?>
  <?php if (${'error_shipping_cost_' . $sc_geo_zone['geo_zone_id'] . '_total'}) { ?>
  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_shipping_cost_total; ?> [<?php echo $sc_geo_zone['name']; ?>]
  <button type="button" class="close" data-dismiss="alert">&times;</button></div>
  <?php } ?>   
  <?php if (${'error_shipping_cost_' . $sc_geo_zone['geo_zone_id'] . '_rate'}) { ?>
  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_shipping_cost_rate; ?> [<?php echo $sc_geo_zone['name']; ?>]
  <button type="button" class="close" data-dismiss="alert">&times;</button></div>
  <?php } ?> 
  <?php } ?> 
  <?php if ($error_extra_cost) { ?>
  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_extra_cost; ?>
  <button type="button" class="close" data-dismiss="alert">&times;</button></div>
  <?php } ?>   
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>    
      <div class="panel-body">
      	  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-adv">        
          <ul class="nav nav-tabs">
          <li class="active"><a href="#tab_product_cost" data-toggle="tab"><?php echo $tab_product_cost; ?></a></li>
          <li><a href="#tab_payment_cost" data-toggle="tab"><?php echo $tab_payment_cost; ?></a></li>
          <li><a href="#tab_shipping_cost" data-toggle="tab"><?php echo $tab_shipping_cost; ?></a></li>
          <li><a href="#tab_extra_cost" data-toggle="tab"><?php echo $tab_extra_cost; ?></a></li>
          <li><a href="#tab_documentation" data-toggle="tab"><?php echo $tab_documentation; ?></a></li>
          <li><a id="about" href="#tab_about" data-toggle="tab"><?php echo $tab_about; ?></a></li>
      	  </ul>              
          <div class="tab-content">
                     
        <div id="tab_product_cost" class="tab-pane active">
        <fieldset style="padding-bottom:20px;">
        <legend><?php echo $entry_import_export; ?></legend>
        <div class="form-group">
          	<div style="padding-bottom:5px;"><?php echo $text_import_export_note; ?></div>
                <div class="col-sm-12" style="padding-bottom:10px;">
                  <div class="row" style="border:1px solid #6db8e0; -moz-border-radius:3px; border-radius:3px;">
                   <div class="input-group"><span class="input-group-btn"><button class="btn btn-primary btn-sm" disabled="disabled" style="height:90px;">1</button></span>               
                    <div class="col-lg-4" style="padding-bottom:5px; padding-top:5px;">
                      <label class="control-label" for="filter_category"><?php echo $entry_category; ?></label>
            		  <select name="filter_category" id="filter_category" class="form-control" multiple="multiple" size="1">
            			<?php foreach ($categories as $category) { ?>         
						<?php if (in_array($category['category_id'], $filter_category)) { ?>
						<option value="<?php echo $category['category_id']; ?>" selected="selected"><?php echo $category['name']; ?></option>
						<?php } else { ?>
						<option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>
						<?php } ?>
						<?php } ?>
          			  </select>
                    </div>
                    <div class="col-lg-4" style="padding-bottom:5px; padding-top:5px;">
                      <label class="control-label" for="filter_manufacturer"><?php echo $entry_manufacturer; ?></label>
            		  <select name="filter_manufacturer" id="filter_manufacturer" class="form-control" multiple="multiple" size="1">
              			<?php foreach ($manufacturers as $manufacturer) { ?>
              			<?php if (isset($filter_manufacturer[$manufacturer['manufacturer_id']])) { ?>
              			<option value="<?php echo $manufacturer['manufacturer_id']; ?>" selected="selected"><?php echo $manufacturer['name']; ?></option>
              			<?php } else { ?>
              			<option value="<?php echo $manufacturer['manufacturer_id']; ?>"><?php echo $manufacturer['name']; ?></option> 
              			<?php } ?>
              			<?php } ?>
            		  </select>
                    </div>
                    <div class="col-lg-4" style="padding-bottom:5px; padding-top:5px;">
                      <label class="control-label" for="filter_status"><?php echo $entry_prod_status; ?></label>
            		  <select name="filter_status" id="filter_status" class="form-control" multiple="multiple" size="1">
                		<?php if ($filter_status) { ?>
                		<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                		<?php } else { ?>
                		<option value="1"><?php echo $text_enabled; ?></option>
                		<?php } ?>
                		<?php if (!is_null($filter_status) && !$filter_status) { ?>
                		<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                		<?php } else { ?>
                		<option value="0"><?php echo $text_disabled; ?></option>
                		<?php } ?>
            		  </select>
                    </div>
                  </div>
                 </div>
                </div>               
              <div class="col-sm-12" style="padding-bottom:10px;">
                <div class="row" style="border:1px solid #6db8e0; -moz-border-radius:3px; border-radius:3px;"> 
                   <div class="input-group"><span class="input-group-btn"><button class="btn btn-primary btn-sm" disabled="disabled" style="height:90px;">2</button></span>               
                    <div class="col-lg-5" style="padding-top:5px;">
                      <div style="padding-bottom:5px;"><?php echo $text_price_rounding; ?></div>
            		  <select name="filter_rounding" id="filter_rounding" data-style="btn-select" data-width="100%" class="select">
			  			<?php if ($filter_rounding == 'RD10DW') { ?>
			  			<option value="RD10DW" selected="selected">110.90 (round down to the whole number minus ten hundredths)</option>
			  			<?php } else { ?>
			  			<option value="RD10DW">110.90 (round down to the whole number minus ten hundredths)</option>
			  			<?php } ?>  
			  			<?php if ($filter_rounding == 'RD5DW') { ?>
			  			<option value="RD5DW" selected="selected">110.95 (round down to the whole number minus five hundredths)</option>
			  			<?php } else { ?>
			  			<option value="RD5DW">110.95 (round down to the whole number minus five hundredths)</option>
			  			<?php } ?>  
			  			<?php if ($filter_rounding == 'RD1DW') { ?>
			  			<option value="RD1DW" selected="selected">110.99 (round down to the whole number minus one hundredth)</option>
			  			<?php } else { ?>
			  			<option value="RD1DW">110.99 (round down to the whole number minus one hundredth)</option>
			  			<?php } ?>  
			  			<?php if ($filter_rounding == 'RD00DW') { ?>
			  			<option value="RD00DW" selected="selected">111.00 (round down to the whole number)</option>
			  			<?php } else { ?>
			  			<option value="RD00DW">111.00 (round down to the whole number)</option>
			  			<?php } ?>          
			  			<?php if ($filter_rounding == 'RD0DW') { ?>
			  			<option value="RD0DW" selected="selected">111.10 (round down to the nearest tenths place)</option>
			  			<?php } else { ?>
			  			<option value="RD0DW">111.10 (round down to the nearest tenths place)</option>
			  			<?php } ?>            
			  			<?php if ($filter_rounding == 'RD') { ?>
			  			<option value="RD" selected="selected">111.11 (without rounding) - default</option>
			  			<?php } else { ?>
			  			<option value="RD">111.11 (without rounding - default)</option>
			  			<?php } ?>
			  			<?php if ($filter_rounding == 'RD0UP') { ?>
			  			<option value="RD0UP" selected="selected">111.20 (round up to the nearest tenths place)</option>
			  			<?php } else { ?>
			  			<option value="RD0UP">111.20 (round up to the nearest tenths place)</option>
			  			<?php } ?> 
			  			<?php if ($filter_rounding == 'RD10UP') { ?>
			  			<option value="RD10UP" selected="selected">111.90 (round up to the whole number minus ten hundredths)</option>
			  			<?php } else { ?>
			  			<option value="RD10UP">111.90 (round up to the whole number minus ten hundredths)</option>
			  			<?php } ?>   
			  			<?php if ($filter_rounding == 'RD5UP') { ?>
			  			<option value="RD5UP" selected="selected">111.95 (round up to the whole number minus five hundredths)</option>
			  			<?php } else { ?>
			  			<option value="RD5UP">111.95 (round up to the whole number minus five hundredths)</option>
			  			<?php } ?>   
			  			<?php if ($filter_rounding == 'RD1UP') { ?>
			  			<option value="RD1UP" selected="selected">111.99 (round up to the whole number minus one hundredth)</option>
			  			<?php } else { ?>
			  			<option value="RD1UP">111.99 (round up to the whole number minus one hundredth)</option>
			  			<?php } ?>   
			  			<?php if ($filter_rounding == 'RD00UP') { ?>
			  			<option value="RD00UP" selected="selected">112.00 (round up to the whole number)</option>
			  			<?php } else { ?>
			  			<option value="RD00UP">112.00 (round up to the whole number)</option>
			  			<?php } ?>                                                                        
            		  </select>
                    </div>
                  </div>
                </div>
              </div> 
              <div class="col-sm-12" style="padding-bottom:10px;">
                <div class="row" style="border:1px solid #6db8e0; -moz-border-radius:3px; border-radius:3px;"> 
                   <div class="input-group"><span class="input-group-btn"><button class="btn btn-primary btn-sm" disabled="disabled" style="height:90px;">3</button></span>               
                    <div class="col-lg-12" style="padding-top:5px;">
                      <div style="padding-bottom:5px;"><?php echo $text_export; ?></div>
            		  <a id="button-export" data-toggle="tooltip" title="<?php echo $text_export; ?>" class="btn btn-primary" /><i class="fa fa-download"></i> <?php echo $button_export; ?></a>
                    </div>
                  </div>
                </div>
              </div> 
              <div class="col-sm-12" style="padding-bottom:10px;">
                <div class="row" style="border:1px solid #6db8e0; -moz-border-radius:3px; border-radius:3px;"> 
                   <div class="input-group"><span class="input-group-btn"><button class="btn btn-primary btn-sm" disabled="disabled" style="height:90px;">4</button></span>               
                    <div class="col-lg-5" style="padding-top:23px;">
                      <input type="file" name="upload" class="filestyle" />
                    </div>
                  </div>
                </div>
              </div> 
              <div class="col-sm-12">
                <div class="row" style="border:1px solid #6db8e0; -moz-border-radius:3px; border-radius:3px;"> 
                   <div class="input-group"><span class="input-group-btn"><button class="btn btn-primary btn-sm" disabled="disabled" style="height:90px;">5</button></span>               
                    <div class="col-lg-12" style="padding-top:5px;">
                      <div style="padding-bottom:5px;"><?php echo $text_import; ?></div>
            		  <a onclick="$('#form-adv').submit();" data-toggle="tooltip" title="<?php echo $text_import; ?>" class="btn btn-primary" /><i class="fa fa-upload"></i> <?php echo $button_import; ?></a>
                    </div>
                  </div>
                </div>
              </div> 
		</div>  
        </fieldset>
        <fieldset>                                         
        <legend><?php echo $entry_set_order_product_cost; ?></legend>
              <div class="form-group">
              <div class="col-sm-12">
                <div class="row">               
                    <div class="col-lg-12" style="padding-top:3px;">
                      <div style="padding-bottom:5px;"><?php echo $text_set_set_order_product_cost; ?></div>
            		  <a onclick="show_order_product_cost_confirm()" data-toggle="tooltip" title="<?php echo $entry_set_order_product_cost; ?>" class="btn btn-success" style="margin-top:10px; white-space:normal;" /><i class="fa fa-plus-circle"></i> <?php echo $button_set_order_product_cost; ?></a>
                    </div>
                </div>
              </div> 
              </div>   
        </fieldset>                   
		</div>
            
		<div id="tab_payment_cost" class="tab-pane">
		<table width="100%" class="table table-bordered">
        <tr>
          <td width="15%" class="text-left"><?php echo $entry_adv_payment_cost_status; ?></td>
          <td width="85%" class="text-left"><select name="adv_payment_cost_status" class="form-control">
              <?php if ($adv_payment_cost_status) { ?>
              <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
              <option value="0"><?php echo $text_disabled; ?></option>
              <?php } else { ?>
              <option value="1"><?php echo $text_enabled; ?></option>
              <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
              <?php } ?>
            </select></td>
        </tr>       
     	</table>
	  <br/>
      <div class="table-responsive">
        <table width="100%" id="adv_payment_cost" class="table table-bordered">
          <thead>
            <tr>
              <td width="18%" class="text-left" style="font-weight:normal; white-space:normal;"><?php echo $entry_adv_payment_cost_payment_type; ?></td>
              <td width="18%" class="text-left" style="font-weight:normal; white-space:normal;"><?php echo $entry_adv_payment_cost_total; ?></td>
              <td width="18%" class="text-left" style="font-weight:normal; white-space:normal;"><?php echo $entry_adv_payment_cost_percentage; ?></td>              
              <td width="18%" class="text-left" style="font-weight:normal; white-space:normal;"><?php echo $entry_adv_payment_cost_fixed_fee; ?></td>
			  <td width="18%" class="text-left" style="font-weight:normal; white-space:normal;"><?php echo $entry_adv_payment_cost_geo_zone; ?></td>
              <td></td>
            </tr>
          </thead>
          <?php if ($adv_payment_cost_types) { ?>
		   <?php $adv_payment_cost_types_row = 0; ?>
			<?php foreach ($adv_payment_cost_types as $adv_payment_cost_type) { ?>
			  <tbody id="adv_payment_cost_types_row<?php echo $adv_payment_cost_types_row; ?>">
				<tr>
				  <td width="18%" class="text-left">
					<select name="adv_payment_cost_type[<?php echo $adv_payment_cost_types_row; ?>][pc_paymentkey]" class="form-control">
					  <?php foreach ($payment_types as $payment_type) { ?>
						  <?php  if ($payment_type['paymentkey'] == $adv_payment_cost_type['pc_paymentkey']) { ?>
							<option value="<?php echo $payment_type['paymentkey']; ?>" selected><?php echo $payment_type['name']; ?></option>
						  <?php } else { ?>
							<option value="<?php echo $payment_type['paymentkey']; ?>"><?php echo $payment_type['name']; ?></option>
						  <?php } ?>
					  <?php } ?>
					</select>
				  </td> 
				  <td width="18%" class="text-left">
				  <input type="text" name="adv_payment_cost_type[<?php echo $adv_payment_cost_types_row; ?>][pc_order_total]" value="<?php echo $adv_payment_cost_type['pc_order_total']; ?>" class="form-control" />
				  </td>                  
				  <td width="18%" class="text-left">
				  <input type="text" name="adv_payment_cost_type[<?php echo $adv_payment_cost_types_row; ?>][pc_percentage]" value="<?php echo $adv_payment_cost_type['pc_percentage']; ?>" class="form-control" />
				  </td>
				  <td width="18%" class="text-left">
				  <input type="text" name="adv_payment_cost_type[<?php echo $adv_payment_cost_types_row; ?>][pc_fixed]" value="<?php echo $adv_payment_cost_type['pc_fixed']; ?>" class="form-control" />
				  </td>
				  <td width="18%" class="text-left">
				    <select name="adv_payment_cost_type[<?php echo $adv_payment_cost_types_row; ?>][pc_geozone]" class="form-control">
					  <option value="0" <?php if($adv_payment_cost_type['pc_geozone'] == 0) { echo 'selected'; } ?>><?php echo $text_all_zones; ?></option>
					  <?php foreach ($pc_geo_zones as $pc_geo_zone) { ?>
						  <?php  if ($pc_geo_zone['geo_zone_id'] == $adv_payment_cost_type['pc_geozone']) { ?>
							<option value="<?php echo $pc_geo_zone['geo_zone_id']; ?>" selected><?php echo $pc_geo_zone['name']; ?></option>
						  <?php } else { ?>
							<option value="<?php echo $pc_geo_zone['geo_zone_id']; ?>"><?php echo $pc_geo_zone['name']; ?></option>
						  <?php } ?>
					  <?php } ?>
					</select>
				  </td>
				  <td class="text-left"><button type="button" onclick="$('#adv_payment_cost_types_row<?php echo $adv_payment_cost_types_row; ?>').remove();" data-toggle="tooltip" title="<?php echo $button_remove_payment; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
				</tr>
			  </tbody>
            <?php $adv_payment_cost_types_row++; ?>
  		    <?php } ?>
          <?php } else { ?>
		     <?php $adv_payment_cost_types_row = 0; ?>
		  <?php } ?>
		  
		  <tfoot>
            <tr>
              <td colspan="5"></td>
              <td class="text-left"><button type="button" onclick="addPaymentType();" data-toggle="tooltip" title="<?php echo $button_add_payment; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
            </tr>
          </tfoot>
        </table>
        </div>
        <fieldset>                                         
        <legend><?php echo $entry_set_order_payment_cost; ?></legend>
              <div class="form-group">
              <div class="col-sm-12">
                <div class="row">               
                    <div class="col-lg-12" style="padding-top:3px;">
                      <div style="padding-bottom:5px;"><?php echo $text_set_set_order_payment_cost; ?></div>
            		  <a onclick="show_order_payment_cost_confirm()" data-toggle="tooltip" title="<?php echo $entry_set_order_payment_cost; ?>" class="btn btn-success" style="margin-top:10px; white-space:normal;" /><i class="fa fa-plus-circle"></i> <?php echo $button_set_order_payment_cost; ?></a>
                    </div>
                </div>
              </div> 
              </div>   
        </fieldset>
        </div>

		<div id="tab_shipping_cost" class="tab-pane">
          <div class="row">
            <div class="col-sm-2">
              <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
                <?php foreach ($sc_geo_zones as $sc_geo_zone) { ?>
                <li><a href="#tab-geo-zone<?php echo $sc_geo_zone['geo_zone_id']; ?>" data-toggle="tab"><?php echo $sc_geo_zone['name']; ?></a></li>
                <?php } ?>
              </ul>
            </div>
            <div class="col-sm-10">
              <div class="tab-content">
                <div class="tab-pane active" id="tab-general">
				<table width="100%" class="table table-bordered">
            	<tr>
              	<td width="30%" class="text-left"><?php echo $entry_adv_shipping_cost_status; ?></td>
              	<td width="70%" class="text-left"><select name="adv_shipping_cost_weight_status" class="form-control">
                  <?php if ($adv_shipping_cost_weight_status) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                  </select></td>
            	</tr>         
        		</table>
				</div>   
        <?php foreach ($sc_geo_zones as $sc_geo_zone) { ?>
        <div class="tab-pane" id="tab-geo-zone<?php echo $sc_geo_zone['geo_zone_id']; ?>">
          <table width="100%" class="table table-bordered">
        	<tr>
          	  <td width="30%" class="text-left"><?php echo $entry_adv_shipping_cost_total; ?></td>
			  <td width="70%" class="text-left"><input type="text" name="adv_shipping_cost_weight_<?php echo $sc_geo_zone['geo_zone_id']; ?>_total" value="<?php echo ${'adv_shipping_cost_weight_' . $sc_geo_zone['geo_zone_id'] . '_total'}; ?>" class="form-control" />
          	  <br />
          	  <?php if (${'error_shipping_cost_' . $sc_geo_zone['geo_zone_id'] . '_total'}) { ?>
          	  <span class="text-danger"><?php echo ${'error_shipping_cost_' . $sc_geo_zone['geo_zone_id'] . '_total'}; ?></span>
          	  <?php } ?></td>
            </tr>              
            <tr>
              <td width="30%" class="text-left"><?php echo $entry_adv_shipping_cost_rate; ?></td>
              <td width="70%" class="text-left"><textarea name="adv_shipping_cost_weight_<?php echo $sc_geo_zone['geo_zone_id']; ?>_rate" cols="40" rows="5" class="form-control"><?php echo ${'adv_shipping_cost_weight_' . $sc_geo_zone['geo_zone_id'] . '_rate'}; ?></textarea>
          	  <br />
         	  <?php if (${'error_shipping_cost_' . $sc_geo_zone['geo_zone_id'] . '_rate'}) { ?>
         	  <span class="text-danger"><?php echo ${'error_shipping_cost_' . $sc_geo_zone['geo_zone_id'] . '_rate'}; ?></span>
        	  <?php } ?></td>              
            </tr>        
            <tr>
              <td width="30%" class="text-left"><?php echo $entry_status; ?></td>
              <td width="70%" class="text-left"><select name="adv_shipping_cost_weight_<?php echo $sc_geo_zone['geo_zone_id']; ?>_status" class="form-control">
                  <?php if (${'adv_shipping_cost_weight_' . $sc_geo_zone['geo_zone_id'] . '_status'}) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select></td>
            </tr>
          </table>
        </div>
        <?php } ?>
        </div>
        </div>
        </div>
        <fieldset style="padding-top:10px;">                                         
        <legend><?php echo $entry_set_order_shipping_cost; ?></legend>
              <div class="form-group">
              <div class="col-sm-12">
                <div class="row">               
                    <div class="col-lg-12" style="padding-top:3px;">
                      <div style="padding-bottom:5px;"><?php echo $text_set_set_order_shipping_cost; ?></div>
            		  <a onclick="show_order_shipping_cost_confirm()" data-toggle="tooltip" title="<?php echo $entry_set_order_shipping_cost; ?>" class="btn btn-success" style="margin-top:10px; white-space:normal;" /><i class="fa fa-plus-circle"></i> <?php echo $button_set_order_shipping_cost; ?></a>
                    </div>
                </div>
              </div> 
              </div>   
        </fieldset>        
        </div>

		<div id="tab_extra_cost" class="tab-pane">
		<table width="100%" class="table table-bordered">
			<tr>
            	<td width="30%" class="text-left"><?php echo $entry_adv_extra_cost_status; ?></td>
              	<td width="70%" class="text-left"><select name="adv_extra_cost_status" class="form-control">
                  <?php if ($adv_extra_cost_status) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                  </select></td>
            </tr>                    
            <tr>
              <td width="30%" class="text-left"><?php echo $entry_adv_extra_cost; ?></td>
              <td width="70%" class="text-left"><textarea name="adv_extra_cost" cols="40" rows="5" class="form-control"><?php echo $adv_extra_cost; ?></textarea>
          	  <br />
         	  <?php if ($error_extra_cost) { ?>
         	  <span class="text-danger"><?php echo $error_extra_cost; ?></span>
        	  <?php } ?></td>              
            </tr>        
          </table>
        <fieldset>                                         
        <legend><?php echo $entry_set_order_extra_cost; ?></legend>
              <div class="form-group">
              <div class="col-sm-12">
                <div class="row">               
                    <div class="col-lg-12" style="padding-top:3px;">
                      <div style="padding-bottom:5px;"><?php echo $text_set_set_order_extra_cost; ?></div>
            		  <a onclick="show_order_extra_cost_confirm()" data-toggle="tooltip" title="<?php echo $entry_set_order_extra_cost; ?>" class="btn btn-success" style="margin-top:10px; white-space:normal;" /><i class="fa fa-plus-circle"></i> <?php echo $button_set_order_extra_cost; ?></a>
                    </div>
                </div>
              </div> 
              </div>   
        </fieldset>            
        </div> 
                 
		<div id="tab_documentation" class="tab-pane">
     	<iframe src="http://www.opencartreports.com/documentation/prm/index.html" width="100%" height="600" frameBorder="0"><a href="http://www.opencartreports.com/documentation/prm/index.html" target="_blank"><strong>Documentation</strong></a></iframe>         
        </div>   
      
		<div id="tab_about" class="tab-pane">
     	<div id="adv_profit_module"></div>
		<div align="center" class="wrapper col-md-12"><img class="img-responsive" src="view/image/adv_reports/adv_logo.jpg" /></div>        
        </div>
      
      </div>
      </form>      
      </div>
  	  </div>
      </div>
<?php if ($adv_prm_ext_version && $adv_prm_version && $adv_prm_version['version'] != $adv_prm_current_version) { ?>  
<script type="text/javascript">
$('#about').append('&nbsp;<i class=\"fa fa-exclamation-circle\"></i>'); 
$('#about').css({'background-color': '#FFD1D1','border': '1px solid #F8ACAC','color': 'red','text-decoration': 'blink'});
</script> 
<?php } ?>
<script type="text/javascript">
$('#button-export').on('click', function() {
	url = 'index.php?route=module/adv_profit_module&token=<?php echo $token; ?>';

	var filtercategory = [];
	$('#filter_category option:selected').each(function() {
		filtercategory.push($(this).val());
	});
	
	var filter_category = filtercategory.join('_');
	
	if (filter_category) {
		url += '&filter_category=' + encodeURIComponent(filter_category);
	}	

	var filtermanufacturer = [];
	$('#filter_manufacturer option:selected').each(function() {
		filtermanufacturer.push($(this).val());
	});
	
	var filter_manufacturer = filtermanufacturer.join('_');
	
	if (filter_manufacturer) {
		url += '&filter_manufacturer=' + encodeURIComponent(filter_manufacturer);
	}	

	var filterstatus = [];
	$('#filter_status option:selected').each(function() {
		filterstatus.push($(this).val());
	});
	
	var filter_status = filterstatus.join('_');
	
	if (filter_status) {
		url += '&filter_status=' + encodeURIComponent(filter_status);
	}		
	
	var filter_rounding = $('select[name=\'filter_rounding\']').val();

	if (filter_rounding) {
		url += '&filter_rounding=' + encodeURIComponent(filter_rounding);
	}		
	
		url += '&export=xls';
	
	location = url;
});

function show_order_product_cost_confirm() {
	var r = confirm("<?php echo $text_set_order_product_cost_confirm ;?>");
	if (r==true) {
		window.location = "<?php echo htmlspecialchars_decode($url_set_order_product_cost) ;?>";
	} else {
		//alert("You pressed Cancel!");
	}
}
function show_order_payment_cost_confirm() {
	var r = confirm("<?php echo $text_set_order_payment_cost_confirm ;?>");
	if (r==true) {
		window.location = "<?php echo htmlspecialchars_decode($url_set_order_payment_cost) ;?>";
	} else {
		//alert("You pressed Cancel!");
	}
}
function show_order_shipping_cost_confirm() {
	var r = confirm("<?php echo $text_set_order_shipping_cost_confirm ;?>");
	if (r==true) {
		window.location = "<?php echo htmlspecialchars_decode($url_set_order_shipping_cost) ;?>";
	} else {
		//alert("You pressed Cancel!");
	}
}
function show_order_extra_cost_confirm() {
	var r = confirm("<?php echo $text_set_order_extra_cost_confirm ;?>");
	if (r==true) {
		window.location = "<?php echo htmlspecialchars_decode($url_set_order_extra_cost) ;?>";
	} else {
		//alert("You pressed Cancel!");
	}
}

$('.select').selectpicker();
</script>
<script type="text/javascript">
$(document).ready(function() {
	if ($(window).height() > $('#filter_category').offset().top) {
		max_height_filter_category = $(window).height() - $('#filter_category').offset().top - $('#filter_category').outerHeight();
	} else {
		max_height_filter_category = $(document).height() - $('#filter_category').offset().top - $('#filter_category').outerHeight();
	}
	if (max_height_filter_category <= 0) {
		max_height_filter_category = 300;
	}
	if ($(window).height() > $('#filter_manufacturer').offset().top) {
		max_height_filter_manufacturer = $(window).height() - $('#filter_manufacturer').offset().top - $('#filter_manufacturer').outerHeight();
	} else {
		max_height_filter_manufacturer = $(document).height() - $('#filter_manufacturer').offset().top - $('#filter_manufacturer').outerHeight();
	}
	if (max_height_filter_manufacturer <= 0) {
		max_height_filter_manufacturer = 300;
	}
	if ($(window).height() > $('#filter_status').offset().top) {
		max_height_filter_status = $(window).height() - $('#filter_status').offset().top - $('#filter_status').outerHeight();
	} else {
		max_height_filter_status = $(document).height() - $('#filter_status').offset().top - $('#filter_status').outerHeight();
	}
	if (max_height_filter_status <= 0) {
		max_height_filter_status = 300;
	}
	
	$('#filter_category').multiselect({
		checkboxName: 'filtercategory[]',
		includeSelectAllOption: true,
		enableFiltering: true,
		selectAllText: '<?php echo $text_all; ?>',
		allSelectedText: '<?php echo $text_selected; ?>',
		nonSelectedText: '<?php echo $text_all_categories; ?>',
		enableClickableOptGroups: true,
		numberDisplayed: 0,
		disableIfEmpty: true,
		maxHeight: max_height_filter_category
	});
	$('#filter_manufacturer').multiselect({
		checkboxName: 'filtermanufacturer[]',
		includeSelectAllOption: true,
		enableFiltering: true,
		selectAllText: '<?php echo $text_all; ?>',
		allSelectedText: '<?php echo $text_selected; ?>',
		nonSelectedText: '<?php echo $text_all_manufacturers; ?>',
		numberDisplayed: 0,
		disableIfEmpty: true,
		maxHeight: max_height_filter_manufacturer
	});	
	$('#filter_status').multiselect({
		checkboxName: 'filterstatus[]',
		includeSelectAllOption: true,
		enableFiltering: true,
		selectAllText: '<?php echo $text_all; ?>',
		allSelectedText: '<?php echo $text_selected; ?>',
		nonSelectedText: '<?php echo $text_all_statuses; ?>',
		numberDisplayed: 0,
		disableIfEmpty: true,
		maxHeight: max_height_filter_status
	});		
});
</script>
<script type="text/javascript">
var adv_payment_cost_types_row = <?php echo $adv_payment_cost_types_row; ?>;

function addPaymentType() {
	html  = '<tbody id="adv_payment_cost_types_row' + adv_payment_cost_types_row + '">';
	html += '<tr>';
	html += '<td class="text-left"><select name="adv_payment_cost_type[' + adv_payment_cost_types_row + '][pc_paymentkey]" class="form-control">';
	html += '<?php foreach ($payment_types as $payment_type) { ?><option value="<?php echo $payment_type["paymentkey"]; ?>"><?php echo $payment_type["name"]; ?></option><?php } ?>';
	html += '<td class="text-left"><input type="text" name="adv_payment_cost_type[' + adv_payment_cost_types_row + '][pc_order_total]" value="0.00" class="form-control" /></td>';
	html += '<td class="text-left"><input type="text" name="adv_payment_cost_type[' + adv_payment_cost_types_row + '][pc_percentage]" value="0.00" class="form-control" /></td>';
	html += '<td class="text-left"><input type="text" name="adv_payment_cost_type[' + adv_payment_cost_types_row + '][pc_fixed]" value="0.00" class="form-control" /></td>';
	html += '<td class="text-left"><select name="adv_payment_cost_type[' + adv_payment_cost_types_row + '][pc_geozone]" class="form-control">';
    html += '<option value="0" selected><?php echo $text_all_zones; ?></option>';
    html += '<?php foreach ($pc_geo_zones as $pc_geo_zone) { ?>';
    html += '<option value="<?php echo $pc_geo_zone["geo_zone_id"]; ?>"><?php echo $pc_geo_zone["name"]; ?></option>';
    html += '<?php } ?></select></td>';
	html += '<td class="text-left"><button type="button" onclick="$(\'#adv_payment_cost_types_row' + adv_payment_cost_types_row + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove_payment; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';
	html += '</tbody>';

	$('#adv_payment_cost > tfoot').before(html);

	adv_payment_cost_types_row++;
}
</script>
</div>
<?php echo $footer; ?>