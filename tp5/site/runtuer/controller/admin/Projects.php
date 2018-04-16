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
// | Projects  Version 1.0  2016/3/13
// +----------------------------------------------------------------------
namespace app\runtuer\controller\admin;
use app\admin\controller\Admin;

class Projects extends Admin
{
    //开发语言
    public static $dev_lang = array(1=>'php', 2=>'js', 3=>'html/css', 4=>'java', 5=>'.net', 6=>'C/C++', 7=>'Ruby', 8=>'Python', 9=>'go');
    /**
     * @Mark:继承
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/8/9
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->project_type = array(
            1 => lang("Shop_dev"),
            2 => lang("Comprehensive_website"),
            3 => lang("Enterprise_website"),
            4 => lang("Marketing_website"),
            5 => lang("Program_dev"),
            6 => lang("Mobile_website"),
            7 => lang("Weixin_dev"),
            8 => lang("Android_dev"),
            9 => lang("IOS_dev"),
            10 => lang("WP_app_dev"),
            11 => lang("Seo_extension"),
            12 => lang("Vhost"),
            13 => lang("Vps"),
            14 => lang("Server"),
        );
    
        $this->project_status = array(
            1 => "<em style='color:#093'>".lang("In_contact")."</em>",
            2 => "<em style='color:#FF0000'>".lang("Signed_contract")."</em>",
            3 => "<em style='color:#0000FF'>".lang("Development")."</em>",
            4 => "<em style='color:#FF00FF'>".lang("Prepaid")."</em>",
            5 => "<em style='color:#CCC5C5'>".lang("Give_up")."</em>",
            6 => "<em style='color:#003333'>".lang("Completed")."</em>",
            7 => "<em style='color:#999'>".lang("After_sale")."</em>",
            0 => "<em style='color:#999'>".lang("Eme_overdue")."</em>",
        );
    
        $this->isforeign = array(
            1 => lang("First_pro"),
            2 => lang("Second_pro"),
            3 => lang("Outsourcing_pro"),
            4 => lang("Garbage"),
        );
    
        $this->from = array(
            1 => lang("Statisticsearchengine"),
            2 => lang("Oldclient"),
            3 => lang("Baiduadsense"),
            4 => lang("Cmfdownload"),
            5 => lang("Other"),
        );
        $this->assign('type',$this->project_type);
        $this->assign('statu',$this->project_status);
        $this->assign('isforeign',$this->isforeign);
        $this->assign('from',$this->from);
        $this->assign ('dev_lang', self::$dev_lang);
    }
    
    public function _empty()
    {
        switch (ACTION_NAME)
        {
            case 'complete':
                $where = array('status', 'eq', 1);
                $this->assign('data', null);
                break;
            case 'failed':
                $where = array('status', 'eq', 1);
                $this->assign('data', null);
                break;
            case 'aftersale':
                $where = array('status', 'eq', 1);
                $this->assign('data', null);
                break;
            case 'overdue':
                $where = array('status', 'eq', 1);
                $this->assign('data', null);
                break;
        }
        
        return $this->fetch('index');
    }
}