<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Fancs
// +----------------------------------------------------------------------
// | Deposit.php  Version 2017/6/27 用户预存款记录API
// +----------------------------------------------------------------------
namespace app\member\service;

use app\admin\service\Service;

class Deposit extends Service
{
    /**
     * @Mark：查询用户预存款记录
     * @param $data ['name'=>'fancs']
     * @return mixed|string
     * @author Fancs
     * @version 2017/6/27
     */
    static public function get_money_log(&$data)
    {
        $info = Member::getUserInfo($data);
        if(!$info) return json(['code' => 0, 'msg' => lang('Account is exits or enable')]);
    
        $without = \app\member\model\Deposit::all(['uid'=>$info['id']]);
    
        if(empty($without)){
            return json(['code' => 0, 'msg' => lang('Can`t find this user log')]);
        }
        return $without;
    }
}
