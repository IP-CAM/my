<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Manager.php  Version 2017/7/23  后台管理组用户API
// +----------------------------------------------------------------------
namespace app\admin\service;

use app\admin\model\Manager as ManagerModel;
use think\Loader;
use think\Session;

class Manager extends Service
{
    /**
     * @Mark:后台登录
     * @param $data
     * @return array
     * @Author: yang <502204678@qq.com>
     * @Version 2017/9/7
     */
    static function login($data)
    {
        $res = ManagerModel::where(['username' => $data['username'], 'password' => md5($data['password'])])->find();
        if (!$res) return ['code' => 0, 'msg' => lang('admin_account_or_password_error')];
        if ($res['status'] != 1) return ['code' => 0, 'msg' => lang('admin_account_forbidden')];
        //更新登录信息
        $token = md5(uniqid(mt_rand(1111, 9999), true));
        $data  = [
            'last_login_time' => time(),
            'last_login_ip'   => ipToInt(get_client_ip()),
            'id'              => $res['id'],
            'login'           => $res['login'] + 1,
            'token'           => $token
        ];
        ManagerModel::update($data);
        
        //保存登录信息
        $save_info = [
            'username' => $res['username'],
            'role_id'  => $res['roleid'],
            'uid'      => $res['id']
        ];
        Session::set('admin_auth', $save_info);
        Session::set('admin_auth_sign', data_auth_sign($save_info));
        $cookie      = [
            'username' => $res['username'],
            'token'    => $token,
        ];
        $cookie_time = \think\config::get('kernel')['cookieexpire'];
        \think\Cookie::set('admin_auth', $cookie, ['expire' => (int)$cookie_time]);
        
        return ['code' => 1, 'data' => $res];
    }
}