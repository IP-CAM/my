<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Fancs
// +----------------------------------------------------------------------
// | Area.php  Version 2017/6/9 国家 & 地区API
// +----------------------------------------------------------------------
namespace app\bcwareexp\service;

use app\admin\service\Service;

class Area extends Service
{
    /**
     * @Mark:根据条件查询
     * @param $data =[
     *      'name'      => $name,       //地区名：name
     *      'code'      => $code        //地区代码
     *      'parent'    => $parent      //上级地区的代码 or 语言变量
     *      .....
     * ]
     * @return mixed
     * @Author: Fancs
     * @Version 2017/6/9
     */
    static public function get_area(&$data=[])
    {
        $data['status'] = 1;//状态
        //如果传入上级地区的代码
        if(!empty($data['parent'])){
            //检查上级是否存在
            $where['code|name'] = $data['parent'];
            $parent = \app\bcwareexp\model\Area::get($where);
            if(empty($parent)) return json(['code'=>0,'msg'=>lang('Parent area not find')]);
            $data['pid'] = $parent['id'];
            unset($data['parent']);
        }
        //根据条件获取数据
        $Area= \app\bcwareexp\model\Area::all(function($query) use ($data){
            $query->where($data);
        });
        
        if (empty($Area)) return false;
        return $Area;
    }
    
    /**
     * @Mark:获取所有下级区域
     * @param $data[
     *      'id'         =>      $id            //id
     *      'code/name'  =>      $code/$name    //地区代码or语言变量
     * ]
     * @return mixed|string
     * @Author: fancs
     * @Version 2017/6/9
     */
    static public function get_lower(&$data)
    {
        //组装查询条件
        $index_where['code|name|id'] =  $data;
        $parent = \app\bcwareexp\model\Area::get($index_where);
        $lower = \app\bcwareexp\model\Area::all(function ($query) use ($parent){
            $query->where(['pid'=>$parent['id']]);
        });
        if (empty($lower)) return false;
        return $lower;
    }
    /**
     * @Mark: 新增/编辑类型
     * @param $data =[
     *      //新增
     *      'name'        => 'Guangzhou',       //语言变量
     *      'englishname' => 'Guangzhou city',  //英文名称
     *      'code'        => 'CN',              //地区代码
     *      'main_lang'   => 'zh-cn'            //主要语言
     *      'zipcode'     => '53574'            //邮编
     *      'areacode'    => '4545'             //区号
     *      'parent'      => 'China/CN'         //上级地区的语言变量or代码，不填默认为国家
     *      ......
     *      'langid'      => 'zh-cn'            //验证器
     *
     *      //更新
     *      'id'          => $id,               //如果是更新有id
     *      'name'        => 'Guangzhou',       //语言变量
     *      'englishname' => 'Guangzhou city',  //英文名称
     *      'code'        => 'CN',              //地区代码
     *      'main_lang'   => 'zh-cn'            //主要语言
     *      'zipcode'     => '53574'            //邮编
     *      'areacode'    => '4545'             //区号
     *      'parent'      => 'China/CN'         //上级地区的语言变量or代码，不填默认为国家
     *
     *
     *
     * ]
     * @return string
     * @Author: Fancs
     * @Version 2017/6/9
     */
    static public function save_area(&$data)
    {
        $class = \think\Loader::parseClass(MODULE_NAME, 'validate', 'Area', false);
        //存在验证器刚执行
        if (class_exists($class)) {
            $validate =  \think\Loader::validate($class);
            $result =   $validate->check($data);
            if(!$result){
                return json(['code' => 0, 'msg' => $validate->getError()]);
            }
        }
        if(!empty($data['parent'])){
            //上级地区，数据处理
            $where['code|name'] = $data['parent'];
            $parent = \app\bcwareexp\model\Area::get($where);
            if(empty($parent)) return json(['code'=>0,'msg'=>lang('Parent area not find')]);
            $data['pid'] = $parent['id'];
            unset($data['parent']);
        }
        if(isset($data['id'])){
            //新增
            $data['status'] = 1;
            if($res = \app\bcwareexp\model\Area::create($data)){
                return true;
            }
            return json(['code'=>0,'msg'=>lang('Add error')]);
        }else{
            //编辑
            if($res = \app\bcwareexp\model\Area::update($data)){
                return true;
            }
            return json(['code'=>0,'msg'=>lang('Update error')]);
        }
    }
    /**
     * @Mark:删除类型
     * @param $data[
     *      'id'   => $id    //id
     *      'name' => $name  //语言变量or代码
     *      ....
     * ]
     * @return string
     * @Author: fancs
     * @Version 2017/6/9
     */
    static public function delete_area(&$data)
    {
        $where['code|name|id'] = $data;
        \app\bcwareexp\model\Area::destroy(function ($query) use ($where){
            $query->where($where);
        });
        return true;
    }
}
