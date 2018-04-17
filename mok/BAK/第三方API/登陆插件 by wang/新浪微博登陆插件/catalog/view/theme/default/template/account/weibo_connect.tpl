<?php echo $header; ?>
<div class="connect-bg">
<div class="container connect" style="max-width:990px;">
<div class="col-sm-3 connect-side">
<div class="connect-logo">
	<?php if ($logo) { ?>
		<a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive turncenter" /></a>
    <?php } else { ?>
		<h1><a href="<?php echo $home; ?>"><?php echo $name; ?></a></h1>
    <?php } ?> 
</div>
<div class="connect-welcome">
<img src="<?php echo $nickimage; ?>" style="margin-right:10px;float:left;width:50px;height:50px;"/>
<p><?php echo $text_welcome; ?></p>
</div>
</div>

<div class="col-sm-9 connect-content" style="border-left:1px solid #E1E9EE;">
<div class="connect-content-welcome hidden-xs">
<img src="catalog/view/theme/default/image/connect-bg-weibo.jpg" alt="bg" class="img-responsive"/>
<p>
<?php echo $text_welcome_description; ?>
</p>
</div>
<?php if ($error_warning) { ?>
<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
<?php } ?>
<div class="connect-tab">
<span class="connect-tab-change connect-bind-change"><?php echo $entry_binding; ?></span>
<span class="connect-tab-change connect-register-change"><?php echo $entry_create; ?></span>
</div>

	<div class="col-sm-12 connect-register">
	<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="create" class="form-horizontal">
    <div class="col-md-6 col-sm-9" style="float:none;margin:0 auto;*width:340px;">
		<div class="form-group">
			<div class="col-sm-12">
			<input type="text" name="firstname" value="<?php echo $firstname; ?>" placeholder="<?php echo $entry_firstname; ?>" id="input-firstname" class="min-register-text form-control" />
            <?php if ($error_firstname) { ?>
            <div class="text-danger"><?php echo $error_firstname; ?></div>
            <?php } ?>
			</div>
        </div>
		<div class="form-group">
            <div class="col-sm-12">
              <input type="tel" name="telephone" value="<?php echo $telephone; ?>" placeholder="<?php echo $entry_telephone; ?>" id="input-telephone" class="min-register-text form-control" />
              <?php if ($error_telephone) { ?>
              <div class="text-danger"><?php echo $error_telephone; ?></div>
              <?php } ?>
            </div>
        </div>
		<div class="form-group">
            <div class="col-sm-12">
              <input type="email" name="email" value="<?php echo $email; ?>" placeholder="<?php echo $entry_email; ?>" id="input-email" class="min-register-text form-control" />
              <?php if ($error_email) { ?>
              <div class="text-danger"><?php echo $error_email; ?></div>
              <?php } ?>
            </div>
        </div>
		<div class="form-group">
            <div class="col-sm-12">
              <input type="password" name="password" value="<?php echo $password; ?>" placeholder="<?php echo $entry_password; ?>" id="input-password" class="min-register-text form-control" />
              <?php if ($error_password) { ?>
              <div class="text-danger"><?php echo $error_password; ?></div>
              <?php } ?>
            </div>
        </div>
		<div class="form-group">
            <div class="col-sm-12">
              <input type="password" name="confirm" value="<?php echo $confirm; ?>" placeholder="<?php echo $entry_confirm; ?>" id="input-confirm" class="min-register-text form-control" />
              <?php if ($error_confirm) { ?>
              <div class="text-danger"><?php echo $error_confirm; ?></div>
              <?php } ?>
            </div>
        </div>
		<div class="form-group">
		  <div class="col-sm-12">
		  <input type="hidden" name="weibo_uid" value="<?php echo $weibo_uid; ?>" />
		  <input type="submit" value="<?php echo $button_register; ?>" class="connect-submit" style="width:100%;*width:276px;">
		  </div>
		</div>	
	</div>
	</form>
	</div>	
	
	<div class="col-sm-12 connect-bind">
	<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="bind" class="form-horizontal">
		<div class="col-md-6 col-sm-9" style="float:none;margin:0 auto;*width:340px;">
		  <div class="form-group">
            <div class="col-sm-12">
              <input type="text" name="bind_email" value="<?php echo $bind_email; ?>" placeholder="<?php echo $entry_bind_email; ?>" id="input-bind_email" class="min-register-text form-control" />
            </div>
          </div>
		  
		  <div class="form-group">
            <div class="col-sm-12">
              <input type="password" name="bind_password" value="<?php echo $bind_password; ?>" placeholder="<?php echo $entry_password; ?>" id="input-bind_password" class="min-register-text form-control" />
            </div>
          </div>
		  
		  <div class="form-group">
		  <div class="col-sm-12">
		  <input type="hidden" name="weibo_uid" value="<?php echo $weibo_uid; ?>" />
		  <input type="submit" value="<?php echo $button_bind; ?>" class="connect-submit" style="width:100%;*width:276px;">
		  </div>
		  </div>
		</div>
	</form>
	</div>
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
		html = '<input type="text" value="<?php echo $entry_password; ?>" class="min-register-text form-control min-replace"/>';
		$(this).parent().prepend(html);
        }else if($(this).attr("name") == "confirm"){
		$(this).hide();
		html = '<input type="text" value="<?php echo $entry_confirm; ?>" class="min-register-text form-control min-replace"/>';
		$(this).parent().prepend(html);
		}else if($(this).attr("name") == "bind_password"){
		$(this).hide();
		html = '<input type="text" value="<?php echo $entry_password; ?>" class="min-register-text form-control min-replace"/>';
		$(this).parent().prepend(html);
		}
		}

      }
    });
  }
  $('.min-replace').focus(function(){
		$(this).hide();
		$(this).parent().children('input[type=\'password\']').show().focus();
	});
 
});

<?php if($typesubmit){ ?>
	$('.connect-bind').hide();
	$('.connect-register').show();
	$('.connect-register-change').addClass('connect-tab-show');
<?php }else{ ?>
	$('.connect-register').hide();
	$('.connect-bind').show();
	$('.connect-bind-change').addClass('connect-tab-show');
<?php } ?>
$('.connect-register-change').click(function(){
	$(this).addClass('connect-tab-show');
	$('.connect-bind-change').removeClass('connect-tab-show');
	$('.connect-bind').hide();
	$('.connect-register').show();
});
$('.connect-bind-change').click(function(){
	$(this).addClass('connect-tab-show');
	$('.connect-register-change').removeClass('connect-tab-show');
	$('.connect-register').hide();
	$('.connect-bind').show();
});
//--></script>
<?php echo $footer; ?>