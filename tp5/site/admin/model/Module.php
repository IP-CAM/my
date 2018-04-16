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
// | Module.php  Version 2016/10/19 模块
// +----------------------------------------------------------------------
namespace app\admin\model;

use app\common\model\Base;

class Module extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__ADMIN_MODULE__';
    
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = true;
    
    //自动完成
    protected $auto     = [];
    protected $insert   = ['name'];
    protected $update   = [];
    
    /**
     * @Mark:设置名称首字母大写
     * @param $value
     * @return string
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/23
     */
    protected function setNameAttr($value)
    {
        return ucfirst($value);
    }
    
}