<?php
$theme_options = $registry->get('theme_options');
$config = $registry->get('config'); 
?>
<div class="article-content">
	<div class="article-meta">
		<?php echo $text_posted_pon; ?> <span><?php echo $date_added; ?></span> |
		<?php if($date_updated) { ?>
			<?php echo $text_updated_on; ?> <span><?php echo $date_updated; ?></span> |
		<?php } ?>
		<?php if($category) { ?>
			<?php echo $text_posted_in; ?> <?php echo $category; ?>
		<?php } ?>
		 <?php if($theme_options->get( 'product_social_share' ) != '0') { ?>
			<div class="article-share">
				<!-- ShareThis Button BEGIN -->
				<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
				<script type="text/javascript">stLight.options({publisher: "ur-d825282d-618f-598d-fca6-d67ef9e76731", doNotHash: true, doNotCopy: true, hashAddressBar: false});</script>
				<span class='st_facebook' displayText=''></span>
				<span class='st_twitter' displayText=''></span>
				<span class='st_linkedin' displayText=''></span>
				<span class='st_googleplus' displayText=''></span>
				<span class='st_pinterest' displayText=''></span>
				<!-- ShareThis Button END -->
			</div>
		<?php } ?>
	</div>
	<?php if ($thumb) { ?>
		<a href="<?php echo $popup; ?>" title="<?php echo $heading_title; ?>" class="colorbox"><img style="padding: 15px; " align="left" src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" id="image-article" /></a>
	<?php } ?>
	<?php if ($custom1) { ?>
		<div class="article-custom-1"><?php echo $custom1; ?></div>
	<?php } ?>
	<?php if ($custom2) { ?>
		<div class="article-custom-2"><?php echo $custom2; ?></div>
	<?php } ?>
	<?php if ($custom3) { ?>
		<div class="article-custom-3"><?php echo $custom3; ?></div>
	<?php } ?>
	<?php if ($custom4) { ?>
		<div class="article-custom-4"><?php echo $custom4; ?></div>
	<?php } ?>
	<?php echo $description; ?>
	<?php if ($article_videos) { ?>
		<div class="blog-videos" style="margin-top: 20px;">
			<?php foreach ($article_videos as $video) { ?>
				<?php echo ($video['text']) ? '<h2 class="video-heading">'.$video['text'].'</h2>' : ''; ?>
				<div>
					<?php echo $video['code']; ?>
				</div>
			<?php } ?>
		</div>
	<?php } ?>
	<?php if ($gallery_images) { ?>
			<div class="content blog-gallery">
				<?php foreach ($gallery_images as $gallery) { ?>
					<a class="colorbox" href="<?php echo $gallery['popup']; ?>" title="<?php echo $gallery['text']; ?>">
						<img src="<?php echo $gallery['thumb']; ?>" alt="<?php echo $gallery['text']; ?>" />
					</a>
				<?php } ?>
			</div>
		
	<?php } ?>
	<?php if ($author) { ?>
		<div class="content blog-author">
			<?php if ($author_image) { ?>
				<img class="author-image" src="<?php echo $author_image; ?>" alt="<?php echo $author; ?>" />
			<?php } ?>
			<b><?php echo $text_posted_by; ?> 
			<a href="<?php echo $author_link; ?>"><?php echo $author; ?></a></b>
			<?php if ($author_desc) { ?>
				<?php echo $author_desc; ?>
			<?php } ?>
		</div>
	<?php } ?>
	<?php if ($ntags && count($ntags) > 1) { ?>
		<div class="article-tags">
			<?php echo $text_tags; ?> 
			<?php foreach($ntags as $ntag) { ?>
				<a class="ntag" href="<?php echo $ntag['href']; ?>"><?php echo $ntag['ntag']; ?></a>
			<?php } ?>
		</div>
	<?php } ?>
