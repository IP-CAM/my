<?php echo $header; ?>
<?php echo $content_top; ?>
<?php echo $column_left; ?>
<?php echo $column_right; ?>
<?php echo $content_bottom; ?>
<?php echo $footer; ?>
<script>
    $(function(){
        var _W = $(window).width() > 750 ? 750 : $(window).width();
        $('html').css('fontSize',_W/7.5+'px');
        $('.lazy').picLazyLoad();
    });

</script>