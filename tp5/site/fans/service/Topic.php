<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Fancs
// +----------------------------------------------------------------------
// | Topic.php  Version 2017/5/26 话题API
// +----------------------------------------------------------------------
namespace app\fans\service;

use app\member\service\Member;
use app\admin\service\Service;

class Topic extends Service
{
    /**
     * @Mark: 获取话题
     * @param $data =[
     *      'id'=>$id,       //话题id
     *      'title'=>$title, //完整的话题标题
     * ]
     * @return string
     * @Author: Fancs
     * @Version 2017/5/24
     */
    static public function get_topic(&$data=[])
    {
        $type = \app\fans\model\Topic::all(function($query) use ($data){
            $query->where($data);
        });
        
        if (empty($type)) return false;
        return $type;
    }
    /**
     * @Mark: 新增/编辑话题
     * @param $data =[
     *      //新增
     *      'username'    => $username      //话题发布人
     *      'circle_id'   => $circle,       //所属圈子id
     *      'title'       => $title         //话题标题
     *      'content'     => $content,      //内容
     *      'view_count'  => $view_count    //阅读量
     *      'reply_count' => $reply_count   //回复量
     *      'is_top'      => $is_top        //是否置顶
     *      'is_hot'      => $is_hot        //是否精品
     *      'is_silent'   => $is_silent     //是否禁言
     *      //更新
     *      'id'          => $id,           //如果是更新有id
     *      'username'    => $username      //话题发布人
     *      'circle_id'   => $circle,       //所属圈子id
     *      'title'       => $title         //话题标题
     *      'content'     => $content,      //内容
     *      'view_count'  => $view_count    //阅读量
     *      'reply_count' => $reply_count   //回复量
     *      'is_top'      => $is_top        //是否置顶
     *      'is_hot'      => $is_hot        //是否精品
     *      'is_silent'   => $is_silent     //是否禁言
     * ]
     * @return string
     * @Author: Fancs
     * @Version 2017/5/31
     */
    static public function save_topic(&$data)
    {
        //验证器
        $class = \think\Loader::parseClass(MODULE_NAME, 'validate', 'Topic', false);
        //存在验证器刚执行
        if (class_exists($class)) {
            $validate =  \think\Loader::validate($class);
            $result =   $validate->check($data);
            if(!$result){
                return json(['code' => 0, 'msg' => $validate->getError()]);
            }
        }
        //获取用户id
        if($data['username']){
            $user = Member::getUserInfo($data['username']);
        }
        if(!$user) return json(['code' => 0, 'msg' => lang('Account is exits or enable')]);
        $data['uid'] = $user['id'];
        unset($data['username']);
        if(!isset($data['id'])){
            //新增
            $data['status'] = 1;
            if($res = \app\fans\model\Topic::create($data)){
                return true;
            }
            return false;
        }else{
            //编辑
            if($res = \app\fans\model\Topic::update($data)){
                return true;
            }
            return false;
        }
    }
    /**
     * @Mark:删除话题
     * @param $data[
     *      'id'   => $id    //id
     *      'title'=> $title //标题
     * ]
     * @return string
     * @Author: fancs
     * @Version 2017/5/31
     */
    static public function delete_topic(&$data)
    {
        \app\fans\model\Topic::destroy(function ($query) use ($data){
            $query->where($data);
        });
        return true;
    }
    
}
