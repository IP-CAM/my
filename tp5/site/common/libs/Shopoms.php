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
// | Common.php  Version 2017/2/26
// +----------------------------------------------------------------------
namespace app\common\libs;

abstract class Shopoms extends Baseexted
{
    /**
     * @Mark:同步
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/12/30
     */
    abstract static public function syncGoods(&$data);
    
    /**
     * @Mark:推送订单数据到OMS 商城到OMS
     * @param $data
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/10/17
     */
    abstract static public function sendOrder(&$data);
    
    /**
     * @Mark:同步订单数据，OMS到商城
     * @param $data
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/10/17
     */
    abstract static public function syncOrder(&$data);
}