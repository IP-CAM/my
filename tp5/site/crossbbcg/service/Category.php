<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: WangHuaLong
// +----------------------------------------------------------------------
// | Category.php  Version 2017/6/12
// +----------------------------------------------------------------------
namespace app\crossbbcg\service;

use app\crossbbcg\model\Category as CategoryModel;
use app\crossbbcg\model\CategoryPath;
use app\crossbbcg\model\GoodsToCategory;
use think\Loader;

class Category
{
    /**
     * @Mark: 获取所有分类
     * @param $data
     * @return \think\Paginator
     * @Author: WangHuaLong
     */
    public static function getCategories($data = array())
    {
        $category = new CategoryModel();
        return $category->getCategories($data);
    }
    
    /**
     * @Mark: 修改分类
     * @param $data
     * @return bool|\think\response\Json
     * @Author: WangHuaLong
     */
    public static function edit($data)
    {
        $category_id = $data['id'];
        $pid         = $data['pid'];
        
        // 验证主表信息
        $class    = Loader::parseClass('crossbbcg', 'validate', 'Category');
        $validate = Loader::validate($class);
        $result   = $validate->check($data);
        if ($result !== true) {
            return ['code' => 0, 'msg' => $validate->getError()];
        }
        
        // 保存主表信息
        $category = new CategoryModel();
        $category->allowField(true)->isUpdate(true)->save($data);
        if ($category->getError() !== null) {
            return ['code' => 0, 'msg' => $category->getError()];
        }
        
        // 修改分类层级关系，获取分类层级
        $category_path = new CategoryPath();
        $result        = $category_path->where('path_id', $category_id)->order(['level' => 'ASC'])->select();
        if ($result) {
            foreach ($result as $arr) {
                // 删除分类的上级层级
                $category_path->where('category_id', $arr['category_id'])->where('level', '<', $arr['level'])->delete();
                $path = array();
                // 获取新上级的层级关系，存储层级id
                $result2 = $category_path->where('category_id', $pid)->order(['level' => 'ASC'])->select();
                foreach ($result2 as $arr2) {
                    $path[] = $arr2['path_id'];
                }
                // 获取下级的层级关系
                $result3 = $category_path->where('category_id', $arr['category_id'])->order(['level' => 'ASC'])->select();
                foreach ($result3 as $arr3) {
                    $path[] = $arr3['path_id'];
                }
                
                $level = 0;
                foreach ($path as $path_id) {
                    $insert_data = array(
                        'category_id' => $arr['category_id'],
                        'path_id'     => $path_id,
                        'level'       => $level
                    );
                    $category_path->replaceInto($insert_data);
                    $level++;
                }
            }
        } else {
            // 删除分类的层级关系，重建分类层级关系
            $category_path->where('category_id', $category_id)->delete();
            $level  = 0;
            $result = $category_path->where('category_id', $pid)->order(['level' => 'ASC'])->select();
            foreach ($result as $arr) {
                $insert_data = array(
                    'category_id' => $category_id,
                    'path_id'     => $arr['path_id'],
                    'level'       => $level
                );
                $category_path->allowField(true)->isUpdate(false)->save($insert_data);
                if ($category_path->getError() !== null) {
                    return ['code' => 0, 'msg' => $category_path->getError()];
                }
                $level++;
            }
            $insert_data = array(
                'category_id' => $category_id,
                'path_id'     => $category_id,
                'level'       => $level
            );
            $category_path->replaceInto($insert_data);
        }
        
        return ['code' => 1, 'msg' => lang('edit_success')];
    }
    
    /**
     * @Mark: 新增分类
     * @return bool|\think\response\Json
     * @Author: WangHuaLong
     */
    public static function add($data)
    {
        
        // 验证主表信息
        $class    = Loader::parseClass('crossbbcg', 'validate', 'Category');
        $validate = Loader::validate($class);
        $result   = $validate->check($data);
        if ($result !== true) {
            return ['code' => 0, 'msg' => $validate->getError()];
        }
        
        // 新增主表信息
        $category = new CategoryModel();
        $category->allowField(true)->isUpdate(false)->save($data);
        if ($category->getError() !== null) {
            return ['code' => 0, 'msg' => $category->getError()];
        }
        $category_id = $category->getLastInsID();
        
        // 新增分类层级关系
        $level         = 0;
        $category_path = new CategoryPath();
        $result        = $category_path->where('category_id', $data['pid'])->order(['level' => 'ASC'])->select();
        // 新增分类的上级层级关系
        foreach ($result as $arr) {
            $insert_data = array(
                'category_id' => $category_id,
                'path_id'     => $arr['path_id'],
                'level'       => $level
            );
            $category_path->allowField(true)->isUpdate(false)->save($insert_data);
            if ($category_path->getError() !== null) {
                return ['code' => 0, 'msg' => $category_path->getError()];
            }
            $level++;
        }
        // 新增分类为最后一级层级
        $insert_data = array(
            'category_id' => $category_id,
            'path_id'     => $category_id,
            'level'       => $level
        );
        $category_path->allowField(true)->isUpdate(false)->save($insert_data);
        if ($category_path->getError() !== null) {
            return ['code' => 0, 'msg' => $category_path->getError()];
        }
        
        return ['code' => 1, 'msg' => lang('add_success')];
    }
    
