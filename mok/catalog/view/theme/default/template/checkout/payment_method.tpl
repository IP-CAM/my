<p class="ok_order_bottom"><span class="ok_order_note_label"><?php echo $text_comments; ?></span>
  <input name="comment" rows="" class="ok_order_note form-control" value="<?php echo $comment; ?>"/>
</p>
<?php if ($error_warning) { ?>
<div class="alert alert-warning"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
<?php } ?>
<?php if ($payment_methods) { ?>
<div class="ok_cs_box">
<div class="ok_order_title"><?php echo $text_payment_method; ?></div>
<div class="ok_pay_content weui-cells">
<?php foreach ($payment_methods as $payment_method) { ?>
<div class="weui-cell">
    <?php if ($payment_method['code'] == $code || !$code) { ?>
	<!-- 默认第一个支付方式选中 -->
    <?php $code = $payment_method['code']; ?>
    
	
	<div class="weui-cell__hd">
        <img class="ok_pay_icon" src="catalog/view/theme/default/image/<?php echo $payment_method['code']; ?>.png" title="<?php echo $payment_method['title']; ?>" alt="<?php echo $payment_method['title']; ?>"/>
    </div>
    <div class="weui-cell__bd">
        <input type="radio" name="payment_method" value="<?php echo $payment_method['code']; ?>" checked="checked" />
        <a href="javascript:;" class="ok_pay_way weui-icon-success"></a>
    </div>
	
    <?php } else { ?>
    
	
	<div class="weui-cell__hd">
        <img class="ok_pay_icon" src="catalog/view/theme/default/image/<?php echo $payment_method['code']; ?>.png" title="<?php echo $payment_method['title']; ?>" alt="<?php echo $payment_method['title']; ?>"/>
    </div>
    <div class="weui-cell__bd">
        <input type="radio" name="payment_method" value="<?php echo $payment_method['code']; ?>" />
        <a href="javascript:;" class="ok_pay_way"></a>
    </div>
	
    <?php } ?>
    
	
</div>
<?php } ?>
</div>
<?php } ?>
</div>


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
<script type="text/javascript"><!--
$('.ok_pay_content').delegate('.ok_pay_way','click',function(){
    var $this = $(this),
        $parent = $(this).parent().parent();
        $parent.siblings().find('.ok_pay_way').removeClass('weui-icon-success');
        $parent.siblings().find('input[name="payment_method"]').prop('checked',false);
            if(!$this.hasClass('weui-icon-success')){
                $this.addClass('weui-icon-success');
                $this.siblings('input[name="payment_method"]').prop('checked',true);
                $.ajax({
                    url: 'index.php?route=checkout/payment_method/save',
                    type: 'post',
                    data: $('#collapse-payment-method input[type=\'radio\']:checked, #collapse-payment-method input[type=\'checkbox\']:checked, #collapse-payment-method textarea,#collapse-payment-method input[name="comment"]'),
                    dataType: 'json',
                    beforeSend: function() {
                        //$('#button-payment-method').button('loading');
                    },
                    success: function(json) {
                        $('.alert, .text-danger').remove();

                        // 验证 账单地址必须存在,购物车必须有商品,必须有库存,商品数高于最低购买数,不存在礼品券
                        if (json['redirect']) {
                            location = json['redirect'];
                        } else if (json['error']) {
                            $('#button-payment-method').button('reset');
                            
                            // 必须提交支付方式
                            if (json['error']['warning']) {
                                $('#collapse-payment-method .panel-body').prepend('<div class="alert alert-danger">' + json['error']['warning'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                            }
                        } else {
                            $.ajax({
                                url: 'index.php?route=checkout/confirm',
                                dataType: 'html',
                                complete: function() {
                                    //$('#button-payment-method').button('reset');
                                },
                                success: function(html) {
                                    $('#collapse-checkout-confirm .panel-body').html(html);

                                    //$('#collapse-checkout-confirm').parent().find('.panel-heading .panel-title').html('<a href="#collapse-checkout-confirm" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle"><?php echo $text_checkout_confirm; ?> <i class="fa fa-caret-down"></i></a>');

                                    //$('a[href=\'#collapse-checkout-confirm\']').trigger('click');
                                },
                                error: function(xhr, ajaxOptions, thrownError) {
                                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                                }
                            });
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        // $('.ok_pop').html(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                        // $('.ok_position').show();
                        // setTimeout(function(){$('.ok_position').hide();},time)
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            }

});
//--></script>