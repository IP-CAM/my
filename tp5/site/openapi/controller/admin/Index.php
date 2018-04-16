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
// | Index  Version 1.0  2016/3/13
// +----------------------------------------------------------------------
namespace app\openapi\controller\admin;

use app\admin\controller\Admin;
use app\openapi\service\Devloper as Devloperapi;

class Index extends Admin
{

    /**
     * @Mark:首页
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/8/9
     */
    public function index()
    {
        $this->index_where = '';
        $this->conDb       = 'Devloper';
        $index_map  = '';
        $name       = input("name");
        if($name)
        {
            $index_map = '`name` LIKE \'%'.$name.'%\' OR `alias` LIKE \'%'.$name.'%\' OR `id` = '.(int)$name.' AND `status` = 1';
        }
    
        $lists = Devloperapi::getlist($this->conDb, $index_map, $this->desc);
        $this->assign('list', $lists['list']);
        $this->assign('page', $lists['page']);
        $this->assign('_total', $lists['total']);
        $this->assign ("meta_title", lang('Devlist'));
        return $this->fetch();
    }
    
    /**
     * @Mark:增加接口
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/8/7
     */
    public function add()
    {
        $this->assign('meta_title', lang('Addnew') . lang('Dever'));
        $this->assign('data', null);
        return $this->fetch('edit');
    }
    
    /**
     * @Mark:修改接口
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/8/7
     */
    public function edit()
    {
        $data = null;
        $this->assign('meta_title', lang('Edit') . lang('Dever'));
        $this->assign('data', $data);
        return $this->fetch();
    }
}