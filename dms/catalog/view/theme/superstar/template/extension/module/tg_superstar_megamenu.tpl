<?php $theme_options = $registry->get('theme_options');
$config = $registry->get('config');
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
							<ul class="megamenu">

							
								<?php
									foreach($menu as $row) {
										$class = '';
										$class_link = 'clearfix';
										$title = false;
										$target = false;
										if($row['description'] != '') { $class_link .= ' description'; }
										if(is_array($row['submenu']) && !empty($row['submenu'])) { $class .= 'with-sub-menu'; if($row['submenu_type'] == 1) { $class .= ' click'; } else { $class .= ' hover'; } }
										if($row['position'] == 1) { $class .= ' pull-right'; }
										if($row['submenu_type'] == 2) { $title = 'title="hover-intent"'; }
										if($row['new_window'] == 1) { $target = 'target="_blank"'; }
										if(!isset($row['name'][$lang_id])) { $row['name'][$lang_id] = 'Set name'; }
										echo "<li class='".$class."' ".$title."><p class='close-menu'></p>";
										echo "<a href='".$row['link']."' class='".$class_link."' ".$target."><span>".$row['icon'].$row['name'][$lang_id].$row['description']."</span>";
										if(is_array($row['submenu']) && !empty($row['submenu'])) {echo '&nbsp;&nbsp;&nbsp;<span class="fa fa-angle-down hidden-xs hidden-sm hidden-md"></span>'; }
										echo "</a>";
											if(is_array($row['submenu']) && !empty($row['submenu'])) {
												
												echo '<div class="sub-menu" style="width:'.$row['submenu_width'].'">';
												
												
													echo '<div class="content">';
														echo '<div class="row">';
															$row_fluid = 0;
															foreach($row['submenu'] as $submenu) {
																if(($row_fluid+$submenu['content_width']) > 12) {
																	$row_fluid = $submenu['content_width'];
																	echo '</div><div class="border"></div><div class="row">';
																} else {
																	$row_fluid = $row_fluid+$submenu['content_width'];
																}
																echo '<div class="col-sm-'.$submenu['content_width'].'">';
																	if($submenu['content_type'] == '0') {
																		echo $submenu['html'];
																	} elseif($submenu['content_type'] == '1') {
																		if(is_array($submenu['product'])) {
																			echo '<div class="product">';
																				echo '<div class="image"><a href="'.$submenu['product']['link'].'" onclick="window.location = \''.$submenu['product']['link'].'\';"><img src="'.$submenu['product']['image'].'" alt=""></a></div>';
																				echo '<div class="name"><a href="'.$submenu['product']['link'].'" onclick="window.location = \''.$submenu['product']['link'].'\';">'.$submenu['product']['name'].'</a></div>';
																				echo '<div class="price">';
																					if (!$submenu['product']['special']) {
																						echo $submenu['product']['price'];
																					} else {
																						echo $submenu['product']['special'];
																					}
																				echo '</div>';
																			echo '</div>';
																		}
																	} elseif($submenu['content_type'] == '2') {
																		echo $submenu['categories'];
																	}
																echo '</div>';
															}
														echo '</div>';
													echo '</div>';
												echo '</div>';
											}
										echo "</li>";
										echo "\n";
									}
								?>
							</ul>
					</div>
				</div>
			</div>
		</div>	
	</div>	
</div>

<script type="text/javascript">
transition = '<?php if($settings['animation'] != '') { echo $settings['animation']; } else { echo 'none'; } ?>';
animation_time = <?php if($settings['animation_time'] > 0 && $settings['animation_time'] < 5000) { echo $settings['animation_time']; } else { echo 500; } ?>;
</script>
