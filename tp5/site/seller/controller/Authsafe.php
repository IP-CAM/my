<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Authsafe.php  Version 2017/9/26
// +----------------------------------------------------------------------

namespace app\seller\controller;

class Authsafe extends Common
{
    public function index()
    {
        $this->assign('meta_title',lang('authsafe'));
        return $this->fetch();
    }
}
