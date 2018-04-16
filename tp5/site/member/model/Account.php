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
use traits\model\SoftDelete;


class Account extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__MEMBER_ACCOUNT__';
    //自动完成
    protected $auto     = [];
    protected $insert   = ['reg_time','reg_ip','idcard'];
    protected $update   = [];
    
   
    
    /**
     * @Mark 关联归档：level
     * @author fancs
     * @return \think\model\relation\HasOne
     * @version 2017/5/27
     */
    public function level()
    {
        return $this->hasOne('level','id','levelid','','LEFT');
    }
    /**
     * @Mark:idcard
     * @param $value
     * @return string
     * @Author: fancs
     * @Version 2017/5/12
     */
    protected function setIdcardAttr($value)
    {
        return getRandOnlyId();
    }
    /**
     * @Mark:reg_time
     * @param $value
     * @return string
     * @Author: fancs
     * @Version 2017/5/10
     */
    protected function setRegTimeAttr($value)
    {
        return time();
    }
    /**
     * @Mark:reg_ip
     * @param $value
     * @return string
     * @author: fancs
     * @Version 2017/5/10
     */
    protected function setRegIpAttr($value)
    {
        return ipToInt(get_client_ip());
    }
    
    protected function getRegIpAttr($value){
        return long2ip($value);
    }

}