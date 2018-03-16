// Load Confirmation
function LoadConfirmation(account_type){
	$.ajax({
		url: 'index.php?route=onepagecheckout/confirm',
		dataType: 'html',
		type: 'post',
		data: 'account_type='+ account_type,
		beforeSend: function() {
			$('#onepagecheckout #button-confirm').attr('disabled', true);
			$('#onepagecheckout #button-register').attr('disabled', true);
			$('#onepagecheckout #button-guest').attr('disabled', true);
		},
		complete: function() {
			$('#onepagecheckout #button-confirm').attr('disabled', false);
			$('#onepagecheckout #button-register').attr('disabled', false);
			$('#onepagecheckout #button-guest').attr('disabled', false);
			$('#onepagecheckout #button-guest').attr('disabled', false);
		},
		success: function(html) {
			$('#onepagecheckout .confirm-order-content').html(html);
		}
	});
}

//Load Checkout Page
function LoadCheckoutpage(){
	$.ajax({
		type: 'GET',
		url: 'index.php?route=onepagecheckout/checkout',
		complete: function (data) {  
			$('#content').html($("#content", data.responseText).html());
			LoadCart();
			LoadPaymentMethod();
			LoadShippingMethod();
			var account_type = ($('#onepagecheckout input[name=\'account_type\']:checked').val()) ? $('#onepagecheckout input[name=\'account_type\']:checked').val() : '';
			LoadConfirmation(account_type);
		}
	});
}

// Load Payment Method
function LoadPaymentMethod(logged){
	if(!logged){
		var postdata = $('#account input[type=\'text\'], #account input[type=\'checkbox\']:checked, #account input[type=\'radio\']:checked, #account input[type=\'hidden\'], #account select');
		var url = 'index.php?route=onepagecheckout/payment_method&type=personal_details';
	}else{
		var postdata = $('.payment-details-content input[type=\'text\'],.payment-details-content input[type=\'checkbox\']:checked, .payment-details-content input[type=\'radio\']:checked, .payment-details-content input[type=\'hidden\'],.payment-details-content select');
		var url = 'index.php?route=onepagecheckout/payment_method&type=payment_details';
	}
	
	$.ajax({
		url:url,
		type:'post',
		data:postdata,
		dataType: 'html',
		beforeSend: function() {
			$('#onepagecheckout #button-confirm').attr('disabled', true);
			$('#onepagecheckout #button-register').attr('disabled', true);
		},
		complete: function() {
			$('#onepagecheckout #button-confirm').attr('disabled', false);
			$('#onepagecheckout #button-register').attr('disabled', false);
		},
		success: function(html) {
			$('#onepagecheckout .payment-method-loader').remove();
			
			$('#onepagecheckout .payment-method-content').html(html);
		}
	});
}

// Load Delivery Method
function LoadShippingMethod(){
	if($("input[name='personal_details[shipping_address]']:checked").val()){
		var postdata = $('#account input[type=\'text\'], #account input[type=\'checkbox\']:checked, #account input[type=\'radio\']:checked, #account input[type=\'hidden\'], #account select,.delivery-method-content input[type=\'radio\']:checked');
		var url = 'index.php?route=onepagecheckout/shipping_method&type=personal_details';
	}else{
		var postdata = $('.delivery-details-content input[type=\'text\'],.delivery-details-content input[type=\'checkbox\']:checked, .delivery-details-content input[type=\'radio\']:checked, .delivery-details-content input[type=\'hidden\'],.delivery-details-content select,.delivery-method-content input[type=\'radio\']:checked');
		var url = 'index.php?route=onepagecheckout/shipping_method&type=delivery_details';
	}
	
	$.ajax({
		url:url,
		type:'post',
		data:postdata,
		dataType: 'html',
		beforeSend: function(){
			$('#onepagecheckout #button-confirm').attr('disabled', true);
			$('#onepagecheckout #button-register').attr('disabled', true);
		},
		complete: function(){
			$('#onepagecheckout #button-confirm').attr('disabled', false);
			$('#onepagecheckout #button-register').attr('disabled', false);
		},
		success: function(html) {
			$('#onepagecheckout .delivery-method-loader').remove();
			
			$('#onepagecheckout .delivery-method-content').html(html);
		}
	});
}

// Load Cart
function LoadCart(){
	$.ajax({
		url: 'index.php?route=onepagecheckout/cart',
		dataType: 'html',
		type: 'post',
		data: $('#onepagecheckout input[name=\'account_type\']:checked'),
		beforeSend: function(){
			$('#onepagecheckout .ext-carts').html('<div class="extloader loader cart-loader text-center"><img src="catalog/view/theme/default/image/loader.gif" alt="Loader" /> <span class="sr-only">Loading...</span></div>');
			
			$('#onepagecheckout #button-confirm').attr('disabled', true);
			$('#onepagecheckout #button-register').attr('disabled', true);
		},
		complete: function(){
			$('#onepagecheckout #button-confirm').attr('disabled', false);
			$('#onepagecheckout #button-register').attr('disabled', false);
		},
		success: function(html){
			$('#onepagecheckout .cart-loader').remove();
			$('#onepagecheckout .shopping-cart-content').html(html);
		}
	});
}