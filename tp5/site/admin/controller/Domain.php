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
// | 域名管理  Version 1.0  2016/3/14
// +----------------------------------------------------------------------
namespace app\admin\controller;

use app\admin\model\Domain as DomainModel;


class Domain extends Admin
{
    /**
     * @Mark:继承
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/8/1
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->meta_title   =   lang('Domainsys');
    }
    
    /**
     * @Mark:获取控制器及方法
     * @return \think\response\Json
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/8/1
     */
    public function getapps()
    {
        $param = $this->request->param();
        $app        = isset($param['apps']) ? strtolower($param['apps']) : '';
        $controller = isset($param['controller']) ? $param['controller'] : '';
        
        //控制器为空时表示传递的是APP
        if(empty($controller))
        {
            $arrCont = array_map('basename', glob(APP_PATH. $app. DS . 'controller'. DS .'*.php'));
            $data = empty($arrCont) ? ['code' => 0, 'msg' => lang('No controller')] : ['code' => 1, 'msg' => $arrCont];
            return json($data);
        }
        
        
        //同时存在时
        if($app && $controller)
        {
            $path   = '\\app\\'. $app .'\\controller\\'.basename($controller, ".php");
            $mothed = get_class_methods($path);
            return json(['code' => 1, 'msg' => $mothed]);
        }
    }
    
    
    /**
     * @Mark: 保存子域名到数据库，与本地
     * @return \think\response\Json
     * @Author: WangHuaLong
     */
    public function savedata()
    {
        $input = $this->request->post();
        
        $domain = new DomainModel();
        
        if(!isset($input['status'])){
            $input['status'] = 0;
        }
        
        if(isset($input['id'])){
            $result = $domain->isUpdate(true)->save($input);
        }else{
            $result = $domain->isUpdate(false)->save($input);
        }
    
        $conf = DomainModel::where('status',1)->column('domain','model');
        
        
        // 保存域名设置到本地
        $res = file_put_contents(MODULE_PATH . DS . 'extra'. DS . 'sub_domain.php', "<?php \n"."\n\nreturn ".var_export($conf, 1).";\n");
        if(!$res){
            return json(['code' => 0, 'msg' => lang('Save_error')]);
        }
    
        
        if($result)
        {
            $this->success(lang('Save_ok'), url($this->jumpUrl));
        }
        
        return json(['code' => 0, 'msg' => lang('Save_error')]);
    }
}