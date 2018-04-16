<?php
// +----------------------------------------------------------------------
// | RuntuerCMF
// +----------------------------------------------------------------------
// | Copyright (c) 2016/3/10 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author theseaer <theseaer@qq.com>.
// +----------------------------------------------------------------------
// | 前端基类 Version 2017/2/8
// +----------------------------------------------------------------------
namespace app\common\controller;

use think\Db;
use think\Image;
use think\Request;
use think\Lang;
use think\Config;

class Home extends Common
{
    public $url;               //转向地址
    
    /**
     * @Mark:继承
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/15
     */
    public function _initialize()
    {
        parent::_initialize();
        
        $ui_Lang = RUNTIME_PATH . '/lang/ui_' . $this->lang . '.php';
        if (is_file(realpath($ui_Lang))) {
            Lang::load($ui_Lang); //加载合并后的语言包
        }
        //平台判断
        $platform = IS_WAP ? (IS_APP ? 'app' : (IS_WECHAT ? 'wechat' : 'wap_app')) : 'pc';
        define('PLATFORM', $platform);
    
        // 平台状态
        $platform_status = 'pc';
        if($platform == 'app'){
            $platform_status = 'api';
        }else if($platform == 'wechat'||$platform == 'mobile'){
            $platform_status = 'wap';
        }
        define('PLATFORM_STATUS', $platform_status . '_status');
        
        //前端语言包 by theseaer start 2017/7/10
        $ui_Lang = RUNTIME_PATH . 'lang' . DS . 'ui_' . $this->lang . '.php';
        if (!is_file($ui_Lang)) {
            $map['status'] = ['=', 1];
            $map['is_del'] = ['eq', ''];
            $install = Db::table('__ADMIN_MODULE__')->where($map)->order('sort asc')->column('name');
            $allinstall = array_merge(Config::get('can_use_not_install'), $install);
            $Tpllangset = [];
            foreach ($allinstall as $key => $value) {
                //加载前端模块下的语言文件
                $Tpllangs = APP_PATH . strtolower($value) . DS . 'view' . DS . MOBTPL . 'lang' . DS . $this->lang . '.php';
                if (is_file($Tpllangs)) {
                    $tmp_Tpllangs = include realpath($Tpllangs);
                } else {
                    continue;
                }
                if (empty($tmp_Tpllangs)) continue;
                
                foreach ($tmp_Tpllangs as $lk => $lv) {
                    $Tpllangset[$lk] = $lv;
                }
            }
            //生成合并后的语言包(前端)
            file_put_contents($ui_Lang, "<?php \n" . self::getnote() . "\n\nreturn " . var_export($Tpllangset, 1) . ";\n");
            //by theseaer end 2017/7/10
        }
        
        //加载当前主题下的语言包 by theseaer start 2017/7/3
        \think\Lang::load($ui_Lang);
    }
    
    /**
     * @Mark:处理空操作
     * @param Request $request
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/2/21
     */
    public function _empty(Request $request)
    {
        $controller = $request->controller();
        $action     = $request->action();
        $view       = new \think\View();
    
        return $view->fetch(MOBTPL. strtolower($controller). '/'. $action);
    }
    
    /**
     * @Mark:图片上传
     * @param Request $request
     * @return \think\response\Json
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/18
     */
    public function up($file,$to='')
    {
      
        if($file)
        {
            $config = get_config('admin','index');
            if($to){
                $info = $file->validate(['size'=>$config['attsize'] * 1024 * 1024, 'ext'=>$config['atttypes']])->move(ROOT_PATH . 'public/' . DS . 'uploads/'. DS . $to);
            }else{
                $info = $file->validate(['size'=>$config['attsize'] * 1024 * 1024, 'ext'=>$config['atttypes']])->move(ROOT_PATH . 'public/' . DS . 'uploads/'. DS . MODULE_NAME);
            }
            
            if($info){
                // 成功上传后 获取上传信息
                // 输出 jpg
                //echo $info->getExtension();
                // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                //echo $info->getSaveName();
                // 输出 42a79759f284b767dfcb2a0197904287.jpg
                //echo $info->getFilename();
                //图片处理
                $msg = [];
                $msg['uploadtime'] = $info->getATime();
                if($to){
                    $msg['url']=DS.'uploads'.DS.$to.DS.$info->getSaveName();
                }else{
                    $msg['url']=DS.'uploads'.DS.MODULE_NAME.DS.$info->getSaveName();
                }
                
                $msg['url'] = str_replace('\\','/',$msg['url']);
                $msg['type'] = $info->getExtension();
                $image = Image::open('.'.$msg['url']);
                
                $image->thumb($config['thuwidth'],$config['thuheight'])->save(substr('.'.$msg['url'],0,strpos('.'.$msg['url'],$msg['type'])-1).'_t'.'.'.$msg['type']);
                
                $image->thumb($config['smawidth'],$config['smaheight'])->save(substr('.'.$msg['url'],0,strpos('.'.$msg['url'],$msg['type'])-1).'_s'.'.'.$msg['type']);
                
                $image->thumb($config['midwidth'],$config['midheight'])->save(substr('.'.$msg['url'],0,strpos('.'.$msg['url'],$msg['type'])-1).'_m'.'.'.$msg['type']);
                
                $image->thumb($config['bigwidth'],$config['bigheight'])->save(substr('.'.$msg['url'],0,strpos('.'.$msg['url'],$msg['type'])-1).'_l'.'.'.$msg['type']);
                
                $width = $image->width();
                $height = $image->height();
                $type = $image->type();
                $mime = $image->mime();
                $size = $image->size();
                $msg['width']=$type;
                $msg['code'] = 1;
                $msg['msg'] = lang('Upload_success');
                return json($msg);
            }else{
                // 上传失败获取错误信息
                return json(['code'=>0,'msg'=>$file->getError()]);
            }
        }
    }
    
    /**
     * @Mark:多级地区下拉框
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/8/18
     */
    public function getarea()
    {
        $input      = $this->request->param();
        $attr       = isset($input['attr']) ? trim($input['attr']) : '';
        $pid        = isset($input['pid']) ? trim($input['pid']) : '';
        
        if($pid == '_NULL_')
        {
            return json(['code' => 0, 'msg' => '']);
        }
        
        switch ($attr)
        {
            case 'country':
                $res         = \app\bcwareexp\service\Country::get_country();
                break;
            case 'province':
                $mapCountry  = ['pid' => $pid];
                $Pid         = \app\bcwareexp\service\Area::get_area($mapCountry)->toArray();
                $data        = [];
                foreach ($Pid as $v){
                    $mapP    = ['pid' => $v['id']]; //获取省份
                    $data[] = \app\bcwareexp\service\Area::get_area($mapP)->toArray();
                }
                
                //转化为二维数组
                $province = [];
                foreach ($data as $val){
                    foreach ($val as $value){
                        $province[] = $value;
                    }
                }
                
                $res         = $province;
                break;
            case 'city':
                $mapProvince  = ['pid' => $pid];
                $res = \app\bcwareexp\service\Area::get_area($mapProvince);
                break;
            case 'district':
                $mapCity  = ['pid' => $pid];
                $res = \app\bcwareexp\service\Area::get_area($mapCity);
                break;
        }
    
        if($res)
        {
            return json(['code' => 1, 'msg' => $res]);
        }
    
        return json(['code' => 0, 'msg' => '']);
    }
}
