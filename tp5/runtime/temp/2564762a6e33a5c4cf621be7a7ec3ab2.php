<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:73:"D:\git\my\tp5\public/../site/crossbbcg/view/pc/default/common/header.html";i:1505790728;}*/ ?>
    <!--head-->
    <div class="ly-header-fixed">
        <div class="n">
            <div class="ly-logo left">
                <a href="<?php echo url('crossbbcg/index/index'); ?>">
                    <img src="__UPLOADS__/<?php echo $shoplogo; ?>" alt="<?php echo $shopname; ?>" />
                </a>
            </div>
            <div class="ly-search" id="ly_search">
                <form action="<?php echo url('crossbbcg/search/index'); ?>">
                    <!--data-action 为各项的搜索提交地址-->
                    <dl class="ly-search-select">
                        <dt><span><?php echo lang('Search_Product'); ?></span><i class="jiao jiao-down"></i></dt>
                        <dd style="display: none;">
                            <em class="act" data-action="<?php echo url('crossbbcg/search/index'); ?>"><?php echo lang('Search_Product'); ?></em>
                            <!-- TODO 店铺搜索 -->
                            <!--<em data-action="<?php echo url('crossbbcg/search/index'); ?>"><?php echo lang('search_seller'); ?></em>-->
                
                        </dd>
                    </dl>
                    <input type="text" id="search_text" autocomplete="off" name="like" placeholder="<?php echo $catalog_search; ?>" value="<?php echo $like; ?>" data-default="<?php echo $catalog_search; ?>"/>
                    <button type="submit"><?php echo lang('Search'); ?></button>
                </form>
                <div class="ly-search-keys">
                    <ul>
                        <?php foreach(widget('crossbbcg/Ad/get_ad', ['id' => 3,'limit'=>5]) as $v): ?>
                        <li><a href="<?php echo $v['ad_link']; ?>"><?php echo $v['name']; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
        
                <!--搜索历史记录-->
                <?php if($search_history): ?>
                <div class="search-results hide" style="display: none;">
                    <ul class="history-results">
                        <li class="title">
                            <span><?php echo lang('recent_search'); ?></span>
                            <a href="javascript:void(0);" class="clear-history clear">
                                <i></i> <?php echo lang('to_empty'); ?>
                            </a>
                        </li>
                
                        <?php foreach($search_history as $key=>$value): ?>
                        <li class="rec_over search-<?php echo $key; ?>">
							<span>
								<a href="<?php echo url('crossbbcg/search/index') . '?like='.$value; ?>" title="<?php echo $value; ?>"><?php echo $value; ?></a>
								<i onclick="search_remove('search-<?php echo $key; ?>')" class="iconfont icon-remove" data-url="<?php echo url('crossbbcg/search/deleteSearchHistory',['key'=>$value]); ?>"></i>
							</span>
                        </li>
                        <?php endforeach; ?>
            
                    </ul>
                    <ul class="rec-results">
                        <li class="title">
                            <span><?php echo lang('hot_search'); ?></span>
                            <i class="close">×</i>
                        </li>
                        <?php foreach(widget('crossbbcg/Ad/get_ad',array('id'=>5,'limit'=>10)) as $v): ?>
                        <li>
                            <a href="<?php echo url('crossbbcg/search/index').'?like='.$v['name']; ?>" title="<?php echo $v['ad_info']; ?>"><?php echo $v['name']; ?></a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="login-info">
                <a href="<?php echo url('member/passport/index'); ?>" class="s-i"><?php echo lang('Login'); ?></a>
                <a href="<?php echo url('member/passport/signup'); ?>" class="s-n"><?php echo lang('free_register'); ?></a>
            </div>
        </div>
    </div>
    <div class="ly-headw">
        <div class="ly-head">
            <div class="ly-head-left left">
                <div class="text"><?php echo lang('Welcome'); ?><?php echo $shopname; ?></div>
            </div>
            <div class="ly-head-right right">
                <ul>
                    
                    <?php if(empty($user) || (($user instanceof \think\Collection || $user instanceof \think\Paginator ) && $user->isEmpty())): ?>
                    <li class="left"><a href="<?php echo url('member/passport/index'); ?>"><?php echo lang('Login'); ?></a></li>
                    <li class="sep left">|</li>
                    <li class="left "><a href="<?php echo url('member/passport/signup'); ?>"><?php echo lang('Register'); ?></a></li>
                    <li class="sep left">|</li>
                    <?php else: ?>
                    <li class="left "><a href="<?php echo url('member/index/index'); ?>"><?php echo $user['nickname']; ?></a></li>
                    <li class="sep left">|</li>
                    <li class="left "><a href="<?php echo url('member/passport/logout'); ?>"><?php echo lang('LoginOut'); ?></a></li>
                    <li class="sep left">|</li>
                    <?php endif; ?>
                    
                    <!--顶部协议-->
                    <?php if(!(empty($top_protocol_title) || (($top_protocol_title instanceof \think\Collection || $top_protocol_title instanceof \think\Paginator ) && $top_protocol_title->isEmpty()))): ?>
                    <li class="left"><a href="<?php echo url('crossbbcg/help/index','id='.$top_protocol_id); ?>"><?php echo $top_protocol_title; ?></a></li>
                    <li class="sep left">|</li>
                    <?php endif; ?>
                    
                    <!--手机端访问-->
                    <li class="left"><a href="<?php echo url('', ['__skin__'=>config('skin.mobile'), '__theme__'=>'mobile']); ?>"><?php echo lang('Wap_Site'); ?></a></li>
                    
                    
                    <!--微信二维码-->
                    <?php if(!(empty($weixin_img) || (($weixin_img instanceof \think\Collection || $weixin_img instanceof \think\Paginator ) && $weixin_img->isEmpty()))): ?>
                    <li class="sep left">|</li>
                    <li class="left">
                        <a href="javascript:void(0);" class="attention-weixin"><?php echo lang('Attention'); ?></a>
                        <div style="z-index:99;position:absolute;display:none;">
                        <img src="__UPLOADS__/<?php echo $weixin_img; ?>" width="100" height="100"/>
                        </div>
                    </li>
                    <?php endif; ?>
    
                    <!--qq在线客服-->
                    <?php if(!(empty($kefu_qq) || (($kefu_qq instanceof \think\Collection || $kefu_qq instanceof \think\Paginator ) && $kefu_qq->isEmpty()))): ?>
                    <li class="sep left">|</li>
                    <li class="left">
                    <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $kefu_qq; ?>&site=qq&menu=yes">
                        <?php echo lang('Online_Service'); ?>
                    </a>
                    </li>
                    <?php endif; ?>
                    
                    
                </ul>
            </div>
        </div>
    </div>
    <!--headEND-->
    <!--top-->
    
    <div class="ly-topw ">
        <div class="ly-top w1200">
            <!--logo-->
            <div class="ly-logo left">
                <a href="<?php echo url('crossbbcg/index/index'); ?>">
                    <img src="__UPLOADS__/<?php echo $shoplogo; ?>" alt="<?php echo $shopname; ?>" />
                </a>
            </div>
            <!--logoEND-->
            <!--搜索-->
            <div class="ly-search" id="ly_search">
                <form action="<?php echo url('crossbbcg/search/index'); ?>">
                    <!--data-action 为各项的搜索提交地址-->
                    <dl class="ly-search-select">
                        <dt><span><?php echo lang('Search_Product'); ?></span><i class="jiao jiao-down"></i></dt>
                        <dd style="display: none;">
                            <em class="act" data-action="<?php echo url('crossbbcg/search/index'); ?>"><?php echo lang('Search_Product'); ?></em>
                            <!-- TODO 店铺搜索 -->
                            <!--<em data-action="<?php echo url('crossbbcg/search/index'); ?>"><?php echo lang('search_seller'); ?></em>-->
                
                        </dd>
                    </dl>
                    <input type="text" id="search_text" autocomplete="off" name="like" placeholder="<?php echo $catalog_search; ?>" value="<?php echo $like; ?>" data-default="<?php echo $catalog_search; ?>"/>
                    <button type="submit"><?php echo lang('Search'); ?></button>
                </form>
                <div class="ly-search-keys">
                    <ul>
                        <?php foreach(widget('crossbbcg/Ad/get_ad', ['id' => 3,'limit'=>5]) as $v): ?>
                        <li><a href="<?php echo $v['ad_link']; ?>"><?php echo $v['name']; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
        
                <!--搜索历史记录-->
                <?php if($search_history): ?>
                <div class="search-results hide" style="display: none;">
                    <ul class="history-results">
                        <li class="title">
                            <span><?php echo lang('recent_search'); ?></span>
                            <a href="javascript:void(0);" class="clear-history clear">
                                <i></i> <?php echo lang('to_empty'); ?>
                            </a>
                        </li>
                
                        <?php foreach($search_history as $key=>$value): ?>
                        <li class="rec_over search-<?php echo $key; ?>">
							<span>
								<a href="<?php echo url('crossbbcg/search/index') . '?like='.$value; ?>" title="<?php echo $value; ?>"><?php echo $value; ?></a>
								<i onclick="search_remove('search-<?php echo $key; ?>')" class="iconfont icon-remove" data-url="<?php echo url('crossbbcg/search/deleteSearchHistory',['key'=>$value]); ?>"></i>
							</span>
                        </li>
                        <?php endforeach; ?>
            
                    </ul>
                    <ul class="rec-results">
                        <li class="title">
                            <span><?php echo lang('hot_search'); ?></span>
                            <i class="close">×</i>
                        </li>
                        <?php foreach(widget('crossbbcg/Ad/get_ad',array('id'=>5,'limit'=>10)) as $v): ?>
                        <li>
                            <a href="<?php echo url('crossbbcg/search/index').'?like='.$v['name']; ?>" title="<?php echo $v['ad_info']; ?>"><?php echo $v['name']; ?></a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
            </div>
            <!--搜索END-->
            
            <!--购物车-->
            <a href="<?php echo url('crossbbcg/carts/index'); ?>" class="ly-cat">
                <dl >
                    <dt class="icon iconfont icon-cart"></dt>
                    <dd><?php echo lang('Cart'); ?>(<em class="cart_num"><?php echo $cart_num; ?></em>)</dd>
                </dl>
            </a>
            <div class="catbg"><span class="nav-jiao"></span></div>
        </div>
    </div>
    <!--topEND-->
    <!--nav-->
    <div class="ly-nav-box">
        <div class="ly-nav">
            <!--左侧分类-->
            <div class="left ly-category">
                <h3><i class="iconfont icon-rectangular4"></i><?php echo lang('All_Categories'); ?></h3>
                <?php if(!(empty($arr_header_category) || (($arr_header_category instanceof \think\Collection || $arr_header_category instanceof \think\Paginator ) && $arr_header_category->isEmpty()))): ?>
                <ul class="public-category">
                    <?php foreach($arr_header_category as $key => $arr): ?>
                    <li>
                        <div class="item">
                            <h4><a href="<?php echo $arr['href']; ?>"><?php echo $arr['title']; ?><i>></i></a></h4>
                            <?php if(isset($arr['child'])): ?>
                            <div class="sub">
                                <?php foreach($arr['child'] as $key2 => $arr2):  if($key2 >= 4){break;}  ?>
                                <span><a href="<?php echo $arr2['href']; ?>"><?php echo $arr2['title']; ?></a></span>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="child">
                            <div class="box">
                                <div class="left cat-items">
                                    <?php if(isset($arr['child'])): foreach($arr['child'] as $key2 => $arr2): ?>
                                    
                                    <div class="two-line">
                                        <dl>
                                            <dt><a href="<?php echo $arr2['href']; ?>"><?php echo $arr2['title']; ?></a></dt>
                                            <?php if(isset($arr2['child'])): ?>
                                            <dd>
                                                <?php foreach($arr2['child'] as $key3 => $arr3): ?>
                                                <a href="<?php echo $arr3['href']; ?>"><?php echo $arr3['title']; ?></a>
                                                <?php endforeach; ?>
                                            </dd>
                                            <?php endif; ?>
                                        </dl>
                                    </div>
                                    <?php endforeach; endif; ?>
                                </div>
                                <!--品牌-->
                                <div class="cat-brand">
                                    <?php if(!(empty($arr['brands']) || (($arr['brands'] instanceof \think\Collection || $arr['brands'] instanceof \think\Paginator ) && $arr['brands']->isEmpty()))): ?>
                                    <div class="title"><?php echo lang('brands'); ?></div>
                                    <div class="clearfix">
                                        <?php foreach($arr['brands'] as $arr4): ?>
                                        <a class="left" href="<?php echo url('crossbbcg/search/index','brand_id='.$arr4['id']); ?>" target="_blank">
                                            <?php if(substr($arr4['logo'],0,4)=='http'): ?>
                                            <img src="<?php echo $arr4['logo']; ?>" alt="<?php echo $arr4['name']; ?>" />
                                            <?php else: ?>
                                            <img src="__UPLOADS__/<?php echo $arr4['logo']; ?>" alt="<?php echo $arr4['name']; ?>" />
                                            <?php endif; ?>
                                        </a>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <!--品牌end-->
                            </div>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>

            </div>
            <!--左侧分类END-->
            <!--网站导航条-->
            <div class="ly-nav-list">
                <ul class="claearfix">
                    <?php if($is_home == 'true'): ?>
                    <li class="current"><a href="<?php echo url('crossbbcg/index/index'); ?>"><?php echo lang('Home'); ?></a></li>
                    <?php else: ?>
                    <li><a href="<?php echo url('crossbbcg/index/index'); ?>"><?php echo lang('Home'); ?></a></li>
                    <?php endif; foreach($arr_header_nav as $arr): if($now_url == $arr['url']): ?>
                    <li class="current"><a href="<?php echo $arr['url']; ?>"><?php echo $arr['title']; ?></a></li>
                        <?php else: ?>
                    <li><a href="<?php echo $arr['url']; ?>"><?php echo $arr['title']; ?></a></li>
                        <?php endif; endforeach; ?>
                    
                </ul>
                
            </div>
            <div class="ly-shop-rz">
                    <a href="<?php echo url('seller/login/welcome'); ?>" target="_blank"><i class="iconfont icon-ruzhu"></i> <?php echo lang('seller_join'); ?></a>
                </div>
            <!--网站导航条END-->
        </div>
    </div>
