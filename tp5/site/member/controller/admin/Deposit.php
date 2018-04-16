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
// | Deposit.php  Version 1.0  2016/3/13 预存款明细
// +----------------------------------------------------------------------
namespace app\member\controller\admin;

use app\admin\controller\Admin;
use app\member\model\Account;
use app\member\service\Deposit as Depositapi;

class Deposit extends Admin
{

    /**
     * @Mark:预存款明细
     * @Author: Fancs
     * @Version 2017/5/19
     */
    public function index()
    {
        $index_map  = '';
        $param      = $this->request->param();
        
        $name       = isset($param['name']) ? trim($param['name']) : '';     //关键字
        $start_time = isset($param['start_time']) ? trim($param['start_time']) : ''; //开始时间
        $end_time   = isset($param['end_time']) ? trim($param['end_time']) : '';     //结束时间
    
        $name       ? $index_map['title'] = ['like','%'. $name .'%'] : '';
        
        //按用户查询
        if(isset($param['name']))
        {
            $user = \app\member\service\Member::getUserInfo($param['name']);//获取登陆类型
            $index_map['uid'] = $user['id'];
        }
    
        //同时具备时
        if($start_time && $end_time)
        {
            $index_map['create_time'] = [
                ['>=', strtotime($start_time)],
                ['<=', strtotime($end_time)],
                'AND'
            ];
        }
        
        //按时间查询
        $data = Depositapi::getlist($this->conDb, $index_map, $this->desc);
        $this->assign('list', $data['list']);
        $this->assign ('page', $data['page']);
        $this->assign ('_total', $data['total']);
        $this->assign ("meta_title", lang($this->conDb));
        return $this->fetch();
    }
    /**
     * @Mark 充值预存款
     * @return mixed|\think\response\Json
     * @version 2017/5/19
     * @author fancs
     */
    public function savemoney()
    {
        if ($this->request->isPost()){
            $uid = input('id');
            $data=[
                'uid'       => $uid,
                'money'     =>  input('money'),
                'remark'    =>  input('remark'),
                'create_time'=> time(),
                'from'      =>  'Admin',
            ];
            $user = Account::get($uid);
            //更新预存款数据
            $res = Account::update(['money'=>$user['money']+$data['money']],['id'=>$uid]);
            if($res !== false){
                //写入预存款明细
                \app\member\model\Deposit::create($data);
                return $this->success(lang('Editok'), $this->jumpUrl);
            }else{
                return $this->error(lang('Editerror'), $this->jumpUrl);
            }
        }else{
            $ids = input('ids');
            empty($ids) && $this->error(lang('Error_id')) ;
            $data = \app\member\model\Deposit::get($ids);
            $user = Account::get($data['uid']);
            $this->assign ("meta_title", lang('money'));
            $this->assign('user', $user);
            $this->assign('data', $data);
            return $this->fetch();
        }
    }
}