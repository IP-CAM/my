<?php 
if($registry->has('theme_options') == false) { 
	header("location: themeinstall/index.php"); 
	exit; 
} 
$theme_options = $registry->get('theme_options');
$config = $registry->get('config');
require_once( DIR_TEMPLATE.$config->get($config->get('config_theme') . '_directory')."/lib/module.php" );
$modules = new Modules($registry);
$language_id = $config->get( 'config_language_id' );
	$customfooter = $theme_options->get( 'customfooter' );
?>
<!DOCTYPE html>
<!--[if IE 7]> <html lang="<?php echo $lang; ?>" class="ie7 responsive"> <![endif]-->  
<!--[if IE 8]> <html lang="<?php echo $lang; ?>" class="ie8 responsive"> <![endif]-->  
<!--[if IE 9]> <html lang="<?php echo $lang; ?>" class="ie9 responsive"> <![endif]-->  
<!--[if !IE]><!--> <html lang="<?php echo $lang; ?>" class="responsive"> <!--<![endif]-->  
<head>
	<title><?php echo $title; ?></title>
	<base href="<?php echo $base; ?>" />

	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<?php if ($description) { ?>
	<meta name="description" content="<?php echo $description; ?>" />
	<?php } ?>
	<?php if ($keywords) { ?>
	<meta name="keywords" content="<?php echo $keywords; ?>" />
	<?php } ?>
	
	<?php foreach ($links as $link) { ?>
	<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
	<?php } ?>
	<!-- Google Fonts -->
	

	
	
	<?php $listcssjs = array(
			'catalog/view/theme/'.$config->get($config->get('config_theme') . '_directory').'/css/bootstrap.css',
			'catalog/view/theme/'.$config->get($config->get('config_theme') . '_directory').'/css/stylesheet.css',
			'catalog/view/theme/'.$config->get($config->get('config_theme') . '_directory').'/css/responsive.css',
			'catalog/view/theme/'.$config->get($config->get('config_theme') . '_directory').'/css/menu.css',
			'catalog/view/theme/'.$config->get($config->get('config_theme') . '_directory').'/css/font-awesome.min.css',
			'catalog/view/theme/'.$config->get($config->get('config_theme') . '_directory').'/css/owl.carousel.css',
			'catalog/view/theme/'.$config->get($config->get('config_theme') . '_directory').'/css/blog-news.css', 
			'catalog/view/theme/'.$config->get($config->get('config_theme') . '_directory').'/css/slider.css', 
			'catalog/view/theme/'.$config->get($config->get('config_theme') . '_directory').'/css/slidebars.css', 
			'catalog/view/theme/'.$config->get($config->get('config_theme') . '_directory').'/css/magnific-popup.css',
			'catalog/view/theme/'.$config->get($config->get('config_theme') . '_directory').'/css/brainyfilter.css'
	); 
	
	// Carousel brands
	if($config->get( 'carousel_module' ) != '') $listcssjs[] = 'catalog/view/theme/'.$config->get($config->get('config_theme') . '_directory').'/css/carousel.css';
	
	// Nivo slider
	if($config->get( 'slideshow_module' ) != '') $listcssjs[] = 'catalog/view/theme/' . $config->get($config->get('config_theme') . '_directory') . '/css/slideshow.css';
		
	
		$listcssjs[] = 'catalog/view/theme/'.$config->get($config->get('config_theme') . '_directory').'/css/wide-grid.css';

	?>
		
	<?php echo $theme_options->compressorCodeCss( $config->get($config->get('config_theme') . '_directory'), $listcssjs, $theme_options->get( 'compressor_code_status' ), HTTP_SERVER ); ?>
	
	<?php if($theme_options->get( 'colors_status' ) == 1) { ?>
	<style type="text/css">
		
		#header .button-search { background: <?php echo $theme_options->get( 'primary_color' ); ?>;}
		
		a:hover, .my-account .dropdown-menu > li > a:hover, .language .dropdown-menu > li > a:hover, .currency .dropdown-menu > li > a:hover, .my-login .dropdown-menu > li > a:hover, 
		.product-list .name a:hover, .rating i.active, .product-grid .product .name a:hover, .box-information > ul > li > a:hover, .col-sm-3 .products .row > div .product .name a:hover,
		.col-sm-4 .products .row > div .product .name a:hover, .category-list a:hover, .product-compare a:hover, .product-filter .options .button-group button:hover,
		.product-filter .options .button-group .active, .filter-product .filter-tabs ul > li > a:hover, .filter-product .filter-tabs ul > li.active > a,
		.bnews-list .artblock .article-meta a:hover, ul.megamenu > li > a:hover, ul.megamenu > li.active > a, ul.megamenu > li.home > a, ul.megamenu > li:hover > a,
		ul.megamenu > li > a:hover,  ul.megamenu > li:hover > a, ul.megamenu li .sub-menu .content a:hover, ul.megamenu li .sub-menu .content .hover-menu li > a:hover

		{
			color: <?php echo $theme_options->get( 'primary_color' ); ?>;
		}

		#cart .cart-heading  p, .button, #header .button-search, .product-list .product-icon:hover, .product-grid .product .product-icon:hover, 
		.product-grid .product .image .quickview a:hover, .scrollup, .product-info .product-icon:hover, .product-info .description .fa, .htabs a:hover, .htabs a.selected,
		.newsletter-holder .button:hover
		{
		   background: none repeat scroll 0 0 <?php echo $theme_options->get( 'primary_color' ); ?>;
		}

		#column_left .box .prev-button:hover,#column_left  .box .prev-button span:hover, #column_left  .box .next-button:hover ,#column_left  .box .next-button span:hover {color: <?php echo $theme_options->get( 'primary_color' ); ?>!important;}
			

		#column_left_fixed .facebook:hover, #column_left_fixed .twitter:hover , #column_left_fixed .instagram:hover , #column_left_fixed .googleplus:hover , #column_left_fixed .pinterest:hover , #column_left_fixed .youtube:hover , #column_left_fixed .flickr:hover, #column_left_fixed .vimeo:hover , #column_left_fixed .tumblr:hover   
		{
			color: <?php echo $theme_options->get( 'primary_color' ); ?>;
			border: 1px solid <?php echo $theme_options->get( 'primary_color' ); ?>;
		}				

	</style>
	<?php } ?>

	
	<?php if($theme_options->get( 'custom_code_css_status' ) == 1) { ?>
	<link rel="stylesheet" href="catalog/view/theme/<?php echo $config->get($config->get('config_theme') . '_directory'); ?>/skins/store_<?php echo $theme_options->get( 'store' ); ?>/<?php echo $theme_options->get( 'skin' ); ?>/css/custom_code.css">
	<?php } ?>

	

    
    	<?php $listcssjs = array(); 
    $listcssjs[] = 'catalog/view/theme/'.$config->get($config->get('config_theme') . '_directory').'/js/jquery.min.js';
    $listcssjs[] = 'catalog/view/theme/'.$config->get($config->get('config_theme') . '_directory').'/js/jquery-migrate-1.2.1.min.js';
    $listcssjs[] = 'catalog/view/theme/'.$config->get($config->get('config_theme') . '_directory').'/js/jquery.easing.1.3.js';
    $listcssjs[] = 'catalog/view/theme/'.$config->get($config->get('config_theme') . '_directory').'/js/bootstrap.min.js';
    $listcssjs[] = 'catalog/view/theme/'.$config->get($config->get('config_theme') . '_directory').'/js/twitter-bootstrap-hover-dropdown.js';
    $listcssjs[] = 'catalog/view/theme/'.$config->get($config->get('config_theme') . '_directory').'/js/common.js';
	$listcssjs[] = 'catalog/view/theme/'.$config->get($config->get('config_theme') . '_directory').'/js/slidebars.js';
    $listcssjs[] = 'catalog/view/theme/'.$config->get($config->get('config_theme') . '_directory').'/js/jquery.cookie.js';
	$listcssjs[] = 'catalog/view/theme/'.$config->get($config->get('config_theme') . '_directory').'/js/brainyfilter.js';
	$listcssjs[] = 'catalog/view/theme/'.$config->get($config->get('config_theme') . '_directory').'/js/jquery.ui.touch-punch.min.js';
    
    // Nivo slider
    if($config->get( 'slideshow_module' ) != '') $listcssjs[] = 'catalog/view/theme/' . $config->get($config->get('config_theme') . '_directory') . '/js/jquery.nivo.slider.pack.js';
    
    // Carousel brands
    if($config->get( 'carousel_module' ) != '') $listcssjs[] = 'catalog/view/theme/'.$config->get($config->get('config_theme') . '_directory').'/js/jquery.jcarousel.min.js';
 
    ?>
        	
    <?php echo $theme_options->compressorCodeJs( $config->get($config->get('config_theme') . '_directory'), $listcssjs, $theme_options->get( 'compressor_code_status' ), HTTP_SERVER ); ?>
    <script type="text/javascript" src="catalog/view/theme/<?php echo $config->get($config->get('config_theme') . '_directory'); ?>/js/jquery.themepunch.plugins.min.js"></script>
  
    	<script type="text/javascript" src="catalog/view/theme/<?php echo $config->get($config->get('config_theme') . '_directory'); ?>/js/jquery.themepunch.revolution.min.js"></script>
		<script type="text/javascript" src="catalog/view/theme/<?php echo $config->get($config->get('config_theme') . '_directory'); ?>/js/jquery.magnific-popup.min.js"></script>
		
 
	
	<script type="text/javascript" src="catalog/view/theme/<?php echo $config->get($config->get('config_theme') . '_directory'); ?>/js/owl.carousel.min.js"></script> 
	<script type="text/javascript" src="catalog/view/theme/<?php echo $config->get($config->get('config_theme') . '_directory'); ?>/js/jquery.jcarousel.min.js"></script> 
	<script type="text/javascript">
	var transition = 'slide';
	var animation_time = 300;
	var checkout_url = '<?php echo $checkout; ?>';
	</script>
	<?php foreach ($scripts as $script) { ?>
	<script type="text/javascript" src="<?php echo $script; ?>"></script>
	<?php } ?>
	<?php if($theme_options->get( 'custom_code_javascript_status' ) == 1) { ?>
	<script type="text/javascript" src="catalog/view/theme/<?php echo $config->get($config->get('config_theme') . '_directory'); ?>/skins/store_<?php echo $theme_options->get( 'store' ); ?>/<?php echo $theme_options->get( 'skin' ); ?>/js/custom_code.js"></script>
	<?php } ?>
	

	<?php foreach ($analytics as $analytic) { ?>
		<?php echo $analytic; ?>
	<?php } ?>  
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<script src="catalog/view/theme/<?php echo $config->get($config->get('config_theme') . '_directory'); ?>/js/respond.min.js"></script>
	<![endif]-->
