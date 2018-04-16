<?php if (!defined('THINK_PATH')) exit(); /*a:6:{s:71:"D:\git\my\tp5\public/../site/crossbbcg/view/pc/default/index\index.html";i:1506051936;s:71:"D:\git\my\tp5\public/../site/crossbbcg/view/pc/default/common\base.html";i:1505125080;s:71:"D:\git\my\tp5\public/../site/crossbbcg/view/pc/default/index\flash.html";i:1504496536;s:75:"D:\git\my\tp5\public/../site/crossbbcg/view/pc/default/index\new_goods.html";i:1506051936;s:76:"D:\git\my\tp5\public/../site/crossbbcg/view/pc/default/index\brand_list.html";i:1506051936;s:76:"D:\git\my\tp5\public/../site/crossbbcg/view/pc/default/index\goods_list.html";i:1506051936;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		
    <title>ETshop</title>
    
        
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

	
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/<?php echo $css_path; ?>/index.css" />
    
	</head>
	<body>
    
        
        <?php echo widget('crossbbcg/common/header'); ?>
  
		
    
    <div class="ly-Allwrap clearfix">
	<div class="n">
		<div class="ly-flash">
<!--请参考index.js 参数设置 此处为全屏轮播配置项 , 可覆盖默认配置项 data-carouFredSel(必须)  为加载标识  data-type(必须) 轮播类型full 为全屏-->
			<div class="slide-full" data-type="full" data-carouFredSel='{
				auto:{
					autoplay:true,
					pauseDuration:5000,
				},
				direction:"left",
				scroll:{
					item:1,
					easing:"swing"
				}
					}'>
				<div class="prev" id="prev"></div>
				<div class="next" id="next"></div>
			    <ol class="slide-content clearfix" >
                    <?php foreach(widget('Ad/get_ad',['id'=>1]) as $v): if(empty($v['ad_thumb']) || (($v['ad_thumb'] instanceof \think\Collection || $v['ad_thumb'] instanceof \think\Paginator ) && $v['ad_thumb']->isEmpty())): ?>
						<li class="slide-item"  style="background:#6000fa"> <a href="#" > <img  src="__PUBLIC__/crossbbcg/pc/default/ad/f4.jpg"/> </a> </li>
                    <?php else: ?>
                    <li class="slide-item"  style="background:<?php echo $v['background_color']; ?>"> <a href="<?php echo $v['ad_link']; ?>" > <img  src="__UPLOADS__/<?php echo $v['ad_thumb']; ?>" /> </a> </li>
                    <?php endif; endforeach; ?>
			    </ol>
				<div class="slide-page">
                    <?php foreach(widget('Ad/get_ad',['id'=>1]) as $k=>$v): if($k == '0'): ?>
					<span class="selected">●</span>
                    <?php else: ?>
                    <span>●</span>
                    <?php endif; endforeach; ?>
                </div>
			</div>
			<div class="ly-rad">
                <?php foreach(widget('Ad/get_ad',['id'=>2,'limit'=>3]) as $v): ?>
			  <a href="<?php echo $v['ad_link']; ?>" title=""> <img src="__UPLOADS__/<?php echo $v['ad_thumb']; ?>" alt="<?php echo $v['ad_info']; ?>" width="200" height="132"> </a>
                <?php endforeach; ?>
			  <!--<a href="#" title=""> <img src="__PUBLIC__/crossbbcg/pc/default/ad/rad2.jpg" alt="xx"> </a>-->
			  <!--<a href="#" title=""> <img src="__PUBLIC__/crossbbcg/pc/default/ad/rad3.jpg" alt="xx"> </a>-->
			</div>
		</div>
	</div>
</div>
    <!--广告组-->
    <div class="ly-ad-group">
        <ul class="clearfix">
            <?php foreach(widget('Ad/get_ad',array('id'=>4,'limit'=>5)) as $v): ?>
            <li>
                <a title="<?php echo $v['ad_info']; ?>" href="<?php echo $v['ad_link']; ?>"><img width="232" height="144" class="lazy" src="__PUBLIC__/<?php echo $img_path; ?>/tm.gif" data-original="__UPLOADS__/<?php echo $v['ad_thumb']; ?>" alt="<?php echo $v['ad_info']; ?>" /></a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    
    <!--国家馆-->
    <?php echo widget('crossbbcg/column/national_pavilion'); ?>
    
    <!--最新商品-->
    <?php if(!(empty(widget('Ad/get_goods_ad',array('id'=>16,'limit'=>5))) || ((widget('Ad/get_goods_ad',array('id'=>16,'limit'=>5)) instanceof \think\Collection || widget('Ad/get_goods_ad',array('id'=>16,'limit'=>5)) instanceof \think\Paginator ) && widget('Ad/get_goods_ad',array('id'=>16,'limit'=>5))->isEmpty()))): ?>
<div class="ly-new-goods">
	<div class="index-title">
		<h3><span>新品上市</span><em>NEW PRODUCT</em> </h3>
		<a class="more" target="_blank"  href="#" title="进入新品频道">进入新品频道 <i>></i></a>
	</div>
	<ul class="goods-list clearfix">
        <?php foreach(widget('Ad/get_goods_ad',array('id'=>16,'limit'=>5)) as $v): ?>
		<li class="goods-item">
			<div class="goods-pic">
				<a href="<?php echo url('crossbbcg/goods/index').'?item_id='.$v['id']; ?>" target="_blank" title="<?php echo $v['name']; ?>" >
                    <?php if(empty($v['thumb']) || (($v['thumb'] instanceof \think\Collection || $v['thumb'] instanceof \think\Paginator ) && $v['thumb']->isEmpty())): ?>
					<img width="205" height="205" class="lazy"  src="__PUBLIC__/<?php echo $img_path; ?>/tm.gif"  data-original="__PUBLIC__/<?php echo $img_path; ?>/no-image.png" alt="<?php echo $v['name']; ?>" />
                    <?php else: if(substr($v['thumb'],0,4)=='http'): ?>
                    <img width="205" height="205" class="lazy"  src="__PUBLIC__/<?php echo $img_path; ?>/tm.gif"  data-original="<?php echo $v['thumb']; ?>" alt="<?php echo $v['name']; ?>" />
                    <?php else: ?>
                    <img width="205" height="205" class="lazy"  src="__PUBLIC__/<?php echo $img_path; ?>/tm.gif"  data-original="__UPLOADS__/<?php echo $v['thumb']; ?>" alt="<?php echo $v['name']; ?>" />
                    <?php endif; endif; ?>
				</a>
			</div>
			<div class="goods-info">
				<div class="goods-name">
					<a href="<?php echo url('crossbbcg/goods/index').'?item_id='.$v['id']; ?>" target="_blank"><?php echo $v['name']; ?></a>
				</div>
				<div class="price-box">
					<span class="price"><?php echo $v['sale_price']; ?></span>
					<span class="mkt-price"><?php echo $v['market_price']; ?></span>
				</div>
			</div>
		</li>
		<?php endforeach; ?>
	</ul>
</div>
<?php endif; ?>
    <!--最新商品END-->
    
    <!--品牌-->
    <?php if(!(empty(widget('Ad/get_ad',array('id'=>6,'limit'=>14))) || ((widget('Ad/get_ad',array('id'=>6,'limit'=>14)) instanceof \think\Collection || widget('Ad/get_ad',array('id'=>6,'limit'=>14)) instanceof \think\Paginator ) && widget('Ad/get_ad',array('id'=>6,'limit'=>14))->isEmpty()))): ?>
<dl class="ly-index-brand">
	<dt class="index-title">
		<h3><span><?php echo lang('brand_guan'); ?></span><em><?php echo lang('to_brand_guan_tip'); ?></em></h3>
		<a href="<?php echo url('crossbbcg/brand/index'); ?>" title="<?php echo lang('to_brand_guan'); ?>" class="more" target="_blank" ><?php echo lang('to_brand_guan'); ?> <i> &gt; </i></a>
		
	</dt>
	<dd>
		<ul>
            <?php foreach(widget('Ad/get_ad',array('id'=>6,'limit'=>14)) as $v): ?>
			<li>
				<a href="<?php echo $v['ad_link']; ?>"  class="hover_solid" title="<?php echo $v['name']; ?>">
					<span class="brand-pic"><img class="lazy" heidth="80" src="__PUBLIC__/<?php echo $img_path; ?>/tm.gif" data-original="__UPLOADS__/<?php echo $v['ad_thumb']; ?>" alt="<?php echo $v['name']; ?>" /></span>
					<em><?php echo $v['ad_info']; ?></em>
				</a>
			</li>
			<?php endforeach; ?>
		</ul>
	</dd>
</dl>
<?php endif; ?>
    <!--品牌END-->
    
    <?php if(!(empty(widget('Ad/get_goods_ad',array('id'=>17,'limit'=>10))) || ((widget('Ad/get_goods_ad',array('id'=>17,'limit'=>10)) instanceof \think\Collection || widget('Ad/get_goods_ad',array('id'=>17,'limit'=>10)) instanceof \think\Paginator ) && widget('Ad/get_goods_ad',array('id'=>17,'limit'=>10))->isEmpty()))): ?>
<dl class="ly-index-goods-list f1" data-title="母婴用品">
	<dt class="index-title">
		<h3><div class="shu"></div><span>母婴用品</span><em>GROCERY & HEALTH</em></h3>
		<div class="more-keys">
			<ul>
                <?php foreach(widget('Ad/get_ad',array('id'=>9,'limit'=>9)) as $v): ?>
				<li><a href="<?php echo $v['ad_link']; ?>"><?php echo $v['name']; ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</dt>
	<dd>
		<!--左侧广告-->
		<div class="index-goods-left">
			<div class="hot-keys">
				<div class="hot-title"> 最热HOT </div>
				<div class="links">
                    <?php foreach(widget('Ad/get_ad',array('id'=>8,'limit'=>6)) as $v): ?>
					<span><a href="<?php echo $v['ad_link']; ?>"><?php echo $v['name']; ?></a></span>
					<?php endforeach; ?>
				</div>
			</div>
            <?php foreach(widget('Ad/get_ad',array('id'=>7,'limit'=>1)) as $v): ?>
            <a href="<?php echo $v['ad_link']; ?>">
                <?php if(empty($v['ad_thumb'])): ?>
                <img class="img-bg" src="__PUBLIC__/<?php echo $img_path; ?>/no-image.png" alt="" />
                <?php elseif(substr($v['ad_thumb'],0,4)=='http'): ?>
                <img class="img-bg" src="<?php echo $v['ad_thumb']; ?>" alt="" />
                <?php else: ?>
                <img class="img-bg" src="__UPLOADS__/<?php echo $v['ad_thumb']; ?>" alt="" />
                <?php endif; ?>
            </a>
            <?php endforeach; ?>
		</div>
		<!--左侧广告END-->
		<div class="index-goods-right">
			<ul class="clearfix goods-list">
                <?php foreach(widget('Ad/get_goods_ad',array('id'=>17,'limit'=>10)) as $v): ?>
				<li class="goods-item">
					<div class="goods-pic">
						<a class="hover_solid" href="<?php echo url('crossbbcg/goods/index').'?item_id='.$v['id']; ?>" target="_blank" title="<?php echo $v['name']; ?>" >
                            <?php if(empty($v['thumb'])): ?>
                            <img width="170" height="170" class="lazy"  src="__PUBLIC__/<?php echo $img_path; ?>/tm.gif"  data-original="__PUBLIC__/<?php echo $img_path; ?>/no-image.png" alt="<?php echo $v['name']; ?>" />
                            <?php elseif(substr($v['thumb'],0,4)=='http'): ?>
                            <img width="170" height="170" class="lazy"  src="__PUBLIC__/<?php echo $img_path; ?>/tm.gif"  data-original="<?php echo $v['thumb']; ?>" alt="<?php echo $v['name']; ?>" />
                            <?php else: ?>
                            <img width="170" height="170" class="lazy"  src="__PUBLIC__/<?php echo $img_path; ?>/tm.gif"  data-original="__UPLOADS__/<?php echo $v['thumb']; ?>" alt="<?php echo $v['name']; ?>" />
                            <?php endif; ?>
						</a>
					</div>
					<div class="goods-info">
						<div class="goods-name">
							<a href="<?php echo url('crossbbcg/goods/index').'?item_id='.$v['id']; ?>" target="_blank"><?php echo $v['name']; ?></a>
						</div>
						<div class="price-box">
							<span class="price"><?php echo $v['sale_price']; ?></span>
							<span class="mkt-price"><?php echo $v['market_price']; ?></span>
						</div>
					</div>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</dd>
</dl>
<?php endif; ?>
<!--f2-->
<?php if(!(empty(widget('Ad/get_goods_ad',array('id'=>18,'limit'=>10))) || ((widget('Ad/get_goods_ad',array('id'=>18,'limit'=>10)) instanceof \think\Collection || widget('Ad/get_goods_ad',array('id'=>18,'limit'=>10)) instanceof \think\Paginator ) && widget('Ad/get_goods_ad',array('id'=>18,'limit'=>10))->isEmpty()))): ?>
<dl class="ly-index-goods-list f2" data-title="母婴用品">
	<dt class="index-title">
		<h3><div class="shu"></div><span>母婴用品</span><em>GROCERY & HEALTH</em></h3>
		<div class="more-keys">
			<ul>
                <?php foreach(widget('Ad/get_ad',array('id'=>12,'limit'=>9)) as $v): ?>
				<li><a href="<?php echo $v['ad_link']; ?>"><?php echo $v['name']; ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</dt>
	<dd>
		<!--左侧广告-->
		<div class="index-goods-left">
			<div class="hot-keys">
				<div class="hot-title"> 最热HOT </div>
				<div class="links">
                    <?php foreach(widget('Ad/get_ad',array('id'=>11,'limit'=>6)) as $v): ?>
					<span><a href="<?php echo $v['ad_link']; ?>"><?php echo $v['name']; ?></a></span>
					<?php endforeach; ?>
				</div>
			</div>
            <?php foreach(widget('Ad/get_ad',array('id'=>10,'limit'=>1)) as $v): ?>
            <a href="<?php echo $v['ad_link']; ?>">
                <?php if(empty($v['ad_thumb'])): ?>
                <img class="img-bg" src="__PUBLIC__/<?php echo $img_path; ?>/no-image.png" alt="" />
                <?php elseif(substr($v['ad_thumb'],0,4)=='http'): ?>
                <img class="img-bg" src="<?php echo $v['ad_thumb']; ?>" alt="" />
                <?php else: ?>
                <img class="img-bg" src="__UPLOADS__/<?php echo $v['ad_thumb']; ?>" alt="" />
                <?php endif; ?>
            </a>
            <?php endforeach; ?>
		</div>
		<!--左侧广告END-->
		<div class="index-goods-right">
			<ul class="clearfix goods-list">
                <?php foreach(widget('Ad/get_goods_ad',array('id'=>18,'limit'=>10)) as $v): ?>
				<li class="goods-item">
					<div class="goods-pic">
						<a class="hover_solid" href="<?php echo url('crossbbcg/goods/index').'?item_id='.$v['id']; ?>" target="_blank" title="<?php echo $v['name']; ?>" >
                            <?php if(empty($v['thumb'])): ?>
                            <img width="170" height="170" class="lazy"  src="__PUBLIC__/<?php echo $img_path; ?>/tm.gif"  data-original="__PUBLIC__/<?php echo $img_path; ?>/no-image.png" alt="<?php echo $v['name']; ?>" />
                            <?php elseif(substr($v['thumb'],0,4)=='http'): ?>
                            <img width="170" height="170" class="lazy"  src="__PUBLIC__/<?php echo $img_path; ?>/tm.gif"  data-original="<?php echo $v['thumb']; ?>" alt="<?php echo $v['name']; ?>" />
                            <?php else: ?>
                            <img width="170" height="170" class="lazy"  src="__PUBLIC__/<?php echo $img_path; ?>/tm.gif"  data-original="__UPLOADS__/<?php echo $v['thumb']; ?>" alt="<?php echo $v['name']; ?>" />
                            <?php endif; ?>
						</a>
					</div>
					<div class="goods-info">
						<div class="goods-name">
							<a href="<?php echo url('crossbbcg/goods/index').'?item_id='.$v['id']; ?>" target="_blank"><?php echo $v['name']; ?></a>
						</div>
						<div class="price-box">
							<span class="price"><?php echo $v['sale_price']; ?></span>
							<span class="mkt-price"><?php echo $v['market_price']; ?></span>
						</div>
					</div>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</dd>
</dl>
<?php endif; ?>
<!--f3-->
<?php if(!(empty(widget('Ad/get_goods_ad',['id'=>19,'limit'])) || ((widget('Ad/get_goods_ad',['id'=>19,'limit']) instanceof \think\Collection || widget('Ad/get_goods_ad',['id'=>19,'limit']) instanceof \think\Paginator ) && widget('Ad/get_goods_ad',['id'=>19,'limit'])->isEmpty()))): ?>
<dl class="ly-index-goods-list f3" data-title="母婴用品">
	<dt class="index-title">
		<h3><div class="shu"></div><span>母婴用品</span><em>GROCERY & HEALTH</em></h3>
		<div class="more-keys">
			<ul>
                <?php foreach(widget('Ad/get_ad',array('id'=>15,'limit'=>9)) as $v): ?>
				<li><a href="<?php echo $v['ad_link']; ?>"><?php echo $v['name']; ?></a></li>
                <?php endforeach; ?>
			</ul>
		</div>
	</dt>
	<dd>
		<!--左侧广告-->
		<div class="index-goods-left">
			<div class="hot-keys">
				<div class="hot-title"> 最热HOT </div>
				<div class="links">
                    <?php foreach(widget('Ad/get_ad',array('id'=>14,'limit'=>6)) as $v): ?>
					<span><a href="<?php echo $v['ad_link']; ?>"><?php echo $v['name']; ?></a></span>
					<?php endforeach; ?>
				</div>
			</div>
            <?php foreach(widget('Ad/get_ad',['id'=>13,'limit'=>1]) as $v): ?>
            <a href="<?php echo $v['ad_link']; ?>">
                <?php if(empty($v['ad_thumb'])): ?>
                <img class="img-bg" src="__PUBLIC__/<?php echo $img_path; ?>/no-image.png" alt="" />
                <?php elseif(substr($v['ad_thumb'],0,4)=='http'): ?>
                <img class="img-bg" src="<?php echo $v['ad_thumb']; ?>" alt="" />
                <?php else: ?>
                <img class="img-bg" src="__UPLOADS__/<?php echo $v['ad_thumb']; ?>" alt="" />
                <?php endif; ?>
            </a>
			
            <?php endforeach; ?>
		</div>
		<!--左侧广告END-->
		<div class="index-goods-right">
			<ul class="clearfix goods-list">
                <?php foreach(widget('Ad/get_goods_ad',['id'=>19,'limit'=>10]) as $v): ?>
				<li class="goods-item">
					<div class="goods-pic">
						<a class="hover_solid" href="<?php echo url('crossbbcg/goods/index').'?item_id='.$v['id']; ?>" target="_blank" title="<?php echo $v['name']; ?>" >
                            <?php if(empty($v['thumb'])): ?>
                            <img width="170" height="170" class="lazy"  src="__PUBLIC__/<?php echo $img_path; ?>/tm.gif"  data-original="__PUBLIC__/<?php echo $img_path; ?>/no-image.png" alt="<?php echo $v['name']; ?>" />
                            <?php elseif(substr($v['thumb'],0,4)=='http'): ?>
                            <img width="170" height="170" class="lazy"  src="__PUBLIC__/<?php echo $img_path; ?>/tm.gif"  data-original="<?php echo $v['thumb']; ?>" alt="<?php echo $v['name']; ?>" />
                            <?php else: ?>
                            <img width="170" height="170" class="lazy"  src="__PUBLIC__/<?php echo $img_path; ?>/tm.gif"  data-original="__UPLOADS__/<?php echo $v['thumb']; ?>" alt="<?php echo $v['name']; ?>" />
                            <?php endif; ?>
						</a>
					</div>
					<div class="goods-info">
						<div class="goods-name">
							<a href="<?php echo url('crossbbcg/goods/index').'?item_id='.$v['id']; ?>" target="_blank"><?php echo $v['name']; ?></a>
						</div>
						<div class="price-box">
							<span class="price"><?php echo $v['sale_price']; ?></span>
							<span class="mkt-price"><?php echo $v['market_price']; ?></span>
						</div>
					</div>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</dd>
</dl>
<?php endif; ?>
    <!--楼层定位-->
    <div class="dingwei" id="dingwei">
        <ul class="clearfix"></ul>
    </div>
    
    <?php echo widget('crossbbcg/common/toolbar'); ?>
    
    

        <?php echo widget('crossbbcg/common/footer'); ?>
			
        
    <script type="text/javascript">
        //需要加载的js文件
        Private_Script = ['index', 'carouFredSel'];
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
