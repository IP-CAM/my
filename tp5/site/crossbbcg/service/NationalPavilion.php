<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: WangHuaLong
// +----------------------------------------------------------------------
// | NationalPavilion.php  Version 2017/9/7
// +----------------------------------------------------------------------
namespace app\crossbbcg\service;

use think\Loader;
use app\crossbbcg\model\NationalPavilion as NationalPavilionModel;

class NationalPavilion
{
    
    /**
     * @Mark: 编辑品牌信息
     * @param $data = [
     * 'id' => int id
     * 'name' => string 名称
     * 'sort' => int 排序
     * 'status' => int 1|0 状态
     * 'is_recommend' => int 1|0 推荐
     * 'is_home' => int 1|0 首页推荐
     * 'thumb' => string 略缩图
     * 'langid' => string 语言id
     * 'banner_image' => string 品牌广告广告图
     * 'home_image' => string 首页国家馆图
     * ]
     * @return bool|\think\response\Json
     * @Author: WangHuaLong
     */
    public static function edit($data)
    {
        // 验证主表信息
        $class    = Loader::parseClass('crossbbcg', 'validate', 'NationalPavilion');
        $validate = Loader::validate($class);
        $result   = $validate->check($data);
        if ($result !== true) {
            return ['code' => 0, 'msg' => $validate->getError()];
        }
        
        // 保存主表信息
        $pavilion = new NationalPavilionModel();
        $pavilion->allowField(true)->isUpdate(true)->save($data);
        if ($pavilion->getError() !== null) {
            return ['code' => 0, 'msg' => $pavilion->getError()];
        }
        
        return ['code' => 1, 'msg' => lang('edit_success')];
    }
    
    /**
     * @Mark: 新增品牌信息
     * @param $data = [
     * 'name' => string 名称
     * 'sort' => int 排序
     * 'status' => int 1|0 状态
     * 'is_recommend' => int 1|0 推荐
     * 'is_home' => int 1|0 首页推荐
     * 'thumb' => string 略缩图
     * 'langid' => string 语言id
     * 'banner_image' => string 品牌广告广告图
     * 'home_image' => string 首页国家馆图
     * ]
     * @return bool|\think\response\Json
     * @Author: WangHuaLong
     */
    public static function add($data)
    {
        // 验证主表信息
        $class    = Loader::parseClass('crossbbcg', 'validate', 'NationalPavilion');
        $validate = Loader::validate($class);
        $result   = $validate->check($data);
        if ($result !== true) {
            return ['code' => 0, 'msg' => $validate->getError()];
        }
        
        // 新增主表信息
        $pavilion = new NationalPavilionModel();
        $pavilion->allowField(true)->isUpdate(false)->save($data);
        if ($pavilion->getError() !== null) {
            return ['code' => 0, 'msg' => $pavilion->getError()];
        }
        
        return ['code' => 1, 'msg' => lang('add_success')];
    }
    
    
}