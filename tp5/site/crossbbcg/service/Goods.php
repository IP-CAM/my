<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: WangHuaLong
// +----------------------------------------------------------------------
// | Goods.php  Version 2017/6/2
// +----------------------------------------------------------------------
namespace app\crossbbcg\service;

use app\crossbbcg\model\Goods as GoodsModel;
use app\crossbbcg\model\AttributeGroup;
use app\crossbbcg\model\Attribute;
use app\crossbbcg\model\GoodsAttribute;
use app\crossbbcg\model\GoodsBlockedStock;
use app\crossbbcg\model\OptionValue;
use app\crossbbcg\model\Brand as BrandModel;
use app\crossbbcg\model\Category as CategoryModel;
use app\crossbbcg\model\CategoryPath;
use app\crossbbcg\model\GoodsToCategory;
use app\crossbbcg\model\Option as OptionModel;
use app\crossbbcg\model\GoodsSku;
use app\crossbbcg\model\GoodsSkuImage;
use app\crossbbcg\model\GoodsImage;
use app\crossbbcg\model\GoodsSkuQuantity;
use app\seller\model\Store as StoreModel;
use app\seller\model\Account as SellerAccountModel;
use app\bcwareexp\model\Country as CountryModel;
use app\bcwareexp\model\Currency;


use think\Loader;

class Goods
{
    
    /**
     * @Mark: 获取商品表
     * @param $data = array(
     * 'where' => 条件 array
     * 'order' => 排序  array
     * 'field' => 输出列  array
     * 'paginate' => 分页 int
     * 'category_id' => 分类id  int
     * );
     * @return \think\Paginator
     * @Author: WangHuaLong
     */
    public static function getGoods($data)
    {
        $goods = new GoodsModel();
        return $goods->getGoods($data);
    }
    
    /**
     * @Mark: 条件查询获取商品总数
     * @param $data = array(
     *      'where' => 查询语句条件
     * );
     * @return int|string
     * @Author: WangHuaLong
     */
    public static function getTotalSearch($data)
    {
        $goods = new GoodsModel();
        return $goods->getTotalSearch($data);
    }
    
