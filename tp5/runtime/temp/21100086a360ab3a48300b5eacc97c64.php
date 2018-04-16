<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:70:"D:\git\my\tp5shop\public/../site/install/view/pc/default/index\s3.html";i:1507549953;s:74:"D:\git\my\tp5shop\public/../site/install/view/pc/default/index\header.html";i:1507723607;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $steps[$step];?> - Runtue ETshop v1.0正式版 - 安装向导</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script src="__STATIC__/js/jquery-1.9.1.min.js" language="javascript" type="text/javascript"></script>
    <script src="__PUBLIC__/install/pc/default/js/jquery.form.js" language="javascript" type="text/javascript"></script>
    <script src="__STATIC__/jquery-validation-1.13.1/dist/jquery.validate.js" language="javascript"
            type="text/javascript"></script>
    <link href="__PUBLIC__/install/pc/default/css/style.css" rel="stylesheet" type="text/css"/>
    <script src="__STATIC__/layer-v3.0.3/layer.js"></script>
</head>
<body>
<!--<div class="top">
    <div class="top_box"><b>Runtue ETshop v1.0 正式版</b></div>
    <div class="top_foot"></div>
</div>-->

<div class="main">
    <h5>感谢您选择Runtue ETshop 电商系统</h5>
    
    <div class="title">
        <ul>
            <?php  foreach($steps as $key=>$res){ ?>
            <li
            <?php if($step==$key):?> class="on"<?php endif;?> ><?php echo $res?></li>
            <?php } ?>
        </ul>
    </div>
    
    <div class="box">
        <div class="b1">
            
            <div class="left">
                <div class="step_nav">
                    <h2>系统简介</h2>
                    <ul>
                        <li>1.PHP7+MYSQL5.6以上版本</li>
                        <li>2.核心采用了Thinkphp5框架</li>
                        <li>3.集众多开源项目于一身</li>
                        <li>4.安全,高效率,易用及可扩展</li>
                        <li>5.程序内置SEO优化机制</li>
                        <li>6.静态页面生成功能</li>
                        <li>7.自定义模型及插件功能</li>
                    </ul>
                </div>
            </div>
            
<script language="javascript" type="text/javascript">
    $(document).ready(function(){
        $('#dbPwd').blur();
        $(".table tr").each(function(){ $(this).children("td").eq(0).addClass("on");});
        $("input[type='text']").addClass("input_blur").mouseover(function(){ $(this).addClass("input_focus");}).mouseout(function(){$(this).removeClass("input_focus");});
        $(".table tr").mouseover(function(){ $(this).addClass("mouseover");}).mouseout(function(){$(this).removeClass("mouseover");	});
        $('#dosubmit').click(function () {
            var url = "<?php echo url('install/index/create_data'); ?>";
            var data=$('#myform').serialize();
            $.post(url,data,function (res) {
                if (res.code) {
                    window.location.href=res.url;
                } else {
                    layer.msg(res.msg,{icon:2,time:2000});
                }
            },'json')
        })
    });
    $.ajaxSetup ({ cache: false });
    function TestDbPwd()
    {
        var dbHost = $('#dbHost').val();
        var dbUser = $('#dbUser').val();
        var dbPwd = $('#dbPwd').val();
        var dbName = $('#dbName').val();
        var dbPort = $('#dbPort').val();
        data={'dbHost':dbHost,'dbUser':dbUser,'dbPwd':dbPwd,'dbName':dbName,'dbPort':dbPort};
        var url = "<?php echo url('install/index/s3','step=3&testdbpwd=1'); ?>";
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            beforeSend:function(){
            },
            success: function(msg){
                if(msg){
                    $('#pwd_msg').html("数据库配置正确");
                    $('#dosubmit').attr("disabled",false);
                    $('#dosubmit').removeAttr("disabled");
                    $('#dosubmit').removeClass("nonext");
                }else{
                    $('#dosubmit').attr("disabled",true);
                    $('#dosubmit').addClass("nonext");
                    $('#pwd_msg').html("数据库链接配置失败");
                }
            },
            complete:function(){
            },
            error:function(){
                $('#pwd_msg').html("数据库链接配置失败");
            }
        });
    }
    TestDbPwd();
    
</script>
<div class="right">
	<h2>Step <?php echo $step;?> of 5 </h2>
	<h1>数据库设定</h1>
