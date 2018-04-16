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
// | 商品管理  Version 1.0  2016/3/13
// +----------------------------------------------------------------------
namespace app\crossbbcg\controller\admin;

use app\admin\controller\Admin;
use app\crossbbcg\model\Goods as GoodsModel;
use app\crossbbcg\model\Category as CategoryModel;
use app\crossbbcg\model\GoodsSkuImage;
use app\crossbbcg\service\Goods as GoodsApi;
use app\bcwareexp\model\Crossware as CrosswareModel;
use app\crossbbcg\model\GoodsSku as GoodsSkuModel;
use app\crossbbcg\model\GoodsImage;
use app\crossbbcg\model\Attribute as AttributeModel;
use app\crossbbcg\model\Option as OptionModel;
use app\seller\model\Store as StoreModel;
use app\crossbbcg\model\GoodsBlockedStock as GoodsBlockedStockModel;

class Index extends Admin
{
    /**
     * @Mark:继承
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/8/9
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->conDb = 'Goods';
    }
    
    /**
     * @Mark: 商品列表页
     * @return mixed
     * @Author: WangHuaLong
     */
    public function index()
    {
        /**
         * 商品多列显示 [未完成]
         * config('default_display_column'); 默认配置显示列
         * cookie('now_display_column'); 当前用户选择列，存储在cookie
         */
        $goods_column = array('*');
        $goods_description_column = array();
        $display_column = array_merge($goods_column, $goods_description_column);
        
        // 排序
        if (input('?_field') && input('?_order')) {
            $order_bys = array(
                input('_field') => input('_order')
            );
        } else {
            $order_bys = array(
                'id' => 'desc'
            );
        }
    
        // where 索搜条件 name 商品名称, quantity 商品库存 , status 商品状态
        $map = [];
        
        if (input('?name')) {
            $map['sub_title|good_code|name|id'] = array('like', '%' . (string)input('name') . '%');
        }
        
        if (input('?quantity')) {
            $map['quantity'] = array('<=', (int)input('quantity'));
        }
        
        if (input('?status')) {
            $map['status'] = array('=', input('status'));
        } else {
            $map['status'] = array('<>', 'recycle');
        }
        
        if (input('?min_price')) {
            $map['sale_price'] = ['>=', input('min_price/d')];
        }
        if (input('?max_price')) {
            $map['sale_price'] = ['<=', input('max_price/d')];
        }
        
        $map['langid'] = LANG;
        
        // 搜索url
        $arr_url = input();
        unset($arr_url['page']);
        if (input('?name') && input('name') != '') {
            unset($arr_url['name']);
        }
        if (input('?min_price') && input('min_price') != '') {
            unset($arr_url['min_price']);
        }
        if (input('?max_price') && input('max_price') != '') {
            unset($arr_url['max_price']);
        }
        $search_url = url('index', $arr_url);
        $this->assign('search_url', $search_url);
        
        // 筛选分类
        $cat_id = 0;
        if (input('?cat_id')) {
            $cat_id = input('cat_id/d');
        }
        $this->assign("catlist", sortdata(CategoryModel::all()));
        $arr_url = input();
        unset($arr_url['page']);
        if (input('?cat_id') && input('cat_id') != 0) {
            unset($arr_url['cat_id']);
            $catlist_url = url('index', $arr_url);
        } else {
            $catlist_url = url('index', $arr_url);
        }
        $this->assign('catlist_url', $catlist_url);
        
        // 筛选品牌
        if (input('?brand_id')) {
            $map['brand_id'] = input('brand_id/d');
        }
        $this->assign('arr_brands', GoodsApi::getBrands());
        $arr_url = input();
        unset($arr_url['page']);
        if (input('?brand_id') && input('brand_id') != 0) {
            unset($arr_url['brand_id']);
            $brand_url = url('index', $arr_url);
        } else {
            $brand_url = url('index', $arr_url);
        }
        $this->assign('brand_url', $brand_url);
        
        
        // 分页显示,叠加搜索条件
        if (config("default_list_rows")) {
            $paginate_list_rows = config("default_list_rows");
        } else {
            $paginate_list_rows = 20;
        }
        
        $filter_data = array(
            'where' => $map,
            'order' => $order_bys,
            'field' => $display_column,
            'category_id' => $cat_id,
            'paginate' => $paginate_list_rows,
        );
        // 获取商品列表
        $list = GoodsApi::getGoods($filter_data);
        $this->assign('list', $list);
    
        // 搜索结果总数
        $search_total = GoodsApi::getTotalSearch($filter_data);
        $this->assign('search_total', $search_total);
        
        // 获取最低库存量
        $low_stock_quantity = config("default_stockwarming");
        $this->assign('low_stock_quantity', $low_stock_quantity);
        if (input('?quantity')) {
            $low_stock = $search_total;
        } else {
            $filter_data_quantity = $filter_data;
            $filter_data_quantity['where']['quantity'] = array('<=', (int)$low_stock_quantity);
            $low_stock = GoodsApi::getTotalSearch($filter_data_quantity);
        }
        $this->assign('low_stock', $low_stock);
        
        // 商品各个状态下的商品数量统计 上架，下架，待审，待修，待上架
        $good_up_total = $good_down_total = $good_wait_total = $good_modify_total = $good_pending_total = 0;
        if (input('?status')) {
            switch (input('status')) {
                case 'disabled':
                    $good_down_total = $search_total;
                    break;
                case 'enabled':
                    $good_up_total = $search_total;
                    break;
                case 'pending_review':
                    $good_wait_total = $search_total;
                    break;
                case 'pending_modify':
                    $good_modify_total = $search_total;
                    break;
                default:
                    $good_pending_total = $search_total;
            }
        } else {
            $filter_data_status_1 = $filter_data_status_2 = $filter_data_status_3 = $filter_data_status_0 = $filter_data;
            $filter_data_status_1['where']['status'] = array('=', 'enabled');
            $filter_data_status_2['where']['status'] = array('=', 'pending_review');
            $filter_data_status_3['where']['status'] = array('=', 'pending_modify');
            $filter_data_status_0['where']['status'] = array('=', 'disabled');
            $filter_data_status_4['where']['status'] = array('=', 'pending');
            $good_up_total = GoodsApi::getTotalSearch($filter_data_status_1);
            $good_wait_total = GoodsApi::getTotalSearch($filter_data_status_2);
            $good_modify_total = GoodsApi::getTotalSearch($filter_data_status_3);
            $good_down_total = GoodsApi::getTotalSearch($filter_data_status_0);
            $good_pending_total = GoodsApi::getTotalSearch($filter_data_status_4);
        }
        $this->assign('good_up_total', $good_up_total);
        $this->assign('good_down_total', $good_down_total);
        $this->assign('good_wait_total', $good_wait_total);
        $this->assign('good_modify_total', $good_modify_total);
        $this->assign('good_pending_total', $good_pending_total);
        
        // 商品总数
        $filter_data_total = array(
            'where' => ['status' => ['<>', 'recycle'], 'langid' => LANG],
        );
        $this->assign('total', GoodsApi::getTotalSearch($filter_data_total));
        $this->assign('meta_title', lang('Bbcggoods'));
        
        // 分类
        $arr_category = CategoryModel::where('langid',LANG)->column('title','id');
        $this->assign('arr_category',$arr_category);
        
        // 店铺
        $arr_store = StoreModel::where('langid',LANG)->column('seller_name','seller_id');
        $this->assign('arr_store',$arr_store);
        
        // 去除page
        $arr_url = input();
        unset($arr_url['page']);
        $this->assign('without_page',$arr_url);
    
        // 调用商品列表模板
        return $this->fetch();
    }
    
