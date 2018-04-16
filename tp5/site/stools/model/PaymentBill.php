<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: lingdong <13480628384@163.com>
// +----------------------------------------------------------------------
// | PaymentBill.php  Version 2017/07/03  支付单表
// +----------------------------------------------------------------------
namespace app\stools\model;

use think\Session;
use app\common\model\Base;

class PaymentBill extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__STOOLS_PAYMENT_BILL__';
    protected $autoWriteTimestamp = true;
    protected $auto     = ['uid'];
    protected $insert   = [];
    protected $update   = [];
    
    /**
     * @Mark:自动填充用户ID
     * @param $value
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/8/16
     */
    protected function setUidAttr($value)
    {
        return Session::get('user_auth.uid');
    }
    
}