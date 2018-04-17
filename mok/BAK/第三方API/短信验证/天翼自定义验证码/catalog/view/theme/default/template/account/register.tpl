<?php echo $minheader; ?>
<div class="container" style="max-width:880px;">
	<div class="col-md-6 col-sm-6 hidden-xs" style="text-align:center;">
	<img src="catalog/view/theme/default/image/register-bg.png" class="img-responsive" alt="绵俪注册" title="绵俪注册"/>
	</div>
    <div id="min-register" class="col-md-6 col-sm-6">
	  <div class="pull-right col-lg-10 col-sm-12 col-xs-12">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal" id="email-register">
		<?php if ($error_warning) { ?>
		<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
		<?php } ?>
		<p class="min-register-welcome">
		<span class="register-login"><?php echo $text_account_already; ?></span>
		<?php echo $text_welcome; ?>
		</p>

		<div class="form-group required">
            <div class="col-sm-12">
              <input type="text" name="firstname" value="<?php echo $firstname; ?>" placeholder="<?php echo $pre_firstname; ?>" id="input-firstname" class="min-register-text form-control"/>
              <?php if ($error_firstname) { ?>
              <div class="text-danger"><?php echo $error_firstname; ?></div>
              <?php } ?>
            </div>
        </div>
		 <div class="form-group required">
            <div class="col-sm-12">
              <input type="email" name="email" value="<?php echo $email; ?>" placeholder="<?php echo $pre_email; ?>" id="input-email" class="min-register-text form-control"/>
              <?php if ($error_email) { ?>
              <div class="text-danger"><?php echo $error_email; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group required">
            <div class="col-sm-12">
              <input type="password" name="password" value="<?php echo $password; ?>" placeholder="<?php echo $pre_password; ?>" id="input-password" class="min-register-text form-control"/>
              <?php if ($error_password) { ?>
              <div class="text-danger"><?php echo $error_password; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group required">
            <div class="col-sm-12">
              <input type="password" name="confirm" value="<?php echo $confirm; ?>" placeholder="<?php echo $pre_confirm; ?>" id="input-confirm" class="min-register-text form-control"/>
              <?php if ($error_confirm) { ?>
              <div class="text-danger"><?php echo $error_confirm; ?></div>
              <?php } ?>
            </div>
          </div>
		
		<div class="form-group required">
            <div class="col-sm-12">
              <input type="text" name="captcha" id="input-captcha" style="width:100px;margin-right:20px;float:left;" class="min-register-text form-control" placeholder="<?php echo $entry_captcha; ?>"/>
			  <img src="index.php?route=tool/captcha" style="height:32px;border-radius: 3px;"/>
			<?php if ($error_captcha) { ?>
				<div class="text-danger pull-left"><?php echo $error_captcha; ?></div>
			<?php } ?>
			</div>
        </div>
		<div class="form-group">
            <div class="col-sm-12">
			<p id="email-register-change" class="pull-right">
			<?php echo $text_email_change; ?>
			</p>
              <input type="submit" value="<?php echo $button_submit; ?>" class="min-register-submit"/>
			</div>
        </div>  
        <?php if ($text_agree) { ?>
		<div class="form-group">
          <div class="col-sm-12 min-register-agree">
            <?php if ($agree) { ?>
            <input type="checkbox" name="agree" value="1" checked="checked" />
            <?php } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') { ?>
            <input type="checkbox" name="agree" value="1" />
            <?php } else { ?>
			<input type="checkbox" name="agree" value="1" checked="checked" />
			<?php } ?>
            <?php echo $text_agree; ?>
          </div>
        </div>
        <?php } ?>
		<input type="hidden" name="typesubmit" value="email-register"/>
      </form>
	  
	  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal" id="telephone-register">
		<?php if ($error_warning) { ?>
		<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
		<?php } ?>
		<p class="min-register-welcome">
		<span class="register-login"><?php echo $text_account_already; ?></span>
		<?php echo $text_welcome; ?>
		</p>
		<div class="form-group required">
            <div class="col-sm-12">
			  <p class="min-firstname-error"><?php echo $text_firstname_error; ?></p>
              <input type="text" name="firstname" value="<?php echo $firstname; ?>" placeholder="<?php echo $pre_firstname; ?>" id="input-min-firstname" class="min-register-text form-control"/>
              <?php if ($error_firstname) { ?>
              <div class="text-danger"><?php echo $error_firstname; ?></div>
              <?php } ?>
            </div>
        </div>
		<div class="form-group required">
            <div class="col-sm-12">
			<p class="min-telephone-error"><?php echo $text_telephone_error; ?></p>
              <input type="tel" name="telephone" value="<?php echo $telephone; ?>" placeholder="<?php echo $pre_telephone; ?>" id="input-min-telephone" onkeyup="this.value=this.value.replace(/[^\d]/g,'');" onafterpaste="this.value=this.value.replace(/[^\d]/g,'');" class="min-register-text form-control"/>
              <?php if ($error_telephone) { ?>
              <div class="text-danger"><?php echo $error_telephone; ?></div>
              <?php } ?>
            </div>
          </div>
		<div class="form-group required">
			<div class="col-sm-12">
			  <p class="min-password-error"><?php echo $text_password_error; ?></p>
              <input type="password" name="password" value="<?php echo $password; ?>" placeholder="<?php echo $pre_password; ?>" id="input-min-password" class="min-register-text form-control"/>
              <?php if ($error_password) { ?>
              <div class="text-danger"><?php echo $error_password; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group required">
            <div class="col-sm-12">
			  <p class="min-confirm-error"><?php echo $text_confirm_error; ?></p>
              <input type="password" name="confirm" value="<?php echo $confirm; ?>" placeholder="<?php echo $pre_confirm; ?>" id="input-min-confirm" class="min-register-text form-control"/>
              <?php if ($error_confirm) { ?>
              <div class="text-danger"><?php echo $error_confirm; ?></div>
              <?php } ?>
            </div>
          </div>
		  <div class="form-group required">
			<div class="col-sm-12">
			  <p class="min-send-success"><?php echo $text_sendsms_success; ?></p>
			  <input type="text" name="securitycode" value="<?php echo $securitycode; ?>" placeholder="<?php echo $pre_securitycode; ?>" id="input-security-code" class="min-register-text form-control" style="width:100px;margin-right:20px;float:left;"/>
			  <p class="min-register-send"><?php echo $text_sendsms; ?></p>
			  <?php if($error_securitycode) { ?>
			  <div class="text-danger" style="clear:left;"><?php echo $error_securitycode; ?></div>
			  <?php } ?>
			</div>
		  </div>
		  <div class="form-group">
            <div class="col-sm-12">
			<p id="telephone-register-change" class="pull-right">
			<?php echo $text_telephone_change; ?>
			</p>
              <input type="submit" value="<?php echo $button_submit; ?>" class="min-register-submit"/>
			</div>
        </div>
		<?php if ($text_agree) { ?>
		<div class="form-group">
          <div class="col-sm-12 min-register-agree">
            <?php if ($agree) { ?>
            <input type="checkbox" name="agree" value="1" checked="checked" />
            <?php } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') { ?>
            <input type="checkbox" name="agree" value="1" />
            <?php } else { ?>
			<input type="checkbox" name="agree" value="1" checked="checked" />
			<?php } ?>
			<?php echo $text_agree; ?>
          </div>
        </div>
        <?php } ?>
		<input type="hidden" name="typesubmit" value="telephone-register"/>
	  </form>
	  </div>

      </div>

</div> 
<script type="text/javascript"><!--

$(function(){  
 
  //判断浏览器是否支持placeholder属性
  supportPlaceholder='placeholder'in document.createElement('input'),
 
  placeholder=function(input){
 
    var text = input.attr('placeholder'),
    defaultValue = input.defaultValue;
 
    if(!defaultValue){
 
      input.val(text).addClass("phcolor");
    }
 
    input.focus(function(){
 
      if(input.val() == text){
   
        $(this).val("");
      }
    });
 
  
    input.blur(function(){
 
      if(input.val() == ""){
       
        $(this).val(text).addClass("phcolor");
      }
    });
 
    //输入的字符不为灰色
    input.keydown(function(){
		
      $(this).removeClass("phcolor");
    });
  };
 
  //当浏览器不支持placeholder属性时，调用placeholder函数
  if(!supportPlaceholder){
 
    $('input').each(function(){
 
      text = $(this).attr("placeholder");
 
      if($(this).attr("type") == "text"){
        placeholder($(this));
      }
	  if($(this).attr("type") == "email"){
        placeholder($(this));
      }
	  if($(this).attr("type") == "tel"){
        placeholder($(this));
      }
	  if($(this).attr("type") == "password"){

		if($(this).val() == ''){
		if($(this).attr("name") == "password"){
	    $(this).hide();
		html = '<input type="text" value="<?php echo $pre_password; ?>" class="min-register-text form-control min-replace"/>';
		$(this).parent().prepend(html);
        }else if($(this).attr("name") == "confirm"){
		$(this).hide();
		html = '<input type="text" value="<?php echo $pre_confirm; ?>" class="min-register-text form-control min-replace"/>';
		$(this).parent().prepend(html);
		}
		}

      }
    });
  }
 
});

$(document).ready(function(){
	<?php if($typesubmit == 'email-register'){ ?>
		$('#email-register').show();
		$('#telephone-register').hide();
	<?php }else{ ?>
		$('#email-register').hide();
		$('#telephone-register').show();
	<?php } ?>
	$('.min-replace').focus(function(){
		$(this).hide();
		$(this).parent().children('input[type=\'password\']').show().focus();
	});
	$('#email-register-change').click(function(){
		$('#email-register').hide();
		$('#telephone-register').show();
		
	});
	$('#telephone-register-change').click(function(){
		$('#email-register').show();
		$('#telephone-register').hide();
	});
	var canSend = true;
	var time = 60;
	$('.min-register-send').click(function(){
		if(!canSend){
		return;
		}else{
		var mobile = $('#input-min-telephone').val();
		reg = /^1[3458][0-9]{9}$/;
		if(!reg.test(mobile)){
		$('.min-telephone-error').fadeIn('slow');
		}else{
		$.ajax({
			url: 'index.php?route=account/register/sendsms',
			type: 'post',
			data: $('#input-min-telephone,#input-min-firstname,#input-min-password,#input-min-confirm'),
			dataType: 'json',
			beforeSend: function(){
			canSend = false;
			},
			complete: function(json){

			},
			success: function(json){
				
			if(json['error']){
				for(i in json['error']){
				$('.min-' + i + '-error').text(json['error'][i]);
				$('.min-' + i + '-error').fadeIn('slow');
				}
			}else{
		$('.min-telephone-error').fadeOut('quick');
		$('.min-send-success').fadeIn('slow');
		$('#input-security-code').focus();
		$('.min-register-send').css({
			"background-color":"#d0d0d0",
			"background-image":"none",
			"border":"1px solid #d0d0d0",
			"cursor":"not-allowed"
			});
		$('.min-register-send').html('<?php echo $text_sendsmsing; ?>');
		var hander = setInterval(function(){
			if(time <= 0){
				canSend = true;
				clearInterval(hander);
				time = 60;
				$('.min-register-send').css({
				"background-color":"#ed145b",
				"background-image":"linear-gradient(to bottom, #ff5d92, #ed145b)",
				"border":"1px solid #df074e",
				"cursor":"pointer"
				});
				$('.min-register-send').html('<?php echo $text_sendsms; ?>');
				
			}else{
				canSend = false;
				time--;
				$('.min-register-send').html('<span style=\"color:#f51973\">'+time + '</span> <?php echo $text_sendsms_again; ?>');
				
			}
		},1000);
		
			}
			//console.log(JSON.stringify(json));
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
		}
		}
	});
	$('#input-security-code').keyup(function(){
		$('.min-send-success').fadeOut('quick');
	});
	$('#input-min-firstname').keyup(function(){
		$('.min-firstname-error').fadeOut('quick');
	});
	$('#input-min-password').keyup(function(){
		$('.min-password-error').fadeOut('quick');
	});
	$('#input-min-confirm').keyup(function(){
		$('.min-confirm-error').fadeOut('quick');
	});
	
	
});
// Sort the custom fields
$('#account .form-group[data-sort]').detach().each(function() {
	if ($(this).attr('data-sort') >= 0 && $(this).attr('data-sort') <= $('#account .form-group').length) {
		$('#account .form-group').eq($(this).attr('data-sort')).before(this);
	} 
	
	if ($(this).attr('data-sort') > $('#account .form-group').length) {
		$('#account .form-group:last').after(this);
	}
		
	if ($(this).attr('data-sort') < -$('#account .form-group').length) {
		$('#account .form-group:first').before(this);
	}
});

$('#address .form-group[data-sort]').detach().each(function() {
	if ($(this).attr('data-sort') >= 0 && $(this).attr('data-sort') <= $('#address .form-group').length) {
		$('#address .form-group').eq($(this).attr('data-sort')).before(this);
	} 
	
	if ($(this).attr('data-sort') > $('#address .form-group').length) {
		$('#address .form-group:last').after(this);
	}
		
	if ($(this).attr('data-sort') < -$('#address .form-group').length) {
		$('#address .form-group:first').before(this);
	}
});

$('input[name=\'customer_group_id\']').on('change', function() {
	$.ajax({
		url: 'index.php?route=account/register/customfield&customer_group_id=' + this.value,
		dataType: 'json',
		success: function(json) {
			$('.custom-field').hide();
			$('.custom-field').removeClass('required');

			for (i = 0; i < json.length; i++) {
				custom_field = json[i];

				$('#custom-field' + custom_field['custom_field_id']).show();

				if (custom_field['required']) {
					$('#custom-field' + custom_field['custom_field_id']).addClass('required');
				}
			}
			

		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('input[name=\'customer_group_id\']:checked').trigger('change');
//--></script> 
<script type="text/javascript"><!--
$('button[id^=\'button-custom-field\']').on('click', function() {
	var node = this;

	$('#form-upload').remove();

	$('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');

	$('#form-upload input[name=\'file\']').trigger('click');

	timer = setInterval(function() {
		if ($('#form-upload input[name=\'file\']').val() != '') {
			clearInterval(timer);
			
			$.ajax({
				url: 'index.php?route=tool/upload',
				type: 'post',
				dataType: 'json',
				data: new FormData($('#form-upload')[0]),
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function() {
					$(node).button('loading');
				},
				complete: function() {
					$(node).button('reset');
				},
				success: function(json) {
					$(node).parent().find('.text-danger').remove();
					
					if (json['error']) {
						$(node).parent().find('input').after('<div class="text-danger">' + json['error'] + '</div>');
					}
	
					if (json['success']) {
						alert(json['success']);

						$(node).parent().find('input').attr('value', json['code']);
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		}
	}, 500);
});
//--></script> 
<script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});

$('.time').datetimepicker({
	pickDate: false
});

$('.datetime').datetimepicker({
	pickDate: true,
	pickTime: true
});
//--></script> 
<script type="text/javascript"><!--
$('select[name=\'country_id\']').on('change', function() {
	$.ajax({
		url: 'index.php?route=account/account/country&country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'country_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
		},
		complete: function() {
			$('.fa-spin').remove();
		},
		success: function(json) {
			if (json['postcode_required'] == '1') {
				$('input[name=\'postcode\']').parent().parent().addClass('required');
			} else {
				$('input[name=\'postcode\']').parent().parent().removeClass('required');
			}
			
			html = '<option value=""><?php echo $text_select; ?></option>';
			
			if (json['zone'] != '') {
				for (i = 0; i < json['zone'].length; i++) {
					html += '<option value="' + json['zone'][i]['zone_id'] + '"';
					
					if (json['zone'][i]['zone_id'] == '<?php echo $zone_id; ?>') {
						html += ' selected="selected"';
					}
				
					html += '>' + json['zone'][i]['name'] + '</option>';
				}
			} else {
				html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
			}
			
			$('select[name=\'zone_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('select[name=\'country_id\']').trigger('change');
//--></script>

<?php echo $minfooter; ?>