<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Enter.php  Version 2017/4/2 入驻申请
// +----------------------------------------------------------------------
namespace app\seller\controller\admin;

use app\admin\controller\Admin;
use app\seller\service\Seller;
use think\Request;
use app\bcwareexp\service\Crossware as CrosswareApi;

class Enter extends Admin
{
    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
        $this->conDb = 'Store';
        $option = \app\seller\service\Shopcat::catList(['status' => 1]);
        $this->assign('option', $option);
    }
    
    /**
     * @Mark:商户申请列表
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/25
     * @return mixed
     */
    public function index()
    {
        $param              = $this->request->param();
        $this->index_where  = ['status' => 2];
    
        $name               = isset($param['name']) ? $param['name'] : '';
        $start_time         = isset($param['start_time']) ? $param['start_time'] : '';
        $end_time           = isset($param['end_time']) ? $param['end_time'] : '';
    
        $name               ? $this->index_where['seller_name|true_name|bank_name|mobile'] = ['like', '%' . trim($param['name']) . '%'] : '';
    
        $start_time         ? $this->index_where['create_time'] = ['>=', strtotime($start_time)] : '';
        $end_time           ? $this->index_where['create_time']   = ['<=', strtotime($end_time)] : '';
    
        //同时具备时
        if($start_time && $end_time)
        {
            $this->index_where['create_time'] = ['between' => [$start_time, $end_time]];
        }
        
        $list = Seller::sellerList($this->index_where);
        $this->assign('list', $list);
        $this->assign("meta_title", lang('Enterapply'));
        return $this->fetch();
    }
    
    /**
     * @Mark:覆盖父类  商户编辑
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/22
     * @return mixed
     */
    public function savedata()
    {
        $data = $this->request->param();
        $re = Seller::aditSeller($data);
        if ($re['code'] == 1) {
            //新建默认仓
            $res = CrosswareApi::create_default_crossware($data['id']);
            if ($res['code']) {
                $this->success(lang('successful'), $this->jumpUrl);
            } else {
                return json($res);
            }
        } else {
            return json($re);
        }
    }
}