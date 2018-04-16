<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:84:"D:\git\my\tp5\public/../site/crossbbcg/view/pc/default/column/national_pavilion.html";i:1505791880;}*/ ?>
<?php if(!(empty($arr_np) || (($arr_np instanceof \think\Collection || $arr_np instanceof \think\Paginator ) && $arr_np->isEmpty()))): ?>
<div class="Pavilion_box">
	<div class="w1200">
		<div class="Pavilion_title"><?php echo lang('pavilion_title'); ?></div>
		<div class="w1200" id="tab_box">
            
			<div class="tabContainer">
				<ul>
                    <?php foreach($arr_np as $key => $arr): ?>
					<li <?php if($key==0): ?>class="on"<?php endif; ?>><?php echo $arr['country']['name']; ?></li>
                    <?php endforeach; ?>
				</ul>
			</div>
            
            <?php if(!(empty($arr_brand) || (($arr_brand instanceof \think\Collection || $arr_brand instanceof \think\Paginator ) && $arr_brand->isEmpty()))): ?>
			<div class="panelContainer">
				<?php foreach($arr_brand as $key => $arr): ?>
				<div class="box_all" <?php if($key!=0): ?>style="display:none"<?php endif; ?>>
					<div class="c_pic">
                        <?php if(!(empty($arr['home_image']) || (($arr['home_image'] instanceof \think\Collection || $arr['home_image'] instanceof \think\Paginator ) && $arr['home_image']->isEmpty()))): ?>
						<a href="<?php echo url('crossbbcg/country/details','item_id='.$arr['id']); ?>">
                            <?php if(substr($arr['home_image'],0,4)=='http'): ?>
                            <img data-original="<?php echo $arr['home_image']; ?>" width="239" height="359" class="lazy" src="__PUBLIC__/<?php echo $img_path; ?>/tm.gif"/>
                            <?php else: ?>
                            <img data-original="__UPLOADS__/<?php echo $arr['home_image']; ?>" width="239" height="359" class="lazy" src="__PUBLIC__/<?php echo $img_path; ?>/tm.gif"/>
                            <?php endif; ?>
                        </a>
                        <?php endif; ?>
					</div>
                    <?php foreach($arr['brand'] as $key2 => $arr2): ?>
					<div class="c_pic_b">
						<a href="<?php echo url('crossbbcg/search/index','brand_id='.$arr2['id']); ?>" target="_blank" title="<?php echo $arr2['name']; ?>">
                            
                            <?php if(empty($arr2['banner_image'])): ?>
                            <img src="__PUBLIC__/<?php echo $img_path; ?>/no-image.png" />
                            <?php elseif(substr($arr2['banner_image'],0,4)=='http'): ?>
                            <img data-original="<?php echo $arr2['banner_image']; ?>" width="239" height="359" class="lazy" src="__PUBLIC__/<?php echo $img_path; ?>/tm.gif"/>
                            <?php else: ?>
                            <img data-original="__UPLOADS__/<?php echo $arr2['banner_image']; ?>" width="239" height="359" class="lazy" src="__PUBLIC__/<?php echo $img_path; ?>/tm.gif"/>
                            <?php endif; ?>
                            
							<div class="txt">
								<h3 class="tit"><?php echo $arr2['name']; ?></h3>
								<p class="desc s-fc2"><?php echo $arr2['description']; ?></p>
								<span><?php echo lang('to_brand'); ?></span>
							</div>
						</a>
					</div>
                    <?php endforeach; ?>
				</div>
                <?php endforeach; ?>
			</div>
            <?php endif; ?>
		</div>
	</div>
</div>
<?php endif; ?>