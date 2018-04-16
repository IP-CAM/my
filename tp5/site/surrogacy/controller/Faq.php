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
// | Faq.php  Version 2017/2/16 疑难解答，留言，评论体系
// +----------------------------------------------------------------------
namespace app\surrogacy\controller;

use app\common\controller\Home;

class Faq extends Home
{
    
    /**
     * @Mark:封面
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/2/16
     */
    public function index()
    {
        return $this->fetch();
    }
}