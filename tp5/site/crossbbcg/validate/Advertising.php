<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Advertising.php  Version 2017/8/4
// +----------------------------------------------------------------------

namespace app\crossbbcg\validate;

use think\Validate;

class Advertising extends Validate
{
    protected $rule=[
        ['ad_position','require','{%pleace_choose_ad_position}'],
        ['ad_type','require','{%pleace_choose_ad_type}'],
        //['start_time','require','{%pleace_input_start_time}'],
        //['end_time','require','{%pleace_input_end_time}'],
        ['ad_link','require|url','{%pleace_input_ad_link}|{%url_format_error}'],
        ['name','require','{%ad_name_must}']
    ];
    
    protected $scene = [
        'goods_ad'=>['name','end_time','start_time','ad_type','ad_position']
    ];
}
