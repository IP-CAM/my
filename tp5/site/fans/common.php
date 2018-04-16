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

/**
 * @Mark: 获取话题标题
 * @param $topic_id = $id, //话题id
 * @return string
 * @Author: Fancs
 * @Version 2017/5/26
 */
function get_topic_title($topic_id){
    $data['id'] = $topic_id;
    $topic = \app\fans\service\Topic::getOneTopic($data);
    return $topic->title;
}

/**
 * @Mark: 获取话题标题
 * @param $type_id = $id, //话题id
 * @return string
 * @Author: Fancs
 * @Version 2017/5/26
 */
function get_reported_type($type_id){
    $data['id'] = $type_id;
    $type = \app\fans\service\Reported::getReportedType($data);
    return $type->name;
}