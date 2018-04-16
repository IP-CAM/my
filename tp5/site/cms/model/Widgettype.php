<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: fancs
// +----------------------------------------------------------------------
// | Home.php  Version 2017/6/16 首页管理模型
// +----------------------------------------------------------------------
namespace app\cms\model;

use app\common\model\Base;

class Widgettype extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__CMS_WIDGETTYPE__';
    
    //定义时间戳字段名create_time, update_time
   // protected $autoWriteTimestamp = true;
    //自动完成
    protected $auto     = [];
    protected $insert   = [];
    protected $update   = [];
}