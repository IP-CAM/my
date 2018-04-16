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
// | 钩子  Version 1.0  2016/3/14
// +----------------------------------------------------------------------
namespace app\admin\controller;

use think\Config;
use think\Cache;

class Hook extends Admin
{

    /**
     * @Mark:首页
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/9/20
     */
    public function index()
    {
        $classlist = $filelist = $lists0 = $lists1 = $lists = [];
    
        $declared = get_declared_classes();
        foreach ($declared as $item)
        {
            if(preg_match('/app\\\\([0-9a-zA-Z_]+)\\\\dev\\\\hook\\\\([0-9a-zA-Z_]+)/' , $item))
            {
                $classlist[] = $item;
            }
        }
    
        foreach ($classlist as $its)
        {
            $lists0[] = [
                'func'  => get_class_methods('\\'. $its),
                'class' => '\\'. $its
            ];
        }
        
        $install    = Cache::get('Modules');
        $install[]  = 'Common';
    
        $applist = array_map('realpath', glob(APP_PATH. DS .'*'));
        foreach($applist as $dir)
        {
            if(is_dir($dir))
            {
                $files = list_dir_file($dir . DS . 'behavior', 'php');
                $filelist = array_merge($filelist, $files);
            }
        }
        
        foreach ($filelist as $file)
        {
            $module = explode(DS, str_replace(realpath(APP_PATH), '', $file));
            $namesp = '\\app\\' .$module[1]. '\\behavior\\' . strstr($module[3], '.', true);
    
            $lists1[] = [
                'func'  => get_class_methods($namesp),
                'class' => $namesp
            ];
        }
    
        $lists = array_merge($lists1, $lists0);
    
        $li1 = $li2 = [];
        foreach ($lists as $k => $v)
        {
            if(stripos($v['class'], 'behavior'))
            {
                //Think 系统自带的hook功能
                preg_match('/app\\\\([0-9a-zA-Z_]+)\\\\behavior\\\\([0-9a-zA-Z_]+)/', $v['class'], $module);
            }else{
                //自定义的hook功能
                preg_match('/app\\\\([0-9a-zA-Z_]+)\\\\dev\\\\hook\\\\([0-9a-zA-Z_]+)/', $v['class'], $module);
            }
            
            if(empty($v['func'])) continue;
            if(count($v['func']) == 1)
            {
                $info1 = get_fun_mark($v['class'], $v['func'][0]);
                $li1[] = [
                    'name'      => $module[2],   //类名
                    'module'    => $module[1],
                    'func'      => $v['func'][0],
                    'class'     => $v['class'],  //包含命名空间的类名
                    'mark'      => $info1['mark'],
                    'ver'       => $info1['ver'],
                    'install'   => in_array(ucfirst($module[1]), $install) ? 1 : 0,  //模块是否忆安装，已安装的模块自动为可用状态
                ];
            }else{
                foreach ($v['func'] as $item) {
                    $info2 = get_fun_mark($v['class'], $item);
                    $li2[]  = [
                        'name'      => $module[2],
                        'module'    => $module[1],
                        'func'      => $item,
                        'class'     => $v['class'],
                        'mark'      => $info2['mark'],
                        'ver'       => $info2['ver'],
                        'install'   => in_array(ucfirst($module[1]), $install) ? 1 : 0,   //模块是否忆安装，已安装的模块自动为可用状态
                    ];
                }
            }
        }
        
        $list = array_sort(array_merge($li1, $li2), 'module');
    
        $this->assign('list', $list);
        //$this->assign('list', array_sort(array_merge($li1, $li2), 'install', 'desc'));
        $this->assign ("meta_title", lang('Hook'));
        return $this->fetch();
    }
    
    /**
     * @Mark:钩子市场
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/8/3
     */
    public function market()
    {
        $this->assign('list', '');
        $this->assign ("meta_title", lang('HookWarehouse'));
        $this->assign ('_total', 1000);
        $this->assign ('_installed', 5);
        $this->assign ('_waitup', 10);
        return $this->fetch();
    }
    
    /**
     * @Mark:下载文件
     * @return string
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/10
     */
    public function download()
    {
        $file = $this->request->param('file');
        if ($file) {
            return \common\File::download($file);
        } else {
            return $this->view->fetch();
        }
    }
}