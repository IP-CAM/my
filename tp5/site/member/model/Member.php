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
// | Account.php  Version 2017/3/20
// +----------------------------------------------------------------------
namespace app\member\model;

use app\common\model\Base;
use think\Db;

class Member extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__MEMBER_MEMBER__';

    //自动完成
    protected $auto     = ['token'];
    protected $insert   = [];
    protected $update   = [];
    
    public function setTokenAttr($value)
    {
        return md5(uniqid(mt_rand(1111,9999),true));
    }
}