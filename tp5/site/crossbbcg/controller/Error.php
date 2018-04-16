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
// | 处理空控制器  Version 2016/12/25
// +----------------------------------------------------------------------
namespace app\crossbbcg\controller;

use app\common\controller\Home;
use think\Request;

class Error extends Home
{
    
    /**
     * @Mark: 公共404页面
     * @param Request $request
     * @return mixed
     * @Author: WangHuaLong
     */
    public function _empty(Request $request)
    {
        $this->assign('title',lang('error_404'));
        $this->assign('error_tip',lang('error_tip'));
        return $this->fetch('/error/404');
    }
    
    /**
     * @Mark: 商品404页面
     * @return mixed
     * @Author: WangHuaLong
     */
    public function not_found_goods(){
        $this->assign('title',lang('error_good_404'));
        $this->assign('error_tip',lang('error_good_tip'));
        return $this->fetch('/error/404');
    }
    
    
}