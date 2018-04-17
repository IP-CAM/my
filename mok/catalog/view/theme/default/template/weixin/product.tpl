<?php echo $header; ?>
<?php echo $content_top; ?>
<div class="ok_slider">
	<?php if ($thumb || $images) { ?>
    <ul>
        <?php if ($thumb) { ?>
		<li><img src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></li>
        <?php } ?>
        <?php if ($images) { ?>
        <?php foreach ($images as $image) { ?>
        <li><img src="<?php echo $image['thumb']; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></li>
        <?php } ?>
        <?php } ?>
    </ul>
    <?php } ?>
</div>

<div class="ok_detail_choose" id="product">
    <div class="ok_goods_info">
        <h3 class="ok_goods_name"><?php echo $heading_title; ?></h3>
		<?php if ($price) { ?>
		<p class="ok_goods_price" id="otp-price">
			<?php if (!$special) { ?>
            	<?php echo $price; ?>
            <?php } else { ?>
            	<?php echo $special; ?> <span style="color:#ddd;font-size:0.2rem;text-decoration:line-through;"><?php echo $price; ?></span>
            <?php } ?>
			<?php if ($tax) { ?>
            	<li><?php echo $text_tax; ?> <?php echo $tax; ?></li>
            <?php } ?>
		</p>
          <?php } ?>
    </div>
	
	<!-- 商品型号,库存状态,extra -->
	<div style="display:none;">
	<span id="otp-model"><?php echo $model; ?></span>
	<span id="otp-stock"><?php echo $stock; ?></span></li>
