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
// | Offdisrules.php  Version 2017/3/23
// +----------------------------------------------------------------------
namespace app\crossbbcg\model;

use app\common\model\Base;

class Offdisrules  extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__CROSSBBCG_OFFDISRULES__';
    
    //定义时间戳字段名create_time, update_time
    protected $autoWriteTimestamp = true;
    //自动完成
    protected $auto     = ['status', 'isrecommend', 'opentime', 'langid'];
    protected $insert   = [];
    protected $update   = [];
    
    /**
     * @Mark:是否推荐
     * @param $value
     * @return int
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/28
     */
    protected function setIsrecommendAttr($value)
    {
        return autostatus($value);
    }
    
    /**
     * @Mark:开业时间
     * @param $value
     * @return false|int
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/28
     */
    protected function setOpentimeAttr($value)
    {
        return strtotime($value);
    }
}