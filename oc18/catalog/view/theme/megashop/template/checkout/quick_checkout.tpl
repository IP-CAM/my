<?php echo $header; ?>


<?php //print_r($_SESSION); ?>



<div class="container">
    <?php require( PAVO_THEME_DIR."/template/common/config_layout.tpl" );  ?>
  <?php require( PAVO_THEME_DIR."/template/common/breadcrumb.tpl" );  ?>
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
      <div class="panel-group qcheckout" id="order-form">
		  <?php if (!$logged) { ?>
		  <div class="qcheckout-login">
			<div class="qcheckout-login-box">
			  <style type="text/css">
			      .qc-item{
				  }
				  .qc-item a{
				      display:block;
					  margin:10px;
					  padding:30px 20px;
					  text-align:center;
					  font-size:26px;
					  font-weight:bold;
					  border:1px #EEE solid;
					  cursor:pointer;
				  }
				  .qc-item a span{
				      display:block;
					  width:100%;
					  padding-top:20px;
					  font-size:14px;
					  font-weight:normal;
				  }
				  .qc-a{background:#444; color:#FFF;}
				  .qc-b{background:#FF66CC; color:#333;}
				  .qc-c{background:#0099FF; color:#333;}
			  </style>
			  <div class="qc-item col-sm-4"><a class="qc-a" href="<?php echo $register; ?>"><?php echo $text_register; ?><span><?php echo $text_register_text; ?></span></a></div>
			  <div class="qc-item col-sm-4"><a class="qc-b" href="<?php echo $login; ?>" title="<?php echo $text_login; ?>"><?php echo $text_login; ?><span><?php echo $text_login_text; ?></span></a></div>
			  <div class="qc-item col-sm-4"><a class="qc-c" onclick="qcheckout();"><?php echo $heading_title; ?><span><?php echo $text_checkout_text; ?></span></a></div>
			</div>
		  </div>
		  <?php } ?>
			<!-- shipping method start-->
			<div class="panel panel-default" id="qcheckout-start" <?php if (!$logged) { ?>style="display:none;"<?php } ?>>
			  <div class="panel-heading">
				<h4 class="panel-title"><?php echo $text_checkout_shipping_method; ?></h4>
			  </div>
			  <div class="panel-collapse" id="collapse-shipping-method">
				<div class="panel-body">
				  <div class="form-group clearfix required">
				    <label class="col-sm-2 control-label"><?php echo $text_shipping_zone; ?></label>
				    <div class="col-sm-10">
					<p><select name="country_id" id="shipping-method-country" class="form-control">
						<option value=""><?php echo $text_select; ?></option>
						<?php foreach ($countries as $country) { ?>
						<option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
						<?php } ?>
					</select></p>
					<p style="height:0px; overflow:hidden;"><select name="zone_id" id="shipping-method-zone" class="form-control">
						<option value=""><?php echo $text_select; ?></option>
						<?php foreach ($zones as $zone) { ?>
						<option value="<?php echo $zone['zone_id']; ?>"><?php echo $zone['name']; ?></option>
						<?php } ?>
					</select></p>
					</div>
				  </div>
				  <p><hr /></p>
					
				  <div id="shipping-methods"></div>
				</div>
			  </div>
			</div>
			<!-- shipping method end -->
			
			
			<!-- address start -->
			<div class="panel panel-default" style="display:none;">
			  <div class="panel-heading">
				<h4 class="panel-title"><?php echo $text_checkout_account; ?></h4>
			  </div>
			  <div class="panel-collapse" id="collapse-payment-address">
			    <div class="panel-body"></div>
			  </div>
			</div>
			<!-- address end -->
			
			
			<!-- payment method start -->
			<div class="panel panel-default" style="display:none;">
			  <div class="panel-heading">
				<h4 class="panel-title"><?php echo $text_checkout_payment_method; ?></h4>
			  </div>
			  <div class="panel-collapse" id="collapse-payment-method">
				<div class="panel-body"></div>
			  </div>
			</div>
			<!-- payment method end -->
			
			<!-- confirm start -->
			<div class="panel panel-default" style="display:none;">
			<style type="text/css">
			.buttons{
				display:none;
			}
			</style>
			  <div class="panel-heading">
				<h4 class="panel-title"><?php echo $text_checkout_confirm; ?></h4>
			  </div>
			  <div class="panel-collapse" id="collapse-checkout-confirm">
				<div class="panel-body"></div>
			  </div>
			</div>
			<!-- confirm end -->
			<div class="panel panel-default" style="display:none;">
			  <div class="panel-collapse" id="order-btn">
				<div class="panel-body">
				  <p><?php foreach ($tags as $tag) { ?>
				  <span onclick="$('#comment').val($('#comment').val() + $(this).text());" class="btn btn-link" style="border:1px #DDD solid;"><?php echo $tag; ?></span>
				  <?php } ?></p>
				  <div class="radio">
				  <textarea name="comment" id="comment" rows="5" placeholder="<?php echo $text_comments; ?>" class="form-control"></textarea>
				  <input type="hidden" id="custom" name="custom" value="" />
				  </div>
				  <div class="pull-right">
					<input type="button" value="<?php echo $button_confirm; ?>" id="addOrder" class="btn btn-outline" style="width:230px; padding:10px 12px;">
				  </div>
				</div>
			  </div>
			</div>
      </div>
      <?php echo $content_bottom; ?>
</div>
   </section> 
<?php if( $SPAN[2] ): ?>
	<aside id="sidebar-right" class="col-md-<?php echo $SPAN[2];?>">	
		<?php echo $column_right; ?>
	</aside>
<?php endif; ?></div>
</div>
<?php echo $footer; ?>
<script type="text/javascript"><!--
function qcheckout() {
	$('.qcheckout-login').hide();
	$('#qcheckout-start').show();
	$("html, body").animate({ scrollTop: 0 }, 600);
}
function shipMethod() {
	var country_id = $('select[name=\'country_id\']').val();
	var zone_id = $('select[name=\'zone_id\']').val();
	
    $('#shipping-methods').html('<img src="catalog/view/theme/megashop/image/loading.gif" />');
	$('#addOrder').button('loading');
	
    $.ajax({
        url: 'index.php?route=checkout/shipping_method&country_id='+country_id+'&zone_id='+zone_id,
        dataType: 'html',
        success: function(html) {
            $('#shipping-methods').html(html);
			
			shipAddress();
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
}

function changeShipMethod() {
	$('#addOrder').button('loading');
	
    $.ajax({
        url: 'index.php?route=checkout/shipping_method/save',
        type: 'post',
        dataType: 'json',
		data: $('input[name=\'shipping_method\']:checked'),
        success: function(json) {
			if (json['redirect']) {
                location = json['redirect'];                
            } else if (json['error']) {
				alert(json['error']['warning']);
			} else {
				shipAddress();
			}
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
}

function payMethod() {
    $('#collapse-payment-method .panel-body').html('<img src="catalog/view/theme/megashop/image/loading.gif" />');
	$('#addOrder').button('loading');
	
    $.ajax({
        url: 'index.php?route=checkout/payment_method',
        dataType: 'html',
        success: function(html) {
            $('#collapse-payment-method .panel-body').html(html);
			
			proConfirm('');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
}

function changePayMethod() {
	$('#addOrder').button('loading');
	
    $.ajax({
        url: 'index.php?route=checkout/payment_method/save',
        type: 'post',
        dataType: 'json',
		data: $('input[name=\'payment_method\']:checked'),
        success: function(json) {
			if (json['redirect']) {
                location = json['redirect'];                
            } else if (json['error']) {
				alert(json['error']['warning']);
			} else {
				payMethod();
			}
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
}

function shipAddress() {
    $('#collapse-payment-address .panel-body').html('<img src="catalog/view/theme/megashop/image/loading.gif" />');
	$('#addOrder').button('loading');
	
    $.ajax({
        url: 'index.php?route=checkout/payment_address',
        dataType: 'html',
        success: function(html) {
            $('#collapse-payment-address .panel-body').html(html);
			
			payMethod();
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
}

function proConfirm(scroll_obj) {
    $('#collapse-checkout-confirm .panel-body').html('<img src="catalog/view/theme/megashop/image/loading.gif" />');
	$('#addOrder').button('loading');
	
    $.ajax({
        url: 'index.php?route=checkout/confirm',
        dataType: 'html',
        success: function(html) {
            $('#collapse-checkout-confirm .panel-body').html(html);
			$('#addOrder').button('reset');
			
			if (scroll_obj != '') {
				$("html,body").animate({scrollTop:$(scroll_obj).parent().offset().top},500);
			}
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
}

function highlight() {
	$('.text-danger').each(function() {
		var element = $(this).parent().parent();
		
		if (element.hasClass('form-group')) {
			element.addClass('has-error');
		}
	});
}

function removeHighlight() {
	$('.text-danger').each(function() {
		$(this).remove();
	});
	
	$('.has-error').each(function() {
		$(this).removeClass('has-error');
	});
}

$(document).delegate('#shipping-methods input[name="shipping_method"]', 'click', function() {
	changeShipMethod();
});

$(document).delegate('#collapse-payment-method input[name="payment_method"]', 'click', function() {
	changePayMethod();
});

$(document).delegate('#addOrder', 'click', function() {
	$('#addOrder').button('loading');
	removeHighlight();
	
    $.ajax({
        url: 'index.php?route=checkout/quick_checkout/order',
		type: 'post',
        dataType: 'json',
		data: $('#order-form input[type=\'text\'], #order-form input[type=\'date\'], #order-form input[type=\'datetime-local\'], #order-form input[type=\'time\'], #order-form input[type=\'password\'], #order-form input[type=\'hidden\'], #order-form input[type=\'checkbox\']:checked, #order-form input[type=\'radio\']:checked, #order-form textarea, #order-form select, #comment'),
        success: function(json) {
			if (json['redirect']) {
				location = json['redirect'];
			}
			
			if (json['error']) {				
				for (var i in json['error']) {
					if (i == 'country') {
						$('#shipping-method-country').parent().after('<div class="text-danger">'+json['error'][i]+'</div>');
					}
					
					if (i == 'zone') {
						$('#shipping-method-zone').parent().after('<div class="text-danger">'+json['error'][i]+'</div>');
					}
					
					if (i == 'email') {
						$('#input-payment-email').after('<div class="text-danger">'+json['error'][i]+'</div>');
					}
					
					if (i == 'telephone') {
						$('#input-payment-telephone').after('<div class="text-danger">'+json['error'][i]+'</div>');
					}
					
					if (i == 'address_1') {
						$('#input-ship-address-1').after('<div class="text-danger">'+json['error'][i]+'</div>');
					}
					
					if (i == 'postcode') {
						$('#input-payment-postcode').after('<div class="text-danger">'+json['error'][i]+'</div>');
					}
					
					if (i == 'firstname') {
						$('#input-payment-firstname').after('<div class="text-danger">'+json['error'][i]+'</div>');
					}
					
					if (i.indexOf('custom_field') == 0) {
						var t = 'custom_field';
						var j = i.substring(t.length);
						
						$('#input-payment-custom-field'+j).after('<div class="text-danger">'+json['error'][i]+'</div>');
					}
					
					$("html,body").animate({scrollTop:$(".text-danger").parent().offset().top},500);
				}
				
				highlight();
				
				$('#addOrder').button('reset');
			}
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

$(document).ready(function() {
});
--></script>
<script type="text/javascript"><!--
$('#collapse-shipping-method select[name=\'country_id\']').on('change', function() {
	if (this.value != '') {			
		$.ajax({
			url: 'index.php?route=checkout/checkout/country&country_id=' + this.value,
			dataType: 'json',
			beforeSend: function() {
				$('#collapse-shipping-method select[name=\'country_id\']').after('<i class="fa fa-circle-o-notch fa-spin"></i>');
			},
			complete: function() {
				$('.fa-spin').remove();
			},
			success: function(json) {
				$('.fa-spin').remove();
	
				html = '<option value=""><?php echo $text_select; ?></option>';
	
				if (json['zone'] != '') {
					for (i = 0; i < json['zone'].length; i++) {
						html += '<option value="' + json['zone'][i]['zone_id'] + '">' + json['zone'][i]['name'] + '</option>';
					}
					
					$('#collapse-shipping-method select[name=\'zone_id\']').parent().attr('style', '');
					
					$('#shipping-methods').hide();
					$('#collapse-payment-address').parent().hide();
					$('#collapse-payment-method').parent().hide();
					$('#collapse-checkout-confirm').parent().hide();
					$('#order-btn').parent().hide();
				} else {
					html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
					
					$('#collapse-shipping-method select[name=\'zone_id\']').parent().attr('style', 'height:0px; overflow:hidden;');
					
					$('#shipping-methods').show();
					$('#collapse-payment-address').parent().show();
					$('#collapse-payment-method').parent().show();
					$('#collapse-checkout-confirm').parent().show();
					$('#order-btn').parent().show();
				
					shipMethod();
				}
	
				$('#collapse-shipping-method select[name=\'zone_id\']').html(html);
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	} else {
		$('#collapse-shipping-method select[name=\'zone_id\']').parent().attr('style', 'height:0px; overflow:hidden;');
	}
});

$('#collapse-shipping-method select[name=\'zone_id\']').on('change', function() {
	if (this.value != '') {
		$('#shipping-methods').show();
		$('#collapse-payment-address').parent().show();
		$('#collapse-payment-method').parent().show();
		$('#collapse-checkout-confirm').parent().show();
		$('#order-btn').parent().show();
					
		shipMethod();
	}
});
//--></script>