<?php if ($config_otp_extra) { ?>
	<li><span id="otp-extra"></span></li>
<?php } ?>
	</div>
			
			<?php if ($options || $otp_options) { ?>
			
<?php if ($otp_options) { ?>
	<style type="text/css">
		ul.otp-option {
			display: block;
			width: 100%;
			list-style: none;
			padding: 0;
			margin: 5px 0 15px 0;
			overflow-x: auto;
		}
		ul.otp-option li {
			padding: .17rem;
		    border: 1px solid #c0c0c0;
		    border-radius: .07rem;
		    font-size: .28rem;
		    color: #555;
		    float: left;
		    margin-right: 4px;
			overflow: hidden;
		}
		ul.otp-option li:hover, ul.otp-option li.selected {
			cursor: pointer;
			color: #e74c3c;
    		background-color: #fff6f6;
		}
	</style>
	<?php $otpcount = 0; ?>
	<!-- 商品原本的数据 -->
	<div id="otp_default" model="<?php echo $model; ?>" price="<?php echo $price; ?>" special="<?php echo ($special?$special:'0'); ?>" text-price="" stock="" text-stock="<?php echo $stock; ?>" out-of-stock="" style="display:none;"></div>
	
	<input type="hidden" id="otp" name="otp" value="">
	<input type="hidden" id="swap" name="swap" value="">
	<!-- 设置第一个选项是默认选择的,才能显示下一级的选项 -->
	<?php foreach ($otp_options as $option) { ?>
		<?php if ($option['type'] == 'select') { ?>
			<div class="otp-option-<?php echo $otpcount; ?>-wrap form-group<?php echo ($option['required'] ? ' required' : ''); ?>" <?php if ($otpcount != 0) { ?>style="display:none;"<?php } ?>>
				<label class="control-label" for="otp_select_<?php echo $otpcount; ?>"><?php echo $option['name']; ?></label>
				<select id="otp-option-<?php echo $otpcount; ?>" class="select-swap select-swap-<?php echo $option['option_id']; ?> form-control" option="<?php echo $option['option_id']; ?>" mode="select" name="option[<?php echo $option['option_id']; ?>]">
					<option value="" selected><?php echo $text_select; ?></option>
					<?php if ($otpcount == 0) { ?>
						<?php foreach ($option['option_value'] as $option_value) { ?>
							<option value="<?php echo $option_value['option_value_id']; ?>"><?php echo $option_value['name']; ?></option>
						<?php } ?>
					<?php } ?>
				</select>
				<div id="input-option<?php echo $option['option_id']; ?>"></div>
			</div>
		<?php } elseif ($option['type'] == 'list') { ?>
			<div class="ok_detail_post otp-option-<?php echo $otpcount; ?>-wrap form-group<?php echo ($option['required'] ? ' required' : ''); ?>" <?php if ($otpcount != 0) { ?>style="display:none;"<?php } ?>>
				<label class="ok_detail_info control-label" for="otp_select_<?php echo $otpcount; ?>"><?php echo $option['name']; ?></label>
				<!-- id 的值是当前选项的提交值 -->
				<input type="hidden" id="otp-option-<?php echo $otpcount; ?>" option="<?php echo $option['option_id']; ?>" mode="list" name="option[<?php echo $option['option_id']; ?>]">
				<ul id="input-option<?php echo $option['option_id']; ?>" class="otp-option otp-option-<?php echo $otpcount; ?> list-swap-<?php echo $option['option_id']; ?>">
				<?php if ($otpcount == 0) { ?>
					<?php foreach ($option['option_value'] as $option_value) { ?>
						<li value="<?php echo $option_value['option_value_id']; ?>">
							<?php if ($option_value['image'] != '') { ?>
								<img src="<?php echo $option_value['image']; ?>">
							<?php } else { ?>
								<span><?php echo $option_value['name']; ?></span>
							<?php } ?>
						</li>
					<?php } ?>
				<?php } ?>
				</ul>
			</div>
		<?php } ?>
		<?php $otpcount++; ?>
	<?php } ?>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#otp_default').attr('text-price', $('#otp-price').html());
			btn_cart_css = $('#button-cart').css('background');
			// 检查购物的数量,需要修改 
			$("input[name='quantity']").keyup(function(){
				checkAvailability();
			});
		});
		// 还原基本信息,还原购物车,还原价格,型号,库存,extra
		function revertData() {
			revertAddToCart();
			//$('.price').html($('#otp_default').attr('text-price'));
			$('#otp-model').html($('#otp_default').attr('model'));
			$('#otp-stock').html($('#otp_default').attr('text-stock'));
			<?php if ($config_otp_extra) { ?>
			$('#otp-extra').html('');
			<?php } ?>
		}
		// 还原购物车 这里需要修改 
		function revertAddToCart() {
			$('#button-cart').html('<?php echo $button_cart; ?>');
			$('#button-cart').css('background',btn_cart_css);
			$('#button-cart').removeClass('inactive');
		}
		// 检查是否可用
		function checkAvailability() {
			// 修改购买的数量100毫秒后执行
			setTimeout(function(){
				// 判断是否无库存
				if ($('#otp_default').attr('out-of-stock') != '0') {
					if ($('#otp_default').attr('stock') == '0') {
						// 修改添加购物车的状态,添加类,禁止加入购物车 inactive
						$('#button-cart').html($('#otp_default').attr('out-of-stock'));
						$('#button-cart').css('background','#FF0000');
						$('#button-cart').addClass('inactive');
					} // 如果,商品选项的库存小于用户的购物数,禁止加入购物车
					else if (parseInt($('#otp_default').attr('stock')) < parseInt($("input[name='quantity']").val())) {
						$('#button-cart').html('<?php echo $text_unavailable; ?>');
						$('#button-cart').css('background','#FF0000');
						$('#button-cart').addClass('inactive');
					}
					else {
						revertAddToCart();
					}
				}
				else {
					revertAddToCart();
				}
			}, 100);
		}
		function standardPrice(sta_price) {
			html =  sta_price ;
			return html;
		}
		function specialPrice(old_price, new_price) {
			html = '<span style="text-decoration: line-through;">' + old_price + '</span>' + new_price ;
			return html;
		}
		function taxPrice(tax_price) {
			html = '<li><?php echo $text_tax; ?> ' + tax_price + '</li>';
			return html;
		}
		//获取子选项的list
		function getOtpChild() {
			$.ajax({
				type: 'GET',
				url: 'index.php?route=product/product/getotpchildvalues',
				data: { product_id: <?php echo $product_id; ?>, child_option_id: $('#otp-option-1').attr('option'), parent_option_value_id: $('#otp-option-0').val(), mode: $('#otp-option-1').attr('mode') },
				success: function(data) {
					console.log(data);
					$('.otp-option-1-wrap').show();
					if ($('#otp-option-1').attr('mode') == 'select') {
						$('#otp-option-1').html(data);
					}
					else {
						$('.otp-option-1').html(data);
					}
				}
			});
			// 移除页面的所有警告
			$('.text-danger').remove();
			$('#otp-option-1').val('');
		}
		// 获取孙选项的list
		function getOtpGrandchild() {
			$.ajax({
				type: 'GET',
				url: 'index.php?route=product/product/getotpgrandchildvalues',
				data: { product_id: <?php echo $product_id; ?>, grandchild_option_id: $('#otp-option-2').attr('option'), parent_option_value_id: $('#otp-option-0').val(), child_option_value_id: $('#otp-option-1').val(), mode: $('#otp-option-2').attr('mode') },
				success: function(data) {
					$('.otp-option-2-wrap').show();
					if ($('#otp-option-2').attr('mode') == 'select') {
						$('#otp-option-2').html(data);
					}
					else {
						$('.otp-option-2').html(data);
					}
				}
			});
			$('#product .text-danger').remove();
			$('#otp-option-2').val('');
		}
		// 获取当前选项
		function getOtpData(pov_id, cov_id, gov_id) {
			$('#product .text-danger').remove();
			$('#button-cart').addClass('inactive');
			$.ajax({
				type: 'GET',
				dataType: 'json',
				url: 'index.php?route=product/product/getotp',
				data: { product_id: <?php echo $product_id; ?>, parent_option_value_id: pov_id, child_option_value_id: cov_id, grandchild_option_value_id: gov_id },
				success: function(data){
					if (data) {
						$('#otp').val(data.id);
						$('#button-cart').removeClass('inactive');
						$('#otp_default').attr('stock', data.quantity);
						$('#otp_default').attr('out-of-stock', data.out_of_stock);
						checkAvailability();
						otp_price = '';
						if (data.price != 0 || data.special != 0) {
							if (data.price != 0) {
								if (data.special != 0) {
									otp_price += specialPrice(data.price, data.special);
								}
								else if ($('#otp_default').attr('special') != '0') {
									otp_price += specialPrice(data.price, $('#otp_default').attr('special'));
								}
								else {
									otp_price += standardPrice(data.price);
								}
							}
							else if (data.special != 0) {
								otp_price += specialPrice($('#otp_default').attr('price'), data.special);
							}
							if (data.tax != 0) {
								otp_price += taxPrice(data.tax);
							}
						}
						else {
							if ($('#otp_default').attr('special') != '0') {
								otp_price += specialPrice($('#otp_default').attr('price'), $('#otp_default').attr('special'));
							}
							else {
								otp_price += standardPrice($('#otp_default').attr('price'));
							}
							<?php if ($tax) { ?>
					        otp_price += taxPrice('<?php echo $tax; ?>');
					        <?php } ?>
						}
						$('#otp-price').html(otp_price);
						if (data.model != '') {
							$('#otp-model').html(data.model);
						}
						else {
							$('#otp-model').html($('#otp_default').attr('model'));
						}
						<?php if ($config_otp_extra) { ?>
						if (data.extra != '') {
							$('#otp-extra').html(data.extra);
						}
						else {
							$('#otp-extra').html('');
						}
						<?php } ?>
						$('#otp-stock').html(data.stock);
					}
				}
			});
		}
		<?php if ($otpcount == 1) { ?>
		$('#otp-option-0').on('change', function(){
			if ($(this).val() != '') {
				getOtpData($('#otp-option-0').val(), 0, 0);
			}
			else {
				revertData();
			}
		});
		$('.otp-option-0').on('click', 'li', function(){
			if (!$(this).hasClass('selected')) {
				$('.otp-option-0 > li').removeClass('selected');
				$(this).addClass('selected');
				$('#otp-option-0').val($(this).attr('value'));
				getOtpData($('#otp-option-0').val(), 0, 0);
			}
		});
		<?php } ?>
		<?php if ($otpcount > 1) { ?>
		$('#otp-option-0').on('change', function(){
			revertData();
			if ($(this).val() != '') {
				getOtpChild();
			}
			else {
				$('#otp-option-1').val('');
				$('.otp-option-1-wrap').hide();
			}
			$('#otp-option-2').val('');
			$('.otp-option-2-wrap').hide();
		});
		$('.otp-option-0').on('click', 'li', function(){
			if (!$(this).hasClass('selected')) {
				$('.otp-option-0 > li').removeClass('selected');
				$(this).addClass('selected');
				revertData();
				$('#otp-option-0').val($(this).attr('value'));
				getOtpChild();
				$('#otp-option-2').val('');
				$('.otp-option-2-wrap').hide();
			}
		});
		<?php } ?>
		<?php if ($otpcount == 2) { ?>
		$('#otp-option-1').on('change', function(){
			if ($(this).val() != '') {
				getOtpData($('#otp-option-0').val(), $('#otp-option-1').val(), 0);
			}
			else {
				revertData();
			}
		});
		$('.otp-option-1').on('click', 'li', function(){
			if (!$(this).hasClass('selected')) {
				$('.otp-option-1 > li').removeClass('selected');
				$(this).addClass('selected');
				$('#otp-option-1').val($(this).attr('value'));
				getOtpData($('#otp-option-0').val(), $('#otp-option-1').val(), 0);
			}
		});
		<?php } ?>
		<?php if ($otpcount == 3) { ?>
		$('#otp-option-1').on('change', function(){
			revertData();
			if ($(this).val() != '') {
				getOtpGrandchild();
			}
			else {
				$('#otp-option-2').val('');
				$('.otp-option-2-wrap').hide();
			}
		});
		$('.otp-option-1').on('click', 'li', function(){
			if (!$(this).hasClass('selected')) {
				$('.otp-option-1 > li').removeClass('selected');
				$(this).addClass('selected');
				revertData();
				$('#otp-option-1').val($(this).attr('value'));
				getOtpGrandchild();
			}
		});
		$('#otp-option-2').on('change', function(){
			if ($(this).val() != '') {
				getOtpData($('#otp-option-0').val(), $('#otp-option-1').val(), $('#otp-option-2').val());
			}
			else {
				revertData();
			}
		});
		$('.otp-option-2').on('click', 'li', function(){
			if (!$(this).hasClass('selected')) {
				$('.otp-option-2 > li').removeClass('selected');
				$(this).addClass('selected');
				$('#otp-option-2').val($(this).attr('value'));
				getOtpData($('#otp-option-0').val(), $('#otp-option-1').val(), $('#otp-option-2').val());
			}
		});
		<?php } ?>
	</script>
