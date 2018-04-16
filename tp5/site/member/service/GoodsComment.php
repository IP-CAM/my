<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | GoodsComment.php  Version 2017/7/5
// +----------------------------------------------------------------------

namespace app\member\service;

use app\admin\service\Service;
use app\member\model\GoodsComment as GoodsCommentModel;
use think\Loader;

class GoodsComment extends Service
{
    /**
     * @Mark:商品评价列表
     * @param $data = [
     *      'seller_id'     =>  2   //商户id
     *      'goods_id'      =>  1   //商品id
     *
     *  ]
     * @return false|static[]
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/5
     */
    static public function lists($data = [])
    {
        $re = GoodsCommentModel::where($data)->order('id', 'desc')->paginate(15);
        return $re;
    }
    
    /**
     * @Mark:新增商品评论
     * @param $data = [
     *      'order_id'      =>  1           //订单id
     *      'order_sn'      =>  '1707051948551234'//订单号
     *      'goods_name'    =>  'apple'     //商品名称
     *      'goods_id'      =>  1           //商品id
     *      'goods_price'   =>  123.12      //销售价格
     *      'uid'           =>  2           //评论人id
     *      'shop_id'       =>  2           //店铺id
     *      'from_membername'=> 'jack'      //评论人
     *      'isanonymity'     =>  1           //是否匿名评论 1匿名 0不匿名
     *      'comment_content'=> '评论内容'
     *      'score'         =>  5           //评分    1-5分
     *      'image'         =>  ['1.png','2.png']          //嗮图url
     * ]
     * @return array
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/5
     */
    static public function add($data)
    {
        //判断是否晒图
        if ($data['image']) {
            $data['is_img'] = 1;
        } else {
            $data['is_img'] = 0;
        }
        //数据验证
        $className = Loader::parseClass('member', 'validate', 'GoodsComment');
        $validate = Loader::validate($className);
        if (!$validate->check($data)) return ['code' => 0, 'msg' => $validate->getError()];
        //数据入库
        $res = GoodsCommentModel::create($data);
        //更新店铺评分
        \app\seller\service\Seller::updateShopScore($data['shop_id']);
        if ($res) {
            return ['code' => 1, 'data' => $res];
        } else {
            return ['code' => 0, 'msg' => lang('service_buzy')];
        }
    }
    
    /**
     * @Mark:商户回复评论
     * @param $data = [
     *      'id'        =>      1,      //评论id
     *      'reply'     =>      '回复内容',
     *  ]
     * @return array
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/5
     */
    static public function reply($data)
    {
        //数据验证
        $className = Loader::parseClass('member', 'validate', 'GoodsComment');
        $validate = Loader::validate($className);
        if (!$validate->scene('reply')->check($data)) return ['code' => 0, 'msg' => $validate->getError()];
        
        //数据入库
        $res = GoodsCommentModel::update($data);
        if ($res) {
            return ['code' => 1, 'data' => $res];
        } else {
            return ['code' => 0, 'msg' => lang('service_buzy')];
        }
    }
    
}
