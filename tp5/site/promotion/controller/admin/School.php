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
// | School.php  Version 2017/3/21  运营课堂
// +----------------------------------------------------------------------
namespace app\promotion\controller\admin;

use app\admin\controller\Admin;

class School extends Admin
{
    /**
     * @Mark:营销 & 运营大课堂
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/21
     */
    public function index()
    {
        $this->assign('meta_title', lang('Schoollist'));
        return $this->fetch();
    }
}