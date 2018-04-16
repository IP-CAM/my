<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Member.php  Version 2017/5/1  会员系统处理逻辑
// +----------------------------------------------------------------------
namespace app\member\service;

use app\admin\service\Service;
use app\member\model\Account as AccountModel;
use app\member\model\Agent;
use app\member\model\Level;
use app\member\model\Tag;
use think\Cookie;
use think\Loader;
use think\Session;
use think\Db;

class Member extends Service
{
    /**
     * @Mark:会员注册
     * @param $data
     * $data = [
     *      'name'      => '手机号/邮箱/字符串用户名',
     *      'password'  => '明文密码',
     *      'ip'        => '192.168.1.101',
     *      'source'    => 'member',  内部来源
     *      'outsrc'    => 'abc',     外部来源
     * ];
     * @return array 成功返回用户ID，失败返回失败的消息
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/5/11
     * @Remark 2017/6/19 fancs调整测试
     */
    static public function register(&$data)
    {
        //注册类型
        $userType = self::checkLoginNameType($data['name']);
        //注册时使用的用户数据
        $userInfo = [
            $userType => $data['name'],  //动态用户类型
            'password' => md5($data['password']),
            'reg_time' => time(),
            'nickname' => isset($data['nickname'])?$data['nickname']:$data['name'],
            'username' => isset($data['username'])?$data['username']:$data['name'],
            'source' => isset($data['source']) ? $data['source'] : MODULE_NAME,  //内部来源
            'outsrc' => isset($data['outsrc']) ? $data['outsrc'] : MODULE_NAME,  //外部来源
            'status' => 1,
        ];
        
        //数据验证
        $_class = Loader::parseClass('member', 'validate', 'Account');
        $validate = Loader::validate($_class);
        if (!$validate->check($userInfo)) return ['code' => 0, 'msg' => $validate->getError()];
        // 启动事务
        Db::startTrans();
        try{
            //create返回对象实例
            $accObj = AccountModel::create($userInfo);
            //插入member表
            $memberData = [
                'id' => (int)$accObj->id,
            ];
            \app\member\model\Member::create($memberData);
            // 提交事务
            Db::commit();
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            return ['code' => 0, 'msg' => lang('Register Account fail')];
        }
        return ['code'=>1,'data'=>(int)$accObj->id];
    }
    
    /**
     * @Mark:会员登陆
     * $data = [
     *      'name'      => '手机号/邮箱/字符串用户名',
     *      'password'  => '明文密码',
     * ];
     * @return bool
     * @Author: Fancs
     * @Version 2017/5/16
     */
    static public function login(&$data)
    {
        $info = self::getUserInfo($data);
        if (!$info) return false;
        //验证用户密码
        if (md5($data['password']) === $info['password']) {
            //更新登陆信息
            $update = array(
                'last_login_time'   => time(),
                'last_login_ip'     => get_client_ip(0),
                'login'             => $info['login'] + 1,
            );
            AccountModel::update($update, ['id' => $info['id']]);
            //更新用户token
            $token = md5(uniqid(mt_rand(1111, 9999), true));
            \app\member\model\Member::update(['id' => $info['id'], 'token' => $token]);
            //设置用户浏览记录cookie
            $config = get_config('admin', 'index');
            if (!Cookie::get('history')) {
                $history = History::get_history($info['id']);
                if ($history) Cookie::set('history', json_encode($history), ['expire' => $config['cookieexpire']]);
            }
            //组装返回登录信息
            $return = [
                'uid' => $info['id'],
                'name' => $data['name'],
                'last_login_time' => time(),
            ];
            //设置登陆信息
            
            Session::set('user_auth', $return);
            Session::set('user_auth_sign', data_auth_sign($return));
            $cookie = [
                'nickname'  => $info['nickname'],
                'token'     => \app\member\model\Member::where('id', $info['id'])->value('token'),
            ];
            Cookie::set('user_auth', $cookie, (int)$config['cookieexpire']);
            
            return $return;//登录成功
        } else {
            //记录日志
            return false;//密码错误
        }
    }
    
