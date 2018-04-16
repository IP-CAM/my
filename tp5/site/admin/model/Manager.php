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
// | Manager.php  Version 1.0  2016/3/14  后台管理员
// +----------------------------------------------------------------------
namespace app\admin\model;

use app\common\model\Base;
use think\Lang;

class Manager extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__ADMIN_MANAGER__';
    
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = true;
    
    //自动完成
    protected $auto     = [];
    protected $insert   = ['reg_ip','reg_time','langid'];
    protected $update   = [];
    
    protected function setRegIpAttr(){
        return ipToInt(get_client_ip());
    }
    
    protected function setRegTimeAttr(){
        return time();
    }
    
    protected function setLangidAttr(){
        return LANG;
    }
}