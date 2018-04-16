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
// | datatypes.php  Version 2017/2/24
// +----------------------------------------------------------------------

return array(
    //数字
    'number' => [
        'doctrineType' => ['type'=>'int', 'length'=>10,'ponit'=>2,'unsigned' => true],
        'langstr'=>lang('Numb'),
        'searchparams' => [
            'than'      => lang('Than'),
            'lthan'     => lang('Lthan'),
            'nequal'    => lang('Nequal'),
            'sthan'     => lang('Sthan'),
            'bthan'     => lang('Bthan'),
            'between'   => lang('Between')
        ]
    ],
    //字符串
    'string'=>[
        'doctrineType' => ['type'=>'varchar' ,'length'=>255],
        'langstr'=>lang('String'),
        'searchparams' => [
            'has'   => lang('Has'),
            'nohas' => lang('Nohas')
        ],
    ],
    //文本框
    'textarea'=>[
        'doctrineType' => ['type'=>'text'],
        'langstr'=>lang('Input'),
        'searchparams' => [
            'has'   => lang('Has'),
            'nohas' => lang('Nohas')
        ],
    ],
    //日期
    'date'    =>  [
        'doctrineType' => ['type'=>'int','length'=>10,'unsigned' => true],
        'langstr'=>lang('Date'),
        'searchparams' => [
            'than'      => lang('Than'),
            'lthan'     => lang('Lthan'),
            'nequal'    => lang('Nequal'),
            'sthan'     => lang('Sthan'),
            'bthan'     => lang('Bthan'),
            'between'   => lang('Between')
        ]
    ],
    //布尔
    'bool'  =>[
        'doctrineType' => ['type'=>'tinyint','length'=>2,'unsigned' => true],
        'langstr'=>lang('Boolean'),
        'searchparams' => [
            'than'      => lang('Than'),
            'lthan'     => lang('Lthan'),
            'nequal'    => lang('Nequal'),
            'sthan'     => lang('Sthan'),
            'bthan'     => lang('Bthan'),
            'between'   => lang('Between')
        ]
    ],
    //枚举
    'select'=>[
        'doctrineType' => ['type'=>'enum'],
        'langstr'=>lang('Enumeration'),
        'searchparams' => [
            'than'      => lang('Than'),
            'lthan'     => lang('Lthan'),
            'nequal'    => lang('Nequal'),
            'sthan'     => lang('Sthan'),
            'bthan'     => lang('Bthan'),
            'between'   => lang('Between')
        ]
    ],
    //单选
    'radio'=>[
        'doctrineType' => ['type'=>'char','length'=>10],
        'langstr'=>lang('Radio'),
        'searchparams' => [
            'has'   => lang('Has'),
            'nohas' => lang('Nohas')
        ],
    ],
    //多选
    'checkbox'=>[
        'doctrineType' => ['type'=>'varchar','length'=>100],
        'langstr'=>lang('Checkbox'),
        'searchparams' => [
            'has'   => lang('Has'),
            'nohas' => lang('Nohas')
        ],
    ],
    //编辑器
    'editor'=>[
        'doctrineType' => ['type'=>'text'],
        'langstr'=>lang('Editor'),
        'searchparams' => [
            'has'   => lang('Has'),
            'nohas' => lang('Nohas')
        ],
    ],
    //单图上传
    'picture'=>[
        'doctrineType' => ['type'=>'varchar','length'=>255],
        'langstr'=>lang('Upload_pic'),
        'searchparams' => [
            'has'   => lang('Has'),
            'nohas' => lang('Nohas')
        ],
    ],
    //多图上传
    'pictures'=>[
        'doctrineType' => ['type'=>'text'],
        'langstr'=>lang('Upload_pic_s'),
        'searchparams' => [
            'has'   => lang('Has'),
            'nohas' => lang('Nohas')
        ],
    ],
    //上传附件
    'file'=>[
        'doctrineType' => ['type'=>'text'],
        'langstr'=>lang('Upload_att'),
        'searchparams' => [
            'has'   => lang('Has'),
            'nohas' => lang('Nohas')
        ],
    ]
);