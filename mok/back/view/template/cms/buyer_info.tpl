<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-blog" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-blog" class="form-horizontal">

          <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
              <ul class="nav nav-tabs" id="language">
                <?php foreach ($languages as $language) { ?>
                <li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                <?php } ?>
              </ul>
              <div class="tab-content">
                <?php foreach ($languages as $language) { ?>
                <div class="tab-pan e" id="language<?php echo $language['language_id']; ?>">

                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-nickname<?php echo $language['language_id']; ?>"><?php echo $entry_nickname; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="buyer_info[<?php echo $language['language_id']; ?>][nickname]" value="<?php echo $nickname; ?>" placeholder="<?php echo $entry_nickname; ?>" id="input-nickname<?php echo $language['language_id']; ?>" class="form-control" />
                      <?php if (isset($error_nickname[$language['language_id']])) { ?>
                      <div class="text-danger"><?php echo $error_nickname[$language['language_id']]; ?></div>
                      <?php } ?>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $entry_head_image; ?></label>
                    <div class="col-sm-10"><a href="" id="thumb-head_image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $head_thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                      <input type="hidden" name="buyer_info[<?php echo $language['language_id']; ?>][head_image]" value="<?php echo $head_image; ?>" id="input-head_image" />
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $entry_show_image; ?></label>
                    <div class="col-sm-10"><a href="" id="thumb-show_image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $show_thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                      <input type="hidden" name="buyer_info[<?php echo $language['language_id']; ?>][show_image]" value="<?php echo $show_image; ?>" id="input-show_image" />
                    </div>
                  </div>

                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-intro<?php echo $language['language_id']; ?>"><?php echo $entry_intro; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="buyer_info[<?php echo $language['language_id']; ?>][intro]" value="<?php echo $intro; ?>" placeholder="<?php echo $entry_intro; ?>" id="input-intro<?php echo $language['language_id']; ?>" class="form-control" />
                      <?php if (isset($error_intro[$language['language_id']])) { ?>
                      <div class="text-danger"><?php echo $error_intro[$language['language_id']]; ?></div>
                      <?php } ?>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-introduce<?php echo $language['language_id']; ?>"><?php echo $entry_introduce; ?></label>
                    <div class="col-sm-10">
                      <input type="hidden" name='buyer_id' value="<?php echo $buyer_id;?>" />
                      <textarea name="buyer_info[<?php echo $language['language_id']; ?>][introduce]" rows="5" placeholder="<?php echo $entry_introduce; ?>" id="input-introduce<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($introduce) ? $introduce : ''; ?></textarea>
                      <?php if (isset($error_introduce[$language['language_id']])) { ?>
                      <div class="text-danger"><?php echo $error_introduce[$language['language_id']]; ?></div>
                      <?php } ?>
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
</div>
<?php echo $footer; ?> 