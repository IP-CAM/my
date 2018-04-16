<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Advertising.php  Version 2017/8/3
// +----------------------------------------------------------------------

namespace app\crossbbcg\controller\admin;

use app\admin\controller\Admin;
use think\Request;
use app\crossbbcg\service\AdPosition as AdPositionApi;

class Advertising extends Admin
{
    public function _initialize()
    {
        parent::_initialize();
        $this->conDb = 'Advertising';
        $this->index_where['ad_type'] = ['<=',2];
        //广告位列表
        $ad_list = AdPositionApi::getlist('AdPosition',['langid'=>LANG,'status'=>1,'ad_type'=>1]);
        $this->assign('ad_list',$ad_list['list']);
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
