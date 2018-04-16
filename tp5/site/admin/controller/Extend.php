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
// | 扩展工具管理器  Version 1.0  2016/3/14
// +----------------------------------------------------------------------
namespace app\admin\controller;

use think\Lang;
use app\admin\model\Extend as Ext;

class Extend extends Admin
{
    private $version;  //版本信息

    /**
     * @Mark:初始化
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/7/29
     */
    public function _initialize()
    {
        parent::_initialize();
        //加载语言包
        $langfile = RUNTIME_PATH . '/lang/extend_'.$this->lang.'.php';
        is_file($langfile) ? Lang::load($langfile) : $this->savecache();
    }

    /**
     * @Mark:首页
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/7/29
     */
    public function index()
    {
        $param   = $this->request->param();
        $group   = isset($param['group']) ? trim($param['group']) : '';
        $extlist = $extend = $tmp_array = $currDir = array();
        $list = Ext::where('is_del', '=', '')->order('sort asc')->select();

        foreach($list as $ext){
            $ext['uninstall']		    =	0;
            $ext[$ext['subjection'].'_'.$ext['code']] = $ext['status'];
            $extlist[$ext['subjection'].'_'.$ext['code']]	    =	$ext;
        }
        $dir_list = scandir(EXTEND_PATH);
        
        foreach($dir_list as $key =>$dir)
        {
            if(is_file($dir)) continue;
            if ( $dir != ".." && $dir != "." && $dir != "common" && $dir != "lang" && $dir != ".svn" )
            {
                $extend[] = $dir;
            }
        }
    
        if(empty($group)){
            foreach($extend as $k =>$v) {
                //扫描目录下的文件
                $currDir = glob(EXTEND_PATH. $v.'/*.php');

                if($currDir)
                {
                    foreach($currDir as $ck => $file)
                    {
                        $f = basename($file);
                        $classname = substr($f,0,strrpos($f, '.'));
                        //import($v. '.'. $classname, EXTEND_PATH, '.php');
                        $extClass = "\\$v\\$classname";
                        $tmp_array[] = $extClass::setup();
                    }
                }
            }
        }else{
            $currDir = glob(EXTEND_PATH .$group . '/*.php');
            foreach($currDir as $ck => $file)
            {
                $f = basename($file);
                $classname = substr($f,0,strrpos($f, '.'));
                $extClass = "\\$group\\$classname";
                $tmp_array[] = $extClass::setup();
            }
        }

        foreach($tmp_array as $ks =>$value){

            $tmp_array[$ks]['subjection']  = strtolower($value['subjection']) ;
            $tmp_array[$ks]['uninstall']   = 0 ;
            $tmp_array[$ks]['lastver']     = '';
            $tmp_array[$ks]['status']      = 0 ;
            $tmp_array[$ks]['isshow']      = 0 ;
            //是否安装

            if(!empty($extlist[$value['subjection'] . '_' .$value['code']]))
            {

                $issubjection = $extlist[$value['subjection'] . '_' .$value['code']]['subjection'] == $value['subjection'];

                $iscode = $extlist[$value['subjection'] . '_' .$value['code']]['code'] == $value['code'];

                if($issubjection && $iscode)
                {

					$tmp_array[$ks]['id']      	= $extlist[$value['subjection'] . '_' .$value['code']]['id'];
                    //状态
                    $tmp_array[$ks]['status']      = $extlist[$value['subjection'] . '_' .$value['code']][$value['subjection'].'_'.$value['code']];
                    $tmp_array[$ks]['isshow']      = $extlist[$value['subjection'] . '_' .$value['code']]['isshow'];
                    $tmp_array[$ks]['uninstall']   = 1;
                    $tmp_array[$ks]['sort']      	= $extlist[$value['subjection'] . '_' .$value['code']]['sort'];
                }
            }

            //是否允许卸载
            $tmp_array[$ks]['allow_uninstall'] = empty($extlist[$value['code']]) ? 1 : $extlist[$value['code']]['allow_uninstall'];
        }

        $this->assign('list', $tmp_array);
        $this->assign ("meta_title", lang('Extend'));
        $this->assign ("group", $group);
        $this->assign ("extend", $extend);
        $this->assign ('_total', count($tmp_array));
        $this->assign ('_enable', count($list));
        return $this->fetch();
    }
    
