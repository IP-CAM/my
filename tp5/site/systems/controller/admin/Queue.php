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
// | 请求KEY管理  Version 1.0  2016/3/14
// +----------------------------------------------------------------------

namespace app\systems\controller\admin;
use app\admin\controller\Admin;

class Queue extends Admin
{

    /**
     * @Mark:首页
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/10/8
     */
    public function index()
    {
        $this->assign ("meta_title", lang('Queue'));
        return $this->fetch();
    }
    
    /**
     * @Mark:清空队列
     * @return string|\think\response\Json
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/1/19
     */
    public function clear()
    {
        
        $this->success(lang('Clearok'));
    }
    
    /**
     * @Mark:重置队列
     * @return string|\think\response\Json
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/1/19
     */
    public function reset()
    {
        $ids            = input('ids/a');
        empty($ids) && $this->error(lang('No select reset queue')) ;
    
        $this->success(lang('Resetok'));
    }
    
    /**
     * @Mark:列队任务
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/6/21
     */
    public function task()
    {
        $this->assign ("meta_title", lang('Queuelist'));
        return $this->fetch();
    }
    
    /**
     * @Mark:执行队列
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/6/27
     */
    public function exec()
    {
        $ids            = input('ids/a');
        empty($ids) && $this->error(lang('No select exec queue')) ;
    
        $this->success(lang('Resetok'));
    }
}