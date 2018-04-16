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
// | Home.php  Version 1.0  2017/6/16
// +----------------------------------------------------------------------
namespace app\cms\controller\admin;
use app\admin\controller\Admin;
use app\cms\service\Home as Homeapi;

class Home extends Admin
{
    
    /**
     * @Mark:首页
     * @Author: fancs
     * @Version 2017/6/16
     */
    public function index()
    {
        $index_map   = '';
        $this->conDb = 'Home';
    
        $param       = $this->request->param();
        if (isset($param['name'])) {
            $index_where['name|title'] = array('like', '%' . (string)$param['name'] . '%');
        }
        $index_where["langid"]              = $this->index_where;
        
        $lists = Homeapi::getlist($this->conDb, $index_map, $this->desc);
        $this->assign('list', $lists['list']);
        $this->assign('page', $lists['page']);
        $this->assign('_total', $lists['total']);
        $this->assign ("meta_title", lang('Home'));
        return $this->fetch();
    }
}