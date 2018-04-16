<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Expresstpl.php  Version 2017/7/23 快递模板API
// +----------------------------------------------------------------------
namespace app\bcwareexp\service;

use app\admin\service\Service;
use app\crossbbcg\model\GoodsSkuQuantity as GoodsSkuQuantityModel;
use app\crossbbcg\model\GoodsSku as GoodsSkuModel;
use app\seller\model\Transport as TransportModel;
use app\bcwareexp\model\Crossware as CrosswareModel;
use app\crossbbcg\model\Goods as GoodsModel;
use app\admin\model\Extend as ExtendModel;


class Expresstpl extends Service
{
    /**
     * @Mark:运费计算
     * @param $data = [
     *      'seller_id'       =>  1                         //加盟版需要此参数
     *      'city_id'       =>  32000
     *      'info'          =>  array(
     *              ['goods_id'=>1,'sku'=>235,'buy_num'=>10]
     *      )
     *
     * ];
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/24
     * @return  array
     */
    static public function calculateFee(&$data)
    {
        //遍历获取每个商品的价格和仓库
        $arr = [];//array(
        //['goods_id'=>1,                                   商品id
        //'goods_weight'=>0.1,                              商品重量
        //'num'=>20                                         购买该数量
        //'sku'=>132,                                       sku
        //'goods_price'=>10,                                商品价格
        //'ware_quantity'=>['B011'=>10,'z1'=>20],           该商品所有库存大于零的仓库
        //'full_ware_quantity'=>['B011'=>10,'z1'=>20]]);    该商品所有库存大于购买数量的仓库
        foreach ($data['info'] as $k => $v) {
            $arr1=[];
            //获取当前商品价格
            $arr1['goods_price'] = GoodsSkuModel::where(['sku' => $v['sku']])->value('sale_price');
            //筛选仓库,获取对应仓库编码和仓库库存
            $arr1['ware_quantity'] = $ware_arr = GoodsSkuQuantityModel::where(['sku' => $v['sku'], 'crossware_sku_quantity' => ['>', 0]])->column('crossware_sku_quantity', 'crossware_code');
            //将可以完全发货的仓库单独区分开
            foreach ($ware_arr as $kk => $vv) {
                if ($vv < $v['buy_num']) continue;
                $arr1['full_ware_quantity'][$kk] = $vv;
            }
            $arr1['num'] = $v['buy_num'];
            $arr1['goods_id'] = $v['goods_id'];
            $arr1['sku'] = $v['sku'];
            
            //获取商品重量和重量单位
            $goods_info = GoodsModel::get($v['goods_id']);
            //统一重量单位kg
            $goods_weight = weight_unit_convert($goods_info['weight'], $goods_info['weight_class_id']);
            $arr1['goods_weight'] = $goods_weight;
            //减库存方式
            $arr1['subtract'] = $goods_info['subtract'];
            //商品主图
            $arr1['sku_thumb'] = $v['thumb'];
            $arr[] = $arr1;
        }
        //根据系统商城配置，仓库编码获取运费模板
        $file = APP_PATH . 'crossbbcg/extra/index.php';
        $config = is_file($file) ? include $file : null;
        
        //系统默认邮费配置
        $system_default_freight = $config['default_shipping_freight'];//默认邮费
        $system_default_free_money = $config['default_free_money'];//默认包邮条件，满**包邮，若不满足，则用默认邮费
        
        //商品仓库运费数组，里面存放商品在运费最低时对应的仓库编码、运费模板等信息
        $goods_ware_tpl_arr = [];
        //array(['goods_id'=>1,'sku'=>123,'num'=>10,'freight'=>10.00,'warecode'=>'B011','tpl_id'=>1,'goods_weight'=>10])
        
        //判断是集运版还是加盟版
        //if ($config['system_shop_type'] == 'Crossbbcr') {
        
        //} else {
            foreach ($arr as $v) {
                //判断是否有仓库可以完全发货，如果存在，则优先走完全发货仓库
                if (isset($v['full_ware_quantity'])) {
                    //定义新数组，里面存放该商品在每个仓库运费最低时对应的仓库编码、模板id、运费等信息
                    $expresstpl_arr = [];
                    //遍历完全发货仓库，获取仓库对应所有运费模板并存入数组
                    foreach ($v['full_ware_quantity'] as $kk => $vv) {
                        //根据仓库编码获取所有运费模板id
                        $expresstplid = CrosswareModel::where(['code' => $kk])->find();
                        //判断仓库是否有绑定运费模板，若没有绑定，则运费模板id为0
                        if ($expresstplid &&  $expresstplid->expresstplid) {
                            //根据运费模板id查询所有运费模板
                            $expresstpl = TransportModel::whereIn('id', $expresstplid->expresstplid)->select();
                            $tpl_fee_arr = [];
                            //遍历该仓库下所有运费模板
                            foreach ($expresstpl as $tk => $tv) {
                                //根据运费模板计算该模板运费
                                $fee = self::feetype_weight($tv, $v['goods_weight'] * $v['num'], $v['goods_price'] * $v['num'], $data['city_id']);
                                $tpl_fee_arr[$tv['id']] = $fee;
                            }
                            //获取该仓库下运费最低的运费模板
                            
                            $arr2['freight'] = min($tpl_fee_arr);
                            $arr2['tpl_id'] = array_search($arr2['freight'], $tpl_fee_arr);
                        } else {
                            //判断是否满足系统默认包邮条件,若满足则包邮，否则使用系统默认邮费
                            if ($system_default_free_money <= $v['goods_price'] * $v['num']) {
                                $arr2['freight'] = 0;
                            } else {
                                $arr2['freight'] = $system_default_freight;
                            }
                            $arr2['tpl_id'] = 0;
                        }
                        $arr2['warecode'] = $kk;
                        $arr2['goods_id'] = $v['goods_id'];
                        $arr2['num'] = $v['num'];
                        $arr2['goods_price'] = $v['goods_price'];
                        $arr2['sku'] = $v['sku'];
                        $arr2['goods_weight'] = $v['goods_weight'];
                        $arr2['subtract'] = $v['subtract'];
                        $arr2['sku_thumb'] = $v['sku_thumb'];
                        $expresstpl_arr[] = $arr2;
                    }
                    //将所有仓库按运费进行升序排序
                    $new_arr = array_sort($expresstpl_arr, 'freight', 'asc');
                    //将运费最低对应的仓库和运费模板存入新数组中
                    $goods_ware_tpl_arr[] = $new_arr[0];
                } else {
                    //一件商品多仓发货
                    //将仓库按照库存降序排序
                    arsort($v['ware_quantity']);
                    
                    //定义剩余发货数变量、本次应发货数变量
                    $temp_num = $send_num = $v['num'];
                    
                    //该商品在不同仓库的发货数量、运费、仓库编码等信息
                    $expresstpl_arr = [];
                    foreach ($v['ware_quantity'] as $wk => $wv) {
                        //判断剩余发货数是否大于本次发货仓的库存量，如果大于则将该仓全部发完
                        if ($temp_num >= $wv) {
                            $send_num = $wv;
                        } else {
                            $send_num = $temp_num;
                        }
                        //根据仓库编码获取所有运费模板id
                        $expresstplid = CrosswareModel::where(['code' => $wk])->find();
                        //判断仓库是否有绑定运费模板，若没有绑定，则运费模板id为0
                        if ($expresstplid && $expresstplid->expresstplid) {
                            //根据运费模板id查询所有运费模板
                            $expresstpl = TransportModel::whereIn('id', $expresstplid->expresstplid)->select();
                            
                            $tpl_fee_arr = [];
                            //遍历该仓库下所有运费模板
                            foreach ($expresstpl as $tk => $tv) {
                                //根据运费模板计算该模板运费
                                $fee = self::feetype_weight($tv, $v['goods_weight'] * $send_num, $v['goods_price'] * $send_num, $data['city_id']);
                                $tpl_fee_arr[$tv['id']] = $fee;
                            }
                            //获取该仓库下运费最低的运费模板
                            $arr2['freight'] = min($tpl_fee_arr);
                            $arr2['tpl_id'] = array_search($arr2['freight'], $tpl_fee_arr);
                        } else {
                            //判断是否满足系统默认包邮条件,若满足则包邮，否则使用系统默认邮费
                            if ($system_default_free_money <= $v['goods_price'] * $send_num) {
                                $arr2['freight'] = 0;
                            } else {
                                $arr2[]['freight'] = $system_default_freight;
                            }
                            $arr2['tpl_id'] = 0;
                        }
                        $arr2['warecode'] = $wk;
                        $arr2['goods_id'] = $v['goods_id'];
                        $arr2['num'] = $send_num;
                        $arr2['goods_price'] = $v['goods_price'];
                        $arr2['sku'] = $v['sku'];
                        $arr2['goods_weight'] = $v['goods_weight'];
                        $arr2['subtract'] = $v['subtract'];
                        $arr2['sku_thumb'] = $v['sku_thumb'];
                        $expresstpl_arr[] = $arr2;
                        //判断该商品是否已经完全发完
                        $temp_num = $temp_num - $wv;
                        if ($temp_num <= 0) {
                            break;
                        }
                    }
                    $goods_ware_tpl_arr = array_merge($goods_ware_tpl_arr, $expresstpl_arr);
                }
            }
        //}
        //将数组按仓库进行分组，从新计算运费
        $group_ware_arr = arr_group($goods_ware_tpl_arr, 'warecode');
        
        //判断是否安装拆单插件
        $config = get_config('crossbbcg','index');
        $class = '\\split\\'.$config['splitclass'];
        $he_arr = $class::start($group_ware_arr);
        
        $total_freight = 0;//总运费
        $order_amount = 0;//订单商品总金额
        $total_taxes = 0;//总税费
        $total_points = 0;//总积分
        foreach ($he_arr as $k=>$v) {
            //遍历仓库下所有订单
            foreach($v as $kk=>$vv){
                $sku_str = '';
                $buy_nums = '';
                $goods_taxes_fee = '';
                $order_taxes = 0;//当前订单税费
                $order_points = 0;//当前订单所得积分
                $goods_ids = '';
                //遍历订单下所有商品，计算该订单总重量和总价格
                $order_total_weight = 0;
                $order_total_money = 0;
                $order_sku_thumb = '';//商品主图
                $subtract = '';//减库存方式
                foreach($vv as $kkk=>$vvv){
                    //获取商品总重量和总价格
                    $order_total_weight +=$vvv['goods_weight']*$vvv['quantity'];
                    $order_total_money +=$vvv['goods_price']*$vvv['quantity'];
                    $sku_str .= ','.$vvv['sku'];
                    $buy_nums .= ','.$vvv['quantity'];
                    $goods_taxes_fee .= ','.$vvv['taxes_fee'];
                    $order_taxes +=$vvv['taxes_fee'];
                    $subtract .=','.$vvv['subtract'];
                    $goods_ids .=','.$vvv['goods_id'];
                    $order_sku_thumb .=','.$vvv['sku_thumb'];
                    //获取该商品积分
                    $points = GoodsModel::where(['id'=>$vvv['goods_id']])->value('points');
                    $order_points +=$points*$vvv['quantity'];
                }
                $order_amount += $order_total_money;
                $total_taxes += $order_taxes;
                $total_points += $order_points;
                //根据该订单的总重量和总价格，计算该订单在该仓库中的最优运费模板
                //根据仓库编码获取所有运费模板id
                $expresstplid = CrosswareModel::where(['code' => $k])->find();
                //判断仓库是否有绑定运费模板，若没有绑定，则运费模板id为0
                if ($expresstplid && $expresstplid->expresstplid) {
                    //根据运费模板id查询所有运费模板
                    $expresstpl = TransportModel::whereIn('id', $expresstplid->expresstplid)->select();
                    $tpl_fee_arr = [];
                    //遍历该仓库下所有运费模板
                    foreach ($expresstpl as $tk => $tv) {
                        //根据运费模板计算该模板运费
                        $fee = self::feetype_weight($tv, $order_total_weight, $order_total_money, $data['city_id']);
                        $tpl_fee_arr[$tv['id']] = $fee;
                    }
                    //获取该仓库下运费最低的运费模板
                    $min_freight = min($tpl_fee_arr);
                    $min_freight_tpl_id = array_search($min_freight, $tpl_fee_arr);
                } else {
                    //判断是否满足系统默认包邮条件,若满足则包邮，否则使用系统默认邮费
                    if ($system_default_free_money <= $order_total_money) {
                        $min_freight = 0;
                    } else {
                        $min_freight = $system_default_freight;
                    }
                    $min_freight_tpl_id = 0;
                }
                unset($he_arr[$k][$kk]);
                if (stripos(',',$sku_str) >=0 ) $sku_str = substr($sku_str,1);
                if (stripos(',',$buy_nums) >=0 ) $buy_nums = substr($buy_nums,1);
                if (stripos(',',$goods_taxes_fee) >=0 ) $goods_taxes_fee = substr($goods_taxes_fee,1);
                if (stripos(',',$subtract) >=0 ) $subtract = substr($subtract,1);
                if (stripos(',',$goods_ids) >=0 ) $goods_ids = substr($goods_ids,1);
                if (stripos(',',$order_sku_thumb) >=0 ) $order_sku_thumb = substr($order_sku_thumb,1);
                
                $he_arr[$k][$kk]['goods']=['sku'=>$sku_str,'buy_nums'=>$buy_nums,'tax'=>$goods_taxes_fee,'subtract'=>$subtract,'goods_ids'=>$goods_ids,'sku_thumb'=>$order_sku_thumb];
                $he_arr[$k][$kk]['freight']=$min_freight;
                $he_arr[$k][$kk]['order_money']=$order_total_money;
                $he_arr[$k][$kk]['order_taxes']=$order_taxes;
                $he_arr[$k][$kk]['total_points']=$order_points;
                $he_arr[$k][$kk]['tpl_id']=$min_freight_tpl_id;
                $total_freight +=$min_freight;
            }
        }
        $res = array('data'=>$he_arr,'freight'=>$total_freight,'total_money'=>$order_amount,'total_taxes'=>$total_taxes,'total_points'=>$total_points);
        return $res;
    }
    
