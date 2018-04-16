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
// | 保险服务接口  Version 2016/7/23
// +----------------------------------------------------------------------
namespace app\common\libs;

abstract class Lnsurance extends Baseexted
{
    /**
     * @Mark:请求保险
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/12
     */
    abstract public function request(&$data);
    
    /**
     * @Mark:获取保险赔付
     * @param $data
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/12
     */
    abstract public function response(&$data);
}