    /**
     * @Mark: 显示列
     * @return mixed
     * @Author: WangHuaLong
     */
    public function editColumn()
    {
        $goods = new GoodsModel();
        $column = $goods->getTableFields();
        $this->assign('column', $column);
        return $this->fetch('editcolumn');
        
    }
    
    /**
     * @Mark: 软删除商品/修改商品状态为recycle
     * @Author: WangHuaLong
     */
    public function delete()
    {
        $result = false;
        if (input('post.ids/a')) {
            foreach (input('post.ids/a') as $value) {
                $data = array(
                    'id' => (int)$value,
                    'status' => 'recycle'
                );
                $result = GoodsApi::changeGoodStatus($data);
            }
        } else {
            if (input('?param.ids')) {
                $data = array(
                    'id' => (int)input('param.ids'),
                    'status' => 'recycle'
                );
                $result = GoodsApi::changeGoodStatus($data);
            } else {
                $this->error(lang('Delete_Goods_Error'), $this->jumpUrl);
            }
        }
        
        if ($result['code']) {
            if (input('post.ids/a')) {
                action_log('delete', $this->conDb, implode(',', input('post.ids/a')), UID);
            } else {
                action_log('delete', $this->conDb, input('ids'), UID);
            }
            $this->success(lang('Deleteok'), $this->jumpUrl);
        } else {
            return $result;
        }
        
    }
    
