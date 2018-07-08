<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-latest" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1 style="display:block;"><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb" style="padding:0px;">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $heading_title; ?></h3>
      </div>
      <div class="panel-body">
<style type="text/css">
.logo{
	padding:20px;
}
.logo h1{
	color:#033A72;
	font-size:72px;
	font-weight:bold;
	font-family:Arial, Helvetica, sans-serif;
	text-align:center;
	margin:0px;
	margin-bottom:10px;
}
.logo .thanks{
	display:block;
	text-align:center;
	color:#999;
	font-family: "Hiragino Sans GB","Microsoft YaHei","微软雅黑",tahoma,arial,simsun,"宋体";
}
.otitle{
	padding-bottom:10px;
	margin-bottom:10px;
	border-bottom:1px #DDD dashed;
	font-size:13px;
	text-transform:uppercase;
	font-family: "Hiragino Sans GB","Microsoft YaHei","微软雅黑",tahoma,arial,simsun,"宋体";
}
.list{
	width:100%;
	margin-bottom:20px;
	border:1px #DDD solid;
	font-size:12px;
	font-family: "Hiragino Sans GB","Microsoft YaHei","微软雅黑",tahoma,arial,simsun,"宋体";
}
.list thead tr{}
.list td{
	padding:10px 15px;
}
.list thead td{
	background:#F3F3F3;
	font-size:13px;
	color:#000;
}
.list input[type=text]{
	width:30px;
	padding:5px;
	border:1px #DDD solid;
}
.list input.t{
	width:96%;
}
.btn_prev{
	display: inline-block;
	width: 0;
	height: 0;
	border-width: 6px;
	border-style: dashed;
	border-color: transparent;
	border-left-width: 0;
	border-right-color: #919191;
	border-right-style: solid;
	text-indent:-99999px;
}
.btn_next{
	display: inline-block;
	width: 0;
	height: 0;
	border-width: 6px;
	border-style: dashed;
	border-color: transparent;
	border-right-width: 0;
	border-left-color: #919191;
	border-left-style: solid;
	text-indent:-99999px;
}
.pages .left{
	float:left;
	clear:left;
}
.pages .right{
	float:right;
	clear:right;
}
.page-btn, .page-jump{
	display:inline-block;
}
.page-btn .links a, .page-btn .links b{
	margin-left:5px;
}
.page-btn .links a{
	border: 1px solid #DDDDDD;
	padding: 4px 10px;
	font-size: 12px;
	text-decoration: none;
	color: #A3A3A3;
}
.page-btn .links b{
	border: 1px solid #269BC6;
	padding: 4px 10px;
	font-size: 12px;
	font-weight: normal;
	text-decoration: none;
	color: #269BC6;
	background: #FFFFFF;
}
.page-jump{
	margin-left:10px;
}
.page-jump input{
	width:35px;
	border: 1px solid #DDDDDD;
	padding: 4px;
	margin-left:5px;
	-webkit-border-radius: 3px 3px 3px 3px;
	-moz-border-radius: 3px 3px 3px 3px;
	-khtml-border-radius: 3px 3px 3px 3px;
	border-radius: 3px 3px 3px 3px;
	background:#FFF;
	color:#999;
	cursor:pointer;
}
.page-jump input[type=button]:hover{
	background:#DDD;
	color:#FFF;
}
.page-del .remove{
	border: 1px solid #CC3366;
	padding: 4px;
	margin-left:5px;
	-webkit-border-radius: 3px 3px 3px 3px;
	-moz-border-radius: 3px 3px 3px 3px;
	-khtml-border-radius: 3px 3px 3px 3px;
	border-radius: 3px 3px 3px 3px;
	background:#CC0066;
	color:#FFF;
	text-decoration:none;
	font-size:11px;
	cursor:pointer;
}
</style>
	  <div class="logo">
	  	<h1>65.apps</h1>
		<span class="thanks">感谢使用本插件，如有问题请联系我的邮箱：330356741@qq.com</span>
		<span class="thanks">Thank you for use my login app, if have any question please contact my email: 330356741@qq.com</span>
	  </div>
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-latest" class="form-horizontal">
		<h2 class="otitle">oauth setting</h2>
	    <table class="list">
          <thead>
            <tr>
              <td class="text-left" width="20%"><?php echo $entry_name; ?></td>
              <td class="text-left" width="30%"><?php echo $entry_client_id; ?></td>
              <td class="text-left" width="30%"><?php echo $entry_client_secret; ?></td>
              <td class="text-right" width="10%"><?php echo $entry_sort_order; ?></td>
              <td class="text-right" width="10%"><?php echo $entry_status; ?></td>
            </tr>
          </thead>
		  <?php
			  $all_oauth = array(
			      'facebook',
			      'google',
			      'live',
			      'qq',
			      'weibo',
			      'baidu',
			  );
		  ?>
          <tbody>
		  	<?php foreach ($all_oauth as $tag) { ?>
            <tr>
              <td class="text-left"><?php echo $tag; ?></td>
              <td class="text-left"><input type="text" class="t" name="oauth[<?php echo $tag; ?>][client_id]" value="<?php echo isset($oauth[$tag])?$oauth[$tag]['client_id']:''; ?>" /></td>
              <td class="text-left"><input type="text" class="t" name="oauth[<?php echo $tag; ?>][client_secret]" value="<?php echo isset($oauth[$tag])?$oauth[$tag]['client_secret']:''; ?>" /></td>
              <td class="text-right"><input type="text" name="oauth[<?php echo $tag; ?>][sort]" value="<?php echo isset($oauth[$tag])?$oauth[$tag]['sort']:'0'; ?>" /></td>
              <td class="text-right"><select name="oauth[<?php echo $tag; ?>][status]">
								  <?php if ($oauth && $oauth[$tag]['status']) { ?>
								  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
								  <option value="0"><?php echo $text_disabled; ?></option>
								  <?php } else { ?>
								  <option value="1"><?php echo $text_enabled; ?></option>
								  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
								  <?php } ?>
								</select></td>
            </tr>
		  	<?php } ?>
          </tbody>
        </table>
        </form>
      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="delete">
		<?php if ($oauth_list) { ?>
	  	<h2 class="otitle">Customer List</h2>
	    <table class="list">
          <thead>
            <tr>
              <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('.list input[name*=\'selected\']').prop('checked', this.checked);" /></td>
              <td class="text-left"><?php echo $entry_c_nickname; ?></td>
              <td class="text-left"><?php echo $entry_name; ?></td>
              <td class="text-left"><?php echo $entry_c_email; ?></td>
              <td class="text-left"><?php echo $entry_c_name; ?></td>
              <td class="text-left"><?php echo $entry_c_openid; ?></td>
              <td class="text-right"><?php echo $entry_c_date; ?></td>
            </tr>
          </thead>
          <tbody id="list">
		    <?php foreach ($oauth_list as $list) { ?>
            <tr>
              <td class="text-left"><input type="checkbox" name="selected[]" value="<?php echo $list['oauth_id']; ?>" /></td>
              <td class="text-left"><?php echo $list['name']; ?></td>
              <td class="text-left"><?php echo $list['type']; ?></td>
              <td class="text-left"><a href="<?php echo $list['href']; ?>"><?php echo $list['email']; ?></a></td>
              <td class="text-left"><?php echo $list['firstname'].' '.$list['lastname']; ?></td>
              <td class="text-left"><?php echo $list['openid']; ?></td>
              <td class="text-right"><?php echo $list['date_added']; ?></td>
            </tr>
			<?php } ?>
          </tbody>
        </table>
		<div class="pages">
			<div class="text-left">
				<div class="page-del"><a onclick="Remove();" class="remove"><?php echo $button_remove; ?></a></div>
			</div>
			<div class="text-right">
				<div class="page-btn"><?php echo $pagination; ?></div>
				<div class="page-jump"><input type="text" value="1" id="jump" /><input type="button" value="GO" onclick="Jump($('#jump').val());" /></div>
			</div>
		</div>
		<?php } ?>
      </form>
      </div>
    </div>
  </div>
