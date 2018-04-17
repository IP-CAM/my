<form class="form-horizontal">
<!--
  radio name payment_address 通过值来
-->
  <?php if ($addresses) { ?>
  <div class="ok_order_title"><?php echo $text_payment_address; ?></div>
  <div class="radio">
      <label>
        <input type="radio" name="payment_address" value="existing" checked="checked" />
        <?php echo $text_address_existing; ?>
      </label>
  </div>
  <div id="payment-existing" class="ok_address_content weui-cells">
      <?php foreach ($addresses as $address) { ?>
      <?php if ($address['address_id'] == $address_id) { ?>
	  
	  <div class="weui-cell">
  	  <input type="radio" name="address_id" value="<?php echo $address['address_id']; ?>" checked="checked" />
              <div class="weui-cell__hd ok_choose_icon"></div>
              <div class="weui-cell__bd">
                  <p class="ok_user_info">
  					<?php if(isset($address['custom_field'][4])){ ?>
                      <span class="ok_user_name"><?php echo $address['custom_field'][4]; ?></span>
  					<?php } ?>
  					<?php if(isset($address['custom_field'][5])){ ?>
                      <span class="ok_user_phone"><?php echo $address['custom_field'][5]; ?></span>
  					<?php } ?>
                      <span class="ok_user_default"><?php echo $text_default; ?></span>
                  </p>
                  <p class="ok_user_address">
				<?php echo $address['zone']; ?>,
				<?php if(!empty($address['city'])) {echo $address['city'].',';}  ?>
				<?php if(!empty($address['district'])){echo $address['district'].',';}  ?>
				<?php echo $address['address_1']; ?>
				  </p>
              </div>
        </div>
      <?php } else { ?>
	  <div class="weui-cell ok_hide">
	     <input type="radio" name="address_id" value="<?php echo $address['address_id']; ?>"/>
            <div class="weui-cell__hd"></div>
            <div class="weui-cell__bd">
                <p class="ok_user_info">
					<?php if(isset($address['custom_field'][4])){ ?>
                    <span class="ok_user_name"><?php echo $address['custom_field'][4]; ?></span>
					<?php } ?>
					<?php if(isset($address['custom_field'][5])){ ?>
                    <span class="ok_user_phone"><?php echo $address['custom_field'][5]; ?></span>
					<?php } ?>
                   
                </p>
                <p class="ok_user_address"><?php echo $address['zone']; ?>,<?php echo $address['address_1']; ?></p>
            </div>
      </div>
	 
      <?php } ?>
      <?php } ?>
    <div class="ok_show_down"></div>
    <div class="ok_address_bottom ok_hide" id="ok_addAddress">
        <i class="ok_address_icon">+</i>
        <span class="ok_address_add"><?php echo $text_address_new; ?></span>
    </div>
  </div>
  <div class="radio">
    <label>
      <input type="radio" name="payment_address" id="add_new" value="new" />
      <?php echo $text_address_new; ?></label>
  </div>
  <?php }else{ ?>
	<div class="ok_order_title"><?php echo $text_address_new; ?></div>
  <?php } ?>

  
  <div id="payment-new" style="display: <?php echo ($addresses ? 'none' : 'block'); ?>;" class="weui-cells">
	<?php foreach ($custom_fields as $custom_field) { ?>
	<!--
	只获取location address 的相关custom_field, data-sort 做顺序排列
	-->
    <?php if ($custom_field['location'] == 'address') { ?>
    <?php if ($custom_field['type'] == 'select') { ?>
    <div class="form-group<?php echo ($custom_field['required'] ? ' required' : ''); ?> custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
      <label class="col-sm-2 control-label" for="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
      <div class="col-sm-10">
        <select name="22custom_field[<?php echo $custom_field['custom_field_id']; ?>]" id="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control">
          <option value=""><?php echo $text_select; ?></option>
          <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
          <option value="<?php echo $custom_field_value['custom_field_value_id']; ?>"><?php echo $custom_field_value['name']; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <?php } ?>
    <?php if ($custom_field['type'] == 'radio') { ?>
    <div class="form-group<?php echo ($custom_field['required'] ? ' required' : ''); ?> custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
      <label class="col-sm-2 control-label"><?php echo $custom_field['name']; ?></label>
      <div class="col-sm-10">
        <div id="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>">
          <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
          <div class="radio">
            <label>
              <input type="radio" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" />
              <?php echo $custom_field_value['name']; ?></label>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
    <?php } ?>
    <?php if ($custom_field['type'] == 'checkbox') { ?>
    <div class="form-group<?php echo ($custom_field['required'] ? ' required' : ''); ?> custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
      <label class="col-sm-2 control-label"><?php echo $custom_field['name']; ?></label>
      <div class="col-sm-10">
        <div id="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>">
          <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
          <div class="checkbox">
            <label>
              <input type="checkbox" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>][]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" />
              <?php echo $custom_field_value['name']; ?></label>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
    <?php } ?>
    <?php if ($custom_field['type'] == 'text') { ?>
	
		<div class="weui-cell custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
            <div class="weui-cell__hd"><?php echo $custom_field['name']; ?></div>
            <div class="weui-cell__bd">
				<input type="text" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field['value']; ?>" placeholder="<?php echo $custom_field['name']; ?>" id="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="ok_input" />
            </div>
        </div>
		
    
    <?php } ?>
    <?php if ($custom_field['type'] == 'textarea') { ?>
    <div class="form-group<?php echo ($custom_field['required'] ? ' required' : ''); ?> custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
      <label class="col-sm-2 control-label" for="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
      <div class="col-sm-10">
        <textarea name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" rows="5" placeholder="<?php echo $custom_field['name']; ?>" id="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control"><?php echo $custom_field['value']; ?></textarea>
      </div>
    </div>
    <?php } ?>
    <?php if ($custom_field['type'] == 'file') { ?>
    <div class="form-group<?php echo ($custom_field['required'] ? ' required' : ''); ?> custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
      <label class="col-sm-2 control-label"><?php echo $custom_field['name']; ?></label>
      <div class="col-sm-10">
        <button type="button" id="button-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-default"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>
        <input type="hidden" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="" id="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>" />
      </div>
    </div>
    <?php } ?>
    <?php if ($custom_field['type'] == 'date') { ?>
    <div class="form-group<?php echo ($custom_field['required'] ? ' required' : ''); ?> custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
      <label class="col-sm-2 control-label" for="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
      <div class="col-sm-10">
        <div class="input-group date">
          <input type="text" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field['value']; ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="YYYY-MM-DD" id="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
          <span class="input-group-btn">
          <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
          </span></div>
      </div>
    </div>
    <?php } ?>
    <?php if ($custom_field['type'] == 'time') { ?>
    <div class="form-group<?php echo ($custom_field['required'] ? ' required' : ''); ?> custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
      <label class="col-sm-2 control-label" for="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
      <div class="col-sm-10">
        <div class="input-group time">
          <input type="text" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field['value']; ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="HH:mm" id="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
          <span class="input-group-btn">
          <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
          </span></div>
      </div>
    </div>
    <?php } ?>
    <?php if ($custom_field['type'] == 'datetime') { ?>
    <div class="form-group<?php echo ($custom_field['required'] ? ' required' : ''); ?> custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
      <label class="col-sm-2 control-label" for="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
      <div class="col-sm-10">
        <div class="input-group datetime">
          <input type="text" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field['value']; ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="YYYY-MM-DD HH:mm" id="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
          <span class="input-group-btn">
          <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
          </span></div>
      </div>
    </div>
    <?php } ?>
    <?php } ?>
    <?php } ?>
	
    <div class="form-group required" style="display:none;">
      <label class="col-sm-2 control-label" for="input-payment-country"><?php echo $entry_country; ?></label>
      <div class="col-sm-10">
        <select name="country_id" id="input-payment-country" class="form-control">
          <option value=""><?php echo $text_select; ?></option>
          <?php foreach ($countries as $country) { ?>
          <?php if ($country['country_id'] == $country_id) { ?>
          <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
          <?php } else { ?>
          <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
          <?php } ?>
          <?php } ?>
        </select>
      </div>
    </div>
	
    <!-- <div class="form-group required">
      <label class="col-sm-2 control-label" for="input-payment-zone"><?php echo $entry_zone; ?></label>
      <div class="col-sm-10">
        <select name="zone_id" id="input-payment-zone" class="form-control">
        </select>
      </div>
    </div> -->
    <div class="weui-cell">
    <div class="weui-cell__hd">区域</div>
            <div class="weui-cell__bd">
                <span class="ok_input" id="showPicker">省市县(区)</span>
                <input id="zone" name="zone_id" type="hidden" data-name="" />
                <input id="city" name="city_id" type="hidden" data-name=""/>
                <input id="district" name="district_id" type="hidden" data-name=""/>
                <input name="country_id" type="hidden" value="44"/>
            </div>
	 </div>
		<div class="weui-cell">
            <div class="weui-cell__hd"><?php echo $entry_address_1; ?></div>
            <div class="weui-cell__bd">
				<input type="text" name="address_1" value="" placeholder="<?php echo $entry_address_1; ?>" id="input-payment-address-1" class="ok_input" />
            </div>
        </div>
		
    <!-- 原本必填项 与默认项 -->
	<div class="weui-cell" style="display:none;">
	<div class="weui-cell__bd">
		<input type="text" name="firstname" value="" placeholder="<?php echo $entry_firstname; ?>" id="input-payment-firstname" class="form-control" />
		<input type="text" name="lastname" value="" placeholder="<?php echo $entry_lastname; ?>" id="input-payment-lastname" class="form-control" />
		
		<!-- 邮编是在国家设置是否必要 -->
		<input type="text" name="postcode" value="" placeholder="<?php echo $entry_postcode; ?>" id="input-payment-postcode" class="form-control" />
		
		<input type="text" name="company" value="" placeholder="<?php echo $entry_company; ?>" id="input-payment-company" class="form-control" />
		<input type="text" name="address_2" value="" placeholder="<?php echo $entry_address_2; ?>" id="input-payment-address-2" class="form-control" />
		<input type="text" name="city" value="" placeholder="<?php echo $entry_city; ?>" id="input-payment-city" class="form-control" />
		
		<!-- 如果没有地址,设置新地址为默认地址 -->
		<?php if (!$addresses) { ?>
		<input type="text" name="default" value="1" id="input-default" class="form-control" style="display:none;"/>
		<?php } ?>
    </div>
    </div>
	
  </div>

    <!-- 
	id button-payment-address 触发加载运货地址
	方法写在checkout.tpl
	$(document).delegate('#button-payment-address', 'click', function() {
	-->
	<?php if (!$addresses) { ?>
	<input type="button" value="<?php echo $button_continue; ?>" id="button-payment-address" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary" />
	<?php }else{ ?>
	<input type="button" value="<?php echo $button_continue; ?>" id="button-payment-address" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary" style="display:none;"/>
	
<script type="text/javascript"><!--
$('#button-payment-address').trigger('click');
//--></script>

	<?php } ?>

</form>
</div>
<div id="ok_picker">
    <div class="weui-mask weui-animate-fade-in"></div>
    <div class="weui-picker weui-animate-slide-up">
        <div class="weui-picker__hd">
            <a href="javascript:;" data-action="cancel" class="weui-picker__action" id="picker_cancel">取消</a> 
            <a href="javascript:;" data-action="select" class="weui-picker__action" id="picker_confirm">确定</a>
        </div>
        <div class="weui-picker__bd">
            <div class="weui-picker__group">
                <div class="weui-picker__mask"></div>
                <div class="weui-picker__indicator"></div>
                <div class="weui-picker__content" data-id="zone">
                    
                </div>
            </div>
        </div>
    </div>
</div>
<div class="weui-flex ok_tabbar">
        <span class="weui-flex__item ok_cancel">取消</span>
        <span class="weui-flex__item ok_submit" id="ok_submit">保存</span>
    </div>
    <div class="ok_position">
    <div class="ok_pop"></div>
</div>
<script type="text/javascript" src="catalog/view/theme/default/script/ok_addAddress.js"></script>
<script type="text/javascript"><!--
$('#ok_submit').click(function () {
  if(isNull($('#input-payment-custom-field4').val())){
    showPop('收货人不能为空');
  }else if(!/^1[3|4|5|7|8]\d{9}/.test($("#input-payment-custom-field5").val())){
    showPop('手机号码格式不对！');        
  }else if(isNull($('#input-payment-address-1').val())){
    showPop('详细地址不能为空');
  }else if(isNull($('#zone').val()) || isNull($('#city').val()) || isNull($('#district').val())){
    showPop('区域地址不全');
  }else{
    $("#button-payment-address").trigger('click');
    window.location.href = window.location.href; 
}
function showPop(_html){
  $('.ok_pop').html(_html);
    $('.ok_position').show();
    setTimeout(function(){$('.ok_position').hide();},400);
}
 function isNull(val){
  if(val == null || val == ''){
    return true;
  }else{
    return false;
  }
 }   
});
$('.ok_show_down').click(function(){
                var $this = $(this);
                if($this.hasClass('ok_show_up')){
                    $(this).removeClass('ok_show_up');
                    $('#ok_addAddress').addClass('ok_hide');
                    $('.ok_address_content .weui-cell').each(function(ind){
                        var _hasIcon = $(this).find('.weui-cell__hd').hasClass('ok_choose_icon');
                        if(!_hasIcon){
                            $(this).addClass('ok_hide');
                        }
                    });
                }else{
                    $('#ok_addAddress').removeClass('ok_hide');
                    $(this).addClass('ok_show_up').siblings('.weui-cell').removeClass('ok_hide');
                }
            });
            //选择地址
            $('.ok_address_content .weui-cell').click(function(){
                var $this = $(this);
                if($this.find('.weui-cell__hd').hasClass('ok_choose_icon')){return false;}
                $this.find('input[name="address_id"]').attr('checked',true);
                $this.find('.weui-cell__hd').addClass("ok_choose_icon");
                $this.siblings('.weui-cell').find('.weui-cell__hd').removeClass("ok_choose_icon")
                $this.siblings('.weui-cell').find('input[name="address_id"]').attr('checked',false);
            });
            //点击新建地址
            $('.ok_address_add').click(function(){
                $('#add_new').trigger('click');
            });
/* 
	如果有地址隐藏新增地址的表单
*/
$('input[name=\'payment_address\']').on('change', function() {
	if (this.value == 'new') {
		$('#payment-existing').hide();
		$('#payment-new').show();
		$('#button-payment-address').show();
		
		$('#collapse-payment-method').hide();
		$('#collapse-checkout-confirm').hide();
	} else {
		$('#payment-existing').show();
		$('#payment-new').hide();
		$('#button-payment-address').hide();
		
		$('#collapse-payment-method').show();
		$('#collapse-checkout-confirm').show();
	}
});
//--></script>

<script type="text/javascript"><!--
// Sort the custom fields

$('#collapse-payment-address .form-group[data-sort]').detach().each(function() {
	if ($(this).attr('data-sort') >= 0 && $(this).attr('data-sort') <= $('#collapse-payment-address .form-group').length-2) {
		$('#collapse-payment-address .form-group').eq(parseInt($(this).attr('data-sort'))+2).before(this);
	}

	if ($(this).attr('data-sort') > $('#collapse-payment-address .form-group').length-2) {
		$('#collapse-payment-address .form-group:last').after(this);
	}

	if ($(this).attr('data-sort') == $('#collapse-payment-address .form-group').length-2) {
		$('#collapse-payment-address .form-group:last').after(this);
	}

	if ($(this).attr('data-sort') < -$('#collapse-payment-address .form-group').length-2) {
		$('#collapse-payment-address .form-group:first').before(this);
	}
});
//--></script>
<script type="text/javascript"><!--
/* 
	custom-field 上传文件,触发 id=button-payment-custom-field
*/
$('#collapse-payment-address button[id^=\'button-payment-custom-field\']').on('click', function() {
	var node = this;

	$('#form-upload').remove();

	$('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');

	$('#form-upload input[name=\'file\']').trigger('click');

	if (typeof timer != 'undefined') {
    	clearInterval(timer);
	}

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
						$(node).parent().find('input[name^=\'custom_field\']').after('<div data-p="" class="text-danger">' + json['error'] + '</div>');
					}

					if (json['success']) {
						$(node).parent().find('input[name^=\'custom_field\']').val(json['code']);
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
/*
	调用日历
*/
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
/*
  选择国家时
*/
$('#collapse-payment-address select[name=\'country_id\']').on('change', function() {
	$.ajax({
		url: 'index.php?route=checkout/checkout/country&country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('#collapse-payment-address select[name=\'country_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
		},
		complete: function() {
			$('.fa-spin').remove();
		},
		success: function(json) {
			if (json['postcode_required'] == '1') {
				$('#collapse-payment-address input[name=\'postcode\']').parent().parent().addClass('required');
			} else {
				$('#collapse-payment-address input[name=\'postcode\']').parent().parent().removeClass('required');
			}

			html = '<option value=""><?php echo $text_select; ?></option>';

			if (json['zone'] && json['zone'] != '') {
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

			$('#collapse-payment-address select[name=\'zone_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});
/* 默认选择国家 */
$('#collapse-payment-address select[name=\'country_id\']').trigger('change');
//--></script>
