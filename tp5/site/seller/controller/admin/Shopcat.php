<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | 店铺类型  Version 1.0  2017/5/26
// +----------------------------------------------------------------------
namespace app\seller\controller\admin;

use app\admin\controller\Admin;
use app\seller\controller\Store;
use app\seller\model\Store as StoreModel;
use app\crossbbcg\service\Category as CategoryApi;
use app\crossbbcg\model\Category as CategoryModel;

class Shopcat extends Admin
{
    /**
     * @Mark: 店铺类型列表
     * @param
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/22
     * @return mixed
     */
    public function index()
    {
        $list = \app\seller\service\Shopcat::catList();
        $this->assign("meta_title", lang('Shopscat'));
        $this->assign('list', $list);
        return $this->fetch();
    }
    
    /**
     * 覆盖父类方法
     * @Mark:保存、修改店铺类型
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/22
     * @return mixed
     */
    public function savedata()
    {
        $data = $this->request->param();
        if (!isset($data['id'])) {
            $re = \app\seller\service\Shopcat::addCat($data);
        } else {
            $re = \app\seller\service\Shopcat::editCat($data);
        }
        if ($re['code']) {
            $this->success(lang('successful'), $this->jumpUrl);
        } else {
            return json($re);
        }
    }
    
    /**
     * @Mark:删除店铺分类
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/22
     * @return mixed
     */
    public function delete()
    {
        $ids = input('ids/a');
        $re = \app\seller\service\Shopcat::delCat($ids);
        if ($re === true) {
            $this->success(lang('successful'), $this->jumpUrl);
        } else {
            return $re;
        }
    }
    
    /**
     * @Mark:商户主营类目列表
     * @Author: yang <502204678@qq.com>
     * @Version 2017/10/11
     */
    public function shop_cate()
    {
        $param = $this->request->request();
        
        $where = [];
        if (isset($param['seller_id']) && $param['seller_id'] != 'all') $where['seller_id'] = $param['seller_id'];
        
        $data = StoreModel::where($where)->select();
        foreach ($data as $k=>$v) {
            $data[$k]['cat'] = [];
            if ($v['goods_cat']){
                $filter = $v['goods_cat'];
                if (isset($param['cate_status']) && $param['cate_status'] != 'all') {
                    $status = (int)$param['cate_status'];
                    $filter =  array_filter($v['goods_cat'], function ($v) use ($status) {
                        return $v == $status;
                    });
                }
                if ($filter) {
                    $where = [
                        'where'=>['id'=>['in',array_keys($filter)]]
                    ];
                    $data[$k]['cat'] = CategoryApi::getCategories($where);
                }
            }
        }
        $this->assign('list',$data);
        $store_list = StoreModel::all();
        $this->assign('store_list',$store_list);
        return $this->fetch();
    }
    
    /**
     * @Mark:经营类目审核通过
     * @Author: yang <502204678@qq.com>
     * @Version 2017/10/11
     */
    public function cate_pass()
    {
        $param = $this->request->param();
        $ids = (array)$param['ids'];
        foreach ($ids as $v) {
            $arr = explode('-',$v);
            $seller_id = $arr[0];
            $cate_id = $arr[1];
            $main_cat_id = StoreModel::where(['seller_id'=>$seller_id])->find();
            $arr = $main_cat_id['goods_cat'];
            $arr[$cate_id] = 1;
            StoreModel::update(['goods_cat'=>json_encode($arr)],['seller_id'=>$seller_id]);
        }
        $this->success(lang('success'));
    }
    
    /**
     * @Mark:驳回经营类目申请
     * @Author: yang <502204678@qq.com>
     * @Version 2017/10/11
     */
    public function cate_fail()
    {
        $param = $this->request->param();
        $ids = (array)$param['ids'];
        foreach ($ids as $v) {
            $arr = explode('-',$v);
            $seller_id = $arr[0];
            $cate_id = $arr[1];
            $main_cat_id = StoreModel::where(['seller_id'=>$seller_id])->find();
            $arr = $main_cat_id['goods_cat'];
            $arr[$cate_id] = -1;
            StoreModel::update(['goods_cat'=>json_encode($arr)],['seller_id'=>$seller_id]);
        }
        $this->success(lang('success'));
    }
    
}

