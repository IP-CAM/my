<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Auth.php  Version 2017/8/22  授权服务
// +----------------------------------------------------------------------

namespace app\index\controller;

use app\common\controller\Home;

class Auth extends Home
{
    /**
     * @Mark:认证首页
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/29
     */
    public function index()
    {
        $this->assign('meta_title', lang('Article cat'));
        return $this->fetch();
    }
    
    
    public function check()
    {
        $input = $this->request->param();
        $auth  = isset($input['code']) ? $input['code'] : '';
        if (empty($auth)) return json(['code' => 0, 'msg' => lang('Error auth')]);
        //查询认证服务是否存在
    }
}
