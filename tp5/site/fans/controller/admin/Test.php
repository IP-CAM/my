<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: fancs
// +----------------------------------------------------------------------
// | Index  Version 1.0  2017/5/31 测试文件
// +----------------------------------------------------------------------
namespace app\fans\controller\admin;


use app\admin\controller\Admin;

class Test extends Admin
{
    /**
     * @Mark:测试addReportedType接口
     * @return string
     * @Author: fancs <theseaer@qq.com>
     * @Version 2017/5/31
     */
    public function test1(){
        $data=[
            'name'=>'aa',
            'description' =>'bb',
            'from'=>'cc'
            ];
        $res = \app\fans\service\Reported::saveReportedType($data);
        dump($res);exit();
    }
    
    /**
     * @Mark:测试addReportedType接口
     * @return string
     * @Author: fancs <theseaer@qq.com>
     * @Version 2017/5/31
     */
    public function test2(){
        $data=[
            'name'=>'aa',
            'description' =>'bb',
            'from'=>'cc'
        ];
        $res = \app\fans\service\Reported::undo($data);
        return $res;
    }
    /**
     * @Mark:测试deleteTopic接口
     * @return string
     * @Author: fancs <theseaer@qq.com>
     * @Version 2017/5/31
     */
    public function test3(){
        $data=[
            'title'=>'论程序猿的自我修养',
        ];
        $res = \app\fans\service\Topic::deleteTopic($data);
        return $res;
    }
    
}