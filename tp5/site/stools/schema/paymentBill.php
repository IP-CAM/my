<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: lingdong <13480628384@163.com>
// +----------------------------------------------------------------------
// | 支付单据表  Version 1.0  2017/06/27
// +----------------------------------------------------------------------
return array(
    'columns'=>array(
        'id'=>array(
          'type'  => 'int',
          'auto_inc' => true,
          'comment' => '主键',
        ),
        'ip' => array (
          'type' => 'varchar',
          'length'=> 15,
          'comment' => '支付IP',
        ),
        'money'=>array(
          'type'  => 'float',
          'length' => 8,
          'comment' => '支付金额',
        ),
        'cur_money' => array (
          'type' => 'float',
          'length' => 8,
          'comment' => '支付货币金额',
        ),
        'member_id' => array (
          'type' => 'int',
          'comment' => '会员用户名',
        ),
        'status'=>array(
          'type'  => array(
            'succ' => '支付成功',
            'failed' => '支付失败',
            'cancel' => '未支付',
            'error' => '处理异常',
            'invalid' => '非法参数',
            'progress' => '已付款至担保方',
            'timeout' => '超时',
            'ready' => '准备中',
          ),
          'default' => 'ready',
          'comment' => '支付状态',
        ),
        'pay_name' => array (
          'type' => 'varchar',
          'length' => 40,
          'comment' => '支付方式名称',
        ),
        't_payed' => array (
          'type' => 'int',
          'length' => 13,
          'comment' => '支付完成时间',
        ),
        'op_id' => array (
          'type' => 'int',
          'comment' => '操作员',
        ),
        'account' => array (
          'type' => 'varchar',
          'length'=>50,
          'comment' => '收款账号',
        ),
        'bank' => array (
          'type' => 'varchar',
          'length'=>50,
          'comment' => '收款银行',
        ),
        'pay_account' => array (
          'type' => 'varchar',
          'length'=>50,
          'comment' => '支付账户',
        ),
        'currency' => array (
          'type' => 'varchar',
          'length'=> 10,
          'comment' => '货币',
        ),
        'paycost' => array (
          'type' => 'float',
          'comment' => '支付网关费用',
        ),
        'pay_app_id' => array (
          'type' => 'varchar',
          'length'=> 100,
          'comment' => '支付方式名称',
        ),
        'payip' => array (
          'type' => 'varchar',
          'length'=> 15,
          'comment' => '支付IP',
        ),
        'order_bn' => array (
          'type' => 'varchar',
          'length' => 32,
          'common' =>'订单唯一编号',
        ),
        'payment_bn' => array (
          'type' => 'varchar',
          'length' => 32,
          'common' =>'支付单唯一编号',
        ),

        't_begin' => array (
          'type' => 'int',
          'length' => 13,
          'comment' => '支付开始时间',
        ),
        't_confirm' => array (
          'type' => 'int',
          'length' => 13,
          'comment' => '支付确认时间',
        ),
        'memo' => array (
          'type' => 'varchar',
          'length'=> 100,
          'comment' => '支付注释',
        ),
        'return_url' => array (
          'type' => 'varchar',
          'length'=> 100,
          'comment' => '支付返回地址',
        ),
        'trade_no' => array (
          'type' => 'varchar',
          'length' => 50,
          'comment' => '支付单交易编号',
        ),
        'thirdparty_account' => array (
          'type' => 'varchar',
          'length' => 50,
          'comment' => '第三方支付账户',
        ),
        'create_time'=>array(
            'type'      => 'int',
            'default'   => 0,
            'comment'   => '创建时间',
        ),
        'update_time'=>array(
            'type'      => 'int',
            'default'   => 0,
            'comment'   => '更新时间',
        ),
    ),
    'primary' => 'id',
    'index' =>  array(
        'ind_name' => ['columns' => ['name']],
    ),
    'comment' => '支付单据表',
);