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
      'comment' => '文档ID',
    ),
    'name' => 
    array (
      'type' => 'char(40)',
      'comment' => '标识',
    ),
    'title' => 
    array (
      'type' => 'char(80)',
      'comment' => '标题',
    ),
    'author' => 
    array (
      'type' => 'varchar(40)',
      'comment' => '文章作者',
    ),
    'author_email' => 
    array (
      'type' => 'varchar(60)',
      'comment' => '作者邮箱',
    ),
    'category_id' => 
    array (
      'type' => 'int(10) unsigned',
      'comment' => '所属分类',
    ),
    'about' => 
    array (
      'type' => 'varchar(255)',
      'comment' => '描述',
    ),
    'contents' => 
    array (
      'type' => 'text',
    ),
    'tags' => 
    array (
      'type' => 'varchar(255)',
      'comment' => '标签',
    ),
    'file_url' => 
    array (
      'type' => 'varchar(255)',
      'comment' => '上传文件或者外部文件的url',
    ),
    'cover_image' => 
    array (
      'type' => 'varchar(255)',
      'comment' => '文章封面图',
    ),
    'article_type' => 
    array (
      'type' => 'tinyint(3) unsigned',
      'default' => '1',
      'comment' => '内容类型',
    ),
    'link' => 
    array (
      'type' => 'varchar(255)',
      'comment' => '链接地址',
    ),
    'open_type' => 
    array (
      'type' => 'tinyint(1)',
      'comment' => '0,正常; 当该字段为1或2时,会在文章最后添加一个链接’相关下载’,连接地址等于file_url的值;',
    ),
    'hits' => 
    array (
      'type' => 'int(10) unsigned',
      'comment' => '浏览量',
    ),
    'create_time' => 
    array (
      'type' => 'int(10) unsigned',
      'comment' => '创建时间',
    ),
    'update_time' => 
    array (
      'type' => 'int(10) unsigned',
      'comment' => '更新时间',
    ),
    'is_comment' => 
    array (
      'type' => 'tinyint(1)',
    ),
    'is_top' => 
    array (
      'type' => 'tinyint(1)',
      'comment' => '是否置顶',
    ),
    'is_review' => 
    array (
      'type' => 'tinyint(1)',
      'default' => '1',
      'comment' => '是否显示;1显示;0不显示 ',
    ),
    'status' => 
    array (
      'type' => 'tinyint(4)',
      'comment' => '数据状态',
    ),
    'sort' => 
    array (
      'type' => 'int(11)',
    ),
    'langid' => 
    array (
      'type' => 'varchar(20)',
    ),
    'from' => 
    array (
      'type' => 'varchar(50)',
      'comment' => '来源',
    ),
  ),
  'primary' => 
  array (
    0 => 'id',
  ),
  'comment' => '文档模型基础表',
);