</head>	
<body>

<?php if($theme_options->get( 'widget_facebook_status' ) == 1) { ?>
<div class="facebook_<?php if($theme_options->get( 'widget_facebook_position' ) == 1) { echo 'left'; } else { echo 'right'; } ?> hidden-xs hidden-sm">
	<div class="facebook-icon"></div>
	<div class="facebook-content">
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		
		<div class="fb-like-box fb_iframe_widget" profile_id="<?php echo $theme_options->get( 'widget_facebook_id' ); ?>" data-colorscheme="light" data-height="370" data-width="243" data-connections="16" fb-xfbml-state="rendered"></div>
	</div>
	
	<script type="text/javascript">    
	$(function() {  
		$(".facebook_right").hover(function() {            
			$(".facebook_right").stop(true, false).animate({right: "0"}, 800, 'easeOutQuint');        
		}, function() {            
			$(".facebook_right").stop(true, false).animate({right: "-250"}, 800, 'easeInQuint');        
		}, 1000);    
	
		$(".facebook_left").hover(function() {            
			$(".facebook_left").stop(true, false).animate({left: "0"}, 800, 'easeOutQuint');        
		}, function() {            
			$(".facebook_left").stop(true, false).animate({left: "-250"}, 800, 'easeInQuint');        
		}, 1000);    
	});  
	</script>
</div>
<?php } ?>

