<?php
// +----------------------------------------------------------------------
// | LTHINK [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2015-2016 http://LTHINK.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 涛哥 <liangtao.gz@foxmail.com>
// +----------------------------------------------------------------------
// | WeixinSDK.class.php 2015-12-01
// +----------------------------------------------------------------------
namespace oauths;

use app\common\libs\Oauth;

class Weixin extends Oauth
{
    private $AppID = '';
    private $AppSecret = '';
    
    public function __construct($config)
    {
        //获取配置参数
        $info   = self::setup();
        $where  = ['code' => $info['code'], 'subjection' => $info['subjection']];
        $config = self::config($where);
        
        $this->AppID     = isset($config['appKey']) ? $config['appKey'] : "";
        $this->AppSecret = isset($config['appSecret']) ? $config['appSecret'] : "";
    }
    
    /**
     * @Mark:扩展配置信息
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/9/15
     */
    public static function setup()
    {
        return array(
            'subjection'  => 'oauths',    //隶属
            'code'        => 'Weixin',     // 扩展器名称名
            'name'        => lang('Weixin_oauth'), // 扩展器名称翻译名
            'description' => lang('Weixin_oauth_desc'), // 扩展器名称翻译描述
            'version'     => '1.0',                                    //版本
            'author'      => 'Runtuer',                                //作者
            'website'     => 'http://www.runtuer.com',                 //出处
            'upgrade'     => '/cmfup/ver2.php',                            //升级位置
            //基本配置项
            'config'      => array(
                'appKey'    => array(
                    'title'    => 'appKey',
                    'type'     => 'string',
                    'validate' => 'required',
                ),
                'appSecret' => array(
                    'title'    => 'appSecret',
                    'type'     => 'string',
                    'validate' => 'required',
                ),
            ),
            //特殊配置项目，可自行定义
            'special'     => array(
                'logo'        => 'wechat.png',
                'appofficial' => 'https://mp.weixin.qq.com/',         //官方
                'country'     => ['zh-cn'],   //适用国家
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
        $urlparam = array(
            "appid=" . $this->AppID,
            "redirect_uri=" . urlencode(parent::getReturnUrl()),
            "response_type=code",
            "scope=snsapi_login",
            "state=" . rand(100, 999),
        );
        $url      = "https://open.weixin.qq.com/connect/qrconnect?" . join("&", $urlparam) . "#wechat_redirect";
        return $url;
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
        if (isset($parms['error']) || !isset($parms['code'])) {
            return false;
        } else {
            return true;
        }
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
        $urlparam = array(
            "appid=" . $this->AppID,
            "secret=" . $this->AppSecret,
            "code=" . $parms['code'],
            "grant_type=authorization_code",
        );
        $url      = "https://api.weixin.qq.com/sns/oauth2/access_token?" . join("&", $urlparam);
        
        //模拟post提交
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $result    = curl_exec($ch);
        $tokenInfo = json_decode($result, true);
        if (!$tokenInfo || !isset($tokenInfo['access_token'])) {
            die(var_export($result));
        }
        
        //获取用户信息
        $unid = $tokenInfo['openid'];
        //$unid = isset($tokenInfo['unionid']) ? $tokenInfo['unionid'] : $tokenInfo['openid'];
        $name = substr($unid, -8);
        
        //获取微信用户信息
        $wechatUser = $this->apiUserInfo($tokenInfo);
        if ($wechatUser && isset($wechatUser['nickname'])) {
            $wechatName = trim(preg_replace('/[\x{10000}-\x{10FFFF}]/u', "", $wechatUser['nickname']));
            $name       = $wechatName ? $wechatName : $name;
        }
        \think\Session::set('wechat_user_nick', $name);
        \think\Session::set('wechat_user_id', $unid);
    }
    
    /**
     * @Mark:获取用户信息
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/20
     */
    public function getUserInfo()
    {
        $userInfo = array();
        $userInfo['id']   = \think\Session::get('wechat_user_id');
        $userInfo['name'] = \think\Session::get('wechat_user_nick');
        $userInfo['sex']  = 1;
        return $userInfo;
    }
    
    /**
     * @Mark:获取用户的基本信息
     * @param $oauthAccess
     * *$oauthAccess = {
     * "access_token": "****",
     * "expires_in": 7200,
     * "refresh_token": "****",
     * "openid": "****",
     * "scope": "snsapi_userinfo"
     * }
     * @return null
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/20
     */
    public function apiUserInfo($oauthAccess)
    {
        $openid      = $oauthAccess['openid'];
        $accessToken = $oauthAccess['access_token'];
        //$scope       = $oauthAccess['scope'];
        $urlparam = array(
            'access_token=' . $accessToken,
            'openid=' . $openid,
        );
        //根据不同的授权类型运行不同的接口
        $apiUrl = "https://api.weixin.qq.com/sns/userinfo?";
        $apiUrl .= join("&", $urlparam);
        $json   = file_get_contents($apiUrl);
        if (stripos($json, "errcode") !== false) {
            return null;
        }
        return json_decode($json, true);
    }
    
    
}