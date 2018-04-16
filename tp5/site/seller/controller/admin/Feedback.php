<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Feedback.php  Version 2017/4/1 意见反馈
// +----------------------------------------------------------------------
namespace app\seller\controller\admin;

use app\admin\controller\Admin;

class Feedback extends Admin
{
    /**
     * @Mark 意见反馈列表
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/25
     * @return mixed
     */
    public function index()
    {
        $index_map  = [];
        //查询条件
        $param      = $this->request->param();
        $name       = isset($param['name']) ? trim($param['name']) : '';     //关键字
        $start_time = isset($param['start_time']) ? trim($param['start_time']) : ''; //开始时间
        $end_time   = isset($param['end_time']) ? trim($param['end_time']) : '';     //结束时间
    
    
        $start_time ? $index_map['create_time'][]   = ['>=', strtotime(trim($start_time))] : '';
        $end_time   ? $index_map['create_time'][]   = ['<=', strtotime($end_time)] : '';
        $name       ? $index_map['seller_name|content'] = ['like','%'. $name .'%'] : '';
    
        //同时具备时
        if($start_time && $end_time)
        {
            $index_map['create_time'] = [
                ['>=', strtotime($start_time)],
                ['<=', strtotime($end_time)],
                'AND'
            ];
        }

        $list = \app\seller\service\Feedback::feedbackList($index_map);
        $this->assign('list', $list);
        $this->assign('meta_title', lang('Shopsfd'));
        return $this->fetch();
    }
    
    /**
     * @Mark: 回复反馈
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/25
     * @return mixed
     */
    public function savedata()
    {
        $data = input('param.');
        //测试数据  yang  2017/5/25  start
        $data['operator'] = 'admin';
        $data['operator_id'] = '1';
        //测试数据  yang    2017/5/25  end
        $re = \app\seller\service\Feedback::replyFeedback($data);
        if ($re === true) {
            $this->success(lang('successful'), $this->jumpUrl);
        } else {
            return $re;
        }
    }
    
    //测试添加反馈信息  yang    2017/5/25
    public function addData()
    {
        $data = [
            'seller_name' => 'yang',
            'seller_id' => '1',
            'content' => '实打实大所大所',
        ];
        $re = \app\seller\service\Feedback::addFeedback($data);
        if ($re === true) {
            $this->success(lang('successful'), $this->jumpUrl);
        } else {
            return $re;
        }
    }
}