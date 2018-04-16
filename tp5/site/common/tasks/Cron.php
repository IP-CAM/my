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
// | 定时任务执行器主类  Version 2017/1/19
//
// 说明： 本执行器为主入口程序，手动执行时请务必在CLI模式下运行，本程序会被workerman频繁访问
// +----------------------------------------------------------------------
namespace app\common\tasks;

use think\Cache;
use think\console\Command;
use think\console\Input;
use think\console\Output;

class Cron extends Command
{
    //已安装的模型列表
    private $models      = array();
    //永久要执行任务的模块
    private $along       = array();
    //禁止执行任务的模块
    private $disabled    = array();
    
    /**
     * @Mark:构造器
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/1/19
     */
    private function init()
    {
        $model = Cache::get('Modules');
        //将一直需要运行的和已安装模块合并
        $allmod = array_merge($this->along, $model);
        //去除重复模块
        $this->models = array();
    }
    
    /**
     * @Mark:定时任务执行
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/4
     */
    protected function configure()
    {
        $this->setName('Corn')
             ->setDescription('execute cron tasks in the background');
    }
    
    /**
     * @Mark:执行主体
     * @param Input $input
     * @param Output $output
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/4
     */
    protected function execute(Input $input, Output $output)
    {
        $this->init();
        
        $output->writeln("TestCommand:");
    }
    
}