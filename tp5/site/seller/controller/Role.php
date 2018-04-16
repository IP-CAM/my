<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Role.php  Version 角色 2017/6/8
// +----------------------------------------------------------------------
namespace app\seller\controller;

use think\Request;
use think\Cache;
use app\seller\service\Role as Roles;
use app\seller\model\Role as RoleModel;
use think\Session;

class Role extends Common
{
    /**
     * @Mark:角色管理
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/8
     */
    public function index()
    {
        $list = RoleModel::all(['seller_id' => SellerId]);
        $this->assign('list', $list);
        $this->assign('meta_title',lang('RoleManage'));
        return $this->fetch();
    }
    
    /**
     * @Mark:添加角色
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/8
     */
    public function add(Request $request)
    {
        if ($request->isAjax()) {
            $data = $request->param();
            $data['seller_id'] = SellerId;
            $data['right'] = strtolower(serialize($data['right']));
            $re = Roles::add_role($data);
            if ($re['code'] == 1) {
                $log_info = '添加角色，角色名称:'.$data['name'].'。操作人:'.Session::get('sellername');
                seller_log(SellerId,Session::get('userid'),$log_info);
                $this->success(lang('success'), 'seller/role/index');
            } else {
                return json($re);
            }
        } else {
            $this->assign('nodeArr', $this->nodelist());
            $this->assign('data',null);
            return $this->fetch();
        }
    }
    
    /**
     * @Mark:删除角色
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/15
     */
    public function delete()
    {
        $data = $this->request->param('id');
        $re = RoleModel::destroy($data);
        if ($re) {
            $this->success(lang('success'), 'seller/role/index');
        } else {
            $this->error(lang('fail'));
        }
    }
    
    /**
     * @Mark:编辑角色
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/15
     */
    public function edit()
    {
        $data = $this->request->param();
        if ($this->request->isAjax()) {
            $data['seller_id'] = SellerId;
            $data['right'] = strtolower(serialize($data['right']));
            $re = Roles::edit_role($data);
            if ($re['code'] == 1) {
                $this->success(lang('success'), 'index');
            } else {
                return json($re);
            }
        } else {
            $id = (int)$data['ids'];
            $data = RoleModel::get($id);
            $data['rightArr'] = unserialize($data['right']);
            $this->assign('data', $data);
            $this->assign('nodeArr', $this->nodelist());
            return $this->fetch('add');
        }
        
    }
    
    /**
     * @Mark:权限节点列表
     * @return array
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/21
     */
    public function nodelist()
    {
        $menu = Cache::get('ShopMenus');
        $tree = [];
        foreach ($menu as $k => $v) {
            if (isset($menu[$v['pid']])) {
                if ($menu[$v['pid']]['button'] == 1) {
                    dump($menu[$v['pid']]);
                }
                $menu[$v['pid']]['button'][$k] = &$menu[$k];
                
            } else {
                $tree[$k] = &$menu[$k];
            }
        }
        //剔除公共方法
        foreach ($tree as $k => $v) {
            //判断顶级节点是否受权限控制
            if ($v['permission']) {
                if (is_array(getAssessList())  && (!in_array(strtolower($k),getAssessList()) &&!in_array(strtolower($v['url']),getAssessList()))){
                    unset($tree[$k]);
                    continue;
                }
                if (is_array($v['button']) && !empty($v['button'])) {
                    //遍历二级子节点
                    foreach ($v['button'] as $kk => $vv) {
                        if ($vv['permission'] ) {
                            if (is_array(getAssessList())  && (!in_array(strtolower($kk),getAssessList()) && !in_array(strtolower($vv['url']),getAssessList()))){
                                unset($tree[$k]['button'][$kk]);
                                continue;
                            }
                            if (is_array($vv['button']) && !empty($vv['button'])) {
                                //遍历三级按钮节点
                                foreach ($vv['button'] as $kkk => $vvv) {
                                    if (is_array(getAssessList())  && !in_array(strtolower($vvv['1']),getAssessList())){
                                        unset($tree[$k]['button'][$kk]);
                                        continue;
                                    }
                                    //判断按钮是否受权限控制
                                    if (!$vvv[9]) {
                                        unset($tree[$k]['button'][$kk]['button'][$kkk]);
                                    }
                                }
                            }
                        } else {
                            unset($tree[$k]['button'][$kk]);
                        }
                    }
                }
            } else {
                unset($tree[$k]);
            }
        }
        return $tree;
    }
}
