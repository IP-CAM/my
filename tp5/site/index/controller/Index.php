<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Index.php  Version 2017/8/22 首页
// +----------------------------------------------------------------------
namespace app\index\controller;

use think\Request;
use app\common\controller\Home;

class Index extends Home
{
    /**
     * @Mark:首页
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/8/23
     */
    public function _empty(Request $request)
    {
        $this->assign('meta_title', lang('Article cat'));
        return $this->fetch(ACTION_NAME);
    }
    
}