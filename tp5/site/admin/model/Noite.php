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
// | Noite.php  Version 1.0 2017/7/23 公告 & 广播
// +----------------------------------------------------------------------
namespace app\admin\model;

use app\common\model\Base;

class Noite extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__ADMIN_NOITE__';
    
    //定义时间戳字段名create_time, update_time
    protected $autoWriteTimestamp = false;
    //自动完成
    protected $auto     = [];
    protected $insert   = ['create_time'];
    protected $update   = [];
    
    /**
     * @Mark:记录新增时间
     * @param $value
     * @return false|int
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/17
     */
    protected function setCreateTimeAttr($value)
    {
        return strtotime(date());
    }
}