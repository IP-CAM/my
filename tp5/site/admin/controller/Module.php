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
// | 应用管理中心  Version 1.0  2016/3/14
// +----------------------------------------------------------------------

namespace app\admin\controller;

use think\Session;
use app\admin\model\Module as Mod;

class Module extends Admin
{
    private $version;  //版本信息
	private $allow_uninstall;  //安装后是否允许卸载
    
    /**
     * @Mark:
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/7/29
     */
    public function index()
    {
        //parent::parseSchema('admin');
        $moduls = $app = $tmp_setting = $depends = array();
        $list = Mod::where('is_del', '=', '')->order('sort asc')->select();
        foreach($list as $modul){
            $modul['uninstall']		    =	0;
            $moduls[$modul['name']]	    =	$modul;
        }

        $staticPath = __ROOT__ . '/' . APP_NAME . '/';
        $files = array_map('realpath', glob(APP_PATH. DS .'*'));
        foreach($files as $key =>$file)
        {
            $setting = realpath($file . DS .'setting.php');
            if(is_file($setting)){
                $tmp_setting[] = include $setting;
            }
        }

        foreach($tmp_setting as $k =>$v) {
            //$Error = APP_PATH . strtolower($v['info']['name']) . DS . 'event' . DS . 'job' . DS;
            //if(!is_dir($Error))
            //{
                //mkdir(APP_PATH . strtolower($v['info']['name']) . DS . 'event' . DS . 'job' . DS , 0777, true);
                //dir_delete($Error);
                //file_put_contents($crontab, "<?php \n".self::getnote('定时任务描述文件')."\n\n\nreturn [\n\n\n];\n");
                //rename($push, APP_PATH . strtolower($v['info']['name']) . DS . 'dev' . DS . 'messager.php');
            //}
            $iconPath      = $staticPath . strtolower($v['info']['name']) . '/';
            $app[$k]['title']         = $v['info']['title'];              //菜单名
            $app[$k]['name']          = $v['info']['name'];               //菜单名
            $app[$k]['image']         = $iconPath. $v['info']['image'];   //图标
            $app[$k]['icon_color']    = $v['info']['icon_color'];
            $app[$k]['description']   = $v['info']['description'];        //介绍
            $app[$k]['author']        = $v['info']['author'];             //作者
            $app[$k]['website']       = $v['info']['website'];            //是否受权限控制
            $app[$k]['version']       = $v['info']['version'];            //版本
            $app[$k]['upgrade']       = $v['info']['upgrade'];            //升级地址
            $app[$k]['id']            = !empty($moduls[$v['info']['name']]) ? $moduls[$v['info']['name']]['id'] : '';
            $app[$k]['sort']          = !empty($moduls[$v['info']['name']]) ? $moduls[$v['info']['name']]['sort'] : 0;
            $app[$k]['status']        = !empty($moduls[$v['info']['name']]) ? $moduls[$v['info']['name']]['status'] : 0;                                //状态
    
            //已安装版本与代码版本是否一致
            $app[$k]['insver']       = !empty($moduls[$v['info']['name']]) ? ($moduls[$v['info']['name']]['version'] == $v['info']['version'] ? '' : $moduls[$v['info']['name']]['version']) : '';

            $app[$k]['uninstall']     = !empty($moduls[$v['info']['name']]) ? 1:0;//是否安装
            $app[$k]['allow_uninstall']= !empty($moduls[$v['info']['name']]) ? $moduls[$v['info']['name']]['allow_uninstall'] : 1;  //是否允许卸载
        }
        
        $this->assign('list', $app);
        $this->assign ("meta_title", lang('Module'));
        $this->assign ('_total',  count($app));
        $this->assign ('_enable',  count($list));
        return $this->fetch();
    }

