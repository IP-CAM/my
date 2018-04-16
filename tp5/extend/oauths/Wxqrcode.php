<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Wxqrcode.php  Version 2017/4/4  微信网站扫码登陆
// +----------------------------------------------------------------------
namespace oauths;

use app\common\libs\Oauth;

class Wxqrcode extends Oauth
{
    /**
     * @Mark:扩展配置信息
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/9/15
     */
    public static function setup()
    {
        return array(
            'subjection'    => 'oauths',    //隶属
            'code'          => 'Wxqrcode',     // 扩展器名称名
            'name'          => lang('Wxqrcode_oauth'), // 扩展器名称翻译名
            'description'   => lang('Wxqrcode_oauth_desc'), // 扩展器名称翻译描述
            'version'       => '1.0',                                    //版本
            'author'        => 'Runtuer',                                //作者
            'website'       => 'http://www.runtuer.com',                 //出处
            'upgrade'       => '/cmfup/ver2.php',                            //升级位置
            //基本配置项
            'config'        => array(
                'appKey' => array(
                    'title'     => 'appKey',
                    'type'      => 'string',
                    'validate'  => 'required',
                ),
                'appSecret' => array(
                    'title'     => 'appSecret',
                    'type'      => 'string',
                    'validate'  => 'required',
                ),
            ),
            //特殊配置项目，可自行定义
            'special' => array(
                'logo'          => 'qrcode.png',
                'appofficial'   => 'https://mp.weixin.qq.com/',         //官方
                'country'       => ['zh-cn'],   //适用国家
            ),
        );
    }
    
    /**
     * @Mark:登录地址
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/20
     */
    public function getLoginUrl()
    {
        // TODO: Implement getLoginUrl() method.
    }
    
    /**
     * @Mark:状态检查
     * @param $parms
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/20
     */
    public function checkStatus($parms)
    {
        // TODO: Implement checkStatus() method.
    }
    
    /**
     * @Mark:获取访问TOKEN
     * @param $parms
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/20
     */
    public function getAccessToken($parms)
    {
        // TODO: Implement getAccessToken() method.
    }
    
    /**
     * @Mark:获取用户信息
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/20
     */
    public function getUserInfo()
    {
        // TODO: Implement getUserInfo() method.
    }
}