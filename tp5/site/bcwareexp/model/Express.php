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
// | Express.php  Version 2017/3/19 快递模型
// +----------------------------------------------------------------------
namespace app\bcwareexp\model;

use app\common\model\Base;

class Express extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__BCWAREEXP_EXPRESS__';
    
    //定义时间戳字段名create_time, update_time
    protected $autoWriteTimestamp = true;
    //自动完成
    protected $auto     = ['firstchar', 'isrecom', 'status', 'isdefault', 'langid'];
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
        $str = \common\Pinyin::ChineseToPinyin($this->getAttr('title'));
        return strtoupper(substr($str, 0, 1));
    }
    
    /**
     * @Mark:是否推荐
     * @param $value
     * @return int
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/28
     */
    protected function setIsrecomAttr($value)
    {
        return autostatus($value);
    }
    
    /**
     * @Mark:是否默认
     * @param $value
     * @return int
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/28
     */
    protected function setIsdefaultAttr($value)
    {
        return autostatus($value);
    }
    
    protected function setLangidAttr(){
        return LANG;
    }

}