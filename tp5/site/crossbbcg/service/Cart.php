<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: WangHuaLong
// +----------------------------------------------------------------------
// | Cart.php  Version 2017/7/15
// +----------------------------------------------------------------------
namespace app\crossbbcg\service;

use app\crossbbcg\model\Cart as CartModel;
use app\crossbbcg\model\GoodsSku as GoodsSkuModel;
use app\crossbbcg\model\Goods as GoodsModel;
use app\crossbbcg\model\GoodsSkuQuantity as GoodsSkuQuantityModel;
use app\crossbbcg\model\GoodsBlockedStock as GoodsBlockedStockModel;

class Cart
{
    
    /**
     * @Mark: 加入购物车，返回购物车中的加入的商品数量
     * @param int $good_id 商品id
     * @param int $num 商品数量
     * @param bool $choose_sku 商品sku 【可选】
     * @return int|mixed 购物车中加入的商品的数量
     * @Author: WangHuaLong
     */
    public static function addCart($good_id, $num = 1, $choose_sku = false)
    {
        // 每次加入购物车，更新购物车总数
        session('cart_total', null);
        
        $num = (int)$num;
        $map = [
            'member_id' => is_login(),
            'session_id' => session_id(),
            'good_id' => $good_id,
        ];
        
        if ($choose_sku) {
            $map['sku'] = $choose_sku;
        }
        
        // 购物车中顾客该商品的数量
        $count_num = CartModel::where($map)->value('num');
        
        if ($count_num) {
            // 更新商品数量
            $num = $count_num + $num;
            
            // 获取商品的最大购物量和库存，防止库存溢出
            $filter_data = array(
                'where' => $map
            );
            $cart = new CartModel();
            $cart_good = $cart->getGoods($filter_data,true);
            if($cart_good === null){
                return ['code' => 0, 'msg' => lang('Add_Cart_Error')];
            }
            $max = $cart_good['maximum'];
            $min = $cart_good['minimum'];
            $quantity = $cart_good['quantity'];  // 商品sku的库存
            if($max > $quantity || $max == 0){
                $max = $quantity;
            }
            if($num > $max){
                $num = $max;
            }
            if($min > $quantity){
                return ['code' => 0, 'msg' => lang('Add_Cart_Quantity_Error')];
            }
            if($num < $min){
                $num = $min;
            }
    
            
            
            
            CartModel::where($map)->update(['num' => $num]);
        } else {
            // 新增商品到购物车
            $insert_data = $map;
            
            // $insert_data['selected'] = 1; 默认不选中
            
            // 获取商品sku的数据
            if ($choose_sku) {
                $sku = GoodsSkuModel::where('sku', $choose_sku)->find();
                if ($sku !== null) {
                    $insert_data['sku'] = $sku['sku'];
                } else {
                    return ['code' => 0, 'msg' => lang('Add_Cart_Error')];
                }
            } else {
                $sku = GoodsSkuModel::where('good_id', $good_id)->find();
                if ($sku !== null) {
                    $insert_data['sku'] = $sku['sku'];
                } else {
                    return ['code' => 0, 'msg' => lang('Add_Cart_Error')];
                }
            }
            
            // 获取商品的最大购物量和库存，防止库存溢出
            $cart_sku = new GoodsSkuModel();
            $cart_good = $cart_sku->getGoodsSku($insert_data['sku']);
            if($cart_good === null){
                return ['code' => 0, 'msg' => lang('Add_Cart_Error')];
            }
            $max = $cart_good['maximum'];
            $min = $cart_good['minimum'];
            $quantity = $cart_good['quantity'];
            if($max > $quantity || $max == 0){
                $max = $quantity;
            }
            if($num > $max){
                $num = $max;
            }
            if($min > $quantity){
                return ['code' => 0, 'msg' => lang('Add_Cart_Quantity_Error')];
            }
            if($num < $min){
                $num = $min;
            }
            $insert_data['num'] = $num;
            
            CartModel::create($insert_data);
        }
    
        return ['code' => 1, 'msg' => lang('add_success')];
    }
    
