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
// | Collect.php  Version 2017/6/28 用户收藏API
// +----------------------------------------------------------------------
namespace app\member\model;

use app\common\model\Base;

class Collect extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__MEMBER_COLLECT__';
   
    //自动完成
    protected $auto     = [];
    protected $insert   = [];
    protected $update   = [];
    
    //定义时间戳字段名create_time, update_time, 自动完成
    protected $autoWriteTimestamp = true;
    /**
     * @Mark 关联归档：account
     * @author fancs
     * @return \think\model\relation\HasOne
     * @version 2017/6/28
     */
    public function account()
    {
        return $this->hasOne('account','id','uid','','LEFT');
    }
    /**
     * @Mark 关联归档：goods表
     * @author fancs
     * @return \think\model\relation\HasOne
     * @version 2017/6/28
     */
    public function goods()
    {
        return $this->hasOne('app\crossbbcg\model\Goods','id','goods_id','','LEFT');
    }
}