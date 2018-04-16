<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Article.php  Version 2017/9/25 文章管理
// +----------------------------------------------------------------------
namespace app\index\controller\admin;

use app\admin\controller\Admin;

class Article extends Admin
{
    /**
     * @Mark:首页
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/25
     */
    public function index()
    {
        $this->assign('meta_title', lang('Indexart'));
        return $this->fetch();
    }
}