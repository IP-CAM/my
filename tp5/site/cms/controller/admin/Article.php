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
// | Index  Version 1.0  2016/6/7
// +----------------------------------------------------------------------
namespace app\cms\controller\admin;

use app\admin\controller\Admin;
use app\cms\service\Article as Articleapi;

class Article extends Admin
{
    /**
     * @Mark:文章列表页
     * @return mixed
     * @Author: fancs
     * @Version 2017/6/6
     */
    public function index()
    {
        $index_map  = [];
        $param      = $this->request->param();
        $name       = isset($param['name']) ? trim($param['name']) : '';     //关键字
        $start_time = isset($param['start_time']) ? trim($param['start_time']) : ''; //开始时间
        $end_time   = isset($param['end_time']) ? trim($param['end_time']) : '';     //结束时间
        //查询条件
        $name       ? $index_map['title'] = ['like','%'. $name .'%'] : '';
        //按时间查询
        $start_time ? $index_map['create_time'] = ['>=', strtotime($start_time)] : '';
        $end_time   ? $index_map['create_time'] = ['<=', strtotime($end_time)] : '';
    
        //同时具备时
        if($start_time && $end_time)
        {
            $index_map['create_time'] = [
                ['>=', strtotime($start_time)],
                ['<=', strtotime($end_time)],
                'AND'
            ];
        }
    
        $index_map['langid'] = ['=', LANG];
        
        $lists = Articleapi::getlist($this->conDb, $index_map, $this->desc);
        $this->assign('list', $lists['list']);
        $this->assign('_total', $lists['total']);
        $this->assign('page', $lists['page']);
        $this->assign("meta_title", lang($this->conDb));
        return $this->fetch();
    }
    
    /**
     * @Mark:添加文章
     * @return mixed
     * @Author: fancs
     * @Version 2017/6/7
     */
    public function add()
    {
        $pid = $this->request->has('ids') ? $this->request->param('ids') : 0;
        $catlist = \app\cms\model\Articlecat::all(function ($query) {
            $query->order('sort', 'desc');
        });
        
        $this->assign("catlist", sortdata($catlist));
        $this->assign("data", null);
        $this->assign("category_id", $pid);
        $this->assign("ACTION_NAME", 'add');
        $this->assign("meta_title", lang('Addnew Category'));
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
        $rs = \app\cms\model\Article::get($id);
        $catlist = \app\cms\model\Articlecat::all();
        
        $this->assign("data", $rs);
        $this->assign("pid", null);
        $this->assign("category_id", $rs['category_id']);
        $this->assign("catlist", sortdata($catlist));
        $this->assign("ACTION_NAME", 'edit');
        $this->assign("meta_title", lang('Edit Category'));
        return $this->fetch();
    }
}