<?php if (!isset($redirect)) { ?>
<div class="mobile-cart">
<?php foreach ($products as $product) { ?>
<div class="mobile-cart-item">
	<div class="mobile-cart-image"><img src="<?php echo $product['image']; ?>" style="width:100px; height:auto;" /></div>
	<div class="mobile-cart-info">
		<span><a href="<?php echo $product['href']; ?>"><strong><?php echo $product['name']; ?></strong></a></span>
		<span><?php echo $column_price; ?>: <?php echo $product['price']; ?></span>
		<span class="price"><?php echo $column_total; ?>: <?php echo $product['total']; ?></span>
	</div>
</div>
<?php } ?>
</div>
<div class="table-responsive hidden-xs">
  <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <td class="text-left"></td>
        <td class="text-left"><?php echo $column_name; ?></td>
        <td class="text-left"><?php echo $column_model; ?></td>
        <td class="text-right"><?php echo $column_quantity; ?></td>
        <td class="text-right"><?php echo $column_price; ?></td>
        <td class="text-right"><?php echo $column_total; ?></td>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($products as $product) { ?>
      <tr>
        <td class="text-left" style="width:100px;"><img src="<?php echo $product['image']; ?>" style="width:100px; height:auto;" /></td>
        <td class="text-left"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
          <?php foreach ($product['option'] as $option) { ?>
          <br />
          &nbsp;<small> - <?php echo $option['name']; ?>: <?php echo $option['value']; ?></small>
        <?php } ?>

        <?php if($product['recurring']) { ?>
          <br />
          <span class="label label-info"><?php echo $text_recurring; ?></span> <small><?php echo $product['recurring']; ?></small>
          <?php } ?></td>
        <td class="text-left"><?php echo $product['model']; ?></td>
        <td class="text-right"><?php echo $product['quantity']; ?></td>
        <td class="text-right"><?php echo $product['price']; ?></td>
        <td class="text-right"><?php echo $product['total']; ?></td>
      </tr>
      <?php } ?>
      <?php foreach ($vouchers as $voucher) { ?>
      <tr>
        <td class="text-left"><?php echo $voucher['description']; ?></td>
        <td class="text-left"></td>
        <td class="text-right">1</td>
        <td class="text-right"><?php echo $voucher['amount']; ?></td>
        <td class="text-right"><?php echo $voucher['amount']; ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<div class="form-group row">
  <div class="col-sm-6">
      <?php if ($voucher) { ?>
	  <div class="input-group radio">
		<input type="text" name="voucher" value="" placeholder="<?php echo $entry_voucher; ?>" id="input-voucher" class="form-control" />
		<span class="input-group-btn">
		<button class="btn btn-primary" onclick="confirmCode('voucher');" type="button"><i class="fa fa-check"></i></button>
		</span>
	  </div>
      <?php } ?>
	  
      <?php if ($coupon) { ?>
	  <div class="input-group radio">
		<input type="text" name="coupon" value="" placeholder="<?php echo $entry_coupon; ?>" id="input-coupon" class="form-control" />
		<span class="input-group-btn">
		<button class="btn btn-primary" onclick="confirmCode('coupon');" type="button"><i class="fa fa-check"></i></button>
		</span>
	  </div>
      <?php } ?>
	  
      <?php if ($reward) { ?>
	  <div class="input-group radio">
		<input type="text" name="reward" value="" placeholder="<?php echo $entry_reward; ?>" id="input-reward" class="form-control" />
		<span class="input-group-btn">
		<button class="btn btn-primary" onclick="confirmCode('reward');" type="button"><i class="fa fa-check"></i></button>
		</span>
	  </div>
	  <div class="radio text-success">( <?php echo $help_point; ?> )</div>
      <?php } ?>
	  
      <?php if ($point) { ?>
	  <div class="input-group radio">
		<input type="text" name="point" value="<?php echo $spoint; ?>" placeholder="<?php echo $entry_point; ?>" id="input-point" class="form-control" />
		<span class="input-group-btn">
		<button class="btn btn-primary" onclick="confirmCode('point');" type="button"><i class="fa fa-check"></i></button>
		</span>
	  </div>
	  <div class="radio text-success">( <?php echo $help_point; ?> )</div>
      <?php } ?>
  </div>
  <div class="col-sm-6">
	<div class="form-horizontal clearfix">
	  <?php foreach ($totals as $total) { ?>
	  <div class="col-xs-9 control-label"><strong><?php echo $total['title']; ?>:</strong></div>
	  <div class="col-xs-3 control-label"><?php echo $total['text']; ?></div>
	  <?php } ?>
	</div>
  </div>
</div>


<?php //echo $payment; ?>



<script type="text/javascript"><!--
function confirmCode(key) {
    $.ajax({
        url: 'index.php?route=checkout/'+key+'/'+key,
        type: 'post',
        dataType: 'json',
		data: $('#input-'+key),
        success: function(json) {
			if (json['error']) {
				alert(json['error']);
			} else {
				proConfirm('input[name=\'point\']');
			}
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
}
//--></script>



<?php } else { ?>
<script type="text/javascript"><!--
//location = '<?php echo $redirect; ?>';
//--></script>
<?php } ?>
