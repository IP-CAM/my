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
// | 财务结算  Version 1.0  2016/3/13
// +----------------------------------------------------------------------
namespace app\order\controller\admin;

use app\admin\controller\Admin;

class Financial extends Admin
{
    
    /**
     * @Mark:首页
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/10
     */
    public function index()
    {
        $this->assign("meta_title", lang('Salespays'));
        return $this->fetch();
    }
    
    /**
     * @Mark:应退款项
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/10
     */
    public function refund()
    {
        $this->assign("meta_title", lang('Refundpays'));
        return $this->fetch();
    }
    
    /**
     * @Mark:快递费用
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/10
     */
    public function expres()
    {
        $this->assign("meta_title", lang('Exprespays'));
        return $this->fetch();
    }
    
    /**
     * @Mark:佣金统计
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/10
     */
    public function commission()
    {
        $this->assign("meta_title", lang('Commission'));
        return $this->fetch();
    }
    
    /**
     * @Mark:返利统计
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/10
     */
    public function rebate()
    {
        $this->assign("meta_title", lang('Rebate'));
        return $this->fetch();
    }
}