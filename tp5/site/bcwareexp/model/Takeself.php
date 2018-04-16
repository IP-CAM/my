<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Takeself.php  Version 2017/3/28 自提点模型
// +----------------------------------------------------------------------
namespace app\bcwareexp\model;

use app\common\model\Base;

class Takeself extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__BCWAREEXP_TAKESELF__';
    
    //定义时间戳字段名create_time, update_time
    protected $autoWriteTimestamp = true;
    //自动完成
    protected $auto = ['status', 'langid'];
    protected $insert = [];
    protected $update = [];
}