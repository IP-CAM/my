<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Address.php  Version 2017/7/20  地址管理
// +----------------------------------------------------------------------

namespace app\member\controller;

use app\member\model\GoodsComment;
use app\order\model\Order as OrderModel;
use app\order\model\Goods as OrderGoodsModel;
use app\member\model\GoodsComment as GoodsCommentModel;
use app\crossbbcg\model\Goods as GoodsModel;

class Comment extends Passport
{
    /**
     * @Mark:评价管理
     * @Author: yang <502204678@qq.com>
     * @Version 2017/8/23
     */
    public function index()
    {
        $uid   = is_login();
        $where = [
            'uid' => $uid
        ];
        $param = $this->request->get('condition');
        if ($param == 'reply') $where['reply'] = ['<>', ''];
        if ($param == 'is_img') $where['is_img'] = 1;
        $data = GoodsCommentModel::where($where)->paginate(config('paginate')['list_rows']);
        foreach ($data as $k =>$v) {
            $data[$k]['thumb'] = GoodsModel::where(['id'=>$v['goods_id']])->value('thumb');
        }
        //晒图数
        $is_img_num = GoodsCommentModel::where(['uid' => $uid, 'is_img' => 1])->count();
        $this->assign('show_img_num', $is_img_num);
        //回复数
        $reply_num = GoodsCommentModel::where(['uid' => $uid, 'reply' => ['<>', '']])->count();
        $this->assign('reply_num', $reply_num);
        //总评论数
        $total = GoodsCommentModel::where(['uid' => $uid])->count();
        $this->assign('total', $total);
        $this->assign('data', $data);
        return $this->fetch();
    }
    
    /**
     * @Mark:商品评价
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/8/22
     */
    public function add()
    {
        $user_id = is_login();
        $param   = $this->request->get();
        if (!isset($param['order_sn'])) $this->redirect('index');
        //查询订单信息
        $order_info = OrderModel::get(['order_sn' => $param['order_sn'], 'user_id' => $user_id]);
        //查询订单下所有商品
        $order_goods_info = OrderGoodsModel::where(['order_id' => $order_info['order_id']])->select();
        if (!$order_info || !$order_goods_info) $this->redirect('index');
        $this->assign('data', $order_goods_info);
        $this->assign('order_info', $order_info);
        return $this->fetch();
    }
    
    /**
     * @Mark:保存
     * @return \think\response\Json
     * @Author: yang <502204678@qq.com>
     * @Version 2017/8/22
     */
    public function save()
    {
        $param = $this->request->post();
        //订单信息
        $user_id = is_login();
        $order_info = OrderModel::get(['order_sn' => $param['order_sn'],'user_id' => $user_id]);
        if (!$order_info) $this->error(lang('param_error'));
        //用户信息
        $user_info = \app\member\model\Account::get($user_id);
        foreach ($param['comment'] as $k => $v) {
            foreach ($v as $kk => $vv) {
                $goods_info = OrderGoodsModel::get(['order_id' => $order_info['order_id'], 'goods_id' => $k, 'sku' => $kk]);
                $data       = [
                    'order_id'        => $order_info['order_id'],
                    'order_sn'        => $order_info['order_sn'],
                    'goods_name'      => $goods_info['goods_name'],
                    'goods_id'        => $k,
                    'sku_id'          => $kk,
                    'sku_name'        => $goods_info['sku_array'],
                    'goods_price'     => $goods_info['sku_price'],
                    'uid'             => is_login(),
                    'shop_id'         => $goods_info['seller_id'],
                    'from_membername' => $user_info['nickname'],
                    'isanonymous'     => isset($vv['isanonymity']) ? $vv['isanonymity'] : 0,
                    'comment_content' => empty($vv['comment_content']) ? '用户暂未评价，系统默认好评' : $vv['comment_content'],
                    'score'           => (int)$vv['score'],
                ];
                if (isset($vv['img'])) {
                    foreach ($vv['img'] as $ik => $iv) {
                        if (substr($iv, 1, 7) == 'uploads') {
                            $vv['img'][$ik] = substr($iv, 9);
                        }
                    }
                    $data['image'] = $vv['img'];
                } else {
                    $data['image'] = [];
                }
                $re = \app\member\service\GoodsComment::add($data);
                if ($re['code'] == 0) {
                    return json($re);
                    break;
                }
            };
        };
        //修改订单表的评价状态
        OrderModel::where(['order_id' => $order_info['order_id'],'user_id' => $user_id])->update(['is_evaluate' => 1]);
        return json(['code' => 1, 'msg' => lang('comment_success'), 'url' => url('index')]);
    }
    
    /**
     * @Mark:晒图
     * @return \think\response\Json
     * @Author: yang <502204678@qq.com>
     * @Version 2017/8/22
     */
    public function ajax_upload()
    {
        $file = $this->request->file('file');
        return $this->up($file);
    }
    
}