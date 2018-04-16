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
// | 海关接口基类  Version 2016/11/10
// +----------------------------------------------------------------------
namespace app\common\libs;

abstract class Sea extends Baseexted
{
    /**
     * @Mark:向海关接口发送数据
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/13
     */
    abstract public function send_to_sea();
    
    /**
     * @Mark:回写请求
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/13
     */
    abstract public function callback();

}