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
// | 推送/短信/邮件配置  Version 1.0  2016/3/14
// +----------------------------------------------------------------------

namespace app\admin\controller;

use think\Config;
use think\Cache;
use \app\admin\service\Message;

class Msgconf extends Admin
{
    
    /**
     * @Mark:首页
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/9/20
     */
    public function index()
    {
        $msg = $tmp_messager = [];
        if (!Cache::has('Modules') || !Cache::has('Menus')) $this->savecache(); //初始化缓存
        $Moduleslist = array_merge(Config::get('can_use_not_install'), Cache::get('Modules'));
        asort($Moduleslist);  //排序
        foreach ($Moduleslist as $mod) {
            $messager = realpath(APP_PATH . strtolower($mod) . DS . 'dev' . DS . 'messager.php');
            if (is_file($messager)) {
                $tmp_messager[$mod] = include $messager;
            }
        }
        
        foreach ($tmp_messager as $ko => $vo) {
            if ($vo) {
                foreach ($vo as $k => $item) {
                    $item['appid'] = $ko;
                    $item['msgid'] = $k;
                    $msg[]         = $item;
                }
            }
        }
        
        $this->assign('list', $msg);
        $this->assign("meta_title", lang('Msgconf'));
        return $this->fetch();
    }
    
    /**
     * @Mark:保存哪些可以发送（复选框前打钩）
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/8
     */
    public function save()
    {
        if ($this->request->isPost()) {
        
        } else {
            $this->error(lang('Save failed'));
        }
    }
    
    /**
     * @Mark:保存模板内容
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/8
     */
    public function saveedit()
    {
        if ($this->request->isPost()) {
            $param = $this->request->post();
            if (!isset($param['status'])) $param['param'] = 0;
            
            \app\admin\model\Message::where(['appid' => $param['appid'], 'msgid' => $param['msgid'], 'type' => $param['type']])->update(['msgtpl' => $param['msgtpl'], 'status' => $param['status']]);
            $this->success(lang('success', 'index'));
        } else {
            $this->error(lang('Save failed'));
        }
    }
    
    /**
     * @Mark:处理各种编辑
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/7
     */
    public function _empty()
    {
        $param = $this->request->param();
        
        $msgid = isset($param['msgid']) ? trim($param['msgid']) : '';
        $type  = isset($param['type']) ? trim($param['type']) : '';
        $appid = isset($param['appid']) ? trim($param['appid']) : '';
        
        $map  = [
            'msgid'  => ['eq', $msgid],
            'type'   => ['eq', $type],
            'appid'  => ['eq', $appid],
            'langid' => ['eq', LANG]
        ];
        $data = Message::getOne($map);
        
        $msg = include APP_PATH . strtolower($appid) . DS . 'dev' . DS . 'messager.php';
        
        if (empty($data)) {
            $data = [
                'appid'       => $appid,
                'msgid'       => $msgid,
                'msgtpl'      => lang($msg[$msgid][$type][1]),
                'type'        => $type,
                'num'         => 0,
                'expire'      => 10,
                'update_time' => time(),
                'status'      => 1,
                'langid'      => LANG
            ];
            \app\admin\model\Message::create($data);
        }
        
        $this->assign('data', $data);
        $this->assign('meta_title', lang('Edit_msg_tpl'));
        return $this->fetch(ACTION_NAME);
    }
}