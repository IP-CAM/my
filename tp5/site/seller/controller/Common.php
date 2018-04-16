<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Common.php  Version 2017/6/20
// +----------------------------------------------------------------------

namespace app\seller\controller;

use app\common\controller\Home;
use think\Cache;
use app\crossbbcg\service\Cart as Cartapi;
use think\Session;
use app\admin\service\Service;

class Common extends Home
{
    private $assess = [];//允许访问的url路由
    public $meta_title;     //页面标题
    public $edittpl;        //编辑页模板名
    public $jumpUrl;        //转向地址
    public $index_where;    //条件
    protected $pk;          //主键
    protected $status;      //状态字段
    protected $desc;        //排序方式
    protected $conDb;       //数据表名
    protected $search;      //搜索字段;
    
    public function _initialize()
    {
        parent::_initialize();
        $this->assign('langList', $this->getLanguageList());
        $this->assign('langid', $this->lang);
        define('SellerId', Session::get('sellerId'));
        //登陆检测,过滤不必要的控制器
        if (!in_array(CONTROLLER_NAME, ['Login']) && SellerId < 1) {
            $this->redirect('seller/login/index');
        }
        if (!Cache::has('ShopMenus')) $this->saveHomeCache();//初始化缓存
        $role     = Session::get('role');
        //如果角色id为零或者不存在，不受权限控制
        if ($role) {
            //获取当前用户允许的url
            $this->assess = getAssessList();
            //获取当前模块控制器方法
            $url = MODULE_NAME . '/' . CONTROLLER_NAME . '/' . ACTION_NAME;
            if (!in_array(CONTROLLER_NAME, ['Login', 'Index'])) {
                if (!in_array(strtolower($url), $this->assess)) $this->error(lang('not_permission'));
            }
        }
        $this->assign('shoplogo', get_config('crossbbcg', 'index')['shoplogo']);
        $this->assign('shopname', get_config('crossbbcg', 'index')['shopname']);
        // 更新购物车，清理过时的数据
        $this->assign('cart_num', CartApi::countGood());
        // 是否在首页
        if ($this->request->path() == 'crossbbcg/' || $this->request->path() == 'crossbbcg/index' || $this->request->path() == 'crossbbcg') {
            $this->assign('is_home', true);
        } else {
            $this->assign('is_home', false);
        }
        // 当前页面url
        $this->assign('now_url', $this->request->url(true));
        $this->assign('now_url_false', $this->request->url());
    
        //初始化字段
        $this->conDb       = $this->conDb ? $this->conDb : str_ireplace('admin.', '', CONTROLLER_NAME);
        $this->meta_title  = lang($this->conDb);
        $this->index_where = array();
    
        $this->pk          = 'id';
        $this->desc        = ''.$this->pk.' desc';
        $this->status      = 'status';
        $this->search      = 'name';
        $this->jumpUrl     = 'index';
        $this->edittpl     = 'edit';
        
        $this->assign('HomeMenu', $this->getShopMenu());
        $this->assign('url', strtolower(MODULE_NAME . '-' . CONTROLLER_NAME . '-' . ACTION_NAME));
    }
    
    /**
     * @Mark:生成商户后台菜单缓存
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/19
     */
    public function saveHomeCache()
    {
        $menus = [];
        $file  = realpath(APP_PATH . strtolower(MODULE_NAME) . DS . 'setting.php');
        if (is_file($file)) {
            $tmp_setting = include $file;
        }
        if (!empty($tmp_setting['user_nav'])) {
            //显示后台菜单部分
            foreach ($tmp_setting['user_nav'] as $k => $v) {
                $iconPath  = '/' . APP_NAME . '/' . strtolower(MODULE_NAME) . '/';
                $menus[$k] = array(
                    'pid'        => $v[0] ? $v[0] : 0, //父节点
                    'pos'        => $v[1],               //位置
                    'url'        => $v[2],               //连接
                    'icon'       => $v[3] ? $v[3] : '',  //图标
                    'data'       => $v[4] ? $v[4] : '',  //菜单附加参数
                    'img'        => $v[0] == '' ? $iconPath . ($v[3] ? $v[3] : '') : '',  //指示图
                    'subimg'     => $v[0] != '' && $v[3] ? $iconPath . ($v[3] ? $v[3] : '') : '',
                    'order'      => $v[5] ? $v[5] : 0,  //排序
                    'permission' => $v[6] ? $v[6] : 0,  //是否受权限控制
                    'button'     => array_key_exists(7, $v) ? $v[7] : array(),
                );
            }
            Cache::set('ShopMenus', $menus);
        }
    }
    
