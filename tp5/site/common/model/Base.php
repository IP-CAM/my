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
// | 基础类  Version 1.0  2016/3/14
// +----------------------------------------------------------------------
namespace app\common\model;

use think\Model;
use think\Config;

class Base extends Model
{
    // 设置当前模型对应的完整数据表名称
    //protected $table = 'think_user';
    
    // 设置当前模型的数据库连接
    /*protected $connection = [
        'type'        => 'mysql',       // 数据库类型
        'hostname'    => '127.0.0.1',   // 服务器地址
        'database'    => 'thinkphp',    // 数据库名
        'username'    => 'root',        // 数据库用户名
        'password'    => '',            // 数据库密码
        'charset'     => 'utf8',        // 数据库编码默认采用utf8
        'prefix'      => 'think_',      // 数据库表前缀
        'debug'       => false,         // 数据库调试模式
    ];*/
    
    // 设置返回数据集的对象名
    // protected $resultSetType = 'collection';
    
    //自动时间戳
    //protected $autoWriteTimestamp = true;
    
    //自动完成
    //protected $auto     = ['name', 'langstr', 'status', 'need_pk', 'islangs'];
    //protected $insert   = [];
    //protected $update   = [];
    
    //解决大小写问题
    //protected $attrCase = \PDO::CASE_NATURAL;   //个别数据表需要区分大小写
    //protected $tablePrefix  = '';   //定义模型对应数据表的前缀，如果未定义则获取配置文件中的database.prefix参数
    //protected $trueTableName= '';   //包含前缀的数据表名称，也就是数据库中的实际表名，该名称无需设置，只有当上面的规则都不适用的情况或者特殊情况下才需要设置。
    //protected $trueTableName = 'top.top_categories';  //省去$dbName，直接为：数据库名，表前缀，表名
    //protected $tableName    = '';   //不包含表前缀的数据表名称，一般情况下默认和模型名称相同，
    //protected $dbName       = '';   //定义模型当前对应的数据库名称
    
    //定义字段，提高性能
    //protected $fields = ['id', 'username', 'email', 'age'];  //数据表字段
    //protected $pk     = 'id';     //定义当前数据表的主键名
    //复合主键，可以这样定义
    //protected $fields = ['user_id', 'lession_id','score'];  //数据表字段
    //protected $pk     = ['user_id','lession_id'];  //定义当前数据表的主键名
    
    /**
     * @Mark:自动设置状态
     * @param $value
     * @return int
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/17
     */
    protected function setStatusAttr($value)
    {
        return autostatus($value);
    }
    
    
}