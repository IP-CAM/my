<?php 
# +----------------------------------------------------------------------
# | ETshop [ Rapid development framework for Cross border Mall ]
# +----------------------------------------------------------------------
# | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
# +----------------------------------------------------------------------
# | Author: yang <502204678@qq.com>
# +----------------------------------------------------------------------
# | By ShopCmf Auto Create File Version 2017/08/31 11:01:43
# +----------------------------------------------------------------------

return array (
  'columns' => 
  array (
    'id' => 
    array (
      'type' => 'int(11)',
      'key' => 'PRI',
      'extra' => 'auto_increment',
      'comment' => '品牌ID',
    ),
    'firstchar' => 
    array (
      'type' => 'char(1)',
      'comment' => '首字母',
    ),
    'name' => 
    array (
      'type' => 'varchar(60)',
      'comment' => '品牌名',
    ),
    'alias' => 
    array (
      'type' => 'varchar(60)',
      'comment' => '别名',
    ),
    'description' => 
    array (
      'type' => 'text',
      'comment' => '品牌描述',
    ),
    'url' => 
    array (
      'type' => 'varchar(255)',
      'comment' => '网址',
    ),
    'pcat' => 
    array (
      'type' => 'int(11)',
      'comment' => '主分类',
    ),
    'cat' => 
    array (
      'type' => 'int(11)',
      'comment' => '隶属分类子分类',
    ),
    'sort' => 
    array (
      'type' => 'int(11)',
      'comment' => '排序',
    ),
    'status' => 
    array (
      'type' => 'tinyint(1)',
      'comment' => '状态',
    ),
    'isrecommend' => 
    array (
      'type' => 'tinyint(1)',
      'comment' => '推荐',
    ),
    'istop' => 
    array (
      'type' => 'tinyint(1)',
      'comment' => '置顶',
    ),
    'logo' => 
    array (
      'type' => 'varchar(255)',
      'comment' => '品牌logo',
    ),
    'country_id' => 
    array (
      'type' => 'int(11) unsigned',
      'comment' => '国家id',
    ),
    'langid' => 
    array (
      'type' => 'varchar(20)',
      'comment' => '语言id',
    ),
    'create_time' => 
    array (
      'type' => 'int(11)',
      'comment' => '创建时间',
    ),
    'update_time' => 
    array (
      'type' => 'int(11)',
      'comment' => '更新时间',
    ),
  ),
  'primary' => 
  array (
    0 => 'id',
  ),
  'comment' => '品牌表',
);
