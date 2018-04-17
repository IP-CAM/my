<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-category" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-category" class="form-horizontal">
		<div class="form-group">
            <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?></label>
            <div class="col-sm-10">
              <input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
              <?php if ($error_name) { ?>
              <div class="text-danger"><?php echo $error_name; ?></div>
              <?php } ?>
            </div>
          </div>
		  
		  <div class="form-group">
            <label class="col-sm-2 control-label" for="input-width"><?php echo $entry_width; ?></label>
            <div class="col-sm-10">
              <input type="text" name="width" value="<?php echo $width; ?>" placeholder="<?php echo $entry_width; ?>" id="input-width" class="form-control" />
              <?php if ($error_width) { ?>
              <div class="text-danger"><?php echo $error_width; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-height"><?php echo $entry_height; ?></label>
            <div class="col-sm-10">
              <input type="text" name="height" value="<?php echo $height; ?>" placeholder="<?php echo $entry_height; ?>" id="input-height" class="form-control" />
              <?php if ($error_height) { ?>
              <div class="text-danger"><?php echo $error_height; ?></div>
              <?php } ?>
            </div>
          </div>
		  
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
		  
		    <h2><?php echo $text_category_banner; ?></h2>
			<table id="category_banner_table" class="table">
			<thead>
				<tr>
				<td><strong><?php echo $image_src; ?></strong></td>
				<td><strong><?php echo $image_alt; ?></strong></td>
				<td><strong><?php echo $image_href; ?></strong></td>
				<td><strong><?php echo $image_sort; ?></strong></td>
				<td><strong><?php echo $text_move;?></strong></td>
				</tr>
			</thead>

			<?php $row_cb=0;?>
			<?php foreach($category_banners as $category_banner) { ?>
			<tbody id="category_banner<?php echo $row_cb;?>">
				<tr>
				<td>
				<a href="javascript:void(0);" id="thumb-image_<?php echo $row_cb; ?>" data-toggle="image" class="img-thumbnail"><img src="<?php echo $category_banner['thumb']; ?>" data-placeholder="<?php echo $placeholder; ?>"/></a>
				
				<input type="hidden" name="category_banner[<?php echo $row_cb;?>][src]" value="<?php echo $category_banner['src'];?>" size="60" id="input-image_<?php echo $row_cb; ?>"/>
				</td>
				<td><input type="text" name="category_banner[<?php echo $row_cb;?>][alt]" value="<?php echo $category_banner['alt'];?>" size="20" class="form-control"/></td>
				<td><input type="text" name="category_banner[<?php echo $row_cb;?>][href]" value="<?php echo $category_banner['href'];?>" size="60" class="form-control"/></td>
				<td><input type="text" name="category_banner[<?php echo $row_cb;?>][sort]" value="<?php echo $category_banner['sort'];?>" class="form-control"/></td>
				<td><a onclick="$('#category_banner<?php echo $row_cb;?>').remove();" class="btn btn-primary"><?php echo $text_move;?></a></td>
				</tr>
			</tbody>
			<?php $row_cb++;?>
			<?php } ?>
			<tfoot>
				<tr>
				<td colspan="4"></td>
				<td><a onclick="addcategory_banner();" class="btn btn-primary"><?php echo $text_add;?></a></td>
				</tr>
			</tfoot>
			</table>
			
        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript"><!--
//category_banner
var row_cb=<?php echo $row_cb;?>;
function addcategory_banner(){
	html = '<tbody id="category_banner'+row_cb+'">';
	html +='<tr><td><a href="javascript:void(0);" id="thumb-image_'+row_cb+'" data-toggle="image" class="img-thumbnail"><img src="<?php echo $placeholder; ?>" data-placeholder="<?php echo $placeholder; ?>"/></a><input type="hidden" name="category_banner['+row_cb+'][src]"value=""size="60" id="input-image_'+row_cb+'"/></td>';
	html +='<td><input type="text" name="category_banner['+row_cb+'][alt]"value=""size="20" class="form-control"/></td>';
	html +='<td><input type="text" name="category_banner['+row_cb+'][href]"value=""size="60" class="form-control"/></td>';
	html +='<td><input type="text" name="category_banner['+row_cb+'][sort]"value="" class="form-control"/></td>';
	html +='<td><a onclick="$(\'#category_banner'+row_cb+'\').remove();"class="btn btn-primary"><?php echo $text_move;?></a></td>';
	html +='</tr></tbody>';
	$('#category_banner_table tfoot').before(html);
	row_cb++;
}
</script>
<?php echo $footer; ?>