<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Fancs
// +----------------------------------------------------------------------
// | Experi.php  Version 2017/5/11 用户积分API
// +----------------------------------------------------------------------
namespace app\member\service;

use app\admin\service\Service;

class Experi extends Service
{
    /**
     * @Mark:获取用户的积分记录
     * @param $uid
     * @return false|\think\response\Json|static[]
     * @Author: fancs
     * @Version 2017/7/14
     */
    static public function get_experi($uid)
    {
        if($uid <1){
            return json(['code'=>0,'msg'=>lang('Account exit')]);
        }
        $experi = \app\member\model\Experi::all(function ($query) use ($uid){
            $query->where('uid',$uid);
        });
        return $experi;
    }
    
    /**
     * @Mark:
     * @param $data=[
     *      'uid'   =>  52                                  //用户id
     *      'change'=>  +50                                 //积分变化值
     *      'way'   =>  1                                   //积分变动方式：1增加 2减少
     *      'from'  =>  '购物获得积分'                        //积分来源
     *      'remark'=>  '当前积分来自订单：1702151834170005'   //积分备注
     * ]
     * @return bool|\think\response\Json
     * @Author: fancs
     * @Version 2017/7/14
     */
    static public function add_experi(&$data)
    {
        if(!is_array($data)){
            return json(['code'=>0,'msg'=>lang('Data_empty')]);
        }
        \app\member\model\Experi::create($data);
        return true;
    }
}
