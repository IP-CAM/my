<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: fancs
// +----------------------------------------------------------------------
// | Member.php  Version 2017/6/30 圈子成员模型
// +----------------------------------------------------------------------
namespace app\fans\model;

use app\common\model\Base;
use think\Db;

class Member extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__FANS_MEMBER__';
    
    //自动完成
    protected $auto     = [];
    protected $insert   = [];
    protected $update   = [];
    
    
    /**
     * @Mark 关联归档：circle
     * @author fancs
     * @return \think\model\relation\HasOne
     * @version 2017/5/31
     */
    public function circle()
    {
        return $this->hasOne('circle','id','circle_id','','LEFT');
    }
}