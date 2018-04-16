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
// | 报表  Version 1.0  2016/3/13
// +----------------------------------------------------------------------
namespace app\promotion\controller\admin;

use app\admin\controller\Admin;

class Report extends Admin
{

    /**
     * @Mark:首页
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/8/9
     */
    public function index()
    {
        $this->assign ("meta_title", lang('Adsensereport'));
        return $this->fetch();
    }
    
    /**
     * @Mark:广告报表
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/8/9
     */
    public function ads()
    {
        $this->assign ("meta_title", lang('Adsensereport'));
        return $this->fetch();
    }
    
    /**
     * @Mark:友情链接
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/16
     */
    public function links()
    {
        $this->assign ("meta_title", lang('Linksreport'));
        return $this->fetch();
    }
    
    /**
     * @Mark:促销报告
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/25
     */
    public function distribution()
    {
        $this->assign ("meta_title", lang('Reportdistri'));
        return $this->fetch();
    }
    
    /**
     * @Mark:优惠劵分析报表
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/25
     */
    public function coupons()
    {
        $this->assign ("meta_title", lang('Reportdistri'));
        return $this->fetch();
    }
    
    /**
     * @Mark:促销活动报表
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/1/10
     */
    public function discount()
    {
        $this->assign ("meta_title", lang('Disreport'));
        return $this->fetch();
    }
    
    /**
     * @Mark:促销活动报表
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/1/10
     */
    public function notice()
    {
        $this->assign ("meta_title", lang('Noticereport'));
        return $this->fetch();
    }
    
    /**
     * @Mark:实体券报表
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/29
     */
    public function shiti()
    {
        $this->assign ("meta_title", lang('Shitiquan'));
        return $this->fetch();
    }
    
    
    public function gift()
    {
        $this->assign ("meta_title", lang('Giftreport'));
        return $this->fetch();
    }


}