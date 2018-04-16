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
// | 订单投诉  Version 1.0  2016/3/13
// +----------------------------------------------------------------------
namespace app\order\controller\admin;

use app\admin\controller\Admin;

class Complaint extends Admin
{
    /**
     * @Mark:售后申请列表
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/26
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->index_where = [];
        $this->assign('meta_title', lang('Complaint'));
    }
    
    /**
     * @Mark:关闭投诉
     * @return \think\response\Json
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/8/14
     */
    public function close()
    {
        $input          = $this->request->param();
        $ids            = isset($input['ids']) ? (array)$input['ids'] : '';
        empty($ids) && $this->error(lang('Noselect'));
        $this->status   = isset($input['pk']) ? $input['pk'] : $this->status;
        $this->pk       = isset($input['changeid']) ? $input['changeid'] : $this->pk;
        $this->conDb    = isset($input['db']) ? $input['db'] : $this->conDb;
        $map = array($this->pk => array('in', implode(',', $ids)));
    
        $data = [
            'model'     => $this->conDb,    //模型名
            'where'     => $map,            //需要改变的字段的条件
            'fields'    => $this->status,   //需要改变的字段名
            'val'       => 0                //需要改变的最终值
        ];
    
        try{
            $result =  Service::setFields($data);
        }catch(\Exception $e){
            return json(['code' => 0, 'msg' => $e->getMessage() ]);  //不刷新
        }
    
        if ($result['code']) {
            $this->success(lang('Disableok'), $this->jumpUrl);
        } else {
            $this->error(lang('Disableerror') . $result['code'], $this->jumpUrl);
        }
    }
    
    public function cancel()
    {
        $input          = $this->request->param();
        $ids            = isset($input['ids']) ? (array)$input['ids'] : '';
        empty($ids) && $this->error(lang('Noselect'));
        $this->status   = isset($input['pk']) ? $input['pk'] : $this->status;
        $this->pk       = isset($input['changeid']) ? $input['changeid'] : $this->pk;
        $this->conDb    = isset($input['db']) ? $input['db'] : $this->conDb;
        $map = array($this->pk => array('in', implode(',', $ids)));
    
        $data = [
            'model'     => $this->conDb,    //模型名
            'where'     => $map,            //需要改变的字段的条件
            'fields'    => $this->status,   //需要改变的字段名
            'val'       => 1                //需要改变的最终值
        ];
    
        try{
            $result =  Service::setFields($data);
        }catch(\Exception $e){
            return json(['code' => 0, 'msg' => $e->getMessage() ]);  //不刷新
        }
    
        if ($result['code']) {
            $this->success(lang('Disableok'), $this->jumpUrl);
        } else {
            $this->error(lang('Disableerror') . $result['code'], $this->jumpUrl);
        }
    }
}