    /**
     * @Mark: 保存商品信息
     * @param $data
     * @return bool|\think\response\Json
     * @Author: WangHuaLong
     */
    public static function edit($data)
    {
        
        $good_id = $data['id'];
    
        // 国家必选，未选时自动关联中国
        if($data['country_id']==0){
            $data['country_id'] = 44;
        }
        // 服务承若
        if(isset($data['promise'])){
            $data['promise'] = implode(',',$data['promise']);
        }
        
        // 验证商品分类
        if ($data['cat_id'] == 0) {
            return ['code' => 0, 'msg' => lang('Category_Error')];
        }
        
        // 验证主表数据
        $goods_class = Loader::parseClass('crossbbcg', 'validate', 'Goods');
        $goods_validate = Loader::validate($goods_class);
        $result = $goods_validate->check($data);
        if ($result !== true) {
            return ['code' => 0, 'msg' => $goods_validate->getError()];
        }
        
        // 验证商品sku
        if (isset($data['sku'])) {
            $sku_class = Loader::parseClass('crossbbcg', 'validate', 'GoodsSku');
            $sku_validate = Loader::validate($sku_class);
            $repeat = [];
            $repeat1 = [];
            $repeat2 = [];
            foreach ($data['sku'] as $arr) {
                if(!isset($arr['merge_option_value_id'])){
                    $arr['merge_option_value_id'] = '';
                }
                if(!isset($arr['name'])){
                    $arr['name'] = '';
                }
                $merge_option_value_id = $arr['merge_option_value_id'];
                $name = $arr['name'];
                if (in_array($merge_option_value_id, $repeat)) {
                    return ['code' => 0, 'msg' => lang('Option_Value_Repeat') . $name];
                }
                $repeat[] = $merge_option_value_id;
                
                if (in_array($arr['sku'], $repeat1)) {
                    return ['code' => 0, 'msg' => lang('Option_Sku_Repeat') . $arr['sku']];
                }
                $repeat1[] = $arr['sku'];
    
                if (in_array($arr['good_barcode'], $repeat2)) {
                    return ['code' => 0, 'msg' => lang('GoodBarcode_Repeat') . $arr['good_barcode']];
                }
                $repeat2[] = $arr['good_barcode'];
                
                $arr['good_id'] = $good_id;
                $result = $sku_validate->check($arr);
                if ($result !== true) {
                    return ['code' => 0, 'msg' => $sku_validate->getError()];
                }
            }
            unset($repeat);
            unset($repeat1);
            unset($repeat2);
        } else {
            return ['code' => 0, 'msg' => lang('Sku_Not_Empty')];
        }
    
        // 计算商品市场价，促销价，成本价
        $market_price = 0;
        $sale_price = 0;
        $cost_price = 0;
        if (isset($data['sku'])) {
            $sku_row = 0;
            foreach ($data['sku'] as $key => $arr) {
                if ($sku_row == 0) {
                    $market_price = $arr['market_price'];
                    $sale_price = $arr['sale_price'];
                    $cost_price = $arr['cost_price'];
                } else {
                    if ($sale_price > $arr['sale_price']) {
                        $market_price = $arr['market_price'];
                        $sale_price = $arr['sale_price'];
                        $cost_price = $arr['cost_price'];
                    }
                }
                $sku_row++;
            }
            unset($sku_row);
        }
        $data['market_price'] = $market_price;
        $data['sale_price'] = $sale_price;
        $data['cost_price'] = $cost_price;
        
        // 库存计算
        $sku_quantity = [];
        $good_quantity = 0;
        $good_offline_quantity = 0;
        if (isset($data['sku_quantity'])) {
            foreach ($data['sku_quantity'] as $key => $arr) {
                if (isset($sku_quantity[$arr['sku']])) {
                    $sku_quantity[$arr['sku']]['quantity'] += $arr['crossware_sku_quantity'];
                    $sku_quantity[$arr['sku']]['offline_quantity'] += $arr['crossware_sku_offline_quantity'];
                } else {
                    $sku_quantity[$arr['sku']]['quantity'] = $arr['crossware_sku_quantity'];
                    $sku_quantity[$arr['sku']]['offline_quantity'] = $arr['crossware_sku_offline_quantity'];
                }
                $good_quantity += $arr['crossware_sku_quantity'];
                $good_offline_quantity += $arr['crossware_sku_offline_quantity'];
            }
        } else if (isset($data['sku_all_quantity'])) {
            $sku_quantity = $data['sku_all_quantity'];
            foreach ($sku_quantity as $arr) {
                $good_quantity += $arr['quantity'];
                $good_offline_quantity += $arr['offline_quantity'];
            }
        }
        $data['quantity'] = $good_quantity;
        $data['offline_quantity'] = $good_offline_quantity;
        
        // 保存主表信息
        $goods = GoodsModel::get($good_id);
        if (!$goods) {
            return ['code' => 0, 'msg' => lang('Error_Good_Id')];
        }
        $goods->allowField(true)->isUpdate(true)->save($data);
        if ($goods->getError() !== null) {
            return ['code' => 0, 'msg' => $goods->getError()];
        }
        
        // 保存商品分类
        if ($data['cat_id'] == 0) {
            GoodsToCategory::where('good_id', $good_id)->delete();
        } else {
            GoodsToCategory::where('good_id', $good_id)->delete();
            $category_ids = self::getPids($data['cat_id']);
            foreach ($category_ids as $value) {
                if ($value != 0) {
                    $insert_data = array(
                        'good_id' => $good_id,
                        'category_id' => $value,
                    );
                    GoodsToCategory::create($insert_data);
                }
            }
            $insert_data = array(
                'good_id' => $good_id,
                'category_id' => $data['cat_id'],
            );
            GoodsToCategory::create($insert_data);
        }
        
        // 保存产品参数，不需要验证
        GoodsAttribute::where('good_id', $good_id)->delete();
        if (isset($data['attribute'])) {
            $post_attribute = $data['attribute'];
            foreach ($post_attribute as $key => $arr) {
                foreach ($arr as $key2 => $arr2) {
                    if(is_array($arr2)){
                        foreach ($arr2 as $key3 => $arr3) {
                            $insert_data = array(
                                'good_id' => $good_id,
                                'attribute_group_id' => $key,
                                'attribute_id' => $key2,
                                'value' => $arr3
                            );
                            GoodsAttribute::create($insert_data);
                        }
                    }else{
                        $insert_data = array(
                            'good_id' => $good_id,
                            'attribute_group_id' => $key,
                            'attribute_id' => $key2,
                            'value' => $arr2
                        );
                        GoodsAttribute::create($insert_data);
                    }
                
                }
            }
        }
        
        // 保存商品选项
        GoodsSku::where('good_id', $good_id)->delete();
        if (isset($data['sku'])) {
            foreach ($data['sku'] as $arr) {
                if (!isset($arr['merge_option_value_id'])) {
                    $arr['merge_option_value_id'] = '';
                }
                if (!isset($arr['name'])) {
                    $arr['name'] = '';
                }
    
                // 排序
                if($arr['merge_option_value_id']){
                    $arr['merge_option_value_id'] = explode(',', $arr['merge_option_value_id']);
                    sort($arr['merge_option_value_id']);
                    $merge_option_value_id = implode(',', $arr['merge_option_value_id']);
                }else{
                    $merge_option_value_id = $arr['merge_option_value_id'];
                }
                $name = $arr['name'];
                
                $quantity = isset($sku_quantity[$arr['sku']]['quantity']) ? $sku_quantity[$arr['sku']]['quantity'] : 0;
                $offline_quantity = isset($sku_quantity[$arr['sku']]['offline_quantity']) ? $sku_quantity[$arr['sku']]['offline_quantity'] : 0;
                
                $insert_data = array(
                    'sku' => $arr['sku'],
                    'good_id' => $good_id,
                    'merge_option_value_id' => $merge_option_value_id,
                    'name' => $name,
                    'good_batch' => $arr['good_batch'],
                    'quantity' => $quantity,
                    'offline_quantity' => $offline_quantity,
                    'sale_price' => $arr['sale_price'],
                    'market_price' => $arr['market_price'],
                    'cost_price' => $arr['cost_price'],
                    'good_barcode' => $arr['good_barcode'],
                    'hs_record' => $arr['hs_record'],
                    'hs_national_record' => $arr['hs_national_record'],
                
                );
                GoodsSku::create($insert_data);
            }
        }
        
        
        // 保存sku，仓库库存
        GoodsSkuQuantity::where('good_id', $good_id)->delete();
        if (isset($data['sku_quantity'])) {
            foreach ($data['sku_quantity'] as $arr) {
                $arr['good_id'] = $good_id;
                GoodsSkuQuantity::create($arr);
            }
        }
        
        // 保存商品图片
        GoodsImage::where('good_id', $good_id)->delete();
        if (isset($data['images'])) {
            foreach ($data['images'] as $key => $arr) {
                $insert_data = array(
                    'good_id' => $good_id,
                    'image' => $arr,
                    'sort' => $key
                );
                GoodsImage::create($insert_data);
            }
        }
    
        // 保存sku图片
        GoodsSkuImage::where('good_id', $good_id)->delete();
        if (isset($data['sku_images'])) {
            foreach ($data['sku_images'] as $arr) {
                $insert_data = array(
                    'good_id' => $good_id,
                    'image' => $arr['image'],
                    'option_value_id' => $arr['option_value_id']
                );
                GoodsSkuImage::create($insert_data);
            }
        }
        
        return ['code' => 1, 'msg' => lang('edit_success')];
    }
    
