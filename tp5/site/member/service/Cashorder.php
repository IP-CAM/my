<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: fancs
// +----------------------------------------------------------------------
// | Cashorder.php  Version 2017/7/1 充值订单API
// +----------------------------------------------------------------------
namespace app\member\service;

use app\admin\service\Service;

class Cashorder extends Service
{
    /**
     * @Mark：查询用户充值订单
     * @param $data [
     *      'name'      => 'fancs'          //用户id/手机/邮箱
     *      'order_sn'  => '17666465656'    //订单号
     * ]
     * @return mixed|string
     * @author Fancs
     * @version 2017/7/1
     */
    static public function get_order(&$data=[])
    {
        if(isset($data['name'])){
            //检查用户ID对应的应用是否存在或者状态是否正常
            $info = Member::getUserInfo($data);
            if(!$info) return json(['code' => 0, 'msg' => lang('Account is exits or enable')]);
            $order = \app\member\model\Cashorder::all(['uid'=>$info['id']]);
        }
        
        if(isset($data['order_sn'])){
            $order = \app\member\model\Cashorder::get(['order_sn'=>$data['order_sn']]);
        }
        if(!isset($data)){
            $order = \app\member\model\Cashorder::all();
        }
        
        
        if(empty($order)){
            return json(['code' => 0, 'msg' => lang('Can`t find this user cash order')]);
        }
        return $order;
    }
    
    /**
     * @Mark:添加/更新充值订单
     * @param $data = [
     *      'uid'           =>  3                   //用户id
     *      'money'         =>  100                 //充值金额
     *      'pay_status'    =>  0                   //支付状态:0待支付 1支付成功 2交易关闭
     *      //更新订单信息
     *      'id'            =>  2                   //订单id
     *      'pay_name'      =>  '支付宝'             //支付方式
     *      'pay_time'      =>  '31487965456'       //支付时间戳
     *      'pay_status'    =>  1                   //支付状态:0待支付 1支付成功 2交易关闭
     * ]
     * @return bool|\think\response\Json
     * @Author: fancs
     * @Version 2017/7/1
     */
    static public function add_order(&$data)
    {
        $class = \think\Loader::parseClass(MODULE_NAME, 'validate', 'cashorder', false);
        //存在验证器刚执行
        if (class_exists($class)) {
            $validate =  \think\Loader::validate($class);
            $result =   $validate->check($data);
            if(!$result){
                return json(['code' => 0, 'msg' => $validate->getError()]);
            }
        }
        if(isset($data['id'])){
            $res = \app\member\model\Cashorder::update($data);
        }else{
            $res = \app\member\model\Cashorder::create($data);
        }
        if($res){
            return true;
        }
        return false;
    }
}