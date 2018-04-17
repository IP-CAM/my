<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-order" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-order" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
              <div class="row">
                
                <div class="col-sm-10">
                  <div class="tab-content">
                    <div class="tab-pane active" id="tab-order">
                      <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-country"><?php echo $entry_express_company; ?></label>
                        <div class="col-sm-10">
                          <select name="express_company_id" id="input-express-company" class="form-control">
                            <option value=""><?php echo $text_select; ?></option>
                            <?php foreach ($express_companies as $express_company) { ?>
                            <?php if ($express_company['express_company_id'] == $express_company_id) { ?>
                            <option value="<?php echo $express_company['express_company_id']; ?>" selected="selected"><?php echo $express_company['name']; ?></option>
                            <?php } else { ?>
                            <option value="<?php echo $express_company['express_company_id']; ?>"><?php echo $express_company['name']; ?></option>
                            <?php } ?>
                            <?php } ?>
                          </select>
                          
                          <?php if ($error_express_company) { ?>
                          <div class="text-danger"><?php echo $error_express_company; ?></div>
                          <?php } ?>
                          
                        </div>
                      </div>
                      
                      <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-express-no"><?php echo $entry_express_no; ?></label>
                        <div class="col-sm-10">
                          <input type="text" name="express_no" value="<?php echo $express_no; ?>" placeholder="<?php echo $entry_express_no; ?>" id="input-express-no" class="form-control" />
                          <?php if ($error_express_no) { ?>
                          <div class="text-danger"><?php echo $error_express_no; ?></div>
                          <?php } ?>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>