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
// | Feedback  Version 1.0  2017/3/14 留言反馈
// +----------------------------------------------------------------------
namespace app\member\controller\admin;

use app\admin\controller\Admin;
use app\member\service\Feedback as FeedbackApi;

class Feedback extends Admin
{
    /**
     * @Mark:覆盖父类方法
     * @Author: Fancs
     * @Version 2017/5/19
     */
    public function index()
    {
        $this->conDb       = 'Feedback';
        $index_map  = '';
        $name['name']       = input("name");
        //按用户查询
        if($name['name'])
        {
            $user = \app\member\service\Member::getUserInfo($name);//获取登陆类型
            $index_map['uid'] = $user['id'];
        }
        //按时间查询
        if (input('start_time')) $index_map['create_time'] = ['>=',strtotime(trim(input('start_time')))];
        if (input('end_time')) $index_map['create_time'] = ['<=',strtotime(trim(input('end_time')))];
        
        $lists = FeedbackApi::getlist($this->conDb, $index_map, $this->desc);
        $this->assign('list', $lists['list']);
        $this->assign ("meta_title", lang($this->conDb));
        $this->assign ('_total', $lists['total']);
        return $this->fetch();
    }
    
    /**
     * @Mark:回復留言
     * @return mixed|void
     * @Author: fancs
     * @Version 2017/6/8
     */
    public function edit()
    {
        if ($this->request->isPost()){
            $feedback_id = input('id');
            $data=[
                'feedback_id'       => $feedback_id,
                'content'     =>  input('content'),
                'create_time'=> time(),
            ];
            $inset = \app\member\model\FeedbackReply::create($data);
            if($inset){
                $this->success(lang('Editok'), $this->jumpUrl);
            }
            $this->error(lang('Editerror'), $this->jumpUrl);
        }else{
            $ids = input('ids');
            $data = \app\member\model\FeedbackReply::all(['feedback_id'=>$ids]);
            empty($ids) && $this->error(lang('Error_id')) ;
            $this->assign ("meta_title", lang('Reply'));
            $this->assign ("data", $data);
            $this->assign ("id", $ids);
            return $this->fetch();
        }
    }
}