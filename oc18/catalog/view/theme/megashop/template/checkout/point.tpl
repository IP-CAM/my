<div class="panel panel-default">
  <div class="panel-heading">
    <h4 class="panel-title"><a href="#collapse-point" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"><?php echo $heading_title; ?> <i class="fa fa-caret-down"></i></a></h4>
  </div>
  <div id="collapse-point" class="panel-collapse collapse">
    <div class="panel-body">
      <label class="col-sm-2 control-label" for="input-point"><?php echo $entry_point; ?></label>
      <div class="input-group">
        <input type="text" name="point" value="<?php echo $point; ?>" placeholder="<?php echo $entry_point; ?>" id="input-point" class="form-control" />
        <span class="input-group-btn">
        <input type="submit" value="<?php echo $button_reward; ?>" id="button-point" data-loading-text="<?php echo $text_loading; ?>"  class="btn btn-outline" />
        </span></div>
      <script type="text/javascript"><!--
$('#button-point').on('click', function() {
	$.ajax({
		url: 'index.php?route=checkout/point/point',
		type: 'post',
		data: 'point=' + encodeURIComponent($('input[name=\'point\']').val()),
		dataType: 'json',
		beforeSend: function() {
			$('#button-point').button('loading');
		},
		complete: function() {
			$('#button-point').button('reset');
		},
		success: function(json) {
			$('.alert').remove();

			if (json['error']) {
				$('.breadcrumb').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

				$('html, body').animate({ scrollTop: 0 }, 'slow');
			}

			if (json['redirect']) {
				location = json['redirect'];
			}
		},
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
	});
});
//--></script>
    </div>
  </div>
</div>