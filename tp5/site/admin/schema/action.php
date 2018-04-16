<?php 
# +----------------------------------------------------------------------
# | ETshop [ Rapid development framework for Cross border Mall ]
# +----------------------------------------------------------------------
# | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
# +----------------------------------------------------------------------
# | Author: theseaer <theseaer@qq.com>
# +----------------------------------------------------------------------
# | By ShopCmf Auto Create File Version 2017/09/16 10:47:30
# +----------------------------------------------------------------------

return array (
  'columns' => 
  array (
    'id' => 
    array (
      'type' => 'number',
      'title' => '主键',
      'autoincrement' => true,
      'length' => 10,
      'unsigned' => true,
      'comment' => '主键',
    ),
    'role' => 
    array (
      'type' => 'data',
      'title' => '角色ID',
      'length' => 10,
      'comment' => '角色ID',
    ),
    'username' => 
    array (
      'type' => 'string',
      'title' => '用户名',
      'length' => 255,
      'comment' => '用户名',
    ),
    'nickname' => 
    array (
      'type' => 'string',
      'title' => '昵称',
      'length' => 255,
      'comment' => '昵称',
    ),
    'password' => 
    array (
      'type' => 'string',
      'title' => '密码',
      'length' => 255,
      'comment' => '密码',
    ),
    'email' => 
    array (
      'type' => 'string',
      'title' => '邮箱',
      'length' => 255,
      'comment' => '邮箱',
    ),
    'mobile' => 
    array (
      'type' => 'string',
      'title' => '手机',
      'length' => 255,
      'comment' => '手机',
    ),
    'email_bind' => 
    array (
      'type' => 'bool',
      'title' => '是否绑定EMAIL',
      'length' => 2,
      'comment' => '是否绑定EMAIL',
    ),
    'mobile_bind' => 
    array (
      'type' => 'bool',
      'title' => '是否绑定手机',
      'length' => 2,
      'comment' => '是否绑定手机',
    ),
    'avatar' => 
    array (
      'type' => 'string',
      'title' => '头像',
      'length' => 255,
      'comment' => '头像',
    ),
    'groupid' => 
    array (
      'type' => 'number',
      'title' => '部门ID',
      'length' => 10,
      'comment' => '部门ID',
    ),
    'create_time' => 
    array (
      'type' => 'number',
      'length' => 10,
    ),
    'update_time' => 
    array (
      'type' => 'number',
      'title' => '修改时间',
      'length' => 10,
      'unsigned' => true,
      'default' => '0',
      'comment' => '修改时间',
    ),
    'last_login_time' => 
    array (
      'type' => 'number',
      'title' => '最后一次登录时间',
      'length' => 10,
      'comment' => '最后一次登录时间',
    ),
    'last_login_ip' => 
    array (
      'type' => 'string',
      'title' => '最后一次登录IP',
      'length' => 255,
      'comment' => '最后一次登录IP',
    ),
    'sort' => 
    array (
      'type' => 'number',
      'title' => '排序',
      'length' => 10,
      'default' => '0',
      'comment' => '排序',
    ),
    'status' => 
    array (
      'type' => 'bool',
      'title' => '状态',
      'length' => 2,
      'default' => '0',
      'comment' => '状态',
    ),
    'name' => 
    array (
      'type' => 'radio',
      'title' => '行为唯一标识',
      'length' => 10,
      'comment' => '行为唯一标识',
    ),
    'title' => 
    array (
      'type' => 'radio',
      'title' => '行为说明',
      'length' => 10,
      'comment' => '行为说明',
    ),
    'remark' => 
    array (
      'type' => 'radio',
      'title' => '行为描述',
      'length' => 10,
      'comment' => '行为描述',
    ),
    'rule' => 
    array (
      'type' => 'string',
      'title' => '行为规则',
      'length' => 255,
      'comment' => '行为规则',
    ),
    'log' => 
    array (
      'type' => 'string',
      'title' => '日志规则',
      'length' => 255,
      'comment' => '日志规则',
    ),
    'type' => 
    array (
      'type' => 'bool',
      'title' => '类型',
      'length' => 2,
      'unsigned' => true,
      'default' => '1',
      'comment' => '类型',
    ),
  ),
  'primaryKey' => 
  array (
    0 => 'id',
  ),
  'comment' => '动作行为表',
);
