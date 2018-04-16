<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// ----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Version 2016/11/8 极验证功能
// +----------------------------------------------------------------------
namespace vercode;

use app\common\libs\Vercode;
use think\Request;
use vercode\Geetest\GeetestLib;

class Geetest extends Vercode
{
    
    /**
     * @Mark: 安装
     * @return array
     * @Author: WangHuaLong
     */
    public static function setup()
    {
        
        return array(
            'subjection'  => 'vercode',       //隶属
            'code'        => 'Geetest',        // 扩展器名称名
            'name'        => lang('Geetest_vercode'), // 扩展器名称翻译名
            'description' => lang('Geetest_vercode_desc'), // 扩展器名称翻译描述
            'version'     => '1.0',                                    //版本
            'author'      => 'Runtuer',                                //作者
            'website'     => 'http://www.runtuer.com',                 //出处
            'upgrade'     => '/cmfup/ver2.php',                            //升级位置
            //基本配置项
            'config'      => array(
                'app_id'  => [
                    'title'    => 'ID',
                    'type'     => 'string',
                    'validate' => 'required'
                ],
                'app_key' => [
                    'title'    => 'KEY',
                    'type'     => 'string',
                    'validate' => 'required'
                ]
            
            ),
            //特殊配置项目，可自行定义
            'special'     => array(
                'logo'        => 'geetest.png',
                'appofficial' => 'http://www.geetest.com/', //官方
            ),
        );
    }
    
    /**
     * @Mark:获取验证码
     * @param $data
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/8/23
     */
    static public function create($data)
    {
        // 获取默认配置
        $config  = self::config(self::setup());
        $GtSdk   = new GeetestLib($config['app_id'], $config['app_key']);
        $status  = $GtSdk->pre_process($data, 1);
        session('gtserver', $status);
        session('user_id', $data['user_id']);
        return $GtSdk->get_response_str();
    }
    
    /**
     * @Mark:二次验证
     * @param $data array [
     * 'user_id'   =>  is_login(), # 网站用户id
     * 'client_type' => PLATFORM, #web:电脑上的浏览器；h5:手机上的浏览器，包括移动应用内完全内置的web_view；native：通过原生SDK植入APP应用的方式
     * "'p_address' => get_client_ip() # 请在此处传输用户请求验证时所携带的IP
     * ]
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/8/23
     */
    static public function check($data)
    {
        $check_data = Request::instance()->param();
        // 获取默认配置
        $config  = self::config(self::setup());
        $GtSdk   = new GeetestLib($config['app_id'], $config['app_key']);
        if (session('gtserver') == 1) {
            //服务器正常
            $result = $GtSdk->success_validate($check_data['geetest_challenge'], $check_data['geetest_validate'], $check_data['geetest_seccode'], $data);
        } else {
            //服务器宕机,走failback模式
            $result = $GtSdk->fail_validate($check_data['geetest_challenge'], $check_data['geetest_validate'], $check_data['geetest_seccode']);
        }
        if ($result) {
            return ['code' => 1, 'msg' => ''];
        } else {
            return ['code' => 0, 'msg' => lang('gt_error')];
        }
        
    }
    
    
}