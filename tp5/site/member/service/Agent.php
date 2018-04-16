<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Fancs
// +----------------------------------------------------------------------
// | Invitation.php  Version 2017/5/11 用户体系API
// +----------------------------------------------------------------------
namespace app\member\service;

use app\admin\service\Service;

class Agent extends Service
{
    /**
     * @Mark：查询代理商级别信息
     * @param $data ['map'=>$title]
     * @return bool|string 代理商级别数组信息
     * @author Fancs
     * @version 2017/5/15
     */
    static public function agentinfo(&$data)
    {
        $info =  \app\member\model\Agent::get(function ($query) use ($data){
            $query->where('title',$data['map']);
        });
        if(empty($info)) return lang('Agent title no exit');
        return $info;
    }

}
