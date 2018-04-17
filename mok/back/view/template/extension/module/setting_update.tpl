<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
	<div class="page-header">
		<div class="container-fluid">
			<div class="pull-right">
				<button type="submit" form="form-account" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
				<a href="<?php echo $cancel;?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
			</div>
			<h1><?php echo $heading_title; ?></h1>
			<ul class="breadcrumb">
				<?php foreach($breadcrumbs as $breadcrumb) { ?>
					<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
	<div class="container-fluid">
		<?php if($error_warning) { ?>
			<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i><?php echo $error_warning; ?>
			<button type="button" class="close" data-dismiss="alert">&times;</button></div>
		<?php } ?>
		<?php if ($success) { ?>
			<div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			</div>
		<?php } ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-pencil"></i><?php echo $text_edit; ?></h3>
			</div>
			<div class="panel-body">
				<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-setting-update" class="form-horizontal">
				
				<!-- search_tags -->
				<h2><?php echo $text_search_tags; ?></h2>
					<table id="setdiy_search_tag_table" class="table">
			<thead>
				<tr>
				
				<td><strong><?php echo $image_alt; ?></strong></td>
				<td><strong><?php echo $image_href; ?></strong></td>
				<td><strong><?php echo $image_sort; ?></strong></td>
				<td><strong><?php echo $text_move;?></strong></td>
				</tr>
			</thead>
			<?php $row_st=0;?>
			<?php foreach($setdiy_search_tags as $setdiy_search_tag) { ?>
			<tbody id="setdiy_search_tag<?php echo $row_st;?>">
				<tr>
				
				<td><input type="text" name="setdiy_search_tag[<?php echo $row_st;?>][alt]" value="<?php echo $setdiy_search_tag['alt'];?>" size="20"/></td>
				<td><input type="text" name="setdiy_search_tag[<?php echo $row_st;?>][href]" value="<?php echo $setdiy_search_tag['href'];?>" size="60"/></td>
				<td><input type="text" name="setdiy_search_tag[<?php echo $row_st;?>][sort]" value="<?php echo $setdiy_search_tag['sort'];?>"/></td>
				<td><a onclick="$('#setdiy_search_tag<?php echo $row_st;?>').remove();" class="btn btn-primary"><?php echo $text_move;?></a></td>
				</tr>
			</tbody>
			<?php $row_st++;?>
			<?php } ?>
			<tfoot>
				<tr>
				<td colspan="3"></td>
				<td><a onclick="addsetdiy_search_tag();" class="btn btn-primary"><?php echo $text_add;?></a></td>
				</tr>
			</tfoot>
			</table>
			<!-- end -->
			

				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript"><!--
//setdiy_search_tag
var row_st=<?php echo $row_st;?>;
function addsetdiy_search_tag(){
	html = '<tbody id="setdiy_search_tag'+row_st+'">';
	html +='<tr>';
	html +='<td><input type="text" name="setdiy_search_tag['+row_st+'][alt]"value=""size="20" class="form-control"/></td>';
	html +='<td><input type="text" name="setdiy_search_tag['+row_st+'][href]"value=""size="60" class="form-control"/></td>';
	html +='<td><input type="text" name="setdiy_search_tag['+row_st+'][sort]"value="" class="form-control"/></td>';
	html +='<td><a onclick="$(\'#setdiy_search_tag'+row_st+'\').remove();"class="btn btn-primary"><?php echo $text_move;?></a></td>';
	html +='</tr></tbody>';
	$('#setdiy_search_tag_table tfoot').before(html);
	row_st++;
}
</script>
<?php echo $footer; ?>















