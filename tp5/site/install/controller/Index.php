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
// | 控制器  Version 2017/1/23
// +----------------------------------------------------------------------
namespace app\install\controller;

use app\common\controller\Home;

class Index extends Home
{
    public $databases = [];
    
    public function _initialize()
    {
        if (file_exists(ROOT_PATH.'install.lock')) {
            echo '
		<html>
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        </head>
        <body>
        你已经安装过该系统，如果想重新安装，请先删除站点根目录下的install.lock 文件，然后再安装。
        </body>
        </html>';
            exit;
        }
        define('App', true);
        @set_time_limit(1000);
        if (phpversion() <= '5.0.0') set_magic_quotes_runtime(0);
        if ('5.0.0' > phpversion()) exit('您的php版本过低，不能安装本软件，请升级到7.0.0或更高版本再安装，谢谢！');
    
        date_default_timezone_set('PRC');
        error_reporting(E_ALL & ~E_NOTICE);
        header('Content-Type: text/html; charset=UTF-8');
        $sqlFile    = 'install.sql';
        if (!file_exists(APP_PATH . 'install/' . $sqlFile)) {
            echo '缺少必要的安装文件!';
            exit;
        }
        $steps = array(
            '1' => '安装许可协议',
            '2' => '运行环境检测',
            '3' => '安装参数设置',
            '4' => '安装详细过程',
            '5' => '安装完成',
        );
        $this->assign('steps',$steps);
        $step  = input('step') ? input('step') : 1;
        $this->assign('step',$step);
    }
    
    /**
     * @Mark:首页
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/12/25
     */
    public function index()
    {
        $dir = explode('/', $_SERVER['REQUEST_URI']);
        if (strtolower($dir[1]) == 'app') {
            echo '程序不能安装在App目录下，请更改为其他目录！';
            exit;
        }
        return $this->fetch('s1');
    }
    
    /**
     * @Mark:系统检测
     * @Author: yang <502204678@qq.com>
     * @Version 2017/10/9
     */
    public function s2()
    {
        if (phpversion() < 5) {
            die('本系统需要PHP7+MYSQL >=5.6环境，当前PHP版本为：' . phpversion());
        }
        $phpv               = @ phpversion();
        $this->assign('phpv',$phpv);
        //$os                 = PHP_OS;
        $os                 = php_uname();
        $this->assign('os',$os);
        $tmp                = function_exists('gd_info') ? gd_info() : array();
        $server             = $_SERVER["SERVER_SOFTWARE"];
        $this->assign('server',$server);
        $host               = (empty ($_SERVER["SERVER_ADDR"]) ? $_SERVER["SERVER_HOST"] : $_SERVER["SERVER_ADDR"]);
        $this->assign('host',$host);
        $name               = $_SERVER["SERVER_NAME"];
        $this->assign('name',$name);
        $max_execution_time = ini_get('max_execution_time');
        $this->assign('max_execution_time',$max_execution_time);
        $allow_reference    = (ini_get('allow_call_time_pass_reference') ? '<font color=green>[√]On</font>' : '<font color=red>[×]Off</font>');
        $this->assign('allow_reference',$allow_reference);
        $allow_url_fopen    = (ini_get('allow_url_fopen') ? '<font color=green>[√]On</font>' : '<font color=red>[×]Off</font>');
        $this->assign('allow_url_fopen',$allow_url_fopen);
        $safe_mode          = (ini_get('safe_mode') ? '<font color=red>[×]On</font>' : '<font color=green>[√]Off</font>');
        $this->assign('safe_mode',$safe_mode);
        $err = 0;
        if (empty($tmp['GD Version'])) {
            $gd = '<font color=red>[×]Off</font>';
            $err++;
        } else {
            $gd = '<font color=green>[√]On</font> ' . $tmp['GD Version'];
        }
        $this->assign('gd',$gd);
        if (function_exists('mysqli_connect')) {
            $mysql = '<font color=green>[√]On</font>';
        } else {
            $mysql = '<font color=red>[×]Off</font>';
            $err++;
        }
        $this->assign('mysql',$mysql);
        if (ini_get('file_uploads')) {
            $uploadSize = '<font color=green>[√]On</font> 文件限制:' . ini_get('upload_max_filesize');
        } else {
            $uploadSize = '禁止上传';
        }
        $this->assign('uploadSize',$uploadSize);
        if (function_exists('session_start')) {
            $session = '<font color=green>[√]On</font>';
        } else {
            $session = '<font color=red>[×]Off</font>';
            $err++;
        }
        $this->assign('err',$err);
        $this->assign('session',$session);
        $folder = array('/',
            'public/uploads',
            'site/database.php',
            'site/config.php',
            'runtime',
            'data'
        );
        $this->assign('folder',$folder);
        return $this->fetch('s2');
    }
    
    /**
     * @Mark:创建系统信息
     * @Author: yang <502204678@qq.com>
     * @Version 2017/10/9
     */
    public function s3()
    {
        $param = $this->request->param();
        if (isset($param['testdbpwd'])) {
            $dbHost = $_POST['dbHost'] . ':' . $_POST['dbPort'];
            $conn   = @mysqli_connect($dbHost, $_POST['dbUser'], $_POST['dbPwd']);
            if ($conn) {
                die("1");
            } else {
                die("");
            }
        }
        
        $scriptName = !empty ($_SERVER["REQUEST_URI"]) ? $scriptName = $_SERVER["REQUEST_URI"] : $scriptName = $_SERVER["PHP_SELF"];
        $rootpath   = @preg_replace("/\/(I|i)nstall\/index\.php(.*)$/", "", $scriptName);
        $domain     = empty ($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];
        $domain     = $domain . $rootpath;
        $this->assign('domain',$domain);
        return $this->fetch('s3');
    }
    
