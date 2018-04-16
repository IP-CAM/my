<?php
// +----------------------------------------------------------------------
// | ETshop Copyright (c)  http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | 配置文件 Version 1.0 2017/2/14
// +----------------------------------------------------------------------
//定义网站根目录
$request = \think\Request::instance();
$base    = $request->root();
$root    = strpos($base, '.') ? ltrim(dirname($base), DS) : $base;
if ('' != $root) {
    $root = '/' . ltrim($root, '/');
}

define('__ROOT__', $root);
define('UPLOADS', 'uploads');

//多个路由合并
$rt_route = RUNTIME_PATH . 'rt_routes.php';
$route    = is_file($rt_route) ? array_merge(['route'], include $rt_route) : ['route'];
//内核配置
$core   = APP_PATH . 'admin/extra/index.php';
$kernel = is_file($core) ? include $core : null;

return [
    //项目通用有配置
    'kernel' => $kernel,
    
    'app_debug'          => true,    // 应用调试模式
    'app_status'         => '',      // 应用模式状态
    'app_multi_module'   => true,    // 是否支持多模块
    'auto_bind_module'   => false,
    'lang_switch_on'     => true,    //开启语言包功能
    // 默认语言
    'default_lang'       => isset($kernel['lang']) ? $kernel['lang'] : 'zh-cn',
    'lang_cookie_var'    => 'rt_lang',   // 语言cookie变量
    'default_timezone'   => 'PRC',       // 默认时区
    'default_filter'     => 'htmlspecialchars', // 默认全局过滤方法 用逗号分隔多个
    
    /*自定义Hook功能 by theseaer start 2017/3/12 */
    'jntoo_hook_pattern' => '/app\\\\([0-9a-zA-Z_]+)\\\\dev\\\\hook\\\\([0-9a-zA-Z_]+)/',
    //是否开启钩子编译缓存，开启后只需要编译一次，以后都将成为惰性加载，如果安装了新的钩子，需要先调用Hook::clearCache() 清除缓存
    'jntoo_hook_cache'   => false,
    //钩子是否使用think钩子系统
    'jntoo_hook_call'    => true,
    'jntoo_hook_plugin'  => [],
    /*自定义Hook功能 by theseaer end 2017/3/12 */
    
    'can_use_not_install' => ['Install'],     // 无需安装即可运行的模块
    
    'pathinfo_depr'     => '/',    // pathinfo分隔符
    'url_html_suffix'   => '',
    'route_config_file' => $route,
    'url_route_on'      => true,    //路由开关
    'url_route_must'    => false,   //开启路由，并设置必须定义路由才能访问：
    //'base_url'               => '',	//去掉生成的URL地址里面的index.php
    'url_domain_deploy' => true,    //域名部署路由功能
    'url_domain_root'   => '',  //特殊域名后缀
    
    'default_module'         => 'index', // 默认模块名
    'default_controller'     => 'Index', // 默认控制器名
    'default_action'         => 'index',    // 默认操作名
    'deny_module_list'       => ['common'], // 禁止访问模块
    'default_validate'       => '',          // 默认验证器
    'controller_auto_search' => true,   //开启自动定位控制器
    
    //模板路径
    'theme'                  => ['pc' => 'pc', 'mobile' => 'mobile'],
    
    //界面方案
    'skin'                   => ['pc' => 'default', 'mobile' => 'default'],
    
    // 平台
    'platform'               => ['pc', 'wap', 'app', 'wechat', 'api', 'other'],
    
    // 视图输出字符串内容替换
    'view_replace_str'       => [
        '__PUBLIC__'  => __ROOT__ . '/' . APP_NAME,
        '__UPLOADS__' => __ROOT__ . '/' . UPLOADS,
    ],
    
    'dispatch_success_tmpl' => THINK_PATH . 'tpl' . DS . 'dispatch_jump.tpl',
    'dispatch_error_tmpl'   => THINK_PATH . 'tpl' . DS . 'dispatch_jump.tpl',
    
    // 异常页面的模板文件
    'exception_tmpl'        => THINK_PATH . 'tpl' . DS . 'think_exception.tpl',
    
    // 错误显示信息,非调试模式有效
    'error_message'         => 'Page error, Please try again later～',
    // 显示错误信息
    'show_error_msg'        => false,
    
    //Trace设置
    'app_trace'             => isset($kernel['runas']) ? $kernel['runas'] : false, //应用Trace
    'trace'                 => [
        //'type'          => 'Console',       //使用浏览器console显示页面trace信息
        //'type'          => 'Html',       //使用Html显示页面trace信息
    ],
    
    //验证码
    'captcha'               => [
        // 验证码字符集合
        'codeSet'  => '2345678abcdefhijkmnpqrstuvwxyzABCDEFGHJKLMNPQRTUVWXY',
        // 验证码字体大小(px)
        'fontSize' => 28,
        // 是否画混淆曲线
        'useCurve' => true,
        // 验证码图片高度
        'imageH'   => 50,
        // 验证码图片宽度
        'imageW'   => 300,
        // 验证码位数
        'length'   => 6,
        // 验证成功后是否重置
        'reset'    => true
    ],
    
    //缓存
    'cache'                 => [
        'type'   => 'File',
        'path'   => CACHE_PATH,
        'prefix' => '',
        'expire' => 0,
    ],
    
    //Cookie配置
    'cookie'                => [
        // cookie 名称前缀
        'prefix'    => isset($kernel['cookieprefix']) ? $kernel['cookieprefix'] : 'rt_',
        // cookie 保存时间
        'expire'    => 0,
        // cookie 保存路径
        'path'      => '/',
        // cookie 有效域名
        'domain'    => (isset($kernel['main_domain']) && $kernel['main_domain'] != '') ? $kernel['main_domain'] : '',
        //  cookie 启用安全传输
        'secure'    => false,
        // httponly设置
        'httponly'  => '',
        // 是否使用 setcookie
        'setcookie' => true,
    ],
    
    //session 配置
    'session'               => [
        'id'             => '',
        'var_session_id' => '',      // SESSION_ID的提交变量,解决flash上传跨域
        // SESSION 前缀
        'prefix'         => isset($kernel['sessionprefix']) ? $kernel['sessionprefix'] : 'rt_',
        'type'           => '',
        //'type'       => 'redis',    // 驱动方式 支持redis memcache memcached
        
        //'host'        => '127.0.0.1',    // redis主机
        //'port'        => 6379,           // redis端口
        //'password'    => '',             // 密码
        'auto_start'     => true,       // 是否自动开启 SESSION
        'domain'         => (isset($kernel['main_domain']) && $kernel['main_domain'] != '') ? $kernel['main_domain'] : '',
    ],
    
    //日志配置
    'log'                   => [
        'type'        => 'File',      //日志记录方式，内置 file socket 支持扩展
        'path'        => LOG_PATH,    //日志保存目录
        'apart_level' => ['error', 'sql'],          //日志记录级别
    ],
    
    //队列
    'queue'                 => [
        //驱动类型，可选择 sync(默认):同步执行，database:数据库驱动,redis:Redis驱动,topthink:Topthink驱动
        //或其他自定义的完整的类名
        'type' => 'sync'
    
    ],
    
    //分页配置
    'paginate'              => [
        'type'      => '\app\common\libs\Pages',
        'var_page'  => 'page',
        'list_rows' => 35,
    ],
];

