<?php if (!defined('THINK_PATH')) exit(); /*a:13:{s:71:"D:\git\my\tp5\public/../site/crossbbcg/view/pc/default/goods\index.html";i:1508285982;s:71:"D:\git\my\tp5\public/../site/crossbbcg/view/pc/default/common\base.html";i:1505125080;s:74:"D:\git\my\tp5\public/../site/crossbbcg/view/pc/default/goods\info\pic.html";i:1508285982;s:77:"D:\git\my\tp5\public/../site/crossbbcg/view/pc/default/goods\info\detail.html";i:1505816044;s:76:"D:\git\my\tp5\public/../site/crossbbcg/view/pc/default/goods\info\price.html";i:1505385695;s:74:"D:\git\my\tp5\public/../site/crossbbcg/view/pc/default/goods\info\sku.html";i:1505792282;s:79:"D:\git\my\tp5\public/../site/crossbbcg/view/pc/default/goods\info\supplier.html";i:1505792360;s:85:"D:\git\my\tp5\public/../site/crossbbcg/view/pc/default/goods\info\detail_tuijian.html";i:1506051936;s:79:"D:\git\my\tp5\public/../site/crossbbcg/view/pc/default/goods\info\hot_sole.html";i:1505383628;s:75:"D:\git\my\tp5\public/../site/crossbbcg/view/pc/default/common\left_cat.html";i:1505791009;s:73:"D:\git\my\tp5\public/../site/crossbbcg/view/pc/default/goods\history.html";i:1505792403;s:77:"D:\git\my\tp5\public/../site/crossbbcg/view/pc/default/goods\tab\comment.html";i:1507723607;s:80:"D:\git\my\tp5\public/../site/crossbbcg/view/pc/default/goods\tab\paramenter.html";i:1505383664;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		
<title><?php echo $data['meta_title']; ?></title>

        
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <?php if(!(empty($meta_keyword) || (($meta_keyword instanceof \think\Collection || $meta_keyword instanceof \think\Paginator ) && $meta_keyword->isEmpty()))): ?>
        <meta name="keywords" content= "<?php echo $meta_keyword; ?>" />
        <?php endif; if(!(empty($meta_description) || (($meta_description instanceof \think\Collection || $meta_description instanceof \think\Paginator ) && $meta_description->isEmpty()))): ?>
        <meta name="description" content= "<?php echo $meta_description; ?>" />
        <?php endif; ?>
        <link rel="icon" href="__ROOT__/favicon.ico" type="image/x-icon" />
        
		<script type="text/javascript">
			//模板静态js路径
			var root = '__ROOT__';
			var RequireParam={
				BaseScriptPath:(root == '') ? '/' : root,
				BaseScript:['jquery', 'public'],
				UpdateCartUrl:"<?php echo url('crossbbcg/carts/update_num'); ?>"
			};
			Private_Script=null
			
		</script>
		<link rel="stylesheet" type="text/css" href="__PUBLIC__/crossbbcg/<?php echo $path; ?>/css/base.css"/>
		<link rel="stylesheet" type="text/css" href="__STATIC__/layer-v3.0.3/skin/default/layer.css"/>
		<link rel="stylesheet" type="text/css" href="__STATIC__/layer-v3.0.3/skin/blue/style.css"/>
		<link rel="stylesheet" type="text/css" href="//at.alicdn.com/t/font_337798_t79wyo862h1qyqfr.css"/>

	
<link rel="stylesheet" type="text/css" href="__STATIC__/jquery.fancybox.pack/jquery.fancybox.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/crossbbcg/pc/default/css/product.css" />
 
	</head>
	<body>
    
        
        <?php echo widget('crossbbcg/common/header'); ?>
  
		
<!--面包屑-->
<div class="ly-path">
	<ul class="clearfix">
		<li class="home">
			<a href="<?php echo url('/crossbbcg/index/index'); ?>" title="<?php echo lang('Go_Home'); ?>"><?php echo lang('Home'); ?></a>
            <?php if(!empty($breadcrumb)): ?>
			<span>&gt;&nbsp;</span>
            <?php endif; ?>
		</li>
        <?php foreach($breadcrumb as $key=>$arr): ?>
		<li>
            <a href="<?php echo $arr['href']; ?>" title="<?php echo $arr['name']; ?>"><?php echo $arr['name']; ?></a>
            <?php if($key!=count($breadcrumb)-1): ?>
            <span>&gt;&nbsp;</span>
            <?php endif; ?>
		</li>
        <?php endforeach; ?>
	</ul>
</div>
<!--面包屑END-->
<div class="ly-main clearfix">
	<!--商品购买区域-->
	<div class="product-detail clearifx">
		<!--图片-->
		<div class="gallery">
			<div class="pic">
                <?php if(!(empty($data['thumb']) || (($data['thumb'] instanceof \think\Collection || $data['thumb'] instanceof \think\Paginator ) && $data['thumb']->isEmpty()))): if(substr($data['thumb'],0,4)=='http'): ?>
                    <a class="jqzoom" id="spec-n1" rel="gal1" href="<?php echo $data['thumb']; ?>"><img class="one-img" src="<?php echo $data['thumb']; ?>" /></a>
                    <?php else: ?>
                    <a class="jqzoom" id="spec-n1" rel="gal1" href="<?php echo resizeImage($data['thumb'],'big',true); ?>"><img class="one-img" src="<?php echo resizeImage($data['thumb'],'middle',true); ?>" /></a>
                    <?php endif; endif; ?>
			</div>
			<div id="spec-n5" data-type = "group" data-caroufredsel='{
				width: 345,
				height: 62,
				circular: false,
				infinite: false,
				mousewheel: true,
				auto: { play: false },
				items: 5,
				scroll: {
					 items: 1,
					
					 easing: "swing",
					 duration: 300,
					 pauseOnHover: true, 
					 fx: "scrollx" 
					 }
			}'>
				<div class="control prev" id="spec-left"><div class="jiao-left"></div></div>
						<div id="spec-list">
							<ul class="list-h slide-content">
                                <?php if(!(empty($data['thumb']) || (($data['thumb'] instanceof \think\Collection || $data['thumb'] instanceof \think\Paginator ) && $data['thumb']->isEmpty()))): ?>
								<li class="zoomThumbActive slide-item">
                                    <?php if(substr($data['thumb'],0,4)=='http'): ?>
									<a href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '<?php echo $data['thumb']; ?>',largeimage:'<?php echo $data['thumb']; ?>'}"><img src="<?php echo $data['thumb']; ?>" /></a>
                                    <?php else: ?>
                                    <a href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '<?php echo resizeImage($data['thumb'],'middle',true); ?>',largeimage:'<?php echo resizeImage($data['thumb'],'big',true); ?>'}"><img src="<?php echo resizeImage($data['thumb'],'small',true); ?>" /></a>
                                    <?php endif; ?>
								</li>
                                <?php endif; if(!(empty($image_list) || (($image_list instanceof \think\Collection || $image_list instanceof \think\Paginator ) && $image_list->isEmpty()))): foreach($image_list as $image): ?>
                                <li class="slide-item">
                                <?php if(substr($image,0,4)=='http'): ?>
									<a href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '<?php echo $image; ?>',largeimage: '<?php echo $image; ?>'}"><img src="<?php echo $image; ?>" /></a>
                                <?php else: ?>
                                    <a href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '<?php echo resizeImage($image,'middle',true); ?>',largeimage: '<?php echo resizeImage($image,'big',true); ?>'}"><img src="<?php echo resizeImage($image,'small',true); ?>" /></a>
                                <?php endif; ?>
                                </li>
                                    <?php endforeach; endif; ?>
							</ul>
							<!--rel-api
						
						smallimage:切换大图
						largeimage：放大大图
					-->
						</div>
						<div class="control next" id="spec-right"><em class="jiao-right"></em></div>
				</div>
				<!--分享-->

						<div class="bdsharebuttonbox">
							<span class="left"><?php echo lang('Share'); ?>：</span>
							<a href="#" class="bds_tsina" data-cmd="tsina" title="<?php echo lang('Share_Sina'); ?>"></a>
							<a href="#" class="bds_weixin" data-cmd="weixin" title="<?php echo lang('Share_Weixin'); ?>"></a>
							<a href="#" class="bds_qzone" data-cmd="qzone" title="<?php echo lang('Share_Qzone'); ?>"></a>
							<a href="#" class="bds_tqq" data-cmd="tqq" title="<?php echo lang('Share_Tqq'); ?>"></a>
							<a href="#" class="bds_douban" data-cmd="douban" title="<?php echo lang('Share_Douban'); ?>"></a>
						</div>
						 <div class="fav-box">
			                <a href="javascript:void(0); " class="btn btn-rounded btn-addfav  attention " data-url="<?php echo url( 'crossbbcg/goods/collectGood', 'item_id='.$data['id']); ?> ">
                                <?php if($is_collect): ?>
                                <i class="mbg icon-fav" style="background-position: 0 0;"></i>
                                <?php else: ?>
                                <i class="mbg icon-fav"></i>
                                <?php endif; ?>
                                <i class="text "><?php echo lang('Collect'); ?></i></a>
			            </div>
						<script>
							window._bd_share_config = {
								"common": {
									"bdSnsKey": {},
									"bdText": "<?php echo $data['meta_title']; ?>",
									"bdMini": "1",
									"bdMiniList": false,
									"bdPic": "<?php echo $data['thumb']; ?>",
									"bdStyle": "1",
									"bdSize": "16"
								},
								"share": {}
							};
//							with(document) 0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~(-new Date() / 36e5)];
						</script>
			</div>
		<!--细节详情-->
		
<div class="detail detail_box">
	<div class="country-ct ">
		<!--品牌 国旗-->
			<div class="brand-box left">
				<img src="<?php echo $data['national_flag']; ?>" alt="<?php echo $data['country_name']; ?>" /><?php echo $data['country_name']; if($data['brand_name']): ?> | <?php echo $data['brand_name']; endif; ?>
			</div>
			<div class="right icon-box">
                <?php if($data['type'] == 'direct_mail'): ?>
				<span class="zhiyou"><i class="iconfont icon-quanqiu"></i><?php echo lang('direct_mail'); ?></span>
                <?php endif; if($data['type'] == 'bonded'): ?>
				<span class="baoshui"><i class="iconfont icon-quanqiu"></i><?php echo lang('bonded'); ?></span>
                <?php endif; if($data['type'] == 'pay_taxes'): ?>
				<span class="wanshui"><i class="iconfont icon-quanqiu"></i><?php echo lang('pay_taxes'); ?></span>
                <?php endif; if(!(empty($seller['cat_name']) || (($seller['cat_name'] instanceof \think\Collection || $seller['cat_name'] instanceof \think\Paginator ) && $seller['cat_name']->isEmpty()))): ?>
				<span class="ziying"><?php echo $seller['cat_name']; ?></span>
                <?php endif; ?>
			</div>
	</div>
	<!--标题-->
	<div class="title">
		<h2><?php echo $data['name']; ?></h2>
	</div>
	<!--副标题-->
	<div class="sub-title">
		<?php if($data['sub_title']): ?> <?php echo $data['sub_title']; endif; ?>
	</div>
	<!--价格-->
	<div class="specific_info">
	<dl class="">
		<dt>
			<div class="price-box">
				<em class="price-em">
					<?php echo lang('Price'); ?><?php echo lang('Colon'); ?><span class="price"><?php echo $data['sale_price']; ?></span>
				</em>
                <?php if($data['price_rate'] > 0): ?>
				<em class="zhe">
                    <?php echo $data['price_rate']; ?>
                </em>
                <?php else: ?>
        <em class="zhe" style="display:none;"></em>
                <?php endif; ?>
        
				<em class="mkprice-em"><?php echo lang('Market_Price'); ?><?php echo lang('Colon'); ?><span class="mk-price"><?php echo $data['market_price']; ?></span></em>
			</div>
			
			
		</dt>
		
	</dl>
</div>
	<!--  TODO 商品活动
	<dl class="item-info huodong">
		<dt class="left">活&#12288;&#12288;动：</dt>
		<dd class="left">
            <em class="red-lb">新人专享</em>
            <a href="" target="_blank"> <font class="red">花少节目</font></a>
        </dd>
	</dl>
	-->
	<dl class="shuifei item-info">
        <dt class="left"><?php echo lang('goods_detail_tax'); ?>：</dt>
		<dd class="left">
			 <span class="tax"><?php echo $data['tax']; ?></span> &nbsp; <?php echo lang('Goods_Tax_Des'); ?>&#12288;
			<a id="shuifei_link" href="javascript:void(0);" target="_blank" data-title="<?php echo lang('tax_rule'); ?>"><?php echo lang('To_Tax_Rule'); ?><i class="jiao-right"></i></a>
		</dd>
	</dl>
	<dl class=" item-info" style="display:none;">
        <dt class="left"><?php echo lang('about_service'); ?>：</dt>
		<dd class="left">
			<p><?php echo lang('about_good'); ?> <span id="cross_name"></span> <?php echo lang('deliver'); ?></p>
			<!--   TODO 预计送达时间
			<div>24:00前完成支付，预计 <font color="#333" class="bold">9月7日(周四)</font> 送达</div>-->
		</dd>
	</dl>
	<!-- 配送 -->
	<div class="other-info">
		<ul>
			<li>
				<span><?php echo lang('Item_Shipping'); ?></span>
				<em>
					  <div class="post-age"> 
   <div class="region-chooser-container region-chooser" style="z-index: 3">
    <div class="region-chooser-selected">
     <div class="region">
      <span><?php echo lang('loading'); ?></span>
     </div>
    </div>
    <div class="region-chooser-box" id="region-chooser-box" style="display: none;">
     <div class="region-chooser-close">×</div>
     <?php if($exist_region == 'true'): ?>
     <div id="region-content" data-url="__STATIC__/js/region.json" data-item_id="<?php echo $data['id']; ?>" data-freight_url = <?php echo url('crossbbcg/goods/shippingPrice'); ?>></div>
     <?php else: ?>
     <div id="region-content" data-url="__PUBLIC__/<?php echo $js_path; ?>/region.json" data-item_id="<?php echo $data['id']; ?>" data-freight_url = <?php echo url('crossbbcg/goods/shippingPrice'); ?>></div>
     <?php endif; ?>
        
    </div>
    <div style="clear: both;"></div>
   </div> 
   <div class="post-age-info">
       <p></p>
    <!--<select name="">
    	<option value="">申通快递 : ¥12</option>
    	<option value="">申通快递 : ¥12</option>
    	<option value="">申通快递 : ¥12</option>
    </select>-->
   </div> 
  </div>
				</em>
			</li>
		</ul>
	</div>
	<div class="buy_info addcat-item">
		<!--规格-->
		<?php foreach($arr_sku as $key => $arr): ?>
<div class="spec-lists" data-url="<?php echo url('crossbbcg/goods/getSku'); ?>" data-item_id="<?php echo $data['id']; ?>">
	<dl class="clearfix spec-item">
		<dt><?php echo $key; ?>：</dt>
		<dd>
			<ul class="clearfix">
                <!--选中 selected-->
                <?php foreach($arr as $arr2): ?>
                    <!--sku选项图片-->
                    <?php if($arr2['sku_image']!=''): ?>
				<li class="spec-attr">
                    <?php if(substr($arr2['sku_image'],0,4)=='http'): ?>
					<a href="javascript:void(0);" data-rel="<?php echo $arr2['option_value_id']; ?>" rel="{gallery: 'gal1', smallimage: '<?php echo $arr2['sku_image']; ?>',largeimage:'<?php echo $arr2['sku_image']; ?>'}">
                        <img width="50" height="50" src="<?php echo $arr2['sku_image']; ?>" title="<?php echo $arr2['name']; ?>" alt="<?php echo $arr2['name']; ?>"/>
                    </a>
                        <?php else: ?>
                    <a href="javascript:void(0);" data-rel="<?php echo $arr2['option_value_id']; ?>" rel="{gallery: 'gal1', smallimage: '<?php echo resizeImage($arr2['sku_image'],'middle',true); ?>',largeimage:'<?php echo resizeImage($arr2['sku_image'],'big',true); ?>'}">
                        <img width="50" height="50" src="<?php echo resizeImage($arr2['sku_image'],'small',true); ?>" title="<?php echo $arr2['name']; ?>" alt="<?php echo $arr2['name']; ?>"/>
                    </a>
                    </a>
                    <?php endif; ?>
				</li>
                    <?php else: ?>
                <li class="spec-attr">
                    <a href="javascript:void(0);" data-rel="<?php echo $arr2['option_value_id']; ?>" data-image="<?php echo $arr2['sku_image']; ?>"> <span><?php echo $arr2['name']; ?></span> <i></i> </a>
                </li>
                    <?php endif; endforeach; ?>
			</ul>
		</dd>
	</dl>
</div>
<?php endforeach; ?>

<!--默认单个sku，无选项商品-->
<input type="hidden" name="choose_sku" value="<?php echo $choose_sku; ?>"/>
<div class="js_language">
    <span id="sku_error"><?php echo lang('sku_quantity_error'); ?></span>
    <span id="js_choose"><?php echo lang('please_choose'); ?></span>
    <span id="js_region_error"><?php echo lang('js_region_error'); ?></span>
    
</div>
<script type="text/javascript">
	var skuAll =<?php echo $all_sku; ?>
</script>



		<!--数量-->
		<dl class="clearfix computing-dl">
			<dt><?php echo lang('Item_Number'); ?></dt>
			<dd>
				<div class="computing-box">
					<div class="computing">
						<span id="quantity_dec_btn" class="reduce btn-flat btn-decrease">-</span>
						<input id="quantity_txt" type="text" class="num action-quantity-input" value="<?php echo $data['minimum']; ?>" min="<?php echo $data['minimum']; ?>" max="<?php echo $data['maximum']; ?>" data-maximum="<?php echo $data['maximum']; ?>" itemId="<?php echo $data['id']; ?>" />
						<span id="quantity_add_btn" class="add btn-flat btn-increase">+</span>
					</div>
					<div class="goods-num">
						<?php echo lang('Quantity'); ?><em><?php echo $data['quantity']; ?></em><?php echo $data['package_unit']; ?>
					</div>
				</div>

			</dd>
		</dl>

		<!--购买按钮-->
		<div class="action-btn clearifx">

			<div class="btn-box">
				<!-- 判断sku库存是否为0，或不存在-->
				<?php if($data['quantity'] <=0): ?>
                <a class="nobuy-btn" href="javascript:void(0); " title="<?php echo lang( 'Sell_Out'); ?>"><?php echo lang('Sell_Out'); ?></a>
                
                <?php else: ?>
                <a id="once_order_btn" class="buy-btn btn-addcart check " href="javascript:void(0); " data-url="<?php echo url( 'crossbbcg/carts/addcart'); ?> " title="<?php echo lang( 'Buy_Now'); ?> "><?php echo lang('Buy_Now'); ?></a>
                <a id="add_cart_btn" class="add-btn btn-addcart check " title="<?php echo lang( 'Add_Cart'); ?> " href="javascript:void(0); " data-url="<?php echo url('crossbbcg/carts/addcart'); ?> ">
                	<i class="iconfont icon-cart"></i><?php echo lang('Add_Cart'); ?></a>
                <?php endif; ?>
                <em class="qrcode-box">
                	<i class="iconfont icon-shouji"></i><span><?php echo lang('buy_by_phone'); ?></span>
                	<!-- 网页二维码 -->
				<div class="wap-erm">
					<em><img src="<?php echo $data['wechat_qr_code']; ?>" /></em>
					<!--<span><?php echo lang('Wechat_Qr_Code_Buy'); ?></span>-->
				</div>
                </em>
                
            </div>
        </div>
	</div>
    <?php if(!empty($data['promise'])): ?>
	<dl class="item-info">
		<dt class="left"><?php echo lang('promise'); ?>：</dt>
		<dd class="left">
            <?php foreach($data['promise'] as $value): ?>
            <em><?php echo $value; ?></em>&#12288;&#12288;&#12288;
            <?php endforeach; ?>
            
        </dd>
	</dl>
    <?php endif; if(!(empty($arr_payments) || (($arr_payments instanceof \think\Collection || $arr_payments instanceof \think\Paginator ) && $arr_payments->isEmpty()))): ?>
	<dl class="item-info">
		<dt class="left"><?php echo lang('goods_payments'); ?>：</dt>
		<dd class="left">
            <?php foreach($arr_payments as $key => $arr): ?>
            <em><?php echo $arr['title']; ?></em> &nbsp;&nbsp;
            <?php endforeach; ?>
        </dd>
	</dl>
    <?php endif; ?>
</div>
        
		<!--店铺信息-->
        <?php if(!empty($seller)): ?>
            <div class="product-supplier">
	<div class="n">
		<!--店铺logo-->
		<div class="logo">
            <?php if(isset($seller['logo'])): ?>
			<div class="logo-box"><a href="<?php echo url('seller/store/index','seller_id='. $data['seller_id']); ?>" title="<?php echo $seller['seller_name']; ?>" target="_blank"><img src="__UPLOADS__/<?php echo $seller['logo']; ?>" /></a></div>
            <?php endif; ?>
            <div class="title">
				<a href="<?php echo url('seller/store/index','seller_id='. $data['seller_id']); ?>" title="<?php echo $seller['seller_name']; ?>" target="_blank"><?php echo $seller['seller_name']; ?></a>
			</div>
		</div>
		<div class="supplier-info">
			<ul class="clearfix">
				<li> <span class="t">掌柜：</span><em>好孩子123</em> </li>
				<li> <span class="t">联系：</span><em><span class="lx"><i class="iconfont icon-liuyan"> </i>和我联系</em> </span></li>
				<li> <span class="t">资质：</span><em><i class="iconfont icon-renzheng"> </i> <span class="bzj" title="已基纳5000元保证金"><i class="iconfont icon-baozhengjindanbao"></i>5000</span></em> </li>
			</ul>
		</div>

		<div class="grade">
			<div class="g-s-parts clearfix">
				<div class="parts-item parts-goods">
					<span class="col1">描述</span>
					<span class="col2 ftx-02">5.0</span>
			
				</div>
				<div class="parts-item parts-goods">
					<span class="col1">服务</span>
					<span class="col2 ftx-02">5.0</span>
			
				</div>
				<div class="parts-item parts-goods" style="border: 0;">
					<span class="col1">物流</span>
					<span class="col2 ftx-01">5.0</span>
				</div>
			</div>
			
		</div>
		<div class="btn-box">
			<a href="<?php echo url('seller/store/index','seller_id='. $data['seller_id']); ?>" title="<?php echo lang('To_Store'); ?>" target="_blank"><?php echo lang('To_Store'); ?></a>
			<a href="javascript:void(0)" title="<?php echo lang('Attention_Store'); ?>" class="attention" data-url="<?php echo url('crossbbcg/goods/attentionStore','store_id='.$seller['id']); ?>"><?php echo lang('Attention_Store'); ?></a>
		</div>
        
		<dl class="tuijian-dl">
            <?php if(!(empty($arr_see) || (($arr_see instanceof \think\Collection || $arr_see instanceof \think\Paginator ) && $arr_see->isEmpty()))): ?>
			<dt><?php echo lang('see_again'); ?></dt>
			<dd>
				<ul class="clearfix">
                    <?php foreach($arr_see as $key => $arr): ?>
					<li>
						<a href="<?php echo $arr['href']; ?>" target="_blank">
                            
                            <?php if(empty($arr['thumb'])): ?>
                            <img width="80" height="80" class="lazy" src="__PUBLIC__/<?php echo $img_path; ?>/tm.gif" data-original="__PUBLIC__/<?php echo $img_path; ?>/no-image.png">
                            <?php elseif(substr($arr['thumb'],0,4)=='http'): ?>
                            <img width="80" height="80" class="lazy" src="__PUBLIC__/<?php echo $img_path; ?>/tm.gif" data-original="<?php echo $arr['thumb']; ?>" alt="<?php echo $arr['name']; ?>"/>
                            <?php else: ?>
                            <img width="80" height="80" class="lazy" src="__PUBLIC__/<?php echo $img_path; ?>/tm.gif" data-original="<?php echo resizeImage($arr['thumb'],'thumb',true); ?>" alt="<?php echo $arr['name']; ?>"/>
                            <?php endif; ?>
                            
							<span class="price"><?php echo $arr['sale_price']; ?></span>
						</a>
					</li>
                    <?php endforeach; ?>
				</ul>
			</dd>
            <?php endif; ?>
		</dl>
	</div>
</div>

        <?php else: ?>
            <div class="product-supplier">
	<dl class="tuijian-list">
		<dt class="tabs-top">
				<ul class="mc-tab mcThree" ectype="rankMcTab">
                    	<li class="curr" style="width:190px;">新品</li>
                    	<!--<li>推荐</li>-->
				</ul>
			</dt>
		<dd class="tabs-body show" data-type="group" data-caroufredsel="{
				direction: 'down',
				circular:false,
				infinite:false,
				width:190,
				height:520,
				items:4,
				scroll:{
					items:4,
					easing:'swing'
				}
					}">
			<ul class="goods-list slide-content">
                <?php foreach($arr_new as $arr_good): ?>
				<li class="goods-item slide-item">
                    <?php foreach($arr_good as $key => $arr): ?>
					<div  class="item">
						<div class="goods-pic">
							<a href="<?php echo $arr['href']; ?>" title="<?php echo $arr['name']; ?>">
                                <?php if(empty($arr['thumb'])): ?>
                                <img width="170" height="170" class="lazy" src="__PUBLIC__/<?php echo $img_path; ?>/tm.gif" data-original="__PUBLIC__/<?php echo $img_path; ?>/no-image.png">
                                <?php elseif(substr($arr['thumb'],0,4)=='http'): ?>
                                <img width="170" height="170" class="lazy" src="__PUBLIC__/<?php echo $img_path; ?>/tm.gif" data-original="<?php echo $arr['thumb']; ?>" alt="<?php echo $arr['name']; ?>"/>
                                <?php else: ?>
                                <img width="170" height="170" class="lazy" src="__PUBLIC__/<?php echo $img_path; ?>/tm.gif" data-original="<?php echo resizeImage($arr['thumb'],'thumb',true); ?>" alt="<?php echo $arr['name']; ?>"/>
                                <?php endif; ?>
                            </a>
						</div>
						<div class="goods-info">
							<div class="price-box">
								<span class="price"><?php echo $arr['sale_price']; ?></span>
							</div>
						</div>
					</div>
                    <?php endforeach; ?>
				</li>
                <?php endforeach; ?>
			</ul>
			<div class="page-btn">
				<span class="prev iconfont icon-up" style="display: none;"></span>
				<span class="next iconfont icon-down" style="display: none;"></span>
			</div>
		</dd>
		<!-- 推荐商品
		<dd class="tabs-body"  data-type="group" data-caroufredsel="{
				direction: 'down',
				circular:false,
				infinite:false,
				width:190,
				height:520,
				items:4,
				scroll:{
					items:4,
					easing:'swing'
				}
					}">
			<ul class="goods-list slide-content">
				<li class="goods-item slide-item">
					<div  class="item">
						<div class="goods-pic">
							<a href="" title="商品名称"><img width="170" height="170" class="lazy" src="/site/<?php echo $img_path; ?>/tm.gif" data-original="https://test.dscmall.cn/images/201703/thumb_img/0_thumb_G_1490174894779.jpg" alt=""></a>
						</div>
						<div class="goods-info">
						
							<div class="price-box">
								<span class="price">¥99.00</span>
							</div>
						</div>
					</div>
					<div  class="item">
						<div class="goods-pic">
							<a href="" title="商品名称"><img width="170" height="170" class="lazy" src="/site/<?php echo $img_path; ?>/tm.gif" data-original="https://test.dscmall.cn/images/201703/thumb_img/0_thumb_G_1490174894779.jpg" alt=""></a>
						</div>
						<div class="goods-info">
							
							<div class="price-box">
								<span class="price">¥99.00</span>
							</div>
						</div>
					</div>
				</li>
				<li class="goods-item slide-item">
					<div  class="item">
						<div class="goods-pic">
							<a href="" title="商品名称"><img width="170" height="170" class="lazy" src="/site/<?php echo $img_path; ?>/tm.gif" data-original="https://test.dscmall.cn/images/201703/thumb_img/0_thumb_G_1490174894779.jpg" alt=""></a>
						</div>
						<div class="goods-info">
						
							<div class="price-box">
								<span class="price">¥99.00</span>
							</div>
						</div>
					</div>
					<div  class="item">
						<div class="goods-pic">
							<a href="" title="商品名称"><img width="170" height="170" class="lazy" src="/site/<?php echo $img_path; ?>/tm.gif" data-original="https://test.dscmall.cn/images/201703/thumb_img/0_thumb_G_1490174894779.jpg" alt=""></a>
						</div>
						<div class="goods-info">
							
							<div class="price-box">
								<span class="price">¥99.00</span>
							</div>
						</div>
					</div>
				</li>
				<li class="goods-item slide-item">
					<div  class="item">
						<div class="goods-pic">
							<a href="" title="商品名称"><img width="170" height="170" class="lazy" src="/site/<?php echo $img_path; ?>/tm.gif" data-original="https://test.dscmall.cn/images/201703/thumb_img/0_thumb_G_1490174894779.jpg" alt=""></a>
						</div>
						<div class="goods-info">
						
							<div class="price-box">
								<span class="price">¥99.00</span>
							</div>
						</div>
					</div>
					<div  class="item">
						<div class="goods-pic">
							<a href="" title="商品名称"><img width="170" height="170" class="lazy" src="/site/<?php echo $img_path; ?>/tm.gif" data-original="https://test.dscmall.cn/images/201703/thumb_img/0_thumb_G_1490174894779.jpg" alt=""></a>
						</div>
						<div class="goods-info">
							
							<div class="price-box">
								<span class="price">¥99.00</span>
							</div>
						</div>
					</div>
				</li>
				<li class="goods-item slide-item">
					<div  class="item">
						<div class="goods-pic">
							<a href="" title="商品名称"><img width="170" height="170" class="lazy" src="/site/<?php echo $img_path; ?>/tm.gif" data-original="https://test.dscmall.cn/images/201703/thumb_img/0_thumb_G_1490174894779.jpg" alt=""></a>
						</div>
						<div class="goods-info">
						
							<div class="price-box">
								<span class="price">¥99.00</span>
							</div>
						</div>
					</div>
					<div  class="item">
						<div class="goods-pic">
							<a href="" title="商品名称"><img width="170" height="170" class="lazy" src="/site/<?php echo $img_path; ?>/tm.gif" data-original="https://test.dscmall.cn/images/201703/thumb_img/0_thumb_G_1490174894779.jpg" alt=""></a>
						</div>
						<div class="goods-info">
							
							<div class="price-box">
								<span class="price">¥99.00</span>
							</div>
						</div>
					</div>
				</li>
				<li class="goods-item slide-item">
					<div  class="item">
						<div class="goods-pic">
							<a href="" title="商品名称"><img width="170" height="170" class="lazy" src="/site/<?php echo $img_path; ?>/tm.gif" data-original="https://test.dscmall.cn/images/201703/thumb_img/0_thumb_G_1490174894779.jpg" alt=""></a>
						</div>
						<div class="goods-info">
						
							<div class="price-box">
								<span class="price">¥99.00</span>
							</div>
						</div>
					</div>
					<div  class="item">
						<div class="goods-pic">
							<a href="" title="商品名称"><img width="170" height="170" class="lazy" src="/site/<?php echo $img_path; ?>/tm.gif" data-original="https://test.dscmall.cn/images/201703/thumb_img/0_thumb_G_1490174894779.jpg" alt=""></a>
						</div>
						<div class="goods-info">
							
							<div class="price-box">
								<span class="price">¥99.00</span>
							</div>
						</div>
					</div>
				</li>
				
			
			</ul>
			<div class="page-btn">
				<span class="prev iconfont icon-up" style="display: none;"></span>
				<span class="next iconfont icon-down" style="display: none;"></span>
			</div>
		</dd>-->
	</dl>
</div>
        <?php endif; ?>
        
	</div>
	<!--热卖推荐-->
		<!--推荐商品-->
<!--自动判断多于6个滚动-->
<?php if(!(empty($arr_hot) || (($arr_hot instanceof \think\Collection || $arr_hot instanceof \think\Paginator ) && $arr_hot->isEmpty()))): ?>
<div class="product-hot-goods" data-type="group" data-carouFredSel='{
				items:5,
				circular:false,
				infinite:false,
				width:1190,
				direction:"left",
				items:6,
				scroll:{
					items:6,
					easing:"swing"
				}
					}'>
	<dl class="goods-ly-list">
		<dt class="ly-title">
		<h3><?php echo lang('hot_sole'); ?></h3>
        <div class="page-btn">
			<a class="slider-btn prev" href="javascript:void(0)" title="" style="display: none"><?php echo lang('Previous_Page'); ?></a>
			<a class="slider-btn next" href="javascript:void(0)" title="" style="display: none"><?php echo lang('Next_Page'); ?></a>
		</div>
				
	</dt>
	
		<!-- goods -->
		<dd class="slide-goods" style="position: relative;overflow: hidden;margin:0 auto;width:1187px">
				<ul class="goods-list clearfix slide-content">
                    <?php foreach($arr_hot as $arr): ?>
					<li class="goods-item slide-item">
						<div class="item">
							<div class="goods-pic">
							<a href="<?php echo $arr['href']; ?>" target="_blank" title="<?php echo $arr['name']; ?>">
                                <?php if(!(empty($arr['thumb']) || (($arr['thumb'] instanceof \think\Collection || $arr['thumb'] instanceof \think\Paginator ) && $arr['thumb']->isEmpty()))): if(substr($arr['thumb'],0,4)=='http'): ?>
                                <img src="<?php echo $arr['thumb']; ?>" alt="<?php echo $arr['name']; ?>" />
                                <?php else: ?>
                                <img  width="177" height="177" class="lazy" data-original="<?php echo resizeImage($arr['thumb'],'thumb',true); ?>" src="__PUBLIC__/<?php echo $img_path; ?>/tm.gif" alt="<?php echo $arr['name']; ?>" />
                                <?php endif; else: ?>
                                <img width="177" height="177" class="lazy" data-original="__PUBLIC__/<?php echo $img_path; ?>/no-image.png" src="__PUBLIC__/<?php echo $img_path; ?>/tm.gif" alt="<?php echo $arr['name']; ?>" />
                                <?php endif; ?>
								
							</a>
						</div>
						<div class="goods-info">
							<div class="goods-name">
								<a href="" target="_blank"><?php echo $arr['name']; ?></a>
							</div>
							<div class="price-box">
								<span class="price"><?php echo $arr['sale_price']; ?></span>
								<span class="mkt-price"><?php echo $arr['market_price']; ?></span>
							</div>
						</div>
						</div>
					</li>
                    <?php endforeach; ?>
				</ul>

		</dd>
		<!-- doodsEND -->
	</dl>

</div>
<?php endif; ?>
		<!--商品购买区域END-->
		<div class="page-maincontent clearfix">
			<div class="ly-main-left">
					<?php if(!(empty($arr_category) || (($arr_category instanceof \think\Collection || $arr_category instanceof \think\Paginator ) && $arr_category->isEmpty()))): ?>
<div class="left-cat associated-cat">
    <div class="ly-title cat1-title"><?php echo $arr_category['title']; ?></div>
    <?php if(!(empty($arr_category['children']) || (($arr_category['children'] instanceof \think\Collection || $arr_category['children'] instanceof \think\Paginator ) && $arr_category['children']->isEmpty()))): ?>
    <ul class="ly-wrap">
        <li class="cat1 cat-all  last">
            <dl>
                <dd class="cat2-box">
                    <?php foreach($arr_category['children'] as $key => $arr2): ?>
                    <div class="cat2<?php if(in_array($arr2['id'],$cids))echo ' cat2-all';if($key == count($arr_category['children'])-1) echo ' last' ?>">
                        <div class="cat2-title">
                            <a href="<?php echo url('crossbbcg/search/index','cat_id='.$arr2['id']); ?>" class="<?php if($arr2['id']==$now_cat_id)echo 'act';?>"><?php echo $arr2['title']; ?></a>
                            
                            <?php if(!(empty($arr2['children']) || (($arr2['children'] instanceof \think\Collection || $arr2['children'] instanceof \think\Paginator ) && $arr2['children']->isEmpty()))): ?>
                            <span class="show"></span>
                            <?php endif; ?>
                        </div>
                            <?php if(!(empty($arr2['children']) || (($arr2['children'] instanceof \think\Collection || $arr2['children'] instanceof \think\Paginator ) && $arr2['children']->isEmpty()))): ?>
                            <div class="cat3-box ">
                            <?php foreach($arr2['children'] as $arr3): ?>
                                <a href="<?php echo url('crossbbcg/search/index','cat_id='.$arr3['id']); ?>" class="<?php if($arr3['id']==$now_cat_id)echo 'act';?>"><?php echo $arr3['title']; ?></a>
                            <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </dd>
            </dl>
        </li>
    </ul>
    <?php endif; ?>
</div>
<?php endif; if(!(empty($collect) || (($collect instanceof \think\Collection || $collect instanceof \think\Paginator ) && $collect->isEmpty()))): ?>
<dl class="goods-ly-list" >

	<dt class="ly-title">
		<h3 class="left"><?php echo lang('goods_my_path'); ?></h3>
		<a href="javascript:void(0);" class="right empty" data-url="<?php echo url('crossbbcg/goods/deleteAllMyPath'); ?>"><?php echo lang('clear_record'); ?></a>
	</dt>

	<dd class="left-goods">
		<ul class="goods-list clearfix">
            <?php if(is_array($collect) || $collect instanceof \think\Collection || $collect instanceof \think\Paginator): $i = 0; $__LIST__ = $collect;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
			<li class="goods-item clearfix">

				<div class="item">
					<div class="goods-pic">
						<a target="_blank" href="<?php echo url('crossbbcg/goods/index','item_id='.$vo['goods']['id']); ?>">
                            <?php if(empty($vo['goods']['thumb'])): ?>
                            <img width="80" height="80" class="lazy" src="__PUBLIC__/<?php echo $img_path; ?>/tm.gif" data-original="__PUBLIC__/<?php echo $img_path; ?>/no-image.png">
                            <?php elseif(substr($vo['goods']['thumb'],0,4)=='http'): ?>
                            <img width="80" height="80" class="lazy" src="__PUBLIC__/<?php echo $img_path; ?>/tm.gif" data-original="<?php echo $vo['goods']['thumb']; ?>" alt="<?php echo $vo['goods']['name']; ?>"/>
                            <?php else: ?>
                            <img src="__PUBLIC__/<?php echo $img_path; ?>/tm.gif" width="80" height="80" class="lazy" data-original="<?php echo resizeImage($vo['goods']['thumb'],'thumb',true); ?>" alt="<?php echo $vo['goods']['name']; ?>"/>
                            <?php endif; ?>
                        
                        </a>
					</div>
					<div class="goods-info">
						<h6 class="goods-name">
					  <a href="<?php echo url('crossbbcg/goods/index','item_id='.$vo['goods']['id']); ?>" target="_blank" title="<?php echo $vo['goods']['name']; ?>"><?php echo $vo['goods']['name']; ?></a>
					</h6>

						<ul class="clearfix">

							<li class="price">

								<i><?php echo $vo['goods']['sale_price']; ?></i>
							</li>

							<li class="mk-price">

								<i><?php echo $vo['goods']['market_price']; ?></i>
							</li>

						</ul>

					</div>

				</div>
			</li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
			
		</ul>
	</dd>

</dl>
<?php endif; ?>
					
			</div>
			<div class="main-right ly-main-right">
				<dl class="goods-detail-tabs">
					<!--切换tab-->
					<dt class="goods-tabs-top">
					<ul class="clearfix">
						<li style="border-left: 1px solid #dfdfdf;" class="act"><span><?php echo lang('Goods_Description'); ?></span></li>
						<li><span><?php echo lang('Comment'); ?><i>(<?php echo $all_comment_list->total(); ?>)</i></span></li>
						<li><span><?php echo lang('Detailed_Attribute'); ?></span></li>
					</ul>
				</dt>
					<!--商品详情-->
					<dd class="goods-tabs-body"  >
                        <?php if(!(empty($goods_attribute) || (($goods_attribute instanceof \think\Collection || $goods_attribute instanceof \think\Paginator ) && $goods_attribute->isEmpty()))): ?>
						<div class="goods-attr-detail pci-detail-box">
							<ul class="clearfix">
                                <li title="<?php echo $data['name']; ?>"><?php echo lang('Goods_Name'); ?>：<?php echo $data['name']; ?></li>
                                <li title="<?php echo $data['good_code']; ?>"><?php echo lang('Goods_sn'); ?>：<?php echo $data['good_code']; ?></li>
                                <?php if($data['country_id']): ?>
                                <li title="<?php echo $data['country_name']; ?>"><?php echo lang('Goods_Country_Id'); ?>：<?php echo $data['country_name']; ?></li>
                                <?php endif; if($data['expiration_time']): ?>
                                <li title="<?php echo $data['expiration_time']; ?>"><?php echo lang('expiration_time'); ?>：<?php echo $data['expiration_time']; ?> <?php echo lang('day'); ?></li>
                                <?php endif; if(!(empty($filter_attribute) || (($filter_attribute instanceof \think\Collection || $filter_attribute instanceof \think\Paginator ) && $filter_attribute->isEmpty()))): foreach($filter_attribute as $key => $value): ?>
                                    <li title="<?php echo $value; ?>"><?php echo $key; ?>：<?php echo $value; ?></li>
                                    <?php endforeach; endif; ?>
                                
							</ul>
						</div>
                        <?php endif; ?>
						<div class="goods-ad">
                            <!-- 视频 -->
                            <?php if(!(empty($data['video']) || (($data['video'] instanceof \think\Collection || $data['video'] instanceof \think\Paginator ) && $data['video']->isEmpty()))): ?>
                            <div style="text-align:center;"><?php echo $data['video']; ?></div>
                            <?php endif; ?>
							<?php echo $data['description']; ?>
						</div>
					</dd>
					<!--商品详情END-->
					<!--评论-->
					<dd class="goods-tabs-body comment" style="display: none;">
					<!--评论头部-->
<div class="comment-hd clearfix">
	<div class="l">
		<div class="t"><?php echo lang('comment_good_rate'); ?></div>
		<div class="b"><?php echo $good_comment_rate; ?>%</div>
	</div>
	<!--act为选中状态-->

	<div class="goods-grade-score">
		<div class="item-w clearfix">
			<div class="level-name"><?php echo lang('comment_good'); ?>(<?php echo $good_comment->total(); ?>)</div>
			<div class="score-parent">
				<div class="scorew">
					<div class="score-progress" style="width:<?php echo $good_comment_rate; ?>%"></div>

				</div>

			</div>
		</div>
		<div class="item-w clearfix">
			<div class="level-name"><?php echo lang('comment_well'); ?>(<?php echo $medium_comment->total(); ?>)</div>
			<div class="score-parent">
				<div class="scorew">
					<div class="score-progress" style="width:<?php echo $medium_comment_rate; ?>%;"></div>

				</div>

			</div>
		</div>
		<div class="item-w clearfix">
			<div class="level-name"><?php echo lang('comment_bad'); ?>(<?php echo $bad_comment->total(); ?>)</div>
			<div class="score-parent">
				<div class="scorew">
					<div class="score-progress" style="width:<?php echo $bad_comment_rate; ?>%;"></div>
				</div>

			</div>

		</div>

	</div>
	<div class="count-grade">
		<div class="t"><?php echo lang('Composite Score'); ?></div>
		<div class="xing-box">
			<span class="act"><i></i></span>
			<span <?php if($goods_avg_score >= '2'): ?>class="act"<?php endif; ?>><i></i></span>
			<span <?php if($goods_avg_score >= '3'): ?>class="act"<?php endif; ?>><i></i></span>
			<span <?php if($goods_avg_score >= '4'): ?>class="act"<?php endif; ?>><i></i></span>
			<span <?php if($goods_avg_score == '5'): ?>class="act"<?php endif; ?>><i></i></span>
			<em><?php echo $goods_avg_score; ?><?php echo lang('comment_score'); ?></em>
		</div>
	</div>
</div>
<!--评论头部END-->
<!--评论内容-->
<div class="comment-tab">
	<ul class="claearfix">
		<li class="active" data-target="all"><span><?php echo lang('all_comment'); ?></span></li>
		<li data-target="good"><span><?php echo lang('comment_good'); ?>(<?php echo $good_comment->total(); ?>)</span></li>
		<li data-target="well"><span><?php echo lang('comment_well'); ?>(<?php echo $medium_comment->total(); ?>)</span></li>
		<li data-target="bad"><span><?php echo lang('comment_bad'); ?>(<?php echo $bad_comment->total(); ?>)</span></li>
		<li data-target="showimg"><span><?php echo lang('show_img'); ?>(<?php echo $show_image->total(); ?>)</span></li>
	</ul>
</div>
<div class="comment-bd">
	<ul id="all">
        <?php if(!(empty($all_comment_list) || (($all_comment_list instanceof \think\Collection || $all_comment_list instanceof \think\Paginator ) && $all_comment_list->isEmpty()))): foreach($all_comment_list as $v): ?>
		<li class="comment-item">
			<div class="item-s clearfix">
				<!--用户信息-->
				<div class="tx-box">
                    <?php if($v['isanonymous'] == '1'): ?>
                    <div class="tx"> <img src="__PUBLIC__/crossbbcg/pc/default/ad/member_tx.png" /> </div>
					<div class="usname"><?php echo lang('anonymity'); ?></div>
                    <?php else: ?>
                    <div class="tx">
                        <?php if(empty($v['headimg'])): ?>
                        <img src="__PUBLIC__/crossbbcg/pc/default/ad/member_tx.png" />
                        <?php elseif(substr($v['headimg'],0,4) == 'http'): ?>
                        <img src="$v.headimg" />
                        <?php else: ?>
                        <img src="__UPLOADS__/<?php echo $v['headimg']; ?>" />
                        <?php endif; ?>
                    </div>
                    <div class="usname"><?php echo $v['from_membername']; ?></div>
                    <?php endif; ?>
				</div>
				<!--评分-->
				<!--选中样式act-->
				<div class="r xing-box">
					<span class="act"><i></i></span>
					<span <?php if($v['score'] > '1'): ?>class="act"<?php endif; ?>><i></i></span>
					<span <?php if($v['score'] > '2'): ?>class="act"<?php endif; ?>><i></i></span>
					<span <?php if($v['score'] > '3'): ?>class="act"<?php endif; ?>><i></i></span>
					<span <?php if($v['score'] == '5'): ?>class="act"<?php endif; ?>><i></i></span>
					<em><?php echo $v['score']; ?><?php echo lang('comment_score'); ?></em>
				</div>
			</div>
			<div class="comment-text"> <?php echo $v['comment_content']; ?> </div>
            <?php if(!(empty($v['reply']) || (($v['reply'] instanceof \think\Collection || $v['reply'] instanceof \think\Paginator ) && $v['reply']->isEmpty()))): ?>
			<div class="comment-text" style="color: #ff561c;"><?php echo lang('seller_answer'); ?>：<?php echo $v['reply']; ?></div>
			<?php endif; ?>
			<div class="comment-pic clearfix">
				<!--a标签地址为放大图片地址-->
				<!--rel 为分组-->
                <?php if(!(empty($v['image']) || (($v['image'] instanceof \think\Collection || $v['image'] instanceof \think\Paginator ) && $v['image']->isEmpty()))): foreach($v['image'] as $vv): ?>
				<div class="pb">
					<a class="grouped" rel="group1" href="__ROOT__/uploads/<?php echo $vv; ?>"><img src="__ROOT__/uploads/<?php echo $vv; ?>" alt=""></a>
				</div>
                <?php endforeach; endif; ?>

			</div>
			<div class="comment-time"> <?php echo lang('date'); ?>：<?php echo $v['create_time']; ?> </div>
		</li>
        <?php endforeach; endif; ?>
	</ul>
    <ul id="good" style="display: none;">
        <?php if(!(empty($good_comment) || (($good_comment instanceof \think\Collection || $good_comment instanceof \think\Paginator ) && $good_comment->isEmpty()))): foreach($good_comment as $v): ?>
        <li class="comment-item">
            <div class="item-s clearfix">
                <!--用户信息-->
                <div class="tx-box">
                    <?php if($v['isanonymous'] == '1'): ?>
                    <div class="tx"> <img src="__PUBLIC__/crossbbcg/pc/default/ad/member_tx.png" /> </div>
                    <div class="usname"><?php echo lang('anonymity'); ?></div>
                    <?php else: ?>
                    <div class="tx">
                        <?php if(empty($v['headimg'])): ?>
                        <img src="__PUBLIC__/crossbbcg/pc/default/ad/member_tx.png" />
                        <?php elseif(substr($v['headimg'],0,4) == 'http'): ?>
                        <img src="$v.headimg" />
                        <?php else: ?>
                        <img src="__UPLOADS__/<?php echo $v['headimg']; ?>" />
                        <?php endif; ?>
                    </div>
                    <div class="usname"><?php echo $v['from_membername']; ?></div>
                    <?php endif; ?>
                </div>
                <!--评分-->
                <!--选中样式act-->
                <div class="r xing-box">
                    <span class="act"><i></i></span>
                    <span <?php if($v['score'] > '1'): ?>class="act"<?php endif; ?>><i></i></span>
                    <span <?php if($v['score'] > '2'): ?>class="act"<?php endif; ?>><i></i></span>
                    <span <?php if($v['score'] > '3'): ?>class="act"<?php endif; ?>><i></i></span>
                    <span <?php if($v['score'] == '5'): ?>class="act"<?php endif; ?>><i></i></span>
                    <em><?php echo $v['score']; ?><?php echo lang('comment_score'); ?></em>
                </div>
            </div>
            <div class="comment-text"> <?php echo $v['comment_content']; ?> </div>
            <?php if(!(empty($v['reply']) || (($v['reply'] instanceof \think\Collection || $v['reply'] instanceof \think\Paginator ) && $v['reply']->isEmpty()))): ?>
            <div class="comment-text" style="color: #ff561c;"><?php echo lang('seller_answer'); ?>：<?php echo $v['reply']; ?></div>
            <?php endif; ?>
            <div class="comment-pic clearfix">
                <!--a标签地址为放大图片地址-->
                <!--rel 为分组-->
                <?php if(!(empty($v['image']) || (($v['image'] instanceof \think\Collection || $v['image'] instanceof \think\Paginator ) && $v['image']->isEmpty()))): foreach($v['image'] as $vv): ?>
                <div class="pb">
                    <a class="grouped" rel="group1" href="__ROOT__/uploads/<?php echo $vv; ?>"><img src="__ROOT__/uploads/<?php echo $vv; ?>" alt=""></a>
                </div>
                <?php endforeach; endif; ?>
            
            </div>
            <div class="comment-time"> <?php echo lang('date'); ?>：<?php echo $v['create_time']; ?> </div>
        </li>
        <?php endforeach; endif; ?>
    </ul>
    <ul id="well" style="display: none;">
        <?php if(!(empty($medium_comment) || (($medium_comment instanceof \think\Collection || $medium_comment instanceof \think\Paginator ) && $medium_comment->isEmpty()))): foreach($medium_comment as $v): ?>
        <li class="comment-item">
            <div class="item-s clearfix">
                <!--用户信息-->
                <div class="tx-box">
                    <?php if($v['isanonymous'] == '1'): ?>
                    <div class="tx"> <img src="__PUBLIC__/crossbbcg/pc/default/ad/member_tx.png" /> </div>
                    <div class="usname"><?php echo lang('anonymity'); ?></div>
                    <?php else: ?>
                    <div class="tx">
                        <?php if(empty($v['headimg'])): ?>
                        <img src="__PUBLIC__/crossbbcg/pc/default/ad/member_tx.png" />
                        <?php elseif(substr($v['headimg'],0,4) == 'http'): ?>
                        <img src="$v.headimg" />
                        <?php else: ?>
                        <img src="__UPLOADS__/<?php echo $v['headimg']; ?>" />
                        <?php endif; ?>
                    </div>
                    <div class="usname"><?php echo $v['from_membername']; ?></div>
                    <?php endif; ?>
                </div>
                <!--评分-->
                <!--选中样式act-->
                <div class="r xing-box">
                    <span class="act"><i></i></span>
                    <span <?php if($v['score'] > '1'): ?>class="act"<?php endif; ?>><i></i></span>
                    <span <?php if($v['score'] > '2'): ?>class="act"<?php endif; ?>><i></i></span>
                    <span <?php if($v['score'] > '3'): ?>class="act"<?php endif; ?>><i></i></span>
                    <span <?php if($v['score'] == '5'): ?>class="act"<?php endif; ?>><i></i></span>
                    <em><?php echo $v['score']; ?><?php echo lang('comment_score'); ?></em>
                </div>
            </div>
            <div class="comment-text"> <?php echo $v['comment_content']; ?> </div>
            <?php if(!(empty($v['reply']) || (($v['reply'] instanceof \think\Collection || $v['reply'] instanceof \think\Paginator ) && $v['reply']->isEmpty()))): ?>
            <div class="comment-text" style="color: #ff561c;"><?php echo lang('seller_answer'); ?>：<?php echo $v['reply']; ?></div>
            <?php endif; ?>
            <div class="comment-pic clearfix">
                <!--a标签地址为放大图片地址-->
                <!--rel 为分组-->
                <?php if(!(empty($v['image']) || (($v['image'] instanceof \think\Collection || $v['image'] instanceof \think\Paginator ) && $v['image']->isEmpty()))): foreach($v['image'] as $vv): ?>
                <div class="pb">
                    <a class="grouped" rel="group1" href="__ROOT__/uploads/<?php echo $vv; ?>"><img src="__ROOT__/uploads/<?php echo $vv; ?>" alt=""></a>
                </div>
                <?php endforeach; endif; ?>
            
            </div>
            <div class="comment-time"> <?php echo lang('date'); ?>：<?php echo $v['create_time']; ?> </div>
        </li>
        <?php endforeach; endif; ?>
    </ul>
    <ul id="bad" style="display: none;">
        <?php if(!(empty($bad_comment) || (($bad_comment instanceof \think\Collection || $bad_comment instanceof \think\Paginator ) && $bad_comment->isEmpty()))): foreach($bad_comment as $v): ?>
        <li class="comment-item">
            <div class="item-s clearfix">
                <!--用户信息-->
                <div class="tx-box">
                    <?php if($v['isanonymous'] == '1'): ?>
                    <div class="tx"> <img src="__PUBLIC__/crossbbcg/pc/default/ad/member_tx.png" /> </div>
                    <div class="usname"><?php echo lang('anonymity'); ?></div>
                    <?php else: ?>
                    <div class="tx">
                        <?php if(empty($v['headimg'])): ?>
                        <img src="__PUBLIC__/crossbbcg/pc/default/ad/member_tx.png" />
                        <?php elseif(substr($v['headimg'],0,4) == 'http'): ?>
                        <img src="$v.headimg" />
                        <?php else: ?>
                        <img src="__UPLOADS__/<?php echo $v['headimg']; ?>" />
                        <?php endif; ?>
                    </div>
                    <div class="usname"><?php echo $v['from_membername']; ?></div>
                    <?php endif; ?>
                </div>
                <!--评分-->
                <!--选中样式act-->
                <div class="r xing-box">
                    <span class="act"><i></i></span>
                    <span <?php if($v['score'] > '1'): ?>class="act"<?php endif; ?>><i></i></span>
                    <span <?php if($v['score'] > '2'): ?>class="act"<?php endif; ?>><i></i></span>
                    <span <?php if($v['score'] > '3'): ?>class="act"<?php endif; ?>><i></i></span>
                    <span <?php if($v['score'] == '5'): ?>class="act"<?php endif; ?>><i></i></span>
                    <em><?php echo $v['score']; ?><?php echo lang('comment_score'); ?></em>
                </div>
            </div>
            <div class="comment-text"> <?php echo $v['comment_content']; ?> </div>
            <?php if(!(empty($v['reply']) || (($v['reply'] instanceof \think\Collection || $v['reply'] instanceof \think\Paginator ) && $v['reply']->isEmpty()))): ?>
            <div class="comment-text" style="color: #ff561c;"><?php echo lang('seller_answer'); ?>：<?php echo $v['reply']; ?></div>
            <?php endif; ?>
            <div class="comment-pic clearfix">
                <!--a标签地址为放大图片地址-->
                <!--rel 为分组-->
                <?php if(!(empty($v['image']) || (($v['image'] instanceof \think\Collection || $v['image'] instanceof \think\Paginator ) && $v['image']->isEmpty()))): foreach($v['image'] as $vv): ?>
                <div class="pb">
                    <a class="grouped" rel="group1" href="__ROOT__/uploads/<?php echo $vv; ?>"><img src="__ROOT__/uploads/<?php echo $vv; ?>" alt=""></a>
                </div>
                <?php endforeach; endif; ?>
            
            </div>
            <div class="comment-time"> <?php echo lang('date'); ?>：<?php echo $v['create_time']; ?> </div>
        </li>
        <?php endforeach; endif; ?>
    </ul>
    <ul id="showimg" style="display: none;">
        <?php if(!(empty($show_image) || (($show_image instanceof \think\Collection || $show_image instanceof \think\Paginator ) && $show_image->isEmpty()))): foreach($show_image as $v): ?>
        <li class="comment-item">
            <div class="item-s clearfix">
                <!--用户信息-->
                <div class="tx-box">
                    <?php if($v['isanonymous'] == '1'): ?>
                    <div class="tx"> <img src="__PUBLIC__/crossbbcg/pc/default/ad/member_tx.png" /> </div>
                    <div class="usname"><?php echo lang('anonymity'); ?></div>
                    <?php else: ?>
                    <div class="tx">
                        <?php if(empty($v['headimg'])): ?>
                        <img src="__PUBLIC__/crossbbcg/pc/default/ad/member_tx.png" />
                        <?php elseif(substr($v['headimg'],0,4) == 'http'): ?>
                        <img src="$v.headimg" />
                        <?php else: ?>
                        <img src="__UPLOADS__/<?php echo $v['headimg']; ?>" />
                        <?php endif; ?>
                    </div>
                    <div class="usname"><?php echo $v['from_membername']; ?></div>
                    <?php endif; ?>
                </div>
                <!--评分-->
                <!--选中样式act-->
                <div class="r xing-box">
                    <span class="act"><i></i></span>
                    <span <?php if($v['score'] > '1'): ?>class="act"<?php endif; ?>><i></i></span>
                    <span <?php if($v['score'] > '2'): ?>class="act"<?php endif; ?>><i></i></span>
                    <span <?php if($v['score'] > '3'): ?>class="act"<?php endif; ?>><i></i></span>
                    <span <?php if($v['score'] == '5'): ?>class="act"<?php endif; ?>><i></i></span>
                    <em><?php echo $v['score']; ?><?php echo lang('comment_score'); ?></em>
                </div>
            </div>
            <div class="comment-text"> <?php echo $v['comment_content']; ?> </div>
            <?php if(!(empty($v['reply']) || (($v['reply'] instanceof \think\Collection || $v['reply'] instanceof \think\Paginator ) && $v['reply']->isEmpty()))): ?>
            <div class="comment-text" style="color: #ff561c;"><?php echo lang('seller_answer'); ?>：<?php echo $v['reply']; ?></div>
            <?php endif; ?>
            <div class="comment-pic clearfix">
                <!--a标签地址为放大图片地址-->
                <!--rel 为分组-->
                <?php if(!(empty($v['image']) || (($v['image'] instanceof \think\Collection || $v['image'] instanceof \think\Paginator ) && $v['image']->isEmpty()))): foreach($v['image'] as $vv): ?>
                <div class="pb">
                    <a class="grouped" rel="group1" href="__ROOT__/uploads/<?php echo $vv; ?>"><img src="__ROOT__/uploads/<?php echo $vv; ?>" alt=""></a>
                </div>
                <?php endforeach; endif; ?>
            </div>
            <div class="comment-time"> <?php echo lang('date'); ?>：<?php echo $v['create_time']; ?> </div>
        </li>
        <?php endforeach; endif; ?>
    </ul>
</div>
					</dd>
					<!--评论end-->
					<!--产品参数-->
					<dd class="goods-tabs-body" style="display: none;">
						<div class="par-table">
	<table>
		<tbody>
            <tr>
                <td class="col_1" colspan="2"><?php echo lang('Goods_Base'); ?></td>
            </tr>
			<tr>
				<td class="col_1"><?php echo lang('Goods_Name'); ?></td>
                <td class="col_2"><?php echo $data['name']; ?></td>
			</tr>
            <?php if($data['en_name']): ?>
            <tr>
                <td class="col_1"><?php echo lang('Goods_En_Name'); ?></td>
                <td class="col_2"><?php echo $data['en_name']; ?></td>
            </tr>
            <?php endif; ?>
            <tr>
                <td class="col_1"><?php echo lang('Goods_sn'); ?></td>
                <td class="col_2"><?php echo $data['good_code']; ?></td>
            </tr>
            
            
            <?php if($data['package_num']): ?>
            <tr>
                <td class="col_1"><?php echo lang('Goods_Package_Num'); ?></td>
                <td class="col_2"><?php echo $data['package_num']; ?></td>
            </tr>
            <?php endif; if($data['package_unit']): ?>
            <tr>
                <td class="col_1"><?php echo lang('Goods_Package_Unit'); ?></td>
                <td class="col_2"><?php echo $data['package_unit']; ?></td>
            </tr>
            <?php endif; if($data['weight']!=0): ?>
            <tr>
                <td class="col_1"><?php echo lang('Goods_Weight'); ?> (<?php echo $data['weight_class_id']; ?>)</td>
                <td class="col_2"><?php echo $data['weight']; ?><?php echo $data['weight_class_id']; ?></td>
            </tr>
            <?php endif; if($data['clear_weight']!=0): ?>
            <tr>
                <td class="col_1"><?php echo lang('Goods_Clear_Weight'); ?> (<?php echo $data['weight_class_id']; ?>)</td>
                <td class="col_2"><?php echo $data['clear_weight']; ?><?php echo $data['weight_class_id']; ?></td>
            </tr>
            <?php endif; if($data['hs_code']): ?>
            <tr>
                <td colspan="2" class="col_1"><?php echo lang('Hs_Record'); ?></td>
            </tr>
			<tr>
				<td class="col_1"><?php echo lang('Goods_Hs_Code'); ?></td>
				<td class="col_2"><?php echo $data['hs_code']; ?></td>
			</tr>
            
            <?php if($data['hs_model']): ?>
            <tr>
                <td class="col_1"><?php echo lang('Goods_Hs_Model'); ?></td>
                <td class="col_2"><?php echo $data['hs_model']; ?></td>
            </tr>
            <?php endif; if($data['hs_quarantine_model']): ?>
            <tr>
                <td class="col_1"><?php echo lang('Goods_Hs_Quarantine_Model'); ?></td>
                <td class="col_2"><?php echo $data['hs_quarantine_model']; ?></td>
            </tr>
            <?php endif; if($data['hs_unit']): ?>
            <tr>
                <td class="col_1"><?php echo lang('Goods_Hs_Unit'); ?></td>
                <td class="col_2"><?php echo $data['hs_unit']; ?></td>
            </tr>
            <?php endif; if($data['country_id']): ?>
            <tr>
                <td class="col_1"><?php echo lang('Goods_Country_Id'); ?></td>
                <td class="col_2"><?php echo $data['country_name']; ?></td>
            </tr>
            <?php endif; endif; ?>
            
            <!--  产品参数-->
            <?php if(!(empty($goods_attribute) || (($goods_attribute instanceof \think\Collection || $goods_attribute instanceof \think\Paginator ) && $goods_attribute->isEmpty()))): foreach($goods_attribute as $key => $arr): foreach($arr as $key2 => $value2): ?>
            <tr>
                <td class="col_1"><?php echo $key2; ?></td>
                <td class="col_2"><?php echo $value2; ?></td>
            </tr>
                <?php endforeach; endforeach; endif; ?>
			
		</tbody>
	</table>
</div>
					</dd>
						
				</dl>
			</div>
		</div>
	</div>
	
<!--图片放大js引用  税收图表后台控制-->
<script type="text/html" id="shuifei_content">
	<div style="text-align:center;">
        <?php if(!(empty($tax_img) || (($tax_img instanceof \think\Collection || $tax_img instanceof \think\Paginator ) && $tax_img->isEmpty()))): ?>
        <img src="__UPLOADS__/<?php echo $tax_img; ?>" />
        <?php else: ?>
        <img src="__ROOT__/static/images/tax.png" />
        <?php endif; ?>
	</div>
</script>
<?php echo widget('crossbbcg/common/toolbar'); ?>
	

        <?php echo widget('crossbbcg/common/footer'); ?>
			
        
	<script type="text/javascript">
		//需要加载的js文件
		Private_Script = ['product','baidu'];
	</script>
	
        <script type="text/javascript" data-main="__PUBLIC__/crossbbcg/<?php echo $path; ?>/js/main" src="__STATIC__/js/require.js" ></script>
        <div class="js_language">
            <span id="js_cart_least"><?php echo lang('js_cart_least'); ?></span>
            <span id="js_cart_more"><?php echo lang('js_cart_more'); ?></span>
            <span id="js_cart_jian"><?php echo lang('js_cart_jian'); ?></span>
            <span id="js_add_cart_success"><?php echo lang('js_add_cart_success'); ?></span>
            <span id="js_choose_sku"><?php echo lang('js_choose_sku'); ?></span>
            <span id="js_ok"><?php echo lang('js_ok'); ?></span>
            <span id="js_no"><?php echo lang('js_no'); ?></span>
            <span id="js_copy_success"><?php echo lang('js_copy_success'); ?></span>
            <span id="js_copy_error"><?php echo lang('js_copy_error'); ?></span>
            <span id="js_again_code"><?php echo lang('js_again_code'); ?></span>
            <span id="js_code_success"><?php echo lang('js_code_success'); ?></span>
        </div>
	</body>
</html>
