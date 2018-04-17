<?php echo $header; ?>
<?php echo $content_top; ?>

  <?php if ($attention) { ?>
  <div class="alert alert-info"><i class="fa fa-info-circle"></i> <?php echo $attention; ?></div>
  <?php } ?>
  <?php if ($success) { ?>
  <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?></div>
  <?php } ?>
  <?php if ($error_warning) { ?>
  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i><?php echo $error_warning; ?></div>
  <?php } ?>

<form action="<?php echo $action; ?>" method="post" autocomplete="off" enctype="multipart/form-data">
<div class="ok_cart_box">
	<?php foreach ($products as $product) { ?>
    <div class="weui-flex ok_cart_item ok_checked">	
        <div class="ok_cart_check"></div>
        <div class="ok_info_box weui-flex__item">
            <div class="ok_cart_img">
				<?php if (!$product['stock']) { ?>
                  <div class="ok_cart_out"><?php echo $text_out_of_stock; ?></div>
                <?php } ?>
				<?php if ($product['thumb']) { ?>
                  <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-thumbnail" width="100%"/></a>
				<?php } ?>
            </div>
            <div class="ok_cart_info">
				
                <a href="<?php echo $product['href']; ?>"><p class="ok_cart_name"><?php echo $product['name']; ?></p></a>
				
				 <!-- 商品属性问题 样式需调整 -->
                 <div class="ok_cart_version">
                    <?php if ($product['option']) { ?>
                    <?php foreach ($product['option'] as $option) { ?>
                    <span class="ok_version_item"> <?php echo $option['value']; ?></span>
                    <?php } ?>
                    <?php } ?>
                </div>
				
				 <!-- 商品的促销信息或缺
                <div class="ok_cart_discount">
                    <span class="ok_discount_coup">优惠券</span>
                    <span class="ok_discount_desc">立减<span>10</span>元</span>
                </div>
                <input type="text" name="quantity[<?php echo $product['cart_id']; ?>]" value="<?php echo $product['quantity']; ?>" size="1" class="form-control" /> -->
                
				<!-- <button type="button" data-toggle="tooltip" title="<?php echo $button_update; ?>" class="btn btn-primary" onclick="cart.update('<?php echo $product['cart_id']; ?>','<?php echo $product['quantity']+1; ?>');">加一个</button>
				<button type="button" data-toggle="tooltip" title="<?php echo $button_update; ?>" class="btn btn-primary" onclick="cart.update('<?php echo $product['cart_id']; ?>','<?php echo $product['quantity']-1; ?>');">减一个</button> -->
				
				<!-- <button type="button" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger" data-id="<?php echo $product['cart_id']; ?>">删除</button>  -->
				
                <div class="ok_price_box">
                    <span class="ok_price"><?php echo $product['price']; ?></span>
                    <span class="ok_num_option">
                        <a href="javascript:;" class="ok_num_desc" data-id="<?php echo $product['cart_id']; ?>" data-quantity="<?php echo $product['quantity']-1; ?>">-</a>
                        <input class="ok_num" type="text" data-max="100" data-min="<?php echo $product['minimum']; ?>" value="<?php echo $product['quantity']; ?>"/>
                        <a href="javascript:;" class="ok_num_asc" data-id="<?php echo $product['cart_id']; ?>" data-quantity="<?php echo $product['quantity']+1; ?>">+</a>
                    </span>
                </div>
            </div>
        </div>
        <a href="javascript:;" class="ok_cart_delete" data-id="<?php echo $product['cart_id']; ?>">
            <img src="catalog/view/theme/default/images/cart/delete.png" width="100%"/>
        </a>
    </div>
	<?php } ?>
</div>
</form>

<div class="ok_cart_tabbar">
	<!-- 选择商品功能或缺
    <div class="ok_choose_all">
        <span class="ok_text"><?php echo $text_choose_all; ?></span>
        <span class="ok_choose"></span>
    </div>
	-->
    <div class="ok_account">
		<?php if(isset($totals[0]['text'])){ ?>
        <span class="ok_total_price"><?php echo $totals[0]['text']; ?></span>
		<?php } ?>
        <a href="<?php echo $checkout; ?>" class="btn btn-primary"><span class="ok_cart_account"><?php echo $button_checkout; ?></span></a>
    </div>
</div>
<div class="ok_dialog" id="ok_dialog">
    <div class="weui-mask"></div>
    <div class="weui-dialog">
        <div class="weui-dialog__bd"><?php echo $text_delete_product; ?></div>
        <div class="weui-dialog__ft">
            <a href="javascript:;" class="weui-dialog__btn weui-dialog__btn_default"><?php echo $text_cancel; ?></a>
            <a href="javascript:;" class="weui-dialog__btn weui-dialog__btn_primary"><?php echo $text_delete; ?></a>
        </div>
    </div>
</div>
<div class="ok_position">
    <div class="ok_pop"></div>
</div>
<?php echo $column_left; ?>
<?php echo $column_right; ?>
<?php echo $content_bottom; ?>
<?php echo $footer; ?>

