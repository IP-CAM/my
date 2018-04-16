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
// | Index  Version 1.0  2016/6/15
// +----------------------------------------------------------------------
namespace app\cms\controller\admin;

use app\admin\controller\Admin;
use app\cms\service\Item as Itemapi;

class Item extends Admin
{
    /**
     * @Mark:列表
     * @return mixed
     * @Author: fancs
     * @Version 2017/6/12
     */
    public function index()
    {
        $index_map = [];
        $param     = $this->request->param();
        isset($param['name']) ? $index_map['name|title|seo_title|seo_keywords|seo_description'] = ['like','%'.trim($param['name']).'%'] : '';
        
        //赋值
        $lists = Itemapi::getlist($this->conDb, $index_map, 'sort ASC');
        $this->assign('list', $lists['list']);
        $this->assign('page', $lists['page']);
        $this->assign('_total', $lists['total']);
        $this->assign('meta_title', lang('Item'));
        return $this->fetch();
    }
    
    /**
     * @Mark:添加
     * @return mixed
     * @Author: fancs
     * @Version 2017/6/12
     */
    public function add()
    {
        $param    = $this->request->param();
        $pid      = isset($param['ids'])? (int)$param['ids'] : 0;
        $itemlist = Itemapi::getlist($this->conDb, [], 'sort ASC');
        $this->assign("itemlist", $itemlist['list']);
        $this->assign("data", null);
        $this->assign("pid", $pid);
        $this->assign("meta_title", lang('Addnew') . lang('Item'));
        return $this->fetch('edit');
    }
    
    /**
     * @Mark:修改
     * @return mixed
     * @Author: fancs
     * @Version 2017/6/12
     */
    public function edit()
    {
        $param    = $this->request->param();
        $id       = isset($param['ids'])? (int)$param['ids'] : $this->error(lang('Error_id'));
        $data     = [
            'model'  => $this->conDb,
            'where'  => 'id = '. $id
        ];
        $rs       = Itemapi::getOne($data);
        $itemlist = Itemapi::getlist($this->conDb, [], 'sort ASC');
        
        $this->assign("data", $rs['data']);
        $this->assign("pid", null);
        $this->assign("itemlist", $itemlist['list']);
        $this->assign("meta_title", lang('Edit') . lang('Item'));
        return $this->fetch();
    }
}