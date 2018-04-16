<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Basecron.php  Version 2017/3/4 定时任务父类
// +----------------------------------------------------------------------
namespace app\common\event;

abstract class Crontab
{
    //定时任务需要执行的代码体
    abstract static public function exec($params = null);
}