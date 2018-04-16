<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | 首页控制器  Version 2016/12/25
// +----------------------------------------------------------------------
namespace app\crossbbcg\controller;

use app\crossbbcg\service\Goods as GoodsApi;
use app\member\model\MyPath as MyPathModel;
use app\crossbbcg\service\Cart as CartApi;

class Index extends Shopbase
{
    
    /**
     * @Mark:首页
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/1/22
     */
    public function index()
    {
        // 加载后台配置信息
        $this->assign('meta_title',config('index.shoptitle'));
        $this->assign('meta_keyword',config('index.shopkeywords'));
        $this->assign('meta_description',config('index.shopdescription'));
        return $this->fetch();
    }
    
    /**
     * @Mark: 我的足迹
     * @return mixed
     * @Author: WangHuaLong
     */
    public function ajaxfoot(){
        $arr_collect = [];
        if(is_login()) {
            //用户信息
            $uid = is_login();
            //收藏
            $collect = MyPathModel::all(function ($query) use ($uid) {
                $query->where(['uid' => $uid])->order('update_time', 'DESC')->limit(10);
            });
        
            if ($collect !== null) {
                foreach ($collect as $key => $arr) {
                    $arr_collect[$key]['goods']['id'] = $arr['goods']['id'];
                    $arr_collect[$key]['goods']['name'] = $arr['goods']['name'];
                    $arr_collect[$key]['goods']['thumb'] = $arr['goods']['thumb'];
                    $arr_collect[$key]['goods']['sale_price'] = GoodsApi::currencyFormat($arr['goods']['sale_price']);
                    $arr_collect[$key]['goods']['market_price'] = GoodsApi::currencyFormat($arr['goods']['market_price']);
                }
            }
        }
    
        $this->assign('collect', $arr_collect);
        return $this->fetch();
    }
    
    /**
     * @Mark: 获取商品收藏
     * @return mixed
     * @Author: WangHuaLong
     */
    public function ajaxfav(){
        $arr_collect = [];
        if(is_login()) {
            //用户信息
            $uid = is_login();
            //收藏
            $collect = \app\member\model\Collect::all(function ($query) use ($uid) {
                $query->where(['uid' => $uid])->order('id', 'DESC')->limit(10);
            });
            
            if ($collect !== null) {
                foreach ($collect as $key => $arr) {
                    $arr_collect[$key]['goods']['id'] = $arr['goods']['id'];
                    $arr_collect[$key]['goods']['name'] = $arr['goods']['name'];
                    $arr_collect[$key]['goods']['thumb'] = $arr['goods']['thumb'];
                    $arr_collect[$key]['goods']['sale_price'] = GoodsApi::currencyFormat($arr['goods']['sale_price']);
                    $arr_collect[$key]['goods']['market_price'] = GoodsApi::currencyFormat($arr['goods']['market_price']);
                }
            }
        }
        
        $this->assign('collect', $arr_collect);
        return $this->fetch();
    }
    
    /**
     * @Mark: 获取关注店铺
     * @return mixed
     * @Author: WangHuaLong
     */
    public function ajaxshops(){
        $arr_collect = [];
        if(is_login()) {
            //用户信息
            $uid = is_login();
            //收藏
            $collect = \app\seller\model\ShopAttention::all(function ($query) use ($uid) {
                $query->where(['uid' => $uid])->order('create_time', 'DESC')->limit(10);
            });
        
            
            if ($collect !== null) {
                foreach ($collect as $key => $arr) {
                    $arr_collect[$key]['store']['seller_id'] = $arr['store']['seller_id'];
                    $arr_collect[$key]['store']['seller_name'] = $arr['store']['seller_name'];
                    $arr_collect[$key]['store']['logo'] = $arr['store']['logo'];
                }
            }
            
            
        }
    
    
        $this->assign('collect', $arr_collect);
        
        return $this->fetch();
    }
    
    
    public function json_login(){
        // 获取转跳的url,默认跳转到会员中心,登陆成功后跳转
        $redirect_url = url('member/index/index');
        if (session('?redirect_url')) {
            $redirect_url = session('redirect_url');
        }
        
        // 用户登录请求
        $post_data = $this->request->post();
        // 极验证服务端验证
        //$vercode_type = config('kernel')['vercodeclass'];
        //$vercode = '\\vercode\\'.$vercode_type;
        //$check_data = [
        //    'user_id'   =>  is_login(),
        //    'client_type' => PLATFORM,
        //    'ip_address' => get_client_ip()
        //];
        //$res = $vercode::check($check_data);
        //if ($res['code'] == 0) return json($res);
        
        
        // 验证数据合法性
        if (empty($post_data['name'])) return json(['code' => 0, 'msg' => lang('Username error')]);
        if (empty($post_data['password'])) return json(['code' => 0, 'msg' => lang('Password error')]);
        $login_data = [
            'name' => $post_data['name'],
            'password' => $post_data['password'],
        ];
        //验证数据合理性
        $info = \app\member\service\Member::login($login_data);
        
        if (!$info) return json(['code' => 0, 'msg' => lang('Name or Password error')]);
        
        //登录成功后跳回来源地址
        session('redirect_url', null);
        // 更新购物车信息
        CartApi::updateCart();
       
        return json(['code' => 1, 'msg' => lang('Login success'), 'url' => $redirect_url]);
        
    }
}