</div>
<?php if ($products) { ?>
<h2><?php echo $news_prelated; ?></h2>
<div class="row product-layout">
  <?php foreach ($products as $product) { ?>
  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="product-grid">
		<?php
$theme_options = $registry->get('theme_options');
$config = $registry->get('config');
?>

<!-- Product -->
<div class="product clearfix">
	<div class="left">
		<?php if ($product['thumb']) { ?>
			<?php if($product['special'] && $theme_options->get( 'display_text_sale' ) != '0') { ?>
				<?php $text_sale = 'Sale';
				if($theme_options->get( 'sale_text', $config->get( 'config_language_id' ) ) != '') {
					$text_sale = $theme_options->get( 'sale_text', $config->get( 'config_language_id' ) );
				} ?>
				<?php if($theme_options->get( 'type_sale' ) == '1') { ?>
					<?php $product_detail = $theme_options->getDataProduct( $product['product_id'] );
					$roznica_ceny = $product_detail['price']-$product_detail['special'];
					$procent = ($roznica_ceny*100)/$product_detail['price']; ?>
					<div class="sale">-<?php echo round($procent); ?>%</div>
				<?php } else { ?>
					<div class="sale"><?php echo $text_sale; ?></div>
				<?php } ?>
			<?php } ?>
			
			<div class="image">
				
				

			<div class="flybar">
				
				
				<?php if($theme_options->get( 'display_add_to_compare' ) != '0') { ?>
					<div class="compare">			
						<a onclick="compare.add('<?php echo $product['product_id']; ?>');" title="<?php if($theme_options->get( 'add_to_compare_text', $config->get( 'config_language_id' ) ) != '') { echo $theme_options->get( 'add_to_compare_text', $config->get( 'config_language_id' ) ); } else { echo 'Add to compare'; } ?>" class="fa  fa-external-link product-icon"></a></a>	
					</div>
				<?php } ?>
				
				<?php if($theme_options->get( 'quick_view' ) != '0') { ?>
					<div class="quickview">
						<a rel="<?php echo $product['href']; ?>" title="<?php echo $product['name']; ?>" class="fa fa-search"></a>
					</div>
				<?php } ?>
				
				<?php if($theme_options->get( 'display_add_to_wishlist' ) != '0') { ?>
					<div class="wishlist">
						<a onclick="wishlist.add('<?php echo $product['product_id']; ?>');" title="<?php if($theme_options->get( 'add_to_wishlist_text', $config->get( 'config_language_id' ) ) != '') { echo $theme_options->get( 'add_to_wishlist_text', $config->get( 'config_language_id' ) ); } else { echo 'Add to wishlist'; } ?>" class="fa fa-heart-o product-icon"></a></a>	
					</div>
				<?php } ?>
				
				
				<?php if($theme_options->get( 'display_add_to_cart' ) != '0') { ?>
					<div class="addtocart">
					<a onclick="cart.add('<?php echo $product['product_id']; ?>');" class="button"><span><?php if($theme_options->get( 'add_to_cart_text', $config->get( 'config_language_id' ) ) != '') { echo $theme_options->get( 'add_to_cart_text', $config->get( 'config_language_id' ) ); } else { echo 'Add to cart'; } ?></span></a>
					</div>
				<?php } ?>
			</div>

				
				<a href="<?php echo $product['href']; ?>">
					<img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" />
				</a>
			</div>
		<?php } else { ?>
			<div class="image">
				<?php if($theme_options->get( 'quick_view' ) != '0') { ?>
				<div class="quickview">
					<a rel="<?php echo $product['href']; ?>" title="<?php echo $product['name']; ?>" class="fa  fa-eye"></a>
				</div>
				<?php } ?>
				
				<a href="<?php echo $product['href']; ?>"><img src="image/no_image.png" alt="<?php echo $product['name']; ?>" class="no-image"/></a>
			</div>
		<?php } ?>
	</div>
	<div class="right">
		<div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
		<div class="price">
			<?php if (!$product['special']) { ?>
			<?php echo $product['price']; ?>
			<?php } else { ?>
			<span class="price-old"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span>
			<?php } ?>
		</div>
		<?php if ($theme_options->get( 'display_rating' ) != '0') { ?>
		<div class="rating"><i class="fa fa-star<?php if($product['rating'] >= 1) { echo ' active'; } ?>"></i><i class="fa fa-star<?php if($product['rating'] >= 2) { echo ' active'; } ?>"></i><i class="fa fa-star<?php if($product['rating'] >= 3) { echo ' active'; } ?>"></i><i class="fa fa-star<?php if($product['rating'] >= 4) { echo ' active'; } ?>"></i><i class="fa fa-star<?php if($product['rating'] >= 5) { echo ' active'; } ?>"></i></div>
		<?php } ?>
		
	</div>
</div>
    </div>
  </div>
  <?php } ?>
</div>
<?php } ?>


