<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Goods.php  Version 商品 2017/6/7
// +----------------------------------------------------------------------

namespace app\seller\controller;

use app\crossbbcg\service\Goods as GoodsApi;
use app\crossbbcg\model\Goods as GoodsModel;
use app\crossbbcg\model\GoodsSku as GoodsSkuModel;
use app\crossbbcg\service\Category;
use app\bcwareexp\model\Crossware as CrosswareModel;
use app\crossbbcg\model\Category as CategoryModel;
use app\crossbbcg\model\Option as OptionModel;
use think\Session;
use app\crossbbcg\model\GoodsImage;
use app\crossbbcg\model\Attribute as AttributeModel;
use app\seller\model\Store as StoreModel;

class Goods extends Common
{
    public $stockwarming;
    
    /**
     * @Mark:经营类目ID(包含一二三级ID,用于筛选当前商户允许添加的商品分类)
     * @Author: 502204678 <50220478@qq.com>
     * @time 2017/9/26
     */
    private $goods_cat = [];
    private $arr_package_units = [];
    
    public function _initialize()
    {
        parent::_initialize();
        $crossbbcg_setting = APP_PATH . 'crossbbcg/config.php';
        $config            = is_file($crossbbcg_setting) ? include $crossbbcg_setting : null;
        //库存预警数量
        $stockwarming = StoreModel::where(['seller_id'=>SellerId])->value('warning_quantity');
        $this->assign('stockwarming', $stockwarming);
        $this->stockwarming = $stockwarming;
        // 商品状态
        $this->assign("arr_status", $config['default_good_status']);
        $this->assign('default_good_status_id', $config['default_good_status_id']);
        // 商品分类
        $goods_cat = \app\seller\model\Store::get(Session::get('shop_id'));
        //剔除审核中以及未通过的分类ID
        $new_cat = [];
        foreach ((array)$goods_cat['goods_cat'] as $k=>$v) {
            if ($v == 1) {
                $new_cat[] = $k;
            }
        }
        //获取顶级分类ID
        $top = \app\crossbbcg\model\CategoryPath::where(['category_id'=>['in',$new_cat],'level'=>0])->column('path_id');
        $parent = \app\crossbbcg\model\CategoryPath::where(['category_id'=>['in',$new_cat],'level'=>1])->column('path_id');
        $this->goods_cat = array_merge($new_cat,$parent,$top);
        
        $category = CategoryModel::where(['id'=>['in',$top]])->select();
        $this->assign('arr_category', $category);
        
        // 商品类型
        $this->assign('arr_types', $config['default_good_types']);
        
        //所有分类列表
        $category_list = Category::getCategories();
        $this->assign('category_list', $category_list);
        
        // 税收
        $arr_taxs = $config['default_tax_class'];
        $this->assign('arr_taxs', $arr_taxs);
        $this->assign('default_tax_class_id', $config['default_tax_class_id']);
        // 包装单位
        $this->arr_package_units = $config['default_package_unit'];
        $this->assign('arr_package_units', $config['default_package_unit']);
        //重量单位
        $arr_weights = ['kg', 'g'];
        $this->assign('arr_weights', $arr_weights);
        // 国家
        $arr_country = GoodsApi::getCountries();
        $this->assign('arr_country', $arr_country);
        // 商品品牌
        $arr_brands = GoodsApi::getBrands();
        $this->assign('arr_brands', $arr_brands);
        // 产品参数
        $arr_attribute_group = GoodsApi::getAttributeGroup();
        $this->assign('arr_attribute_group', $arr_attribute_group);
        // 商品选项
        $arr_option = GoodsApi::getOptions();
        $this->assign('arr_option', $arr_option);
        // 服务承诺
        $this->assign('arr_promise', $config['default_good_service']);
        $this->assign('promise', []);
        
        //仓库列表
        $housecode = \app\seller\model\Account::get(SellerId);
        $warehouse = \app\bcwareexp\model\Crossware::where(['code' => ['in', $housecode['housecode']]])->column('name', 'code');
        $this->assign('warehouse', $warehouse);
    }
    
