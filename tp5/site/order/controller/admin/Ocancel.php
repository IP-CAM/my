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
// | Ocancel.php  Version 1.0  2016/3/13  取消订单列表
// +----------------------------------------------------------------------
namespace app\order\controller\admin;

use app\order\service\Order;
use think\Lang;
use app\admin\controller\Admin;
use app\order\service\Order as Orderapi;
use app\order\service\OrderGoods as OrderGoodsapi;
use app\order\service\OrderLog;
use app\order\service\Refund;

class Ocancel extends Admin
{
    /**
     * @Mark:继承
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/26
     */
    public function _initialize()
    {
        parent::_initialize();
    
        //加载语言包
        $langfile = RUNTIME_PATH . '/lang/extend_'.$this->lang.'.php';
        is_file($langfile) ? Lang::load($langfile) : $this->savecache();
    }
    
    /**
     * @Mark:订单列表
     * @param item string 平台类型 Pc app 等
     * @param prom string 活动类型
     * @param type int 订单类型
     * @param partner string 合作商
     * @param source string 订单来源
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/16
     * @return mixed
     */
    public function index()
    {
        $order_map  = $order_search = [];   //查询条件
        $param      = $this->request->param();
        $name       = isset($param['name']) ? trim($param['name']) : '';  //关键字搜索
        $prom       = isset($param['prom']) ? trim($param['prom']) : '';  //活动类型
        $status     = isset($param['status']) ? trim($param['status']) : '';   //订单状态
        $source     = isset($param['source']) ? trim($param['source']) : '';    //平台类型
        $partner    = isset($param['partner']) ? trim($param['partner']) : '';  //合作商
        $start_time = isset($param['start_time']) ? trim($param['start_time']) : ''; //下单时间开始
        $end_time   = isset($param['end_time']) ? trim($param['end_time']) : '';     //下单时间结束
    
        $order_map['cancel_status'] = ['in', ['SUCCESS', 'REFUND_PROCESS', 'WAIT_PROCESS']];
        if($status && $status != 'all')
        {
            $order_map['cancel_status'] = ['=', $status];
        }
        
        if ($source && $source <> 'all') $order_map["platform_type"] = ["=", $source];
        if ($partner && $partner <> 'all') $order_map["partner"] = ["=", $partner];
        
        //条件搜索
        $name       ? $order_map['consignee|order_sn|tel|mobile|email'] = ['like', '%' . $name . '%'] : '';
        $start_time ? $order_map['create_time'] = ['>=', strtotime($start_time)] : '';
        $end_time   ? $order_map['create_time']   = ['<=', strtotime($end_time)] : '';
        
        //同时具备时
        if($start_time && $end_time)
        {
            $index_map['create_time'] = ['between' => [$start_time, $end_time]];
        }
        
        $Order = Orderapi::getlist('Order', $order_map, 'order_id desc');
        
        $this->assign("meta_title", lang('Ocancel'));
        $this->assign('list', $Order['list']);
        $this->assign('page', $Order['page']);
        $this->assign('_total', $Order['total']);
        $this->assign('status', $status);
        $this->assign('source', $source);
        $this->assign('partner', $partner);
        $this->assign('prom', $prom);
        return $this->fetch();
    }
    
