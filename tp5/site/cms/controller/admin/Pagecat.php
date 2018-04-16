<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: fancs <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Index  Version 1.0  2016/6/6
// +----------------------------------------------------------------------
namespace app\cms\controller\admin;

use app\admin\controller\Admin;

class Pagecat extends Admin
{
    /**
     * @Mark:单页分类列表页
     * @return mixed
     * @Author: fancs
     * @Version 2017/6/6
     */
    public function index()
    {
        $this->conDb       = 'Pagecat';
        $index_map  = '';
        $name['name']       = input("name");
        //查询条件
        if($name['name'])
        {
            $index_map['name|alias'] =  ['like','%'.trim(input('name')).'%'];
        }
        //按时间查询
        if (input('start_time')) $index_map['create_time'] = ['>=',strtotime(trim(input('start_time')))];
        if (input('end_time')) $index_map['create_time'] = ['<=',strtotime(trim(input('end_time')))];
        
        $lists = $this->lists($this->conDb, $index_map, $this->desc);
        $this->assign('list', $name ? $lists : $lists);
        $this->assign ("meta_title", lang($this->conDb));
        $this->assign ('_total', $lists->count());
        return $this->fetch();
    }
    
}