<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Offshop.php  Version 2017/6/2 线下门店
// +----------------------------------------------------------------------
namespace app\seller\validate;

use think\Validate;

class Offshop extends Validate
{
    protected $rule = [
        ['seller_name','require|unique:Offshop','{%sellerName_must}|{%sellerName_unique}'],
        ['mobile','require|/^1[34578]\d{9}$/','{%mobile_must}|{%mobile_format_error}'],
        ['principal','require','{%principal_must}'],
        ['country','require','{%country_must}'],
        ['province','require','{%province_must}'],
        ['city','require','{%city_must}'],
        ['address','require','{%address_must}'],
        ['area','require','{%area_must}'],
        ['lat','require|float','{%lat_must}|{%lat_error}'],
        ['lng','require|float','{%lng_must}|{%lng_error}'],
        ['logo','require','{%logo_must}'],
        ['description','require','{%description_must}'],
        ['cat_id','require','{%cat_must}'],
        
    ];
    
    protected $scene = [
        'edit'  =>['seller_name','logo','lat','lng','province','city','area','address','description']
    ];
}
