<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Liceson.php  Version 2017/10/13
// +----------------------------------------------------------------------

namespace app\runtuer\validate;

use think\Validate;

class Liceson extends Validate
{
    protected $rule = [
        ['product_type','require','{%pleace_choose_product_type}'],
        ['type','require','{%pleace_choose_liceson_type}'],
        ['version_type','require','{%pleace_choose_version_type}'],
        ['title','require|max:200','{%pleace_input_title}|{%title_max_length_200}'],
        ['version','require','{%pleace_input_version}'],
        ['code','require|unique:RuntuerLiceson','{%pleace_input_code}|{%code_exist}'],
        ['website_name','require','{%pleace_input_website_name}'],
        ['company','require','{%pleace_input_company}'],
        ['url','require','{%pleace_input_url}'],
        ['end_time','require','{%pleace_input_end_time}'],
        ['jumptarget','require','{%pleace_input_jumptarget}'],
        ['description','require','{%pleace_input_description}'],
    ];
}