    /**
     * @Mark:商品列表
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/7
     */
    public function index()
    {
        $param = $this->request->param();
        $where = [
            'where'    => ['seller_id' => SellerId, 'status' => ['<>', 'recycle']],
            'lang'     => $this->lang,
            'order'    => ['id desc'],
            'paginate' => 15,
            'field'    => ['id', 'thumb', 'name', 'good_code', 'sale_price', 'quantity', 'status', 'pc_status', 'wap_status', 'api_status', 'sort', 'cat_id', 'type']
        ];
        //商品筛选
        $cat_id    = isset($param['cat_id']) ? $param['cat_id'] : '';
        $brand_id    = isset($param['brand_id']) ? $param['brand_id'] : '';
        $status    = isset($param['status']) ? $param['status'] : '';
        $mix_price = isset($param['mix_price']) ? $param['mix_price'] : '';
        $max_price = isset($param['max_price']) ? $param['max_price'] : '';
        $key_words = isset($param['key_words']) ? $param['key_words'] : '';
        $condition  = isset($param['condition'])  ? $param['condition'] : '';
        
        if ($cat_id && $cat_id <> 'all') $where['category_id']      = (int)$cat_id;
        if ($brand_id && $brand_id <> 'all') $where['where']['brand_id']      = (int)$brand_id;
        if ($status && $status <> 'all') $where['where']['status']  = $status;
        if ($mix_price) $where['where']['sale_price']       = $mix_price;
        if ($max_price) $where['where']['sale_price']       = $max_price;
        if ($key_words && $condition) $where['where'][$param['condition']]        = ['like', '%' . $key_words . '%'];
        
        //if ($quantity) {
        //    $where['where']['quantity'] = ['<=', $quantity];
        //    $where['order']             = [$param['_field'] . ' ' . $param['_order']];
        //}
        // 分类
        $arr_category = CategoryModel::where('langid', LANG)->column('title', 'id');
        $this->assign('arr_category', $arr_category);
        $this->assign("catlist", sortdata(CategoryModel::all()));
        
        $data = GoodsApi::getGoods($where);
        //预警库存量
        $stockwarming_num = GoodsModel::where(['seller_id' => SellerId, 'status' => ['<>', 'recycle'], 'quantity' => ['<=', $this->stockwarming]])->count();
        $this->assign('stockwarming_num', $stockwarming_num);
        $this->assign('cat_id', $cat_id);
        $this->assign('brand_id', $brand_id);
        $this->assign('status', $status);
        $this->assign('key_words', $key_words);
        $this->assign('condition', isset($param['condition']) ? $param['condition'] : '');
        $this->assign('list', $data);
        $this->assign('meta_title', lang('GoodsList'));
        return $this->fetch();
    }
    
    /**
     * @Mark:添加商品
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/7
     */
    public function add()
    {
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
        $this->assign('data', null);
        return $this->fetch('edit');
    }
    
