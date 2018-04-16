<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Login.php  Version 2017/6/12
// +----------------------------------------------------------------------

namespace app\seller\controller;

use app\seller\service\Account;
use think\Db;
use think\Request;
use \think\Session;
use app\seller\model\Account as AccountModel;
use app\seller\service\Account as AccountApi;
use app\seller\model\Store as StoreModel;
use app\seller\service\Seller as StoreApi;
use app\seller\model\Shopcat as ShopcatModel;
use app\admin\model\Message;
use common\PhpMailer;
use think\Cache;
use think\Config;
use app\crossbbcg\model\Category as CategoryModel;
use app\crossbbcg\service\Goods as GoodsApi;

class Login extends Common
{
    public function index()
    {
        $error_num = Session::get('seller_login_error');
        if ($error_num >=3){
            $this->assign('verify',1);
        } else {
            $this->assign('verify',0);
        }
        return $this->fetch('index');
    }
    
    /**
     * @Mark:商户登陆
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/14
     */
    public function login()
    {
        $data = $this->request->post();
        $error_num = Session::get('seller_login_error');
        if ($error_num > 3) {
            //二次验证
            $vercode_type = config('kernel')['vercodeclass'];
            $vercode = '\\vercode\\'.$vercode_type;
            $check_data = [
                'user_id'   =>  is_login(),
                "client_type" => PLATFORM,
                "ip_address" => get_client_ip()
            ];
            $res = $vercode::check($check_data);
            if ($res['code'] == 0) return json($res);
        }
        
        $re = Account::login($data);
        if (!isset($re['code'])) {
            //判断是否是子账户
            if ($re['pid']) {
                session::set('sellerId', $re['pid']);
            } else {
                session::set('sellerId', $re['id']);
            }
            $seller_info = StoreModel::get(['seller_id' => Session::get('sellerId')]);
            if ($seller_info) session::set('shop_id', $seller_info['id']);
            session::set('userid', $re['id']);
            session::set('sellername', $re['nickname']);
            session::set('last_login_time', $re['last_login_time']);
            session::set('last_login_ip', $re['last_login_ip']);
            session::set('role', $re['role_id']);
            session::set('langid', $re['langid']);
            $log_info = '账户登录。账户名是：'.$re['nickname'];
            seller_log(Session::get('sellerId'),$re['id'],$log_info);
            Session::delete('seller_login_error');
            $this->success(lang('signin_success'),'seller/index/index');
        } else {
            $re['verify'] = false;
            //保存错误次数,若大于3次前台调出验证码
            if ($error_num) {
                if ($error_num >= 3) {
                    Session::set('seller_login_error',$error_num+1);
                    $re['verify'] = true;
                } else {
                    Session::set('seller_login_error',$error_num+1);
                }
            } else {
                Session::set('seller_login_error',1);
            }
            return $re;
        }
    }
    
    /**
     * @Mark:注销登陆
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/14
     */
    public function logout()
    {
        session::delete('sellerId');
        session::delete('sellername');
        session::delete('last_login_ip');
        session::delete('last_login_time');
        session::delete('langid');
        session::delete('role');
        session::delete('userid');
        return $this->index();
    }
    
    /**
     * @Mark:注册
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/19
     */
    public function reg()
    {
        //仓库列表
        $warehouse = \app\bcwareexp\model\Crossware::column('name', 'code');
        $this->assign('warehouse', $warehouse);
        return $this->fetch('signup');
    }
    
    /**
     * @Mark:注册信息入库
     * @return bool|string
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/19
     */
    public function save()
    {
        $data = $this->request->param();
        //二次验证
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
        if (Cache::get($data['mobile']) != $data['mobile_captcha']) $this->error(lang('captcha_error'));
        
        if ($data['password'] !== $data['repassword']) $this->error(lang('pwd_not_equal'));
        unset($data['repassword']);
        unset($data['geetest_challenge']);
        unset($data['geetest_validate']);
        unset($data['geetest_seccode']);
        unset($data['mobile_captcha']);
        $re = Account::addSeller($data);
        if ($re['code'] == 1) {
            $this->success(lang('Reg_ok'), 'seller/login/index');
        } else {
            return json($re);
        }
    }
    
    /**
     * @Mark:忘记密码--用户名验证
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/29
     */
    public function forget_pwd()
    {
        if ($this->request->isPost()) {
            $username = $this->request->param();
            $re = AccountModel::where(['nickname'=>$username])->find();
            if (!$re) {
                return ['status'=>'n','info'=>lang('member_not_exist')];
            } else {
                return ['status' => 'y', 'info' => lang('check_ok')];
            }
        } else {
            return $this->fetch();
        }
        
    }
    
