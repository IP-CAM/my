<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Projects.php  Version 2017/6/8
// +----------------------------------------------------------------------
namespace app\runtuer\model;

use app\common\model\Base;

class Projects extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__RUNTUER_PROJECTS__';
    
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = true;
    protected $insert = [];
}