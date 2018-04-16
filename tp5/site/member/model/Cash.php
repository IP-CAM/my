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
// | Account.php  Version 2017/3/20
// +----------------------------------------------------------------------
namespace app\member\model;

use app\common\model\Base;
use think\Db;

class Cash extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__MEMBER_CASH__';
    //自动完成
    protected $auto = ['create_time','order_sn','pay_sn','nickname'];
    protected $insert   = [];
    protected $update   = [];
    /**
     * @Mark 关联归档：account
     * @author fancs
     * @return \think\model\relation\HasOne
     * @version 2017/5/27
     */
    public function account()
    {
        return $this->hasOne('account','id','uid','','LEFT');
    }
    /**
     * @Mark 关联归档：account
     * @author fancs
     * @return \think\model\relation\HasOne
     * @version 2017/5/27
     */
    public function user()
    {
        return $this->hasOne('account','id','fuid','','LEFT');
    }
    /**
     * @Mark:创建时间
     * @param $value
     * @return int
     * @Author: fancs
     * @Version 2017/7/1
     */
    public function setCreateTimeAttr($value)
    {
        return time();
    }
    
    /**
     * @Mark:设置订单号
     * @param $value
     * @param $data
     * @return string
     * @Author: fancs
     * @Version 2017/7/1
     */
    public function setOrderSnAttr($value,$data)
    {
        return get_order_sn($data['uid']);
    }
    /**
     * @Mark:设置支付单号
     * @param $value
     * @param $data
     * @return string
     * @Author: fancs
     * @Version 2017/7/1
     */
    public function setPaySnAttr($value,$data)
    {
        return get_order_sn($data['uid']);
    }
    /**
     * @Mark:会员昵称
     * @param $value
     * @param $data
     * @return string
     * @Author: fancs
     * @Version 2017/7/1
     */
    public function setNickname($value,$data)
    {
        return get_username($data['uid']);
    }
}