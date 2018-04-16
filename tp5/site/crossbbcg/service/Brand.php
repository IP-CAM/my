<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: WangHuaLong
// +----------------------------------------------------------------------
// | Brand.php  Version 2017/6/8
// +----------------------------------------------------------------------
namespace app\crossbbcg\service;

use think\Loader;
use app\crossbbcg\model\Brand as BrandModel;
use app\crossbbcg\model\Goods as GoodsModel;

class Brand
{
    
    /**
     * @Mark: 编辑品牌信息
     * @param $data = [
     * 'id' => int 品牌id
     * 'firstchar' => string 首字母
     * 'name' => string 品牌名称
     * 'alias' => string 品牌别名
     * 'description' => string 品牌介绍
     * 'url' => string 品牌地址
     * 'pcat' =>  int 主分类
     * 'cat' => int 主分类的子分类
     * 'sort' => int 排序
     * 'status' => int 1|0 状态
     * 'isrecommend' => int 1|0 推荐
     * 'istop' => int 1|0 首页推荐
     * 'logo' => string logo图片地址
     * 'langid' => string 语言id
     * ]
     * @return bool|\think\response\Json
     * @Author: WangHuaLong
     */
    public static function edit($data)
    {
        // 验证主表信息
        $class    = Loader::parseClass('crossbbcg', 'validate', 'Brand');
        $validate = Loader::validate($class);
        $result   = $validate->check($data);
        if ($result !== true) {
            return ['code' => 0, 'msg' => $validate->getError()];
        }
        
        // 保存主表信息
        $brand = new BrandModel();
        $brand->allowField(true)->isUpdate(true)->save($data);
        if ($brand->getError() !== null) {
            return ['code' => 0, 'msg' => $brand->getError()];
        }
        
        return ['code' => 1, 'msg' => lang('edit_success')];
    }
    
    /**
     * @Mark: 新增品牌信息
     * @param $data = [
     * 'firstchar' => string 首字母
     * 'name' => string 品牌名称
     * 'alias' => string 品牌别名
     * 'description' => string 品牌介绍
     * 'url' => string 品牌地址
     * 'pcat' =>  int 主分类
     * 'cat' => int 主分类的子分类
     * 'sort' => int 排序
     * 'status' => int 1|0 状态
     * 'isrecommend' => int 1|0 推荐
     * 'istop' => int 1|0 首页推荐
     * 'logo' => string logo图片地址
     * 'langid' => string 语言id
     * ]
     * @return bool|\think\response\Json
     * @Author: WangHuaLong
     */
    public static function add($data)
    {
        // 验证主表信息
        $class    = Loader::parseClass('crossbbcg', 'validate', 'Brand');
        $validate = Loader::validate($class);
        $result   = $validate->check($data);
        if ($result !== true) {
            return ['code' => 0, 'msg' => $validate->getError()];
        }
        
        // 新增主表信息
        $brand = new BrandModel();
        $brand->allowField(true)->isUpdate(false)->save($data);
        if ($brand->getError() !== null) {
            return ['code' => 0, 'msg' => $brand->getError()];
        }
        
        return ['code' => 1, 'msg' => lang('add_success')];
    }
    
    /**
     * @Mark: 删除品牌
     * @param $brand_id int 品牌id
     * @return bool|\think\response\Json
     * @Author: WangHuaLong
     */
    public static function deleteBrand($brand_id)
    {
        // 关联商品查询
        $good   = new GoodsModel();
        $result = $good->where('brand_id', (int)$brand_id)->column('id');
        
        if ($result) {
            $warning = '';
            foreach ($result as $key => $value) {
                $warning .= ',' . $value;
            }
            return ['code' => 0, 'msg' => lang('Relation_Delete_Error') . substr($warning, 1)];
        }
        
        // 删除品牌
        BrandModel::destroy((int)$brand_id);
        return ['code' => 1, 'msg' => lang('delete_success')];
    }
    
    
}