<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Fancs
// +----------------------------------------------------------------------
// | Without.php  Version 2017/6/28 会员收藏API
// +----------------------------------------------------------------------
namespace app\member\service;

use app\admin\service\Service;

class Collect extends Service
{
    /**
     * @Mark：查询用户收藏
     * @param $uid  用户id
     * @return mixed|string
     * @author Fancs
     * @version 2017/6/28
     */
    static public function get_collect($uid)
    {
        if($uid <1){
            return json(['code'=>0,'msg'=>lang('Account exit')]);
        }
        $collect = \app\member\model\Collect::all(function ($query) use ($uid){
            $query->where('uid',$uid);
        });
        
        return $collect;
    }

    /**
     * @Mark:新增收藏
     * @param $data = [
     *      'uid'           =>  3                   //用户id/手机号/邮箱/用户名
     *      'goods_id'      =>  100                 //商品的id
     * ]
     * @return bool|\think\response\Json
     * @Author: fancs
     * @Version 2017/6/28
     */
    static public function add_collect(&$data)
    {
        if($data['uid']<1){
            return json(['code'=>0,'msg'=>lang('Account logout')]);
        }
        $param = [
            'uid'=>$data['uid'],
            'goods_id'=>$data['goods_id']
        ];
    
        //判断是否已收藏
        if(\app\member\model\Collect::get($param))
            return json(['code'=>0,'msg'=>lang('Collect already exist')]);;
        //新增
         \app\member\model\Collect::create($data);
         return true;
        
    }
    
    /**
     * @Mark:删除收藏
     * @param $id
     * @return bool
     * @Author: fancs
     * @Version 2017/7/1
     */
    public static function del_collect($id)
    {
        \app\member\model\Collect::destroy($id);
        return true;
    }
}