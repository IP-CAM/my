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
// | 地区管理  Version 2.0  2017/6/9
// +----------------------------------------------------------------------
namespace app\bcwareexp\controller\admin;

use app\admin\controller\Admin;
use app\bcwareexp\model\Country;
use app\bcwareexp\service\Country as Countryapi;
use app\bcwareexp\service\Area as Areaapi;
use app\bcwareexp\model\Area as AreaModel;

class Area extends Admin
{
    
    /**
     * @Mark:首页
     * @Author: fancs
     * @Version 2017/6/9
     */
    public function index()
    {
        $this->conDb = 'Area';
        $this->desc  = 'sort asc';
        $index_where = [];
        $param       = $this->request->param();
        $name        = isset($param['name']) ? $param['name'] : '';
        if ($name) {
            $index_where['name|code|countrycode'] = ['like', '%' . (string)$name . '%'];
        }
        $index_where['langid'] = LANG;
        //如果是查询下级地区
        $id = $this->request->has('ids') ? $this->request->param('ids') : 0;
        if ($id) {
            $index_where['pid'] = $id;//pid
            
            $lists = Areaapi::getlist($this->conDb, $index_where, $this->desc);
        } else {
            $lists = Countryapi::getlist('Country', $index_where, $this->desc);
        }
        
        $this->assign("list", $lists['list']);
        $this->assign("page", $lists['page']);
        $this->assign("_total", $lists['total']);
        $this->assign('meta_title', lang('Area'));
        return $this->fetch();
    }
    
    /**
     * @Mark:添加
     * @return mixed
     * @Author: fancs
     * @Version 2017/6/9
     */
    public function add()
    {
        //如果是ajax请求，返回省市区
        if ($this->request->isAjax()) {
            $param      = $this->request->param();
            $country_id = isset($param['country_id']) ? $param['country_id'] : 0;
            if ($country_id) {
                $city = \app\bcwareexp\model\Area::all(function ($query) use ($country_id) {
                    $query->where(['langid' => LANG])->order('sort asc');
                });
                $city = sortdata($city);
                return json(['code' => 1, 'data' => $city]);
            } else {
                return json(['code' => 0, 'data' => null]);
            }
        } else {
            //显示页面
            $id      = $this->request->has('ids') ? $this->request->param('ids') : 0;
            $data    = Country::get($id);
            $catlist = \app\bcwareexp\model\Country::all(function ($query) {
                $query->where(['langid' => LANG])->order('sort', 'asc');
            });
            $this->assign("levellist", $catlist);
            $this->assign("data", $data);
            $this->assign("id", $id);
            $this->assign("meta_title", lang('Addnew Area'));
            return $this->fetch('edit');
        }
    }
    
    public function add_child()
    {
        $id = $this->request->has('ids') ? $this->request->param('ids') : 0;
        if ($id > 100000) {
            //id大于100000 是为area地区表
            $model = new \app\bcwareexp\model\Area();
            
        } else {
            //是为国家表
            $model = new \app\bcwareexp\model\Country();
        }
        $catlist = $model::all(function ($query) {
            $query->where(['langid' => LANG])->order('sort', 'asc');
        });
        $this->assign("levellist", $catlist);
        $this->assign("data", null);
        $this->assign("id", $id);
        $this->assign("meta_title", lang('Addnew Area'));
        return $this->fetch('edit');
        
    }
    
    /**
     * @Mark:编辑
     * @return mixed
     * @Author: fancs
     * @Version 2017/6/9
     */
    public function edit()
    {
        $id      = $this->request->has('ids') ? $this->request->param('ids') : $this->error(lang('Error_id'));
        $country = \app\bcwareexp\model\Country::get($id);
        $area    = \app\bcwareexp\model\Area::get($id);
        $list    = \app\bcwareexp\model\Area::all(function ($query) {
            $query->where(['langid' => LANG]);
        });
        
        $this->assign("data", $country ? $country : $area);
        $this->assign("pid", null);
        $this->assign("levellist", sortdata($list));
        $this->assign("meta_title", lang('Edit Area'));
        return $this->fetch();
    }
    
    /**
     * @Mark: 生成中国的省市区json
     * @return \think\response\Json
     * @Author: WangHuaLong
     */
    public function create_region_json()
    {
        // 获取中国的省市区
        $map    = [
            'pid' => 44
        ];
        $region = [];
        $result = AreaModel::where($map)->column('id');
        if ($result !== null) {
            $map2     = [
                'pid'  => ['in', $result],
                'type' => 0
            ];
            $province = AreaModel::where($map2)->order('sort', 'asc')->column('*'); // 省
            if ($province !== null) {
                foreach ($province as $key => $arr) {
                    $children = [];
                    $map3     = [
                        'pid' => $arr['code'],
                    ];
                    $district = AreaModel::where($map3)->order('sort', 'asc')->column('*'); // 市
                    if ($district !== null) {
                        foreach ($district as $key2 => $arr2) {
                            $grandchildren = [];
                            $map4          = [
                                'pid' => $arr2['code'],
                            ];
                            $district      = AreaModel::where($map4)->order('sort', 'asc')->column('*'); // 区
                            if ($district !== null) {
                                foreach ($district as $key3 => $arr3) {
                                    $grandchildren[] = [
                                        'id'       => $arr3['id'],
                                        'value'    => $arr3['name'],
                                        'parentId' => $arr3['pid']
                                    ];
                                }
                            }
                            
                            
                            $children[] = [
                                'id'       => $arr2['id'],
                                'value'    => $arr2['name'],
                                'parentId' => $arr2['pid'],
                                'children' => $grandchildren
                            ];
                        }
                    }
                    
                    
                    $region[] = [
                        'id'       => $arr['code'],
                        'value'    => $arr['name'],
                        'parentId' => $arr['pid'],
                        'children' => $children
                    ];
                }
            }
        }
        $res = false;
        if (!empty($region)) {
            $res = file_put_contents(ROOT_PATH . 'public' . DS . 'static' . DS . 'js' . DS . 'region.json', json_encode($region));
        }
        
        if ($res) {
            return json(['code' => 1, 'msg' => lang('create_ok')]);
        } else {
            return json(['code' => 0, 'msg' => lang('create_error')]);
        }
        
    }
    
    
}