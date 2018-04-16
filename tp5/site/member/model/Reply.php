<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Reply.php  Version 2017/5/22
// +----------------------------------------------------------------------
namespace app\member\model;
use app\common\model\Base;
class Reply extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__MEMBER_REPLY__';
    protected $auto = ['ip','langid'];
    protected $insert = ['reply_time'];
    protected $update = [];
    protected $resultSetType = 'collection';
    
    
    /**
     * @Mark:语言设置
     * @param $value
     * @return mixed|string
     * @Author: fancs
     * @Version 2017/6/19
     */
    public function setLangidAttr($value)
    {
        if(empty($value)){
            return LANG;
        }else{
            return $value;
        }
    }

    /**
     * @Mark reply_time
     * @param $value
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/22
     * @return string
     */
    protected function setReplyTimeAttr($value){
        return time();
    }

    /**
     * @Mark ip
     * @param  $value
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/22
     * @return int
     */
    protected function setIpAttr($value){
        return ipToInt(get_client_ip());
    }
}