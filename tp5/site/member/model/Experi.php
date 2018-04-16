<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Reply.php  Version 2017/5/22
// +----------------------------------------------------------------------

namespace app\member\model;
use app\common\model\Base;

class Experi extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__MEMBER_EXPERI__';
    protected $auto = ['langid'];
    protected $insert = [];
    protected $update = [];
    //protected $resultSetType = 'collection';
    
    /**
     * @Mark:语言设置
     * @param $value
     * @return mixed|string
     * @Author: fancs
     * @Version 2017/6/19
     */
    public function setLangidAttr($value)
    {
        if(empty($value)){
            return LANG;
        }else{
            return $value;
        }
    }
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
     * @Mark 关联归档：goods
     * @author fancs
     * @return \think\model\relation\HasOne
     * @version 2017/7/14
     */
    public function goods()
    {
        return $this->hasOne('app/crossbbcg/goods','id','goods_id','','LEFT');
    }
}