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
// | Attribute.php  Version 1.0 2017/6/14 属性管理
// +----------------------------------------------------------------------
namespace app\cms\controller\admin;

use app\admin\controller\Admin;
use app\cms\service\Itemtype;

class Itemattr extends Admin
{
    /**
     * @Mark:继承
     * @Author: fancs
     * @Version 2017/6/14
     */
    public function _initialize()
    {
       
        parent::_initialize();
        $this->index_where = '';
    }
    /**
     * @Mark:列表
     * @return mixed
     * @Author: fancs
     * @Version 2017/6/14
     */
    public function index()
    {
        $this->conDb    =  'Itemtype';
        $index_where = [];
        $name        = input('name');
        if($name){
            $index_where['name|iden|langid']  			= array('like', '%'.(string)$name.'%');
        }
        $lists = Itemtype::getlist($this->conDb, $index_where, $this->desc);
       
        $this->assign("list", $lists['list']);
        $this->assign('_total', $lists['total']);
        $this->assign('page', $lists['page']);
        $this->assign('meta_title', lang('Itemattr'));
        return $this->fetch();
    }
    
    /**
     * @Mark: 保存/新增 参数组与参数
     * @return bool|\think\response\Json|void
     * @Author: WangHuaLong
     */
    public function save()
    {
        
        $post_data = $this->request->post();
        //return json(['code'=>0,'msg'=>$post_data['langid']]);
        if ($post_data['action_name'] == 'edit') {
            $result = Itemtype::edit($post_data);
        } elseif ($post_data['action_name'] == 'add') {
            $result = Itemtype::add($post_data);
        } else {
            $this->error(lang('Error_Missing_Param'), $this->jumpUrl);
        }
        
        if ($result === true) {
            $this->success(lang('Editok'), $this->jumpUrl);
        } else {
            return $result;
        }
    }
    
    /**
     * @Mark:新增页面
     * @return mixed
     * @Author: fancs
     * @Version 2017/6/14
     */
    public function add()
    {
        $this->assign('action_name', 'add');
        $this->assign('meta_title', lang('Add attr'));
        
        //构建选项值
        $attribute = new \app\cms\model\Itemattr();     //实例化
        $result_value_column = $attribute->getFieldsType(); //获取字段名
        $result_value_column['sort'] = lang('Sort');
        $result_value_column['name'] = lang('Attr_name');
        $result_value_column['type_id'] = 'id';
        
        unset($result_value_column['article_id']);
        unset($result_value_column['id']);
        unset($result_value_column['status']);
        unset($result_value_column['create_time']);
        unset($result_value_column['update_time']);
    
        $this->assign('attribute_num', 0);
        $this->assign('arr_columns', $result_value_column);
    
        $this->assign('arr_values', []);
        
        return $this->fetch('admin/itemattr/edit');
    }
    
    /**
     * @Mark: 编辑页面
     * @return mixed
     * @Author: fancs
     * @Version 2017/6/14
     */
    public function edit()
    {
        $this->assign('action_name', 'edit');
        $this->assign('meta_title', lang('Edit'));
        
        if (input('?ids')) {
            $attribute_type_id = input('ids');
        } else {
            $this->error(lang('Error_id'));
        }
        
        // 参数组
        $result_attribute_type = \app\cms\model\Itemtype::get($attribute_type_id);
        if ($result_attribute_type) {
            $this->assign("data", $result_attribute_type);
        } else {
            $this->error(lang('Error_id'));
        }
        
        // 参数
        $attribute = new \app\cms\model\Itemattr();
        $result_value_column = $attribute->getFieldsType(); //获取字段名
        $result_value_column['sort'] = lang('Sort');
        $result_value_column['name'] = lang('Attr_name');
        $result_value_column['type_id'] = 'id';
        unset($result_value_column['article_id']);
        unset($result_value_column['id']);
        unset($result_value_column['status']);
        unset($result_value_column['create_time']);
        unset($result_value_column['update_time']);
        
        $this->assign('attribute_num', 0);
        $this->assign('arr_columns', $result_value_column);
        
        $result_attribute = $attribute->where('type_id', '=', $attribute_type_id)->order('id', 'ASC')->select();
        if ($result_attribute) {
            $this->assign('arr_values', $result_attribute);
        }
        
        $this->assign('langlist', $this->getLanguageList());
        
        return $this->fetch('admin/itemattr/edit');
    }
}