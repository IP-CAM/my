<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | 会员行为  Version 1.0  2016/3/13
// +----------------------------------------------------------------------

return [
    'reg_init'=> [
        'app\\member\\behavior\\RegInit',       //注册时调用
    ],
    'reg_succ'=> [
        'app\\member\\behavior\\SendSms',       //注册成功时发送短信
        'app\\member\\behavior\\GiveCoupons',   //注册成功时发赠送优惠劵
        'app\\member\\behavior\\GivePoint',     //注册成功时发赠送积分
    ],
    'reg_after'=> [
        'app\\member\\behavior\\AfterReg',       //注册成功后调用
    ],

    'add_member'=> [
        'app\\member\\behavior\\AddMember',    //管理员添加会员时执行
    ],

    'del_member'=> [
        'app\\member\\behavior\\DelMember',    //删除会员时调用
    ],
];