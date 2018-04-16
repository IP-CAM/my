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
// | 跨境电子商城B2B2C  Version 1.0  2016/3/13
// +----------------------------------------------------------------------
namespace app\crossbbcg\controller\admin;

use app\admin\controller\Admin;
use app\bcwareexp\model\Country as CountryModel;
use app\crossbbcg\model\NationalPavilion as NationalPavilionModel;
use app\crossbbcg\service\NationalPavilion as NationalPavilionApi;

class Column extends Admin
{
    
    public function _initialize()
    {
        parent::_initialize();
        $this->conDb        = 'NationalPavilion';
        $this->meta_title   = lang('Bbcgcolumn_country');
    }
    
    /**
     * @Mark: 修改
     * @return mixed
     * @Author: WangHuaLong
     */
    public function edit()
    {
        $id = input('ids');
        empty($id) && $this->error(lang('Error_id'));
        
        // 获取品牌信息
        $data = NationalPavilionModel::get($id);
        if (empty($data)) {
            $this->error(lang('Error_id'));
        }
        // 国家
        $arr_country = CountryModel::where('status', 1)->select();
        $this->assign('arr_country', $arr_country);
        
        $this->assign("data", $data);
        $this->assign("meta_title", lang('Bbcgcolumn_country'));
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
            $result = NationalPavilionApi::edit($post_data);
            if ($result['code']) {
                $this->success(lang('Editok'), $this->jumpUrl);
            } else {
                return $result;
            }
        } elseif ($post_data['action_name'] == 'add') {
            $result = NationalPavilionApi::add($post_data);
            if ($result['code']) {
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
        $this->assign("meta_title", lang('Addnew'));
        $this->assign("data", null);
        // 国家
        $arr_country = CountryModel::where('status', 1)->select();
        $this->assign('arr_country', $arr_country);
        
        return $this->fetch('edit');
    }
    
    /**
     * @Mark: 排序
     * @Author: WangHuaLong
     */
    public function sort()
    {
        $sort   = input('sort');
        $ids    = input('ids');
        $modObj = '\\app\\' . MODULE_NAME . '\\model\\' . ucfirst($this->conDb);
        $table  = new $modObj();
        $pk     = $table->getPK();
        if (!empty($sort) && !empty($ids)) {
            $table::where($pk, $ids)->setField('sort', $sort);
            $this->success(lang('Doingok'));
        } else {
            $this->error(lang('Sortnoselect'));
        }
    }
    
}
