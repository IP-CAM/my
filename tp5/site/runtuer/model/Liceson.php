<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Licenson.php  Version 2017/10/13
// +----------------------------------------------------------------------

namespace app\runtuer\model;

use app\admin\service\Service;

class Liceson extends Service
{
    protected $table = '__RUNTUER_LICESON__';
    
    protected $autoWriteTimestamp = true;
    
    protected $insert = ['langid','uid'];
    protected $auto = ['start_time','end_time'];
    protected $type = [
        'start_time'=>'timestamp',
        'end_time'=>'timestamp'
    ];
    
    protected function setLangidAttr($value){
        return getlangid($value);
    }
    
    protected function setUidAttr(){
        return UID;
    }
}
