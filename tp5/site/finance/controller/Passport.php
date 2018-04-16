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
// | Passport.php  Version 2017/2/23
// +----------------------------------------------------------------------
namespace app\finance\controller;

use app\common\controller\Home;

class Passport extends Home
{
    
    /**
     * @Mark:登录页；
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/2/23
     */
    public function index()
    {
        $this->assign('Title', lang('Login'));
        return $this->fetch();
    }
    
    /**
     * @Mark:退出登录
     * @return bool
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/2/23
     */
    public function logout()
    {
        return true;
    }
}