    /**
     * @Mark:返回用户token
     * @param $uid
     * @return bool
     * @Author: fancs
     * @Version 2017/7/5
     */
    public static function get_token($uid)
    {
        $user = \app\member\model\Member::get($uid);
        if ($user) return $user['token'];
        return false;
    }
    
    /**
     * @Mark:根据用户token返回用户信息
     * @param $token
     * @return bool|null|static
     * @Author: fancs
     * @Version 2017/7/6
     */
    static public function get_userinfo_by_token($token)
    {
        $member = \app\member\model\Member::get(['token' => $token]);
        if (empty($member)) {
            return false;
        } else {
            $data = ['name' => $member['id']];
            $info = self::info($data);
        }
        return $info;
        
    }
    
    /**
     * @Mark:获取所有有效会员
     * @return bool|false|static[]
     * @Author: fancs
     * @Version 2017/6/29
     */
    static public function all_account()
    {
        $data = AccountModel::all(function ($query) {
            $query->where('status', '>', 0);
        });
        if (empty($data)) return false;
        return $data;
    }
    
    /**
     * @Mark：修改用户密码
     * @param $data [
     *      'name'=>'fancs',
     *      'old_password'=>'123',
     *      'new_password'=>'456'
     * ]
     * @return bool|int
     * @author Fancs
     * @version 2017/5/11
     */
    static public function change_pwd(&$data)
    {
        $info = self::getUserInfo($data);
        if (!$info) return json(['code' => 0, 'msg' => lang('Account is exits or enable')]);
        //验证用户密码
        if (md5($data['old_password']) !== $info['password']) {
            return json(['code' => 0, 'msg' => lang('Password error')]);//密码错误
        }
        
        //检查通过，更新用户信息
        $res = AccountModel::update(['password' => md5($data['new_password'])], ['id' => $info['id']], 'password');
        if ($res) {
            return true;
        } else {
            return json(['code' => 0, 'msg' => lang('Update error')]);//数据更新失败
        }
    }
    
    /**
     * @Mark：重置用户密码
     * @param $data [
     *      'name'=>'fancs',
     *      'password'=> 123456
     * ]
     * @return bool|int
     * @author Fancs
     * @version 2017/5/16
     */
    static public function resetPwd(&$data)
    {
        //检查用户ID对应的应用是否存在或者状态是否正常
        $info = self::getUserInfo($data);
        if (!$info) return json(['code' => 0, 'msg' => lang('Account is exits or enable')]);
        //重置用户密码
        $res = AccountModel::update(['password' => md5($data['password'])], ['id' => $info['id']], 'password');
        if ($res) {
            return true;
        } else {
            return json(['code' => 0, 'msg' => lang('System error')]);//数据更新失败
        }
    }
    
    /**
     * @Mark：获取用户昵称，后台使用
     * @param $id //用户id
     * @return string
     * @author Fancs
     * @version 2017/5/25
     */
    static public function get_nickname($id, $fields = 'nickname')
    {
        $info = AccountModel::get($id);
        if (empty($info)) {
            return '';
        }
        return $info[$fields];
    }
    
    /**
     * @Mark:检查手机号码是否存在
     * @param $mobile
     * @return bool
     * @Author: fancs
     * @Version 2017/7/11
     */
    static public function check_mobile($mobile)
    {
        if (empty($mobile) || !preg_match("/^1[34578]{1}[0-9]{9}$/", $mobile)) {
            return false;
        }
        $res = AccountModel::where('mobile', $mobile)->find();
        if ($res) return true;
        return false;
    }
    
    /**
     * @Mark:检查邮箱是否存在
     * @param $wmail
     * @return bool
     * @Author: fancs
     * @Version 2017/7/11
     */
    static public function check_email($email)
    {
        if (empty($email) || !preg_match("/^[a-z\d][a-z\d_.]*@[\w-]+(?:\.[a-z]{2,})+$/", $email)) {
            return false;
        }
        $res = AccountModel::where('email', $email)->find();
        if ($res) return true;
        return false;
    }
    
