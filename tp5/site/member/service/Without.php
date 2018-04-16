<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Without.php  Version 2017/6/27 提现API
// +----------------------------------------------------------------------
namespace app\member\service;

use app\admin\service\Service;

class Without extends Service
{
    /**
     * @Mark：查询用户提现记录
     * @param $data ['name'=>'fancs']
     * @return mixed|string
     * @author Fancs
     * @version 2017/5/18
     */
    static public function get_without_log(&$data)
    {
        //检查用户ID对应的应用是否存在或者状态是否正常
        $info = Member::getUserInfo($data);
        if(!$info) return json(['code' => 0, 'msg' => lang('Account is exits or enable')]);
        
        $without = \app\member\model\Without::all(['uid'=>$info['id']]);
        
        if(empty($without)){
            return json(['code' => 0, 'msg' => lang('Can`t find this user withoutlog')]);
        }
        return $without;
    }
    
    /**
     * @Mark:添加提现记录
     * @param $data = [
     *      'uid'           =>  3                   //用户id
     *      'money'         =>  100                 //提现金额
     *      'bank_name'     =>  '支付宝'             //银行名称 如支付宝 微信 中国银行 农业银行等
     *      'account_bank'  =>  '13111111111'       //提现账号
     *      'account_name'  =>  'Fancs'             //账户名称
     *      'remark'        =>  '提现申请'           //备注
     * ]
     * @return bool|\think\response\Json
     * @Author: fancs
     * @Version 2017/6/27
     */
    static public function add_without_log(&$data)
    {
        $class = \think\Loader::parseClass(MODULE_NAME, 'validate', 'Without', false);
        //存在验证器刚执行
        if (class_exists($class)) {
            $validate =  \think\Loader::validate($class);
            $result =   $validate->check($data);
            if(!$result){
                return json(['code' => 0, 'msg' => $validate->getError()]);
            }
        }
    
        
        if($res = \app\member\model\Without::create($data)){
            return true;
        }
        return false;
        
    }
}