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
// | 管理员列表  Version 1.0  2016/3/14
// +----------------------------------------------------------------------
namespace app\admin\controller;

use app\admin\model\Role as RoleModel;
use app\admin\service\Manager as Managerapi;
use think\Request;

class Manager extends Admin
{
    /**
     * @Mark:继承
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/21
     */
    public function _initialize()
    {
        parent::_initialize();
        $role = RoleModel::where('status', 1)->column('id, pid, name, alias');
        $this->assign('role', $role ? sortdata($role) : null);
    }
    
    /**
     * @Mark:首页
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/8/21
     */
    public function index()
    {
        $params = $this->request->param();
        $this->index_where = '';
        $index_map  = [];
        $name       = isset($params['name']) ? $params['name'] : null;
        if($name)
        {
            $index_map['username|email|id'] = ['like','%'.$name.'%'];
        }
        if (isset($params['roleid']) && $params['roleid'] !== 'all') $index_map['roleid'] = $params['roleid'];
        $lists = Managerapi::getlist($this->conDb, $index_map, $this->desc);
        $this->assign('list', $lists['list']);
        $this->assign('page', $lists['page']);
        $this->assign('_total', $lists['total']);
        $this->assign('roleid',isset($params['roleid'])?$params['roleid']:null);
        $this->assign ("meta_title", lang('Manager'));
        return $this->fetch();
    }
    
    public function savedata()
    {
        $param = $this->request->param();
        $data = [
            'model'     =>  $this->conDb,
        ];
        unset($param['c']);
        unset($param['a']);
        if (!isset($param['id'])) {
            if ($param['password'] !== $param['repassword']) return json(['code'=>0,'msg'=>lang('admin_password_not_same')]);
            unset($param['repassword']);
            $param['password'] = md5($param['password']);
            $param['operator'] = is_sign();
            $data['value'] = $param;
            $res = Managerapi::savedata($data);
            if ($res['code']) $this->success(lang('Save_ok'),$this->jumpUrl);
        } else {
            $data['value'] = $param;
            $data['pk'] = 'id';
            $res = Managerapi::savedata($data);
            if ($res['code']) $this->success(lang('Editok'),$this->jumpUrl);
        }
        return json($res);
    }
    
}