<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Hscode.php  Version 2017/5/17 商品海关编码采集器
// +----------------------------------------------------------------------
namespace app\bigdata\controller\admin;

use app\admin\controller\Admin;
use app\bigdata\model\Hscode as HscodeModel;

class Hscode extends Admin
{
    /**
     * @Mark:商品海关编码列表页
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/5/17
     */
    public function index()
    {
        $this->assign('meta_title', lang('Hscode'));
        $this->assign('list', HscodeModel::all());
        return $this->fetch();
    }
}