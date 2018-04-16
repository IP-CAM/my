<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Yugou.php  Version 2017/3/27 云购
// +----------------------------------------------------------------------
namespace app\promotion\model;

use app\common\model\Base;

class Yugou extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__PROMOTION_YUNGOU__';
    //定义时间戳字段名create_time, update_time
    protected $autoWriteTimestamp = true;
    //自动完成
    protected $auto     = ['begin_time', 'end_time', 'isrecommend', 'istop', 'status', 'langid'];
    protected $insert   = [];
    protected $update   = [];
}