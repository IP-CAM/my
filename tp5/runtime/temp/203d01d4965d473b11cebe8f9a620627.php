<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:66:"D:\git\my\tp5\public/../site/crossbbcg/view/admin\config\sync.html";i:1500622431;s:56:"D:\git\my\tp5\public/../site/admin\view\public\base.html";i:1506158164;s:56:"D:\git\my\tp5\public/../site/admin\view\public\navs.html";i:1503361789;s:56:"D:\git\my\tp5\public/../site/admin\view\public\lang.html";i:1503361789;}*/ ?>
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
                
                <div class="alert alert-success">
                    <button class="close" type="button">&times;</button>
                    <span class="alert-content"><?php echo lang('Snycconfig tip'); ?></span>
                </div>
                
                <div class="bloc" id="blocStatistics">
                    <!--<div class="title collapsible">-->
                    <div class="title">
                        <div class="tabs static pot" id="blockStatistics">
                            <ul>
                                <a id="tabStat1_link" href="#tabStat1">
                                    <li><?php echo lang('Omssync'); ?></li>
                                </a>
                                <a id="tabStat2_link" href="#tabStat2">
                                    <li><?php echo lang('Deliverysync'); ?></li>
                                </a>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="content" style="padding-bottom: 20px;">
                        <div id="tabStat1" style="display:block;">
                            <table class="table kright">
                                <tbody>
                                <tr>
                                    <td><?php echo lang('Omsstatus'); ?>: </td>
                                    <td>
                                        <div class="slideBox" >
                                            <input id="omsstatus" value="1" type="checkbox" name="omsstatus"  <?php if($data['omsstatus'] == '1'): ?>checked<?php endif; ?> />
                                            <label for="omsstatus"></label>
                                        </div> &nbsp;
                                        <span class="slideBoxafter">
                                            <?php echo lang('Omsstatus tip'); ?>
                                        </span>
                                    </td>
                                </tr>

                                <tr class="omsbox" style="display: none ;">
                                    <td><?php echo lang('Omsgeturl'); ?>: </td>
                                    <td>
                                        <input name="omsgeturl" value="<?php echo (isset($data['omsgeturl']) && ($data['omsgeturl'] !== '')?$data['omsgeturl']:url('api.sync.oms/index', '', true, true)); ?>" type="text" class="input" placeholder="http://" style="width: 56%;" />
                                        <?php echo lang('omsgeturl tip'); ?>
                                    </td>
                                </tr>

                                <tr class="row bset omsbox" style="display: none ;">
                                    <td><?php echo lang('Oms sync type'); ?>: </td>
                                    <td>
                                        <div class="row bset">
                                            <input name="omsorder" type="radio" value="order" id="omsorder_0" <?php if($data['omsorder'] == '1'): ?>checked<?php endif; if(!isset($data['omstype'])): ?>checked<?php endif; ?> />
                                            <label for="omsorder_0" class="w150_r_0"><?php echo lang('Order to Oms'); ?></label>
                                            <input name="omsgoods" type="radio" value="1" id="omsgoods_1" <?php if($data['omsgoods'] == '1'): ?>checked<?php endif; ?> />
                                            <label for="omsgoods_1" class="w150_r_0"><?php echo lang('Goods to Oms'); ?></label>
                                        </div>
                                    </td>
                                </tr>
                                
                                <tr class="omsbox" style="display: none ;">
                                    <td><?php echo lang('Omspushurl'); ?>: </td>
                                    <td>
                                        <input name="omspushurl" value="<?php echo (isset($data['omspushurl']) && ($data['omspushurl'] !== '')?$data['omspushurl']:url('oms/api.sync.index/index', '', true, true)); ?>" type="text" class="input" placeholder="http://" style="width: 50%;" />
                                        <?php echo lang('omspushurl tip'); ?>
                                    </td>
                                </tr>

                                <tr class="omsbox" style="display: none ;">
                                    <td>Appid: </td>
                                    <td>
                                        <input name="omsappid" value="<?php echo $data['omsappid']; ?>" type="text" class="input" placeholder="RT BBC" />
                                    </td>
                                </tr>

                                <tr class="omsbox" style="display: none ;">
                                    <td>Appkey: </td>
                                    <td>
                                        <input name="omskey" value="<?php echo $data['omskey']; ?>" type="text" class="input" placeholder="<?php echo generate_prefix(10); ?>" />
                                    </td>
                                </tr>

                                <tr class="omsbox" style="display: none ;">
                                    <td>App Secret: </td>
                                    <td>
                                        <input name="omssecret" value="<?php echo $data['omssecret']; ?>" type="text" class="input" placeholder="<?php echo generate_prefix(32); ?>" />
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
    
                        <div id="tabStat2">
                            <table class="table kright">
                                <tbody>
                                <tr>
                                    <td><?php echo lang('Deliverystatus'); ?>: </td>
                                    <td>
                                        <div class="slideBox" >
                                            <input id="deliverystatus" value="1" type="checkbox" name="deliverystatus"  <?php if($data['deliverystatus'] == '1'): ?>checked<?php endif; ?> />
                                            <label for="deliverystatus"></label>
                                        </div> &nbsp;
                                    </td>
                                </tr>
                                <tr id="deliverybox" style="display: none ;">
                                    <td><?php echo lang('Deliveryclass'); ?>: </td>
                                    <td>
                                        <input name="deliveryclass" value="<?php echo $data['deliveryclass']; ?>" type="text" class="input" placeholder="<?php echo lang('Deliveryclass_pla'); ?>" style="width: 60%;" />
                                        <a class="tooltip-icon" title="<?php echo lang('Deliveryclass_tip'); ?>"></a>
                                        &nbsp;&nbsp;
                    
                                        <select id="omses" style="width: 20%;">
                                            <option value=""><?php echo lang('Please_choose'); ?></option>
                                            <?php foreach(get_extend_type('deliverys') as $vo): ?>
                                            <option value="<?php echo $vo['code']; ?>" data-tip="<?php echo lang($vo['description']); ?>" <?php if($data['vercodeclass'] == $vo['code']): ?>selected<?php endif; ?>><?php echo lang($vo['name']); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                </tr>
            
                                <tr>
                                    <td><?php echo lang('Synctime'); ?>:  </td>
                                    <td>
                                        <input name="synctime" type="number" placeholder="3" style="width: 60px; text-align: center;" value="<?php echo (isset($data['synctime']) && ($data['synctime'] !== '')?$data['synctime']:3); ?>" />
                                        <?php echo lang('Synctime_tip'); ?>
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
    

    
    <script>
        $(function(){
            $(".bset").buttonset();
    
            //OMS同步接口
            <?php if(!(empty($data['omsstatus']) || (($data['omsstatus'] instanceof \think\Collection || $data['omsstatus'] instanceof \think\Paginator ) && $data['omsstatus']->isEmpty()))): ?>$('.omsbox').show();<?php endif; ?>
            $('#omsstatus').click(function(){
                var ischecked = $(this).is(":checked");
                if(ischecked){
                    $('.omsbox').show();
                    $('input[name=omsclass]').attr('disabled', false);
                }else{
                    $('.omsbox').hide();
                    $('input[name=omsclass]').attr('disabled', true);
                }
            })
        })
    </script>
    
    <!--<script type="text/javascript" src="//runtuer.com/liceson/check"></script>-->
</body>
</html>