<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Store.php  Version 2017/7/6
// +----------------------------------------------------------------------

namespace app\seller\controller;

use app\seller\model\Store as StoreModel;
use app\crossbbcg\service\Goods as GoodsApi;
use app\seller\service\Category as GoodsCategoryApi;
use app\seller\model\GoodsCategory as GoodsCategoryModel;
use think\Cache;
use app\crossbbcg\controller\Shopbase;
use app\seller\model\Slideshow as SlideshowModel;

class Store extends Shopbase
{
    public $seller_id;
    public $param = [];
    
    public function _initialize()
    {
        parent::_initialize();
        $param = $this->request->param();
        $this->param = $param;
        if (isset($param['seller_id'])) {
            $this->seller_id = $param['seller_id'];
        } else {
            $this->redirect('error/not_found_store');
        }
        //获取店铺信息
        if (!Cache::get('store_info_' . $this->seller_id)) {
            $store = StoreModel::get(['seller_id' => $this->seller_id]);
            if (!$store) $this->redirect('error/not_found_store');
            Cache::set('store_info_' . $this->seller_id, $store);
        }
        $this->assign('store_info', Cache::get('store_info_' . $this->seller_id));
        //获取轮播图信息
        $shideshow = SlideshowModel::where(['seller_id'=>$this->seller_id,'status'=>1,'type'=>'PC'])->order('sort desc')->select();
        $this->assign('shideshow',$shideshow);
        //推荐商品
        $recommend_goods = GoodsApi::getGoods([
            'where' => ['seller_id' => $this->seller_id],
            'lang' => LANG,
            'order' => ['sort desc'],
            'limit' => 4,
            'field' => ['*']
        ]);
        $this->assign('recommend_goods',$recommend_goods);
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
        
        //TODO 店内搜索
        //if (input('keywords')) ;
        
        
        //掌柜推荐商品
        $where = [
            'where' => ['seller_id' => $this->seller_id],
            'lang' => LANG,
            'order' => ['sort desc'],
            'limit' => 10,
            'field' => ['*']
        ];
       
        $store_goods_list = GoodsApi::getGoods($where);
        $this->assign('store_recommend_goods_list', $store_goods_list);
        
        //新品上市商品
        $where['order'] = ['create_time desc'];
        
        $store_goods_list = GoodsApi::getGoods($where);
        $this->assign('store_new_goods_list', $store_goods_list);
        
        //获取店铺商品分类
        $conditon = [
            'where' => [
                'seller_id' => $this->seller_id,
                'langid' => LANG,
            ],
            'order' => ['sort asc'],
        ];
        $category = GoodsCategoryApi::categoryList($conditon);
        $this->assign('category', $category);
        
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
        if (isset($this->param['cate_id'])) {
            $category_id = $this->param['cate_id'];
        } else {
            return $this->redirect(url('index') . '?seller_id=' . $this->seller_id);
        }
        //获取店铺商品分类
        
        $conditon = [
            'where' => [
                'seller_id' => $this->seller_id,
                'langid' => LANG,
            ],
            'order' => ['sort desc'],
        ];
        $category = GoodsCategoryApi::categoryList($conditon);
        $this->assign('category',$category);
        
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
        if (isset($this->param['_field']) && $this->param['_order']) $where['order'] = [$this->param['_field'].' '.$this->param['_order']];
        
        $store_goods_list = GoodsApi::getGoods($where);
        $goods_list_arr = [];
        foreach ($store_goods_list as $k=>$arr) {
            if ($arr['minimum'] <= 0) {
                $minimum = 1;
            } else {
                $minimum = $arr['minimum'];
            }
            if ($arr['maximum'] <= 0) {
                $maximum = $arr['quantity'];
            } else {
                if ($arr['maximum'] > $arr['quantity']) {
                    $maximum = $arr['quantity'];
                }else{
                    $maximum = $arr['maximum'];
                }
            }
            $sale_price = GoodsApi::currencyFormat($arr['sale_price'], config('catalog_currency_code'));
            $market_price = GoodsApi::currencyFormat($arr['market_price'], config('catalog_currency_code'));
            if($arr['country_code']){
                $country_code = strtolower($arr['country_code']);
            }else{
                $country_code = 'cn';
            }
            $national_flag = __ROOT__ . '/' . APP_NAME . '/' . 'crossbbcg' . '/'.MOBTPL.'image/flags/'.$country_code.'.png';
            
            if ($arr['country_id']) {
                $country_name = $arr['country_name'];
            } else {
                $country_name = config('catalog_country_name');
            }
            if(substr($arr['thumb'],0,4)!='http'){
                $goods_list_arr[$k]['thumb'] = resizeImage($arr['thumb'],'thumb');
            }else{
                $goods_list_arr[$k]['thumb'] = $arr['thumb'];
            }
            $goods_list_arr[$k]['country_code']=$country_code;
            $goods_list_arr[$k]['sale_price']=$sale_price;
            $goods_list_arr[$k]['market_price']=$market_price;
            $goods_list_arr[$k]['country_name']=$country_name;
            $goods_list_arr[$k]['national_flag']=$national_flag;
            $goods_list_arr[$k]['name']=$arr['name'];
            $goods_list_arr[$k]['id']=$arr['id'];
            $goods_list_arr[$k]['minimum']=$minimum;
            $goods_list_arr[$k]['maximum']=$maximum;
        }
        $this->assign('goods_list_arr',$goods_list_arr);
        $this->assign('store_category_goods_list', $store_goods_list);
        
        return $this->fetch();
    }
}
