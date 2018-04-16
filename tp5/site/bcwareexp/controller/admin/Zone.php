<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: fancs
// +----------------------------------------------------------------------
// | 区域管理  Version 2.0  2017/6/21
// +----------------------------------------------------------------------
namespace app\bcwareexp\controller\admin;

use app\admin\controller\Admin;
use app\bcwareexp\model\Country;

class Zone extends Admin
{
    /**
     * @Mark:添加
     * @return mixed
     * @Author: fancs
     * @Version 2017/6/22
     */
    public function add()
    {
        if ($this->request->post()) {
            $country = $this->request->has('country') ? $this->request->param('country') : 0;
            $name    = $this->request->has('name') ? $this->request->param('name') : '';
            $ids     = $this->request->has('ids') ? $this->request->param('ids') : '';
            if (empty($name)) {
                //列出地区选项
                $data = \app\bcwareexp\model\Area::all(function ($query) {
                    $query->where(['type' => ['<>', 2]])->order('sort asc');
                })->toArray();
                $data = self::get_children($data, $country);
                if ($data) return json(['code' => 1, 'data' => $data]);
                return json(['code' => 0, 'data' => $data]);
            } else {
                //处理数据，入库
                $data = [
                    'name'    => $name,
                    'country' => $country,
                    'city'    => $ids,
                ];
                $res  = \app\bcwareexp\service\Zone::save_zone($data);
                if ($res === true) {
                    $this->success(lang('Addnew_ok'), $this->jumpUrl);
                }
                $this->error(lang('Addnew_error'), $this->jumpUrl);
            }
            
        } else {
            $country = Country::all(function ($query) {
                $query->order('sort asc');
            });
            $this->assign('data', null);
            $this->assign('country', $country);
            $this->assign('ACTION_NAME', 'add');
            $this->assign("meta_title", lang('Addnew') . lang('Zone'));
            return $this->fetch('add');
        }
        
        
    }
    
    /**
     * @Mark:编辑
     * @return mixed
     * @Author: fancs
     * @Version 2017/6/22
     */
    public function edit()
    {
        $id = $this->request->has('ids') ? $this->request->param('ids') : $this->error(lang('Error_id'));
        if ($this->request->post()) {
            $country = $this->request->has('country') ? $this->request->param('country') : 0;
            $name    = $this->request->has('name') ? $this->request->param('name') : '';
            $ids     = $this->request->has('idstr') ? $this->request->param('idstr') : '';
            //处理数据，入库
            $data = [
                'id'      => $id,
                'name'    => $name,
                'country' => $country,
                'city'    => $ids,
            
            ];
            $res  = \app\bcwareexp\service\Zone::save_zone($data);
            
            if ($res === true) {
                $this->success(lang('Edit_ok'), $this->jumpUrl);
            }
            $this->error(lang('Edit_error'), $this->jumpUrl);
        }
        $rs      = \app\bcwareexp\model\Zone::get($id);
        $country = Country::all(function ($query) {
            $query->order('sort asc');
        });
        $this->assign("data", $rs);
        $this->assign("ida", $rs['city']);
        $this->assign('country', $country);
        $this->assign('ACTION_NAME', 'edit');
        $this->assign("meta_title", lang('Edit') . lang('Zone'));
        return $this->fetch('edit');
    }
    
    
    /**
     * @Mark:无限分类
     * @param $data
     * @param int $pId
     * @return array|string
     * @Author: fancs
     * @Version 2017/6/22
     */
    static protected function get_children($data, $pId = 0)
    {
        $tree = [];
        foreach ($data as $k => $v) {
            if ($v['pid'] == $pId) {        //父亲找到儿子
                $v['children'] = self::get_children($data, $v['id']);
                $tree[]        = $v;
                //unset($data[$k]);
            }
        }
        return $tree;
        
    }
    
    
}