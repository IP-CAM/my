<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | consult.php  Version 咨询 2017/6/7
// +----------------------------------------------------------------------

namespace app\seller\controller;

use app\member\service\Refer;
use app\member\model\GoodsRefer;
use app\member\model\GoodsReply;


class Consult extends Common
{
    /**
     * @Mark:咨询列表
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/7
     */
    public function index()
    {
        $data = [];
        $param = $this->request->param();
        
        $nickname = isset($param['nickname'])?$param['nickname']:'';
        $time = isset($param['time'])?$param['time']:'';
        $question = isset($param['question'])?$param['question']:'';
        
        if ($nickname) $data['nickname'] = ['like','%'.$nickname.'%'];
        if ($question) $data['question'] = ['like','%'.$question.'%'];
        if ($time) $data['create_time'] = ['between time',explode('-',preg_replace('# #','',$time))];
        
        $lists = GoodsRefer::where($data)->paginate(15);
        $this->assign('lists',$lists);
        $this->assign('time',$time);
        $this->assign('meta_title',lang('GoodsConsult'));
        return $this->fetch();
    }
    
    /**
     * @Mark:咨询详情
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/7
     */
    public function info()
    {
        $id = input('id');
        $info = Refer::getReferDetail($id);
        $info['reply'] = GoodsReply::all(['refer_id'=>$id]);
        $this->assign('info',$info);
        return $this->fetch();
    }
    
    /**
     * @Mark:新增商品咨询 ----------------------- 测试
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/7
     */
    public function add_test_consult()
    {
        $data = [
            'user_id'   =>1,
            'question'=>2,
            'goods_id'=>1,
            'goods_name'=>'ashfakjs',
            'goods_logo_url'=>'dasd',
        ];
        $re  = Refer::submitRefer($data);
        if ($re['code'] == 1) {
            $this->success('successful');
        } else {
            return json($re);
        }
    }
    
    /**
     * @Mark:新增回复咨询---------------------测试
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/7
     */
    public function reply()
    {
        $data = input('param.');
        $data['id'] = session('sellerId');
        $data['type'] = 3;
        $re = \app\member\service\Reply::referAnswer($data);
        if ($re['code'] == 1) {
            $log_info = '回复咨询，咨询id:'.$data['refer_id'].'。操作人:'.session('sellername');
            seller_log(session('sellerId'),session('userid'),$log_info);
            $this->success(lang('success'),'index');
        } else {
            return json($re);
        }
    }
}
