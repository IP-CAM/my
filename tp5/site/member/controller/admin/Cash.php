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
// | Cash.php  Version 1.0  2017/3/28 提现 & 充值
// +----------------------------------------------------------------------
namespace app\member\controller\admin;

use app\admin\controller\Admin;
use app\member\model\Account;
use app\member\service\Without as WithoutApi;
use think\Db;

class Cash extends Admin
{
    /**
     * @Mark:继承
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/8/9
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->index_where  =  '';
        $this->assign ('status', $this->request->has('status') ?$this->request->param('status') : null );
    }
    
    /**
     * @Mark:提现
     * @return mixed
     * @Author: fancs
     * @Version 2017/5/18
     */
    public function without()
    {
        $this->conDb    = 'Without';
        $index_map      = '';
        $param          = $this->request->param();
        $name           = isset($param['name']) ? trim($param['name']) : '';
        $start_time     = isset($param['start_time']) ? trim($param['start_time']) : '';
        $end_time       = isset($param['end_time']) ? trim($param['end_time']) : '';
        //按用户查询
        if($name)
        {
            $data['name']     =  $name;
            $user = \app\member\service\Member::getUserInfo($data);//获取登陆类型
            $index_map['uid'] = $user['id'];
        }
        //按时间查询
        $start_time ? $index_map['create_time'] = ['>=',strtotime($start_time)] : '';
        $end_time   ? $index_map['create_time'] = ['<=',strtotime($end_time)] : '';
    
        $lists = WithoutApi::getlist($this->conDb, $index_map, $this->desc);
        $this->assign ('list', $lists['list']);
        $this->assign ('_total', $lists['total']);
        $this->assign ('page', $lists['page']);
        $this->assign ("meta_title", lang($this->conDb));
        return $this->fetch();
    }

    /**
     * @Mark 覆盖父类方法
     * @return mixed|\think\response\Json
     * @version 2017/5/18
     * @author fancs
     */
    public function edit()
    {
        if($this->request->isPost()){
            $data=[
                'id'             =>  input('id'),
                'status'         =>  input('status'),
                'pand_remark'    =>  input('pand_remark'),
                'update_time'    =>  time(),
            ];
            if(empty($data['pand_remark'])){
                return json(['code'=>0,'msg'=>lang('Pand_remark_must')]);
            }
            $res = Db::name('Without')->where('id',$data['id'])->update($data);
            if(!$res){
                $this->error(lang('Editerror'), $this->jumpUrl);
            }
            $this->success(lang('Editok'), $this->jumpUrl);

        }else{
            $ids = input('ids');
            empty($ids) && $this->error(lang('Error_id')) ;
            $data = Without::get($ids);
            $nickname = Account::get(function ($query) use ($data){
                $query->where('id',$data['id'])->field('nickname');
            });
            $data['nickname'] = $nickname;
            $this->assign("data", $data ? $data : null );
            $this->assign("meta_title", lang('Edit') . lang($this->conDb));
            return $this->fetch();
        }
    }
}