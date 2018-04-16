<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Expresstpl.php  Version 2017/3/27  运费模板模型
// +----------------------------------------------------------------------
namespace app\bcwareexp\model;

use app\common\model\Base;

class Expresstpl extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__BCWAREEXP_EXPRESSTPL__';
    
    //定义时间戳字段名create_time, update_time
    protected $autoWriteTimestamp = true;
    //自动完成
    protected $auto     = ['firstchar', 'isrecom', 'status', 'isdefault', 'langid'];
    protected $insert   = [];
    protected $update   = [];
}