    /**
     * @Mark: 删除分类
     * @param $category_id
     * @return bool|\think\response\Json
     * @Author: WangHuaLong
     */
    public static function delete($category_id)
    {
        $category_id = (int)$category_id;
        $category    = CategoryModel::get($category_id);
        if ($category) {
            // 删除前检查是否有子分类
            $count = CategoryModel::where('pid', $category_id)->count('id');
            if ($count) {
                return ['code' => 0, 'msg' => lang('Delete_Category_Pid')];
            }
            
            // 检查是否关联商品
            $good   = new GoodsToCategory();
            $result = $good->where('category_id', $category_id)->column('good_id');
            
            if ($result) {
                $warning = '';
                foreach ($result as $key => $value) {
                    $warning .= ',' . $value;
                }
                return ['code' => 0, 'msg' => lang('Relation_Delete_Error') . substr($warning, 1)];
            }
            
            
            // 删除分类的层级关系，回调删除，从最低层分类开始删除
            $category_path = new CategoryPath();
            $category_path->where('category_id', $category_id)->delete();
            $result = $category_path->where('path_id', $category_id)->select();
            foreach ($result as $arr) {
                self::delete($arr['category_id']);
            }
            
            // 删除分类关联的表
            $category->delete();
            $goods_to_category = new GoodsToCategory();
            $goods_to_category->where('category_id', $category_id)->delete();
            return ['code' => 1, 'msg' => lang('delete_success')];
        } else {
            return ['code' => 0, 'msg' => lang('Delete_Category_Missing')];
        }
    }
    
    /**
     * @Mark: 修复分类层级关系，当层级表被破坏时，可以使用修复，根据主表还原层级表
     * @param int $pid 需要修复的上级分类id
     * @return bool
     * @Author: WangHuaLong
     */
    public static function repairCategories($pid = 0)
    {
        // 查找顶级分类
        $category = new CategoryModel();
        $result   = $category->where('pid', (int)$pid)->select();
        foreach ($result as $arr) {
            // 删除下级分类id的层级关系,重建分类的层级关系
            $category_path = new CategoryPath();
            $category_path->where('category_id', $arr['id'])->delete();
            $level   = 0;
            $result2 = $category_path->where('category_id', $pid)->order('level ASC')->select();
            foreach ($result2 as $arr2) {
                $insert_data = array(
                    'category_id' => $arr['id'],
                    'path_id'     => $arr2['path_id'],
                    'level'       => $level
                );
                $category_path->allowField(true)->isUpdate(false)->save($insert_data);
                $level++;
            }
            $insert_data = array(
                'category_id' => $arr['id'],
                'path_id'     => $arr['id'],
                'level'       => $level
            );
            $category_path->replaceInto($insert_data);
            self::repairCategories($arr['id']);
        }
        return ['code' => 1, 'msg' => lang('edit_success')];
    }
    
    /**
     * @Mark: 保存分类的关联品牌
     * @param $id int 分类id
     * @param $brand_ids string '1,2,3' 品牌id
     * @return array
     * @Author: WangHuaLong
     */
    public static function saveBrandIds($id, $brand_ids)
    {
        // 更新当前目录
        CategoryModel::where('id', $id)->update(['brand_ids' => $brand_ids]);
        
        $result = self::repeatSavePidBrandIds($id);
        
        if ($result) {
            return ['code' => 1, 'msg' => lang('Save_ok')];
        } else {
            return ['code' => 0, 'msg' => lang('Save_error')];
        }
    }
    