<script type="text/javascript"><!--
function Jump(page) {
	if (Number(page) <= <?php echo $maxpage; ?>) {
		show(page);
	} else {
		alert('<?php echo $error_jump; ?>');
	}
}

function Remove() {
	$.ajax({
		type: 'POST',
		url: '<?php echo $delete; ?>',
		data: $('#list input[type=\'checkbox\']:checked'),
		dataType: 'json',
		success: function(json) {
			if (!json['error']) {
				show(1);
			} else {
				alert(json['error']);
			}
		}
	});
}

function show(page) {
	$.ajax({
		type: 'GET',
		url: 'index.php?route=module/oauth/getlist&token=<?php echo $token; ?>',
		data: {'page':page},
		dataType: 'json',
		success: function(json) {
			if (!json['error']) {
				var html  = '';
				
				for (var i = 0; i < json['data'].length; i ++) {
					html += '<tr>';
					html += '  <td class="left"><input type="checkbox" name="selected[]" value="'+json['data'][i]['oauth_id']+'" /></td>';
					html += '  <td class="left">'+json['data'][i]['name']+'</td>';
					html += '  <td class="left">'+json['data'][i]['type']+'</td>';
					html += '  <td class="left"><a href="'+json['data'][i]['href']+'">'+json['data'][i]['email']+'</a></td>';
					html += '  <td class="left">'+json['data'][i]['firstname']+' '+json['data'][i]['lastname']+'</td>';
					html += '  <td class="right">'+json['data'][i]['openid']+'</td>';
					html += '  <td class="right">'+json['data'][i]['date_added']+'</td>';
					html += '</tr>';
				}
				
				$('#list').html(html);
				$('.page-btn').html(json['pagination']);
			} else {
				// 输出错误
				alert(json['error']);
			}
		}
	});
}
//--></script>
<?php echo $footer; ?>