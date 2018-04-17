<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="catalog/view/theme/default/css/weui.css"/>
    <link rel="stylesheet" href="catalog/view/theme/default/css/home.css">
    <link rel="stylesheet" href="catalog/view/theme/default/css/public.css">
    <title>来看</title>
</head>
<body>

<?php echo $column_left; ?>
<?php echo $column_right; ?>
<?php echo $content_top; ?>
<?php echo $content_bottom; ?>

<div class="ok_cs_box">
        <div class="ok_cs_title">
            <a href="#">
                <span class="ok_cs__text">内容</span>
                <img class="weui-icon-next" src="catalog/view/theme/default/images/home/arrows.png"/>
            </a>
        </div>
        <div class="ok_article_item">
            <a href="#">
                <div class="ok_article_img">
                    <img class="lazy" src="catalog/view/theme/default/images/public/lazy.png"  data-original="catalog/view/theme/default/images/product/home_05.jpg" width="100%"/>
                </div>
                <div class="ok_articel_info">
                    <p class="ok_articel_title">创意生活<i class="ok_border_r"></i>数据线再也不会乱跑了</p>
                    <p class="ok_articel_date">1天前</p>
                </div>
            </a>
        </div>
    </div>
<div class="ok_loadmore"><a href="#">查看更多<img src="catalog/view/theme/default/images/home/loadmore.jpg" width="100%"/></a></div>

<script src="catalog/view/theme/default/lib/zepto.min.js"></script>
<script src="catalog/view/theme/default/lib/swipeSlide.min.js"></script>
<script src="catalog/view/theme/default/lib/zepto.lazyload.min.js"></script>
<script src="catalog/view/theme/default/script/ok_home.js"></script>
</body>
</html>