    /**
     * @Mark:插件安装
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/8/6
     */
    public function install($name)
    {
        //检查依赖
        $depends = $this->check($name);
        if(false !== $depends){
            return json(['code' => 0, 'msg' => $depends ]);
        }
        
        $map = ['name' => ['eq', ucfirst($name)]];
        $appinfo      = Mod::where($map)->find();
        //解析数据库描述文件
        //parent::parseSchema($name);

        if($appinfo)
        {
            $res =  Mod::where($map)->update([
                'version'      =>  $this->version,
                'status'       =>  1,
                'is_del'       =>  0,
            ]);
        }else{
            $res = Mod::insert([
                'name'              =>  $name,
                'version'           =>  $this->version,
                'status'            =>  1,
                'sort'              =>  0,
                'allow_uninstall'   =>  $this->allow_uninstall,
                'is_del'            =>  0,
            ]);
        }
    
        //将定时任务写入表
        /*if(is_file(APP_PATH. $name . DS . 'crontab.php'))
        {
            $crontab = include APP_PATH. $name . DS . 'crontab.php';
            if($crontab)
            {
                foreach ($crontab as $key => $item)
                {
                    \think\Db::name('crontab')->insert([
                        'app'               =>  $name,
                        'class'             =>  $key,
                        'description'       =>  $item['description'],
                        'schedule'          =>  $item['schedule'],
                        'lasttime'          =>  0,
                        'status'            =>  1,
                    ]);
                }
            }
        }*/
        
        //安装成功后更新缓存
        $this->savecache();

        $res ? $this->success(lang('Install_app_ok')) : $this->error(lang('Install_app_fail'));
    }

    /**
     * @Mark:卸载（软删除，非框架软删除）
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/10/19
     */
    public function uninstall($name)
    {
        $map = ['name' => ['eq', ucfirst($name)]];
        $res =  Mod::where($map)->update([
            'version'      =>  '',
            'status'       =>  0,
            'is_del'       =>  time(),
        ]);
        
        $this->removedbschema($name);
        //卸载成功后更新缓存
        $this->savecache();

        $res ? $this->success(lang('Uninstall_app_ok')) : $this->error(lang('Uninstall_app_fail'));
    }

    /**
     * @Mark:检查依赖关系
     * @param $appName 模块名称
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/10/22
     */
    private function check($appName)
    {
        $setting = realpath(APP_PATH . strtolower($appName) . DS .'setting.php');
        if(is_file($setting)){
            $tmp_setting = include $setting;
        }else{
            $this->error(lang('No_setting_install'));
        }
        
        $this->version = $tmp_setting['info']['version'];
		$this->allow_uninstall = array_key_exists('afterunset', $tmp_setting['info']) ? $tmp_setting['info']['afterunset'] : 1;
		
        //检查依赖关系
        $err = array();
        if(array_key_exists('depends', $tmp_setting['info']))
        {
            foreach($tmp_setting['info']['depends'] as $k => $v){
                $depapp = Mod::where(['name' => $k, 'status' => 1])->find();
                if($depapp){
                    //检查版本信息
                    if(version_compare ($depapp['version'] , $v) >=  0){
                        continue;
                    }else{
                        $err[] = lang('Dependsapp', array('app' =>$k, 'ver' => $v));
                    }
            
                }else{
                    $err[] = lang('Dependsapp', array('app' =>$k, 'ver' => $v));
                }
            }
        }
		
		if(array_key_exists('extend', $tmp_setting['info']))
        {
            foreach($tmp_setting['info']['extend'] as $k => $v){
				list($subjection, $code) = explode('|', $k); 
				$map = ['subjection' => $subjection, 'code'=>$code, 'status' => 1];
                $depext = \think\Db::name('extend')->where($map)->find();
                if($depext){
                    //检查版本信息
                    if(version_compare ($depext['version'] , $v) >=  0){
                        continue;
                    }else{
                        $err[] = lang('Dependsext', array('app' =>$subjection.'/'. $code, 'ver' => $v));
                    }
            
                }else{
                    $err[] = lang('Dependsext', array('app' =>$subjection.'/'. $code, 'ver' => $v));
                }
            }
			
			if($err){
                return lang('No_depends', array('str' => implode('<br />',$err)));
			}
        }
        return false;
    }
    
    /**
     * @Mark:移除模块对应的数据
     * @param $appName
     * @return bool
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/7
     */
    private function removedbschema($appName)
    {
        return true;
    }

