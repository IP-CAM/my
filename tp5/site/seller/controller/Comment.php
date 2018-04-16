<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Comment.php  Version 评论 2017/6/7
// +----------------------------------------------------------------------

namespace app\seller\controller;

use app\member\model\GoodsComment;
use app\member\model\Account;


class Comment extends Common
{
    /**
     * @Mark:评论管理
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/7
     */
    public function index()
    {
        $param = $this->request->param();
        $data = ['shop_id'=>SellerId];
        
        $goods_name = isset($param['goods_name'])?$param['goods_name']:'';
        $from_membername = isset($param['from_membername'])?$param['from_membername']:'';
        $time = isset($param['time'])?$param['time']:'';
        $level = isset($param['level'])?$param['level']:'';
        $condition = isset($param['condition'])?$param['condition']:'';
        $key_words = isset($param['key_words'])?$param['key_words']:'';
        
        if ($goods_name)  $data['goods_name'] = ['like','%'.$goods_name.'%'];
        if ($from_membername) $data['from_membername'] = ['like','%'.$from_membername.'%'];
        if ($time) {
            $timeArr = explode('-',preg_replace('# #','',$time));
            $data['create_time'] = ['between time',[strtotime($timeArr[0]),strtotime($timeArr[1])]];
        }
        if ($condition && $key_words) $data[$condition] = ['like','%'.$key_words.'%'];
        switch ($level){
            case 1:
                $data['score'] = 1;
                break;
            case 2:
                $data['score'] = ['in',[2,3]];
                break;
            case 4:
                $data['score'] = ['>=',4];
                break;
            default :
                $data['score'] = ['>',0];
                break;
        }
        
        $list = \app\member\service\GoodsComment::lists($data);
        $this->assign('list',$list);
        $this->assign('time',$time);
        $this->assign('level',$level);
        $this->assign('condition',$condition);
        $this->assign('key_words',$key_words);
        $this->assign('meta_title',lang('GoodsComment'));
        return $this->fetch();
    }
    
    /**
     * @Mark:评论详情
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/7
     */
    public function info()
    {
        $id = input('id');
        $info = GoodsComment::get($id);
        if ($info['isanonymous'] == 0) {
            $user_info = Account::get($info['uid']);
            $this->assign('headimg',$user_info['headimg']);
        }
        $this->assign('info',$info);
        return $this->fetch();
    }
    
    /**
     * @Mark:测试新增评论-----------------------------------------测试
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/6
     */
    public function add_comment()
    {
        $data = [
            'order_id'      =>  rand(10000,99999),           //订单id
            'order_sn'      =>  time().'1234',//订单号
            'goods_name'    =>  '金箍棒',     //商品名称
            'goods_id'      =>  1 ,          //商品id
            'goods_price'   =>  123.12,      //销售价格
            'uid'           =>  2,           //评论人id
            'shop_id'       =>  2,           //店铺id
            'from_membername'=> '悟空',      //评论人
            'isanonymous'     =>  0,           //是否匿名评论 1匿名 0不匿名
            'comment_content'=> '评论内容',
            'score'         =>  5 ,          //评分    1-5分
            'image'         =>  [] ,         //嗮图url
            'grade'         =>  '1'          //嗮图url
        ];
        $re = \app\member\service\GoodsComment::add($data);
        if ($re['code'] === 1) {
            $this->success(lang('successful'));
        } else {
            return json($re);
        }
    }
    
    /**
     * @Mark:回复评价
     * @return bool|\think\response\Json
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/6
     */
    public function reply()
    {
        $data = input('param.');
        $re = \app\member\service\GoodsComment::reply($data);
        if ($re['code'] == 1) {
            $log_info = '回复评价，评论id:'.$data['id'].'。操作人：'.session('sellername');
            seller_log(session('sellerId'),session('userid'),$log_info);
            $this->success(lang('successful'),'index');
        } else {
            return json($re);
        }
    }
}
