<?php echo $header; ?>
<!--头部-->
<div class="ok_logo_box">
    <div class="ok_cs_box">
        <img src="<?php echo $show_image;?>" width="100%"/>
    </div>
    <div class="weui-cells">
        <div class="weui-cell">
            <div class="weui-cell__hd">
                <div class="ok_small_logo"><img src="<?php echo $logo_image;?>" width="100%"/></div>
            </div>
            <div class="weui-cell__bd">
                <div class="ok_logo_left">
                    <p class="ok_logo_name"><?php echo $manufacturer_info['name'];?></p>
                    <p class="ok_logo_num"><span><?php echo $product_total;?></span><?php echo $text_goods;?></p>
                </div>
                <input type="hidden" value="<?php echo $manufacturer_info['manufacturer_id'];?>" id="manufacturer_id" />

                <div class="ok_logo_right <?php if($is_attention==1){ echo 'ok_logo_add';}?>"></div>

            </div>
        </div>
    </div>
</div>
<!--文章-->
<article class="weui-article">
    <h1><?php echo $text_about;?><?php echo $manufacturer_info['name'];?></h1>
    <section>
        <p><?php echo $manufacturer_info['introduce'];?></p>
    </section>
</article>
<!--内容-->
<div class="ok_brand_content">
    <p class="ok_content_title"><?php echo $text_manufacturer_content;?></p>
    <div class="weui-cells">

        <?php
            if($blogs){
                foreach($blogs as $k=>$row){

        ?>
        <div class="weui-cell <?php if($k>2){ echo 'ok_hide';};?>" >
            <div class="weui-cell__hd">
                <a href="<?php echo $row['blog_href'];?>">
                    <img src="<?php echo $row['image'];?>" width="100%"/>
                </a>
            </div>
            <div class="weui-cell__bd">
                <a href="<?php echo $row['blog_href'];?>">
                    <?php echo $row['title'];?>
                </a>
            </div>
        </div>
        <?php
              }
                }
        ?>

    </div>
    <div class="ok_show_up"></div>
</div>
<!--产品-->
<div class="ok_cs_box">
    <div class="ok_list">
        <?php
           foreach($products as $v){
        ?>
        <div class="ok_list_item">
            <a href="<?php echo $v['href']; ?>">
                <img src="<?php echo $v['thumb']; ?>" width="100%"/>
                <p class="ok_cs_info"><?php echo $v['name']?></p>
                <p class="ok_cs_price">
                    <?php echo $v['price']?>
                </p>
            </a>
        </div>
        <?php
            }
        ?>
    </div>
</div>
<div class="ok_position"> 
    <div class="ok_pop">
        <span class="ok_tag"></span>
        <span class="ok_pop_info"></span>
    </div>
</div>
<?php echo $footer; ?>
