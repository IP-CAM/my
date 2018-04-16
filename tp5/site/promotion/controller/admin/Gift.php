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
// | gift.php  Version 2017/3/15  赠品管理系统
// +----------------------------------------------------------------------
namespace app\promotion\controller\admin;

use app\admin\controller\Admin;

class Gift extends Admin
{
    /**
     * @Mark:商品管理首页
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/15
     */
    public function index()
    {
        $this->assign('meta_title', lang('Giftlist'));
		$this->assign('_total', 0);
        return $this->fetch();
    }
}