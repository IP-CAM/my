<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | GoodsConsult.php  Version 商品咨询 2017/6/21
// +----------------------------------------------------------------------

namespace app\seller\model;

use app\common\model\Base;
use think\Db;

class GoodsConsult extends Base
{
    protected $table = "__SELLER_GOODS_CONSULT__";
    protected $insert = ['consult_addtime'];
    protected $table_crossbbcg_goods = '__CROSSBBCG_GOODS__';
    protected $table_member_account = '__MEMBER_ACCOUNT__';
    
    protected function setConsultAddtimeAttr($value)
    {
        return time();
    }
    
    protected function getConsultList()
    {
        $res = Db::table($this->table)
            ->alias('gc')
            ->join($this->table_crossbbcg_goods.' cg','gc.goods_id = cg.id','LEFT')
            ->join($this->table_member_account.' ma','gc.member_id = ma.id','LEFT')
            ->select();
        return $res;
    }
}

