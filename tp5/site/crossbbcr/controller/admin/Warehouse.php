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
// | 仓库接口  Version 1.0  2016/3/13
// +----------------------------------------------------------------------
namespace app\crossbbcr\controller\admin;
use app\admin\controller\Admin;

class Warehouse extends Admin
{

    /**
     * @Mark:首页
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/8/9
     */
    public function index()
    {
        $this->assign ("meta_title", lang('Warehouse'));
        return $this->fetch();
    }

    /**
     * @Mark:配置
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/8/9
     */
    public function config()
    {
        $this->assign ("meta_title", lang('Index'));
        return $this->fetch();
    }
}
