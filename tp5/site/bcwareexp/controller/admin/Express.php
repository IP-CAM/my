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
// | 快递公司  Version 1.0  2016/3/13
// +----------------------------------------------------------------------
namespace app\bcwareexp\controller\admin;

use app\admin\controller\Admin;
use app\bcwareexp\model\Express as ExpressModel;

class Express extends Admin
{
    /**
     * @Mark:导入
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/5
     */
    public function import()
    {
        if ($this->request->isPost()) {
            //TODO
            
            
        } else {
            $this->assign('meta_title', lang('import') . lang('Express'));
            return $this->fetch();
        }
    }
    
    /**
     * @Mark:导出
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/5
     */
    public function export()
    {
        $ids = $this->request->post('ids/a');
        empty($ids) && $this->error(lang('Exportsnoselect'));
        
        if ($this->request->isPost()) {
            //本段为演示代码
            $header = ['用户ID', '登录IP', '登录地点', '登录浏览器', '登录操作系统', '登录时间'];
            $data   = Db::name("LoginLog")->field("id", true)->order("id desc")->limit(20)->select();
            if ($error = \common\Excel::export($header, $data, "示例Excel导出", '2007')) {
                throw new Exception($error);
            }
        }
        
        $this->assign('meta_title', lang('export') . lang('Express'));
        return $this->fetch();
    }
    
    /**
     * @Mark:修改单条记录
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/10/25
     */
    public function edit()
    {
        $param  = $this->request->param();
        $ids    = isset($param['ids']) ? $param['ids'] : '';
        empty($ids) && $this->error(lang('Error_id')) ;
        
        
        $data   = ExpressModel::get($ids);
        if($data===null){
            $this->error(lang('Error_id'));
        }
        
        // 获取快递公司
        $express = get_config('bcwareexp','express');
        $this->assign('express',$express);
    
        $this->assign("data", $data);
        
        $this->assign("meta_title", lang('Edit') . lang($this->conDb));
        return $this->fetch();
    }
    
    /**
     * @Mark:新增
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/10/25
     */
    public function add(){
        // 获取快递公司
        $express = get_config('bcwareexp','express');
        $this->assign('express',$express);
        $this->assign("meta_title", lang('Addnew'). lang($this->conDb));
        $this->assign("data", null);
        return $this->fetch($this->edittpl);
    }
    
    
}
