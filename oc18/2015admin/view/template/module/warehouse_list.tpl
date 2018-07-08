<table class="table table-bordered table-hover">
  <thead>
	<tr>
	  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
	  <td class="text-left"><?php echo $column_name; ?></td>
	  <td width="70%" class="text-left"><?php echo $column_address; ?></td>
	  <td width="10%" class="text-right"><?php echo $column_action; ?></td>
	</tr>
  <tbody>
  	<?php if ($warehouses) { ?>
  	<?php foreach ($warehouses as $warehouse) { ?>
    <tr<?php if ($warehouse['default']) { echo ' style="font-weight:bold;"'; } ?>>
	  <td><input type="checkbox" name="selected[]" value="<?php echo $warehouse['warehouse_id']; ?>" /></td>
	  <td class="text-left"><small style="font-size:11px; color:#3366CC;">(<?php echo $warehouse['code']; ?>)</small> <?php echo $warehouse['name']; ?></td>
	  <td class="text-left"><?php echo $warehouse['address']; ?></td>
	  <td class="text-right">
	  	<button class="btn btn-primary" onclick="edit(<?php echo $warehouse['warehouse_id']; ?>);"><i class="fa fa-pencil"></i></button>
	  </td>
	</tr>
	<?php } ?>
	<?php } else { ?>
    <tr>
	  <td colspan="4" class="text-center">no data.</td>
	</tr>
	<?php } ?>
  </tbody>
</table>
<div class="row">
<div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
<div class="col-sm-6 text-right"><b><?php echo $pagetext; ?></b></div>
</div>