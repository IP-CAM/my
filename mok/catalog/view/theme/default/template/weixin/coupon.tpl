<?php echo $header; ?>

<div class="weui-search-bar">
    <div class="weui-search-bar__form">
        <div class="weui-search-bar__box">
            <input type="search" class="weui-search-bar__input" placeholder="<?php echo $text_input_info;?>" id="searchInput">
        </div>
    </div>
    <a href="javascript:void(0);" class="weui-search-bar__cancel-btn"><?php echo $text_search;?></a>
</div>
<ul class="ok_coup_list">
    <?php if ($coupons) {
        foreach ($coupons as $row) {
    ?>
    <li>
            <div class="ok_coup_item">
                <div class="ok_coup_top">
                    <div class="ok_coup_left">
                        <span class="ok_left_tag">￥</span>
                        <span class="ok_left_num"><?php echo (int)$row['discount']; ?></span>
                    </div>
                    <div class="ok_coup_right">
                        <p class="ok_scope"><?php echo $row['coupon_name']; ?></p>
                        <p class="ok_range"><?php echo $text_full.(int)$row['price_conditions'].$text_minus; ?></p>
                    </div>
                </div>
                <div class="ok_coup_bottom">
                    <span class="ok_validity"><?php echo $text_valid_time.$row['date_start'].$text_expire.$row['date_end']; ?></span>
                    <span class="ok_use"><?php echo $row['use_product_str']; ?></span>
                </div>
            </div>
    </li>
    <?php
        }
    }
    ?>
</ul>
<a href="#" class="ok_help"><i class="ok_help_icon">?</i><?php echo $text_use_directions;?></a>

<?php echo $footer; ?>