    /**
     * @Mark:审核
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/4
     */
    public function edit()
    {
        $input       = $this->request->param();
        $order_id    = isset($input['order_id']) ? $input['order_id'] : 0;
        $order_sn    = isset($input['order_sn']) ? $input['order_sn'] : '';
        empty($order_id) && $this->error(lang('Error_id'));
    
        if($this->request->isPost())
        {
            $isagree    = isset($input['isagree']) ? $input['isagree'] : 0;
            $contents   = isset($input['contents']) ? $input['contents'] : '';
            $money      = isset($input['money']) ? $input['money'] : 0.00;  //退款金额
            
            //同意
            if($isagree)
            {
                //生成退款单
                $refund = [
                    'order_id'     => $order_id,
                    'contents'     => $contents,
                    'money'        => $money,
                    'rtype'        => 0
                ];
    
                $Referres = \app\order\service\Refund::createRefund($refund);
                $remark = lang('seller_agree_cancel');
                //创建取消订单日志信息
                $Logres = OrderLog::writelog([
                    'order_id'  => $order_id,
                    'order_sn'  => $order_sn,
                    'user'      => is_login() ? is_login() : UID,
                    'role'      => 'admin',
                    'result'    => true,
                    'soruce'    => 'pc',
                    'action'    => 'cancel_order',
                    'params'    => json_encode('SUCCESS'),
                    'remark'    => $remark,
                ]);
    
                $Referres['code'] && $Logres['code'] ? $this->success($Referres['msg'], $this->jumpUrl) : $this->error($Referres['msg'], $this->jumpUrl);
            }
    
            if(empty($contents)) return json(['code' => 0, 'msg' => lang('Unagree contents must')]);
            
            $setData = [
                'model'     => 'order/Order',
                'where'     => 'order_id = '. $order_id,
                'fields'    => 'cancel_status',
                'val'       => 'FAILS'
            ];
            $Orderres = Orderapi::setFields($setData);
    
            $remark = lang('seller_disagree_cancel') . $contents;
            //创建取消订单日志信息
            $Logres = OrderLog::writelog([
                'order_id'  => $order_id,
                'order_sn'  => $order_sn,
                'user'      => is_login() ? is_login() : UID,
                'role'      => 'admin',
                'result'    => false,
                'soruce'    => 'pc',
                'action'    => 'cancel_order',
                'params'    => json_encode('FAILS'),
                'remark'    => $remark,
            ]);
    
            $Logres['code'] && $Orderres['code'] ? $this->success($Orderres['msg'], $this->jumpUrl) : $this->error($Orderres['msg'], $this->jumpUrl);
        }
        
        $order_id   = isset($input['order_id']) ? trim($input['order_id']) : '';
        $where      = [
            'model' => 'Order',
            'where' => ['order_id' => $order_id],
        ];
        $data       = Orderapi::getOne($where);
        $this->assign('data', $data['data']);
        $this->assign('meta_title', lang('Process order'));
        return $this->fetch();
    }
    
    /**
     * @Mark:订单详情
     * @return mixed
     * @param ordersn string 订单号
     * @Author: yang <502204678@qq.com>
     * @Version 2017/5/16
     */
    public function view()
    {
        $param      = $this->request->param();
        $ordersn    = isset($param['ordersn']) ? trim($param['ordersn']) : '';  //关键字搜索
        $where      = [
            'model' => 'Order',
            'where' => ['order_sn' => $ordersn],
        ];
        $data       = Orderapi::getOne($where);
        $map['order_id'] = ['=', $data['data']['order_id']];
        $goods      = Ordergoodsapi::getlist('Goods', $map, 'goods_id desc');
        //查找日志
        $log = 'order_id = '.$data['data']['order_id'].' or order_sn = "'.$data['data']['order_sn'].'"';
        $logs       = OrderLog::getlist('OrderLog', $log, 'id desc');
        $this->assign('data', $data['data']);
        $this->assign('goods', $goods);
        $this->assign('logs', $logs);
        return $this->fetch();
    }
    
    /**
     * @Mark:
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/25
     */
    public function undo()
    {
        $input       = $this->request->param();
        $order_id    = isset($input['order_id']) ? $input['order_id'] : '';
        empty($order_id) && $this->error(lang('Deletenoselect')) ;
        
        $data       = [
            'model'     => 'order/Refund',
            'where'     => 'order_id = ' . $order_id
        ];
    
        $result = Refund::getOne($data);
        
        //有退款数据
        if($result['data'])
        {
            //未退款时
            if($result['data']['status'] == '0')
            {
                //删除退款岁数数据
                $Ref = Refund::del($data);
    
                //改变原始订单取消状态为等待审核
                $process = [
                    'model'     => 'order/Order',
                    'where'     => 'order_id = '. $order_id,
                    'fields'    => 'cancel_status',
                    'val'       => 'WAIT_PROCESS'
                ];
                $Orderres = Orderapi::setFields($process);
                
                $Ref['code'] && $Orderres['code'] ? $this->success(lang('Undo refund succ'), $this->jumpUrl) : $this->error(lang('Undo refund fail'), $this->jumpUrl);
            }else{
                $this->error(lang('Order refunded'), $this->jumpUrl);
            }
        }
    
        $this->error(lang('Refund data error'), $this->jumpUrl);
    }
}