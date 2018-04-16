<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Taobao.php  Version 2017/9/20
// +----------------------------------------------------------------------
namespace oauths;

use app\common\libs\Oauth;

class Taobao extends Oauth
{
    private $apiKey = '';
    private $apiSecret = '';
    
    public function __construct($config)
    {
        //获取配置参数
        $info   = self::setup();
        $where  = ['code' => $info['code'], 'subjection' => $info['subjection']];
        $config = self::config($where);
        
        $this->apiKey    = isset($config['appKey']) ? $config['appKey'] : "";
        $this->apiSecret = isset($config['appSecret']) ? $config['appSecret'] : "";
    }
    
    /**
     * @Mark:扩展、插件配置说明
     * @return array
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/11
     */
    static public function setup()
    {
        return array(
            'subjection'  => 'oauths',    //隶属
            'code'        => 'Taobao',     // 扩展器名称名
            'name'        => lang('Taobao_oauth'), // 扩展器名称翻译名
            'description' => lang('Taobao_oauth_desc'), // 扩展器名称翻译描述
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
                'logo'        => 'taobao.png',
                'appofficial' => 'https://www.taobao.com/',         //官方
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
        $url = 'https://oauth.taobao.com/authorize?response_type=code';
        $url .= '&client_id=' . $this->apiKey;
        $url .= '&redirect_uri=' . urlencode(parent::getReturnUrl());
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
        if (isset($parms['error'])) {
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
        $url           = 'https://oauth.taobao.com/token';
        $urlParmsArray = array(
            'grant_type'    => 'authorization_code',
            'code'          => $parms['code'],
            'redirect_uri'  => urlencode(parent::getReturnUrl()),
            'client_id'     => $this->apiKey,
            'client_secret' => $this->apiSecret,
        );
        
        //模拟post提交
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($urlParmsArray));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $tokenInfo = json_decode(curl_exec($ch), true);
        
        if (!isset($tokenInfo['access_token'])) {
            die(var_export($tokenInfo));
        }
        \think\Session::set('taobao_user_nick', urldecode($tokenInfo['taobao_user_nick']));
        \think\Session::set('taobao_user_id', $tokenInfo['taobao_user_id']);
    }
    
    /**
     * @Mark:获取用户信息
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/20
     */
    public function getUserInfo()
    {
        $userInfo         = array();
        $userInfo['id']   = \think\Session::get('taobao_user_id');
        $userInfo['name'] = \think\Session::get('taobao_user_nick');
        $userInfo['sex']  = 1;
        return $userInfo;
    }
}