    /**
     * @Mark:创建数据
     * @Author: yang <502204678@qq.com>
     * @Version 2017/9/30
     */
    public function create_data()
    {
        $param = $this->request->param();
        if (!is_file(APP_PATH . 'database.php')) $this->error('databases.php不存在');
        $database             = include APP_PATH . 'database.php';
        $database['hostname'] = $param['dbHost'];
        $database['database'] = $param['dbName'];
        $database['username'] = $param['dbUser'];
        $database['password'] = $param['dbPwd'];
        $database['hostport'] = $param['dbPort'];
        $database['prefix']   = $param['dbPrefix'];
        $dbHost   = empty($param['dbPort']) || $param['dbPort'] == 3306 ? $param['dbHost'] : $param['dbHost'] . ':' . $param['dbPort'];
        $conn = @mysqli_connect($dbHost, $param['dbUser'], $param['dbPwd']);
        if (!$conn) {
            $arr['msg'] = "连接数据库失败!";
            $this->error($arr['msg']);
        }
        mysqli_query($conn,"SET NAMES 'utf8'");//,character_set_client=binary,sql_mode='';
        $version = mysqli_get_server_info($conn);
        if ($version < 5.5) {
            $arr['msg'] = '数据库版本太低!';
            $this->error($arr['msg']);
        }
        
        if (!mysqli_select_db($conn,$param['dbName'])) {
            if (!mysqli_query($conn,"CREATE DATABASE IF NOT EXISTS `" . $param['dbName'] . "`;")) {
                $arr['msg'] = '数据库 ' . $param['dbName'] . ' 不存在，也没权限创建新的数据库！';
                $this->error($arr['msg']);
            } else {
                $arr['n']   = 0;
                $arr['code'] = 1;
                $arr['msg'] = "成功创建数据库:{$param['dbName']}<br>";
                $arr['url'] = url('s4',$param);
                file_put_contents(realpath(APP_PATH . 'database.php'), "<?php \n" . $this->getnote() . "\n\nreturn " . var_export($database, true) . ";\n");
                return json($arr);
            }
        } else {
            $this->error('数据库已存在，请更换数据库名！');
        }
    }
    public function s4()
    {
        $param = $this->request->param();
        $this->assign('param',$param);
        return $this->fetch();
    }
    
    public function s5()
    {
        $admin_url = $this->request->host().url('admin/index/index');
        file_put_contents(ROOT_PATH."install.lock",'');
        $this->assign('admin_url',$admin_url);
        return $this->fetch();
    }
    
    /**
     * @Mark:判断文件读写权限
     * @param $file
     * @Author: yang <502204678@qq.com>
     * @Version 2017/9/30
     */
    public function is_readOrwrite($file)
    {
        $arr = [];
        if (is_writable($file)) {
            $arr[0] = 1;
        } else {
            $arr[0] = 0;
        }
        if (is_readable($file)) {
            $arr[1] = 1;
        } else {
            $arr[1] = 0;
        }
        return $arr;
    }
    
    /**
     * @Mark:创建数据库
     * @Author: yang <502204678@qq.com>
     * @Version 2017/9/30
     */
    public function create_databases()
    {
        $param = $this->request->param();
        $n   = intval($param['n']);
        $username        = trim($param['username']);
        $password        = trim($param['password']);
        //读取数据文件
        $sqldata   = file_get_contents(APP_PATH . 'install/install.sql');
        $sqlFormat = sql_split($sqldata, $param['dbPrefix']);
        /**
         * 执行SQL语句
         */
        $counts = count($sqlFormat);
        for ($i = $n; $i < $counts; $i++) {
            $sql = trim($sqlFormat[$i]);
            if (strstr($sql, 'CREATE TABLE')) {
                preg_match('/CREATE TABLE `([^ ]*)`/', $sql, $matches);
                \think\Db::connect()->query("DROP TABLE IF EXISTS `$matches[1]`");
                $ret = \think\Db::connect()->query($sql);
                if ($ret !== false) {
                    $message = '<li><span class="correct_span">&radic;</span>创建数据表' . $matches[1] . '，<font color="gree">完成</font></li> ';
                } else {
                    $message = '<li><span class="correct_span error_span">&radic;</span>创建数据表' . $matches[1] . '，<font  color="red">失败</font></li>';
                }
                $i++;
                $arr = array('n' => $i, 'msg' => $message);
                echo json_encode($arr);
                exit;
            } else {
                \think\Db::connect()->query($sql);
                $message = '';
                $arr     = array('n' => $i, 'msg' => $message);
            }
        }
        if ($i == 999999) exit;
        $data = [
            'nickname'=>$username,
            'username'=>$username,
            'password'=>md5($password),
        ];
        \app\admin\model\Manager::create($data);
        $message = '成功添加管理员<br />成功写入配置文件<br>安装完成．';
        $arr     = array('n' => 999999, 'msg' => $message);
        echo json_encode($arr);
        exit;
    }
}
