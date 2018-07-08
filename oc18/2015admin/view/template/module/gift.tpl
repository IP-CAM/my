<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-gift" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-gift" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?></label>
            <div class="col-sm-10">
              <input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
              <?php if ($error_name) { ?>
              <div class="text-danger"><?php echo $error_name; ?></div>
              <?php } ?>
            </div>
          </div>
		  <?php foreach ($languages as $language) { ?>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-title<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $entry_title; ?></label>
            <div class="col-sm-10">
              <input type="text" name="title[<?php echo $language['language_id']; ?>]" value="<?php echo isset($title[$language['language_id']])?$title[$language['language_id']]:''; ?>" placeholder="<?php echo $entry_title; ?>" id="input-title<?php echo $language['language_id']; ?>" class="form-control" />
            </div>
          </div>
		  <?php } ?>
		  <div class="form-group">
			<label class="col-sm-2 control-label" for="input-total"><span data-toggle="tooltip" title="" data-original-title="<?php echo $help_total?>"><?php echo $entry_total; ?></span></label>
			<div class="col-sm-10">
			  <input type="text" name="total" value="<?php echo $total; ?>" placeholder="<?php echo $entry_total; ?>" id="input-total" class="form-control" />
			</div>
		  </div>
		  <div class="form-group required">
			<label class="col-sm-2 control-label" for="input-product"><?php echo $entry_product; ?></label>
			<div class="col-sm-10">
			  <input type="text" name="product" value="" placeholder="<?php echo $entry_product; ?>" data="" id="input-product" class="form-control" />
			  <div id="gift-product" class="well well-sm" style="height: 150px; overflow: auto;">
				<?php foreach ($products as $product) { ?>
				<div id="gift-product<?php echo $product['product_id']; ?>"><i class="fa fa-minus-circle"></i> <span class="breadcrumb"><img src="<?php echo $product['image']; ?>" /></span> <?php echo $product['name']; ?> <span class="breadcrumb text-danger"><?php echo $product['price']; ?></span><input type="text" name="product[<?php echo $product['product_id']; ?>][price]" value="<?php echo $product['newprice']; ?>" size="1" />
				</div>
				<?php } ?>
			  </div>
			</div>
		  </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-discount"><?php echo $entry_discount; ?></label>
            <div class="col-sm-10">
				<?php $row = 0; ?>
				<?php foreach ($discounts as $discount) { ?>
				<div style="padding:10px; margin-bottom:20px; border:1px #DDD solid; overflow:hidden;">
					<div class="col-sm-2"><a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $discount['thumb']; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a><input type="hidden" name="discount[<?php echo $row; ?>][image]" value="<?php echo $discount['image']; ?>" id="input-image" /></div>
					<div class="col-sm-2"><?php echo $entry_type; ?><br />
					  <select name="discount[<?php echo $row; ?>][type]" class="form-control">
						<?php if ($discount['type'] == 'F') { ?>
						<option value="F" selected="selected"><?php echo $text_amount; ?></option>
						<?php } else { ?>
						<option value="F"><?php echo $text_amount; ?></option>
						<?php } ?>
						<?php if ($discount['type'] == 'P') { ?>
						<option value="P" selected="selected"><?php echo $text_percent; ?></option>
						<?php } else { ?>
						<option value="P"><?php echo $text_percent; ?></option>
						<?php } ?>
					  </select></div>
					<div class="col-sm-2"><?php echo $entry_discount; ?><br /><input type="text" name="discount[<?php echo $row; ?>][amount]" value="<?php echo $discount['amount']; ?>" class="form-control" /></div>
					<div class="col-sm-5">
						<?php echo $entry_title; ?><br />
						<?php foreach ($languages as $language) { ?>
						<div style="position:relative; margin-bottom:3px;">
							<span style="position:absolute; left:5px; top:7px;">
								<img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" />
							</span>
							<input type="text" name="discount[<?php echo $row; ?>][name][<?php echo $language['language_id']; ?>]" value="<?php echo isset($discount['name'][$language['language_id']])?$discount['name'][$language['language_id']]:''; ?>" class="form-control" style="padding-left:25px;" /></div>
						<?php } ?>
					</div>
					<div class="col-sm-1"><a class="btn btn-primary" onclick="$(this).parent().parent().remove();"><?php echo $button_remove; ?></a></div>
				</div>
				<?php $row++; ?>
				<?php } ?>
				<div id="discount"><button type="button" form="form-gift" class="btn btn-primary" onclick="addDiscount();">增加一条优惠</button></div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-limit"><?php echo $entry_limit; ?></label>
            <div class="col-sm-10">
              <input type="text" name="limit" value="<?php echo $limit; ?>" placeholder="<?php echo $entry_limit; ?>" id="input-limit" class="form-control" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-width"><?php echo $entry_width; ?></label>
            <div class="col-sm-10">
              <input type="text" name="width" value="<?php echo $width; ?>" placeholder="<?php echo $entry_width; ?>" id="input-width" class="form-control" />
              <?php if ($error_width) { ?>
              <div class="text-danger"><?php echo $error_width; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-height"><?php echo $entry_height; ?></label>
            <div class="col-sm-10">
              <input type="text" name="height" value="<?php echo $height; ?>" placeholder="<?php echo $entry_height; ?>" id="input-height" class="form-control" />
              <?php if ($error_height) { ?>
              <div class="text-danger"><?php echo $error_height; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="status" id="input-status" class="form-control">
                <?php if ($status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
<script type="text/javascript"><!--
var row = <?php echo $row; ?>;

function addDiscount() {
	var html = '';
		html += '<div style="padding:10px 0; margin-bottom:20px; border:1px #DDD solid; overflow:hidden;">';
		html += '  <div class="col-sm-2"><a href="" id="thumb-image'+row+'" data-toggle="image" class="img-thumbnail"><img src="<?php echo $placeholder; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a><input type="hidden" name="discount['+row+'][image]" value="" id="input-image'+row+'" /></div>';
		html += '  <div class="col-sm-2"><?php echo $entry_type; ?><br /><select name="discount['+row+'][type]" class="form-control"><option value="F"><?php echo $text_amount; ?></option><option value="P"><?php echo $text_percent; ?></option></select></div>';
		html += '  <div class="col-sm-2"><?php echo $entry_discount; ?><br /><input type="text" name="discount['+row+'][amount]" value="" class="form-control" /></div>';
		html += '  <div class="col-sm-5">';
		html += '    <?php echo $entry_title; ?><br />';
		<?php foreach ($languages as $language) { ?>
		html += '    <div style="position:relative; margin-bottom:3px;">';
		html += '        <span style="position:absolute; left:5px; top:7px;"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>';
		html += '        <input type="text" name="discount['+row+'][name][<?php echo $language['language_id']; ?>]" value="" class="form-control" style="padding-left:25px;" />';
		html += '    </div>';
		<?php } ?>
		
		html += '  </div>';
		html += '  <div class="col-sm-1"><a class="btn btn-primary" onclick="$(this).parent().parent().remove();"><?php echo $button_remove; ?></a></div>';
		html += '</div>';
	
	$('#discount').before(html);
	
	row ++;
}

$('input[name=\'product\']').autocomplete({
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&size=30&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['product_id'],
						image: item['image'],
						price: item['price']
					}
				}));
			}
		});
	},
	select: function(item) {
		$(this).val('');
		
		$('#gift-product' + item['value']).remove();
		
		$('#gift-product').append('<div id="gift-product' + item['value'] + '"><i class="fa fa-minus-circle"></i> <span class="breadcrumb"><img src="' + item['image'] + '" /></span>' + item['label'] + '<span class="breadcrumb text-danger">' + item['price'] + '</span><input type="text" name="product[' + item['value'] + '][price]" value="" size="1" /></div>');	
	}
});
	
$('#gift-product').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});
//--></script>
</div>
<?php echo $footer; ?>