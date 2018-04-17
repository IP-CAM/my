<?php echo $header; ?>
<?php echo $content_top; ?>
<div class="ok_login_info weui-flex">
  <div class="ok_login_img">
    <img src="<?php echo $user_head;?>"/>
  </div>
  <div class="weui-flex__item">
    <a href="<?php echo $edit_personal_info;?>" class="ok_my_name"><?php echo $user_name;?></a>
  </div>
</div>
<div class="weui-flex ok_collect_head">
  <a href="<?php echo $my_collect;?>" class="weui-flex__item">
    <p class="ok_collect_num"><?php echo $collect_num;?></p>
    <p class="ok_collect_text"><?php echo $text_my_collect;?></p>
  </a>
  <a href="<?php echo $my_attention;?>" class="weui-flex__item ok_on">
    <p class="ok_focus_num"><?php echo $attention_num;?></p>
    <p class="ok_collect_text"><?php echo $text_my_attention;?></p>
  </a>
</div>
<div class="weui-grids">
  <a href="<?php echo $shopping_cart;?>" class="weui-grid">
    <div class="weui-grid__icon">
      <img src="catalog/view/theme/default/images/my/cart.png" width="100%"/>
      <i class="ok_my_num"><?php echo $amount;?></i>
    </div>
    <p class="weui-grid__label"><?php echo $text_shopping_cart;?></p>
  </a>
  <a href="<?php echo $my_order;?>" class="weui-grid">
    <div class="weui-grid__icon">
      <img src="catalog/view/theme/default/images/my/order.png" width="100%"/>
    </div>
    <p class="weui-grid__label"><?php echo $text_my_orders;?></p>
  </a>
  <a href="<?php echo $my_address;?>" class="weui-grid">
    <div class="weui-grid__icon">
      <img src="catalog/view/theme/default/images/my/address.png" width="100%"/>
    </div>
    <p class="weui-grid__label"><?php echo $text_address_management;?></p>
  </a>
  <a href="<?php echo $my_coupon;?>" class="weui-grid">
    <div class="weui-grid__icon">
      <img src="catalog/view/theme/default/images/my/coups.png" width="100%"/>
    </div>
    <p class="weui-grid__label"><?php echo $text_my_coupons;?></p>
  </a>
  <a href="<?php echo $my_activities;?>" class="weui-grid">
    <div class="weui-grid__icon">
      <img src="catalog/view/theme/default/images/my/plan.png" width="100%"/>
    </div>
    <p class="weui-grid__label"><?php echo $text_my_activities;?></p>
  </a>
  <a href="<?php echo $account_security;?>" class="weui-grid">
    <div class="weui-grid__icon">
      <img src="catalog/view/theme/default/images/my/safe.png" width="100%"/>
    </div>
    <p class="weui-grid__label"><?php echo $text_account_safe;?></p>
  </a>
  <a href="<?php echo $feedback;?>" class="weui-grid">
    <div class="weui-grid__icon">
      <img src="catalog/view/theme/default/images/my/advice.png" width="100%"/>
    </div>
    <p class="weui-grid__label"><?php echo $text_my_feedback;?></p>
  </a>
  <a href="tel:0755-88698888" class="weui-grid">
    <div class="weui-grid__icon">
      <img src="catalog/view/theme/default/images/my/connect.png" width="100%"/>
    </div>
    <p class="weui-grid__label"><?php echo $text_customer_service;?></p>
  </a>
  <a href="<?php echo $help_center;?>" class="weui-grid">
    <div class="weui-grid__icon">
      <img src="catalog/view/theme/default/images/my/help.png" width="100%"/>
    </div>
    <p class="weui-grid__label"><?php echo $text_help_center;?></p>
  </a>
</div>
<a href="<?php echo $logout_href;?>"> <div class="ok_login_out"><?php echo $text_log_out;?></div></a>
<div class="weui-tabbar ok_tabbar">
  <a href="home.html" class="weui-tabbar__item">
    <i class="weui-tabbar__icon ok_tabbar__see"></i>
    <p class="weui-tabbar__label"><?php echo $text_come_look;?></p>
  </a>
  <a href="come_play.html" class="weui-tabbar__item">
    <i class="weui-tabbar__icon ok_tabbar__play"></i>
    <p class="weui-tabbar__label"><?php echo $text_come_play;?></p>
  </a>
  <a href="come_buy.html" class="weui-tabbar__item">
    <i class="weui-tabbar__icon ok_tabbar__buy"></i>
    <p class="weui-tabbar__label"><?php echo $text_come_buy;?></p>
  </a>
  <a href="my.html" class="weui-tabbar__item">
    <i class="weui-tabbar__icon ok_tabbar__self"></i>
    <p class="weui-tabbar__label"><?php echo $text_mine;?></p>
  </a>
</div>
<?php echo $column_left; ?>
<?php echo $column_right; ?>
<?php echo $content_bottom; ?>
<?php echo $footer; ?>
