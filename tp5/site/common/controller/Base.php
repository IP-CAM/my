<?php
// +----------------------------------------------------------------------
// | RuntuerCMF
// +----------------------------------------------------------------------
// | Copyright (c) 2016/3/10 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author theseaer <theseaer@qq.com>.
// +----------------------------------------------------------------------
// | Description : 后台基类
// +----------------------------------------------------------------------
namespace app\common\controller;

class Base extends Common
{
    
    /**
     * 为模块生成相应的语言包文件
     * @param $appName
     */
    static public function createLangDir($appName, $langList){
        //判断模块下的目录是否存在
        $LangPath = APP_PATH. $appName. DS .'lang';
        if(!is_dir($LangPath)){
            @mkdir($LangPath, 0777, true);
        }else{
            $langList = empty($langList) ? parent::getLanguageList() : $langList;
            //$langMap = self::getMappings();
            foreach($langList as $k =>$lang){
                if(\think\Config::get('default_lang') == $k) continue;
                if(is_file($LangPath.'/'.$k.'.php') ){
                    //存在则跳过
                    continue;
                }else{
                    //TODO 处理语言映射，减少重复语言包数量
                    file_put_contents($LangPath .DS. $k.'.php', "<?php \n".parent::getnote()."\n\nreturn [\n\n];\n");
                }
            }
        }
    }
}