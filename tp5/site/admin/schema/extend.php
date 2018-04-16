<?php 
# +----------------------------------------------------------------------
# | ETshop [ Rapid development framework for Cross border Mall ]
# +----------------------------------------------------------------------
# | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
# +----------------------------------------------------------------------
# | Author: yang <502204678@qq.com>
# +----------------------------------------------------------------------
# | By ShopCmf Auto Create File Version 2017/08/31 11:01:35
# +----------------------------------------------------------------------

return array (
  'columns' => 
  array (
    'id' => 
    array (
      'type' => 'int(11) unsigned',
      'key' => 'PRI',
      'extra' => 'auto_increment',
    ),
    'code' => 
    array (
      'type' => 'varchar(50)',
      'key' => 'MUL',
      'comment' => '支付工具名称',
    ),
    'subjection' => 
    array (
      'type' => 'varchar(30)',
      'comment' => '分组',
    ),
    'module' => 
    array (
      'type' => 'varchar(80)',
      'comment' => '分组模型名称',
    ),
    'version' => 
    array (
      'type' => 'varchar(30)',
      'comment' => '版本',
    ),
    'config' => 
    array (
      'type' => 'text',
      'comment' => '配置参数',
    ),
    'create_time' => 
    array (
      'type' => 'int(11)',
      'comment' => '创建时间',
    ),
    'update_time' => 
    array (
      'type' => 'int(11)',
      'comment' => '修改时间',
    ),
    'status_time' => 
    array (
      'type' => 'int(11)',
      'comment' => '状态修改时间',
    ),
    'status' => 
    array (
      'type' => 'tinyint(1)',
      'default' => '1',
      'comment' => '状态',
    ),
    'isshow' => 
    array (
      'type' => 'tinyint(1)',
      'comment' => '是否显示',
    ),
    'sort' => 
    array (
      'type' => 'int(11)',
      'comment' => '显示排序',
    ),
    'pc' => 
    array (
      'type' => 'tinyint(1)',
      'default' => '1',
      'comment' => '支持PC',
    ),
    'wap_app' => 
    array (
      'type' => 'tinyint(1)',
      'comment' => '移动端支持',
    ),
    'api' => 
    array (
      'type' => 'tinyint(1)',
      'comment' => 'API调用支持',
    ),
    'other' => 
    array (
      'type' => 'tinyint(1)',
      'comment' => '异形邢台支持',
    ),
    'allow_uninstall' => 
    array (
      'type' => 'tinyint(1)',
      'default' => '1',
      'comment' => '是否允许卸载',
    ),
    'lang_list' => 
    array (
      'type' => 'text',
      'comment' => '支持的语言列',
    ),
    'is_del' => 
    array (
      'type' => 'int(11)',
      'comment' => '删除时间',
    ),
  ),
  'primary' => 
  array (
    0 => 'id',
  ),
  'index' => 
  array (
    'rt_payment_id_uindex' => 
    array (
      0 => 'id',
    ),
    'code' => 
    array (
      0 => 'code',
    ),
  ),
  'comment' => '插件&扩展',
);
