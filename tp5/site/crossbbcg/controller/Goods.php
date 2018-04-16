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
// | Goods.php  Version 2017/2/23
// +----------------------------------------------------------------------
namespace app\crossbbcg\controller;

use app\crossbbcg\model\Goods as GoodsModel;
use app\crossbbcg\service\Goods as GoodsApi;
use app\crossbbcg\model\Category as CategoryModel;
use app\seller\service\ShopAttention as ShopAttentionApi;
use app\crossbbcg\model\Brand as BrandModel;
use app\member\service\Collect as CollectApi;
use app\crossbbcg\model\GoodsSku as GoodsSkuModel;
use app\member\service\GoodsComment as GoodsCommentApi;
use app\member\model\GoodsComment as GoodsCommentModel;
use app\bcwareexp\service\Expresstpl as ExpresstplApi;
use app\member\model\MyPath as MyPathModel;
use app\member\model\Collect as CollectModel;
use app\bcwareexp\model\Crossware as CrosswareModel;

class Goods extends Shopbase
{
    
    /**
     * @Mark:商品页面
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/2/23
     */
    public function index()
    {
        if (input('?item_id')) {
            $good_id = input('item_id');
        } else {
            return $this->redirect('error/not_found_goods');
        }
        
        // 其他信息
        $other = [];
        $other['now_langid'] = LANG; // 前后台分开互不影响
        $other['platform'] = PLATFORM;
        $this->assign('other', $other);
        
        // 商品信息
        $result = GoodsModel::get($good_id);
    
        if ($result === null) {
            return $this->redirect('error/not_found_goods');
        }
        
        // 商品状态判断
        if ($result['status'] != 'enabled') {
            return $this->redirect('error/not_found_goods');
        }
        // 平台状态
        $platform = PLATFORM_STATUS;
        
        if (!$result[$platform]) {
            return $this->redirect('error/not_found_goods');
        }
        
        // 记录用户的浏览记录
        $this->addMyPath($good_id);
        
        // 面包屑导航
        $breadcrumb = [];
        if (!cache('breadcrumb_good_' . $good_id)) {
            if ($result['cat_id'] != 0) {
                $pids = GoodsApi::getPids($result['cat_id']);
                foreach ($pids as $value) {
                    $cat_model = CategoryModel::get($value);
                    $category = array(
                        'href' => url('crossbbcg/search/index', 'cat_id=' . $value),
                        'name' => $cat_model['title'],
                    );
                    array_unshift($breadcrumb, $category);
                }
                
                $cat_model = CategoryModel::get($result['cat_id']);
                $breadcrumb[] = array(
                    'href' => url('crossbbcg/search/index', 'cat_id=' . $result['cat_id']),
                    'name' => $cat_model['title'],
                );
            }
            $breadcrumb[] = array(
                'href' => url('crossbbcg/goods/index', 'item_id=' . $good_id),
                'name' => $result['name'],
            );
            cache('breadcrumb_good_' . $good_id, $breadcrumb);
        } else {
            $breadcrumb = cache('breadcrumb_good_' . $good_id);
        }
        $this->assign('breadcrumb', $breadcrumb);
        
        // 左侧分类导航
        $cat_id = $result['cat_id'];
        $arr_category = [];
        $cids = [];
        if ($cat_id) {
            if (!cache('cids_good_' . $good_id) && !cache('arr_category_good_' . $good_id)) {
                $path_id = GoodsApi::getTopPid($cat_id);
                $cat1 = CategoryModel::get($path_id);
                $cids[] = $path_id;
                if ($cat1) {
                    $cids = array_merge($cids, GoodsApi::getCids($path_id));
                    $arr_category['href'] = url('crossbbcg/search/index', 'cat_id=' . $cat1['id']);
                    $arr_category['title'] = $cat1['title'];
                    $arr_category['children'] = [];
                    $cat2 = GoodsApi::getCategories($cat1['id']);
                    if ($cat2) {
                        $arr_category['children'] = $cat2->toArray();
                        foreach ($arr_category['children'] as $key => $arr) {
                            $arr_category['children'][$key]['children'] = [];
                            $cat3 = GoodsApi::getCategories($arr['id']);
                            if ($cat3) {
                                $arr_category['children'][$key]['children'] = $cat3->toArray();
                            }
                        }
                    }
                }
                
                cache('cids_good_' . $good_id, $cids);
                cache('arr_category_good_' . $good_id, $arr_category);
            } else {
                $cids = cache('cids_good_' . $good_id);
                $arr_category = cache('arr_category_good_' . $good_id);
            }
        }
        
        $this->assign('now_cat_id', $cat_id);
        $this->assign('cids', $cids);
        $this->assign('arr_category', $arr_category);
        
        
        // 商品图片
        $image_list = [];
        if ($result['thumb']) {
            $images = GoodsApi::getImage($good_id);
            if ($images) {
                $image_list = $images;
            }
        }
        $this->assign('image_list', $image_list);
        
        // 二维码图片
        $result['wechat_qr_code'] = qrcode();
        
        // 税费规则
        if(config('tax_img')){
            $tax_img = config('tax_img');
        }else{
            $tax_img = '';
        }
        //$tax_img = 'static/images/tax.png';
        $this->assign('tax_img',$tax_img);
    
    
        // 商户资料
        $seller = [];
        $arr_see = [];
        $arr_new = [];
        if ($result['seller_id'] != 0) {
            $seller = GoodsApi::getSeller($result['seller_id']);
            if ($seller !== null) {
                $seller['shop_grade_percent'] = $seller['shop_grade'] * 20 . '%';
                $seller['shop_grade'] = $seller['shop_grade'] . lang('Minute');
            }
            // 店铺类型
            if ($seller['shopcat'] != null) {
                $seller['cat_name'] = $seller['shopcat']['name'];
            }
            
            // 看了又看，同商户下的最新产品
            $map2 = ['langid'=>LANG,'status'=>'enabled','quantity'=>['>',0]];
            $see_goods = GoodsModel::where('seller_id', $result['seller_id'])->where($map2)->order('create_time', 'DESC')->limit(4)->select();
            if ($see_goods !== null) {
                foreach ($see_goods as $key => $arr) {
                    $arr_see[$key]['thumb'] = $arr['thumb'];
                    $arr_see[$key]['name'] = $arr['name'];
                    $arr_see[$key]['href'] = url('crossbbcg/goods/index', 'item_id=' . $arr['id']);
                    $arr_see[$key]['sale_price'] = GoodsApi::currencyFormat($arr['sale_price'], config('catalog_currency_code'));
                    $arr_see[$key]['market_price'] = GoodsApi::currencyFormat($arr['market_price'], config('catalog_currency_code'));
                }
            }
        }
        if (empty($seller)) {
            // 新品 推荐
            if ($result['cat_id']) {
                $new_goods = GoodsModel::where('cat_id', $result['cat_id'])->where('langid', LANG)->order('create_time', 'DESC')->limit(12)->select();
                if ($new_goods !== null) {
                    foreach ($new_goods as $key => $arr) {
                        if ($key % 2 == 0) {
                            $new_key = $key;
                        } else {
                            $new_key = $key - 1;
                        }
                        $new_arr = [];
                        $new_arr['thumb'] = $arr['thumb'];
                        $new_arr['name'] = $arr['name'];
                        $new_arr['href'] = url('crossbbcg/goods/index', 'item_id=' . $arr['id']);
                        $new_arr['sale_price'] = GoodsApi::currencyFormat($arr['sale_price'], config('catalog_currency_code'));
                        $new_arr['market_price'] = GoodsApi::currencyFormat($arr['market_price'], config('catalog_currency_code'));
                
                        $arr_new[$new_key][] = $new_arr;
                
                    }
                }
            }
        }
    
    
        $this->assign('seller', $seller);
        $this->assign('arr_see', $arr_see);
        $this->assign('arr_new', $arr_new);
        
        
        
        // 会员id
        $this->assign('member_id', is_login());
        
        
        // 商品关联的国家
        if ($result['country_id'] != 0) {
            $country = GoodsApi::getCountry($result['country_id']);
            $result['country_name'] = $country['name'];
            $result['country_code'] = strtolower($country['code']);
        } else {
            $result['country_name'] = config('catalog_country_name');
            $result['country_code'] = strtolower(config('catalog_country_code'));
        }
        // 国旗
        $national_flag = __ROOT__ . '/' . APP_NAME . '/' . MODULE_NAME . '/' . MOBTPL . 'image/flags/' . $result['country_code'] . '.png';
        $result['national_flag'] = $national_flag;
        
        // 商品折扣
        $price_rate = 0;
        if (($result['market_price'] - $result['sale_price']) > 0) {
            $price_rate = (10 - round(($result['market_price'] - $result['sale_price']) / $result['market_price'] * 10, 1)) . lang('zhe');
        }
        $result['price_rate'] = $price_rate;
        
        
        //商品价格
        $tax = 0;
        if ($result['sale_price'] >= 2000) {
            $tax = GoodsApi::currencyFormat((GoodsApi::getTax($result['sale_price'], $result['tax_rate'])), config('catalog_currency_code'));
        }
        
        $sale_price = GoodsApi::currencyFormat($result['sale_price'], config('catalog_currency_code'));
        $market_price = GoodsApi::currencyFormat($result['market_price'], config('catalog_currency_code'));
        $result['tax'] = $tax;
        $result['sale_price'] = $sale_price;
        $result['market_price'] = $market_price;
        
        // 商品品牌
        $brand = BrandModel::get($result['brand_id']);
        if ($brand !== null) {
            $result['brand_name'] = $brand['name'];
        } else {
            $result['brand_name'] = '';
        }
        
        // 商品选项sku
        $arr_sku = [];
        // 返回sku有选项，且库存不低于0的选项值合并字符串
        $merge_value = GoodsApi::getMergeValue($good_id, true);
        if ($merge_value) {
            $sku_images = GoodsApi::GoodsSkuImage($good_id);
            //$merge_value = str_replace('_', ',', $merge_value);
            $merge_option = GoodsApi::getSkuOptions($merge_value);
            foreach ($merge_option as $arr) {
                $sku_image = '';
                if (isset($sku_images[$arr['option_value_id']])) {
                    $sku_image = $sku_images[$arr['option_value_id']];
                }
                $arr_sku[$arr['name']][] = array(
                    'option_value_id' => $arr['option_value_id'],
                    'name' => $arr['option_value_name'],
                    'sku_image' => $sku_image,
                    'sort' => $arr['option_value_sort']
                );
            }
            $choose_sku = '';
        } else {
            // 无选项的sku默认选择
            $choose_sku = GoodsSkuModel::where('good_id', $good_id)->value('sku');
        }
        $this->assign('arr_sku', $arr_sku);
        $this->assign('choose_sku', $choose_sku);
        $this->assign('all_sku', json_encode($this->getAllSku($good_id)));
    
        
        // 产品参数
        $goods_attribute = GoodsApi::getGoodsAttribute($good_id);
        $arr_attribute = [];
        $filter_attribute = [];
        if ($goods_attribute !== null) {
            foreach ($goods_attribute as $key => $arr) {
                if ($arr['attribute']['filtrate']) {
                    if (isset($filter_attribute[$arr['attribute']['name']])) {
                        $filter_attribute[$arr['attribute']['name']] = $filter_attribute[$arr['attribute']['name']] . ',' . $arr['value'];
                    } else {
                        $filter_attribute[$arr['attribute']['name']] = $arr['value'];
                    }
                    
                }
                if (isset($arr_attribute[$arr['attribute_group']['name']][$arr['attribute']['name']])) {
                    $arr_attribute[$arr['attribute_group']['name']][$arr['attribute']['name']] = $arr_attribute[$arr['attribute_group']['name']][$arr['attribute']['name']] . ',' . $arr['value'];
                } else {
                    $arr_attribute[$arr['attribute_group']['name']][$arr['attribute']['name']] = $arr['value'];
                }
                
            }
        }
        $this->assign('goods_attribute', $arr_attribute);
        $this->assign('filter_attribute', $filter_attribute);
        
        
        // 最大购买量，最小购买量
        if ($result['minimum'] <= 0) {
            $result['minimum'] = 1;
        }
        if ($result['maximum'] <= 0) {
            $result['maximum'] = $result['quantity'];
        } else {
            if ($result['maximum'] > $result['quantity']) {
                $result['maximum'] = $result['quantity'];
            }
        }
        
        //商品评价
        //所有评价列表
        $all_comment = GoodsCommentApi::lists(['goods_id' => $good_id, 'is_display' => 1]);
        foreach ($all_comment as $k=>$v) {
            $all_comment[$k]['headimg'] = \app\member\model\Account::where(['id'=>$v['uid']])->value('headimg');
        }
        $this->assign('all_comment_list', $all_comment);
        $goods_avg_score = GoodsCommentModel::where(['goods_id' => $good_id])->avg('score');
        $this->assign('goods_avg_score', round($goods_avg_score, 2));
        
        //好评
        $good_comment = GoodsCommentApi::lists(['goods_id' => $good_id, 'score' => ['in', [4, 5]], 'is_display' => 1]);
        foreach ($good_comment as $k=>$v) {
            $good_comment[$k]['headimg'] = \app\member\model\Account::where(['id'=>$v['uid']])->value('headimg');
        }
        $this->assign('good_comment', $good_comment);
        $this->assign('good_comment_rate', $all_comment->total() ? round($good_comment->total() / $all_comment->total() * 100, 2) : 0);
        //中评
        $medium_comment = GoodsCommentApi::lists(['goods_id' => $good_id, 'score' => ['in', [2, 3]], 'is_display' => 1]);
        foreach ($medium_comment as $k=>$v) {
            $medium_comment[$k]['headimg'] = \app\member\model\Account::where(['id'=>$v['uid']])->value('headimg');
        }
        $this->assign('medium_comment', $medium_comment);
        $this->assign('medium_comment_rate', $all_comment->total() ? round($medium_comment->total() / $all_comment->total() * 100, 2) : 0);
        //差评
        $bad_comment = GoodsCommentApi::lists(['goods_id' => $good_id, 'score' => 1, 'is_display' => 1]);
        foreach ($bad_comment as $k=>$v) {
            $bad_comment[$k]['headimg'] = \app\member\model\Account::where(['id'=>$v['uid']])->value('headimg');
        }
        $this->assign('bad_comment', $bad_comment);
        $this->assign('bad_comment_rate', $all_comment->total() ? round($bad_comment->total() / $all_comment->total() * 100, 2) : 0);
        //晒图
        $show_image = GoodsCommentApi::lists(['goods_id' => $good_id, 'is_display' => 1, 'is_img' => 1]);
        $this->assign('show_image', $show_image);
        
        // 商品详情描述 视频
        $result['video'] = html_entity_decode(trim($result['video']), ENT_QUOTES, 'UTF-8');
        if (PLATFORM == 'pc') {
            $result['description'] = html_entity_decode(rtrim($result['pc_description']), ENT_QUOTES, 'UTF-8');
        } else {
            $result['description'] = html_entity_decode(rtrim($result['wap_description']), ENT_QUOTES, 'UTF-8');
        }
        
        // 同分类下的热销商品12个
        $arr_hot = [];
        if ($result['cat_id']) {
            $hot_goods = GoodsModel::where('cat_id', $result['cat_id'])->where('langid', LANG)->order('sales_volume', 'DESC')->limit(12)->select();
            if ($hot_goods !== null) {
                foreach ($hot_goods as $key => $arr) {
                    $arr_hot[$key]['thumb'] = $arr['thumb'];
                    $arr_hot[$key]['name'] = $arr['name'];
                    $arr_hot[$key]['href'] = url('crossbbcg/goods/index', 'item_id=' . $arr['id']);
                    $arr_hot[$key]['sale_price'] = GoodsApi::currencyFormat($arr['sale_price'], config('catalog_currency_code'));
                    $arr_hot[$key]['market_price'] = GoodsApi::currencyFormat($arr['market_price'], config('catalog_currency_code'));
                }
            }
        }
        $this->assign('arr_hot', $arr_hot);
        
        // 用户浏览记录
        $arr_collect = [];
        if (is_login()) {
            //用户信息
            $uid = is_login();
            $collect = MyPathModel::all(function ($query) use ($uid) {
                $query->where(['uid' => $uid])->order('update_time', 'DESC')->limit(10);
            });
            
            if ($collect !== null) {
                foreach ($collect as $key => $arr) {
                    $arr_collect[$key]['goods']['id'] = $arr['goods']['id'];
                    $arr_collect[$key]['goods']['name'] = $arr['goods']['name'];
                    $arr_collect[$key]['goods']['thumb'] = $arr['goods']['thumb'];
                    $arr_collect[$key]['goods']['sale_price'] = GoodsApi::currencyFormat($arr['goods']['sale_price']);
                    $arr_collect[$key]['goods']['market_price'] = GoodsApi::currencyFormat($arr['goods']['market_price']);
                }
            }
        }
        
        $this->assign('collect', $arr_collect);
        
        // 是否收藏
        $is_collect = false;
        if (is_login()) {
            $map = [
                'uid' => is_login(),
                'goods_id' => $good_id
            ];
            $result_collect = CollectModel::where($map)->find();
            if ($result_collect !== null) {
                $is_collect = true;
            }
        }
        $this->assign('is_collect', $is_collect);
        
        // 获取平台现有的支付方式
        $arr_payments = [];
        $filter_data = array(
            'subjection' => 'seapays',     // 跨境电商支付方式
            PLATFORM => 1,
            'status' => 1
        );
        $payments = \app\common\service\Extend::getExt($filter_data);
        if ($payments['data']) {
            foreach ($payments['data'] as $key => $arr) {
                $arr_payments[$key]['config'] = unserialize($arr['config']);
                $arr_payments[$key]['title'] = $arr_payments[$key]['config']['pay_name'];
                $arr_payments[$key]['code'] = $arr['code'];
                $arr_payments[$key]['logo'] = __ROOT__ . '/static/images/seapays/' . strtolower($arr['code']) . '.png';
            }
        }
        $this->assign('arr_payments', $arr_payments);
        
        // 服务承诺
        if ($result['promise'] != '') {
            $promise = explode(',', $result['promise']);
        } else {
            $promise = [];
        }
        $result['promise'] = $promise;
        
        
        $result['href'] = url('crossbbcg/goods/index', 'item_id=' . $good_id);
        if ($result['meta_title'] == '') {
            $result['meta_title'] = $result['name'];
        }
        
        // 地区
        $bcwareexp_region = ROOT_PATH . 'public/static/js/region.json';
        
        if(is_file($bcwareexp_region)){
            $this->assign('exist_region',true);
        }else{
            $this->assign('exist_region',false);
        }
        
    
  
        $this->assign("data", $result);
        return $this->fetch();
    }
    
