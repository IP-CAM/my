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
// | 搜素筛选  Version 1.0  2016/3/13
// +----------------------------------------------------------------------
namespace app\crossbbcg\controller\admin;

use app\admin\controller\Admin;
use app\crossbbcg\model\Filter as FilterModel;
use app\crossbbcg\service\Filter as FilterApi;
use app\crossbbcg\model\Option as OptionModel;
use app\crossbbcg\model\Brand as BrandModel;
use app\bcwareexp\model\Country as CountryModel;


class Filter extends Admin
{
    
    public function _initialize()
    {
        parent::_initialize();
        $this->conDb = 'Filter';
    }
    
    /**
     * @Mark: 产品参数组列表页
     * @return mixed
     * @Author: WangHuaLong
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
                'id' => 'DESC'
            );
        }
        // 查找
        $map = array();
        $map['langid'] = ['=', LANG];
        if (input('?name')) {
            $map['name'] = array('like', '%' . (string)input('name') . '%');
        }
        
        // 分页显示,叠加搜索条件
        if (config("default_list_rows")) {
            $paginate_list_rows = config("default_list_rows");
        } else {
            $paginate_list_rows = 20;
        }
        
        $filter = new FilterModel();
        $list = $filter->where($map)->order($order_bys)->paginate($paginate_list_rows);
        $this->assign('list', $list);
        // 选项
        $options = OptionModel::where('langid',LANG)->select();
        $this->assign('arr_option',$options);
        // 品牌
        $brands = BrandModel::where('langid',LANG)->select();
        $this->assign('arr_brand',$brands);
        // 国家
        $countries = CountryModel::where('langid',LANG)->select();
        $this->assign('arr_country',$countries);
        
        $total = $filter->count();
        $this->assign('total', $total);
        $this->assign("meta_title", lang('Goods_Search_Filter'));
        return $this->fetch('admin/filter/index');
    }
    
    /**
     * @Mark: 删除参数组
     * @Author: WangHuaLong
     */
    public function delete()
    {
        if (input('post.ids/a')) {
            foreach (input('post.ids/a') as $value) {
                FilterModel::destroy($value);
            }
            $this->success(lang('Deleteok'), $this->jumpUrl);
        } else {
            if (input('?param.ids')) {
                FilterModel::destroy(input('param.ids'));
                $this->success(lang('Deleteok'), $this->jumpUrl);
            } else {
                $this->error(lang('Delete_Filter_Error'), $this->jumpUrl);
            }
        }
    }
    
    /**
     * @Mark: 保存/新增
     * @return bool|\think\response\Json|void
     * @Author: WangHuaLong
     */
    public function save()
    {
        $post_data = $this->request->post();
        if(!isset($post_data['status'])){
            $post_data['status'] = 0;
        }
        if (isset($post_data['id'])) {
            $result = FilterApi::edit($post_data);
        } else {
            $result = FilterApi::add($post_data);
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
        
        if (!input('?ids')) {
            $this->error(lang('Error_id'));
        }
        $result = FilterModel::get(input('ids'));
        $this->assign('data', $result);
        
        return $this->fetch('admin/filter/edit');
    }
    
    /**
     * @Mark: 编辑选项，国家，品牌
     * @return mixed
     * @Author: WangHuaLong
     */
    public function editColumn()
    {
        $id = input('ids');
        $map = [];
        $map['id'] = $id;
        $column = input('column');
        $filter = FilterModel::get($id);
        $option_ids = explode(',', $filter['option_ids']);
        $brand_ids = explode(',', $filter['brand_ids']);
        $country_ids = explode(',', $filter['country_ids']);
        $result = [];
        if ($column == 'option') {
            $options = OptionModel::where('langid', LANG)->select();
            if ($options !== null) {
                foreach ($options as $key => $arr) {
                    
                    $result[$key]['selected'] = in_array($arr['option_id'], $option_ids) ? 1 : 0;
                    $result[$key]['name'] = $arr['name'];
                    $result[$key]['id'] = $arr['option_id'];
                }
            }
        }else if ($column == 'brand') {
            $brands = BrandModel::where('langid', LANG)->select();
            if ($brands !== null) {
                foreach ($brands as $key => $arr) {
            
                    $result[$key]['selected'] = in_array($arr['id'], $brand_ids) ? 1 : 0;
                    $result[$key]['name'] = $arr['name'];
                    $result[$key]['id'] = $arr['id'];
                }
            }
        }else if ($column == 'country') {
            $countries = CountryModel::where('langid', LANG)->select();
    
            if ($countries !== null) {
                foreach ($countries as $key => $arr) {
            
                    $result[$key]['selected'] = in_array($arr['id'], $country_ids) ? 1 : 0;
                    $result[$key]['name'] = $arr['name'];
                    $result[$key]['id'] = $arr['id'];
                }
            }
        }else{
            $this->error(lang('Error_id'), $this->jumpUrl);
        }
        
        $this->assign('column',$column);
        $this->assign('ids', $id);
        $this->assign('list', $result);
        return $this->fetch('admin/filter/editcolumn');
        
    }
    
    /**
     * @Mark: 保存选项id
     * @return \think\response\Json|void
     * @Author: WangHuaLong
     */
    public function optionIdsSave()
    {
        if (input('?column')) {
            $column = input('column/a');
        } else {
            $column = [];
        }
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
        $data = ['id' => input('ids')];
        $data['option_ids'] = $option_ids;
        
        // 保存
        $filter = new FilterModel();
        $filter->allowField(true)->isUpdate(true)->save($data);
        if ($filter->getError() !== null) {
            return json(['code' => 0, 'msg' => $filter->getError()]);
        }
        $this->success(lang('Editok'), $this->jumpUrl);
    }
    
    /**
     * @Mark: 保存品牌
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
        $data = ['id' => input('ids')];
        $data['brand_ids'] = $brand_ids;
        
        // 保存
        $filter = new FilterModel();
        $filter->allowField(true)->isUpdate(true)->save($data);
        if ($filter->getError() !== null) {
            return json(['code' => 0, 'msg' => $filter->getError()]);
        }
        $this->success(lang('Editok'), $this->jumpUrl);
    }
    
    /**
     * @Mark:保存国家
     * @return \think\response\Json|void
     * @Author: WangHuaLong
     */
    public function countryIdsSave()
    {
        if (input('?column')) {
            $column = input('column/a');
        } else {
            $column = [];
        }
        // 将选项id转化为字符串形式，逗号分隔
        if (!empty($column)) {
            $country_ids = [];
            foreach ($column as $key => $arr) {
                if ($arr) {
                    $country_ids[] = $key;
                }
            }
            $country_ids = implode(',', $country_ids);
        } else {
            $country_ids = '';
        }
        $data = ['id' => input('ids')];
        $data['country_ids'] = $country_ids;
        
        // 保存
        $filter = new FilterModel();
        $filter->allowField(true)->isUpdate(true)->save($data);
        if ($filter->getError() !== null) {
            return json(['code' => 0, 'msg' => $filter->getError()]);
        }
         $this->success(lang('Editok'), $this->jumpUrl);
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
        $this->assign('data', []);
        return $this->fetch('admin/filter/edit');
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
            $table->isUpdate(true)->save(['sort' => $sort, $pk => $ids]);
            $this->success(lang('Doingok'));
        } else {
            $this->error(lang('Sortnoselect'));
        }
    }
}
