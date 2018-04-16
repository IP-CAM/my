<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Crossware.php  Version 2017/7/23 跨境仓库API
// +----------------------------------------------------------------------
namespace app\bcwareexp\service;

use app\admin\service\Service;
use app\seller\model\Store as StoreModel;
use app\bcwareexp\model\Crossware as CrosswareModel;

class Crossware extends Service
{
    /**
     * @Mark:给入驻商家建立默认仓
     * @param $seller_id int 商家id
     * @Author: yang <502204678@qq.com>
     * @Version 2017/9/7
     * @return array
     */
    static public function create_default_crossware($seller_id)
    {
        //检测是否开通店铺
        $seller_info = StoreModel::where(['seller_id'=>$seller_id,'status'=>1])->find();
        if (!$seller_info) return ['code'=>0,'msg'=>lang('Store_not_exist')];
        
        //生成唯一仓库编码
        while(true){
            $code = 'D'.generate_code(5);
            $check = CrosswareModel::where(['code'=>$code])->count();
            if(!$check){
                break;
            }
        }
        $data = [
            'code'=>$code,
            'name'=>$seller_info['seller_name']
        ];
        $res = CrosswareModel::create($data);
        return ['code'=>1,'data'=>$res];
    }
}