<?php if($theme_options->get( 'widget_twitter_status' ) == 1) { ?>
<div class="twitter_<?php if($theme_options->get( 'widget_twitter_position' ) == 1) { echo 'left'; } else { echo 'right'; } ?> hidden-xs hidden-sm">
	<div class="twitter-icon"></div>
	<div class="twitter-content">
		<a class="twitter-timeline"  href="https://twitter.com/@<?php echo $theme_options->get( 'widget_twitter_user_name' ); ?>" data-chrome="noborders" data-tweet-limit="<?php echo $theme_options->get( 'widget_twitter_limit' ); ?>"  data-widget-id="<?php echo $theme_options->get( 'widget_twitter_id' ); ?>" data-theme="light" data-related="twitterapi,twitter" data-aria-polite="assertive">Tweets by @<?php echo $theme_options->get( 'widget_twitter_user_name' ); ?></a>
	</div>
	
	<script type="text/javascript">    
	!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
	$(function() {  
		$(".twitter_right").hover(function() {            
			$(".twitter_right").stop(true, false).animate({right: "0"}, 800, 'easeOutQuint');        
		}, function() {            
			$(".twitter_right").stop(true, false).animate({right: "-250"}, 800, 'easeInQuint');        
		}, 1000);    
	
		$(".twitter_left").hover(function() {            
			$(".twitter_left").stop(true, false).animate({left: "0"}, 800, 'easeOutQuint');        
		}, function() {            
			$(".twitter_left").stop(true, false).animate({left: "-250"}, 800, 'easeInQuint');        
		}, 1000);    
	});  
	</script>
</div>
<?php } ?>

