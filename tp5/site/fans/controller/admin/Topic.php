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
// | Index  Version 1.0  2016/3/13
// +----------------------------------------------------------------------

namespace app\fans\controller\admin;

use app\admin\controller\Admin;
use app\fans\model\Circle;
use app\member\service\Member;
use app\fans\service\Topic as Topicapi;

class Topic extends Admin
{
    /**
     * @Mark:继承
     * @Author: fancs
     * @Version 2017/5/25
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->conDb        = 'Topic';
        $this->assign('circle', Circle::all());
        $this->assign('account', Member::all_account());
    }
    /**
     * @Mark:话题列表页
     * @return mixed
     * @Author: fancs
     * @Version 2017/5/25
     */
    public function index()
    {
        $index_map  = [];
    
        $parems  = $this->request->param();
        $name    = isset($parems['name']) ? $parems['name'] : '';
        $review  = isset($parems['review']) ? $parems['review'] : '';
        
        //按用户查询
        if($name)
        {
            $user = \app\member\service\Member::getUserInfo($name);//获取登陆类型
            $index_map['uid'] = $user['id'];
        }
        
        //按时间查询
        $start_time = isset($param['start_time']) ? trim($param['start_time']) : ''; //时间开始
        $end_time   = isset($param['end_time']) ? trim($param['end_time']) : '';     //时间结束
        if ($start_time && $end_time)
        {
            $index_map['create_time'] = ['between' => [$start_time, $end_time]];
        }

        $lists = Topicapi::getlist($this->conDb, $index_map, $this->desc);
        $this->assign('list', $lists['list']);
        $this->assign('page', $lists['page']);
        $this->assign('_total', $lists['total']);
        $this->assign ("meta_title", lang($this->conDb));
        return $this->fetch();
    }
}