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
// | InitUser.php  Version 1.0  2016/3/14
// +----------------------------------------------------------------------
namespace app\member\behavior;

class AfterReg
{
    /**
     * @Mark:注册成功后执行
     * @param $content
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/13
     */
    public function run(&$content)
    {
        print_r('AfterReg');
    }
}