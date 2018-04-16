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
// | 客服系统配置器  Version 1.0  2016/3/13
// +----------------------------------------------------------------------
namespace app\im\controller\admin;

use app\admin\controller\Setting;

class Config extends Setting
{
    
    /**
     * @Mark:默认操作 覆盖父类
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/12/8
     */
    public function index(){
        $this->assign('meta_title', lang('Imconf'));
        return $this->fetch();
    }
    
}
