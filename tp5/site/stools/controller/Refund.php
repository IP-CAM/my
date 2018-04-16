<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: lingdong <13480628384@163.com>
// +----------------------------------------------------------------------
// | Version 2017/07/04 退款回调处理
// +----------------------------------------------------------------------
namespace app\stools\controller;

use app\common\controller\Home;

class Refund extends Home
{
    /**
     * @Mark:首页
     * @return mixed
     * @Author: lingdong <lingdong@qq.com>
     * @Version 2017/2/21
     */
    public function index()
    {
        //重新定位到首页
        $this->redirect('index/index/index');
    }
    
    /**
     * @Mark:退款回调函数地址(同步)
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/10
     */
    public function callback()
    {
        $input = $this->request->param();
        //获取使用的支付插件
        $class      = isset($input['class']) ? base64_decode($input['class']) : $this->error(lang('Error_id'));
        $platform   = isset($input['platform']) ? $input['platform'] : 'pc';
        
        $status = '';
        
        if(!$status)
        {
            return ['code' => 0, 'msg' => lang('Refund faill')];
        }
        
        //退款成功
        return ['code' => 1, 'msg' => lang('Refund success')];
    }
    
    /**
     * @Mark:回调业务处理地址(异步)
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/10
     */
    public function servercallback()
    {
        //TODO;
    }
    
    /**
     * @Mark:中断退款返回
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/10
     */
    public function merchantcallback()
    {
        //TODO;
    }
}
