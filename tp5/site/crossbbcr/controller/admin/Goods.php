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
// | 商品管理  Version 1.0  2016/3/13
// +----------------------------------------------------------------------
namespace app\crossbbcr\controller\admin;
use app\admin\controller\Admin;

class Goods extends Admin
{
    
    /**
     * @Mark:首页
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/13
     */
    public function index()
    {
        $this->assign ("meta_title", lang('Goods'));
        $this->assign ('data', null);
        return $this->fetch();
    }
    
    /**
     * @Mark:处理各种请求
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/8/9
     */
    public function _empty()
    {
        switch (ACTION_NAME){
            case 'wait': //待审
                $ids = input('post.ids/a');
                $this->assign ("meta_title", lang('Under'));
                $this->assign ('data', null);
                break;
            case 'up':  //上架
                $ids = input('post.ids/a');
                $this->assign ("meta_title", lang('Waitverify'));
                $this->assign ('data', null);
                break;
            case 'down': //下架
                $ids = input('post.ids/a');
                $this->assign ("meta_title", lang('Waitverify'));
                $this->assign ('data', null);
                break;
            default:
                $this->error('Error');
        }
    }
}
