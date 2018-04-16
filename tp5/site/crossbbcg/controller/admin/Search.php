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
// | Search.php  Version 1.0  2016/3/13 搜索器
// +----------------------------------------------------------------------
namespace app\crossbbcg\controller\admin;
use app\admin\controller\Admin;

class Search extends Admin
{

    /**
     * @Mark:首页
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/8/9
     */
    public function index()
    {
        $this->assign ("meta_title", lang('Bbcsearch'));
        return $this->fetch();
    }
    
    /**
     * @Mark:搜索引擎配置
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/26
     */
    public function config()
    {
        $this->assign ("meta_title", lang('Searcheng'));
        return $this->fetch();
    }
    
    /**
     * @Mark:索引管理
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/26
     */
    public function indexed()
    {
        $this->assign ("meta_title", lang('Searchind'));
        return $this->fetch();
    }

}
