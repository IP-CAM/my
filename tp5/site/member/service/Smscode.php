<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Fancs
// +----------------------------------------------------------------------
// | Smscode.php  Version 2017/7/5 短信验证码API
// +----------------------------------------------------------------------
namespace app\member\service;

use app\admin\service\Service;

class Smscode extends Service
{
    /**
     * @Mark：验证短信验证码
     * @param $data = [
     *      'mobile'    =>  1311111111  //手机号码
     *      'code'      =>  788945      //验证码
     *
     * ]
     * @return mixed|string
     * @author Fancs
     * @version 2017/7/5
     */
    static public function get_code(&$data)
    {
        $code = \app\member\model\Smscode::get(function ($query) use ($data){
            $query->where(['mobile'=>$data['mobile'],'status'=>1])->order('id desc');
        });
        if($code){
            if(($code['code'] == $data['code']) && ($code['expire'] > time())){
                return $code['code'];
            }else{
                //验证码过期
                return json(['code'=>0,'msg'=>lang('SMS code expire')]);
            }
        }
        return json(['code'=>0,'msg'=>lang('SMS code error')]);
    }
    /**
     * @Mark:
     * @param $data=[
     *      'uid'   =>  1       //用户id
     *      ''
     * ];
     * @return bool
     * @Author: fancs
     * @Version 2017/7/7
     */
    static public function add_smscode(&$data)
    {
        if(is_array($data)){
            $res = \app\member\model\Smscode::create($data);
            if($res){
                return true;
            }
            return false;
        }else{
            return false;
        }
        
    }
    
}