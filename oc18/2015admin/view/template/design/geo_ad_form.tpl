<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-geo_ad" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-geo_ad" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="status" id="input-status" class="form-control">
                <?php if ($status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?></label>
            <div class="col-sm-10">
              <input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
              <?php if ($error_name) { ?>
              <div class="text-danger"><?php echo $error_name; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label"><?php echo $entry_size; ?></label>
            <div class="col-sm-10">
              <input type="text" name="width" value="<?php echo $width; ?>" placeholder="<?php echo $entry_width; ?>" class="form-control" style="width:120px; display:inline-block;" />
              <input type="text" name="height" value="<?php echo $height; ?>" placeholder="<?php echo $entry_height; ?>" class="form-control" style="width:120px; display:inline-block;" />
            </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label">默认图片：</label>
            <div class="col-sm-10"><a href="" id="thumb-path-logo" data-toggle="image" class="img-thumbnail"><img src="<?php echo $path_logo; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                  <input type="hidden" name="path" value="<?php echo $path; ?>" id="input-path-logo" /></div>
		  </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label"><?php echo $entry_code; ?></label>
            <div class="col-sm-10">
			  <div class="well well-sm">
			    <?php echo $code; ?>
			  </div>
            </div>
          </div>
		  <ul class="nav nav-tabs" id="group">
		    <?php $group_row = 0; ?>
			<?php foreach ($geo_ad_images as $geo_ad_image) { ?>
			<li><a href="#group<?php echo $group_row; ?>" data-toggle="tab"><i class="fa fa-minus-circle" onclick="$('a[href=\'#group<?php echo $group_row; ?>\']').parent().remove(); $('#group<?php echo $group_row; ?>').remove(); $('#group a:first').tab('show');"></i> <?php echo $text_group; ?> <?php echo $group_row; ?></a></li>
			<?php $group_row++; ?>
			<?php } ?>
			<li><a href="#" onclick="addGroup(this); return false;"><i class="fa fa-plus-circle"></i> <?php echo $text_group_add; ?></a></li>
		  </ul>
		  
		  
		  
		  
		  
		  
		  
		  <div class="tab-content" id="group-content">
		    <?php $group_row = 0; ?>
			<?php $geo_row = 0; ?>
			<?php $geo_row_content = 0; ?>
			<?php foreach ($geo_ad_images as $geo_ad_image) { ?>
			<div class="tab-pane" id="group<?php echo $group_row; ?>">
				<div class="tab-content panel-heading" style="margin-bottom:20px;">
				  <div class="form-group">
					<label class="col-sm-2 control-label" for="input-country<?php echo $geo_ad_image['geo_ad_image_id']; ?>"><span data-toggle="tooltip" title="<?php echo $help_country; ?>"><?php echo $entry_country; ?></span></label>
					<div class="col-sm-10">
					  <input type="text" name="country" value="" placeholder="<?php echo $entry_country; ?>" id="input-country<?php echo $geo_ad_image['geo_ad_image_id']; ?>" data="<?php echo $group_row; ?>" class="form-control" />
					  <div id="country<?php echo $group_row; ?>" class="well well-sm" style="height: 150px; overflow: auto;">
						<?php foreach ($countries as $country) { ?>
						<?php if (in_array($country['iso_code_2'], $geo_ad_image['country'])) { ?>
						<div id="country<?php echo $geo_ad_image['geo_ad_image_id']; ?><?php echo $country['iso_code_2']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $country['name']; ?>
						  <input type="hidden" name="geo_ad_image[<?php echo $group_row; ?>][country][]" value="<?php echo $country['iso_code_2']; ?>" />
						</div>
						<?php } ?>
						<?php } ?>
					  </div>
					</div>
				  </div>
				</div>
				<div class="row">
					<div class="col-sm-2">
						<ul class="nav nav-pills nav-stacked" id="option<?php echo $group_row; ?>">
							<?php foreach ($geo_ad_image['geo_ad_image_description'] as $geo_ad_image_description) { ?>
							<?php if ($geo_ad_image_description['geo_ad_image_id'] == $geo_ad_image['geo_ad_image_id']) { ?>
							<li><a href="#tab-option<?php echo $group_row.$geo_row; ?>" data-toggle="tab"><i class="fa fa-minus-circle" onclick="$('a[href=\'#tab-option<?php echo $group_row.$geo_row; ?>\']').parent().remove(); $('#tab-option<?php echo $group_row.$geo_row; ?>').remove(); $('#option a:first').tab('show');"></i> <?php echo $text_image; ?></a></li>
							<?php $geo_row ++; ?>
							<?php } ?>
							<?php } ?>
							<li><a href="#" onclick="addImage('<?php echo $group_row; ?>'); return false;"><i class="fa fa-plus-circle"></i> <?php echo $text_image_add; ?></a></li>
						</ul>
					</div>
					<div class="col-sm-10">
						<div class="tab-content" id="option-content<?php echo $group_row; ?>">
							<?php foreach ($geo_ad_image['geo_ad_image_description'] as $geo_ad_image_description) { ?>
							<?php if ($geo_ad_image_description['geo_ad_image_id'] == $geo_ad_image['geo_ad_image_id']) { ?>
							<div class="tab-pane" id="tab-option<?php echo $group_row.$geo_row_content; ?>">
							
							
							<ul class="nav nav-tabs" id="language<?php echo $geo_ad_image['geo_ad_image_id'].$geo_row_content; ?>">
								<?php foreach ($languages as $language) { ?>
								<li><a href="#language<?php echo $geo_ad_image['geo_ad_image_id'].$geo_row_content.$language['language_id']; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
								<?php } ?>
							</ul>
							
							<div class="tab-content">
								<?php foreach ($languages as $language) { ?>
								<div class="tab-pane" id="language<?php echo $geo_ad_image['geo_ad_image_id'].$geo_row_content.$language['language_id']; ?>">
								  <div class="form-group">
									<label class="col-sm-2 control-label" for="input-title<?php echo $geo_ad_image['geo_ad_image_id'].$geo_row_content; ?>"><?php echo $entry_title_show; ?></label>
									<div class="col-sm-10">
									  <input
									  	type="text"
										name="geo_ad_image[<?php echo $group_row; ?>][geo_ad_image_description][<?php echo $geo_row_content; ?>][title][<?php echo $language['language_id']; ?>]"
										value="<?php echo isset($geo_ad_image_description['title'][$language['language_id']])?$geo_ad_image_description['title'][$language['language_id']]:''; ?>"
										placeholder="<?php echo $entry_title_show; ?>"
										id="input-title<?php echo $geo_ad_image['geo_ad_image_id'].$geo_row_content.$language['language_id']; ?>"
										class="form-control" />
									</div>
								  </div>
								  <div class="form-group">
									<label class="col-sm-2 control-label" for="input-link<?php echo $geo_ad_image['geo_ad_image_id'].$geo_row_content; ?>"><?php echo $entry_link; ?></label>
									<div class="col-sm-10">
									  <input
									  	type="text"
										name="geo_ad_image[<?php echo $group_row; ?>][geo_ad_image_description][<?php echo $geo_row_content; ?>][link][<?php echo $language['language_id']; ?>]"
										value="<?php echo isset($geo_ad_image_description['link'][$language['language_id']])?$geo_ad_image_description['link'][$language['language_id']]:''; ?>"
										placeholder="<?php echo $entry_link; ?>"
										id="input-link<?php echo $geo_ad_image['geo_ad_image_id'].$geo_row_content.$language['language_id']; ?>"
										class="form-control" />
									</div>
								  </div>
								  <div class="form-group">
									<label class="col-sm-2 control-label" for="input-sort_order<?php echo $geo_ad_image['geo_ad_image_id'].$geo_row_content; ?>"><?php echo $entry_sort_order; ?></label>
									<div class="col-sm-10">
									  <input
									  	type="text"
										name="geo_ad_image[<?php echo $group_row; ?>][geo_ad_image_description][<?php echo $geo_row_content; ?>][sort_order][<?php echo $language['language_id']; ?>]"
										value="<?php echo isset($geo_ad_image_description['sort_order'][$language['language_id']])?$geo_ad_image_description['sort_order'][$language['language_id']]:''; ?>"
										placeholder="<?php echo $entry_sort_order; ?>"
										id="input-sort_order<?php echo $geo_ad_image['geo_ad_image_id'].$geo_row_content.$language['language_id']; ?>"
										class="form-control" />
									</div>
								  </div>
								  <div class="form-group">
									<label class="col-sm-2 control-label" for="input-image<?php echo $geo_ad_image['geo_ad_image_id']; ?>"><?php echo $entry_image; ?></label>
									<div class="col-sm-10">
									  <a href="" id="thumb-image<?php echo $geo_ad_image['geo_ad_image_id'].$geo_row_content.$language['language_id']; ?>" data-toggle="image" class="img-thumbnail"><img src="<?php echo isset($geo_ad_image_description['thumb'][$language['language_id']])?$geo_ad_image_description['thumb'][$language['language_id']]:''; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
									  <input
									  	type="hidden"
										name="geo_ad_image[<?php echo $group_row; ?>][geo_ad_image_description][<?php echo $geo_row_content; ?>][image][<?php echo $language['language_id']; ?>]"
										value="<?php echo isset($geo_ad_image_description['image'][$language['language_id']])?$geo_ad_image_description['image'][$language['language_id']]:''; ?>"
										id="input-image<?php echo $geo_ad_image['geo_ad_image_id'].$geo_row_content.$language['language_id']; ?>"
									  />
									</div>
								  </div>
								</div>
								<?php } ?>
							</div>
							
							<script type="text/javascript">$('#language<?php echo $geo_ad_image['geo_ad_image_id'].$geo_row_content; ?> a:first').tab('show');</script>
							  
							  
							  
							  
							  
							  
							  
							</div>
							<?php $geo_row_content ++; ?>
							<?php } ?>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<?php $group_row++; ?>
			<?php } ?>
		  </div>
        </form>
      </div>
    </div>
  </div>
<script type="text/javascript"><!--
function getCountry() {
	$('input[name=\'country\']').autocomplete({
		'source': function(request, response) {
			$.ajax({
				url: 'index.php?route=localisation/country/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
				dataType: 'json',			
				success: function(json) {
					response($.map(json, function(item) {
						return {
							label: item['name'],
							value: item['iso_code_2']
						}
					}));
				}
			});
		},
		'select': function(item) {
			$(this).val('');
			
			var id = $(this).attr('data');
			
			$('#country' + id + item['value']).remove();
			
			$('#country'+id).append('<div id="country' + id + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="geo_ad_image['+id+'][country][]" value="' + item['value'] + '" /></div>');	
		}
	});
}

getCountry();
--></script>
<script type="text/javascript"><!--
$('#group a:first').tab('show');
//$('#language a:first').tab('show');
<?php $group_row = 0; ?>
<?php foreach ($geo_ad_images as $geo_ad_image) { ?>
$('#option<?php echo $group_row; ?> a:first').tab('show');

$('#country<?php echo $group_row; ?>').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});
<?php $group_row++; ?>
<?php } ?>
//--></script>
<script type="text/javascript"><!--
var group_row = <?php echo $group_row; ?>;

function addGroup() {
	var html = '<li><a href="#group'+group_row+'" data-toggle="tab"><i class="fa fa-minus-circle" onclick="$(\'a[href=\\\'#group'+group_row+'\\\']\').parent().remove(); $(\'#group'+group_row+'\').remove(); $(\'#group a:first\').tab(\'show\');"></i> <?php echo $text_group; ?> '+group_row+'</a></li>';
		
	$('#group > li:last-child').before(html);
	
	var html  = '<div class="tab-pane" id="group'+group_row+'">';
		html += '  <div class="tab-content panel-heading" style="margin-bottom:20px;">';
		html += '    <div class="form-group">';
		html += '      <label class="col-sm-2 control-label" for="input-country'+group_row+'"><span data-toggle="tooltip" title="<?php echo $help_country; ?>"><?php echo $entry_country; ?></span></label>';
		html += '      <div class="col-sm-10">';
		html += '      <input type="text" name="country" value="" placeholder="<?php echo $entry_country; ?>" id="input-country'+group_row+'" data="'+group_row+'" class="form-control" />';
		html += '      <div id="country'+group_row+'" class="well well-sm" style="height: 150px; overflow: auto;"></div>';
		html += '      </div>';
		html += '    </div>';
		html += '  </div>';
		html += '  <div class="row">';
		html += '    <div class="col-sm-2">';
		html += '      <ul class="nav nav-pills nav-stacked" id="option'+group_row+'">';
		html += '      <li><a href="#" onclick="addImage(\''+group_row+'\'); return false;"><i class="fa fa-plus-circle"></i> <?php echo $text_image_add; ?></a></li>';
		html += '      </ul>';
		html += '    </div>';
		html += '    <div class="col-sm-10">';
		html += '      <div class="tab-content" id="option-content'+group_row+'"></div>';
		html += '    </div>';
		html += '  </div>';
		html += '</div>';
		
	$('#group-content').append(html);
	$('#group a[href=\'#group'+group_row+'\']').tab('show');
	getCountry();
	
	group_row++;
}

var geo_row = <?php echo $geo_row; ?>;

function addImage(obj) {
	var id = obj+geo_row;
	
	var html = '<li><a href="#tab-option'+id+'" data-toggle="tab"><i class="fa fa-minus-circle" onclick="$(\'a[href=\\\'#tab-option'+id+'\\\']\').parent().remove(); $(\'#tab-option'+id+'\').remove(); $(\'#option a:first\').tab(\'show\');"></i> <?php echo $text_image; ?></a></li>';
		
	$('#option'+obj+' > li:last-child').before(html);
	
	var language_html = '';
		
		// language tab
		language_html += '<ul class="nav nav-tabs" id="language'+id+'">';
		<?php foreach ($languages as $language) { ?>
		language_html += '   <li><a href="#language'+id+'<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>';
		<?php } ?>
		language_html += '</ul>';
		
		// language tab content
		<?php foreach ($languages as $language) { ?>		
		language_html += '<div class="tab-pane" id="language'+id+'<?php echo $language['language_id']; ?>">';
		language_html += '  <div class="form-group">';
		language_html += '    <label class="col-sm-2 control-label" for="input-title'+id+'"><?php echo $entry_title_show; ?></label>';
		language_html += '    <div class="col-sm-10"><input type="text" name="geo_ad_image['+obj+'][geo_ad_image_description]['+geo_row+'][title][<?php echo $language['language_id']; ?>]" value="" placeholder="<?php echo $entry_title_show; ?>" id="input-title'+id+'" class="form-control" /></div>';
		language_html += '  </div>';
		language_html += '  <div class="form-group">';
		language_html += '    <label class="col-sm-2 control-label" for="input-link'+id+'"><?php echo $entry_link; ?></label>';
		language_html += '    <div class="col-sm-10"><input type="text" name="geo_ad_image['+obj+'][geo_ad_image_description]['+geo_row+'][link][<?php echo $language['language_id']; ?>]" value="" placeholder="<?php echo $entry_link; ?>" id="input-link'+id+'" class="form-control" /></div>';
		language_html += '  </div>';
		language_html += '  <div class="form-group">';
		language_html += '    <label class="col-sm-2 control-label" for="input-sort_order'+id+'"><?php echo $entry_sort_order; ?></label>';
		language_html += '    <div class="col-sm-10"><input type="text" name="geo_ad_image['+obj+'][geo_ad_image_description]['+geo_row+'][sort_order][<?php echo $language['language_id']; ?>]" value="" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort_order'+id+'" class="form-control" /></div>';
		language_html += '  </div>';
		language_html += '  <div class="form-group">';
		language_html += '    <label class="col-sm-2 control-label" for="input-image'+id+'"><?php echo $entry_image; ?></label>';
		language_html += '    <div class="col-sm-10"><a href="" id="thumb-image'+id+'<?php echo $language['language_id']; ?>" data-toggle="image" class="img-thumbnail"><img src="<?php echo $placeholder; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a><input type="hidden" name="geo_ad_image['+obj+'][geo_ad_image_description]['+geo_row+'][image][<?php echo $language['language_id']; ?>]" value="" id="input-image'+id+'<?php echo $language['language_id']; ?>" /></div>';
		language_html += '  </div>';
		language_html += '</div>';
		<?php } ?>
		
	var html  = '<div class="tab-pane" id="tab-option'+id+'">';
		html += '<div class="tab-content">' + language_html + '</div>';
		html += '</div>';
		
	$('#option-content'+obj).append(html);
	$('#option'+obj+' a[href=\'#tab-option'+id+'\']').tab('show');
	$('#language'+id+' a:first').tab('show');
	
	geo_row++;
}
--></script>
</div>
<?php echo $footer; ?>