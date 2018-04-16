<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Account.php  Version 账户管理 2017/6/8
// +----------------------------------------------------------------------

namespace app\seller\controller;

use app\seller\model\Role;
use app\seller\service\Account as Accounts;
use app\seller\model\Account as AccountModel;
use think\Request;
use think\Session;

class Account extends Common
{
    public function _initialize()
    {
        parent::_initialize();
        $this->conDb = 'Account';
        $rolelist = Role::all(['seller_id' => session('sellerId')]);
        $this->assign('rolelist', $rolelist);
    }
    
    /**
     * @Mark:账户管理
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/8
     */
    public function index()
    {
        $data = AccountModel::all(['pid' => SellerId]);
        foreach ($data as &$v) {
            $v['rolename'] = Role::where('id', $v->role_id)->value('name');
        }
        $this->assign('list', $data);
        $this->assign('meta_title',lang('AccountManage'));
        return $this->fetch();
    }
    
    /**
     * @Mark:添加子账户
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/8
     */
    public function add()
    {
        if ($this->request->isAjax()) {
            $data = $this->request->param();
            if (!isset($data['role_id']) || empty($data['role_id']) || !$data['role_id']) $this->error(lang('choose_role'));
            //判断密码是否一致
            if ($data['password'] !== $data['repassword']) $this->error(lang('pwd_not_equal'));
            unset($data['repassword']);
            //添加上级id
            $data['pid'] = SellerId;
            //子账户状态默认通过审核
            $data['status'] = 1;
            //验证场景
            $data['scene'] = 'add_son';
            //数据入库
            $re = Accounts::addSeller($data);
            if ($re['code'] == 1) {
                $log_info = '添加子账户:'.$data["nickname"].'。添加人是：'.session('sellername');
                seller_log(SellerId,Session::get('userid'),$log_info);
                $this->success(lang('success'), 'index');
            } else {
                return json($re);
            }
        } else {
            $this->assign('data',null);
            return $this->fetch();
        }
    }
    
    /**
     * @Mark:删除子账户
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/15
     */
    public function delete()
    {
        $param = (array)$this->request->param();
        $ids = (array)$param['ids'];
        $re = AccountModel::destroy(['id'=>['in',$ids]]);
        if ($re) {
            $log_info = '删除子账户，id:'.implode(',',$ids).'。操作人：'.session('sellername');
            seller_log(session('sellerId'),session('userid'),$log_info);
            $this->success(lang('success'), 'seller/account/index');
        } else {
            $this->error(lang('fail'));
        }
    }
    
    /**
     * @Mark:账号修改
     * @param Request $request
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/15
     */
    public function edit(Request $request)
    {
        if ($request->isAjax()) {
            $data = $request->param();
            $re = Accounts::editSeller($data);
            if ($re['code'] == 1) {
                $log_info = '修改子账户，id:'.$data['id'].'。操作人：'.session('sellername');
                seller_log(session('sellerId'),session('userid'),$log_info);
                $this->success(lang('success'), 'index');
            } else {
                $this->error(lang('fail'));
            }
        } else {
            $id = $request->param('id');
            $data = AccountModel::get($id);
            $this->assign('data', $data);
            return $this->fetch('add');
        }
    }
    
    /**
     * @Mark:密码修改
     * @param Request $request
     * @return bool|mixed|string
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/15
     */
    public function edit_pwd(Request $request)
    {
        if ($request->isAjax()) {
            $data = $request->param();
            //密码比对
            if ($data['password'] !== $data['repassword']) $this->error(lang('pwd_not_equal'));
            unset($data['repassword']);
            //更新
            $re = Accounts::editPwd($data);
            if ($re['code'] == 1) {
                $log_info = '修改子账户密码，账户id:'.$data['id'].'。操作人：'.Session::get('sellername');
                seller_log(SellerId,Session::get('userid'),$log_info);
                $this->success(lang('success'), 'seller/account/index');
            } else {
                return json($re);
            }
        } else {
            $id = $request->param('id');
            $data = AccountModel::get($id);
            $this->assign('data', $data);
            return $this->fetch();
        }
    }
    
}
