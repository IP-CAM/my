<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: WangHuaLong
// +----------------------------------------------------------------------
// | Filter.php  Version 2017/6/2
// +----------------------------------------------------------------------
namespace app\crossbbcg\service;

use app\crossbbcg\model\Filter as FilterModel;
use think\Loader;

class Filter
{
    /**
     * @Mark: 保存
     * @param $data = [
     * 'id' => int ， 主键id
     * 'name' => string ,多个关键词逗号隔开
     * 'option_ids' => string , 选项id，多个逗号隔开
     * 'brand_ids' => string , 品牌id， 多个逗号隔开
     * 'country_ids' => string , 国家id， 多个逗号隔开
     * 'sort' => int , 排序
     * 'status' => int ， 0|1
     * 'langid' => string , 语言id
     * ]
     * @return bool|\think\response\Json
     * @Author: WangHuaLong
     */
    public static function edit($data)
    {
        // 验证
        $class = Loader::parseClass('crossbbcg', 'validate', 'Filter');
        $validate = Loader::validate($class);
        $result = $validate->check($data);
        if ($result !== true) {
            return ['code' => 0, 'msg' => $validate->getError()];
        }
        // 保存
        $filter = new FilterModel();
        $filter->allowField(true)->isUpdate(true)->save($data);
        if ($filter->getError() !== null) {
            return ['code' => 0, 'msg' => $filter->getError()];
        }
    
        return ['code' => 1, 'msg' => lang('edit_success')];
    }
    
    /**
     * @Mark: 新增
     * @param $data = [
     * 'name' => string ,多个关键词逗号隔开
     * 'option_ids' => string , 选项id，多个逗号隔开
     * 'brand_ids' => string , 品牌id， 多个逗号隔开
     * 'country_ids' => string , 国家id， 多个逗号隔开
     * 'sort' => int , 排序
     * 'status' => int ， 0|1
     * 'langid' => string , 语言id
     * ]
     * @return bool|\think\response\Json
     * @Author: WangHuaLong
     */
    public static function add($data)
    {
        // 验证
        $class = Loader::parseClass('crossbbcg', 'validate', 'Filter');
        $validate = Loader::validate($class);
        $result = $validate->check($data);
        if ($result !== true) {
            return ['code' => 0, 'msg' => $validate->getError()];
        }
        // 新增
        $filter = new FilterModel();
        $filter->allowField(true)->isUpdate(false)->save($data);
        if ($filter->getError() !== null) {
            return ['code' => 0, 'msg' => $filter->getError()];
        }
    
        return ['code' => 1, 'msg' => lang('add_success')];
    }
    
    /**
     * @Mark:查找关键字是否存在
     * @param $name string 关键字
     * @return array|false|\PDOStatement|string|\think\Model
     * @Author: WangHuaLong
     */
    public static function findName($name){
        $filter = new FilterModel();
        $find = $filter->findName($name);
        return $find;
    }
    
    
}