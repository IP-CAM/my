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
// | 配置  Version 1.0  2016/3/13
// +----------------------------------------------------------------------
namespace app\seller\controller\admin;

use app\admin\controller\Setting;

class Config extends Setting
{
    
    
    /**
     * @Mark:注册协议
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/12/31
     */
    public function protocol()
    {
        $Conf = MODULE_PATH . DS . 'extra' . DS . ACTION_NAME . '.php';
        $data = is_file(realpath($Conf)) ? include realpath($Conf) : null;
        $this->assign('data', $data);
        $this->assign("meta_title", lang('Sprotocol'));
        return $this->fetch();
    }
    
    /**
     * @Mark:入驻申请
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/12/31
     */
    public function apply()
    {
        $this->assign("meta_title", lang('Shopapply'));
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
            $conf = $this->request->post();
            $conf['contents'] = html_entity_decode($conf['contents']);
            $res = file_put_contents(MODULE_PATH . DS . 'extra'. DS . $act. '.php', "<?php \n".self::getnote()."\n\nreturn ".var_export($conf, 1).";\n");
            $res ? $this->success(lang('Save_ok')) : $this->error(lang('Save_error'));
        }else{
            $this->error(lang('Save_error'));
        }
    }
}