    /**
     * @Mark:应用市场
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/8/3
     */
    public function market()
    {
        $this->assign('list', '');
        $this->assign ("meta_title", lang('Appmarket'));
        $this->assign ('_total', 1000);
        $this->assign ('_installed', 5);
        $this->assign ('_waitup', 10);
        return $this->fetch();
    }

    /**
     * @Mark:禁用
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/8/21
     */
    public function disable()
    {
        $param   = $this->request->param();
        $appName = isset($param['name']) ? trim($param['name']) : '';
        $map = ['name' => ucfirst($appName)];
        $res =  Mod::where($map)->update([
            'version'           =>  '',
            'status'            =>  0,
            'status_time'       =>  time(),
        ]);

        $res ? $this->success(lang('Disableok')) : $this->error(lang('Disableerror'));
    }

    /**
     * @Mark:启用
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/8/21
     */
    public function enable()
    {
        $param   = $this->request->param();
        $appName = isset($param['name']) ? trim($param['name']) : '';
        $map = ['name' => ucfirst($appName)];
        $res =  Mod::where($map)->update([
            'version'           =>  $this->version,
            'status'            =>  1,
            'status_time'       =>  time(),
        ]);

        $res ? $this->success(lang('Enableok')) : $this->error(lang('Enableerror'));
    }
    
    /**
     * @Mark:升级弹出页面
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/10/31
     */
    public function upgradeto()
    {
        $param   = $this->request->param();
    
        $appName = isset($param['name']) ? trim($param['name']) : '';
        $url     = isset($param['url']) ? trim($param['url']) : '';
        $ver     = isset($param['ver']) ? trim($param['ver']) : '';
        $istrue  = isset($param['istrue']) ? trim($param['istrue']) : '';
        if($istrue){
            $this->assign ('app', $appName);
            $this->assign ('url', $url);
            $this->assign ('ver', $ver);
        }
        return $this->fetch();
    }
    
