<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-paymentasia" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-paymentasia" class="form form-horizontal">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab-merchant" data-toggle="tab"><?php echo $tab_merchant; ?></a></li>
                        <li><a href="#tab-display-name" data-toggle="tab"><?php echo $tab_display_name; ?></a></li>
                        <li><a href="#tab-description" data-toggle="tab"><?php echo $tab_description; ?></a></li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-merchant">
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="paymentasia_merchan"><?php echo $entry_merchant; ?></label>
                                <div class="col-sm-10">
                                    <input type="text" name="paymentasia_merchant" value="<?php echo $paymentasia_merchant; ?>" placeholder="<?php echo $entry_merchant; ?>" id="amazon-login-pay-merchant-id" class="form-control" />
                                    <?php if ($error_merchant) { ?>
                                    <div class="text-danger"><?php echo $error_merchant; ?></div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="paymentasia_security"> <?php echo $entry_security; ?></label>
                                <div class="col-sm-10">
                                    <input type="text" name="paymentasia_security" value="<?php echo $paymentasia_security; ?>" placeholder="<?php echo $entry_security; ?>" id="amazon-login-pay-merchant-id" class="form-control" size="80"/>
                                    <?php if ($error_security) { ?>
                                    <div class="text-danger"><?php echo $error_security; ?></div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="paymentasia_mode">Mode:</label>
                                <div class="col-sm-10">
                                    <select name="paymentasia_mode" id="paymentasia_mode" class="form-control">
                                        <?php foreach ($paymentasia_modes as $temp) { ?>
                                        <?php if ($temp == $paymentasia_mode) { ?>
                                        <option value="<?php echo $temp; ?>" selected="selected"><?php echo $temp; ?></option>
                                        <?php } else { ?>
                                        <option value="<?php echo $temp; ?>"><?php echo $temp; ?></option>
                                        <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="paymentasia_paymethod">Payment Method:</label>
                                <div class="col-sm-10">
                                    <select name="paymentasia_paymethod" id="paymentasia_paymethod" class="form-control">
                                        <?php foreach ($paymentasia_paymethods as $temp) { ?>
                                        <?php if ($temp == $paymentasia_paymethod) { ?>
                                        <option value="<?php echo $temp; ?>" selected="selected"><?php echo $temp; ?></option>
                                        <?php } else { ?>
                                        <option value="<?php echo $temp; ?>"><?php echo $temp; ?></option>
                                        <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="paymentasia_order_status_id"><?php echo $entry_order_status; ?></label>
                                <div class="col-sm-10">
                                    <select name="paymentasia_order_status_id" id="paymentasia_order_status_id" class="form-control">
                                        <?php foreach ($order_statuses as $order_status) { ?>
                                        <?php if ($order_status['order_status_id'] == $paymentasia_order_status_id) { ?>
                                        <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                                        <?php } else { ?>
                                        <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                                        <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="paymentasia_status"><?php echo $entry_status; ?></label>
                                <div class="col-sm-10">
                                    <select name="paymentasia_status" id="paymentasia_status" class="form-control">
                                        <?php if ($paymentasia_status) { ?>
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
                                <label class="col-sm-2 control-label" for="paymentasia_security"><?php echo $entry_sort_order; ?></label>
                                <div class="col-sm-10">
                                    <input type="text" name="paymentasia_sort_order" value="<?php echo $paymentasia_sort_order; ?>" size="1" placeholder="<?php echo $entry_sort_order; ?>" id="amazon-login-pay-merchant-id" class="form-control" size="80"/>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="tab-display-name">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-weight-cost"><?php echo $entry_display_name; ?></label>
                                <div class="col-sm-10">
                                    <?php foreach ($languages as $language) { ?>
                                    <div style="margin-bottom:10px;"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><textarea name="paymentasia_display_name[<?php echo $language['language_id']; ?>]" rows="5" class="form-control"><?php echo $paymentasia_display_name[$language['language_id']]?$paymentasia_display_name[$language['language_id']]:'Credit Card'; ?></textarea></div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="tab-description">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-weight-cost"><?php echo $entry_description; ?></label>
                                <div class="col-sm-10">
                                    <?php foreach ($languages as $language) { ?>
                                    <div style="margin-bottom:10px;"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><textarea name="paymentasia_description[<?php echo $language['language_id']; ?>]" rows="5" class="form-control"><?php echo $paymentasia_description[$language['language_id']]?$paymentasia_description[$language['language_id']]:''; ?></textarea></div>
                                    <?php } ?>
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


