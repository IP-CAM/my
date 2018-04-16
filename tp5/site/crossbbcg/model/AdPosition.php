<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | AdPosition.php  Version 2017/8/4
// +----------------------------------------------------------------------

namespace app\crossbbcg\model;

use app\common\model\Base;

class AdPosition extends Base
{
    protected $table = '__CROSSBBCG_AD_POSITION__';
    protected $autoWriteTimestamp=true;
    protected $insert = ['langid'];
    
    protected function setLangidAttr(){
        return LANG;
    }
}
