<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:67:"D:\git\my\tp5\public/../site/crossbbcg/view/admin\config\index.html";i:1506764635;s:56:"D:\git\my\tp5\public/../site/admin\view\public\base.html";i:1506158164;s:56:"D:\git\my\tp5\public/../site/admin\view\public\navs.html";i:1503361789;s:56:"D:\git\my\tp5\public/../site/admin\view\public\lang.html";i:1503361789;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="renderer" content="webkit" />
    <title><?php echo (isset($meta_title) && ($meta_title !== '')?$meta_title:''); ?> | <?php echo lang('cmfname'); ?></title>
	<meta name="keywords" content=" " />
	<meta name="description" content=" " />
    <meta name="generator" content="">
    
	<link href="__ROOT__/favicon.ico" type="image/x-icon" rel="shortcut icon">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/admin/css/style.css" />
    <?php echo get_res('css');; ?>
    <link rel="stylesheet" type="text/css" href="__CSS__/jquery-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="__CSS__/jquery-ui-timepicker-addon.min.css" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="__JS__/jquery-1.9.1.min.js"></script>
    <![endif]-->
    <!--[if gte IE 9]><!-->
    <script type="text/javascript" src="__JS__/jquery-2.1.4.min.js"></script>
    <!--<![endif]-->
    
	<script type="text/javascript" src="__JS__/jquery-ui.min.js"></script>
    <script type="text/javascript" src="__JS__/jquery-ui-timepicker-addon.min.js"></script>
    <script type="text/javascript" src="__JS__/jquery-ui-i18n.min.js"></script>
    <!-- tooltip files -->
    <script type="text/javascript" src="__JS__/jquery.tipTip.min.js"></script>
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/admin/css/tipTip.css" />
    <link rel="stylesheet" type="text/css" href="__CSS__/div.css" />
    <script type="text/javascript">/*<![CDATA[*/var cookiePath = "__ROOT__/";/*]]>*/</script>
	<script type="text/javascript" src="__PUBLIC__/admin/js/main.js"></script>
    <script type="text/javascript" src="__ROOT__/static/layer-v3.0.3/layer.js"></script>
    <script type="text/javascript" src="__PUBLIC__/admin/js/commonv3.0.3.js"></script>
    
    <link rel="stylesheet" type="text/css" href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <!--search select input-->
    <script type="text/javascript" src="__ROOT__/static/chosen/chosen.jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="__ROOT__/static/chosen/chosen.min.css" />
    
    <?php echo get_res('js');; ?>
    
    
    <style>
        .apppush, .dis{display: none;}
    </style>
    
