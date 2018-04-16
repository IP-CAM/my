<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: fancs
// +----------------------------------------------------------------------
// | Nav.php  Version 2017/6/28 导航管理模型
// +----------------------------------------------------------------------
namespace app\cms\model;

use app\common\model\Base;

class Nav extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__CMS_NAV__';
    
    //自动完成
    protected $auto     = ['langid'];
    protected $insert   = [];
    protected $update   = [];
    
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
    
    /**
     * @Mark:是否新页面打开
     * @param $value
     * @return int
     * @Author: Fancs
     * @Version 2017/6/28
     */
    protected function setTypeAttr($value)
    {
        return autostatus($value);
    }
}