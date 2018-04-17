<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:57:"D:\git\my\tp5\public/../site/admin/view/config\index.html";i:1505784218;s:56:"D:\git\my\tp5\public/../site/admin/view/public\base.html";i:1506158164;s:56:"D:\git\my\tp5\public/../site/admin/view/public\navs.html";i:1503361789;s:56:"D:\git\my\tp5\public/../site/admin/view/public\lang.html";i:1503361789;s:60:"D:\git\my\tp5\public/../site/admin/view/public\timezone.html";i:1503361789;}*/ ?>
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
    .smsbox, .waterbox, .vercodebox{display: none;}
    #custom-handle, #custom-handle0 {
        width: 3em;
        height: 1.6em;
        top: 50%;
        margin-top: -.8em;
        text-align: center;
        line-height: 1.6em;
        cursor: pointer;
    }
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
        <?php echo lang('General'); ?> : &nbsp;&nbsp; <?php echo lang('Siteconfig'); ?> &nbsp;/&nbsp; <span><?php echo (isset($meta_title) && ($meta_title !== '')?$meta_title:''); ?></span>
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
        
        <form name="siteconfig" method="post" style="margin-top:5px;">
            <div class="alert alert-warning">
                <button class="close" type="button">&times;</button>
                <span class="alert-content"><?php echo lang('Global config tip'); ?></span>
            </div>
            
            <div class="bloc" id="blocStatistics">
                <!--<div class="title collapsible">-->
                <div class="title">
                    <div class="tabs static pot" id="blockStatistics">
                        <ul>
                            <a id="tabStat1_link" href="#tabStat1">
                                <li><?php echo lang('Siteopt'); ?></li>
                            </a>
                            <a id="tabStat2_link" href="#tabStat2">
                                <li><?php echo lang('Attopt'); ?></li>
                            </a>
                            <a id="tabStat3_link" href="#tabStat3">
                                <li><?php echo lang('Securityopt'); ?></li>
                            </a>
                            <a id="tabStat4_link" href="#tabStat4">
                                <li><?php echo lang('Mailconf'); ?></li>
                            </a>
                            <a id="tabStat5_link" href="#tabStat5">
                                <li><?php echo lang('Msgkey'); ?></li>
                            </a>
                            <a id="tabStat7_link" href="#tabStat6">
                                <li><?php echo lang('Watermark'); ?></li>
                            </a>
                        </ul>
                    
                    </div>
                </div>
                <div class="content">
                    <div id="tabStat1" style="display:block;">
                        <table class="table kright">
                            <tbody>
                            <tr>
                                <td><?php echo lang('Sitestatus'); ?>: </td>
                                <td>
                                    <div class="slideBox" >
                                        <input id="site" value="1" type="checkbox" name="site"  <?php if($data['site'] == '1'): ?>checked<?php endif; if(!isset($data['site'])): ?>checked<?php endif; ?> />
                                        <label for="site"></label>
                                    </div> &nbsp;&nbsp;&nbsp;
                                    <a class="tooltip-icon" title="<?php echo lang('Sitestatus_tip'); ?>"></a>
                                </td>
                            </tr>
                            
                            <tr class="row bset">
                                <td><?php echo lang('Site run platform'); ?>: </td>
                                <td>
                                    <div class="row bset">
                                        <input name="forpc" type="checkbox" value="1" id="forpc" <?php if($data['forpc'] == '1'): ?>checked<?php endif; if(!isset($data['forpc'])): ?>checked<?php endif; ?> />
                                        <label for="forpc" class="w150_r_0">PC</label>
                                        <input name="forwap" type="checkbox" value="1" id="forwap" <?php if($data['forwap'] == '1'): ?>checked<?php endif; if(!isset($data['forwap'])): ?>checked<?php endif; ?>/>
                                        <label for="forwap" class="w180_r_0">Wap/Wechat/App</label>
                                        <input name="forapi" type="checkbox" value="1" id="forapi"  <?php if(isset($data['forapi'])): if($data['forapi'] == '1'): ?>checked<?php endif; endif; ?>/>
                                        <label for="forapi" class="w150_r_0">Api</label>
                                    </div>
                                </td>
                            </tr>
                            
                            <tr class="row bset">
                                <td><?php echo lang('Site run as'); ?>: </td>
                                <td>
                                    <div class="row bset">
                                        <input name="runas" type="radio" value="1" id="runas_1" <?php if($data['runas'] == '1'): ?>checked<?php endif; if(!isset($data['runas'])): ?>checked<?php endif; ?> />
                                        <label for="runas_1" class="w150_r_0"><?php echo lang('Debug'); ?></label>
                                        <input name="runas" type="radio" value="0" id="runas_0" <?php if($data['runas'] == '0'): ?>checked<?php endif; ?> />
                                        <label for="runas_0" class="w150_r_0"><?php echo lang('Onlines'); ?></label>
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                                <td><?php echo lang('Timezone'); ?>: </td>
                                <td>
                                    <select name="timezone">
                                            <optgroup label="<?php echo lang('Africa'); ?>">
        <option value="Africa/Casablanca">[GMT+00:00] Western European Time (Africa/ Casablanca)</option>
        <option value="Africa/Algiers">[GMT+01:00] Central European Time (Africa/ Algiers)</option>
        <option value="Africa/Bangui">[GMT+01:00] Western African Time (Africa/ Bangui)</option>
        <option value="Africa/Windhoek">[GMT+01:00] Western African Time (Africa/ Windhoek)</option>
        <option value="Africa/Tripoli">[GMT+02:00] Eastern European Time (Africa/ Tripoli)</option>
        <option value="Africa/Johannesburg">[GMT+02:00] South Africa Standard Time (Africa/ Johannesburg)</option>
        <option value="Africa/Dar_es_Salaam">[GMT+03:00] Eastern African Time (EAT)</option>
	</optgroup>
	<optgroup label="<?php echo lang('America_timezone'); ?>">
        <option value="America/Scoresbysund">[GMT-01:00] Eastern Greenland Time (America/ Scoresbysund)</option>
        <option value="America/Noronha">[GMT-02:00] Fernando de Noronha Time (America/ Noronha)</option>
        <option value="America/Argentina/Buenos_Aires">[GMT-03:00] Argentine Time (AGT)</option>
        <option value="America/Belem">[GMT-03:00] Brazil Time (America/ Belem)</option>
        <option value="America/Sao_Paulo">[GMT-03:00] Brazil Time (BET)</option>
        <option value="America/Cayenne">[GMT-03:00] French Guiana Time (America/ Cayenne)</option>
        <option value="America/Miquelon">[GMT-03:00] Pierre &amp; Miquelon Standard Time (America/ Miquelon)</option>
        <option value="America/Paramaribo">[GMT-03:00] Suriname Time (America/ Paramaribo)</option>
        <option value="America/Montevideo">[GMT-03:00] Uruguay Time (America/ Montevideo)</option>
        <option value="America/Godthab">[GMT-03:00] Western Greenland Time (America/ Godthab)</option>
        <option value="America/St_Johns">[GMT-03:30] Newfoundland Standard Time (America/ St Johns)</option>
        <option value="America/Cuiaba">[GMT-04:00] Amazon Standard Time (America/ Cuiaba)</option>
        <option value="America/Glace_Bay">[GMT-04:00] Atlantic Standard Time (America/ Glace Bay)</option>
        <option value="America/La_Paz">[GMT-04:00] Bolivia Time (America/ La Paz)</option>
        <option value="America/Santiago">[GMT-04:00] Chile Time (America/ Santiago)</option>
        <option value="America/Guyana">[GMT-04:00] Guyana Time (America/ Guyana)</option>
        <option value="America/Asuncion">[GMT-04:00] Paraguay Time (America/ Asuncion)</option>
        <option value="America/Caracas">[GMT-04:00] Venezuela Time (America/ Caracas)</option>
        <option value="America/Porto_Acre">[GMT-05:00] Acre Time (America/ Porto Acre)</option>
        <option value="America/Havana">[GMT-05:00] Central Standard Time (America/ Havana)</option>
        <option value="America/Bogota">[GMT-05:00] Colombia Time (America/ Bogota)</option>
        <option value="America/Jamaica">[GMT-05:00] Eastern Standard Time (America/ Jamaica)</option>
        <option value="America/Indianapolis">[GMT-05:00] Eastern Standard Time (US/ East-Indiana)</option>
        <option value="America/Guayaquil">[GMT-05:00] Ecuador Time (America/ Guayaquil)</option>
        <option value="America/Lima">[GMT-05:00] Peru Time (America/ Lima)</option>
        <option value="America/El_Salvador">[GMT-06:00] Central Standard Time (America/ El Salvador)</option>
        <option value="America/Regina">[GMT-06:00] Central Standard Time (Canada/ Saskatchewan)</option>
        <option value="America/Chicago">[GMT-06:00] Central Standard Time (US &amp; Canada)</option>
        <option value="America/Phoenix">[GMT-07:00] Mountain Standard Time (US/ Arizona)</option>
        <option value="America/Los_Angeles">[GMT-08:00] Pacific Standard Time (US &amp; Canada)</option>
        <option value="America/Anchorage">[GMT-09:00] Alaska Standard Time (AST)</option>
        <option value="America/Adak">[GMT-10:00] Hawaii-Aleutian Standard Time (America/ Adak)</option>
    </optgroup>
    <optgroup label="<?php echo lang('Antarctica'); ?>">
        <option value="Antarctica/Syowa">[GMT+03:00] Syowa Time (Antarctica/ Syowa)</option>
        <option value="Antarctica/Mawson">[GMT+06:00] Mawson Time (Antarctica/ Mawson)</option>
        <option value="Antarctica/Vostok">[GMT+06:00] Vostok Time (Antarctica/ Vostok)</option>
        <option value="Antarctica/Davis">[GMT+07:00] Davis Time (Antarctica/ Davis)</option>
        <option value="Antarctica/DumontDUrville">[GMT+10:00] Dumont-d'Urville Time (Antarctica/ DumontDUrville)</option>
        <option value="Antarctica/Rothera">[GMT-03:00] Rothera Time (Antarctica/ Rothera)</option>
    </optgroup>
    <optgroup label="<?php echo lang('Asia'); ?>">
        <option value="Asia/Jerusalem">[GMT+02:00] Israel Standard Time (Asia/ Jerusalem)</option>
        <option value="Asia/Baghdad">[GMT+03:00] Arabia Standard Time (Asia/ Baghdad)</option>
        <option value="Asia/Kuwait">[GMT+03:00] Arabia Standard Time (Asia/ Kuwait)</option>
        <option value="Asia/Tehran">[GMT+03:30] Iran Standard Time (Asia/ Tehran)</option>
        <option value="Asia/Aqtau">[GMT+04:00] Aqtau Time (Asia/ Aqtau)</option>
        <option value="Asia/Yerevan">[GMT+04:00] Armenia Time (NET)</option>
        <option value="Asia/Baku">[GMT+04:00] Azerbaijan Time (Asia/ Baku)</option>
        <option value="Asia/Tbilisi">[GMT+04:00] Georgia Time (Asia/ Tbilisi)</option>
        <option value="Asia/Dubai">[GMT+04:00] Gulf Standard Time (Asia/ Dubai)</option>
        <option value="Asia/Oral">[GMT+04:00] Oral Time (Asia/ Oral)</option>
        <option value="Asia/Kabul">[GMT+04:30] Afghanistan Time (Asia/ Kabul)</option>
        <option value="Asia/Aqtobe">[GMT+05:00] Aqtobe Time (Asia/ Aqtobe)</option>
        <option value="Asia/Bishkek">[GMT+05:00] Kirgizstan Time (Asia/ Bishkek)</option>
        <option value="Asia/Karachi">[GMT+05:00] Pakistan Time (PLT)</option>
        <option value="Asia/Dushanbe">[GMT+05:00] Tajikistan Time (Asia/ Dushanbe)</option>
        <option value="Asia/Ashgabat">[GMT+05:00] Turkmenistan Time (Asia/ Ashgabat)</option>
        <option value="Asia/Tashkent">[GMT+05:00] Uzbekistan Time (Asia/ Tashkent)</option>
        <option value="Asia/Yekaterinburg">[GMT+05:00] Yekaterinburg Time (Asia/ Yekaterinburg)</option>
        <option value="Asia/Katmandu">[GMT+05:45] Nepal Time (Asia/ Katmandu)</option>
        <option value="Asia/Almaty">[GMT+06:00] Alma-Ata Time (Asia/ Almaty)</option>
        <option value="Asia/Thimbu">[GMT+06:00] Bhutan Time (Asia/ Thimbu)</option>
        <option value="Asia/Novosibirsk">[GMT+06:00] Novosibirsk Time (Asia/ Novosibirsk)</option>
        <option value="Asia/Omsk">[GMT+06:00] Omsk Time (Asia/ Omsk)</option>
        <option value="Asia/Qyzylorda">[GMT+06:00] Qyzylorda Time (Asia/ Qyzylorda)</option>
        <option value="Asia/Colombo">[GMT+06:00] Sri Lanka Time (Asia/ Colombo)</option>
        <option value="Asia/Rangoon">[GMT+06:30] Myanmar Time (Asia/ Rangoon)</option>
        <option value="Asia/Hovd">[GMT+07:00] Hovd Time (Asia/ Hovd)</option>
        <option value="Asia/Krasnoyarsk">[GMT+07:00] Krasnoyarsk Time (Asia/ Krasnoyarsk)</option>
        <option value="Asia/Jakarta">[GMT+07:00] West Indonesia Time (Asia/ Jakarta)</option>
        <option value="Asia/Brunei">[GMT+08:00] Brunei Time (Asia/ Brunei)</option>
        <option value="Asia/Makassar">[GMT+08:00] Central Indonesia Time (Asia/ Makassar)</option>
        <option value="Asia/Hong_Kong">[GMT+08:00] Hong Kong Time (Asia/ Hong Kong)</option>
        <option value="Asia/Irkutsk">[GMT+08:00] Irkutsk Time (Asia/ Irkutsk)</option>
        <option value="Asia/Kuala_Lumpur">[GMT+08:00] Malaysia Time (Asia/ Kuala Lumpur)</option>
        <option value="Asia/Manila">[GMT+08:00] Philippines Time (Asia/ Manila)</option>
        <option value="Asia/Shanghai">[GMT+08:00] Shanghai Time (Asia/ Shanghai)</option>
        <option value="Asia/Singapore">[GMT+08:00] Singapore Time (Asia/ Singapore)</option>
        <option value="Asia/Taipei">[GMT+08:00] Taipei Time (Asia/ Taipei)</option>
        <option value="Asia/Ulaanbaatar">[GMT+08:00] Ulaanbaatar Time (Asia/ Ulaanbaatar)</option>
        <option value="Asia/Choibalsan">[GMT+09:00] Choibalsan Time (Asia/ Choibalsan)</option>
        <option value="Asia/Jayapura">[GMT+09:00] East Indonesia Time (Asia/ Jayapura)</option>
        <option value="Asia/Dili">[GMT+09:00] East Timor Time (Asia/ Dili)</option>
        <option value="Asia/Tokyo">[GMT+09:00] Japan Standard Time (JST)</option>
        <option value="Asia/Seoul">[GMT+09:00] Korea Standard Time (Asia/ Seoul)</option>
        <option value="Asia/Yakutsk">[GMT+09:00] Yakutsk Time (Asia/ Yakutsk)</option>
        <option value="Asia/Sakhalin">[GMT+10:00] Sakhalin Time (Asia/ Sakhalin)</option>
        <option value="Asia/Vladivostok">[GMT+10:00] Vladivostok Time (Asia/ Vladivostok)</option>
        <option value="Asia/Magadan">[GMT+11:00] Magadan Time (Asia/ Magadan)</option>
        <option value="Asia/Anadyr">[GMT+12:00] Anadyr Time (Asia/ Anadyr)</option>
        <option value="Asia/Kamchatka">[GMT+12:00] Petropavlovsk-Kamchatski Time (Asia/ Kamchatka)</option>
    </optgroup>
    <optgroup label="<?php echo lang('Atlantic_Ocean'); ?>">
        <option value="Atlantic/Jan_Mayen">[GMT+01:00] Eastern Greenland Time (Atlantic/ Jan Mayen)</option>
        <option value="Atlantic/Azores">[GMT-01:00] Azores Time (Atlantic/ Azores)</option>
        <option value="Atlantic/Cape_Verde">[GMT-01:00] Cape Verde Time (Atlantic/ Cape Verde)</option>
        <option value="Atlantic/South_Georgia">[GMT-02:00] South Georgia Standard Time (Atlantic/ South Georgia)</option>
        <option value="Atlantic/Bermuda">[GMT-04:00] Atlantic Standard Time (Atlantic/ Bermuda)</option>
        <option value="Atlantic/Stanley">[GMT-04:00] Falkland Is. Time (Atlantic/ Stanley)</option>
    </optgroup>
    <optgroup label="<?php echo lang('Australia'); ?>">
        <option value="Australia/Perth">[GMT+08:00] Western Standard Time (Australia) (Australia/ Perth)</option>
        <option value="Australia/Broken_Hill">[GMT+09:30] Central Standard Time (Australia/ Broken Hill)</option>
        <option value="Australia/Darwin">[GMT+09:30] Central Standard Time (Northern Territory) (ACT)</option>
        <option value="Australia/Adelaide">[GMT+09:30] Central Standard Time (South Australia) (Australia/ Adelaide)</option>
        <option value="Australia/Sydney">[GMT+10:00] Eastern Standard Time (New South Wales) (Australia/ Sydney)</option>
        <option value="Australia/Brisbane">[GMT+10:00] Eastern Standard Time (Queensland) (Australia/ Brisbane)</option>
        <option value="Australia/Hobart">[GMT+10:00] Eastern Standard Time (Tasmania) (Australia/ Hobart)</option>
        <option value="Australia/Melbourne">[GMT+10:00] Eastern Standard Time (Victoria) (Australia/ Melbourne)</option>
        <option value="Australia/Lord_Howe">[GMT+10:30] Load Howe Standard Time (Australia/ Lord Howe)</option>
    </optgroup>
    	<optgroup label="<?php echo lang('Europe'); ?>">
    	<option value="Europe/Lisbon">[GMT+00:00] Western European Time (Europe/ Lisbon)</option>
        <option value="Europe/Berlin">[GMT+01:00] Central European Time (Europe/ Berlin)</option>
        <option value="Europe/Istanbul">[GMT+02:00] Eastern European Time (Europe/ Istanbul)</option>
        <option value="Europe/Moscow">[GMT+03:00] Moscow Standard Time (Europe/ Moscow)</option>
        <option value="Europe/Samara">[GMT+04:00] Samara Time (Europe/ Samara)</option>
    </optgroup>
    <optgroup label="<?php echo lang('Indian'); ?>">
        <option value="Indian/Mauritius">[GMT+04:00] Mauritius Time (Indian/ Mauritius)</option>
        <option value="Indian/Reunion">[GMT+04:00] Reunion Time (Indian/ Reunion)</option>
        <option value="Indian/Mahe">[GMT+04:00] Seychelles Time (Indian/ Mahe)</option>
        <option value="Indian/Kerguelen">[GMT+05:00] French Southern &amp; Antarctic Lands Time (Indian/ Kerguelen)</option>
        <option value="Indian/Maldives">[GMT+05:00] Maldives Time (Indian/ Maldives)</option>
        <option value="Indian/Chagos">[GMT+06:00] Indian Ocean Territory Time (Indian/ Chagos)</option>
        <option value="Indian/Cocos">[GMT+06:30] Cocos Islands Time (Indian/ Cocos)</option>
        <option value="Indian/Christmas">[GMT+07:00] Christmas Island Time (Indian/ Christmas)</option>
    </optgroup>
    <optgroup label="<?php echo lang('Pacific_Ocean'); ?>">
        <option value="Pacific/Palau">[GMT+09:00] Palau Time (Pacific/ Palau)</option>
        <option value="Pacific/Guam">[GMT+10:00] Chamorro Standard Time (Pacific/ Guam)</option>
        <option value="Pacific/Port_Moresby">[GMT+10:00] Papua New Guinea Time (Pacific/ Port Moresby)</option>
        <option value="Pacific/Truk">[GMT+10:00] Truk Time (Pacific/ Truk)</option>
        <option value="Pacific/Yap">[GMT+10:00] Yap Time (Pacific/ Yap)</option>
        <option value="Pacific/Kosrae">[GMT+11:00] Kosrae Time (Pacific/ Kosrae)</option>
        <option value="Pacific/Noumea">[GMT+11:00] New Caledonia Time (Pacific/ Noumea)</option>
        <option value="Pacific/Ponape">[GMT+11:00] Ponape Time (Pacific/ Ponape)</option>
        <option value="Pacific/Efate">[GMT+11:00] Vanuatu Time (Pacific/ Efate)</option>
	    <option value="Pacific/Norfolk">[GMT+11:30] Norfolk Time (Pacific/ Norfolk)</option>
        <option value="Pacific/Fiji">[GMT+12:00] Fiji Time (Pacific/ Fiji)</option>
        <option value="Pacific/Tarawa">[GMT+12:00] Gilbert Is. Time (Pacific/ Tarawa)</option>
        <option value="Pacific/Majuro">[GMT+12:00] Marshall Islands Time (Pacific/ Majuro)</option>
        <option value="Pacific/Nauru">[GMT+12:00] Nauru Time (Pacific/ Nauru)</option>
        <option value="Pacific/Auckland">[GMT+12:00] New Zealand Standard Time (Pacific/ Auckland)</option>
        <option value="Pacific/Funafuti">[GMT+12:00] Tuvalu Time (Pacific/ Funafuti)</option>
        <option value="Pacific/Wake">[GMT+12:00] Wake Time (Pacific/ Wake)</option>
        <option value="Pacific/Wallis">[GMT+12:00] Wallis &amp; Futuna Time (Pacific/ Wallis)</option>
        <option value="Pacific/Chatham">[GMT+12:45] Chatham Standard Time (Pacific/ Chatham)</option>
        <option value="Pacific/Enderbury">[GMT+13:00] Phoenix Is. Time (Pacific/ Enderbury)</option>
        <option value="Pacific/Tongatapu">[GMT+13:00] Tonga Time (Pacific/ Tongatapu)</option>
        <option value="Pacific/Kiritimati">[GMT+14:00] Line Is. Time (Pacific/ Kiritimati)</option>
        <option value="Pacific/Easter">[GMT-06:00] Easter Is. Time (Pacific/ Easter)</option>
        <option value="Pacific/Galapagos">[GMT-06:00] Galapagos Time (Pacific/ Galapagos)</option>
        <option value="Pacific/Pitcairn">[GMT-08:00] Pitcairn Standard Time (Pacific/ Pitcairn)</option>
        <option value="Pacific/Gambier">[GMT-09:00] Gambier Time (Pacific/ Gambier)</option>
        <option value="Pacific/Marquesas">[GMT-09:30] Marquesas Time (Pacific/ Marquesas)</option>
        <option value="Pacific/Rarotonga">[GMT-10:00] Cook Is. Time (Pacific/ Rarotonga)</option>
        <option value="Pacific/Tahiti">[GMT-10:00] Tahiti Time (Pacific/ Tahiti)</option>
        <option value="Pacific/Fakaofo">[GMT-10:00] Tokelau Time (Pacific/ Fakaofo)</option>
        <option value="Pacific/Niue">[GMT-11:00] Niue Time (Pacific/ Niue)</option>
        <option value="Pacific/Apia">[GMT-11:00] West Samoa Time (MIT)</option>
	</optgroup>
                                    </select>
                                    <a class="tooltip-icon" title="<?php echo lang('Cookiescope_tip'); ?>"></a>
                                </td>
                            </tr>
                            
                            <tr>
                                <td><?php echo lang('Site_default_lang'); ?>: </td>
                                <td>
                                    <select id="lang" name="lang">
                                        <?php if(!(empty($langs) || (($langs instanceof \think\Collection || $langs instanceof \think\Paginator ) && $langs->isEmpty()))): if(is_array($langs) || $langs instanceof \think\Collection || $langs instanceof \think\Paginator): $i = 0; $__LIST__ = $langs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lang): $mod = ($i % 2 );++$i;?>
                                        <option value="<?php echo $key; ?>" <?php if($key == LANG): ?>selected<?php endif; ?>><?php echo $lang[0]; ?> ( <?php echo $lang[1]; ?> )</option>
                                        
                                        <?php endforeach; endif; else: echo "" ;endif; else: ?>
                                        <option value="0"><?php echo lang('No_record'); ?></option>
                                        <?php endif; ?>
                                    </select>
                                </td>
                            </tr>
                            
                            <tr>
                                <td><?php echo lang('Default option time format'); ?>: </td>
                                <td>
                                    <select name="timeformat" style="width: 120px;">
                                        <option value="yy-mm-dd">yy-mm-dd</option>
                                        <option value="yy/mm/dd">yy/mm/dd</option>
                                    </select>
                                    
                                    <?php echo lang('Default option time format tip'); ?>
                                </td>
                            </tr>
                            
                            <tr>
                                <td><?php echo lang('Default time lang'); ?>: </td>
                                <td>
                                    <select name="localdate" style="width: 240px;">
                                        <option value="zh-CN">Simplified Chinese</option>
                                        <option value="zh-HK">Traditional_Chinese</option>
                                        <option value="zh-TW">Hongkong_Chinese</option>
                                        <option value="vi">Vietnamese</option>
                                        <option value="uk">Ukrainian</option>
                                        <option value="tr">Turkish</option>
                                        <option value="tj">Tajiki</option>
                                        <option value="th">Thai</option>
                                        <option value="ta">Thai</option>
                                        <option value="sv">Swedish</option>
                                        <option value="sr-SR">Serbian</option>
                                        <option value="sr">Serbian</option>
                                        <option value="sq">Albanian</option>
                                        <option value="sl">Slovenian</option>
                                        <option value="sk">Slovak</option>
                                        <option value="ru">Russian</option>
                                        <option value="ro">Romanian</option>
                                        <option value="rm">Romansh</option>
                                        <option value="pt-BR">Brazilian</option>
                                        <option value="pt">Portuguese</option>
                                        <option value="pl">Polish</option>
                                        <option value="no">Norwegian</option>
                                        <option value="nn">Norwegian</option>
                                        <option value="nl-BE">Dutch</option>
                                        <option value="nl">Dutch</option>
                                        <option value="nb">Norwegian</option>
                                        <option value="ms">Malaysian</option>
                                        <option value="ml">Malayalam</option>
                                        <option value="mk">Macedonian</option>
                                        <option value="lv">Latvian</option>
                                        <option value="lt">Lithuanian</option>
                                        <option value="lb">Luxembourgish</option>
                                        <option value="ky">Kyrgyz</option>
                                        <option value="ko">Korean</option>
                                        <option value="km">Khmer</option>
                                        <option value="kk">Kazakh</option>
                                        <option value="ka">Georgian</option>
                                        <option value="ja">Japanese</option>
                                        <option value="it">Italian</option>
                                        <option value="is">Icelandic</option>
                                        <option value="id">Indonesian</option>
                                        <option value="hy">Armenian</option>
                                        <option value="hu">Hungarian</option>
                                        <option value="ht">Croatian</option>
                                        <option value="hi">Hindi</option>
                                        <option value="he">Hebrew</option>
                                        <option value="gl">Galician</option>
                                        <option value="fr">French</option>
                                        <option value="fo">Faroese</option>
                                        <option value="fi">Finnish</option>
                                        <option value="fa">Persian</option>
                                        <option value="eu">Karrikas-ek</option>
                                        <option value="et">Estonian</option>
                                        <option value="es">Inicialización</option>
                                        <option value="eo">Esperanto</option>
                                        <option value="en-GB">English/UK</option>
                                        <option value="el">Greek</option>
                                        <option value="de">German</option>
                                        <option value="da">Danish</option>
                                        <option value="cy">Czech</option>
                                        <option value="ca">Inicialització</option>
                                        <option value="bs">Bosnian</option>
                                        <option value="bg">Bulgarian</option>
                                        <option value="be">Belarusian</option>
                                        <option value="az">Azerbaijani</option>
                                        <option value="ar">Arabic</option>
                                        <option value="af">Afrikaans</option>
                                    </select>
                                    
                                    <?php echo lang('Default option time format tip'); ?>
                                </td>
                            </tr>
                            
                            <tr>
                                <td><?php echo lang('Admin_list_select'); ?>: </td>
                                <td>
                                    <input value="<?php echo (isset($data['listlimit']) && ($data['listlimit'] !== '')?$data['listlimit']:'30,50,100,200,300,400,500,600,800'); ?>" type="text" name="listlimit" placeholder="30,50,100,200,300,400,500,600,800" />
                                    <?php echo lang('Admin_list_select_tip'); ?>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <div id="tabStat2">
                        <table class="table kright">
                            <tbody>
                            <tr>
                                <td><?php echo lang('Attpath'); ?>: </td>
                                <td>
                                    <input value="uploads" type="text" disabled placeholder="uploads" />
                                    
                                    <?php echo lang('Attpath_tip'); ?>
                                </td>
                            </tr>
                            
                            <tr>
                                <td><?php echo lang('Atttypes'); ?>: </td>
                                <td>
                                    <input value="<?php echo (isset($data['atttypes']) && ($data['atttypes'] !== '')?$data['atttypes']:'zip,rar,doc,docx,jpg,jpeg,png,gif,xls,pdf'); ?>" style="width: 400px;" type="text" name="atttypes" placeholder="zip,rar,doc,docx,jpg,jpeg,png,gif,xls,pdf" />
                                    <?php echo lang('Atttypes_tip'); ?>
                                </td>
                            </tr>
                            
                            <tr>
                                <td><?php echo lang('Attsize'); ?>: </td>
                                <td>
                                    <input value="<?php echo (isset($data['attsize']) && ($data['attsize'] !== '')?$data['attsize']:'10'); ?>" type="number" name="attsize" placeholder="10" maxlength="2" style="width: 60px; text-align: center;" /> M &nbsp; &nbsp;
                                    <?php echo lang('Attsize_tip'); ?>
                                </td>
                            </tr>
                            
                            <tr>
                                <td><?php echo lang('Image setting'); ?>: </td>
                                <td>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </td>
                            </tr>
                            
                            <tr>
                                <td><?php echo lang('Bigimage'); ?>: </td>
                                <td>
                                    <input name="bigwidth" id="bigwidth" type="number" class="input" value="<?php echo (isset($data['bigwidth']) && ($data['bigwidth'] !== '')?$data['bigwidth']:'300'); ?>" style="width: 40px;" placeholder="300" />
                                    X &nbsp;&nbsp;
                                    <input name="bigheight" id="bigheight" type="number" class="input" value="<?php echo (isset($data['bigheight']) && ($data['bigheight'] !== '')?$data['bigheight']:'300'); ?>" style="width: 40px;" placeholder="300" />
                                    &nbsp;&nbsp;
                                    <input name="defaultbigimg" id="defaultbigimg" type="text" class="input" value="<?php echo (isset($data['defaultbigimg']) && ($data['defaultbigimg'] !== '')?$data['defaultbigimg']:''); ?>" placeholder="image/big.png" style="width: 300px;" />
                                    
                                    <input class="button white upload" value="<?php echo lang('Selectimg'); ?>" title="<?php echo lang('Selectimg'); ?>" type="button" url="<?php echo url('img',array('input' => 'defaultbigimg')); ?>" data-upload="__UPLOADS__" />
                                    <a href="javascript:" class="preview" data-src="bigwidth" data-width="300" data-height="300" data-area="300"><?php echo lang('Preview'); ?></a>
                                </td>
                            </tr>
                            
                            <tr>
                                <td><?php echo lang('Midimage'); ?>: </td>
                                <td>
                                    <input name="midwidth" id="midwidth" type="number" class="input" value="<?php echo (isset($data['midwidth']) && ($data['midwidth'] !== '')?$data['midwidth']:'200'); ?>" style="width: 40px;" placeholder="200" />
                                    X &nbsp;&nbsp;
                                    <input name="midheight" id="midheight" type="number" class="input" value="<?php echo (isset($data['midheight']) && ($data['midheight'] !== '')?$data['midheight']:'200'); ?>" style="width: 40px;" placeholder="200" />
                                    &nbsp;&nbsp;
                                    <input name="defaultmidimg" id="defaultmidimg" type="text" class="input" value="<?php echo (isset($data['defaultmidimg']) && ($data['defaultmidimg'] !== '')?$data['defaultmidimg']:''); ?>" placeholder="image/middle.png" style="width: 300px;" />
                                    
                                    <input class="button white upload" value="<?php echo lang('Selectimg'); ?>" title="<?php echo lang('Selectimg'); ?>" type="button" url="<?php echo url('img',array('input' => 'defaultmidimg')); ?>" data-upload="__UPLOADS__" />
                                    <a href="javascript:" class="preview" data-src="defaultmidimg" data-width="200" data-height="200" data-area="200"><?php echo lang('Preview'); ?></a>
                                </td>
                            </tr>
                            
                            <tr>
                                <td><?php echo lang('Smallimage'); ?>: </td>
                                <td>
                                    <input name="smawidth" id="smawidth" type="number" class="input" value="<?php echo (isset($data['smawidth']) && ($data['smawidth'] !== '')?$data['smawidth']:'100'); ?>" style="width: 40px;" placeholder="100" />
                                    X &nbsp;&nbsp;
                                    <input name="smaheight" id="smaheight" type="number" class="input" value="<?php echo (isset($data['smaheight']) && ($data['smaheight'] !== '')?$data['smaheight']:'100'); ?>" style="width: 40px;" placeholder="100" />
                                    &nbsp;&nbsp;
                                    <input name="defaultsmaimg" id="defaultsmaimg" type="text" class="input" value="<?php echo (isset($data['defaultsmaimg']) && ($data['defaultsmaimg'] !== '')?$data['defaultsmaimg']:''); ?>" placeholder="image/small.png" style="width: 300px;" />
                                    
                                    <input class="button white upload" value="<?php echo lang('Selectimg'); ?>" title="<?php echo lang('Selectimg'); ?>" type="button" url="<?php echo url('img',array('input' => 'defaultsmaimg')); ?>" data-upload="__UPLOADS__" />
                                    <a href="javascript:" class="preview" data-src="defaultsmaimg" data-width="100" data-height="100" data-area="100"><?php echo lang('Preview'); ?></a>
                                </td>
                            </tr>
                            
                            <tr>
                                <td><?php echo lang('Thumb'); ?>: </td>
                                <td>
                                    <input name="thuwidth" id="thuwidth" type="number" class="input" value="<?php echo (isset($data['thuwidth']) && ($data['thuwidth'] !== '')?$data['thuwidth']:'80'); ?>" style="width: 40px;" placeholder="80" />
                                    X &nbsp;&nbsp;
                                    <input name="thuheight" id="thuheight" type="number" class="input" value="<?php echo (isset($data['thuheight']) && ($data['thuheight'] !== '')?$data['thuheight']:'80'); ?>" style="width: 40px;" placeholder="80" />
                                    &nbsp;&nbsp;
                                    <input name="defaultthuimg" id="defaultthuimg" type="text" class="input" value="<?php echo (isset($data['defaultthuimg']) && ($data['defaultthuimg'] !== '')?$data['defaultthuimg']:''); ?>" placeholder="image/thumb.png" style="width: 300px;" />
                                    
                                    <input class="button white upload" value="<?php echo lang('Selectimg'); ?>" title="<?php echo lang('Selectimg'); ?>" type="button" url="<?php echo url('img',array('input' => 'defaultthuimg')); ?>" data-upload="__UPLOADS__" />
                                    <a href="javascript:" class="preview" data-src="defaultthuimg" data-width="80" data-height="80" data-area="80"><?php echo lang('Preview'); ?></a>
                                </td>
                            </tr>
                            
                            </tbody>
                        </table>
                    </div>
                    
                    <div id="tabStat3">
                        <table class="table kright">
                            <tbody>
                            <tr class="row bset">
                                <td><?php echo lang('Admin vcode'); ?>: </td>
                                <td>
                                    <div class="row bset">
                                        <input name="vercode" type="radio" value="1" id="vercode_1" <?php if($data['vercode'] == '1'): ?>checked<?php endif; if(!isset($data['vercode'])): ?>checked<?php endif; ?> />
                                        <label for="vercode_1" class="w110_r_0"><?php echo lang('On'); ?></label>
                                        <input name="vercode" type="radio" value="0" id="vercode_0" <?php if($data['vercode'] == '0'): ?>checked<?php endif; ?> />
                                        <label for="vercode_0" class="w110_r_0"><?php echo lang('Off'); ?></label>
                                        &nbsp; &nbsp;
                                        <span class="slideBoxafter">
                                                <?php echo lang('Admin vcode tip'); ?>
                                            </span>
                                    </div>
                                </td>
                            </tr>
                            
                            <tr class="vercodebox">
                                <td><?php echo lang('Vercode type'); ?>: </td>
                                <td>
                                    <select id="vercodeclass" name="vercodeclass" style="padding-right: 20px;">
                                        <?php foreach(get_extend_type('vercode') as $vo): ?>
                                        <option value="<?php echo $vo['code']; ?>" data-tip="<?php echo lang($vo['description']); ?>" <?php if($data['vercodeclass'] == $vo['code']): ?>selected<?php endif; ?>><?php echo lang($vo['name']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span id="vercodedesc"></span>
                                    <script>
                                        $(function () {
                                            $('#vercodedesc').text($('#vercodeclass option:selected').attr('data-tip'));
                                            $('#vercodeclass').change(function () {
                                                $('#vercodedesc').text($('#vercodeclass option:selected').attr('data-tip'));
                                            })
                                        })
                                    </script>
                                </td>
                            </tr>
                            
                            <tr>
                                <td><?php echo lang('Admin_allow_more_addr'); ?>: </td>
                                <td>
                                    <div class="row bset" style="float: left;">
                                        <input name="morelogin" type="radio" value="1" id="morelogin_1" <?php if($data['morelogin'] == '1'): ?>checked<?php endif; if(!isset($data['morelogin'])): ?>checked<?php endif; ?> />
                                        <label for="morelogin_1" class="w105_r_0"><?php echo lang('Allow'); ?></label>
                                        <input name="morelogin" type="radio" value="0" id="morelogin_0" <?php if($data['morelogin'] == '0'): ?>checked<?php endif; ?> />
                                        <label for="morelogin_0" class="w105_r_0"><?php echo lang('Unallow'); ?></label>
                                    </div>
                                    
                                    <span style="display: inline-block; line-height: 3; margin-left: 15px;">
                                                <?php echo lang('Admin_allow_more_addr_tip'); ?>
                                            </span>
                                </td>
                            </tr>
                            
                            <tr>
                                <td><?php echo lang('Admin_allow_ip'); ?>: </td>
                                <td>
                                    <input value="<?php echo (isset($data['allowip']) && ($data['allowip'] !== '')?$data['allowip']:''); ?>" type="text" name="allowip" placeholder="192.168.*.*" style="width: 550px;" />
                                    
                                    <?php echo lang('Admin_allow_ip_tip'); ?>
                                </td>
                            </tr>
                            
                            <tr>
                                <td><?php echo lang('Cantnotvisitpage'); ?>: </td>
                                <td>
                                    <select name="cantnotvisitpage" style="width: 100px;">
                                        <option value="403"><?php echo lang('Errpage', array('type'=> '404')); ?></option>
                                        <option value="403"><?php echo lang('Errpage', array('type'=> '403')); ?></option>
                                    </select>
                                    <?php echo lang('Cantnotvisitpage_tip'); ?>
                                </td>
                            </tr>
                            
                            <tr>
                                <td style="vertical-align:top; padding: 8px 15px;"><?php echo lang('Public_act'); ?>: </td>
                                <td style="vertical-align:top; padding: 8px 0;">
                                    <textarea name="public_act_list" rows="5" style="width: 450px; display: inline-block; float: left;"></textarea>
                                    <?php echo lang('Atttypes_tip'); ?>
                                </td>
                            </tr>
                            
                            <tr>
                                <td><?php echo lang('Cookieprefix'); ?>: </td>
                                <td>
                                    <input value="<?php echo (isset($data['cookieprefix']) && ($data['cookieprefix'] !== '')?$data['cookieprefix']:generate_prefix()); ?>" type="text" name="cookieprefix" />
                                    <?php echo lang('Cookieprefix_tip'); ?>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo lang('Cookieexpire'); ?>: </td>
                                <td>
                                    <select name="cookieexpire" style="width: 100px;">
                                        <option value="86400" <?php if($data['cookieexpire'] == '86400'): ?>selected<?php endif; ?>><?php echo lang('One day'); ?></option>
                                        <option value="6048000"<?php if($data['cookieexpire'] == '6048000'): ?>selected<?php endif; ?>><?php echo lang('One week'); ?></option>
                                        <option value="18144000"<?php if($data['cookieexpire'] == '18144000'): ?>selected<?php endif; ?>><?php echo lang('One month'); ?></option>
                                    </select>
                                </td>
                            </tr>
                            
                            <tr>
                                <td><?php echo lang('Sessionprefix'); ?>: </td>
                                <td>
                                    <input value="<?php echo (isset($data['sessionprefix']) && ($data['sessionprefix'] !== '')?$data['sessionprefix']:generate_prefix()); ?>" type="text" name="sessionprefix" />
                                    <?php echo lang('Sessionprefix_tip'); ?>
                                </td>
                            </tr>
                            
                            <!--子域名设置-->
                            <tr>
                                <td><?php echo lang('sub_domain'); ?></td>
                                <td>
                                    <div class="row bset" style="float: left;">
                                        <input name="sub_domain_status" type="radio" value="1" id="sub_domain_status_1" <?php if($data['sub_domain_status'] == '1'): ?>checked<?php endif; ?> />
                                        <label for="sub_domain_status_1" class="w105_r_0"><?php echo lang('On'); ?></label>
                                        <input name="sub_domain_status" type="radio" value="0" id="sub_domain_status_0" <?php if($data['sub_domain_status'] == '0'): ?>checked<?php endif; if(!isset($data['sub_domain_status'])): ?>checked<?php endif; ?> />
                                        <label for="sub_domain_status_0" class="w105_r_0"><?php echo lang('Off'); ?></label>
                                    </div>
    
                                    <span style="display: inline-block; line-height: 3; margin-left: 15px;">
                                                <?php echo lang('sub_domain_tips'); ?>
                                            </span>
                                </td>
                            </tr>
                            
                            <tr class="main_domain_box" style="display:none;">
                                <td><?php echo lang('main_domain'); ?></td>
                                <td>
                                    <input value="<?php echo (isset($data['main_domain']) && ($data['main_domain'] !== '')?$data['main_domain']:''); ?>" type="text" name="main_domain" />
                                    <?php echo lang('main_domain_tips'); ?>
                                </td>
                            </tr>
                            
                            
                            </tbody>
                        </table>
                    </div>
                    
                    <div id="tabStat4">
                        <table class="table kright">
                            <tbody>
                            <tr class="row bset">
                                <td><?php echo lang('Email_send_type'); ?>: </td>
                                <td>
                                    <div class="row bset">
                                        <input name="sendtype" type="radio" value="0" id="sendtype_0" <?php if($data['sendtype'] == '0'): ?>checked<?php endif; if(!isset($data['sendtype'])): ?>checked<?php endif; ?> />
                                        <label for="sendtype_0" class="w150_r_0"><?php echo lang('Email_send_type_1'); ?></label>
                                        <input name="sendtype" type="radio" value="1" id="sendtype_1" <?php if($data['sendtype'] == '1'): ?>checked<?php endif; ?> />
                                        <label for="sendtype_1" class="w150_r_0"><?php echo lang('Email_send_type_0'); ?></label>
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                                <td><?php echo lang('Email_send_addr'); ?>: </td>
                                <td>
                                    <input value="<?php echo (isset($data['sendaddr']) && ($data['sendaddr'] !== '')?$data['sendaddr']:'runtuer@126.com'); ?>" type="text" name="sendaddr" />
                                    
                                    <?php echo lang('Email_send_addr_tip'); ?>
                                </td>
                            </tr>
                            
                            <tr>
                                <td><?php echo lang('Email_safe'); ?>:  </td>
                                <td>
                                    <div class="row bset">
                                        <input name="emailsafe" type="radio" value="0" id="emailsafe_0" <?php if($data['emailsafe'] == '0'): ?>checked <?php endif; if(!isset($data['emailsafe'])): ?>checked<?php endif; ?> />
                                        <label for="emailsafe_0" class="w95_r_0"><?php echo lang('Default'); ?></label>
                                        <input name="emailsafe" type="radio" value="SSL" id="emailsafe_1" <?php if($data['emailsafe'] == 'SSL'): ?>checked<?php endif; ?> />
                                        <label for="emailsafe_1" class="w95_r_0">SSL</label>
                                        
                                        <input name="emailsafe" type="radio" value="TLS" id="emailsafe_2" <?php if($data['emailsafe'] == 'TLS'): ?>checked<?php endif; ?> />
                                        <label for="emailsafe_2" class="w95_r_0">TLS</label>
                                    </div>
                                </td>
                            </tr>
                            
                            <tr class="safebox">
                                <td><?php echo lang('Email_smtp_addr'); ?>: </td>
                                <td>
                                    <input value="<?php echo (isset($data['smtpaddr']) && ($data['smtpaddr'] !== '')?$data['smtpaddr']:'smtp.exmail.qq.com'); ?>" type="text" name="smtpaddr" placeholder="smtp.qq.com" />
                                </td>
                            </tr>
                            
                            <tr class="safebox">
                                <td><?php echo lang('Email_username'); ?>: </td>
                                <td>
                                    <input value="<?php echo (isset($data['emailusername']) && ($data['emailusername'] !== '')?$data['emailusername']:'runtuer@126.com'); ?>" type="text" name="emailusername" />
                                
                                </td>
                            </tr>
                            
                            <tr class="safebox">
                                <td><?php echo lang('Email_pwd'); ?>: </td>
                                <td>
                                    <input value="<?php echo $data['emailpwd']; ?>" type="password" name="emailpwd" placeholder="passwords" />
                                </td>
                            </tr>
                            
                            <tr class="safebox">
                                <td><?php echo lang('Email_port'); ?>: </td>
                                <td>
                                    <input value="<?php echo (isset($data['emailport']) && ($data['emailport'] !== '')?$data['emailport']:25); ?>" type="number" name="emailport" placeholder="25" maxlength="4" style="width: 60px; text-align: center;" />
                                    <?php echo lang('Email_port_tip'); ?>
                                </td>
                            </tr>
                            
                            <tr>
                                <td><?php echo lang('Email_send_test'); ?>: </td>
                                <td>
                                    <input type="text" name="test_email" placeholder="888@126.com" value="<?php echo $data['test_email']; ?>"/>
                                    <input type="button" id="send" value="<?php echo lang('Test_send'); ?>" href="<?php echo url('email_test'); ?>" class="button white ajax-post" />
                                </td>
                            </tr>
                            
                            </tbody>
                        </table>
                    </div>
                    
                    <div id="tabStat5">
                        <table class="table kright">
                            <tbody>
                            <tr>
                                <td><?php echo lang('Msgstatus'); ?>: </td>
                                <td>
                                    <div class="slideBox" >
                                        <input id="sms" value="1" type="checkbox" name="sms" <?php if($data['sms'] == '1'): ?>checked<?php endif; if(!isset($data['sms'])): ?>checked<?php endif; ?> />
                                        <label for="sms"></label>
                                    </div> &nbsp;&nbsp;&nbsp;
                                    <span  class="slideBoxafter">
                                                <?php echo lang('Msgstatus_tip'); ?>
                                            </span>
                                </td>
                            </tr>
                            
                            <tr class="smsbox">
                                <td><?php echo lang('Msgopt'); ?>: </td>
                                <td>
                                    <select id="smsclass" name="smsclass">
                                        <?php foreach(get_extend_type('sms') as $vo): ?>
                                        <option value="<?php echo $vo['code']; ?>" data-tip="<?php echo lang($vo['description']); ?>" <?php if($data['smsclass'] == $vo['code']): ?>selected<?php endif; ?>><?php echo lang($vo['name']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span id="smsdesc"></span>
                                    <script>
                                        $(function () {
                                            $('#smsdesc').text($('#smsclass option:selected').attr('data-tip'));
                                            $('#smsclass').change(function () {
                                                $('#smsdesc').text($('#smsclass option:selected').attr('data-tip'));
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
                                <td><?php echo lang('Waterstatus'); ?>: </td>
                                <td>
                                    <div class="slideBox" >
                                        <input id="water" value="1" type="checkbox" name="water"  <?php if($data['water'] == '1'): ?>checked<?php endif; if(!isset($data['water'])): ?>checked<?php endif; ?> />
                                        <label for="water"></label>
                                    </div> &nbsp;&nbsp;&nbsp;
                                    <span  class="slideBoxafter">
                                                <?php echo lang('Waterstatus_tip'); ?>
                                            </span>
                                </td>
                            </tr>
                            
                            <tr class="row bset waterbox">
                                <td><?php echo lang('Watertype'); ?>: </td>
                                <td>
                                    <div class="row bset">
                                        <input name="watertype" type="radio" value="text" id="watertype_0" <?php if($data['watertype'] == 'text'): ?>checked<?php endif; if(!isset($data['watertype'])): ?>checked<?php endif; ?> />
                                        <label for="watertype_0" class="w110_r_0"><?php echo lang('Text'); ?></label>
                                        <input name="watertype" type="radio" value="image" id="watertype_1" <?php if($data['watertype'] == 'image'): ?>checked<?php endif; ?> />
                                        <label for="watertype_1" class="w110_r_0"><?php echo lang('Image'); ?></label>
                                    </div>
                                </td>
                            </tr>
                            
                            <tr class="waterbox">
                                <td id="watertypebox_text">
                                    <?php if(!isset($data['watertype'])): ?>
                                    <?php echo lang('Text'); else: if($data['watertype'] == 'text'): ?>
                                    <?php echo lang('Text'); else: ?>
                                    <?php echo lang('Image'); endif; endif; ?>
                                    :
                                </td>
                                <td id="watertypebox_input">
                                    <input value="<?php echo $data['watertype_txt']; ?>" type="text" name="watertype_txt" placeholder="<?php echo lang('Watertype_txt_pla'); ?>" />
                                    <a class="tooltip-icon" title="<?php echo lang('Watertype_txt_pla'); ?>"></a>
                                </td>
                            </tr>
                            
                            <tr class="waterfont" style="display: none;">
                                <td><?php echo lang('Waterfont'); ?>: </td>
                                <td>
                                    <input value="<?php echo (isset($data['waterfontsize']) && ($data['waterfontsize'] !== '')?$data['waterfontsize']:'18'); ?>" type="number" name="waterfontsize" placeholder="18" style="width: 50px; text-align: center;" />
                                    
                                    <?php echo lang('Waterfont_tip'); ?>
                                </td>
                            </tr>
                            
                            <tr class="waterbox">
                                <td><?php echo lang('Waterrule'); ?>: </td>
                                <td>
                                    <?php echo lang('Width'); ?>
                                    <input value="<?php echo (isset($data['waterwidth']) && ($data['waterwidth'] !== '')?$data['waterwidth']:'200'); ?>" type="number" name="waterwidth" placeholder="200" style="width: 60px; text-align: center;" />
                                    <span  class="slideBoxafter">px <?php echo lang('Height'); ?></span>
                                    <input value="<?php echo (isset($data['waterheight']) && ($data['waterheight'] !== '')?$data['waterheight']:'200'); ?>" type="number" name="waterheight" placeholder="200" style="width: 60px; text-align: center;" />
                                    <span  class="slideBoxafter">px</span>
                                    
                                    &nbsp;&nbsp;
                                    <?php echo lang('Waterrule_tip'); ?>
                                </td>
                            </tr>
                            
                            <tr class="waterbox">
                                <td><?php echo lang('Watertransparency'); ?>: </td>
                                <td>
                                    <input value="<?php echo (isset($data['watertransparency']) && ($data['watertransparency'] !== '')?$data['watertransparency']:75); ?>" type="hidden" name="watertransparency" />
                                    <div style="float: left; margin-right: 50px;">
                                        <div id="slider" style="width: 300px;">
                                            <div id="custom-handle" class="ui-slider-handle"></div>
                                        </div>
                                    </div>
                                    
                                    <?php echo lang('Watertransparency_tip'); ?>
                                
                                </td>
                            </tr>
                            
                            <tr class="waterbox">
                                <td><?php echo lang('Watermarkquality'); ?>: </td>
                                <td>
                                    <input value="<?php echo (isset($data['watermarkquality']) && ($data['watermarkquality'] !== '')?$data['watermarkquality']:60); ?>" type="hidden" name="watermarkquality" />
                                    <div style="float: left; margin-right: 50px;">
                                        <div id="slider0" style="width: 300px;">
                                            <div id="custom-handle0" class="ui-slider-handle"></div>
                                        </div>
                                    </div>
                                    
                                    <?php echo lang('Watermarkquality_tip'); ?>
                                
                                </td>
                            </tr>
                            
                            <tr class="waterbox">
                                <td><?php echo lang('Waterpostion'); ?>: </td>
                                <td>
                                    <div class="row bset" style="width: 290px;">
                                        <input name="waterpostion" type="radio" value="1" id="postion1" <?php if($data['waterpostion'] == '1'): ?>checked<?php endif; if(!isset($data['waterpostion'])): ?>checked<?php endif; ?> />
                                        <label for="postion1" class="w95_r_0"><?php echo lang('Waterpostion_1'); ?></label>
                                        <input name="waterpostion" type="radio" value="2" id="postion2" <?php if($data['waterpostion'] == '2'): ?>checked<?php endif; ?> />
                                        <label for="postion2" class="w95_r_0"><?php echo lang('Waterpostion_2'); ?></label>
                                        <input name="waterpostion" type="radio" value="3" id="postion3" <?php if($data['waterpostion'] == '3'): ?>checked<?php endif; ?> />
                                        <label for="postion3" class="w95_r_0"><?php echo lang('Waterpostion_3'); ?></label>
                                        
                                        <input name="waterpostion" type="radio" value="4" id="postion4" <?php if($data['waterpostion'] == '4'): ?>checked<?php endif; ?> />
                                        <label for="postion4" class="w95_r_0"><?php echo lang('Waterpostion_4'); ?></label>
                                        <input name="waterpostion" type="radio" value="5" id="postion5" <?php if($data['waterpostion'] == '5'): ?>checked<?php endif; ?> />
                                        <label for="postion5" class="w95_r_0"><?php echo lang('Waterpostion_5'); ?></label>
                                        <input name="waterpostion" type="radio" value="6" id="postion6" <?php if($data['waterpostion'] == '6'): ?>checked<?php endif; ?> />
                                        <label for="postion6" class="w95_r_0"><?php echo lang('Waterpostion_6'); ?></label>
                                        
                                        <input name="waterpostion" type="radio" value="7" id="postion7" <?php if($data['waterpostion'] == '7'): ?>checked<?php endif; ?> />
                                        <label for="postion7" class="w95_r_0"><?php echo lang('Waterpostion_7'); ?></label>
                                        <input name="waterpostion" type="radio" value="8" id="postion8" <?php if($data['waterpostion'] == '8'): ?>checked<?php endif; ?> />
                                        <label for="postion8" class="w95_r_0"><?php echo lang('Waterpostion_8'); ?></label>
                                        <input name="waterpostion" type="radio" value="9" id="postion9" <?php if($data['waterpostion'] == '9'): ?>checked<?php endif; ?> />
                                        <label for="postion9" class="w95_r_0"><?php echo lang('Waterpostion_9'); ?></label>
                                    </div>
                                </td>
                            </tr>
                            
                            </tbody>
                        </table>
                    </div>
                
                
                </div>
                
                <div class="buttons-wrapper" style="margin:15px 0 30px; padding:0 0 0 18%;">
                    <input name="submit" value="<?php echo lang('Savekernelconf'); ?>" type="submit" url="<?php echo url('save', array('act'=>ACTION_NAME)); ?>" />
                </div>
            </div>
        </form>
    </div>
</div>


    
<script charset="utf-8" src="__STATIC__/kindeditor/kindeditor-all-min.js"></script>
<script>
    $('#start_time').timepicker();
    $('#end_time').timepicker();
</script>
<script>
    $(function(){
        $(".bset").buttonset();

        //短信设置
        <?php if($data['sms'] == '1'): ?>$('.smsbox').show();<?php endif; ?>
        $('input[name=sms]').click(function(){
            var ischecked = $(this).is(":checked");
            if(ischecked){
                $('.smsbox').show().find('input').attr('disabled', false);
            }else{
                $('.smsbox').hide().find('input').attr('disabled', true);
            }
        })

        <?php if($data['water'] == '1'): ?>$('.waterbox').show();<?php endif; ?>
        $('#water').click(function(){
            var ischecked = $(this).is(":checked");
            if(ischecked){
                $('.waterbox').show().find('input').attr('disabled', false);
            }else{
                $('.waterbox').hide().find('input').attr('disabled', true);
            }
        });
        
        // 子域名
        <?php if($data['sub_domain_status'] == '1'): ?>$('.main_domain_box').show();<?php endif; ?>
        $('input[name=sub_domain_status]').click(function(){
            var val = $(this).val();
            if(val == 1){
                $('.main_domain_box').show();
            }else{
                $('.main_domain_box').hide();
            }
        });

        //短信验证码开关
        <?php if($data['vercode'] == '1'): ?>$('.vercodebox').show();<?php endif; ?>
        $('input[name=vercode]').click(function(){
            var val = $(this).val();
            if(val == 1){
                $('.vercodebox').show().find('input').attr('disabled', false);
            }else{
                $('.vercodebox').hide().find('input').attr('disabled', true);
            }
        });

        <?php if($data['watertype'] == 'text'): ?>
        $('.waterfont').show();
        <?php endif; if($data['watertype'] == 'image'): ?>
        $('#watertypebox_upload').show();
        $('input[name=watertype_txt]').attr('placeholder', '<?php echo lang('Watertype_img_pla'); ?>');
        <?php endif; ?>
        $('input[name=watertype]').click(function () {
            if($(this).val() == 'text') {
                $("#watertypebox_text").text('<?php echo lang('Text'); ?>');
                $('input[name=watertype_txt]').attr('placeholder', '<?php echo lang('Watertype_txt_pla'); ?>');
                $('#watertypebox_upload').hide();
                $('.waterfont').show();
            }else{
                $("#watertypebox_text").text('<?php echo lang('Image'); ?>');
                $('input[name=watertype_txt]').attr('placeholder', '<?php echo lang('Watertype_img_pla'); ?>');
                $('#watertypebox_upload').show();
                $('.waterfont').hide();
            }
        });

//            //发送测试
//            $('#send').click(function () {
//                var that = $(this);
//                var test_send_mail = $('#sendtest').val();
//                var emal_smtp = $('input[name=smtpaddr]').val();
//                var emal_port = $('input[name=emailport]').val();
//                var emal_send = $('input[name=sendaddr]').val();
//                var emal_emailsafe = $('input[name=emailsafe]').val();
//                var emal_username = $('input[name=emailusername]').val();
//                var emal_emailpwd = $('input[name=emailpwd]').val();
//                $.ajax({
//                    'url':"<?php echo url('email_test'); ?>",
//                    'type':'post',
//                    'data':{
//                        'content':test_send_mail,
//                        'smtpaddr'
//                    }
//                })
//            })

        //透明度拖动条
        var handle = $( "#custom-handle" );
        $( "#slider" ).slider({
                value: <?php echo (isset($data['watertransparency']) && ($data['watertransparency'] !== '')?$data['watertransparency']:75); ?>,
            create: function() {
            handle.text( $( this ).slider( "value" ) );
        },
        slide: function( event, ui ) {
            handle.text( ui.value );
            $('input[name=watertransparency]').val(ui.value);
        }
    });

        var handle0 = $( "#custom-handle0" );
        $( "#slider0" ).slider({
                value: <?php echo (isset($data['watermarkquality']) && ($data['watermarkquality'] !== '')?$data['watermarkquality']:60); ?>,
            create: function() {
            handle0.text( $( this ).slider( "value" ) );
        },
        slide: function( event, ui ) {
            handle0.text( ui.value );
            $('input[name=watermarkquality]').val(ui.value);
        }
    });
    })
</script>

    <!--<script type="text/javascript" src="//runtuer.com/liceson/check"></script>-->
</body>
</html>