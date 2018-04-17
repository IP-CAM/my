<?php echo $header; ?>
<!--地址-->
<div class="ok_cs_box">
    <?php
            if ($addresses) {
                    foreach ($addresses as $row) {
    ?>
    <div class="ok_address_content weui-cells">
        <div class="weui-cell">
            <div class="weui-cell__hd ok_choose_icon"></div>
            
            <div class="weui-cell__bd">
                <a href="<?php echo $row['update'];?>" class="ok_user_info">
                    <span class="ok_user_name"><?php echo $row['consignee'];?></span>
                    <span class="ok_user_phone"><?php echo $row['telephone'];?></span>
                    <?php
                       if($customer_address == $row['address_id']){
                   ?>
                    <span class="ok_user_default"><?php echo $text_default;?></span>
                    <?php
                       }
                    ?>
                </a>
                <p class="ok_user_address"><?php echo $row['address'];?></p>
            </div>

        </div>
        <div class="ok_delete_address">
            <div class="ok_delete_icon">
                <a href="javascript:;" data-href="<?php echo $row['delete'];?>"/>
                <img src="catalog/view/theme/default/images/address/delete.png" width="100%"/>
                </a>
            </div>
        </div>
    </div>
           <?php
                       }
                }else{
                    echo $text_empty;
                }
           ?>
</div>
<div class="ok_address_bottom ok_tabbar">
    <a href="<?php echo $add;?>">
        <span class="ok_address_add"><i class="ok_address_icon">+</i><?php echo $text_add_address;?></span>
    </a>
</div>
<div class="ok_position">
    <div class="ok_pop"></div>
</div>
<?php echo $footer; ?>