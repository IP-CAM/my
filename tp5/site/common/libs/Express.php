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
// | 快递接口  Version 2016/7/23
// +----------------------------------------------------------------------
namespace app\common\libs;

abstract class Express extends Baseexted
{
    /**
     * @Mark:获取快递结果
     * @param $data = [
     * 'shipping_no' => 快递单号
     * 'shipping_company' => 快递公司名称
     * ]
     * @return array = [
     * 'code' => 0,1 成功，失败
     * 'msg' => 失败原因，成功状态[运输中，派件，签收，等等]
     * 'data' => [
     * 'time' => 时间
     * 'station' => 站点
     * ]
     * ]
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/12
     */
    abstract public function response(&$data);

}