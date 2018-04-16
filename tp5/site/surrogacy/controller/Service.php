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
// | Service.php  Version 2017/2/16 服务，陪护，月嫂， 商城等
// +----------------------------------------------------------------------
namespace app\surrogacy\controller;

use app\common\controller\Home;

class Service extends Home
{
    
    /**
     * @Mark:服务入口
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/2/16
     */
    public function index()
    {
        return $this->fetch();
    }
}
