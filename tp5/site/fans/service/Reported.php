<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Fancs
// +----------------------------------------------------------------------
// | Reported.php  Version 2017/5/26 举报管理API
// +----------------------------------------------------------------------
namespace app\fans\service;

use app\fans\model\ReportedType;
use app\member\service\Member;
use app\admin\service\Service;

class Reported extends Service
{
    /**
     * @Mark: 新增举报
     * @param $data =[
     *      //新增
     *      'username'    => $username//举报人
     *      'name'        => $name, //举报类型名称
     *      'description' => $description   //描述
     *      'title'       => $title,//举报的话题
     *      'scene'       => add //验证器
     *      'from'        => $from //来源
     * ]
     * @return string
     * @Author: Fancs
     * @Version 2017/5/31
     */
    static public function addReported(&$data)
    {
        //验证器
        if(!$validate = get_validate('Reported',$data)){
            return $validate;
        }
        
        //获取用户id
        $user = Member::getUserInfo($data['username']);
        if(!$user) return json(['code' => 0, 'msg' => lang('Account is exits or enable')]);
        $data['uid'] = $user['id'];
        
        //获取话题id
        $topic = \app\fans\model\Topic::get(['title'=>$data['title']]);
        if(!$topic) return json(['code' => 0, 'msg' => lang('Topic is exits')]);
        $data['topic_id'] = $topic['id'];
        
        //获取举报类型
        $type = ReportedType::get(['name'=>$data['name']]);
        if(!$topic) return json(['code' => 0, 'msg' => lang('Type is exits')]);
        $data['type_id'] = $type['id'];
    
        //新增
        $data['status'] = 1;
        if($res = \app\fans\model\Topic::create($data)){
            return true;
        }
        return json(['code'=>0,'msg'=>lang('add error')]);
    }
    /**
     * @Mark: 获取举报类型
     * @param $data =[
     *      'id'=>$id, //类型id
     *      'name'=>$name, //完整的类型名称
     * ]
     * @return mixed
     * @Author: Fancs
     * @Version 2017/5/26
     */
    static public function getReportedType(&$data)
    {
        //id
        if(!empty($data['id'])){
            $type = ReportedType::get(function ($query) use ($data){
                $query->where('id',$data['id'])->find();
            });
        }
        //name
        if(!empty($data['name'])){
            $type = ReportedType::get(function ($query) use ($data){
                $query->where('name',$data['name'])->find();
            });
        }
        //未查询到数据
        if(empty($type)){
            return json(['code'=>0,'msg'=>lang('Not find topic')]);
        }
        return $type;
    }

    /**
     * @Mark: 获取所有举报
     * @param $data =[
     *      ''=>, //参数说明
     * ]
     * @return mixed
     * @Author: Fancs
     * @Version 2017/5/26
     */
    static public function getAllReported(&$data=[])
    {
        $all = \app\fans\model\Reported::all();
        return json($all);
    }

    /**
     * @Mark: 根据举报用户名查询
     * @param $data =[
     *      'name'=>$username, //用户名
     * ]
     * @return mixed
     * @Author: Fancs
     * @Version 2017/5/26
     */
    static public function getReported(&$data)
    {
        //检查用户ID对应的应用是否存在或者状态是否正常
        $user = Member::getUserInfo($data);
        //获取数据
        $reported = \app\fans\model\Reported::get(function ($query) use ($user){
            $query->where('uid',$user['id'])->select();
        });
        if(empty($reported)){
            return json(['code'=>0,'msg'=>lang('Not find')]);
        }
        return json($reported);
    }

    /**
     * @Mark: 撤销举报
     * @param $data =[
     *      'id'=>$id, //id
     * ]
     * @return string
     * @Author: Fancs
     * @Version 2017/5/2
     */
    static public function undo(&$data)
    {
        $reported = \app\fans\model\Reported::get(function ($query) use ($data){
            $query->where('id',$data['id'])->find();
        });
        if(empty($reported)){
            return json(['code'=>0,'msg'=>lang('This reported not find')]);
        }
        //修改状态
        $res =  \app\fans\model\Reported::update(['status'=>0]);
        if(!$res){
            return json(['code'=>0,'msg'=>lang('Updata error')]);
        }
        return true;
    }
    
    /**
     * @Mark: 新增/编辑举报类型
     * @param $data =[
     *      //新增
     *      'name'        => $name, //类型名称
     *      'description' => $description,//描述
     *      'scene'       => add //验证器
     *      'from'        => $from //来源
     *      //更新
     *      'id'          => $id, //如果是更新有id
     *      'name'        => $name, //类型名称
     *      'description' => $description,//描述
     *      'scene'       => edit //验证器
     *      'from'        => $from //来源
     * ]
     * @return string
     * @Author: Fancs
     * @Version 2017/5/31
     */
    static public function saveReportedType(&$data)
    {
        //验证器
        if(!$validate = get_validate('reportedType',$data)){
            return $validate;
        }
        if(!$data['id']){
            //新增
            $data['status'] = 1;
            if($res = ReportedType::create($data)){
                return true;
            }
            return json(['code'=>0,'msg'=>lang('add error')]);
        }else{
            //编辑
            if($res = ReportedType::update($data)){
                return true;
            }
            return json(['code'=>0,'msg'=>lang('add error')]);
        }
    }
    
}
