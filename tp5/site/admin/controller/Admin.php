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
// | 后台父类  Version 1.0  2016/3/14
// +----------------------------------------------------------------------
namespace app\admin\controller;

use think\Db;
use think\Lang;
use think\Config;
use think\Loader;
use think\Exception;
use app\common\controller\Base;
use app\admin\service\Service;
use app\admin\service\Attachment as AttachmentApi;

class Admin extends Base
{
    public $langage;        //限定模块所使用的语言
    public $langid;         //查询用语言标识符
    public $meta_title;     //页面标题
    public $edittpl;        //编辑页模板名
    public $jumpUrl;        //转向地址
    public $index_where;    //条件
    protected $pk;          //主键
    protected $status;      //状态字段
    protected $desc;        //排序方式
    protected $conDb;       //数据表名
    protected $search;      //搜索字段;
    
    /**
     * @Mark:继承
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/12
     */
    public function _initialize()
    {
        // 判断是否登录，并定义用户ID常量
        //defined('UID') or define('UID',is_sign());
        //if (!UID) $this->redirect('admin/passport/login');
        parent::_initialize();
        
        parent::sendMsg([]);
       
        //\app\common\libs\Hook::call('Category', 'index');  // 自动加载Hook调用方法
        //\think\Hook::listen('admin_init');          //Admin初始化时执行，系统原有hook调用方式
        
        //自动创建语言目录及语言包
        $langfile = MODULE_PATH. DS. 'lang'. DS. Config::get('default_lang').'.php';
        //加载模块自定义配置
        $this->langage = Config::get('limit_lang');      //限定模块所使用的语言
        if(Config::has('check_lang_dir')){
            parent::createLangDir(MODULE_NAME, $this->langage);
        }else{
            if(!is_file($langfile)){
                //创建默认语言包
                file_put_contents($langfile, "<?php \n".parent::getnote()."\n\nreturn [\n\n];\n");
            }
        }
        
        //初始化时加载admin配置文件(全局)，方便后继模板中使用变量 by theseaer start 2017/7/7
        $Conf = APP_PATH . 'admin' . DS . 'extra'. DS . 'index.php';
        Config::load($Conf);
    
        //平台判断
        $platform = IS_WAP ? (IS_APP ? 'app' : (IS_WECHAT ? 'wechat' : 'mobile')) : 'pc';
        define('PLATFORM', $platform);
        
        //语言下拉框 by theseaer start 2017/8/11
        $this->assign('langs', $this->langage ? $this->langage : $this->getLanguageList());
        
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
    
        //后台菜单赋值 by theseaer start 2017/8/11
        $Menus = $this->getMenus();
        $this->assign('__MENU__', $Menus['Main']);
        
    
        $this->assign('__CHILD__', $Menus['Child']);
        
    
        $this->assign('__SOON__', $Menus['Soon']);
        
	}
    
    /**
     * @Mark:处理空操作 默认定位到加载配置文件操作，因index为默认操作，故不存在index 被覆盖的可能
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/1/18
     */
    public function _empty() {

        if(!$this->request->isPost())
        {
            $Conf = MODULE_PATH . DS . 'extra'. DS . ACTION_NAME. '.php';
    
            $data = is_file(realpath($Conf)) ? include realpath($Conf) : null;
    
            $this->assign ("meta_title", lang(ACTION_NAME));
            $this->assign ('data', $data);
        }
    
        return $this->fetch(ACTION_NAME);
    }

