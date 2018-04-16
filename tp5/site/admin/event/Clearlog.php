<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Clearlog.php  Version 2017/3/4 定时清理日志数据
// +----------------------------------------------------------------------
namespace app\admin\event;

use app\common\event\Crontab;

class Clearlog extends Crontab
{
    
    /**
     * @Mark: 定时任务执行体
     * @param null $params
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/4
     */
     static public function exec($params = null)
     {
         // TODO: Implement exec() method.
     }
}