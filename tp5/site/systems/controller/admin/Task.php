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
// | 定时任务管理  Version 1.0  2016/3/14
// +----------------------------------------------------------------------

namespace app\systems\controller\admin;

use think\Config;
use think\Cache;
use app\admin\controller\Admin;

class Task extends Admin
{

    /**
     * @Mark:首页
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/10/8
     */
    public function index()
    {
        $corn = $tmp_crontab = [];
        if( ! Cache::has('Modules') || ! Cache::has('Menus') ) $this->savecache(); //初始化缓存
        $Moduleslist = array_merge(Config::get('can_use_not_install'), Cache::get('Modules'));
        asort($Moduleslist);  //排序
        foreach($Moduleslist as $mod)
        {
            $crontab = realpath(APP_PATH . strtolower($mod) . DS . 'dev'. DS . 'crontab.php');
            if(is_file($crontab)){
                $tmp_crontab[$mod] = include $crontab;
            }
        }
        
        foreach($tmp_crontab as $ko =>$vo) {
            if($vo)
            {
                foreach($vo as $k => $item)
                {
                    $item['appid']      = $ko;
                    $item['name']       = $k;
                    $item['lasttime']   = $item['status'] ? $this->getlasttime($ko, $k) : '';
                    $corn[] = $item;
                }
            }
        }
        
        $this->assign('list', $corn);
        $this->assign ("meta_title", lang('Crontab'));
        return $this->fetch();
    }
    
    /**
     * @Mark:获取定时任务最后执行时间
     * @param $appid string 模块名
     * @param $name string 类名
     * @return false|mixed|string
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/6
     */
    private function getlasttime($appid, $name)
    {
        $map = ['name' => ['eq', ucfirst($name)], 'appid' => ['eq', $appid]];
        $cronData = \app\systems\model\Crontab::where($map)->find();
        if($cronData)
        {
            return date('Y-m-d H:i:s', $cronData['lasttime']);
        }
        return lang('Not exec');
        //return date('Y-m-d H:i:s');
    }
    
    /**
     * @Mark:编辑定时任务 (作废 2017/3/6)
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/6
     */
    public function edit()
    {
        $name   = trim(input('name'));
        $app    = trim(input('app'));
    
        //该表只记录修改过的数据
        $map        = ['name' => ['eq', $name], 'appid' => ['eq', ucfirst($app)]];
        $croninfo   = \app\systems\model\Crontab::where($map)->find();
        
        if(empty($croninfo))
        {
            //读取定时任务配置
            $file = realpath(APP_PATH. $app . DS . 'dev'. DS . 'crontab.php');
            if(is_file($file)) {
                $crontab = include realpath($file);
                if($crontab)
                {
                    $croninfo = [
                        'appid'             =>  $app,
                        'name'              =>  $name,
                        'description'       =>  $crontab[$name]['description'],
                        'schedule'          =>  $crontab[$name]['schedule'],
                        'lasttime'          =>  0,
                        'status'            =>  1,
                    ];
                }
            }
        }
    
        $this->assign ("meta_title", lang('Cron_edit') . '：'. $app . '/event/'. $name);
        $this->assign('data', $croninfo);
        return $this->fetch();
    }
    
    /**
     * @Mark:手动执行定时任务
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/1/9
     */
    public function execron()
    {
        $ids            = input('ids/a');
        empty($ids) && $this->error(lang('No select Exec cron')) ;
    
        print_r($ids);
        exit;
    
    
        $err = [];  //存放出错记录，如果为空时刚为执行成功
        
        //循环执行选中的任务，将错误放到err数组中
        foreach ($ids as $id => $item)
        {
            $class = '\\app\\' . $item;
            $res   = $class::exec();
            if(! $res)
            {
                $err[]  = $res;
            }
        }
    
        //输出提示
        if (empty($err)) {
            $this->success(lang('Exec ok'));
        } else {
            $this->error(lang('Exec fail'));
        }
    }
    
    /**
     * @Mark:手动执行定时任务
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/1/9
     */
    public function cusexecron()
    {
        $ids            = input('ids/a');
        empty($ids) && $this->error(lang('No select Exec cron')) ;
        
        print_r($ids);
        exit;
        
        
        $err = [];  //存放出错记录，如果为空时刚为执行成功
        
        //循环执行选中的任务，将错误放到err数组中
        foreach ($ids as $id => $item)
        {
            $class = '\\app\\' . $item;
            $res   = $class::exec();
            if(! $res)
            {
                $err[]  = $res;
            }
        }
        
        //输出提示
        if (empty($err)) {
            $this->success(lang('Exec ok'));
        } else {
            $this->error(lang('Exec fail'));
        }
    }
    
    /**
     * @Mark:暂停任务
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/6/21
     */
    public function pause()
    {
        $ids            = input('ids/a');
        empty($ids) && $this->error(lang('No select pause cron')) ;
    
        $err = [];  //存放出错记录，如果为空时刚为执行成功
    
        //循环执行选中的任务，将错误放到err数组中
        foreach ($ids as $id => $item)
        {
            $class = '\\app\\' . $item;
            $res   = $class::exec();
            if(! $res)
            {
                $err[]  = $res;
            }
        }
    
        //输出提示
        if (empty($err)) {
            $this->success(lang('Pause ok'));
        } else {
            $this->error(lang('Pause fail'));
        }
    }
    
    /**
     * @Mark:自定义任务暂停
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/6/21
     */
    public function cuspause()
    {
        $ids            = input('ids/a');
        empty($ids) && $this->error(lang('No select pause cron')) ;
        
        print_r($ids);
        exit;
        
        
        $err = [];  //存放出错记录，如果为空时刚为执行成功
        
        //循环执行选中的任务，将错误放到err数组中
        foreach ($ids as $id => $item)
        {
            $class = '\\app\\' . $item;
            $res   = $class::exec();
            if(! $res)
            {
                $err[]  = $res;
            }
        }
        
        //输出提示
        if (empty($err)) {
            $this->success(lang('Pause ok'));
        } else {
            $this->error(lang('Pause fail'));
        }
    }

    /**
     * @Mark:新建定时任务
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/6/21
     */
    public function add()
    {
        $this->assign('data', null);
        $this->assign ("meta_title", lang('Addnew task'));
        return $this->fetch('edit');
    }
}