    /**
     * @Mark: 新增商品信息
     * @param $data
     * @return bool|\think\response\Json
     * @Author: WangHuaLong
     */
    public static function add($data)
    {
        // 国家必选，未选时自动关联中国
        if($data['country_id']==0){
            $data['country_id'] = 44;
        }
    
        // 服务承若
        if(isset($data['promise'])){
            $data['promise'] = implode(',',$data['promise']);
        }
        
        // 验证商品分类
        if ($data['cat_id'] == 0) {
            return ['code' => 0, 'msg' => lang('Category_Error')];
        }
        
        // 验证主表数据
        $goods_class = Loader::parseClass('crossbbcg', 'validate', 'Goods');
        $goods_validate = Loader::validate($goods_class);
        $result = $goods_validate->check($data);
        if ($result !== true) {
            return ['code' => 0, 'msg' => $goods_validate->getError()];
        }
        
        // 验证商品sku
        if (isset($data['sku'])) {
            $sku_class = Loader::parseClass('crossbbcg', 'validate', 'GoodsSku');
            $sku_validate = Loader::validate($sku_class);
            $repeat = [];
            $repeat1 = [];
            $repeat2 = [];
            foreach ($data['sku'] as $arr) {
                if(!isset($arr['merge_option_value_id'])){
                    $arr['merge_option_value_id'] = '';
                }
                if(!isset($arr['name'])){
                    $arr['name'] = '';
                }
                $merge_option_value_id = $arr['merge_option_value_id'];
                $name = $arr['name'];
                
                if (in_array($merge_option_value_id, $repeat)) {
                    return ['code' => 0, 'msg' => lang('Option_Value_Repeat') . $name];
                }
                $repeat[] = $merge_option_value_id;
                
                if (in_array($arr['sku'], $repeat1)) {
                    return ['code' => 0, 'msg' => lang('Option_Sku_Repeat') . $arr['sku']];
                }
                $repeat1[] = $arr['sku'];
    
                if (in_array($arr['good_barcode'], $repeat2)) {
                    return ['code' => 0, 'msg' => lang('GoodBarcode_Repeat') . $arr['good_barcode']];
                }
                $repeat2[] = $arr['good_barcode'];
                
                $result = $sku_validate->check($arr);
                if ($result !== true) {
                    return ['code' => 0, 'msg' => $sku_validate->getError()];
                }
            }
            unset($repeat);
            unset($repeat1);
            unset($repeat2);
        } else {
            return ['code' => 0, 'msg' => lang('Sku_Not_Empty')];
        }
    
        // 计算商品市场价，促销价，成本价
        $market_price = 0;
        $sale_price = 0;
        $cost_price = 0;
        if (isset($data['sku'])) {
            $sku_row = 0;
            foreach ($data['sku'] as $key => $arr) {
                if ($sku_row == 0) {
                    $market_price = $arr['market_price'];
                    $sale_price = $arr['sale_price'];
                    $cost_price = $arr['cost_price'];
                } else {
                    if ($sale_price > $arr['sale_price']) {
                        $market_price = $arr['market_price'];
                        $sale_price = $arr['sale_price'];
                        $cost_price = $arr['cost_price'];
                    }
                }
                $sku_row++;
            }
            unset($sku_row);
        }
        $data['market_price'] = $market_price;
        $data['sale_price'] = $sale_price;
        $data['cost_price'] = $cost_price;
        
        // 商品库存
        $data['quantity'] = 0;
        $data['offline_quantity'] = 0;
        
        // 新增主表信息，返回商品id
        $goods = new GoodsModel();
        $goods->allowField(true)->isUpdate(false)->save($data);
        if ($goods->getError() !== null) {
            return ['code' => 0, 'msg' => $goods->getError()];
        }
        $good_id = $goods->getLastInsID();
        
        // 保存商品分类
        if ($data['cat_id'] == 0) {
            GoodsToCategory::where('good_id', $good_id)->delete();
        } else {
            GoodsToCategory::where('good_id', $good_id)->delete();
            $category_ids = self::getPids($data['cat_id']);
            foreach ($category_ids as $value) {
                if ($value != 0) {
                    $insert_data = array(
                        'good_id' => $good_id,
                        'category_id' => $value,
                    );
                    GoodsToCategory::create($insert_data);
                }
            }
            $insert_data = array(
                'good_id' => $good_id,
                'category_id' => $data['cat_id'],
            );
            GoodsToCategory::create($insert_data);
        }
        
        // 保存产品参数，不需要验证
        GoodsAttribute::where('good_id', $good_id)->delete();
        if (isset($data['attribute'])) {
            $post_attribute = $data['attribute'];
            foreach ($post_attribute as $key => $arr) {
                foreach ($arr as $key2 => $arr2) {
                    if(is_array($arr2)){
                        foreach ($arr2 as $key3 => $arr3) {
                            $insert_data = array(
                                'good_id' => $good_id,
                                'attribute_group_id' => $key,
                                'attribute_id' => $key2,
                                'value' => $arr3
                            );
                            GoodsAttribute::create($insert_data);
                        }
                    }else{
                        $insert_data = array(
                            'good_id' => $good_id,
                            'attribute_group_id' => $key,
                            'attribute_id' => $key2,
                            'value' => $arr2
                        );
                        GoodsAttribute::create($insert_data);
                    }
                }
            }
        }
        
        // 保存商品选项
        GoodsSku::where('good_id', $good_id)->delete();
        if (isset($data['sku'])) {
            foreach ($data['sku'] as $arr) {
                if (!isset($arr['merge_option_value_id'])) {
                    $arr['merge_option_value_id'] = '';
                }
                if (!isset($arr['name'])) {
                    $arr['name'] = '';
                }
                
                // 排序
                if($arr['merge_option_value_id']){
                    $arr['merge_option_value_id'] = explode(',', $arr['merge_option_value_id']);
                    sort($arr['merge_option_value_id']);
                    $merge_option_value_id = implode(',', $arr['merge_option_value_id']);
                }else{
                    $merge_option_value_id = $arr['merge_option_value_id'];
                }
                $name = $arr['name'];
                
                $insert_data = array(
                    'sku' => $arr['sku'],
                    'good_id' => $good_id,
                    'merge_option_value_id' => $merge_option_value_id,
                    'name' => $name,
                    'good_batch' => $arr['good_batch'],
                    'quantity' => 0,
                    'offline_quantity' => 0,
                    'sale_price' => $arr['sale_price'],
                    'market_price' => $arr['market_price'],
                    'cost_price' => $arr['cost_price'],
                    'good_barcode' => $arr['good_barcode'],
                    'hs_record' => $arr['hs_record'],
                    'hs_national_record' => $arr['hs_national_record'],
                
                );
                GoodsSku::create($insert_data);
            }
        }
        
        // 保存商品图片
        GoodsImage::where('good_id', $good_id)->delete();
        if (isset($data['images'])) {
            foreach ($data['images'] as $key=>$arr) {
                $insert_data = array(
                    'good_id' => $good_id,
                    'image' => $arr,
                    'sort' => $key
                );
                GoodsImage::create($insert_data);
            }
        }
        
        // 保存sku图片
        GoodsSkuImage::where('good_id', $good_id)->delete();
        if (isset($data['sku_images'])) {
            foreach ($data['sku_images'] as $arr) {
                $insert_data = array(
                    'good_id' => $good_id,
                    'image' => $arr['image'],
                    'option_value_id' => $arr['option_value_id']
                );
                GoodsSkuImage::create($insert_data);
            }
        }
        
        
        return ['code' => 1, 'msg' => lang('add_success')];
    }
    
