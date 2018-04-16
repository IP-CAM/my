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
// | Index.php  Version 1.0  2016/3/13
// +----------------------------------------------------------------------
namespace app\admin\controller;

use think\Lang;
use app\admin\model\Manager as ManagerModel;
use app\admin\service\Manager as ManagerApi;

class Index extends Admin
{
    
    /**
     * @Mark:首页
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/1/22
     */
    public function index()
    {
        $this->assign ("meta_title", lang('General'));
        return $this->fetch();
    }
    
    /**
     * @Mark:后台导航
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/1/22
     */
    public function navs()
    {
        Lang::load(realpath(RUNTIME_PATH . '/lang/'.$this->lang.'.php'));//加载合并后的语言包
        $Admin_menus = \think\Cache::get('Menus'); //菜单
    
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
    
        $this->assign ("meta_title", lang('Navs'));
        $this->assign ("node_list", $tree);
        return $this->fetch();
    }
    
    /**
     * @Mark:清除缓存
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/7/28
     */
    public function clearcache() {
        dir_delete(RUNTIME_PATH.'cache/');
        dir_delete(RUNTIME_PATH.'temp/');
        dir_delete(RUNTIME_PATH.'log/');
        dir_delete(RUNTIME_PATH.'lang/');
        $this->savecache();
        $this->success(lang('Clearcacheok'));
    }
    
    /**
     * @Mark:生成随机前后缀
     * @return string
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/5/2
     */
    public function randfix()
    {
        $param  = $this->request->param();
        $len = isset($param['len']) ? $param['len'] : 12;
        return generate_prefix($len);
    }
    
    /**
     * @Mark:我的账户
     * @Author: yang <502204678@qq.com>
     * @Version 2017/9/8
     */
    public function myinfo()
    {
        $param = $this->request->param();
        if ($this->request->isAjax()) {
            unset($param['c']);
            unset($param['a']);
            $data = [
                'model'=>'Manager',
                'pk'=>'id'
            ];
            if ($param['type'] == 'infos'){
                unset($param['type']);
                $data['value'] = $param;
                $res = ManagerApi::savedata($data);
            } else {
                if (empty($param['password']) || $param['password'] !== $param['repassword']) return json(['code'=>0,'msg'=>lang('admin_password_not_same')]);
                unset($param['repassword']);
                unset($param['type']);
                $param['password'] = md5($param['password']);
                $data['value'] = $param;
                $res = ManagerApi::savedata($data);
            }
            if ($res['code']) {
                $this->success(lang('Editok'),'index');
            } else {
                return json($res);
            }
        }
        //获取当前账户信息
        if (!isset($param['ids'])) {
            $uid = UID;
        } else {
            $uid = $param['ids'];
        }
        $info = ManagerModel::get($uid);
        $this->assign('data',$info);
        return $this->fetch();
    }
}