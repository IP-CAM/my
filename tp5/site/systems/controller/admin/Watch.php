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
// | 性能监控  Version 1.0  2016/3/14
// +----------------------------------------------------------------------

namespace app\systems\controller\admin;
use app\admin\controller\Admin;

class Watch extends Admin
{
   
    /**
     * @Mark:首页
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/10/8
     */
    public function index()
    {
        $this->assign ("meta_title", lang('Serverwatch'));
        return $this->fetch();
    }
    
    /**
     * @Mark:
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/10
     */
    public function mongo()
    {
        $this->assign ("meta_title", lang('Warmingcall'));
        return $this->fetch();
    }
    
    /**
     * @Mark:
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/10
     */
    public function redis()
    {
        $this->assign ("meta_title", lang('Rediswatch'));
        return $this->fetch();
    }
    
    /**
     * @Mark:WEB服务实时监控
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/10
     */
    public function web()
    {
        $this->assign ("meta_title", lang('Webwatch'));
        return $this->fetch();
    }
    
    /**
     * @Mark:数据库实时监控平台
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/10
     */
    public function db()
    {
        $this->assign ("meta_title", lang('Dbwatch'));
        return $this->fetch();
    }
    
    /**
     * @Mark: 报警及监控平台
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/10
     */
    public function warming()
    {
        $this->assign ("meta_title", lang('Warmingcall'));
        $this->assign('data', null);
        return $this->fetch();
    }
}