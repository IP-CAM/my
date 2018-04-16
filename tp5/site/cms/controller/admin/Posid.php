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
// | 推荐位  Version 1.0 2017/6/15
// +----------------------------------------------------------------------
namespace app\cms\controller\admin;

use app\admin\controller\Admin;
use app\cms\service\Posid as Posidapi;

class Posid extends Admin
{
    
    /**
     * @Mark:首页
     * @Author: fancs
     * @Version 2017/6/12
     */
    public function index()
    {
        $this->conDb = 'Posid';
        $index_where = [];
        $name = input('name');
        if ($name) {
            $index_where['name|title'] = array('like', '%' . (string)$name . '%');
        }
        
        //赋值
        $lists = Posidapi::getlist($this->conDb, $index_where, $this->desc);
        $this->assign('list', $lists['list']);
        $this->assign('page', $lists['page']);
        $this->assign('_total', $lists['total']);
        $this->assign('meta_title', lang('Posidlist'));
        return $this->fetch();
    }
    
    /**
     * @Mark:添加
     * @return mixed
     * @Author: fancs
     * @Version 2017/6/13
     */
    public function add()
    {
        $item = \app\cms\model\Item::all(function ($query) {
            $query->order('sort', 'desc');
        });
        $model = \app\cms\model\Itemmodel::all(function ($query) {
            $query->order('sort', 'desc');
        });
        $this->assign("item", sortdata($item));
        $this->assign("model", $model);
        $this->assign("data", null);
        $this->assign("pid", null);
        $this->assign("ACTION_NAME", 'add');
        $this->assign("meta_title", lang('Addnew posid'));
        return $this->fetch('edit');
    }
    /**
     * @Mark:编辑
     * @return mixed
     * @Author: fancs
     * @Version 2017/6/13
     */
    public function edit()
    {
        $id = $this->request->has('ids') ? $this->request->param('ids') : $this->error(lang('Error_id'));
        $rs = \app\cms\model\Posid::get($id);
        
        $list = \app\cms\model\Item::all(function ($query) {
            $query->order('sort', 'desc');
        });
        $model = \app\cms\model\Itemmodel::all(function ($query) {
            $query->order('sort', 'desc');
        });
        
        $this->assign("data", $rs);
        $this->assign("pid", $rs['item_id']);
        $this->assign("item", sortdata($list));
        $this->assign("model", $model);
        $this->assign("meta_title", lang('Edit posid'));
        return $this->fetch('edit');
    }
}