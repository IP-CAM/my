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
// | 仓库接口  Version 2016/7/25
// +----------------------------------------------------------------------
namespace app\common\libs;

abstract class Warehouse extends Baseexted
{
    //仓库名称
    public $name;
    //仓库接口地址
    public $openapiurl;
    //仓库标识
    public $identity;
    
    /**
     * @Mark:请求数据
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/12
     */
    abstract static public function request(&$data);
    
    /**
     * @Mark:接收数据
     * @param $data
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/12
     */
    abstract static public function redponse(&$data);
}