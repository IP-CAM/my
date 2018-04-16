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
// | Products.php  Version 2017/2/23 融资租赁商品控制器
// +----------------------------------------------------------------------
namespace app\finance\controller;

use app\common\controller\Home;

class Products extends Home
{
    
    /**
     * @Mark:融资租赁商品首面
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/2/23
     */
    public function index()
    {
        $this->assign('Title', lang('Products index'));
        return $this->fetch();
    }
    
    /**
     * @Mark:普通融资租赁商品列表
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/2/23
     */
    public function lists()
    {
        $this->assign('Title', lang('Products lists'));
        return $this->fetch();
    }
    
    /**
     * @Mark:普通融资租赁商品详情
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/2/23
     */
    public function detailed()
    {
        $this->assign('Title', lang('Products detailed'));
        return $this->fetch();
    }
}