    /**
     * @Mark:加载模块下的配置文件，生成管理员菜单
     * @return array
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/7/25
     */
    protected function getMenus(){
        Lang::load(realpath(RUNTIME_PATH . '/lang/'.$this->lang.'.php')); //加载合并后的语言包
        $Admin_menus = \think\Cache::get('Menus'); //菜单
        $menus = $child = $soon = $button = array();
        //显示后台菜单部分
        foreach($Admin_menus as $k =>$v){
            if($v['order'] == -1 ) continue;
            if(strtoupper($v['pos']) === 'L'){
                $menus[$k]['title'] = lang($k);                             //菜单名
                $menus[$k]['icon']  = $v['icon'] ? $v['icon']:'';           //图标
                $menus[$k]['order'] = $v['order'] ? $v['order'] : 0;        //排序
                $menus[$k]['img']   =  $v['pid'] === '0' ? ((preg_match('/.png|.gif|.bmp|.jpg|.jpeg/', $v['img']) ? __ROOT__ . $v['img'] : $v['img'])) : '' ;
                $menus[$k]['subimg']=  $v['subimg'] ? ((preg_match('/.png|.gif|.bmp|.jpg|.jpeg/', $v['subimg']) ? __ROOT__ . $v['subimg'] : $v['subimg'])) : '';
                $menus[$k]['permission'] = $v['permission'] ? $v['permission'] : 0; //是否受权限控制
                $menus[$k]['pid']   = $v['pid'] ? $v['pid'] : '0';  //父节点
                if($v['pid'] === '0'){
                    $menus[$k]['url']   = $v['url'] ? '<a href='.url('/'.$v['url']).'>'.lang($k).'</a>' : lang($k);
                    $menus[$k]['imghtml']   = "<img src='".$menus[$k]['img']."' alt='".lang($k)."' class='menu-icon' />";
                    $menus[$k]['href']      = "class='dropdown-toggle' data-toggle='dropdown' href='javascript:void(0)' data-url='".url('/'.$v['url'])."'";
                    $menus[$k]['caret']     = "<b class='caret'></b>";
                }else{
                    $menus[$k]['imghtml']   = empty($menus[$k]['subimg']) ? "" : "<img src='".$menus[$k]['subimg']."' alt='".lang($k)."' class='sub-menu-icon' />";
                    $menus[$k]['href'] = " href='".url('/'.$v['url'])."' class='".$menus[$k]['icon']."'";
                    $menus[$k]['caret'] = "";
                }
            }else if(strtoupper($v['pos']) === 'R'){
                $child[$v['pid']][] = array(
                    'pid'           => $v['pid'] ? $v['pid'] : '0',  //子节点
                    'url'           => $v['url'],
                    'href'          => url('/'.$v['url']),
                    'icon'          => $v['icon'] ? $v['icon']:'',
                    'order'         => $v['order'] ? $v['order'] : 0,
                    'title'         => lang($k),
                    'permission'    => $v['permission'] ? $v['permission'] : 0, //是否受权限控制
                    'button'        => array_key_exists('button', $v) ? $v['button'] : '', //子菜单
                );
            }else if(strtoupper($v['pos']) === 'H'){
                $soon[$v['pid']][] = array(
                    'pid'           => $v['pid'] ? $v['pid'] : '0',  //子节点
                    'url'           => $v['url'],
                    'href'          => url('/'.$v['url']),
                    'icon'          => $v['icon'] ? $v['icon']:'',
                    'order'         => $v['order'] ? $v['order'] : 0,
                    'title'         => lang($k),
                    'permission'    => $v['permission'] ? $v['permission'] : 0, //是否受权限控制
                    'button'        => array_key_exists('button', $v) ? $v['button'] : '', //子菜单
                );
            }
        }
        
        foreach ($menus as $item => $ik) {
            $array[$item] = $ik;
        }
    
        $tree = new \common\Tree();
        $tree->init($array);
        $str = "<a \$href>\$imghtml\$title</a>";
        $str2 = "<a \$href>\$imghtml\$title\$caret</a>";
        $Main = $tree->get_treeview('0','menu',$str,$str2);
        return array('Main'=>$Main, 'Child'=>$child, 'Soon'=>$soon);
    }

    /**
     * @Mark:首页
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/7/30
     */
    public function index(){
        //赋值
        $param      = $this->request->param();
        $start_time = isset($param['start_time']) ? trim($param['start_time']) : '';
        $end_time   = isset($param['end_time']) ? trim($param['end_time']) : '';
        $name       = isset($param['name']) ? trim($param['name']) : '';
        $lang       = isset($param['lang']) ? trim($param['lang']) : '';

        $name ?         $this->index_where[$this->search]   = array('like', '%'.(string)$name.'%') : '';
        $start_time ?   $this->index_where['create_time']   = array('>=', strtotime($start_time)) : '';
        $end_time ?     $this->index_where['end_time']      = array('<=', strtotime($end_time)) : '';
        $lang ?         $this->index_where['langid']        = array('=', strtotime($lang)) : '';
        
        $lists = Service::getlist($this->conDb, $this->index_where, $this->desc);
        $this->assign('list', $lists['list']);
        $this->assign('page', $lists['page']);
        $this->assign('_total', $lists['total']);
        $this->assign ("meta_title", $this->meta_title);
        return $this->fetch();
    }

    /**
     * @Mark:新增
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/10/25
     */
    public function add(){
        $this->assign("meta_title", lang('Addnew'). lang($this->conDb));
        $this->assign("data", null);
        return $this->fetch($this->edittpl);
    }

    /**
     * @Mark:修改单条记录
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/10/25
     */
    public function edit()
    {
        $param  = $this->request->param();
        $ids    = isset($param['ids']) ? $param['ids'] : '';
        empty($ids) && $this->error(lang('Error_id')) ;
        
        $map = [
            'model'  => $this->conDb,
            'where'  => [$this->pk => ['eq', $ids]]
        ];
        $data   = Service::getOne($map);
    
        $this->assign("data", $data['code'] ? $data['data'] : null );
        $this->assign("meta_title", lang('Edit') . lang($this->conDb));
        return $this->fetch();
    }
    