    /**
     * @Mark: 修改商品状态
     * @param $data
     * @return bool|object|\think\response\Json
     * @Author: WangHuaLong
     */
    public static function changeGoodStatus($data)
    {
        $good = GoodsModel::get($data['id']);
        if (!$good) {
            return ['code' => 0, 'msg' => lang('Error_Missing_Good')];
        }
        
        if (!isset($data['status'])) {
            return ['code' => 0, 'msg' => lang('Error_Missing_Param')];
        }
        
        if (!in_array($data['status'], config('default_all_good_status'))) {
            return ['code' => 0, 'msg' => lang('Error_Good_Status')];
        }
        
        $good->status = $data['status'];
        if ($good->save()) {
            return ['code' => 1, 'msg' => lang('edit_success')];
        } else {
            if ($good->getError() !== null) {
                return ['code' => 0, 'msg' => $good->getError()];
            } else {
                return ['code' => 0, 'msg' => lang('Error_Nothing')];
            }
        }
        
    }
    
    /**
     * @Mark: 删除商品数据
     * @param $data
     * @return bool|object|\think\response\Json
     * @Author: WangHuaLong
     */
    public static function recycleDelete($data)
    {
        $good_id = $data['id'];
        $map = [
            'good_id' => $good_id
        ];
        
        // 删除商品数据
        GoodsToCategory::where($map)->delete();
        GoodsSkuQuantity::where($map)->delete();
        GoodsSkuImage::where($map)->delete();
        GoodsSku::where($map)->delete();
        GoodsImage::where($map)->delete();
        GoodsBlockedStock::where($map)->delete();
        GoodsAttribute::where($map)->delete();
        GoodsModel::where(['id'=>$good_id])->delete();
        
        return ['code'=>1,'msg'=>lang('recycle_delete_ok')];
    }
    
