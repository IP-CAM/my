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
// | 控制器  Version 2017/1/23
// +----------------------------------------------------------------------
namespace app\bigdata\controller\admin;

use app\admin\controller\Admin;
use app\bigdata\service\Persion as PersionModel;

class Index extends Admin
{
    /**
     * @Mark:个人信息
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/2
     */
    public function index()
    {
        $index_map  = ['status' => ['<', 2]];
        //查询条件
        $param      = $this->request->param();
        $name       = isset($param['name']) ? trim($param['name']) : '';     //关键字
        $start_time = isset($param['start_time']) ? trim($param['start_time']) : ''; //开始时间
        $end_time   = isset($param['end_time']) ? trim($param['end_time']) : '';     //结束时间
    
        $name       ? $index_map['seller_name|true_name|bank_name|mobile'] = ['like','%'. $name .'%'] : '';
        //按时间查询
        $start_time ? $index_map['create_time'] = ['>=', strtotime($start_time)] : '';
        $end_time   ? $index_map['create_time'] = ['<=', strtotime($end_time)] : '';
    
        //同时具备时
        if($start_time && $end_time)
        {
            $index_map['create_time'] = [
                ['>=', strtotime($start_time)],
                ['<=', strtotime($end_time)],
                'AND'
            ];
        }
        
        $list = PersionModel::allList($index_map);
        $this->assign('list', $list);
        $this->assign("meta_title", lang('Person'));
        return $this->fetch();
    }
}
