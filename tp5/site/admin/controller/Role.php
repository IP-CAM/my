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
// | 角色管理  Version 1.0  2016/3/14
// +----------------------------------------------------------------------
namespace app\admin\controller;

use think\Lang;
use app\admin\model\Role as RoleModel;
use app\admin\service\Role as Roleapi;

class Role extends Admin
{
    /**
     * @Mark:继承
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/8
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->desc    = ''.$this->pk.' asc';
    }
    /**
     * @Mark:
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/17
     */
    public function edit(){
        $ids = input('ids');
        empty($ids) && $this->error(lang('Error_id')) ;
        $pidlist        = RoleModel::where('status', 1)->column('pid, id, name, alias');
        $data           = RoleModel::get($ids);
        $this->assign("data", $data ? $data : null );
        $this->assign("meta_title", lang('Edit'));
        $this->assign('pidlist', sortdata($pidlist));
        return $this->fetch();
    }
    
    /**
     * @Mark:新增
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/18
     */
    public function add()
    {
        $pidlist = RoleModel::where('status', 1)->column('pid, id, name, alias');
        $this->assign('pidlist', sortdata($pidlist));
        $this->assign("data", null );
        $this->assign("meta_title", lang('Addnew'). lang('Role'));
        return $this->fetch('edit');
    }
    
    /**
     * @Mark:授权管理页面
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/27
     */
    public function access()
    {
        $params = $this->request->param();
        Lang::load(realpath(RUNTIME_PATH . '/lang/'.$this->lang.'.php'));//加载合并后的语言包
        $Admin_menus = cache('Menus'); //菜单
    
        $tree = []; //格式化好的树
        foreach ($Admin_menus as $key => $item)
        {
            if (isset($Admin_menus[$item['pid']]))
                $Admin_menus[$item['pid']]['son'][$key] = &$Admin_menus[$key];
            else
                $tree[$key] = &$Admin_menus[$key];
        }
    
        //剔除公共方法
        foreach ( $tree as $k => $item)
        {
            if( ! $tree[$k]['permission']) unset($tree[$k]);
        }
    
        $map['status']  = ['eq', 1];
        $role   = RoleModel::all(function($query) use ($map){
            $query->where($map)->order('sort', 'ASC');
        })->toArray();
    
        $this->assign('authapp', $tree);
        $this->assign('role', sortdata($role));
        $this->assign('meta_title', lang('Auth'));
        $this->assign('group', isset($params['gid']) ? $role[$params['gid'] - 1] : null);
        $this->assign('tree', null);
        return $this->fetch();
    }
}