<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: fancs
// +----------------------------------------------------------------------
// | Index  Version 1.0  2016/6/6
// +----------------------------------------------------------------------
namespace app\cms\controller\admin;

use app\admin\controller\Admin;
use app\cms\service\Specialcat as SpecialcatApi;

class Specialcat extends Admin
{
    /**
     * @Mark:分类首页
     * @return mixed
     * @Author: fancs
     * @Version 2017/6/8
     */
    public function index(){
        $param          = $this->request->param();
        $name           = isset($param['name']) ? trim($param['name']) : '';
        $index_map      = [];
        $name ? $index_map['name|title|seo_title|seo_keywords|seo_description'] = ['like','%'. $name .'%'] : '';
    
        $lists = SpecialcatApi::getlist($this->conDb, $index_map, 'sort ASC');
        
        $this->assign("list", $lists['list']);
        $this->assign ('list', $lists['list']);
        $this->assign ('_total', $lists['total']);
        $this->assign ('page', $lists['page']);
        $this->assign('meta_title', lang('Category'));
        return $this->fetch();
    }
    
    /**
     * @Mark:添加分类
     * @return mixed
     * @Author: fancs
     * @Version 2017/6/8
     */
    public function add()
    {
        $pid     = $this->request->has('ids') ? $this->request->param('ids') : 0;
        $catlist = \app\cms\model\Specialcat::all(function($query){
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
     * @Author: fancs
     * @Version 2017/6/8
     */
    public function edit()
    {
        $id      = $this->request->has('ids') ? $this->request->param('ids') : $this->error(lang('Error_id'));
        $rs      = \app\cms\model\Specialcat::get($id);
        $catlist = \app\cms\model\Specialcat::all();
        $this->assign("data", $rs);
        $this->assign("pid", null);
        $this->assign("catlist", sortdata($catlist));
        $this->assign("meta_title", lang('Edit Category'));
        return $this->fetch();
    }
}