    /**
     * @Mark:插件安装
     * @param $code string
     * @param $subjection string
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/5/9
     */
    public function install($code, $subjection)
    {
        $map = ['code' => $code, 'subjection' => $subjection];
        $this->check($map);  //检查依赖
        $extinfo      = Ext::where($map)->find();
        
        if($extinfo){
            $res =  Ext::where($map)->update([
                'version'       =>  $this->version,
                'status'        =>  1,
                'is_del'        =>  0,
                'update_time'   =>  time(),
            ]);
        }else{
            $res = Ext::insert([
                'code'              =>  $code,
                'subjection'        =>  $subjection,
                'version'           =>  $this->version,
                'status'            =>  1,
                'sort'              =>  0,
                'allow_uninstall'   =>  1,
                'is_del'            =>  0,
                'create_time'       =>  time(),
            ]);
        }

        $res ? $this->success(lang('Install_ext_ok')) : $this->error(lang('Install_ext_fail'));
    }

    /**
     * @Mark:卸载（软删除，非框架软删除）
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/10/19
     */
    public function uninstall($code, $subjection)
    {
        $map = ['code' => $code, 'subjection' => $subjection];
        $res =  Ext::where($map)->update([
            'version'      =>  '',
            'status'       =>  0,
            'is_del'       =>  time(),
            'isshow'       =>  0,
        ]);

        $res ? $this->success(lang('Uninstall_ext_ok')) : $this->error(lang('Uninstall_ext_fail'));
    }

