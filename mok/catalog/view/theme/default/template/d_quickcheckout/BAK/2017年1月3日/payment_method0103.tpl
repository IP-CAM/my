<!-- 
	Ajax Quick Checkout 
	这个页面的脚本问题主要是在选择相应的支付选项是,radio跟着改变
-->
<div id="payment_method" class="qc-step" data-col="<?php echo $col; ?>" data-row="<?php echo $row; ?>"></div>
<script type="text/html" id="payment_method_template" >
<form id="payment_method_form" <%= parseInt(model.config.display) ? '' : 'class="hidden"' %>>
	<% if (model.error_warning) { %>
		<div class="error"><%= model.error_warning %></div>
	<% } %>
	<% if (model.payment_methods.length != 0) { %>
		<div class="ok_cs_box" >
			<div class="ok_order_title">
				<%= model.config.title %>
			</div>
			
				<% if(model.error){ %>
					<div class="alert alert-danger">
						<%= model.error %>
					</div>
				<% } %>
			<div class="ok_pay_content weui-cells">
				<div id="payment_method_list" class="<%= parseInt(model.config.display_options) ? '' : 'hidden' %>">
					<% _.each(model.payment_methods, function(payment_method) { %>
						<div class="weui-cell">
							
								<% if (payment_method.code == model.payment_method.code) { %>
									<input type="radio" name="payment_method" value="<%= payment_method.code %>" id="<%= payment_method.code %>" checked="checked" class="styled"  data-refresh="6"/>
								<% } else { %>
									<input type="radio" name="payment_method" value="<%= payment_method.code %>" id="<%= payment_method.code %>" class="styled"  data-refresh="6"/>
								<% } %>

								<% if(parseInt(model.config.display_images)) { %>
									<img class="payment-image" src="<%= payment_method.image %>" />
								<% } %>
								<div class="weui-cell__bd">
									<a href="javascript:;" class="ok_pay_way"></a>
								</div>
								
							
						</div>
					<% }) %>
				</div>									
			</div>	
		</div>
	<% } else{ %>
    <% if (model.payment_error) { %> 
       <div class="alert alert-warning"><i class="fa fa-exclamation-circle"></i> <%= model.payment_error %></div>
   <% } %>
	<% } %>
</form>
</script>
<script>
$(function() {
	qc.paymentMethod = $.extend(true, {}, new qc.PaymentMethod(<?php echo $json; ?>));
	qc.paymentMethodView = $.extend(true, {}, new qc.PaymentMethodView({
		el:$("#payment_method"), 
		model: qc.paymentMethod, 
		template: _.template($("#payment_method_template").html())
	}));
});
</script>