    /**
     * @Mark: 修改商品状态
     * @return bool|object|\think\response\Json
     * @Author: WangHuaLong
     */
    public function changeStatus()
    {
        $data = array(
            'id' => $this->request->post('id'),
            'status' => $this->request->post('status')
        );
        return GoodsApi::changeGoodStatus($data);
    }
    
    /**
     * @Mark: 修改商品的排序
     * @return bool|object|\think\response\Json
     * @Author: WangHuaLong
     */
    public function changeSort()
    {
        $data = array(
            'id' => $this->request->post('id'),
            'sort' => $this->request->post('sort')
        );
        return GoodsApi::changeGoodSort($data);
    }
    
    /**
     * @Mark: 商品编辑页
     * @return mixed
     * @Author: WangHuaLong
     */
    public function edit()
    {
        $this->assign("action_name", 'edit');
        $this->assign("meta_title", lang('Edit'));
        
        $good_id = $this->request->has('ids') ? $this->request->param('ids') : $this->error(lang('Error_id'));
        $result = GoodsModel::get($good_id);
        if ($result) {
            $result = $result->toArray();
        } else {
            $this->error(lang('Error_id'));
        }
        $this->assign("data", $result);
        
        // 商户
        $seller_name = GoodsApi::getSellerNickname($result['seller_id']);
        $this->assign('seller_name', $seller_name);
        // 商品分类
        $category = GoodsApi::getCategories(0);
        $this->assign('arr_category', $category);
        if ($result['cat_id'] != 0) {
            $now_category = GoodsApi::getNowCategory($result['cat_id']);
            if ($now_category) {
                $this->assign('now_category_name', $now_category[0]['sort_name']);
            } else {
                $this->assign('now_category_name', lang('Null'));
            }
        } else {
            $this->assign('now_category_name', lang('Null'));
        }
        
        // 商品状态
        $this->assign("arr_status", config('default_good_status'));
        $this->assign('default_good_status_id', config('default_good_status_id'));
        // 税收
        $this->assign('arr_taxs', config('default_tax_class'));
        $this->assign('default_tax_class_id', config('default_tax_class_id'));
        
        // 服务承诺
        $this->assign('arr_promise',config('default_good_service'));
        if($result['promise'] != ''){
            $promise = explode(',',$result['promise']);
        }else{
            $promise = [];
        }
        $this->assign('promise',$promise);
        
        
        // 重量单位,包装件数
        $this->assign('arr_weights', config('default_weight_class'));
        $this->assign('arr_package_units', config('default_package_unit'));
        
        
        // 商品类型
        $this->assign('arr_types', config('default_good_types'));
        
        // 国家
        $arr_country = GoodsApi::getCountries();
        $this->assign('arr_country', $arr_country);
        
        // 商品品牌
        $arr_brands = GoodsApi::getBrands();
        $this->assign('arr_brands', $arr_brands);
        
        // 获取当前分类的所有参数
        $goods_attribute = GoodsApi::getGoodsAttribute($good_id);
        $has_attribute = [];
        $has_group_attribute = [];
        if($goods_attribute!==null){
            foreach($goods_attribute as $key => $arr){
                $has_attribute[$arr['attribute_group_id']][$arr['attribute_id']][$arr['value']] = $arr['value'];
                $has_group_attribute[] = $arr['attribute_group_id'];
            }
        }
    
        $arr_attribute = [];
        if($result['cat_id']!=0) {
            $attribute_group_ids = CategoryModel::where('id', $result['cat_id'])->value('attribute_group_ids');
            $attribute_group_ids = explode(',',$attribute_group_ids);
            $attribute_group_ids = array_merge($attribute_group_ids,$has_group_attribute);
            $arr_result = AttributeModel::where('attribute_group_id','in',$attribute_group_ids)->select();
            if($arr_result!==null){
                foreach($arr_result as $key => $arr){
                    $arr_attribute[$arr['attribute_group_id']]['attribute_group_name'] = $arr['attribute_group']['name'];
                    $arr_attribute[$arr['attribute_group_id']][$arr['attribute_id']]['attribute_name'] = $arr['name'];
            
                    // 获取参数值
                    if($arr['attribute_value']){
                        $att_options = explode(',',$arr['attribute_value']);
                        $attribute_options =[];
                        foreach($att_options as $key2 => $value){
                            $attribute_options[$key2]['value'] = $value;
                            if(isset($has_attribute[$arr['attribute_group_id']][$arr['attribute_id']][$value])){
                                $attribute_options[$key2]['checked'] = 1;
                            }else{
                                $attribute_options[$key2]['checked'] = 0;
                            }
                        }
                    }else{
                        $attribute_options = false;
                    }
                    $arr_attribute[$arr['attribute_group_id']][$arr['attribute_id']]['option'] = $attribute_options;
                    // 获取商品的选定参数值
                    if(isset($has_attribute[$arr['attribute_group_id']][$arr['attribute_id']])){
                        $arr_attribute[$arr['attribute_group_id']][$arr['attribute_id']]['value'] = current($has_attribute[$arr['attribute_group_id']][$arr['attribute_id']]);
                    }else{
                        $arr_attribute[$arr['attribute_group_id']][$arr['attribute_id']]['value'] = '';
                    }
            
                }
            }
        }
        
        $this->assign('goods_attribute', $arr_attribute);
        
        // 获取所有的参数组
        $arr_attribute_group = GoodsApi::getAttributeGroup();
        $this->assign('arr_attribute_group', $arr_attribute_group);
    
        
    
    
        // 当前分类的规格
        $option_ids = CategoryModel::where('id',$result['cat_id'])->value('option_ids');
        $arr_option = [];
        $has_option = [];
        $has_image = [];
        if($option_ids){
            $arr_option = OptionModel::where('langid', LANG)->where('option_id','IN',$option_ids)->order('sort','asc')->select();
            $merge_option = GoodsSkuModel::where('good_id',$good_id)->field('GROUP_CONCAT(merge_option_value_id) as merge')->find()->toArray();
            if($merge_option!==null){
                $has_option = explode(',',$merge_option['merge']);
            }
            $has_image = GoodsSkuImage::where('good_id',$good_id)->column('image','option_value_id');
        }
        $this->assign('arr_option', $arr_option);
        $this->assign('has_option',$has_option);
        $this->assign('has_image',$has_image);
        
    
    
        // sku
        $arr_sku = GoodsApi::getGoodsSku($good_id);
        $this->assign('arr_sku', $arr_sku);
        if ($arr_sku) {
            $arr_sku_option = GoodsApi::getGoodsSkuOption($good_id);
    
            if (!empty($arr_sku_option)) {
                $this->assign('arr_one_sku', $arr_sku_option[$arr_sku[0]['merge_option_value_id']]);
                $this->assign('arr_sku_option', $arr_sku_option);
            } else {
                $this->assign('arr_one_sku', []);
                $this->assign('arr_sku_option', []);
            }
        } else {
            $this->assign('arr_one_sku', []);
            $this->assign('arr_sku_option', []);
        }
    
    
        // sku quantity
        $seller_warehouse = GoodsApi::getSellerWarehouse($result['seller_id']);
        $this->assign('seller_warehouse', $seller_warehouse);
        if ($seller_warehouse) {
            $arr_warehouse = [];
            $crossware = CrosswareModel::all();
            if ($crossware !== null) {
                foreach ($crossware as $arr) {
                    $arr_warehouse[$arr['code']] = $arr['name'];
                }
            }
            $this->assign('arr_warehouse', $arr_warehouse);
            $arr_sku_quantity = [];
            $goods_sku_quantity = GoodsApi::getGoodsSkuQuantity($good_id);
            foreach ($goods_sku_quantity as $arr) {
                $arr_sku_quantity[$arr['sku']][$arr['crossware_code']] =
                    array(
                        'quantity' => $arr['crossware_sku_quantity'],
                        'offline_quantity' => $arr['crossware_sku_offline_quantity']
                    );
                
            }
            $this->assign('arr_sku_quantity', $arr_sku_quantity);
        } else {
            $arr_sku_quantity = GoodsSkuModel::where('good_id', $good_id)->column('quantity,offline_quantity', 'sku');
            $this->assign('arr_sku_quantity', $arr_sku_quantity);
        }
        
        // 商品图片
        $arr_image = GoodsImage::where('good_id', $good_id)->order('sort','ASC')->column('image','sort');
        $this->assign('arr_image', $arr_image);
        $image_list = '';
        if ($result['thumb']) {
            $image_list .= $result['thumb'];
            if (!empty($arr_image)) {
                foreach ($arr_image as $arr) {
                    $image_list .= ',' . $arr;
                }
            }
        }
        $this->assign('image_list', $image_list);
        
        // 冻结库存数量
        $map = [
            'good_id' => $good_id
        ];
        $blocked_quantity = GoodsBlockedStockModel::where($map)->sum('quantity');
        $this->assign('blocked_quantity',$blocked_quantity);
        
        
        $this->assign('langid', LANG);
        return $this->fetch();
    }
    
