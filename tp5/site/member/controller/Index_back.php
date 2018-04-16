<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Fancs
// +----------------------------------------------------------------------
// | Index  Version 1.0  2017/6/22
// +----------------------------------------------------------------------
namespace app\member\controller;


use app\common\controller\Home;
use app\member\model\Account;
use app\member\model\Smscode;
use app\member\service\Member;
use sms\Alidayu;
use sms\Yumpian;
use think\Cookie;
use think\Session;
use vercode\Geetest;

class Index extends Home
{
    
    /**
     * @Mark:会员中心首页
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/12/23
     */
    public function index()
    {
        return $this->fetch();
    }
    
    /**
     * @Mark:登录
     * @return \think\response\Json
     * @Author: fancs
     * @Version 2017/6/23
     */
    public function login()
    {
        $name =  $this->request->has('name') ? $this->request->param('name') : '';
        $pwd  =  $this->request->has('password') ? $this->request->param('password') : '';
        //验证数据合法性
        if(empty($name)) return json(['code'=>0,'msg'=>lang('Username error')]);
        if(empty($pwd)) return json(['code'=>0,'msg'=>lang('Password error')]);
        $data=[
            'name'     => $name,
            'password' => $pwd,
        ];
        //验证数据合理性
        $info = Member::login($data);
        if(!$info) return json(['code'=>0,'msg'=>lang('Name or Password error')]);
        return json(['code'=>1,'msg'=>lang('Login success')]);
    }
    
    /**
     * @Mark:登陆页面极验证
     * @return \think\response\Json
     * @Author: fancs
     * @Version 2017/7/4
     */
    public function gt_login()
    {
        //获取配置项
        $Conf = realpath(APP_PATH) . DS . 'admin' . DS . 'extra'. DS . 'index.php';
        $data = is_file(realpath($Conf)) ? include realpath($Conf) : null;
        //开关
        if(!$data['vercode']){
            return false;
        }
        if(empty($data['vcodeid']) || empty($data['vcodekeys'])){
            return false;
        }
        $gtClass = new Geetest($data['vcodeid'],$data['vcodekeys']);
        $status = $gtClass->create();
        $res = $gtClass->get_response_str();
        return json($res);
    }
    /**
     * @Mark:退出登录
     * @Author: fancs
     * @Version 2017/6/26.
     */
    public function logout()
    {
        Session::clear('user_info');
        Cookie::delete('history');
        $this->redirect('index');
    }
    /**
     * @Mark:注册页面极验证
     * @return \think\response\Json
     * @Author: fancs
     * @Version 2017/7/4
     */
    public function gt_register()
    {
        //获取配置项
        $Conf = realpath(APP_PATH) . DS . 'member' . DS . 'extra'. DS . 'index.php';
        $data = is_file(realpath($Conf)) ? include realpath($Conf) : null;
        //开关
        if(!$data['regstatus']){
            return false;
        }
        if(empty($data['vcodeid']) || empty($data['vcodekeys'])){
            return false;
        }
        $gtClass = new Geetest($data['vcodeid'],$data['vcodekeys']);
        $status = $gtClass->create();
        $res = $gtClass->get_response_str();
        return json($res);
    }
    
    /**
     * @Mark:登陆页面
     * @return mixed
     * @Author: fancs
     * @Version 2017/7/4
     */
    public function register_mobile()
    {
        return $this->fetch();
    }
    
    /**
     * @Mark:阿里大于短信
     * @return \think\response\Json
     * @Author: fancs
     * @Version 2017/7/5
     */
    public function alidayu()
    {
        $class = new Alidayu();
        $code = generate_code();
        $data  = [
            'param'=>['username'=>'fancs','vcode'=>$code],
            'mobile'=>18573538575,
            'template'=>'SMS_75835052',
        ];
        $res   = $class->send($data);
    
        //短信入库
        $param = [
            'mobile' => $data['mobile'],
            'code'   => $code,
            'status' => (int)$res->isSuccess(),
            'scene'  => lang('Mobile'),
        ];
        Smscode::create($param);
        return json(['code'=>0,'msg'=>$res]);
    }
    
