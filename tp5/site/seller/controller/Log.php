<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Log.php  Version 操作日志 2017/6/8
// +----------------------------------------------------------------------

namespace app\seller\controller;

use app\seller\service\SellerLog as SellerLogApi;

class Log extends Common
{
    public function _initialize()
    {
        parent::_initialize();
    }
    /**
     * @Mark:日志列表
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/8
     */
    public function index()
    {
        $where = ['seller_id'=>SellerId];
        $param = $this->request->param();
        $time = isset($param['time'])?$param['time']:'';
        $key_words = isset($param['key_words'])?$param['key_words']:'';
    
        if ($time) {
            $timeArr             = explode('-', preg_replace('# #', '', $time));
            $where['log_time'][] = ['>=', strtotime($timeArr[0])];
            $where['log_time'][]   = ['<=', strtotime($timeArr[1])];
        }
        
        if ($key_words) $where['log_info'] = ['like','%'.$key_words.'%'];
        
        $list = SellerLogApi::getlist('SellerLog',$where);
        $this->assign('list',$list['list']);
        $this->assign('meta_title',lang('Log'));
        $this->assign('time',$time);
        $this->assign('key_words',$key_words);
        return $this->fetch();
    }
}
