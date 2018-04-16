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
// | 注册相关配置  Version 1.0  2016/3/13
// +----------------------------------------------------------------------
namespace app\common\behavior;

use think\Config;
use think\Request;
use think\Cookie;

class Regconf
{
    /**
     * @Mark:注册系统配置：模块语言，模板切换功能
     * @param $content
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/2/6
     */
    public function run(&$content){
        /*该方法写为行为的原因：防止API返回不同语言的数据 by theseaer start 2017/2/15 */
        $langList = \app\common\controller\Base::getLanguageList();
        //设置允许语言列表
        Config::set('lang_list', implode(",", array_keys($langList)));
        /*该方法写为行为的原因：防止API返回不同语言的数据 by theseaer end 2017/2/15 */
        
        $request    = Request::instance();
        $module     = $request->module();
        $controller = $request->controller();

        if(stripos($controller, 'admin') !== false || strtolower($module) == 'admin') {
            $is_mob_tpl = '';
        }elseif($request->has('__theme__') && $request->has('__skin__')) {
            $theme  = $request->param('__theme__') ;
            $skin   = $request->param('__skin__') ;
            Cookie::set($module. '_theme_skin', $theme . '|' . $skin, 3600);
            $is_mob_tpl = $theme . '/'. $skin . '/';
        }elseif(Cookie::get($module. '_theme_skin')){
            $is_mob_tpl = str_replace('|', '/', Cookie::get($module. '_theme_skin')) . '/';
        }elseif($request->isMobile()){
            $is_mob_tpl = Config::get('theme.mobile'). '/' .Config::get('skin.mobile'). '/';
        }else{
            $is_mob_tpl = Config::get('theme.pc'). '/' .Config::get('skin.pc'). '/';
        }
        define('MOBTPL', $is_mob_tpl);
        //根据模块名称和来访设备类型重置模版路径设置
        Config::set('template.view_path', APP_PATH . $module .'/view/' . $is_mob_tpl);
        
    }
}