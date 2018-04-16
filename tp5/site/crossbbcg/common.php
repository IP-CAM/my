<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>  Version 1.0  2017/3/9
// +----------------------------------------------------------------------

/**
 * @Mark:统一重量单位kg
 * @param $weight
 * @param $unit
 * @Author: yang <502204678@qq.com>
 * @Version 2017/7/26
 * @return number
 */
function weight_unit_convert($weight, $unit)
{
    switch ($unit) {
        case 'g':
            return $weight / 1000;
            break;
        default :
            return $weight;
    }
}

/**
 * @Mark:将数组按照某个键值分组
 * @param $array =array(
 * ['A'=>1,'B'=>10],
 * ['A'=>1,'C'=>'20'],
 * ['D'=>20,'B'=>5]
 * );
 * 得到新数组array(
 * '1'=>array(['A'=>1,'B'=>10],['A'=>1,'B'=>'20']),
 * '20'=>array(['A'=>20,'D'=>5]))
 * @param $value string 需要分组的键值对应的键名
 * @Author: yang <502204678@qq.com>
 * @Version 2017/7/26
 * @return array
 */
function arr_group($array, $value)
{
    $result = array();
    foreach ($array as $k => $v) {
        $result[$v[$value]][] = $v;
    }
    return $result;
}

/**
 * @Mark:获取广告位信息
 * @param $id
 * @return string|\think\response\Json
 * @Author: yang <502204678@qq.com>
 * @Version 2017/8/4
 */
function get_ad_position($id){
    $where = ['model'=>'AdPosition','where'=>['id'=>$id]];
    $data = \app\crossbbcg\service\AdPosition::getOne($where);
    return $data['data'];
}

/**
 * @Mark:获取商品信息
 * @param $goods_id
 * @return null|static
 * @Author: yang <502204678@qq.com>
 * @Version 2017/8/8
 */
function get_goods_info($goods_id){
    $data = \app\crossbbcg\model\Goods::get($goods_id);
    return $data;
}

