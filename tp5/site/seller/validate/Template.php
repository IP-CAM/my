<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Shoptpl.php  Version 店铺模板 2017/6/12
// +----------------------------------------------------------------------

namespace app\seller\validate;

use think\Validate;

class Template extends Validate
{
    protected $rule = [
        ['name','require','{%tplname_must}'],
        ['description','require|max:500','{%descri_must}|{%descri_too_long}'],
        ['picture','require','{%picture_must}'],
        ['skin_name','require|alpha','{%skin_name_must}|{%skin_alpha}'],
    ];
}
