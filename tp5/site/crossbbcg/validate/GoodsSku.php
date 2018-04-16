<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: WangHuaLong
// +----------------------------------------------------------------------
// | GoodsSku.php  Version 2017/6/22
// +----------------------------------------------------------------------
namespace app\crossbbcg\validate;

use think\Validate;
use app\crossbbcg\model\GoodsSku as GoodsSkuModel;

class GoodsSku extends Validate
{
    // 验证规则
    protected $rule = [
        ['sku','require','{%Sku_Require}'],
        ['sku', 'checkSku'],
        ['good_barcode','require','{%GoodBarcode_Require}'],
        ['good_barcode', 'checkGoodBarcode'],
    ];
    
    /**
     * @Mark: 检查主键sku是否唯一
     * @param $value
     * @return bool
     * @Author: WangHuaLong
     */
    protected function checkSku($value,$rule,$data){
        $sku = $value;
        if(isset($data['good_id'])){
            $good_id = $data['good_id'];
            $result = GoodsSkuModel::where('good_id','<>',$good_id)->where('sku',$sku)->find();
        }else{
            $result = GoodsSkuModel::where('sku',$sku)->find();
        }
            
        if($result){
            return lang('Sku_Exist') . $value;
        }else{
            return true;
        }
    }
    
    /**
     * @Mark: 检查条形码是否唯一
     * @param $value
     * @param $rule
     * @param $data
     * @return bool|string
     * @Author: WangHuaLong
     */
    protected function checkGoodBarcode($value,$rule,$data){
        $good_barcode = $value;
        if(isset($data['good_id'])){
            $good_id = $data['good_id'];
            $result = GoodsSkuModel::where('good_id','<>',$good_id)->where('good_barcode',$good_barcode)->find();
        }else{
            $result = GoodsSkuModel::where('good_barcode',$good_barcode)->find();
        }
        
        if($result){
            return lang('GoodBarcode_Exist') . $value;
        }else{
            return true;
        }
    }
}