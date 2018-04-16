<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Seller.php  Version 店铺  2017/5/27
// +----------------------------------------------------------------------

namespace app\seller\service;

use app\common\model\Base;
use think\Loader;
use app\seller\model\Store as Mseller;

class Seller extends Base
{
    
    /**
     * @Mark:店铺列表
     * @param $where array 查询条件[
     *      'seller_name'       =>  ['like','%阿里巴巴%'],
     *      'create_time'       =>  ['>','12312313'],
     *      'seller_id'         =>  1,
     *      'mobile'            =>  13333333333,
     *      'email'             =>  123@qq.com
     *  ]
     * @param $order array 排序条件[
     *      'id'        =>  'desc|asc',
     *      'create_time'=> 'desc|asc',
     *      'shop_grade'=>  'desc|asc',
     *  ]
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/22
     * @return mixed
     */
    static public function sellerList($where = [], $order = ['id' => 'desc'])
    {
        $re = Mseller::where($where)->order($order)->paginate(25);
        return $re;
    }
    
    /**
     * @Mark:添加线上店铺
     * @param $data = [
     *      'seller_id'     => '1'  商户登录账户id
     * ]
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/27
     * @return array
     */
    static public function addSeller($data)
    {
        if (isset($data['shop_account'])) unset($data['shop_account']);
        //转换主营类目数据结构
        if (isset($data['goods_cat'])) {
            $arr = explode(',',$data['goods_cat']);
            $data['goods_cat'] = [];
            foreach ($arr as $v) {
                $data['goods_cat'][$v]=0;
            }
        }
        //判断商户是否存在
        $seller = \app\seller\model\Account::where(['id' => $data['seller_id']])->find();
        if (!$seller) return ['code' => 0, 'msg' => lang('shop_account_not_exist')];
        
        //数据验证
        $seller_class = Loader::parseClass('seller', 'validate', 'Store');
        $validate = Loader::validate($seller_class);
        $re = $validate->scene('add')->check($data);
        if (!$re) return ['code' => 0, 'msg' => $validate->getError()];
        
        //数据入库
        $res = Mseller::create($data);
        
        return ['code'=>1,'data'=>$res];
        
    }
    
    /**
     * @Mark:店铺修改
     * @param $data =[
     *      'id'        =>      1   店铺id
     *      ...                     其他修改字段
     * ]
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/22
     * @return array
     */
    static public function aditSeller($data)
    {
        if (isset($data['shop_account'])) unset($data['shop_account']);
        //判断店铺id是否存在
        if (!isset($data['id'])) return ['code' => 0, 'msg' => lang('param_error')];
        
        //数据验证
        $seller_class = Loader::parseClass('seller', 'validate', 'Store');
        $validate = Loader::validate($seller_class);
        $re = $validate->scene('edit')->check($data);
        if (!$re) return ['code' => 0, 'msg' => $validate->getError()];
        
        //数据更新
        $result = Mseller::update($data);
        if ($result !== false) {
            return ['code'=>1,'data'=>$result];
        } else {
            return ['code' => 0, 'msg' => lang('fail')];
        }
    }
    
    /**
     * @Mark:更新店铺评分
     * @param $seller_id  int 商户id
     * @return bool|\think\response\Json
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/29
     */
    static public function updateShopScore($seller_id)
    {
        //获取店铺平均分
        $avg_score = \app\member\model\Goodscomment::where('shop_id', $seller_id)->avg('score');
        //将平均分更新到店铺表中
        $re = Mseller::where(['seller_id' => $seller_id])->update([ 'shop_grade' => $avg_score]);
        if ($re !== false) {
            return ['code'=>1,'data'=>$re];
        } else {
            return ['code' => 0, 'msg' => lang('service_buzy')];
        }
    }
}