    /**
     * @Mark: 修改商品顺序
     * @param $data
     * @return bool|object|\think\response\Json
     * @Author: WangHuaLong
     */
    public static function changeGoodSort($data)
    {
        $good = GoodsModel::get($data['id']);
        
        if (!$good) {
            return ['code' => 0, 'msg' => lang('Error_Missing_Good')];
        }
        
        if (!isset($data['sort'])) {
            return ['code' => 0, 'msg' => lang('Error_Missing_Param')];
        }
        
        $good->sort = (int)$data['sort'];
        if ($good->save()) {
            return ['code' => 1, 'msg' => lang('edit_success')];
        } else {
            if ($good->getError() !== null) {
                return ['code' => 0, 'msg' => $good->getError()];
            } else {
                return ['code' => 0, 'msg' => lang('Error_Nothing')];
            }
        }
        
    }
    
    /**
     * @Mark: 获取参数组
     * @return false|static[]
     * @Author: WangHuaLong
     */
    public static function getAttributeGroup()
    {
        $result = AttributeGroup::where('langid', LANG)->select();
        return $result;
    }
    
    /**
     * @Mark: 获取参数
     * @param $attribute_group_id 参数组id
     * @return false|\PDOStatement|string|\think\Collection
     * @Author: WangHuaLong
     */
    public static function getAttribute($attribute_group_id)
    {
        $attribute = new Attribute();
        $result = $attribute->where('attribute_group_id', $attribute_group_id)->select();
        
        return $result;
    }
    
    /**
     * @Mark: 获取商品参数表的参数
     * @param $good_id
     * @return false|\PDOStatement|string|\think\Collection
     * @Author: WangHuaLong
     */
    public static function getGoodsAttribute($good_id)
    {
        $result = GoodsAttribute::where('good_id',$good_id)->select();
        return $result;
    }
    
