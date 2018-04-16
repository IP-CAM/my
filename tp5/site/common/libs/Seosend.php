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
// | SEO推送  Version 2016/12/31
// +----------------------------------------------------------------------
namespace app\common\libs;

abstract class Seosend extends Baseexted
{
    /**
     * @Mark:推送主休
     * @param $data array
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/12/31
     */
    abstract public function push(&$data);
}