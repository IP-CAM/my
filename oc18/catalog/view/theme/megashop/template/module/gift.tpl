<div class="box box-normal">
<?php

	$config = $this->registry->get('config');

	$cols = 4;
	$span = 12/$cols;
?>
<div class="box-heading">
	<span><?php echo $heading_title; ?></span>
	<em class="line"></em>
</div>
<style type="text/css">
.gift-meta h3.name{
	margin-bottom:7px;
}
.gift-price{
	margin-right:50px;
}
.gift-cart{
	float:right;
	width:50px;
	overflow:hidden;
}
</style>
<div class="box-content" id="gift-list<?php echo $module_id; ?>">
	<?php foreach ($products as $i => $product) { $i=$i+1; ?>
	
	<?php if( $i%$cols == 1 && $cols > 1 ) { ?>
	<div class="row products-row gift-row">
	<?php } ?>
		
		<?php if ($product['type'] == 'product') { ?>
		<div class="col-lg-<?php echo $span;?> col-md-<?php echo $span;?> col-sm-6 col-xs-12">
			<div class="product-block form-group item-default clearfix" itemtype="http://schema.org/Product" itemscope>
				<?php if ($product['thumb']) {    ?>
				<?php if( isset($date_available) && $date_available == date('Y-m-d')) {   ?>
				<span class="product-label ribbon label-new"><span class="product-label-new">New</span></span>
				<?php } ?>
				<div class="images col-lg-3 clearfix">
					<a class="img" itemprop="url" title="<?php echo $product['name']; ?>" href="<?php echo $product['href']; ?>" target="_blank">
						<img class="img-responsive" itemprop="image" src="<?php echo $product['thumb']; ?>" title="<?php echo $product['name']; ?>" alt="<?php echo $product['name']; ?>" />
					</a>
				</div>
				<?php } ?>
				
				<div class="col-lg-9 clearfix">
					<div class="gift-meta">
						<h3 class="name" itemprop="name"><a href="<?php echo $product['href']; ?>" title="<?php echo $product['name']; ?>" target="_blank"><?php echo $product['name']; ?></a></h3>
						<div class="gift-cart"">
							<?php if ($product['selected']) { ?>
							<button class="btn btn-disable pull-right btn-outline" type="button" data="<?php echo $product['product_id']; ?>" rel="del"><i class="fa fa-check"></i></button>
							<?php } else { ?>
							<button class="btn btn-disable pull-right" type="button" data="<?php echo $product['product_id']; ?>" rel="add"><i class="fa fa-check"></i></button>
							<?php } ?>
						</div>

						<?php if ($product['price']) { ?>
						<div class="gift-price price clearfix" itemtype="http://schema.org/Offer" itemscope itemprop="offers">
							<?php if (!$product['special']) {  ?>
							<span class="special-price"><?php echo $product['price']; ?></span>
							<?php if( preg_match( '#(\d+).?(\d+)#',  $product['price'], $p ) ) { ?>
							<meta content="<?php echo $p[0]; ?>" itemprop="price">
							<?php } ?>
							<?php } else { ?>
							<span class="price-new"><?php echo $product['special']; ?></span>
							<span class="price-old"><?php echo $product['price']; ?></span>
							<?php if( preg_match( '#(\d+).?(\d+)#',  $product['special'], $p ) ) { ?>
							<meta content="<?php echo $p[0]; ?>" itemprop="price">
							<?php } ?>
							<?php } ?>
						</div>
						<?php } ?>

					</div>
				</div>
			</div>
		</div>
		<?php } ?>
		
		<?php if ($product['type'] == 'discount') { ?>
		<div class="col-lg-<?php echo $span;?> col-md-<?php echo $span;?> col-sm-6 col-xs-12">
			<div class="product-block form-group item-default clearfix" itemtype="http://schema.org/Product" itemscope>
				<?php if ($product['thumb']) {    ?>
				<?php if( isset($date_available) && $date_available == date('Y-m-d')) {   ?>
				<span class="product-label ribbon label-new"><span class="product-label-new">New</span></span>
				<?php } ?>
				<div class="images col-lg-3 clearfix"><img class="img-responsive" itemprop="image" src="<?php echo $product['thumb']; ?>" title="<?php echo $product['name']; ?>" alt="<?php echo $product['name']; ?>" /></div>
				<?php } ?>
				
				<div class="col-lg-9 clearfix">
					<div class="gift-meta">
						<h3 class="name" itemprop="name"><?php echo $product['name']; ?></h3>
						<div class="gift-cart"">
							<?php if ($product['selected']) { ?>
							<button class="btn btn-disable pull-right btn-outline" type="button" data="<?php echo $product['product_id']; ?>" rel="del"><i class="fa fa-check"></i></button>
							<?php } else { ?>
							<button class="btn btn-disable pull-right" type="button" data="<?php echo $product['product_id']; ?>" rel="add"><i class="fa fa-check"></i></button>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
		
		
	<?php if( ($i%$cols == 0 || $i==count($products) ) && $cols > 1 ) { ?>
	</div>
	<?php } ?>
	
	
	<?php } ?>
</div>

<script type="text/javascript"><!--
$('#gift-list<?php echo $module_id; ?> button').on('click', function() {
	var i = $(this).attr('data');
	var t = $(this).attr('rel');
	var o = $(this);
	
	$('#gift-list<?php echo $module_id; ?> button').each(function() {
		$(this).attr('rel', 'add');
		$(this).removeClass('btn-outline');
	});
	
	o.button('loading');
	
	if (t == 'add') {
		$.ajax({
			url: 'index.php?route=module/gift/add',
			type: 'post',
			data: 'product_id=' + i,
			dataType: 'json',
			success: function(json) {
				if (json['error']) {
					var txt = json['error'].replace('%s', '<?php echo $total; ?>');
					
					alert(txt);
				
					o.button('reset');
				} else {
					o.button('reset').attr('rel', 'del').addClass('btn-outline');
				}
			}
		});
	}
	
	if (t == 'del') {
		$.ajax({
			url: 'index.php?route=module/gift/remove',
			type: 'post',
			data: 'product_id=' + i,
			dataType: 'json',
			success: function(json) {				
				o.button('reset');
			}
		});
	}
});
//--></script>
</div>