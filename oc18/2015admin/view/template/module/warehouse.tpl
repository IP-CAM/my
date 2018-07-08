<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <style type="text/css">
.spinner {
  margin: 100px auto;
  width: 50px;
  height: 60px;
  text-align: center;
  font-size: 10px;
}
 
.spinner > div {
  background-color: #67CF22;
  height: 100%;
  width: 6px;
  display: inline-block;
   
  -webkit-animation: stretchdelay 1.2s infinite ease-in-out;
  animation: stretchdelay 1.2s infinite ease-in-out;
}
 
.spinner .rect2 {
  -webkit-animation-delay: -1.1s;
  animation-delay: -1.1s;
}
 
.spinner .rect3 {
  -webkit-animation-delay: -1.0s;
  animation-delay: -1.0s;
}
 
.spinner .rect4 {
  -webkit-animation-delay: -0.9s;
  animation-delay: -0.9s;
}
 
.spinner .rect5 {
  -webkit-animation-delay: -0.8s;
  animation-delay: -0.8s;
}
 
@-webkit-keyframes stretchdelay {
  0%, 40%, 100% { -webkit-transform: scaleY(0.4) } 
  20% { -webkit-transform: scaleY(1.0) }
}
 
@keyframes stretchdelay {
  0%, 40%, 100% {
    transform: scaleY(0.4);
    -webkit-transform: scaleY(0.4);
  }  20% {
    transform: scaleY(1.0);
    -webkit-transform: scaleY(1.0);
  }
}
</style>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading" style="position:relative;">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
	    <div class="pull-right" style="position:absolute; top:3px; right:20px;">
		  <button data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary" onclick="add();"><i class="fa fa-plus"></i></button>
		  <button data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger" onclick="del();"><i class="fa fa-remove"></i></button>
	    </div>
      </div>
      <div class="panel-body" id="warehouse"></div>
    </div>
  </div>
</div>
<script type="text/javascript"><!--//
function list(page) {
	if (parseInt(page) < 1) {
		page = 1;
	}
	
	$.ajax({
		url: 'index.php?route=module/warehouse/whlist&token=' + getURLVar('token') + '&page=' + page,
		dataType: 'html',
		beforeSend: function() {
			var html = '';
				html += '<div class="spinner">';
				html += '  <div class="rect1"></div>';
				html += '  <div class="rect2"></div>';
				html += '  <div class="rect3"></div>';
				html += '  <div class="rect4"></div>';
				html += '  <div class="rect5"></div>';
				html += '</div>';
				
			$('#warehouse').html(html);
		},
		success: function(html) {
			$('#warehouse').html(html);
		}
	});	
}

list(1);

function add() {
	$.ajax({
		url: 'index.php?route=module/warehouse/whform&token=' + getURLVar('token'),
		dataType: 'html',
		beforeSend: function() {
			var html = '';
				html += '<div class="spinner">';
				html += '  <div class="rect1"></div>';
				html += '  <div class="rect2"></div>';
				html += '  <div class="rect3"></div>';
				html += '  <div class="rect4"></div>';
				html += '  <div class="rect5"></div>';
				html += '</div>';
				
			$('#warehouse').html(html);
		},
		success: function(html) {
			$('#warehouse').html(html);
		}
	});	
}

function edit(id) {
	$.ajax({
		url: 'index.php?route=module/warehouse/whform&token=' + getURLVar('token') + '&id=' + id,
		dataType: 'html',
		beforeSend: function() {
			var html = '';
				html += '<div class="spinner">';
				html += '  <div class="rect1"></div>';
				html += '  <div class="rect2"></div>';
				html += '  <div class="rect3"></div>';
				html += '  <div class="rect4"></div>';
				html += '  <div class="rect5"></div>';
				html += '</div>';
				
			$('#warehouse').html(html);
		},
		success: function(html) {
			$('#warehouse').html(html);
		}
	});	
}

function save() {
	$.ajax({
		url: 'index.php?route=module/warehouse/save&token=' + getURLVar('token'),
		dataType: 'json',
        type: 'post',
		data: $('#warehouse input[type=\'text\'], #warehouse input[type=\'hidden\'], #warehouse input[type=\'checkbox\']:checked, #warehouse select'),
		beforeSend: function() {
			$('.buttons button').text('loading..').attr('disabled', true);
		},
		success: function(json) {
			if(json['error_code']){
				alert(json['error_code'])
				$('.buttons button').text('<?php echo $button_save?>').attr('disabled', false);
			} else if (json['error_name']) {
				alert(json['error_name']);
				$('.buttons button').text('<?php echo $button_save?>').attr('disabled', false);
			} else if (json['error_address']) {
				alert(json['error_address']);
				$('.buttons button').text('<?php echo $button_save?>').attr('disabled', false);
			} else if (json['error_phone']) {
				alert(json['error_phone']);
				$('.buttons button').text('<?php echo $button_save?>').attr('disabled', false);
			} else if (json['error_email']) {
				alert(json['error_email']);
				$('.buttons button').text('<?php echo $button_save?>').attr('disabled', false);
			} else {
				list(1);
			}
		}
	});
}

function del(id) {
	if (confirm('<?php echo $text_alert_delete; ?>')) {
		var ids = new Array();
		
		$('input[name*=\'selected\']:checked').each(function (i) {
			ids[i] = $(this).val();
		});
		
		var id = ids.join();
		
		$.ajax({
			url: 'index.php?route=module/warehouse/whdel&token=' + getURLVar('token') + '&id=' + id,
			dataType: 'json',
			success: function(json) {
				if (json['error']) {
					alert(json['error']);
				} else {
					list(1);
				}
			}
		});
	}
}
//--></script>
<?php echo $footer; ?>