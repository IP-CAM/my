<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-prizmpay" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href ="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
            </div>

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
            <div class="panel-body">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-prizmpay" class="form form-horizontal">
                    <div class="tab-content">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-weight-cost"><?php echo $entry_description; ?></label>
                            <div class="col-sm-10">
                                <?php foreach ($languages as $language) { ?>
                                <div style="margin-bottom:10px;"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><textarea name="prizmpay_description[<?php echo $language['language_id']; ?>]" rows="5" class="form-control"><?php echo $prizmpay_description[$language['language_id']]?$prizmpay_description[$language['language_id']]:''; ?></textarea></div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="prizmpay_merchan"><?php echo $entry_merchant; ?></label>
                            <div class="col-sm-10">
                                <input type="text" name="prizmpay_merchant" value="<?php echo $prizmpay_merchant; ?>" placeholder="<?php echo $entry_merchant; ?>" id="amazon-login-pay-merchant-id" class="form-control" />
                                <?php if ($error_merchant) { ?>
                                <div class="text-danger"><?php echo $error_merchant; ?></div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="prizmpay_security"> <?php echo $entry_security; ?></label>
                            <div class="col-sm-10">
                                <input type="text" name="prizmpay_security" value="<?php echo $prizmpay_security; ?>" placeholder="<?php echo $entry_security; ?>" id="amazon-login-pay-merchant-id" class="form-control" size="80"/>
                                <?php if ($error_security) { ?>
                                <div class="text-danger"><?php echo $error_security; ?></div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="prizmpay_default_currency"><?php echo $entry_default_currency; ?></label>
                            <div class="col-sm-10">
                                <select name="prizmpay_default_currency" id="prizmpay_default_currency" class="form-control">
                                    <?php foreach ($prizmpay_currencys as $temp) { ?>
                                    <?php if ($temp == $prizmpay_default_currency) { ?>
                                    <option value="<?php echo $temp; ?>" selected="selected"><?php echo $temp; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $temp; ?>"><?php echo $temp; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="prizmpay_merchan"><?php echo $entry_merchant_cup; ?></label>
                            <div class="col-sm-10">
                                <input type="text" name="prizmpay_merchant_cup" value="<?php echo $prizmpay_merchant_cup; ?>" placeholder="<?php echo $entry_merchant_cup; ?>" id="amazon-login-pay-merchant-id" class="form-control" />
                                <?php if ($error_merchant) { ?>
                                <div class="text-danger"><?php echo $error_merchant; ?></div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="prizmpay_security_cup"> <?php echo $entry_security_cup; ?></label>
                            <div class="col-sm-10">
                                <input type="text" name="prizmpay_security_cup" value="<?php echo $prizmpay_security_cup; ?>" placeholder="<?php echo $entry_security; ?>" id="amazon-login-pay-merchant-id" class="form-control" size="80"/>
                                <?php if ($error_security) { ?>
                                <div class="text-danger"><?php echo $error_security; ?></div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="prizmpay_mode">Mode:</label>
                            <div class="col-sm-10">
                                <select name="prizmpay_mode" id="prizmpay_mode" class="form-control">
                                    <?php foreach ($prizmpay_modes as $temp) { ?>
                                    <?php if ($temp == $prizmpay_mode) { ?>
                                    <option value="<?php echo $temp; ?>" selected="selected"><?php echo $temp; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $temp; ?>"><?php echo $temp; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="prizmpay_paymethod">Payment Method:</label>
                            <div class="col-sm-10">
                                <select name="prizmpay_paymethod" id="prizmpay_paymethod" class="form-control">
                                    <?php foreach ($prizmpay_paymethods as $temp) { ?>
                                    <?php if ($temp == $prizmpay_paymethod) { ?>
                                    <option value="<?php echo $temp; ?>" selected="selected"><?php echo $temp; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $temp; ?>"><?php echo $temp; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="prizmpay_order_status_id"><?php echo $entry_order_status; ?></label>
                            <div class="col-sm-10">
                                <select name="prizmpay_order_status_id" id="prizmpay_order_status_id" class="form-control">
                                    <?php foreach ($order_statuses as $order_status) { ?>
                                    <?php if ($order_status['order_status_id'] == $prizmpay_order_status_id) { ?>
                                    <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="prizmpay_status"><?php echo $entry_status; ?></label>
                            <div class="col-sm-10">
                                <select name="prizmpay_status" id="prizmpay_status" class="form-control">
                                    <?php if ($prizmpay_status) { ?>
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
                            <label class="col-sm-2 control-label" for="prizmpay_security"><?php echo $entry_sort_order; ?></label>
                            <div class="col-sm-10">
                                <input type="text" name="prizmpay_sort_order" value="<?php echo $prizmpay_sort_order; ?>" size="1" placeholder="<?php echo $entry_sort_order; ?>" id="amazon-login-pay-merchant-id" class="form-control" size="80"/>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php echo $footer; ?>