<form id="myform" action="<?php echo url('create_data'); ?>" method="post" onsubmit="return false">
	<table   border="0" align="center" cellpadding="0" cellspacing="0" class="table">
		<tr>
            <td width="170"><strong>网站类型</strong></td>
            <td width="410"><input type="radio" name="lang" value="1"  checked /> 多语网站 &nbsp;<input type="radio" name="lang" value="0" /> 单语网站 </td>
        </tr>
    
        <tr>
            <td width="170"><strong>数据库主机：</strong></td>
            <td width="410"><input name="dbHost" type="text" id="dbHost" value="localhost" size="30" />
            <small>(一般为localhost)</small></td>
        </tr>
        <tr>
          <td><strong>数据库端口：</strong></td>
          <td><input name="dbPort" type="text" id="dbPort" value="3306" size="10" /></td>
        </tr>
        <tr>
            <td><strong>数据库名称：</strong></td>
            <td>
                <input name="dbName" type="text" id="dbName" value="runtuer" size="20" />
			</td>
        </tr>
	    <tr>
            <td><strong>数据库用户：</strong></td>
            <td><input name="dbUser" type="text" id="dbUser" value="root" size="20" /></td>
        </tr>
        <tr>
            <td><strong>数据库密码：</strong></td>
            <td>
            <input name="dbPwd" type="text" id="dbPwd" size="20" value="root"  onblur="TestDbPwd()" />
            <span id='pwd_msg'></span>            </td>
        </tr>
        <tr>
            <td><strong>数据表前缀：</strong></td>
            <td><input name="dbPrefix" type="text" id="dbPrefix" value="rt_" size="20" />
                    <small>(如无特殊需要,请不要修改)</small></td>
        </tr>
	</table>
	
	<h1>管理员帐号</h1>
	<table   border="0" align="center" cellpadding="0" cellspacing="0" class="table">
		
        <tr>
            <td width="170"><strong>用户名：</strong></td>
            <td width="410">
                <input name="username" type="text" id="username" value="admin" size="20"  validate=" required:true, minlength:5, maxlength:80,"  title="标题必填5-20个字"  />
            </td>
        </tr>
        <tr>
            <td><strong>密　码：</strong></td>
            <td><input name="password" type="password"  style="padding:4px" id="password" value="" size="20"  validate=" required:true, minlength:5, maxlength:80,"  title="标题必填5-20个字"  /></td>
        </tr>
        
        <!--<tr>-->
            <!--<td><strong>后台路径：</strong></td>-->
            <!--<td><input name="admin_url" type="text" disabled id="admin_url"  style="padding:4px"  title="路径必填1-20个字" value="admin" size="15" readonly  validate=" required:true, minlength:1, maxlength:60,"  /></td>-->
        <!--</tr>-->
        <!--<tr>-->
            <!--<td><strong>后台语言：</strong></td>-->
            <!--<td>-->
            <!--<select name="admin_lang" disabled>-->
              <!--<option value="zh-cn" selected>简体中文 Simplified Chinese</option>-->
              <!--<option value="en">英语 - English</option>-->
              <!--<option value="es">西班牙语 - España</option>-->
            <!--</select>-->
            <!--</td>-->
        <!--</tr>-->
	</table>
	<!--<h1>其他设置</h1>-->
	<!--<table  border="0" align="center" cellpadding="0" cellspacing="0" class="table">-->
        <!--<tr>-->
            <!--<td width="170"><strong>网站名称：</strong></td>-->
            <!--<td width="410">-->
                <!--<input name="site_name" type="text" id="site_name" value="ETshop 跨境电商系统" size="30" />-->
            <!--</td>-->
        <!--</tr>-->
        <!--<tr>-->
            <!--<td><strong> 网站域名：</strong></td>-->
            <!--<td><input name="site_url" type="text" value="http://<?php echo $domain ?>" id="site_url" size="30" /></td>-->
        <!--</tr>-->
        <!--<tr>-->
            <!--<td><strong>关键词(keywords)：</strong></td>-->
            <!--<td>-->
                <!--<input name="seo_keywords" type="text" id="seo_keywords" value="ETshop 跨境电商系统" size="30" />-->
            <!--</td>-->
        <!--</tr>-->
        <!--<tr>-->
            <!--<td><strong> 描述(description)：</strong></td>-->
            <!--<td><textarea id="seo_description" name="seo_description" rows="5" cols="60" size="30">ETshop 跨境电商系统,是一款完全开源免费的PHP+MYSQL系统.核心采用了Thinkphp5框架等众多开源软件,同时核心功能也作为开源软件发布</textarea></td>-->
        <!--</tr>-->
        <!--<tr>-->
            <!--<td><strong>管理员邮箱：</strong></td>-->
            <!--<td><input name="site_email" type="text" id="site_email" value="admin@runtuer.com" size="30" /></td>-->
        <!--</tr>-->
	<!--</table>-->
 
	<div class="butbox">
		<input type="button" class="inputButton" value=" 上一步 " onclick="history.back();" style="margin-right:20px" />
		<input type="submit" class="inputButton nonext" id="dosubmit" value="下一步"/>
	</div>
	</form>
</div>

        </div>
    </div>
</div>
</body>
</html>