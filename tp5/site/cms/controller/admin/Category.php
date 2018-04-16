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
namespace app\cms\controller\admin;

use app\admin\controller\Admin;
use app\cms\service\Category as CategoryApi;

class Category extends Admin
{
    
    /**
     * @Mark:分类首页
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/6
     */
    public function index(){
        $index_where = [];
        $param       = $this->request->param();
        
        if(isset($param['name']))
        {
            $index_where['name|title|seo_title|seo_keywords|seo_description'] =  ['like','%'.trim($param['name']).'%'];
        }
    
        $lists = CategoryApi::getlist($this->conDb, $index_where, $this->desc);
    
        $this->assign('list', $lists['list']);
        $this->assign('_total', $lists['total']);
        $this->assign('page', $lists['page']);
        $this->assign('meta_title', lang('Category'));
        return $this->fetch();
    }
    
    /**
     * @Mark:添加分类
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/6
     */
    public function add()
    {
        $inputs  = $this->request->param();
        $lists = CategoryApi::getlist($this->conDb, [], $this->desc);
        $this->assign("catlist", $lists['list']);
        $this->assign("data", null);
        $this->assign("pid", isset($inputs['ids']) ? $inputs['ids'] : 0);
        $this->assign("meta_title", lang('Addnew Category'));
        return $this->fetch('edit');
    }
    
    /**
     * @Mark:编辑分类
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/6
     */
    public function edit()
    {
        $id      = $this->request->has('ids') ? $this->request->param('ids') : $this->error(lang('Error_id'));
        $map['where'] = 'id = '. $id;
        $rs      = CategoryApi::getOne($map);
        $catlist = CategoryApi::getlist($this->conDb, [], $this->desc);
        $this->assign("data", $rs['data']);
        $this->assign("pid", null);
        $this->assign("catlist", $catlist['list']);
        $this->assign("meta_title", lang('Edit Category'));
        return $this->fetch();
    }
}