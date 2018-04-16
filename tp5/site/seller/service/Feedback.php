<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Feedback.php  Version 意见反馈  2017/5/25
// +----------------------------------------------------------------------
namespace app\seller\service;

use think\Model;
use think\Loader;


class Feedback extends Model
{
    
    /**
     * @Mark:添加意见反馈
     * @param   $data = [
     * 'seller-_id'=>1,
     * 'seller_name'=>'yang',
     * 'content'=>'123132',
     * 'email'  =>'12@qq.com',
     * 'mobile' =>13333333333
     * ]
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/25
     * @return array
     */
    static function addFeedback($data)
    {
        if (!isset($data['seller_id']) || empty($data['seller_id'])) return ['code' => 0, 'msg' => lang('id_error')];
        
        //数据验证
        $feedback_class = Loader::parseClass('seller', 'validate', 'Feedback');
        $validate = Loader::validate($feedback_class);
        $result = $validate->scene('insert')->check($data);
        if (!$result) return ['code' => 0, 'msg' => $validate->getError()];
        
        //数据入库
        $re = \app\seller\model\Feedback::create($data);
        return ['code' => 1, 'data' => $re];
    }
    
    /**
     * @Mark: 反馈列表
     * @param $where array
     * $param $order array
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/25
     * @return mixed
     */
    static public function feedbackList($where = [], $order = ['id' => 'desc'])
    {
        $data = \app\seller\model\Feedback::where($where)->order($order)->paginate(15);
        return $data;
    }
    
    /**
     * @Mark:  回复反馈信息
     * @param $data array ['id'=>1,'handling_content'=>'132133','operator'=>'admin','operator_id'=>123]
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/25
     * @return mixed
     */
    static public function replyFeedback($data)
    {
        $feedback_class = Loader::parseClass('seller', 'validate', 'Feedback');
        $validate = Loader::validate($feedback_class);
        $result = $validate->scene('update')->check($data);
        if (!$result) return ['code' => 0, 'msg' => $validate->getError()];
        $data['status'] = 2;
        $re = \app\seller\model\Feedback::update($data);
        if ($re) {
            return ['code' => 1, 'data' => $re];
        } else {
            return ['code' => 0, 'msg' => lang('fail')];
        }
    }
}