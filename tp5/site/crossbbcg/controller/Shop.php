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
// | Article.php  Version 2017/2/16 文章类控制器
// +----------------------------------------------------------------------
namespace app\crossbbcg\controller;

use app\seller\model\Store as StoreModel;
use app\crossbbcg\service\Goods as GoodsApi;
use app\seller\service\Category as GoodsCategoryApi;
use app\seller\model\GoodsCategory as GoodsCategoryModel;
use think\Cache;

class Shop extends Shopbase
{
    public $seller_id = 0;
    
    public function _initialize()
    {
        parent::_initialize();
        if (input('?get.seller_id')) {
            $this->seller_id = input('get.seller_id');
        } else {
            return $this->redirect('error/not_found_store');
        }
        //获取店铺信息
        if (!Cache::get('store_info_' . $this->seller_id)) {
            $store = StoreModel::get(['seller_id' => $this->seller_id]);
            if (!$store) return $this->redirect('error/not_found_store');
            Cache::set('store_info_' . $this->seller_id, $store);
        }
        $this->assign('store_info', Cache::get('store_info_' . $this->seller_id));
    }
    
    /**
     * @Mark:店铺首页
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/18
     */
    public function index()
    {
        //其他信息
        $other = [
            'now_langid' => LANG,
            'url' => $this->jumpUrl,
            'platform' => PLATFORM
        ];
        $this->assign('other', $other);
        
        //店铺商品列表
        $where = [
            'where' => ['seller_id' => $this->seller_id],
            'lang' => LANG,
            'order' => ['sort desc'],
            'paginate' => 15,
            'field' => ['*']
        ];
        if (!Cache::get('store_goods_list_' . $this->seller_id)) {
            $store_goods_list = GoodsApi::getGoods($where);
            Cache::set('store_goods_list_' . $this->seller_id, $store_goods_list);
        }
        $this->assign('store_goods_list', Cache::get('store_goods_list_' . $this->seller_id));
        
        //获取店铺商品分类
        if (!Cache::get('store_category_' . $this->seller_id)) {
            $conditon = [
                'where' => [
                    'seller_id' => $this->seller_id,
                    'langid' => LANG
                ],
                'order' => ['sort desc'],
            ];
            $category = GoodsCategoryApi::categoryList($conditon);
            Cache::set('store_category_' . $this->seller_id, $category);
        }
        $this->assign('category', Cache::get('store_category_' . $this->seller_id));
        
        return $this->fetch();
    }
    
    /**
     * @Mark:店铺分类页
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/18
     */
    public function items()
    {
        if (input('?get.cate_id')) {
            $category_id = input('get.cate_id');
        } else {
            return $this->redirect(url('index') . '?seller_id=' . $this->seller_id);
        }
        //获取店铺商品分类
        if (!Cache::get('store_category_' . $this->seller_id)) {
            $conditon = [
                'where' => [
                    'seller_id' => $this->seller_id,
                    'langid' => LANG,
                ],
                'order' => ['sort desc'],
            ];
            $category = GoodsCategoryApi::categoryList($conditon);
            Cache::set('store_category_' . $this->seller_id, $category);
        }
        $this->assign('category', Cache::get('store_category_' . $this->seller_id));
        
        //查询该分类下所有商品
        $goods_ids = GoodsCategoryModel::get($category_id);
        $where = [
            'where' => ['seller_id' => $this->seller_id, 'id' => ['in', $goods_ids['goods_ids']]],
            'lang' => LANG,
            'order' => ['sort desc'],
            'paginate' => 8,
            'field' => ['*']
        ];
        //筛选条件
        if (input('_field')) $where['order'] = [input('_field').' '.input('_order')];
        ///dump($where);exit();
        $store_goods_list = GoodsApi::getGoods($where);
        $this->assign('store_category_goods_list', $store_goods_list);
        return $this->fetch();
    }
    
    
}