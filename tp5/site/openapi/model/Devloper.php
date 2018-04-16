<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Devloper.php  Version 2017/5/2  开发者模型
// +----------------------------------------------------------------------
namespace app\openapi\model;

use app\common\model\Base;

class Devloper extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__OPENAPI_DEVLOPER__';
    
    //自动时间戳
    protected $autoWriteTimestamp = true;
    
    //自动完成
    protected $auto     = [];
    protected $insert   = [];
    protected $update   = [];
}