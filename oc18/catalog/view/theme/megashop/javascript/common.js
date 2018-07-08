// offcanvas menu
$(document).ready(function () {
    /*  Fix First Click Menu */
    $(document.body).on('click', '#pav-mainnav [data-toggle="dropdown"]' ,function(){
        if(!$(this).parent().hasClass('open') && this.href && this.href != '#'){
            window.location.href = this.href;
        }

    });
	$(document.body).on('click', '.pav-verticalmenu [data-toggle="dropdown"], .verticalmenu [data-toggle="dropdown"]' ,function(){
        if(!$(this).parent().hasClass('open') && this.href && this.href != '#'){
            window.location.href = this.href;
        }

    });
	jQuery(document).ready(function(){
        jQuery(window).scroll(function(){
            if (jQuery(this).scrollTop() > 100) {
                jQuery('.scrollup').fadeIn();
            } else {
                jQuery('.scrollup').fadeOut();
            }
			
            if (jQuery(this).scrollTop() > 200) {
                jQuery('.fixed_menu').fadeIn();
            } else {
                jQuery('.fixed_menu').fadeOut();
            }
        });
        // scroll-to-top animate
        jQuery('.scrollup, .fixed_menu > div > button').click(function(){
            jQuery("html, body").animate({ scrollTop: 0 }, 600);
            return false;
        });
    });
// Adding the clear Fix
cols1 = $('#column-right, #column-left').length;

if (cols1 == 2) {
	$('#content .product-layout:nth-child(2n+2)').after('<div class="clearfix visible-md visible-sm"></div>');
} else if (cols1 == 1) {
	$('#content .product-layout:nth-child(3n+3)').after('<div class="clearfix visible-lg"></div>');
} else {
	$('#content .product-layout:nth-child(4n+4)').after('<div class="clearfix"></div>');
}

  $('[data-toggle="offcanvas"]').click(function () {
    $('.row-offcanvas').toggleClass('active')
  });

  /* Search */
  $('#offcanvas-search input[name=\'search\']').parent().find('button').on('click', function() {
    url = $('base').attr('href') + 'index.php?route=product/search';

    var value = $('header input[name=\'search\']').val();

    if (value) {
      url += '&search=' + encodeURIComponent(value);
    }

    location = url;
  });

  $('#offcanvas-search input[name=\'search\']').on('keydown', function(e) {
    if (e.keyCode == 13) {
      $('header input[name=\'search\']').parent().find('button').trigger('click');
    }
  });
});


$(document).ready(function() {
	$('.product-zoom').magnificPopup({
		  type: 'image',
          closeOnContentClick: true,

          image: {
            verticalFit: true
          }
	});

	  $('.iframe-link').magnificPopup({
      type:'iframe'
    });
});


$(document).ready(function(){
	 // Currency
    $('.currency .currency-select').on('click', function(e) {
        e.preventDefault();

        $('.currency input[name=\'code\']').attr('value', $(this).attr('data-name'));

        $('.currency').submit();
    });
	
    $('.dropdown-menu input').click(function(e) {
        e.stopPropagation();
    });

    // grid list switcher
    $("button.btn-switch").bind("click", function(e){
        e.preventDefault();
        var theid = $(this).attr("id");
        var row = $("#products");

        if($(this).hasClass("active")) {
            return false;
        } else {
            if(theid == "list-view"){
                $('#list-view').addClass("active");
                $('#grid-view').removeClass("active");

                // remove class list
                row.removeClass('product-grid');
                // add class gird
                row.addClass('product-list');

            }else if(theid =="grid-view"){
                $('#grid-view').addClass("active");
                $('#list-view').removeClass("active");

                // remove class list
                row.removeClass('product-list');
                // add class gird
                row.addClass('product-grid');

            }
        }
    });


    $(".quantity-adder .add-action").click( function(){
        var obj = $(this).parent().find('input');
		
		if( $(this).hasClass('add-up') ) {
            obj.val( parseInt(obj.val()) + 1 );
        }else {
            if( parseInt(obj.val())  > 1 ) {
                obj.val( parseInt(obj.val()) - 1 );
            }
        }
		
		$(this).parents('form').submit();
    });
	
	
    $(".quantity-adder input").each(function(){
		$(this).blur(function (){
			$(this).parents('form').submit();
		});
	});
    /****/
    $(document).ready(function() {
        $('.popup-with-form').magnificPopup({
              type: 'inline',
              preloader: false,
              focus: '#input-name',

              // When elemened is focused, some mobile browsers in some cases zoom in
              // It looks not nice, so we disable it:
              callbacks: {
                beforeOpen: function() {
                  if($(window).width() < 700) {
                    this.st.focus = false;
                  } else {
                    this.st.focus = '#input-name';
                  }
                }
              }
        });
    });
});

