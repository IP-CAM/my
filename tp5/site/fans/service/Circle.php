<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Fancs
// +----------------------------------------------------------------------
// | Circle.php  Version 2017/5/26 圈子API
// +----------------------------------------------------------------------
namespace app\fans\service;

use app\admin\service\Service;

class Circle extends Service
{
    /**
     * @Mark:查询圈子
     * @param $data =[
     *      'name'  =>  '技术交流'      //名称
     * ]
     * @return mixed
     * @Author: Fancs
     * @Version 2017/6/29
     */
    static public function get_circle(&$data=[])
    {
        $type = \app\fans\model\Circle::all(function($query) use ($data){
            $query->where($data);
        });
        
        if (empty($type)) return false;
        return $type;
    }
    
    /**
     * @Mark: 新增/编辑圈子
     * @param $data =[
     *      //新增
     *      'name'          => $title,      //圈名
     *      'uid'           => 'fancs'      //圈子：用户名/id/手机
     *      'type_id'       => 3            //圈子类型id
     *      'logo'          => 'url'        //圈子logo
     *      'tags'          => 'php,it'     //圈子标签
     *      'advertisement' => '广告'        //圈子广告
     *      'is_recommend'  => 1            //是否推荐：0不推荐 1推荐
     *      'description'   => $description,//描述
     *      'langid'        => 'zh-cn'      //语言
     *      //更新
     *      'id'          => $id, //如果是更新有id
     *      'name'          => $title,      //圈名
     *      'uid'           => 'fancs'      //圈子：用户名/id/手机
     *      'type_id'       => 3            //圈子类型id
     *      'logo'          => 'url'        //圈子logo
     *      'tags'          => 'php,it'     //圈子标签
     *      'advertisement' => '广告'        //圈子广告
     *      'is_recommend'  => 1            //是否推荐：0不推荐 1推荐
     *      'description'   => $description,//描述
     *      'langid'        => 'zh-cn'      //语言
     * ]
     * @return string
     * @Author: Fancs
     * @Version 2017/6/29
     */
    static public function save_circle(&$data)
    {
        //验证器
        $class = \think\Loader::parseClass(MODULE_NAME, 'validate', 'circle', false);
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
            if($res = \app\fans\model\Circle::create($data)){
                return true;
            }
            return false;
        }else{
            //编辑
            if($res = \app\fans\model\Circle::update($data)){
                return true;
            }
            return false;
        }
    }
    /**
     * @Mark:删除圈子
     * @param $data[
     *      'id'   => $id    //id
     *      'name'=> $name //标题
     * ]
     * @return string
     * @Author: fancs
     * @Version 2017/5/31
     */
    static public function delete_circle(&$data)
    {
        \app\fans\model\Circle::destroy(function ($query) use ($data){
            $query->where($data);
        });
        return true;
    }

}