    /**
     * @Mark:  收藏店铺
     * @return bool|\think\response\Json
     * @Author: WangHuaLong
     */
    public function attentionStore()
    {
        $member_id = is_login();
        
        if ($member_id == 0) {
            // 存储请求页面的链接，登陆成功后跳转
            session('redirect_url', input('server.HTTP_REFERER'));
            return json(['code' => 0, 'msg' => lang('Please_Login'), 'url' => url('member/passport/index')]);
        }
        $store_id = $this->request->get('store_id');
        $filter_data = array(
            'uid' => $member_id,
            'store_id' => $store_id,
        );
        
        $result = ShopAttentionApi::addAttentionStore($filter_data);
        if ($result['code'] == 0) {
            return $result;
        }
        return json(['code' => 1, 'msg' => lang('Attention_Store_Success')]);
    }
    
    /**
     * @Mark: 收藏商品
     * @return bool|\think\response\Json
     * @Author: WangHuaLong
     */
    public function collectGood()
    {
        $member_id = is_login();
        
        if ($member_id == 0) {
            return json(['code' => 0, 'msg' => lang('Please_Login'), 'url' => url('member/passport/index')]);
        }
        $good_id = $this->request->get('item_id');
        $filter_data = array(
            'uid' => $member_id,
            'goods_id' => $good_id,
        );
        
        $result = CollectApi::add_collect($filter_data);
        if ($result === true) {
            return json(['code' => 1, 'msg' => lang('Collect_Success')]);
        }
        return $result;
    }
    
