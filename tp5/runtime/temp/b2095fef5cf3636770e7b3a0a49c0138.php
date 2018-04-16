<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:74:"D:\git\my\tp5\public/../site/crossbbcg/view/pc/default/common/toolbar.html";i:1506563702;}*/ ?>
<div id="ly_toolbar" class="mui-mbar-outer" >
	<div class="mui-mbar mui-mbar-status-standard">
		<div class="mui-mbar-plugins" >
			<!--<div class="mui-mbar-plugin  mui-mbar-plugin-prof">
				<div class="mui-mbar-plugin-hd">
					<a target="_blank" href="//vip.tmall.com?scm=1048.1.2.1" class="mui-mbar-plugin-hd-title ">会员中心</a>
					<div class="mui-mbar-plugin-hd-tip"></div>
					<div class="mui-mbar-plugin-cover"></div>
					<div class="mui-mbar-plugin-hd-close mui-mbar-iconfont"></div>
				</div>
				<div class="mui-mbar-plugin-bd" onmousewheel="return scroll(event,this)"  >
					<div class="mui-mbar-plugin-load"></div>
				</div>
			</div>-->
			<div class="mui-mbar-plugin  mui-mbar-plugin-cart" data-url="<?php echo url('crossbbcg/carts/ajaxcart'); ?>">
				<div class="mui-mbar-plugin-hd">
					<a target="_self" href="javascript:;" class="mui-mbar-plugin-hd-title mui-mbar-plugin-hd-title-txt"><?php echo lang('Cart'); ?></a>
					<div class="mui-mbar-plugin-hd-tip"></div>
					<div class="mui-mbar-plugin-cover"></div>
					<div class="mui-mbar-plugin-hd-close mui-mbar-iconfont"></div>
				</div>
				<div class="mui-mbar-plugin-bd" onmousewheel="return scroll(event,this)"  >
					<div class="mui-mbar-plugin-load"></div>
				</div>
			</div>
			<!--<div class="mui-mbar-plugin  mui-mbar-plugin-asset">
				<div class="mui-mbar-plugin-hd">
					<a target="_blank" href="//taoquan.taobao.com/framework/got_bonus.htm?tabIndex=1&amp;scm=1048.1.3.1" class="mui-mbar-plugin-hd-title ">我的资产</a>
					<div class="mui-mbar-plugin-hd-tip"></div>
					<div class="mui-mbar-plugin-cover"></div>
					<div class="mui-mbar-plugin-hd-close mui-mbar-iconfont"></div>
				</div>
				<div class="mui-mbar-plugin-bd" onmousewheel="return scroll(event,this)"  >
					<div class="mui-mbar-plugin-load"></div>
				</div>
			</div>-->
			<div class="mui-mbar-plugin  mui-mbar-plugin-brand" data-url="<?php echo url('crossbbcg/index/ajaxshops'); ?>" >
				<div class="mui-mbar-plugin-hd">
					<a target="_blank" href="//mybrand.tmall.com?scm=1048.1.4.1" class="mui-mbar-plugin-hd-title "><?php echo lang('attention_dianpu'); ?></a>
					<div class="mui-mbar-plugin-hd-tip"></div>
					<div class="mui-mbar-plugin-cover"></div>
					<div class="mui-mbar-plugin-hd-close mui-mbar-iconfont"></div>
				</div>
				<div class="mui-mbar-plugin-bd" onmousewheel="return scroll(event,this)"  >
					<div class="mui-mbar-plugin-load"></div>
				</div>
			</div>
			<div class="mui-mbar-plugin  mui-mbar-plugin-favor" data-url="<?php echo url('crossbbcg/index/ajaxfav'); ?>">
				<div class="mui-mbar-plugin-hd">
					<a target="_self" href="javascript:;" class="mui-mbar-plugin-hd-title mui-mbar-plugin-hd-title-txt"><?php echo lang('my_favor'); ?></a>
					<div class="mui-mbar-plugin-hd-tip"></div>
					<div class="mui-mbar-plugin-cover"></div>
					<div class="mui-mbar-plugin-hd-close mui-mbar-iconfont"></div>
				</div>
				<div class="mui-mbar-plugin-bd" onmousewheel="return scroll(event,this)"  >
					<div class="mui-mbar-plugin-load"></div>
				</div>
				
			</div>
			<div class="mui-mbar-plugin  mui-mbar-plugin-foot" data-url="<?php echo url('crossbbcg/index/ajaxfoot'); ?>">
				<div class="mui-mbar-plugin-hd">
					<a target="_self" href="javascript:;" class="mui-mbar-plugin-hd-title mui-mbar-plugin-hd-title-txt"><?php echo lang('i_see'); ?></a>
					<div class="clear-item" data-url="<?php echo url('crossbbcg/goods/deleteAllMyPath'); ?>"><?php echo lang('clear_record'); ?></div>
					<div class="mui-mbar-plugin-hd-tip"></div>
					<div class="mui-mbar-plugin-cover"></div>
					<div class="mui-mbar-plugin-hd-close mui-mbar-iconfont"></div>
				</div>
				<div class="mui-mbar-plugin-bd" onmousewheel="return scroll(event,this)"  >
					<div class="mui-mbar-plugin-load"></div>
				</div>
			</div>
			
			<div class="mui-mbar-plugin  mui-mbar-plugin-top">
				<div class="mui-mbar-plugin-hd">
					<a target="_self" href="" class="mui-mbar-plugin-hd-title mui-mbar-plugin-hd-title-txt"><?php echo lang('to_top'); ?></a>
					<div class="mui-mbar-plugin-hd-tip"></div>
					<div class="mui-mbar-plugin-cover"></div>
					<div class="mui-mbar-plugin-hd-close mui-mbar-iconfont"></div>
				</div>
				<div class="mui-mbar-plugin-bd" onmousewheel="return scroll(event,this)"  >
					<div class="mui-mbar-plugin-load"></div>
				</div>
			</div>
			
			
		</div>
		<div class="mui-mbar-tabs  mui-mbar-tabs-narrow" >
			<div class="mui-mbar-tabs-mask" >
				<div class="mui-mbar-tabs-top-wide" style="height: 0px;">
					<div class="mui-mbar-tab-top-left"></div>
				</div>
				<div class="mui-mbar-tab mui-mbar-tab-prof " style="top: 0px; margin: 71.5px 0px 0px;">
                    <?php if(is_login()): ?>
					<a href="<?php echo url('member/index/index'); ?>" class="mui-mbar-tab-logo mui-mbar-tab-logo-prof"></a>
                    <?php else: ?>
                    <a onclick="toolbarParam.showMinLogin('<?php echo url("member/passport/minLogin"); ?>')" class="mui-mbar-tab-logo mui-mbar-tab-logo-prof"></a>
                    <?php endif; ?>
					
					<div class="mui-mbar-tab-new" style="display:none;"></div>
					<!--<div class="mui-mbar-tab-logo-prof-nick-bd" style="display: none;"><img class="mui-mbar-tab-logo-prof-nick" src="//wwc.alicdn.com/avatar/getAvatar.do?userId=657482266&amp;width=160&amp;height=160&amp;type=ww"></div>-->
					<div class="mui-mbar-tab-tip"><?php echo lang('Member'); ?>
						<div class="mui-mbar-arr mui-mbar-tab-tip-arr">◆</div>
					</div>
					<div class="mui-mbar-arr mui-mbar-tab-logo-arr ">◆</div>
				</div>
				<div class="mui-mbar-tab mui-mbar-tab-cart " style="top: 0px; margin: 8px 0px;">
					<div class="mui-mbar-tab-logo mui-mbar-tab-logo-cart">
                        
                    </div>
					<div class="mui-mbar-tab-txt"><?php echo lang('Cart'); ?></div>
					<div class="mui-mbar-tab-new" style="display:none;"></div>
					<div class="mui-mbar-tab-sup" style="display: block;">
						<div class="mui-mbar-tab-sup-bg">
							<div class="mui-mbar-tab-sup-bd cart_num"><?php echo $cart_num; ?></div>
						</div>
					</div>
					<div class="mui-mbar-tab-tip"><?php echo lang('Cart'); ?>
						<div class="mui-mbar-arr mui-mbar-tab-tip-arr">◆</div>
					</div>
					<div class="mui-mbar-arr mui-mbar-tab-logo-arr ">◆</div>
					<div class="mui-mbarp-tab-cart-border ">
                        
                    </div>
				</div>
				<!--<div class="mui-mbar-tab mui-mbar-tab-asset " style="top: 0px; margin: 8px 0px;">
					<div class="mui-mbar-tab-logo mui-mbar-tab-logo-asset"></div>
					
					<div class="mui-mbar-tab-new" style="display:none;"></div>
					
					<div class="mui-mbar-tab-tip">我的资产
						<div class="mui-mbar-arr mui-mbar-tab-tip-arr">◆</div>
					</div>
					<div class="mui-mbar-arr mui-mbar-tab-logo-arr ">◆</div>
				</div>-->
				<div class="mui-mbar-tab mui-mbar-tab-brand " style="top: 0px; margin: 8px 0px;">
					<div class="mui-mbar-tab-logo mui-mbar-tab-logo-brand">
                        
                    </div>
					
					<div class="mui-mbar-tab-new" style="display:none;"></div>
					<!--我关注的店铺-->
					<div class="mui-mbar-tab-tip"><?php echo lang('attention_dianpu'); ?>
						<div class="mui-mbar-arr mui-mbar-tab-tip-arr">◆</div>
					</div>
					<div class="mui-mbar-arr mui-mbar-tab-logo-arr ">◆</div>
				</div>
				<div class="mui-mbar-tab mui-mbar-tab-favor" style="top: 0px; margin: 8px 0px;">
					<!--<div class="mui-mbar-tab-logo mui-mbar-tab-logo-favor"></div>-->
                    <div class="mui-mbar-tab-logo mui-mbar-tab-logo-favor">
                        
                    </div>
					
					<div class="mui-mbar-tab-new" style="display:none;"></div>
					<!--我的收藏-->
					<div class="mui-mbar-tab-tip" style="right: 70px; opacity: 0; display: none;"><?php echo lang('my_favor'); ?>
						<div class="mui-mbar-arr mui-mbar-tab-tip-arr">◆</div>
					</div>
					<div class="mui-mbar-arr mui-mbar-tab-logo-arr ">◆</div>
				</div>
				<div class="mui-mbar-tab mui-mbar-tab-foot " style="top: 0px; margin: 8px 0;">
					<div class="mui-mbar-tab-logo mui-mbar-tab-logo-foot">
                        
                    </div>
					
					<div class="mui-mbar-tab-new" style="display:none;"></div>
                    <!--  浏览记录 用户足迹 -->
					<div class="mui-mbar-tab-tip"><?php echo lang('i_see'); ?>
						<div class="mui-mbar-arr mui-mbar-tab-tip-arr">◆</div>
					</div>
					<div class="mui-mbar-arr mui-mbar-tab-logo-arr ">◆</div>
				</div>
				
				<div class="mui-mbar-tab mui-mbar-tab-top " style="bottom: 0px; position: absolute;">
					<div class="mui-mbar-tab-logo mui-mbar-tab-logo-top"></div>
					
					<div class="mui-mbar-tab-new" style="display:none;"></div>
					<!--返回顶部-->
					<div class="mui-mbar-tab-tip"><?php echo lang('to_top'); ?>
						<div class="mui-mbar-arr mui-mbar-tab-tip-arr">◆</div>
					</div>
					<div class="mui-mbar-arr mui-mbar-tab-logo-arr ">◆</div>
				</div>
				<div class="mui-mbar-tab mui-mbar-tab-qrcode " style="bottom: 35px; position: absolute;">
					<div class="mui-mbar-tab-logo mui-mbar-tab-logo-qrcode"></div>
					
					<div class="mui-mbar-tab-new" style="display:none;"></div>
					 <!--二维码-->
					<div class="mui-mbar-tab-tip"><?php echo lang('weixin_img'); ?>
						<div class="mui-mbar-arr mui-mbar-tab-tip-arr">◆</div>
					</div>
					<div class="mui-mbar-qrcode-img" style="display: none;">
						<div class="mui-mbar-arr mui-mbar-tab-tip-arr">◆</div>
						<div class="img-box">
                             <?php if(!(empty($weixin_img) || (($weixin_img instanceof \think\Collection || $weixin_img instanceof \think\Paginator ) && $weixin_img->isEmpty()))): ?>
                             <img src="__UPLOADS__/<?php echo $weixin_img; ?>"/>
                             <?php endif; ?>
						</div>
					</div>
				</div>
				<div class="mui-mbar-tab mui-mbar-tab-ue " style="bottom: 70px; position: absolute;display:none;">
					<div class="mui-mbar-tab-logo mui-mbar-tab-logo-ue">
						<a style="display:block;width: 35px;height: 35px;overflow: hidden;text-indent: -40px" href="#">&nbsp;</a>
					</div>
					
					<div class="mui-mbar-tab-new" style="display:none;"></div>
					
					<div class="mui-mbar-tab-tip"> <!-- TODO 用户反馈 -->
						<a target="_blank" style="color:#fff;" href="#"><?php echo lang('user_feedback'); ?></a>
							<div class="mui-mbar-arr mui-mbar-tab-tip-arr">◆</div>
					</div>
					<div class="mui-mbar-arr mui-mbar-tab-logo-arr ">◆</div>
				</div>
			</div>
		</div>
		<div class="mui-mbar-mini">
			<div class="mui-mbar-mini-avatar-def"></div>
		</div>
		<div class="mui-mbar-mini-logo" style="visibility: hidden;"></div>
		<div class="mui-mbarp-prof"></div>
		<div class="mui-mbarp-qrcode" style="display: none;">
			<!--<div class="mui-mbarp-qrcode-tip" style="background-image:url(//img.alicdn.com/tfs/TB1uwIcRXXXXXXsaXXXXXXXXXXX-154-207.png)">
				<div class="mui-mbarp-qrcode-hd mui-mbarp-qrcode-hd-d"> <img src="//img.alicdn.com/tfs/TB1GPVXRpXXXXXsapXXXXXXXXXX-175-175.jpg"> </div>
				<div class="mui-mbarp-qrcode-bd "> <img src="//img.alicdn.com/tps/i4/TB1tQeoOFXXXXbsXVXXwu0bFXXX.png"> </div>
			</div>-->
			<div class="mui-mbar-arr mui-mbarp-qrcode-arr " style="color:#FF0036">◆</div>
			<div class="mui-mbar-bubble-close mui-mbarp-qrcode-bubble-close"></div>
		</div>
	</div>
</div>

<div class="js_language">
    <span id="js_member_center"><?php echo lang('js_member_center'); ?></span>
</div>

<?php if($sub_domain_status): ?>
<div id="sub-domain-status" data-value="1"></div>
<?php else: ?>
<div id="sub-domain-status" data-value="0"></div>
<?php endif; ?>