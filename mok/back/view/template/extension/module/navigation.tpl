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
            <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?></label>
            <div class="col-sm-10">
              <input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
              <?php if ($error_name) { ?>
              <div class="text-danger"><?php echo $error_name; ?></div>
              <?php } ?>
            </div>
          </div> 
		  
		  <div class="form-group">
            <label class="col-sm-2 control-label" for="input-template_id"><?php echo $entry_template; ?></label>
            <div class="col-sm-10">
              <select name="template_id" id="input-template_id" class="form-control">
			  <?php foreach($templates as $template){ ?>
				<option value="<?php echo $template['template_id']; ?>"<?php if($template['template_id'] == $template_id){echo " selected=\"selected\"";}?>><?php echo $template['name']; ?></option>
			  <?php } ?>
              </select>
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
		 
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab0" data-toggle="tab"><?php echo $text_navigation1; ?></a></li>
			<li><a href="#tab1" data-toggle="tab"><?php echo $text_navigation2; ?></a></li>
			<li><a href="#tab2" data-toggle="tab"><?php echo $text_navigation3; ?></a></li>
			<li><a href="#tab3" data-toggle="tab"><?php echo $text_navigation4; ?></a></li>
			<li><a href="javascript:void(0)">+</a></li>
		</ul>
		<div class="tab-content">
		  
          <div class="tab-pane active" id="tab0">
            <ul class="nav nav-tabs" id="language0">
              <?php foreach ($languages as $language) { ?>
              <li><a href="#language0<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
              <?php } ?>
            </ul>
            <div class="tab-content">
              <?php foreach ($languages as $language) { ?>
              <div class="tab-pane" id="language0<?php echo $language['language_id']; ?>">
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-title<?php echo $language['language_id']; ?>"><?php echo $entry_title; ?></label>
                  <div class="col-sm-10">
                    <input type="text" name="module_description[0][<?php echo $language['language_id']; ?>][title]" placeholder="<?php echo $entry_title; ?>" id="input-title<?php echo $language['language_id']; ?>" value="<?php echo isset($module_description[0][$language['language_id']]['title']) ? $module_description[0][$language['language_id']]['title'] : ''; ?>" class="form-control" />
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label" for="input-href<?php echo $language['language_id']; ?>"><?php echo $entry_href; ?></label>
                  <div class="col-sm-10">
                    <input type="text" name="module_description[0][<?php echo $language['language_id']; ?>][href]" placeholder="<?php echo $entry_href; ?>" id="input-href<?php echo $language['language_id']; ?>" value="<?php echo isset($module_description[0][$language['language_id']]['href']) ? $module_description[0][$language['language_id']]['href'] : ''; ?>" class="form-control" />
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label" for="input-class<?php echo $language['language_id']; ?>"><?php echo $entry_class; ?></label>
				<div class="col-sm-10">
                    <input type="text" name="module_description[0][<?php echo $language['language_id']; ?>][class]" placeholder="<?php echo $entry_class; ?>" id="input-class<?php echo $language['language_id']; ?>" value="<?php echo isset($module_description[0][$language['language_id']]['class']) ? $module_description[0][$language['language_id']]['class'] : ''; ?>" class="form-control" />
                </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label" for="input-sort_order<?php echo $language['language_id']; ?>"><?php echo $entry_sort_order; ?></label>
				<div class="col-sm-10">
                    <input type="text" name="module_description[0][<?php echo $language['language_id']; ?>][sort_order]" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort_order<?php echo $language['language_id']; ?>" value="<?php echo isset($module_description[0][$language['language_id']]['sort_order']) ? $module_description[0][$language['language_id']]['sort_order'] : ''; ?>" class="form-control" />
                </div>
                </div>
              </div>
              <?php } ?>
            </div>
          </div>
		  
		  <div class="tab-pane" id="tab1">
            <ul class="nav nav-tabs" id="language1">
              <?php foreach ($languages as $language) { ?>
              <li><a href="#language1<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
              <?php } ?>
            </ul>
            <div class="tab-content">
              <?php foreach ($languages as $language) { ?>
              <div class="tab-pane" id="language1<?php echo $language['language_id']; ?>">
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-title<?php echo $language['language_id']; ?>"><?php echo $entry_title; ?></label>
                  <div class="col-sm-10">
                    <input type="text" name="module_description[1][<?php echo $language['language_id']; ?>][title]" placeholder="<?php echo $entry_title; ?>" id="input-title<?php echo $language['language_id']; ?>" value="<?php echo isset($module_description[1][$language['language_id']]['title']) ? $module_description[1][$language['language_id']]['title'] : ''; ?>" class="form-control" />
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label" for="input-href<?php echo $language['language_id']; ?>"><?php echo $entry_href; ?></label>
                  <div class="col-sm-10">
                    <input type="text" name="module_description[1][<?php echo $language['language_id']; ?>][href]" placeholder="<?php echo $entry_href; ?>" id="input-href<?php echo $language['language_id']; ?>" value="<?php echo isset($module_description[1][$language['language_id']]['href']) ? $module_description[1][$language['language_id']]['href'] : ''; ?>" class="form-control" />
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label" for="input-class<?php echo $language['language_id']; ?>"><?php echo $entry_class; ?></label>
				<div class="col-sm-10">
                    <input type="text" name="module_description[1][<?php echo $language['language_id']; ?>][class]" placeholder="<?php echo $entry_class; ?>" id="input-class<?php echo $language['language_id']; ?>" value="<?php echo isset($module_description[1][$language['language_id']]['class']) ? $module_description[1][$language['language_id']]['class'] : ''; ?>" class="form-control" />
                </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label" for="input-sort_order<?php echo $language['language_id']; ?>"><?php echo $entry_sort_order; ?></label>
				<div class="col-sm-10">
                    <input type="text" name="module_description[1][<?php echo $language['language_id']; ?>][sort_order]" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort_order<?php echo $language['language_id']; ?>" value="<?php echo isset($module_description[1][$language['language_id']]['sort_order']) ? $module_description[1][$language['language_id']]['sort_order'] : ''; ?>" class="form-control" />
                </div>
                </div>
              </div>
              <?php } ?>
            </div>
          </div>
		  
		  <div class="tab-pane" id="tab2">
			<ul class="nav nav-tabs" id="language2">
              <?php foreach ($languages as $language) { ?>
              <li><a href="#language2<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
              <?php } ?>
            </ul>
            <div class="tab-content">
              <?php foreach ($languages as $language) { ?>
              <div class="tab-pane" id="language2<?php echo $language['language_id']; ?>">
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-title<?php echo $language['language_id']; ?>"><?php echo $entry_title; ?></label>
                  <div class="col-sm-10">
                    <input type="text" name="module_description[2][<?php echo $language['language_id']; ?>][title]" placeholder="<?php echo $entry_title; ?>" id="input-title<?php echo $language['language_id']; ?>" value="<?php echo isset($module_description[2][$language['language_id']]['title']) ? $module_description[2][$language['language_id']]['title'] : ''; ?>" class="form-control" />
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label" for="input-href<?php echo $language['language_id']; ?>"><?php echo $entry_href; ?></label>
                  <div class="col-sm-10">
                    <input type="text" name="module_description[2][<?php echo $language['language_id']; ?>][href]" placeholder="<?php echo $entry_href; ?>" id="input-href<?php echo $language['language_id']; ?>" value="<?php echo isset($module_description[2][$language['language_id']]['href']) ? $module_description[2][$language['language_id']]['href'] : ''; ?>" class="form-control" />
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label" for="input-class<?php echo $language['language_id']; ?>"><?php echo $entry_class; ?></label>
				<div class="col-sm-10">
                    <input type="text" name="module_description[2][<?php echo $language['language_id']; ?>][class]" placeholder="<?php echo $entry_class; ?>" id="input-class<?php echo $language['language_id']; ?>" value="<?php echo isset($module_description[2][$language['language_id']]['class']) ? $module_description[2][$language['language_id']]['class'] : ''; ?>" class="form-control" />
                </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label" for="input-sort_order<?php echo $language['language_id']; ?>"><?php echo $entry_sort_order; ?></label>
				<div class="col-sm-10">
                    <input type="text" name="module_description[2][<?php echo $language['language_id']; ?>][sort_order]" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort_order<?php echo $language['language_id']; ?>" value="<?php echo isset($module_description[2][$language['language_id']]['sort_order']) ? $module_description[2][$language['language_id']]['sort_order'] : ''; ?>" class="form-control" />
                </div>
                </div>
              </div>
              <?php } ?>
            </div>
		  </div>
		  
		  <div class="tab-pane" id="tab3">
			<ul class="nav nav-tabs" id="language3">
              <?php foreach ($languages as $language) { ?>
              <li><a href="#language3<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
              <?php } ?>
            </ul>
            <div class="tab-content">
              <?php foreach ($languages as $language) { ?>
              <div class="tab-pane" id="language3<?php echo $language['language_id']; ?>">
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-title<?php echo $language['language_id']; ?>"><?php echo $entry_title; ?></label>
                  <div class="col-sm-10">
                    <input type="text" name="module_description[3][<?php echo $language['language_id']; ?>][title]" placeholder="<?php echo $entry_title; ?>" id="input-title<?php echo $language['language_id']; ?>" value="<?php echo isset($module_description[3][$language['language_id']]['title']) ? $module_description[3][$language['language_id']]['title'] : ''; ?>" class="form-control" />
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label" for="input-href<?php echo $language['language_id']; ?>"><?php echo $entry_href; ?></label>
                  <div class="col-sm-10">
                    <input type="text" name="module_description[3][<?php echo $language['language_id']; ?>][href]" placeholder="<?php echo $entry_href; ?>" id="input-href<?php echo $language['language_id']; ?>" value="<?php echo isset($module_description[3][$language['language_id']]['href']) ? $module_description[3][$language['language_id']]['href'] : ''; ?>" class="form-control" />
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label" for="input-class<?php echo $language['language_id']; ?>"><?php echo $entry_class; ?></label>
				<div class="col-sm-10">
                    <input type="text" name="module_description[3][<?php echo $language['language_id']; ?>][class]" placeholder="<?php echo $entry_class; ?>" id="input-class<?php echo $language['language_id']; ?>" value="<?php echo isset($module_description[3][$language['language_id']]['class']) ? $module_description[3][$language['language_id']]['class'] : ''; ?>" class="form-control" />
                </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label" for="input-sort_order<?php echo $language['language_id']; ?>"><?php echo $entry_sort_order; ?></label>
				<div class="col-sm-10">
                    <input type="text" name="module_description[3][<?php echo $language['language_id']; ?>][sort_order]" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort_order<?php echo $language['language_id']; ?>" value="<?php echo isset($module_description[3][$language['language_id']]['sort_order']) ? $module_description[3][$language['language_id']]['sort_order'] : ''; ?>" class="form-control" />
                </div>
                </div>
              </div>
              <?php } ?>
            </div>
		  </div>
		
		
          
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="view/javascript/summernote/summernote.js"></script>
  <link href="view/javascript/summernote/summernote.css" rel="stylesheet" />
  <script type="text/javascript" src="view/javascript/summernote/opencart.js"></script>  
  <script type="text/javascript"><!--
$('#language0 a:first').tab('show');
$('#language1 a:first').tab('show');
$('#language2 a:first').tab('show');
$('#language3 a:first').tab('show');
//--></script></div>

<script type="text/javascript">



</script>


<?php echo $footer; ?>