		<?php
				//call by framework Auto Search
           // $searchtmp = $this->config->get('pavautosearch_module');
            //$configsearch = reset($searchtmp);
           // $statusSearch = ($configsearch['status'])?1:0;

			//$autosearch = empty($configsearch)?'':$helper->renderModule( 'module/pavautosearch' );
			//$configVerticalmenu = $this->config->get('pavverticalmenu_module');
			//$verticalmenu = empty($configVerticalmenu)?'':$helper->renderModule( 'module/pavverticalmenu' );


        $objlang = $this->registry->get('language');

        $autosearch = $helper->renderModule( 'pavautosearch' );
        $megamenu = $helper->renderModule('pavmegamenu');
        $verticalmenu=$helper->renderModule('pavverticalmenu');
		?>
        <div class="has-verticalmenu">
            <header id="header">
                <div id="header-main" class="hasverticalmenu">
                    <div class="container">
                        <div class="row">
                            <div class="logo inner  col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <?php if( $logoType=='logo-theme'){ ?>
                                <div id="logo-theme" class="logo-store pull-left">
                                    <a href="<?php echo $home; ?>">
                                        <span><?php echo $name; ?></span>
                                    </a>
                                </div>
                                <?php } elseif ($logo) { ?>
                                <div id="logo" class="logo-store pull-left"><a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" /></a></div>
                                <?php } ?>
								
                                <div class="logo-cart pull-right">
									<a href="<?php echo $shopping_cart; ?>"><div class="icon-cart"></div>
									<span class="pull-right" id="logo-cart-total"><?php echo $text_items; ?></span></a>
								</div>
                            </div>
							
                            <?php if (isset($autosearch) &&  !empty($autosearch)) { ?>
                            <div class="inner col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div id="search-auto" class=" search-box search-wrapper clearfix clearfix">
                                    <?php echo $autosearch ?>
                                </div>
                            </div>
                            <?php } else { ?>
                            <div id="search" class="inner col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="quick-access">
                                    <?php echo $search; ?>
                                </div>
                            </div>
                            <?php } ?>

                            <div id="cart-top" class=" inner col-lg-3 col-md-3 col-sm-3 hidden-xs">
                                <div class="cart-top">
                                    <?php echo $cart; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <section id="pav-masshead" class="pav-masshead aligned-right">
                <div class="container">
                    <div class="inner row clearfix">
                        <div id="hideverticalmenu" class="col-lg-3 col-md-3 col-sm-4 hidden-xs">
                            <?php if(!empty($verticalmenu)) { ?>
                            <?php echo $verticalmenu; ?>
                            <?php } ?>
                        </div>
                        <div id="pav-mainnav" class="col-lg-9 col-md-9 col-sm-12">
                            <?php
                            /**
                            * Main Menu modules: as default if do not put megamenu, the theme will use categories menu for main menu
                            */
                            $modules = $helper->renderModule('pavmegamenu');
                            if (count($modules) && !empty($modules)) { ?>
                            <?php echo $modules; ?>
                            <?php } elseif ($categories) {  ?>
                                <nav id="mainmenutop" class="pav-megamenu" role="navigation">
                                    <div class="navbar-header pull-right">
                                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                                            <span class="sr-only">Toggle navigation</span>
                                            <span class="fa fa-bars"></span>
                                        </button>
                                    </div>

                                    <div class="collapse navbar-collapse navbar-ex1-collapse">
                                        <ul class="nav navbar-nav">
                                            <li><a href="<?php echo $home; ?>" title="<?php echo $objlang->get('text_home');?>"><?php echo $objlang->get('text_home');?></a></li>
                                            <?php foreach ($categories as $category) { ?>

                                            <?php if ($category['children']) { ?>
                                            <li class="parent dropdown deeper ">
                                                <a href="<?php echo $category['href'];?>" class="dropdown-toggle" data-toggle="dropdown"><?php echo $category['name']; ?>
                                                    <b class="fa fa-angle-down"></b>
                                                    <span class="triangles"></span>
                                                </a>
                                                <?php } else { ?>
                                            <li>
                                                <a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
                                                <?php } ?>
                                                <?php if ($category['children']) { ?>
                                                <ul class="dropdown-menu">
                                                    <?php for ($i = 0; $i < count($category['children']);) { ?>
                                                    <?php $j = $i + ceil(count($category['children']) / $category['column']); ?>
                                                    <?php for (; $i < $j; $i++) { ?>
                                                    <?php if (isset($category['children'][$i])) { ?>
                                                    <li><a href="<?php echo $category['children'][$i]['href']; ?>"><?php echo $category['children'][$i]['name']; ?></a></li>
                                                    <?php } ?>
                                                    <?php } ?>
                                                    <?php } ?>
                                                </ul>
                                                <?php } ?>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </nav>
                            <?php } ?>
                        </div>

                    </div>
                </div>
            </section>
        </div>


 