<?php if($theme_options->get( 'widget_custom_status' ) == 1) { ?>
<div class="custom_<?php if($theme_options->get( 'widget_custom_position' ) == 1) { echo 'left'; } else { echo 'right'; } ?> hidden-xs hidden-sm">
	<div class="custom-icon"></div>
	<div class="custom-content">
		<?php $lang_id = $config->get( 'config_language_id' ); ?>
		<?php $custom_content = $theme_options->get( 'widget_custom_content' ); ?>
		<?php if(isset($custom_content[$lang_id])) echo html_entity_decode($custom_content[$lang_id]); ?>
	</div>
	
	<script type="text/javascript">    
	$(function() {  
		$(".custom_right").hover(function() {            
			$(".custom_right").stop(true, false).animate({right: "0"}, 800, 'easeOutQuint');        
		}, function() {            
			$(".custom_right").stop(true, false).animate({right: "-250"}, 800, 'easeInQuint');        
		}, 1000);    
	
		$(".custom_left").hover(function() {            
			$(".custom_left").stop(true, false).animate({left: "0"}, 800, 'easeOutQuint');        
		}, function() {            
			$(".custom_left").stop(true, false).animate({left: "-250"}, 800, 'easeInQuint');        
		}, 1000);    
	});  
	</script>
	
</div>
<?php } ?>

<div id="notification" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" style="font-family: "Roboto Condensed",sans-serif!important;"><?php if($theme_options->get( 'confirmation_text', $config->get( 'config_language_id' ) ) != '') { echo $theme_options->get( 'confirmation_text', $config->get( 'config_language_id' ) ); } else { echo 'Confirmation'; } ?></h4>
            </div>
            <div class="modal-body">
                <p></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="button modal-left-button"  data-dismiss="modal"><?php if($theme_options->get( 'continue_shopping_text', $config->get( 'config_language_id' ) ) != '') { echo $theme_options->get( 'continue_shopping_text', $config->get( 'config_language_id' ) ); } else { echo 'Continue shopping'; } ?></button>
                <a href="<?php echo $shopping_cart; ?>" class="button modal-right-button"><?php if($theme_options->get( 'checkout_text', $config->get( 'config_language_id' ) ) != '') { echo $theme_options->get( 'checkout_text', $config->get( 'config_language_id' ) ); } else { echo 'View Cart'; } ?></a>
            </div>
        </div>
    </div>
