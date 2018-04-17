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
                        <label class="col-sm-2 control-label" for="entry-appkey"><?php echo $entry_Tag_name; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="tag_name"  placeholder="<?php echo $entry_Tag_name; ?>"  class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="entry-appkey"><?php echo $entry_Tag_type; ?></label>
                        <div class="col-sm-10">
                            <select name = "tag_type">
                                <option value="S">--视频--</option>
                                <option value="C">--测评--</option>
                                <option value="W">--文章--</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="entry-appsecret"><?php echo $entry_Tag_seoTitle; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="seo_title" placeholder="<?php echo $entry_Tag_seoTitle; ?>" id="entry-appsecret" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="entry-appsecret"><?php echo $entry_Tag_seoDesc; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="seo_desc" placeholder="<?php echo $entry_Tag_seoDesc; ?>" id="entry-appsecret" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="entry-appsecret"><?php echo $entry_Tag_seoKeyword; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="seo_keyword" placeholder="<?php echo $entry_Tag_seoKeyword; ?>" id="entry-appsecret" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="entry-appsecret"><?php echo $entry_Tag_sort; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="tag_sort"  placeholder="<?php echo $entry_Tag_sort; ?>" id="entry-appsecret" class="form-control"/>
                        </div>
                    </div>


                    <button type="submit" form="form-weibo-login" data-toggle="tooltip" title="<?php echo $button; ?>" class="btn btn-primary" style="margin-left: 800px;"><?php echo $button; ?></button>

                </form>
            </div>
        </div>
    </div>
</div>
<?php echo $footer; ?>