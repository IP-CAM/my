<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Fancs
// +----------------------------------------------------------------------
// | Actor.php  Version 2017/6/29 圈子头衔API
// +----------------------------------------------------------------------
namespace app\fans\service;

use app\admin\service\Service;

class Actor extends Service
{
    /**
     * @Mark:获取头衔
     * @param $data =[
     *      'name'  =>  '初级粉丝'      //名称
     * ]
     * @return mixed
     * @Author: Fancs
     * @Version 2017/6/29
     */
    static public function get_actor(&$data=[])
    {
        $data['langid'] = LANG;
        $type = \app\fans\model\Actor::all(function($query) use ($data){
            $query->where($data);
        });
        
        if (empty($type)) return false;
        return $type;
    }
    
    /**
     * @Mark: 新增/编辑类型
     * @param $data =[
     *      //新增
     *      'name'        => $name, //名称
     *      'exp'         => 100    //所需经验值
     *      'langid'      => 'zh-cn'//语言
     *      //更新
     *      'id'          => $id, //如果是更新有id
     *      'name'        => $name, //名称
     *      'exp'         => 100    //所需经验值
     *      'langid'      => 'zh-cn'//语言
     * ]
     * @return string
     * @Author: Fancs
     * @Version 2017/6/29
     */
    static public function save_actor(&$data)
    {
        //验证器
        $class = \think\Loader::parseClass(MODULE_NAME, 'validate', 'Actor', false);
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
            if($res = \app\fans\model\Actor::create($data)){
                return true;
            }
            return false;
        }else{
            //编辑
            if($res = \app\fans\model\Actor::update($data)){
                return true;
            }
            return false;
        }
    }
    /**
     * @Mark:删除类型
     * @param $data[
     *      'id'   => $id    //id
     *      'name' => $name  //名称
     * ]
     * @return string
     * @Author: fancs
     * @Version 2017/6/29
     */
    static public function delete_actor(&$data)
    {
        \app\fans\model\Actor::destroy(function ($query) use ($data){
            $query->where($data);
        });
        return true;
    }
}
