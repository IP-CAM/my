<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Category 验证器  Version 2016/11/27
// +----------------------------------------------------------------------
namespace app\crossbbcg\validate;

use think\Validate;
use app\crossbbcg\model\Category as CategoryModel;

class Category extends Validate
{
    // 验证规则
    protected $rule = [
        ['pid', 'checkpid', '{%Error_Pid}'],
        ['kickback','between:0,100','{%Category_Kickback_Between}'],
        ['name', 'unique:Category', '{%Category_Name_Repeat}'],
        ['title', 'require', '{%Category_Title_Require}'],
        //['title', 'checkTitle', '{%Category_Title_Repeat}'],
        ['title', 'length:0,255', '{%Category_Title_Length_Error}'],
        ['wap_title', 'checkWapTitle', '{%Category_Wap_Title_Repeat}'],
        ['wap_title', 'length:0,255', '{%Category_Wap_Title_Length_Error}'],
        ['meta_title', 'length:0,255', '{%Category_Meta_Title_Length_Error}'],
    ];
    
    /**
     * @Mark:检查PID是否合法
     * @param $value
     * @param $rule
     * @param $data
     * @return bool
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/18
     */
    protected function checkpid($value, $rule, $data){
        if(!empty($data['id'])){
            if($data['id'] == $data['pid'] ){
                return false;
            }
        }
        return true;
    }
    
    /**
     * @Mark: 检查标题是否唯一
     * @param $value
     * @param $rule
     * @param $data
     * @return bool|mixed
     * @Author: WangHuaLong
     */
    protected function checkTitle($value, $rule, $data){
        $map = array();
        $map['title'] = ['=',$value];
        $map['langid'] = ['=',$data['langid']];
        if(isset($data['id'])){
            $map['id'] = ['NOT IN',$data['id']];
            $category = new CategoryModel();
            $count = $category->where($map)->count();
            if($count){
                return false;
            }else{
                return true;
            }
        }else{
            $category = new CategoryModel();
            $count = $category->where($map)->count();
            if($count){
                return lang('AttributeGroup_Name_Exist');
            }else{
                return true;
            }
        }
    }
    
    /**
     * @Mark: 检查手机端标题
     * @param $value
     * @param $rule
     * @param $data
     * @return bool|mixed
     * @Author: WangHuaLong
     */
    protected function checkWapTitle($value, $rule, $data){
        $map = array();
        $map['wap_title'] = ['=',$value];
        $map['langid'] = ['=',$data['langid']];
        if(isset($data['id'])){
            $map['id'] = ['NOT IN',$data['id']];
            $category = new CategoryModel();
            $count = $category->where($map)->count();
            if($count){
                return false;
            }else{
                return true;
            }
        }else{
            $category = new CategoryModel();
            $count = $category->where($map)->count();
            if($count){
                return false;
            }else{
                return true;
            }
        }
    }
}