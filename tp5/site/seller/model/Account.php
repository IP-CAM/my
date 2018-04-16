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
namespace app\seller\model;

use app\common\model\Base;


class Account extends Base
{
    protected $table = '__SELLER_ACCOUNT__';
    protected $insert = ['langid'];
    protected $auto = ['housecode'];
    protected $autoWriteTimestamp = true;
    
    protected function setLangidAttr($value)
    {
        return LANG;
    }
    
    protected function setHousecodeAttr($value)
    {
        $data = implode(',', (array)$value);
        return $data;
    }
    
    protected function getHousecodeAttr($value)
    {
        if ($value != '') {
            $re = explode(',', $value);
        } else {
            $re = $value;
        }
        return $re;
    }
}