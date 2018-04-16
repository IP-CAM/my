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
// | Appeal.php  Version  2017/5/23
// +----------------------------------------------------------------------
namespace app\member\model;
use app\common\model\Base;
class Appeal extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__MEMBER_APPEAL__';
    protected $auto = ['langid'];
    protected $insert = ['create_time','status'=>1];
    protected $update = [];


    /**
     * @Mark:语言
     * @param $value
     * @return int
     * @Author: yang <502204678@qq.com>
     * @Version 2017/5/23
     */
    protected function setLangidAttr($value)
    {
        return getlangid($value);
    }


    /**
     * @Mark: create_time
     * @param $value
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/22
     * @return mixed
     */
    protected function setCreateTimeAttr($value){
        return time();
    }
}