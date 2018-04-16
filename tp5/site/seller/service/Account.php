<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Account.php  Version 1.0  2017/5/24 商户
// +----------------------------------------------------------------------

namespace app\seller\service;

use think\Loader;
use app\admin\service\Service;
use app\seller\model\Account as AccountModel;

class Account extends Service
{
    /**
     * @Mark:商家注册
     * @param  $data = [
     *      'nickname'          => 'yang'   string
     *      'password'          => '123456' string
     *      'realname'          => '张三'    string
     *      'email'             => '12@qq.com'
     *      'cat_id'            => '1'
     *      'mobile'            => '1333333333'
     *      'role_id'           => '1'      角色id--->添加子账户时必须要
     *      'pid'         => '1'      上级商户管理员id--->只有添加子账户时需要
     *      'housecode'         => [1,2,3]
     * ]
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/24
     * @return array
     */
    static public function addSeller($data)
    {
        //数据验证
        $account_class = Loader::parseClass('seller', 'validate', 'Account');
        $validate = Loader::validate($account_class);
        if (isset($data['scene'])) {
            $re = $validate->scene($data['scene'])->check($data);
        } else {
            $re = $validate->check($data);
        }
        if (!$re) return ['code' => 0, 'msg' => $validate->getError()];
        unset($data['scene']);
        //密码加密
        $data['salt'] = generate_prefix(4);
        $data['password'] = md5(md5($data['password']) . $data['salt']);
        
        //根据系统设置判断新账户是否需要审核
        if (!isset($data['status']) && !config('index')['accounts_auto_check']) {
            $data['status'] = 0;
        }
        //数据入库
        $re = AccountModel::create($data);
        return ['code'=>1,'data'=>$re,'msg'=>''];
    }
    
    /**
     * @Mark:商家修改
     * @param $data array 修改内容
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/24
     * @return array
     */
    static public function editSeller($data)
    {
        //数据验证
        $account_class = Loader::parseClass('seller', 'validate', 'Account');
        $validate = Loader::validate($account_class);
        if (isset($data['scene'])) {
            $re = $validate->scene($data['scene'])->check($data);
            unset($data['scene']);
        } else {
            $re = $validate->scene('update')->check($data);
        }
        if (!$re) return ['code' => 0, 'msg' => $validate->getError()];
        
        //查询数据库的仓库
        $account_info = AccountModel::get($data['id']);
        //数组对比，判断是否修改了仓库
        $new_code = isset($data['housecode'])?(array)$data['housecode']:[];
        $diff = array_diff((array)$account_info['housecode'],$new_code);
        if ($diff) {
            //判断被修改的仓库是否绑定了商品以及商品是否有库存,如果有，则无法修改仓库
            $goods_ids = \app\crossbbcg\model\Goods::where(['seller_id'=>$data['id']])->value('id');
            $res = \app\crossbbcg\model\GoodsSkuQuantity::where(['good_id'=>['in',(array)$goods_ids],'crossware_code'=>['in',$diff]])
                ->where('crossware_sku_quantity>0 or crossware_sku_offline_quantity>0')
                ->value('good_id');
            if ($res) return ['code'=>0,'msg'=>lang('relieve_houseware_tips').implode(',',(array)$res)];
        }
        //数据入库
        $res = AccountModel::update($data);
        return ['code'=>1,'data'=>$res,'msg'=>''];
    }
    
    /**
     * @Mark:商户列表
     * @param $where array
     * @param $order array
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/22
     * @return mixed
     */
    static public function sellerList($where = ['status' => 0], $order = ['id' => 'desc'])
    {
        $list = AccountModel::where($where)->order($order)->paginate(15);
        return $list;
    }
    
    /**
     * @Mark:删除商户
     * @param $ids array 商户ids数组 [1,2,3]
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/22
     * @return array
     */
    static public function delSeller($ids)
    {
        $map = array(
            'id' => array('in', implode(',', $ids))
        );
        $re = AccountModel::where($map)->setField('is_del', 1);
        if (!$re) {
            return ['code' => 0, 'msg' => lang('del_fail')];
        } else {
            return ['code' => 1, 'msg' => lang('del_ok')];
        }
    }
    
    /**
     * @Mark:修改密码
     * @param $data array
     * @Author: yang <502204678@qq.com>
     * @Version 2017/5/31
     * @return array
     */
    static public function editPwd($data)
    {
        $data['salt'] = generate_prefix(4);
        $data['password'] = md5(md5($data['password']) . $data['salt']);
        $re = AccountModel::update($data);
        if ($re === false) {
            return ['code' => 0, 'msg' => lang('fail')];
        } else {
            return ['code' => 1, 'msg' => lang('success')];
        }
    }
    
    /**
     * @Mark:获取用户登录类型
     * @param $loginName string
     * @return string|\think\response\Json
     * @Author: yang <502204678@qq.com>
     * @Version 2017/5/31
     * @return string
     */
    private static function checkLoginNameType($loginName)
    {
        if (strpos($loginName, '@')) {
            if (!preg_match("/^[a-z\d][a-z\d_.]*@[\w-]+(?:\.[a-z]{2,})+$/", $loginName)) {
                return json(['code' => 0, 'msg' => lang('mail_format_error')]);
            }
            $type = 'email';
        } elseif (preg_match("/^1[34578]{1}[0-9]{9}$/", $loginName)) {
            $type = 'mobile';
        } else {
            $type = 'nickname';
        }
        return $type;
    }
    
    /**
     * @Mark:商户登陆
     * @param $data = [
     *      'name'      =>  'yang' 账户
     *      'pwd'       =>  '123'  密码
     *  ]
     * @return array
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/14
     */
    static public function login(&$data)
    {
        //账户检测
        $re = self::getUserInfo($data);
        if (!$re) return ['code' => 0, 'msg' => lang('Account is exits or unenable')];
        
        //密码比对
        if ($re['password'] !== md5(md5($data['pwd']) . $re['salt'])) return ['code' => 0, 'msg' => lang('Password error')];
        
        //更新登陆信息
        $data = [
            'login_time' => time(),
            'last_login_ip' => ipToInt(get_client_ip()),
        ];
        AccountModel::update($data, ['id' => $re['id']]);
        //登陆成功,返回用户信息
        $returndata = [
            'id'                =>  $re['id'],
            'nickname'          =>  $re['nickname'],
            'langid'            =>  $re['langid'],
            'last_login_time'   =>  $re['login_time'],
            'last_login_ip'     =>  get_client_ip(),
            'role_id'           =>  (int)$re['role_id'],
            'pid'               =>  $re['pid']
        ];
        return $returndata;
    }
    
    /**
     * @Mark:根据用户登录类型返回用户信息
     * @param $data = [
     *      'name'  =>  'yang' 登陆账户
     *
     * ]
     * @return bool|null|static
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/14
     */
    static public function getUserInfo(&$data)
    {
        //判断用户登录类型
        $nameType = self::checkLoginNameType($data['name']);
        $where = [$nameType => $data['name'],'is_del'=>0];
        
        //检测用户是否存在
        $re = AccountModel::get(function ($query) use ($where) {
            $query->where($where);
        });
        
        if (empty($re) || $re['status'] < 1) {
            return false;
        } else {
            return $re;
        }
    }
    
    /**
     * @Mark:根据子账号获取商户账号id
     * @param $id int 子账号id
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/13
     * @return int
     */
    static public function getParentId($id)
    {
        $re = AccountModel::where(['id'=>$id])->value('pid');
        if ($re) {
            return $re;
        } else {
            return $id;
        }
    }
}