    /**
     * @Mark:检查昵称是否存在
     * @param $nickname
     * @return bool
     * @Author: fancs
     * @Version 2017/7/12
     */
    static public function check_nickname($nickname)
    {
        if (empty($nickname)) {
            return false;
        }
        $res = AccountModel::where('nickname', $nickname)->find();
        if ($res) return true;
        return false;
    }
    
    /**
     * @Mark：更新用户信息
     * @param $data [
     *      'name'  =>'fancs',
     *      'update'=>['email'=>'a','sex'=>'1','nickname'=>'f'......]
     * ]
     * @return bool|int
     * @author Fancs
     * @version 2017/5/16
     */
    static public function update_user(&$data)
    {
        //更新前检查用户
        $info = self::getUserInfo($data);
        if (!$info) return json(['code' => 0, 'msg' => lang('Account is exits or enable')]);
        //如果是后台更新用户数据,内部调用
        if (!empty($data['id'])) {
            $update = AccountModel::update($data['update'], ['id' => $data['id']]);
            if (!$update) return false;
            return true;
        }
        //更新用户信息
        $res = AccountModel::update($data['update'], ['id' => $info['id']]);
        if ($res) {
            return true;//更新成功
        } else {
            return false;//更新失败
        }
    }
    
    /**
     * @Mark：更新用户扩展信息
     * @param $data [
     *      'name'     =>'fancs',
     *      'birthday' =>'2017-5-4'
     * ]
     * @return bool|int
     * @author Fancs
     * @version 2017/6/24
     */
    static public function update_extent(&$data)
    {
        //更新前检查用户
        $info = self::getUserInfo($data);
        if (!$info) return json(['code' => 0, 'msg' => lang('Account is exits or enable')]);
        $data['id'] = $info['id'];
        unset($data['name']);
        $res = \app\member\model\Member::update($data);
        if ($res) {
            return true;//更新成功
        } else {
            return false;//更新失败
        }
    }
    
    /**
     * @Mark：查询用户的扩展信息
     * @param $data [
     *      'name'  =>'fancs',
     * ]
     * @return bool|int
     * @author Fancs
     * @version 2017/5/17
     */
    static public function get_user_extent(&$data)
    {
        $info = self::getUserInfo($data);
        if (!$info) return json(['code' => 0, 'msg' => lang('Account is exits or enable')]);
        //查询扩展信息
        $extent = \app\member\model\Member::get($info['id']);
        return $extent;
    }
    
    /**
     * @Mark：查询所有扩展字段
     * @param $data [
     *
     * ]
     * @return bool|int
     * @author Fancs
     * @version 2017/5/17
     */
    static public function get_extent(&$data = [])
    {
        $extent = \app\member\model\Extent::all(function ($query) {
            $query->where('status', '>', 0);
        });
        if (empty($extent)) {
            return json(['code' => 0, 'msg' => lang('Not find')]);;
        }
        return $extent;
    }
    
    /**
     * @Mark：查询单一用户组信息
     * @param $data [
     *      'id'    => $id
     *      'name'  =>'普通会员 or General',
     * ]
     * @return mixed|json
     * @author Fancs
     * @version 2017/5/27
     */
    static public function getOneLevel(&$data)
    {
        if ($data['id']) {
            //id
            $level = Level::get((int)$data['id']);
        } else {
            //判断是字母
            $map['status'] = ['>', 0];
            if (preg_match("/^[a-zA-Z]+$/", $data['name'])) {
                //根据alias查询
                $map['alias'] = $data['name'];
                $level = Level::get(function ($query) use ($map) {
                    $query->where($map);
                });
            } else {
                //根据name查询
                $map['name'] = $data['name'];
                $level = Level::get(function ($query) use ($map) {
                    $query->where($map);
                });
            }
        }
        if (empty($level)) {
            return json(['code' => 0, 'msg' => lang('Can`t fond user level or unenable')]);
        }
        return $level;
    }
    
