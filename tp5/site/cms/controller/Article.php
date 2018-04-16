<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | article.php  Version 2017/8/9
// +----------------------------------------------------------------------

namespace app\cms\controller;

use app\crossbbcg\controller\Shopbase;
use Think\Request;
use app\cms\model\Article as ArticleModel;

class Article extends Shopbase
{
    public function details()
    {
        $param = $this->request->get();
        //TODO 文章id为空跳转
        if (!isset($param['id'])) $this->redirect('error/not_found_article');
        $info = ArticleModel::get($param['id']);
        //文章数据为空跳转
        if (!$info) $this->redirect('error/not_found_article');
        $this->assign('data',$info);
        $this->assign('mate_title',$info['about']);
        return $this->fetch();
    }
}
