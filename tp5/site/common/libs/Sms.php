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
// | 短信接口  Version 2016/7/23
// +----------------------------------------------------------------------
namespace app\common\libs;

abstract class Sms extends Baseexted
{
    //短信发送接口
    static abstract  public function send($mobile, $content);

    //短信发送结果接口
    abstract static public function response($result);

}