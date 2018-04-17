<?php echo $header; ?>
<?php echo $content_top; ?>
<div class="ok_article_head">
		<!-- video 视频待接入 -->
        <div class="ok_article_item">
			<?php if($video_path){ ?>
            <div class="ok_article_img">

                <video id="ok_media" class="ok_media" poster="catalog/view/theme/default/images/product/home_06.jpg" width="100%">
                <source src="<?php echo $video_path; ?>" type="video/mp4"/>  
                    
					<?php echo $text_no_support; ?>
				</video>
				
                <div class="ok_play">
                    <img class="ok_play_img" src="catalog/view/theme/default/images/public/play.png" width="100%"/>
                </div>
				
            </div>
			
            <div class="ok_articel_info">
                <p class="ok_articel_title"><?php echo $title; ?></p>
                <p class="ok_articel_date"><?php echo $date_added; ?></p>
            </div>
			<?php }else{ ?>
				<?php if($thumb){ ?>
				<div class="ok_article_img">
					<img class="lazy" src="<?php echo $thumb; ?>" width="100%"/>
				</div>
				<?php } ?>
				<p class="ok_articel_title"><?php echo $title; ?></p>
				<?php echo $description; ?>
			<?php } ?>
		</div>
		
</div>

<!--评论-->
<?php if($comment_count) { ?>
<div class="ok_cs_box">
    <div class="ok_order_title"><?php echo $entry_comment; ?></div>
    <div class="ok_comment" id="comment"></div>
</div>
<?php } ?>
<!--分享-->
<div class="ok_share">
    <a href="javascript:void(0);" class="ok_share_btn">分享有礼</a>
    <p class="ok_share_info">每个专题每天首次分享即可参加抽奖</p>
    <p class="ok_share_info">可获得补光灯一个</p>
    <img class="ok_share_img" src="catalog/view/theme/default/images/public/speical.jpg"/>
</div>
<!--底部-->
<div class="ok_tabbar weui-flex">
    <a href="javascript:;" class="weui-flex__item">
        <input type="hidden" value="<?php echo $blog_id; ?>" id="article_id">
        <img src="<?php if($is_collect==1){ echo 'catalog/view/theme/default/images/home/collected.png';}else{ echo 'catalog/view/theme/default/images/home/vedio_collect.png';}?>" class="ok_play_collect"/>
    </a>
    <a href="<?php echo $write_comment;?>" class="weui-flex__item">
        <img src="catalog/view/theme/default/images/home/vedio_info.png" class="ok_play_info"/>
		<?php if($comment_count){ ?>
        <span class="ok_info_num">(<?php echo $comment_count; ?>)</span>
		<?php } ?>
    </a>
    <a href="javascript:void(0);" class="weui-flex__item">
        <img src="catalog/view/theme/default/images/home/vedio_share.png" class="ok_play_share"/>
    </a>
</div>
<div class="ok_position"> 
    <div class="ok_pop">
        <span class="ok_tag"></span>
        <span class="ok_pop_info"></span>
    </div>
</div>
<?php echo $column_left; ?>
<?php echo $column_right; ?>
<?php echo $content_bottom; ?>
<?php echo $footer; ?>
<script type="text/javascript" src="catalog/view/theme/default/script/jweixin-1.0.0.js"></script>
<script type="text/javascript"><!--
                wx.config({
                    debug : true,
                    appId : 'wxebbeb7320e857ded',
                    timestamp : '1484220881',
                    nonceStr : 'jsMUVueDcoAEzEwn',
                    signature : 'ccfe731b3a4a70c4aa5ece9bb07177d46290d956',
                    jsApiList : ['onMenuShareTimeline']
                });
                $('.ok_share_btn,.ok_play_share').click(function(){ 
                    // 分享到朋友圈
                    wx.onMenuShareTimeline({
                        title: '华强北商城(全民疯购趴 低价嗨爆神经）', // 分享标题
                        link: '', // 分享链接
                        imgUrl: 'http://img5.hqbcdn.com/activity/dc/43/dc43b5bfe799d8cf86e36a85355a204b.png', // 分享图标
                        trigger: function (res) {
                            // 不要尝试在trigger中使用ajax异步请求修改本次分享的内容，因为客户端分享操作是一个同步操作，这时候使用ajax的回包会还没有返回
                            alert('用户点击分享到朋友圈');
                          },
                        success: function () {
                            alert(11);
                        },
                        cancel: function () {
                            alert(11);
                            // 用户取消分享后执行的回调函数
                        }
                    });
                });
--></script>
<?php if($comment_count) { ?>
<script type="text/javascript"><!--
                wx.config({
                    debug : false,
                    appId : 'wxebbeb7320e857ded',
                    timestamp : '1484220881',
                    nonceStr : 'jsMUVueDcoAEzEwn',
                    signature : 'ccfe731b3a4a70c4aa5ece9bb07177d46290d956',
                    jsApiList : ['onMenuShareTimeline']
                });
                $('.ok_share_btn').click(function(){ 
                    // 分享到朋友圈
                    wx.onMenuShareTimeline({
                        title: '华强北商城(全民疯购趴 低价嗨爆神经）', // 分享标题
                        link: '', // 分享链接
                        imgUrl: 'http://img5.hqbcdn.com/activity/dc/43/dc43b5bfe799d8cf86e36a85355a204b.png', // 分享图标
                        trigger: function (res) {
                            // 不要尝试在trigger中使用ajax异步请求修改本次分享的内容，因为客户端分享操作是一个同步操作，这时候使用ajax的回包会还没有返回
                            alert('用户点击分享到朋友圈');
                          },
                        success: function () {
                            alert(11);
                        },
                        cancel: function () {
                            // 用户取消分享后执行的回调函数
                        }
                    });
                     alert('已注册获取“分享到朋友圈”状态事件');
                });
$('#comment').load('index.php?route=blog/blog/comment&blog_id=<?php echo $blog_id; ?>');
--></script>
<?php } ?>