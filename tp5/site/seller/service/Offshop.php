<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Offshop.php  Version 2017/5/31 线下门店
// +----------------------------------------------------------------------

namespace app\seller\service;

use app\seller\model\Offshop as Offshops;
use think\Loader;
use app\admin\service\Service;

class Offshop extends Service
{
    /**
     * @Mark:新增线下门店
     * @param $data = [
     *      'seller_name'   =>''店铺名
     *      'mobile'        =>'1333333333'
     *      'phone'         =>'02777777777'
     *      'country'       =>''国id
     *      'province'      =>''省id
     *      'city'          =>''市id
     *      'address'       =>''详细地址
     *      'lat'           =>''高德地图纬度
     *      'lng'           =>''经度
     *      'logo'          =>''店铺图片地址
     *      'description'   =>''店铺描述
     *      'cat_id'        =>''店铺类型id，
     *      'principal'     =>''负责人
     * ]
     * @Author: yang <502204678@qq.com>
     * @Version 2017/5/31
     * @return array
     */
    static public function addShop($data)
    {
        //判断商户是否存在
        $seller = \app\seller\model\Account::where(['id' => $data['seller_id'], 'status' => 1])->find();
        if (!$seller) return ['code' => 0, 'msg' => lang('shop_account_not_exist')];
        
        //数据验证
        $offshop_class = Loader::parseClass('seller', 'validate', 'Offshop');
        $validate = Loader::validate($offshop_class);
        $re = $validate->check($data);
        if (!$re) return ['code' => 0, 'msg' => $validate->getError()];
        
        //数据插入
        $res = Offshops::create($data);
        
        return ['code' => 1, 'data' => $res];
        
    }
    
    /**
     * @Mark:修改线下门店
     * @param $data = [
     *      'id'            =>'1'       门店id
     *      'seller_name',  =>'yang'    店铺名称
     *      'logo'          =>'123.png',店铺logo
     *      'lat'           =>123.12,   经度
     *      'lng'           =>12.12,    纬度
     *      'province'      =>1,
     *      'city'          =>1,
     *      'area'          =>2,
     *      'address'       =>'大学城',
     *      'description'   =>'哔哩哔哩哔哩哔哩吧'
     * ]
     * @Author: yang <502204678@qq.com>
     * @Version 2017/5/31
     * @return array
     */
    static public function editShop($data)
    {
        //判断店铺id是否存在
        if (!isset($data['id']) || empty($data['id'])) return ['code' => 0, 'msg' => lang('id_must')];
        
        //数据验证
        $offshop_class = Loader::parseClass('seller', 'validate', 'Offshop');
        $validate = Loader::validate($offshop_class);
        $re = $validate->scene('edit')->check($data);
        if (!$re) return ['code' => 0, 'msg' => $validate->getError()];
        
        //数据更新
        $re = Offshops::update($data);
        
        return ['code' => 1, 'data' => $re];
        
    }
}
