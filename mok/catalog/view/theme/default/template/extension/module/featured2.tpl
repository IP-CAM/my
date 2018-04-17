<!-- 单品爆款推荐倒计时 -->
<div class="ok_cs_box">
		<?php if($title && $title_href){ ?>
        <div class="ok_cs_title">
            <a href="<?php echo $title_href; ?>">
                <span class="ok_cs__text"><?php echo $title; ?></span>
                <img class="weui-icon-next" src="catalog/view/theme/default/images/home/arrows.png"/>
            </a>
        </div>
		<?php } ?>
		<?php foreach($products as $product) { ?>
        <div class="weui-flex ok_ms">
            <div class="weui-flex__item">
                <div class="ok_ms_box" data-time="<?php echo $product['date_end']; ?>">
                    <p class="ok_ms_title"><?php echo $text_today; ?></p>
                    <p class="ok_ms_over"><?php echo $text_end; ?></p>
                    <div class="ok_ms_count">
                        <span class="ok_time ok_hour">00</span>
                        <span class="we_dot_box">
                            <i class="mx_dot mx_dot_top"></i>
                            <i class="mx_dot mx_dot_bottom"></i>
                        </span>
                        <span class="ok_time ok_min">00</span>
                        <span class="we_dot_box">
                            <i class="mx_dot mx_dot_top"></i>
                            <i class="mx_dot mx_dot_bottom"></i>
                        </span>
                        <span class="ok_time ok_sec">00</span>
                    </div>
					<?php if($product['special']){ ?>
                    <p class="ok_ms_price"><span><?php echo $product['special']; ?></span><del><?php echo $product['price']; ?></del></p>
					<?php }else{ ?>
					<p class="ok_ms_price"><span><?php echo $product['price']; ?></span></p>
					<?php } ?>
                </div>
            </div>
            <div class="weui-flex__item">
                <a href="<?php echo $product['href']; ?>">
                    <div class="ok_ms_img">
                        <img src="<?php echo $product['thumb']; ?>" width="100%"/>
                    </div>
                </a>
            </div>
        </div>
		<?php } ?>
    </div>

