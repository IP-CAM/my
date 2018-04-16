<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: fancs <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Invitation.php  Version 2017/5/2 邀请
// +----------------------------------------------------------------------
namespace app\member\model;

use app\common\model\Base;
use think\Db;

class Extent extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__MEMBER_EXTENT__';
    protected $auto = ['langid'];
    protected $insert = [];
    protected $update = [];
    
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
     * @Mark  进行数据类型的转换，给member表添加列
     * @param $value
     * @param $data
     * @return mixed
     */
    public function setFieldTypeAttr($value,$data)
    {
        //数据类型转换

        switch ($value)
        {
            case 'input':
                $field_type = 'varchar(250) not null'; //input
                break;
            case 'select':
                $field_type = 'varchar(100) not null'; //select
                break;
            case 'radio':
                $field_type = 'tinyint(1) not null'; //radio
                break;
            case 'checkbox':
                $field_type = 'varchar(250) not null'; //checkbox
                break;
            case 'textarea':
                $field_type = 'text not null'; //textare
                break;
            case 'time':
                $field_type = 'datetime not null'; //time
                break;
            default:
                $field_type = '';
        }
        $field_name = $data['field_name'];//字段名
        //添加字段到account表
        Db::execute("alter table rt_member_member add  {$field_name} $field_type COMMENT '{$data['alias']}'");
        return $value;
    }
}