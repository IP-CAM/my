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

class Article extends Service
{
    /**
     * @Mark:根据条件查询文章
     * @param $data =[
     *      'name'=>$name,//类型标识：name
     *      'category'=> $category //分类名称或者id
     *      .....
     * ]
     * @return mixed
     * @Author: Fancs
     * @Version 2017/6/7
     */
    static public function get_article(&$data=[])
    {
        $data['status'] = 1;//状态
        $data['langid'] = LANG;
        
        if(isset($data['category'])){//传入文章分类名称或者标识
            $map['name|title|id'] = $data['category'];
            $cat = \app\cms\model\Articlecat::get(function ($query) use ($map){
                $query->where($map);
            });
            $data['category_id'] = $cat['id'];
            unset($data['category']);
        }
        $type = \app\cms\model\Article::all(function($query) use ($data){
            $query->where($data);
        });
        
        if (empty($type)) return false;
        return $type;
    }
    
    /**
     * @Mark: 新增/编辑类型
     * @param $data =[
     *      //新增
     *      'name'        => $name, //类型标识
     *      'title'       => $title,//类型名称
     *      'cat_type'    => $cat,//描述
     *      'parent'      => $parent //父级名称
     *      ......
     *      'langid'      => 'zh-cn' //语言
     *      //更新
     *      'id'          => $id, //如果是更新有id
     *      'name'        => $name, //类型标识
     *      'title'       => $title,//类型名称
     *      'cat_type'    =>$cat,//描述
     *      'parent'      => $parent //父级
     * ]
     * @return string
     * @Author: Fancs
     * @Version 2017/6/7
     */
    static public function save_article(&$data)
    {
        $class = \think\Loader::parseClass(MODULE_NAME, 'validate', 'Article', false);
        //存在验证器刚执行
        if (class_exists($class)) {
            $validate =  \think\Loader::validate($class);
            $result =   $validate->check($data);
            if(!$result){
                return json(['code' => 0, 'msg' => $validate->getError()]);
            }
        }
        //传入分类名称或标识
        if(!isset($data['category'])){
            //检查
            $map['name|title'] = $data['category'];
            $res = \app\cms\model\Articlecat::get($map);
            if(!$res) return json(['code'=>0,'msg'=>lang('Category is exit')]);
            $data['pid'] = $res['id'];
            unset($data['category']);
        }
        if(isset($data['id'])){
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
    static public function delete_article(&$data)
    {
        \app\cms\model\Article::destroy(function ($query) use ($data){
            $query->where($data);
        });
        return true;
    }
}
