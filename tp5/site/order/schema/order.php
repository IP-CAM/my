<?php 
# +----------------------------------------------------------------------
# | ETshop [ Rapid development framework for Cross border Mall ]
# +----------------------------------------------------------------------
# | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
# +----------------------------------------------------------------------
# | Author: yang <502204678@qq.com>
# +----------------------------------------------------------------------
# | By ShopCmf Auto Create File Version 2017/08/31 11:01:58
# +----------------------------------------------------------------------

return array (
  'columns' => 
  array (
    'order_id' => 
    array (
      'type' => 'bigint(15) unsigned',
      'key' => 'PRI',
      'extra' => 'auto_increment',
    ),
    'order_sn' => 
    array (
      'type' => 'varchar(32)',
      'key' => 'UNI',
      'comment' => '订单号',
    ),
    'batch_no' => 
    array (
      'type' => 'varchar(40)',
      'comment' => '批次号',
    ),
    'order_type' => 
    array (
      'type' => 'tinyint(1)',
      'default' => '1',
      'comment' => '订单类型 1正常订单 0系统自动生成',
    ),
    'user_id' => 
    array (
      'type' => 'mediumint(8) unsigned',
      'key' => 'MUL',
    ),
    'status' => 
    array (
      'type' => 'enum(\'WAIT_BUYER_PAY\',\'WAIT_SELLER_SEND_GOODS\',\'WAIT_BUYER_CONFIRM_GOODS\',\'TRADE_FINISHED\',\'TRADE_CLOSED\',\'TRADE_CLOSED_BY_SYSTEM\')',
      'key' => 'MUL',
      'comment' => '订单状态:WAIT_BUYER_PAY:已下单等待付款,WAIT_SELLER_SEND_GOODS:已付款等待发货,WAIT_BUYER_CONFIRM_GOODS,已发货等待确认收货,TRADE_FINISHED,已完成,TRADE_CLOSED:已关闭(退款关闭订单),',
    ),
    'consignee' => 
    array (
      'type' => 'varchar(60)',
      'comment' => '收货人的姓名',
    ),
    'country' => 
    array (
      'type' => 'varchar(50)',
      'comment' => '收货人的国家',
    ),
    'province' => 
    array (
      'type' => 'varchar(50)',
      'comment' => '收货人的省份',
    ),
    'city' => 
    array (
      'type' => 'varchar(100)',
      'comment' => '收货人的城市',
    ),
    'district' => 
    array (
      'type' => 'varchar(200)',
      'comment' => '收货人的地区',
    ),
    'address' => 
    array (
      'type' => 'varchar(255)',
      'comment' => '收货人的详细地址',
    ),
    'zipcode' => 
    array (
      'type' => 'varchar(60)',
      'comment' => '收货人的邮编',
    ),
    'tel' => 
    array (
      'type' => 'varchar(20)',
      'comment' => '收货人的电话',
    ),
    'mobile' => 
    array (
      'type' => 'varchar(20)',
      'comment' => '收货人的手机',
    ),
    'email' => 
    array (
      'type' => 'varchar(60)',
      'comment' => '收货人的Email',
    ),
    'idnumber' => 
    array (
      'type' => 'varchar(30)',
      'comment' => '身份证号',
    ),
    'sfzzm' => 
    array (
      'type' => 'text',
      'comment' => '身份证正面',
    ),
    'sfzfm' => 
    array (
      'type' => 'text',
      'comment' => '身份证反面',
    ),
    'pay_name' => 
    array (
      'type' => 'varchar(100)',
      'comment' => '支付方式名称',
    ),
    'pay_class' => 
    array (
      'type' => 'varchar(60)',
      'comment' => '支付方式：0：货到付款',
    ),
    'pay_status' => 
    array (
      'type' => 'tinyint(1) unsigned',
      'key' => 'MUL',
      'comment' => '支付状态;0未付款;1已付款',
    ),
    'shipping_id' => 
    array (
      'type' => 'tinyint(3)',
      'key' => 'MUL',
      'comment' => '用户选择的配送方式id',
    ),
    'shipping_name' => 
    array (
      'type' => 'varchar(120)',
      'comment' => '用户选择的配送方式的名称',
    ),
    'shipping_fee' => 
    array (
      'type' => 'decimal(10,2)',
      'default' => '0.00',
      'comment' => '配送费用',
    ),
    'shipping_status' => 
    array (
      'type' => 'tinyint(1) unsigned',
      'key' => 'MUL',
      'comment' => '商品配送情况;0未发货,1已发货,2已收货',
    ),
    'shipping_time' => 
    array (
      'type' => 'int(10) unsigned',
      'comment' => '订单配送时间',
    ),
    'shipping_no' => 
    array (
      'type' => 'varchar(50)',
      'comment' => '物流单号',
    ),
    'recode' => 
    array (
      'type' => 'varchar(40)',
      'comment' => '收货人省市区代码组合',
    ),
    'postscript' => 
    array (
      'type' => 'varchar(255)',
      'comment' => '订单附言,由用户提交订单前填写',
    ),
    'pay_ip' => 
    array (
      'type' => 'varchar(32)',
      'comment' => '支付IP地址',
    ),
    'pay_time' => 
    array (
      'type' => 'int(10) unsigned',
      'comment' => '订单支付时间',
    ),
    'inv_type' => 
    array (
      'type' => 'tinyint(1)',
      'comment' => '1,公司，2，个人',
    ),
    'inv_number' => 
    array (
      'type' => 'varchar(50)',
      'comment' => '纳税人识别号',
    ),
    'inv_payee' => 
    array (
      'type' => 'varchar(120)',
      'comment' => '发票抬头',
    ),
    'goods_amount' => 
    array (
      'type' => 'decimal(10,2)',
      'default' => '0.00',
      'comment' => '商品的总金额',
    ),
    'money_paid' => 
    array (
      'type' => 'decimal(10,2)',
      'default' => '0.00',
      'comment' => '已付款金额',
    ),
    'integral' => 
    array (
      'type' => 'int(10) unsigned',
      'comment' => '使用的积分的数量,取用户使用积分,商品可用积分,用户拥有积分中最小者 ',
    ),
    'bonus' => 
    array (
      'type' => 'decimal(10,2)',
      'default' => '0.00',
      'comment' => '使用红包金额',
    ),
    'order_amount' => 
    array (
      'type' => 'decimal(10,2)',
      'default' => '0.00',
      'comment' => '应付款金额',
    ),
    'symbol' => 
    array (
      'type' => 'varchar(3)',
      'comment' => '货币符号',
    ),
    'code' => 
    array (
      'type' => 'varchar(4)',
      'comment' => '货币代码',
    ),
    'rate' => 
    array (
      'type' => 'decimal(15,8)',
      'comment' => '汇率',
    ),
    'platform_type' => 
    array (
      'type' => 'varchar(8)',
      'default' => 'pc',
      'comment' => '来源平台',
    ),
    'update_time' => 
    array (
      'type' => 'int(11)',
      'comment' => '更新时间',
    ),
    'create_time' => 
    array (
      'type' => 'int(10) unsigned',
      'comment' => '订单生成时间',
    ),
    'confirm_time' => 
    array (
      'type' => 'int(10) unsigned',
      'comment' => '订单确认时间',
    ),
    'bonus_id' => 
    array (
      'type' => 'mediumint(8) unsigned',
      'comment' => '红包id',
    ),
    'extension_code' => 
    array (
      'type' => 'varchar(30)',
      'key' => 'MUL',
      'comment' => '通过活动购买的商品的代号,group_buy是团购; auction是拍卖;snatch夺宝奇兵;正常普通产品该处理为空 ',
    ),
    'extension_id' => 
    array (
      'type' => 'mediumint(8) unsigned',
      'comment' => '通过活动购买的物品id,取值ecs_good_activity;如果是正常普通商品,该处为0 ',
    ),
    'to_buyer' => 
    array (
      'type' => 'varchar(255)',
      'comment' => '商家给客户的留言,当该字段值时可以在订单查询看到 ',
    ),
    'tax' => 
    array (
      'type' => 'decimal(10,2)',
      'comment' => '发票税额',
    ),
    'order_tax' => 
    array (
      'type' => 'decimal(10,2)',
      'default' => '0.00',
      'comment' => '订单税费',
    ),
    'trade_no' => 
    array (
      'type' => 'varchar(255)',
      'comment' => '支付平台返回的流水号',
    ),
    'is_separate' => 
    array (
      'type' => 'tinyint(1)',
      'comment' => '0未分成或等待分成;1已分成;2取消分成 ',
    ),
    'discount' => 
    array (
      'type' => 'decimal(10,2)',
      'comment' => '折扣',
    ),
    'is_evaluate' => 
    array (
      'type' => 'tinyint(1)',
      'comment' => '是否已评价，1：是，0：否',
    ),
    'is_checkout' => 
    array (
      'type' => 'tinyint(1)',
      'comment' => '是否给商家货款',
    ),
    'langid' => 
    array (
      'type' => 'text',
      'comment' => '下单所处语言',
    ),
    'partner' => 
    array (
      'type' => 'varchar(8)',
      'comment' => '合作商',
    ),
    'seller_id' => 
    array (
      'type' => 'int(11)',
      'comment' => '商户ID',
    ),
    'warecode' => 
    array (
      'type' => 'varchar(50)',
      'comment' => ' 仓库代码',
    ),
    'cancel_status' => 
    array (
      'type' => 'enum(\'FAILS\',\'SUCCESS\',\'REFUND_PROCESS\',\'WAIT_PROCESS\',\'NO_APPLY\')',
      'default' => 'NO_APPLY',
      'comment' => '取消状态, NO_APPLY:未申请\',WAIT_PROCESS:等待审核,REFUND_PROCESS:退款处理,SUCCESS:取消成功\',FAILS:取消失败\',',
    ),
    'cancel_reason' => 
    array (
      'type' => 'varchar(255)',
      'comment' => '取消原因',
    ),
    'cancel_opt' => 
    array (
      'type' => 'varchar(50)',
      'comment' => '取消订单操作者',
    ),
    'cancel_soruce' => 
    array (
      'type' => 'varchar(20)',
      'default' => 'pc',
      'comment' => '取消订单发起平台',
    ),
    'cancel_time' => 
    array (
      'type' => 'int(11)',
      'comment' => '订单取消时间',
    ),
  ),
  'primary' => 
  array (
    0 => 'order_id',
  ),
  'index' => 
  array (
    'order_sn' => 
    array (
      0 => 'order_sn',
    ),
    'user_id' => 
    array (
      0 => 'user_id',
    ),
    'order_status' => 
    array (
      0 => 'status',
    ),
    'shipping_status' => 
    array (
      0 => 'shipping_status',
    ),
    'pay_status' => 
    array (
      0 => 'pay_status',
    ),
    'shipping_id' => 
    array (
      0 => 'shipping_id',
    ),
    'extension_code' => 
    array (
      0 => 'extension_code',
      1 => 'extension_id',
    ),
  ),
  'comment' => '主订单表',
);
