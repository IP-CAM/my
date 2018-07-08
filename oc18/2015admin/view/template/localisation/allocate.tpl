<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i> 返回快递单模板</a></div>
      <h1>配送单自动打印匹配</h1>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> 配送单自动打印匹配</h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action1; ?>" method="post" enctype="multipart/form-data" id="form1" class="form-horizontal">
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
				<div class="col-sm-3">
					<a class="btn btn-primary" id="add">确认添加</a>
					<a class="btn btn-primary" data-toggle="tooltip" title="<?php echo $button_save; ?>" onClick="$('#form1').submit();">保存设置</a>
				</div>
			</div>
			<div class="col-sm-8 well well-sm" id="order-area">
				<?php foreach ($allocates as $s) { ?>
				<div col="<?php echo $s['order_status_id'].'|||'.$s['shipping_code']; ?>"><i class="fa fa-minus-circle" onclick="$(this).parent().remove();"></i> <?php echo $s['text']; ?><input type="hidden" name="autoprint[]" value="<?php echo $s['order_status_id'].'|||'.$s['shipping_code'].'[|]|[|]'.$s['text']; ?>" /></div>
				<?php } ?>
			</div>
        </div>
        </form>

		<div style="clear:both;"></div>

        <form action="<?php echo $action2; ?>" method="post" enctype="multipart/form-data" id="form2">
        <div class="form-horizontal" style="margin-bottom:20px; border-bottom:1px #DDD solid; overflow:hidden;">
	        <label class="col-sm-2 control-label">仓库：</label>
	        <div class="col-sm-10">
				<div class="form-group">
					<div class="col-sm-3"><input type="text" placeholder="仓库名称" class="form-control w-name" /></div>
					<div class="col-sm-3"><input type="text" placeholder="仓库编码" onKeyUp="value=value.replace(/[^0-9a-zA-Z]/g,'')" onFour class="form-control w-code" /></div>
					<div class="col-sm-3">
						<a class="btn btn-primary" id="w-add">确认添加</a>
						<a class="btn btn-primary" data-toggle="tooltip" title="<?php echo $button_save; ?>" onClick="$('#form2').submit();">保存设置</a></div>
				</div>
			</div>
		</div>
		<style type="text/css">
		.wss{
			overflow: hidden;
		}
		.wss > .col-sm-3{
			position: relative;
			overflow: hidden;
		}
		.wss > .col-sm-3:hover .close{
			display: block;
		}
		.wss > .col-sm-3 .close{
			display: none;
			position: absolute;
			top: 3px; right: 0;
		}
		</style>
        <div class="form-horizontal wss">
        	<?php $row = 0; ?>
			<?php $srow = 0; ?>
        	<?php foreach ($www as $w) { ?>
			<div class="col-sm-3" id="ws<?php echo $row; ?>">
				<div class="close">
					<i data-toggle="tooltip" title="Remove" class="fa fa-remove pull-right" onClick="$('#ws<?php echo $row; ?>').remove();"></i>
				</div>
				<h4>
					<?php echo $w['name']; ?> (<?php echo $w['code']; ?>)
					<input type="hidden" name="autowarehouse[<?php echo $row; ?>][name]" value="<?php echo $w['name']; ?>" />
					<input type="hidden" name="autowarehouse[<?php echo $row; ?>][code]" value="<?php echo $w['code']; ?>" />
				</h4>
				<div style="margin-bottom:20px;overflow:hidden;">
					<div class="col-sm-8" style="padding:0;">
						<select class="form-control">
							<?php foreach ($supers as $super) { ?>
							<option value="<?php echo $super['id']; ?>"><?php echo $super['name']; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-sm-4" style="padding:0;"><a class="btn btn-primary pull-right" onClick="sdd('<?php echo $row; ?>');">添加配送</a></div>
				</div>
				<div class="col-sm-12 well well-sm" id="wsa<?php echo $row; ?>">
					<?php foreach ($w['ship'] as $ship) { ?>
					<div>
						<i class="fa fa-minus-circle" onclick="$(this).parent().remove();"></i>
						<?php echo $ship['name']; ?>
						<input type="hidden" name="autowarehouse[<?php echo $row; ?>][ship][<?php echo $srow; ?>][code]" value="<?php echo $ship['code']; ?>">
						<input type="hidden" name="autowarehouse[<?php echo $row; ?>][ship][<?php echo $srow; ?>][name]" value="<?php echo $ship['name']; ?>">
					</div>
					<?php $srow ++; ?>
					<?php } ?>
				</div>
			</div>
        	<?php $row ++; ?>
			<?php } ?>
		</div>
		</form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
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
		html += '<input type="hidden" name="autoprint[]" value="'+order_match+'[|]|[|]'+order_match_text+'" />';
		html += '</div>';
	
	$('#order-area').append(html);
});