    /**
     * @Mark:获取商户后台菜单
     * @return string
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/21
     */
    public function getShopMenu()
    {
        $menus = Cache::get('ShopMenus');
        $main  = '';
        foreach ($menus as $k => $v) {
            if ($v['pid'] === 0) {
                $main .= $this->main_menu($k, $menus);
            }
        };
        return $main;
    }
    
    /**
     * @Mark:拼接顶部导航str
     * @param $value
     * @param $url
     * @return string
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/21
     */
    private function main_menu($key, $menu)
    {
        //判断是否有链接，如有则无子菜单
        if ($menu[$key]['url']) {
            if (!empty($this->assess) && !in_array(strtolower($menu[$key]['url']), $this->assess)) return '';
            $str = '<li>';
            $str .= '<a href="' . url($menu[$key]['url']) . '">';
            $str .= '<i class="fa ' . $menu[$key]['icon'] . '"></i>';
            $str .= '<span>' . lang($key) . '</span>';
            $str .= '<span class="pull-right-container">';
            //$str .='<i class="fa  pull-right"></i>';
            $str .= '</a>';
        } else {
            if (!empty($this->assess) && !in_array(strtolower($key), $this->assess)) return '';
            $str = '<li class="treeview">';
            $str .= '<a href="javaScript:void(0);">';
            $str .= '<i class="fa ' . $menu[$key]['icon'] . '"></i>';
            $str .= '<span>' . lang($key) . '</span>';
            $str .= '<span class="pull-right-container">';
            $str .= '<i class="fa fa-caret-right pull-right"></i>';
            $str .= '</a>';
            $str .= '<ul class="treeview-menu">';
            foreach ($menu as $k => $v) {
                if (!empty($this->assess) && !in_array($v['url'], $this->assess)) continue;
                if ($v['pid'] === $key) {
                    $str .= $this->sub_menu($k, $v);
                }
            }
            $str .= '</ul>';
        }
        $str .= '</li>';
        return $str;
    }
    
    
    /**
     * @Mark:左侧主菜单str
     * @param $data
     * @return string
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/21
     */
    private function sub_menu($lang, $data)
    {
        $url = str_replace('/', '-', $data['url']);
        $str = '<li id="' . $url . '"><a href="' . url($data['url']) . '"><i class="fa ' . $data['icon'] . '"></i>' . lang($lang) . '</a></li>';
        return $str;
    }
    
    
    
    /**
     * @Mark:图片上传
     * @return \think\response\Json
     * @Author: yang <502204678@qq.com>
     * @Version 2017/9/12
     */
    public function ajax_upload()
    {
        // 获取表单上传文件 例如上传了001.jpg
        $file = $this->request->file('file');
        return $this->up($file);
    }
    
    /**
     * @Mark:导入
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/23
     */
    public function import()
    {
    
    }
    
    /**
     * @Mark:导出
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/23
     */
    public function export()
    {
    
    }
    