    /**
     * @Mark: 返回sku的数据
     * @return int|mixed
     * @Author: WangHuaLong
     */
    public function getSku()
    {
        $merge_value = $this->request->post('merge_value');
        $good_id = $this->request->post('item_id');
        $merge_value = explode(',', $merge_value);
        sort($merge_value); // 排序id
        $merge_option_value_id = implode(',', $merge_value);
        
        $map = array(
            'good_id' => $good_id,
            'merge_option_value_id' => $merge_option_value_id
        );
        $result = GoodsSkuModel::where($map)->find();
        if ($result === null) {
            return false;
        }
        $good = GoodsModel::get($result['good_id']);
        
        // 商品折扣
        $price_rate = 0;
        if (($result['market_price'] - $result['sale_price']) > 0) {
            $price_rate = (10 - round(($result['market_price'] - $result['sale_price']) / $result['market_price'] * 10, 1)) . lang('zhe');
        }
        $result['price_rate'] = $price_rate;
        
        // 商品价格
        $tax = 0;
        if ($result['sale_price'] >= 2000) {
            $tax = GoodsApi::currencyFormat((GoodsApi::getTax($result['sale_price'], $good['tax_rate'])), config('catalog_currency_code'));
        }
        $sale_price = GoodsApi::currencyFormat($result['sale_price'], config('catalog_currency_code'));
        $market_price = GoodsApi::currencyFormat($result['market_price'], config('catalog_currency_code'));
        $result['sale_price'] = $sale_price;
        $result['market_price'] = $market_price;
        $result['tax'] = $tax;
        return json($result);
    }
    
