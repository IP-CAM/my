<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Advertising.php  Version 2017/8/3
// +----------------------------------------------------------------------

namespace app\crossbbcg\model;

use app\common\model\Base;
use think\Db;

class Advertising extends Base
{
    protected $table = '__CROSSBBCG_ADVERTISING__';
    protected $autoWriteTimestamp = true;
    protected $auto = ['langid'];
    
    protected $table_goods = '__CROSSBBCG_GOODS__';
    
    protected function setStartTimeAttr($value)
    {
        return strtotime($value);
    }
    
    protected function setEndTimeAttr($value)
    {
        return strtotime($value);
    }
    
    protected function setLangidAttr()
    {
        return LANG;
    }
    
    public function get_goods_ad($data)
    {
        $list = Db::table($this->table)
            ->alias('a')
            ->join($this->table_goods.' g','a.goods_id = g.id','LEFT')
            ->where($data['where'])
            ->order($data['order'])
            ->field('g.name,g.thumb,g.sale_price,g.id,g.market_price')
            ->paginate($data['limit']);
        $page = (int)input('get.page');
        if ($page>$list->lastPage()) {
            $list = Db::table($this->table)
                ->alias('a')
                ->join($this->table_goods.' g','a.goods_id = g.id','LEFT')
                ->where($data['where'])
                ->order($data['order'])
                ->page($list->lastPage(),$data['limit'])
                ->field('g.name,g.thumb,g.sale_price,g.id,g.market_price')
                ->select();
        }
        return $list;
    }
    
}