    /**
     * @Mark: 获取参数
     * @return \think\response\Json
     * @Author: WangHuaLong
     */
    public function getAttribute()
    {
        $attribute_group_id = $this->request->post('attribute_group_id');
        $result = GoodsApi::getAttribute($attribute_group_id);
        $arr_attribute = [];
        if($result!==null){
            foreach($result as $key => $arr){
                $arr_attribute[$key] = $arr;
                // 获取参数值
                if($arr['attribute_value']){
                    $attribute_options = explode(',',$arr['attribute_value']);
                }else{
                    $attribute_options = false;
                }
                $arr_attribute[$key]['option'] = $attribute_options;
            }
        }
        
        
        return json($arr_attribute);
    }
    
    /**
     * @Mark: 获取选项，选项值
     * @return string|\think\response\Json
     * @Author: WangHuaLong
     */
    public function getOptionAll()
    {
        $all = [];
        $option_id = $this->request->post('option_id');
        $result = GoodsApi::getOption($option_id);
        
        if (!$result) {
            return '';
        } else {
            $all['name'] = $result['name'];
        }
        
        $result = GoodsApi::getOptionValues($option_id);
        
        if (!$result) {
            return '';
        } else {
            $option_values = $result;
        }
        $arr_div = '';
        foreach ($option_values as $arr) {
            $arr_div .= "<option value='{$arr['option_value_id']}'>" . $arr['name'] . "</option>";
        }
        $all['option'] = $arr_div;
        
        return json($all);
    }
    