    /**
     * @Mark:禁用
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/8/21
     */
    public function disable()
    {
        $param = $this->request->param();
        if(!isset($param['code']) || !isset($param['subjection']))
        {
            return json([
                'code'    => 0,
                'msg'     => lang('Code or subjection empty')
            ]);
        }
        
        $map = ['code' => trim($param['code']), 'subjection' => trim($param['subjection'])];
        $res =  Ext::where($map)->update([
            'status'       =>  0,
            'is_del'       =>  0,
            'isshow'       =>  0,
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
        $param = $this->request->param();
        if(!isset($param['code']) || !isset($param['subjection']))
        {
            return json([
                'code'    => 0,
                'msg'     => lang('Code or subjection empty')
            ]);
        }
        
        $map = ['code' => trim($param['code']), 'subjection' => trim($param['subjection'])];
        $this->check($map);  //检查依赖

        if(isset($param['isshow']) && $param['isshow'])
        {
            $res =  Ext::where($map)->update([
                'isshow'       =>  1,
                'status'       =>  1,
            ]);
        }else{
            $res =  Ext::where($map)->update([
                'status'       =>  1,
                'is_del'       =>  0,
            ]);
        }
        

        $res ? $this->success(lang('Enableok')) : $this->error(lang('Enableerror'));
    }

    /**
     * @Mark:配置插件/扩展
     * @param $code
     * @param $subjection
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/10
     */
    public function config()
    {
        $input = $this->request->param();
        $group = isset($input['group']) ? $input['group'] : '';
        
        if($this->request->isPost())
        {
            $data = $this->request->post();
    
            $map  = ['code' => trim($data['code']), 'subjection' => trim($data['subjection'])];
            $res  =  Ext::where($map)->update([
                'status'       =>  isset($data['status']) ? 1 : 0,
                'pc'           =>  isset($data['pc']) ? 1 : 0,
                'wap_app'      =>  isset($data['wap_app']) ? 1 : 0,
                'api'          =>  isset($data['api']) ? 1 : 0,
                'other'        =>  isset($data['other']) ? 1 : 0,
                'update_time'  =>  time(),
                'config'       =>  isset($data['setting']) ? serialize($data['setting']) : '',
            ]);
    
            $url = $data['jump'] ? base64_decode($data['jump']) : url('index', ['group'=>$group]);
            $res ? $this->success(lang('Conf setting ok'), $url) : $this->error(lang('Conf setting fail'), $url);
        }else{
            $code  = isset($input['code']) ? trim($input['code']) : '';
            $subj  = isset($input['subjection']) ? trim($input['subjection']) : '';
            if(empty($code) || empty($subj)) $this->error(lang('Error_id'));
    
            $jump  = isset($input['jump']) ? trim($input['jump']) : base64_encode(url('index', ['group'=>$group]));
            
            $map = ['code' => $code, 'subjection' => $subj];
            list($path, $classname) = array($map['subjection'], $map['code']);
            import($path. '.'. $classname, EXTEND_PATH, '.php');
            $extClass = "\\$path\\$classname";
    
            $extSetup = $extClass::setup();

            $data   = Ext::where($map)->find();
            $config = $this->return_extend_input_config($extSetup, empty($data['config']) ? $data['config'] : unserialize($data['config']));

            $this->assign ("meta_title", lang($extSetup['name']). lang('Config'));
            $this->assign ('jump', $jump);
            $this->assign ('data', empty($data) ? null : $data);
            $this->assign ('extSetup', $extSetup);
            $this->assign ('config', $config);
            return $this->fetch();
        }
    }

    /**
     * @Mark:返回扩展配置项
     * @param array $extSetup
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/4/16
     */
    private function return_extend_input_config( $extSetup = [], $data = null)
    {
        $config = array();
        $output = '' ;
        foreach ($extSetup['config'] as $key => $v){
            $min = isset($v['min']) ? ' min="'.$v['min'].'"' : '' ;
            $max = isset($v['max']) ? ' max="'.$v['max'].'"' : '' ;
            $len = isset($v['length']) ? ' style="width:'.$v['length'].'px"' : '' ;
            $tip = isset($v['tip']) ? ' placeholder = "'. lang($v['tip']) .'"': '';
            switch ($v['type']){
                case 'string':
                    $suffix = isset($v['suffix']) ? $v['suffix'] : '';
                    $value  = isset($data[$key]) ? $data[$key] : (isset($v['default']) ? $v['default'] : '');
                    $output =  '<input type="text" name=setting['.$key .']'. ' id=setting['.$key .']'. ' value="'.$value.'" '.$len. $tip .' />' . $suffix . '';
                    break;
                case 'number':
                    $suffix = isset($v['suffix']) ? $v['suffix'] : '';
                    $value = isset($data[$key]) ? $data[$key] : (isset($v['default']) ? $v['default'] : '');
                    $output =  '<input type="number" name="setting['.$key .']"'. ' id="setting['.$key .']"'. ' value="'.$value.'" '.$min. $len . $tip .' class="input small" '.$len.'/> ' . $suffix . '';
                    break;
                case 'time':
                    $suffix = isset($v['suffix']) ? $v['suffix'] : '';
                    $value = isset($data[$key]) ? $data[$key] : (isset($v['default']) ? $v['default'] : '');
                    $output =  '<input type="text" name="setting['.$key .']"'. ' id="setting['.$key .']"'. ' value="'.$value.'"  class="w140c green datainput" /> ' . $suffix . '';
                    break;
                case 'radio':
                    $output = '<div class="bset">';
                    if(isset($v['option']))
                    {
                        foreach ($v['option'] as $k => $item)
                        {
                            $checked = ((isset($data[$key]) && $data[$key] == $item)) ? 'checked': '';
                            $output .=  '<input type="radio" value="'. $item .'" '.$checked.' name = setting['.$key .'] id = '.$key .'_'. $k .'  /><label for='.$key .'_'. $k .' class="w110_r_0">'.$k.'</label>';
                        }
                    }
                    $output .=  '</div>';
                    break;
                case 'checkbox':
                    $output = '<div class="bset">';
                    if(isset($v['option']))
                    {
                        foreach ($v['option'] as $k => $item)
                        {
                            $checked = ((isset($data[$key]) && $data[$key] == $item)) ? 'checked': '';
                            $output .=  '<input type="checkbox" value="'. $item .'" '.$checked.' name = setting['.$key .'] id = '.$key .'_'. $k .'  /><label for='.$key .'_'. $k .' class="w120_r_0">'.$k.'</label>';
                        }
                    }
                    $output .=  '</div>';
                    break;
                case 'select':
                    $suffix = isset($v['suffix']) ? $v['suffix'] : '';
                    $output  =  '<select name=setting['.$key .']'. ' id=setting['.$key .']'.  $len . ' style="padding-right:15px;">';
                    $output .= '<option>'. lang('Pleaseselect').'</option>';
                    if(isset($v['option']))
                    {
                        foreach ($v['option'] as $k => $item) {
                            if(isset($data[$key]))
                            {
                                $selected = ((isset($data[$key]) && $data[$key] == $item)) ? 'selected': '';
                                $output .=  '<option value="'. $item .'" '.$selected.'>'. $k .'</option>';
                            }else{
                                $selected = ((isset($v['default']) && $v['default'] == $item)) ? 'selected': '';
                                $output .=  '<option value="'. $item .'" '.$selected.'>'. $k .'</option>';
                            }
                        }
                    }
                    $output .=  '</select>'. $suffix;
                    break;
                case 'html':
                    $suffix = isset($v['suffix']) ? $v['suffix'] : '';
                    $output  =  '<textarea name=setting['.$key .']'. ' id=setting['.$key .']'. '>'.$data[$key].'</textarea>'. $suffix;
                    break;
            }

            $config[] = [
                'title'     =>  lang($v['title']),
                'code'      =>  $extSetup['code'],
                'name'      =>  $key,
                'output'    =>  $output,
                'validate'  =>  isset($v['validate']) ? $v['validate'] : '',
            ];
        }

        return $config;
    }

    /**
     * @Mark:扩展市场
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/8/3
     */
    public function market()
    {
        $this->assign('list', '');
        $this->assign ("meta_title", lang('Store'));
        $this->assign ('_installed', 1000);
        $this->assign ('_total', 1000);
        $this->assign ('_waitup', 10);
        return $this->fetch();
    }

    /**
     * @Mark:检查扩展
     * @param array $map 扩展说明；
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/1
     */
    private function check(&$map)
    {
        list($path, $classname) = array($map['subjection'], $map['code']);
        import($path. '.'. $classname, EXTEND_PATH, '.php');
        $extClass = "\\$path\\$classname";
        $extSetup = $extClass::setup();
        $this->version = $extSetup['version'];  //代码版本
        $extinfo      = Ext::where($map)->find();
        //检查版本信息
        if(version_compare ($this->version , $extinfo['version']) >=  0){
            return true;
        }else{
            $err[] = lang('Need'). $extinfo['version'] . ' '. $this->version;
        }
    }

    /**
     * @Mark:升级功能弹窗
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/10/31
     */
    public function upgradeto()
    {
        $param      = $this->request->param();
        $code       = isset($param['code']) ? trim($param['code']) : '';
        $url        = isset($param['url']) ? trim($param['url']) : '';
        $ver        = isset($param['ver']) ? trim($param['ver']) : '';
        $subjection = isset($param['subjection']) ? trim($param['subjection']) : '';
        $istrue     = isset($param['istrue']) ? trim($param['istrue']) : '';
        if($istrue){
            $this->assign ('code', $code);
            $this->assign ('url', $url);
            $this->assign ('ver', $ver);
            $this->assign ('subjection', $subjection);
        }
        return $this->fetch();
    }

    /**
     * @Mark:升级处理过程
     * @return string|\think\response\Json
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/2/16
     */
    public function upgrade()
    {
        $param      = $this->request->param();
        //步骤
        $setup     = isset($param['setup']) ? trim($param['setup']) : '';
        //子步骤
        $n         = isset($param['setup']) ? trim($param['setup']) : '';
        //插件目录
        $subjection= isset($param['subjection']) ? trim($param['subjection']) : '';
        //插件名
        $name      = isset($param['name']) ? trim($param['name']) : '';
        //版本号
        $ver       = isset($param['ver']) ? trim($param['ver']) : '';
        //升级文件下载地址
        $url       = isset($param['url']) ? trim($param['url']) : '';
        $urlcode   = $this->httpcode(base64_decode($url));

        $path = EXTEND_PATH . $subjection . DS . '~tmp'; //升级文件临时存放目录
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
                    \think\Session::set($subjection . '_' . $name. '_file', $remoteJson);
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
                $remoteFile = \think\Session::get($subjection . '_' . $name. '_file');
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
                if(!$this->moveFolder($path, EXTEND_PATH)){
                    return json([
                        'setup' => -2,
                        'n'     => $n,
                        'msg'   => lang('Release file', ['code'=> lang('Fail')])
                    ]);
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
                //删除Session
                \think\Session::set($subjection . '_' . $name. '_file', null);
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