    /**
     * @Mark:忘记密码--验证手机或邮箱
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/19
     */
    public function forget_pwd_two()
    {
        $param = $this->request->param();
        //异步验证邮箱或者手机验证码
        if (isset($param['uid']) && !empty($param['uid'])) {
            $re = AccountModel::get($param['uid']);
            if ($param['name'] == 'code') {
                //验证手机验证码
                $params = array('mobile'=>$re['mobile'],'code'=>$param['param']);
                $res = \app\member\service\Smscode::get_code($params);
                if ($res != $param['param']) return json(['status'=>'n','info'=>lang('captcha_error')]);
            } else {
                if ($param['param'] != Cache::get($re['email'])) return json(['status'=>'n','info'=>lang('captcha_error')]);
            }
            return json(['status'=>'y','info'=>lang('check_ok')]);
        }
        //验证用户名是否存在
        if (!isset($param['username'])) return json(['code'=>0,'msg'=>lang('member_not_exist')]);
        $re = AccountModel::where(['nickname'=>$param['username']])->find();
        if ($re) {
            $this->assign('data',$re);
        } else {
            $this->error(lang('member_not_exist'));
        }
        return $this->fetch();
    }
    
    /**
     * @Mark:忘记密码--设置新密码
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/8/1
     */
    public function forget_pwd_three()
    {
        $data = $this->request->param();
        if ($this->request->isAjax()) {
            if (!isset($data['userpassword']) || !$data['userpassword']) $this->error(lang('param_error'));
            $salt = generate_prefix(4);
            $newpassword = md5(md5($data['userpassword']).$salt);
            AccountModel::update(['id'=>$data['id'],'password'=>$newpassword,'salt'=>$salt]);
            $this->success(lang('success'),'seller/login/index');
        }
        $userinfo = AccountModel::get($data['uid']);
        //验证邮箱或者手机号
        if (isset($data['email_captcha'])) {
            //验证邮箱验证码
            if ($data['email_captcha'] != Cache::get($userinfo['email'])) $this->error(lang('captcha_error'));
        } else {
            //验证手机验证码
            if (Cache::get($userinfo['mobile']) != $data['code']) $this->error(lang('captcha_error'));
        }
        $this->assign('data',$userinfo);
        return $this->fetch();
    }
    
    /**
     * @Mark:发送邮件
     * @Author: yang <502204678@qq.com>
     * @Version 2017/8/1
     */
    public function send_email(){
        $to_email = $this->request->post('post.email');
        //邮箱模板
        $tpl = Message::get(function ($query) {
            $query->where(['msgid' => 'deposit-lostPw', 'type' => 'email']);
        });
        $code = generate_code();
        $text = str_replace('$code$', $code, $tpl['msgtpl']);
        $data = [
            'to_email'      =>  $to_email,
            'content'       =>  $text
        ];
        $res = PhpMailer::send($data);
        if ($res['code'] == 1) {
            //缓存验证码
            Cache::set($to_email, $code, 36000);
            $this->success('OK');
        } else {
            return json($res);
        }
    }
    
    /**
     * @Mark:发送短信
     * @Author: yang <502204678@qq.com>
     * @Version 2017/8/24
     */
    public function sendsms()
    {
        $mobile = $this->request->param('username');
    
        if (!$mobile)  $this->error(lang('Mobile_empty'));
    
        //配置
        $config = get_config('admin', 'index')['smsclass'];
        $smsClass = "\\sms\\$config";
        $code = generate_code();
        $data = ['tel' => $mobile, 'content' => ['code'=>$code,'product'=>'润土科技']];
        $res = $smsClass::send($data['tel'],$data['content']);
        if ($res['code'] == 1) {
            //设置验证码缓存10分钟有效，缓存键名是
            \think\Cache::set($mobile,$code,36000);
            $this->success(lang('success'));
        } else {
            $this->error(lang('fail'));
        }
    }
    
    public function welcome()
    {
        
        return $this->fetch();
    }
    
    public function agreement()
    {
        //获取商户注册协议
        $config = Config::get();
        //$a = $config['protocol']['contents'];
        $this->assign('protocol',htmlentities($config['protocol']['contents']));
        return $this->fetch();
    }
    
