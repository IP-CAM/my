<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: fancs <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Test.php  Version 2017/6/19 测试API
// +----------------------------------------------------------------------
namespace app\member\controller\admin;

use app\admin\controller\Admin;

class Test extends Admin
{
    public function api1(){
        $data= [
            'name' => 'qoqoq',
            'password'=>123456,
            'ip'   => '192.168.1.101',
            'langid'    => 'zh_cn',
        ];
        $res = \app\member\service\Member::register($data);
        return $res;
    }
    public function api2(){
        $data= [
            'name' => 'fancs',
            'password'=>123456,
        ];
        $res = \app\member\service\Member::login($data);
        return $res;
    }
    public function api3(){
        $data= [
            'name' => 'fancs',
            'old_password'=>123456,
            'new_password'=>741852,
        ];
        $res = \app\member\service\Member::change_pwd($data);
        return $res;
    }
    public function api4(){
        $data= [
            'name' => 'fancs',
            'update'=> ['email'=>'789456@qq.com'],
        ];
        $res = \app\member\service\Member::update_user($data);
        return $res;
    }
    public function api5(){
        $data= [
            'name' => 'jack',
        ];
        $res = \app\member\service\Member::get_without($data);
        return $res;
    }
    public function api6()
    {
        $data= [
            'cardNo' => '432826199302123031',
            'realName'=> '刘杰',
        ];
        $res = \app\member\service\Member::identification($data);
        return $res;
    }
    public function api7()
    {
        $uid =  500000;
        return get_order_sn($uid);
    }
}