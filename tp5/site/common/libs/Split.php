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
// | 拆单插件 & 接口  Version 2016/11/8
// +----------------------------------------------------------------------
namespace app\common\libs;

abstract class Split extends Baseexted
{
    /**
     * @Mark:获取商品
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/8
     */
    abstract public function getlist();
}