<?php } ?>

            <?php foreach ($options as $option) { ?>
            <?php if ($option['type'] == 'select') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <select name="option[<?php echo $option['product_option_id']; ?>]" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control">
                <option value=""><?php echo $text_select; ?></option>
                <?php foreach ($option['product_option_value'] as $option_value) { ?>
                <option value="<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
                <?php if ($option_value['price']) { ?>
                (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                <?php } ?>
                </option>
                <?php } ?>
              </select>
            </div>
            <?php } ?>
			<!-- 修改价格如果有option_value price -->
            <?php if ($option['type'] == 'radio') { ?>
			<div class="ok_detail_post form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
            <p class="ok_detail_info"><?php echo $option['name']; ?></p>
            <div class="ok_goods_kind">
				<?php foreach ($option['product_option_value'] as $option_value) { ?>
                <a href="javascript:void(0);" class="ok_checkBox">
                    <input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" />
                    <?php echo $option_value['name']; ?>
					
					<?php if ($option_value['price']) { ?>
                    (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                    <?php } ?>
				</a>
				<?php } ?>
            </div>
			</div>
            <?php } ?>
            <?php if ($option['type'] == 'checkbox') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label"><?php echo $option['name']; ?></label>
              <div id="input-option<?php echo $option['product_option_id']; ?>">
                <?php foreach ($option['product_option_value'] as $option_value) { ?>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="option[<?php echo $option['product_option_id']; ?>][]" value="<?php echo $option_value['product_option_value_id']; ?>" />
                    <?php if ($option_value['image']) { ?>
                    <img src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>" class="img-thumbnail" /> 
                    <?php } ?>
                    <?php echo $option_value['name']; ?>
                    <?php if ($option_value['price']) { ?>
                    (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                    <?php } ?>
                  </label>
                </div>
                <?php } ?>
              </div>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'text') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" placeholder="<?php echo $option['name']; ?>" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'textarea') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <textarea name="option[<?php echo $option['product_option_id']; ?>]" rows="5" placeholder="<?php echo $option['name']; ?>" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control"><?php echo $option['value']; ?></textarea>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'file') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label"><?php echo $option['name']; ?></label>
              <button type="button" id="button-upload<?php echo $option['product_option_id']; ?>" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-default btn-block"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>
              <input type="hidden" name="option[<?php echo $option['product_option_id']; ?>]" value="" id="input-option<?php echo $option['product_option_id']; ?>" />
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'date') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <div class="input-group date">
                <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="YYYY-MM-DD" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
                <span class="input-group-btn">
                <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                </span></div>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'datetime') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <div class="input-group datetime">
                <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="YYYY-MM-DD HH:mm" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
                <span class="input-group-btn">
                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span></div>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'time') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <div class="input-group time">
                <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="HH:mm" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
                <span class="input-group-btn">
                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span></div>
            </div>
            <?php } ?>
            <?php } ?>
            <?php } ?>
		
		<input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
		<input type="hidden" name="quantity" value="<?php echo $minimum; ?>" id="input-quantity" />
        <div class="ok_detail_post">
            <p class="ok_detail_info"><?php echo $entry_qty; ?></p>
            <div class="ok_goods_kind">
                <a href="javascript:void(0);" class="ok_option_num" id="ok_option_desc">-</a>
                <a href="javascript:void(0);" class="ok_goods_num"><?php echo $minimum; ?></a>
                <a href="javascript:void(0);" class="ok_option_num" id="ok_option_add">+</a>
            </div>
        </div>

		

         
