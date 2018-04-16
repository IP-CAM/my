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
// | Index  Version 1.0  2017/5/27
// +----------------------------------------------------------------------
namespace app\member\controller\admin;

use app\admin\controller\Admin;
use app\member\model\Level;
use app\member\model\Agent;
use app\member\model\Tag;
use app\member\service\Member as MemberApi;
use app\member\service\Account as AccountApi;
use app\member\model\Account as AccountModel;

class Index extends Admin
{
    /**
     * @Mark:继承
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/20
     */
    public function _initialize()
    {
        $this->conDb = 'Account';
        parent::_initialize();
        $this->assign('level', Level::all());
        $this->assign('agent', Agent::all());
        $this->assign('tag', Tag::all());
    }
    
    /**
     * @Mark:覆盖父类方法
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/8/21
     */
    public function index()
    {
        $index_map      = '';
        $input          = $this->request->param();
        $level          = isset($input['levelid']) ? trim($input['levelid']) : '';   //用户组
        $name           = isset($input['name']) ? str_replace(' ', '', $input['name']) : ''; //搜索词
        $type           = isset($input['type']) ? trim($input['type']) : '';         //类型
        $start_time     = isset($input['start_time']) ? trim($input['start_time']) : ''; //搜索词
        $end_time       = isset($input['end_time']) ? trim($input['end_time']) : '';     //搜索词
        
        //按用户查询
        if ($name) {
            $userType = self::getUserType($name);//获取登陆类型
            $index_map[$userType] = $name;
        }
        $level ? $index_map['levelid']  = $level : '';
        //按时间查询
        $start_time ? $index_map['reg_time'] = ['>=', strtotime(trim($start_time))] : '' ;
        $end_time ? $index_map['reg_time']   = ['<=', strtotime(trim($end_time))] : '' ;
    
        $lists = AccountApi::getlist($this->conDb, $index_map, $this->desc);
        
        $this->assign("meta_title", lang('Userlist'));
        $this->assign("list", $lists['list']);
        $this->assign('page', $lists['page']);
        $this->assign('_total', $lists['total']);
        $this->assign('levelid', $level);
        $this->assign('type', $type);
        return $this->fetch();
    }
    
    /**
     * @Mark:会员软删除
     * @Author: fancs
     * @Version 2017/7/17
     */
    public function delete_false()
    {
        $ids = $this->request->param('ids/a');
        empty($ids) && $this->error(lang('Deletenoselect'));
        foreach ($ids as $v) {
            $map[] = ['id' => $v, 'status' => 0];
        }
        $account = new AccountModel();
        try {
            $status = $account->saveAll($map);
        } catch (\Exception $e) {
            $this->error(lang('Executeerror'), $this->jumpUrl);  //带刷新
        }
        if ($status !== false) {
            $this->success(lang('Deleteok'), $this->jumpUrl);
        } else {
            $this->error(lang('Deleteerror'), $this->jumpUrl);
        }
    }
    
    /**
     * @Mark:修改密码
     * @Author: Fancs
     * @Version 2017/5/17
     */
    public function password()
    {
        if ($this->request->isPost()) {
            $data = [
                'id' => input('id'),
                'password' => input('password'),
                'repassword' => input('repassword'),
            ];
            if ($data['password'] !== $data['repassword']) return json(['code' => 0, 'msg' => $this->lang('Password_error')]);
            //更新密码
            $res = AccountModel::update(['password' => md5($data['password'])], ['id' => $data['id']], 'password');
            if ($res) return json(['code' => 1, 'msg' => lang('Update password OK')]);
            return json(['code' => 0, 'msg' => lang('Update password error')]);
        } else {
            $id = input('ids');
            $this->assign("meta_title", lang('Savepassword'));
            $this->assign("id", $id);
            return $this->fetch();
        }
    }
    
    /**
     * @Mark:显示用户其他信息
     * @Author: Fancs
     * @Version 2017/5/27
     */
    public function view()
    {
        $id = input('ids');
        $data = AccountModel::get($id);
        $tag = Tag::get(function ($query) use ($data) {
            $query->where('id', $data['tag_id']);
        });
        $data['tag_id'] = $tag['name'];
        $agent = Agent::get(function ($query) use ($data) {
            $query->where('id', $data['agent_id']);
        });
        $data['agent_id'] = $agent['title'];
        $parent = AccountModel::get(function ($query) use ($data) {
            $query->where('idcard', $data['pidcard'])->field('nickname');
        });
        $data['pidcard'] = $parent['nickname'];
        $this->assign("meta_title", lang('Other'));
        $this->assign("data", $data);
        return $this->fetch();
    }
    
    /**
     * @Mark:返回用户类型
     * @param $name
     * @return string
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/8/9
     */
    static public function getUserType($name)
    {
        return MemberApi::checkLoginNameType($name);
    }
}