    /**
     * @Mark: 获取商品的所有sku
     * @param $good_id int 商品id
     * @return array
     * @Author: WangHuaLong
     */
    public function getAllSku($good_id)
    {
        
        $map = array(
            'good_id' => $good_id
        );
        $arr_sku = GoodsSkuModel::where($map)->column('*', 'merge_option_value_id');
        
        if (empty($arr_sku)) {
            return [];
        }
        $good = GoodsModel::get($good_id);
        $result = [];
        foreach ($arr_sku as $key => $arr) {
            if ($arr['merge_option_value_id'] != '') {
                $tax = 0;
                if ($arr['sale_price'] >= 2000) {
                    $tax = GoodsApi::currencyFormat((GoodsApi::getTax($arr['sale_price'], $good['tax_rate'])), config('catalog_currency_code'));
                }
                $sale_price = GoodsApi::currencyFormat($arr['sale_price'], config('catalog_currency_code'));
                $market_price = GoodsApi::currencyFormat($arr['market_price'], config('catalog_currency_code'));
                
                if ($arr['quantity'] > $good['minimum']) {
                    $validate = true;
                } else {
                    $validate = false;
                }
                
                $result[$key]['sku_id'] = $arr['sku'];
                $result[$key]['item_id'] = $good_id;
                $result[$key]['sale_price'] = $sale_price;
                $result[$key]['market_price'] = $market_price;
                $result[$key]['tax'] = $tax;
                $result[$key]['validate'] = $validate;
            }
        }
        
        
        return $result;
    }
    
