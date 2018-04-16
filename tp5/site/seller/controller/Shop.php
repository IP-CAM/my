<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Shop.php  Version 店铺 2017/6/8
// +----------------------------------------------------------------------
namespace app\seller\controller;

use app\seller\model\Store as SellerModel;
use app\seller\service\Seller;
use app\seller\service\Offshop;
use app\seller\model\Offshop as OffshopModel;
use app\seller\service\Feedback;
use app\crossbbcg\service\Goods as GoodsApi;
use think\Request;
use app\seller\model\Slideshow as SlideshowModel;
use think\Session;
use app\crossbbcg\service\Category as CategoryApi;

class Shop extends Common
{
    public function _initialize()
    {
        parent::_initialize();
        $option = \app\seller\service\Shopcat::catList(['status' => 1]);
        $this->assign('option', $option);
        
        // 国家
        $arr_country = GoodsApi::getCountries();
        $this->assign('arr_country', $arr_country);
    }
    
    /**
     * @Mark:店铺设置
     * @Author: yang <502204678@qq.com>
     * @Version 2017/9/19
     */
    public function index()
    {
        if ($this->request->isAjax()) {
            $param = $this->request->param();
            SlideshowModel::update($param);
            return true;
        }
        //轮播图
        $list = SlideshowModel::where(['seller_id' => SellerId])->select();
        $this->assign('list', $list);
        //店铺信息
        $info = SellerModel::where(['seller_id' => SellerId])->find();
        $this->assign('info', $info);
        $this->assign('meta_title',lang('StoreSetting'));
        return $this->fetch();
    }
    
    /**
     * @Mark:店铺信息
     * @Author: yang <502204678@qq.com>
     * @Version 2017/9/20
     */
    public function infomation()
    {
        $info = SellerModel::where(['seller_id' => SellerId])->find();
        $this->assign('data',$info);
        $this->assign('meta_title',lang('StoreInfo'));
        return $this->fetch();
    }
    
    /**
     * @Mark:经营类目
     * @Author: yang <502204678@qq.com>
     * @Version 2017/9/20
     */
    public function cate()
    {
        //获取当前商户经营类目
        $main_cat_id = SellerModel::where(['seller_id'=>SellerId])->find();
        $where = [
            'where'=>['id'=>['in',array_keys($main_cat_id['goods_cat'])]]
        ];
        $data = CategoryApi::getCategories($where);
        
        $this->assign('list',$data);
        $this->assign('cate_status',$main_cat_id['goods_cat']);
        $this->assign('meta_title',lang('BusinessCate'));
        return $this->fetch();
        
    }
    
    /**
     * @Mark:删除主营类目
     * @Author: yang <502204678@qq.com>
     * @Version 2017/9/20
     */
    public function del_cat()
    {
        $param = $this->request->param();
        $ids = (array)$param['ids'];
        //TODO 判断是否有商品绑定将要删除的分类
        
        $main_cat_id = SellerModel::where(['seller_id'=>SellerId])->find();
        $arr = $main_cat_id['goods_cat'];
        foreach ($ids as $v) {
            unset($arr[$v]);
        }
        SellerModel::update(['goods_cat'=>json_encode($arr)],['seller_id'=>SellerId]);
        $log_info = '删除店铺经营类目。类目id：'.implode(',',$ids).';操作人:' . Session::get('sellername');
        seller_log(Session::get('sellerId'), Session::get('userid'), $log_info);
        $this->success(lang('success'), 'seller/shop/cate');
    }
    
    /**
     * @Mark:添加经营类目
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/9/20
     */
    public function cat_add()
    {
        $param = $this->request->param();
        if ($this->request->isAjax()) {
            $main_cat_id = SellerModel::where(['seller_id'=>SellerId])->find();
            $arr = $main_cat_id['goods_cat'];
            $arr[$param['goods_cat_id']] = 0;
            SellerModel::update(['goods_cat'=>json_encode($arr)],['seller_id'=>SellerId]);
            $log_info = '新增店铺经营类目。类目id：'.$param['goods_cat_id'].';操作人:' . Session::get('sellername');
            seller_log(Session::get('sellerId'), Session::get('userid'), $log_info);
            $this->success(lang('success'),'seller/shop/cate');
        }
        $category = GoodsApi::getCategories(0);
        $this->assign('arr_category', $category);
        $this->assign('data',null);
        $this->assign('action_name','add');
        $this->assign('meta_title',lang('add_main_cate'));
        return $this->fetch('edit_cat');
    }
    
