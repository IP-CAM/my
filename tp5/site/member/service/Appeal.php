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
// | Appeal.php  Version 1.0  2017/5/23
// +----------------------------------------------------------------------
namespace app\member\service;

use think\Db;
use think\Loader;
use app\admin\service\Service;
use app\member\model\Appeal as AppealModel;

class Appeal extends Service
{
    /**
     * @Mark: 提交申诉
     * @param  $data = [
     *  'name'  =>'yang'//用户登录信息
     *  'reason'=>'申诉原因'
     * ]
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/23
     * @return string
     */
    static function appeal($data){
        $re = Member::getUserInfo($data);
        if (!$re) return json(['code'=>0,'msg'=>lang('Can`t find this parent or unenable')]);
        $data['user_id']        =   $re['id'];
        $data['user_name']      =   $re['nickname'];
        $data['user_ip']        =   ipToInt(get_client_ip());
        unset($data['name']);
        $validate = Loader::validate('\app\member\validate\Appeal');
        $re = $validate->check($data);//数据验证
        if (!$re) return json(['code'=>0,'msg'=>$validate->getError()]);
        $cre = AppealModel::create($data);
        if ($cre) {
            return json(['code'=>1,'msg'=>lang('Successful')]);
        } else {
            return json(['code'=>0,'msg'=>lang('Submit fail')]);
        }
    }

    /**
     * @Mark:用户取消申诉
     * @param $id int 申诉id
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/23
     * @return boolean
     */
    static function cancelAppeal($id){
        $re = AppealModel::where(['id'=>$id])->setField('status', '4');
        if ($re !== false) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @Mark:申诉审核
     * @param $data = [
     *      'id'  =>1         int           申诉表id
     *      'handling_content'   string     回复内容
     *      'status'            int         审核状态
     *      'operator'          string      操作人（后台管理员）
     *      'operator_id'       int         操作人id（管理员）
     * ];
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/22
     * @return mixed
     */
    static function checkAppeal($data){
        $validate = Loader::validate('\app\member\validate\Appeal');
        $re = $validate->check($data);//数据验证
        if (!$re) return json(['code'=>0,'msg'=>$validate->getError()]);
        $data['check_time'] = time();
        $re = AppealModel::update($data);
        if ($re) {
            return true;
        } else {
            return json(['code'=>0,'msg'=>lang('Submit fail')]);
        }
    }
}