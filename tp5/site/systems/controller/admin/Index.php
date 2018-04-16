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
// | 日志  Version 1.0  2016/3/13
// +----------------------------------------------------------------------
namespace app\systems\controller\admin;
use app\admin\controller\Admin;

class Index extends Admin
{
    
    
    public function actionlog(){
        $this->assign ("meta_title", lang('Actionlog'));
        // 模板输出
        return $this->fetch();
    }

    /**
     * @Mark:管理操作日志
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/10/22
     */
    public function adminlog(){
        $this->assign ("meta_title", lang('Adminlog'));
        // 模板输出
        return $this->fetch();
    }

    /**
     * @Mark:API日志
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/10/22
     */
    public function apilog(){
        $this->assign ("meta_title", lang('Apilog'));
        return $this->fetch();
    }

    /**
     * 查看行为日志
     */
    public function view($ids = 0){
        empty($ids) && $this->meta_title = lang('Varerror');
        $info = M('ActionLog')->field(true)->find($id);
        $this->assign('info', $info);
        $this->meta_title = lang('Viewactionlog');
        $this->display();
    }

    public function clear(){
        $msg = array(
            'success'   =>lang('Deleteok'),
            'error'     =>lang('Deleteerror'),
            'url'       =>'' ,
            'ajax'      =>1
        );
        
        if (!input('?param.ids')) {
            $status =  \think\Db::name('ActionLog')->where('1=1')->delete();
            if ($status!==false) {
                $this->success($msg['success'],$msg['url'],$msg['ajax']);
            } else {
                $this->error($msg['error'],$msg['url'],$msg['ajax']);
            }
        }else{
            $map = array('id' => array('in', input('post.ids/a')) );
            $status =  \think\Db::name('ActionLog')->where($map)->delete();
            if ($status!==false) {
                $this->success($msg['success'],$msg['url'],$msg['ajax']);
            } else {
                $this->error($msg['error'],$msg['url'],$msg['ajax']);
            }
        }

    }

    public function index(){
        $option = array(
            0 => lang('Allorders'),
            1 => lang('Completed'),
            2 => lang('Paid'),
            3 => lang('To_be_confirmed'),
            4 => lang('To_be_paid'),
            5 => lang('To_be_shipped'),
            6 => lang('Paymenting'),
            7 => lang('Return'),
        );
        $this->assign ("meta_title", lang('Useraction'));
        $this->assign ("option", $option);
        $this->assign ("list", '');
        return $this->fetch();
        /*$Useraction = $this->lists('action',array(),'id desc');
        int_to_string($Useraction,array('type'=>array(1=>lang('systemsaction'),2=>lang('Useraction'))));
        $this->assign('langist',$Useraction);
        $this->meta_title = lang('Useraction');*/
    }

    //用户动作删除
    public function deletelog(){
        $this->controller_name = 'ActionLog';
        parent::delete();
    }

    //用户动作删除
    public function deleteaction(){
        $this->controller_name = 'Action';
        parent::delete();
    }
    
}