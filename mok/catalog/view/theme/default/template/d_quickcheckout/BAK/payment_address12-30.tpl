
<div id="payment_address" class="qc-step"></div>
<script type="text/html" id="payment_address_template">
<div class="ok_cs_box<%= parseInt(model.config.display) ? '' : ' hidden' %>">
	<div class="">
		<div class="ok_order_title"><%= model.config.title %></div>
		
		<div class="ok_address_content weui-cells panel-body">
			<% if(model.account == 'logged'){ %> 
				<% if(_.size(model.addresses) > 0){ %>
					
						<% _.each (model.addresses, function(address) { %>
							<% if(address.address_id == model.payment_address.address_id) { %>
							<div class="weui-cell radio-input">
							<div class="weui-cell__hd ok_choose_icon"></div>
							<input type="radio" name="payment_address[address_id]" class="payment-address" value="<%= address.address_id %>" id="payment_address_exists_<%= address.address_id %>" <%= address.address_id == model.payment_address.address_id ? 'checked="checked"' : '' %> data-refresh="2" autocomplete='off' style="display:none;"/> 
							
							<div class="weui-cell__bd">
								<p class="ok_user_info">
								<span class="ok_user_name"><%= address.custom_field[4] %></span>
								<span class="ok_user_phone"><%= address.custom_field[5] %></span>
								<span class="ok_user_default"><?php echo $text_default; ?></span>
								<!-- 存在bug 需要在存入custom field时设置值 -->
								<%= console.log(address) %>
								
								</p>
								<p class="ok_user_address"><%= address.address_1 %></p>
							</div>
							</div>
							<% }else{ %> 
							<div class="weui-cell ok_hide radio-input">
							<div class="weui-cell__hd"></div>
							<input type="radio" name="payment_address[address_id]" class="payment-address" value="<%= address.address_id %>" id="payment_address_exists_<%= address.address_id %>" <%= address.address_id == model.payment_address.address_id ? 'checked="checked"' : '' %> data-refresh="2" autocomplete='off' style="display:none;"/> 
							
							<div class="weui-cell__bd">
								<p class="ok_user_info">
								<span class="ok_user_name"><%= address.custom_field[4] %></span>
								<span class="ok_user_phone"><%= address.custom_field[5] %></span>
								</p>
								<p class="ok_user_address"><%= address.address_1 %></p>
							</div>
							</div>
							<% } %>
			            <% }) %>
						<div class="ok_show_down"></div>
							<div class="ok_address_bottom ok_hide" id="ok_addAddress">
								<i class="ok_address_icon">+</i>
								<span class="ok_address_add"><?php echo $text_address_new; ?></span>
						</div>
					
				<% } %>
				<!-- 这里的model.address 判断有问题,不管是否有地址都大于0了 -->
				
				<% if(_.size(model.addresses) > 0){ %> 
				<div class="radio-input">
		            <input type="radio" name="payment_address[address_id]" class="payment-address" value="new" id="payment_address_exists_new" <%= model.payment_address.address_id == 'new' ? 'checked="checked"' : '' %> data-refresh="2" autocomplete='off' />
		            <label for="payment_address_exists_new">
		                <?php echo $text_address_new; ?>
		            </label>
		        </div>
		        <form id="payment_address_form" class="form-horizontal <%= model.payment_address.address_id == 'new' ? '' : 'hidden' %>">
				
				</form>
				<% }else{ %>
				<div class="radio-input">
		            <input type="radio" name="payment_address[address_id]" class="payment-address" value="new" id="payment_address_exists_new" checked="checked" data-refresh="2" autocomplete='off' />
		            <label for="payment_address_exists_new">
		                <?php echo $text_address_new; ?>
		            </label>
		        </div>
		        <form id="payment_address_form" class="form-horizontal">
				
				</form>
				<% } %>
			<% }else{ %>
			<form id="payment_address_form" class="form-horizontal">
				
			</form>
			<% } %>
		</div>
	</div>
</div>
</script>

<script>
$(function() {
	qc.paymentAddress = $.extend(true, {}, new qc.PaymentAddress(<?php echo $json; ?>));
	qc.paymentAddressView = $.extend(true, {}, new qc.PaymentAddressView({
		el:$("#payment_address"), 
		model: qc.paymentAddress, 
		template: _.template($("#payment_address_template").html())
	}));
	qc.paymentAddressView.setZone(qc.paymentAddress.get('payment_address.country_id'));
	qc.paymentAddressView.setCity(qc.paymentAddress.get('payment_address.zone_id'));
	qc.paymentAddressView.setDistrict(qc.paymentAddress.get('payment_address.city_id'));
});
</script>