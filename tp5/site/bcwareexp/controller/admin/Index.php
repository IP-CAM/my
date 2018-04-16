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
// | 仓库接口  Version 1.0  2016/3/13
// +----------------------------------------------------------------------
namespace app\bcwareexp\controller\admin;

use app\admin\controller\Admin;

class Index extends Admin
{
    /**
     * @Mark:
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/27
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->conDb      = 'Crossware';
        $this->meta_title = lang('Crossware');
        $expresstpl       = \app\seller\service\Transport::lists(['shop_id' => 0]);
        
        // 仓库类型
        $cross_type = [
            'bonded',
            'pay_taxes',
            'direct_mail'
        ];
        $this->assign('cross_type', $cross_type);
        
        $this->assign('expresstpl', $expresstpl);
    }
    
}
