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
namespace app\union\controller\admin;

use app\admin\controller\Admin;
use app\union\service\Ads as Adsapi;

class Index extends Admin
{
    /**
     * @Mark:继承
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/7
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->conDb = 'Ads';
    }
    
    /**
     * @Mark:问题列表
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/25
     */
    public function index()
    {
        $index_map  = '';
        //查询条件
        $param      = $this->request->param();
    
        isset($param['name']) ? $index_map['name|id'] = ['like','%'.trim($param['name']).'%'] : '';
        //按时间查询
        isset($param['start_time']) ? $index_map['create_time'] = ['>=',strtotime(trim($param['start_time']))] : '';
        isset($param['end_time']) ? $index_map['create_time'] = ['<=',strtotime(trim($param['end_time']))] : '';
    
        //赋值
        $lists = Adsapi::getlist($this->conDb, $index_map, $this->desc);
        $this->assign('list', $lists['list']);
        $this->assign('page', $lists['page']);
        $this->assign('_total', $lists['total']);
        $this->assign ("meta_title", lang('Unadslist'));
        return $this->fetch();
    }
    
}