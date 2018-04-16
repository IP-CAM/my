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
// | Version 2017/07/04 支付处理
// +----------------------------------------------------------------------
namespace app\stools\controller;

use think\Request;
use app\common\controller\Home;
use app\stools\service\Recharge as RechargeApi;
use app\order\service\Order as OrderApi;

class Payment extends Home
{
    /**
     * @Mark:首页
     * @return mixed
     * @Author: lingdong <lingdong@qq.com>
     * @Version 2017/2/21
     */
    public function _empty(Request $request)
    {
        //重新定位到首页
        $this->redirect('index/index/index');
    }
    
    /**
     * @Mark:支付回调函数地址(同步)
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/10
     */
    public function callback()
    {
        $input = $this->request->param();
        //获取使用的支付插件
        $class           = isset($input['class']) ? base64_decode($input['class']) : $this->error(lang('Error_id'));
        $platform        = isset($input['platform']) ? $input['platform'] : 'pc';
        $paymentInstance = new $class($platform);
        
        unset($input['class']);
        unset($input['platform']);
        
        //初始化参数
        $money   = '';
        $message = lang('Payment failed');
        $orderNo = '';
        $return  = $paymentInstance->callback($input, $class, $money, $message, $orderNo);
        
        //创建支付日志信息
        /*OrderLog::insert([
            'order_id'  => '',
            'order_sn'  => $input['out_trade_no'],
            'user'      => $data['username'],
            'result'    => $return['code'] == 1 ? true : false,
            'action'    => lang('Payment order'),
            'remark'    => '',
        ]);*/
        
        //支付成功
        if ($return['code'] == 1) {
            //充值方式
            if (stripos($orderNo, 'recharge') !== false) {
                $tradenoArray = explode('recharge', $orderNo);
                $recharge_no  = isset($tradenoArray[1]) ? $tradenoArray[1] : 0;
                if (RechargeApi::updateRecharge($recharge_no)) {
                    return $this->fetch('recharge_succ');
                }
                //充值失败
                return $this->fetch('recharge_fail');
            } else {
                //订单批量结算缓存机制
                $moreOrder = array();//订单号 => 订单金额
                $orderList = explode(',', $orderNo);
                if ($orderList) {
                    foreach ($orderList as $key => $val) {
                        $map['where'] = 'order_sn = ' . $val;
                        $map['model'] = 'order/Order';
                        $orderRow     = OrderApi::getOne($map);
                        if ($orderRow['data']) {
                            $moreOrder[$val] = $orderRow['data']['order_amount'];
                        }
                    }
                }
                if ($money >= array_sum($moreOrder)) {
                    foreach ($moreOrder as $key => $item) {
                        $orderRes = OrderApi::updateOrderStatus($key, $class);
                        if (!$orderRes) {
                            return json(['code' => 0, 'msg' => lang('Order edit failed, Order sn') . $key]);
                        }
                    }
                    return $this->fetch('pay_succ');
                }
                
                $message = lang('Order amount neq payment amount');
            }
        }
        
        $this->assign('msg', $message ? $message : null);
        return $this->fetch('pay_fail');
    }
    
    /**
     * @Mark:回调业务处理地址(异步)
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/10
     */
    public function servercallback()
    {
        $input = $this->request->param();
        //获取使用的支付插件
        $class           = isset($input['class']) ? base64_decode($input['class']) : $this->error(lang('Error_id'));
        $platform        = isset($input['platform']) ? $input['platform'] : 'pc';
        $paymentInstance = new $class($platform);
        
        unset($input['class']);
        unset($input['platform']);
        
        //初始化参数
        $money   = '';
        $message = lang('Payment failed');
        $orderNo = '';
        
        $return = $paymentInstance->serverCallback($input, $class, $money, $message, $orderNo);
        
        //支付成功失败处理
        if ($return['code'] == 1) {
            //充值方式
            if (stripos($orderNo, 'recharge') !== false) {
                $tradenoArray = explode('recharge', $orderNo);
                $recharge_no  = isset($tradenoArray[1]) ? $tradenoArray[1] : 0;
                if (RechargeApi::updateRecharge($recharge_no)) {
                    $paymentInstance->notifyStop();
                }
            } else {
                //订单批量结算缓存机制
                $moreOrder = array();//订单号 => 订单金额
                $orderList = explode(',', $orderNo);
                if ($orderList) {
                    foreach ($orderList as $key => $val) {
                        $map['where'] = 'order_sn = ' . $val;
                        $orderRow     = OrderApi::getOne($map);
                        if ($orderRow['data']) {
                            $moreOrder[$val] = $orderRow['data']['order_amount'];
                        }
                    }
                }
                
                if ($money >= array_sum($moreOrder)) {
                    foreach ($moreOrder as $key => $item) {
                        $orderRes = OrderApi::updateOrderStatus($key, $class);
                        if (!$orderRes) {
                            //$this->error(lang('Sync order callback edit failed, Order sn'). $key );
                            return json(['code' => 0, 'msg' => lang('Sync order edit failed, Order sn') . $key]);
                        }
                    }
                    $paymentInstance->notifyStop();
                }
            }
        }
        
        return 'fail';
    }
    
    /**
     * @Mark:中断支付返回
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/10
     */
    public function merchantcallback()
    {
        $this->fetch('index/index/index');
    }
    
    /**
     * @Mark:支付成功页面
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/20
     */
    public function succ()
    {
        $this->fetch('pay_succ');
    }
    
    /**
     * @Mark:支付失败页面
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/20
     */
    public function fail()
    {
        $this->fetch('pay_fail');
    }
}
