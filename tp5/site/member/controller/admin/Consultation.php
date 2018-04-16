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
// | Consultation.php  Version 2017/3/28 咨询管理
// +----------------------------------------------------------------------
namespace app\member\controller\admin;

use app\admin\controller\Admin;
use app\member\service\Refer;
use app\member\service\Reply;
use app\member\service\Refer as Referapi;

class Consultation extends Admin
{
    
    /**
     * @Mark: 咨询列表
     * @param start_time string 查询开始时间
     * @param end_time string 查询结束时间
     * @param name string 查询咨询人、id、咨询内容关键字
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/22
     * @return mixed
     */
    public function index()
    {
        $index_map  = [];
        //查询条件
        $param      = $this->request->param();
    
        isset($param['name']) ? $index_map['question|nickname|user_id'] = ['like','%'.trim($param['name']).'%'] : '';
        //按时间查询
        isset($param['start_time']) ? $index_map['time'] = ['>=',strtotime(trim($param['start_time']))] : '';
        isset($param['start_time']) ? $index_map['time'] = ['<=',strtotime(trim($param['end_time']))] : '';
        
        $data = Referapi::getlist('GoodsRefer', $index_map);
        $this->assign('list',$data['list']);
        $this->assign('page',$data['page']);
        $this->assign('_total',$data['total']);
        return $this->fetch();
    }

    /**
     * @Mark:咨询详情
     * @param id int 咨询id
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/22
     * @return mixed
     */
    public function view()
    {
        $this->conDb    = 'GoodsReply';
        $id = (int)input('id');
        //判断是否传值
        if (empty($id)) return json(['code'=>0,'msg'=>lang('Error_id')]);
        
        //查询咨询信息
        $where = ['refer_id'=>$id];
        $data = Refer::getReferDetail($id);
        
        //加入回复列表信息
        $data['reply'] = $this->lists($this->conDb,$where);
        
        //更新回复数量
        Refer::upReplyNum($id,$data['reply']->total());
        
        $this->assign('answer_nickname','admin');
        $this->assign('admin_id',1);
        $this->assign('info',$data);
        $this->assign('page',$data['reply']->render());
        $this->assign('answer_total',$data['reply']->total());
        return $this->fetch();
    }

    /**
     * @Mark: 回复咨询
     * @param user_id|admin_id|seller_id
     * @param answer string 回复内容
     * @param nickname string 回复人昵称
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/23
     * @return mixed
     */
    public function store()
    {
        $data = input('param.');

        //测试数据  yang  2017/5/24   start
        $data['type'] = 1;
        $data['name'] = 'jack';
        //测试数据  yang  2017/5/24    end
        $re = Reply::referAnswer($data);
        
        if ($re === true) {
            $this->success(lang('successful'),$this->jumpUrl);
        } else {
            return $re;
        }
    }
    
}