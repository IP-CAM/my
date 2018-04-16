<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Topic.php  Version 2017/8/22  讨论
// +----------------------------------------------------------------------
namespace app\index\controller;

use app\common\controller\Home;

class Topic extends Home
{
    /**
     * @Mark:首页
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/29
     */
    public function index()
    {
        return $this->fetch();
    }
}
