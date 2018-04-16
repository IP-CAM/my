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
// | Refer.php  Version 2017/5/22 咨询
// +----------------------------------------------------------------------
namespace app\member\service;

use think\Loader;
use app\member\model\GoodsRefer as ReferModel;
use app\admin\service\Service;

class Refer extends Service
{
    /**
     * @Mark: 查询咨询详细信息，包括回复信息
     * @param $id int 咨询表id
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/22
     * @return mixed
     */
    static function getReferDetail($id)
    {
        $data = ReferModel::get($id)->toArray();
        return $data;
    }
    
    /**
     * @Mark:更新回复数量
     * @param $id int 咨询表id
     * @param $num int 回复数量 可选
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/23
     * @return boolean
     */
    static function upReplyNum($id, $num = 1)
    {
        if ($num == 1) {
            ReferModel::where('id', $id)->setInc('answer_num');
        } else {
            ReferModel::where('id', $id)->update(['answer_num'=>$num]);
        }
        return true;
    }
    
    /**
     * @Mark: 提交咨询
     * @param $data = [
     *              'user_id'=>1,                              int 用户id
     *              'question'=>'咨询内容',                 string|max:500
     *              'goods_id'=>'咨询商品id',               int
     *              'goods_logo_url'=>'商品图片url'         string|max:200
     *              'goods_name'=>'商品名称'                string|max:50
     * ]
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/22
     * @return array
     */
    static function submitRefer($data)
    {
        //判断用户是否存在
        $re = \app\member\model\Account::get($data['user_id']);
        if (!$re) return ['code' => 0, 'msg' => lang('member_not_exist')];
        
        $data['nickname'] = $re['nickname'];//咨询人昵称
        $data['ip'] = ipToInt(get_client_ip());//咨询人ip
        
        //数据验证
        $className = Loader::parseClass('member','validate','GoodsRefer');
        $validate = Loader::validate($className);
        $re = $validate->check($data);
        if (!$re) return ['code'=>0,'msg'=>$validate->getError()];
        
        //数据入库
        $rec = ReferModel::create($data);
        return ['code'=>1,'data'=>$rec];
    }
}