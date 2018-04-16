<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:70:"D:\git\my\tp5shop\public/../site/install/view/pc/default/index\s2.html";i:1507549953;s:74:"D:\git\my\tp5shop\public/../site/install/view/pc/default/index\header.html";i:1507723607;}*/ ?>
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
		$("input[type='text']").addClass("input_blur").mouseover(function(){ $(this).addClass("input_focus");}).mouseout(function(){$(this).removeClass("input_focus");});
		$(".table tr").mouseover(function(){ $(this).addClass("mouseover");}).mouseout(function(){$(this).removeClass("mouseover");	});
	});
</script>

<div class="right">
	<h2>Step <?php echo $step; ?> of 5 </h2>
	<h1>服务器信息</h1>	
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
		<tr>
			<th width="300" align="left"><strong>参数</strong></th>
			<th width="424" align="left"><strong>值</strong></th>
		</tr>
		<tr>
				<td><strong>服务器域名/IP地址</strong></td>
				<td><?php echo $name."/".$host; ?></td>
		</tr>
		<tr>
				<td><strong>服务器操作系统</strong></td>
				<td><?php echo $os; ?></td>
		</tr>
		<tr>
				<td><strong>服务器解译引擎</strong></td>
				<td><?php echo $server; ?></td>
		</tr>
		<tr>
				<td><strong>PHP版本</strong></td>
				<td><?php echo $phpv; ?></td>
		</tr>
		<tr>
				<td><strong>安装路径</strong></td>
				<td><?php echo ROOT_PATH; ?></td>
		</tr>
		<tr>
				<td><strong>脚本超时时间</strong></td>
				<td><?php echo $max_execution_time; ?> 秒</td>
		</tr>

	</table>
	<h1>系统环境要求</h1> 
	
	<table width="100%" border="0" align="center" cellpadding="2" cellspacing="0" class="table">
		<tr>
			<th width="230"><strong>需开启的变量或函数</strong></th>
			<th width="100"><strong>系统要求</strong></th>
			<th width="400"><strong>实际状态及建议</strong></th>
		</tr>
		<tr>
				<td>GD 支持 </td>
				<td>支持</td>
				<td><?php echo $gd; ?></td>
		</tr>
		<tr>
				<td>MySQL 支持</td>
				<td>支持</td>
				<td><?php echo $mysql; ?></td>
		</tr>

		<tr> 
			<td>upload</td>
			<td>支持</td>
			<td><?php echo $uploadSize ?></td>
			</tr>


		<tr>
		  <td>session</td>
		  <td>支持</td>
		  <td><?php echo $session ?></td>
		</tr>


 

	</table>
	<h1>目录权限检测</h1> 
	<div style="margin:10px auto; color:#666;">
	系统要求必须满足下列所有的目录权限全部可读写的需求才能使用。</div>
	
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
		<tr>
			<th width="230"><strong>目录名</strong></th>
			<th width="100"><strong>系统要求</strong></th>
			<th width="400"><strong>实际状态及建议</strong></th>
		</tr>
		<?php
		foreach($folder as $dir)
		{
			$Testdir = ROOT_PATH.$dir;
			if(TestWrite($Testdir)){
				$w = '<font color=green>[√]写</font>';
			}else{
                if(is_writable($Testdir)){
                    $w = '<font color=green>[√]写</font>';
                } else {
                    $w = '<font color=red>[×]写</font>';
                    $err++;
                }
			}
			if(is_readable($Testdir)){
				$r = '<font color=green>[√]读</font>' ;
			}else{
                if(is_writable($Testdir)){
                $w = '<font color=green>[√]写</font>';
                } else {
                $w = '<font color=red>[×]写</font>';
                $err++;
                }
			}
		?>
		<tr>
		  <td><?php echo $dir; ?></td>
		  <td>读写</td>
		  <td><?php echo $r." ".$w; ?></td>
		</tr>
		<?php } ?>
	</table>


	<div class="butbox">
		<input type="button" class="inputButton" value=" 上一步 " onclick="history.back();" style="margin-right:20px" />		
		<input type="button" class="inputButton" value=" 下一步 " onclick="window.location.href='<?php echo url("s3",['step'=>3]); ?>';" <?php if($err>0){ ?> id="nonext"  disabled<?php } ?>  />
		<input type="button" class="inputButton" value=" 重新检测 " onclick="document.location.reload();" style="margin-left:20px" />
	</div>
</div>



        </div>
    </div>
</div>
</body>
</html>