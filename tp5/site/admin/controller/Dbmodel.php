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
// | Module  Version 1.0  2016/3/13
// +----------------------------------------------------------------------
namespace app\admin\controller;

use app\admin\model\Dbmodel as DbmodelModel;
use app\admin\service\Dbmodel as DbmodelApi;
use app\admin\model\Attribute as AttributeModel;
use think\db\Query;
use think\Request;

class Dbmodel extends Admin
{
    /**
     * @Mark:初始化
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/9/17
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->index_where  = '';
    }
    
    /**
     * @Mark:生成模型
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/19
     */
    public function generate(){
        
        if($this->request->isPost()){
            $param  = $this->request->post();
            !isset($param['table']) && $this->error(lang('Create_model_empty'));
            !isset($param['name']) && $this->error(lang('Name empty'));
            !isset($param['langstr']) && $this->error(lang('Langstr empty'));
            $res = DbmodelApi::generate($param);
            if($res['code'] == 1){
                $this->success(lang('Create_model_ok'),'index');
            }else{
                return json($res);
            }
        }else{
            //获取所有的数据表
            $tables = DbmodelApi::getTables();
            $this->assign('tables', $tables);
            $this->assign('meta_title', lang('Createmd'));
            return $this->fetch();
        }
    }
    
    /**
     * @Mark:保存数据
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/20
     */
    //public function savedata(){
    //    $data = $this->request->post();
    //    $validate = Loader::validate('admin','Dbmodel','validate');
    //    if(!$validate->check($data)){
    //        return json(['code' => 0, 'msg' => $validate->getError()]);
    //    }
    //    $res = $this->savedata();
    //    if(!$res){
    //        $this->error($this->dbmodel->getError(), 'index');
    //    }else{
    //        $this->success(empty($res[$this->field]) ? lang('Addnew_ok') : lang('Update_ok'), 'index');
    //    }
    //}
    
    /**
     * @Mark:删除一条数据
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/20
     */
    public function delete()
    {
        $param  = $this->request->param();
        empty((array)$param['ids']) && $this->error(lang('Error_id'));
        try {
            DbmodelApi::del_table((array)$param['ids']);
        } catch (\Exception $exception){
            $this->error($exception->getMessage());
        }
        $this->success(lang('Model_del_ok'),$this->jumpUrl);
    }
    
    /**
     * @Mark:导入
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/5
     */
    public function import()
    {
        if($this->request->isPost())
        {
            //TODO
            
        }else{
            $this->assign ('meta_title', lang('Import'));
            return $this->fetch();
        }
    }
	
	/**
     * @Mark:新增页面初始化
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/10/24
     */
    public function excute(){
        $param  = $this->request->param();
        //isswet($param['']) //TODO
        $this->assign ("meta_title", lang('Addnew_model'));
        $this->assign('data', null);
        return $this->fetch();
    }
    
    public function test()
    {
        $res = create_schame_file(9);
        dump($res);exit;
    }
}