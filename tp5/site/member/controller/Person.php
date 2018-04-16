<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: fancs <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Person.php  Version 2017/6/24 个人中心
// +----------------------------------------------------------------------

namespace app\member\controller;

/*use app\bcwareexp\model\Area;
use app\bcwareexp\model\Country;*/
use app\common\controller\Home;
use app\member\model\Account;
use app\member\service\Address;
use app\member\service\Cash;
use app\member\service\Collect;
use app\member\service\Comment;
use app\member\service\Deposit;
use app\member\service\Member;
use app\member\service\Question;
use app\member\service\Security;
use app\member\service\Without;
/*use think\Session;*/

class Person extends Home
{
    /**
     * @Mark:用户个人信息中心
     * @return mixed
     * @Author: fancs <theseaer@qq.com>
     * @Version 2017/6/24
     */
    public function info()
    {
        if($this->request->post()){
            $uid = $this->request->has('id')?$this->request->param('id'):0;
            $nickname = $this->request->has('nickname')?$this->request->param('nickname'):'';
            $sex = $this->request->has('sex')?$this->request->param('sex'):0;
            $headimg = $this->request->has('headimg')?$this->request->param('headimg'):'';
            $birthday = $this->request->has('birthday')?$this->request->param('birthday'):'';
            
            //组装数据，更新用户修改的数据
            $data = [
                'name'      =>      $uid,
                'update'    =>      [
                    'nickname'  => $nickname,
                    'sex'       => $sex,
                    'headimg'   => $headimg,
                ],
            ];
            //更新扩展信息
            if($birthday){
                $extent = ['name'=>$uid,'birthday'=>$birthday];
                Member::update_extent($extent);
            }
            //更新account表信息
            $res = Member::update_user($data);
            if($res === true){
                return json(['code'=>1,'msg'=>lang('Update user success')]);
            }else if($res === false){
                return json(['code'=>0,'msg'=>lang('Update user error')]);
            }else{
                return $res;
            }
        }else{
            //从session中获取到用户信息
            //$info = Session::get('user_info');
            $info  = ['id'=>3,'last_login_time'=>time()];//模拟从session中获取到用户信息
            $param = ['name'=>$info['id']];
            $user  = Member::info($param);
            $this->assign('data',$user);
            $this->assign('ids',$info['id']);
            return $this->fetch();
        }
        
    }
    
    /**
     * @Mark:更换手机号
     * @return mixed
     * @Author: fancs
     * @Version 2017/6/24
     */
    public function mobile_validate()
    {
        if($this->request->isAjax()){
            $uid = $this->request->has('id')?$this->request->param('id'):0;
            $new_mobile = $this->request->has('new_mobile')?$this->request->param('new_mobile'):'';
            if(empty($new_mobile)){
                return json(['code'=>0,'msg'=>lang('New mobile is empty')]);
            }
            $mobile = Account::get(['mobile'=>$new_mobile]);
            if($mobile){
                return json(['code'=>0,'msg'=>lang('This mobile be occupied')]);
            }
            //组装数据，更新用户修改的数据
            $data = [
                'name'      =>      $uid,
                'update'    =>      [
                    'mobile'  => $new_mobile,
                ],
            ];
            $res = Member::update_user($data);
            if($res === true){
                return json(['code'=>1,'msg'=>lang('Update mobile success')]);
            }else if($res === false){
                return json(['code'=>0,'msg'=>lang('Update mobile error')]);
            }else{
                return $res;
            }
            
        }else{
            //显示页面
            //$info = Session::get('user_info');
            $info  = ['id'=>3,'last_login_time'=>time()];//模拟从session中获取到用户信息
            $param = ['name'=>$info['id']];
            $user  = Member::info($param);
            $this->assign('data',$user);
            $this->assign('ids',$info['id']);
            return $this->fetch();
        }
        
    }
    
