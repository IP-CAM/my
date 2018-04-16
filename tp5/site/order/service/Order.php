<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Order.php  Version 2017/7/13  订单API
// +----------------------------------------------------------------------
namespace app\order\service;

use think\Loader;
use app\admin\service\Service;
use app\member\service\Member;
use app\crossbbcg\model\Goods;
use app\crossbbcg\model\GoodsSku;
use app\order\model\Order as OrderModel;
use app\order\model\Goods as OrderGoods;
use app\stools\model\PaymentBill;
use app\order\model\ConfirmLog;
use app\order\model\Afterservice as AfterserviceModel;
use app\order\service\OrderLog as OrderLogApi;

class Order extends Service
{
    /**
     * @Mark:根据用户ID生成唯一订单号
     * @param $uid int 会员ID号
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/14
     */
    static public function ordersnApi($uid)
    {
        return date('ymdHi') . str_pad(substr(microtime(), 3, 6), 5, '0', STR_PAD_LEFT) . str_pad($uid % 10000, 4, '0', STR_PAD_LEFT);
    }
    
    /**
     * @Mark:创建订单
     * @param $data array
     * $data = [
     *      'username'  => 'yang|theseaer@qq.com|13322936015',
     *      'password'  => '',         //可选，远程注册时默认密码：111111Abc，该用户已存在系统时无需密码
     *      'ip'        => '',         //下单时的用户IP地址
     *      'source'    => '',         //来源模块，默认为调用该模块的名称
     *      'sku_ids'   => '1,2,3,4',  //SKUid，多个用,分隔开
     *      'sku_nums'  => '1,2,1,1',  //SKUid对应的商品数量,分隔开，如不传，默认数量为1
     *      'sku_tax'   => '1,2,1,1',  //SKUid对应的商品税费,分隔开，如不传，默认数量为0
     *      'order_type'=> '1',        //1,正常订单，0，测试订单（由系统生成）
     *      'receipt'   => [
     *           recode     => '100000/200000/30000',  //省市县区代码组合
     *           'consignee'  => '1,2,1,1',  //收货人姓名
     *           'country'    => '1,2,1,1',  //收货的国家
     *           'province'   => '1,2,1,1',  //收货的省份
     *           'city'       => '',  //收货的城市
     *           'district'   => '',  //收货的地区
     *           'address'    => '',  //收货人详细地址
     *           'zipcode'    => '',  //收货人邮编
     *           'tel'        => '',  //收货人电话
     *           'mobile'     => '',  //收货人手机号
     *           'email'      => '',  //收货人email
     *       ],
     *      'postscript'   => '订单附言',  //订单附言
     *      'inv_payee'    => '',  //发票抬头
     *      'inv_type'     => '',  //发票类型  1,公司，2，个人
     *      'inv_number'   => '',  //纳税人训别号
     *      'goods_amount' => '9.99',  //商品总金额
     *      'integral'     => '10',  //可该订单可获取的积分
     *      'bonus'        => '10.00',  //使用红包金额
     *      'order_amount' => '99.00',  //应付金额
     *      'crossware_code' => string 仓库代码
     *      'transport_id' => int 运费模板id
     *      'platform_type'=> 'app|pc|wap|api|other',     //平台来源
     *      'create_time'  => time(),   //订单创建时间
     *      'bonus_id'     => 10,       //红包ID
     *      'extension_id' => 10,       //红包ID
     *      'shipping_fee' => 10,       //运费
     *      'extension_code' => 'tuan',      //活动标识代码
     *      'discount'      => '0.00',       //优惠金额
     *      'symbol'        => '0.00',       //货币符号
     *      'code'          => '0.00',       //货币代码
     *      'rate'          => '0.00',       //汇率
     *      'order_tax'     => 0.00          //发票税费
     *
     * ];
     * @return bool|\think\response\Json
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/13
     */
    static public function createOrderApi(&$data)
    {
        //查询用户是否存在，不存在刚进行注册(闭包函数写法)
        $uid = (function () use ($data) {
            $usename = ['name' => $data['username']];
            $u       = Member::getUserInfo($usename);
            if ($u) {
                return $u['id'];
            } else {
                $data = [
                    'name'     => $data['username'],
                    'password' => md5(isset($data['password']) ? $data['password'] : '111111Abc'),
                    'ip'       => $data['ip'],
                    'source'   => isset($data['source']) ? $data['source'] : MODULE_NAME,
                    'outsrc'   => isset($data['outsrc']) ? $data['outsrc'] : '',
                ];
                //返回用户注册后的ID
                return Member::register($data);
            }
        })();
        //检查订单中的商品及数量
        $skuid_err = $skunum_err = $skumax_err = $skumax_err = [];  //记录SKU出错信息；
        $goodsList = []; //商品详细
        $sku_id    = explode(',', $data['sku_ids']);   //SKUID
        $sku_num   = explode(',', $data['sku_nums']);  //sku对应的数量
        $sku_tax   = explode(',', $data['sku_tax']);   //sku对应的税费
        $sku_thumb = explode(',', $data['sku_thumb']);   //sku对应的图片
        foreach ($sku_id as $key => $sku) {
            //检查商品SKUID是否存在
            $skuidRes = GoodsSku::where('sku', '=', $sku)->find();
            if (!$skuidRes) {
                $skuid_err[] = $sku;
            } else {
                //检查SKU对应的商品数量是否充足
                if ($skuidRes['quantity'] < $sku_num[$key]) {
                    $skunum_err[] = $sku . ' : ' . $sku_num[$key];
                }
                
                //检查SKU对应的商品一次购买时最大购买数量
                $Goods = Goods::get($skuidRes['good_id'], 'country');
                if ($Goods['maximum'] && $Goods['maximum'] < $sku_num[$key]) {
                    $skumax_err[] = $sku . ' : ' . $sku_num[$key];
                }
                
                //组装商品详细数据
                $goodsList[] = [
                    'goods_id'       => $Goods['id'],
                    'goods_name'     => $Goods['name'],
                    'sku'            => $sku,
                    'sku_batch'      => $skuidRes['good_batch'],     //SKU批次号
                    'sku_pv'         => $Goods['pv'],                //商品净利润
                    'sku_kickback'   => $Goods['kickback'],          //佣金
                    'sku_code'       => $Goods['good_code'],         //商品编码
                    'sku_barcode'    => $skuidRes['good_barcode'],   //商品条码
                    'sku_packge_num' => $Goods['package_num'],       //包装数量
                    'sku_number'     => $sku_num[$key],              //购买数量
                    'sku_thumb'      => $sku_thumb[$key],            //SKU对应的图片
                    'sku_price'      => $skuidRes['sale_price'],     //下单时的价格
                    'sku_tax'        => $sku_tax[$key],              //下单时的税费
                    'sku_weight'     => $Goods['weight'],            //记录下单时的重量
                    'sku_warecode'   => $data['crossware_code'],     //仓库代码
                    'country_code'   => $Goods['country']['code'], //国家代码
                    'country_name'   => $Goods['country']['name'], //国家名称
                    'goods_type'     => $Goods['type'], // 商品类型
                    'market_price'   => $Goods['market_price'],
                    'seller_id'      => $Goods['seller_id'],
                    'sku_array'      => $skuidRes['name'],           //规格
                ];
            }
        }
        
        //发现商品SKUID不存在时报错
        if ($skuid_err) return ['code' => 0, 'msg' => lang('Goods sku not exits') . implode(', ', $skuid_err)];
        
        //发现商品SKUID对应的商品数量有误时报错
        if ($skunum_err) return ['code' => 0, 'msg' => lang('Goods sku num inadequate') . implode(', ', $skunum_err)];
        
        //发现商品SKUID对应的商品许可最大购买数量有误时报错
        if ($skumax_err) return ['code' => 0, 'msg' => lang('Goods sku num exceed max buys') . implode(', ', $skumax_err)];
        
        $OrderModel = new OrderModel;
        //组装订单信息数据
        $OrderModel->order_sn     = self::ordersnApi($uid);
        $OrderModel->batch_no     = isset($data['batch_no']) ? $data['batch_no'] : '';
        $OrderModel->order_type   = isset($data['order_type']) ? $data['order_type'] : 0;
        $OrderModel->user_id      = $uid;
        $OrderModel->status       = 'WAIT_BUYER_PAY';
        $OrderModel->consignee    = isset($data['receipt']['consignee']) ? $data['receipt']['consignee'] : '';
        $OrderModel->recode       = isset($data['receipt']['recode']) ? $data['receipt']['recode'] : '';
        $OrderModel->country      = isset($data['receipt']['country']) ? $data['receipt']['country'] : '';
        $OrderModel->province     = isset($data['receipt']['province']) ? $data['receipt']['province'] : '';
        $OrderModel->city         = isset($data['receipt']['city']) ? $data['receipt']['city'] : '';
        $OrderModel->district     = isset($data['receipt']['district']) ? $data['receipt']['district'] : '';
        $OrderModel->address      = isset($data['receipt']['address']) ? $data['receipt']['address'] : '';
        $OrderModel->zipcode      = isset($data['receipt']['zipcode']) ? $data['receipt']['zipcode'] : '';
        $OrderModel->tel          = isset($data['receipt']['tel']) ? $data['receipt']['tel'] : '';
        $OrderModel->mobile       = isset($data['receipt']['mobile']) ? $data['receipt']['mobile'] : '';
        $OrderModel->email        = isset($data['receipt']['email']) ? $data['receipt']['email'] : '';
        $OrderModel->warecode     = isset($data['crossware_code']) ? $data['crossware_code'] : ''; //仓库
        $OrderModel->transport_id = isset($data['transport_id']) ? $data['transport_id'] : ''; //运费模板id
        $OrderModel->postscript   = isset($data['postscript']) ? $data['postscript'] : '';  //订单附言
        $OrderModel->inv_payee    = isset($data['inv_payee']) ? $data['inv_payee'] : '';  //发票抬头
        $OrderModel->inv_type     = isset($data['inv_type']) ? $data['inv_type'] : '';     //发票类型
        $OrderModel->inv_number   = isset($data['inv_number']) ? $data['inv_number'] : '';  //纳税人识别号
        $OrderModel->shipping_fee = isset($data['shipping_fee']) ? $data['shipping_fee'] : 0.00;//纳税人识别号
        //商品总金额
        $OrderModel->goods_amount = isset($data['goods_amount']) ? $data['goods_amount'] : '0.00';
        $OrderModel->integral     = isset($data['integral']) ? $data['integral'] : '0';  //可该订单可获取的积分
        $OrderModel->bonus        = isset($data['bonus']) ? $data['bonus'] : '0';  //使用红包金额
        //应付金额
        $OrderModel->order_amount = isset($data['order_amount']) ? $data['order_amount'] : '0.00';
        //平台来源
        $OrderModel->platform_type = isset($data['platform_type']) ? strtolower($data['platform_type']) : 'pc';
        $OrderModel->create_time   = time();   //订单创建时间
        $OrderModel->order_tax     = isset($data['order_tax']) ? $data['order_tax'] : '0.00'; //订单税费
        $OrderModel->tax           = isset($data['tax']) ? $data['tax'] : '0.00';             //发票税费
        $OrderModel->bonus_id      = isset($data['bonus_id']) ? $data['bonus_id'] : '';       //红包ID
        $OrderModel->extension_id  = isset($data['extension_id']) ? $data['extension_id'] : ''; //红包ID
        $OrderModel->ip            = isset($data['ip']) ? $data['ip'] : get_client_ip();
        //活动标识代码
        $OrderModel->extension_code = isset($data['extension_code']) ? $data['extension_code'] : '';
        $OrderModel->discount       = isset($data['discount']) ? $data['discount'] : '';       //折扣
        $OrderModel->symbol         = isset($data['symbol']) ? $data['symbol'] : '￥';          //符号
        $OrderModel->code           = isset($data['code']) ? $data['code'] : 'CNY';             //货币代码
        $OrderModel->rate           = isset($data['rate']) ? $data['rate'] : '1';               //汇率
        $OrderModel->seller_id      = isset($data['seller_id']) ? $data['seller_id'] : 0;       //商户
        //跨境参数
        $OrderModel->idnumber = isset($data['receipt']['idnumber']) ? $data['receipt']['idnumber'] : '';
        //身份证号
        $OrderModel->sfzzm = isset($data['receipt']['sfzzm']) ? $data['receipt']['sfzzm'] : '';         //身份证正面
        $OrderModel->sfzfm = isset($data['receipt']['sfzfm']) ? $data['receipt']['sfzfm'] : '';         //身份证反面
        
        //数据入库
        $OrderModel->isUpdate(false)->save();
        
        $order_id = $OrderModel->order_id;
        
        //创建日志信息
        OrderLogApi::writelog([
            'order_id' => $order_id,
            'order_sn' => $OrderModel->order_sn,
            'user'     => $data['username'],
            'result'   => true,
            'soruce'   => 'pc',
            'action'   => 'create_order',
            'remark'   => '',
        ]);
        
        //写入订单中包含的商品数据
        foreach ($goodsList as $keys => $item) {
            $item['order_id'] = $order_id;
            OrderGoods::insert($item);
        }
        
        return ['code' => 1, 'msg' => $OrderModel->order_sn];
    }
    
