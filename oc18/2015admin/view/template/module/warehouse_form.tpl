<div class="form-horizontal">
	<div class="form-group required">
		<label class="col-sm-2 control-label" for="input-code"><?php echo $entry_code; ?></label>
		<div class="col-sm-10">
		  <input type="text" name="code" value="<?php echo $code; ?>" placeholder="<?php echo $entry_code; ?>" id="input-code" class="form-control" />
		</div>
	</div>
	<div class="form-group required">
		<label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?></label>
		<div class="col-sm-10">
		  <input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
		</div>
	</div>
	<div class="form-group required">
		<label class="col-sm-2 control-label" for="input-address"><?php echo $entry_address; ?></label>
		<div class="col-sm-10">
		  <input type="text" name="address" value="<?php echo $address; ?>" placeholder="<?php echo $entry_address; ?>" id="input-address" class="form-control" />
		</div>
	</div>
	<div class="form-group required">
		<label class="col-sm-2 control-label" for="input-phone"><?php echo $entry_phone; ?></label>
		<div class="col-sm-10">
		  <input type="text" name="phone" value="<?php echo $phone; ?>" placeholder="<?php echo $entry_phone; ?>" id="input-phone" class="form-control" />
		</div>
	</div>
	<div class="form-group required">
		<label class="col-sm-2 control-label" for="input-email"><?php echo $entry_email; ?></label>
		<div class="col-sm-10">
		  <input type="text" name="email" value="<?php echo $email; ?>" placeholder="<?php echo $entry_email; ?>" id="input-email" class="form-control" />
		</div>
	</div>
	<div class="form-group required">
		<label class="col-sm-2 control-label" for="input-area"><?php echo $entry_area; ?></label>
		<div class="col-sm-10">
              <div class="well well-sm" style="height: 150px; overflow: auto;">
                <?php foreach ($countries as $country) { ?>
                <div class="checkbox">
					<label>
					  <?php if (in_array($country['country_id'], $area)) { ?>
					  <input type="checkbox" name="area[]" value="<?php echo $country['country_id']; ?>" checked="checked" />
					  <?php echo $country['name']; ?>
					  <?php } else { ?>
					  <input type="checkbox" name="area[]" value="<?php echo $country['country_id']; ?>" />
					  <?php echo $country['name']; ?>
					  <?php } ?>
					</label>
                </div>
                <?php } ?>
              </div>
		</div>
	</div>
	<div class="form-group required">
		<label class="col-sm-2 control-label" for="input-area"><?php echo $entry_priority; ?></label>
		<div class="col-sm-10">
			<?php foreach ($warehouses as $key => $warehouse) { ?>
				<div class="form-group required">
					<div class="col-sm-1">
						<input type="text" name="other_warehouses[<?php echo $key; ?>][priority]" value="<?php echo $warehouse['priority']?$warehouse['priority']:0; ?>" class="form-control" />
					</div>
					<div class="col-sm-11">
						<?php echo $warehouse['name']; ?> (<?php echo $warehouse['code']; ?>)
						<input type="hidden" name="other_warehouses[<?php echo $key; ?>][spare_id]" value="<?php echo $warehouse['warehouse_id']; ?>" />
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
	<div class="form-group required">
		<label class="col-sm-2 control-label" for="input-default"><?php echo $entry_default; ?></label>
		<div class="col-sm-10">
			<select name="default" class="form-control">
				<?php if ($default) { ?>
				<option value="1" selected="selected"><?php echo $text_yes; ?></option>
				<option value="0"><?php echo $text_no; ?></option>
				<?php } else { ?>
				<option value="1"><?php echo $text_yes; ?></option>
				<option value="0" selected="selected"><?php echo $text_no; ?></option>
                <?php } ?>
			</select>
		</div>
	</div>
	<?php if ($warehouse_id) { ?>
		<input type="hidden" name="warehouse_id" value="<?php echo $warehouse_id; ?>" />
	<?php } ?>
	<div class="buttons">
		<button type="button" class="btn btn-primary" onclick="save();"><?php echo $button_save; ?></button>
		<span class="btn btn-default" onclick="list(1);"><?php echo $button_cancel; ?></span>
	</div>
</div>