    /**
     * @Mark:更换邮箱
     * @return mixed
     * @Author: fancs
     * @Version 2017/6/24
     */
    public function email_validate()
    {
        if($this->request->isAjax()){
            $uid = $this->request->has('id')?$this->request->param('id'):0;
            $new_email = $this->request->has('new_email')?$this->request->param('new_email'):'';
            if(empty($new_email)){
                return json(['code'=>0,'msg'=>lang('New email is empty')]);
            }
            $email = Account::get(['email'=>$new_email]);
            if($email){
                return json(['code'=>0,'msg'=>lang('This email be occupied')]);
            }
            //组装数据，更新用户修改的数据
            $data = [
                'name'      =>      $uid,
                'update'    =>      [
                    'email'  => $new_email,
                ],
            ];
            $res = Member::update_user($data);
            if($res === true){
                return json(['code'=>1,'msg'=>lang('Update email success')]);
            }else if($res === false){
                return json(['code'=>0,'msg'=>lang('Update email error')]);
            }else{
                return $res;
            }
            
        }else{
            //显示页面
            //$info = Session::get('user_info');
            $info  = ['id'=>3,'last_login_time'=>time()];//模拟从session中获取到用户信息
            $param = ['name'=>$info['id']];
            $user  = Member::info($param);
            $this->assign('data',$user);
            $this->assign('ids',$info['id']);
            return $this->fetch();
        }
        
    }
    
    /**
     * @Mark:安全中心
     * @Author: fancs
     * @Version 2017/6/24
     */
    public function safety_settings()
    {
        //显示页面
        //$info = Session::get('user_info');
        $info  = ['id'=>3,'last_login_time'=>time()];//模拟从session中获取到用户信息
        $param = ['name'=>$info['id']];
        $user  = Member::info($param);
        $this->assign('data',$user);
        $this->assign('ids',$info['id']);
        return $this->fetch();
    }
    
    /**
     * @Mark:用户修改密码
     * @return bool|int|mixed|\think\response\Json
     * @Author: fancs
     * @Version 2017/6/24
     */
    public function password()
    {
        if($this->request->isAjax()){
            $new_password = $this->request->has('new_password')?$this->request->param('new_password'):'';
            $old_password = $this->request->has('old_password')?$this->request->param('old_password'):'';
            $confirm_password = $this->request->has('confirm_password')?$this->request->param('confirm_password'):'';
            //数据验证
            if(empty($new_password) || empty($confirm_password)){
                return json(['code'=>0,'msg'=>lang('Password empty')]);
            }
            if($new_password !== $confirm_password){
                return json(['code'=>0,'msg'=>lang('New password and old password disaffinity')]);
            }
            //$info = Session::get('user_info');
            $info  = ['id'=>3,'last_login_time'=>time()];//模拟从session中获取到用户信息
            $param = ['name'=>$info['id']];
            $user  = Member::info($param);
            if(md5($old_password) != $user['password']){
                return json(['code'=>0,'msg'=>lang('Old passwords false')]);
            }
            //组装数据，更新用户修改的数据
            $data = [
                'name'      =>      3,
                'update'    =>      [
                    'password'  => md5($new_password),
                ],
            ];
            $res = Member::update_user($data);
            if($res === true){
                return json(['code'=>1,'msg'=>lang('Update password success')]);
            }else if($res === false){
                return json(['code'=>0,'msg'=>lang('Update password error')]);
            }else{
                return $res;
            }
        }
        return $this->fetch();
    }
    
    /**
     * @Mark:设置支付密码
     * @return bool|int|mixed|\think\response\Json
     * @Author: fancs
     * @Version 2017/6/26
     */
    public function paypwd()
    {
        if($this->request->isAjax()){
            $uid = $this->request->has('id')?$this->request->param('id'):0;
            $paypwd = $this->request->has('paypwd')?$this->request->param('paypwd'):'';
            $repaypwd = $this->request->has('repaypwd')?$this->request->param('repaypwd'):'';
            //验证数据
            if(empty($paypwd) || empty($repaypwd)) return json(['code'=>0,'msg'=>lang('Data empty')]);
            if($paypwd !== $repaypwd) json(['code'=>0,'msg'=>lang('Paypwd and repaypwd disaffinity')]);
            $param = ['name'=>$uid];
            $user  = Member::info($param);
            if(md5($paypwd) == $user['password']) return json(['code'=>0,'msg'=>lang('Paypwd and password  cannot be the same')]);
            //组装数据，更新用户修改的数据
            $data = [
                'name'      =>      3,
                'update'    =>      [
                    'pay_pwd'  => md5($paypwd),
                ],
            ];
            $res = Member::update_user($data);
            if($res === true){
                return json(['code'=>1,'msg'=>lang('Update paypwd success')]);
            }else if($res === false){
                return json(['code'=>0,'msg'=>lang('Update paypwd error')]);
            }else{
                return $res;
            }
        }else{
            //显示页面
            //$info = Session::get('user_info');
            $info  = ['id'=>3,'last_login_time'=>time()];//模拟从session中获取到用户信息
            $param = ['name'=>$info['id']];
            $user  = Member::info($param);
            $this->assign('data',$user);
            $this->assign('ids',$info['id']);
            return $this->fetch();
        }
        
    }
    
