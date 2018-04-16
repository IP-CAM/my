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
// | Account.php  Version 2017/5/24
// +----------------------------------------------------------------------
namespace app\fans\model;

use app\common\model\Base;
use think\Db;

class Circle extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__FANS_CIRCLE__';

    //自动时间戳
    protected $autoWriteTimestamp=true;
    //自动完成
    protected $auto     = ['langid'];
    protected $insert   = ['name'];
    protected $update   = [];

    /**
     * @Mark 关联归档：circleCategory
     * @author fancs
     * @return \think\model\relation\HasOne
     * @version 2017/5/31
     */
    public function type()
    {
        return $this->hasOne('Type','id','type_id','','LEFT');
    }
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
     * @Mark:自动设置状态,添加
     * @param $value
     * @return int
     * @Author: fancs
     * @Version 2017/3/17
     */
    protected function setNameAttr($value)
    {
        return trim($value);
    }
}