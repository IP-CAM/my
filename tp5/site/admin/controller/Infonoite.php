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
// | Infonoite.php  Version 2017/2/17  公告&广播
// +----------------------------------------------------------------------
namespace app\admin\controller;

use app\admin\service\Infonoite as Noiteapi;

class Infonoite extends Admin
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
        $map['type']    = ['neq', ''];  //消息类型，0：公告， 1，定向发送
        $param      = $this->request->param();
        /* 查询条件初始化 */
        isset($param['name']) ? $index_map['name|id'] = ['like','%'.trim($param['name']).'%'] : '';
        //按时间查询
        isset($param['start_time']) ? $index_map['create_time'] = ['>=',strtotime(trim($param['start_time']))] : '';
        isset($param['end_time']) ? $index_map['create_time'] = ['<=',strtotime(trim($param['end_time']))] : '';
    
        $list = Noiteapi::getlist('Noite', $map);
        
        $this->assign('list', $list['list']);
        $this->assign('page', $list['page']);
        $this->assign('_total', $list['total']);
        $this->assign('meta_title', lang('Infonoitfly'));
        return $this->fetch();
    }
}