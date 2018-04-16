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
// | Pact.php  Version 2017/3/3 租赁合同管理
// +----------------------------------------------------------------------
namespace app\finance\controller\admin;

use app\admin\controller\Admin;

class Pact extends Admin
{
    
    /**
     * @Mark:首页
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/3
     */
    public function index()
    {
        $this->assign ("meta_title", lang('Pactlist'));
        return $this->fetch();
    }
}