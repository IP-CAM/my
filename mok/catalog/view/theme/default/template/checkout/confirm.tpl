<?php if (!isset($redirect)) { ?>

<div class="ok_cs_box">
    <div class="ok_order_title"><?php echo $text_order_details; ?></div>
    <div class="ok_order_content weui-cells">
		<?php foreach ($products as $product) { ?>
        <div class="weui-cell">
            <div class="weui-cell__hd">
                <img src="<?php echo $product['thumb']; ?>" width="100%"/>
            </div>
            <div class="weui-cell__bd">
                <div class="ok_order_info">
                    <p class="ok_order_name"><span class="ok_product_name"><?php echo $product['name']; ?></span><i>x</i><span class="ok_gift_num"><?php echo $product['quantity']; ?></span> </p>
                    <p class="ok_order_version">
					<?php foreach ($product['option'] as $option) { ?>
						<!-- <span>- <?php echo $option['name']; ?>: <?php echo $option['value']; ?></span> -->
                        <span><?php echo $option['value']; ?></span>
					<?php } ?>
                    </p>
                </div>
                <p class="ok_order_price"><?php echo $product['price']; ?></p>
            </div>
        </div>
		<?php } ?>
    </div>
</div>
<div class="ok_cs_box">
    <div class="ok_order_title"><?php echo $text_totals; ?></div>
    <div class="ok_item_content weui-cells">
		<?php foreach ($totals as $key => $total) { ?>
			<?php if($key != count($totals) - 1){ ?>
        <div class="weui-cell">
            <div class="weui-cell__hd">
                <p class="ok_order_item"><?php echo $total['title']; ?></p>
            </div>
            <div class="weui-cell__bd">
                <p class="ok_item_price"><?php echo $total['text']; ?></p>
            </div>
			<?php }else{ ?>
			<div class="ok_order_bottom ok_total_box">
				<span class="ok_total"><?php echo $total['title']; ?></span>
				<span class="ok_total_price"><?php echo $total['text']; ?></span>
			</div>
			<?php } ?>
        </div>
		<?php } ?>
    </div>
</div>

<div class="ok_bottom weui-flex">
	<?php if(isset($totals[count($totals)-1]['text'])){ ?>
    <a href="javascript:;" class="ok_bottom_price weui-flex__item"><?php echo $text_should_payment; ?> <?php echo $totals[count($totals)-1]['text'];?></a>
	<?php } ?>
    <a href="javascript:void(0);" class="ok_bottom_pay weui-flex__item"><?php echo $text_confirm_payment; ?></a>
</div>

<?php echo $payment; ?>
<?php } else { ?>
<script type="text/javascript"><!--
location = '<?php echo $redirect; ?>';
//--></script>
<?php } ?>
<script type="text/javascript"><!--
$('.ok_bottom_pay').click(function(){
    $('#button-confirm').trigger('click');
});
//--></script>
