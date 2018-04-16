<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Oauth.php  Version 2017/9/20
// +----------------------------------------------------------------------
namespace app\common\libs;

abstract class Oauth extends Baseexted
{
    public $platform = '';    //平台
    
    /**
     * @Mark:获取回调URL地址
     * @return string
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/20
     */
    protected function getReturnUrl($platform = 'pc')
    {
        $this->platform = $platform;
        return Url::build('member/oauth/callback', ['class' => base64_encode(get_called_class()), 'platform' => $platform], true, true);
    }
    
    /**
     * @Mark:登录地址
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/20
     */
    abstract public function getLoginUrl();
    
    /**
     * @Mark:状态检查
     * @param $parms
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/20
     */
    abstract public function checkStatus($parms);
    
    /**
     * @Mark:获取访问TOKEN
     * @param $parms
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/20
     */
    abstract public function getAccessToken($parms);
    
    /**
     * @Mark:获取用户信息
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/20
     */
    abstract public function getUserInfo();
}