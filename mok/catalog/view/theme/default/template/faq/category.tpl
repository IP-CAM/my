<?php echo $header; ?>
<?php echo $content_top; ?>
<?php if($categories){ ?>
<header class="weui-flex">
	<?php foreach ($categories as $category) { ?>
		<?php if($category['faq_category_id'] == $child_id ) { ?>
	<a href="<?php echo $category['href']; ?>" class="weui-flex__item ok_on"><?php echo $category['name']; ?></a>
		<?php }else{ ?>
	<a href="<?php echo $category['href']; ?>" class="weui-flex__item"><?php echo $category['name']; ?></a>
		<?php } ?>
	<?php } ?>
</header>
<?php } ?>

<?php if($faqs) { ?>
<article class="ok_article">
   <?php foreach($faqs as $faq) { ?>
	<section>
        <h2 class="ok_question"><?php echo $faq['title']; ?></h2>
        <div class="ok_answer"><?php echo $faq['answer']; ?></div>
    </section>
    <?php } ?>
</article>
<?php } ?>

<?php echo $column_left; ?>
<?php echo $column_right; ?>
<?php echo $content_bottom; ?>
<script>
    var _W = document.documentElement.clientWidth || document.body.clientWidth,
            $html = document.getElementsByTagName('html')[0];
    _W = _W > 750 ? 750 : _W;
    $html.style.fontSize = _W/7.5+'px';
</script>
<?php echo $footer; ?>