    /**
     * @Mark: 返回商品分类
     * @return \think\response\Json
     * @Author: WangHuaLong
     */
    public function getCategories()
    {
        $pid = $this->request->post('pid');
        if ($pid == 0) {
            return '';
        }
        $category = GoodsApi::getCategories($pid);
        return json($category);
    }
    
    /**
     * @Mark: 商品回收站
     * @return mixed
     * @Author: WangHuaLong
     */
    public function recycle()
    {
        /**
         * 商品多列显示 [未完成]
         * config('default_display_column'); 默认配置显示列
         * cookie('now_display_column'); 当前用户选择列，存储在cookie
         */
        $goods_column = array('*');
        $goods_description_column = array();
        $display_column = array_merge($goods_column, $goods_description_column);
    
        // 排序
        if (input('?_field') && input('?_order')) {
            $order_bys = array(
                input('_field') => input('_order')
            );
        } else {
            $order_bys = array(
                'update_time' => 'desc'
            );
        }
    
        // where 索搜条件 name 商品名称, quantity 商品库存 , status 商品状态
        $map = [];
    
        if (input('?name')) {
            $map['sub_title|good_code|name|id'] = array('like', '%' . (string)input('name') . '%');
        }
        
        $map['status'] = array('=', 'recycle');
        
        $map['langid'] = LANG;
    
        // 搜索url
        $arr_url = input();
        unset($arr_url['page']);
        if (input('?name') && input('name') != '') {
            unset($arr_url['name']);
        }
        if (input('?min_price') && input('min_price') != '') {
            unset($arr_url['min_price']);
        }
        if (input('?max_price') && input('max_price') != '') {
            unset($arr_url['max_price']);
        }
        $search_url = url('recycle', $arr_url);
        $this->assign('search_url', $search_url);
    
    
        // 分页显示,叠加搜索条件
        if (config("default_list_rows")) {
            $paginate_list_rows = config("default_list_rows");
        } else {
            $paginate_list_rows = 20;
        }
    
        $filter_data = array(
            'where' => $map,
            'order' => $order_bys,
            'field' => $display_column,
            'paginate' => $paginate_list_rows,
        );
        // 获取商品列表
        $list = GoodsApi::getGoods($filter_data);
        $this->assign('list', $list);
    
        // 搜索结果总数
        $search_total = GoodsApi::getTotalSearch($filter_data);
        $this->assign('search_total', $search_total);
    
        // 获取最低库存量
        $low_stock_quantity = config("default_stockwarming");
        $this->assign('low_stock_quantity', $low_stock_quantity);
        if (input('?quantity')) {
            $low_stock = $search_total;
        } else {
            $filter_data_quantity = $filter_data;
            $filter_data_quantity['where']['quantity'] = array('<=', (int)$low_stock_quantity);
            $low_stock = GoodsApi::getTotalSearch($filter_data_quantity);
        }
        $this->assign('low_stock', $low_stock);
    
        // 商品总数
        $filter_data_total = array(
            'where' => ['status' => 'recycle', 'langid' => LANG],
        );
        $this->assign('total', GoodsApi::getTotalSearch($filter_data_total));
        $this->assign('meta_title', lang('Bbcggoods'));
    
        // 分类
        $arr_category = CategoryModel::where('langid',LANG)->column('title','id');
        $this->assign('arr_category',$arr_category);
    
        // 店铺
        $arr_store = StoreModel::where('langid',LANG)->column('seller_name','seller_id');
        $this->assign('arr_store',$arr_store);
    
        // 去除page
        $arr_url = input();
        unset($arr_url['page']);
        $this->assign('without_page',$arr_url);
    
        // 调用商品列表模板
        return $this->fetch();
    }
    
