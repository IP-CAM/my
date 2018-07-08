<?php echo $header; ?>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
	<style type="text/css">
		.oauth_login, .oauth_info{
			border:1px #DDD solid; padding:15px; margin-bottom:20px;
			font-family:"Hiragino Sans GB","Hiragino Sans GB W3","Microsoft YaHei","微软雅黑",tahoma,arial,simhei,"黑体";
			color:#666;
			background:#FFF;
			overflow:hidden;
		}
		.oauth_login h2, .oauth_info h2{
			font-size:12px;
			color:#666;
			padding:0px;
			margin:0px;
			margin-bottom:10px;
		}
		.oauth_info h2{
			margin-bottom:5px;
		}
		.oauth_login input[type='text'], .oauth_login input[type='password'], .oauth_login select{
			font-family:"Hiragino Sans GB","Hiragino Sans GB W3","Microsoft YaHei","微软雅黑",tahoma,arial,simhei,"黑体";
			width:150px;
			border:1px #DDD solid;
			padding:5px;
		}
		.oauth_login select{
			width:160px;
			border:1px #DDD solid;
			padding:5px;
		}
		
		/* oauth info */
		.oauth_info .face{
			float:left;
			width:64px;
			height:64px;
		}
		.oauth_info .face img{
			width:64px;
			height:auto;
			-webkit-border-radius: 7px 7px 7px 7px;
			-moz-border-radius: 7px 7px 7px 7px;
			-khtml-border-radius: 7px 7px 7px 7px;
			border-radius: 7px 7px 7px 7px;
		}
		.oauth_info .info{
			margin-left:84px;
		}
		.oauth_info .info span{
			display:inline-block;
			margin-bottom:5px;
		}
		
		/* oauth login */
		.oauth_login input[type='radio'], .oauth_login input[type='checkbox']{
			padding:0px;
			margin:0px;
		}
		.oauth_login .left{
			float:left;
			width:48%;
			border-right:1px #EEE solid;
			padding-right:15px;
		}
		.oauth_login .right{
			float:right;
			width:48%;
		}
		.oauth_login .required{
			color:#FF0033;
		}
		.oauth_login ul{
			padding:0px;
			margin:0px;
			margin-bottom:20px;
			list-style:none;
		}
		.bt{
			padding:5px 0px;
			border-bottom:1px #DDD dotted;
		}
		.pt{
			padding:7px 0px;
			border-top:1px #DDD dotted;
			border-bottom:1px #DDD dotted;
		}
		.rt{
			text-align:right;
		}
		.oauth_login ul li{
			margin-bottom:6px;
		}
		.oauth_login ul li a{
			font-size:12px;
			color:#999;
			text-decoration:none;
		}
		.oauth_login ul li .error{
			display:inline-block;
		}
		.oauth_login .t{
			display:inline-block;
			width:100px;
			margin-right:10px;
			text-align:right;
			text-transform:capitalize;
		}
	</style>
      
	    <div class="oauth_info">
	<div class="face"><img src="<?php echo $info['face']; ?>" /></div>
	<div class="info">
		<h2><?php echo $text_user_hello; ?></h2>
		<span><?php echo $text_user_tip; ?></span><br />
		<span><?php echo $entry_type; ?> <?php echo $info['tag']; ?></span>
	</div>
  </div>
  
  <div class="oauth_login">
    <div class="left spr">
    <form action="<?php echo $action_register; ?>" method="post" enctype="multipart/form-data">
	  <ul>
	    <!-- Details -->
		<li class="bt"><?php echo $text_your_details; ?></li>
		<li><span class="t"><span class="required">*</span> <?php echo $entry_lastname; ?></span><span class="i"><input type="text" name="lastname" /></span></li>
		<?php if ($error_lastname) { ?>
        <li class="rt"><span class="error"><?php echo $error_lastname; ?></span></li>
        <?php } ?>
		<li><span class="t"><span class="required">*</span> <?php echo $entry_email; ?></span><span class="i"><input type="text" name="email" /></span></li>
		<?php if ($error_email) { ?>
        <li class="rt"><span class="error"><?php echo $error_email; ?></span></li>
        <?php } ?>
		
		
		<li><span class="t"><span class="required">*</span> <?php echo $entry_password; ?></span><span class="i"><input type="password" name="password" /></span></li>
		<?php if ($error_password) { ?>
        <li class="rt"><span class="error"><?php echo $error_password; ?></span></li>
        <?php } ?>
		<li><span class="t"><span class="required">*</span> <?php echo $entry_confirm; ?></span><span class="i"><input type="password" name="confirm" /></span></li>
		<?php if ($error_confirm) { ?>
        <li class="rt"><span class="error"><?php echo $error_confirm; ?></span></li>
        <?php } ?>
		<li><span class="t"></span><span class="i"><input type="submit" value="<?php echo $button_register; ?>" class="btn btn-outline" /></span></li>
	  </ul>
	</form>
	</div>
    <div class="right">
    <form action="<?php echo $action_login; ?>" method="post" enctype="multipart/form-data">
	  <ul>
		<li class="bt"><?php echo $text_your_login; ?></li>
		<li><span class="t"><span class="required">*</span> <?php echo $entry_email; ?></span><span class="i"><input type="text" name="email" /></span></li>
		<li><span class="t"><span class="required">*</span> <?php echo $entry_password; ?></span><span class="i"><input type="password" name="password" /></span></li>
		<?php if ($error_login) { ?>
        <li class="rt"><span class="error"><?php echo $error_login; ?></span></li>
        <?php } ?>
		<li><span class="t"></span><span class="i"><a href="<?php echo $forgotten; ?>" target="_blank"><?php echo $text_forgotten; ?></a></span></li>
		<li><span class="t"></span><span class="i"><input type="submit" value="<?php echo $button_login; ?>" class="btn btn-outline" /></span></li>
	  </ul>
	</form>
	</div>
  </div>
	  
	  
	  
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?> 
