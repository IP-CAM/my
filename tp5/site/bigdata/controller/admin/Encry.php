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
use app\bigdata\model\Encry as EncryModel;

class Encry extends Admin
{
    /**
     * @Mark:加密串
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/5/17
     */
    public function index()
    {
        $this->assign('meta_title', lang('Cryptography'));
        $this->assign('list', EncryModel::all());
        return $this->fetch();
    }
}