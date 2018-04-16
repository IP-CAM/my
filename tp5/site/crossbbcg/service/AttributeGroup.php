<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: WangHuaLong
// +----------------------------------------------------------------------
// | AttributeGroup.php  Version 2017/6/2
// +----------------------------------------------------------------------
namespace app\crossbbcg\service;

use app\crossbbcg\model\AttributeGroup as AttributeGroupModel;
use app\crossbbcg\model\Attribute as AttributeModel;
use app\crossbbcg\model\GoodsAttribute;
use think\Loader;

class AttributeGroup
{
    
    /**
     * @Mark: 改变商品顺序
     * @param $data = array(
     *      'attribute_group_id' => 主键id，
     *      'sort' => 顺序
     * );
     * @return bool|\think\response\Json
     * @Author: WangHuaLong
     */
    public static function changeSort($data)
    {
        $attribute_group       = AttributeGroupModel::get($data['attribute_group_id']);
        $attribute_group->sort = (int)$data['sort'];
        if ($attribute_group->save()) {
            return ['code' => 1, 'msg' => lang('edit_success')];
        } else {
            if ($attribute_group->getError() !== null) {
                return ['code' => 0, 'msg' => $attribute_group->getError()];
            } else {
                return ['code' => 0, 'msg' => lang('Error_Nothing')];
            }
        }
    }
    
    /**
     * @Mark: 删除参数组，参数
     * @param $attribute_group_id  int 主键id
     * @return bool|\think\response\Json
     * @Author: WangHuaLong
     */
    public static function deleteAttributeGroup($attribute_group_id)
    {
        $attribute_group_id = (int)$attribute_group_id;
        
        // 关联商品查询
        $good_attribute = new GoodsAttribute();
        $result         = $good_attribute->where('attribute_group_id', (int)$attribute_group_id)->column('good_id');
        
        if ($result) {
            $warning = '';
            foreach ($result as $key => $value) {
                $warning .= ',' . $value;
            }
            return ['code' => 0, 'msg' => lang('Relation_Delete_Error') . substr($warning, 1)];
        }
        
        $attribute_group = AttributeGroupModel::get($attribute_group_id);
        if ($attribute_group) {
            $attribute_group->delete();
            $attribute = new AttributeModel();
            $attribute->where('attribute_group_id', '=', $attribute_group_id)->delete();
            return ['code' => 1, 'msg' => lang('delete_success')];
        } else {
            return ['code' => 0, 'msg' => lang('Delete_AttributeGroup_Missing')];
        }
    }
    
    /**
     * @Mark: 保存参数组，参数
     * @param $data = [
     * 'attribute_group_id' => int 参数组主键id
     * 'name' => string 参数组名称
     * 'sort' => int 排序
     * 'langid' => string 语言id
     * 'attribute' => [
     *      'attribute_id' => int 参数id
     *      'name' => string 参数名称
     *      'attribute_group_id' => int 参数组id
     *      'sort' => int 排序
     *  ]
     * ]
     * @return bool|\think\response\Json
     * @Author: WangHuaLong
     */
    public static function edit($data)
    {
        // 判断是否提交参数
        if (isset($data['attribute'])) {
            // 验证参数
            // 验证提交的参数名是否有重复
            $repeat = [];
            foreach ($data['attribute'] as $value) {
                if ($value['name'] == '') {
                    return ['code' => 0, 'msg' => lang('Attribute_Name_Require')];
                }
                if (in_array($value['name'], $repeat)) {
                    return ['code' => 0, 'msg' => lang('Attribute_Name_Exist')];
                }
                $repeat[] = $value['name'];
                
                // 验证筛选参数的值
                if (isset($value['filtrate']) && $value['filtrate'] == 1) {
                    if (trim($value['attribute_value']) == '') {
                        return ['code' => 0, 'msg' => lang('error_filtrate')];
                    }
                }
            }
            unset($repeat);
            
            
            // 删除参数
            $attribute = new AttributeModel();
            $attribute->where('attribute_group_id', $data['attribute_group_id'])->delete();
            
            // 添加提交的参数
            foreach ($data['attribute'] as $value) {
                $attribute = new AttributeModel();
                $attribute->allowField(true)->isUpdate(false)->save($value);
                if ($attribute->getError() !== null) {
                    return ['code' => 0, 'msg' => $attribute->getError()];
                }
            }
        } else {
            
            // 删除参数
            $attribute = new AttributeModel();
            $attribute->where('attribute_group_id', $data['attribute_group_id'])->delete();
        }
        
        // 验证参数组，添加参数组
        $class    = Loader::parseClass('crossbbcg', 'validate', 'AttributeGroup');
        $validate = Loader::validate($class);
        $result   = $validate->check($data);
        if ($result !== true) {
            return ['code' => 0, 'msg' => $validate->getError()];
        }
        
        $attribute_group = new AttributeGroupModel();
        $attribute_group->allowField(true)->isUpdate(true)->save($data);
        if ($attribute_group->getError() !== null) {
            return ['code' => 0, 'msg' => $attribute_group->getError()];
        }
        
        return ['code' => 1, 'msg' => lang('edit_success')];
    }
    
