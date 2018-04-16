<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Dbmodel.php  Version 2016/10/19 模型管理器
// +----------------------------------------------------------------------
namespace app\admin\model;

use think\Db;
use app\common\model\Base;
use app\admin\model\Attribute as AttributeModel;

class Dbmodel extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__ADMIN_DBMODEL__';
    
    //自动时间戳
    protected $autoWriteTimestamp = true;
    
    //自动完成
    protected $auto     = ['name', 'langstr', 'status', 'need_pk', 'islangs'];
    protected $insert   = [];
    protected $update   = [];
    
    /**
     * @Mark:Name
     * @param $value
     * @return string
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/27
     */
    protected function setNameAttr($value)
    {
        return strtolower($value);
    }
    
    /**
     * @Mark:Langstr
     * @param $value
     * @return string
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/27
     */
    protected function setLangstrAttr($value)
    {
        return ucfirst($value);
    }
    
    /**
     * @Mark:Status
     * @param $value
     * @return int
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/27
     */
    protected function setStatusAttr($value)
    {
        return autostatus($value);
    }
    
    /**
     * @Mark:Needpk
     * @param $value
     * @return int
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/27
     */
    protected function setNeedpkAttr($value)
    {
        return autostatus($value);
    }
    
    /**
     * @Mark:Islangs
     * @param $value
     * @return int
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/27
     */
    protected function setIslangsAttr($value)
    {
        return autostatus($value);
    }
}