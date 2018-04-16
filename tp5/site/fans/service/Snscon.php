<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Fancs
// +----------------------------------------------------------------------
// | Snscon.php  Version 2017/5/26 咨询API
// +----------------------------------------------------------------------
namespace app\fans\service;

use app\fans\model\SnsconCategory;
use app\member\service\Member;
use app\admin\service\Service;

class Snscon extends Service
{
    /**
     * @Mark：新增咨询
     * @param $data = [
     *      'name'=>$name,  //用户,话题创建者
     *      'title'=>$title //标题
     *      'category'=>$category //话题类型
     *      'cover'=>$cover //封面
     *      'isrecommend'=>1/0 //是否推荐
     *      'contents'   =>$contents //内容
     *      'dead_line'  =>'2017-5-24'
     *      'from'       =>$from  //来源平台
     * ]
     * @return bool|string
     * @author Fancs
     * @version 2017/5/31
     */
    static public function addSnscon(&$data)
    {
        if(!empty($data['name'])){
            //检查用户是否存在
            if($data['name']){
                $user = Member::getUserInfo($data['name']);
            }
            if(!$user) return json(['code' => 0, 'msg' => lang('Account is exits or enable')]);
            //验证器
            if(!$validate = get_validate('Snscon',$data)){
                return $validate;
            }
            //检查话题类型是否存在
            $category = SnsconCategory::get(['title'=>$data['title']]);
            if(empty($category) || $category['status']<1){
                return   json(['code' => 0, 'msg' => lang('This category is exit or enable')]);
            }
            $data['uid'] = $user['id'];
            $insert = \app\fans\model\Snscon::create($data);
            if ($insert){
                return   json(['code' => 0, 'msg' => lang('Add success')]);
            }else{
                return json(['code' => 0, 'msg' => lang('Add error')]);
            }
        }
    }
    /**
     * @Mark:获取咨询分类
     * @param $data=[
     *      'title'=>$title, //不传此参数默认获取所有分类
     * ]
     * @return string
     * @Author: Fancs
     * @Version 2017/5/24
     */
    static public function getSnsconCategory(&$data=[])
    {
        if(empty($data['title'])){
            $category = SnsconCategory::all();
            if(empty($category)){
                return   json(['code' => 0, 'msg' => lang('Don`t have category')]);
            }
        }else{
            $category = SnsconCategory::get(['title'=>$data['title']]);
            if(empty($category) || $category['status']<1){
                return   json(['code' => 0, 'msg' => lang('This category is exit or enable')]);
            }
        }
        return json($category);
    }
    
    /**
     * @Mark:删除咨询
     * @param $data[
     *      'id'   => $id    //id
     *      'title'=> $title //标题
     * ]
     * @return string
     * @Author: fancs
     * @Version 2017/5/31
     */
    static public function deleteSnscon(&$data)
    {
        \app\fans\model\Snscon::destroy(function ($query) use ($data){
            $query->where($data);
        });
        return true;
    }

}
