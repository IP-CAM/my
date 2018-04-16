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
// | 工单系统  Version 1.0  2016/3/13
// +----------------------------------------------------------------------
namespace app\im\controller\admin;
use app\admin\controller\Admin;

class Index extends Admin
{
    /**
     * @Mark:继承
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/7
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->conDb = 'worksheet';
    }
    
    /**
     * @Mark:问题列表
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/25
     */
    public function index()
    {
        $this->assign ("meta_title", lang('Questions'));
        return $this->fetch();
    }

    /**
     * @Mark:售后
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/7
     */
    public function aftersale()
    {
        $this->assign ("meta_title", lang('Worksheet'));
        return $this->fetch();
    }
}