// Cart add remove functions
var cart = {
  'addcart': function(product_id, quantity) {
    $.ajax({
      url: 'index.php?route=checkout/cart/add',
      type: 'post',
      data: 'product_id=' + product_id + '&quantity=' + (typeof(quantity) != 'undefined' ? quantity : 1),
      dataType: 'json',
      success: function(json) {
        $('.alert, .text-danger').remove();

        if (json['redirect']) {
          location = json['redirect'];
        }
		
        if (json['success']) {
          $('#popup_window_cart').html('<div class="popup_box_product_image"><img src="'+json['product_image']+'" /></div><div class="popup_box_product_title">'+json['product_name']+'</div>');
		  
		  $('.popup_dark').show();
		  
          if( $("#cart-total").hasClass("cart-mini-info") ){
              json['total'] = json['total'].replace(/-(.*)+$/,"");
          }
		  
          $('#cart-total').html(json['total']);
          $('#cart > ul').load('index.php?route=common/cart/info ul li');
		}

        /*if (json['success']) {
          $('#notification').html('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
          if( $("#cart-total").hasClass("cart-mini-info") ){
              json['total'] = json['total'].replace(/-(.*)+$/,"");
          }
          $('#cart-total').html(json['total']);

          $('html, body').animate({ scrollTop: 0 }, 'slow');

          $('#cart > ul').load('index.php?route=common/cart/info ul li');
        }*/
      }
    });
  },
  'update': function(key, quantity) {
    $.ajax({
      url: 'index.php?route=checkout/cart/edit',
      type: 'post',
      data: 'key=' + key + '&quantity=' + (typeof(quantity) != 'undefined' ? quantity : 1),
      dataType: 'json',
      beforeSend: function() {
        $('#cart > button').button('loading');
      },
      success: function(json) {
        $('#cart > button').button('reset');

        $('#cart-total').html(json['total']);
        if (getURLVar('route') == 'checkout/cart' || getURLVar('route') == 'checkout/checkout') {
          location = 'index.php?route=checkout/cart';
        } else {
          $('#cart > ul').load('index.php?route=common/cart/info ul li');
        }
      }
    });
  },
  'remove': function(key) {
    $.ajax({
      url: 'index.php?route=checkout/cart/remove',
      type: 'post',
      data: 'key=' + key,
      dataType: 'json',
      beforeSend: function() {
        $('#cart > button').button('loading');
      },
      success: function(json) {
        $('#cart > button').button('reset');

        $('#cart-total').html(json['total']);

        if (getURLVar('route') == 'checkout/cart' || getURLVar('route') == 'checkout/checkout') {
          location = 'index.php?route=checkout/cart';
        } else {
          $('#cart > ul').load('index.php?route=common/cart/info ul li');
        }
      }
    });
  },
  'close': function() {
	  $('.popup_dark').hide();
  }
}

var wishlist = {
  'addwishlist': function(product_id) {
    $.ajax({
      url: 'index.php?route=account/wishlist/add',
      type: 'post',
      data: 'product_id=' + product_id,
      dataType: 'json',
      success: function(json) {
        $('.alert').remove();

        if (json['success']) {
          $('#notification').html('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        }

        if (json['info']) {
          $('#notification').html('<div class="alert alert-info"><i class="fa fa-info-circle"></i> ' + json['info'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        }

        $('#wishlist-total').html(json['total']);

        $('html, body').animate({ scrollTop: 0 }, 'slow');
      }
    });
  },
  'remove': function() {

  }
}

var compare = {
  'addcompare': function(product_id) {
    $.ajax({
      url: 'index.php?route=product/compare/add',
      type: 'post',
      data: 'product_id=' + product_id,
      dataType: 'json',
      success: function(json) {
        $('.alert').remove();

        if (json['success']) {
          $('#notification').html('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

          $('#compare-total').html(json['total']);

          $('html, body').animate({ scrollTop: 0 }, 'slow');
        }
      }
    });
  },
  'remove': function() {

  }
}

$(document).ready(function() {
    $('.box-currency').hover(function() {
        $(this).find('.dropdown-menu').stop(true, true).slideDown('fast');
    },function() {
        $(this).find('.dropdown-menu').stop(true, true).slideUp('fast');
    });
    $('.box-user').hover(function() {
        $(this).find('.dropdown-menu').stop(true, true).slideDown('fast');
    },function() {
        $(this).find('.dropdown-menu').stop(true, true).slideUp('fast');
    });
    $('.box-language').hover(function() {
        $(this).find('.dropdown-menu').stop(true, true).slideDown('fast');
    },function() {
        $(this).find('.dropdown-menu').stop(true, true).slideUp('fast');
    });
	
	$('#tab-description').find('img, table, iframe').removeAttr('width').removeAttr('height');
});


$(document).keydown(function(e) {
	if ((e.ctrlKey == 27) || (e.which == 27)) {
		$('.popup_dark').hide();
	}
});