<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-super" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-super" class="form-horizontal">
		  <div class="form-group">
			<label class="col-sm-1 control-label"><?php echo $entry_shipping_status; ?></label>
			<div class="col-sm-11">
			  <select name="super_status" class="form-control">
				<?php if ($super_status) { ?>
				<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
				<option value="0"><?php echo $text_disabled; ?></option>
				<?php } else { ?>
				<option value="1"><?php echo $text_enabled; ?></option>
				<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
				<?php } ?>
			  </select>
			</div>
		  </div>
		  <div class="form-group" style="border-bottom:1px #DDD solid; padding-bottom:30px;">
			<label class="col-sm-1 control-label"><?php echo $entry_sort_order; ?></label>
			<div class="col-sm-11">
			  <input type="text" name="super_sort_order" value="<?php echo $super_sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" />
			</div>
		  </div>
		  <div class="col-sm-2">
		    <ul class="nav nav-pills nav-stacked">
			  <?php foreach ($super as $s) { ?>
              <li class="shipping<?php echo $s['id']; ?>">
			    <a href="#tab-shipping<?php echo $s['id']; ?>" class="tab-shipping<?php echo $s['id']; ?>" data-toggle="tab"><span><?php echo $s['name']; ?></span> <i class="fa fa-minus-circle" style="position:absolute; right:10px; top:35%;" onclick="$(this).parent().parent().remove(); $('#tab-shipping<?php echo $s['id']; ?>').remove();"></i></a>
				<input type="hidden" name="super[]" value="<?php echo $s['id']; ?>" />
				<script type="text/javascript">
					$(document).ready(function(){
						loadForm('<?php echo $s['id']; ?>');
						$('.shipping<?php echo $s['id']; ?> a').tab('show');
					});
				</script>
			  </li>
			  <?php } ?>
              <li style="padding:10px 15px;"><input type="text" value="" style="width:90%; float:left;" /> <i class="fa fa-plus-circle" style="float:right; margin-top:5px;" id="add-shipping"></i></li>
            </ul>
		  </div>
		  
		  <div class="col-sm-10">
		    <div class="tab-content" id="form">
			  <?php foreach ($super as $s) { ?>
			  <div class="tab-pane" id="tab-shipping<?php echo $s['id']; ?>"></div>
			  <?php } ?>
			</div>
		  </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript"><!--
$('#add-shipping').click(function(){
	var show = true;
	var id = $(this).parent().find('input').val();
	$(this).parent().find('input').val('');
	
	if (id == '') {
		show = false;
	} else {
		$('input[name=\'super[]\']').each(function(){
			if ($(this).val() == id) {
				show = false;
			}
		});
	}
	
	if (show) {
		var html = '<li class="shipping'+id+'"><a href="#tab-shipping'+id+'" class="tab-shipping'+id+'" data-toggle="tab"><span><?php echo $entry_name; ?></span><i class="fa fa-minus-circle" style="position:absolute; right:10px; top:35%;" onclick="$(this).parent().parent().remove(); $(\'#tab-shipping'+id+'\').remove();"></i></a><input type="hidden" name="super[]" value="'+id+'" /></li>';
		
		$(this).parent().before(html);
		
		var html = '<div class="tab-pane" id="tab-shipping'+id+'"></div>';
		
		$('#form').append(html);
		
		loadForm(id);
		
		$('.shipping'+id+' a').tab('show');
	} else {
		alert('请输入配送代码，不能重复！');
	}
});

function loadForm(row) {
	var obj = $('#add-shipping');
	
	obj.attr('rel', 'add-shipping').removeAttr('id');
	
	$.ajax({
		url: 'index.php?route=shipping/super/form&token=<?php echo $token; ?>&shipping_id=' + encodeURIComponent(row),
		dataType: 'html',
		success: function(html) {
			$('#tab-shipping'+row).html(html);
			
			obj.attr('id', 'add-shipping').removeAttr('rel');
		}
	});
}
//--></script> 
<?php echo $footer; ?>