    /**
     * @Mark:修改经营类目
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/9/20
     */
    public function edit_cat()
    {
        $param = $this->request->param();
        if ($this->request->isAjax()) {
            //判断被修改的商品分类是否绑定商品
            $goods_ids = \app\crossbbcg\model\Goods::where(['cat_id'=>$param['goods_cat_id'],'seller_id'=>SellerId])->column('id');
            if ($goods_ids) $this->error(lang('Edit_Business_Cate_fail').implode(',',$goods_ids));
            
            $main_cat_id = SellerModel::where(['seller_id'=>SellerId])->find();
            $arr = $main_cat_id['goods_cat'];
            unset($arr[$param['id']]);
            $arr[$param['goods_cat_id']] = 0;
            SellerModel::update(['goods_cat'=>json_encode($arr)],['seller_id'=>SellerId]);
            $log_info = '修改店铺经营类目。类目id：'.$param['goods_cat_id'].';操作人:' . Session::get('sellername');
            seller_log(SellerId, Session::get('userid'), $log_info);
            $this->success(lang('success'),'seller/shop/cate');
        }
        $father_id = \app\crossbbcg\model\Category::where(['id'=>$param['id']])->value('pid');
        $grandfather_id = \app\crossbbcg\model\Category::where(['id'=>$father_id])->value('pid');
        $category = GoodsApi::getCategories(0);
        $this->assign('arr_category', $category);
        $this->assign('data',['cat_id'=>$grandfather_id,'id'=>$param['id']]);
        $this->assign('action_name','edit');
        return $this->fetch();
    }
    
    
    /**
     * @Mark:修改线上店铺
     * @param Request $request
     * @return string
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/15
     */
    public function savedata(Request $request)
    {
        $data = $request->param();
        $re   = Seller::aditSeller($data);
        if ($re['code'] == 1) {
            $log_info = '修改店铺。操作人:' . Session::get('sellername');
            seller_log(Session::get('sellerId'), Session::get('userid'), $log_info);
            $this->success(lang('success'), 'seller/shop/index');
        } else {
            return json($re);
        }
    }
    
    
    /**
     * @Mark:线下店铺
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/8
     */
    public function offshop()
    {
        $list      = OffshopModel::get(['seller_id' => SellerId, 'status' => 1]);
        $province  = \app\cms\model\Area::get(['code' => $list['province']]);
        $city      = \app\cms\model\Area::get(['code' => $list['city']]);
        $area      = \app\cms\model\Area::get(['code' => $list['area']]);
        $this->assign('province', $province ? $province : '');
        $this->assign('city', $city ? $city : '');
        $this->assign('area', $area ? $area : '');
        $this->assign('list', $list);
        return $this->fetch();
    }
    
    /**
     * @Mark:修改线下店铺1
     * @param Request $request
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/15
     * @return json
     */
    public function edit_shop_off(Request $request)
    {
        $data = $request->param();
        $re   = Offshop::editShop($data);
        if ($re['code'] == 1) {
            $this->success(lang('success'), 'seller/shop/offshop');
        } else {
            return json($re);
        }
    }
    
    /**
     * @Mark:申请线下店铺
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/9
     */
    public function applyoff(Request $request)
    {
        if ($request->isAjax()) {
            $data              = $request->param();
            $data['seller_id'] = SellerId;
            $data['country']   = 1;
            $re                = Offshop::addShop($data);
            if ($re['code'] == 1) {
                $this->success(lang('successful'), 'offshop');
            } else {
                return json($re);
            }
        } else {
            return $this->fetch();
        }
    }
    
    
    /**
     * @Mark:意见反馈
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/8
     */
    public function feedback(Request $request)
    {
        if ($request->isAjax()) {
            $data              = $request->param();
            $data['seller_id'] = SellerId;
            $re                = Feedback::addFeedback($data);
            if ($re['code'] == 1) {
                $log_info = '提交反馈。操作人:' . Session::get('sellername');
                seller_log(SellerId, Session::get('userid'), $log_info);
                $this->success(lang('success'), 'feedback');
            } else {
                return json($re);
            }
        } else {
            return $this->fetch();
        }
    }
    
    /**
     * @Mark:安全中心
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/8
     */
    public function safe()
    {
        return $this->fetch();
    }
    
    /**
     * @Mark:开发者中心
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/8
     */
    public function developer()
    {
        return $this->fetch();
    }
    
    /**
     * @Mark:验证密码
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/9
     */
    public function checkpwd()
    {
        return $this->fetch();
    }
    
    /**
     * @Mark:手机验证
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/9
     */
    public function checkphone()
    {
        return $this->fetch();
    }
    
    /**
     * @Mark:语言设置
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/15
     */
    public function lang()
    {
        $data = \app\seller\model\Account::get(SellerId);
        $this->assign('lang', $data['langid']);
        return $this->fetch();
    }
    
    /**
     * @Mark:设置语言
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/19
     */
    public function langset()
    {
        $langid = $this->request->param('langid');
        \app\seller\model\Account::where(['id' => SellerId])->update(['langid' => $langid]);
        $this->redirect('lang');
    }
    
    
}
