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
// | Report.php  Version 2017/3/20
// +----------------------------------------------------------------------
namespace app\finance\controller\admin;

use app\admin\controller\Admin;

class Report extends Admin
{
    /**
     * @Mark:报表分析
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/20
     */
    public function index()
    {
        $this->assign('meta_title', lang('Finreport'));
        return $this->fetch();
    }
    
    /**
     * @Mark:运维垫板
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/20
     */
    public function eoms()
    {
        $this->assign('meta_title', lang('Eomsreport'));
        return $this->fetch();
    }
    
}