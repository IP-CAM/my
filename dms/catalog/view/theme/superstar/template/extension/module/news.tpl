


<div class="box-heading2" style="text-transform: none;"><?php echo $heading_title; ?> <a href="<?php echo $newslink; ?>" class="news-link"><?php echo $text_headlines; ?></a></div>
  <div class="box-content bnews-holder">
	<div class="row">
    <div class="bnews-list<?php if ($display_style) { ?> bnews-list-2<?php } ?>">
		<?php foreach ($article as $articles) { ?>
		
			<div class="col-sm-6 tg-padding">
			<div class="artblock">
				<div class="col-sm-4 tg-padding-right" style="padding-left: 0;">
					<?php if ($articles['thumb']) { ?>
						<a href="<?php echo $articles['href']; ?>"><img class="article-image" align="left" src="<?php echo $articles['thumb']; ?>" title="<?php echo $articles['name']; ?>" alt="<?php echo $articles['name']; ?>" /></a>
					<?php } ?>
				</div>	
				
				<div class="col-sm-8 tg-padding-left tg-padding-right">
				
					<?php if ($articles['name']) { ?>
						<div class="name"><a href="<?php echo $articles['href']; ?>"><?php echo $articles['name']; ?></a></div>
					<?php } ?>
					<div class="article-meta">
						<?php if ($articles['author']) { ?>
							<?php echo $text_posted_by; ?> <a href="<?php echo $articles['author_link']; ?>"><?php echo $articles['author']; ?></a> |
						<?php } ?>
						<?php if ($articles['date_added']) { ?>
							<?php if ($articles['author']) { ?><?php echo $text_posted_on; ?><?php } else { ?><?php } ?> <?php echo $articles['date_added']; ?> |
						<?php } ?>
						
						<?php if ($articles['category']) { ?>
							<?php echo $articles['category']; ?>
						<?php } ?>
					</div>
					
					<div class="description"><?php echo utf8_substr(strip_tags(html_entity_decode($articles['description'])), 0, 60)."..." ?></div>
					
				</div>	
			
			</div>
			</div>
		
		<?php } ?>
	</div>		
    </div>
  </div>
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