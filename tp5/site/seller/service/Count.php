<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Count.php  Version 1.0  2017/5/26 商家结算
// +----------------------------------------------------------------------
namespace app\seller\service;

use app\seller\model\Count as CountModel;
use app\order\model\Order;
use app\seller\model\Store as StoreModel;
use app\admin\service\Service;

class Count extends Service
{
    /**
     * @Mark:商户结算汇总记录
     * @param $where = [
     *      'start_time'    =>  ['>=','1200000000'],
     *      'seller_name'   =>  ['like', '%admin%'],
     *      'status'        =>  2
     * ]
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/22
     * @return mixed
     */
    static public function countList($where = [])
    {
        $re = CountModel::where($where)->paginate(15);
        return $re;
    }
    
    /**
     * @Mark: 商家结算
     * @param $time array 结算时间区间--时间戳
     *  $time=[
     *  'start_time'=>123313
     *  'end_time'=>12355555
     * ];
     * @param $id int 商户id
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/26
     * @return mixed
     */
    static public function addCount($time = [], $id = 0)
    {
        //系统结算日
        $zhe_day = isset(getSetting()['settleday']) ? getSetting()['settleday'] : 15;
        $stime = date('Y') . '-' . date('m') . '-' . $zhe_day;
        $lm = date('m') - 1;
        $etime = date('Y') . '-' . $lm . '-' . $zhe_day;
        $start_time = $time['start_time'] ? $time['start_time'] : strtotime($stime);
        $end_time = $time['end_time'] ? $time['end_time'] : strtotime($etime);
        
        
        $where = [
            'add_time' => [
                ['>=', $start_time],                           //订单完成时间--开始
                ['<', $end_time]                               //订单完成时间--结束
            ],
            'settle_status' => 0,                            //订单表结算状态  0未结算  1结算中 2已结算
            'status' => 5                             //订单状态--已完成
        ];
        
        //平台佣金比例
        $commission = isset(getSetting()['platform_commission']) ? getSetting()['platform_commission'] / 100 : 0;
        
        //判断是否是商户手动提交结算申请
        if ($id > 0) {
            $where['seller_id'] = $id;
            //查询此次结算订单信息
            $re = Order::where($where)
                ->field("seller_id,count('order_id') as num,sum(goods_amount) as goods_amount,sum(shipping_fee) as freight,sum(bonus) as bonus,sum(integral_money) as integral_money")
                ->find();
            //获取所有结算订单id
            $ids = Order::where($where)->column('order_id');
            //查询商户名称
            $seller_name = StoreModel::where('id', $re->seller_id)->value('seller_name');
            
            $data['order_num'] = $re['num'];                         //订单总数
            $data['freight'] = $re['freight'];                     //运费总额
            $data['bonus'] = $re['bonus'];                       //红包总金额
            $data['integral_money'] = $re['integral_money'];              //积分总金额
            $data['order_money'] = $re['goods_amount'];                //商品总金额
            $data['platform_commission'] = $data['order_money'] * $commission;  //平台应得佣金
            $data['money'] = $data['order_money'] - $data['integral_money'] - $data['freight'] - $data['bonus'] - $data['platform_commission'];                                               //本期应结金额
            $data['seller_name'] = $seller_name;                       //商户名称
            $data['seller_id'] = $re['seller_id'];                   //商户id
            $data['order_ids'] = serialize($ids);                    //序列化所有结算订单id
            $data['start_time'] = $start_time;
            $data['end_time'] = $end_time;
            $re = CountModel::create($data);
            Order::where(['order_id' => ['in', $ids]])->update(['settle_status' => 1]);
            return true;
        } else {
            $re = Order::where($where)
                ->field("seller_id,count('order_id') as num,sum(goods_amount) as goods_amount,sum(shipping_fee) as freight,sum(bonus) as bonus,sum(integral_money) as integral_money")
                ->group('seller_id')
                ->select();
            foreach ($re as $v) {
                //获取所有结算订单id
                $ids = Order::where($where)->where('seller_id', $v['seller_id'])->column('order_id');
                //查询商户名称
                $seller_name = StoreModel::where('id', $v['seller_id'])->value('seller_name');
                $data['order_num'] = $v['num'];                         //订单总数
                $data['freight'] = $v['freight'];                     //运费总额
                $data['bonus'] = $v['bonus'];                       //红包总金额
                $data['integral_money'] = $v['integral_money'];              //积分总金额
                $data['order_money'] = $v['goods_amount'];                //商品总金额
                $data['platform_commission'] = $data['order_money'] * $commission;  //平台应得佣金
                $data['money'] = $data['order_money'] - $data['integral_money'] - $data['freight'] - $data['bonus'] - $data['platform_commission'];                                               //本期应结金额
                $data['seller_name'] = $seller_name;                       //商户名称
                $data['seller_id'] = $v['seller_id'];                   //商户id
                $data['order_ids'] = serialize($ids);                    //序列化所有结算订单id
                $data['start_time'] = $start_time;
                $data['end_time'] = $end_time;
                $re = CountModel::create($data);
                Order::where(['order_id' => ['in', $ids]])->update(['settle_status' => 1]);
            }
            return true;
        }
    }
    
    
    /**
     * @Mark:结算明细
     * @param $where array 查询条件
     * @Author: yang <502204678@qq.com>
     * @Version 2017/5/31
     * @return mixed
     */
    static public function detailCount($where = [])
    {
        //查看单商户结算申请明细
        if (isset($where['id'])) {
            $ids = CountModel::get($where['id']);
            //判断结算订单是否存在
            if (!$ids) return json(['code' => 0, 'msg' => lang('param_error')]);
            $data = Order::where(['order_id' => ['in', $ids['order_ids']]])->paginate(15);
        } else {
            //查看所有商户结算申请明细
            $ids_list = CountModel::where($where)->column('order_ids');
            $arr = '';
            foreach ($ids_list as $k=>$v) {
                if ($k) {
                    $arr .= ','.$v;
                } else {
                    $arr .= $v;
                }
            }
            $data = Order::where(['order_id' => ['in', $arr]])->paginate(20);
        }
        return $data;
    }
    
    /**
     * @Mark:结算订单列表
     * @param $data array(
     *  'seller_id'=>1
     * )
     * @return \think\Paginator
     * @Author: yang <502204678@qq.com>
     * @Version 2017/9/25
     */
    static public function CountInfo($data)
    {
        $ids_list = CountModel::where($data)->column('order_ids');
        $ids = '';
        foreach ($ids_list as $k=>$v) {
            if ($k) {
                $ids .= ','.$v;
            } else {
                $ids .= $v;
            }
        }
        $data = Order::where(['order_id' => ['in', $ids]])->paginate(20);
        return $data;
    }
    
    /**
     * @Mark: 修改结算状态
     * @param $ids array 结算表id
     * @param $status   int 状态
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/26
     * @return mixed
     */
    static public function editStatus($ids)
    {
        CountModel::where(['id' => ['in', implode(',', $ids)]])->setField('status', 2);
        //更改订单结算状态
        //获取结算记录
        $order_ids = CountModel::where(['id' => ['in', implode(',', $ids)]])->column('order_ids');
        $ids = '';
        foreach ($order_ids as $k=>$v) {
            if ($k) {
                $ids .= ','.$v;
            } else {
                $ids .= $v;
            }
        }
        //修改订单结算状态为已结算
        Order::where(['order_id' => ['in', $ids]])->setField('is_checkout', 1);
        return true;
    }
}