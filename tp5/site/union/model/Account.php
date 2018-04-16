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
// | Ads.php  Version 2017/3/19  联盟广告
// +----------------------------------------------------------------------
namespace app\union\model;

use app\common\model\Base;

class Account extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__UNION_ACCOUNT__';
    //定义时间戳字段名create_time, update_time
    protected $autoWriteTimestamp = true;
    //自动完成
    protected $auto     = [];
    protected $insert   = [];
    protected $update   = [];
    
}