    /**
     * @Mark:取消订单
     * @param $data array 取消订单时传递过来的数据；
     * $data = [
     *      'cancel_reason' => '369147258',  //取消原因
     *      'order_id'      => order_id,           //取消订单的ID ,
     *      'cancel_reason_log' => string 取消订单日志记录信息
     *      'cancel_opt'    => 'user_id|admim|system',     //取消订单的操作者
     *      'cancel_soruce' => 'PC|WAP|Wechat|App|Other',  //取消订单的发起平台
     *      'role'  => 'customer|...', // 操作的角色，顾客，客服，管理员，等待
     * ];
     * @return bool
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/14
     */
    static public function cancelOrderApi(&$data)
    {
        $orderInfo = OrderModel::get($data['order_id']);
        
        if ($orderInfo == null) {
            return ['code' => 0, 'msg' => lang('Order not find')];
        }
        
        // 未付款|待发货
        if ($orderInfo['status'] == 'WAIT_SELLER_SEND_GOODS' || $orderInfo['status'] == 'WAIT_BUYER_PAY') {
            $cancelArr = [
                'cancel_type'   => isset($data['cancel_type']) ? $data['cancel_type'] : 0,
                'cancel_status' => $orderInfo['pay_status'] ? 'WAIT_PROCESS' : 'SUCCESS',
                'cancel_reason' => $data['cancel_reason'],
                'order_id'      => $data['order_id'],
                'cancel_opt'    => $data['cancel_opt'],
                'cancel_soruce' => $data['cancel_soruce'],
                'cancel_time'   => time()
            ];
            $orderInfo['pay_status'] ? '' : $cancelArr['status'] = 'TRADE_CLOSED';
            
            // 取消订单的状态不更改
            if($orderInfo['status'] == 'WAIT_BUYER_PAY'){
                $cancelArr['cancel_status'] = 'NO_APPLY';
            }
            
            $cancelStatus = OrderModel::where('order_id = "' . $data['order_id'] . '"')->update($cancelArr);
            
            //创建取消订单日志信息
            if(isset($data['cancel_reason_log'])){
                $remark = $data['cancel_reason_log'];
            }else{
                $remark = $data['cancel_reason'];
            }
            
            if($orderInfo['status'] == 'WAIT_BUYER_PAY'){
                $remark = '';
            }
            
            OrderLogApi::writelog([
                'order_id' => $data['order_id'],
                'order_sn' => $orderInfo['order_sn'],
                'user'     => is_login() ? is_login() : UID,
                'role'     => $data['role'],
                'result'   => $cancelStatus ? true : false,
                'soruce'   => $data['cancel_soruce'],
                'action'   => 'cancel_order',
                'params'   => json_encode($cancelArr),
                'remark'   => $remark,
            ]);
            
            if ($cancelStatus) {
                if ($orderInfo['pay_status']) {
                    return ['code' => 1, 'msg' => lang('wait_cancel')];
                } else {
                    return ['code' => 1, 'msg' => lang('Cancel_succ')];
                }
                
            }
            return ['code' => 0, 'msg' => lang('Unable change shipped')];
        }
        
        return ['code' => 0, 'msg' => lang('Cancel_fail')];
    }
    
