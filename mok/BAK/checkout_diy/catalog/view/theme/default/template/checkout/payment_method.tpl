<?php if ($error_warning) { ?>
<div class="alert alert-warning"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
<?php } ?>
<?php if ($payment_methods) { ?>
<div class="ok_cs_box">
<div class="ok_order_title"><?php echo $text_payment_method; ?></div>
<?php foreach ($payment_methods as $payment_method) { ?>
<div class="weui-cell">
    <?php if ($payment_method['code'] == $code || !$code) { ?>
	<!-- 默认第一个支付方式选中 -->
    <?php $code = $payment_method['code']; ?>
    <input type="radio" name="payment_method" value="<?php echo $payment_method['code']; ?>" checked="checked" />
	
	<div class="weui-cell__hd">
        <img class="ok_pay_icon" src="catalog/view/theme/default/image/<?php echo $payment_method['code']; ?>.png" title="<?php echo $payment_method['title']; ?>" alt="<?php echo $payment_method['title']; ?>"/>
    </div>
    <div class="weui-cell__bd">
        <a href="javascript:;" class="ok_pay_way weui-icon-success"></a>
    </div>
	
    <?php } else { ?>
    <input type="radio" name="payment_method" value="<?php echo $payment_method['code']; ?>" />
	
	<div class="weui-cell__hd">
        <img class="ok_pay_icon" src="catalog/view/theme/default/image/<?php echo $payment_method['code']; ?>.png" title="<?php echo $payment_method['title']; ?>" alt="<?php echo $payment_method['title']; ?>"/>
    </div>
    <div class="weui-cell__bd">
        <a href="javascript:;" class="ok_pay_way"></a>
    </div>
	
    <?php } ?>
    
	
</div>
<?php } ?>
</div>
<?php } ?>


<p style="display:none"><strong><?php echo $text_comments; ?></strong></p>
<p style="display:none">
  <textarea name="comment" rows="8" class="form-control"><?php echo $comment; ?></textarea>
</p>
<?php if ($text_agree) { ?>
<div class="buttons">
  <div class="pull-right"><?php echo $text_agree; ?>
    <?php if ($agree) { ?>
    <input type="checkbox" name="agree" value="1" checked="checked" />
    <?php } else { ?>
    <input type="checkbox" name="agree" value="1" />
    <?php } ?>
    &nbsp;
    <input type="button" value="<?php echo $button_continue; ?>" id="button-payment-method" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary" style="display:none;"/>
  </div>
</div>
<?php } else { ?>
<div class="buttons" style="display:none;">
  <div class="pull-right">
    <input type="button" value="<?php echo $button_continue; ?>" id="button-payment-method" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary" />
  </div>
</div>
<?php } ?>
