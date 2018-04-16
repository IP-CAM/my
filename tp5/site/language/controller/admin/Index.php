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
namespace app\language\controller\admin;

use app\admin\controller\Admin;

class Index extends Admin
{
    /**
     * @Mark:类目管理
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/31
     */
    public function index()
    {
        $input  = $this->request->param();
        $item   = isset($input['item']) ? trim($input['item']) : '';
        $prom   = isset($input['prom']) ? trim($input['prom']) : '';
        $source = isset($input['source']) ? trim($input['source']) : '';
        
        $option = null;
        $this->assign('meta_title', lang('Langclass'));
        $this->assign('option', $option);
        $this->assign('item', $item);
        $this->assign('prom', $prom);
        $this->assign('source', $source);
        $this->assign('_total', 0);
        return $this->fetch();
    }
}