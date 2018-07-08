<?php echo $header; ?>
<div class="container">
    <?php require( PAVO_THEME_DIR."/template/common/config_layout.tpl" );  ?>
  <?php require( PAVO_THEME_DIR."/template/common/breadcrumb.tpl" );  ?>
  <?php if ($attention) { ?>
  <div class="alert alert-info"><i class="fa fa-info-circle"></i> <?php echo $attention; ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
  <?php } ?>
  <?php if ($success) { ?>
  <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
  <?php } ?>
  <?php if ($error_warning) { ?>
  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
  <?php } ?>
  <div class="row"><?php if( $SPAN[0] ): ?>
			<aside id="sidebar-left" class="col-md-<?php echo $SPAN[0];?>">
				<?php echo $column_left; ?>
			</aside>	
		<?php endif; ?> 
  
   <section id="sidebar-main" class="col-md-<?php echo $SPAN[1];?>"><div id="content" class="wrapper clearfix"><?php echo $content_top; ?>
      <h1><?php echo $heading_title; ?>
        <?php if ($weight) { ?>
        &nbsp;(<?php echo $weight; ?>)
        <?php } ?>
      </h1>
      <div class="mobile-cart">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
	  	<?php foreach ($products as $product) { ?>
		<div class="mobile-cart-item">
			<div class="mobile-cart-image"><?php if ($product['thumb']) { ?><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-thumbnail" /></a><?php } ?></div>
			<div class="mobile-cart-info">
				<span><a href="<?php echo $product['href']; ?>"><strong><?php echo $product['name']; ?></strong></a></span>
				<span><?php echo $column_price; ?>: <?php echo $product['price']; ?></span>
				<span class="price"><?php echo $column_total; ?>: <?php echo $product['total']; ?></span>
			</div>
			<div class="mobile-cart-qty">
                    <span class="quantity-adder mobile-cart-input">
						<div class="quantity-number input-group pull-left">
							<span class="add-down add-action input-group-addon"><i class="fa fa-minus"></i></span>
							<input type="text" name="quantity[<?php echo $product['key']; ?>]" value="<?php echo $product['quantity']; ?>" size="1" class="form-control" />
							<span class="add-up add-action input-group-addon"><i class="fa fa-plus"></i></span>
						</div>
					</span>
                    <span class="mobile-cart-btn">
						<!--<button type="submit" data-toggle="tooltip" title="<?php echo $button_update; ?>" class="btn btn-outline"><i class="fa fa-refresh"></i></button>-->
						<button type="button" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-inverse" onclick="cart.remove('<?php echo $product['key']; ?>');"><i class="fa fa-times-circle"></i></button>
					</span>
			</div>
		</div>
		<?php } ?>
	  </form>
	  </div>
      <div class="table-responsive hidden-xs">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
          <table class="table table-bordered">
            <thead>
              <tr>
                <td class="text-center"><?php echo $column_image; ?></td>
                <td class="text-left"><?php echo $column_name; ?></td>
                <td class="text-left"><?php echo $column_model; ?></td>
                <td class="text-left"><?php echo $column_quantity; ?></td>
                <td class="text-right"><?php echo $column_price; ?></td>
                <td class="text-right"><?php echo $column_total; ?></td>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($products as $product) { ?>
              <tr>
                <td class="text-center" style="width:100px;"><?php if ($product['thumb']) { ?>
                  <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-thumbnail" style="width:100px; height:auto;" /></a>
                  <?php } ?></td>
                <td class="text-left"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
                  <?php if (!$product['stock']) { ?>
                  <span class="text-danger">***</span>
                  <?php } ?>
                  <?php if ($product['option']) { ?>
                  <?php foreach ($product['option'] as $option) { ?>
                  <br />
                  <small><?php echo $option['name']; ?>: <?php echo $option['value']; ?></small>
                  <?php } ?>
                  <?php } ?>
                  <?php if ($product['reward']) { ?>
                  <br />
                  <small><?php echo $product['reward']; ?></small>
                  <?php } ?>
                  <?php if ($product['recurring']) { ?>
                  <br />
                  <span class="label label-info"><?php echo $text_recurring_item; ?></span> <small><?php echo $product['recurring']; ?></small>
                  <?php } ?></td>
                <td class="text-left"><?php echo $product['model']; ?></td>
                <td class="text-left"><div class="quantity-adder input-group btn-block input-checkout-cart" style="max-width: 200px;">
					<div class="quantity-number input-group pull-left">
						<span class="add-down add-action input-group-addon"><i class="fa fa-minus"></i></span>
						<input type="text" name="quantity[<?php echo $product['key']; ?>]" value="<?php echo $product['quantity']; ?>" size="1" class="form-control" />
						<span class="add-up add-action input-group-addon"><i class="fa fa-plus"></i></span>
					</div>
                    <span class="input-group-btn">
                    <!--<button type="submit" data-toggle="tooltip" title="<?php echo $button_update; ?>" class="btn btn-outline"><i class="fa fa-refresh"></i></button>-->
                    <button type="button" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-inverse" onclick="cart.remove('<?php echo $product['key']; ?>');"><i class="fa fa-times-circle"></i></button></span></div></td>
                <td class="text-right"><?php echo $product['price']; ?></td>
                <td class="text-right"><?php echo $product['total']; ?></td>
              </tr>
              <?php } ?>
              <?php foreach ($vouchers as $vouchers) { ?>
              <tr>
                <td></td>
                <td class="text-left"><?php echo $vouchers['description']; ?></td>
                <td class="text-left"></td>
                <td class="text-left"><div class="input-group btn-block" style="max-width: 200px;">
                    <input type="text" name="" value="1" size="1" disabled="disabled" class="form-control" />
                    <span class="input-group-btn"><button type="button" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-inverse" onclick="voucher.remove('<?php echo $vouchers['key']; ?>');"><i class="fa fa-times-circle"></i></button></span></div></td>
                <td class="text-right"><?php echo $vouchers['amount']; ?></td>
                <td class="text-right"><?php echo $vouchers['amount']; ?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
      </form>
      </div>
      <br />
      <div class="row">
        <div class="col-sm-4 col-sm-offset-8">
          <table class="table table-bordered">
            <?php foreach ($totals as $total) { ?>
            <tr>
              <td class="text-right"><strong><?php echo $total['title']; ?>:</strong></td>
              <td class="text-right"><?php echo $total['text']; ?></td>
            </tr>
            <?php } ?>
          </table>
        </div>
      </div>
      <div class="buttons" style="clear:both; overflow:hidden; margin-bottom:35px;">
        <div class="pull-left"><a href="<?php echo $continue; ?>" class="btn btn-default"><?php echo $button_shopping; ?></a></div>
        <div class="pull-right"><a class="btn btn-outline ckbtn" style="width:150px; padding:10px 12px;"><i class="fa fa-check"></i> <?php echo $button_checkout; ?></a></div>
      </div>
      <?php echo $content_bottom; ?>
	  <?php if ($content_bottom) { ?>
      <div class="buttons" style="clear:both; overflow:hidden; margin-bottom:35px;">
        <div class="pull-right"><a class="btn btn-outline ckbtn" style="width:150px; padding:10px 12px;"><?php echo $button_checkout; ?></a></div>
	  </div>
	  <?php } ?>
	  </div>
   </section> 
<?php if( $SPAN[2] ): ?>
	<aside id="sidebar-right" class="col-md-<?php echo $SPAN[2];?>">	
		<?php echo $column_right; ?>
	</aside>
<?php endif; ?></div>
</div>

<script type="text/javascript"><!--
$('.ckbtn').on('click', function() {
	var selected = false;
	
	$('.gift-cart button').each(function() {		
		if ($(this).attr('rel') == 'del') {
			selected = true;
		}
	});
	
	if (selected == false) {
		$.ajax({
			url: 'index.php?route=module/gift/vat',
			dataType: 'json',
			success: function(json) {
				if (!json['msg'] || !confirm(json['msg'])) {
					location = '<?php echo $checkout; ?>';
				}
			}
		});
	} else {
		location = '<?php echo $checkout; ?>';
	}
});
</script>
<?php echo $footer; ?> 