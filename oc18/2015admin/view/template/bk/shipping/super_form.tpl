  <div class="form-group">
	<label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?></label>
	<div class="col-sm-10">
	  <?php foreach ($languages as $language) { ?>
		  <?php if ($language['language_id'] == $language_id) { ?>
		  <div style="margin-bottom:10px;"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><input type="text" name="super<?php echo $shipping_id; ?>_name[<?php echo $language['language_id']; ?>]" value="<?php echo isset(${'super'.$shipping_id.'_name'}[$language['language_id']])?${'super'.$shipping_id.'_name'}[$language['language_id']]:''; ?>" onkeyup="$('.tab-shipping<?php echo $shipping_id; ?> span').html($(this).val())" onblur="$('.tab-shipping<?php echo $shipping_id; ?> span').html($(this).val())" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" /></div>
		  <?php } else { ?>
		  <div style="margin-bottom:10px;"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><input type="text" name="super<?php echo $shipping_id; ?>_name[<?php echo $language['language_id']; ?>]" value="<?php echo isset(${'super'.$shipping_id.'_name'}[$language['language_id']])?${'super'.$shipping_id.'_name'}[$language['language_id']]:''; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" /></div>
		  <?php } ?>
	  <?php } ?>
	</div>
  </div>
  <div class="form-group">
	<label class="col-sm-2 control-label" for="input-weight-cost"><?php echo $entry_description; ?></label>
	<div class="col-sm-10">
	  <?php foreach ($languages as $language) { ?>
	  <div style="margin-bottom:10px;"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><textarea name="super<?php echo $shipping_id; ?>_description[<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_description; ?>" rows="5" class="form-control"><?php echo isset(${'super'.$shipping_id.'_description'}[$language['language_id']])?${'super'.$shipping_id.'_description'}[$language['language_id']]:''; ?></textarea></div>
	  <?php } ?>
	</div>
  </div>
  <div class="form-group">
	<label class="col-sm-2 control-label" for="input-geo-zone"><?php echo $entry_geo_zone; ?></label>
	<div class="col-sm-10">
	  <select name="super<?php echo $shipping_id; ?>_geo_zone_id" id="input-geo-zone" class="form-control">
		<option value="0"><?php echo $text_all_zones; ?></option>
		<?php foreach ($geo_zones as $geo_zone) { ?>
		<?php if ($geo_zone['geo_zone_id'] == ${'super'.$shipping_id.'_geo_zone_id'}) { ?>
		<option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
		<?php } else { ?>
		<option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
		<?php } ?>
		<?php } ?>
	  </select>
	</div>
  </div>
  <div class="form-group">
	<label class="col-sm-2 control-label" for="input-weight-cost"><span data-toggle="tooltip" title="<?php echo $help_weight_cost; ?>"><?php echo $entry_weight_cost; ?></span></label>
	<div class="col-sm-10">
	  <textarea name="super<?php echo $shipping_id; ?>_weight_cost" rows="5" placeholder="<?php echo $entry_weight_cost; ?>" id="input-weight-cost" class="form-control"><?php echo ${'super'.$shipping_id.'_weight_cost'}; ?></textarea>
	</div>
  </div>
  <div class="form-group">
	<label class="col-sm-2 control-label" for="input-price-cost"><span data-toggle="tooltip" title="<?php echo $help_price_cost; ?>"><?php echo $entry_price_cost; ?></span></label>
	<div class="col-sm-10">
	  <textarea name="super<?php echo $shipping_id; ?>_price_cost" rows="5" placeholder="<?php echo $entry_price_cost; ?>" id="input-price-cost" class="form-control"><?php echo ${'super'.$shipping_id.'_price_cost'}; ?></textarea>
	</div>
  </div>
  <div class="form-group">
	<label class="col-sm-2 control-label"><?php echo $entry_payment; ?></label>
	<div class="col-sm-10">
	  <div class="well well-sm" style="height: 150px; overflow: auto;">
		<?php foreach ($extensions as $payment) { ?>
		<div class="checkbox">
		  <label>
			<?php if (in_array($payment['code'], ${'super'.$shipping_id.'_payment'})) { ?>
			<input type="checkbox" name="super<?php echo $shipping_id; ?>_payment[]" value="<?php echo $payment['code']; ?>" checked="checked" />
			<?php echo $payment['name']; ?>
			<?php } else { ?>
			<input type="checkbox" name="super<?php echo $shipping_id; ?>_payment[]" value="<?php echo $payment['code']; ?>" />
			<?php echo $payment['name']; ?>
			<?php } ?>
		  </label>
		</div>
		<?php } ?>
	  </div>
	</div>
  </div>
  <div class="form-group">
	<label class="col-sm-2 control-label"><?php echo $text_store; ?></label>
	<div class="col-sm-10">
		<div class="tab-pane" id="tab-stores-<?php echo $shipping_id; ?>">
		  <ul class="nav nav-tabs" id="store<?php echo $shipping_id; ?>">
			<?php $store_row = 0; ?>
			<?php foreach (${'super'.$shipping_id.'_store'} as $ss) { ?>
			<li><a href="#tab-store-<?php echo $shipping_id; ?><?php echo $store_row; ?>" data-toggle="tab"><i class="fa fa-minus-circle" onclick="$(this).parent().remove(); $('#tab-store-<?php echo $shipping_id; ?><?php echo $store_row; ?>').remove(); $('#option a:first').tab('show')"></i> <span id="txt<?php echo $store_row; ?>"><?php echo $ss['name'][$language_id]; ?></span></a></li>
			<?php $store_row++; ?>
			<?php } ?>
			<li class="active"><a onclick="addStore<?php echo $shipping_id; ?>();"><i class="fa fa-plus-circle"></i> <?php echo $text_group_add; ?></a></li>
		  </ul>
		
		  <div class="tab-content">
			<?php $store_row = 0; ?>
			<?php $s_row = 0; ?>
			<?php foreach (${'super'.$shipping_id.'_store'} as $ss) { ?>
			<div class="tab-pane" id="tab-store-<?php echo $shipping_id; ?><?php echo $store_row; ?>">
			  <div class="form-group">
				<label class="col-sm-2 control-label" for="input-sort-order"><?php echo $text_group; ?></label>
				<div class="col-sm-10">
				  <?php foreach ($languages as $language) { ?>
		  		    <?php if ($language['language_id'] == $language_id) { ?>
				    <div style="margin-bottom:10px;"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><input type="text" name="super<?php echo $shipping_id; ?>_store[<?php echo $store_row; ?>][name][<?php echo $language['language_id']; ?>]" value="<?php echo isset($ss['name'][$language['language_id']])?$ss['name'][$language['language_id']]:''; ?>" onkeyup="$('#txt<?php echo $store_row; ?>').html($(this).val())" onblur="$('#txt<?php echo $store_row; ?>').html($(this).val())" placeholder="<?php echo $text_group; ?>" class="form-control" /></div>
					<?php } else { ?>
				    <div style="margin-bottom:10px;"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><input type="text" name="super<?php echo $shipping_id; ?>_store[<?php echo $store_row; ?>][name][<?php echo $language['language_id']; ?>]" value="<?php echo isset($ss['name'][$language['language_id']])?$ss['name'][$language['language_id']]:''; ?>" placeholder="<?php echo $text_group; ?>" class="form-control" /></div>
					<?php } ?>
				  <?php } ?>
				</div>
			  </div>
			  <div class="table-responsive">
				<table id="store<?php echo $shipping_id; ?>-address<?php echo $store_row; ?>" class="table table-striped table-bordered table-hover">
				  <thead>
					<tr>
					  <td class="text-left"><?php echo $text_store_name; ?></td>
					  <td class="text-left"><?php echo $text_store_work; ?></td>
					  <td></td>
					</tr>
				  </thead>
				  <tbody>
					<?php if (!empty($ss['store'])) { ?>
					<?php foreach ($ss['store'] as $s) { ?>
					<tr>
					  <td class="text-left">
					  <?php foreach ($languages as $language) { ?>
					  <div style="margin-bottom:10px;"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><input type="text" name="super<?php echo $shipping_id; ?>_store[<?php echo $store_row; ?>][store][<?php echo $s_row; ?>][address][<?php echo $language['language_id']; ?>]" value="<?php echo isset($s['address'][$language['language_id']])?$s['address'][$language['language_id']]:''; ?>" placeholder="<?php echo $text_store_address; ?>" class="form-control" /></div>
					  <?php } ?>
					  </td>
					  <td class="text-left">
					  <?php foreach ($languages as $language) { ?>
					  <div style="margin-bottom:10px;"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><input type="text" name="super<?php echo $shipping_id; ?>_store[<?php echo $store_row; ?>][store][<?php echo $s_row; ?>][work][<?php echo $language['language_id']; ?>]" value="<?php echo isset($s['work'][$language['language_id']])?$s['work'][$language['language_id']]:''; ?>" placeholder="<?php echo $text_store_work; ?>" class="form-control" /></div>
					  <?php } ?>
					  </td>
					  <td class="text-left"><button type="button" onclick="$(this).parent().parent().remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
					</tr>
					<?php $s_row++; ?>
					<?php } ?>
					<?php } ?>
				  </tbody>
				  <tfoot>
					<tr>
					  <td colspan="2"></td>
					  <td class="text-left" width="1%"><button type="button" onclick="addAddress<?php echo $shipping_id; ?>(<?php echo $store_row; ?>);" data-toggle="tooltip" title="<?php echo $text_store_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
					</tr>
				  </tfoot>
				</table>
			  </div>
			</div>
			<?php $store_row++; ?>
			<?php } ?>
		  </div>
		</div>
	</div>
  </div>
  <div class="form-group">
	<label class="col-sm-2 control-label"><?php echo $text_custom; ?></label>
	<div class="col-sm-10">
		<table class="table table-striped table-bordered table-hover">
		  <thead>
			<tr>
			  <td class="text-left"><?php echo $text_custom_name; ?></td>
			  <td class="text-left"><?php echo $text_custom_value; ?></td>
			  <td class="text-left"><?php echo $text_custom_type; ?></td>
			  <td></td>
			</tr>
		  </thead>
		  <tbody id="custom<?php echo $shipping_id; ?>">
			<?php $custom_row = 0; ?>
			<?php foreach (${'super'.$shipping_id.'_custom'} as $sc) { ?>
			<tr>
			  <td class="text-left">
			      <?php foreach ($languages as $language) { ?>
				  <div style="margin-bottom:10px;"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><input type="text" name="super<?php echo $shipping_id; ?>_custom[<?php echo $custom_row; ?>][name][<?php echo $language['language_id']; ?>]" value="<?php echo isset($sc['name'][$language['language_id']])?$sc['name'][$language['language_id']]:''; ?>" placeholder="<?php echo $text_custom_name; ?>" class="form-control" /></div>
				  <?php } ?>
			  </td>
			  <td class="text-left">
			      <?php foreach ($languages as $language) { ?>
				  <div style="margin-bottom:10px;"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><textarea name="super<?php echo $shipping_id; ?>_custom[<?php echo $custom_row; ?>][value][<?php echo $language['language_id']; ?>]" rows="5" class="form-control"><?php echo isset($sc['value'][$language['language_id']])?$sc['value'][$language['language_id']]:''; ?></textarea></div>
				  <?php } ?>
			  </td>
			  <td class="text-left">
				  <select name="super<?php echo $shipping_id; ?>_custom[<?php echo $custom_row; ?>][type]" class="form-control">
					<option value="0"><?php echo $text_none; ?></option>
					<option value="text"<?php echo $sc['type']=='text'?' selected="selected"':''; ?>><?php echo $type_text; ?></option>
					<option value="select"<?php echo $sc['type']=='select'?' selected="selected"':''; ?>><?php echo $type_select; ?></option>
					<option value="date"<?php echo $sc['type']=='date'?' selected="selected"':''; ?>><?php echo $type_date; ?></option>
				  </select></td>
			  <td><button type="button" onclick="$(this).parent().parent().remove();" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
			</tr>
			<?php $custom_row ++; ?>
			<?php } ?>
		  </tbody>
		  <tfoot>
			<tr>
			  <td colspan="3"></td>
			  <td class="text-left" width="1%"><button type="button" onclick="addCustom<?php echo $shipping_id; ?>(<?php echo $custom_row; ?>);" data-toggle="tooltip" title="<?php echo $text_custom_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
			</tr>
		  </tfoot>
		</table>
	</div>
  </div>
  <div class="form-group">
	<label class="col-sm-2 control-label"><?php echo $entry_status; ?></label>
	<div class="col-sm-10">
	  <select name="super<?php echo $shipping_id; ?>_status" class="form-control">
		<?php if (${'super'.$shipping_id.'_status'}) { ?>
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
	<label class="col-sm-2 control-label"><?php echo $entry_sort_order; ?></label>
	<div class="col-sm-10">
	  <input type="text" name="super<?php echo $shipping_id; ?>_sort_order" value="<?php echo ${'super'.$shipping_id.'_sort_order'}; ?>" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" />
	</div>
  </div>

<script type="text/javascript"><!--
var store_row<?php echo $shipping_id; ?> = '<?php echo $store_row; ?>';

function addStore<?php echo $shipping_id; ?>() {
	var html = '<li><a href="#tab-store-<?php echo $shipping_id; ?>'+store_row<?php echo $shipping_id; ?>+'" data-toggle="tab"><i class="fa fa-minus-circle" onclick="$(\'a[href=\\\'#tab-store-<?php echo $shipping_id; ?>'+store_row<?php echo $shipping_id; ?>+'\\\']\').parent().remove(); $(\'#tab-store-<?php echo $shipping_id; ?>'+store_row<?php echo $shipping_id; ?>+'\').remove(); $(\'#store<?php echo $shipping_id; ?> a:first\').tab(\'show\')"></i> <span id="txt'+store_row<?php echo $shipping_id; ?>+'"><?php echo $text_group; ?> '+store_row<?php echo $shipping_id; ?>+'</span></a></li>';
	
	$('#store<?php echo $shipping_id; ?> > li:last-child').before(html);
	
	var html  = '<div class="tab-pane" id="tab-store-<?php echo $shipping_id; ?>'+store_row<?php echo $shipping_id; ?>+'">';
		html += '  <div class="form-group">';
		html += '    <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $text_group; ?></label>';
		html += '    <div class="col-sm-10">';
		<?php foreach ($languages as $language) { ?>
		<?php if ($language['language_id'] == $language_id) { ?>
		html += '    <div style="margin-bottom:10px;"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><input type="text" name="super<?php echo $shipping_id; ?>_store['+store_row<?php echo $shipping_id; ?>+'][name][<?php echo $language['language_id']; ?>]" value="<?php echo $text_group; ?> '+store_row<?php echo $shipping_id; ?>+'" onkeyup="$(\'#txt'+store_row<?php echo $shipping_id; ?>+'\').html($(this).val())" onblur="$(\'#txt'+store_row<?php echo $shipping_id; ?>+'\').html($(this).val())" placeholder="<?php echo $text_group; ?>" id="input-sort-order" class="form-control" /></div>';
		<?php } else { ?>
		html += '    <div style="margin-bottom:10px;"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><input type="text" name="super<?php echo $shipping_id; ?>_store['+store_row<?php echo $shipping_id; ?>+'][name][<?php echo $language['language_id']; ?>]" value="<?php echo $text_group; ?> '+store_row<?php echo $shipping_id; ?>+'" placeholder="<?php echo $text_group; ?>" id="input-sort-order" class="form-control" /></div>';
		<?php } ?>
		<?php } ?>
		html += '    </div>';
		html += '  </div>';
		html += '  <div class="table-responsive">';
		html += '    <table id="store<?php echo $shipping_id; ?>-address'+store_row<?php echo $shipping_id; ?>+'" class="table table-striped table-bordered table-hover">';
		html += '      <thead>';
		html += '        <tr>';
		html += '          <td class="text-left"><?php echo $text_store_address; ?></td>';
		html += '          <td class="text-left"><?php echo $text_store_work; ?></td>';
		html += '          <td></td>';
		html += '        </tr>';
		html += '      </thead>';
		html += '      <tbody></tbody>';
		html += '      <tfoot>';
		html += '        <tr>';
		html += '          <td colspan="2"></td>';
		html += '          <td class="text-left" width="1%"><button type="button" onclick="addAddress<?php echo $shipping_id; ?>('+store_row<?php echo $shipping_id; ?>+');" data-toggle="tooltip" title="<?php echo $text_store_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>';
		html += '        </tr>';
		html += '      </tfoot>';
		html += '    </table>';
		html += '  </div>';
		html += '</div>';
		
	$('#tab-stores-<?php echo $shipping_id; ?> .tab-content').append(html);
	$('#store<?php echo $shipping_id; ?> a[href=\'#tab-store-<?php echo $shipping_id; ?>'+store_row<?php echo $shipping_id; ?>+'\']').tab('show');
	
	store_row<?php echo $shipping_id; ?>++;
}

$('#store<?php echo $shipping_id; ?> > li:first-child a').tab('show');

var s_row<?php echo $shipping_id; ?> = '<?php echo $s_row; ?>';

function addAddress<?php echo $shipping_id; ?>(row) {
	var html  = '<tr>';
		html += '  <td class="text-left">';
		<?php foreach ($languages as $language) { ?>
		html += '  <div style="margin-bottom:10px;"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><input type="text" name="super<?php echo $shipping_id; ?>_store['+row+'][store]['+s_row<?php echo $shipping_id; ?>+'][address][<?php echo $language['language_id']; ?>]" value="" placeholder="<?php echo $text_store_address; ?>" class="form-control" /></div>';
		<?php } ?>
		html += '  </td>';
		html += '  <td class="text-left">';
		<?php foreach ($languages as $language) { ?>
		html += '  <div style="margin-bottom:10px;"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><input type="text" name="super<?php echo $shipping_id; ?>_store['+row+'][store]['+s_row<?php echo $shipping_id; ?>+'][work][<?php echo $language['language_id']; ?>]" value="" placeholder="<?php echo $text_store_work; ?>" class="form-control" /></div>';
		<?php } ?>
		html += '  </td>';
		html += '  <td class="text-left"><button type="button" onclick="$(this).parent().parent().remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
		html += '</tr>';
		
	$('#store<?php echo $shipping_id; ?>-address'+row+' tbody').append(html);
	
	s_row<?php echo $shipping_id; ?>++;
}

var custom_row<?php echo $shipping_id; ?> = '<?php echo $custom_row; ?>';

function addCustom<?php echo $shipping_id; ?>() {
	var html  = '<tr>';
		html += '  <td class="text-left" valign="top">';
		<?php foreach ($languages as $language) { ?>
		html += '  <div style="margin-bottom:10px;"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><input type="text" name="super<?php echo $shipping_id; ?>_custom['+custom_row<?php echo $shipping_id; ?>+'][name][<?php echo $language['language_id']; ?>]" value="" placeholder="<?php echo $text_custom_name; ?>" class="form-control" /></div>';
		<?php } ?>
		html += '  </td>';
		html += '  <td class="text-left">';
		<?php foreach ($languages as $language) { ?>
		html += '  <div style="margin-bottom:10px;"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><textarea name="super<?php echo $shipping_id; ?>_custom['+custom_row<?php echo $shipping_id; ?>+'][value][<?php echo $language['language_id']; ?>]" rows="5" class="form-control"></textarea></div>';
		<?php } ?>
		html += '  </td>';
		html += '  <td class="text-left">';
		html += '    <select name="super<?php echo $shipping_id; ?>_custom['+custom_row<?php echo $shipping_id; ?>+'][type]" class="form-control">';
		html += '      <option value="0"><?php echo $text_none; ?></option>';
		html += '      <option value="text"><?php echo $type_text; ?></option>';
		html += '      <option value="select"><?php echo $type_select; ?></option>';
		html += '      <option value="date"><?php echo $type_date; ?></option>';
		html += '    </select></td>';
		html += '  <td><button type="button" onclick="$(this).parent().parent().remove();" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
		html += '</tr>';
		
	$('#custom<?php echo $shipping_id; ?>').append(html);
	
	custom_row<?php echo $shipping_id; ?>++;
}
//--></script>