<?php if ($acom != 0 && !$disqus_status && !$fbcom_status) { ?>
    <h2 style="clear: both; margin-top: 20px;"><a name="comments"></a><?php echo $title_comments; ?> <?php echo $text_coms; ?> "<?php echo $heading_title; ?>"</h2>
	<?php if ($comment) { ?>
    <?php foreach ($comment as $comment) { ?>
    <div class="content blog-content">
		<div  class="comment-header"><span class="comment-icon"></span><b><?php echo $comment['author']; ?></b> <?php echo $text_posted_on; ?> <?php echo $comment['date_added']; ?></div>
		<div class="comment-text"><?php echo $comment['text']; ?>
			<a onclick="addReply('<?php echo $comment['ncomment_id']; ?>', '<?php echo $comment['author']; ?>');"><?php echo $text_reply; ?></a>
		</div>
			<?php foreach ($comment['replies'] as $reply) { ?>
				<div class="content blog-reply">
					<div class="reply-header"><span class="comment-icon"></span><b><?php echo $reply['author']; ?></b> <?php echo $text_posted_on; ?> <?php echo $reply['date_added']; ?></div>
					<div class="comment-text"><?php echo $reply['text']; ?></div>
				</div>
			<?php } ?>
	</div>
    <?php } ?>
	<div class="row">
        <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
        <div class="col-sm-6 text-right"><?php echo $pag_results; ?></div>
	</div>
    <?php } ?>
    <div class="content" id="comment-form">
    <h2 id="com-title"><span class="blog-write"></span><?php echo $writec; ?></h2>
	<input type="hidden" name="reply_id" value="0" id="reply-id-field"/>
    <div class="comment-form">
	<div <?php if (version_compare(VERSION, '2.0.2.0') < 0) { ?>class="comment-left"<?php } ?>>
    <b><?php echo $entry_name; ?></b><br />
    <input class="form-control" type="text" name="name" value="<?php echo $customer_name; ?>" style="" />
    <div style="height: 5px; overflow: hidden">&nbsp;</div>
    <?php if (version_compare(VERSION, '2.0.2.0') < 0) { ?>
      <?php //201x captcha ?>
    	<b><?php echo $entry_captcha; ?></b><br />
    	<input class="form-control" type="text" name="captcha" style="" value="" />
		<div style="height: 5px; overflow: hidden">&nbsp;</div>
    	<img src="index.php?route=tool/captcha" alt="" id="captcha" />
    <?php } ?>
	</div>
	<div <?php if (version_compare(VERSION, '2.0.2.0') < 0) { ?>class="comment-right"<?php } ?>>
    <b><?php echo $entry_review; ?></b><br />
    <textarea class="form-control" name="text" cols="40" rows="4"></textarea>
    <span style="font-size: 11px;"><?php echo $text_note; ?></span>
	</div>
	<?php if (version_compare(VERSION, '2.0.2.0') >= 0) { ?>
        <?php //2.0.2x captcha ?>
        <?php if ($site_key) { ?>
            <div style="overflow:hidden"><div class="g-recaptcha" data-sitekey="<?php echo $site_key; ?>"></div></div>
        <?php } ?>
    <?php } ?>
    </div>
    <div id="com-error" style="margin-top: 5px;"></div>
    <div class="buttons">
      <div class="right">
		<button type="button" id="button-comment" data-loading-text="<?php echo $text_send; ?>" class="button"><?php echo $text_send; ?></button>
	  </div>
    </div>
  </div>
<?php }  ?>
<script type="text/javascript"><!--
$('.colorbox').magnificPopup({ 
  type: 'image',
  gallery:{enabled:true},
  zoom: {
	enabled: true,
	duration: 300,
	opener: function(element) {
		return element.find('img');
	}
  }
});
//--></script>  
<script type="text/javascript"><!--
function addReply(reply_id, author) {
	$('#reply-id-field').attr('value', reply_id);
	$('#com-title').html("<span class=\"blog-write\"></span><?php echo $text_reply_to; ?> " + author + "<span onclick=\"cancelReply();\" title=\"Cancel Reply\" class=\"cancel-reply\"></span>");
	var scroll = $('#comment-form').offset();
	$('html, body').animate({ scrollTop: scroll.top - 80 }, 'slow');
}
function cancelReply(reply_id, author) {
	$('#reply-id-field').attr('value', 0);
	$('#com-title').html("<span class=\"blog-write\"></span><?php echo $writec; ?>");
}
$('#button-comment').bind('click', function() {
	$.ajax({
		type: 'POST',
		url: 'index.php?route=news/article/writecomment&news_id=<?php echo $news_id; ?>',
		dataType: 'json',
		<?php if ((version_compare(VERSION, '2.0.2.0') >= 0) && $site_key) { ?>
		 data: 'name=' + encodeURIComponent($('input[name=\'name\']').val()) + '&text=' + encodeURIComponent($('textarea[name=\'text\']').val()) + '&captcha=' + encodeURIComponent($('.comment-form [name=\'g-recaptcha-response\']').val()) + '&reply_id=' + encodeURIComponent($('input[name=\'reply_id\']').val()),
		<?php } elseif ((version_compare(VERSION, '2.0.2.0') >= 0) && !$site_key) { ?>
		 data: 'name=' + encodeURIComponent($('input[name=\'name\']').val()) + '&text=' + encodeURIComponent($('textarea[name=\'text\']').val()) + '&reply_id=' + encodeURIComponent($('input[name=\'reply_id\']').val()),
		<?php } else { ?>
		 data: 'name=' + encodeURIComponent($('input[name=\'name\']').val()) + '&text=' + encodeURIComponent($('textarea[name=\'text\']').val()) + '&captcha=' + encodeURIComponent($('input[name=\'captcha\']').val()) + '&reply_id=' + encodeURIComponent($('input[name=\'reply_id\']').val()),
		<?php } ?>
		beforeSend: function() {
			$('.alert').remove();
			$('#button-comment').attr('disabled', true);
			$('#com-error').after('<div class="alert alert-danger ad1"><i class="fa fa-exclamation-circle"></i> <?php echo $text_wait; ?></div>');
		},
		complete: function() {
			$('#button-comment').attr('disabled', false);
			$('.ad1').remove();
		},
		success: function(data) {
			if (data.error) {
				$('#com-error').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + data.error + '</div>');
			}
			
			if (data.success) {
				$('#com-error').after('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + data.success + '</div>');
								
				$('input[name=\'name\']').val('');
				$('textarea[name=\'text\']').val('');
				<?php if (version_compare(VERSION, '2.0.2.0') < 0) { ?>
				$('input[name=\'captcha\']').val('');
				<?php } ?>
			}
		}
	});
});
//--></script> 
<script type="text/javascript"><!--
	$(document).ready(function() {
		var articleImageWidth = $('img#image-article').width() + 30;
		var pageWidth = $('.article-content').width() * 0.65;
		if (articleImageWidth >= pageWidth) {
			$('img#image-article').attr("align","center");
			$('img#image-article').parent().addClass('centered-image');
		}
		$('img.article-image').each(function(index, element) {
		var articleWidth = $(this).parent().parent().width() * 0.7;
		var imageWidth = $(this).width() + 10;
		if (imageWidth >= articleWidth) {
			$(this).attr("align","center");
			$(this).parent().addClass('bigimagein');
		}
		});
		$(window).resize(function() {
		var articleImageWidth = $('img#image-article').width() + 30;
		var pageWidth = $('.article-content').width() * 0.65;
		if (articleImageWidth >= pageWidth) {
			$('img#image-article').attr("align","center");
			$('img#image-article').parent().addClass('centered-image');
		}
		$('img.article-image').each(function(index, element) {
		var articleWidth = $(this).parent().parent().width() * 0.7;
		var imageWidth = $(this).width() + 10;
		if (imageWidth >= articleWidth) {
			$(this).attr("align","center");
			$(this).parent().addClass('bigimagein');
		}
		});
		});
	});
//--></script> 