</div>
</div>
</div>
<?php 
if($registry->has('theme_options') == true) { 
	$theme_options = $registry->get('theme_options');
	$config = $registry->get('config');
	require_once( DIR_TEMPLATE.$config->get($config->get('config_theme') . '_directory')."/lib/module.php" );
	$modules = new Modules($registry);
	
	$language_id = $config->get( 'config_language_id' );
	$customfooter = $theme_options->get( 'customfooter' );
	
			$grids = 3; $columns = 0;  

			if($theme_options->get( 'custom_footer1_status' ) == '1') { $columns++; }
			if($theme_options->get( 'custom_footer2_status' ) == '1') { $columns++; }
			if($columns == 1) { $grids = 25; }
			if($columns == 2) { $grids = 2; }

	
	?>

	
	
	<!-- FOOTER
		================================================== -->
	<div class="footer full-width footer-holder">
				<div class="container">
					<?php 
					$footer_top = $modules->getModules('footer_top');
					if( count($footer_top) ) { 
						foreach ($footer_top as $module) {
							echo $module;
						}
					} ?>
					<div class="row">
					
						<?php if($theme_options->get( 'custom_footer1_status' ) == 1) { ?>
							<div class="col-sm-<?php echo $grids; ?> col-xs-6 footer-column">
									<?php $lang_id = $config->get( 'config_language_id' ); ?>
									<?php $custom_content = $theme_options->get( 'custom_footer1_content' ); ?>
									<?php if(isset($custom_content[$lang_id])) echo html_entity_decode($custom_content[$lang_id]); ?>
							</div>
						<?php } ?>
						
						<?php if($theme_options->get( 'custom_footer2_status' ) == 1) { ?>
							<div class="col-sm-<?php echo $grids; ?> col-xs-6 footer-column">
									<?php $lang_id = $config->get( 'config_language_id' ); ?>
									<?php $custom_content = $theme_options->get( 'custom_footer2_content' ); ?>
									<?php if(isset($custom_content[$lang_id])) echo html_entity_decode($custom_content[$lang_id]); ?>
							</div>
						<?php } ?>
						

						
						<!-- Information -->
						<div class="col-sm-<?php echo $grids; ?> col-xs-6 footer-column">
							<h4><?php echo $text_information; ?></h4>
							
							<ul>
								<?php foreach ($informations as $information) { ?>
								<li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
								<?php } ?>
							</ul>
						</div>
						
						<!-- Customer Service -->
						<div class="col-sm-<?php echo $grids; ?> col-xs-6 footer-column">
							<h4><?php echo $text_service; ?></h4>
							
							<ul>
								<li><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li>
								<li><a href="<?php echo $return; ?>"><?php echo $text_return; ?></a></li>
								<li><a href="<?php echo $sitemap; ?>"><?php echo $text_sitemap; ?></a></li>
							</ul> 
						</div>
						
						<!-- Extras -->
						<div class="col-sm-<?php echo $grids; ?> col-xs-6 footer-column">
							<h4><?php echo $text_extra; ?></h4>
							
							<ul>
								<li><a href="<?php echo $manufacturer; ?>"><?php echo $text_manufacturer; ?></a></li>
								<li><a href="<?php echo $voucher; ?>"><?php echo $text_voucher; ?></a></li>
								<li><a href="<?php echo $affiliate; ?>"><?php echo $text_affiliate; ?></a></li>
								<li><a href="<?php echo $special; ?>"><?php echo $text_special; ?></a></li>
							</ul>
						</div>
						
						<!-- My Account -->
						<div class="col-sm-<?php echo $grids; ?> col-xs-6 footer-column">
							<h4><?php echo $text_account; ?></h4>
							
							<ul>
								<li><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li>
								<li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
								<li><a href="<?php echo $wishlist; ?>"><?php echo $text_wishlist; ?></a></li>
								<li><a href="<?php echo $newsletter; ?>"><?php echo $text_newsletter; ?></a></li>
							</ul>
						</div>
					
				
					</div>
					
			

					<div class="newsletter-holder">
						<div class="col-sm-8" style="padding: 0;">
								
								<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 newsletter-text" style="padding-left:0px"><?php if($theme_options->get( 'subscribe_text', $config->get( 'config_language_id' ) ) != '') { echo html_entity_decode($theme_options->get( 'subscribe_text', $config->get( 'config_language_id' ) )); } else { echo 'Subscribe Us'; } ?></div>
										
								<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12"><input type="text" value="" name="email" id="newsletter_email" class="form-control" /></div>
								<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 newsletter-button"><button class="button" id="button-newsletter"><?php if($theme_options->get( 'signup_text', $config->get( 'config_language_id' ) ) != '') { echo html_entity_decode($theme_options->get( 'signup_text', $config->get( 'config_language_id' ) )); } else { echo 'Sign Up'; } ?></a></div>


								<script type="text/javascript"><!--
								$('#button-newsletter').on('click', function() {
									$.ajax({
										url: 'index.php?route=extension/module/newsletter/validate',
										type: 'post',
										data: $('#newsletter_email'),
										dataType: 'json',
										beforeSend: function() {
											$('#button-newsletter').prop('disabled', true);
											$('#button-newsletter').after('<i class="fa fa-spinner"></i>');
										},	
										complete: function() {
											$('#button-newsletter').prop('disabled', false);
											$('.fa-spinner').remove();
										},				
										success: function(json) {
											if (json['error']) {
												alert(json['error']['warning']);
											} else {
												alert(json['success']);
												
												$('#newsletter_email').val('');
											}
										}
									});	
								});	
								$('#newsletter_email').on('keydown', function(e) {
									if (e.keyCode == 13) {
										$('#button-newsletter').trigger('click');
									}
								});
								//--></script> 
						</div>	
						
						<?php if($theme_options->get( 'social_status' ) == 1) { ?>
							<div class="col-sm-4 social-holder" style="padding: 0;">
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
					</div>		

				
				
				</div>
				
				
				
				
				
	</div>
	
	<!-- COPYRIGHT
		================================================== -->
			<div class="copyright">
				
						<div class="container">
							<div class="pattern">
									<!--
									OpenCart is open source software and you are free to remove the powered by OpenCart if you want, but its generally accepted practise to make a small donation.
									Please donate via PayPal to donate@opencart.com
									//-->
									<p class="copyright-left">
									Copyright © 2017 福建省南安多美声电子有限公司 | 闽ICP备17030571号-1
									
									</p>
									<!--
									OpenCart is open source software and you are free to remove the powered by OpenCart if you want, but its generally accepted practise to make a small donation.
									Please donate via PayPal to donate@opencart.com
									//-->
									
								<?php if(is_array($theme_options->get( 'payment' ))) { if($theme_options->get( 'payment_status' ) != '0') { ?>
						
							<ul class="copyright-right">
								<?php foreach($theme_options->get( 'payment' ) as $payment) { 
									echo '<li>';
									if($payment['link'] != '') {
										$new_tab = false;
										if($payment['new_tab'] == 1) {
											$new_tab = ' target="_blank"';
										}
										echo '<a href="' .$payment['link']. '"'.$new_tab.'>';
									}
									echo '<img src="image/' .$payment['img']. '" alt="' .$payment['name']. '">';
									if($payment['link'] != '') {
										echo '</a>';
									}
									echo '</li>'; 
								} ?>
							</ul>
					
							<?php } } ?>			
							</div>
							
						</div>
						
				
			</div>
	
	
	
							
					
					
					
	<script type="text/javascript" src="catalog/view/theme/<?php echo $config->get($config->get('config_theme') . '_directory'); ?>/js/megamenu.js"></script>
</div>



<a href="#" class="scrollup"><i class="fa fa-angle-up"></i></a>
</div>
<?php } ?>
</div>
</header>
</body>
</html>