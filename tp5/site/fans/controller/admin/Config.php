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
// | Config.php  Version 2017/3/14
// +----------------------------------------------------------------------
namespace app\fans\controller\admin;

use app\admin\controller\Setting;

class Config extends Setting
{
    
    /**
     * @Mark:SNS平台设置
     * @return mixed
     * @Author: fancs
     * @Version 2017/6/2
     */
    public function index()
    {
        //$uid = [ 1 ];
        //\app\common\libs\Hook::call('Member' , 'registerSuccess', $uid);
        //系统原有hook调用方式
        //\think\Hook::listen('reg_after');          //注册成功后调用
        $Conf = MODULE_PATH . DS . 'extra'. DS . ACTION_NAME. '.php';
        $data = is_file(realpath($Conf)) ? include realpath($Conf) : null;
        $this->assign ("meta_title", lang('Memberconf'));
        $this->assign ('data', $data);
        return $this->fetch(ACTION_NAME);
    }
    
    /**
     * @Mark:保存数据
     * @Author: fancs
     * @Version 2017/6/2
     */
    public function save()
    {
        if($this->request->isPost())
        {
            $act = $this->request->param('act');
            $act = $act ? $act : 'index';
            $conf = $this->request->post();
            switch ($act)
            {
                case 'index':
                    $conf['circlestatus'] = array_key_exists('circlestatus', $conf)?$conf['circlestatus'] : 0;
                    $conf['iscomment']= array_key_exists('iscomment', $conf)?$conf['iscomment'] : 0;
                    break;
            }
            
            $res = file_put_contents(MODULE_PATH . DS . 'extra'. DS . $act. '.php', "<?php \n".self::getnote()."\n\nreturn ".var_export($conf, 1).";\n");
            $res ? $this->success(lang('Save_ok')) : $this->error(lang('Save_error'));
        }else{
            $this->error(lang('Save_error'));
        }
    }
    
}