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
// | 订单处理接口  Version 2016/11/10
// +----------------------------------------------------------------------
namespace app\common\libs;

abstract class Order extends Baseexted
{
    /**
     * @Mark:组合/创建订单数据
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/13
     */
    abstract public function create();
    
    /**
     * @Mark:写订单，可写本地或者外部
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/13
     */
    abstract public function send_to();
    
    /**
     * @Mark:处理回调
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/13
     */
    abstract public function callback();
}