    /**
     * @Mark: 获取品牌
     * @return false|\PDOStatement|string|\think\Collection
     * @Author: WangHuaLong
     */
    public static function getBrands()
    {
        $result = BrandModel::where('langid', LANG)->order('firstchar','ASC')->select();
        return $result;
    }
    
    /**
     * @Mark: 获取当前语言的所有商户
     * @return false|\PDOStatement|string|\think\Collection
     * @Author: WangHuaLong
     */
    public static function getSellers()
    {
        $result = SellerAccountModel::where(['langid' => LANG])->select();
        return $result;
    }
    
    /**
     * @Mark: 获取商家信息
     * @param $seller_id
     * @return array|false|\PDOStatement|string|\think\Model
     * @Author: WangHuaLong
     */
    public static function getSeller($seller_id)
    {
        $result = StoreModel::where('seller_id', $seller_id)->find();
        return $result;
    }
    
    /**
     * @Mark: 获取商户名称
     * @param $id int 商户id
     * @return array|false|\PDOStatement|string|\think\Model
     * @Author: WangHuaLong
     */
    public static function getSellerNickname($id)
    {
        $result = SellerAccountModel::where('id', $id)->find();
        return $result['nickname'];
    }
    
    /**
     * @Mark: 获取所有国家
     * @return false|\PDOStatement|string|\think\Collection
     * @Author: WangHuaLong
     */
    public static function getCountries()
    {
        $result = CountryModel::all();
        return $result;
    }
    
    /**
     * @Mark:获取国家
     * @param $country_id
     * @return null|static
     * @Author: WangHuaLong
     */
    public static function getCountry($country_id)
    {
        $result = CountryModel::get($country_id);
        return $result;
    }
    
    /**
     * @Mark: 获取商品附加图
     * @param $good_id
     * @return false|\PDOStatement|string|\think\Collection
     * @Author: WangHuaLong
     */
    public static function getImage($good_id)
    {
        $result = GoodsImage::where('good_id', $good_id)->order('sort','ASC')->column('image','sort');
        return $result;
    }
    
    /**
     * @Mark: 获取子分类
     * @param int $pid
     * @return false|\PDOStatement|string|\think\Collection
     * @Author: WangHuaLong
     */
    public static function getCategories($pid)
    {
        $category = new CategoryModel();
        $result = $category->where('pid', $pid)->order('sort', 'ASC')->select();
        return $result;
    }
    
    /**
     * @Mark: 获取分类名
     * @return array
     * @Author: WangHuaLong
     */
    public static function getCateogriesName()
    {
        $category = new CategoryModel();
        $result = $category->where('langid', LANG)->order('sort', 'ASC')->field(['id', 'title'])->select();
        if ($result) {
            $names = [];
            foreach ($result as $arr) {
                $names[$arr['id']] = $arr['title'];
            }
            return $names;
        } else {
            return [];
        }
        
    }
    
    /**
     * @Mark: 获取当前分类
     * @param $cat_id
     * @return \think\Paginator
     * @Author: WangHuaLong
     */
    public static function getNowCategory($cat_id)
    {
        $map = array();
        $map['id'] = $cat_id;
        $filter_data = array(
            'where' => $map,
        );
        $category = new CategoryModel();
        $result = $category->getCategories($filter_data);
        return $result;
    }
    
    /**
     * @Mark: 通过分类名称获取分类
     * @param $title
     * @return array|false|\PDOStatement|string|\think\Model
     * @Author: WangHuaLong
     */
    public static function getCategoryByTitle($title)
    {
        $category = new CategoryModel();
        $result = $category->where('title', $title)->find();
        return $result;
    }
    
    /**
     * @Mark: 返回上级分类id  回调
     * @param $category_id
     * @param array $arr
     * @return array
     * @Author: WangHuaLong
     */
    public static function getPids($category_id, &$arr = [])
    {
        $result = CategoryModel::get($category_id);
        if ($result['pid'] != 0) {
            $arr[] = $result['pid'];
            self::getPids($result['pid'], $arr);
        }
        
        return $arr;
    }
    
    /**
     * @Mark: 获取下级分类id
     * @param $pid
     * @return array|mixed
     * @Author: WangHuaLong
     */
    public static function getCids($pid)
    {
        $result = CategoryModel::where('pid', $pid)->select();
        $cids = [];
        if ($result) {
            foreach ($result as $arr) {
                $cids[] = $arr['id'];
            }
        }
        return $cids;
    }
    
    /**
     * @Mark: 获取顶级分类
     * @param $category_id
     * @return int
     * @Author: WangHuaLong
     */
    public static function getTopPid($category_id)
    {
        $path = new CategoryPath();
        $result = $path::where('category_id', $category_id)->where('level', 0)->find();
        if ($result) {
            return $result['path_id'];
        } else {
            return 0;
        }
    }
    
