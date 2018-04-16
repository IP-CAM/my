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
// | SEO规则管理  Version 2017/1/18
// +----------------------------------------------------------------------
namespace app\admin\controller;

class Seo extends Admin
{
    /**
     * @Mark:集成并赋值
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/23
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->meta_title = lang('Seoconf');
    }
}