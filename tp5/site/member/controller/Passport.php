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
// | Passport.php  Version 2017/2/23
// +----------------------------------------------------------------------
namespace app\member\controller;

use app\member\model\Account;
use think\Cookie;
use think\Cache;
use think\Session;
use app\member\service\History;
use app\admin\model\Message;
use common\PhpMailer;
use app\crossbbcg\service\Cart as CartApi;

class Passport extends Memberbase
{
    /**
     * @Mark:登录页，已登陆则跳转
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/2/23
     */
    public function index()
    {
        
        // 获取转跳的url,默认跳转到会员中心,登陆成功后跳转
        $redirect_url = url('member/index/index');
        if (session('?redirect_url')) {
            $redirect_url = session('redirect_url');
        }
        
        if(is_login()){
            session('redirect_url',null);
            $this->redirect($redirect_url);
        }
        
        // 用户登录请求
        if ($this->request->isAjax()) {
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
        
        return $this->fetch();
    }
    
    /**
     * @Mark:手机端登录页
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/10/16
     */
    public function login()
    {
        return $this->fetch();
    }
    
    
    /**
     * @Mark:弹出层登录
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/8/3
     */
    public function minLogin()
    {
        return $this->fetch('minLogin');
    }
    
    /**
     * @Mark:检查手机号码是否存在
     * @Author:fancs
     * @Version 2017/7/11
     */
    public function check_mobile()
    {
        $data = $this->request->param();
        
        $res = \app\member\service\Member::check_mobile($data['username']);
        //场景
        if ($data['scene'] == 'login') {//登录
            if (!$res) return $this->error(lang('Can`t find account'));
            return $this->success();
        }
        if ($data['scene'] == 'reg') {//注册
            if ($res) return $this->error(lang('Mobile used'));
            return $this->success();
        }
    }
    
    /**
     * @Mark:登陆页面极验证
     * @return \think\response\Json
     * @Author: fancs
     * @Version 2017/7/6
     */
    public function gt_login()
    {
        $vercode_type = config('kernel')['vercodeclass'];
        $vercode = '\\vercode\\'.$vercode_type;
        $check_data = [
            'user_id'   =>  is_login(),
            'client_type' => PLATFORM,
            'ip_address' => get_client_ip()
        ];
        $res = $vercode::create($check_data);
        echo $res;
    }
    
    /**
     * @Mark:极验证二次验证
     * @Author: yang <502204678@qq.com>
     * @Version 2017/8/23
     */
    //public function gt_check_again()
    //{
    //    $data = Request::instance()->post();
    //    if (!isset($data['geetest_challenge']) && !isset($data['geetest_validate']) && !isset($data['geetest_seccode'])) return json(['code'=>0,'msg'=>lang('param_error')]);
    //    $res = \vercode\Geetest::check($data);
    //    return json($res);
    //}
    
    /***
     * @Mark:注册
     * @return \think\response\Json
     * @Author: fancs
     * @Version 2017/7/12
     */
    public function register()
    {
        $reg = $this->request->post();
        
        // 极验证服务端验证
        $vercode_type = config('kernel')['vercodeclass'];
        $vercode = '\\vercode\\'.$vercode_type;
        $check_data = [
            'user_id'   =>  is_login(),
            "client_type" => PLATFORM,
            "ip_address" => get_client_ip()
        ];
        $res = $vercode::check($check_data);
        if ($res['code'] == 0) return json($res);
        
        //验证短信验证码
        if (\think\Cache::has($reg['username'])) {
            if (\think\Cache::get($reg['username']) != $reg['smscode']) {
                $this->error(lang('mobile_code_error'));
            }
        } else {
            $this->error(lang('mobile_code_error'));
        }
        
        //验证重复密码是否相同
        if ($reg['password'] !== $reg['repassword']) return json(['code' => 0, 'msg' => lang('password_error')]);
        $data = [
            'name' => $reg['username'],
            'password' => $reg['password'],
        ];
        //注册
        $res = \app\member\service\Member::register($data);

        if ($res['code'] == 1) {
            
            $update = array(
                'last_login_time'   => time(),
                'last_login_ip'     => get_client_ip(0),
                'login'             => 1,
            );
            \app\member\model\Account::update($update, ['id' => $res['data']]);
            //更新用户token
            $token = md5(uniqid(mt_rand(1111, 9999), true));
            \app\member\model\Member::update(['id' => $res['data'], 'token' => $token]);
            //设置用户浏览记录cookie
            $config = get_config('admin', 'index');
            if (!Cookie::get('history')) {
                $history = History::get_history($res['data']);
                if ($history) Cookie::set('history', json_encode($history), ['expire' => $config['cookieexpire']]);
            }
            //组装返回登录信息
            $return = [
                'uid' => $res['data'],
                'name' => $data['name'],
                'last_login_time' => time(),
            ];
            //设置登陆信息
    
            Session::set('user_auth', $return);
            Session::set('user_auth_sign', data_auth_sign($return));
            $cookie = [
                'nickname'  => $data['name'],
                'token'     => \app\member\model\Member::where('id', $res['data'])->value('token'),
            ];
            Cookie::set('user_auth', $cookie, ['expire' => (int)$config['cookieexpire']]);
            return json(['code' => 1, 'msg' => lang('Register success'),'url'=>url('member/index/index')]);
        }
        return json($res);
    }
    
    /**
     * @Mark:获取短信验证码
     * @Author: fancs
     * @Version 2017/7/12
     */
    public function sendcode()
    {
        $mobile = $this->request->param('username');
        
        if (!$mobile)  $this->error(lang('Mobile_empty'));
        
        //配置
        //$code = rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9);
        //$data = [
        //    'mobile' => $mobile,
        //    'type'=>'sms',
        //    'tpl'=>'account-signup',
        //    'var'=>[
        //        'vcode'=>$code,
        //        'time'=>36000
        //    ],
        //    'content' => ['code'=>$code,'product'=>'润土科技']
        //];
        //
        //$this->sendMsg($data);
        
        
        $config = get_config('admin', 'index')['smsclass'];
        $smsClass = "\\sms\\$config";
        $code = rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9);
        $data = ['tel' => $mobile, 'content' => ['code'=>$code,'product'=>'润土科技']];
        $res = $smsClass::send($data['tel'],$data['content']);
        if ($res['code'] == 1) {
            //设置验证码缓存10分钟有效，缓存键名是
            \think\Cache::set($mobile,$code);
            $this->success(lang('success'));
        } else {
            $this->error(lang('fail'));
        }
        
    }
    