</head>
<body>

    <?php
        //获取选择参数
        $inputarr = is_array(input('param.')) ?  input('param.') : array();
    ?>
    <div id="alert_win" class="bg"></div>
    <div style="top:50%;display:block" class="zeng_msgbox_layer_wrap" id="msg">
        <span style="z-index:10000" class="zeng_msgbox_layer">
            <span class="gtl_ico_clear"></span>
            <div class="bd-loding"></div><?php echo lang('Page_loding'); ?>
            <span class="gtl_end"></span>
        </span>
    </div>
    
    <script>
	function showInit(){
		var c = setTimeout("alert_win.style.display='none',msg.style.display='none'",500);
		$(".breadcrumbs").append("<sapn id='jnkc'>Loading......</sapn>");
		setInterval("jnkc.innerHTML=new Date().toLocaleString();",1000);
	}

	addLoadEvent(showInit);

	/*window.onunload = function(){
		clearInterval(c);
	}*/
	</script>

    <!-- HEADER --> 
    <div id="top">
    <div id="head">
        <div class="left">
            <a class="header-title" href="<?php echo url('admin/index/index'); ?>" title="<?php echo lang('Cmfname'); ?>">
                <i class="fa fa-cloud white"></i><?php echo lang('Cmfname'); ?>
            </a>
        </div>
        
        <div class="right">
            
            <div id="dd" class="wrapper-dropdown">
            <img height="24px" src="__PUBLIC__/admin/images/accounts/no_image.png" alt="avatar" /><span><?php echo lang('Adminhi'); ?>, <?php echo session('admin_auth')['username']; ?></span>
            <ul class="dropdown">
            	<li>
                    <a href="<?php echo url('admin/index/index'); ?>">
                        <i class="icon-home"></i><?php echo lang('Index'); ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo url('admin/index/dashboard'); ?>">
                        <i class="icon-dashboard"></i><?php echo lang('dashboard'); ?>
                    </a>
                </li>

                <li>
                    <a href="<?php echo url('admin/config/index'); ?>">
                        <i class="icon-settings"></i><?php echo lang('siteconfig'); ?></a>
                </li>

                <li>
                    <a href="<?php echo url('admin/index/myinfo'); ?>" class="ajax-get" data-width="450" data-height="270">
                        <i class="icon-account"></i><?php echo lang('myaccount'); ?>
                    </a>
                </li>
            </ul>
            </div>
    
            <div class="left headicon">
                <a href="<?php echo url('index/index/index', ['__theme__'=> 'pc', '__skin__' => 'default']); ?>" target="_blank" class="tooltip-link" title="<?php echo lang('Pc terminal'); ?>">
                    <i class="fa fa-television white"></i>
                </a>
        
                <a href="<?php echo url('index/index/index', ['__theme__'=> 'mobile', '__skin__' => 'default']); ?>" target="_blank" class="tooltip-link" title="<?php echo lang('Mobile terminal'); ?>">
                    <i class="fa fa-mobile white"></i>
                </a>
        
                </a>
                <a href="<?php echo url('seller/index/index'); ?>" target="_blank" class="tooltip-link" title="<?php echo lang('Seller terminal'); ?>">
                    <i class="fa fa-user-md white"></i>
                </a>
            </div>
            
            <div class="cache f24">
                <a class="tooltip-link ajax-clear" title="<?php echo lang('clearcache'); ?>" href="<?php echo url('admin/index/clearcache'); ?>">
                    <i class="fa fa-refresh white"></i>
                </a>
            </div>
            
            <div class="tnavs">
                <a class="tooltip-link ajax-get" title="<?php echo lang('Navs'); ?>" href="<?php echo url('admin/index/navs'); ?>" data-title="<?php echo lang('Navs'); ?>" data-height="630" data-width="860">
                    <i class="fa fa-th-large white"></i>
                </a>
            </div>
            
            <!--<div class="indexhome">
                <a class="tooltip-link" title="<?php echo lang('Homeindex'); ?>" href="__ROOT__/" target="_blank">
                    <img src="__PUBLIC__/admin/images/icons/home.png" alt="<?php echo lang('Homeindex'); ?>" />
                </a>
            </div>-->
    
            <div class="help">
                <a class="tooltip-link" title="<?php echo lang('Helpcenter'); ?>" target="_blank" href="//help.runtuer.com">
                    <i class="fa fa-question-circle white"></i>
                </a>
            </div>
            
            <div class="logout">
                <a class="tooltip-link ajax-get confirm" title="<?php echo lang('logout'); ?>" href="<?php echo url('admin/passport/logout'); ?>" data-layer="<?php echo lang('confirmlogout'); ?>" data-title="<?php echo lang('logout'); ?>" data-postion="1" >
                    <i class="fa fa-power-off white"></i>
                </a>
            </div>
        </div>
    </div>
    
    </div>

    <!-- SIDEBAR -->
    <div id="sidebar" class="noscroll">
        <div id="top-line">            
            <a href="javascript:void(0);" id="menuopen"><?php echo lang('Open'); ?> <label>&#9660;</label></a>
            <a href="javascript:void(0);" id="menuclose"><?php echo lang('Close'); ?> <label>&#9650;</label></a>
            <a href="javascript:void(0);" id="menucollapse" data-direction="ltr">&#9664;</a>
        </div>

        
        <?php echo $__MENU__; ?>
        
    </div>
                
    <!-- CONTENT --> 
    
    <div id="content">
        <div class="breadcrumbs">
            <?php echo lang('Crossbbcg'); ?> : &nbsp;&nbsp; <?php echo lang('Crossbbset'); ?> &nbsp;/&nbsp; <span><?php echo (isset($meta_title) && ($meta_title !== '')?$meta_title:''); ?></span>
        </div>

        <div class="bloc">
            <div class="title">
                <div class="tabs" id="navs">
                            <?php echo getChild($__CHILD__); ?>
                </div>

                			  <div class="back-link">
                  <select id="selectlang" name="selectlang">
                      <?php if(!(empty($langs) || (($langs instanceof \think\Collection || $langs instanceof \think\Paginator ) && $langs->isEmpty()))): if(is_array($langs) || $langs instanceof \think\Collection || $langs instanceof \think\Paginator): $i = 0; $__LIST__ = $langs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lang): $mod = ($i % 2 );++$i;?>
                              <option value="<?php echo $key; ?>" data-url="<?php echo url('', array_merge(is_array(input('param')) ? input('param') : array(), array('lang'=>$key) )); ?>" <?php if($key == LANG): ?>selected<?php endif; ?>><?php echo $lang[0]; ?> ( <?php echo $lang[1]; ?> )</option>
    
                              
                          <?php endforeach; endif; else: echo "" ;endif; else: ?>
                          <option value="0"><?php echo lang('No_record'); ?></option>
                      <?php endif; ?>
                  </select>
				<script>
				$(function(){
					$("#selectlang").change(function(){
                        var lang_url = $(this).find("option:selected").attr('data-url');
                        eval("self.location='"+lang_url+"'")
                    })
                })
				</script>
                </div>
            </div>
    
            <form name="frmShopSettingsEdit" method="post" style="margin-top:5px;">
                
                <div class="alert alert-warning">
                    <button class="close" type="button">&times;</button>
                    <span class="alert-content"><?php echo lang('Shopconfmark'); ?></span>
                </div>
                
                <div class="bloc" id="blocStatistics">
                    <!--<div class="title collapsible">-->
                    <div class="title">
                        <div class="tabs static pot" id="blockStatistics">
                            <ul>
                                <a id="tabStat1_link" href="#tabStat1">
                                    <li><?php echo lang('Shopconf'); ?></li>
                                </a>
                                <a id="tabStat2_link" href="#tabStat2">
                                    <li><?php echo lang('Tradeconf'); ?></li>
                                </a>
                                <a id="tabStat3_link" href="#tabStat3">
                                    <li><?php echo lang('Distribconf'); ?></li>
                                </a>
                                <a id="tabStat4_link" href="#tabStat4">
                                     <li><?php echo lang('Pointconf'); ?></li>
                                </a>
                                <a id="tabStat5_link" href="#tabStat5">
                                    <li><?php echo lang('Baseconf'); ?></li>
                                </a>
                                <a id="tabStat6_link" href="#tabStat6">
                                    <li><?php echo lang('Shopappconf'); ?></li>
                                </a>
                                <a id="tabStat7_link" href="#tabStat7">
                                    <li><?php echo lang('Shopmobconf'); ?></li>
                                </a>
                                <a id="tabStat8_link" href="#tabStat8">
                                    <li><?php echo lang('Licenseinfo'); ?></li>
                                </a>
                                <a id="tabStat9_link" href="#tabStat9">
                                    <li><?php echo lang('protocol'); ?></li>
                                </a>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="content" style="padding-bottom: 20px;">
                        <div id="tabStat1" style="display:block;">
                            <table class="table kright">
                                <tbody>
                                <tr>
                                    <td><?php echo lang('Shopname'); ?>: </td>
                                    <td class="left">
                                        <input name="shopname" type="text" placeholder="<?php echo lang('Shopname_pla'); ?>" style="width: 300px;" value="<?php echo $data['shopname']; ?>" />
                                        <a class="tooltip-icon" title="<?php echo lang('Shopname_tip'); ?>"></a>
                                    </td>
                                </tr>

                                <tr>
                                    <td><?php echo lang('Shopurl'); ?>: </td>
                                    <td class="left">
                                        <input name="shopurl" type="text" placeholder="//www.shop.com" style="width: 300px;" value="<?php echo (isset($data['shopurl']) && ($data['shopurl'] !== '')?$data['shopurl']:''); ?>" />
                                        <a class="tooltip-icon" title="//www.shop.com"></a>
                                    </td>
                                </tr>

                                <tr>
                                    <td><?php echo lang('Shoplogo'); ?>:  </td>
                                    <td>
                                        <input name="shoplogo" type="text" class="input" value="<?php echo $data['shoplogo']; ?>" id="shoplogo" style="width: 300px;" placeholder="image/logo.png" />
                                        <input class="button white upload" value="<?php echo lang('Selectimg'); ?>" title="<?php echo lang('Selectimg'); ?>" type="button" title="<?php echo lang('Upload img and file'); ?>" url="<?php echo url('img', ['input' => 'shoplogo']); ?>" data-upload="__UPLOADS__" />
                                        <a href="javascript:void(0)" class="preview" data-src="shoplogo" data-width="200" data-height="200" data-area="200"><?php echo lang('Preview'); ?></a>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td><?php echo lang('Shoptitle'); ?>:  </td>
                                    <td>
                                        <input name="shoptitle" type="text" placeholder="<?php echo lang('Shoptitle_pla'); ?>" style="width: 500px;" value="<?php echo (isset($data['shoptitle']) && ($data['shoptitle'] !== '')?$data['shoptitle']:''); ?>" maxlength="100"/>
                                        <a class="tooltip-icon" title="<?php echo lang('Shoptitle_tip'); ?>"></a>
                                    </td>
                                </tr>

                                <tr>
                                    <td><?php echo lang('Shopkeywords'); ?>:  </td>
                                    <td>
                                        <input name="shopkeywords" type="text" placeholder="<?php echo lang('Shopkeywords_pla'); ?>" style="width: 500px;" value="<?php echo (isset($data['shopkeywords']) && ($data['shopkeywords'] !== '')?$data['shopkeywords']:''); ?>" maxlength="100"/>
                                        <a class="tooltip-icon" title="<?php echo lang('Shopkeywords_tip'); ?>"></a>
                                    </td>
                                </tr>

                                <tr>
                                    <td><?php echo lang('Shopdescription'); ?>:  </td>
                                    <td>
                                        <input name="shopdescription" type="text" placeholder="<?php echo lang('Shopdescription_pla'); ?>" style="width: 500px;" maxlength="200" value="<?php echo (isset($data['shopdescription']) && ($data['shopdescription'] !== '')?$data['shopdescription']:''); ?>" />
                                        <a class="tooltip-icon" title="<?php echo lang('Shopdescription_tip'); ?>"></a>
                                    </td>
                                </tr>

                                <tr>
                                    <td><?php echo lang('Shopcontanter'); ?>: </td>
                                    <td class="left">
                                        <input name="shopcontanter" type="text" placeholder="<?php echo lang('Shopcontanter_pla'); ?>" style="width: 300px;" value="<?php echo (isset($data['shopcontanter']) && ($data['shopcontanter'] !== '')?$data['shopcontanter']:''); ?>" />
                                    </td>
                                </tr>

                                <tr>
                                    <td><?php echo lang('Shopemail'); ?>: </td>
                                    <td class="left">
                                        <input name="shopemail" type="text" placeholder="<?php echo lang('Shopemail_pla'); ?>" style="width: 300px;" value="<?php echo (isset($data['shopemail']) && ($data['shopemail'] !== '')?$data['shopemail']:'@'); ?>" />
                                        <a class="tooltip-icon" title="<?php echo lang('Shopemail_tip'); ?>"></a>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td><?php echo lang('kefu_tel'); ?>:</td>
                                    <td>
                                        <input type="text" name="kefu_tel" placeholder="4000000000" value="<?php echo $data['kefu_tel']; ?>"/>
                                        <a class="tooltip-icon" title="<?php echo lang('Shoptel_tip'); ?>"></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo lang('kefu_qq'); ?>:</td>
                                    <td>
                                        <input type="text" name="kefu_qq" value="<?php echo $data['kefu_qq']; ?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo lang('Shopaddr'); ?>: </td>
                                    <td class="left">
                                        <input name="shopaddr" type="text" placeholder="<?php echo lang('Shopaddr_pla'); ?>" style="width: 300px;" value="<?php echo (isset($data['shopaddr']) && ($data['shopaddr'] !== '')?$data['shopaddr']:''); ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo lang('kefu_time'); ?>:</td>
                                    <td>
                                        <select name="kefu_start_week">
                                            <option value="Monday" <?php if($data['kefu_start_week'] == 'Monday'): ?>selected<?php endif; ?>><?php echo lang('Monday'); ?></option>
                                            <option value="Tuesday" <?php if($data['kefu_start_week'] == 'Tuesday'): ?>selected<?php endif; ?>><?php echo lang('Tuesday'); ?></option>
                                            <option value="Wednesday" <?php if($data['kefu_start_week'] == 'Wednesday'): ?>selected<?php endif; ?>><?php echo lang('Wednesday'); ?></option>
                                            <option value="Thursday" <?php if($data['kefu_start_week'] == 'Thursday'): ?>selected<?php endif; ?>><?php echo lang('Thursday'); ?></option>
                                            <option value="Friday" <?php if($data['kefu_start_week'] == 'Friday'): ?>selected<?php endif; ?>><?php echo lang('Friday'); ?></option>
                                            <option value="Saturday" <?php if($data['kefu_start_week'] == 'Saturday'): ?>selected<?php endif; ?>><?php echo lang('Saturday'); ?></option>
                                            <option value="Sunday" <?php if($data['kefu_start_week'] == 'Sunday'): ?>selected<?php endif; ?>><?php echo lang('Sunday'); ?></option>
                                        </select>~
                                        <select name="kefu_end_week">
                                            <option value="Monday" <?php if($data['kefu_end_week'] == 'Monday'): ?>selected<?php endif; ?>><?php echo lang('Monday'); ?></option>
                                            <option value="Tuesday" <?php if($data['kefu_end_week'] == 'Tuesday'): ?>selected<?php endif; ?>><?php echo lang('Tuesday'); ?></option>
                                            <option value="Wednesday" <?php if($data['kefu_end_week'] == 'Wednesday'): ?>selected<?php endif; ?>><?php echo lang('Wednesday'); ?></option>
                                            <option value="Thursday" <?php if($data['kefu_end_week'] == 'Thursday'): ?>selected<?php endif; ?>><?php echo lang('Thursday'); ?></option>
                                            <option value="Friday" <?php if($data['kefu_end_week'] == 'Friday'): ?>selected<?php endif; ?>><?php echo lang('Friday'); ?></option>
                                            <option value="Saturday" <?php if($data['kefu_end_week'] == 'Saturday'): ?>selected<?php endif; ?>><?php echo lang('Saturday'); ?></option>
                                            <option value="Sunday" <?php if($data['kefu_end_week'] == 'Sunday'): ?>selected<?php endif; ?>><?php echo lang('Sunday'); ?></option>
                                        </select>
                                        <input type="text" name="kefu_start_time" id="start_time" value="<?php echo $data['kefu_start_time']; ?>" placeholder="09:00" class="input_img w50"/>~
                                        <input type="text" name="kefu_end_time" id="end_time" value="<?php echo $data['kefu_end_time']; ?>" placeholder="18:00" class="input_img w50"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo lang('app_down_qrcode'); ?>:</td>
                                    <td><input name="app_down_qrcode" type="text" class="input" value="<?php echo $data['app_down_qrcode']; ?>" id="app_down_qrcode" style="width: 180px;margin-left: 4px;" placeholder="image/logo.png" />
                                        <input class="button white upload" value="<?php echo lang('Selectimg'); ?>" title="<?php echo lang('Selectimg'); ?>" type="button" title="<?php echo lang('Upload img and file'); ?>" url="<?php echo url('img',array('input' => 'app_down_qrcode')); ?>" data-upload="__UPLOADS__" />
                                        <a href="javascript:void(0)" class="preview" data-src="app_down_qrcode" data-width="200" data-height="200" data-area="200"><?php echo lang('Preview'); ?></a></td>
                                </tr>
                                <tr>
                                    <td><?php echo lang('weixin_attention_qrcode'); ?>:</td>
                                    <td>
                                        <input name="weixin_attention_qrcode" type="text" class="input" value="<?php echo $data['weixin_attention_qrcode']; ?>" id="weixin_attention_qrcode" style="width: 180px;margin-left: 4px;" placeholder="image/logo.png" />
                                        <input class="button white upload" value="<?php echo lang('Selectimg'); ?>" title="<?php echo lang('Selectimg'); ?>" type="button" title="<?php echo lang('Upload img and file'); ?>" url="<?php echo url('img',array('input' => 'weixin_attention_qrcode')); ?>" data-upload="__UPLOADS__" />
                                        <a href="javascript:void(0)" class="preview" data-src="weixin_attention_qrcode" data-width="200" data-height="200" data-area="200"><?php echo lang('Preview'); ?></a>
                                    </td>
                                </tr>

                                <tr>
                                    <td><?php echo lang('tax_img'); ?>:</td>
                                    <td>
                                        <input name="tax_img" type="text" class="input" value="<?php echo $data['tax_img']; ?>" id="tax_img" style="width: 180px;margin-left: 4px;" placeholder="image/logo.png" />
                                        
                                        <input class="button white upload" value="<?php echo lang('Selectimg'); ?>" title="<?php echo lang('Selectimg'); ?>" type="button" url="<?php echo url('img',array('input' => 'tax_img')); ?>" data-upload="__UPLOADS__" />
                                        <a href="javascript:void(0)" class="preview" data-src="tax_img" data-width="200" data-height="200" data-area="200"><?php echo lang('Preview'); ?></a>
                                        
                                    </td>
                                </tr>

                                <tr>
                                    <td style="vertical-align:top; padding: 8px 15px;"><?php echo lang('Shopstatistical'); ?>:  </td>
                                    <td style="vertical-align:top; padding: 8px 0;">
                                        <textarea name="shopstatistical" rows="3" style="width: 450px;resize: none;"><?php echo (isset($data['shopstatistical']) && ($data['shopstatistical'] !== '')?$data['shopstatistical']:''); ?></textarea>
                                        <a class="tooltip-icon" title="<?php echo lang('Shopstatistical_tip'); ?>" style="vertical-align: top;"></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align:top; padding: 8px 15px;"><?php echo lang('site_footer_info'); ?>:  </td>
                                    <td style="vertical-align:top; padding: 8px 0;">
                                        <textarea name="site_footer_info" class="site_info" rows="3" style="width: 500px;resize: none;"><?php echo html_entity_decode($data['site_footer_info']); ?></textarea>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
    
                        <div id="tabStat2">
                            <table class="table kright">
                                <tbody>

                                <!--<tr class="row bset">
                                    <td><?php echo lang('Stockdowntime'); ?>: </td>
                                    <td>
                                        <div class="row bset">
                                            <input name="stockdowntime" type="radio" value="0" id="stockdowntime_0" <?php if($data['stockdowntime'] == '0'): ?>checked<?php endif; if(!isset($data['stockdowntime'])): ?>checked<?php endif; ?> />
                                            <label for="stockdowntime_0" class="w150_r_0"><?php echo lang('Stockdownbypay'); ?></label>
                                            <input name="stockdowntime" type="radio" value="1" id="stockdowntime_1" <?php if($data['stockdowntime'] == '1'): ?>checked<?php endif; ?> />
                                            <label for="stockdowntime_1" class="w150_r_0"><?php echo lang('Stockdownbydelivery'); ?></label>
                                        </div>
                                    </td>
                                </tr>-->
                                <tr>
                                    <td><?php echo lang('Certificationstatus'); ?>: </td>
                                    <td>
                                        <div class="slideBox" >
                                            <input id="realname" value="1" type="checkbox" name="realname" <?php if($data['realname'] == '1'): ?>checked<?php endif; if(!isset($data['realname'])): ?>checked<?php endif; ?> />
                                            <label for="realname"></label>
                                        </div> &nbsp;&nbsp;&nbsp;
                                        <span class="slideBoxafter">
                                                <?php echo lang('Certificationstatus_tip'); ?>
                                        </span>
                                    </td>
                                </tr>

                                <tr class="realname">
                                    <td><?php echo lang('Certificationopt'); ?>: </td>
                                    <td>
                                        <select id="realnameclass" name="realnameclass">
                                            <?php foreach(get_extend_type('realname') as $vo): ?>
                                            <option value="<?php echo $vo['code']; ?>" data-tip="<?php echo lang($vo['description']); ?>" <?php if($data['realnameclass'] == $vo['code']): ?>selected<?php endif; ?>><?php echo lang($vo['name']); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <span id="realdesc"></span>
                                        <script>
                                            $(function () {
                                                $('#realdesc').text($('#realnameclass option:selected').attr('data-tip'));
                                                $('#realnameclass').change(function () {
                                                    $('#realdesc').text($('#realnameclass option:selected').attr('data-tip'));
                                                })
                                            })
                                        </script>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td><?php echo lang('Invoicestatus'); ?>:  </td>
                                    <td>
                                        <div class="slideBox" >
                                            <input id="invoicestatus" value="1" type="checkbox" name="invoicestatus" <?php if($data['invoicestatus'] == '1'): ?>checked<?php endif; ?> />
                                            <label for="invoicestatus"></label>
                                        </div> &nbsp; &nbsp;
                                        <span class="slideBoxafter">
                                                <?php echo lang('Invoicestatus_tip'); ?>
                                        </span>
    
                                        <span class="slideBoxafter" id="invoice" style="display: none;">&nbsp;&nbsp;
                                            <?php echo lang('Invoice_tip'); ?>
                                            <input name="invoicescale" type="number" placeholder="8" style="width: 50px; text-align: center;" value="<?php echo (isset($data['invoicescale']) && ($data['invoicescale'] !== '')?$data['invoicescale']:'8'); ?>" />
                                            %
                                        </span>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td><?php echo lang('Tradeclose'); ?>:  </td>
                                    <td>
                                        <input name="tradeclose" type="number" placeholder="72" style="width: 60px; text-align: center;" value="<?php echo (isset($data['tradeclose']) && ($data['tradeclose'] !== '')?$data['tradeclose']:72); ?>" min="2" max="720" />
                                        <?php echo lang('Unitehours'); ?> &nbsp; &nbsp;
                                        <a class="tooltip-icon" title="<?php echo lang('Tradeclose_tip'); ?>"></a>
                                    </td>
                                </tr>

                                <tr>
                                    <td><?php echo lang('Tradefinish'); ?>:  </td>
                                    <td>
                                        <input name="tradefinish" type="number" placeholder="15" style="width: 60px; text-align: center;" value="<?php echo (isset($data['tradefinish']) && ($data['tradefinish'] !== '')?$data['tradefinish']:15); ?>" min="7" max="180"/>
                                        <?php echo lang('Unitedays'); ?> &nbsp; &nbsp;
                                        <a class="tooltip-icon" title="<?php echo lang('Tradefinish_tip'); ?>"></a>
                                    </td>
                                </tr>

                                <tr>
                                    <td><?php echo lang('Directtradefinish'); ?>:  </td>
                                    <td>
                                        <input name="directtradefinish" type="number" placeholder="24" style="width: 60px; text-align: center;" value="<?php echo (isset($data['directtradefinish']) && ($data['directtradefinish'] !== '')?$data['directtradefinish']:24); ?>" min="15" max="180" />
                                        <?php echo lang('Unitedays'); ?> &nbsp; &nbsp;
                                        <a class="tooltip-icon" title="<?php echo lang('Directtradefinish_tip'); ?>"></a>
                                    </td>
                                </tr>

                                <tr>
                                    <td><?php echo lang('Bondedtradefinish'); ?>:  </td>
                                    <td>
                                        <input name="bondedtradefinish" type="number" placeholder="72" style="width: 60px; text-align: center;" value="<?php echo (isset($data['bondedtradefinish']) && ($data['bondedtradefinish'] !== '')?$data['bondedtradefinish']:72); ?>" min="15" max="180" />
                                        <?php echo lang('Unitedays'); ?> &nbsp; &nbsp;
                                        <a class="tooltip-icon" title="<?php echo lang('Bondedtradefinish_tip'); ?>"></a>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        
                        <div id="tabStat3">
                            <table class="table kright">
                                <tbody>
                                <tr>
                                    <td><?php echo lang('Disstatus'); ?>: </td>
                                    <td>
                                        <div class="slideBox" >
                                            <input id="disstatus" value="1" type="checkbox" name="disstatus" <?php if($data['disstatus'] == '1'): ?>checked<?php endif; ?> />
                                            <label for="disstatus"></label>
                                        </div> &nbsp; &nbsp;
                                        <span class="slideBoxafter">
                                            <?php echo lang('Disstatus_tip'); ?>
                                        </span>
                                    </td>
                                </tr>

                                <tr class="row bset dis">
                                    <td><?php echo lang('Disrule'); ?>: </td>
                                    <td>
                                        <div class="row bset">
                                            <input name="dis" type="radio" value="0" id="dis_0" <?php if($data['dis'] == '0'): ?>checked<?php endif; if(!isset($data['dis'])): ?>checked<?php endif; ?> />
                                            <label for="dis_0" class="w150_r_0"><?php echo lang('Disrule_1'); ?></label>
                                            <input name="dis" type="radio" value="1" id="dis_1" <?php if($data['dis'] == '1'): ?>checked<?php endif; ?> />
                                            <label for="dis_1" class="w150_r_0"><?php echo lang('Disrule_2'); ?></label>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="dis">
                                    <td><?php echo lang('Rebatefinish'); ?>:  </td>
                                    <td>
                                        <input name="rebatefinish" type="number" placeholder="7" style="width: 60px; text-align: center;" value="<?php echo (isset($data['rebatefinish']) && ($data['rebatefinish'] !== '')?$data['rebatefinish']:7); ?>" min="3" max="180" />
                                        <?php echo lang('Unitedays'); ?> &nbsp;
                                        <a class="tooltip-icon" title="<?php echo lang('Rebatefinish_tip'); ?>"></a>
                                    </td>
                                </tr>

                                <tr class="dis">
                                    <td><?php echo lang('Disname'); ?>:  </td>
                                    <td>
                                        <input name="disname" type="text" placeholder="<?php echo lang('Disname_pla'); ?>" value="<?php echo (isset($data['disname']) && ($data['disname'] !== '')?$data['disname']:''); ?>" /> &nbsp;
                                        <a class="tooltip-icon" title="<?php echo lang('Disname_tip'); ?>"></a>
                                    </td>
                                </tr>

                                <tr class="row bset dis">
                                    <td><?php echo lang('Dismodel'); ?>: </td>
                                    <td>
                                        <div class="row bset">
                                            <input name="dismodel" type="radio" value="0" id="dismodel_0" <?php if($data['dismodel'] == '0'): ?>checked <?php endif; if(!isset($data['dismodel'])): ?>checked<?php endif; ?> />
                                            <label for="dismodel_0" class="w180_r_0"><?php echo lang('Dismodel_1'); ?></label>
                                            <input name="dismodel" type="radio" value="1" id="dismodel_1" <?php if($data['dismodel'] == '1'): ?>checked<?php endif; ?> />
                                            <label for="dismodel_1" class="w180_r_0"><?php echo lang('Dismodel_2'); ?></label>
                                        </div>
                                    </td>
                                </tr>

                                <tr id="disscale" class="dis" <?php if(empty($data['dismodel']) || (($data['dismodel'] instanceof \think\Collection || $data['dismodel'] instanceof \think\Paginator ) && $data['dismodel']->isEmpty())): ?>style="display: none ;"<?php endif; ?>>
                                    <td><?php echo lang('Disscale'); ?>:  </td>
                                    <td>
                                        <input name="disscale" type="number" placeholder="15" style="width: 50px; text-align: center;" value="<?php echo (isset($data['disscale']) && ($data['disscale'] !== '')?$data['disscale']:15); ?>" /> % &nbsp;
                                        <a class="tooltip-icon" title="<?php echo lang('Disscale_tip'); ?>"></a>
                                    </td>
                                </tr>

                                <tr class="dis">
                                    <td><?php echo lang('Dislevel'); ?>:  </td>
                                    <td>
                                        <input name="dislevel" type="number" placeholder="15" style="width: 50px; text-align: center;" value="<?php echo (isset($data['dislevel']) && ($data['dislevel'] !== '')?$data['dislevel']:3); ?>" min="2" max="99" /> <?php echo lang('Disscale_pla'); ?> &nbsp;&nbsp;
                                        <a href="javascript:void(0);" id="levelcreate">
                                            <?php echo lang('Create'); ?>
                                        </a>
                                        &nbsp;&nbsp;
                                        <a class="tooltip-icon" title="<?php echo lang('Dislevel_tip'); ?>"></a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
    
                        <div id="tabStat4">
                            <table class="table kright">
                                <tbody>
                                <tr>
                                    <td><?php echo lang('Pointstatus'); ?>: </td>
                                    <td>
                                        <div class="slideBox" >
                                            <input id="pointstatus" value="1" type="checkbox" name="pointstatus"  <?php if($data['pointstatus'] == '1'): ?>checked<?php endif; ?> />
                                            <label for="pointstatus"></label>
                                        </div> &nbsp;
                                        &nbsp;&nbsp;
                                        <span class="slideBoxafter">
                                            <?php echo lang('Pointstatus_tip'); ?>
                                        </span>
                                    </td>
                                </tr>
                                <tr class="Point">
                                    <td><?php echo lang('Conversion_ratio'); ?>: </td>
                                    <td>
                                        <input name="ratio" type="number" class="input" placeholder="1" value="<?php echo (isset($data['ratio']) && ($data['ratio'] !== '')?$data['ratio']:1); ?>" min='0' max="99" style="width: 60px; text-align: center;" />
                                        <?php echo lang('Conversion_ratio_tip'); ?>
                                        &nbsp;&nbsp;
                                        <a class="tooltip-icon" title="<?php echo lang('Conversion_ratio_tip_2'); ?>"></a>
                                    </td>
                                </tr>
                                <tr class="Point">
                                    <td><?php echo lang('Expired_month'); ?>: </td>
                                    <td>
                                        <input name="point_expired_month" type="number" class="input" placeholder="12" value="<?php echo (isset($data['point_expired_month']) && ($data['point_expired_month'] !== '')?$data['point_expired_month']:12); ?>" min="1" max="12" style="width: 60px; text-align: center;" />
                                        <?php echo lang('Expired_month_tip'); ?>
                                        &nbsp;&nbsp;
                                        <a class="tooltip-icon" title="<?php echo lang('Expired_month_tip_2'); ?>"></a>
                                    </td>
                                </tr>

                                <tr class="Point">
                                    <td><?php echo lang('Msg_point_set'); ?>: </td>
                                    <td>
                                        <a class="tooltip-icon" title="<?php echo lang('Msg_point_set_tip'); ?>"></a>&nbsp;&nbsp;&nbsp;
                                        <input name="point_limit" type="number" class="input" placeholder="12" value="<?php echo (isset($data['point_limit']) && ($data['point_limit'] !== '')?$data['point_limit']:100); ?>" min="5" style="width: 60px; text-align: center;" />
                                        
                                        <?php echo lang('Howlong_login'); ?>
                                        <input name="howlong_login" type="number" class="input" placeholder="12" value="<?php echo (isset($data['howlong_login']) && ($data['howlong_login'] !== '')?$data['howlong_login']:90); ?>" min="10" max="360" style="width: 60px; text-align: center;" />
                                        <?php echo lang('Howlong_login_2'); ?>
                                    </td>
                                </tr>
 
                                <tr class="Point">
                                    <td><?php echo lang('Deductionstatus'); ?>: </td>
                                    <td>
                                        <div class="slideBox" >
                                            <input id="deductionstatus" value="1" type="checkbox" name="deductionstatus"  <?php if($data['deductionstatus'] == '1'): ?>checked<?php endif; ?> />
                                            <label for="deductionstatus"></label>
                                        </div> &nbsp;&nbsp;&nbsp;
                                        <span class="slideBoxafter">
                                            <?php echo lang('Deductionstatus_tip'); ?>
                                        </span>
                                    </td>
                                </tr>
                                
                                </tbody>
                            </table>
                        </div>
    
                        <div id="tabStat5">
                            <table class="table kright">
                                <tbody>
                                <tr class="row bset">
                                    <td><?php echo lang('Goodsorts'); ?>: </td>
                                    <td>
                                        <div class="row bset">
                                            <input name="sorts" type="radio" value="sort" id="sorts_0" <?php if($data['sorts'] == 'sort'): ?>checked<?php endif; if(!isset($data['sorts'])): ?>checked<?php endif; ?> />
                                            <label for="sorts_0" class="w105_r_0"><?php echo lang('Default'); ?></label>
                                            <input name="sorts" type="radio" value="sale" id="sorts_1" <?php if($data['sorts'] == 'sale'): ?>checked<?php endif; ?> />
                                            <label for="sorts_1" class="w105_r_0"><?php echo lang('Sale'); ?></label>
                                            <input name="sorts" type="radio" value="cpoint" id="cpoint_1" <?php if($data['sorts'] == 'cpoint'): ?>checked<?php endif; ?> />
                                            <label for="cpoint_1" class="w105_r_0"><?php echo lang('Cpoint'); ?></label>
                                            <input name="sorts" type="radio" value="price" id="price_1" <?php if($data['sorts'] == 'price'): ?>checked<?php endif; ?> />
                                            <label for="price_1" class="w105_r_0"><?php echo lang('Cprice'); ?></label>
                                            <input name="sorts" type="radio" value="new" id="new_1" <?php if($data['sorts'] == 'new'): ?>checked<?php endif; ?> />
                                            <label for="new_1" class="w105_r_0"><?php echo lang('Lastnew'); ?></label>
                                        </div>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td><?php echo lang('Stockwarming'); ?>: </td>
                                    <td>
                                        <input name="stockwarming" type="number" class="input" placeholder="90" value="<?php echo (isset($data['stockwarming']) && ($data['stockwarming'] !== '')?$data['stockwarming']:10); ?>" min="1" max="300" style="width: 60px; text-align: center;" />
                                        <?php echo lang('Stockwarming_tip'); ?>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td><?php echo lang('Deposit_pwd_err_num'); ?>: </td>
                                    <td>
                                        <input name="deposit_pwd_err_num" type="number" class="input" placeholder="3" value="<?php echo (isset($data['deposit_pwd_err_num']) && ($data['deposit_pwd_err_num'] !== '')?$data['deposit_pwd_err_num']:5); ?>" min="3" max="99" style="width: 60px; text-align: center;" />
                                        <?php echo lang('Deposit_pwd_err_num_2'); ?>
                                        &nbsp;
                                        <input name="deposit_pwd_err_time" type="number" class="input" placeholder="3" value="<?php echo (isset($data['deposit_pwd_err_time']) && ($data['deposit_pwd_err_time'] !== '')?$data['deposit_pwd_err_time']:3); ?>" min="3" max="99" style="width: 60px; text-align: center;" />
                                        <?php echo lang('Unitehours'); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo lang('Shopid_log_del_by'); ?>: </td>
                                    <td>
                                        <input name="shopid_log_del_by" type="number" class="input" placeholder="30" value="<?php echo (isset($data['shopid_log_del_by']) && ($data['shopid_log_del_by'] !== '')?$data['shopid_log_del_by']:30); ?>" min="3" max="180" style="width: 60px; text-align: center;" />
                                        <?php echo lang('Shopid_log_del_by_tip'); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo lang('Site_log_del_by'); ?>: </td>
                                    <td>
                                        <input name="site_log_del_by" type="number" class="input" placeholder="30" value="<?php echo (isset($data['site_log_del_by']) && ($data['site_log_del_by'] !== '')?$data['site_log_del_by']:30); ?>" min="3" max="180" style="width: 60px; text-align: center;" />
                                        <?php echo lang('Site_log_del_by_tip'); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo lang('Api_log_del_by'); ?>: </td>
                                    <td>
                                        <input name="api_log_del_by" type="number" class="input" placeholder="90" value="<?php echo (isset($data['api_log_del_by']) && ($data['api_log_del_by'] !== '')?$data['api_log_del_by']:90); ?>" min="60" max="300" style="width: 60px; text-align: center;" />
                                        <?php echo lang('Api_log_del_by_tip'); ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td><?php echo lang('Default_List_Rows'); ?></td>
                                    <td>
                                        <input name="list_rows" type="number" class="input" value="<?php echo (isset($data['list_rows']) && ($data['list_rows'] !== '')?$data['list_rows']:20); ?>" style="width:60px;text-align: center;"/>
                                        <span class="slideBoxafter">
                                            <?php echo lang('Default_List_Rows_Description'); ?>                                        </span>
                                    </td>
                                </tr>

                                <tr class="row bset">
                                    <td><?php echo lang('Default_Good_Status'); ?></td>
                                    <td>
                                        <div class="row bset">
                                            <input name="good_status_id" type="radio" value="enabled" id="good_status_id_1" <?php if($data['good_status_id'] == 'enabled'): ?>checked<?php endif; if(!isset($data['good_status_id'])): ?>checked<?php endif; ?> />
                                            <label for="good_status_id_1" class="w105_r_0"><?php echo lang('Good_Up'); ?></label>
            
                                            <input name="good_status_id" type="radio" value="disabled" id="good_status_id_0" <?php if($data['good_status_id'] == 'disabled'): ?>checked<?php endif; ?> />
                                            <label for="good_status_id_0" class="w105_r_0"><?php echo lang('Good_Down'); ?></label>
            
                                            <input name="good_status_id" type="radio" value="pending_review" id="good_status_id_2" <?php if($data['good_status_id'] == 'pending_review'): ?>checked<?php endif; ?> />
                                            <label for="good_status_id_2" class="w105_r_0"><?php echo lang('Good_Wait'); ?></label>
            
            
                                            <input name="good_status_id" type="radio" value="pending_modify" id="good_status_id_3" <?php if($data['good_status_id'] == 'pending_modify'): ?>checked<?php endif; ?> />
                                            <label for="good_status_id_3" class="w105_r_0"><?php echo lang('Good_Modify'); ?></label>
        
                                        </div>
                                    </td>
                                </tr>
                                
                                <!--服务承诺-->
                                <tr>
                                    <td><?php echo lang('goods_service'); ?></td>
                                    <td>
                                        <input type="text" value="<?php echo (isset($data['goods_service']) && ($data['goods_service'] !== '')?$data['goods_service']:''); ?>" name="goods_service" style="width:410px"/>
                                        <a class="tooltip-icon" title="<?php echo lang('goods_service_tips'); ?>"></a>
                                    </td>
                                </tr>
                                

                                <!--税收类别-->
                                <tr>
                                    <td>
                                        <?php echo lang('Default_Tax_Class'); ?>
                                    </td>
                                    <td>
                                        <select name="default_tax_class_id" id="tax_class_id" >
                                            <option value="0"><?php echo lang('Goods_Null'); ?></option>
                                            <?php if(isset($data['tax_class'])): foreach($data['tax_class'] as $key=> $value): ?>
                                            <option value="<?php echo $key; ?>" <?php if($data['default_tax_class_id'] == $key): ?>selected="selected"<?php endif; ?>><?php echo $value; ?></option>
                                            <?php endforeach; endif; ?>
                                        </select>
        
                                        <span class="slideBoxafter">
                                            <?php echo lang('Tax_Rate'); ?>
                                            <span id="tax_rate">
                                            
                                            </span>
                                        </span>
                                        <a class="tooltip-icon" title="<?php echo lang('Tax_Not_Repeat'); ?>"></a>
        
                                        <a href="javascript:void(0)" id="delete_tax_class" style="margin:5px 20px 5px 0;display:none;">
                                            <?php echo lang('Tax_Class_Delete'); ?>
                                        </a>
                                        <a href="javascript:void(0)" id="add_tax_class" style="margin:5px 0;">
                                            <?php echo lang('Tax_Class_Add'); ?>
                                        </a>
        
                                        <!--保存税收类别-->
                                        <span id="tax_class">
                                            
                                        </span>
    
    
                                    </td>
                                </tr>
                                <!--默认运费模板-->
                                <tr>
                                    <td>
                                        <?php echo lang('Default_shipping_template'); ?>
                                    </td>
                                    <td>
                                        <span><?php echo lang('Default_freight'); ?>(￥)</span>
                                        <input type="number" min="0.00" class="w80" name="default_shipping_freight" value="<?php echo (isset($data['default_shipping_freight']) && ($data['default_shipping_freight'] !== '')?$data['default_shipping_freight']:0.00); ?>" />
                                        <span><?php echo lang('enough'); ?>(￥)</span>
                                        <input type="number" min="0.00" class="w80" name="default_free_money" id="default_free_money" value="<?php echo (isset($data['default_free_money']) && ($data['default_free_money'] !== '')?$data['default_free_money']:0.00); ?>"/>
                                        <span><?php echo lang('free_freight'); ?></span>
                                        <a class="tooltip-icon" title="<?php echo lang('freight_shipping_tips'); ?>"></a>
                                    </td>
                                </tr>
                                <tr class="realname">
                                    <td><?php echo lang('Cart_type'); ?>: </td>
                                    <td>
                                        <select id="split" name="splitclass">
                                            <?php foreach(get_extend_type('split') as $vo): ?>
                                            <option value="<?php echo $vo['code']; ?>" data-tip="<?php echo lang($vo['description']); ?>" <?php if($data['realnameclass'] == $vo['code']): ?>selected<?php endif; ?>><?php echo lang($vo['name']); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <span id="splitdesc"></span>
                                        <script>
                                            $(function () {
                                                $('#splitdesc').text($('#split option:selected').attr('data-tip'));
                                                $('#split').change(function () {
                                                    $('#splitdesc').text($('#split option:selected').attr('data-tip'));
                                                })
                                            })
                                        </script>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
    
                        <div id="tabStat6">
                            <table class="table kright">
                                <tbody>

                                <tr>
                                    <td><?php echo lang('Androidset'); ?>: </td>
                                    <td>
                                        <div class="slideBox" >
                                            <input id="androidstatus" value="1" type="checkbox" name="androidstatus"  <?php if($data['androidstatus'] == '1'): ?>checked<?php endif; ?> />
                                            <label for="androidstatus"></label>
                                        </div> &nbsp;
                                        &nbsp;&nbsp;
                                        <input name="androidversion" id="androidversion" type="text" class="input" value="<?php echo (isset($data['androidversion']) && ($data['androidversion'] !== '')?$data['androidversion']:''); ?>" style="width: 60px; display: none;" placeholder="1.0.0.1" />
                                        &nbsp;&nbsp;
                                        <input name="androidurl" id="androidurl" type="text" class="input" value="<?php echo (isset($data['androidurl']) && ($data['androidurl'] !== '')?$data['androidurl']:''); ?>" style="width: 260px; display: none;" placeholder="<?php echo lang('Androidurl'); ?>" />
                                        
                                    </td>
                                </tr>

                                <tr>
                                    <td><?php echo lang('IOSset'); ?>: </td>
                                    <td>
                                        <div class="slideBox" >
                                            <input id="iosstatus" value="1" type="checkbox" name="iosstatus"  <?php if($data['iosstatus'] == '1'): ?>checked<?php endif; ?> />
                                            <label for="iosstatus"></label>
                                        </div> &nbsp;
                                        &nbsp;&nbsp;
                                        <input name="iosversion" id="iosversion" type="text" class="input" value="<?php echo (isset($data['iosversion']) && ($data['iosversion'] !== '')?$data['iosversion']:''); ?>" style="width: 60px; display: none;" placeholder="1.0.0.1" />
                                        &nbsp;&nbsp;
                                        <input name="iosurl" id="iosurl" type="text" class="input" value="<?php echo (isset($data['iosurl']) && ($data['iosurl'] !== '')?$data['iosurl']:''); ?>" style="width: 260px; display: none;" placeholder="<?php echo lang('Iosurl'); ?>" />
                                    </td>
                                </tr>

                                <tr>
                                    <td><?php echo lang('App push'); ?>: </td>
                                    <td>
                                        <div class="slideBox" >
                                            <input id="apppush" value="1" type="checkbox" name="apppush"  <?php if($data['apppush'] == '1'): ?>checked<?php endif; ?> />
                                            <label for="apppush"></label>
                                        </div> &nbsp;
                                        &nbsp;&nbsp;
                                        <span class="slideBoxafter">
                                            <?php echo lang('App push tip'); ?>
                                        </span>
                                    </td>
                                </tr>

                                <tr class="apppush">
                                    <td><?php echo lang('Pushopt'); ?>: </td>
                                    <td>
                                        <select id="pushapp" name="pushapp">
                                            <?php foreach(get_extend_type('pushapp') as $vo): ?>
                                            <option value="<?php echo $vo['code']; ?>" data-tip="<?php echo lang($vo['description']); ?>" <?php if($data['sms'] == $vo['code']): ?>selected<?php endif; ?>><?php echo lang($vo['name']); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <span id="pusdesc"></span>
                                        <script>
                                            $(function () {
                                                $('#pusdesc').text($('#pushapp option:selected').attr('data-tip'));
                                                $('#pushapp').change(function () {
                                                    $('#pusdesc').text($('#pushapp option:selected').attr('data-tip'));
                                                })
                                            })
                                        </script>
                                    </td>
                                </tr>
                                
                                </tbody>
                            </table>
                        </div>
    
                        <div id="tabStat7">
                            <table class="table kright">
                                <tbody>
                                
                                <tr>
                                    <td><?php echo lang('Wechat user auto reg'); ?>: </td>
                                    <td>
                                        <div class="slideBox" >
                                            <input id="wechatautoreg" value="1" type="checkbox" name="wechatautoreg"  <?php if($data['wechatautoreg'] == '1'): ?>checked<?php endif; ?> />
                                            <label for="wechatautoreg"></label>
                                        </div> &nbsp;
                                        &nbsp;&nbsp;
                                        <span class="slideBoxafter">
                                            <?php echo lang('Wechat user auto reg tip'); ?>
                                        </span>
                                    </td>
                                </tr>

                                <tr>
                                    <td><?php echo lang('Wechat js-sdk'); ?>: </td>
                                    <td>
                                        <div class="slideBox" >
                                            <input id="wechatjssdk" value="1" type="checkbox" name="wechatjssdk"  <?php if($data['wechatjssdk'] == '1'): ?>checked<?php endif; ?> />
                                            <label for="wechatjssdk"></label>
                                        </div> &nbsp;
                                        &nbsp;&nbsp;
                                        <span class="slideBoxafter">
                                            <?php echo lang('Wechat js-sdk tip'); ?>
                                        </span>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td><?php echo lang('Token'); ?>: </td>
                                    <td>
                                        <input name="token" type="text" class="input" value="<?php echo (isset($data['token']) && ($data['token'] !== '')?$data['token']:''); ?>" style="width: 260px;" placeholder="Token" />
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td><?php echo lang('AppID'); ?>: </td>
                                    <td>
                                        <input name="appid" type="text" class="input" value="<?php echo (isset($data['appid']) && ($data['appid'] !== '')?$data['appid']:''); ?>" style="width: 260px;" placeholder="AppID" />
                                    </td>
                                </tr>

                                <tr>
                                    <td><?php echo lang('AppSecret'); ?>: </td>
                                    <td>
                                        <input name="appsecret" type="text" class="input" value="<?php echo (isset($data['appsecret']) && ($data['appsecret'] !== '')?$data['appsecret']:''); ?>" style="width: 260px;" placeholder="AppSecret" />
                                    </td>
                                </tr>
                                
                                </tbody>
                            </table>
                        </div>
    
                        <div id="tabStat8">
                            <table class="table kright">
                                <tbody>
                                <tr>
                                    <td><?php echo lang('Licensecode'); ?>: </td>
                                    <td>
                                        <input name="licensecode" type="text" class="input" value="<?php echo (isset($licensecode) && ($licensecode !== '')?$licensecode:''); ?>" style="width: 260px;" readonly />
                                        <?php echo lang('Licensecode_tip'); if(empty($data['licensecode']) || (($data['licensecode'] instanceof \think\Collection || $data['licensecode'] instanceof \think\Paginator ) && $data['licensecode']->isEmpty())): ?>
                                            <a href="//www.runtuer.com/buy" target="_blank"><?php echo lang('Clickbuy'); ?></a>
                                        <?php else: ?>
                                            <a href="//www.runtuer.com/search/<?php echo $data['licensecode']; ?>" target="_blank"><?php echo lang('Clicksearch'); ?></a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td><?php echo lang('Licensecompany'); ?>: </td>
                                    <td>
                                        <input id="licensename" type="text" class="input" value="<?php echo (isset($licensename) && ($licensename !== '')?$licensename:''); ?>" style="width: 260px;" readonly />
                                    </td>
                                </tr>
                                
                                </tbody>
                            </table>
                        </div>
    
                        <div id="tabStat9">
                            <table class="table kright">
                                <tbody>
                                <tr>
                                    <td><?php echo lang('show_top_protocol'); ?></td>
                                    <td>
                                        <div class="slideBox">
                                            <input id="top_protocol_status" value="1" type="checkbox" name="top_protocol_status" <?php if($data['top_protocol_status'] == '1'): ?>checked<?php endif; ?>>
                                            <label for="top_protocol_status"></label>
                                        </div>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td><?php echo lang('top_protocol_info'); ?></td>
                                    <td>
                                     
                                    <select name="top_protocol_id">
                                        <option value="0"><?php echo lang('choose_top_protocol'); ?></option>
                                        <?php foreach($arr_info as $key => $arr): ?>
                                        <option value="<?php echo $arr['id']; ?>" <?php if($data['top_protocol_id'] == $arr['id']): ?>selected="selected"<?php endif; ?>><?php echo $arr['title']; ?></option>
                                        <?php endforeach; ?>
                                        
                                    </select>
                                        
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td><?php echo lang('protocol_status'); ?></td>
                                    <td>
                                        <div class="slideBox">
                                            <input id="protocol_status" value="1" type="checkbox" name="protocol_status" <?php if($data['protocol_status'] == '1'): ?>checked<?php endif; ?>>
                                            <label for="protocol_status"></label>
                                        </div>
                                        &nbsp;&nbsp;
                                        <span class="slideBoxafter">
                                                <?php echo lang('protocol_tips'); ?>
                                        </span>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php echo lang('protocol_title'); ?>
                                    </td>
                                    <td>
                                        <input type="text" name="protocol_title" value="<?php echo (isset($data['protocol_title']) && ($data['protocol_title'] !== '')?$data['protocol_title']:''); ?>" />
                                    </td>
                                </tr>
                                
                                
                                <tr>
                                    <td style="vertical-align:top; padding: 8px 15px;"><?php echo lang('protocol_info'); ?>:  </td>
                                    <td style="vertical-align:top; padding: 8px 0;">
                                        <textarea name="checkout_protocol" rows="3" class="site_info" style="width: 500px"><?php if(!(empty($data['checkout_protocol']) || (($data['checkout_protocol'] instanceof \think\Collection || $data['checkout_protocol'] instanceof \think\Paginator ) && $data['checkout_protocol']->isEmpty()))): ?><?php echo html_entity_decode($data['checkout_protocol']); endif; ?></textarea>
                                    </td>
                                </tr>
            
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                        
                    <div class="buttons-wrapper" style="margin:0 0 30px; padding:0 0 0 18%;">
                        <input name="submit" value="<?php echo lang('Saveshopconf'); ?>" type="submit" url="<?php echo url('save', array('act' => ACTION_NAME)); ?>" />
                    </div>
                    
                </div>
            </form>
            
        </div>
    </div>
    

    
    <script charset="utf-8" src="__STATIC__/kindeditor/kindeditor-all-min.js"></script>
    <script>
        $(function(){
            KindEditor.ready(function(K) {
                editor = K.create('.site_info', {
                    resizeType : 1,
                    allowPreviewEmoticons : false,
                    allowImageUpload : false,
                    minWidth : 450,
                    minHeight : 150,
                    langType : "<?php echo jsup(config('default_lang')); ?>",
                    items : [
                        'source', '|','undo', 'redo', '|','bold', 'italic', 'underline',
                        'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                        'insertunorderedlist', '|', 'link', 'unlink'],
                    afterBlur: function () { this.sync(); }
                });
            });
            $('#start_time').timepicker();
            $('#end_time').timepicker();
            $(".bset").buttonset();
            $('input[name=dismodel]').click(function () {
                if($(this).val() == 1) {
                    $("#disscale").show();
                    $('input[name=disscale]').attr('disabled', false);
                }else{
                    $("#disscale").hide();
                    $('input[name=disscale]').attr('disabled', true);
                }
            });

            //实名认证开关
            <?php if($data['realname'] == '0'): ?>$('.realname').hide();<?php endif; ?>
            $('input[name=realname]').click(function(){
                var ischecked = $(this).is(":checked");
                if(ischecked){
                    $('.realname').show().find('input').attr('disabled', false);
                }else{
                    $('.realname').hide().find('input').attr('disabled', true);
                }
            })
            
            //OMS接口
            <?php if(!(empty($data['omsstatus']) || (($data['omsstatus'] instanceof \think\Collection || $data['omsstatus'] instanceof \think\Paginator ) && $data['omsstatus']->isEmpty()))): ?>$('#omsbox').show();<?php endif; ?>
            $('#omsstatus').click(function(){
                var ischecked = $(this).is(":checked");
                if(ischecked){
                    $('#omsbox').show();
                    $('input[name=omsclass]').attr('disabled', false);
                }else{
                    $('#omsbox').hide();
                    $('input[name=omsclass]').attr('disabled', true);
                }
            })

            //发票
            <?php if(!(empty($data['invoicestatus']) || (($data['invoicestatus'] instanceof \think\Collection || $data['invoicestatus'] instanceof \think\Paginator ) && $data['invoicestatus']->isEmpty()))): ?>$('#invoice').show();<?php endif; ?>
            $('#invoicestatus').click(function(){
                var ischecked = $(this).is(":checked");
                if(ischecked){
                    $('#invoice').show();
                    $('input[name=invoicescale]').attr('disabled', false);
                }else{
                    $('#invoice').hide();
                    $('input[name=invoicescale]').attr('disabled', true);
                }
            })

            //安卓设置
            <?php if(!(empty($data['androidstatus']) || (($data['androidstatus'] instanceof \think\Collection || $data['androidstatus'] instanceof \think\Paginator ) && $data['androidstatus']->isEmpty()))): ?>$('#androidversion, #androidurl').show();<?php endif; ?>
            $('#androidstatus').click(function(){
                var ischecked = $(this).is(":checked");
                if(ischecked){
                    $('#androidversion, #androidurl').show();
                    $('input[name=androidversion], input[name=androidurl]').attr('disabled', false);
                }else{
                    $('#androidversion, #androidurl').hide();
                    $('input[name=androidversion], input[name=androidurl]').attr('disabled', true);
                }
            })

            //IOS设置
            <?php if(!(empty($data['iosstatus']) || (($data['iosstatus'] instanceof \think\Collection || $data['iosstatus'] instanceof \think\Paginator ) && $data['iosstatus']->isEmpty()))): ?>$('#iosversion, #iosurl').show();<?php endif; ?>
            $('#iosstatus').click(function(){
                var ischecked = $(this).is(":checked");
                if(ischecked){
                    $('#iosversion, #iosurl').show();
                    $('input[name=iosversion], input[name=iosurl]').attr('disabled', false);
                }else{
                    $('#iosversion, #iosurl').hide();
                    $('input[name=iosversion], input[name=iosurl]').attr('disabled', true);
                }
            })

            //APP推送配置
            <?php if(empty($data['apppush']) || (($data['apppush'] instanceof \think\Collection || $data['apppush'] instanceof \think\Paginator ) && $data['apppush']->isEmpty())): ?>$('.apppush').hide();<?php endif; ?>
            $('#apppush').click(function(){
                var ischecked = $(this).is(":checked");
                if(ischecked){
                    $('.apppush').show();
                    $('.apppush').find('input').attr('disabled', false);
                }else{
                    $('.apppush').hide();
                    $('.apppush').find('input').attr('disabled', true);
                }
            })

            //分销功能设置
            <?php if($data['disstatus'] == '1'): ?>$('.dis').show();<?php endif; ?>
            $('input[name=disstatus]').click(function(){
                var ischecked = $(this).is(":checked");
                if(ischecked){
                    $('.dis').show().find('input').attr('disabled', false);
                }else{
                    $('.dis').hide().find('input').attr('disabled', true);
                }
            })

            //分销功能设置
            <?php if($data['pointstatus'] == '1'): ?>$('.Point').show();<?php endif; ?>
            $('input[name=pointstatus]').click(function(){
                var ischecked = $(this).is(":checked");
                if(ischecked){
                    $('.Point').show().find('input').attr('disabled', false);
                }else{
                    $('.Point').hide().find('input').attr('disabled', true);
                }
            })
            
            // 税率
            $('#tax_rate').text($('#tax_class_id').val());
            $('#tax_class_id').on('change',function(){
                $('#tax_rate').text($(this).val());
            });
            
            // 税收类别，新增，保存，删掉
            var taxes_html = '';
            $("#tax_class_id option").each(function () {
                if($(this).val() != 0) {
                    taxes_html += '<input type="text" name="tax_class['+$(this).val()+']" value="'+$(this).text()+'" hidden/>';
                }
            });
            $('#tax_class').html(taxes_html);
            
            $("#delete_tax_class").on('click',function(){
                layer.confirm('<?php echo lang('Confirm_Delete_Tax_Class'); ?>',
                    {
                        icon: 3,
                        title:[
                            "<?php echo lang('Weight_Class_Delete'); ?>",
                            "border:none; background:rgb(202, 134, 64);font-size: 15px;font-weight:bold;color:#fff;"],
                        btnAlign: 'c',
                        btn: ['Ok','Cancel']
                    }, function(index){
                        $('#tax_class').empty();
                        $('#tax_class_id').empty();
                        $('#tax_class_id').append('<option value="0">'+'<?php echo lang('Goods_Null'); ?>'+'</option>');
                        $('#tax_rate').text();
                        layer.close(index);
                    }, function(index){
                        layer.close(index);
                    });
                
            });
            
            var add_click = 0;
            $("#add_tax_class").on('click',function(){
                $("#delete_tax_class").show();
                if(add_click === 0) {
                    var _html = '<div id="add_tax_class_div" style="margin:5px 0;">';
                    _html += '<?php echo lang('Tax_Rate'); ?>' + ' <input type="text" name="tax_class_key" style="width:60px;"/>';
                    _html += '<?php echo lang('Tax_Name'); ?>' + ' <input type="text" name="tax_class_value"/>';
                    _html += '<input class="button white upload" value="'+'<?php echo lang('Goods_Add'); ?>'+'" type="button" id="save_tax_class"> &nbsp;&nbsp; <input class="button white" value="'+'<?php echo lang('Goods_Close'); ?>'+'" type="button" id="close_tax_class">';
                    _html += '</div>';
                    $(this).after(_html);
                }
                add_click ++;
            });
            
            $(document).on( "click", "#save_tax_class", function() {
                var key = Number($.trim($("input[name='tax_class_key']").val()));
                var value = $.trim($("input[name='tax_class_value']").val());
                if(key === '' || value === ''){
                    layer.msg('<?php echo lang('Tax_Name_Rate_Null'); ?>',{icon:2, time: 2000 ,shade: 0.3});
                }else if(key>100||key<0){
                    layer.msg('<?php echo lang('Tax_Rate_Error'); ?>',{icon:2, time: 2000 ,shade: 0.3});
                }else {
                    $('#tax_class_id').append('<option value="' + key + '">' + value + '</option>');
                    $('#tax_class').append('<input type="text" name="tax_class['+key+']" value="'+value+'" hidden/>');
                    
                    layer.msg('<?php echo lang('Save_Tax_Success'); ?>',{icon:1, time: 1000 ,shade: 0.3});
                    $("#add_tax_class_div").remove();$("#delete_tax_class").hide();
                    add_click = 0;
                    $("#tax_class_id").val(key);
                    $('#tax_rate').text(key);
                }
            });
            
            $(document).on( "click", "#close_tax_class", function() {
                $('#add_tax_class_div').remove();$("#delete_tax_class").hide();
                add_click = 0;
            });
        });
    </script>
    
    <!--<script type="text/javascript" src="//runtuer.com/liceson/check"></script>-->
</body>
</html>