<?php 
# +----------------------------------------------------------------------
# | ETshop [ Rapid development framework for Cross border Mall ]
# +----------------------------------------------------------------------
# | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
# +----------------------------------------------------------------------
# | Author: theseaer <theseaer@qq.com>
# +----------------------------------------------------------------------
# | 消息推送控制文件 2017/03/07 12:09:16
# +----------------------------------------------------------------------

return [
    'confirm-order' => array(
        'label'     => lang('Confirm order'),
        'app'       => [1, 'order is confirm complete by app push'],
        'email'     => [0, ''],
        'sms'       => [1, 'confirm order by sms'],
        'wechat'    => [1, 'confirm order by wechat'],
        'whatisapp' => [1, 'confirm order by what is app'],
        'messager'  => [1, 'confirm order by messager'],
        'sendType'  => 'notice',
        'varmap'    => ['orderNo'=>'$orderNo$'],
    ),
    
    'distribution-order' => array(
        'label'     => lang('Distribution order'),
        'app'       => [1, 'order is distribution by app push'],
        'email'     => [0, ''],
        'sms'       => [1, 'order is distribution by sms'],
        'wechat'    => [1, 'order is distribution by wechat'],
        'whatisapp' => [0, ''],
        'messager'  => [0, ''],
        'sendType'  => 'notice',
        'varmap'    => ['orderNo'=>'$orderNo$'],
    ),
    
    'refund-complete' => array(
        'label'     => lang('Refund complete'),
        'app'       => [1, 'refund-complete by app push'],
        'email'     => [1, 'refund-complete by email'],
        'sms'       => [1, 'refund-complete by sms'],
        'wechat'    => [1, 'refund-complete by wechat'],
        'whatisapp' => [1, 'refund-complete by what is app'],
        'messager'  => [1, 'refund-complete by messager'],
        'sendType'  => 'notice',
        'varmap'    => ['orderNo'=>'$orderNo$', 'money'=>'$money$'],
    ),
    
];
