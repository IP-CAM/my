<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Index.php  Version 2017/5/2  Api请求入口
// +----------------------------------------------------------------------
namespace app\openapi\controller;

use app\common\controller\Common;

class Index extends Common
{
    /**
     * @Mark:初始化API接口
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/5/2
     */
    public function _initialize()
    {
        parent::_initialize();
    }
    
    /**
     * @Mark:API入口处理方法
     * @return mixed
     * @post 参数模拟
     * $data = [
     *      'service'   => 'member.member.register',
     *      'from'      => 'app',
     *      'content'   => [
     *          'name'      => '手机号/邮箱/字符串用户名',
     *          'password'  => '明文密码',
     *          'ip'        => '192.168.1.101',
     *      ],
     *      'sign'      => sign(),
     * ]
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/5/2
     */
    public function index()
    {
        if($this->request->isPost())
        {
            $data = $this->request->post();
            //判断各个参数是否为空
            empty($data['service']) && $this->error(lang('Not found service'));
            empty($data['from']) && $this->error(lang('From ids unallow empty'));
            empty($data['content']) && $this->error(lang('Not found content'));
            empty($data['sign']) && $this->error(lang('Not found sign'));
            //分拆调用
            $serviceArr = explode('.', $data['service']);
            
            //检测APP是否安装或者存在
            //TODO
            //检测方法是否存在
            //TODO
    
            //单层模型 $method = '\\app\\member\\service\\member::register($data)';
            $method = '\\app\\' . $serviceArr[0] . '\\service\\' . $serviceArr[1]::$serviceArr[2]($data['content']);
            
            print_r($method);
            exit;
    
        }
        return lang('Return index str');
    }
    
    
}