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
// | Account.php  Version 2017/6/29 圈子头衔模型
// +----------------------------------------------------------------------
namespace app\fans\model;

use app\common\model\Base;

class Actor extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__FANS_ACTOR__';
    //自动完成
    protected $auto     = ['langid'];
    protected $insert   = [];
    protected $update   = [];
    
    /**
     * @Mark: 修改字段属性值langid
     * @param $value
     * @return string
     * @Author: Fancs
     * @Version 2017/6/29
     */
    public function setLangidAttrAttr($value)
    {
        if(empty($value)){
            return LANG;
        }else{
            return $value;
        }
    }
    
}