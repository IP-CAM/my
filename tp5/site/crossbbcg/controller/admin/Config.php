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
// | Config.php  Version 1.0  2016/3/13 配置器
// +----------------------------------------------------------------------
namespace app\crossbbcg\controller\admin;

use app\admin\controller\Setting;
use app\cms\model\Article as ArticleModel;

class Config extends Setting
{
    
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
        // 顶部协议文章
        $arr_info = [];
        $map = [
            'langid' => LANG,
            'status' => 1
        ];
        $articles = ArticleModel::where($map)->order('sort','asc')->select();
        if($articles!==null){
            $arr_info = $articles;
        }
        $this->assign('arr_info',$arr_info);
        
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
            $act = $act ? $act : 'index';
            $conf = $this->request->post();
            switch ($act)
            {
                case 'index':
                    $conf['invoicestatus']	= array_key_exists('invoicestatus', $conf) ? $conf['invoicestatus'] : 0;
                    $conf['omsstatus']	    = array_key_exists('omsstatus', $conf) ? $conf['omsstatus'] : 0;
                    $conf['disstatus'] 		= array_key_exists('disstatus', $conf) ? $conf['disstatus'] : 0;
                    $conf['sitestatus'] 	= array_key_exists('sitestatus', $conf) ? $conf['sitestatus'] : 0;  //临时，后面要改
                    $conf['pointstatus'] 	= array_key_exists('pointstatus', $conf) ? $conf['pointstatus'] : 0;
                    $conf['deductionstatus']= array_key_exists('deductionstatus', $conf) ? $conf['deductionstatus'] : 0;
                    $conf['dis']			= array_key_exists('dis', $conf) ? $conf['dis'] : 0;
                    $conf['dismodel']		= array_key_exists('dismodel', $conf) ? $conf['dismodel'] : 0;
                    $conf['site_footer_info']= htmlentities($conf['site_footer_info']);
                    $conf['checkout_protocol']= htmlentities($conf['checkout_protocol']);
                    break;
            }
            
            
            
            
            
			
            $res = file_put_contents(MODULE_PATH . DS . 'extra'. DS . $act. '.php', "<?php \n".self::getnote()."\n\nreturn ".var_export($conf, 1).";\n");
            if($res)
            {
                return json(['code' => 1, 'msg' => lang('Save_ok') ]);
                //$this->error(lang('Save_ok'));
            }else{
                return json(['code' => 0, 'msg' => lang('Save_error') ]);
            }
        }else{
            return json(['code' => 0, 'msg' => lang('Save_error') ]);
        }
    }
    
    /**
     * @Mark:线下店铺配置
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/12/7
     */
    public function offline()
    {
        $Conf = MODULE_PATH . DS . 'extra'. DS . ACTION_NAME. '.php';
        if(is_file(realpath($Conf)))
        {
            $data = include realpath($Conf);
        }else{
            $data = null;
        }
    
        $this->assign ("meta_title", lang('Offdisconf'));
        $this->assign ('data', $data);
        return $this->fetch();
    }

}
