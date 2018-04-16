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
// | Config.php  Version 2017/3/2 融资租赁配置器
// +----------------------------------------------------------------------
namespace app\finance\controller\admin;

use app\admin\controller\Setting;

class Config extends Setting
{
    
    /**
     * @Mark:配置器
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/2
     */
    public function index()
    {
        $this->assign ("meta_title", lang('Finconf'));
        return $this->fetch();
    }
}