</div>

<div id="quickview" class="modal fade bs-example-modal-lg">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" style="text-align:left;" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Product</h4>
            </div>
            <div class="modal-body">
                <p></p>
            </div>
        </div>
    </div>
</div>



<?php if($theme_options->get( 'quick_view' ) != '0') { ?>

<script type="text/javascript">
	$('body').on('click', '.quickview a', function () {
		$('#quickview .modal-header .modal-title').html($(this).attr('title'));
		$('#quickview .modal-body').load($(this).attr('rel') + ' #quickview_product' ,function(result){
		    $('#quickview').modal('show');
		    $('#quickview .popup-gallery').magnificPopup({
		    	delegate: 'a',
		    	type: 'image',
		    	tLoading: 'Loading image #%curr%...',
		    	mainClass: 'mfp-img-mobile',
		    	gallery: {
		    		enabled: true,
		    		navigateByImgClick: true,
		    		preload: [0,1] // Will preload 0 - before current, and 1 after the current image
		    	},
		    	image: {
		    		tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
		    		titleSrc: function(item) {
		    			return item.el.attr('title');
		    		}
		    	}
		    });
		});
		return false;
	});
	
	$('#quickview').on('click', '#button-cart', function () {
		$('#quickview').modal('hide');
		cart.add($(this).attr("rel"));
	});
</script>
<?php } ?>



<header>

<!-- Column Left Fixed -->
<?php if($config->get( 'config_maintenance' ) == 0) { ?>
		<?php 
		$clfixed = $modules->getModules('clfixed');
		 ?>
		<div id="column_left_fixed" class="sb-slidebar sb-momentum-scrolling sb-left visible-lg col-sm-2 tg-padding-right sb-width-custom">
			<div class="tg-logo"><a href="<?php echo $home; ?>"><?php if($theme_options->get( 'clfixed_text', $config->get( 'config_language_id' ) ) != '') { echo html_entity_decode($theme_options->get( 'clfixed_text', $config->get( 'config_language_id' ) )); } else { echo 'Superstar'; } ?></a></div>
				<span class="tg-close sb-close"></span>
			<div class="clfixed_wrapper">

				<?php if($theme_options->get( 'social_status' ) == 1) { ?>
									<div style="margin-bottom: 10px; margin-top: 20px;">
										<?php if($customfooter['facebook_link'] != '') { ?>
											<a href="<?php echo $customfooter['facebook_link']; ?>" class="fa fa-facebook facebook" target="_blank" style="font-size: 18px; "></a>
										<?php } ?>
										<?php if($customfooter['twitter_link'] != '') { ?>
											<a href="<?php echo $customfooter['twitter_link']; ?>" class="fa fa-twitter twitter" target="_blank" style="font-size: 18px; "></a>
										<?php } ?>	
																		
																		<?php if($customfooter['instagram_link'] != '') { ?>
																			
																				<a href="<?php echo $customfooter['instagram_link']; ?>" class="fa fa-instagram instagram" target="_blank" style="font-size: 18px; "></a>
																			
																		<?php } ?>	
																			
																		<?php if($customfooter['googleplus_link'] != '') { ?>
																			
																				<a href="<?php echo $customfooter['googleplus_link']; ?>" class="fa fa-google-plus googleplus" target="_blank" style="font-size: 18px; "></a>
																			
																		<?php } ?>	
																		
																		<?php if($customfooter['pinterest_link'] != '') { ?>
																			
																				<a href="<?php echo $customfooter['pinterest_link']; ?>" class="fa fa- fa-pinterest pinterest" target="_blank" style="font-size: 18px; "></a>
																			
																		<?php } ?>	
																		
																		<?php if($customfooter['youtube_link'] != '') { ?>
																			
																				<a href="<?php echo $customfooter['youtube_link']; ?>" class="fa fa- fa-youtube youtube" target="_blank" style="font-size: 18px; "></a>
																			
																		<?php } ?>	
																		
																		<?php if($customfooter['flickr_link'] != '') { ?>
																			
																				<a href="<?php echo $customfooter['flickr_link']; ?>" class="fa fa- fa-flickr flickr" target="_blank" style="font-size: 18px; "></a>
																			
																		<?php } ?>	
																		
																		<?php if($customfooter['vimeo_link'] != '') { ?>
																			
																				<a href="<?php echo $customfooter['vimeo_link']; ?>" class="fa fa-  fa-vimeo-square vimeo" target="_blank" style="font-size: 18px; "></a>
																		
																		<?php } ?>	
																		
																		<?php if($customfooter['tumblr_link'] != '') { ?>
																			
																				<a href="<?php echo $customfooter['tumblr_link']; ?>" class="fa fa- fa-tumblr tumblr" target="_blank" style="font-size: 18px; "></a>
																			
																		<?php } ?>	
									</div>
								<?php } ?>
								
				<?php
					foreach ($clfixed as $module) {
					echo $module;
					}
				?>
			</div>	
		</div>
<?php } ?>		
<script>
  (function($) {
    $(document).ready(function() {
      $.slidebars({
        siteClose: true, // true or false
        scrollLock: true // true or false
      });
    });
  }) (jQuery);