    /**
     * @Mark:云片短信
     * @return \think\response\Json
     * @Author: fancs
     * @Version 2017/7/5
     */
    public function yunpian()
    {
        $class = new Yumpian();
        $code = generate_code();
        
        $data = [
            'mobile'=>18573538520,
            'text'  =>"【润土信息】您的验证码是{$code}。如非本人操作，请忽略本短信"
        ];
        $res   = $class->send($data);
        
        //短信入库
        $param = [
            'mobile' => $data['mobile'],
            'code'   => $code,
            'status' => (int)$res->isSuccess(),
            'scene'  => lang('Mobile'),
        ];
        Smscode::create($param);
        if($res->isSuccess()){
            return json(['code'=>1,'msg'=>lang('Send success')]);
        }
        return json(['code'=>0,'msg'=>$res->getData()]);
       
    }
    /***
     * @Mark:注册
     * @return \think\response\Json
     * @Author: fancs
     * @Version 2017/6/23
     */
    public function register()
    {
        $name =  $this->request->has('name') ? $this->request->param('name') : '';
        $pwd  =  $this->request->has('password') ? $this->request->param('password') : '';
        $repwd=  $this->request->has('repassword') ? $this->request->param('repassword') : '';
        $mobile=  $this->request->has('mobile') ? $this->request->param('mobile') : '';
        $vcode=  $this->request->has('vcode') ? $this->request->param('vcode') : '';
        $nickname=  $this->request->has('nickname') ? $this->request->param('nickname') : '';
        if(empty($name)||empty($pwd)||empty($repwd)||empty($nickname)||empty($vcode)){
            return json(['code'=>0,'msg'=>lang('Register data incomplete')]);
        }
        //验证短信验证码
        $code = \app\member\service\Smscode::get_code($mobile);
        if($code != $vcode){
            return json(['code'=>0,'msg'=>lang('SMS verification code error')]);
        }
        //验证重复密码是否相同
        if($pwd !== $repwd) return json(['code'=>0,'msg'=>lang('Password and repassword is disaffinity')]);
        $data = [
            'name'    =>    $name,
            'password'=>    $pwd,
            'ip'      =>    get_client_ip(),
        ];
        //注册
        $res = Member::register($data);
        if(is_int($res)) return json(['code'=>1,'msg'=>lang('Register success')]);
        return $res;
    }
  
    /**
     * @Mark:忘记密码
     * @return mixed|\think\response\Json
     * @Author: fancs
     * @Version 2017/6/23
     */
    public function forgot()
    {
        if($this->request->isAjax()){
            $name =  $this->request->has('name') ? $this->request->param('name') : '';
            if(empty($name)){
                return json(['code'=>0,'msg'=>lang('Name is null')]);
            }
            $data = ['name'=>$name];
            $res = Member::getUserInfo($data);
            if($res === false) return json(['code'=>0,'msg'=>lang('Name is exit')]);
            return json(['code'=>1,'id'=>$res['idcard']]);
        }else{
    
            return $this->fetch();
        }
    }
    
    /**
     * @Mark:身份验证
     * @return mixed|\think\response\Json
     * @Author: fancs
     * @Version 2017/6/23
     */
    public function forgot_autonym()
    {
       
        if($this->request->isAjax()){
            $mobile =  $this->request->has('mobile') ? $this->request->param('mobile') : '';
            $sfz    =  $this->request->has('sfz') ? $this->request->param('sfz') : '';
            $idcard =  $this->request->has('idcard') ? $this->request->param('idcard') : 0;
            //验证数据合法性
            if(empty($mobile) || empty($sfz)){
                return json(['code'=>0,'msg'=>lang('Data incomplete')]);
            }
            if(!preg_match("/^1[34578]{1}[0-9]{9}$/", $mobile)){
                return json(['code'=>0,'msg'=>lang('Mobile error')]);
            }
            if(!preg_match("/^(\d{15}$|^\d{18}$|^\d{17}(\d|X|x))$/",$sfz)){
                return json(['code'=>0,'msg'=>lang('Idcard error')]);
            }
            //验证数据合理性
            $info = Account::get(['idcard'=>$idcard]);
            if($info['mobile'] != $mobile) return json(['code'=>0,'msg'=>lang('Mobile discrepancy')]);
            $extent = \app\member\model\Member::get($info['id']);
            if($extent['sfz'] != $sfz)  return json(['code'=>0,'msg'=>lang('Idcard discrepancy')]);
            return json(['code'=>1,'id'=>$idcard]);
        }else{
            $idcard =  $this->request->has('id') ? $this->request->param('id') : 0;
            $this->assign('id',$idcard);
            return $this->fetch();
        }
    }
    
    /**
     * @Mark:重置密码
     * @return mixed|\think\response\Json
     * @Author: fancs
     * @Version 2017/6/23
     */
    public function reset_pwd()
    {
        if($this->request->isAjax()){
            $password     =  $this->request->has('password') ? $this->request->param('password') : '';
            $repassword   =  $this->request->has('repassword') ? $this->request->param('repassword') : '';
            $idcard =  $this->request->has('idcard') ? $this->request->param('idcard') : 0;
            //验证数据合法性
            if(empty($password) || empty($repassword)){
                return json(['code'=>0,'msg'=>lang('Data incomplete')]);
            }
            if ($password !== $repassword) return json(['code'=>0,'msg'=>lang('Password and repassword is disaffinity')]);
            //更新密码
            $info = Account::get(['idcard'=>$idcard]);
            $data = [
                'id'     => $info['id'],
                'password'=>md5($password),
            ];
            $res = Account::update($data);
            if($res) return json(['code'=>0,'msg'=>lang('Reset password success')]);
            return json(['code'=>0,'msg'=>lang('Reset password error')]);
        }else{
            $idcard =  $this->request->has('id') ? $this->request->param('id') : 0;
            $this->assign('id',$idcard);
            return $this->fetch();
        }
    }
    
    
    /**
     * @Mark:空方法时执行
     * @param $name
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/12/23
     */
    /*public function _empty($name){
        return $name;
    }*/
}