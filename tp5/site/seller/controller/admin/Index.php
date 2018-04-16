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
namespace app\seller\controller\admin;

use app\admin\controller\Admin;
use app\seller\service\Seller;
use app\seller\model\Account as AccountModel;
use app\seller\model\Store as StoreModel;
use app\crossbbcg\model\Category as CategoryModel;
use app\crossbbcg\service\Goods as GoodsApi;

class Index extends Admin
{
    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
        $this->conDb = 'Store';
        $option      = \app\seller\service\Shopcat::catList(['status' => 1]);
        $this->assign('option', $option);
        //纳税类型税码
        $tax_type_tax_code = [0, 3, 6, 11, 13, 17];
        $this->assign('tax_type_tax_code', $tax_type_tax_code);
        //纳税人类型
        $taxpayer_type = [
            '1' => lang('general_taxpayer'),
            '2' => lang('small-scale_taxpayer'),
            '3' => lang('Non-vat taxpayer')
        ];
        $this->assign('taxpayer_type', $taxpayer_type);
        //营业执照类型
        $business_license_type = [
            '1' => lang('license_type_one'),
            '2' => lang('license_type_two'),
            '3' => lang('license_type_three'),
        ];
        $this->assign('business_license_type', $business_license_type);
        //可售商品数量
        $goods_num = [
            '0~100', '100~200', '200~500', '500+'
        ];
        $this->assign('goods_num', $goods_num);
        //预计平均客单价
        $predict_avg_price = [
            '0~100', '100~200', '200~500', '500+'
        ];
        $this->assign('predict_avg_price', $predict_avg_price);
    }
    
    /**
     * @Mark:店铺管理
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/5/27
     */
    public function index()
    {
        $param             = $this->request->param();
        $this->index_where = ['status' => ['<', 2]];
        
        $name       = isset($param['name']) ? $param['name'] : '';
        $start_time = isset($param['start_time']) ? $param['start_time'] : '';
        $end_time   = isset($param['end_time']) ? $param['end_time'] : '';
        
        $name ? $this->index_where['seller_name|corporate|bank_name|mobile'] = ['like', '%' . trim($param['name']) . '%'] : '';
        
        $start_time ? $this->index_where['create_time'] = ['>=', strtotime($start_time)] : '';
        $end_time ? $this->index_where['create_time'] = ['<=', strtotime($end_time)] : '';
        //同时具备时
        if ($start_time && $end_time) {
            $this->index_where['create_time'] = ['between' => [$start_time, $end_time]];
        }
        
        $list = Seller::sellerList($this->index_where);
        $this->assign('list', $list);
        $this->assign("meta_title", lang('Shops'));
        return $this->fetch();
    }
    
    /**
     * @Mark:新增店铺
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/19
     */
    public function savedata()
    {
        $data = $this->request->param();
        if (!isset($data['id'])) {
            //账号验证-->获取商户账号id
            $shop_account = $data['shop_account'];
            $re           = \app\seller\model\Account::get(['nickname' => $shop_account]);
            if (!$re) $this->error(lang('shop_account_not_exist'));
            $data['seller_id'] = $re['id'];
            $res               = Seller::addSeller($data);
        } else {
            $res = Seller::aditSeller($data);
        }
        if ($res['code']) {
            $this->success(lang('success'), 'index');
        } else {
            return json($res);
        }
    }
    
    /**
     * @Mark:添加店铺
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/9/14
     */
    public function add()
    {
        if ($this->request->isAjax()) {
            $param = $this->request->post();
            //获取商户id
            $account = AccountModel::where(['nickname' => $param['shop_account']])->find();
            if (!count($account)) $this->error(lang('shop_account_not_exist'));
            
            //判断店铺名是否唯一
            $store = StoreModel::where(['seller_name' => $param['seller_name']])->select();
            if (count($store)) $this->error(lang('sellerName_unique'));
            $count = StoreModel::where(['seller_id' => $account['id']])->count();
            if ($count) $this->error(lang('Store_had_exist'));
            
            //注册
            StoreModel::create(['seller_name' => $param['seller_name'], 'seller_id' => $account['id']]);
            $this->success(lang('Reg_ok'), 'index');
        }
        $this->assign('data', null);
        $this->assign('title', lang('Add_Store'));
        return $this->fetch();
    }
    
    public function edit()
    {
        $id   = $this->request->param('ids');
        $info = StoreModel::get($id)->toArray();
        if ($info['goods_cat']) {
            $info['goods_cat'] = $this->get_business_cate($info['goods_cat']);
        } else {
            $info['goods_cat'] = [];
        }
        
        $this->assign('data', $info);
        return $this->fetch();
    }
    
    /**
     * @Mark:店铺设置
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/9/14
     */
    public function set_store()
    {
        $id   = $this->request->param('ids');
        $info = StoreModel::get($id)->toArray();
        $this->assign('data', $info);
        return $this->fetch();
    }
    
    /**
     * @Mark:保存店铺信息
     * @Author: yang <502204678@qq.com>
     * @Version 2017/9/14
     */
    public function save()
    {
        $param = $this->request->param();
        if (isset($param['goods_cat'])) {
            $arr = [];
            foreach ($param['goods_cat'] as $v) {
                $arr[$v]=1;
            }
            $param['goods_cat'] = json_encode($arr);
        }
        $res   = StoreModel::update($param);
        
        if ($res) {
            $this->success(lang('edit_ok'), 'index');
        } else {
            $this->error(lang('edit_fail'));
        }
    }
    
    /**
     * @Mark:获取经营类目
     * @param $cate_ids string 经营类目id
     * @Author: yang <502204678@qq.com>
     * @Version 2017/9/14
     * @return array
     */
    public function get_business_cate($cate_ids)
    {
        if (!$cate_ids) return null;
        $arr      = [];
        foreach ($cate_ids as $k => $v) {
            if ($v == 1) {
                //第三级分类信息
                $third = CategoryModel::get($k);
                //第二级分类信息
                $second = CategoryModel::get($third['pid']);
                //第一级分类信息
                $first                   = CategoryModel::get($second['pid']);
                $arr[$k]['first_title']  = $first['title'];
                $arr[$k]['second_title'] = $second['title'];
                $arr[$k]['third_title']  = $third['title'];
                $arr[$k]['commission']   = $third['kickback'];
            }
            
        }
        return $arr;
    }
    
    /**
     * @Mark:编辑主营类目
     * @Author: yang <502204678@qq.com>
     * @Version 2017/9/14
     */
    public function edit_business_category()
    {
        $id   = $this->request->param('ids');
        $info = StoreModel::get($id)->toArray();
        if ($info['goods_cat']) {
            $info['goods_cat'] = $this->get_business_cate($info['goods_cat']);
        } else {
            $info['goods_cat'] = [];
        }
        $this->assign('data', $info);
        //经营类目
        $category = GoodsApi::getCategories(0);
        $this->assign('category', $category);
        return $this->fetch();
    }
}