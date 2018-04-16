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
// | 友情链接  Version 1.0  2016/3/13
// +----------------------------------------------------------------------
namespace app\promotion\controller\admin;
use app\admin\controller\Admin;

class Links extends Admin
{

    /**
     * @Mark:首页
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/8/9
     */
    public function index()
    {
        $this->index_where = '';
        $index_map  = '';
        $name       = input("name");
        if($name)
        {
            $index_map = '`name` LIKE \'%'.$name.'%\' OR `alias` LIKE \'%'.$name.'%\' OR `id` = '.(int)$name.' AND `status` = 1';
        }
    
        $lists = $this->lists($this->conDb, $index_map, $this->desc);
        $this->assign('list', $lists);
        $this->assign('fcatidlist', null);
        $this->assign ("meta_title", lang('Links'));
        return $this->fetch();
    }
}