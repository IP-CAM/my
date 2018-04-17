<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-html" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-html" class="form-horizontal">
          
		  <div class="form-group">
		    <label class="col-sm-2 control-label"><?php echo $entry_api; ?></label>
			<div class="col-sm-10">
			
			<input type="text" name="tianyisms_apiid" value="<?php echo $tianyisms_apiid; ?>" class="form-control"/>
			<?php if ($error_tianyisms_apiid) { ?>
              <div class="text-danger"><?php echo $error_tianyisms_apiid; ?></div>
            <?php } ?>
			
			</div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-2 control-label"><?php echo $entry_secret; ?></label>
			<div class="col-sm-10">
			
			<input type="text" name="tianyisms_apisecret" value="<?php echo $tianyisms_apisecret; ?>" class="form-control"/>
			<?php if ($error_tianyisms_apisecret) { ?>
              <div class="text-danger"><?php echo $error_tianyisms_apisecret; ?></div>
            <?php } ?>
			</div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-2 control-label"><?php echo $entry_access_token; ?></label>
			
			<div class="col-sm-10">
			<?php if($tianyisms_status) { ?>
			<p style="cursor:pointer;display:table;border:1px solid #ddd;padding:6px 12px;" id="getAccessToken"><?php echo $entry_get; ?></p><span class="geting"></span>
			<?php } ?>
			<input type="text" name="tianyisms_access_token" value="<?php echo $tianyisms_access_token; ?>" readonly="readonly" class="form-control"/><br/>
			<input type="hidden" name="tianyisms_res_code" value="<?php echo $tianyisms_res_code; ?>" readonly="readonly"/>
			
			</div>
		  </div>
		  <div class="form-group">
			<label class="col-sm-2 control-label"><?php echo $entry_expire; ?></label>
			<div class="col-sm-10">
			<input type="text" name="tianyisms_expires_in" value="<?php echo $tianyisms_expires_in; ?>"  readonly="readonly" class="form-control"/>
			</div>
		  </div>
		   
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-tianyisms_status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="tianyisms_status" id="input-tianyisms_status" class="form-control">
                <?php if ($tianyisms_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
		  
		  <div class="form-group">
			<?php if($security_code) { ?>
			<table class="table-responsive table-striped table">
			<?php list($key,$security) = each ($security_code); ?>
			<thead>
				<?php foreach($security as $key => $value){ ?>
				<td><?php print_r($key); ?></td>
				<?php } ?>
			</thead>

			<tbody>
				<?php foreach($security_code as $security) { ?>
				<tr>
					<?php foreach($security as $key => $value) { ?>
					<td><?php echo $value; ?></td>
					<?php } ?>
				</tr>
				<?php } ?>
			</tbody>
			
			</table>
			<?php } ?>
		  </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
$('#getAccessToken').on('click',function(){
	$.ajax({
		url: 'index.php?route=module/tianyisms/getAccessToken&token=<?php echo $token; ?>',
		type: 'post',
		dataType: 'json',
		beforeSend: function(){
		$('.geting').text('ing...');
		},
		complete: function(){
		$('.geting').text('OK');
		},
		success: function(json){
			if(json['tianyisms_res_code'] == 0){
			$('input[name=\'tianyisms_res_code\']').val(json['tianyisms_res_code']);
			if(json['tianyisms_access_token']){
			$('input[name=\'tianyisms_access_token\']').val(json['tianyisms_access_token']);
			}
			if(json['tianyisms_expires_in']){
			$('input[name=\'tianyisms_expires_in\']').val(json['tianyisms_expires_in']);
			}
			}else{
			alert('error! res_code:' + json['tianyisms_res_code']);
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});
--></script>

<?php echo $footer; ?>