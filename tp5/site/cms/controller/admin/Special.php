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
// | 专题  Version 1.0  2016/3/13
// +----------------------------------------------------------------------
namespace app\cms\controller\admin;

use app\admin\controller\Admin;

class Special extends Admin
{
    
    /**
     * @Mark:添加文章
     * @return mixed
     * @Author: fancs
     * @Version 2017/6/7
     */
    public function add()
    {
        $pid = $this->request->has('ids') ? $this->request->param('ids') : 0;
        $catlist = \app\cms\model\Specialcat::all(function ($query) {
            $query->order('sort', 'desc');
        });
        
        $this->assign("catlist", sortdata($catlist));
        $this->assign("data", null);
        $this->assign("category_id", $pid);
        $this->assign("meta_title", lang('Addnew Special'));
        return $this->fetch('edit');
    }
    
    /**
     * @Mark:编辑文章
     * @return mixed
     * @Author: fancs
     * @Version 2017/6/7
     */
    public function edit()
    {
        $id = $this->request->has('ids') ? $this->request->param('ids') : $this->error(lang('Error_id'));
        $rs = \app\cms\model\Special::get($id);
        $catlist = \app\cms\model\Specialcat::all();
        
        $this->assign("data", $rs);
        $this->assign("pid", null);
        $this->assign("catlist", sortdata($catlist));
        $this->assign("meta_title", lang('Edit Category'));
        return $this->fetch();
    }
}