    /**
     * @Mark:返回订状态
     * @param $order_sn string 需要查询状态的订单号，可查询多个，用逗号分隔即可；
     * $order_sn = '170714184712801000, 170714185728941000, 17071418586491000, 170714185818981000';
     * @return string
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/14
     */
    static public function getOrderStatusApi($order_sn)
    {
        $res = [];
        foreach (explode(',', $order_sn) as $key => $v) {
            $res[$v] = OrderModel::where('order_sn = "' . $v . '"')->value('status');
        }
        
        return ['code' => 1, 'msg' => '', 'data' => $res];
    }
    
    /**
     * @Mark:返回订单支付状态
     * @param $order_sn string 需要查询状态的订单号，可查询多个，用逗号分隔即可；
     * $order_sn = '170714184712801000, 170714185728941000, 17071418586491000, 170714185818981000';
     * @return string
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/14
     */
    static public function getPayStatusApi($order_sn)
    {
        
        return 'WAIT';
    }
    
    /**
     * @Mark:更新订单状态
     * @param $orderNo
     * @param string $admin_id
     * @param string $note
     * @return $this
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/8/12
     */
    static public function updateOrderStatus($orderNo, $class = '', $admin_id = '', $note = '')
    {
        $payClass    = '\\' . $class;
        $extConfig[] = $payClass::setup();
        
        $where     = [
            'model' => 'order/Order',
            'where' => ['order_sn' => $orderNo],
        ];
        $orderInfo = self::getOne($where);;
        
        $dataArray = array(
            'status'     => 'WAIT_SELLER_SEND_GOODS',  //付款完成后等待商家发货
            'pay_class'  => $class,    //支付插件类
            'pay_name'   => isset($extConfig[0]['name']) ? $extConfig[0]['name'] : $payClass, //支付插件类
            'pay_time'   => time(),//支付时间
            'pay_status' => 1,     //支付状态
            'pay_ip'     => get_client_ip(),     //支付IP
        );
        
        $pres = PaymentBill::where('order_sn = "' . $orderNo . '"')->update([
            'ip'       => $dataArray['pay_ip'],
            'amount'   => $orderInfo['data']['order_amount'],
            'currency' => $orderInfo['data']['code'],  //将货币更新过来
        ]);
        
        if (!$pres) return ['code' => 0, 'msg' => lang('Update PaymentBill ip Fail')];
        $ores = OrderModel::where('order_sn = "' . $orderNo . '"')->update($dataArray);
        
        //创建更新订单日志信息
        OrderLogApi::writelog([
            'order_id' => $orderInfo['data']['order_id'],
            'order_sn' => $orderNo,
            'user'     => $admin_id,
            'result'   => $ores ? true : false,
            'action'   => 'update_order_status',
            'soruce'   => PLATFORM,
            'params'   => json_encode($dataArray),
            'remark'   => $note,
        ]);
        
        if (!$ores) return ['code' => 0, 'msg' => lang('Update order status Faill')];
        return ['code' => 1, 'msg' => lang('Update order status Succ')];
    }
    
