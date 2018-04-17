<?php echo $header; ?><?php echo $column_left; ?>
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

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $heading_title; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-weibo-login" class="form-horizontal">

          <div class="form-group required">
            <label class="col-sm-2 control-label" for="entry-appkey"><?php echo $entry_customer; ?></label>
            <div class="col-sm-10">
              <input type="text" name="customer" value="<?php echo $value_customer;?>" placeholder="<?php echo $entry_customer; ?>"  class="form-control"/>
              <?php if ($error_customer) { ?>
              <div class="text-danger"><?php echo $error_customer; ?></div>
              <?php } ?>
            </div>
          </div>

        <!--用户组-->
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="entry-appkey"><?php echo $entry_customer_group; ?></label>
            <div class="col-sm-10">
              <select name="customer_group">
                  <option value="0">---请选择---</option>

                  <?php
                    foreach($customer_group as $v){
                ?>
                <option value="<?php echo $v['customer_group_id']?>">---<?php echo $v['name']?>---</option>
                <?php
                    }
                ?>
              </select>
              <?php if ($error_delivering_way) { ?>
              <div class="text-danger"><?php echo $error_delivering_way; ?></div>
              <?php } ?>
            </div>
          </div>

          <!--所有用户-->
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="entry-appkey"><?php echo $entry_customer_all; ?></label>
            <div class="col-sm-10">
              <input type="radio" name="is_all_customer" value="0" checked="checked"/>否　　　
              <input type="radio" name="is_all_customer" value="1" />是
              <?php if ($error_delivering_way) { ?>
              <div class="text-danger"><?php echo $error_delivering_way; ?></div>
              <?php } ?>
            </div>
          </div>

          <div class="form-group required">
            <label class="col-sm-2 control-label" for="entry-appsecret"><?php echo $entry_coupon_code; ?></label>
            <div class="col-sm-10">
              <input type="text" name="coupon_code" value="<?php echo $value_coupon_code;?>" placeholder="<?php echo $entry_coupon_code; ?>" id="entry-appsecret" class="form-control"/>
              <?php if ($error_coupon_code) { ?>
              <div class="text-danger"><?php echo $error_coupon_code; ?></div>
              <?php } ?>
            </div>
          </div>

          <div class="form-group required">
            <label class="col-sm-2 control-label" for="entry-appsecret"><?php echo $entry_coupon_num; ?></label>
            <div class="col-sm-10">
              <input type="text" name="coupon_num" value="<?php echo $value_coupon_num;?>" placeholder="<?php echo $entry_coupon_num; ?>" id="entry-appsecret" class="form-control"/>
              <?php if ($error_coupon_num) { ?>
              <div class="text-danger"><?php echo $error_coupon_num; ?></div>
              <?php } ?>
            </div>
          </div>

          <button type="submit" form="form-weibo-login" data-toggle="tooltip" title="<?php echo $button; ?>" class="btn btn-primary" style="margin-left: 800px;"><?php echo $button; ?></button>

        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>