    /**
     * @Mark: 获取购物车的商品的信息
     * @param bool $selected 是否只获取选中的商品
     * @return array|false|\PDOStatement|string|\think\Collection|\think\Model
     * @Author: WangHuaLong
     */
    public static function getGoods($selected = false)
    {
        $map = [
            'member_id' => is_login(),
            'session_id' => session_id(),
        ];
        if($selected){
            $map['selected'] = 1;
        }
        $filter_data = array(
            'where' => $map
        );
        $cart = new CartModel();
        return $cart->getGoods($filter_data);
    }
    
    /**
     * @Mark: 改变购物车指定商品的数量
     * @param int $cart_id 购物车id
     * @param int $num     商品数量
     * @return bool
     * @Author: WangHuaLong
     */
    public static function changeCartNum($cart_id,$num){
        // 更新购物车总数
        session('cart_total', null);
        $num = (int)$num;
        $map = [
            'member_id' => is_login(),
            'session_id' => session_id(),
            'id' => $cart_id
        ];
        CartModel::where($map)->update(['num'=>$num]);
        return ['code' => 1, 'msg' => lang('edit_success')];
    }
    
    /**
     * @Mark: 获取购物车中单个商品的信息
     * @param int $cart_id 购物车id
     * @return array|bool|false|\PDOStatement|string|\think\Collection|\think\Model
     * @Author: WangHuaLong
     */
    public static function getCartSku($cart_id){
        $map = [
            'member_id' => is_login(),
            'session_id' => session_id(),
            'id' => (int)$cart_id
        ];
        
        $filter_data = array(
            'where' => $map
        );
        $cart = new CartModel();
        $result = $cart->getGoods($filter_data,true);
        
        if($result!==null){
            return $result;
        }else{
            return false;
        }
    }
    
    /**
     * @Mark: 返回购物车中的总数
     * @return int
     * @Author: WangHuaLong
     */
    public static function countGood()
    {
        // 购物车总数存储在session
        if (session('cart_total')) {
            $total = session('cart_total');
        } else {
            $total = 0;
            $cart_goods = self::getGoods();
            foreach ($cart_goods as $arr) {
                $total += $arr['num'];
            }
            session('cart_total', $total);
        }
        
        return $total;
    }
    
    // TODO 重量单位转换
    public static function getWeight($value, $class = 'g', $config_class = 'g')
    {
        // config('default_weight_class_id'); 默认的重量单位
        return $value;
    }
    
    /**
     * @Mark: 返回选中状态的商品数量
     * @return int
     * @Author: WangHuaLong
     */
    public static function countSelected()
    {
        $cart = new CartModel();
        $map = [
            'member_id' => is_login(),
            'session_id' => session_id(),
            'selected' => 1
        ];
        $count = $cart->where($map)->count();
        return (int)$count;
    }
    
    /**
     * @Mark: 更新购物车
     * @Author: WangHuaLong
     */
    public static function updateCart()
    {
        // 更新购物车总数
        session('cart_total', null);
        
        $member_id = is_login();
        $cart = new CartModel();
        if ($member_id !== 0) {
            // 更新当前session_id的会员id
            $cart->where('session_id', session_id())->update(['member_id' => $member_id]);
            
            // 更新会员之前的session
            $cart->where('member_id', $member_id)->update(['session_id' => session_id()]);
            
            // 更新购物车中的商品信息，删除重复的商品数据，保留最后加入的商品数据
            $cart->deleteRepeatSku($member_id);
            
        } else {
            // 清理冗余的购物车数据,清理24小时前的数据
            $cart->where('member_id', 0)->where('create_time', '<', strtotime('-1 day'))->delete();
        }
    }
    
