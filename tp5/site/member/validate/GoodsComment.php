<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | GoodsComment.php  Version 2017/7/6
// +----------------------------------------------------------------------

namespace app\member\validate;

use think\Validate;

class GoodsComment extends Validate
{
    protected $rule = [
        ['order_id','require|integer','{%param_error}|{%param_error}'],
        ['order_sn','require|length:14,21','{%param_error}|{%param_error}'],
        ['goods_id','require|integer','{%param_error}|{%param_error}'],
        ['goods_name','require','{%param_error}'],
        ['goods_price','require','{%param_error}'],
        ['uid','require|integer','{%param_error}|{%param_error}'],
        ['shop_id','require|integer','{%param_error}|{%param_error}'],
        ['score','require|in:1,2,3,4,5','{%param_error}|{%param_error}'],
        ['from_membername','require','{%param_error}'],
        ['isanonymous','require','{%param_error}'],
        ['comment_content','require','{%comment_content_must}'],
        ['sku_id','require','{%sku_id_must}'],
        //['sku_name','require','{%sku_name_must}'],
        ['reply','max:250','{%reply_max_250}']
    ];
    protected $scene = [
        'reply'=>['reply']
    ];
}
