<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Fancs
// +----------------------------------------------------------------------
// | Srcurity.php  Version 2017/7/6 密保问题API
// +----------------------------------------------------------------------
namespace app\member\service;

use app\admin\service\Service;

class Security extends Service
{
    /**
     * @Mark:获取用户密保问题
     * @param $uid
     * @return bool|false|static[]
     * @Author: fancs
     * @Version 2017/7/6
     */
    static public function get_security($uid)
    {
        $security = \app\member\model\Security::all(function ($query) use ($uid){
                $query->where(['uid'=>$uid]);
        });
        if(empty($security)) return false;
        return $security;
    }
    
    /**
     * @Mark:新增/编辑密保问题
     * @param $data=[
     *      //新增
     *      'uid'           =>  3       //用户id
     *      'question_id'   =>  9       //问题id\
     *      'value'         =>  '张飞'   //问题答案
     *      //修改
     *      'id'            =>  10        //主键
     *      'uid'           =>  3       //用户id
     *      'question_id'   =>  9       //问题id\
     *      'value'         =>  '张飞'   //问题答案
     * ]
     * @Author: fancs
     * @return bool|false
     * @Version 2017/7/6
     */
    static public function save_security(&$data)
    {
        if(isset($data['id']))
        {
            $res = \app\member\model\Security::update($data);
        }else{
            $res = \app\member\model\Security::create($data);
        }
        if($res) return true;
        return false;
    }
}