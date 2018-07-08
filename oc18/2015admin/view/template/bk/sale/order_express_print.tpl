<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>
<meta charset="UTF-8" />
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<script type="text/javascript" src="view/javascript/jquery/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="view/javascript/jquery/ui/jquery-ui.min.js"></script>
<style type="text/css">
body, html{
	padding:0px;
	margin:0px;
	font-family:"黑体";
}
.express-wrap{
	padding:0px;
	margin:0px;
	position:relative;
	overflow:hidden;
}
.express-wrap p{
	position:absolute;
	padding:0px;
	margin:0px;
	font-size:11px;
	font-weight:bold;
	cursor:move;
}
.express-wrap textarea, .express-wrap input{
	width:100%;
	height:100%;
	padding:0px;
	margin:0px;
	font-size:11px;
	font-family:"黑体";
	border:1px #999 solid;
	background-color:#000;
	background-color:rgba(0,0,0,0.2);
}
.express-wrap span{
	position:relative;
	display:block;
	width:100%; height:100%;
}
.express-wrap span i{
	display:none;
	position:absolute;
	top:0px; left:-15px;
	width:15px; height:15px;
	line-height:15px;
	text-align:center;
	font-style:normal;
	font-size:12px;
	font-weight:normal;
	color:#FFF;
	background:#CC9966;
}
.express-wrap span:hover i{
	display:block;
}
</style>
</head>
<body>
<div class="express-wrap" style="<?php echo $style; ?>">
	<?php foreach ($value as $key => $v) { ?>
	<p style="width:<?php echo $v['width']; ?>px; height:<?php echo $v['height']; ?>px; left:<?php echo $v['left']; ?>px; top:<?php echo $v['top']; ?>px;">
		<span>
		<textarea
			id="<?php echo $key; ?>" style="<?php
			if(!empty($v['font_size'])) {
				echo 'font-size:'.$v['font_size'].'px;';
			}
			
			if(!empty($v['line_height'])) {
				echo 'line-height:'.$v['line_height'].'px;';
			}
			
			if(!empty($v['letter_spacing'])) {
				echo 'letter-spacing:'.$v['letter_spacing'].'px;';
			}
			
			echo 'font-weight:'.$v['font_weight'].';';
			?>"><?php echo $v['text']; ?></textarea>
		<i class="move">@</i>
		</span>
	</p>
	<?php } ?>
</div>

<style type="text/css" media="print">
#print{
	display:none;
}
.express-wrap{
	margin:0;
	margin-top:<?php echo $top; ?>px;
	margin-left:<?php echo $left; ?>px;
}
.express-wrap textarea, .express-wrap input{
	border:none;
	background-color:#000;
	background-color:rgba(0,0,0,0);
	resize:none;
	overflow:hidden;
}
</style>
<button id="print">开始打印</button>
<script type="text/javascript">
$('.express-wrap p').draggable({
	containment:".express-wrap"
});

$('#print').click(function(){
	window.print();
});
</script>
</body>
</html>