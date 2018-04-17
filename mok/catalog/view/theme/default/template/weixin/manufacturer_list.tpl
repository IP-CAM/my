<?php echo $header; ?>
<?php echo $content_top; ?>
<div class="ok_cs_box">
    <div class="ok_list">
        <?php
            foreach($manufacturers as $row){
        ?>
        <div class="ok_list_item">
            <a href="<?php echo $row['href'];?>">
                <img class="ok_item_img lazy" data-original="<?php echo $row['image'];?>" src="<?php echo $row['image'];?>"/>
                <p class="ok_brand_name"><?php echo $row['name'];?></p>
            </a>
        </div>
        <?php
            }
        ?>
    </div>
</div>
<script type="text/javascript">
    var $width = $(window).width()>750?750:$(window).width();
    $('html').css('fontSize',$width/7.5+'px');
    $('.lazy').picLazyLoad();
</script>
<?php echo $column_left; ?>
<?php echo $column_right; ?>
<?php echo $content_bottom; ?>
<?php echo $footer; ?>
