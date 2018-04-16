<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Account.php  Version 2017/4/1 商家账户
// +----------------------------------------------------------------------
namespace app\systems\model;

use app\common\model\Base;


class Crontab extends Base
{
    protected $table = '__SYSTEMS_CRONTAB__';
    protected $insert = ['create_time'];

    /**
     * @Mark 创建时间
     * @param $value
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/22
     * @return mixed
     */
    protected function setCreateTimeAttr($value){
        return time();
    }
}