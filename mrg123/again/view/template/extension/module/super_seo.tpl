<?php echo $header; ?>
<?php echo $column_left; ?>
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
		<div class = "panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-pencil"></i><?php echo $text_edit; ?></h3>
			</div>
			<div class="panel-body">
			<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-super-seo" class="form-horizontal">
			<table class="table table-hover">
			<thead>
				<tr>
				<td class="col-sm-4"><strong><?php echo $description_route; ?></strong></td>
				<td colspan="2" class="col-sm-8"><strong><?php echo $description_url; ?></strong></td>
				</tr>
			</thead>
			<tbody>
			<tr>
				<td><input type = "text" name = "route" /></td>
				<td><input type = "text" name = "url" /></td>
				<td><button type="submit" form="form-featured" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button></td>
			</tr>
				<?php foreach($super_seo_urls as $url) { ?>
					<tr>
						<td><?php echo $url['query']; ?></td>
						<td><?php echo $url['keyword']; ?></td>
						<td><a href = "<?php echo $url['delete']; ?>" class = "btn btn-danger"><?php echo $button_delete; ?></a></td>
					</tr>
				<?php } ?>
			</tbody>
			</table>
			</form>
			</div>
		</div> 
		
	</div>

</div> 

<?php echo $footer; ?>
