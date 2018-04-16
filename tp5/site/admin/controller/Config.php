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
// | Config.php  Version 1.0  2016/3/14
// +----------------------------------------------------------------------
namespace app\admin\controller;
use common\PhpMailer;

class Config extends Setting
{
    
    /**
     * @Mark:配置项
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/9/20
     */
    public function index()
    {
        $Conf = MODULE_PATH . DS . 'extra'. DS . ACTION_NAME. '.php';
        $data = is_file(realpath($Conf)) ? include realpath($Conf) : null;
        $this->assign ("meta_title", lang('Siteset'));
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
            $act = $this->request->param('act');
            $act = $act ? $act : 'index';
            $conf = $this->request->post(false);
            
            switch ($act)
            {
                case 'index':
                    $conf['forpc']  = isset($conf['forpc']) ? $conf['forpc'] : 0;
                    $conf['forwap'] = isset($conf['forwap']) ? $conf['forwap'] : 0;
                    $conf['forapi'] = isset($conf['forapi']) ? $conf['forapi'] : 0;
                    $conf['site']   = isset($conf['site']) ? $conf['site'] : 0;
                    $conf['sms'] 	= isset($conf['sms']) ? $conf['sms'] : 0;
                    $conf['cnf'] 	= isset($conf['cnf']) ? $conf['cnf'] : 0;
                    $conf['water'] 	= isset($conf['water']) ? $conf['water'] : 0;
                    //$conf['']
                    break;
            }
            
            // 子域名
            if($conf['sub_domain_status']){
                if(trim($conf['main_domain'])==''){
                    $this->error(lang('main_domain_error'));
                }
            }else{
                $conf['main_domain'] = '';
            }
            
            
            $res = file_put_contents(MODULE_PATH . DS . 'extra'. DS . $act. '.php', "<?php \n".self::getnote()."\n\nreturn ".var_export($conf, 1).";\n");
            $res ? $this->success(lang('Save_ok')) : $this->error(lang('Save_error'));
        }else{
            $this->error(lang('Save_error'));
        }
    }
    
    /**
     * @Mark:邮件发送测试
     * @return \think\response\Json
     * @Author: yang <502204678@qq.com>
     * @Version 2017/8/21
     */
    public function email_test()
    {
        $test_email = \think\Config::get('test_email');
        $data = [
            'to_email'      =>  $test_email,
            'content'       =>  '<strong>This is a test Email</strong>'
        ];
        $re = PhpMailer::send($data);
        return json($re);
    }
    
    
}