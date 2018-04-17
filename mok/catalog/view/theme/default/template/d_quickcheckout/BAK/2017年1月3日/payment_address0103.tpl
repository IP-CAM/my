<!-- 
	Ajax Quick Checkout 
	v6.0.0
	Dreamvention.com 
	d_quickcheckout/payment_address.tpl 
-->
<div id="payment_address" class="qc-step" data-col="<?php echo $col; ?>" data-row="<?php echo $row; ?>"></div>
<script type="text/html" id="payment_address_template">

<div class="ok_cs_box<%= parseInt(model.config.display) ? '' : ' hidden' %>">	
		<div class="ok_order_title"><%= model.config.title %></div>
		

			<% if(model.account == 'logged'){ %>
			<div class="ok_address_content weui-cells">	
				<% if(_.size(model.addresses) > 0){ %>
				
				<% _.each (model.addresses, function(address) { %>
					<% if(address.address_id == model.payment_address.address_id){ %>
					
					<input type="radio" name="payment_address[address_id]" class="payment-address"  value="<%= address.address_id %>" id="payment_address_exists_<%= address.address_id %>" checked="checked"  data-refresh="2" autocomplete='off' />
					
					<div class="weui-cell">
						<div class="weui-cell__hd ok_choose_icon"></div>
						<div class="weui-cell__bd">
						<p class="ok_user_info">
							<span class="ok_user_name"><%= address.custom_field[4] %></span>
							<span class="ok_user_phone"><%= address.custom_field[5] %></span>
							<span class="ok_user_default">默认</span>
						</p>
						<p class="ok_user_address">
				        <%= address.zone %>,<%= address.address_1 %>
						<br/>
						<%= address.city_id %>,<%= address.district_id %>
							
						</p>
						</div>
					</div>
					
					
					
					<% }else{ %>
					
					<% } %>
				<% }) %>
					
				<% } %>
				<div class="radio-input">
		            <input type="radio" name="payment_address[address_id]" class="payment-address" value="new" id="payment_address_exists_new" <%= model.payment_address.address_id == 'new' ? 'checked="checked"' : '' %> data-refresh="2" autocomplete='off' />
		            <label for="payment_address_exists_new">
		                <?php echo $text_address_new; ?>
		            </label>
		        </div>
			</div>
		        <form id="payment_address_form" class="form-horizontal <%= model.payment_address.address_id == 'new' ? '' : 'hidden' %>">
				
				</form>
			
			<% }else{ %>
			<form id="payment_address_form" class="form-horizontal">
				
			</form>
			<% } %>
		
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