    /**
     * @Mark: 设置商品的默认运费
     * @return bool|int
     * @Author: WangHuaLong
     */
    public function shippingPrice()
    {
        if (input('?post.item_id')) {
            $good_id = input('post.item_id');
        } else {
            return false;
        }
        
        $city_id = 0; // 设置默认城市
        if (input('?post.city_id')) {
            $city_id = input('post.city_id');
        }
        
        $good = GoodsModel::get($good_id);
        if (input('?post.sku') && input('post.sku') != '') {
            $sku_id = input('post.sku');
        } else {
            $sku = GoodsSkuModel::where('good_id', $good_id)->find();
            $sku_id = $sku['sku'];
        }
        
        if (input('?post.num')) {
            $num = input('post.num');
        } else {
            $num = $good['minimum'];
        }
        
        $filter_data = array(
            'seller_id' => $good['seller_id'],
            'city_id' => $city_id,
            'info' => array([
                'goods_id' => $good_id,
                'sku' => $sku_id,
                'buy_num' => $num
            ])
        );
        
        $result = ExpresstplApi::calculateFee($filter_data);
        if (isset($result['freight'])) {
            $freight = lang('express_value') . '：' . GoodsApi::currencyFormat($result['freight'], config('catalog_currency_code'));
        } else {
            $freight = 0;
        }
        // 发货仓库，选择一个
        $type = false;
        if (isset($result['data'])) {
            $code = current(array_keys($result['data']));
            if ($code) {
                $type = CrosswareModel::where('code', $code)->value('type');
                if ($type === null) {
                    $type = false;
                }
            }
        }
        $json['freight'] = $freight;
        if($type){
            $json['cross_name'] = lang('cross_' . $type);
        }else{
            $json['cross_name'] = false;
        }
        
        
        return $json;
    }
    
    /**
     * @Mark: 记录用户的商品浏览足迹
     * @param $good_id
     * @return array
     * @Author: WangHuaLong
     */
    public function addMyPath($good_id)
    {
        if (is_login()) {
            $user_id = is_login();
            
            $insert_data = [
                'uid' => $user_id,
                'goods_id' => $good_id,
            ];
            // 修改足迹中，同商品的修改时间，即最近的访问时间
            $time = ['update_time' => time()];
            $result = MyPathModel::where($insert_data)->update($time);
            // 如果没有，则创建
            if ($result == 0) {
                MyPathModel::create($insert_data);
            }
            return ['code' => 1, 'msg' => ''];
        }
        return ['code' => 0, 'msg' => lang('login_first'), 'url' => url('member/passport/index')];
    }
    
    /**
     * @Mark: 删除用户所有的访问记录
     * @return array
     * @Author: WangHuaLong
     */
    public function deleteAllMyPath()
    {
        if (is_login()) {
            $user_id = is_login();
            MyPathModel::where('uid', $user_id)->delete();
            return ['code' => 1, 'msg' => ''];
        }
        return ['code' => 0, 'msg' => lang('login_first'), 'url' => url('member/passport/index')];
    }
}