    /**
     * @Mark：查询所有用户组信息
     * @param $data [
     *
     * ]
     * @return mixed|json
     * @author Fancs
     * @version 2017/5/17
     */
    static public function getLevels(&$data = [])
    {
        $levels = Level::all(function ($query) {
            $query->where('status', '>', 0);
        });
        return $levels;
    }
    
    /**
     * @Mark：查询用户指定信息
     * @param $data [
     *      'name'  =>'fancs',
     *      'select'=>'email,nickname,sex,mobile',
     * ]
     * @return bool|data    返回用户指定信息一维数组
     * @author Fancs
     * @version 2017/5/16
     */
    static public function speInfo(&$data)
    {
        
        //检查用户ID对应的应用是否存在或者状态是否正常
        $info = self::getUserInfo($data);
        if (!$info) return json(['code' => 0, 'msg' => lang('Account is exits or unenable')]);
        
        $select = explode(',', $data['select']);
        //遍历数据
        foreach ($select as $key => $val) {
            $info[$val] = AccountModel::hasWhere(['id' => $info['id']])->value($val);
        }
        return $info;
    }
    
    /**
     * @Mark：查询用户标签
     * @param $data [
     *      'name'  =>  'fancs',
     * ]
     * @return bool|string 标签名
     * @author Fancs
     * @version 2017/5/16
     */
    static public function getUserTag(&$data)
    {
        //如果是后台内部调用
        if (!empty($data['id'])) {
            $user = AccountModel::get($data['id']);
            if (empty($user)) return json(['code' => 0, 'msg' => lang('This user is exit')]);
            $tag = Tag::get(function ($query) use ($user) {
                $query->where('id', $user['tag_id']);
            });
            return $tag;
        }
        
        //检查用户ID对应的应用是否存在或者状态是否正常
        $info = self::getUserInfo($data);
        if (!$info) return json(['code' => 0, 'msg' => lang('Account is exits or unenable')]);
        //获取用户标签
        $tag = Tag::get(function ($query) use ($info) {
            $query->where('id', $info['tag_id']);
        });
        return $tag['name'];
    }
    
    /**
     * @Mark：设置用户标签
     * @param $data [
     *      'name'=>$name,
     *      'tag'=>$tag_name
     * ]
     * @return bool|string
     * @author Fancs
     * @version 2017/5/16
     */
    static public function setUserTag(&$data)
    {
        //检查用户ID对应的应用是否存在或者状态是否正常
        $info = self::getUserInfo($data);
        if (!$info) return json(['code' => 0, 'msg' => lang('Account is exits or unenable')]);
        //检查标签是否存在
        $tag = Tag::get(function ($query) use ($data) {
            $query->where('name', $data['tag']);
        });
        if (empty($tag)) return json(['code' => 0, 'msg' => lang('Tag is not exit')]);
        //设置标签
        $res = AccountModel::update(['tag_id' => $tag['id']], ['id' => $info['id']]);
        if ($res === false) {
            return json(['code' => 0, 'msg' => lang('Set tag error')]);
        }
        return true;
    }
    
    /**
     * @Mark：查询标签分类用户
     * @param $data ['tag'=>$tag_name]
     * @return mixed|string 用户,二维数组
     * @author Fancs
     * @version 2017/5/15
     */
    static public function getUsersByTag(&$data)
    {
        //检查标签是否存在
        $tag = Tag::get(function ($query) use ($data) {
            $query->where('name', $data['tag']);
        });
        if (empty($tag)) return json(['code' => 0, 'msg' => lang('Tag is not exit')]);
        //根据tag查询分类用户
        $users = AccountModel::all(function ($query) use ($tag) {
            $query->where('tag_id', $tag['id']);
        });
        return $users;
    }
    
