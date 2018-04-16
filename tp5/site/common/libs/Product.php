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
// | Product.php  Version 2016/11/9
// +----------------------------------------------------------------------
namespace app\common\libs;

abstract class Product extends Baseexted
{
    /**
     * @Mark:获取产品列表
     * @param array $where
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/9
     */
    abstract public function getlist($where = array());
    
    /**
     * @Mark:获取单个商品
     * @param $sku
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/9
     */
    abstract public function getone($sku);
}