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
// | 客服系统配置  Version 1.0  2016/3/13
// +----------------------------------------------------------------------
namespace app\im\controller\admin;
use app\admin\controller\Admin;

class Quesconf extends Admin
{
    /**
     * @Mark:继承
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/7
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->conDb = 'worksheet';
    }
    
    /**
     * @Mark:问题列表
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/25
     */
    public function index()
    {
        //降低报错级别 by theseaer start 2017/1/14
        error_reporting(E_ERROR | E_WARNING | E_PARSE);
        $Conf = MODULE_PATH .DS. MODULE_NAME. '.php';
        if(is_file(realpath($Conf)))
        {
            $data = include realpath($Conf);
        }else{
            $data = null;
        }
    
        $this->assign ("meta_title", lang('Quesconf'));
        $this->assign ('data', $data);
        return $this->fetch();
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
            $conf = $this->request->post();
            $conf['invoicestatus']	= array_key_exists('invoicestatus', $conf) ? $conf['invoicestatus'] : 0;
            $conf['disstatus'] 		= array_key_exists('disstatus', $conf) ? $conf['disstatus'] : 0;
            $conf['sitestatus'] 	= array_key_exists('sitestatus', $conf) ? $conf['sitestatus'] : 0;  //临时，后面要改
            $conf['pointstatus'] 	= array_key_exists('pointstatus', $conf) ? $conf['pointstatus'] : 0;
            $conf['deductionstatus']= array_key_exists('deductionstatus', $conf) ? $conf['deductionstatus'] : 0;
            $conf['dis']			= array_key_exists('dis', $conf) ? $conf['dis'] : 0;
            $conf['dismodel']		= array_key_exists('dismodel', $conf) ? $conf['dismodel'] : 0;
    
            $res = file_put_contents(MODULE_PATH .DS. MODULE_NAME. '.php', "<?php \n".self::getnote()."\n\nreturn ".var_export($conf, 1).";\n");
    
            $res ? $this->success(lang('Save_ok')) : $this->error(lang('Save_error'));
        }else{
            $this->error(lang('Save_error'));
        }
    }
}