    /**
     * @Mark:保存数据 单条
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/18
     */
    public function savedata()
    {
        $input = $this->request->post();
    
        $data = [
             'model'  => $this->conDb,   //数据表
             'value'  => $input,             //数据值
        ];
    
        //修改动作
        isset($input[$this->pk]) ? $data['pk'] = $this->pk : '';
        
        $result = Service::savedata($data);
    
        if($result['code'])
        {
            $this->success($result['msg'], url($this->jumpUrl));
        }
    
        return json(['code' => 0, 'msg' => $result['msg']]);
    }

    /**
     * @Mark:删除
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/10/25
     */
    public function delete()
    {
        $input       = $this->request->param();
        $ids         = isset($input['ids']) ? (array)$input['ids'] : '';
        empty($ids) && $this->error(lang('Deletenoselect')) ;
        $map = array(
            $this->pk => array('in', implode(',', $ids))
        );
    
        $data       = [
            'model'     => ucfirst($this->conDb),
            'where'     => $map
        ];
    
        try{
            $result =  Service::del($data);
        }catch(\Exception $e){
            $this->error($e->getMessage());  //带刷新
        }
        
        if ($result['code']) {
            //action_log('delete', $this->conDb, implode(',', $ids), UID);
            $this->success(lang('Deleteok'), $this->jumpUrl);
        } else {
            $this->error(lang('Deleteerror'), $this->jumpUrl);
        }
    }
    
