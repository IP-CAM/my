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
// | Dbs.php  Version 2016/7/23
// +----------------------------------------------------------------------
namespace app\b2b2c\model;
use \think\Model;

class Dbs extends Model
{
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = true;
    protected $insert = ['name'];
    
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