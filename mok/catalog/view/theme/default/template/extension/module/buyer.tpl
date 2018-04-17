
<div class="ok_cs_box">
    <?php
    if($buyers){
    ?>
    <div class="ok_ban_title">
        <p class="ok_title_first"><?php echo $module_title;?></p>
        <p class="ok_title_sec"></p>
    </div>
    <?php
        foreach ($buyers as $buyer) {  ?>
    <div class="ok_recommend">
        <div class="ok_reco_title weui-flex">
            <div class="ok_rec_tag">
                <a href="<?php echo $buyer['buyer_href'];?> ">
                    <img class="lazy" src='catalog/view/theme/default/images/public/lazy.png' data-original="<?php echo $buyer['head_image'];?>"/>
                </a>
            </div>
            <a  href="<?php echo $buyer['buyer_href'];?>" class="weui-flex__item">

                <span class="ok_play_name"><?php echo $buyer['nickname'];?></span>
            </a>
            <div class="ok_rec_add" data-status="<?php echo $buyer['is_attention'];?>" data-id="<?php echo $buyer['buyer_id'];?>"></div>

        </div>
        <div class="ok_reco_content">
            <a href="<?php echo $buyer['href'];?>">
                <div class="ok_reco_img">
                    <img class="lazy" src='catalog/view/theme/default/images/public/lazy.png' data-original="<?php echo $buyer['src'];?>" width="100%"/>
                </div>
                <div class="ok_reco_info">
                    <p class="ok_reco_name ok_over"><?php echo $buyer['title'];?></p>
                    <p class="ok_reco_date"><?php echo $buyer['date'];?></p>
                </div>
            </a>
        </div>
    </div>

    <?php
        }
        }
    ?>
</div>
<div class="ok_position">
    <div class="ok_pop">
        <span class="ok_tag"></span>
        <span class="ok_pop_info"></span>
    </div>
</div>