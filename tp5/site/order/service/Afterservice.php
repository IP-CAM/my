<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Afterservice.php  Version 2017/7/23
// +----------------------------------------------------------------------
namespace app\order\service;

use app\order\model\Afterservice as AfterserviceModel;

class Afterservice
{
    /**
     * @Mark: 售后单申请拒绝
     * @param $id  int 售后单id
     * @return array
     * @Author: WangHuaLong
     */
    public static function refuse_apply($id){
        $after_service = AfterserviceModel::get($id);
        if($after_service===null){
            return ['code'=> 0,'msg'=>lang('after_service_null')];
        }
        
        if($after_service['status']==0){
            $after_service->status = 4;
            if($after_service->save()){
                return ['code'=> 1,'msg'=>lang('action_ok')];
            }else{
                return ['code'=> 0,'msg'=>lang('system_error')];
            }
            
        }else{
            return ['code'=> 0,'msg'=>lang('after_service_status_error')];
        }
    }
    
}