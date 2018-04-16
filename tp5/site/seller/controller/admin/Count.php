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
// | Index  Version 1.0  2016/3/13
// +----------------------------------------------------------------------
namespace app\seller\controller\admin;

use app\admin\controller\Admin;
use app\seller\service\Count as CountModel;

class Count extends Admin
{
    
    /**
     * @Mark:结算处理列表
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/1
     */
    public function index()
    {
        $this->index_where = [];
        $status = input('status');
        if (input('status') && input('status') <> 'all') $this->index_where['status'] = $status;
        if (input('start_time')) $this->index_where['start_time'][] = ['>=', input('start_time')];
        if (input('end_time')) $this->index_where['start_time'][] = ['<=', input('end_time')];
        if (input('name')) $this->index_where['seller_name'] = ['like', '%' . input('name') . '%'];
        
        $data = CountModel::countList($this->index_where);
        $this->assign('list', $data);
        $this->assign("meta_title", lang('sCounts'));
        $this->assign('_total', $data->total());
        $this->assign('status', $status);
        return $this->fetch();
    }
    
    /**
     * @Mark:结算明细
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/1
     */
    public function detail()
    {
        $this->index_where = [];
        $status = input('status');
        if (input('status') && input('status') <> 'all') $this->index_where['status'] = $status;
        if (input('start_time')) $this->index_where['start_time'][] = ['>=', input('start_time')];
        if (input('end_time')) $this->index_where['start_time'][] = ['<=', input('end_time')];
        if (input('name')) $this->index_where['seller_name'] = ['like', '%' . input('name') . '%'];
        $data = CountModel::detailCount($this->index_where);
        $this->assign('list', $data);
        $this->assign("meta_title", lang('sDetail'));
        $this->assign('_total', $data->total());
        $this->assign('status', $status);
        return $this->fetch();
    }
    
    /**
     * @Mark:结算申请
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/1
     */
    public function createCount()
    {
        //测试数据--start
        $data = ['start_time' => '1200000000', 'end_time' => '1442144250'];
        //测试数据--end
        $re = CountModel::addCount($data);
        if ($re === true) {
            $this->success(lang('successful'), $this->jumpUrl);
        } else {
            return $re;
        }
    }
    
    /**
     * @Mark:确认结算
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/1
     */
    public function confirm()
    {
        $id = input('ids/a');
        $re = CountModel::editStatus($id);
        if ($re === true) {
            $this->success(lang('successful'), $this->jumpUrl);
        } else {
            return $re;
        }
    }
}