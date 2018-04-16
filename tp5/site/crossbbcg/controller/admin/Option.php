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
// | 商品选项  Version 1.0  2016/3/13
// +----------------------------------------------------------------------
namespace app\crossbbcg\controller\admin;

use app\admin\controller\Admin;
use app\crossbbcg\model\Option as OptionModel;
use app\crossbbcg\model\OptionValue;
use app\crossbbcg\service\Option as OptionApi;

class Option extends Admin
{
    
    public function _initialize()
    {
        parent::_initialize();
        $this->conDb = 'Option';
    }
    
    /**
     * @Mark: 商品选项
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/8/9
     */
    public function index()
    {
        
        // 排序
        if (input('?_field') && input('?_order')) {
            $order_bys = array(
                input('_field') => input('_order')
            );
        } else {
            $order_bys = array(
                'option_id' => 'asc'
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
        
        
        $option = new OptionModel();
        $list = $option->order($order_bys)->where($map)->paginate($paginate_list_rows);
        $this->assign('list', $list);
        
        $total = $option->count();
        $this->assign('total', $total);
        $this->assign("meta_title", lang('Goods_Option'));
        return $this->fetch();
    }
    
    /**
     * @Mark: 改变顺序
     * @return bool|\think\response\Json
     * @Author: WangHuaLong
     */
    public function changeSort()
    {
        $data = array(
            'option_id' => $this->request->post('option_id'),
            'sort' => $this->request->post('sort')
        );
        return OptionApi::changeSort($data);
    }
    
    /**
     * @Mark: 删除选项
     * @Author: WangHuaLong
     */
    public function delete()
    {
        $result = false;
        if (input('post.ids/a')) {
            foreach (input('post.ids/a') as $value) {
                $result = OptionApi::deleteOption($value);
            }
        } else {
            if (input('?param.ids')) {
                $result = OptionApi::deleteOption(input('param.ids'));
            } else {
                $this->error(lang('Delete_Option_Error'), $this->jumpUrl);
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
     * @Mark: 保存或新增
     * @return bool|\think\response\Json|void
     * @Author: WangHuaLong
     */
    public function save()
    {
        $post_data = $this->request->post();
        if ($post_data['action_name'] == 'edit') {
            $result = OptionApi::edit($post_data);
        } elseif ($post_data['action_name'] == 'add') {
            $result = OptionApi::add($post_data);
        } else {
            $this->error(lang('Error_Missing_Param'), $this->jumpUrl);
        }
        
        if ($result['code']) {
            $this->success(lang('Editok'), $this->jumpUrl);
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
            $option_id = input('ids');
        } else {
            $this->error(lang('Error_id'));
        }
        
        // 选项
        $result_option = OptionModel::get($option_id);
        if ($result_option) {
            $this->assign("data", $result_option);
        } else {
            $this->error(lang('Error_id'));
        }
        
        // 选项值
        $option_value = new OptionValue();
        $result_value_column = array_flip($option_value->getTableFields());
        $result_value_column['option_value_id'] = lang('Option_Value_Id');
        unset($result_value_column['option_id']);
        $result_value_column['name'] = lang('Option_Value_Name');
        $result_value_column['sort'] = lang('Sort');
        
        $this->assign('option_value_num', 0);
        $this->assign('arr_columns', $result_value_column);
        $result_option_value = $option_value->where('option_id', '=', $option_id)->order('option_value_id', 'ASC')->select();
        if ($result_option_value) {
            $this->assign('arr_values', $result_option_value);
        }
        
       
        return $this->fetch();
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
        $option_value = new OptionValue();
        $result_value_column = array_flip($option_value->getTableFields());
        $result_value_column['option_value_id'] = lang('Option_Value_Id');
        unset($result_value_column['option_id']);
        $result_value_column['name'] = lang('Option_Value_Name');
        $result_value_column['sort'] = lang('Sort');
        
        $this->assign('option_value_num', 0);
        $this->assign('arr_columns', $result_value_column);
        
        $this->assign('arr_values', []);
        
        return $this->fetch('admin/option/edit');
    }
    
    /**
     * @Mark: 删除选项值验证
     * @return bool|\think\response\Json
     * @Author: WangHuaLong
     */
    public function deleteOptionValueValidate(){
        $option_value_id = input('option_value_id/d');
        $result = OptionApi::deleteOptionValueValidate($option_value_id);
        
        if ($result['code']) {
            return json(['code'=>1,'msg'=>lang('Deleteok')]);
        } else {
            return $result;
        }
    }
}
