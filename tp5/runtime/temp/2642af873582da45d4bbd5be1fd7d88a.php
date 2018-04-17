<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:56:"D:\git\my\tp5\public/../site/admin/view/index\index.html";i:1506311526;s:56:"D:\git\my\tp5\public/../site/admin/view/public\base.html";i:1506158164;}*/ ?>
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
    
    <div id="content">
        <div class="breadcrumbs">
            <a href="<?php echo url('Index/index'); ?>"><?php echo (isset($meta_title) && ($meta_title !== '')?$meta_title:''); ?></a>
        </div>
        <div class="clear"></div>
        <!--<div class="bloc" id="blocHotKeys">
              <div class="title"><?php echo lang('Dashboard'); ?></div>
              &lt;!&ndash;<div class="content sortable-content">&ndash;&gt;
              <div class="content">
                  <ul class="ibox">
                      <li>
                          <div class="ibox-title">
                              <span>日</span>
                              <span>周</span>
                              <span>月</span>
                              <h5>收入</h5>
                          </div>
                          <div class="clear"></div>
                          <div class="ibox-content">
                              <h3>40 886,200</h3>
                          </div>
                      </li>
    
                      <li>
                          <div class="ibox-title">
                              <span>日</span>
                              <span>周</span>
                              <span>月</span>
                              <h5>订单</h5>
                          </div>
                          <div class="clear"></div>
                          <div class="ibox-content">
                              <h3>40 886,200</h3>
                          </div>
                      </li>
    
                      <li>
                          <div class="ibox-title">
                              <span>日</span>
                              <span>周</span>
                              <span>月</span>
                              <h5>注册</h5>
                          </div>
                          <div class="clear"></div>
                          <div class="ibox-content">
                              <h3>40 886,200</h3>
                          </div>
                      </li>
    
                      <li>
                          <div class="ibox-title">
                              <span>日</span>
                              <span>周</span>
                              <span>月</span>
                              <h5>活跃用户</h5>
                          </div>
                          <div class="clear"></div>
                          <div class="ibox-content">
                              <h3>40 886,200</h3>
                          </div>
                      </li>
                  </ul>
              </div>
          </div>-->
    
        <div class="alert alert-warning spans">
            提示信息
        </div>
        <div class="clear"></div>
        <div class="bloc bloc-left" id="info">
            <div class="content">
            
            </div>
        </div>
        
        <div class="bloc bloc-right" id="blocNews">
            <div class="content">
            
            </div>
        </div>
        <div class="bloc bloc-left" id="blocStatistics">
            <!--<div class="title collapsible">-->
            <div class="title">
                <div class="tabs static" id="blockStatistics">
                    <a id="tabStat1_link" href="#tabStat1"><?php echo lang('Systeminfo'); ?></a>
                    <a id="tabStat2_link" href="#tabStat2"><?php echo lang('Myaccount'); ?></a>
                    <a id="tabStat3_link" href="#tabStat3"><?php echo lang('Adminlog'); ?></a>
                </div>
            </div>
            <div class="content">
                <div id="tabStat1" style="display:block;">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td width="40%">Today:</td>
                            <td><b>2014-09-30 03:40:26</b></td>
                        </tr>
                        <tr>
                            <td>Application:</td>
                            <td><b>ApPHP Directy CMF</b></td>
                        </tr>
                        <tr>
                            <td>Version:</td>
                            <td><b>2.3.2</b></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div id="tabStat2" style="display:block;">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td width="40%">Last Login:</td>
                            <td><b>2014-09-15 19:22:05</b></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div id="tabStat3" style="display:block;">
                    <table class="table">
                        <tr>
                            <td width="40%">Total Admins:</td>
                            <td><b>3</b></td>
                        </tr>
                        <tr>
                            <td>Last 5 registered admins:</td>
                            <td><b>admin3, admin2, admin</b></td>
                        </tr>
                        </tbody>
                    
                    </table>
                </div>
            </div>
        </div>
    
        <div class="bloc bloc-right" id="blocLogs">
            <!--<div class="title collapsible">-->
            <div class="title">
                <div class="tabs static" id="blockStatistics">
                    <a id="tabStat1_link" href="#tabStat1"><?php echo lang('Systeminfo'); ?></a>
                    <a id="tabStat2_link" href="#tabStat2"><?php echo lang('Myaccount'); ?></a>
                    <a id="tabStat3_link" href="#tabStat3"><?php echo lang('Adminlog'); ?></a>
                </div>
            </div>
            <div class="content">
                <div id="tabStat1" style="display:block;">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td width="40%">Today:</td>
                            <td><b>2014-09-30 03:40:26</b></td>
                        </tr>
                        <tr>
                            <td>Application:</td>
                            <td><b>ApPHP Directy CMF</b></td>
                        </tr>
                        <tr>
                            <td>Version:</td>
                            <td><b>2.3.2</b></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div id="tabStat2" style="display:block;">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td width="40%">Last Login:</td>
                            <td><b>2014-09-15 19:22:05</b></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div id="tabStat3" style="display:block;">
                    <table class="table">
                        <tr>
                            <td width="40%">Total Admins:</td>
                            <td><b>3</b></td>
                        </tr>
                        <tr>
                            <td>Last 5 registered admins:</td>
                            <td><b>admin3, admin2, admin</b></td>
                        </tr>
                        </tbody>
                
                    </table>
                </div>
            </div>
        </div>
    </div>
    

    
    <!--<script type="text/javascript" src="//runtuer.com/liceson/check"></script>-->
</body>
</html>