    /**
     * @Mark:升级处理过程
     * @param null $setup
     * @return string|\think\response\Json
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/2/19
     */
    public function upgrade()
    {
        $param   = $this->request->param();
        
        $setup   = isset($param['setup']) ? trim($param['setup']) : '';  //步骤
        $n       = isset($param['num']) ? trim($param['num']) : '';      //子步骤
        $name    = isset($param['name']) ? trim($param['name']) : '';    //模块名
        $ver     = isset($param['ver']) ? trim($param['ver']) : '';      //版本号
        $url     = isset($param['url']) ? trim($param['url']) : '';      //升级文件下载地址
        $urlcode = $this->httpcode(base64_decode($url));
    
        $path = APP_PATH . $name . DS . '~tmp'; //升级文件临时存放目录
        switch ($setup)
        {
            //检查升级地址
            case '0':
                if($urlcode == '200'){
                    $remoteJson = json_decode(file_get_contents(base64_decode($url)), true);
                    //权限不足时
                    if($remoteJson['response']['rsp'] == 'err')
                    {
                        return json([
                            'setup' => -1,
                            'n'     => $n,
                            'msg'   => lang('Connection succ but unallow')
                        ]);
                        break;
                    }
                    \think\Session::set($name. '_file', $remoteJson);
                    return json([
                        'setup' => 1,
                        'n'     => $n,
                        'msg'   => lang('Check url status', ['code' => '200 Ok !'])
                    ]);
                }else{
                    return json([
                        'setup' => -1,
                        'n'     => $n,
                        'msg'   => lang('Connection err', ['code' => $urlcode])
                    ]);
                }
                break;
            //创建临时目录存放升级文件；
            case '1':
                dir_delete($path); //清空目录
                if(!is_dir($path)){
                    mkdir($path, 0755, true);
                }
                return json([
                    'setup' => 2,
                    'n'     => $n,
                    'msg'   => lang('Create tmp dir')
                ]);
                break;
            //开始下载文件
            case '2':
                return json([
                    'setup' => 3,
                    'n'     => $n,
                    'msg'   => lang('Begin download files')
                ]);
                break;
            //遍历并下载文件
            case '3':
                //远程文件JSON
                $remoteFile = \think\Session::get($name. '_file');
                $counts = count($remoteFile['response'][''.$ver.'']);
                
                for ($i = $n; $i < $counts; $i++)
                {
                    $filename = basename($remoteFile['response'][''.$ver.''][$i]);
                    if (strtolower(trim(substr(strrchr($filename, '.'), 1, 10))) !== 'zip') break;
                    file_put_contents($path. '/'. $filename, file_get_contents($remoteFile['response'][''.$ver.''][$i]));
                    return json([
                        'setup' => 3,
                        'n'     => $i + 1,
                        'msg'   => lang('Download files', ['file'=>$filename]) . lang('Success')
                    ]);
                }
                return json([
                    'setup' => 4,
                    'n'     => 1,
                    'msg'   => lang('All file download succ')
                ]);
                break;
            //解压
            case '4':
                $zip = new \ZipArchive();
                //打开zip文档，如果打开失败返回提示信息
                if ($zip->open($path. '/'. $ver. '.zip') !== TRUE) {
                    return json([
                        'setup' => 5,
                        'n'     => $n,
                        'msg'   => lang('Could not open zip file', ['file'=> $ver. '.zip'])
                    ]);
                    break;
                }
                //将压缩文件解压到指定的目录下
                $zip->extractTo($path);
                //关闭zip文档
                $zip->close();
                @unlink($path. '/'. $ver. '.zip');
                return json([
                    'setup' => 5,
                    'n'     => $n,
                    'msg'   => lang('Unzip file')
                ]);
                break;
            //释放文件到目录
            case '5':
                if(!$this->moveFolder($path, str_replace(DS . 'public', '', getcwd()))){
                    return json([
                        'setup' => -2,
                        'n'     => $n,
                        'msg'   => lang('Release file', ['code'=> lang('Fail')])
                    ]);
                }
                print_r(glob($path . DS . 'schema/*.php'));
                exit;
    
                $tmpschema = array_map('realpath', glob($path . DS . 'schema/*.php'));
                print_r($tmpschema);
                exit;
    
                if($tmpschema)
                {
                    \think\Session::set($name. '_schema', $tmpschema);
                }
                
                dir_delete($path); //删除升级时的临时目录
                return json([
                    'setup' => 6,
                    'n'     => $n,
                    'msg'   => lang('Release file', ['code'=> lang('Success')])
                ]);
                break;
            //升级数据库
            case '6':
                if('' !== \think\Session::set($name. '_schema'))
                {
                    
                }
              
                
                return json([
                    'setup' => -1,
                    'n'     => $n,
                    'msg'   => lang('Upgrade succ', ['name'=> $name, 'version'=> $ver])
                ]);
                break;
            default:
                return json([
                    'setup' => -2,
                    'n'     => $n,
                    'msg'   => lang('Upgrade fail')
                ]);
                break;
        }
    }
    
    /**
     * @Mark:覆盖式移动文件或者文件夹
     * @param $source 源位置
     * @param $target 目标位置
     * @return bool
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/2/20
     */
    public function moveFolder($source, $target){
        if(!file_exists($source))return false; //如果源目录/文件不存在返回false
        //如果要移动文件
        if(filetype($source) == 'file'){
            $basedir = dirname($target);
            if(!is_dir($basedir))mkdir($basedir); //目标目录不存在时给它创建目录
            copy($source, $target);
            //unlink($source);
            
        }else{ //如果要移动目录
            
            if(!file_exists($target))mkdir($target); //目标目录不存在时就创建
            
            $files = array(); //存放文件
            $dirs = array(); //存放目录
            $fh = opendir($source);
            
            if($fh != false){
                while($row = readdir($fh)){
                    $src_file = $source . '/' . $row; //每个源文件
                    if($row != '.' && $row != '..'){
                        if(!is_dir($src_file)){
                            $files[] = $row;
                        }else{
                            $dirs[] = $row;
                        }
                    }
                }
                closedir($fh);
            }
            
            foreach($files as $v){
                copy($source . '/' . $v, $target . '/' . $v);
                //unlink($source . '/' . $v);
            }
            
            if(count($dirs)){
                foreach($dirs as $v){
                    $this->moveFolder($source . '/' . $v, $target . '/' . $v);
                }
            }
        }
        return true;
    }
}