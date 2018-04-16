<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Shopbase.php  Version 2017/7/26
// +----------------------------------------------------------------------
namespace app\crossbbcg\controller;

use app\common\controller\Home;
use think\Config;
use app\crossbbcg\service\Cart as Cartapi;
use app\member\service\Member;
use think\Cookie;
use think\Request;

class Shopbase extends Home
{
    /**
     * @Mark:商城初始化
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/26
     */
    public function _initialize()
    {
        parent::_initialize();
        
        //初始化时加载crossbbcg配置文件，方便后继模板中使用变量 by theseaer start 2017/7/7
        $Conf = APP_PATH . 'crossbbcg' . DS . 'extra' . DS . 'index.php';
        if (is_file($Conf)) Config::load($Conf);
        $this->assign('shopname', Config::get('shopname'));
        $this->assign('shoplogo', Config::get('shoplogo'));
    
        // 更新购物车，清理过时的数据
        $this->assign('cart_num', CartApi::countGood());
    
        /* 会员登录状态：永久登录 star */
        $cookie = Cookie::get('user_auth');
        $userInfo = Member::get_userinfo_by_token($cookie['token']);
        /*print_r(is_login());
        exit;*/
        
        $this->assign('user', $userInfo);
        /* 会员登录状态：永久登录 star */
        
        // 右侧导航栏二维码
        $weixin_img = get_config('crossbbcg','index')['weixin_attention_qrcode'];
        $this->assign('weixin_img',$weixin_img);
        // qq 客服
        $kefu_qq = get_config('crossbbcg','index')['kefu_qq'];
        $this->assign('kefu_qq',$kefu_qq);
    
        $this->assign('now_url',$this->request->url(true));
        $this->assign('now_url_false',$this->request->url());
        
        // 判断是否启用子域名
        $sub_domain_status = get_config('admin')['sub_domain_status'];
        $this->assign('sub_domain_status',$sub_domain_status);
    
        // 是否在首页
        if($this->request->path() == 'crossbbcg/'|| $this->request->path() == 'crossbbcg/index'||$this->request->path() =='crossbbcg'){
            $this->assign('is_home',true);
        }else{
            $this->assign('is_home',false);
        }
        
    }
    
    
}