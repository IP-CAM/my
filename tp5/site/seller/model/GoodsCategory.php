<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | GoodsCategory.php  Version 2017/7/17
// +----------------------------------------------------------------------

namespace app\seller\model;

use app\common\model\Base;

class GoodsCategory extends Base
{
    protected $table = '__SELLER_GOODS_CATEGORY__';
    protected $autoWriteTimestamp = true;
    
    protected $insert = ['langid'];
    
    protected function setLangidAttr($value)
    {
        return LANG;
    }
}
