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
// | 具备清关支付的接口基类  Version 2016/7/23
// +----------------------------------------------------------------------
namespace app\common\libs;

use think\Url;
use app\order\service\Order as OrderApi;
use app\stools\model\PaymentBill;

abstract class Paypush extends Baseexted
{
    public $version             = '';    //版本
    public $platform            = '';    //平台
    
    /**
     * @Mark:构造函数
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/12/23
     */
    public function __construct($platform = 'pc')
    {
        $this->platform = $platform;
    }
    
    /**
     * @Mark:记录流水号
     * @param $callbackData 订单号
     * @param $payment 支付类名
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/8/12
     */
    protected function writeCustom($callbackData, $payment)
    {
    
    }
    
    /**
     * @Mark:推送支付单
     * @param $sendData
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/10
     */
    abstract public function doPush($sendData);
    
    /**
     * @Mark:查询推送的支付单
     * @param $sendData
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/10/16
     */
    abstract public function doQuery($sendData);
    
    /**
     * @Mark:获取提交地址
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/12/23
     */
    abstract public function getSubmitUrl();
    
}