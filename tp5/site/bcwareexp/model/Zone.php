<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: fancs
// +----------------------------------------------------------------------
// | Nav.php  Version 2017/6/28 导航管理模型
// +----------------------------------------------------------------------
namespace app\bcwareexp\model;

use app\common\model\Base;

class Zone extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__BCWAREEXP_ZONE__';
    
    //自动完成
    protected $auto     = ['langid'];
    protected $insert   = [];
    protected $update   = [];
}