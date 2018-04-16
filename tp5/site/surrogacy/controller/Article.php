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
// | Article.php  Version 2017/2/16
// +----------------------------------------------------------------------
namespace app\surrogacy\controller;

use app\common\controller\Home; 

class Article extends Home
{
    
    /**
     * @Mark:文章封面首页
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/2/16
     */
    public function index()
    {
        return $this->fetch();
    }
    
    /**
     * @Mark:列表页
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/2/16
     */
    public function lists()
    {
        return $this->fetch();
    }
    
    /**
     * @Mark:内容
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/2/16
     */
    public function show()
    {
        return $this->fetch();
    }
}