</div>
<?php if ($manufacturer) { ?>
<div class="ok_brand weui-cells">
    <div class="weui-cell">
        <div class="weui-cell__hd">
        	<a href="<?php echo $manufacturers; ?>">
			<?php if($manufacturer_logo) { ?>

            <img src="<?php echo $manufacturer_logo; ?>" width="100%">
			<?php } ?>
			</a>
        </div>
        <div class="weui-cell__bd">
            <div class="ok_brand_info">
            	<a href="<?php echo $manufacturers; ?>">
                <p class="ok_brand_name ok_over"><?php echo $manufacturer; ?></p>
               </a>
            </div>
            <a href="<?php echo $manufacturers; ?>" class="ok_enter_brand"><?php echo $text_entry_manufacturer; ?></a>
        </div>
    </div>
</div>
<?php } ?>
<div class="ok_push_load">
	<?php echo $text_pull_up; ?>
    <img src="catalog/view/theme/default/images/public/pushload.gif" class="ok_push_img"/>
</div>
<div class="ok_detail_comment" style="display:none;">
    <div class="weui-flex ok_tab">
        <a href="javascript:;" class="weui-flex__item ok_detail_tab ok_tab_selected"> <?php echo $tab_description; ?></a>
        <a href="<?php echo $href; ?>#comment" class="weui-flex__item ok_detail_tab"><?php echo $entry_rating; ?></a>
    </div>
	<?php if (isset($attribute_groups)) { ?>
    <div class="ok_img_text">
		<?php foreach ($attribute_groups as $attribute_group) { ?>
		<!--
		<h2><?php echo $attribute_group['name']; ?></h2>
		-->
		<?php foreach ($attribute_group['attribute'] as $attribute) { ?>
        <div class="weui-flex">
            <div class="weui-flex__item ok_text_title"><?php echo $attribute['name']; ?></div>
            <div class="ok_text_detail">
                <p><?php echo $attribute['text']; ?></p>
            </div>
        </div>
		<?php } ?>
		<?php } ?>
    </div>
	<?php }else{ ?>
    <div class="ok_img_text"></div>
    <?php } ?>
    <div class="ok_img">
    </div>
	<!-- 评论 -->
	<div class="ok_comment" name="comment" id="review" data-id="<?php echo $product_id; ?>"></div>