    /**
     * @Mark: 收货地址列表页面
     * @return mixed
     * @Author: fancs
     * @Version 2017/6/27
     */
    public function address_list()
    {
        //$info = Session::get('user_info');
        $info  = ['id'=>3,'last_login_time'=>time()];//模拟从session中获取到用户信息
        $param = ['name'=>$info['id']];
        $list = Address::get_address($param);
        $this->assign('list',$list);
        return $this->fetch();
    }
    
    /**
     * @Mark:新增收货地址
     * @return mixed|\think\response\Json
     * @Author: fancs
     * @Version 2017/6/27
     */
    public function address_add()
    {
        if($this->request->isAjax()){
            $country = $this->request->has('country')?$this->request->param('country'):0;//国家id
            $consignee = $this->request->has('consignee')?$this->request->param('consignee'):'';//收货人
            $province = $this->request->has('province')?$this->request->param('province'):'';//省id
            $city = $this->request->has('city')?$this->request->param('city'):'';//市id
            $district = $this->request->has('district')?$this->request->param('district'):'';//县id
            $address = $this->request->has('address')?$this->request->param('address'):'';//街道地址
            $mobile = $this->request->has('mobile')?$this->request->param('mobile'):'';//手机
            $zipcode = $this->request->has('zipcode')?$this->request->param('zipcode'):'';//邮编
            $identity = $this->request->has('identity')?$this->request->param('identity'):'';//身份证号码
            //验证数据
            if(!($country && $consignee && $address && $mobile &&$zipcode && $identity)) return json(['code'=>0,'msg'=>lang('Data incomplete')]);
            $a = preg_match("/^[a-z\d][a-z\d_.]*@[\w-]+(?:\.[a-z]{2,})+$/", $mobile);
            $b = preg_match("/^([0-9]{3,4}-)?[0-9]{7,8}$/",$mobile);
            $c = preg_match("/d{6}/",$zipcode);
            if($a && $b ) return json(['code'=>0,'msg'=>lang('Mobile error')]);
            if(!$c) return json(['code'=>0,'msg'=>lang('Zipcode error')]);
            //组装数据，调用接口
            //$info = Session::get('user_info');
            $info  = ['id'=>3,'last_login_time'=>time()];//模拟从session中获取到用户信息
            $data = [
                'uid'       =>  $info['id'],
                'consignee' =>  $consignee,
                'country'   =>  $country,
                'province'  =>  $province,
                'city'      =>  $city,
                'district'  =>  $district,
                'address'   =>  $address,
                'mobile'    =>  $mobile,
            ];
            $res = Address::add_address($data);
            return json(['code'=>0,'msg'=>$res]);
            if($res) return json(['code'=>1,'msg'=>lang('Add ok')]);
            return json(['code'=>0,'msg'=>lang('Add error')]);
        }else{
            //地区数据
            $country = \app\bcwareexp\service\Country::get_country();
            $this->assign('country',$country);
            return $this->fetch();
        }
    }
    
    /**
     * @Mark:账户余额页面
     * @return mixed
     * @Author: fancs
     * @Version 2017/6/27
     */
    public function recharge()
    {
        //$info = Session::get('user_info');
        $info  = ['id'=>3,'last_login_time'=>time()];//模拟从session中获取到用户信息
        $param = ['name'=>$info['id']];
        $user  = Member::info($param);
        $this->assign('user',$user);
    
        $type = $this->request->has('type')?$this->request->param('type'):0;//
        if($type == 0){             //充值记录
            $res = Cash::get_cash_log($param);
            
        }elseif ($type == 1){       //提现记录
            $res = Without::get_without_log($param);
        }else{                      //预存款变动记录
            $res = Deposit::get_money_log($param);
        }
        //dump($res->toArray());die();
        $this->assign('type',$type);
        $this->assign('lists',$res);
        return $this->fetch();
    }
    
    /**
     * @Mark:用户收藏列表
     * @return mixed
     * @Author:Fancs
     * @Version 2017/6/28
     */
    public function collect()
    {
        //$info = Session::get('user_info');
        $info  = ['id'=>3,'last_login_time'=>time()];//模拟从session中获取到用户信息
        $param = ['name'=>$info['id'],'type'=>0];//商品收藏
        $list = Collect::get_collect($param);
        $this->assign('list',$list);
        return $this->fetch();
    }
    
