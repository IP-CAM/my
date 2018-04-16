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
    'account-member' => array(
        'label'     => lang('Account member'),
        'app'       => [0, ''],
        'email'     => [1, 'Dear $username$, please click this link $url$ be complete account-member'],
        'sms'       => [1, 'Dear $username$, your account member vcode is : $vcode$'],
        'wechat'    => [0, ''],
        'whatisapp' => [0, ''],
        'messager'  => [0, ''],
        'sendType'  => 'notice',
        'varmap'    => ['username'=>'$username$', 'url'=>'$url$', 'vcode'=>'$vcode$'],
    ),
    
    'account-signup' => array(
        'label'     => lang('Account signup'),
        'app'       => [0, ''],
        'email'     => [1, ''],
        'sms'       => [1, 'Dear $username$, your account member vcode is : $vcode$'],
        'wechat'    => [0, ''],
        'whatisapp' => [0, ''],
        'messager'  => [0, ''],
        'sendType'  => 'notice',
        'varmap'    => ['username'=>'$username$'],
    ),
    
    'deposit-lostPw' => array(
        'label'     => lang('Deposit lostPw'),
        'app'       => [0, ''],
        'email'     => [1, 'account-signup by email'],
        'sms'       => [1, 'account-signup by sms'],
        'wechat'    => [0, ''],
        'whatisapp' => [0, ''],
        'messager'  => [0, ''],
        'sendType'  => 'notice',
        'varmap'    => ['username'=>'$username$'],
    ),
    
    'account-unmember' => array(
        'label'     => lang('Account unmember'),
        'app'       => [1, 'account-unmember by app push'],
        'email'     => [1, 'account-unmember by email'],
        'sms'       => [1, 'account-unmember by sms'],
        'wechat'    => [1, 'account-unmember by wechat'],
        'whatisapp' => [1, 'account-unmember by whatisapp'],
        'messager'  => [1, 'account-unmember by messager'],
        'sendType'  => 'notice',
        'varmap'    => ['username'=>'$username$', 'email'=>'$email$', 'mob'=>'$mob$'],
    ),

];