    /**
     * @Mark:更新订单
     * @param $data
     * $data = [
     * 'consignee'     => '张三222',
     * 'order_amount'  => '1499.00',
     * 'shipping_fee'  => '0.00',
     * 'country'       => '44',
     * 'province'      => '440000',
     * 'city'          => '440300',
     * 'district'      => '440306',
     * 'address'       => '阿斯顿发生吩咐过热施工队v',
     * 'mobile'        => '18573538575',
     * 'order_id'      => '1',
     * ];
     * @return array
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/8/19
     */
    static public function updateOrder(&$data)
    {
        $order_id = $data['order_id'];
        unset($data['order_id']);
        $res = OrderModel::where('order_id = "' . $order_id . '"')->update($data);
        
        //创建更新订单日志信息
        OrderLogApi::writelog([
            'order_id' => $order_id,
            'order_sn' => $data['order_sn'],
            'user'     => '',
            'result'   => $res ? true : false,
            'action'   => 'update_order',
            'params'   => json_encode($data),
            'soruce'   => PLATFORM,
            'remark'   => '',
        ]);
        
        if (!$res) return ['code' => 0, 'msg' => lang('Update order Faill')];
        return ['code' => 1, 'msg' => lang('Update order Succ')];
    }
    
    /**
     * @Mark:设置订单完成（确认订单API）
     * @param $data
     * $data = [
     *    'order_id' => '',
     *    'uid'      => //可选
     *   'seller_id' => //可选
     *    'opt_id'   => //可选
     *    'source'   => 'system|user|seller',
     * ]
     * @return array
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/8/21
     */
    static public function confirmorder(&$data)
    {
        $order_id = $data['order_id'];
        $res      = OrderModel::where('order_id = "' . $order_id . '"')->setField('status', 'TRADE_FINISHED');
        
        ConfirmLog::insert([
            'order_id'  => $data['order_id'],
            'source'    => isset($data['source']) ? $data['source'] : 'system',
            'uid'       => isset($data['uid']) ? $data['uid'] : 0,
            'seller_id' => isset($data['seller_id']) ? $data['seller_id'] : 0,
            'opt_id'    => isset($data['opt_id']) ? $data['opt_id'] : 0,
        ]);
        
        //创建确认订单日志信息
        OrderLogApi::writelog([
            'order_id' => $data['order_id'],
            'order_sn' => '',
            'user'     => isset($data['uid']) ? $data['uid'] : 0,
            'result'   => $res ? true : false,
            'soruce'   => PLATFORM,
            'action'   => 'confirm_order',
            'params'   => '',
            'remark'   => '',
        ]);
        
        if (!$res)
            return ['code' => 0, 'msg' => lang('Update order Faill')];
        
        return ['code' => 1, 'msg' => lang('Update order Succ')];
    }
    