    /**
     * @Mark：查询用户代理商级别
     * @param $data ['name'=>'fancs']
     * @return bool|string 代理商级别
     * @author Fancs
     * @version 2017/5/16
     */
    static public function getUserAgent(&$data)
    {
        //如果是后台内部调用
        if (!empty($data['id'])) {
            $user = AccountModel::get($data['id']);
            if (empty($user)) return json(['code' => 0, 'msg' => lang('This user is exit')]);
            $agent = Agent::get(function ($query) use ($user) {
                $query->where('id', $user['agent_id']);
            });
            return $agent;
        }
        
        //检查用户ID对应的应用是否存在或者状态是否正常
        $info = self::getUserInfo($data);
        if (!$info) return json(['code' => 0, 'msg' => lang('Account is exits or unenable')]);
        $agent = Agent::get(function ($query) use ($info) {
            $query->where('id', $info['agent_id']);
        });
        if (empty($agent)) {
            return json(['code' => 0, 'msg' => lang('This user is not agent')]);
        }
        return $agent['title'];
    }
    
    /**
     * @Mark：查询用户所在用户组信息
     * @param $data ['name'=>'fancs']
     * @return bool|string 用户组信息
     * @author Fancs
     * @version 2017/5/16
     */
    static public function get_user_level(&$data)
    {
        //检查用户ID对应的应用是否存在或者状态是否正常
        $info = self::getUserInfo($data);
        if (!$info) return false;
        //查询用户组
        $level = Level::get(function ($query) use ($info) {
            $query->where('id', $info['levelid']);
        });
        return $level;
    }
    
    /**
     * @Mark：查询用户父级信息
     * @param $data ['name'=>'fancs']
     * @return mixed|string 父级信息或错误信息
     * @author Fancs
     * @version 2017/5/16
     */
    static public function getUserParent(&$data)
    {
        //如果是后台内部调用
        if (!empty($data['id'])) {
            $user = AccountModel::get($data['id']);
            if (empty($user)) return json(['code' => 0, 'msg' => lang('This user is exit')]);
            $parent = AccountModel::get(function ($query) use ($user) {
                $query->where('idcard', $user['pidcard']);
            });
            return $parent;
        }
        
        //检查用户ID对应的应用是否存在或者状态是否正常
        $info = self::getUserInfo($data);
        if (!$info) return json(['code' => 0, 'msg' => lang('Account is exits or unenable')]);
        //获取父级信息
        $parent = AccountModel::get(function ($query) use ($info) {
            $query->where('idcard', $info['pidcard']);
        });
        return $parent;
    }
    
    /**
     * @Mark：更新用户父级
     * @param $data ['name'=>'fancs','parent'=>'jack']/['id'=>'1','pid'=>'2']
     * @return mixed|string 返回true或错误信息
     * @author Fancs
     * @version 2017/5/16
     */
    static public function changeParent(&$data)
    {
        //如果后台调用
        if (!empty($data['id'])) {
            //检查用户是否存在
            $user = AccountModel::get($data['id']);
            if (empty($user)) return json(['code' => 0, 'msg' => lang('This account is exit')]);
            $parent = AccountModel::get($data['pid']);
            if (empty($parent)) return json(['code' => 0, 'msg' => lang('Parent is exit')]);
            //更新父级
            $res = AccountModel::hasWhere('id', $data['id'])->update(['pidcard' => $parent['idcard']]);
            if ($res !== false) return true;
            return json(['code' => 0, 'msg' => lang('Update error')]);
            
        }
        
        //检查用户ID对应的应用是否存在或者状态是否正常
        $info = self::getUserInfo($data);
        if (!$info) return json(['code' => 0, 'msg' => lang('Account is exits or enable')]);
        //检查父级用户
        $p_type = self::checkLoginNameType($data['parent']);//获取登陆类型
        
        $index = [
            $p_type => $data['parent'],  //动态用户类型
        ];
        
        //检查用户是否存在
        $parent = AccountModel::get($info['pid']);
        if (empty($parent) || $parent['status'] < 1) {
            return json(['code' => 0, 'msg' => lang('Can`t find this parent or enable')]);
        }
        //更新操作
        $res = AccountModel::hasWhere('id', $info['id'])->update(['pidcard' => $parent['idcard']]);
        if ($res !== false) return true;
        return json(['code' => 0, 'msg' => lang('Change error')]);
    }
    