var row = <?php echo $row; ?>;
var srow = <?php echo $srow; ?>;

$('#w-add').click(function() {
	var name = $(this).parent().parent().find('.w-name').val();
	var code = $(this).parent().parent().find('.w-code').val();
	var wdd = true;

	$('.wss > .col-sm-3').each(function (){
		var n = $(this).find('h4 input[name*=name]').val();
		var c = $(this).find('h4 input[name*=code]').val();

		if (n == name || c == code) {
			alert('仓库名称或仓库编号有重复');
			wdd = false;
			return false;
		}
	});

	if (!wdd) {
		return false;
	}

	var html  = '<div class="col-sm-3" id="ws'+row+'">';
		html += '	<div class="close">';
		html += '		<i data-toggle="tooltip" title="Remove" class="fa fa-remove pull-right" onClick="$(\'#ws'+row+'\').remove();"></i>';
		html += '	</div>';
		html += '	<h4>'+name+' ('+code+')';
		html += '<input type="hidden" name="autowarehouse['+row+'][name]" value="'+name+'" />';
		html += '<input type="hidden" name="autowarehouse['+row+'][code]" value="'+code+'" />';
		html += '	</h4>';
		html += '	<div style="margin-bottom:20px;overflow:hidden;">';
		html += '		<div class="col-sm-8" style="padding:0;">';
		html += '			<select class="form-control">';

		<?php foreach ($supers as $super) { ?>
		html += '<option value="<?php echo $super['id']; ?>"><?php echo $super['name']; ?></option>';
		<?php } ?>

		html += '			</select>';
		html += '		</div>';
		html += '		<div class="col-sm-4" style="padding:0;"><a class="btn btn-primary pull-right" onClick="sdd('+row+');">添加配送</a></div>';
		html += '	</div>';
		html += '	<div class="col-sm-12 well well-sm" id="wsa'+row+'"></div>';
		html += '</div>';

	$('.wss').append(html);
	row++;
});

function sdd(num) {
	var name = $('#ws'+num).find('select option:selected').text();
	var code = $('#ws'+num).find('select option:selected').val();
	var sdd  = true;
	var html = '';
	
	$('#wsa'+num+' > div').each(function (){
		var c = $(this).find('input[name*=code]').val();
		
		if (c == code) {
			$(this).remove();
		}
	});

	$('.wss .well-sm > div').each(function (){
		var c = $(this).find('input[name*=code]').val();
		
		if (c == code) {
			alert('该配送已选');
			sdd = false;
			return false;
		}
	});

	if (!sdd) {
		return false;
	}

	html += '<div>';
	html += '	<i class="fa fa-minus-circle" onclick="$(this).parent().remove();"></i>'+name;
	html += '	<input type="hidden" name="autowarehouse['+num+'][ship]['+srow+'][code]" value="'+code+'">';
	html += '	<input type="hidden" name="autowarehouse['+num+'][ship]['+srow+'][name]" value="'+name+'">';
	html += '</div>';

	$('#wsa'+num).append(html);
	srow++;
}
//--></script>
<?php echo $footer; ?>