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
// | Plugins.php  Version 2017/3/12
// +----------------------------------------------------------------------
namespace app\admin\controller;

class Plugins extends Admin
{
    
    
    /**
     * @Mark:插件列表
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/12
     */
    public function index()
    {
        $this->assign('meta_title', lang('Plugins'));
        $this->assign('_total', 100);
        $this->assign('_enable', 100);
        return $this->fetch();
    }
    
    /**
     * @Mark:扩展市场
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/8/3
     */
    public function market()
    {
        $this->assign('list', '');
        $this->assign ("meta_title", lang('Store'));
        $this->assign ('_total', 1000);
        $this->assign ('_installed', 5);
        $this->assign ('_waitup', 10);
        return $this->fetch();
    }
    
    /**
     * @Mark:升级功能弹窗
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/10/31
     */
    public function upgradeto()
    {
        $param      = $this->request->param();
        $code       = isset($param['code']) ? trim($param['code']) : '';
        $url        = isset($param['url']) ? trim($param['url']) : '';
        $ver        = isset($param['ver']) ? trim($param['ver']) : '';
        $subjection = isset($param['subjection']) ? trim($param['subjection']) : '';
        $istrue     = isset($param['istrue']) ? trim($param['istrue']) : '';
        if($istrue){
            $this->assign ('code', $code);
            $this->assign ('url', $url);
            $this->assign ('ver', $ver);
            $this->assign ('subjection', $subjection);
        }
        return $this->fetch();
    }
}