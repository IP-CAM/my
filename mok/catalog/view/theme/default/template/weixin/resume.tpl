<?php echo $header; ?>

<!--地址-->
<form class="ok_form" autocomplete="off" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">

    <!--自定义栏目输出开始-->
    <?php foreach ($custom_fields as $custom_field) { ?>
    <?php if ($custom_field['location'] == 'account') { ?>
    <?php if ($custom_field['type'] == 'file') { ?>
    <div class="ok_upload">
        <div class="ok_upload_box">
            <input id="uploaderInput" class="ok_upload_img" type="file"  accept="image/*" multiple name="customer_image"/>

            <img src="<?php echo $account_custom_field[$custom_field['custom_field_id']]; ?>" class="ok_img" width="100%" height="100%" style="opacity: 1;" />
        </div>
    </div>
    <?php } ?>
    <div class="weui-cells">

        <?php if ($custom_field['type'] == 'text') { ?>
        <div class="weui-cell">
            <div class="weui-cell__hd"><?php echo $custom_field['name']; ?></div>
            <div class="weui-cell__bd">
                <input id = 'nickname' class="ok_input" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" type="text" value="<?php echo (isset($account_custom_field[$custom_field['custom_field_id']]) ? $account_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?>"/>
            </div>
        </div>
        <?php } ?>

        <?php if ($custom_field['type'] == 'radio') { ?>
        <div class="weui-cell">
            <div class="weui-cell__hd"><?php echo $custom_field['name']; ?></div>
            <div class="weui-cell__bd">
                <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
                <span class="ok_sex_circle">
                    <?php if ((isset($account_custom_field[$custom_field['custom_field_id']]) && $custom_field_value['custom_field_value_id'] == $account_custom_field[$custom_field['custom_field_id']])) { ?>
                    <i class="weui-icon-circle weui-icon-success"></i>
                    <input id="male" class="ok_input_sex" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" type="radio" checked="checked"/>
                    <label class="ok_sex_label" for="male"><?php echo $custom_field_value['name']; ?></label>
                    <?php } else { ?>
                    <i class="weui-icon-circle"></i>
                    <input id="female" class="ok_input_sex" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" type="radio" />
                    <label class="ok_sex_label" for="male"><?php echo $custom_field_value['name']; ?></label>
                    <?php } ?>
                </span>
                <?php } ?>
            </div>
        </div>
        <?php } ?>

        <?php if ($custom_field['type'] == 'date') { ?>
        <div class="weui-cell">
            <div class="weui-cell__hd"><?php echo $custom_field['name']; ?></div>
            <div class="weui-cell__bd">
                <input type="hidden"  id="ok_date" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($account_custom_field[$custom_field['custom_field_id']]) ? $account_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?>"/>
                <a href="javascript:;" class="ok_input" id="showDatePicker"><?php echo (isset($account_custom_field[$custom_field['custom_field_id']]) ? $account_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?></a>
            </div>
        </div>
        <?php } ?>


    </div>
    <?php } ?>
    <?php } ?>
    <div class="weui-flex ok_tabbar">
        <span class="weui-flex__item ok_cancel">取消</span>
        <span class="weui-flex__item ok_submit">确定</span>
    </div>
    <!--自定义栏目输出结束-->

</form>
<div class="ok_position">
    <div class="ok_pop"></div>
</div>
<?php echo $footer; ?>