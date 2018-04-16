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
// | Posid.php  Version 2017/3/22  推荐位模型
// +----------------------------------------------------------------------
namespace app\cms\model;

use app\common\model\Base;

class Posid extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__CMS_POSID__';
    
    //定义时间戳字段名create_time, update_time
    protected $autoWriteTimestamp = true;
    //自动完成
    protected $auto     = ['status', 'langid'];
    protected $insert   = [];
    protected $update   = [];
    
    /**
     * @Mark: 关联数据模型：item
     * @return \think\model\relation\HasOne
     * @Author: fancs
     * @Version 2017/6/13
     */
    public function item()
    {
        return $this->hasOne('Item','id','item_id','','Left');
    }
    /**
     * @Mark: 关联数据模型：itemmodel
     * @return \think\model\relation\HasOne
     * @Author: fancs
     * @Version 2017/6/13
     */
    public function model()
    {
        return $this->hasOne('Itemmodel','id','model_id','','Left');
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