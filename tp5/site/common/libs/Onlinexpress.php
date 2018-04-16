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
// | Hook.php  Version 2017/3/13
// +----------------------------------------------------------------------
namespace app\common\libs;

abstract class Onlinexpress extends Baseexted
{
    /**
     * @Mark:获取快递公司列表
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/19
     */
    abstract public function get_exp_list();
    
}