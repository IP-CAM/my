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
// | 所有配置器父类  Version 2017/1/18
// +----------------------------------------------------------------------
namespace app\admin\controller;

use think\Lang;

class Setting extends Admin
{
    /**
     * @Mark:继承父类
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/1/18
     */
    public function _initialize()
    {
        error_reporting(E_ERROR | E_WARNING | E_PARSE);
        parent::_initialize();
        $modelConfPath = MODULE_PATH . DS . 'extra'. DS;
        if(!is_dir($modelConfPath)) @mkdir($modelConfPath, 0777, true);
        //加载语言包
        $langfile = RUNTIME_PATH . '/lang/extend_'.$this->lang.'.php';
        is_file($langfile) ? Lang::load($langfile) : $this->savecache();
    }
    
    /**
     * @Mark:默认操作 覆盖父类
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/1/18
     */
    public function index()
    {
        $Conf = MODULE_PATH . DS . 'extra'. DS . ACTION_NAME. '.php';

        $data = is_file(realpath($Conf)) ? include realpath($Conf) : null;
    
        $this->assign ("meta_title", lang($this->meta_title ? $this->meta_title : ACTION_NAME));
        $this->assign ('data', $data);
        return $this->fetch(ACTION_NAME);
    }
    
    /**
     * @Mark:保存数据
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/1/14
     */
    public function save()
    {
        if($this->request->isPost())
        {
            $act = $this->request->param('act');
            $conf = $this->request->post();
            $res = file_put_contents(MODULE_PATH . DS . 'extra'. DS . $act. '.php', "<?php \n".self::getnote()."\n\nreturn ".var_export($conf, 1).";\n");
            $res ? $this->success(lang('Save_ok')) : $this->error(lang('Save_error'));
        }else{
            $this->error(lang('Save_error'));
        }
    }
}