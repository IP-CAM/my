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
// | 品牌  Version 1.0  2016/3/13
// +----------------------------------------------------------------------
namespace app\crossbbcg\controller\admin;

use app\admin\controller\Admin;
use app\crossbbcg\model\Brand as BrandModel;
use app\crossbbcg\service\Brand as BrandApi;
use app\bcwareexp\model\Country as CountryModel;

class Brand extends Admin
{
    
    /**
     * @Mark:首页
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/8/9
     */
    public function index()
    {
        // 查询
        $map = [];
        $name = input('name');
        $map['langid'] = ['=', LANG];
        if ($name) {
            $map['name|alias|firstchar|url'] = array('like', '%' . (string)$name . '%');
        }
        
        
        // 排序
        if (input('?_field') && input('?_order')) {
            $order_bys = array(
                input('_field') => input('_order')
            );
        } else {
            $order_bys = array(
                'id' => 'asc'
            );
        }
        
        // 分页显示,叠加搜索条件
        if (config("default_list_rows")) {
            $paginate_list_rows = config("default_list_rows");
        } else {
            $paginate_list_rows = 20;
        }
    
        // 国家
        $arr_country = CountryModel::where('status',1)->column('name','id');
        $this->assign('arr_country', $arr_country);
        
    
    
        $lists = BrandModel::where($map)->order($order_bys)->paginate($paginate_list_rows);
        
        $this->assign('list', $lists);
        $this->assign('_total', BrandModel::count());
        $this->assign("meta_title", lang('Brandlist'));
        return $this->fetch();
    }
    
    /**
     * @Mark: 品牌编辑页面
     * @return mixed
     * @Author: WangHuaLong
     */
    public function edit()
    {
        $brand_id = input('ids');
        empty($brand_id) && $this->error(lang('Error_id'));
        
        // 获取品牌信息
        $data = BrandModel::get($brand_id);
        if (empty($data)) {
            $this->error(lang('Error_id'));
        }
        // 国家
        $arr_country = CountryModel::where('status',1)->select();
        $this->assign('arr_country', $arr_country);
        
        $this->assign("data", $data);
        $this->assign("meta_title", lang('Edit') . lang('brand'));
        return $this->fetch();
    }
    
    /**
     * @Mark: 保存 新增/修改数据
     * @return \think\response\Json|void
     * @Author: WangHuaLong
     */
    public function savedata()
    {
        $post_data = $this->request->post();
        if ($post_data['action_name'] == 'edit') {
            $result = BrandApi::edit($post_data);
            if ($result['code'] ) {
                $this->success(lang('Editok'), $this->jumpUrl);
            } else {
                return $result;
            }
        } elseif ($post_data['action_name'] == 'add') {
            $result = BrandApi::add($post_data);
            if ($result['code'] ) {
                $this->success(lang('Editok'), $this->jumpUrl);
            } else {
                return $result;
            }
        }
    }
    
    /**
     * @Mark: 新增页面
     * @return mixed
     * @Author: WangHuaLong
     */
    public function add()
    {
        $this->assign("meta_title", lang('Addnew') . lang($this->conDb));
        $this->assign("data", null);
        // 国家
        $arr_country = CountryModel::where('status',1)->select();
        $this->assign('arr_country', $arr_country);
        
        return $this->fetch('edit');
    }
    
    /**
     * @Mark: 排序
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
     * @Mark: 删除
     * @Author: WangHuaLong
     */
    public function delete()
    {
        $result = false;
        if (input('post.ids/a')) {
            foreach (input('post.ids/a') as $value) {
                $result = BrandApi::deleteBrand($value);
            }
        } else {
            if (input('?param.ids')) {
                $result = BrandApi::deleteBrand(input('param.ids'));
            } else {
                $this->error(lang('Delete_AttributeGroup_Error'), $this->jumpUrl);
            }
        }
        
        if ($result['code'] ) {
            $this->success(lang('Deleteok'), $this->jumpUrl);
        } else {
            return $result;
        }
    }
    
}
