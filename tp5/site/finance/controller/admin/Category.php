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
// | Category.php  Version 2017/3/2
// +----------------------------------------------------------------------
namespace app\finance\controller\admin;

use app\admin\controller\Admin;
use app\finance\model\Category as CategoryModel;

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
        $name        = input('name');
        if($name){
            $index_where['name']  			= array('like', '%'.(string)$name.'%');
            $index_where['title'] 			= array('like', '%'.(string)$name.'%');
            $index_where['seo_title'] 		= array('like', '%'.(string)$name.'%');
            $index_where['seo_keywords'] 	= array('like', '%'.(string)$name.'%');
            $index_where['seo_description'] = array('like', '%'.(string)$name.'%');
        }
        
        $index_where["langid"]              = $this->index_where;
        
        $result = CategoryModel::all(function($query) use ($index_where){
            $query->where($index_where)->order('sort', 'ASC');
        });
        
        $this->assign("list", $name ? $result : sortdata($result));
        $this->assign('meta_title', lang('Fincat'));
        $this->assign ('_total', CategoryModel::count());
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
        $pid     = $this->request->has('ids') ? $this->request->param('ids') : 0;
        $catlist = CategoryModel::all(function($query){
            $query->order('sort', 'desc');
        });
        
        $this->assign("catlist", sortdata($catlist));
        $this->assign("data", null);
        $this->assign("pid", $pid);
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
        $rs      = CategoryModel::get($id);
        $catlist = CategoryModel::all();
        $this->assign("data", $rs);
        $this->assign("pid", null);
        $this->assign("catlist", sortdata($catlist));
        $this->assign("meta_title", lang('Edit Category'));
        return $this->fetch();
    }
}