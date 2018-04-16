<?php 
# +----------------------------------------------------------------------
# | ETshop [ Rapid development framework for Cross border Mall ]
# +----------------------------------------------------------------------
# | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
# +----------------------------------------------------------------------
# | Author: yang <502204678@qq.com>
# +----------------------------------------------------------------------
# | By ShopCmf Auto Create File Version 2017/08/31 11:01:38
# +----------------------------------------------------------------------

return array (
  'columns' => 
  array (
    'id' => 
    array (
      'type' => 'int(10) unsigned',
      'key' => 'PRI',
      'extra' => 'auto_increment',
      'comment' => '分类ID',
    ),
    'name' => 
    array (
      'type' => 'varchar(255)',
      'comment' => '标识',
    ),
    'title' => 
    array (
      'type' => 'varchar(50)',
      'comment' => '标题',
    ),
    'mobtitle' => 
    array (
      'type' => 'varchar(50)',
      'comment' => '移动端显示名称',
    ),
    'catimage' => 
    array (
      'type' => 'text',
      'comment' => '栏目图片',
    ),
    'groupbys' => 
    array (
      'type' => 'int(11)',
      'comment' => '分组',
    ),
    'pid' => 
    array (
      'type' => 'int(10) unsigned',
      'comment' => '上级分类ID',
    ),
    'class' => 
    array (
      'type' => 'varchar(255)',
      'comment' => '栏目CLASS',
    ),
    'sort' => 
    array (
      'type' => 'int(10) unsigned',
      'comment' => '排序（同级有效）',
    ),
    'listrow' => 
    array (
      'type' => 'tinyint(3) unsigned',
      'default' => '25',
      'comment' => '列表每页行数',
    ),
    'seo_title' => 
    array (
      'type' => 'varchar(50)',
      'comment' => 'SEO的网页标题',
    ),
    'seo_keywords' => 
    array (
      'type' => 'varchar(255)',
      'comment' => '关键字',
    ),
    'seo_description' => 
    array (
      'type' => 'varchar(255)',
      'comment' => '描述',
    ),
    'template_index' => 
    array (
      'type' => 'varchar(100)',
      'comment' => '频道页模板',
    ),
    'template_lists' => 
    array (
      'type' => 'varchar(100)',
      'comment' => '列表页模板',
    ),
    'template_detail' => 
    array (
      'type' => 'varchar(100)',
      'comment' => '详情页模板',
    ),
    'allow_publish' => 
    array (
      'type' => 'tinyint(3) unsigned',
      'comment' => '是否允许发布内容',
    ),
    'is_reply' => 
    array (
      'type' => 'tinyint(1) unsigned',
      'comment' => '是否允许回复',
    ),
    'is_recom' => 
    array (
      'type' => 'tinyint(1)',
      'comment' => '是否推荐',
    ),
    'is_check' => 
    array (
      'type' => 'tinyint(1) unsigned',
      'comment' => '发布的文章是否需要审核',
    ),
    'api_status' => 
    array (
      'type' => 'tinyint(1)',
    ),
    'wap_hits' => 
    array (
      'type' => 'int(11)',
    ),
    'status' => 
    array (
      'type' => 'tinyint(1)',
      'default' => '1',
      'comment' => '移动端状态',
    ),
    'pc_status' => 
    array (
      'type' => 'tinyint(1)',
      'default' => '1',
    ),
    'pc_hits' => 
    array (
      'type' => 'int(11)',
    ),
    'urlruleid' => 
    array (
      'type' => 'tinyint(2)',
    ),
    'listtype' => 
    array (
      'type' => 'tinyint(1)',
      'comment' => '是否封面',
    ),
    'update_time' => 
    array (
      'type' => 'int(10) unsigned',
      'comment' => '更新时间',
    ),
    'create_time' => 
    array (
      'type' => 'int(10) unsigned',
      'comment' => '创建时间',
    ),
    'langid' => 
    array (
      'type' => 'text',
      'comment' => '语言',
    ),
  ),
  'primary' => 
  array (
    0 => 'id',
  ),
  'comment' => '分类类目',
);