    /**
     * @Mark:排序
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/5/16
     */
    public function sort(){
        $input       = $this->request->param();
        $sort        = isset($input['sorts']) ? (array)$input['sorts'] : '';
        $this->conDb = isset($input['db']) ? $input['db'] : $this->conDb;
        if (!empty($sort)) {
            foreach ($sort as $id => $v) {
                $data = [
                    'model'     => $this->conDb,         //模型名
                    'where'     => [$this->pk => $id],   //需要改变的字段的条件
                    'fields'    => 'sort',               //需要改变的字段名
                    'val'       => $v                    //需要改变的最终值
                ];
                $result = Service::setFields($data);
                
                if(!$result['code']) $this->error($result['msg']);
            }
            //action_log('sort', $this->conDb, $sort, UID);
            $this->success(lang('Doingok'));
        } else {
            $this->error(lang('Sortnoselect'));
        }
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
    
    /**
     * @Mark:导入
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/5/16
     */
    public function import()
    {
        if($this->request->isPost())
        {
            //TODO
            
            
        }else{
            $this->assign ('meta_title', lang('import'));
            return $this->fetch('admin@public/import');
        }
    }
    
    /**
     * @Mark:导出
     * @param ids array  需要导出的字段ID
     * @param header array  数据头标题
     * @param field array   需要导出的字段
     * @param filename string 文件名
     * @return mixed
     * @throws Exception
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/25
     */
    public function export()
    {
        //获取当前数据表
        $Model          = '\\app\\'. MODULE_NAME .'\\model\\'.ucfirst($this->conDb);
        $the_model      = new $Model;
        $prefix         = config('database.prefix');
        $the_main_table = strtolower($prefix.MODULE_NAME.'_'.$this->conDb);
        $table_info     = Db::query("SHOW FULL COLUMNS FROM $the_main_table");
        $new_arr        = [];
        foreach ($table_info as $av){
            $new_arr[$the_main_table.'.'.$av['Field']]=$av['Comment'];
        }
        if (property_exists($the_model,'test') && !empty($the_model->test)) {
            $alias_info = $the_model->test;
            $this->assign('alias_info',implode(',',$alias_info));
            foreach ($alias_info as $k=>$v) {
                $info           = explode('@',$v);
                //$source = strtoupper('__'.MODULE_NAME.'_'.$this->conDb.'__');
                //$table_name = strtoupper('__'.MODULE_NAME.'_'.$bb[0].'__');
                //$field = explode(':',$info[1]);
                $table_alias    = strtolower($prefix.MODULE_NAME.'_'.$info[0]);
                $join_table     = Db::query("SHOW FULL COLUMNS FROM $table_alias");
                foreach ($join_table as $bv){
                    $new_arr[$table_alias.'.'.$bv['Field']]=$bv['Comment'];
                }
            }
        }
        dump($new_arr);exit();
        return $this->fetch('admin@public/export');
        //$param      = $this->request->param();
        //$ids        = isset($param['ids']) ? (array)$param['ids'] : '';
        //empty($ids) && $this->error(lang('Exportsnoselect'));
        //
        //if($this->request->isPost())
        //{
            //需要导出的模型
            //$Model      = '\\app\\'. MODULE_NAME .'\\model\\'.ucfirst($this->conDb);
            
            $header     = isset($param['header']) ? (array)$param['header'] : '';
            empty($header) && $this->error(lang('Exports header is empty'));
            $filename   = isset($param['filename']) ? $param['filename'] : $this->conDb. '_'. date('Y-m-d');
            $ids        = isset($param['ids']) ? (array)$param['ids'] : '';
            empty($ids) && $this->error(lang('Exportsnoselect'));
            $map        = [$this->pk => ['in', implode(',', $ids)]];
            
            $field      = isset($param['field']) ? implode(',', $param['field']) : '';
            
            //本段为演示代码
            $data       = Service::getlist($this->conDb,$map,'',$field);
            if ($error = \common\Excel::export($header, $data['list'], $filename, '2007')) {
                return json(['code' => 0, 'msg' => $error ]);  //不刷新
            }
            
        //}
        //$this->assign ('meta_title', lang('export'));
        //return $this->fetch('admin@public/export');
    }
    
    
    /**
     * @Mark:解析schema
     * @return array
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/1/16
     */
    final static protected function parseSchema($appName)
    {
        $files = array_map('realpath', glob(APP_PATH . $appName .'/schema/*.php'));
        $query  = new \think\db\Query;
        
        foreach ($files as $key => $file)
        {
            $filename = basename($file, '.php');
            $tmp_tb[$filename] = include $file;
            if($tmp_tb[$filename]['columns']) continue;
            analysis_schama($tmp_tb[$filename]);
    
            $res = Loader::model('Admin/Dbmodel')->getTables();
            //存在刚比对 by theseaer start 2017/1/17
            if(in_array($query->getTable($filename), $res))
            {
                //获取数据表属性
                $shopCmfTb = Db::connect()->query("SHOW FULL FIELDS FROM ".$query->getTable($filename)."");
    
            }else{
                //不存在则新建 by theseaer start 2017/1/17

            }
        }
        
        return array();
    }
    
    /**
     * @Mark:解析数组为SQL语言
     * @param $data
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/8
     */
    final static protected function array_to_sql(&$data)
    {
        
    }
    
    /**
     * @Mark:更新数据库
     * @return bool
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/1/16
     */
    final static public function updateschema()
    {
        return true;
    }
    
    /**
     * @Mark:图片上传 加入公共控制器
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/1/14
     */
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
        foreach (explode(',', Config::get('atttypes')) as $key => $item)
        {
            $mimeTypes .= $File::getMime($item). ', ';
        }
        
        if($file)
        {
            $info = $file
                ->validate([
                    'size'  => Config::get('attsize') * 1024 * 1024,
                    'ext'   => Config::get('atttypes')])
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
                            Config::get('bigwidth') ? Config::get('bigwidth') : 800,
                            Config::get('bigheight') ? Config::get('bigheight') : 800,
                        ],
                        'middle' =>[
                            Config::get('midwidth') ? Config::get('midwidth') : 400,
                            Config::get('midheight') ? Config::get('midheight') : 400,
                        ],
                        'small'  =>[
                            Config::get('smawidth') ? Config::get('smawidth') : 58,
                            Config::get('smaheight') ? Config::get('smaheight') : 58,
                        ],
                        'thumb'  =>[
                            Config::get('thuwidth') ? Config::get('thuwidth') : 200,
                            Config::get('thuheight') ? Config::get('thuheight') : 200,
                        ],
                    ];
                    
                    $image  = \think\Image::open($path. DS . $info->getSaveName());
    
                    //水印参数
                    $water_off      = Config::get('water') ? Config::get('water') : 0;  //水印开关
                    //水印类型
                    $water_type     = Config::get('watertype') ? Config::get('watertype') : 'text';
                    //水印内容
                    $water_content  = Config::get('watertype_txt') ? Config::get('watertype_txt') : 'ETshop';
                    $fontsize       = Config::get('waterfontsize') ? Config::get('waterfontsize') : 18;  //字体大小
                    $water_width    = Config::get('waterwidth');
                    $water_height   = Config::get('waterheight');
                    //水印透明度
                    $water_trans    = Config::get('watertransparency') ? Config::get('watertransparency') : 75;
                    //水印质量
                    $water_quality  = Config::get('watermarkquality') ? Config::get('watermarkquality') : 0;
                    //水印位置
                    $waterpostion    = Config::get('waterpostion') ? Config::get('waterpostion') : 9;
    
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
        return $this->fetch('admin@public/img');
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
        AttachmentApi::addpic([
            'name'          => $name,
            'path'          => $path,
            'size'          => $size,
            'type'          => $type,
            'module'        => MODULE_NAME,
            'uid'           => UID,
            'langid'        => LANG,
        ]);
    }
    
}