    /**
     * @Mark:按重计价运费配置
     * @param $templ
     * @param $goods_weight
     * @param $goods_price
     * @param $city_id
     * @return float|int|mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/25
     */
    static private function feetype_weight($templ, $goods_weight, $goods_price, $city_id)
    {
        //判断该模板是否包邮
        if ($templ['is_free'] == 1) return 0;
        //判断是否开启免邮规则
        if ($templ['open_freerule'] == 1) {
            //遍历免邮条件配置
            foreach ($templ['free_conf'] as $fk => $fv) {
                if ($fv['country_id'] > 0) {
                    //判断是否在指定免邮地区,如不在，则跳出当前循环
                    if (!in_array($city_id, explode(',', $fv['area_ids'])) && $fv['country_id'] != 0) continue;
                }
                //判断免邮条件
                if ($fv['freetype'] == 1) {
                    //判断是否在规定重量之内
                    if ($goods_weight > $fv['inweight']) continue;
                    $fee = 0;
                } else if ($fv['freetype'] == 2) {
                    //判断是否满足最低金额
                    if ($goods_price < $fv['upmoney']) continue;
                    $fee = 0;
                } else {
                    //判断是否在规定重量之内且大于最低包邮金额
                    if ($goods_weight > $fv['inweight'] && $goods_price < $fv['upmoney']) continue;
                    $fee = 0;
                }
                return $fee;
            }
        }
        //定义临时运费数组
        $arr = [];
        $default_fee = 0;
        foreach ($templ->fee_conf as $ck => $cv) {
            //默认配置
            if ($cv['country_id'] == 0) {
                //判断是否超过首重
                if ((float)$goods_weight < (float)$cv['start_standard']) {
                    $default_fee = (float)$cv['start_fee'];
                } else {
                    //计算续重运费和总费用
                    $extra = ceil(((float)$goods_weight - (float)$cv['start_standard']) / (float)$cv['add_standard']);
                    $default_fee = $extra * $cv['add_fee'] + $cv['start_fee'];
                }
            } else {
                //判断是否在指定地区
                if (!in_array($city_id, explode(',', $cv['area_ids']))) continue;
                //判断是否超过首重
                if ((float)$goods_weight < (float)$cv['start_standard']) {
                    //将邮费存在临时邮费数组中，方便取最小值(正常情况下,一个地区不会有多个邮费配置，但不排除误操作，因此邮费取最小值)
                    $temp_weight = (float)$cv['start_fee'];
                } else {
                    //计算超重运费
                    $extra = ceil(((float)$goods_weight - (float)$cv['start_standard']) / (float)$cv['add_standard']);
                    $temp_weight = $extra * $cv['add_fee'] + $cv['start_fee'];
                }
                $arr[] = $temp_weight;
            }
        }
        //判断临时运费数组是否大于0，如没有，则运费采用默认配置运费
        if (count($arr) > 0) {
            $fee = min($arr);
        } else {
            $fee = $default_fee;
        }
        return $fee;
    }
    
    /**
     * @Mark:拆单
     * @param $arr = array(
     * ['goods_id'=>1,'sku'=>123,'goods_price'=>500.00,'num'=>1,'weight'=>10,'rule'=>['price','<','2000']],
     * ['goods_id'=>1,'sku'=>123,'goods_price'=>500.00,'num'=>1,'weight'=>10,'rule'=>['price','<','2000']],
     * ['goods_id'=>2,'sku'=>521,'goods_price'=>500.00,'num'=>1,'weight'=>10,'rule'=>['price','<','2000']]
     * )
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/27
     * @return array
     */
    static private function chaidan(&$arr)
    {
        $arr3 = [];
        $arr2 = [];
        foreach ($arr as $k => $v) {
            if (!isset($arr[$k])) continue;
            unset($arr[$k]);
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
                $a = array_filter($arr, function ($v) use ($j) {
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
                        unset($arr[$key]);
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
        $b = self::hedan($a);
        return $b;
    }
    
    /**
     * @Mark:合单
     * @param $arr
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/28
     * @return array
     */
    static private function hedan($arr)
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