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
// | Action.php  Version 1.0  2016/3/14
// +----------------------------------------------------------------------
namespace app\admin\model;

use app\common\model\Base;

class Role extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__ADMIN_ROLE__';
    
    //定义时间戳字段名create_time, update_time
    protected $autoWriteTimestamp = true;
    //自动完成
    protected $auto     = ['name', 'status'];
    protected $insert   = [];
    protected $update   = [];

    /**
     * @Mark:
     * @param $value
     * @return string
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/17
     */
    protected function setNameAttr($value)
    {
        return ucfirst($value);
    }
    
    /**
     * @Mark:自动设置状态
     * @param $value
     * @return int
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/17
     */
    protected function setStatusAttr($value)
    {
        if(array_key_exists('id', $this->data) && $this->getAttr('id') == 1) return 1;
        return autostatus($value);
    }
    
}