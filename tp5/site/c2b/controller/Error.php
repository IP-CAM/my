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
// | 处理空控制器  Version 2016/12/25
// +----------------------------------------------------------------------
namespace app\b2c\controller;

use think\Request;
use think\View;

class Error {

    /**
     * @Mark:处理空控制器的任意方法
     * @param $name
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/12/25
     */
    public function _empty(Request $request)
    {
        $action = $request->controller();
        $view = new View();
        return $view->fetch($action);
    }
}