<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Shideshow.php  Version 2017/9/19
// +----------------------------------------------------------------------

namespace app\seller\controller;

use app\seller\model\Slideshow as SlideshowModel;
use think\Session;
use app\seller\service\Slideshow as SlideshowApi;


class Shideshow extends Common
{
    /**
     * @Mark:添加轮播图
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/9/19
     */
    public function add()
    {
        $this->assign('data',null);
        return $this->fetch('edit');
    }
    
    /**
     * @Mark:保存
     * @Author: yang <502204678@qq.com>
     * @Version 2017/9/19
     */
    public function savedata()
    {
        $param = $this->request->param();
        $param['seller_id'] = SellerId;
        $data = [
            'model'=>'Slideshow',
            'value'=>$param,
        ];
        if (isset($param['id'])) $data['pk']='id';
        $res = SlideshowApi::savedata($data);
        if ($res['code'] == 1) {
            if (isset($param['id'])) {
                $log_info = '修改轮播图。轮播图ID：'.$param['id'].'操作人:' . Session::get('sellername');
            } else {
                $log_info = '新增轮播图。操作人:' . Session::get('sellername');
            }
            seller_log(SellerId, Session::get('userid'), $log_info);
            $this->success($res['msg'],'seller/shop/index');
        } else {
            $this->error($res['msg']);
        }
    }
    
    /**
     * @Mark:删除
     * @Author: yang <502204678@qq.com>
     * @Version 2017/9/23
     */
    public function del()
    {
        $param = $this->request->param();
        $re = SlideshowModel::where(['id'=>['in',(array)$param['ids']]])->delete();
        if ($re) {
            $log_info = '删除轮播图。轮播图ID：'.implode(',',(array)$param['ids']).'操作人:' . Session::get('sellername');
            seller_log(SellerId, Session::get('userid'), $log_info);
            $this->success(lang('del_success'));
        } else {
            $this->success(lang('del_fail'));
        }
    }
    
    /**
     * @Mark:编辑
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/9/27
     */
    public function edit()
    {
        $ids = $this->request->param('ids');
        $data = SlideshowModel::get($ids);
        $this->assign('data',$data);
        return $this->fetch();
    }
}