    /**
     * @Mark:发送邮箱验证码
     * @Author: fancs
     * @Version 2017/7/14
     */
    public function get_email_code()
    {
        $to = $this->request->param('username');
        if (empty($to)) {
            $this->error(lang('Email_null'));
        }
        //邮箱模板
        $tpl = Message::get(function ($query) {
            $query->where(['msgid' => 'deposit-lostPw', 'type' => 'email']);
        });
        $code = generate_code();
        $text = str_replace('$vcode$', $code, $tpl['msgtpl']);
        $text = str_replace('$username$', Cookie::get('user_auth')['nickname'], $text);
        $data = [
            'to_email'      =>  $to,
            'content'       =>  $text
        ];
        $res = PhpMailer::send($data);
        if ($res['code'] == 1) {
            //缓存验证码
            Cache::set('verifyEmail_'.$to, md5($code), 36000);
            $this->success('OK');
        } else {
            return json($res);
        }
    }
    
    public function signup()
    {
        $this->assign('Title', lang('Passport index'));
        return $this->fetch();
    }
    
    /**
     * @Mark:找回密码1
     * @return mixed|\think\response\Json
     * @Author: fancs
     * @Version 2017/7/13
     */
    public function findpwd()
    {
        if ($this->request->isAjax()) {
            $mobile = $this->request->param('username');
            $type = \app\member\service\Member::checkLoginNameType($mobile);
            if ($type == 'email') {
                $type = 'email';
            } else {
                $type = 'mobile';
            }
            $res = Account::get([$type=>$mobile]);
            if (!$res) return ['code'=>0,'msg'=>lang('account_not_exist')];
            return json(['code' => 1,'url'=>url('findpwdTwo',['username'=>$mobile])]);
        } else {
            $this->assign('mata_title',lang('forget_password'));
            return $this->fetch();
        }
        
    }
    
