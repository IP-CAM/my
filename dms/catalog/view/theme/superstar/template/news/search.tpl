
<div class="row">
<div class="col-sm-12 center-column">
  <?php if ($article) { ?>
	<div class="bnews-list<?php if ($display_s) { ?> bnews-list-2<?php } ?>">
		<?php foreach ($article as $articles) { ?>
			<div class="artblock clearfix<?php if ($display_s) { ?> artblock-2<?php } ?>" style="margin-bottom: 16px; border-bottom: 1px solid #f1f1f1;">
				<?php if ($articles['name']) { ?>
					<div class="name"><a href="<?php echo $articles['href']; ?>"><?php echo $articles['name']; ?></a></div>
				<?php } ?>
				<div class="article-meta">
					<?php if ($articles['author']) { ?>
						<?php echo $text_posted_by; ?> <a href="<?php echo $articles['author_link']; ?>"><?php echo $articles['author']; ?></a> |
					<?php } ?>
					<?php if ($articles['date_added']) { ?>
						<?php if ($articles['author']) { ?><?php echo $text_posted_on; ?><?php } else { ?><?php echo $text_posted_pon; ?><?php } ?> <?php echo $articles['date_added']; ?> |
					<?php } ?>
					<?php if ($articles['du']) { ?>
						<?php echo $text_updated_on; ?> <?php echo $articles['du']; ?> |
					<?php } ?>
					<?php if ($articles['category']) { ?>
						<?php echo $articles['category']; ?>
					<?php } ?>
				</div>
				<?php if ($articles['thumb']) { ?>
					<a href="<?php echo $articles['href']; ?>"><img class="article-image"  style="width: 200px; height: 200px;" align="left" src="<?php echo $articles['thumb']; ?>" title="<?php echo $articles['name']; ?>" alt="<?php echo $articles['name']; ?>" /></a>
				<?php } ?>
				<?php if ($articles['custom1']) { ?>
					<div class="custom1"><?php echo $articles['custom1']; ?></div>
				<?php } ?>
				<?php if ($articles['custom2']) { ?>
					<div class="custom2"><?php echo $articles['custom2']; ?></div>
				<?php } ?>
				<?php if ($articles['custom3']) { ?>
					<div class="custom3"><?php echo $articles['custom3']; ?></div>
				<?php } ?>
				<?php if ($articles['custom4']) { ?>
					<div class="custom4"><?php echo $articles['custom4']; ?></div>
				<?php } ?>
				<?php if ($articles['description']) { ?>
					<div class="description"><?php echo $articles['description']; ?></div>
				<?php } ?>
				<?php if ($articles['total_comments']) { ?>
				  <?php if (!$disqus_status && !$fbcom_status) { ?>
					<div class="total-comments"><?php echo $articles['total_comments']; ?> <?php echo $text_comments; ?> - <a href="<?php echo $articles['href']; ?>#comments"><?php echo $text_comments_v; ?></a></div>
				  <?php } elseif ($fbcom_status) { ?>
					<div class="total-comments"><fb:comments-count href="<?php echo $articles['canhref']; ?>"></fb:comments-count> <?php echo $text_comments; ?> - <a href="<?php echo $articles['href']; ?>#comments"><?php echo $text_comments_v; ?></a></div>
				  <?php } else { ?>
					<div class="total-comments"><a data-disqus-identifier="article_<?php echo $articles['article_id']; ?>" href="<?php echo $articles['href']; ?>#disqus_thread"><?php echo $text_comments_v; ?></a></div>
				  <?php } ?>
				<?php } ?>
				<?php if ($articles['button']) { ?>
					<div class="blog-button"><a class="button" href="<?php echo $articles['href']; ?>"><?php echo $button_more; ?></a></div>
				<?php } ?>
			</div>
		<?php } ?>
  </div>
  </div>
  <div class="row">
        <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
        <div class="col-sm-6 text-right"><?php echo $pag_results; ?></div>
  </div>
  <?php } else { ?>
  <div class="content"><?php echo $text_empty; ?></div>
  <?php }?>

<script type="text/javascript"><!--
$('#button-search').bind('click', function() {
	url = 'index.php?route=news/search';
	
	var search = $('#content input[name=\'filter_artname\']').prop('value');
	
	if (search) {
		url += '&filter_artname=' + encodeURIComponent(search);
	}

	var category_id = $('#content select[name=\'filter_category_id\']').prop('value');
	
	if (category_id > 0) {
		url += '&filter_category_id=' + encodeURIComponent(category_id);
	}
	
	var sub_category = $('#content input[name=\'filter_sub_category\']:checked').prop('value');
	
	if (sub_category) {
		url += '&filter_sub_category=true';
	}
		
	var filter_description = $('#content input[name=\'filter_description\']:checked').prop('value');
	
	if (filter_description) {
		url += '&filter_description=true';
	}

	location = url;
});

$('#content input[name=\'filter_artname\']').bind('keydown', function(e) {
	if (e.keyCode == 13) {
		$('#button-search').trigger('click');
	}
});

--></script>
<script type="text/javascript"><!--
$(document).ready(function() {
	$('img.article-image').each(function(index, element) {
		var articleWidth = $(this).parent().parent().width() * 0.7;
		var imageWidth = $(this).width() + 10;
		if (imageWidth >= articleWidth) {
			$(this).attr("align","center");
			$(this).parent().addClass('bigimagein');
		}
	});
});
//--></script> 
<?php if ($disqus_status) { ?>
<script type="text/javascript">
var disqus_shortname = '<?php echo $disqus_sname; ?>';
(function () {
var s = document.createElement('script'); s.async = true;
s.type = 'text/javascript';
s.src = 'http://' + disqus_shortname + '.disqus.com/count.js';
(document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
}());
</script>
<?php } ?>
<?php if ($fbcom_status) { ?>
<script type="text/javascript">
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '<?php echo $fbcom_appid; ?>',
		  status     : true,
          xfbml      : true,
		  version    : 'v2.0'
        });
      };

      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));
</script>
<?php } ?>