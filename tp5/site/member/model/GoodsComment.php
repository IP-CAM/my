<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Comment.php  Version 2017/6/29 评论表
// +----------------------------------------------------------------------

namespace app\member\model;

use think\Model;

class GoodsComment extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__MEMBER_GOODS_COMMENT__';
    
    protected $autoWriteTimestamp = true;
    
    protected $insert = ['from_ip'];
    protected $type = ['image' => 'json'];
    
    /**
     * @Mark:来源IP
     * @param $value
     * @return int
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/24
     */
    protected function setFromIpAttr($value)
    {
        return ipToInt(get_client_ip());
    }
    
    /**
     * @Mark 关联归档：account
     * @author fancs
     * @return \think\model\relation\HasOne
     * @version 2017/5/27
     */
    public function account()
    {
        return $this->hasOne('account', 'id', 'uid', '', 'LEFT');
    }
}
