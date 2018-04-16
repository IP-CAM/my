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
// | 商品分类  Version 1.0  2016/3/13
// +----------------------------------------------------------------------
namespace app\crossbbcg\controller\admin;

use app\admin\controller\Admin;
use app\crossbbcg\model\AttributeGroup as AttributeGroupModel;
use app\crossbbcg\model\Attribute as AttributeModel;
use app\crossbbcg\model\Category as CategoryModel;
use app\crossbbcg\model\Brand as BrandModel;
use app\crossbbcg\service\Category as CategoryApi;
use app\crossbbcg\model\Option as OptionModel;

class Category extends Admin
{
    
    /**
     * @Mark:分类首页
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/6
     */
    public function index()
    {
        // 查询
        $map = [];
        
        $map['langid'] = LANG;
        if (input('?name')) {
            $map['name|title|wap_title'] = array('like', '%' . (string)input('name') . '%');
        }
        
        // 排序
        if (input('?_field') && input('?_order')) {
            $order_bys = array(
                input('_field') => input('_order')
            );
        } else {
            $order_bys = [];
        }
        
        // 多列显示
        $display_column = array('*'); //TODO
        
        $filter_data = array(
            'where' => $map,
            'order' => $order_bys,
            'field' => $display_column,
            // 'paginate' => $paginate_list_rows
        );
        
        $result = CategoryApi::getCategories($filter_data);
        
        $this->assign("list", sortdata($result));
        $this->assign('meta_title', lang('Bbccat'));
        $this->assign('_total', CategoryModel::count());
        return $this->fetch();
    }
    
    /**
     * @Mark:添加分类
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/6
     */
    public function add()
    {
        $pid = input('?pid') ? input('pid') : 0;
        $catlist = sortdata(CategoryApi::getCategories());
        
        $this->assign("catlist", $catlist);
        $this->assign("data", null);
        $this->assign("pid", $pid);
        $this->assign("meta_title", lang('Addnew Category'));
        return $this->fetch('edit');
    }
    
    /**
     * @Mark:编辑分类
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/6
     */
    public function edit()
    {
        // 判断id是否正确
        $category_id = $this->request->has('ids') ? $this->request->param('ids') : $this->error(lang('Error_id'));
        $category = CategoryModel::get($category_id);
        if (empty($category)) {
            $this->error(lang('Error_id'));
        }
        
        //$catlist = CategoryApi::getCategories();
        $catlist = sortdata(CategoryModel::all());
        $this->assign("data", $category);
        $this->assign("pid", null);
        $this->assign("catlist", $catlist);
        $this->assign("meta_title", lang('Edit Category'));
        
        return $this->fetch();
    }
    
    /**
     * @Mark: 提交数据
     * @return bool|\think\response\Json|void
     * @Author: WangHuaLong
     */
    public function savedata()
    {
        $post_data = $this->request->post();
        if (isset($post_data['id'])) {
            $result = CategoryApi::edit($post_data);
            if ($result['code']) {
                $this->success(lang('Editok'), $this->jumpUrl);
            } else {
                return $result;
            }
        } else {
            $result = CategoryApi::add($post_data);
            if ($result['code']) {
                $this->success(lang('Editok'), $this->jumpUrl);
            } else {
                return $result;
            }
        }
        
    }
    
    /**
     * @Mark: 删除分类
     * @return bool
     * @Author: WangHuaLong
     */
    public function delete()
    {
        $result = false;
        if (input('post.ids/a')) {
            foreach (input('post.ids/a') as $value) {
                $result = CategoryApi::delete($value);
            }
        } else {
            if (input('?param.ids')) {
                $result = CategoryApi::delete(input('param.ids'));
            } else {
                $this->error(lang('Error_id'), $this->jumpUrl);
            }
        }
        
        if ($result['code']) {
            if (input('post.ids/a')) {
                action_log('delete', $this->conDb, implode(',', input('post.ids/a')), UID);
            } else {
                action_log('delete', $this->conDb, input('ids'), UID);
            }
            $this->success(lang('Deleteok'), $this->jumpUrl);
        } else {
            return $result;
        }
    }
    
    /**
     * @Mark: 修复分类层级关系
     * @Author: WangHuaLong
     */
    public function repair()
    {
        CategoryApi::repairCategories();
        $this->redirect($this->jumpUrl);
        
        /*下面跳转无法实现
        if ($result['code']) {
            $this->success(lang('Repair_Ok'), $this->jumpUrl);
        } else {
            $this->error(lang('Error_id'), $this->jumpUrl);
        }*/
    }
    
    /**
     * @Mark: 修改排序
     * @Author: WangHuaLong
     */
    public function sort()
    {
        $sort = input('sort');
        $ids = input('ids');
        $modObj = '\\app\\' . MODULE_NAME . '\\model\\' . ucfirst($this->conDb);
        $table = new $modObj();
        $pk = $table->getPK();
        if (!empty($sort) && !empty($ids)) {
            $table::where($pk, $ids)->setField('sort', $sort);
            $this->success(lang('Doingok'));
        } else {
            $this->error(lang('Sortnoselect'));
        }
    }
    
