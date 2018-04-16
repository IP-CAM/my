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
// | 认证器  Version 1.0  2017/1/22
// +----------------------------------------------------------------------
namespace app\admin\controller;

use think\Cookie;
use think\Loader;
use think\Request;
use think\Db;
use app\common\controller\Base;
use app\admin\service\Manager as ManagerApi;
use think\Session;

class Passport extends Base
{
    
    /**
     * @Mark:登录
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/8/8
     */
    public function login()
    {
        $error_num = Session::get('admin_login_error');
        if ($this->request->isAjax()) {
            $param = $this->request->param();
            if ($error_num > 3) {
                //极验证二次验证
                $vercode_type   = config('kernel')['vercodeclass'];
                $vercode        = '\\vercode\\' . $vercode_type;
                $check_data = [
                    'user_id'       => is_sign(),
                    'client_type'   => 'pc',
                    'ip_address'    => get_client_ip()
                ];
                $res = $vercode::check($check_data);
                if ($res['code'] == 0) return json($res);
            }
            //登录验证
            $res = ManagerApi::login($param);
            if (!$res['code']) {
                $res['verify'] = false;
                //保存错误次数,若大于3次前台调出验证码
                if ($error_num) {
                    if ($error_num >= 3) {
                        Session::set('admin_login_error',$error_num+1);
                        $res['verify'] = true;
                    } else {
                        Session::set('admin_login_error',$error_num+1);
                    }
                } else {
                    Session::set('admin_login_error',1);
                }
                return json($res);
            }
            Session::delete('admin_login_error');
            $this->success(lang('admin_login_success'), url('/admin/index/index'));
        }
        
        if ($this->is_login()) {
            $this->redirect('/admin/index/index');
        } else {
            if ($error_num >=3){
                $this->assign('verify',1);
            } else {
                $this->assign('verify',0);
            }
            return $this->fetch();
        }
    }
    
    /**
     * @Mark:退出登录
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/8/8
     */
    public function logout()
    {
        if ($this->is_login()) {
            Session::delete('admin_auth');
            Session::delete('admin_auth_sign');
            Cookie::delete('admin_auth');
            $this->success('退出成功！', url('login'));
        } else {
            $this->success('退出成功！', url('login'));
        }
    }
    
    /**
     * @Mark:是否登录
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/8/8
     */
    public function is_login()
    {
        if (is_sign()) {
            return true;
        }
        return false;
    }
    
    /**
     * @Mark:转向登录
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/1/1
     */
    public function index()
    {
        $this->redirect("/admin/index/index");
    }
    
    /**
     * @Mark:获取极验证信息
     * @Author: yang <502204678@qq.com>
     * @Version 2017/9/8
     */
    public function gt()
    {
        $vercode_type = config('kernel')['vercodeclass'];
        $vercode = '\\vercode\\' . $vercode_type;
        $check_data = [
            'user_id' => is_sign(),
            'client_type' => 'pc',
            'ip_address' => get_client_ip()
        ];
        $res = $vercode::create($check_data);
        echo $res;
    }
    
    /**
     * @Mark:创建快捷方式
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/9
     */
    public function shortcuts()
    {
        $furl = \think\Url::build('login', [], true, true);
        $content = "[InternetShortcut]
URL=".$furl."
IDList=[{000214A0-0000-0000-C000-000000000046}]
Prop3=19,2";
        
        $filename = lang('Cmfname');
        $encoded_filename = urlencode($filename);
        $encoded_filename = str_replace("+", "%20", $encoded_filename);
        
        if (preg_match("/MSIE/", $_SERVER['HTTP_USER_AGENT']) )
        {
            header('Content-Disposition:  attachment; filename=' . $encoded_filename . '.url;');
        }
        elseif (preg_match("/Firefox/", $_SERVER['HTTP_USER_AGENT']))
        {
            header('Content-Disposition: attachment; filename*=utf8' .  $filename . '.url;');
        }
        else
        {
            header('Content-Disposition: attachment; filename=' .  $filename . '.url;');
        }
        /** end **/
        
        echo $content;
    }
    
}
