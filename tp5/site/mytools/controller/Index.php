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
// | 站长工具  Version 1.0  2016/3/14
// +----------------------------------------------------------------------
namespace app\mytools\controller;
use app\common\controller\Home;
class Index extends Home
{

     /**
     * @Mark:测试
     * @Author: 支付测试 <theseaer@qq.com>
     * @Version 2017/06/27
     */
    public function test()
    {
        return $this->fetch();
    }
}
