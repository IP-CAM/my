<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Article.php  Version 2017/2/16 文章类控制器
// +----------------------------------------------------------------------
namespace app\crossbbcg\controller;

class Article extends Shopbase
{
    
    public function index()
    {
        $this->assign('Title', lang('Article index'));
        return $this->fetch();
    }
    
    
    /**
     * @Mark:详情页
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/2/23
     */
    public function details()
    {
        $this->assign('Title', lang('Article details'));
        return $this->fetch();
    }
}