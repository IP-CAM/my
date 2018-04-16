<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Seller.php  Version 店铺  2017/5/27
// +----------------------------------------------------------------------
namespace app\seller\model;

use app\common\model\Base;

class Store extends Base
{
    protected $table = '__SELLER_STORE__';
    protected $insert = ['langid','build_time'];
    protected $type = ['goods_cat'=>'json'];
    protected $autoWriteTimestamp = true;
    
    
    protected function setCreateTimeAttr(){
        return time();
    }
    
    protected function setLangidAttr($value)
    {
        return LANG;
    }
    
    protected function setBuildTimeAttr($value){
        return strtotime($value);
    }
    
    protected function setGoodsCatAttr($value){
        return implode(',',(array)$value);
    }
    
    /**
     * @Mark: 关联店铺
     * @return \think\model\relation\HasOne
     * @Author: WangHuaLong
     */
    public function shopcat(){
        return $this->hasOne('Shopcat','id','cat_id');
    }
    
}