    /**
     * @Mark: 还原商品，批量还原商品
     * @return bool|object|\think\response\Json
     * @Author: WangHuaLong
     */
    public function restore()
    {
        $result = false;
        if (input('post.ids/a')) {
            foreach (input('post.ids/a') as $value) {
                $data = array(
                    'id' => (int)$value,
                    'status' => 'pending'
                );
                $result = GoodsApi::changeGoodStatus($data);
            }
        } else {
            if (input('?param.ids')) {
                $data = array(
                    'id' => (int)input('param.ids'),
                    'status' => 'pending'
                );
                $result = GoodsApi::changeGoodStatus($data);
            } else {
                $this->error(lang('restore_error'), url('recycle'));
            }
        }
        
        if ($result['code']) {
            if (input('post.ids/a')) {
                action_log('restore', $this->conDb, implode(',', input('post.ids/a')), UID);
            } else {
                action_log('restore', $this->conDb, input('ids'), UID);
            }
            $this->success(lang('restore_ok'), url('recycle'));
        } else {
            return $result;
        }
        
    }
    
    /**
     * @Mark: 回收站删除，批量删除
     * @return bool|object|\think\response\Json
     * @Author: WangHuaLong
     */
    public function recycle_delete(){
        $result = false;
        if (input('post.ids/a')) {
            foreach (input('post.ids/a') as $value) {
                $data = array(
                    'id' => (int)$value
                );
                $result = GoodsApi::recycleDelete($data);
            }
        } else {
            if (input('?param.ids')) {
                $data = array(
                    'id' => (int)input('param.ids')
                );
                $result = GoodsApi::recycleDelete($data);
            } else {
                $this->error(lang('recycle_delete_error'), url('recycle'));
            }
        }
    
        if ($result['code']) {
            if (input('post.ids/a')) {
                action_log('recycle_delete', $this->conDb, implode(',', input('post.ids/a')), UID);
            } else {
                action_log('recycle_delete', $this->conDb, input('ids'), UID);
            }
            $this->success(lang('recycle_delete_ok'), url('recycle'));
        } else {
            return $result;
        }
    }
    
