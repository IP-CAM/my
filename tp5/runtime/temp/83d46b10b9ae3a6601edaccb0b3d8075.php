<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:68:"D:\git\my\tp5\public/../site/crossbbcg/view/admin\payment\index.html";i:1504778766;s:56:"D:\git\my\tp5\public/../site/admin\view\public\base.html";i:1506158164;s:56:"D:\git\my\tp5\public/../site/admin\view\public\navs.html";i:1503361789;s:56:"D:\git\my\tp5\public/../site/admin\view\public\lang.html";i:1503361789;s:58:"D:\git\my\tp5\public/../site/admin\view\public\button.html";i:1503361789;}*/ ?>
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
    
    <?php $curr_url = base64_encode(url()); ?>
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

        <div class="content">
                
                <dl class="gzzt clearfix mtb10">
                <dd>
                    <div class="boxr">
                                <?php echo getButton($__CHILD__); ?>
                    </div>
                </dd>
                    <dd style="float: right !important;">
                        <div class="boxl">
                            <span>
                                <a href="javascript:location.reload();" class="refresh tooltip-link" title="<?php echo lang('Refresh'); ?>">
                                    <em><?php echo lang('Refresh'); ?></em>
                                </a>
                            </span>
                            <span>
                                <a href="javascript:void(0);" class="ajax-get setting tooltip-link colum" title="<?php echo lang('Showlum'); ?>" data-title="<?php echo lang('Showlum'); ?>">
                                    <em><?php echo lang('Showlum'); ?></em>
                                </a>
                            </span>
                        </div>
                    </dd>
            </dl>
            
            <table class="table">
                <thead>
                <tr>
                    <!--<th class="center" width="30"><input class="check-all" type="checkbox"></th>-->
                    <th class="left" style="width:35px;">ID</th>
                    <th class="left"><?php echo lang('Name'); ?></th>
                    <th class="left"><?php echo lang('Identity'); ?></th>
                    <th class="left"><?php echo lang('Description'); ?></th>
                    <th class="center"><?php echo lang('Author'); ?></th>
                    <th class="center" style="width:80px;"><?php echo lang('Version'); ?></th>
                    <th class="center" style="width:80px;"><?php echo lang('Status'); ?></th>
                    <th class="center"><?php echo lang('Is_show'); ?></th>
                    <th class="actions" style="width:100px;"><?php echo lang('Actions'); ?></th>
                </tr>
                </thead>
                    
                <tbody>
                <?php if(!(empty($seapays) || (($seapays instanceof \think\Collection || $seapays instanceof \think\Paginator ) && $seapays->isEmpty()))): ?>
                <tr>
                    <td colspan="10" style="padding: 0;">
                        <div class="alert alert-success" style="margin:0;"><?php echo lang('Seapays'); ?></div>
                    </td>
                </tr>
                <?php if(is_array($seapays) || $seapays instanceof \think\Collection || $seapays instanceof \think\Paginator): $i = 0; $__LIST__ = $seapays;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <tr>
                    <!--<td class="center">
                    <?php if(!(empty($vo['uninstall']) || (($vo['uninstall'] instanceof \think\Collection || $vo['uninstall'] instanceof \think\Paginator ) && $vo['uninstall']->isEmpty()))): ?>
                    <input class="ids" type="checkbox" value="<?php echo $vo['id']; ?>" name="ids[]">
                    <?php endif; ?>
                    </td>-->
                    <td class="left"> <?php echo $key + 1; ?></td>
                    <td class="left"><?php echo $vo['name']; ?></td>
                    <td class="left"><?php echo $vo['code']; ?></td>
                    <!--<td class="left">
                        <a href="<?php echo url('',array('group'=>$vo['subjection'])); ?>"><?php echo $vo['subjection']; ?></a>
                    </td>-->
                    <td class="left slh tooltip-link" title="<?php echo $vo['description']; ?>" style="max-width: 250px; line-height: 1.7;">
                        <?php echo $vo['description']; ?>
                    </td>
                    <td class="center">
                        <a target="_blank" href="<?php echo (isset($vo['website']) && ($vo['website'] !== '')?$vo['website']:'http://www.runtuer.com'); ?>">
                            <?php echo $vo['author']; ?>
                        </a>
                    </td>
                    <td class="center"><?php echo $vo['version']; ?></td>
                    <!--<td class="center lastver" data-ver="<?php echo $vo['version']; ?>" <?php if(!(empty($vo['upgrade']) || (($vo['upgrade'] instanceof \think\Collection || $vo['upgrade'] instanceof \think\Paginator ) && $vo['upgrade']->isEmpty()))): ?>data-update="<?php echo $vo['upgrade']; ?>"<?php endif; ?>>
                    <a class="tooltip-link red ajax-get" data-showbar="1" data-width="480" data-height="320" data-layer="<?php echo lang('Upgrade_e_to', array('cnname'=>$vo['name'], 'enname'=>$vo['code'], 'lastver'=>'')); ?>" title="<?php echo lang('Upgrade_e_to', array('cnname'=>$vo['name'], 'enname'=>$vo['code'])); ?>" href="<?php echo url('upgradeto',array('code'=>$vo['code'], 'subjection' => $vo['subjection'], 'url'=>'upgradetourl', 'istrue'=>1)); ?>"></a>
                    </td>-->
    
                    <td class="center">
                        <?php if($vo['status'] == 1): ?>
                        <a href="<?php echo url('disable', array('code'=> $vo['code'], 'subjection'=>$vo['subjection'])); ?>" class="ajax-able" data-doing="<?php echo lang('Disable'); ?>">
                            <img src="__PUBLIC__/admin/images/enabled.png" title="<?php echo lang('Enable'); ?>" class="tooltip-link" alt="<?php echo lang('Enable'); ?>" height="16px" data-enabled="__PUBLIC__/admin/images/enabled.png" data-disabled="__PUBLIC__/admin/images/disabled.png" />
                        </a>
                        <?php else: if($vo['uninstall'] == 1): ?>
                        <a href="<?php echo url('enable', array('code'=> $vo['code'], 'subjection'=>$vo['subjection'])); ?>" class="ajax-able" data-doing="<?php echo lang('Enable'); ?>">
                            <img src="__PUBLIC__/admin/images/disabled.png" title="<?php echo lang('Disable'); ?>" class="tooltip-link" alt="<?php echo lang('Disable'); ?>" height="16px" data-enabled="__PUBLIC__/admin/images/enabled.png" data-disabled="__PUBLIC__/admin/images/disabled.png" />
                        </a>
                        <?php else: ?>
                        <img src="__PUBLIC__/admin/images/notinstall.png" title="<?php echo lang('Notinstall'); ?>" class="tooltip-link" alt="<?php echo lang('Notinstall'); ?>" height="16px" />
                        <?php endif; endif; ?>
                    </td>
    
                    <td class="center">
                        <?php if($vo['isshow'] == 1): ?>
                        <a href="<?php echo url('disable', array('code'=> $vo['code'], 'subjection'=>$vo['subjection'])); ?>" class="ajax-able" data-doing="<?php echo lang('Disable'); ?>">
                            <img src="__PUBLIC__/admin/images/enabled.png" title="<?php echo lang('Enable'); ?>" class="tooltip-link" alt="<?php echo lang('Enable'); ?>" height="16px" data-enabled="__PUBLIC__/admin/images/enabled.png" data-disabled="__PUBLIC__/admin/images/disabled.png" />
                        </a>
                        <?php else: if($vo['uninstall'] == 1): ?>
                        <a href="<?php echo url('enable', array('isshow'=> 1, 'code'=> $vo['code'], 'subjection'=>$vo['subjection'])); ?>" class="ajax-able" data-doing="<?php echo lang('Enable'); ?>">
                            <img src="__PUBLIC__/admin/images/disabled.png" title="<?php echo lang('Disable'); ?>" class="tooltip-link" alt="<?php echo lang('Disable'); ?>" height="16px" data-enabled="__PUBLIC__/admin/images/enabled.png" data-disabled="__PUBLIC__/admin/images/disabled.png" />
                        </a>
                        <?php else: ?>
                        <img src="__PUBLIC__/admin/images/notinstall.png" title="<?php echo lang('Notinstall'); ?>" class="tooltip-link" alt="<?php echo lang('Notinstall'); ?>" height="16px" />
                        <?php endif; endif; ?>
                    </td>
            
                    <td class="actions">
                        <?php if(!(empty($vo['uninstall']) || (($vo['uninstall'] instanceof \think\Collection || $vo['uninstall'] instanceof \think\Paginator ) && $vo['uninstall']->isEmpty()))): if(($vo['status'] >= 0) AND ($vo['allow_uninstall'] == 1)): if($vo['status'] == '1'): ?>
                        <a class="ajax-get btn_submit green" href="<?php echo url('admin/extend/config', array('code'=> $vo['code'], 'subjection'=>$vo['subjection'], 'jump'=>$curr_url)); ?>" data-layer="<?php echo lang('Setting'); ?> ：<?php echo $vo['name']; ?> " data-showbar=1 data-title="<?php echo $vo['name']; ?> <?php echo lang('Setting'); ?>" data-width="680" data-height="520">
                            <?php echo lang('Setting'); ?>
                        </a>
                        <?php endif; endif; if($vo['allow_uninstall'] == 1): ?>
                        <a class="tooltip-link ajax-get confirm warning btn_submit red" title="<?php echo lang('Uninstall', array('name'=>$vo['name'])); ?>" href="<?php echo url('admin/extend/uninstall',array('code'=> $vo['code'], 'subjection'=>$vo['subjection'])); ?>" data-layer="<?php echo lang('Uninstallext', array('subjection' => lang($vo['subjection']), 'name' => $vo['name'], 'code' => $vo['code'])); ?>" data-title="<?php echo lang('Uninstall', array('name'=>$vo['name'])); ?>">
                            <?php echo lang('Uninstall', array('name'=>'')); ?>
                        </a>
                        <?php endif; else: ?>
                        <a class="tooltip-link ajax-get confirm btn_submit" title="<?php echo lang('Install'); ?>" href="<?php echo url('admin/extend/install', array('code'=> $vo['code'], 'subjection'=>$vo['subjection'])); ?>" data-layer="<?php echo lang('Install'); ?> ：<?php echo $vo['name']; ?>(<?php echo $vo['code']; ?>) ?" data-title="<?php echo lang('Install'); ?> ：<?php echo $vo['name']; ?>">
                            <?php echo lang('Install'); ?>
                        </a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; else: ?>
                <div class="alert alert-warning"><?php echo lang('No_record'); ?></div>
                <?php endif; if(!(empty($payments) || (($payments instanceof \think\Collection || $payments instanceof \think\Paginator ) && $payments->isEmpty()))): ?>
                <tr>
                    <td colspan="10" style="padding: 0;">
                        <div class="alert alert-info" style="margin:0;"><?php echo lang('Common_Payments'); ?></div>
                    </td>
                </tr>

                <?php if(is_array($payments) || $payments instanceof \think\Collection || $payments instanceof \think\Paginator): $i = 0; $__LIST__ = $payments;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <tr>
                    <!--<td class="center">
                    <?php if(!(empty($vo['uninstall']) || (($vo['uninstall'] instanceof \think\Collection || $vo['uninstall'] instanceof \think\Paginator ) && $vo['uninstall']->isEmpty()))): ?>
                    <input class="ids" type="checkbox" value="<?php echo $vo['id']; ?>" name="ids[]">
                    <?php endif; ?>
                    </td>-->
                    <td class="left"> <?php echo $key + 1; ?></td>
                    <td class="left"><?php echo $vo['name']; ?></td>
                    <td class="left"><?php echo $vo['code']; ?></td>
                    <!--<td class="left">
                        <a href="<?php echo url('',array('group'=>$vo['subjection'])); ?>"><?php echo $vo['subjection']; ?></a>
                    </td>-->
                    <td class="left slh tooltip-link" title="<?php echo $vo['description']; ?>" style="max-width: 250px; line-height: 1.7;">
                        <?php echo $vo['description']; ?>
                    </td>
                    <td class="center">
                        <a target="_blank" href="<?php echo (isset($vo['website']) && ($vo['website'] !== '')?$vo['website']:'http://www.runtuer.com'); ?>">
                            <?php echo $vo['author']; ?>
                        </a>
                    </td>
                    <td class="center"><?php echo $vo['version']; ?></td>
                    <!--<td class="center lastver" data-ver="<?php echo $vo['version']; ?>" <?php if(!(empty($vo['upgrade']) || (($vo['upgrade'] instanceof \think\Collection || $vo['upgrade'] instanceof \think\Paginator ) && $vo['upgrade']->isEmpty()))): ?>data-update="<?php echo $vo['upgrade']; ?>"<?php endif; ?>>
                    <a class="tooltip-link red ajax-get" data-showbar="1" data-width="480" data-height="320" data-layer="<?php echo lang('Upgrade_e_to', array('cnname'=>$vo['name'], 'enname'=>$vo['code'], 'lastver'=>'')); ?>" title="<?php echo lang('Upgrade_e_to', array('cnname'=>$vo['name'], 'enname'=>$vo['code'])); ?>" href="<?php echo url('upgradeto',array('code'=>$vo['code'], 'subjection' => $vo['subjection'], 'url'=>'upgradetourl', 'istrue'=>1)); ?>"></a>
                    </td>-->
    
                    <td class="center">
                        <?php if($vo['isshow'] == 1): ?>
                        <a href="<?php echo url('disable', array('code'=> $vo['code'], 'subjection'=>$vo['subjection'])); ?>" class="ajax-able" data-doing="<?php echo lang('Disable'); ?>">
                            <img src="__PUBLIC__/admin/images/enabled.png" title="<?php echo lang('Enable'); ?>" class="tooltip-link" alt="<?php echo lang('Enable'); ?>" height="16px" data-enabled="__PUBLIC__/admin/images/enabled.png" data-disabled="__PUBLIC__/admin/images/disabled.png" />
                        </a>
                        <?php else: if($vo['uninstall'] == 1): ?>
                        <a href="<?php echo url('enable', array('isshow'=> 1, 'code'=> $vo['code'], 'subjection'=>$vo['subjection'])); ?>" class="ajax-able" data-doing="<?php echo lang('Enable'); ?>">
                            <img src="__PUBLIC__/admin/images/disabled.png" title="<?php echo lang('Disable'); ?>" class="tooltip-link" alt="<?php echo lang('Disable'); ?>" height="16px" data-enabled="__PUBLIC__/admin/images/enabled.png" data-disabled="__PUBLIC__/admin/images/disabled.png" />
                        </a>
                        <?php else: ?>
                        <img src="__PUBLIC__/admin/images/notinstall.png" title="<?php echo lang('Notinstall'); ?>" class="tooltip-link" alt="<?php echo lang('Notinstall'); ?>" height="16px" />
                        <?php endif; endif; ?>
                    </td>
    
                    <td class="center">
                        <?php if($vo['status'] == 1): ?>
                        <a href="<?php echo url('admin/extend/disable', array('code'=> $vo['code'], 'subjection'=>$vo['subjection'])); ?>" class="ajax-able" data-doing="<?php echo lang('Disable'); ?>">
                            <img src="__PUBLIC__/admin/images/enabled.png" title="<?php echo lang('Enable'); ?>" class="tooltip-link" alt="<?php echo lang('Enable'); ?>" height="16px" data-enabled="__PUBLIC__/admin/images/enabled.png" data-disabled="__PUBLIC__/admin/images/disabled.png" />
                        </a>
                        <?php else: if($vo['uninstall'] == 1): ?>
                        <a href="<?php echo url('admin/extend/enable', array('code'=> $vo['code'], 'subjection'=>$vo['subjection'])); ?>" class="ajax-able" data-doing="<?php echo lang('Enable'); ?>">
                            <img src="__PUBLIC__/admin/images/disabled.png" title="<?php echo lang('Disable'); ?>" class="tooltip-link" alt="<?php echo lang('Disable'); ?>" height="16px" data-enabled="__PUBLIC__/admin/images/enabled.png" data-disabled="__PUBLIC__/admin/images/disabled.png" />
                        </a>
                        <?php else: ?>
                        <img src="__PUBLIC__/admin/images/notinstall.png" title="<?php echo lang('Notinstall'); ?>" class="tooltip-link" alt="<?php echo lang('Notinstall'); ?>" height="16px" />
                        <?php endif; endif; ?>
                    </td>
    
                    <td class="actions">
                        <?php if(!(empty($vo['uninstall']) || (($vo['uninstall'] instanceof \think\Collection || $vo['uninstall'] instanceof \think\Paginator ) && $vo['uninstall']->isEmpty()))): if(($vo['status'] >= 0) AND ($vo['allow_uninstall'] == 1)): if($vo['status'] == '1'): ?>
                        <a class="ajax-get btn_submit green" href="<?php echo url('admin/extend/config', array('code'=> $vo['code'], 'subjection'=>$vo['subjection'], 'jump'=>$curr_url)); ?>" data-layer="<?php echo lang('Setting'); ?> ：<?php echo $vo['name']; ?> " data-showbar=1 data-title="<?php echo $vo['name']; ?> <?php echo lang('Setting'); ?>" data-width="680" data-height="520">
                            <?php echo lang('Setting'); ?>
                        </a>
                        <?php endif; endif; if($vo['allow_uninstall'] == 1): ?>
                        <a class="tooltip-link ajax-get confirm warning btn_submit red" title="<?php echo lang('Uninstall', array('name'=>$vo['name'])); ?>" href="<?php echo url('admin/extend/uninstall',array('code'=> $vo['code'], 'subjection'=>$vo['subjection'])); ?>" data-layer="<?php echo lang('Uninstallext', array('subjection' => lang($vo['subjection']), 'name' => $vo['name'], 'code' => $vo['code'])); ?>" data-title="<?php echo lang('Uninstall', array('name'=>$vo['name'])); ?>">
                            <?php echo lang('Uninstall', array('name'=>'')); ?>
                        </a>
                        <?php endif; else: ?>
                        <a class="tooltip-link ajax-get confirm btn_submit" title="<?php echo lang('Install'); ?>" href="<?php echo url('admin/extend/install', array('code'=> $vo['code'], 'subjection'=>$vo['subjection'])); ?>" data-layer="<?php echo lang('Install'); ?> ：<?php echo $vo['name']; ?>(<?php echo $vo['code']; ?>) ?" data-title="<?php echo lang('Install'); ?> ：<?php echo $vo['name']; ?>">
                            <?php echo lang('Install'); ?>
                        </a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; else: ?>
                <div class="alert alert-warning"><?php echo lang('No_record'); ?></div>
                <?php endif; ?>
                
                </tbody>
            </table>
            <div class="pagination-wrapper">
    
            </div>
        </div>

    </div>
    </div>
    

    
    <!--<script type="text/javascript" src="//runtuer.com/liceson/check"></script>-->
</body>
</html>