    public function img()
    {
        //加载admin模块配置
        $get   = $this->request->param();
        $file  = $this->request->file('file');
        $path  = ROOT_PATH . 'public' . DS . 'uploads' . DS . MODULE_NAME;
        $thumb = ['jpg', 'png', 'jpeg', 'bmp', 'gif']; //可以生成缩略图的后缀
        
        //组合生成mimeTypes参数
        $mimeTypes = '';
        $File = new \common\File();
        foreach (explode(',', get_config('admin','index')['atttypes']) as $key => $item)
        {
            $mimeTypes .= $File::getMime($item). ', ';
        }
        
        if($file)
        {
            $info = $file
                ->validate([
                    'size'  => get_config('admin','index')['attsize'] * 1024 * 1024,
                    'ext'   => get_config('admin','index')['atttypes']])
                ->move($path);
            if($info){
                // 成功上传后 获取上传信息
                // 输出 jpg
                //echo $info->getExtension();
                // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                //echo $info->getSaveName();
                // 输出 42a79759f284b767dfcb2a0197904287.jpg
                //echo $info->getFilename();
                // 生成相应的图片缩略图
                $ext    = substr(strrchr($info->getFilename(), '.'), 1);
                $name   = basename($info->getFilename(), "." . $ext);
                $dir    = dirname($path. DS . $info->getSaveName());
                $finalimg = MODULE_NAME .'/'. str_replace('\\', '/', $info->getSaveName());
                
                if(in_array(strtolower($info->getExtension()), $thumb) && isset($get['isthumb']))
                {
                    $thumb = [
                        'big'    =>[
                            get_config('admin','index')['bigwidth'] ? get_config('admin','index')['bigwidth'] : 800,
                            get_config('admin','index')['bigheight'] ? get_config('admin','index')['bigheight'] : 800,
                        ],
                        'middle' =>[
                            get_config('admin','index')['midwidth'] ? get_config('admin','index')['midwidth'] : 400,
                            get_config('admin','index')['midheight'] ? get_config('admin','index')['midheight'] : 400,
                        ],
                        'small'  =>[
                            get_config('admin','index')['smawidth'] ? get_config('admin','index')['smawidth'] : 58,
                            get_config('admin','index')['smaheight'] ? get_config('admin','index')['smaheight'] : 58,
                        ],
                        'thumb'  =>[
                            get_config('admin','index')['thuwidth'] ? get_config('admin','index')['thuwidth'] : 200,
                            get_config('admin','index')['thuheight'] ? get_config('admin','index')['thuheight'] : 200,
                        ],
                    ];
                    
                    $image  = \think\Image::open($path. DS . $info->getSaveName());
                    
                    //水印参数
                    $water_off      = get_config('admin','index')['water'] ? get_config('admin','index')['water'] : 0;  //水印开关
                    //水印类型
                    $water_type     = get_config('admin','index')['watertype'] ? get_config('admin','index')['watertype'] : 'text';
                    //水印内容
                    $water_content  = get_config('admin','index')['watertype_txt'] ? get_config('admin','index')['watertype_txt'] : 'ETshop';
                    $fontsize       = get_config('admin','index')['waterfontsize'] ? get_config('admin','index')['waterfontsize'] : 18;  //字体大小
                    $water_width    = get_config('admin','index')['waterwidth'];
                    $water_height   = get_config('admin','index')['waterheight'];
                    //水印透明度
                    $water_trans    = get_config('admin','index')['watertransparency'] ? get_config('admin','index')['watertransparency'] : 75;
                    //水印质量
                    $water_quality  = get_config('admin','index')['watermarkquality'] ? get_config('admin','index')['watermarkquality'] : 0;
                    //水印位置
                    $waterpostion    = get_config('admin','index')['waterpostion'] ? get_config('admin','index')['waterpostion'] : 9;
                    
                    //对原图加水印
                    if($water_off)
                    {
                        if($water_type == 'image')
                        {
                            $image->water($water_content, $waterpostion, $water_trans)->save($dir. DS . $name. '.'. $ext, null, $water_quality);
                        }
                        
                        if($water_type == 'text')
                        {
                            $image->text($water_content, 'static/font/HYQingKongTiJ.ttf', $fontsize, '#ffffff')->save($dir. DS . $name. '.'. $ext, null, $water_quality);
                        }
                    }
                    
                    //大
                    $bigname = $name. '_' . $thumb['big'][0] . '_'. $thumb['big'][1]. '.'. $ext;
                    $image->thumb($thumb['big'][0], $thumb['big'][1], \think\Image::THUMB_CENTER)->save($dir. DS . $bigname);
                    $bigp   = str_replace($info->getFilename(), $bigname, $finalimg);
                    self::writeimgLog($bigname, $bigp, filesize($dir. DS . $bigname), $ext);
                    //中
                    $midname = $name. '_' . $thumb['middle'][0] . '_'. $thumb['middle'][1]. '.'. $ext;
                    $image->thumb($thumb['middle'][0], $thumb['middle'][1],\think\Image::THUMB_CENTER)->save($dir. DS . $midname);
                    $middlep = str_replace($info->getFilename(), $midname, $finalimg);
                    self::writeimgLog($midname, $middlep, filesize($dir. DS . $midname), $ext);
                    //缩略
                    $thuname = $name. '_' . $thumb['thumb'][0] . '_'. $thumb['thumb'][1]. '.'. $ext;
                    $image->thumb($thumb['thumb'][0], $thumb['thumb'][1], \think\Image::THUMB_CENTER)->save($dir. DS . $thuname);
                    $thumbp  = str_replace($info->getFilename(), $thuname, $finalimg);
                    self::writeimgLog($thuname, $thumbp, filesize($dir. DS . $thuname), $ext);
                    //小
                    $smaname = $name. '_' . $thumb['small'][0] . '_'. $thumb['small'][1]. '.'. $ext;
                    $image->thumb($thumb['small'][0], $thumb['small'][1], \think\Image::THUMB_CENTER)->save($dir. DS . $smaname);
                    $smallp = str_replace($info->getFilename(), $smaname, $finalimg);
                    self::writeimgLog($smaname, $smallp, filesize($dir. DS . $smaname), $ext);
                }
                
                //记录原图
                self::writeimgLog($info->getSaveName(), $finalimg, filesize($dir. DS . $info->getFilename()), $ext);
                
                return json([
                    'code'  => 1,
                    'msg'   => lang('Upload success'),
                    'data'  => $finalimg
                ]);
            }else{
                // 上传失败获取错误信息
                return json(['code' => 0, 'msg' => $file->getError() ]);
            }
        }
        $this->assign('get', $get);
        $this->assign('mimeTypes', $mimeTypes);
        return $this->fetch('common/img');
    }
    
