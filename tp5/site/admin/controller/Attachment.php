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
// | Attachment.php  Version 1.0  2017/7/23 附件管理
// +----------------------------------------------------------------------
namespace app\admin\controller;

use app\admin\service\Attachment as Attapi;

class Attachment extends Admin
{
    /**
     * @Mark:首页
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/9/20
     */
    public function index()
    {
        $index_map = [];
        $param     = $this->request->param();

        $type       = isset($param['type']) ? trim($param['type']) : '';   //图片类型
        $name       = isset($param['name']) ? trim($param['name']) : '';   //搜索词
        $apps       = isset($param['apps']) ? trim($param['apps']) : '';     //所属模块
        $start_time = isset($param['start_time']) ? trim($param['start_time']) : ''; //时间开始
        $end_time   = isset($param['end_time']) ? trim($param['end_time']) : '';     //时间结束
    
        $name       ? $index_map['name|type'] = ['like', '%' . $name . '%'] : '';
        $start_time ? $order_map['create_time'] = ['>=', strtotime($start_time)] : '';
        $end_time   ? $order_map['create_time'] = ['<=', strtotime($end_time)] : '';
        if ($type && $type <> 'all') $order_map["type"]     = ["=", $type];
        if ($apps && $apps <> 'all') $order_map["module"]   = ["=", $apps];
        
        //获取附件类型
        $option   = explode(',', \think\Config::get('kernel.atttypes'));
        
        $lists = Attapi::getlist($this->conDb, $index_map, $this->desc);
        $this->assign('list', $lists['list']);
        $this->assign('page', $lists['page']);
        $this->assign('_total', $lists['total']);
        $this->assign ("meta_title", lang('Attachment'));
        $this->assign ("type", $type);
        $this->assign ("apps", $apps);
        return $this->fetch();
    }
    
    /**
     * @Mark:附件上传功能
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/5/23
     */
    public function add()
    {
        return $this->img();
    }
    
    /**
     * @Mark:删除图片
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/19
     */
    public function delete()
    {
    
    }
}