    /**
     * @Mark: 改变购物车中选中的商品
     * @param array $items
     * @return bool
     * @Author: WangHuaLong
     */
    public static function changeSelected($items = array())
    {
        $map = [
            'member_id' => is_login(),
            'session_id' => session_id(),
        ];
        
        CartModel::where($map)->update(['selected' => 0]);
        
        if (!empty($items)) {
            foreach ($items as $value) {
                CartModel::where($map)->where('id', $value)->update(['selected' => 1]);
            }
        }
        
        //$count_selected = CartModel::where($map)->where('selected', 1)->count('sku');
        return ['code' => 1, 'msg' => lang('edit_success')];
        
    }
    
    /**
     * @Mark: 选中购物车中的一个商品
     * @param int $good_id 商品id
     * @param int $num 商品数量
     * @param string|bool $choose_sku  商品sku
     * @return bool
     * @Author: WangHuaLong
     */
    public static function selectedOne($good_id,$num,$choose_sku){
        // 每次加入购物车，更新购物车总数
        session('cart_total', null);
    
        $num = (int)$num;
        $map = [
            'member_id' => is_login(),
            'session_id' => session_id(),
            'good_id' => $good_id,
        ];
    
        if ($choose_sku) {
            $map['sku'] = $choose_sku;
        }
        
        $map_other = [
            'member_id' => is_login(),
            'session_id' => session_id()
        ];
        // TODO NUM 库存商品溢出
    
        // 购物车中顾客该商品的数量
        CartModel::where($map_other)->update(['selected'=>0]);
        CartModel::where($map)->update(['selected'=>1,'num'=>$num]);
        
        
        return ['code' => 1, 'msg' => lang('edit_success')];
    }
    
    /**
     * @Mark: 删除购物车中的商品
     * @param int $cart_id 购物车中商品的id
     * @return bool
     * @Author: WangHuaLong
     */
    public static function delete($cart_id){
        $map = [
            'member_id' => is_login(),
            'session_id' => session_id(),
        ];
        CartModel::where($map)->delete($cart_id);
    
        // 更新购物车总数
        session('cart_total', null);
    
        return ['code' => 1, 'msg' => lang('delete_success')];
    }
    
    /**
     * @Mark: 删除购物车中的商品
     * @param $sku_ids  string|int sku  商品sku,多个逗号隔开
     * @return bool
     * @Author: WangHuaLong
     */
    public static function deleteCartSku($sku_ids){
        $map = [
            'member_id' => is_login(),
            'session_id' => session_id(),
        ];
        CartModel::where($map)->where('sku','IN',$sku_ids)->delete();
    
        // 更新购物车总数
        session('cart_total', null);
    
        return ['code' => 1, 'msg' => lang('delete_success')];
    }
    
    /**
     * @Mark: 减去商品的库存，加入到冻结库存
     * @param $data = [
     * 'sku' => 商品sku
     * 'good_id' => 商品id
     * 'crossware_code' => 仓库code
     * 'num' => 减去商品库存
     * ]
     * @Author: WangHuaLong
     */
    public static function deleteQuantity($data){
        $map = [
            'sku' => $data['sku'],
            'good_id' => $data['good_id']
        ];
        $map2 = $map;
        $map2['crossware_code'] = $data['crossware_code'];
        GoodsSkuQuantityModel::where($map2)->setDec('crossware_sku_quantity',$data['num']);
        
        GoodsSkuModel::where($map)->setDec('quantity',$data['num']);
        
        GoodsModel::where('id',$data['good_id'])->setDec('quantity',$data['num']);
    
        // 库存加入到库存冻结表
        $result = GoodsBlockedStockModel::where($map2)->find();
        if($result!==null){
            GoodsBlockedStockModel::where($map2)->setInc('quantity',$data['num']);
        }else{
            $insert_data = $map2;
            $insert_data['quantity'] = $data['num'];
            GoodsBlockedStockModel::create($insert_data);
        }
    }
}