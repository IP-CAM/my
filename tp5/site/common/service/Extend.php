<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Extend.php  Version 2017/7/23 扩展API
// +----------------------------------------------------------------------
namespace app\common\service;

use app\admin\service\Service;
use app\admin\model\Extend as ExtendModel;

class Extend extends Service
{
    /**
     * @Mark:返回已安装的插件
     * @param $data array
     * $data = [
     *    'subjection'  => 'seapays',  隶属分组
     *     PLATFORM     => 1, 平台参数
            'status'    => 1  插件是否启用参数
     * ];
     * @return array
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/8/23
     */
    static public function getExt(&$data)
    {
        $res = ExtendModel::where($data)->order('sort', 'ASC')->select();
        if(!$res)
        {
            return ['code' => 0, 'msg' => lang('Not find extend')];
        }
        return ['code' => 1, 'data' => $res , 'msg' => ''];
    }
    
    /**
     * @Mark: 返回已安装的插件，一个
     * @param $data
     * @return array
     * @Author: WangHuaLong
     */
    static public function getOneExt($data)
    {
        $res = ExtendModel::where($data)->order('sort','ASC')->find();
        if($res === null)
        {
            return ['code' => 0, 'msg' => lang('Not find extend')];
        }
        return ['code' => 1, 'data' => $res , 'msg' => ''];
    }
}