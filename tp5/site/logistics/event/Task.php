<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | 触发式事件  Version 2017/1/19
// +----------------------------------------------------------------------
namespace app\logistics\event;

use think\queue\Job;

class Task
{
    
    /**
     * @Mark:执行失败时
     * @param $data
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/12/9
     */
    static public function failed($data)
    {
        
    }
}