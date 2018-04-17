<!-- 来买顶部导航 -->
<div class="weui-search-bar">
        <div class="weui-search-bar__box">
            <i class="weui-icon-search"></i>
            <input type="search" name="search" class="weui-search-bar__input" placeholder="<?php echo $text_search_placeholder; ?>" id="searchInput"/>
        </div>
    <a href="<?php echo $cart; ?>" class="weui-search-bar__cancel-btn">
        <span class="ok_cart"></span>
        <i class="ok_cart_num"><?php echo $amount; ?></i>
    </a>
</div>