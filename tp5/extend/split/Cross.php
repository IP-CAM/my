<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// ----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | 跨境拆单插件  Version 2016/11/8
// +----------------------------------------------------------------------
namespace split;

use app\common\libs\Split;
use app\crossbbcg\model\Goods as GoodsModel;
use app\bcwareexp\model\Crossware as CrosswareModel;

class Cross extends Split
{
    /**
     * @Mark:接口说明
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/7/24
     */
    public static function setup()
    {
        return array(
            'subjection'    => 'split',             //隶属
            'code'          => 'Cross',          // 扩展器名称名
            'name'          => lang('Cross_split'), // 扩展器名称翻译名
            'description'   => lang('Cross_split_desc'), // 扩展器名称翻译描述
            'version'       => '1.0',                       //版本
            'author'        => 'Runtuer',                   //作者
            'website'       => 'http://www.runtuer.com',    //出处
            'upgrade'     => '/cmfup/ver2.php',             //升级位置
            //基本配置项
            'config'        => array(),
            //特殊配置项目，可自行定义
            'special'       => array(
                'logo'          => 'croscart.png',
                'appofficial'   => 'http://www.runtuer.com/',   //官方
            ),
        );
    }
    
    /**
     * @Mark:获取商品
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/8
     */
    public function getlist()
    {
        // TODO: Implement getlist() method.
    }
    
    /**
     * @Mark:拆单入口
     * @param $data array 需要拆单的数据
     * @Author: yang <502204678@qq.com>
     * @Version 2017/8/30
     * @return array
     */
    static public function start($data)
    {
        $array = [];
        foreach ($data as $k => $v) {
            $initcdarr = [];
            //获取该仓库的拆单规则
            $rule = CrosswareModel::where(['code' => $k])->value('rule');
            $rule = empty($rule) ? [] : explode(',', $rule);
            //若未设置拆单规则，则不去拆单
            if (empty($rule)) {
                foreach ($v as $kk=>$vv) {
                    $v[$kk]['quantity']=$vv['num'];
                    $v[$kk]['taxes_fee']=0;
                    unset($v[$kk]['num']);
                }
                $array[$k]=array($v);
                continue;
            }
            foreach ($v as $kk => $vvv) {
                $vvv['quantity'] = 1;
                $count = $vvv['num'];
                unset($vvv['num']);
                $vvv['rule'] = $rule;
                $orderSon = array($vvv);
                for ($i = 0; $i < $count; $i++) {
                    $initcdarr = array_merge($initcdarr, $orderSon);
                }
            }
            $res = self::split($initcdarr);
            $array[$k]=$res;
        }
        return $array;
    }
    
    /**
     * @Mark:拆单
     * @param $data array 需要拆单的数据
     * array(
     * ['goods_id'=>1,'sku'=>123,'goods_price'=>500.00,'num'=>1,'weight'=>10,'rule'=>['price','<','2000']],
     * ['goods_id'=>1,'sku'=>123,'goods_price'=>500.00,'num'=>1,'weight'=>10,'rule'=>['price','<','2000']],
     * ['goods_id'=>2,'sku'=>521,'goods_price'=>500.00,'num'=>1,'weight'=>10,'rule'=>['price','<','2000']]
     * )
     * @Author: yang <502204678@qq.com>
     * @Version 2017/8/30
     * @return array
     */
    static private function split($data)
    {
        $arr3 = [];
        $arr2 = [];
        foreach ($data as $k => $v) {
            if (!isset($data[$k])) continue;
            unset($data[$k]);
            $rule = $v['rule'];
            $taxes = GoodsModel::where(['id'=>$v['goods_id']])->value('tax_rate');
            $goods_taxes = $taxes*$v['goods_price']/100;
            if (count($rule) == 3) {
                $rule[1] = html_entity_decode($rule[1]);
                eval("\$s=(\$v['goods_price'] $rule[1] $rule[2]);");
            } else {
                $v['taxes_fee']=$goods_taxes;
                $arr2[] = $v;continue;
            }
            if ($s) {//根据拆单规则拆单
                $j = $rule[2] - $v['goods_price'];
                //筛选出所有可以和该商品组合的记录
                $a = array_filter($data, function ($v) use ($j) {
                    return $v['goods_price'] < $j;
                });
                $arr1 = [];
                $v['taxes_fee']=0;
                $arr1[] = $v;
                foreach ($a as $key => $val) {
                    if ($j - $val['goods_price'] < 0) {
                        continue;
                    } else {
                        $j -= $val['goods_price'];
                        unset($data[$key]);
                        $val['taxes_fee']=0;
                        $arr1[] = $val;
                    }
                }
                $arr3[] = $arr1;
            } else {//不拆单
                $v['taxes_fee']=$goods_taxes;
                $arr2[] = $v;
            }
        }
        $arr3[] = $arr2;
        //过滤空数组
        $a = array_filter($arr3, function ($v) {
            return (!empty($v));
        });
        $b = self::merge($a);
        return $b;
    }
    
    /**
     * @Mark:合单
     * @param $arr array 需要合单的数据
     * @Author: yang <502204678@qq.com>
     * @Version 2017/8/30
     * @return array
     */
    static private function merge($arr)
    {
        $result = [];
        foreach ($arr as $k => $v) {
            unset($arr[$k]);
            $arr1 = [];
            foreach ($v as $kk => $vv) {
                if (!isset($v[$kk])) continue;
                unset($v[$kk]);
                $a = array_filter($v, function ($v) use ($vv) {
                    return ($vv['sku'] == $v['sku']);
                });
                //将同一商品进行合并
                foreach ($a as $ak => $av) {
                    $vv['quantity']++;
                    $vv['taxes_fee'] +=$av['taxes_fee'];
                    unset($v[$ak]);
                }
                $arr1[] = $vv;
            }
            $result[] = $arr1;
        }
        return $result;
    }
    
}