    /**
     * @Mark：修改用户积分
     * @param $data [
     *      'name'=>'fancs'
     *      'add'=> 100    //增加积分
     *      'minus'=> 100  //减少积分
     * ]
     * @return mixed|string
     * @author Fancs
     * @version 2017/5/17
     */
    static public function saveScore(&$data)
    {
        //检查用户ID对应的应用是否存在或者状态是否正常
        $info = self::getUserInfo($data);
        if (!$info) return json(['code' => 0, 'msg' => lang('Account is exits or enable')]);
        
        if (!empty($data['add'])) {
            //增加积分
            $res = AccountModel::update(['score' => $info['score'] + $data['add']], ['id' => $info['id']]);
            if (empty($res)) return json(['code' => 0, 'msg' => lang('Update user score error')]);
            return true;
        }
        if (!empty($data['minus'])) {
            //减少积分
            $res = AccountModel::update(['score' => $info['score'] - $data['minus']], ['id' => $info['id']]);
            if (empty($res)) return json(['code' => 0, 'msg' => lang('Update user score error')]);
            return true;
        }
    }
    
    /**
     * @Mark：修改用户预存款
     * @param $data [
     *      'name'=>'fancs'
     *      'add'=> 100    //增加预存款
     *      'minus'=> 100  //减少预存款
     * ]
     * @return mixed|string
     * @author Fancs
     * @version 2017/5/18
     */
    static public function saveMoney(&$data)
    {
        //检查用户ID对应的应用是否存在或者状态是否正常
        $info = self::getUserInfo($data);
        if (!$info) return json(['code' => 0, 'msg' => lang('Account is exits or enable')]);
        
        if (!empty($data['add'])) {
            //增加预存款
            $res = AccountModel::update(['money' => $info['money'] + $data['add']], ['id' => $info['id']]);
            if (empty($res)) return json(['code' => 0, 'msg' => lang('Update user score error')]);
            return true;
        }
        if (!empty($data['minus'])) {
            //减少积分
            $res = AccountModel::update(['money' => $info['money'] - $data['minus']], ['id' => $info['id']]);
            if (empty($res)) return json(['code' => 0, 'msg' => lang('Update user score error')]);
            return true;
        }
    }
    
    /**
     * @Mark：查询用户预存款
     * @param $data ['name'=>'fancs']
     * @return mixed|string
     * @author Fancs
     * @version 2017/5/17
     */
    static public function getUserMoney(&$data)
    {
        //如果是后台内部调用
        if (!empty($data['id'])) {
            $user = AccountModel::get($data['id']);
            if (empty($user)) return json(['code' => 0, 'msg' => lang('This user is exit')]);
            return $user['money'];
        }
        //检查用户ID对应的应用是否存在或者状态是否正常
        $info = self::getUserInfo($data);
        if (!$info) return json(['code' => 0, 'msg' => lang('Account is exits or enable')]);
        
        return $info['money'];
    }
    
    
    /**
     * @Mark:检测用户登录类型
     * @param $loginName
     * @return string
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/5/31
     */
    public static function checkLoginNameType($loginName)
    {
        if (strpos($loginName, '@')) {
            if (!preg_match("/^[a-z\d][a-z\d_.]*@[\w-]+(?:\.[a-z]{2,})+$/", $loginName)) {
                return json(['code' => 0, 'msg' => lang('mail_format_error')]);
            }
            $type = 'email';
        } elseif (preg_match("/^1[34578]{1}[0-9]{9}$/", $loginName)) {
            $type = 'mobile';
        } elseif (preg_match("/^[0-9]+$/", $loginName)) {
            $type = 'id';
        } else {
            $type = 'username';
        }
        return $type;
    }
    
    /**
     * @Mark:根据用户登录类型返回用户信息
     * @param $data = ['name'=>'yang']
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/22
     * @return mixed|boolean
     */
    public static function getUserInfo(&$data)
    {
        $userType = self::checkLoginNameType($data['name']);//获取登陆类型
        $map = [
            $userType => $data['name'],  //动态用户类型
        ];
        //检查用户是否存在
        $user = AccountModel::get(function ($query) use ($map) {
            $query->where($map);
        });
        
        if (empty($user) || $user['status'] < 1) {
            return false;
        } else {
            return $user;
        }
    }
    
