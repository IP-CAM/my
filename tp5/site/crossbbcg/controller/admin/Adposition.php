<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Adposition.php  Version 2017/8/4
// +----------------------------------------------------------------------

namespace app\crossbbcg\controller\admin;

use app\admin\controller\Admin;
use think\Request;

class Adposition extends Admin
{
    public function _initialize()
    {
        parent::_initialize();
        $this->conDb = 'AdPosition';
    }
    
    public function savedata()
    {
        $param = $this->request->post();
        if (!isset($param['status'])) $this->request->post(['status'=>0]);
        if (!isset($param['pc_status'])) $this->request->post(['pc_status'=>0]);
        if (!isset($param['wap_status'])) $this->request->post(['wap_status'=>0]);
        if (!isset($param['api_status'])) $this->request->post(['api_status'=>0]);
        parent::savedata();
    }
}