    /**
     * @Mark:记录图片
     * @param $name
     * @param $path
     * @param $size
     * @param $type
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/13
     */
    static private function writeimgLog($name, $path, $size, $type)
    {
        \app\admin\service\Attachment::addpic([
            'name'          => $name,
            'path'          => $path,
            'size'          => $size,
            'type'          => $type,
            'module'        => MODULE_NAME,
            'uid'           => SellerId,
            'langid'        => LANG,
        ]);
    }
    
    /**
     * @Mark:禁用
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/8/21
     */
    public function disable()
    {
        $input          = $this->request->param();
        $ids            = isset($input['ids']) ? (array)$input['ids'] : '';
        empty($ids) && $this->error(lang('Noselect'));
        $this->status   = isset($input['pk']) ? $input['pk'] : $this->status;
        $this->pk       = isset($input['changeid']) ? $input['changeid'] : $this->pk;
        $this->conDb    = isset($input['db']) ? $input['db'] : $this->conDb;
        $map = array($this->pk => array('in', implode(',', $ids)));
        
        $data = [
            'model'     => $this->conDb,    //模型名
            'where'     => $map,            //需要改变的字段的条件
            'fields'    => $this->status,   //需要改变的字段名
            'val'       => 0                //需要改变的最终值
        ];
        
        try{
            $result =  Service::setFields($data);
        }catch(\Exception $e){
            return json(['code' => 0, 'msg' => $e->getMessage() ]);  //不刷新
        }
        
        if ($result['code']) {
            $this->success(lang('Disableok'), $this->jumpUrl);
        } else {
            $this->error(lang('Disableerror') . $result['code'], $this->jumpUrl);
        }
    }
    
    /**
     * @Mark:禁用
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/8/21
     */
    public function enable()
    {
        $input          = $this->request->param();
        $ids            = isset($input['ids']) ? (array)$input['ids'] : '';
        empty($ids) && $this->error(lang('Noselect'));
        $this->status   = isset($input['pk']) ? $input['pk'] : $this->status;
        $this->pk       = isset($input['changeid']) ? $input['changeid'] : $this->pk;
        $this->conDb    = isset($input['db']) ? $input['db'] : $this->conDb;
        $map = array($this->pk => array('in', implode(',', $ids)));
        
        $data = [
            'model'     => $this->conDb,    //模型名
            'where'     => $map,            //需要改变的字段的条件
            'fields'    => $this->status,   //需要改变的字段名
            'val'       => 1                //需要改变的最终值
        ];
        
        try{
            $result =  Service::setFields($data);
        }catch(\Exception $e){
            return json(['code' => 0, 'msg' => $e->getMessage() ]);  //不刷新
        }
        
        if ($result['code']) {
            //action_log('disable', $this->conDb, implode(',', $ids), UID);
            $this->success(lang('Enableok'), $this->jumpUrl);
        } else {
            $this->error(lang('Enableerror'), $this->jumpUrl);
        }
    }
}