    /**
     * @Mark: 获取当前语言的所有选项
     * @return false|\PDOStatement|string|\think\Collection
     * @Author: WangHuaLong
     */
    public static function getOptions()
    {
        
        $result = OptionModel::where('langid', LANG)->select();
        
        return $result;
    }
    
    /**
     * @Mark: 获取一个选项
     * @param $option_id
     * @return array
     * @Author: WangHuaLong
     */
    public static function getOption($option_id)
    {
        $result = OptionModel::get($option_id)->toArray();
        
        return $result;
    }
    
    /**
     * @Mark: 获取选项的选项值
     * @param $option_id
     * @return array
     * @Author: WangHuaLong
     */
    public static function getOptionValues($option_id)
    {
        $result = OptionValue::where('option_id', $option_id)->select()->toArray();
        
        return $result;
    }
    
    /**
     * @Mark: 获取商品sku，返回数组
     * @param int $good_id 商品id
     * @return array
     * @Author: WangHuaLong
     */
    public static function getGoodsSku($good_id,$quantity=false)
    {
        if($quantity){
            $result = GoodsSku::where('good_id', $good_id)->where('quantity','>',0)->order('sku', 'ASC')->select()->toArray();
        }else{
            $result = GoodsSku::where('good_id', $good_id)->order('sku', 'ASC')->select()->toArray();
        }
        
        return $result;
    }
    
    /**
     * @Mark: 获取商品sku的选项
     * @param $good_id
     * @return array
     * @Author: WangHuaLong
     */
    public static function getGoodsSkuOption($good_id)
    {
        $merge = [];
        $result = GoodsSku::where('good_id', $good_id)->field('merge_option_value_id')->select()->toArray();
        foreach ($result as $value) {
            if ($value['merge_option_value_id'] != '') {
                $merge_string = $value['merge_option_value_id'];
                $arr = explode(',', $merge_string);
                $merge_option = [];
                foreach ($arr as $option_value_id) {
                    $merge_option[$option_value_id] = self::getMergeOption($option_value_id);
                }
                $merge[$value['merge_option_value_id']] = $merge_option;
            } else {
                continue;
            }
        }
        
        return $merge;
    }
    
    /**
     * @Mark: 获取合并的选项
     * @param $option_value_id
     * @return array
     * @Author: WangHuaLong
     */
    public static function getMergeOption($option_value_id)
    {
        
        $option_value = new OptionValue();
        $result = $option_value->getMergeOption($option_value_id);
        $merge = [];
        if ($result) {
            
            $merge['option_value_id'] = $option_value_id;
            $merge['option_id'] = $result['option_id'];
            $merge['option_name'] = $result['option_name'];
            $merge['option_value_name'] = $result['option_value_name'];
            $merge['options'] = OptionValue::where('option_id', $result['option_id'])->select()->toArray();
        }
        
        return $merge;
        
    }
    
    /**
     * @Mark: 获取商品所有sku合并的选项值id
     * @param $good_id
     * @return array|false|\PDOStatement|string|\think\Model
     * @Author: WangHuaLong
     */
    public static function getMergeValue($good_id, $quantity = false)
    {
        $sku = new GoodsSku();
        return $sku->getMergeValue((int)$good_id, $quantity);
    }
    
    /**
     * @Mark: 返回商品的sku选项
     * @param $merge_value
     * @return false|\PDOStatement|string|\think\Collection
     * @Author: WangHuaLong
     */
    public static function getSkuOptions($merge_value)
    {
        $sku = new OptionModel();
        return $sku->getSkuOptions($merge_value);
    }
    
    /**
     * @Mark: 返回以选项值为键的sku图片地址
     * @param $good_id
     * @return array
     * @Author: WangHuaLong
     */
    public static function GoodsSkuImage($good_id)
    {
        $sku_image = new GoodsSkuImage();
        $result = $sku_image->where(['good_id' => $good_id, 'image' => ['<>', '']])->column('image', 'option_value_id');
        return $result;
    }
    
    /**
     * @Mark: 获取商家的仓库编码
     * @param $seller_id
     * @return array|mixed
     * @Author: WangHuaLong
     */
    public static function getSellerWarehouse($seller_id)
    {
        if ($seller_id != 0) {
            $result = SellerAccountModel::where('id', $seller_id)->find();
            if ($result!==null) {
                return $result['housecode'];
            }
            return [];
        }
        return [];
    }
    
