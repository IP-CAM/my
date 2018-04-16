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
// | Govments.php  Version 2017/2/23
// +----------------------------------------------------------------------
namespace app\finance\controller;

use app\common\controller\Home;

class Enterprise extends Home
{
    
    /**
     * @Mark:企业融资租赁首页
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/2/23
     */
    public function index()
    {
        $this->assign('Title', lang('Enterprise index'));
        return $this->fetch();
    }
    
    /**
     * @Mark:企业融资租赁商品列表
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/2/23
     */
    public function lists()
    {
        $this->assign('Title', lang('Enterprise lists'));
        return $this->fetch();
    }
    
    /**
     * @Mark:企业融资租赁商品详情
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/2/23
     */
    public function detailed()
    {
        $this->assign('Title', lang('Enterprise detailed'));
        return $this->fetch();
    }
    
    
    
    
}