    /**
     * @Mark:
     * @param $data =[
     *      'name'  =>  '1311111111'    //用户手机，id，用户名,邮箱
     * ];
     * @return bool|null|static
     * @Author: fancs
     * @Version 2017/7/6
     */
    static public function info(&$data)
    {
        if (!is_array($data)) {
            return false;
        }
        $userType = self::checkLoginNameType($data['name']);//获取登陆类型
        $map = [
            $userType => $data['name'],  //动态用户类型
        ];
        //检查用户是否存在
        $user = AccountModel::get(function ($query) use ($map) {
            $query->where($map);
        });
        
        if (!$user) {
            return false;
        } else {
            $extent = \app\member\model\Member::get($user['id']);
            $user['extent'] = $extent;
            return $user;
        }
    }
    
    /**
     * @Mark: 根据条件查询会员人数
     * @param $where  array 条件 如：array('reg_time',['>','100'])
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/24
     * @return int
     */
    public static function getDayAccount($where = [])
    {
        $where['status'] = ['>',0];
        $num = AccountModel::where($where)->count();
        return (int)$num;
    }
    
    
    /**
     * @Mark:获取一周内每天用户注册数和充值额
     * @return array
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/2
     */
    public static function getWeekNum()
    {
        $arr = [];
        for ($i = 6; $i >= 0; $i--) {
            $cash['pay_time'] = $rec['reg_time'] = [];
            $date = date('Y-m-d', strtotime("-$i day"));
            $start = ['>=', mktime(0, 0, 0, date('m'), date('d') - $i, date('Y'))];
            $end = ['<=', mktime(23, 59, 59, date('m'), date('d') - $i, date('Y'))];
            $cash['pay_time'][] = $rec['reg_time'][] = $start;
            $cash['pay_time'][] = $rec['reg_time'][] = $end;
            $arr[$date]['reg'] = self::getDayAccount($rec);
            $sum = \app\member\model\Cash::where($cash)->sum('money');
            $arr[$date]['cash'] = $sum ? $sum : 0.00;
        }
        return $arr;
    }
    
    /**
     * @Mark:实名认证接口
     * @param $item [
     *      'IDcard'    =>  432826199302123031      //证件号
     *      'realName'  =>  '张三'                  //姓名
     * ]
     * @return \think\response\Json
     * @Author: Fancs
     * @Version 2017/6/30
     */
    static public function identification(&$item)
    {
        //获取实名认证配置项
        $Conf = realpath(APP_PATH) . DS . 'crossbbcg' . DS . 'extra' . DS . 'index.php';
        $data = is_file(realpath($Conf)) ? include realpath($Conf) : null;
        //开关
        if (!$data['realname']) {
            return json(['code' => 0, 'msg' => lang('Cnf_off')]);
        }
        if (empty($data['realnameclass']) && empty($data)) {
            return json(['code' => 0, 'msg' => lang('Cnf_configuration')]);
        }
        //实例化类
        $space = '\\realname\\' . $data['realnameclass'];
        $class = new $space;
        $param = [
            'IDcard'    => $item['IDcard'],        //证件号
            'realName'  => $item['realName'],      //姓名
        ];
        $res = $class->check($param);
        return $res;
    }
    
    /**
     * @Mark:获取验证码配置项
     * @param $data
     * @return bool
     * @Author: fancs
     * @Version 2017/7/3
     */
    static public function vercode()
    {
        //获取配置项
        $Conf = realpath(APP_PATH) . DS . 'admin' . DS . 'extra' . DS . 'index.php';
        $data = is_file(realpath($Conf)) ? include realpath($Conf) : null;
        //开关
        if (!$data['vercode']) {
            return false;
        }
        if (empty($data['vcodeid']) || empty($data['vcodekeys'])) {
            return false;
        }
        $config['vcodeid'] = $data['vcodeid'];
        $config['vcodekeys'] = $data['vcodekeys'];
        return $config;
    }
}