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
// | 分类模型  Version 1.0  2017/6/12
// +----------------------------------------------------------------------
namespace app\cms\controller\admin;

use app\admin\controller\Admin;
use app\cms\service\Itemmodel as Itemmodelapi;


class Itemmodel extends Admin
{
    /**
     * @Mark:列表
     * @return mixed
     * @Author: fancs
     * @Version 2017/6/13
     */
    public function index()
    {
        $index_map  = '';
        //查询条件
        $param      = $this->request->param();
    
        isset($param['name']) ? $index_map['name|iden'] = ['like','%'.trim($param['name']).'%'] : '';
        
        //赋值
        $lists = Itemmodelapi::getlist($this->conDb, $index_map, $this->desc);
        $this->assign('list', $lists['list']);
        $this->assign('page', $lists['page']);
        $this->assign('_total', $lists['total']);
        $this->assign('meta_title', lang('Itemmodel'));
        return $this->fetch();
    }
    
    /***
     * @Mark:添加
     * @return mixed|\think\response\Json
     * @Author: fancs
     * @Version 2017/6/15
     */
    public function add()
    {
        //获取所有的分类类型
        $attr = \app\cms\model\Itemtype::all();
        //如果是ajax请求，返回对应类型下的属性
        if($this->request->isAjax()){
            $type_id = $this->request->has('type_id') ? $this->request->param('type_id') : 0;
            $attr    = \app\cms\model\Itemattr::all(function ($query) use ($type_id){
                $query->where(['type_id'=>$type_id]);
            });
            //验证type_id是否存在
            if(empty($attr)) return json(['code'=>0,'data'=>$attr]);
            return json(['code'=>1,'data'=>$attr]);
        }
        $itemlist = \app\cms\model\Item::all(function ($query) {
            $query->order('sort', 'desc');
        });
        $this->assign('data',null);
        $this->assign('itemlist',sortdata($itemlist));
        $this->assign('pid',0);
        $this->assign('itemattr',$attr);
        $this->assign("meta_title", lang('Add Itemmodel'));
        return $this->fetch('admin/itemmodel/add');
    }
    
    /**
     * @Mark:编辑
     * @return mixed|\think\response\Json
     * @Author: fancs
     * @Version 2017/6/15
     */
    public function edit()
    {
        $id      = $this->request->has('ids') ? $this->request->param('ids') : $this->error(lang('Error_id'));
        $data = \app\cms\model\Itemmodel::get($id);
        //dump($data);die;
        //获取所有的分类类型
        $type = \app\cms\model\Itemtype::all();
        $attr = \app\cms\model\Itemattr::all();
        //如果是ajax请求，返回对应类型下的属性
        if($this->request->isAjax()){
            $type_id = $this->request->has('type_id') ? $this->request->param('type_id') : 0;
            $attr    = \app\cms\model\Itemattr::all(function ($query) use ($type_id){
                $query->where(['type_id'=>$type_id]);
            });
            //验证type_id是否存在
            if(empty($attr)) return json(['code'=>0,'data'=>$attr]);
            return json(['code'=>1,'data'=>$attr]);
        }
        $itemlist = \app\cms\model\Item::all(function ($query) {
            $query->order('sort', 'desc');
        });
        $this->assign('data',$data);
        $this->assign('ACTION_NAME','edit');
        $this->assign('itemlist',sortdata($itemlist));
        $this->assign('pid',$data['item_id']);
        $this->assign('itemtype',$type);
        $this->assign('itemattr',$attr);
        $this->assign("meta_title", lang('Edit Itemmodel'));
        return $this->fetch('admin/itemmodel/edit');
    }
}