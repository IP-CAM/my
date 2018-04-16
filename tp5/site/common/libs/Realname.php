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
// | 实名认证接口  Version 2016/12/27
// +----------------------------------------------------------------------
namespace app\common\libs;

abstract class Realname extends Baseexted
{
    /**
     * @Mark:实现实名验证必须方法
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/12/27
     */
    abstract static public function check($item);
    
    /**
     * @Mark:将实名认证数据写入大数据中心
     * @param $item array
     * $item = ['realName'=>'张三', 'IDcard'=>'429006199909090909']
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/8/17
     */
    static protected function writeIdnumber($item)
    {
    
    }
}