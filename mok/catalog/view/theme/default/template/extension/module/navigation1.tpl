<!-- 首页/来看 顶部导航 -->
<header class="weui-flex ok_head">
    <a href="<?php echo $search; ?>" class="ok_head_item ok_search">
        <img src="catalog/view/theme/default/images/home/search.png" width="100%"/>
    </a>
	<?php foreach($navs as $key=>$nav) { ?>
		<?php if($key>2){break;} ?>
		<?php if(strpos($nav['href'],$ok_head_on_url)) { ?>
		<a href="<?php echo $nav['href']; ?>" class="weui-flex__item"><span class="ok_head_text ok_head_on"><?php echo $nav['title']; ?></span></a>
		<?php }else{ ?>
		<a href="<?php echo $nav['href']; ?>" class="weui-flex__item"><span class="ok_head_text"><?php echo $nav['title']; ?></span></a>
		<?php } ?>
	<?php } ?>
    <a href="<?php echo $cart; ?>" class="ok_head_item ok_cart">
        <img src="catalog/view/theme/default/images/home/shoppingcart.png" width="100%"/>
		<i class="ok_cart_num"><?php echo $amount; ?></i>
    </a>
</header>