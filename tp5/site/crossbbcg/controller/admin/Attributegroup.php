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
// | 规格参数  Version 1.0  2016/3/13
// +----------------------------------------------------------------------
namespace app\crossbbcg\controller\admin;

use app\admin\controller\Admin;
use app\crossbbcg\model\AttributeGroup as AttributeGroupModel;
use app\crossbbcg\model\Attribute;
use app\crossbbcg\service\AttributeGroup as AttributeGroupApi;

class Attributegroup extends Admin
{
    
    public function _initialize()
    {
        parent::_initialize();
        $this->conDb = 'AttributeGroup';
    }
    
    /**
     * @Mark: 产品参数组列表页
     * @return mixed
     * @Author: WangHuaLong
     */
    public function index()
    {
        $this->request->param();
        // 排序
        if (input('?_field') && input('?_order')) {
            $order_bys = array(
                input('_field') => input('_order')
            );
        } else {
            $order_bys = array(
                'attribute_group_id' => 'asc'
            );
        }
        // 查找
        $map = array();
        $map['langid'] = ['=',LANG];
        if (input('?name')) {
            $map['name'] = array('like', '%' . (string)input('name') . '%');
        }
        
        // 分页显示,叠加搜索条件
        if (config("default_list_rows")) {
            $paginate_list_rows = config("default_list_rows");
        } else {
            $paginate_list_rows = 20;
        }
        
        $attribute_group = new AttributeGroupModel();
        $list = $attribute_group->where($map)->order($order_bys)->paginate($paginate_list_rows);
        $this->assign('list', $list);
        
        $total = $attribute_group->count();
        $this->assign('total', $total);
        $this->assign("meta_title", lang('Goods_Attribute'));
        return $this->fetch('admin/attribute/index');
    }
    
    /**
     * @Mark: 修改排序
     * @return bool|\think\response\Json
     * @Author: WangHuaLong
     */
    public function changeSort()
    {
        $data = array(
            'attribute_group_id' => $this->request->post('attribute_group_id'),
            'sort' => $this->request->post('sort')
        );
        return AttributeGroupApi::changeSort($data);
    }
    
    /**
     * @Mark: 删除参数组
     * @Author: WangHuaLong
     */
    public function delete()
    {
        $result = false;
        if (input('post.ids/a')) {
            foreach (input('post.ids/a') as $value) {
                $result = AttributeGroupApi::deleteAttributeGroup($value);
            }
        } else {
            if (input('?param.ids')) {
                $result = AttributeGroupApi::deleteAttributeGroup(input('param.ids'));
            } else {
                $this->error(lang('Delete_AttributeGroup_Error'), $this->jumpUrl);
            }
        }
        
        if ($result['code'] == true) {
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
     * @Mark: 保存/新增 参数组与参数
     * @return bool|\think\response\Json|void
     * @Author: WangHuaLong
     */
    public function save()
    {
        $post_data = $this->request->post();
        if ($post_data['action_name'] == 'edit') {
            $result = AttributeGroupApi::edit($post_data);
        } elseif ($post_data['action_name'] == 'add') {
            $result = AttributeGroupApi::add($post_data);
        } else {
            $this->error(lang('Error_Missing_Param'), $this->jumpUrl);
        }
        
        if ($result['code'] == true) {
            $this->success($result['msg'], $this->jumpUrl);
        } else {
            return $result;
        }
    }
    
    /**
     * @Mark: 编辑页面
     * @return mixed
     * @Author: WangHuaLong
     */
    public function edit()
    {
        $this->assign('action_name', 'edit');
        $this->assign('meta_title', lang('Edit'));
        
        if (input('?ids')) {
            $attribute_group_id = input('ids');
        } else {
            $this->error(lang('Error_id'));
        }
        
        // 参数组
        $result_attribute_group = AttributeGroupModel::get($attribute_group_id);
        if ($result_attribute_group) {
            $this->assign("data", $result_attribute_group);
        } else {
            $this->error(lang('Error_id'));
        }
        
        // 参数
        $attribute = new Attribute();
        $result_value_column = array_flip($attribute->getTableFields());
        $result_value_column['attribute_id'] = lang('Attribute_Id');
        unset($result_value_column['attribute_group_id']);
        $result_value_column['name'] = lang('Attribute_Name');
        $result_value_column['filtrate'] = lang('filtrate');
        $result_value_column['attribute_value'] = lang('attribute_value');
        $result_value_column['sort'] = lang('Sort');
        
        
        $this->assign('attribute_num', 0);
        $this->assign('arr_columns', $result_value_column);
        $result_attribute = $attribute->where('attribute_group_id', '=', $attribute_group_id)->order('attribute_id', 'ASC')->select();
        if ($result_attribute) {
            $this->assign('arr_values', $result_attribute);
        }
       
        return $this->fetch('admin/attribute/edit');
    }
    
    /**
     * @Mark: 新增页面
     * @return mixed
     * @Author: WangHuaLong
     */
    public function add()
    {
        $this->assign('action_name', 'add');
        $this->assign('meta_title', lang('Add'));
        
        // 选项值
        $attribute = new Attribute();
        $result_value_column = array_flip($attribute->getTableFields());
        $result_value_column['attribute_id'] = lang('Attribute_Id');
        unset($result_value_column['attribute_group_id']);
        $result_value_column['name'] = lang('Attribute_Name');
        $result_value_column['filtrate'] = lang('filtrate');
        $result_value_column['attribute_value'] = lang('attribute_value');
        $result_value_column['sort'] = lang('Sort');
        $this->assign('attribute_num', 0);
        $this->assign('arr_columns', $result_value_column);
        
        $this->assign('arr_values', []);
    
        
        return $this->fetch('admin/attribute/edit');
    }
}