    /**
     * @Mark: 保存上级分类的品牌ids
     * @param $id int 分类id
     * @return bool
     * @Author: WangHuaLong
     */
    private static function repeatSavePidBrandIds($id)
    {
        
        $pid       = CategoryModel::where('id', $id)->value('pid');
        $cats      = CategoryModel::where('pid', $pid)->column('brand_ids', 'id');
        $merge_ids = '';
        if (!empty($cats)) {
            foreach ($cats as $key => $value) {
                if ($value) {
                    $merge_ids .= ',' . $value;
                }
            }
            if (strpos($merge_ids, ',') !== false) {
                $merge_ids = substr($merge_ids, 1);
            }
        }
        if ($merge_ids) {
            $arr_merge = explode(',', $merge_ids);
            $merge_ids = implode(',', array_unique($arr_merge));
        }
        
        // 更新二级目录
        CategoryModel::where('id', $pid)->update(['brand_ids' => $merge_ids]);
        
        // 防止死循环，当 a->b->a 时
        $grand_pid = CategoryModel::where('id', $pid)->value('pid');
        if ($grand_pid == $id) {
            return false;
        }
        
        if ($pid !== 0) {
            self::repeatSavePidBrandIds($pid);
        }
        
        return true;
        
    }
    
    /**
     * @Mark: 保存规格ids
     * @param $id int 分类id
     * @param $option_ids string 规格ids，多个逗号隔开
     * @return array
     * @Author: WangHuaLong
     */
    public static function saveOptionIds($id, $option_ids)
    {
        // 更新当前目录
        CategoryModel::where('id', $id)->update(['option_ids' => $option_ids]);
        
        $result = self::repeatSavePidOptionIds($id);
        
        if ($result) {
            return ['code' => 1, 'msg' => lang('Save_ok')];
        } else {
            return ['code' => 0, 'msg' => lang('Save_error')];
        }
    }
    
    /**
     * @Mark: 保存上级分类的规格ids
     * @param $id int 分类id
     * @return bool
     * @Author: WangHuaLong
     */
    private static function repeatSavePidOptionIds($id)
    {
        
        $pid       = CategoryModel::where('id', $id)->value('pid');
        $cats      = CategoryModel::where('pid', $pid)->column('option_ids', 'id');
        $merge_ids = '';
        if (!empty($cats)) {
            foreach ($cats as $key => $value) {
                if ($value) {
                    $merge_ids .= ',' . $value;
                }
            }
            if (strpos($merge_ids, ',') !== false) {
                $merge_ids = substr($merge_ids, 1);
            }
        }
        if ($merge_ids) {
            $arr_merge = explode(',', $merge_ids);
            $merge_ids = implode(',', array_unique($arr_merge));
        }
        
        // 更新二级目录
        CategoryModel::where('id', $pid)->update(['option_ids' => $merge_ids]);
        
        // 防止死循环，当 a->b->a 时
        $grand_pid = CategoryModel::where('id', $pid)->value('pid');
        if ($grand_pid == $id) {
            return false;
        }
        
        if ($pid !== 0) {
            self::repeatSavePidOptionIds($pid);
        }
        
        return true;
        
    }
    
    
    /**
     * @Mark: 保存分类的参数组
     * @param $id int 分类id
     * @param $attribute_group_ids string '1,2,3' 品牌id
     * @return array
     * @Author: WangHuaLong
     */
    public static function saveAttributeGroupIds($id, $attribute_group_ids)
    {
        // 更新当前目录
        CategoryModel::where('id', $id)->update(['attribute_group_ids' => $attribute_group_ids]);
        
        $result = self::repeatSavePidAttributeGroupIds($id);
        
        if ($result) {
            return ['code' => 1, 'msg' => lang('Save_ok')];
        } else {
            return ['code' => 0, 'msg' => lang('Save_error')];
        }
    }
    
    /**
     * @Mark: 保存上级分类的参数组ids
     * @param $id int 分类id
     * @return bool
     * @Author: WangHuaLong
     */
    private static function repeatSavePidAttributeGroupIds($id)
    {
        
        $pid       = CategoryModel::where('id', $id)->value('pid');
        $cats      = CategoryModel::where('pid', $pid)->column('attribute_group_ids', 'id');
        $merge_ids = '';
        if (!empty($cats)) {
            foreach ($cats as $key => $value) {
                if ($value) {
                    $merge_ids .= ',' . $value;
                }
            }
            if (strpos($merge_ids, ',') !== false) {
                $merge_ids = substr($merge_ids, 1);
            }
        }
        if ($merge_ids) {
            $arr_merge = explode(',', $merge_ids);
            $merge_ids = implode(',', array_unique($arr_merge));
        }
        
        // 更新二级目录
        CategoryModel::where('id', $pid)->update(['attribute_group_ids' => $merge_ids]);
        
        // 防止死循环，当 a->b->a 时
        $grand_pid = CategoryModel::where('id', $pid)->value('pid');
        if ($grand_pid == $id) {
            return false;
        }
        
        if ($pid !== 0) {
            self::repeatSavePidAttributeGroupIds($pid);
        }
        
        return true;
        
    }
}