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
// | Index  Version 1.0  2016/3/13
// +----------------------------------------------------------------------
namespace app\openapi\controller\admin;
use app\admin\controller\Admin;

class Apis extends Admin
{

    /**
     * @Mark:公有API
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/8/9
     */
    public function index()
    {
        $this->assign ("meta_title", lang('Pubapi'));
        return $this->fetch();
    }
    
    /**
     * @Mark:私有API
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/6/30
     */
    public function appapis()
    {
        $this->assign ("meta_title", lang('Priapi'));
        return $this->fetch();
    }
}