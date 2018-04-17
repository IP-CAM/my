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
                    <label class="col-sm-2 control-label" for="input-nickname<?php echo $language['language_id']; ?>"><?php echo $entry_title; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="buyer_blog[<?php echo $language['language_id']; ?>][title]" value="<?php echo $title; ?>" placeholder="<?php echo $entry_title; ?>" id="input-nickname<?php echo $language['language_id']; ?>" class="form-control" />
                      <?php if (isset($error_nickname[$language['language_id']])) { ?>
                      <div class="text-danger"><?php echo $error_nickname[$language['language_id']]; ?></div>
                      <?php } ?>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $entry_image; ?></label>
                    <div class="col-sm-10"><a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                      <input type="hidden" name="buyer_blog[<?php echo $language['language_id']; ?>][image]" value="<?php echo $image; ?>" id="input-image" />
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-product-related"><?php echo $entry_product; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="prelated" value="" placeholder="<?php echo $entry_product_related; ?>" id="input-product-related" class="form-control" />
                      <div id="product-related" class="well well-sm" style="height: 150px; overflow: auto;">
                        <?php if($product_relateds['product_id']) { ?>
                        <div id="product-related<?php echo $product_relateds['product_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $product_relateds['name']; ?>
                          <input type="hidden" name="buyer_blog[<?php echo $language['language_id']; ?>][product_related][]" value="<?php echo $product_relateds['product_id']; ?>" />
                        </div>
                        <?php } ?>
                      </div>
                    </div>
                  </div>

                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-nickname<?php echo $language['language_id']; ?>"><?php echo $entry_buyer; ?></label>
                    <div class="col-sm-10">

                      <select name="buyer_info_id">
                          <?php
                            if($all_buyers){
                              foreach($all_buyers as $row){
                        ?>
                          <option value="<?php echo $row['buyer_info_id'];?>" <?php if($buyer_info_id==$row['buyer_info_id']){ echo "selected='selected'";}?>> <?php echo $row['nickname'];?></option>
                          <?php
                              }
                            }
                        ?>
                      </select>

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

    // Product Related
    $('input[name=\'prelated\']').autocomplete({
      'source': function(request, response) {
        $.ajax({
          url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
          dataType: 'json',
          success: function(json) {
            response($.map(json, function(item) {
              return {
                label: item['name'],
                value: item['product_id']
              }
            }));
          }
        });
      },
      'select': function(item) {
        $('input[name=\'prelated\']').val('');

        $('#product-related' + item['value']).remove();

        $('#product-related').append('<div id="product-related' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="buyer_blog[<?php echo $language['language_id']; ?>][product_related][]" value="' + item['value'] + '" /></div>');
      }
    });

    $('#product-related').delegate('.fa-minus-circle', 'click', function() {
      $(this).parent().remove();
    });
    //--></script>


  <script type="text/javascript"><!--

    // Blog Related
    $('input[name=\'brelated\']').autocomplete({
      'source': function(request, response) {
        $.ajax({
          url: 'index.php?route=cms/blog/autocomplete&token=<?php echo $token; ?>&filter_title=' +  encodeURIComponent(request),
          dataType: 'json',
          success: function(json) {
            response($.map(json, function(item) {
              return {
                label: item['title'],
                value: item['blog_id']
              }
            }));
          }
        });
      },
      'select': function(item) {
        $('input[name=\'brelated\']').val('');

        $('#blog-related' + item['value']).remove();

        $('#blog-related').append('<div id="blog-related' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="blog_related[]" value="' + item['value'] + '" /></div>');
      }
    });

    $('#blog-related').delegate('.fa-minus-circle', 'click', function() {
      $(this).parent().remove();
    });
    //--></script>

  <script type="text/javascript"><!--
    $('.date').datetimepicker({
      pickTime: false
    });

    $('.time').datetimepicker({
      pickDate: false
    });

    $('.datetime').datetimepicker({
      pickDate: true,
      pickTime: true
    });
    //--></script>

  <script type="text/javascript"><!--
    $('#language a:first').tab('show');
    //--></script></div>
<?php echo $footer; ?> 