    /**
     * @Mark: 保存商品数据
     * @return \think\response\Json|void
     * @Author: WangHuaLong
     */
    public function savedata()
    {
        $post_data = $this->request->post();
        
        // 商品图片
        $images = $post_data['image_list'];
        if ($images != '') {
            $arr_image = explode(',', $images);
            // 添加商品排序
            if(isset($post_data['image_list_sort'])){
                $arr_sort = $post_data['image_list_sort'];
                $arr_middle = [];
                foreach($arr_image as $key => $value){
                    if(isset($arr_sort[$key])){
                        // 判断是否有重复的键值，重复值垫后
                        if(isset($arr_middle[$arr_sort[$key]])){
                            $arr_middle[] = $value;
                        }else{
                            $arr_middle[$arr_sort[$key]] = $value;
                        }
                        
                    }else{
                        if(isset($arr_middle[$key])){
                            $arr_middle[] = $value;
                        }else{
                            $arr_middle[$key] = $value;
                        }
                        
                    }
                }
                $arr_image = $arr_middle;
                unset($arr_middle);
                unset($arr_sort);
            }
            
            if(isset($post_data['selected_thumb'])){
                if(substr($post_data['selected_thumb'],0,4)=='http'){
                    $post_data['thumb'] = $post_data['selected_thumb'];
                    
                }elseif(substr($post_data['selected_thumb'],0,9) == '/uploads/'){
                    $post_data['thumb'] = substr($post_data['selected_thumb'],9);
                    
                }
            }else{
                // 获取第一张图片当主图
                $post_data['thumb'] = current($arr_image);
            }
            
    
            if(count($arr_image) > 1) {
                $key = array_search($post_data['thumb'], $arr_image);
                if ($key !== false) {
                    unset($arr_image[$key]);
                    $post_data['images'] = $arr_image;
                }
            }
            
        }
        
        
        // 状态提交使用的样式，未提交表示状态为0
        if (!isset($post_data['pc_status'])) {
            $post_data['pc_status'] = 0;
        }
        if (!isset($post_data['wap_status'])) {
            $post_data['wap_status'] = 0;
        }
        if (!isset($post_data['api_status'])) {
            $post_data['api_status'] = 0;
        }
        if (!isset($post_data['shipping'])) {
            $post_data['shipping'] = 0;
        }
    
        // 海关计量单位，包装单位
        $arr_package_units = config('default_package_unit');
        $post_data['package_unit'] = $arr_package_units[$post_data['hs_unit']];
        
        if (isset($post_data['id'])) {
            $result = GoodsApi::edit($post_data);
            if ($result['code']) {
                action_log('edit_goods','goods',$post_data['id'],UID);
                $this->success(lang('Editok'), $this->jumpUrl);
            } else {
                return $result;
            }
        } else {
            $result = GoodsApi::add($post_data);
            if ($result['code']) {
                $this->success(lang('Editok'), $this->jumpUrl);
            } else {
                return $result;
            }
        }
    }
    
    /**
     * @Mark: 新增商品页面
     * @return mixed
     * @Author: WangHuaLong
     */
    public function add()
    {
        $this->assign("action_name", 'add');
        $this->assign("meta_title", lang('Add'));
        $this->assign('data', null);
        
        // 商品状态
        $this->assign("arr_status", config('default_good_status'));
        $this->assign('default_good_status_id', config('default_good_status_id'));
        
        // 税收
        $this->assign('arr_taxs', config('default_tax_class'));
        $this->assign('default_tax_class_id', config('default_tax_class_id'));
    
        // 服务承诺
        $this->assign('arr_promise',config('default_good_service'));
        $this->assign('promise',[]);
        
        // 重量单位，包装件数
        $this->assign('arr_weights', config('default_weight_class'));
        $this->assign('arr_package_units', config('default_package_unit'));
        
        
        // 商品类型
        $this->assign('arr_types', config('default_good_types'));
        
        // 国家
        $arr_country = GoodsApi::getCountries();
        $this->assign('arr_country', $arr_country);
        
        
        // 商品品牌
        $arr_brands = GoodsApi::getBrands();
        $this->assign('arr_brands', $arr_brands);
        
        // 商户
        $seller = GoodsApi::getSellers();
        $this->assign('arr_seller', $seller);
        
        // 商品分类
        $category = GoodsApi::getCategories(0);
        $this->assign('arr_category', $category);
        $this->assign('now_category_name', lang('Null'));
        
        
        // 产品参数
        $this->assign('goods_attribute', []);
        $arr_attribute_group = GoodsApi::getAttributeGroup();
        $this->assign('arr_attribute_group', $arr_attribute_group);
        
        // 商品选项
        $this->assign('arr_option', []);
        $this->assign('has_option',[]);
        $this->assign('has_image',[]);
        
        // sku
        $arr_sku = array(
            0 => [
                'sku' => '',
                'good_id' => '',
                'merge_option_value_id' => '',
                'name' => '',
                'good_batch' => '',
                'quantity' => 0,
                'offline_quantity' => 0,
                'market_price' => 0,
                'sale_price' => 0,
                'cost_price' => 0,
                'good_barcode' => '',
                'hs_record' => '',
                'hs_national_record' => '',
            ]
        );
        $this->assign('arr_sku', $arr_sku);
        $this->assign('arr_one_sku', []);
        $this->assign('arr_sku_option', []);
        
        // 商品图片
        $this->assign('arr_image', []);
        $this->assign('image_list', '');
        
        
        $this->assign('langid', LANG);
        return $this->fetch('edit');
    }
    
