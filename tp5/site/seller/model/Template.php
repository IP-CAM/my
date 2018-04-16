<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Template.php  Version 店铺模板 2017/6/12
// +----------------------------------------------------------------------

namespace app\seller\model;

use think\Model;

class Template extends Model
{
    protected $table = '__SELLER_TEMPLATE__';
    protected $insert = ['create_time'];
    
    protected function setCreateTimeAttr($value){
        return time();
    }
}