</script>
<div id="sb-site">
		<div id="header-holder">
					<div id="top-line" class="fixed-body">
						
						<div id="main" class="main-fixed" style="padding-top: 0px;">
							<div class="container">
								<div class="row">

									
									<!-- Top Line -->
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div id="welcome">
											<?php if($theme_options->get( 'welcome_text', $config->get( 'config_language_id' ) ) != '') { echo html_entity_decode($theme_options->get( 'welcome_text', $config->get( 'config_language_id' ) )); } else { echo ''; } ?>
										</div>
									</div>	
							  
									<div class="col-sm-8 col-xs-12 hidden-xs">
										
											<div class="quick-access">
												<div class="dropdown">
													<div id="my-account">
														<?php if($theme_options->get( 'hotline_text', $config->get( 'config_language_id' ) ) != '') { ?> <span class="fa fa-phone" style="margin-right: 5px; font-size: 14px;"></span> <?php  echo html_entity_decode($theme_options->get( 'hotline_text', $config->get( 'config_language_id' ) )); } else { echo ''; } ?>
													
													</div>
												</div>
											
												<div class="dropdown  my-account tg-account hidden-xs hidden-sm">
													<div id="my-account">
														<div class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
															<?php if ($logged) { ?>
															<?php echo $text_account; ?>&nbsp;&nbsp<span class="fa fa-angle-down"></span>
															<?php } else { ?>
															<?php echo $text_login; ?>&nbsp;&nbsp<span class="fa fa-angle-down"></span>
															<?php } ?>
														</div>
														
														<ul class="dropdown-menu"  role="menu">
															<?php if ($logged) { ?>
															<li><a href="<?php echo $wishlist; ?>" id="wishlist-total"><?php echo $text_wishlist; ?></a></li>
															<li><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li>
															
															<li><a href="<?php echo $shopping_cart; ?>"><?php echo $text_shopping_cart; ?></a></li>
															<li><a href="<?php echo $checkout; ?>"><?php echo $text_checkout; ?></a></li>
															<li><a href="<?php echo $logout; ?>"><?php echo $text_logout; ?></a></li>
															<?php } else { ?>
															<li><a href="<?php echo $register; ?>"><?php echo $text_register; ?></a></li>
															<li><a href="<?php echo $login; ?>"><?php echo $text_login; ?></a></li>
															<li><a href="<?php echo $shopping_cart; ?>"><?php echo $text_shopping_cart; ?></a></li>
															<li><a href="<?php echo $checkout; ?>"><?php echo $text_checkout; ?></a></li>
															<?php } ?>
														</ul>	
													</div>	
												</div>
												
												
												<div class="dropdown  my-account currency">
													<?php echo $currency; ?>
												</div>

												<div class="dropdown  my-account language">
													<?php echo $language; ?>
												</div>
											
											</div>		
									</div>
									
									<div class="visible-xs col-xs-12" style="text-align:center;display:inline-block;">
										<div class="my-account"	style="display:inline-block!important;">
													<?php echo $currency; ?>
												</div>
										<div class="my-account"	style="display:inline-block!important;">
													<?php echo $language; ?>
										</div>
										
										<div class="my-login"	style="display:inline-block!important;">
											<div class="dropdown" style="float: none;">
													
														<div class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
															<?php if ($logged) { ?>
															<?php echo $text_account; ?>&nbsp;&nbsp<span class="fa fa-angle-down"></span>
															<?php } else { ?>
															<?php echo $text_login; ?>&nbsp;&nbsp<span class="fa fa-angle-down"></span>
															<?php } ?>
														</div>
														
														<ul class="dropdown-menu">
															<?php if ($logged) { ?>
															<li><a href="<?php echo $wishlist; ?>" id="wishlist-total"><?php echo $text_wishlist; ?></a></li>
															<li><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li>
															
															<li><a href="<?php echo $shopping_cart; ?>"><?php echo $text_shopping_cart; ?></a></li>
															<li><a href="<?php echo $checkout; ?>"><?php echo $text_checkout; ?></a></li>
															<li><a href="<?php echo $logout; ?>"><?php echo $text_logout; ?></a></li>
															<?php } else { ?>
															<li><a href="<?php echo $register; ?>"><?php echo $text_register; ?></a></li>
															<li><a href="<?php echo $login; ?>"><?php echo $text_login; ?></a></li>
															<li><a href="<?php echo $shopping_cart; ?>"><?php echo $text_shopping_cart; ?></a></li>
															<li><a href="<?php echo $checkout; ?>"><?php echo $text_checkout; ?></a></li>
															<?php } ?>
														</ul>	
													
											</div>
										</div>	
									</div>
									
									
								</div>
							</div>	
						</div>	
					</div>
					
					<div id="header" class="fixed-body">
						<div id="main" class="main-fixed" style="padding-top: 0px;">
							<div class="container">
								<div class="row">
							
									<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 logo-inner">
										<div class="logo-store" >
											<a href="<?php echo $home; ?>">
												<img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" />
											</a>
										</div>
									</div>
									
									<!-- Search Holder -->
									<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 hidden-xs">
												<div id="search" style="padding: 0px;">
													<input type="text" name="search" placeholder="<?php if($theme_options->get( 'search_text', $config->get( 'config_language_id' ) ) != '') { echo html_entity_decode($theme_options->get( 'search_text', $config->get( 'config_language_id' ) )); } else { echo 'Search'; } ?>" value="" />
													<span class="button-search fa fa-search"></span>
												</div>
									</div>	
									
									<div id="header-right" class="col-lg-2 col-md-2 col-sm-2 hidden-xs">
												<?php echo $cart; ?>						
									</div>	
								</div>
							</div>
						</div>	
					</div>	
					
					
					<div class="fixed-body">
					<div id="main" class="main-fixed" style="padding-top: 0px!important;">
					<div class="visible-xs col-xs-12" style="text-align:center;display:inline-block;margin-top:10px; margin-bottom:20px;">
								
							
												<div id="welcome" style="margin-bottom: 10px;">
													<?php if($theme_options->get( 'hotline_text', $config->get( 'config_language_id' ) ) != '') { ?> <span class="fa fa-phone" style="margin-right: 5px; font-size: 14px;"></span> <?php  echo html_entity_decode($theme_options->get( 'hotline_text', $config->get( 'config_language_id' ) )); } else { echo ''; } ?>
												</div>
							
								
								<a href="<?php echo $shopping_cart; ?>">
								<div class="tg-search" style="display:inline-block;">
									<span class="fa fa-shopping-cart"></span>
								</div>	
								</a>
								<div class="tg-search" style="display:inline-block;">
												<div id="tg-search2">
													<div class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
														<span class="fa fa-search"></span>
													</div>
													
													<ul class="dropdown-menu keep_open">
														<li>
														
														<div id="search">
																<input type="text" name="search2" placeholder="<?php if($theme_options->get( 'search_text', $config->get( 'config_language_id' ) ) != '') { echo html_entity_decode($theme_options->get( 'search_text', $config->get( 'config_language_id' ) )); } else { echo 'Search'; } ?>" value="" />
																<span class="button-search2 fa fa-search"></span>
														</li>
													</ul>	
												</div>	
								</div>	
								
							
					</div>	
					
		</div>	

		<?php 
					$menu = $modules->getModules('menu');
					if( count($menu) ) {
						foreach ($menu as $module) {
							echo $module;
						}
					} elseif($categories) {
					?>
						<?php if($config->get( 'config_maintenance' ) == 0) { ?>
							<div class="sb-toggle-left tg-navbar visible-lg">
								<div class="navicon-line"></div>
								<div class="navicon-line"></div>
								<div class="navicon-line"></div>
							</div>
						<?php } ?>
					<div class="horizontal">
						<div id="megaMenuToggle">
							<div class="megamenuToogle-wrapper">
								<div class="megamenuToogle-pattern">
									<div class="container">
										<?php if($theme_options->get( 'menu_text', $config->get( 'config_language_id' ) ) != '') { echo html_entity_decode($theme_options->get( 'menu_text', $config->get( 'config_language_id' ) )); } else { echo 'menu'; } ?>
									</div>
								</div>
							</div>
						</div>
						<div id="tg-menu">
							<div id="main" class="main-fixed" style="padding-top: 0px!important;">
								<div class="container">
									<div class="megamenu-wrapper">
										<div class="megamenu-pattern">
											<div class="container">
												<ul class="megamenu">
													
													<?php foreach ($categories as $category) { ?>
													<?php if ($category['children']) { ?>
													<li class="with-sub-menu hover"><p class="close-menu"></p>
														<a href="<?php echo $category['href'];?>"><span><strong><?php echo $category['name']; ?></strong></span></a>
													<?php } else { ?>
													<li>
														<a href="<?php echo $category['href']; ?>"><span><strong><?php echo $category['name']; ?></strong></span></a>
													<?php } ?>
														<?php if ($category['children']) { ?>
														<?php 
															$width = '100%';
															$row_fluid = 3;
															if($category['column'] == 1) { $width = '220px'; $row_fluid = 12; }
															if($category['column'] == 2) { $width = '500px'; $row_fluid = 6; }
															if($category['column'] == 3) { $width = '700px'; $row_fluid = 4; }
														?>
														<div class="sub-menu" style="width: <?php echo $width; ?>">
															<div class="content">
																<div class="row hover-menu">
																	<?php for ($i = 0; $i < count($category['children']);) { ?>
																	<div class="col-sm-<?php echo $row_fluid; ?>">
																		<div class="menu">
																			<ul>
																			  <?php $j = $i + ceil(count($category['children']) / $category['column']); ?>
																			  <?php for (; $i < $j; $i++) { ?>
																			  <?php if (isset($category['children'][$i])) { ?>
																			  <li><a href="<?php echo $category['children'][$i]['href']; ?>" onclick="window.location = '<?php echo $category['children'][$i]['href']; ?>';"><?php echo $category['children'][$i]['name']; ?></a></li>
																			  <?php } ?>
																			  <?php } ?>
																			</ul>
																		</div>
																	</div>
																	<?php } ?>
																</div>
															</div>
														</div>
														<?php } ?>
													</li>
													<?php } ?>
												</ul>
											</div>
										</div>
									</div>
								</div	
							</div>
						</div>			
					</div>
					</div>
					</div>
					<?php
					}
					?>
								
				<?php $slideshow = $modules->getModules('slideshow'); ?>
			<?php  if(count($slideshow)) { ?>
			<!-- Slider -->
			<div id="slider" class="full-width">
						<?php foreach($slideshow as $module) { ?>
						<?php echo $module; ?>
						<?php } ?>
			</div>
			<?php } ?>			

	


<div class="fixed-body">
		<div id="main" class="main-fixed">

		
		
		
