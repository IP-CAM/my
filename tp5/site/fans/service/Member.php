<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Fancs
// +----------------------------------------------------------------------
// | Member.php  Version 2017/6/30 圈子成员API
// +----------------------------------------------------------------------
namespace app\fans\service;

use app\admin\service\Service;

class Member extends Service
{
    /**
     * @Mark:查询圈子成员
     * @param $data =[
     *      'circle_name'  =>  '技术交流'      //圈子名称或id
     *      'username'     =>  'fancs'        //会员昵称或id
     * ]
     * @return mixed
     * @Author: Fancs
     * @Version 2017/6/30
     */
    static public function get_member(&$data=[])
    {
        $data['circle_name|circle_id'] = $data['circle_name'];
        unset($data['circle_name']);
        $data['account_name|uid'] = $data['username'];
        unset($data['username']);
        $type = \app\fans\model\Member::all(function($query) use ($data){
            $query->where($data);
        });
        
        if (empty($type)) return false;
        return $type;
    }
    
    /**
     * @Mark: 新增/编辑圈子成员
     * @param $data =[
     *      //新增
     *      'circle_id'             => 2,           //圈子id
     *      'circle_name'           => 'php技术猿圈' //圈名
     *      'uid'                   => 3            //成员用户id
     *      'account_name'          => 'fancs'      //成员昵称
     *      'apply_content'         => '申请加入'    //申请内容
     *      'apply_time'            =>  time()      //申请时间
     *      'is_identity'           =>  1           //成员身份:1圈主 2管理 3成员
     * ]
     * @return string
     * @Author: Fancs
     * @Version 2017/6/30
     */
    static public function save_member(&$data)
    {
        //验证器
        $class = \think\Loader::parseClass(MODULE_NAME, 'validate', 'member', false);
        //存在验证器刚执行
        if (class_exists($class)) {
            $validate =  \think\Loader::validate($class);
            $result =   $validate->check($data);
            if(!$result){
                return json(['code' => 0, 'msg' => $validate->getError()]);
            }
        }
        if(!isset($data['id'])){
            //新增
            $data['status'] = 1;
            if($res = \app\fans\model\Member::create($data)){
                return true;
            }
            return false;
        }else{
            //编辑
            if($res = \app\fans\model\Member::update($data)){
                return true;
            }
            return false;
        }
    }
    /**
     * @Mark:删除圈子成员
     * @param $data[
     *      'id'   => $id    //id
     * ]
     * @return string
     * @Author: fancs
     * @Version 2017/6/30
     */
    static public function delete_member(&$data)
    {
        \app\fans\model\Member::destroy(function ($query) use ($data){
            $query->where($data);
        });
        return true;
    }

}
