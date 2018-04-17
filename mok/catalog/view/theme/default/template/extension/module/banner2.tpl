<div class="ok_cs_box">
		<?php if($title_href && $title){ ?>
        <div class="ok_cs_title">
            <a href="<?php echo $title_href; ?>">
                <span class="ok_cs__text"><?php echo $title; ?></span>
                <img class="weui-icon-next" src="catalog/view/theme/default/images/home/arrows.png"/>
            </a>
        </div>
		<?php } ?>
		<?php foreach ($banners as $banner) { ?>
        <div class="ok_article_item">
            <a href="<?php echo $banner['link']; ?>">
                <div class="ok_article_img">
                    <img class="lazy" src="catalog/view/theme/default/images/public/lazy.png" data-original="<?php echo $banner['image']; ?>" width="100%"/>
                </div>
                <div class="ok_articel_info">
                    <p class="ok_articel_title"><?php echo $banner['title']; ?></p>
                </div>
            </a>
        </div>
		<?php } ?>
</div>
<?php if($title2_href && $title2) { ?>
<div class="ok_loadmore"><a href="<?php echo $title2_href; ?>"><?php echo $title2; ?><img src="catalog/view/theme/default/images/home/loadmore.jpg" width="100%"/></a></div>
<?php } ?>