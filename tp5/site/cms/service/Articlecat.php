<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Fancs
// +----------------------------------------------------------------------
// | Invitation.php  Version 2017/6/6 类型API
// +----------------------------------------------------------------------
namespace app\cms\service;

use app\admin\service\Service;

class Articlecat extends Service
{
    /**
     * @Mark:根据条件查询分类
     * @param $data =[
     *      'name'=>$name,//类型标识：name
     *      .....
     * ]
     * @return mixed
     * @Author: Fancs
     * @Version 2017/6/7
     */
    static public function get_category(&$data=[])
    {
        $data['status'] = 1;//状态
        $data['langid'] = LANG;//语言
        
        $type = \app\cms\model\Articlecat::all(function($query) use ($data){
            $query->where($data);
        });
        
        if (empty($type)) return false;
        return $type;
    }
    
    /**
     * @Mark: 新增/编辑类型
     * @param $data =[
     *      //新增
     *      'title'       => $title,//类型名称
     *      'cat_type'    => $cat,//描述
     *      'parent'      => $parent //父级名称
     *      ......
     *      'langid'      => 'zh-cn' //语言
     *      //更新
     *      'id'          => $id, //如果是更新有id
     *      'title'       => $title,//类型名称
     *      'cat_type'    =>$cat,//描述
     *      'parent'      => $parent //父级
     * ]
     * @return string
     * @Author: Fancs
     * @Version 2017/6/7
     */
    static public function save_category(&$data)
    {
        $class = \think\Loader::parseClass(MODULE_NAME, 'validate', 'Articlecat', false);
        //存在验证器刚执行
        if (class_exists($class)) {
            $validate =  \think\Loader::validate($class);
            $result =   $validate->check($data);
            if(!$result){
                return json(['code' => 0, 'msg' => $validate->getError()]);
            }
        }
        //传入父级
        if(!isset($data['parent'])){
            //检查
            $map['name|title'] = $data['parent'];
            $res = \app\cms\model\Articlecat::get($map);
            if(!$res) return json(['code'=>0,'msg'=>lang('Parent is exit')]);
            $data['pid'] = $res['id'];
            unset($data['parent']);
        }
        if(!isset($data['id'])){
            //新增
            $data['status'] = 1;
            if($res = \app\cms\model\Articlecat::create($data)){
                return true;
            }
            return json(['code'=>0,'msg'=>lang('Add error')]);
        }else{
            //编辑
            if($res = \app\cms\model\Articlecat::update($data)){
                return true;
            }
            return json(['code'=>0,'msg'=>lang('Update error')]);
        }
    }
    /**
     * @Mark:删除类型
     * @param $data[
     *      'id'   => $id    //id
     *      'name' => $name //类型名称
     *      ....
     * ]
     * @return string
     * @Author: fancs
     * @Version 2017/6/7
     */
    static public function delete_category(&$data)
    {
        \app\cms\model\Articlecat::destroy(function ($query) use ($data){
            $query->where($data);
        });
        return true;
    }
}