    /**
     * @Mark: 申请售后
     * @param $data = [
     * 'order_id' => int 订单id
     * 'order_sn' => int 订单编号
     * 'rec_id' => int 订单商品表id
     * 'user_id' => int 用户id
     * 'rtype' => int 售后类型，[0,1,2]
     * 'return_reason' => string 售后原因
     * 'role' => string 操作角色 customer,seller,admin
     * 'source' => string 来源 'api','app','wap','wechat','pc'
     * 可选项
     * 'return_images' => string 图片，逗号隔开多个
     * 'return_description' => string 描述
     *
     * ]
     * @return \think\response\Json
     * @Author: WangHuaLong
     */
    static public function createAfterservice($data)
    {
        // 验证数据
        $class    = Loader::parseClass('order', 'validate', 'Afterservice');
        $validate = Loader::validate($class);
        $result   = $validate->check($data);
        if ($result !== true) {
            return json(['code' => 0, 'msg' => $validate->getError()]);
        }
        $source = $data['source'];
        $role   = $data['role'];
        unset($data['source']);
        unset($data['role']);
        
        // 生成退换货编号
        $after_sn = 'AF'. self::ordersnApi($data['user_id']);
        $data['after_sn'] = $after_sn;
        AfterserviceModel::create($data);
        
        // 创建取消订单日志信息
        OrderLogApi::writelog([
            'order_id' => $data['order_id'],
            'order_sn' => $data['order_sn'],
            'user'     => $data['user_id'],
            'role'     => $role,
            'result'   => 1,
            'soruce'   => $source,
            'action'   => 'create_afterservice',
            'params'   => json_encode($data),
            'remark'   => $data['return_reason'],
        ]);
        
        return json(['code' => 1, 'msg' => lang('apply_success')]);
    }
    
    /**
     * @Mark:返回统计状态数量
     * @param $status
     * @return int
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/8/23
     */
    static public function getOrderCountByStatus($status)
    {
        return OrderModel::where('status = "' . $status . '"')->count();
    }
}