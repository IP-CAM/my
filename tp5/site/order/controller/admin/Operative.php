<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Operative.php  Version 2017/7/27 合作商管理
// +----------------------------------------------------------------------
namespace app\order\controller\admin;

use app\admin\controller\Admin;

class Operative extends Admin
{
    /**
     * @Mark:继承
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/27
     */
    public function _initialize()
    {
        parent::_initialize();
        
        $arr_country = \app\crossbbcg\service\Goods::getCountries();
        $this->assign('arr_country', $arr_country);
        $this->meta_title = lang('Cooperative');
    }
}