    /**
     * @Mark: 分类的关联属性 品牌，参数等等
     * @return mixed
     * @Author: WangHuaLong
     */
    public function editColumn()
    {
        $id = input('ids');
        $map = [];
        $map['id'] = $id;
        $column = input('column');
        $filter = CategoryModel::get($id);
        $brand_ids = explode(',', $filter['brand_ids']);
        $attribute_ids = explode(',', $filter['attribute_group_ids']);
        $option_ids = explode(',', $filter['option_ids']);
        
        $result = [];
        if ($column == 'brand') {
            $brands = BrandModel::where('langid', LANG)->order('firstchar', 'ASC')->select();
            if ($brands !== null) {
                foreach ($brands as $key => $arr) {
                    
                    $result[$key]['selected'] = in_array($arr['id'], $brand_ids) ? 1 : 0;
                    $result[$key]['name'] = $arr['firstchar'] . '-' . $arr['name'];
                    $result[$key]['id'] = $arr['id'];
                }
            }
        } elseif ($column == 'attribute_group') {
            $attribute_group = AttributeGroupModel::where('langid', LANG)->order('sort', 'ASC')->select();
            if ($attribute_group !== null) {
                foreach ($attribute_group as $key => $arr) {
                    $result[$key]['selected'] = in_array($arr['attribute_group_id'], $attribute_ids) ? 1 : 0;
                    $result[$key]['name'] = $arr['name'];
                    $result[$key]['id'] = $arr['attribute_group_id'];
                }
            }
            
            
        } elseif ($column == 'option') {
            $options = OptionModel::where('langid', LANG)->order('sort', 'ASC')->select();
            if ($options !== null) {
                foreach ($options as $key => $arr) {
                    $result[$key]['selected'] = in_array($arr['option_id'], $option_ids) ? 1 : 0;
                    $result[$key]['name'] = $arr['name'];
                    $result[$key]['id'] = $arr['option_id'];
                }
            }
        } else {
            $this->error(lang('Error_id'), $this->jumpUrl);
        }
        
        $this->assign('column', $column);
        $this->assign('ids', $id);
        $this->assign('list', $result);
        return $this->fetch('admin/category/editcolumn');
        
    }
    
    /**
     * @Mark: 保存分类的关联品牌
     * @return \think\response\Json|void
     * @Author: WangHuaLong
     */
    public function brandIdsSave()
    {
        if (input('?column')) {
            $column = input('column/a');
        } else {
            $column = [];
        }
        $category_id = input('ids');
        
        // 将选项id转化为字符串形式，逗号分隔
        if (!empty($column)) {
            $brand_ids = [];
            foreach ($column as $key => $arr) {
                if ($arr) {
                    $brand_ids[] = $key;
                }
            }
            $brand_ids = implode(',', $brand_ids);
        } else {
            $brand_ids = '';
        }
        
        $result = CategoryApi::saveBrandIds($category_id,$brand_ids);
        
        if($result['code']){
            return ['code'=> 1, 'msg' => $result['msg']];
            // $this->success($result['msg'], $this->jumpUrl);
        }else{
            $this->error($result['msg'], $this->jumpUrl);
        }
    }
    
    /**
     * @Mark: 保存规格ids
     * @Author: WangHuaLong
     */
    public function optionIdsSave()
    {
        if (input('?column')) {
            $column = input('column/a');
        } else {
            $column = [];
        }
        $category_id = input('ids');
        
        // 将选项id转化为字符串形式，逗号分隔
        if (!empty($column)) {
            $option_ids = [];
            foreach ($column as $key => $arr) {
                if ($arr) {
                    $option_ids[] = $key;
                }
            }
            $option_ids = implode(',', $option_ids);
        } else {
            $option_ids = '';
        }
        
        $result = CategoryApi::saveOptionIds($category_id,$option_ids);
        
        if($result['code']){
            return ['code'=> 1, 'msg' => $result['msg']];
            // $this->success($result['msg'], $this->jumpUrl);
        }else{
            $this->error($result['msg'], $this->jumpUrl);
        }
    }
    
    /**
     * @Mark: 保存参数组ids
     * @Author: WangHuaLong
     */
    public function attributeGroupIdsSave(){
        if (input('?column')) {
            $column = input('column/a');
        } else {
            $column = [];
        }
        $category_id = input('ids');
    
        // 将选项id转化为字符串形式，逗号分隔
        if (!empty($column)) {
            $attribute_group_ids = [];
            foreach ($column as $key => $arr) {
                if ($arr) {
                    $attribute_group_ids[] = $key;
                }
            }
            $attribute_group_ids = implode(',', $attribute_group_ids);
        } else {
            $attribute_group_ids = '';
        }
    
        $result = CategoryApi::saveAttributeGroupIds($category_id,$attribute_group_ids);
    
        if($result['code']){
            return ['code'=> 1, 'msg' => $result['msg']];
            // $this->success($result['msg'], $this->jumpUrl);
        }else{
            $this->error($result['msg'], $this->jumpUrl);
        }
    }
    
    /**
     * @Mark: 获取参数值
     * @return array
     * @Author: WangHuaLong
     */
    public function getAttributeValue(){
        $attribute_group_id = input('attribute_gorup_id');
        
        $values = AttributeModel::where('attribute_group_id',$attribute_group_id)->order('sort','ASC')->select()->toArray();
        
        return $values;
    }
}
