<?php echo $header; ?>
<div class="container">
    <?php require( PAVO_THEME_DIR."/template/common/config_layout.tpl" );  ?>
  <?php require( PAVO_THEME_DIR."/template/common/breadcrumb.tpl" );  ?>
  <div class="row"><?php if( $SPAN[0] ): ?>
			<aside id="sidebar-left" class="col-md-<?php echo $SPAN[0];?>">
				<?php echo $column_left; ?>
			</aside>	
		<?php endif; ?> 
  
   <section id="sidebar-main" class="col-md-<?php echo $SPAN[1];?>"><div id="content" class="wrapper clearfix"><?php echo $content_top; ?>
      <h2><?php echo $heading_title; ?></h2>
      

<?php foreach ($modules as $module) { ?>
<div class="box box-normal">
<?php

	$config = $this->registry->get('config');

	$cols = 3;
	$span = 12/$cols;
?>
<div class="box-heading">
	<span><?php echo $module['title']; ?></span>
	<em class="line"></em>
</div>
<div class="box-content">
	<?php foreach ($module['product'] as $i => $product) { $i=$i+1; ?>
	
	<?php if( $i%$cols == 1 && $cols > 1 ) { ?>
	<div class="row products-row">
	<?php } ?>
		
		<?php if ($product['type'] == 'product') { ?>
		<div class="col-lg-<?php echo $span;?> col-md-<?php echo $span;?> col-sm-6 col-xs-12">
			<div class="product-block form-group item-default clearfix" itemtype="http://schema.org/Product" itemscope>
				<?php if ($product['thumb']) {    ?>
				<?php if( isset($date_available) && $date_available == date('Y-m-d')) {   ?>
				<span class="product-label ribbon label-new"><span class="product-label-new">New</span></span>
				<?php } ?>
				<div class="images col-lg-3 clearfix">
					<a class="img" itemprop="url" title="<?php echo $product['name']; ?>" href="<?php echo $product['href']; ?>">
						<img class="img-responsive" itemprop="image" src="<?php echo $product['thumb']; ?>" title="<?php echo $product['name']; ?>" alt="<?php echo $product['name']; ?>" />
					</a>
				</div>
				<?php } ?>
				
				<div class="col-lg-9 clearfix">
					<div class="gift-meta">
						<h3 class="name" itemprop="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h3>

						<?php if ($product['price']) { ?>
						<div class="price" itemtype="http://schema.org/Offer" itemscope itemprop="offers">
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
		
							<meta content="<?php // echo $this->currency->getCode(); ?>" itemprop="priceCurrency">
						</div>
						<?php } ?>
						<?php //if( isset($product['description']) ){ ?>
						<!--<p itemprop="description"><?php //echo utf8_substr( strip_tags($product['description']),0,130);?>...</p>-->
						<?php //} ?>
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
					<div class="gift-meta"><h3 class="name" itemprop="name"><?php echo $product['name']; ?></h3></div>
				</div>
			</div>
		</div>
		<?php } ?>
		
		
	<?php if( ($i%$cols == 0 || $i==count($module['product']) ) && $cols > 1 ) { ?>
	</div>
	<?php } ?>
	
	
	<?php } ?>
</div>
</div>
<?php } ?>

<div class="box box-normal">
	<?php echo $text_point_text; ?>
</div>
	  
	  
	  
      <?php echo $content_bottom; ?></div>
   </section> 
<?php if( $SPAN[2] ): ?>
	<aside id="sidebar-right" class="col-md-<?php echo $SPAN[2];?>">	
		<?php echo $column_right; ?>
	</aside>
<?php endif; ?></div>
</div>
<?php echo $footer; ?>