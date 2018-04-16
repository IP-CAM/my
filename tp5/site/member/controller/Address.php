<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Address.php  Version 2017/7/20  地址管理
// +----------------------------------------------------------------------
namespace app\member\controller;

class Address extends Passport
{
    /**
     * @Mark:地址列表页
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/2/23
     */
    public function index()
    {
        $this->assign('Title', lang('Address index'));
        return $this->fetch();
    }
    
    /**
     * @Mark:地址编辑
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/2/23
     */
    public function edit()
    {
        $this->assign('Title', lang('Address edit'));
        return $this->fetch();
    }
    
    /**
     * @Mark:保存地址
     * @return bool
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/2/23
     */
    public function save()
    {
        return true;
    }
}