</div>
<?php echo $column_left; ?>
<?php echo $column_right; ?>
<div style="display:none" id="layout">
	<?php echo $content_bottom; ?>
</div>
<div class="ok_over_tips">
	<?php echo $text_look_and_buy; ?>
</div>
<div class="ok_tabbar">
    <span class="ok_tabbar_cart">
        <span class="ok_cart_box">
                <a href="<?php echo $shopping_cart; ?>">
                    <img class="ok_cart" src="catalog/view/theme/default/images/goods_detalil/cart.jpg" width="100%"/>
                    <i class="ok_num"><?php echo $amount; ?></i>
                </a>
        </span>
        <?php if($wish_product){ ?>
    <img class="ok_detail_collect wish_add" data-collect="true" src="catalog/view/theme/default/images/goods_detalil/collected.png" width="100%" />
    <?php }else{ ?>
    <img class="ok_detail_collect wish_add" data-collect="false" src="catalog/view/theme/default/images/goods_detalil/collect.png" width="100%" />
    <?php } ?>
    </span>
    <a href="javascript:void(0);" class="ok_tabbar_buy" id="button-buy" data-href='<?php echo $shopping_cart; ?>'>
        <p class="ok_buy" id="ok_submit"><?php echo $button_buy; ?></p>
    </a>
    <a href="javascript:void(0);" class="ok_tabbar_add" id="button-cart">
        <p class="ok_add_cart" data-id="<?php echo $product_id; ?>"><?php echo $button_cart; ?></p>
    </a>
</div>
<div class="ok_position"> 
    <div class="ok_pop"><span class="ok_tag ok_fail_in"></span>
        <span class="ok_pop_info"></span></div>
</div>

<?php echo $footer; ?>