<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: fancs
// +----------------------------------------------------------------------
// | Item.php  Version 2017/6/12 分类模型
// +----------------------------------------------------------------------
namespace app\cms\model;

use app\common\model\Base;

class Tags extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__CMS_TAGS__';
    
    //定义时间戳字段名create_time, update_time
    protected $autoWriteTimestamp = true;
    //自动完成
    protected $auto     = ['status', 'langid'];
    protected $insert   = [];
    protected $update   = [];
    
    /**
     * @Mark:语言
     * @param $value
     * @return int
     * @Author: fancs
     * @Version 2017/6/15
     */
    protected function setLangidAttr($value)
    {
        return LANG;
    }
    /**
     * @Mark: 修改字段属性值langid
     * @param $value
     * @return string
     * @Author: Fancs
     * @Version 2017/6/9
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