    /**
     * @Mark: 新增参数组，参数值
     * @param $data = [
     * 'name' => string 参数组名称
     * 'sort' => int 排序
     * 'langid' => string 语言id
     * 'attribute' => [
     *      'name' => string 参数名称
     *      'sort' => int 排序
     *  ]
     * ]
     * @return bool|\think\response\Json
     * @Author: WangHuaLong
     */
    public static function add($data)
    {
        // 判断是否提交参数
        if (isset($data['attribute'])) {
            
            // 验证提交的参数名是否有重复
            $repeat = [];
            foreach ($data['attribute'] as $value) {
                if ($value['name'] == '') {
                    return ['code' => 0, 'msg' => lang('Attribute_Name_Require')];
                }
                if (in_array($value['name'], $repeat)) {
                    return ['code' => 0, 'msg' => lang('Attribute_Name_Exist')];
                }
                $repeat[] = $value['name'];
                
                // 验证筛选参数的值
                if (isset($value['filtrate']) && $value['filtrate'] == 1) {
                    if (trim($value['attribute_value']) == '') {
                        return ['code' => 0, 'msg' => lang('error_filtrate')];
                    }
                }
            }
            unset($repeat);
            
            
            // 验证参数组，新增参数组
            $class    = Loader::parseClass('crossbbcg', 'validate', 'AttributeGroup');
            $validate = Loader::validate($class);
            $result   = $validate->check($data);
            if ($result !== true) {
                return ['code' => 0, 'msg' => $validate->getError()];
            }
            
            $attribute_group = new AttributeGroupModel();
            $attribute_group->allowField(true)->isUpdate(false)->save($data);
            if ($attribute_group->getError() !== null) {
                return ['code' => 0, 'msg' => $attribute_group->getError()];
            }
            
            // 先删除参数再新增参数
            $attribute_group_id = $attribute_group->getLastInsID();
            $attribute          = new AttributeModel();
            $attribute->where('attribute_group_id', $attribute_group_id)->delete();
            foreach ($data['attribute'] as $value) {
                $value['attribute_group_id'] = $attribute_group_id;
                $attribute                   = new AttributeModel();
                $attribute->allowField(true)->isUpdate(false)->save($value);
                if ($attribute->getError() !== null) {
                    return ['code' => 0, 'msg' => $attribute->getError()];
                }
            }
        } else {
            
            // 验证参数组，新增参数组，删除参数
            $class    = Loader::parseClass('crossbbcg', 'validate', 'AttributeGroup');
            $validate = Loader::validate($class);
            $result   = $validate->check($data);
            if ($result !== true) {
                return ['code' => 0, 'msg' => $validate->getError()];
            }
            
            $attribute_group = new AttributeGroupModel();
            $attribute_group->allowField(true)->isUpdate(false)->save($data);
            if ($attribute_group->getError() !== null) {
                return ['code' => 0, 'msg' => $attribute_group->getError()];
            }
            
            $attribute_group_id = $attribute_group->getLastInsID();
            
            $attribute = new AttributeModel();
            $attribute->where('attribute_group_id', $attribute_group_id)->delete();
        }
        return ['code' => 1, 'msg' => lang('add_success')];
    }
    
    
}