<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-banner" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
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
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-banner" class="form-horizontal">
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?></label>
            <div class="col-sm-10">
              <input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
              <?php if ($error_name) { ?>
              <div class="text-danger"><?php echo $error_name; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-printer"><span data-toggle="tooltip" title="用于自动打印，请对应电脑本地打印机名称">打印机名称</span></label>
            <div class="col-sm-10">
              <input type="text" name="printer" value="<?php echo $printer; ?>" placeholder="打印机名称" id="input-printer" class="form-control" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-papersize"><span data-toggle="tooltip" title="用于自动打印，请对应电脑本地的纸张规格">纸张规格</span></label>
            <div class="col-sm-10">
              <input type="text" name="papersize" value="<?php echo $papersize; ?>" placeholder="纸张规格" id="input-papersize" class="form-control" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">匹配：</label>
            <div class="col-sm-10">
				<div class="form-group">
					<div class="col-sm-3">
						<select class="form-control" id="order-status">
							<?php foreach ($order_status as $status) { ?>
							<option value="<?php echo $status['order_status_id']; ?>"><?php echo $status['name']; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-sm-3">
						<select class="form-control" id="order-shipping">
							<?php foreach ($shipping_methods as $method) { ?>
							<option value="<?php echo $method['code']; ?>"><?php echo $method['name']; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-sm-2"><a class="btn btn-primary" id="add">确认添加</a></div>
				</div>
				<div class="col-sm-8 well well-sm" id="order-area">
					<?php foreach ($shippings as $s) { ?>
					<div col="<?php echo $s['order_status_id'].'|||'.$s['shipping_code']; ?>"><i class="fa fa-minus-circle" onclick="$(this).parent().remove();"></i> <?php echo $s['text']; ?><input type="hidden" name="shippings[]" value="<?php echo $s['order_status_id'].'|||'.$s['shipping_code'].'|||'.$s['text']; ?>" /></div>
					<?php } ?>
				</div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_image; ?></label>
            <div class="col-sm-10">
              <a onclick="manager();" class="btn btn-primary"><?php echo $text_change; ?></a>
			  <input type="hidden" name="image" id="image-input" value="<?php echo $image; ?>" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-name">大小：</label>
            <div class="col-sm-10">
              <div class="input-group pull-left" style="margin-right:15px;">
				  <label class="input-label">宽 mm</label>
			  	  <input type="text" name="width" id="image-width" value="<?php echo $width; ?>" placeholder="<?php echo $entry_width; ?>" class="form-control" />
			  </div>
              <div class="input-group pull-left" style="margin-right:15px;">
				  <label class="input-label">高 mm</label>
			 	  <input type="text" name="height" id="image-height" value="<?php echo $height; ?>" placeholder="<?php echo $entry_height; ?>" class="form-control" />
			  </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-name">偏移：</label>
            <div class="col-sm-10">
              <div class="input-group pull-left" style="margin-right:15px;">
				  <label class="input-label">上偏移</label>
				  <input type="text" name="top" value="<?php echo $top; ?>" placeholder="上偏移" class="form-control" />
			  </div>
              <div class="input-group pull-left" style="margin-right:15px;">
				  <label class="input-label">左偏移</label>
				  <input type="text" name="left" value="<?php echo $left; ?>" placeholder="左偏移" class="form-control" />
			  </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_data; ?></label>
		  	<style type="text/css">
			.data-box{
				padding-top:9px;
			}
			.data-box a{
				display:inline-block;
				padding:2px 5px;
				margin-right:10px;
				margin-bottom:10px;
				color:#333;
				border:1px #DDD solid;
			}
			.data-box i{
				display:block;
				clear:both;
			}
			</style>
            <div class="col-sm-10 data-box">
              <a href="" data="ship_name"><?php echo $value_ship_name; ?></a>
              <a href="" data="ship_country"><?php echo $value_ship_country; ?></a>
              <a href="" data="ship_address"><?php echo $value_ship_address; ?></a>
              <a href="" data="ship_postcode"><?php echo $value_ship_postcode; ?></a>
              <a href="" data="ship_telphone"><?php echo $value_ship_telphone; ?></a>
			  <i></i>
              <a href="" data="dly_name"><?php echo $value_dly_name; ?></a>
              <a href="" data="dly_country"><?php echo $value_dly_country; ?></a>
              <a href="" data="dly_address"><?php echo $value_dly_address; ?></a>
              <a href="" data="dly_postcode"><?php echo $value_dly_postcode; ?></a>
              <a href="" data="dly_telphone"><?php echo $value_dly_telphone; ?></a>
			  <i></i>
              <a href="" data="order_id"><?php echo $value_order_id; ?></a>
              <a href="" data="order_weight"><?php echo $value_order_weight; ?></a>
              <a href="" data="order_total"><?php echo $value_order_total; ?></a>
              <a href="" data="order_total_number"><?php echo $value_order_total_number; ?></a>
              <a href="" data="order_currency"><?php echo $value_order_currency; ?></a>
              <a href="" data="order_qty"><?php echo $value_order_qty; ?></a>
              <a href="" data="order_comment"><?php echo $value_order_comment; ?></a>
			  <i></i>
              <a href="" data="date_year"><?php echo $value_date_year; ?></a>
              <a href="" data="date_month"><?php echo $value_date_month; ?></a>
              <a href="" data="date_day"><?php echo $value_date_day; ?></a>
              <a href="" data="date_time"><?php echo $value_date_time; ?></a>
			  <i></i>
              <a href="" data="store_name"><?php echo $value_store_name; ?></a>
              <a href="" data="store_url"><?php echo $value_store_url; ?></a>
              <a href="" data="tick"><?php echo $value_tick; ?></a>
              <a href="" data="custom"><?php echo $value_custom; ?></a>
			  <i></i>
			  <div class="input-group pull-left" style="margin-right:15px;">
			    <label class="input-label">字体大小：</label>
				<select class="form-control" onchange="$('#draggable .active').find('input[rel=\'font_size\']').val($(this).val()); $('#draggable .active').css('font-size', $(this).val()+'px'); $('#draggable .active textarea').css('font-size', $(this).val()+'px').css('line-height', $(this).val()+'px');">
			    <?php for($i=11; $i <= 36; $i++) { ?>
			    <option value="<?php echo $i; ?>"><?php echo $i; ?>px</option>
			    <?php } ?>
			  </select></div>
			  <div class="input-group pull-left" style="margin-right:15px;">
			    <label class="input-label">文字间距：</label>
				<select class="form-control" onchange="$('#draggable .active').find('input[rel=\'letter_spacing\']').val($(this).val()); $('#draggable .active').css('letter-spacing', $(this).val()+'px'); $('#draggable .active textarea').css('letter-spacing', $(this).val()+'px');">
			    <?php for($i=-6; $i <= 30; $i++) { ?>
			    <option value="<?php echo $i; ?>" <?php echo ($i==0)?'selected="selected"':''; ?>><?php echo $i; ?>px</option>
			    <?php } ?>
			  </select></div>
			  <div class="input-group pull-left" style="margin-right:15px;">
			    <label class="input-label">文字行距：</label>
				<select class="form-control" onchange="$('#draggable .active').find('input[rel=\'line_height\']').val($(this).val()); $('#draggable .active').css('line-height', $(this).val()+'px'); $('#draggable .active textarea').css('line-height', $(this).val()+'px');">
			    <?php for($i=11; $i <= 36; $i++) { ?>
			    <option value="<?php echo $i; ?>" <?php echo ($i==0)?'selected="selected"':''; ?>><?php echo $i; ?>px</option>
			    <?php } ?>
			  </select></div>
			  <div class="input-group pull-left" style="margin-right:15px; font-weight:normal">
			    <label class="input-label">文字加粗：</label>
				<div>
					<span class="btn btn-default" onclick="
						$('#draggable .active').find('input[rel=\'font_weight\']').val('bold');
						$('#draggable .active').css('font-weight', 'bold');
						$('#draggable .active textarea').css('font-weight', 'bold');"><strong>粗</strong></span>
					<span class="btn btn-default" onclick="
						$('#draggable .active').find('input[rel=\'font_weight\']').val('normal');
						$('#draggable .active').css('font-weight', 'normal');
						$('#draggable .active textarea').css('font-weight', 'normal');">细</span>
				</div>
			  </div>
            </div>
          </div>
          <div class="form-group panel-heading"></div>
		    <link rel="stylesheet" href="view/javascript/jquery/ui/jquery-ui.min.css">
		  	<style type="text/css">
			.draggable-image{
				height:550px;
				padding:0px;
				border:1px #DDD dashed;
				background:#F8F8F8;
				overflow:hidden;
			}
			.draggable-box{
				height:100%;
				padding:0px;
				overflow:hidden;
				position:relative;
			}
			.draggable-box p{
				display:inline-block;
				padding:2px;
				margin-right:30px;
				cursor:move;
				border:1px #000 dotted;
				background-color:#FFF;
				background-color:rgba(255,255,255,0.2);
				font-size:11px;
				font-family:"新宋体";
				position: absolute;
				* opacity: 0.3;
				-webkit-box-sizing: content-box; */
				-moz-box-sizing: content-box;
				box-sizing: content-box;
			}
			.draggable-box p span{
				display:block;
				width:100%;
				height:100%;
				overflow:hidden;
			}
			.draggable-box p input{
				font-size:11px;
				font-family:"新宋体";
			}
			.draggable-box p textarea{
				width:100%;
				height:100%;
				font-size:11px;
				font-family:"新宋体";
				min-height:17px;
				margin:0px;
				padding:0px;
				border:1px #FFF solid;
			}
			.draggable-box p i{
				display:none;
				position:absolute;
				width:24px; height:24px;
				line-height:24px;
				text-align:center;
				font-style:normal;
				font-size:12px;
				color:#FFF;
				background:#FF0033;
			}
			.draggable-box p:hover i{
				display:block;
			}
			.draggable-box p:hover i.move{
				top:-1px; left:-24px;
				cursor:move;
			}
			.draggable-box p:hover i.remove{
				top:-1px; right:-24px;
				cursor:pointer;
			}
			.draggable-box .active{
				border:2px #003399 solid;
			}
			</style>
			
          <div class="form-group">
            <div class="col-sm-12" id="draggable">
			  <?php
			  $style  = 'style="';
			  $style .= 'width:'.round($width*3.779527559055, 2).'px;';
			  $style .= 'height:'.round($height*3.779527559055, 2).'px;';
			  
			  if ($thumb) {
			      $style .= ' background: url('.$thumb.') no-repeat left top;';
			  } else {
				  $style .= '';
			  }
			  
			  $style .= '"';
			  ?>
			  <div class="draggable-image" id="image-thumb" <?php echo $style; ?>>
			    <div class="draggable-box">
					<?php
						$vow = 0;
						foreach ($value as $key => $v) {
						$text = '';
						switch ($v['key']) {
							case 'ship_name': $text = $value_ship_name; break;
							case 'ship_country': $text = $value_ship_country; break;
							case 'ship_address': $text = $value_ship_address; break;
							case 'ship_postcode': $text = $value_ship_postcode; break;
							case 'ship_telphone': $text = $value_ship_telphone; break;
							
							case 'dly_name': $text = $value_dly_name; break;
							case 'dly_country': $text = $value_dly_country; break;
							case 'dly_address': $text = $value_dly_address; break;
							case 'dly_postcode': $text = $value_dly_postcode; break;
							case 'dly_telphone': $text = $value_dly_telphone; break;
							
							case 'store_name': $text = $value_store_name; break;
							case 'store_url': $text = $value_store_url; break;
							case 'tick': $text = $value_tick; break;
							case 'custom': $text = $value_custom; break;
							
							case 'date_year': $text = $value_date_year; break;
							case 'date_month': $text = $value_date_month; break;
							case 'date_day': $text = $value_date_day; break;
							case 'date_time': $text = $value_date_time; break;
							
							case 'order_id': $text = $value_order_id; break;
							case 'order_weight': $text = $value_order_weight; break;
							case 'order_total': $text = $value_order_total; break;
							case 'order_total_number': $text = $value_order_total_number; break;
							case 'order_currency': $text = $value_order_currency; break;
							case 'order_qty': $text = $value_order_qty; break;
							case 'order_comment': $text = $value_order_comment; break;
						}
					?>
					<p class="ui-widget-content"
						style="
							width:<?php echo $v['width']; ?>px;
							height:<?php echo $v['height']; ?>px;
							left:<?php echo $v['left']; ?>px;
							top:<?php echo $v['top']; ?>px;
							font-size:<?php echo $v['font_size']; ?>px;
							font-weight:<?php echo $v['font_weight']; ?>;
							line-height:<?php echo $v['line_height']; ?>px;
							letter-spacing:<?php echo $v['letter_spacing']; ?>px;
						">
						<span><?php echo $text; ?></span>
						<input type="hidden" name="value[<?php echo $vow; ?>][key]" rel="key" value="<?php echo $v['key']; ?>" />
						<input type="hidden" name="value[<?php echo $vow; ?>][width]" rel="width" value="<?php echo $v['width']; ?>" />
						<input type="hidden" name="value[<?php echo $vow; ?>][height]" rel="height" value="<?php echo $v['height']; ?>" />
						<input type="hidden" name="value[<?php echo $vow; ?>][left]" rel="left" value="<?php echo $v['left']; ?>" />
						<input type="hidden" name="value[<?php echo $vow; ?>][top]" rel="top" value="<?php echo $v['top']; ?>" />
						<input type="hidden" name="value[<?php echo $vow; ?>][font_size]" rel="font_size" value="<?php echo $v['font_size']; ?>" />
						<input type="hidden" name="value[<?php echo $vow; ?>][font_weight]" rel="font_weight" value="<?php echo $v['font_weight']; ?>" />
						<input type="hidden" name="value[<?php echo $vow; ?>][line_height]" rel="line_height" value="<?php echo $v['line_height']; ?>" />
						<input type="hidden" name="value[<?php echo $vow; ?>][letter_spacing]" rel="letter_spacing" value="<?php echo $v['letter_spacing']; ?>" />
						<i class="remove" onclick="$(this).parent().remove();">x</i><i class="move">@</i></p>
					<?php $vow++; ?>
					<?php } ?>
					
					<?php $row = 0; ?>
					<?php foreach ($custom as $v) { ?>
					<p class="ui-widget-content"
						style="
						width:<?php echo $v['width']; ?>px;
						height:<?php echo $v['height']; ?>px;
						left:<?php echo $v['left']; ?>px;
						top:<?php echo $v['top']; ?>px;
						font-size:<?php echo $v['font_size']; ?>px;
						font-weight:<?php echo $v['font_weight']; ?>;
						line-height:<?php echo $v['line_height']; ?>px;
						letter-spacing:<?php echo $v['letter_spacing']; ?>px;
						">
						<textarea
							name="custom[<?php echo $row; ?>][text]"
							rel="text"
							style="
							<?php
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
						<input type="hidden" name="custom[<?php echo $row; ?>][width]" rel="width" value="<?php echo $v['width']; ?>" />
						<input type="hidden" name="custom[<?php echo $row; ?>][height]" rel="height" value="<?php echo $v['height']; ?>" />
						<input type="hidden" name="custom[<?php echo $row; ?>][left]" rel="left" value="<?php echo $v['left']; ?>" />
						<input type="hidden" name="custom[<?php echo $row; ?>][top]" rel="top" value="<?php echo $v['top']; ?>" />
						<input type="hidden" name="custom[<?php echo $row; ?>][font_size]" rel="font_size" value="<?php echo $v['font_size']; ?>" />
						<input type="hidden" name="custom[<?php echo $row; ?>][font_weight]" rel="font_weight" value="<?php echo $v['font_weight']; ?>" />
						<input type="hidden" name="custom[<?php echo $row; ?>][line_height]" rel="line_height" value="<?php echo $v['line_height']; ?>" />
						<input type="hidden" name="custom[<?php echo $row; ?>][letter_spacing]" rel="letter_spacing" value="<?php echo $v['letter_spacing']; ?>" />
						<i class="remove" onclick="$(this).parent().remove();">x</i><i class="move">@</i></p>
					<?php $row++; ?>
					<?php } ?>
				</div>
			  </div>
			</div>
		  </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="view/javascript/jquery/ui/jquery-ui.min.js" type="text/javascript"></script>
<script type="text/javascript"><!--
function manager() {
	$.ajax({
		url: 'index.php?route=common/filemanager&token=' + getURLVar('token') + '&target=image-input&source=image-thumb',
		dataType: 'html',
		beforeSend: function() {
			$('#button-image i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
			$('#button-image').prop('disabled', true);
		},
		complete: function() {
			$('#button-image i').replaceWith('<i class="fa fa-upload"></i>');
			$('#button-image').prop('disabled', false);
		},
		success: function(html) {
			$('body').append('<div id="modal-image" class="modal">' + html + '</div>');

			$('#modal-image').modal('show');
		}
	});
}

function drag() {
  $('#draggable p').draggable({
  	containment:".draggable-box",
	addClasses: false,
	stop: function (event, ui) {
		ui.helper.find('input[rel="left"]').val(ui.position.left);
		ui.helper.find('input[rel="top"]').val(ui.position.top);
	}
  });
}

function resize() {
  $("#draggable p").resizable({
    containment: 'parent',
    maxWidth:270,
	maxHeight:120,
    minWidth:50,
	minHeight:17,
	stop: function(event, ui) {
		ui.helper.find('input[rel="width"]').val(ui.size.width);
		ui.helper.find('input[rel="height"]').val(ui.size.height);
	}
  });
}

function active() {
  $('#draggable p').click(function(){
    $('#draggable p').each(function(){
		$(this).removeClass('active');
	});
	
    $(this).addClass('active');
  });
}

var row = <?php echo $row; ?>;
var vow = <?php echo $vow; ?>;

$('.data-box a').each(function(){
	$(this).click(function(){
		var html  = '<p style="width:50px; height:17px; left:10px; top:10px;">';
			if ($(this).attr('data') == 'custom') {
			html += '<textarea name="custom['+row+'][text]" rel="text">'+$(this).text()+'</textarea>';
			html += '<input type="hidden" name="custom['+row+'][width]" rel="width" value="50" />';
			html += '<input type="hidden" name="custom['+row+'][height]" rel="height" value="17" />';
			html += '<input type="hidden" name="custom['+row+'][left]" rel="left" value="0" />';
			html += '<input type="hidden" name="custom['+row+'][top]" rel="top" value="0" />';
			html += '<input type="hidden" name="custom['+row+'][font_size]" rel="font_size" value="12" />';
			html += '<input type="hidden" name="custom['+row+'][font_weight]" rel="font_weight" value="normal" />';
			html += '<input type="hidden" name="custom['+row+'][line_height]" rel="line_height" value="14" />';
			html += '<input type="hidden" name="custom['+row+'][letter_spacing]" rel="letter_spacing" value="0" />';
			
			row ++;
			} else {
			html += '<span>'+$(this).text()+'</span>';
			html += '<input type="hidden" name="value['+vow+'][key]" rel="key" value="'+$(this).attr('data')+'" />';
			html += '<input type="hidden" name="value['+vow+'][width]" rel="width" value="50" />';
			html += '<input type="hidden" name="value['+vow+'][height]" rel="height" value="17" />';
			html += '<input type="hidden" name="value['+vow+'][left]" rel="left" value="0" />';
			html += '<input type="hidden" name="value['+vow+'][top]" rel="top" value="0" />';
			html += '<input type="hidden" name="value['+vow+'][font_size]" rel="font_size" value="12" />';
			html += '<input type="hidden" name="value['+vow+'][font_weight]" rel="font_weight" value="normal" />';
			html += '<input type="hidden" name="value['+vow+'][line_height]" rel="line_height" value="14" />';
			html += '<input type="hidden" name="value['+vow+'][letter_spacing]" rel="letter_spacing" value="0" />';
			
			vow ++;
			}
			html += '<i class="remove" onclick="$(this).parent().remove();">x</i><i class="move">@</i>';
			html += '</p>';
			
		$('.draggable-box').append(html);
		drag(); resize(); active();
		return false;
	});
});

//在页面加载完之后加载jquery
$().ready(function(e) {
  drag(); resize(); active();
});

$('#add').click(function() {
	var order_match_text = $('#order-status option:selected').text()+' - '+$('#order-shipping option:selected').text();
	var order_match = $('#order-status option:selected').val()+'|||'+$('#order-shipping option:selected').val();
	
	$('#order-area > div').each(function (){
		var t = $(this).attr('col');
		
		if (t == order_match) {
			$(this).remove();
		}
	});
	
	var html = '<div col="'+order_match+'">';
		html += '<i class="fa fa-minus-circle" onclick="$(this).parent().remove();"></i> '+order_match_text;
		html += '<input type="hidden" name="shippings[]" value="'+order_match+'|||'+order_match_text+'" />';
		html += '</div>';
	
	$('#order-area').append(html);
});
//--></script>
<?php echo $footer; ?>