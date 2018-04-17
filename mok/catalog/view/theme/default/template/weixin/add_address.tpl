<?php echo $header; ?>

<form class="ok_form" action="<?php echo $action;?>" method="post" autocomplete="off" id="add_address">
    <div class="weui-cells">
        <?php foreach ($custom_fields as $custom_field) { ?>
        <?php if ($custom_field['location'] == 'address') { ?>
        <?php if ($custom_field['type'] == 'text') { ?>
        <div class="weui-cell">
            <div class="weui-cell__hd"><?php echo $custom_field['name']; ?></div>
            <div class="weui-cell__bd">
                <input class="ok_input" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" type="text" placeholder="<?php echo $custom_field['name']; ?>" value="<?php if(isset($address_custom_field[$custom_field['custom_field_id']])){ echo $address_custom_field[$custom_field['custom_field_id']];};?>"/>
            </div>
        </div>
        <?php } ?>
        <?php } ?>
        <?php } ?>
        <div class="weui-cell">
            <div class="weui-cell__hd"><?php echo $entry_area;?></div>
            <div class="weui-cell__bd">
                <span class="ok_input" id="showPicker"><?php if(isset($area_info)){ echo $area_info;}else{ echo $entry_area_p;}?></span>
                <input id="zone" name="zone_id" type="hidden" data-name=""  value="<?php if(isset($area_info_zone)){ echo $area_info_zone;}?>" />
                <input id="city" name="city_id" type="hidden" data-name="" value="<?php if(isset($area_info_city)){ echo $area_info_city;}?>" />
                <input id="district" name="district_id" type="hidden" data-name="" value="<?php if(isset($area_info_district)){ echo $area_info_district;}?>" />
                <input name="country_id" type="hidden" value="44"/>
            </div>
        </div>

        <div class="weui-cell">
            <div class="weui-cell__hd"><?php echo $entry_address;?></div>
            <div class="weui-cell__bd">
                <input name="address_1" class="ok_input" type="text" placeholder="<?php echo $entry_address;?>" value="<?php echo $address_1;?>"/>
            </div>
        </div>
        <?php
            if(!isset($default_address)){
        ?>
        <div class="weui-cell">
            <input type="checkbox" class="ok_default_box" name="default"/>
            <span class="ok_default"><?php echo $entry_is_default;?></span>
        </div>
        <?php
            }
        ?>
    </div>
    <div class="weui-flex ok_tabbar">
        <span class="weui-flex__item ok_cancel"><?php echo $button_cancel;?></span>
        <span class="weui-flex__item ok_submit"><?php echo $button_save;?></span>
    </div>
</form>
<div class="ok_position">
    <div class="ok_pop"></div>
</div>
<div id="ok_picker">
    <div class="weui-mask weui-animate-fade-in"></div>
    <div class="weui-picker weui-animate-slide-up">
        <div class="weui-picker__hd">
            <a href="javascript:;" data-action="cancel" class="weui-picker__action" id="picker_cancel">取消</a> 
            <a href="javascript:;" data-action="select" class="weui-picker__action" id="picker_confirm">确定</a>
        </div>
        <div class="weui-picker__bd">
            <div class="weui-picker__group">
                <div class="weui-picker__mask"></div>
                <div class="weui-picker__indicator"></div>
                <div class="weui-picker__content" data-id="zone">
                    <div class="weui-picker__item" data-value="1">上海市</div>
                    <div class="weui-picker__item" data-value="2">云南省</div>
                    <div class="weui-picker__item" data-value="3">内蒙古自治区</div>

                </div>
            </div>
        </div>
    </div>
</div>    
<?php echo $footer; ?>