    /**
     * @Mark:商品编辑
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/8
     */
    public function edit()
    {
        $this->assign("action_name", 'edit');
        $this->assign("meta_title", lang('Edit'));
        
        $good_id = $this->request->has('id') ? $this->request->param('id') : $this->error(lang('Error_id'));
        $result  = GoodsModel::where(['id'=>$good_id,'seller_id'=>SellerId])->find();
        if ($result) {
            $result = $result->toArray();
        } else {
            $this->error(lang('Error_id'));
        }
        $this->assign("data", $result);
        
        //服务承诺
        if ($result['promise'] != '') {
            $promise = explode(',', $result['promise']);
        } else {
            $promise = [];
        }
        $this->assign('promise', $promise);
        
        // 产品参数
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
    
        $this->assign('goods_attribute', $arr_attribute);//dump($arr_attribute);exit();
        
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
        
        //sku库存
        $seller_warehouse = GoodsApi::getSellerWarehouse($result['seller_id']);
        $this->assign('seller_warehouse', $seller_warehouse);
        $arr_warehouse = [];
        $crossware     = CrosswareModel::all();
        if ($crossware !== null) {
            foreach ($crossware as $arr) {
                $arr_warehouse[$arr['code']] = $arr['name'];
            }
        }
        $this->assign('arr_warehouse', $arr_warehouse);
        $arr_sku_quantity   = [];
        $goods_sku_quantity = GoodsApi::getGoodsSkuQuantity($good_id);
        foreach ($goods_sku_quantity as $arr) {
            $arr_sku_quantity[$arr['sku']][$arr['crossware_code']] =
                array(
                    'quantity'         => $arr['crossware_sku_quantity'],
                    'offline_quantity' => $arr['crossware_sku_offline_quantity']
                );
            
        }
        $this->assign('arr_sku_quantity', $arr_sku_quantity);
    
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
        return $this->fetch();
    }
    
    
    /**
     * @Mark:商品入库
     * @return bool
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/22
     */
    public function save()
    {
        $data              = $this->request->post();
        $data['seller_id'] = SellerId;
        $data['langid']    = Session::get('langid');
        // 商品图片
        $images = $data['image_list'];
        if ($images != '') {
            $arr_image = explode(',', $images);
            // 添加商品排序
            if(isset($data['image_list_sort'])){
                $arr_sort = $data['image_list_sort'];
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
           
            if(isset($data['selected_thumb'])){
                dump(123);exit();
                if(substr($data['selected_thumb'],0,4)=='http'){
                    $data['thumb'] = $data['selected_thumb'];
                
                }elseif(substr($data['selected_thumb'],0,9) == '/uploads/'){
                    $data['thumb'] = substr($data['selected_thumb'],9);
                }
            }else{
                // 获取第一张图片当主图
               
                $data['thumb'] = current($arr_image);
            }
        
        
            if(count($arr_image) > 1) {
                $key = array_search($data['thumb'], $arr_image);
                if ($key !== false) {
                    unset($arr_image[$key]);
                    $data['images'] = $arr_image;
                }
            }
        
        }
        // 海关计量单位，包装单位
        $arr_package_units = $this->arr_package_units;
        $data['package_unit'] = $arr_package_units[$data['hs_unit']];
        if (isset($data['id'])) {
            
            $result = GoodsApi::edit($data);
            if ($result['code'] == 1) {
                $log_info = '修改商品，商品id:' . $data['id'] . '。操作人:' . Session::get('sellername');
                seller_log(SellerId, Session::get('userid'), $log_info);
                $this->success(lang('edit_ok'), 'index');
            } else {
                return json($result);
            }
        } else {
            $re = GoodsApi::add($data);
            if ($re['code'] == 1) {
                $log_info = '添加商品，商品名称:' . $data['name'] . '。操作人:' . Session::get('sellername');
                seller_log(SellerId, Session::get('userid'), $log_info);
                $this->success(lang('add_success'), 'seller/goods/index');
            } else {
                return json($re);
            }
        }
        
    }
    
    /**
     * @Mark:修改排序
     * @return $this
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/22
     */
    public function edit_goods_sort()
    {
        $data = input('param.');
        $re   = GoodsModel::where(['id' => $data['id']])->update(['sort' => $data['sort']]);
        if ($re !== false) {
            $this->success(lang('success'));
        } else {
            $this->error(lang('fail'));
        }
    }
    
    /**
     * @Mark:软删除商品
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/22
     */
    public function del_goods()
    {
        $ids  = $this->request->param();
        $data = array(
            'id'     => (array)$ids['ids'],
            'status' => 'recycle'
        );
        GoodsModel::where(['id' => ['in',$data['id']]])->update(['status' => $data['status']]);
        $log_info = '删除商品，商品id:' . implode($data['id']) . '。操作人:' . Session::get('sellername');
        seller_log(SellerId, Session::get('userid'), $log_info);
        $this->success(lang('del_success'), 'index');
    }
    
    /**
     * @Mark:商品回收站列表
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/8
     */
    public function recycle_list()
    {
        $where = [
            'where'    => ['seller_id' => session('sellerId'), 'status' => 'recycle'],
            'lang'     => $this->lang,
            'order'    => ['sort desc'],
            'paginate' => 15,
            'field'    => ['id', 'thumb', 'name', 'good_code', 'sale_price', 'quantity', 'status', 'pc_status', 'wap_status', 'api_status', 'sort']
        ];
        //商品筛选
        if (input('cat_id') && input('cat_id') <> 'all') $where['where']['cat_id'] = (int)input('cat_id');
        
        if (input('status') && input('status') <> 'all') $where['where']['status'] = input('status');
        
        if (input('key_words')) $where['where'][input('condition')] = array('like', '%' . input('key_words') . '%');
        
        $data = GoodsApi::getGoods($where);
        $this->assign('cat_id', input('cat_id') ? input('cat_id') : '');
        $this->assign('status', input('status') ? input('status') : '');
        $this->assign('key_words', input('key_words') ? input('key_words') : '');
        $this->assign('condition', input('condition') ? input('condition') : '');
        $this->assign('list', $data);
        return $this->fetch();
    }
    
    /**
     * @Mark:回收站彻底删除商品
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/8
     */
    public function recycle_del()
    {
        $id = (int)input('id');
        $re = GoodsModel::destroy($id);
        if ($re) {
            $log_info = '彻底删除商品，商品id:' . $id . '。操作人:' . session('sellername');
            seller_log(session('sellerId'), session('userid'), $log_info);
            $this->success(lang('success'), 'recycle_list');
        } else {
            $this->error(lang('fail'));
        }
    }
    
    /**
     * @Mark:回收站商品恢复
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/8
     */
    public function recycle_recover()
    {
        $data   = array(
            'id'     => (int)input('ids'),
            'status' => 'enable'
        );
        $result = GoodsModel::where(['id' => $data['id']])->update(['status' => $data['status']]);
        if ($result === true) {
            $this->success(lang('Deleteok'), 'index');
        } else {
            $this->error($result, 'recycle_list');
        }
    }
    
    /**
     * @Mark:修改sku商品仓库库存
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/11
     */
    public function edit_sku_quantity()
    {
        $good_id = $this->request->param('id');
        if (!$good_id) $this->error(lang('Error_id'));
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
        $result             = GoodsApi::getAttribute($attribute_group_id);
        $arr_attribute      = [];
        if ($result !== null) {
            foreach ($result as $key => $arr) {
                $arr_attribute[$key] = $arr;
                // 获取参数值
                if ($arr['attribute_value']) {
                    $attribute_options = explode(',', $arr['attribute_value']);
                } else {
                    $attribute_options = false;
                }
                $arr_attribute[$key]['option'] = $attribute_options;
            }
        }
        
        
        return json($arr_attribute);
    }
    
    /**
     * @Mark:保存sku仓库库存
     * @return bool
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/20
     */
    public function save_sku_quantity()
    {
        $data = $this->request->param();
        $re   = GoodsApi::editSkuQuantity($data);
        if ($re['code'] == 1) {
            $log_info = '修改sku库存，商品id:' . $data['id'] . '。操作人:' . Session::get('sellername');
            seller_log(SellerId, Session::get('userid'), $log_info);
            $this->success(lang('success'), 'index');
        } else {
            return json($re);
        }
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
        if($this->request->has('all')){
            $category = GoodsApi::getCategories($pid);
        } else {
            $category = CategoryModel::all(['id'=>['in',$this->goods_cat],'pid'=>$pid]);
        }
        return json($category);
    }
    
    /**
     * @Mark: 获取分类的参数组id
     * @return mixed
     * @Author: WangHuaLong
     */
    public function getCategoryAttributeGroupIds()
    {
        $cat_id = $this->request->param('cat_id');
        $result = false;
        if ($cat_id != 0) {
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
    public function getCategoryOptionIds()
    {
        $cat_id = $this->request->param('cat_id');
        $result = false;
        if ($cat_id != 0) {
            $option_ids = CategoryModel::where('id', $cat_id)->value('option_ids');
            if ($option_ids) {
                $arr_option = OptionModel::where('langid', LANG)->where('option_id', 'IN', $option_ids)->order('sort', 'asc')->select();
                if ($arr_option !== null) {
                    $result = [];
                    foreach ($arr_option as $key => $arr) {
                        $result[$key]                 = $arr;
                        $result[$key]['option_value'] = $arr['option_value'];
                    }
                }
            }
        }
        return $result;
    }
    
    /**
     * @Mark:商品库存预警列表
     * @Author: yang <502204678@qq.com>
     * @Version 2017/9/18
     */
    public function stockwarming()
    {
        $param = $this->request->param();
        $where = [
            'where'    => ['seller_id' => SellerId, 'status' => ['<>', 'recycle'], 'quantity' => ['<=', $this->stockwarming]],
            'lang'     => $this->lang,
            'order'    => ['sort desc'],
            'paginate' => 15,
            'field'    => ['id', 'thumb', 'name', 'good_code', 'sale_price', 'quantity', 'status', 'pc_status', 'wap_status', 'api_status', 'sort', 'cat_id', 'type']
        ];
        ///商品筛选
        $cat_id    = isset($param['cat_id']) ? $param['cat_id'] : '';
        $brand_id    = isset($param['brand_id']) ? $param['brand_id'] : '';
        $status    = isset($param['status']) ? $param['status'] : '';
        $mix_price = isset($param['mix_price']) ? $param['mix_price'] : '';
        $max_price = isset($param['max_price']) ? $param['max_price'] : '';
        $key_words = isset($param['key_words']) ? $param['key_words'] : '';
        //$quantity  = isset($param['quantity'])  ? $param['quantity'] : '';
    
        if ($cat_id && $cat_id <> 'all') $where['category_id']      = (int)$cat_id;
        if ($brand_id && $brand_id <> 'all') $where['where']['brand_id']      = (int)$brand_id;
        if ($status && $status <> 'all') $where['where']['status']  = $status;
        if (!empty($mix_price)) $where['where']['sale_price']       = $mix_price;
        if (!empty($max_price)) $where['where']['sale_price']       = $max_price;
        if ($key_words) $where['where'][$param['condition']]        = ['like', '%' . $key_words . '%'];
        // 分类
        $arr_category = CategoryModel::where('langid', LANG)->column('title', 'id');
        $this->assign('arr_category', $arr_category);
        $this->assign("catlist", sortdata(CategoryModel::all()));
        
        $data = GoodsApi::getGoods($where);
        
        $this->assign('cat_id', $cat_id);
        $this->assign('status', $status);
        $this->assign('brand_id', $brand_id);
        $this->assign('key_words',$key_words);
        $this->assign('condition', isset($param['condition']) ? $param['condition'] : '');
        $this->assign('list', $data);
        $this->assign('meta_title', lang('GoodsStockwarming'));
        return $this->fetch();
    }
}
