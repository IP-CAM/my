<table class="table table-bordered">
  <thead>
    <tr>
      <td class="text-left"><?php echo $column_date_added; ?></td>
      <td class="text-left"><?php echo $column_comment; ?></td>
      <td class="text-left"><?php echo $column_status; ?></td>
      <td class="text-left"><?php echo $column_notify; ?></td>
	  <td width="1"></td>
    </tr>
  </thead>
  <tbody>
    <?php if ($histories) { ?>
    <?php foreach ($histories as $history) { ?>
    <tr id="history<?php echo $history['order_history_id']; ?>">
      <td class="text-left"><?php echo $history['date_added']; ?></td>
      <td class="text-left"><?php echo $history['comment']; ?></td>
      <td class="text-left"><?php echo $history['status']; ?></td>
      <td class="text-left"><?php echo $history['notify']; ?></td>
      <td class="text-left"><button type="button" class="btn btn-danger" onclick="delHistory(<?php echo $history['order_history_id']; ?>);"><i class="fa fa-trash-o"></i></button></td>
    </tr>
    <?php } ?>
    <?php } else { ?>
    <tr>
      <td class="text-center" colspan="4"><?php echo $text_no_results; ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
<div class="row">
  <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
  <div class="col-sm-6 text-right"><?php echo $results; ?></div>
</div>
<script type="text/javascript"><!--
function delHistory(id) {
	if (confirm('Are you sure?')) {
	$.ajax({
		url: 'index.php?route=sale/order/del_history&token=<?php echo $token; ?>&order_history_id='+id,
		type: 'post',
		dataType: 'json',
		success: function(json) {
			$('#history'+id).remove();
		},			
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
	}
}
--></script>