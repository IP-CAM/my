<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | ShopAttention.php  Version 2017/6/29
// +----------------------------------------------------------------------

namespace app\seller\service;

use app\common\model\Base;
use app\seller\model\ShopAttention as ShopAttionModel;
use think\Loader;
use app\seller\model\Store;
use app\member\model\Account;

class ShopAttention extends Base
{
    /**
     * @Mark:获取店铺关注人数
     * @param $store_id int 店铺id
     * @return int
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/29
     */
    static public function getAttentionNum($store_id)
    {
        $count = ShopAttionModel::where('store_id', (int)$store_id)->count();
        return (int)$count;
    }
    
    /**
     * @Mark:获取我关注的店铺列表
     * @param $uid int 用户id
     * @return false|static[]
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/29
     */
    static public function getMyAttentionStore($uid)
    {
        // TODO 关注店铺列表
        return null;
    }
    
    /**
     * @Mark:关注店铺
     * @param $data = [
     *     'uid'       =>  1,用户id
     *     'store_id'  =>  1,店铺id
     * ]
     * @return bool|\think\response\Json
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/29
     */
    static public function addAttentionStore($data)
    {
        //判断店铺是否存在
        $store_res = Store::get($data['store_id']);
        if (!$store_res) return ['code'=>0,'msg'=>lang('store_not_exist')];
        
        //判断用户是否存在
        $member_res = Account::get($data['uid']);
        if (!$member_res) return ['code'=>0,'msg'=>lang('member_not_exist')];
        
        //判断用户是否关注过
        $result = ShopAttionModel::get($data);
        if ($result) return ['code'=>0,'msg'=>lang('had_attention')];
        
        //数据验证
        $class = Loader::parseClass('seller', 'validate', 'ShopAttention');
        $validate = Loader::validate($class);
        $res = $validate->check($data);
        if (!$res) return ['code' => 0, 'msg' => $validate->getError()];
        //数据入库
        $data['create_day'] = date('Y-m-d',time());
        $re = ShopAttionModel::create($data);
        if ($re) {
            return ['code'=>2,'data'=>$re];
        } else {
            return ['code' => 0, 'msg' => lang('service_buzy')];
        }
    }
    
    /**
     * @Mark:取消关注
     * @param $data = [
     *     'uid'       =>  1,
     *     'store_id'  =>  1
     * ]
     * @return array
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/29
     */
    static public function delAttention($data)
    {
        if (!isset($data['uid']) && !isset($data['store'])) return ['code' => 0, 'msg' => lang('param_error')];
        $re = ShopAttionModel::destroy($data);
        if ($re) {
            return ['code'=>1,'data'=>$re];
        } else {
            return ['code' => 0, 'msg' => lang('service_buzy')];
        }
    }
}
