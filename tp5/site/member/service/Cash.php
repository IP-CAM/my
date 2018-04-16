<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Cash.php  Version 2017/5/11 充值相关API
// +----------------------------------------------------------------------
namespace app\member\service;

use app\member\model\Account;
use app\member\model\Cashlog;
use app\admin\service\Service;

class Cash extends Service
{
    /**
     * @Mark:充值API
     * @param array $data
     * $data = array(
     *      'uid'       => 1,  //用户ID
     *      'fromuid'   => 0,  //代充用户ID
     *      'money'     => 0.01, //充值金额
     *      'from'      => empty($from) ? 'default' : $from, //平台来源
     *      'remark'    => '捐款', //充值金额
     * );
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/5/11
     */
    public static function recharge(&$data = array())
    {
        //充用户是否存在检查代
        if($data['fromuid'])
        {
            $fromuid = Account::get(function($query) use ($data){
                $query->where('id', $data['fromuid']);
            });
            
            if(! empty($fromuid)) return lang('Fromuid is not exit');
        }
        
        //if($data['moneny'] < 0) return lang('Recharge money unallow less than 0');
        
        //检查用户ID对应的应用是否存在或者状态是否正常
        $uid = Account::get(function($query) use ($data){
            $query->where('id', $data['uid']);
        });
    
        if(empty($fromuid)) return lang('User is not exit');
        
        //状态判断
        if(! empty($uid['status'])) return $uid['status'];
        
        //修改用户充值字段值
        $res = Account::where('uid', $data['uid'])->update(['moneny' => $uid['moneny'] + $data['moneny']]);
        if(empty($res)) return lang('Update user money error');
        
        //写充值日志
        Cashlog::create([
            'uid'       =>  $data['uid'],
            'moneny'    =>  $data['moneny'],
            'fromuid'   =>  $data['fromuid'],
            'from'      =>  $data['from'],
            'remark'    =>  $data['remark'],
        ]);
        
        return true;
    }
    /**
     * @Mark:更新充值信息
     * @param $data = [
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
        
        $res = \app\member\model\Cashorder::update($data);
        
        if($res){
            return true;
        }
        return false;
    }
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
            $order = \app\member\model\Cash::all(['uid'=>$info['id']]);
        }
        
        if(isset($data['order_sn'])){
            $order = \app\member\model\Cash::get(['order_sn'=>$data['order_sn']]);
        }
        if(!isset($data)){
            $order = \app\member\model\Cash::all();
        }
        
        
        if(empty($order)){
            return json(['code' => 0, 'msg' => lang('Can`t find this user cash log')]);
        }
        return $order;
    }
}