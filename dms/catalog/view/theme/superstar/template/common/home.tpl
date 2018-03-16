<?php 
if($registry->has('theme_options') == true) { 
	$theme_options = $registry->get('theme_options');
	$config = $registry->get('config');
	$language_id = $config->get( 'config_language_id' );
	$customfooter = $theme_options->get( 'customfooter' );
	if(!isset($customfooter[$language_id])) {
		$customfooter[$language_id] = array(
			'facebook_status' => 0,
			'contact_status' => 0
		);
	}
$class = 3; 
$id = rand(0, 5000)*rand(0, 5000); 
$all = 4; 
$row = 4; 

?>
<?php } ?>

<?php echo $header;
$theme_options = $registry->get('theme_options');
$config = $registry->get('config'); ?>
<?php 
$grid_center = 12; 
if($column_left != '') { 
	$grid_center = $grid_center-3; 
}

if($column_right != '') { 
	$grid_center = $grid_center-3; 
} 

require_once( DIR_TEMPLATE.$config->get($config->get('config_theme') . '_directory')."/lib/module.php" );
$modules_old_opencart = new Modules($registry); ?>

<!-- MAIN CONTENT
	================================================== -->

	
<div class="main-content full-width home">
			
			<?php $top_content = $modules_old_opencart->getModules('top_content');
			if( count($top_content) ) { ?>
				<div class="container">
					<div class="row" style="margin-bottom: 10px;">						
									<div class="col-sm-12 w-background">
										<?php 
										$top_content = $modules_old_opencart->getModules('top_content');
										if( count($top_content) ) { 
											foreach ($top_content as $module) {
												echo $module;
											}
										} ?>
									</div>				
					</div>
				</div>	
			<?php } ?>
			
			</div>	
			</div>	
			
			<?php $top_left = $modules_old_opencart->getModules('top_left'); $top_right = $modules_old_opencart->getModules('top_right');
			if( count($top_left) || count($top_right) ) { ?>
				<div class="middle-holder">
					<div id="main" class="main-fixed">
						<div class="container">
							<div class="box-heading"><?php if($theme_options->get( 'hotdeal_text', $config->get( 'config_language_id' ) ) != '') { echo html_entity_decode($theme_options->get( 'hotdeal_text', $config->get( 'config_language_id' ) )); } else { echo ''; } ?></div>
									
							<div class="middle-content">
							<div class="row">	
								<div class="col-sm-12">
									<?php $top_left = $modules_old_opencart->getModules('top_left'); $top_right = $modules_old_opencart->getModules('top_right');
									if( count($top_left) || count($top_right) ) { ?>
												<?php 
												if( count($top_left) ) { ?>
													<div class="col-sm-5 hidden-xs" id="top_left">
														<?php
														foreach ($top_left as $module) {
															echo $module;
														}
														?>
													</div>
												<?php } ?>
														
												<?php if( count($top_right) ) { ?> 
													<div class="col-sm-7" id="top_right">
														<?php foreach ($top_right as $module) {
															echo $module;
														} ?>
												</div>
												<?php } ?>
										</div>
									<?php } ?>
								</div>	
							</div>	
						</div>	
					</div>	
				</div> <!-- end of middle holder -->
			<?php } ?>	
			
			
			<?php $column_left = $modules_old_opencart->getModules('column_left'); $column_right = $modules_old_opencart->getModules('column_right'); $content_top = $modules_old_opencart->getModules('content_top');
			if( count($column_left) || count($column_right) || count($content_top) ) { ?>
				<div class="content-top-holder">
					<div id="main" class="main-fixed">
							<div class="container">
									<div class="row">	
										<div class="col-sm-12">
											<?php 
											$columnleft = $modules_old_opencart->getModules('column_left');
											if( count($columnleft) ) { ?>
											<div class="col-sm-3 tg-padding-right" id="column_left tg-home" style="padding-left: 0px;">
												<?php
												foreach ($columnleft as $module) {
													echo $module;
												}
												} ?>
											</div>
											<?php $grid_center = 12; if( count($columnleft) ) { $grid_center = 9; } ?>
											<div class="col-sm-<?php echo $grid_center; ?> tg-padding-left" style="padding-right: 0px;">
												
												<div class="row">
													<?php 
													$grid_content_top = 12; 
													$grid_content_right = 3;
													$column_right = $modules_old_opencart->getModules('column_right'); 
													if( count($column_right) ) {
														if($grid_center == 9) {
															$grid_content_top = 8;
															$grid_content_right = 4;
														} else {
															$grid_content_top = 9;
															$grid_content_right = 3;
														}
													}
													?>
													<div class="col-sm-<?php echo $grid_content_top; ?> w-background">
														<?php 
														$content_top = $modules_old_opencart->getModules('content_top');
														if( count($content_top) ) { 
															foreach ($content_top as $module) {
																echo $module;
															}
														} ?>
													</div>
													
													<?php if( count($column_right) ) { ?> 
													<div class="col-sm-<?php echo $grid_content_right; ?>" id="column_right">
														<?php foreach ($column_right as $module) {
															echo $module;
														} ?>
													</div>
													<?php } ?>
												</div>
											</div>
											<?php  ?>
										</div>	
									</div>
							</div>
						</div>
					</div>
			<?php } ?>
					
					
		
			<?php $middle_topleft = $modules_old_opencart->getModules('middle_topleft'); $middle_top = $modules_old_opencart->getModules('middle_top');	
				if( count($middle_topleft) || count($middle_top) ) { ?>
					<div class="middle-holder">
						<div id="main" class="main-fixed">
							<div class="container">
								<div class="row">	
									<div class="col-sm-12">
											<?php 
												$middle_topleft = $modules_old_opencart->getModules('middle_topleft');
												if( count($middle_topleft) ) { ?>
												<div class="col-sm-3 tg-padding-right" id="middle_topleft" style="padding-left: 0px;">
													<?php
													foreach ($middle_topleft as $module) {
														echo $module;
													}
													} ?>
												</div>
												<?php $grid_center = 12; if( count($middle_topleft) ) { $grid_center = 9; } ?>
												<div class="col-sm-<?php echo $grid_center; ?> tg-padding-left" style="padding-right: 0px;">
													
													<div class="row">
														<?php 
														$grid_middle_top = 12; 
														$grid_content_right = 3;
														$middle_topright = $modules_old_opencart->getModules('middle_topright'); 
														if( count($middle_topright) ) {
															if($grid_center == 9) {
																$grid_middle_top = 8;
																$grid_content_right = 4;
															} else {
																$grid_middle_top = 9;
																$grid_content_right = 3;
															}
														}
														?>
														<div class="col-sm-<?php echo $grid_middle_top; ?> tg-content-top">
															<?php 
															$middle_top = $modules_old_opencart->getModules('middle_top');
															if( count($middle_top) ) { 
																foreach ($middle_top as $module) {
																	echo $module;
																}
															} ?>
														</div>
												
													</div>
												</div>
											<?php  ?>
									</div>	
							</div>	
						</div>	
						</div>	
					</div> <!-- end of Middle Top holder -->	
			<?php } ?>
			
			<?php $mcenterleft = $modules_old_opencart->getModules('mcenterleft'); $middle_center = $modules_old_opencart->getModules('middle_center'); $mcenterright = $modules_old_opencart->getModules('mcenterright');	
			if( count($mcenterleft) || count($middle_center) || count($mcenterright) ) { ?>
					<div class="middle-center-holder">
							<div id="main" class="main-fixed">
								<div class="container">
									<div class="row">	
										<div class="col-sm-12">
												<?php 
													$mcenterleft = $modules_old_opencart->getModules('mcenterleft');
													if( count($mcenterleft) ) { ?>
													<div class="col-sm-3 tg-padding-right" id="mcenterleft" style="padding-left: 0px;">
														<?php
														foreach ($mcenterleft as $module) {
															echo $module;
														}
														} ?>
													</div>
													<?php $grid_center = 12; if( count($mcenterleft) ) { $grid_center = 9; } ?>
													<div class="col-sm-<?php echo $grid_center; ?> tg-padding-left" style="padding-right: 0px;">
														
														<div class="row">
															<?php 
															$grid_middle_center = 12; 
															$grid_content_right = 3;
															$mcenterright = $modules_old_opencart->getModules('mcenterright'); 
															if( count($mcenterright) ) {
																if($grid_center == 9) {
																	$grid_middle_center = 8;
																	$grid_content_right = 4;
																} else {
																	$grid_middle_center = 9;
																	$grid_content_right = 3;
																}
															}
															?>
															<div class="col-sm-<?php echo $grid_middle_center; ?> w-background">
																<?php 
																$middle_center = $modules_old_opencart->getModules('middle_center');
																if( count($middle_center) ) { 
																	foreach ($middle_center as $module) {
																		echo $module;
																	}
																} ?>
															</div>
															
															<?php if( count($mcenterright) ) { ?> 
																<div class="col-sm-<?php echo $grid_content_right; ?>" id="mcenterright">
																	<?php foreach ($mcenterright as $module) {
																		echo $module;
																	} ?>
																</div>
															<?php } ?>
															
														</div>
													</div>
												<?php  ?>
										</div>	
									</div>	
								</div>	
							</div>				
					</div> <!-- end of Middle Center -->	
			<?php } ?>	
			
			
			<?php $mbottomleft = $modules_old_opencart->getModules('mbottomleft'); $middle_bottom = $modules_old_opencart->getModules('middle_bottom');	
			if( count($mbottomleft) || count($middle_bottom) ) { ?>			
						<div id="main" class="main-fixed">
							<div class="container">
								<div class="row">	
									<div class="col-sm-12">
											<?php 
												$mbottomleft = $modules_old_opencart->getModules('mbottomleft');
												if( count($mbottomleft) ) { ?>
												<div class="col-sm-3 tg-padding-right" id="mbottomleft" style="padding-left: 0px;">
													<?php
													foreach ($mbottomleft as $module) {
														echo $module;
													}
													} ?>
												</div>
												<?php $grid_center = 12; if( count($mbottomleft) ) { $grid_center = 9; } ?>
												<div class="col-sm-<?php echo $grid_center; ?> tg-padding-left" style="padding-right: 0px;">
													
													<div class="row">
														<?php 
														$grid_bottom_center = 12; 
														$grid_content_right = 3;
														$mbottomright = $modules_old_opencart->getModules('mbottomright'); 
														if( count($mbottomright) ) {
															if($grid_center == 9) {
																$grid_bottom_center = 8;
																$grid_content_right = 4;
															} else {
																$grid_bottom_center = 9;
																$grid_content_right = 3;
															}
														}
														?>
														<div class="col-sm-<?php echo $grid_bottom_center; ?> tg-home-news">
															<?php 
															$middle_bottom = $modules_old_opencart->getModules('middle_bottom');
															if( count($middle_bottom) ) { 
																foreach ($middle_bottom as $module) {
																	echo $module;
																}
															} ?>
														</div>
														
														<?php if( count($mbottomright) ) { ?> 
														<div class="col-sm-<?php echo $grid_content_right; ?>" id="mbottomright">
															<?php foreach ($mbottomright as $module) {
																echo $module;
															} ?>
														</div>
														<?php } ?>
													</div>
												</div>
											<?php  ?>
									</div>	
								</div>	
						</div>				
					</div> <!-- end of Middle Bottom -->
			<?php } ?>	
			
			<?php $content_bottom = $modules_old_opencart->getModules('content_bottom');
			if( count($content_bottom) ) { ?>	
				<!-- Content Bottom -->
				<div id="main" class="main-fixed">
							<div class="container">
								<div class="row">	
									<div class="col-sm-12 w-background">
										<?php 
										$content_bottom = $modules_old_opencart->getModules('content_bottom');
										if( count($content_bottom) ) { 
											foreach ($content_bottom as $module) {
												echo $module;
											}
										} ?>
									</div>	
								</div>	
							</div>	
				</div>				
			<?php } ?>
			
	
<?php echo $footer; ?>