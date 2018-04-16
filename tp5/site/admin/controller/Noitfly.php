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
// | Noitfly.php  Version 1.0  2017/4/3  消息 & 通知
// +----------------------------------------------------------------------
namespace app\admin\controller;

use app\admin\model\Noite as NoiteModel;

class Noitfly extends Admin
{
    
    /**
     * @Mark:首页
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/2/17
     */
    public function index()
    {
        $map['status']  = ['eq', 1];
        $map['type']    = ['eq', 0];  //消息类型，0：公告， 1，定向发送
        $list = NoiteModel::all(function($query) use ($map){
            $query->where($map)->order('create_time', 'ASC');
        });
    
        $this->assign('list', $list);
        $this->assign('meta_title', lang('Noitfly'));
        $this->assign ('_total', NoiteModel::count());
        return $this->fetch();
    }
}