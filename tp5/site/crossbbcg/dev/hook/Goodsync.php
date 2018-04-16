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
// | Goodsync.php  Version 2017/3/16
// +----------------------------------------------------------------------
namespace app\crossbbcg\dev\hook;

//use think\Cache;
//use think\Config;

class Goodsync
{
    /**
     * @Mark:发送商品数据给同步接口，如：OMS
     * @return bool
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/16
     */
    public function sendgoods()
    {
        return true;
    }
}