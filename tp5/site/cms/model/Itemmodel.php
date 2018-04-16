<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: fancs
// +----------------------------------------------------------------------
// | Item.php  Version 2017/6/12 分类模型模型
// +----------------------------------------------------------------------
namespace app\cms\model;

use app\common\model\Base;

class Itemmodel extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__CMS_ITEMMODEL__';
    
    //定义时间戳字段名create_time, update_time
    protected $autoWriteTimestamp = true;
    //自动完成
    protected $auto     = ['langid'];
    protected $insert   = [];
    protected $update   = [];
    
    /**
     * @Mark: 关联数据模型：itemattr
     * @return \think\model\relation\HasOne
     * @Author: fancs
     * @Version 2017/6/13
     */
    public function attr()
    {
        return $this->hasOne('Itemattr','id','attr_id','','Left');
    }
    
    /**
     * @Mark: 关联数据模型：itemsprcifi
     * @return \think\model\relation\HasOne
     * @Author: fancs
     * @Version 2017/6/13
     */
    public function type()
    {
        return $this->hasOne('Itemtype','id','type_id','','Left');
    }
    /**
     * @Mark: 关联数据模型：item
     * @return \think\model\relation\HasOne
     * @Author: fancs
     * @Version 2017/6/15
     */
    public function item()
    {
        return $this->hasOne('Item','id','item_id','','Left');
    }
}