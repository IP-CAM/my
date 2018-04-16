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
use think\Db;
use app\fans\service\Circle as Circleapi;

class Index extends Admin
{
    /**
     * @Mark:继承
     * @Author: fancs
     * @Version 2017/5/24
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->conDb = 'Circle';
        $type        = \app\fans\service\Type::get_type($data);//获取类型
        $this->assign('type', $type ? $type : null);
        $account    = Member::all_account();
        $this->assign('account', $account);
    }
    
    /**
     * @Mark:圈子列表页
     * @return mixed
     * @Author: fancs
     * @Version 2017/5/25
     */
    public function index()
    {
        $index_map  = [];
        $parems     = $this->request->param();
        $name       = isset($parems['name']) ? $parems['name'] : '';
        $type_id    = isset($parems['review']) ? $parems['review'] : '';
        $start_time = isset($param['start_time']) ? trim($param['start_time']) : ''; //开始时间
        $end_time   = isset($param['end_time']) ? trim($param['end_time']) : '';     //结束时间

        if ($name) {
            $index_map['name'] = array('like', '%' . (string)$name . '%');
            $user = \app\member\service\Member::getUserInfo($name);//获取登陆类型
            $index_map['uid'] = $user['id'];
        }
        $type_id  ? $index_map['review'] = $type_id : $index_map['review'] = '';
        //dump($index_map);die;
        //按时间查询
        $start_time ? $index_map['create_time'] = ['>=', strtotime($start_time)] : '';
        $end_time   ? $index_map['create_time'] = ['<=', strtotime($end_time)] : '';
        //同时具备时
        if($start_time && $end_time)
        {
            $index_map['create_time'] = ['between' => [$start_time, $end_time]];
        }
    
        $lists = Circleapi::getlist($this->conDb, $index_map, $this->desc);
        $this->assign('list', $lists['list']);
        $this->assign('page', $lists['page']);
        $this->assign('_total', $lists['total']);
        $this->assign('review', $type_id);
        $this->assign("meta_title", lang($this->conDb));
        return $this->fetch();
    }
    
    /**
     * @Mark:保存数据
     * @return string
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/25
     */
    public function save()
    {
        $data = $this->request->post();
        $res = \app\fans\service\Circle::save_circle($data);
        if ($res === true) {
            //添加成功，添加圈主信息到成员表
            $circle_id = Db::name("Circle")->getLastInsID();
            $param = [
                'uid' => $data['uid'],
                'circle_id' => $circle_id,
                'circle_name' => $data['name'],
                'account_name' => get_username($data['uid']),
                'apply_time' => time(),
                'apply_state' => 1,
                'join_time' => time(),
                'is_identity' => 1,
            ];
            $rs = \app\fans\service\Member::save_member($param);
            if ($rs === true) {
                $this->success(lang('Addnew_ok'), $this->jumpUrl);
            } else {
                $this->error(lang('Addnew_fail'), $this->jumpUrl);
            }
        } elseif ($res === false) {
            $this->error(lang('Addnew_fail'), $this->jumpUrl);
        } else {
            return $res;
        }
    }
    
    /**
     * @Mark 处理审核状态
     * @return mixed|\think\response\Json
     * @version 2017/5/18
     * @author fancs
     */
    public function review()
    {
        $parems  = $this->request->param();
        $ids     = isset($parems['ids']) ? $parems['ids'] : '';
        $review  = isset($parems['review']) ? $parems['review'] : '';
        empty($ids) && $this->error(lang('Error_id'));
        empty($review) && $this->error(lang('Error_id'));
        
        if ($this->request->isPost()) {
            $data = [
                'id'     => $ids,
                'review' => $review,
            ];
            $res = Circle::update($data);
            if (!$res) {
                $this->error(lang('Editerror'), $this->jumpUrl);
            }
            $this->success(lang('Editok'), $this->jumpUrl);
            
        } else {
            $data = Circle::get($ids);
            $this->assign("data", $data ? $data : null);
            $this->assign("meta_title", lang('Edit') . lang('Review'));
            return $this->fetch();
        }
    }
    
}