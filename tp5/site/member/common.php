<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>  Version 1.0  2016/3/12
// +----------------------------------------------------------------------

function get_level_name($id)
{
    $data['id'] = $id;
    $level = \app\member\service\Member::getOneLevel($data);
    return isset($level->name)? $level->name : '';
}

