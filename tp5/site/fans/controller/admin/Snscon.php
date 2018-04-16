<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: fancs <theseaer@qq.com>
// +----------------------------------------------------------------------
// | 社交资讯  Version 1.0  2016/5/31
// +----------------------------------------------------------------------
namespace app\fans\controller\admin;

use app\admin\controller\Admin;
use app\fans\service\Snscon as Snsconapi;

class Snscon extends Admin
{
    /**
     * @Mark:继承
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/5/24
     */
    public function _initialize()
    {
        parent::_initialize();
        $type   = \app\fans\service\Type::get_type();//获取类型
        $this->assign('type', $type ? $type : null);
    }
    /**
     * @Mark:首页
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/8/21
     */
    public function index()
    {
        $index_map  = [];
    
        $parems     = $this->request->param();
        $name       = isset($parems['name']) ? (array)$parems['name'] : '';
    
        //按时间查询
        $start_time = isset($param['start_time']) ? trim($param['start_time']) : ''; //时间开始
        $end_time   = isset($param['end_time']) ? trim($param['end_time']) : '';     //时间结束
        if ($start_time && $end_time)
        {
            $index_map['create_time'] = ['between' => [$start_time, $end_time]];
        }
        
        //按用户查询
        if($name)
        {
            $user = Member::getUserInfo($name);//获取登陆类型
            $index_map['uid'] = $user['id'];
        }
    
        $lists = Snsconapi::getlist($this->conDb, $index_map, $this->desc);
        $this->assign('list', $lists['list']);
        $this->assign('page', $lists['page']);
        $this->assign('_total', $lists['total']);
        $this->assign ("meta_title", lang($this->conDb));
        return $this->fetch();
    }
    
}