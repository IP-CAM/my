<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Common.php  Version 2017/7/19
// +----------------------------------------------------------------------

namespace app\seller\widget;

use think\Controller;


class Common extends Controller
{
    /**
     * @Mark:注册协议
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/19
     */
    public function register_protocol()
    {
        $protocol = APP_PATH . 'seller/extra/protocol.php';
        if (is_file($protocol)) {
            $protocol = include $protocol;
            $content = $protocol['content'];
        } else {
            $content = '';
        }
        $this->assign('register_protocol',$content);
        return $this->fetch('login/register_protocol');
    }
    
    /**
     * @Mark:店铺首页导航
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/20
     */
    public function head_bar()
    {
        // 更新购物车，清理过时的数据
        $this->assign('cart_num',CartApi::countGood());
        $this->assign('shopname', config('index.shopname'));
        $this->assign('shoplogo', config('index.shoplogo'));
        
        return $this->fetch('common/head_bar');
    }
    
    /**
     * @Mark:店铺首页顶部
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/20
     */
    public function head_top()
    {
        // 更新购物车，清理过时的数据
        $this->assign('cart_num',CartApi::countGood());
        $this->assign('shopname', config('index.shopname'));
        $this->assign('shoplogo', config('index.shoplogo'));
        return $this->fetch('common/head_top');
    }
}