    /**
     * @Mark:用户评价列表
     * @return mixed
     * @Author: fancs
     * @Version 2017/6/28
     */
    public function comment()
    {
        //$info = Session::get('user_info');
        $info  = ['id'=>3,'last_login_time'=>time()];//模拟从session中获取到用户信息
        $param = ['name'=>$info['id']];//商品收藏
        $list = Comment::get_comment($param);
        $this->assign('list',$list);
        return $this->fetch();
    }
    /**
     * @Mark:用户提现申请
     * @return bool|mixed|\think\response\Json
     * @Author: fancs
     * @Version 2017/6/28
     */
    public function withdrawals()
    {
        if($this->request->isAjax()){
            $money = $this->request->has('money')?$this->request->param('money'):'';
            $bank_name = $this->request->has('bank_name')?$this->request->param('bank_name'):'';
            $account_bank = $this->request->has('account_bank')?$this->request->param('account_bank'):'';
            $account_name = $this->request->has('account_name')?$this->request->param('account_name'):'';
            $paypwd = $this->request->has('paypwd')?$this->request->param('paypwd'):'';
            //验证数据
            if(empty($money)||empty($bank_name)||empty($account_bank)||empty($account_name)||empty($paypwd)){
                return json(['code'=>0,'msg'=>lang('Data incomplete')]);
            }
            //$info = Session::get('user_info');
            $info  = ['id'=>3,'last_login_time'=>time()];//模拟从session中获取到用户信息
            $param = ['name'=>$info['id']];
            $user  = Member::info($param);
            if(md5($paypwd) !== $user['pay_pwd']){
                return json(['code'=>0,'msg'=>lang('Paypwd error')]);
            }
            if($money > $user['money']){
                return json(['code'=>0,'msg'=>lang('Money insufficient')]);
            }
            //组装数据调用接口
            $data = [
                'uid'           =>  $info['id'],
                'money'         =>  $money,
                'bank_name'     =>  $bank_name,
                'account_name'  =>  $account_name,
                'account_bank'  =>  $account_bank,
                'remark'        =>  '用户发起提现',
            ];
            $res = Without::add_without_log($data);
            if($res === true){
                return json(['code'=>1,'msg'=>lang('Apply success')]);
            }elseif ($res === false){
                return json(['code'=>0,'msg'=>lang('Apply error')]);
            }else{
                return $res;
            }
        }
        //$info = Session::get('user_auth');
        $info  = ['id'=>3,'last_login_time'=>time()];//模拟从session中获取到用户信息
        $param = ['name'=>$info['id']];
        $user  = Member::info($param);
        $this->assign('user',$user);
        //获取配置
        $Conf = MODULE_PATH . DS . 'extra'. DS .'index.php';
        $data = is_file(realpath($Conf)) ? include realpath($Conf) : null;
        $this->assign('config',$data);
        return $this->fetch();
    }
    public function question()
    {
        if($this->request->isAjax()){
             $q1 = $this->request->has('q1')?$this->request->param('q1'):'';
             $q2 = $this->request->has('q2')?$this->request->param('q2'):'';
             $q3 = $this->request->has('q3')?$this->request->param('q3'):'';
             $v1 = $this->request->has('v1')?$this->request->param('v1'):'';
             $v2 = $this->request->has('v2')?$this->request->param('v2'):'';
             $v3 = $this->request->has('v3')?$this->request->param('v3'):'';
             if(empty($q1)||empty($q2)||empty($q3)||empty($v1)||empty($v2)||empty($v3)){
                 return json(['code'=>0,'msg'=>'数据不完整']);
             }
            //$info = Session::get('user_auth');
            $info  = ['id'=>3,'last_login_time'=>time()];//模拟从session中获取到用户信息
            $data = [
                ['uid'=>$info['id'],'question_id'=>$q1,'value'=>$v1],
                ['uid'=>$info['id'],'question_id'=>$q2,'value'=>$v2],
                ['uid'=>$info['id'],'question_id'=>$q3,'value'=>$v3],
            ];
            foreach ($data as $value){
                $res = Security::save_security($value);
            }
            if($res){
                return json(['code'=>1,'msg'=>'add ok']);
            }
            return json(['code'=>0,'msg'=>'add error']);
        }else{
            $qustion1 = Question::get_question(1);
            $qustion2 = Question::get_question(2);
            $qustion3 = Question::get_question(3);
            $this->assign('question1',$qustion1);
            $this->assign('question2',$qustion2);
            $this->assign('question3',$qustion3);
            return $this->fetch();
        }
       
    }
}