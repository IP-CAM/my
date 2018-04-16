<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Category.php  Version 2017/3/28
// +----------------------------------------------------------------------
namespace app\finance\model;

use app\common\model\Base;

class Category extends Base
{
    //定义时间戳字段名create_time, update_time
    protected $autoWriteTimestamp = true;
    //自动完成
    protected $auto     = ['is_reply', 'is_recom', 'is_check', 'api_status', 'pc_status', 'wap_status', 'allow_publish', 'listtype', 'langid'];
    protected $insert   = [];
    protected $update   = [];
    
    /**
     * @Mark:是否需要回复
     * @param $value
     * @return int
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/27
     */
    protected function setIsReplyAttr($value)
    {
        return autostatus($value);
    }
    
    /**
     * @Mark:是否推荐
     * @param $value
     * @return int
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/28
     */
    protected function setIsRecomAttr($value)
    {
        return autostatus($value);
    }
    
    /**
     * @Mark:是否需要审核
     * @param $value
     * @return int
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/27
     */
    protected function setIsCheckAttr($value)
    {
        return autostatus($value);
    }
    
    /**
     * @Mark:是否允许API
     * @param $value
     * @return int
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/27
     */
    protected function setApiStatusAttr($value)
    {
        return autostatus($value);
    }
    
    /**
     * @Mark:是否允许PC端
     * @param $value
     * @return int
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/27
     */
    protected function setPcStatusAttr($value)
    {
        return autostatus($value);
    }
    
    /**
     * @Mark:是否允许Wap端
     * @param $value
     * @return int
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/27
     */
    protected function setWapStatusAttr($value)
    {
        return autostatus($value);
    }
    
    /**
     * @Mark:是否封面
     * @param $value
     * @return int
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/27
     */
    protected function setlisttypeAttr($value)
    {
        return autostatus($value);
    }
    
    /**
     * @Mark:语言
     * @param $value
     * @return int
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/20
     */
    protected function setLangidAttr($value)
    {
        return getlangid($value);
    }
}