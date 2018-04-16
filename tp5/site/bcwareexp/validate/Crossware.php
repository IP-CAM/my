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
// | Warehouse.php  Version 2017/3/19  仓库验证规则
// +----------------------------------------------------------------------
namespace app\bcwareexp\validate;

use think\Validate;

class Crossware extends Validate
{
    // 验证规则
    protected $rule = [
        ['code', 'require', '{%Crossware_code_must}'],
        ['code', '/^[a-zA-Z]\w{0,39}$/', '{%Crossware_code_rule_error}'],
        ['code', 'unique:Crossware', '{%Crossware_code_repeat}'],
        ['name', 'require', '{%Crossware_Name_must}'],
        ['address', 'require', '{%Crossware_address_must}'],
        ['rebackaddr', 'require', '{%Crossware_rebackaddr_must}'],
        //['expresstplid', 'require', '{%Crossware_exptplid_must}'],
        ['rule', 'checkrule', '{%Crossware_rule_error}'],
        ['rule', 'length:0,80', '{%Crossware_rule_betwen0255}'],
        ['url', 'url', '{%Crossware_url_error}'],
        ['adminurl', 'url', '{%Crossware_adminurl_error}'],
    ];
    
    /**
     * @Mark:检查拆单规则
     * @param $value
     * @param $rule
     * @param $data
     * @return bool
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/27
     */
    protected function checkrule($value, $rule, $data)
    {
        if (!isset($data['rule']) || empty($data['rule'])) return true;
        if (!empty($data['rule'])) {
            if ($data['rule'] == '') {
                return false;
            }
        }
        return true;
    }
}