    /**
     * @Mark:找回密码2
     * @return mixed|\think\response\Json
     * @Author: fancs
     * @Version 2017/7/13
     */
    public function findpwdTwo()
    {
        $data = $this->request->param();
        if (!isset($data['username'])) {
            return json(['code' => 0, 'msg' => lang('Mobile null')]);
        }
        $type = \app\member\service\Member::checkLoginNameType($data['username']);
        if ($type == 'email') {
            $type = 'email';
            $check_type = 'verifyEmail_';
        } else {
            $type = 'mobile';
            $check_type = '';
        }
        $res = Account::get([$type=>$data['username']]);
        if (!$res) return ['code'=>0,'msg'=>lang('account_not_exist')];
        //ajax 提交验证码
        if ($this->request->isAjax()) {
            $cookies_check = trim($check_type.$data['username']);
            if ($type == 'email') {
                if (\think\Cache::has($cookies_check)) {
                    if (\think\Cache::get($cookies_check) != md5($data['code'])) {
                        $this->error(lang('captcha_error'));
                    }
                } else {
                    $this->error(lang('captcha_error'));
                }
            } else {
                if (\think\Cache::has($cookies_check)) {
                    if (\think\Cache::get($cookies_check) != $data['code']) {
                        $this->error(lang('captcha_error'));
                    }
                } else {
                    $this->error(lang('captcha_error'));
                }
            }
            return json(['code' => 1,'url'=>url('findpwdThree',['username'=>$data['username']])]);
        }
        $this->assign('type',$type);
        $this->assign('username', $data['username']);
        $this->assign('mata_title',lang('forget_password'));
        return $this->fetch('findpwdTwo');
    }
    
    /**
     * @Mark:找回密码3
     * @return mixed|\think\response\Json
     * @Author: fancs
     * @Version 2017/7/13
     */
    public function findpwdThree()
    {
        $data = $this->request->param();
        //ajax提交数据
        if ($this->request->isAjax()) {
            //更改密码
            if (!($data['password'] && $data['repassword'] && $data['username'])) {
                return json(['code' => 0, 'msg' => lang('Data incomplete')]);
            }
            if ($data['password'] !== $data['repassword']) return json(['code' => 0, 'msg' => lang('password_not_same')]);
            $param = [
                'name' => $data['username'],
                'password' => $data['password'],
            ];
            $res = \app\member\service\Member::resetPwd($param);
            if ($res === true) {
                return json(['code' => 1, 'msg' => lang('Change ok'),'url'=>url('index')]);
            } else {
                return $res;
            }
        } else {
            if (!isset($data['username']) || !$data['username']) {
                return json(['code' => 0, 'msg' => lang('Mobile null')]);
            }
            $this->assign('username', $data['username']);
            $this->assign('mata_title',lang('forget_password'));
            return $this->fetch('findpwdThree');
        }
    }
    
    /**
     * @Mark:退出登录
     * @Author: fancs
     * @Version 2017/7/
     */
    public function logout()
    {
        self::history_db();
        Session::delete('user_auth');
        Session::delete('user_auth_sign');
        Cookie::delete('history');
        Cookie::delete('user_auth');
       
        // 更新购物车信息
        CartApi::updateCart();
        $this->redirect(url('member/passport/index'));
    }
    
    /**
     * @Mark:用户浏览记录cookie入库
     * @Author: fancs
     * @Version 2017/7/14
     */
    protected static function history_db()
    {
        //用户浏览记录更新入库
        if (Cookie::has('history') && Cookie::has('user_auth')) {
            $uid = check_login();
            if ($uid) {
                $history = Cookie::get('history');
                $param = ['uid' => $uid, 'history_cookie' => $history];
                $res = History::add_history($param);
            }
        }
    }
    
    /**
     * @Mark:扫码登录
     * @return array
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/2/23
     */
    public function scancode()
    {
        return [];
    }
    
}