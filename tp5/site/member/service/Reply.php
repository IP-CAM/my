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
// | Reply.php  Version 2017/5/23
// +----------------------------------------------------------------------
namespace app\member\service;

use think\Loader;
use app\member\model\GoodsReply;
use app\admin\service\Service;

class Reply extends Service
{
    /**
     * @Mark: 回复咨询
     * @param $data = [
     *      'type'      =>1              账户类型 1会员 2管理员 3商户                                int
     *      'id'        =>1              当前用户id                                                 int
     *      'answer'    =>'回复内容'      回复内容                                                  string
     *      'refer_id'  =>'1'            咨询表id                                                  int
     *
     * ]
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/23
     * @return array
     */
    static public function referAnswer($data)
    {
        //判断账户类型，返回不同角色id
        if ($data['type'] == 1) {
            $re = \app\member\model\Member::get($data['id']);
            if (!$re) return ['code' => 0, 'msg' => lang('Can`t find this parent or unenable')];
            $data['uid'] = $data['id'];
        } else if ($data['type'] == 2) {
            $re = \app\admin\model\Account::get($data['id']);
            if (!$re) return ['code' => 0, 'msg' => lang('Can`t find this parent or unenable')];
        } else {
            $re = \app\seller\model\Account::get($data['id']);
            if (!$re) return ['code' => 0, 'msg' => lang('Can`t find this parent or unenable')];
        }
        
        $data['nickname'] = $re['nickname'];
        
        //防止入库
        unset($data['id']);
        unset($data['name']);
        unset($data['type']);
        
        //数据验证
        $className = Loader::parseClass('member', 'validate', 'GoodsReply');
        $validate = Loader::validate($className);
        $re = $validate->check($data);
        if (!$re) return ['code' => 0, 'msg' => $validate->getError()];
        //数据入库
        $re = GoodsReply::create($data);
        
            //更新回复数量
            Refer::upReplyNum($data['refer_id']);
        return ['code' => 1, 'data' => $re];
    }
}