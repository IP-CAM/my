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
// | Goods 验证器  Version 2016/11/27
// +----------------------------------------------------------------------
namespace app\crossbbcg\validate;

use think\Validate;
use app\crossbbcg\model\Goods as GoodsModel;

class Goods extends Validate
{
   
    // 验证规则
    protected $rule = [
        'good_code'=>'checkGoodCode|require|max:64',
        //'good_barcode'=>'checkGoodBarcode|max:64',
        'status' => 'require',
        'weight' =>'egt:0|checkWeight',
        'clear_weight' =>'egt:0',
        'length' => 'egt:0',
        'width' => 'egt:0',
        'height' => 'egt:0',
        'minimum' => 'egt:1',
        'points' => 'egt:0',
        //'market_price' => 'egt:0',
        //'market_price' => 'checkMarketPrice',
        //'sale_price' => 'egt:0',
        //'cost_price' => 'egt:0',
        'kickback' => 'between:0,100',
        'points_price' => 'egt:0',
        'domestic_freight' => 'egt:0',
        'package_num' => 'egt:1',
        'package_charge' => 'egt:0',
        
        'location' => 'length:0,64',
        'name' => 'require|checkName',
        'enname' => 'length:0,255|checkEnname',
        'video' => 'length:0,500',
    ];

    protected $message = [
        'good_code.require' => '{%Goods_Good_Code_Require}',
        //'good_barcode.require' => '{%Goods_Good_Barcode_Require}',
        'good_code.max' => '{%Goods_Good_Code_Max}',
        //'good_barcode.max' => '{%Goods_Good_Barcode_Max}',
        'length.egt' => '{%Goods_Length_Egt}',
        'width.egt' => '{%Goods_Width_Egt}',
        'height.egt' => '{%Goods_Height_Egt}',
        'weight.egt' => '{%Goods_Weight_Egt}',
        'clear_weight.egt' => '{%Goods_Clear_Weight_Egt}',
        'minimum.egt' => '{%Goods_Minimum_Egt}',
        'points.egt' => '{%Goods_Points_Egt}',
        'domestic_freight.egt' => '{%Goods_Domestic_Freight_Egt}',
        'package_charge.egt' => '{%Goods_Package_Charge_Egt}',
        'package_num.egt' => '{%Goods_Package_Num_Egt}',
        'market_price.egt' => '{%Goods_Market_Price_Egt}',
        'sale_price.egt' => '{%Goods_Sale_Price_Egt}',
        'cost_price.egt' => '{%Goods_Cost_Price_Egt}',
        'kickback.between' => '{%Goods_Kickback_Between}',
        'points_price.egt' => '{%Goods_Points_Price_Egt}',
        
        'location.length' => '{%Goods_Location_Length}',
        'name.require' => '{%Goods_Name_Require}',
        'enname.length' => '{%Goods_Enname_Length}',
        'video.length' => '{%Goods_Video_Length}',
    ];
    
    /**
     * @Mark: 检查商品编码是否唯一
     * @param $value
     * @param $rule
     * @param $data
     * @return bool|mixed
     * @Author: WangHuaLong
     */
    protected function checkGoodCode($value,$rule,$data){
        $map = array();
        $map['good_code']  = ['=',$value];
        $map['langid'] = ['=',$data['langid']];
    
        if(isset($data['id'])) {
            $map['id'] = ['NOT IN', $data['id']];
            $count = GoodsModel::where($map)->count();
            if ($count) {
                return lang('Goods_Good_Code_Exist');
            } else {
                return true;
            }
        }else{
            $count = GoodsModel::where($map)->count();
            if ($count) {
                return lang('Goods_Good_Code_Exist');
            } else {
                return true;
            }
        }
    }
    
    /**
     * @Mark: 检查商品条码是否唯一
     * @param $value
     * @param $rule
     * @param $data
     * @return bool|mixed
     * @Author: WangHuaLong
     */
    protected function checkGoodBarcode($value,$rule,$data){
        $map = array();
        $map['good_barcode']  = ['=',$value];
        $map['langid'] = ['=',$data['langid']];
    
        if(isset($data['id'])) {
            $map['id'] = ['NOT IN', $data['id']];
            $count = GoodsModel::where($map)->count();
            if ($count) {
                return lang('Goods_Good_Barcode_Exist');
            } else {
                return true;
            }
        }else{
            $count = GoodsModel::where($map)->count();
            if ($count) {
                return lang('Goods_Good_Barcode_Exist');
            } else {
                return true;
            }
        }
    }
    
    /**
     * @Mark: 检查商品名称在当前语言下是否重复
     * @param $value
     * @param $rule
     * @param $data
     * @return bool|mixed
     * @Author: WangHuaLong
     */
    protected function checkName($value,$rule,$data){
        $map = array();
        $map['name']  = ['=',$value];
        $map['langid'] = ['=',$data['langid']];
        
        if(isset($data['id'])) {
            $map['id'] = ['NOT IN', $data['id']];
            $goods = new GoodsModel();
            $count = $goods->where($map)->count();
            if ($count) {
                return lang('Goods_Name_Exist');
            } else {
                return true;
            }
        }else{
            $goods = new GoodsModel();
            $count = $goods->where($map)->count();
            if ($count) {
                return lang('Goods_Name_Exist');
            } else {
                return true;
            }
        }
    }
    
    /**
     * @Mark: 检查当前语言下的英文名是否重复
     * @param $value
     * @param $rule
     * @param $data
     * @return bool|mixed
     * @Author: WangHuaLong
     */
    protected function checkEnname($value,$rule,$data){
        $map = array();
        $map['enname']  = ['=',$value];
        $map['langid'] = ['=',$data['langid']];
        
        if(isset($data['id'])) {
            $map['id'] = ['NOT IN', $data['id']];
            $goods = new GoodsModel();
            $count = $goods->where($map)->count();
            if ($count) {
                return lang('Goods_Enname_Exist');
            } else {
                return true;
            }
        }else{
            $goods = new GoodsModel();
            $count = $goods->where($map)->count();
            if ($count) {
                return lang('Goods_Enname_Exist');
            } else {
                return true;
            }
        }
    }
    
    /**
     * @Mark: 检查商品的毛重是否大于等于净重
     * @param $value
     * @param $rule
     * @param $data
     * @return bool|mixed
     * @Author: WangHuaLong
     */
    protected function checkWeight($value,$rule,$data){
        if($value >= $data['clear_weight']){
            return true;
        }else{
            return lang('Goods_Check_Weight_Error');
        }
    }
    
    protected function checkMarketPrice($value,$rule,$data){
        if($value > $data['sale_price']){
            return true;
        }else{
            return lang('Goods_Check_Marke_Price_Error');
        }
    }
   

}