    /**
     * @Mark: 获取商品sku仓库库存
     * @param $good_id
     * @return false|\PDOStatement|string|\think\Collection
     * @Author: WangHuaLong
     */
    public static function getGoodsSkuQuantity($good_id)
    {
        $result = GoodsSkuQuantity::where('good_id', $good_id)->select();
        return $result;
    }
    
    /**
     * @Mark: 修改商品的sku仓库库存
     * @param $data
     * @return bool
     * @Author: WangHuaLong
     */
    public static function editSkuQuantity($data)
    {
        $good_id = $data['id'];
        
        // 保存sku，仓库库存
        GoodsSkuQuantity::where('good_id', $good_id)->delete();
        if (isset($data['sku_quantity'])) {
            foreach ($data['sku_quantity'] as $arr) {
                $arr['good_id'] = $good_id;
                GoodsSkuQuantity::create($arr);
            }
        }
        
        // 库存计算
        $sku_quantity = [];
        $good_quantity = 0;
        $good_offline_quantity = 0;
        if (isset($data['sku_quantity'])) {
            foreach ($data['sku_quantity'] as $key => $arr) {
                if (isset($sku_quantity[$arr['sku']])) {
                    $sku_quantity[$arr['sku']]['quantity'] += $arr['crossware_sku_quantity'];
                    $sku_quantity[$arr['sku']]['offline_quantity'] += $arr['crossware_sku_offline_quantity'];
                } else {
                    $sku_quantity[$arr['sku']]['quantity'] = $arr['crossware_sku_quantity'];
                    $sku_quantity[$arr['sku']]['offline_quantity'] = $arr['crossware_sku_offline_quantity'];
                }
                
            }
        } else if (isset($data['sku_all_quantity'])) {
            $sku_quantity = $data['sku_all_quantity'];
        }
        
        // 更新sku库存
        if ($sku_quantity) {
            $sku = new GoodsSku();
            foreach ($sku_quantity as $key => $arr) {
                $good_quantity += $arr['quantity'];
                $good_offline_quantity += $arr['offline_quantity'];
                $sku->where('sku', $key)->update(['quantity' => $arr['quantity'], 'offline_quantity' => $arr['offline_quantity']]);
            }
        }
        
        // 更新商品库存
        $goods = new GoodsModel();
        $goods->where('id', $good_id)->update(['quantity' => $good_quantity, 'offline_quantity' => $good_offline_quantity]);
    
        return ['code' => 1, 'msg' => lang('edit_success')];
    }
    
    /**
     * @Mark:  返回商品的税费
     * @param $price
     * @param int $tax_rate
     * @return float|int
     * @Author: WangHuaLong
     */
    public static function getTax($price, $tax_rate = 0)
    {
        return $price * $tax_rate / 100;
    }
    
    /**
     * @Mark: 获取货币价格
     * @param int $number  价格
     * @param string $currency  货币代码
     * @param string $value 汇率【可选】
     * @param bool $format 是否带货币符号【可选】
     * @return float|string
     * @Author: WangHuaLong
     */
    public static function currencyFormat($number, $currency = '', $value = '', $format = true)
    {
        $currency_model = new Currency();
        // TODO 缓存控制，防止过多查询
        if($currency == '') {
            $result = $currency_model::where('code', $currency)->cache('currency_' . $currency)->find();
        }else{
            $result = null;
        }
        
        // 防止空数据表 TODO 当前的货币
        if ($result === null) {
            $result['symbol'] = '￥';
            $result['rate'] = '1';
        }
        
        $symbol_left = $result['symbol'];   // 币符号靠左或靠右
        $symbol_right = false;
        
        $decimal_place = 2;  // 小数位
        
        if (!$value) {
            $value = $result['rate'];
        }
        
        $amount = $value ? (float)$number * $value : (float)$number;
        
        $amount = round($amount, (int)$decimal_place);
        
        if (!$format) {
            return $amount;
        }
        
        $string = '';
        
        if ($symbol_left) {
            $string .= $symbol_left;
        }
        
        $string .= number_format($amount, (int)$decimal_place, lang('Decimal_Point'), lang('Thousand_Point'));
        
        if ($symbol_right) {
            $string .= $symbol_right;
        }
        
        return $string;
    }
    
    /**
     * @Mark: 返回带税价格
     * @param $price float 价格
     * @param $tax_rate float 税率
     * @param $currency string 货币符号
     * @return float|string
     * @Author: WangHuaLong
     */
    public static function getTaxAndPrice($price, $tax_rate, $currency, $value = '', $format = true)
    {
        return self::currencyFormat(($price + self::getTax($price, $tax_rate)), $currency, $value, $format);
    }
    
}