    /**
     * @Mark: 编辑sku仓库库存
     * @return mixed
     * @Author: WangHuaLong
     */
    public function editSkuQuantity()
    {
        
        $good_id = input('?ids') ? input('ids/d') : $this->error(lang('Error_id'));
        $result = GoodsModel::get($good_id);
        if ($result === null) {
            $this->error(lang('Error_id'));
        }
        $this->assign('data', $result);
        
        // sku
        $arr_sku = GoodsApi::getGoodsSku($good_id);
        $this->assign('arr_sku', $arr_sku);
        if ($arr_sku) {
            $arr_sku_option = GoodsApi::getGoodsSkuOption($good_id);
            if (!empty($arr_sku_option)) {
                $this->assign('arr_one_sku', $arr_sku_option[$arr_sku[0]['merge_option_value_id']]);
                $this->assign('arr_sku_option', $arr_sku_option);
            } else {
                $this->assign('arr_one_sku', []);
                $this->assign('arr_sku_option', []);
            }
        } else {
            $this->assign('arr_one_sku', []);
            $this->assign('arr_sku_option', []);
        }
        
        // sku quantity
        $seller_warehouse = GoodsApi::getSellerWarehouse($result['seller_id']);
        $this->assign('seller_warehouse', $seller_warehouse);
    
        // 判断商户是否有仓库
        if ($seller_warehouse) {
            $arr_warehouse = [];
            $crossware = CrosswareModel::all();
            if ($crossware !== null) {
                foreach ($crossware as $arr) {
                    $arr_warehouse[$arr['code']] = $arr['name'];
                }
            }
            $this->assign('arr_warehouse', $arr_warehouse);
            $arr_sku_quantity = [];
            $goods_sku_quantity = GoodsApi::getGoodsSkuQuantity($good_id);
            if($goods_sku_quantity!==null){
                foreach ($goods_sku_quantity as $arr) {
                    $arr_sku_quantity[$arr['sku']][$arr['crossware_code']] =
                        array(
                            'quantity' => $arr['crossware_sku_quantity'],
                            'offline_quantity' => $arr['crossware_sku_offline_quantity']
                        );
        
                }
            }
            
            $this->assign('arr_sku_quantity', $arr_sku_quantity);
        } else {
            $arr_sku_quantity = GoodsSkuModel::where('good_id', $good_id)->column('quantity,offline_quantity', 'sku');
            $this->assign('arr_sku_quantity', $arr_sku_quantity);
        }
        
    
    
        return $this->fetch('edit_sku_quantity');
    }
    
    /**
     * @Mark: 保存sku仓库库存
     * @return bool|void
     * @Author: WangHuaLong
     */
    public function saveSkuQuantity()
    {
        
        $post_data = $this->request->post();
        
        if (isset($post_data['id'])) {
            $result = GoodsApi::editSkuQuantity($post_data);
            if ($result['code']) {
                $this->success(lang('Editok'), $this->jumpUrl);
            } else {
                return $result;
            }
        } else {
            $this->error(lang('Error_id'));
        }
    }
    
    /**
     * @Mark: 获取分类的参数组id
     * @return mixed
     * @Author: WangHuaLong
     */
    public function getCategoryAttributeGroupIds(){
        $cat_id = input('cat_id');
        $result = false;
        if($cat_id!=0) {
            $attribute_group_ids = CategoryModel::where('id', $cat_id)->value('attribute_group_ids');
            if ($attribute_group_ids) {
                $result = explode(',', $attribute_group_ids);
            }
        }
        return $result;
    }
    
    /**
     * @Mark: 获取分类的规格id
     * @return mixed
     * @Author: WangHuaLong
     */
    public function getCategoryOptionIds(){
        $cat_id = input('cat_id');
        $result = false;
        if($cat_id!=0) {
            $option_ids = CategoryModel::where('id', $cat_id)->value('option_ids');
            if ($option_ids) {
                $arr_option = OptionModel::where('langid', LANG)->where('option_id','IN',$option_ids)->order('sort','asc')->select();
                if($arr_option!==null){
                    $result = [];
                    foreach($arr_option as $key => $arr){
                        $result[$key] = $arr;
                        $result[$key]['option_value'] = $arr['option_value'];
                    }
                }
            }
        }
        return $result;
    }

}
