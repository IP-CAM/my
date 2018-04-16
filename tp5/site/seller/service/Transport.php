<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Transport.php  Version 2017/6/27
// +----------------------------------------------------------------------

namespace app\seller\service;

use app\common\model\Base;
use app\seller\model\Transport as TransportModel;
use think\Loader;
use app\crossbbcg\model\Goods;

class Transport extends Base
{
    
    /**
     * @Mark:运费模板列表
     * @param $data = [
     *      'shop_id'   => 1    //店铺id
     *  ]
     * @return false|static[]
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/27
     */
    static public function lists($data)
    {
        $data = TransportModel::all($data);
        return $data;
    }
    
    /**
     * @Mark:新增运费模板
     * @param $data = [
     *      'name'      =>  '华中大区',                       //模板名称
     *      'shop_id'   =>  2,                              //店铺id
     *      'is_free'   =>  '1',                            //是否包邮 1包邮 0不包邮
     *      'valuation' =>  'weight',                       //计价方式 weight按重计价 quantity按件计价 money按金额计价
     *      'status'    =>  1,                              //状态 1启用 0禁用
     *      'warecode'  =>  'z1'                            //仓库编码
     *      'fee_conf'  =>  [                               //按重计价运费配置
     *                          [
     *                              country_id=>1            国家
     *                              area=>[23000,630000],    地区
     *                              start_standard=>10,        首重
     *                              start_fee=>10,            首费
     *                              add_standard=>5,        续重
     *                              add_fee=>10            续费
     *                          ],
     *                  ],
     *      'fee_number_conf'=>[                            //按件计价运费配置
     *                          [
     *                              country_id=>1            国家
     *                              area=>[23000,630000],    地区
     *                              start_standard=>10,        首重
     *                              start_fee=>10,            首费
     *                              add_standard=>5,        续重
     *                              add_fee=>10            续费
     *                          ],
     *                  ],
     *      'fee_money_conf'=>[                             //按金额计价运费配置
     *                          [
     *                              rules=>[
     *                                          [
     *                                          up=>100.0,            金额上限(金额开始)
     *                                          down=>200.00,        金额下限(金额结束，如为空，则代表无限大，例 (100,+∞))
     *                                          basefee=>50.00        运费
     *                                          ]
     *                                      ],
     *                              area=>[23000,34100],    地区
     *                              country_id=>1,            国家
     *                          ]
     *                  ],
     *      'free_conf'     =>[                             //按重量计价免邮设置
     *                          [
     *                              country_id=>1,            国家
     *                              area=>[12000,32000]        地区
     *                              freetype=>1,            免邮规则 1重量 2金额 3重量+金额
     *                              upmoney=>200.00,        满xx元包邮
     *                              inweight=>0.00,            在xxkg内包邮
     *                          ]
     *                  ]
     *      'free_number_conf'=>[                           //按件计价免邮设置
     *                          [
     *                              country_id=>1,            国家
     *                              area=>[12000,32000]        地区
     *                              freetype=>1,            免邮规则 1件数 2金额 3件数+金额
     *                              upmoney=>200.00,        满xx元包邮
     *                              quantity=>10,            在xx件内包邮
     *                          ]
     *                  ]
     * ]
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/4
     * @return array
     */
    static public function add($data)
    {
        //数据验证
        $class = Loader::parseClass('seller', 'validate', 'Transport');
        $validate = Loader::validate($class);
        if (isset($data['scene'])) {
            $res = $validate->scene($data['scene'])->check($data);
            unset($data['scene']);
        } else {
            $res = $validate->check($data);
        }
        
        if (!$res) return ['code' => 0, 'msg' => $validate->getError()];
        
        //数据入库
        $res = TransportModel::create($data);
       
        return ['code'=>1,'data'=>$res];
       
    }
    
    /**
     * @Mark:修改运费模板
     * @param $data =[] 参数如上
     * @return array
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/28
     */
    static public function edit($data)
    {
        //数据验证
        $class = Loader::parseClass('seller', 'validate', 'Transport');
        $validate = Loader::validate($class);
        if (!$validate->scene('edit')->check($data)) return ['code' => 0, 'msg' => $validate->getError()];
        //数据更新
        $res = TransportModel::update($data);
        //返回结果
        return ['code'=>1,'data'=>$res];
    }
    
    /**
     * @Mark:改变运费模板状态
     * @param $data = [
     *      'id'        =>  2               //模板id
     *      'change'    =>  'enable|disable'//启用还是禁用
     *  ]
     * @return array
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/4
     */
    static public function changeStatus($data)
    {
        //判断模板是否存在
        $info = TransportModel::get($data['id']);
        if (!$info) return ['code' => 0, 'msg' => lang('template_not_exist')];
        
        if ($data['change'] == 'enable') {
            $re = TransportModel::update(['id' => $data['id'], 'status' => 1]);
        } else {
            $re = TransportModel::update(['id' => $data['id'], 'status' => 0]);
        }
        
        if ($re !== false) {
            return ['code'=>1,'data'=>$re];
        } else {
            return ['code' => 0, 'msg' => lang('service_buzy')];
        }
    }
    
}