    /**
     * @Mark:商户入驻-公司信息
     * @return mixed|\think\response\Json
     * @Author: yang <502204678@qq.com>
     * @Version 2017/9/12
     */
    public function entertwo()
    {
        if ($this->request->isAjax()) {
            $param = $this->request->param();
            //公司信息数据验证
            $result = $this->validate($param,'Store.company_info');
            if ($result !== true) $this->error($result);
            $this->success(lang('check_success'));
        }
        //纳税类型税码
        $tax_type_tax_code = [0,3,6,11,13,17];
        $this->assign('tax_type_tax_code',$tax_type_tax_code);
        //纳税人类型
        $taxpayer_type = [
            '1'=>lang('general_taxpayer'),
            '2'=>lang('small-scale_taxpayer'),
            '3'=>lang('Non-vat taxpayer')
        ];
        $this->assign('taxpayer_type',$taxpayer_type);
        //营业执照类型
        $business_license_type = [
            '1'=>lang('license_type_one'),
            '2'=>lang('license_type_two'),
            '3'=>lang('license_type_three'),
        ];
        $this->assign('business_license_type',$business_license_type);
        
        $this->assign('data',null);
        return $this->fetch();
    }
    public function enterthree()
    {
        
        $param = $this->request->param();
        if ($this->request->isAjax()) {
            $company_info = (array)json_decode(html_entity_decode($param['company_info']));
            unset($param['company_info']);
            $param = array_merge($param,$company_info);
            //注册账号
            $account_data = [
                'nickname'=>$param['account']['username'],
                'password'=>$param['account']['password'],
                'cat_id'=>$param['cat_id'],
                'realname'=>$company_info['linkname'],
                'mobile'=>$company_info['mobile'],
                'status'=>0
            ];
            unset($param['account']);
            Db::startTrans();
            try{
                $reg_info = AccountApi::addSeller($account_data);
                if (!$reg_info['code']) return json($reg_info);
                //商户资料入库
                $param = array_merge($param,$company_info);
                $param['seller_id'] = $reg_info['data']['id'];
                $res = StoreApi::addSeller($param);
                if (!$res['code']) {
                    Db::rollback();
                    return json($res);
                }
                Db::commit();
            }catch (\Exception $e){
                Db::rollback();
                return json(['code'=>0,'msg'=>$e->getMessage()]);
            }
            return json(['code'=>1,'msg'=>lang('submit_success'),'url'=>url('enterfour').'?name='.$res['data']['seller_name']]);
        }
        //公司信息数据验证
        $result = $this->validate($param,'Store.company_info');
        if ($result !== true) $this->error($result);
        
        //公司类型
        $company_type = [
            '1'=>lang('company_type_one'),
            '2'=>lang('company_type_two'),
            '3'=>lang('company_type_three'),
            '4'=>lang('company_type_four'),
        ];
        $this->assign('company_type',$company_type);
        
        //店铺类型
        $shopcat = ShopcatModel::where(['status'=>1])->order('sort')->select();
        $this->assign('shopcat',$shopcat);
        
        //经营类目
        $category = GoodsApi::getCategories(0);
        $this->assign('category',$category);
        
        //主营类目
        $main_sale_type = [
            ['id'=>1,'name'=>'数码3C'],['id'=>2,'name'=>'服饰']
        ];
        $this->assign('main_sale_type',$main_sale_type);
        
        //可售商品数量
        $goods_num = [
            '0~100','100~200','200~500','500+'
        ];
        $this->assign('goods_num',$goods_num);
        
        //预计平均客单价
        $predict_avg_price = [
            '0~100','100~200','200~500','500+'
        ];
        $this->assign('predict_avg_price',$predict_avg_price);
       
        $this->assign('company_info',json_encode($param));
        
        $this->assign('data',null);
        return $this->fetch();
    }
    public function enterfour()
    {
        $param = $this->request->param();
        //获取店铺信息
        $store_info = StoreModel::where(['seller_name'=>$param['name']])->find();
        $this->assign('store_info',$store_info);
        return $this->fetch();
    }
    public function enterfive()
    {
        $param = $this->request->param();
        //获取店铺信息
        $store_info = StoreModel::where(['seller_name'=>$param['name']])->find();
        $this->assign('store_info',$store_info);
        return $this->fetch();
    }
    
    
    /**
     * @Mark: 返回商品分类
     * @return \think\response\Json
     * @Author: WangHuaLong
     */
    public function getCategories()
    {
        $pid = $this->request->post('pid');
        if ($pid == 0) {
            return '';
        }
        $category = GoodsApi::getCategories($pid);
        return json($category);
    }
    
    /**
     * @Mark:获取分类详细信息
     * @return null|\think\response\Json
     * @Author: yang <502204678@qq.com>
     * @Version 2017/9/13
     */
    public function get_cate_info()
    {
        $id = $this->request->post('id');
        $info = CategoryModel::get($id);
        if ($info) {
            return json(['code'=>1,'data'=>$info]);
        } else {
            return json(['code'=>0,'msg'=>lang('cate_error')]);
        }
    }
    
    
    public function CategoryDetail()
    {
        
        return $this->fetch();
    }
}
