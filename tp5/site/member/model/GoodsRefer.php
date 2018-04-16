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
// | Refer.php  Version 1.0  2017/5/22
// +----------------------------------------------------------------------

namespace app\member\model;

use app\common\model\Base;

class GoodsRefer extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__MEMBER_GOODS_REFER__';
    protected $pk = 'id';
    protected $auto = ['ip', 'goods_id', 'user_id'];
    protected $insert = ['status' => 0];
    protected $update = [];
    protected $autoWriteTimestamp = true;
    
    /**
     * @Mark ip
     * @param  $value
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/22
     * @return string
     */
    protected function setIpAttr($value)
    {
        return ipToInt(get_client_ip());
    }
    
    /**
     * @Mark time
     * @param $value
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/22
     * @return string
     */
    protected function setTimeAttr($value)
    {
        return time();
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
        if (empty($value)) {
            return LANG;
        } else {
            return $value;
        }
    }
    
    /**
     * @Mark:自动状态
     * @param $value
     * @return int
     * @Author: yang <502204678@qq.com>
     * @Version 2017/5/22
     */
    protected function setGoodsIdAttr($value)
    {
        return autostatus($value);
    }
    
    /**
     * @Mark:自动状态
     * @param $value
     * @return int
     * @Author: yang <502204678@qq.com>
     * @Version 2017/5/22
     */
    protected function setUserIdAttr($value)
    {
        return autostatus($value);
    }
}