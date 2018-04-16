<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Fancs
// +----------------------------------------------------------------------
// | Type.php  Version 2017/6/2 类型API
// +----------------------------------------------------------------------
namespace app\fans\service;

use app\admin\service\Service;

class Type extends Service
{
    /**
     * @Mark:根据条件查询类型
     * @param $data =[
     *      'name'  =>  '技术交流'      //名称
     * ]
     * @return mixed
     * @Author: Fancs
     * @Version 2017/6/2
     */
    static public function get_type(&$data=[])
    {
        $data['langid'] = LANG;
        $type = \app\fans\model\Type::all(function($query) use ($data){
            $query->where($data);
        });
        
        if (empty($type)) return false;
        return $type;
    }
    
    /**
     * @Mark: 新增/编辑类型
     * @param $data =[
     *      //新增
     *      'name'        => $name, //类型名称
     *      'is_recommend'=> 1      //是否推荐：0不推荐 1推荐
     *      'langid'      => 'zh-cn'//语言
     *      //更新
     *      'id'          => $id, //如果是更新有id
     *      'name'        => $name, //类型名称
     *      'is_recommend'=> 1      //是否推荐：0不推荐 1推荐
     *      'langid'      => 'zh-cn'//语言
     * ]
     * @return string
     * @Author: Fancs
     * @Version 2017/6/2
     */
    static public function save_type(&$data)
    {
        //验证器
        $class = \think\Loader::parseClass(MODULE_NAME, 'validate', 'Type', false);
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
            if($res = \app\fans\model\Type::create($data)){
                return true;
            }
            return false;
        }else{
            //编辑
            if($res = \app\fans\model\Type::update($data)){
                return true;
            }
            return false;
        }
    }
    /**
     * @Mark:删除类型
     * @param $data[
     *      'id'   => $id    //id
     *      'name' => $name //类型名称
     * ]
     * @return string
     * @Author: fancs
     * @Version 2017/6/2
     */
    static public function delete_circle(&$data)
    {
        \app\fans\model\Type::destroy(function ($query) use ($data){
            $query->where($data);
        });
        return true;
    }
}
