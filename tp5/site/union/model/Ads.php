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
// | Ads.php  Version 2017/3/19  联盟广告
// +----------------------------------------------------------------------
namespace app\union\model;

use app\common\model\Base;

class Ads extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__UNION_ADS__';
    //定义时间戳字段名create_time, update_time
    protected $autoWriteTimestamp = true;
    //自动完成
    protected $auto     = ['firstchar', 'status', 'isrecommend', 'istop', 'langid'];
    protected $insert   = [];
    protected $update   = [];
    
    /**
     * @Mark:首字母
     * @param $value
     * @return string
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/20
     */
    protected function setFirstcharAttr($value)
    {
        if($value) return $value;
        $str = \common\Pinyin::ChineseToPinyin($this->getAttr('name'));
        return strtoupper(substr($str, 0, 1));
    }
    /**
     * @Mark:自动状态
     * @param $value
     * @return int
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/17
     */
    protected function setStatusAttr($value)
    {
        return autostatus($value);
    }
    
    /**
     * @Mark:是否推荐
     * @param $value
     * @return int
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/20
     */
    protected function setIsrecommendAttr($value)
    {
        return autostatus($value);
    }
    
    /**
     * @Mark:置顶
     * @param $value
     * @return int
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/20
     */
    protected function setIstopAttr($value)
    {
        return autostatus($value);
    }
    
    /**
     * @Mark:语言
     * @param $value
     * @return int
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/20
     */
    protected function setLangidAttr($value)
    {
        return getlangid($value);
    }
}