<?php echo $header; ?>
<?php echo $content_top; ?>
<div class="weui-cells">
	<?php foreach($categories as $categorie) { ?>
    <a class="weui-cell" href="<?php echo $categorie['href']; ?>">
        <div class="weui-cell__bd">
            <p class="ok_help_kind"><?php echo $categorie['name']; ?></p>
        </div>
        <div class="weui-cell__ft"></div>
    </a>
	<?php } ?>
</div>
<script>
    var _W = document.documentElement.clientWidth || document.body.clientWidth,
        $html = document.getElementsByTagName('html')[0];
    _W = _W > 750 ? 750 : _W;
    $html.style.fontSize = _W/7.5+'px';
</script>
<?php echo $column_left; ?>
<?php echo $column_right; ?>
<?php echo $content_bottom; ?>
<?php echo $footer; ?>