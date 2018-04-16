<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:73:"D:\git\my\tp5\public/../site/crossbbcg/view/pc/default/common/footer.html";i:1506324000;}*/ ?>
<div class="ly-footer-ad">
    <dl class="ad-ly-multiple">
        <dd>
            <ul class="clearfix">
                <li>
                    <a href="javascript:void (0);">
                        <img src="__PUBLIC__/crossbbcg/pc/default/image/footer1.png" title="<?php echo lang('right_product'); ?>">
                        <span><?php echo lang('right_product'); ?></span>
                    </a>
                </li>
                <li class="item-1">
                    <a href="javascript:void (0);">
                        <img src="__PUBLIC__/crossbbcg/pc/default/image/footer2.png" title="<?php echo lang('guojian'); ?>">
                        <span><?php echo lang('guojian'); ?></span>
                    </a>
                </li>
                <li>
                    <a href="javascript:void (0);">
                        <img src="__PUBLIC__/crossbbcg/pc/default/image/footer3.png" title="<?php echo lang('quick_bak'); ?>">
                        <span><?php echo lang('quick_bak'); ?></span>
                    </a>
                </li>
                <li>
                    <a href="javascript:void (0);">
                        <img src="__PUBLIC__/crossbbcg/pc/default/image/footer4.png" title="<?php echo lang('country_send'); ?>">
                        <span><?php echo lang('country_send'); ?></span>
                    </a>
                </li>
                <li>
                    <a href="javascript:void (0);">
                        <img src="__PUBLIC__/crossbbcg/pc/default/image/footer5.png" title="<?php echo lang('customer_confirm'); ?>">
                        <span><?php echo lang('customer_confirm'); ?></span>
                    </a>
                </li>
            </ul>
        </dd>
    </dl>
</div>

<div class="ly-Footbody">
    <div class="ly-Helpw">
        <div class="ly-Help w1200">
            <div class="n clearfix">
                <!--左侧-->
                <div class="help-left">
                    <div class="ly-footer-ewm">
                        <div class="img">
                            <?php if($data['app_down_qrcode']==''): ?>
                            <img src="__PUBLIC__/crossbbcg/pc/default/image/no-image.png" width="115" height="115">
                            <?php elseif(substr($data['app_down_qrcode'],0,4) == 'http'): ?>
                            <img src="<?php echo $data['app_down_qrcode']; ?>" width="115" height="115">
                            <?php else: ?>
                            <img src="__UPLOADS__/<?php echo $data['app_down_qrcode']; ?>" width="115" height="115">
                            <?php endif; ?>
                        </div>
                        <div class="text"><?php echo lang('Download_APP'); ?></div>
                    </div>
                    <div class="ly-footer-ewm">
                        <div class="img">
                            <?php if(empty($data['weixin_attention_qrcode'])): ?>
                            <img src="__PUBLIC__/crossbbcg/pc/default/image/no-image.png" width="115" height="115">
                            <?php elseif(substr($data['weixin_attention_qrcode'],0,4) == 'http'): ?>
                            <img src="<?php echo $data['weixin_attention_qrcode']; ?>" width="115" height="115">
                            <?php else: ?>
                            <img src="__UPLOADS__/<?php echo $data['weixin_attention_qrcode']; ?>" width="115" height="115">
                            <?php endif; ?>
                        </div>
                        <div class="text"><?php echo lang('Attention_weixin'); ?></div>
                    </div>
                </div>
                <!--左侧END-->
                <div class="help-center">
                    <!--item -->
                    <?php foreach($article as $vo): ?>
                    <div class="common-mod">
                        <div class="hd"> <h2 class="title"><span><?php echo $vo['title']; ?></span></h2> </div>
                        <div class="bd">
                            <ul class="news-list">
                                <?php foreach($vo['article'] as $io): ?>
                                <li>
                                    <a href="<?php echo url('crossbbcg/help/index',array('id'=>$io['id'],'cat'=>$io['category_id'])); ?>" target="_blank" title="<?php echo $io['title']; ?>"><?php echo $io['title']; ?></a>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <!--item  END-->
                </div>
                <div class="help-right">
                    <div class="ly-footer-tel clearfix">
                        <div class="t"><?php echo lang('Service_tel'); if(!(empty($data['kefu_qq']) || (($data['kefu_qq'] instanceof \think\Collection || $data['kefu_qq'] instanceof \think\Paginator ) && $data['kefu_qq']->isEmpty()))): ?>
                            <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $data['kefu_qq']; ?>&site=qq&menu=yes">
                                <img border="0" src="http://pub.idqqimg.com/qconn/wpa/button/button_111.gif" alt="<?php echo lang('kefu_online'); ?>" title="<?php echo lang('kefu_online'); ?>"/>
                            </a>
                            <?php endif; ?>
                        </div>
                        <div class="text"><i></i><?php echo $data['kefu_tel']; ?></div>
                        <div class="b"><?php echo lang($data['kefu_start_week']); ?>~<?php echo lang($data['kefu_end_week']); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo lang($data['kefu_start_time']); ?>-<?php echo lang($data['kefu_end_time']); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="fbody"> <?php echo html_entity_decode($data['site_footer_info']); ?></div>
</div>