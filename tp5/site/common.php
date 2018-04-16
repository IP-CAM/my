<?php
    /**
     * 对内容进行安全处理，来自Discuz!X
     * @param string|array $string 要处理的字符串或者数组
     * @param $string $flags 指定标记
     */
    function dhtmlspecialchars($string, $flags = null)
    {
        if (is_array($string)) {
            foreach ($string as $key => $val) {
                $string[$key] = dhtmlspecialchars($val, $flags);
            }
        } else {
            if ($flags === null) {
                $string = str_replace(array('&', '"', '<', '>'), array('&', '"', '<', '>'), $string);
                if (strpos($string, '&#') !== false) {
                    $string = preg_replace('/&((#(\d{3,5}|x[a-fA-F0-9]{4}));)/', '&\\1', $string);
                }
            } else {
                if (PHP_VERSION < '5.4.0') {
                    $string = htmlspecialchars($string, $flags);
                } else {
                    if (strtolower(CHARSET) == 'utf-8') {
                        $charset = 'UTF-8';
                    } else {
                        $charset = 'ISO-8859-1';
                    }
                    $string = htmlspecialchars($string, $flags, $charset);
                }
            }
        }
        return $string;
    }
    
    /**
     * @Mark:获取属性类型信息
     * @param string $type
     * @return array
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/12/8
     */
    function get_attribute_type($type = '')
    {
        // TODO 可以加入系统配置
        static $_type = array(
            'num'            => array('Numb', 'int(10) UNSIGNED NOT NULL'),
            'string'         => array('String', 'varchar(255) NOT NULL'),
            'textarea'       => array('Input', 'text NOT NULL'),
            'date'           => array('Date', 'int(10) NOT NULL'),
            'datetime'       => array('Time', 'int(10) NOT NULL'),
            'bool'           => array('Boolean', 'tinyint(2) NOT NULL'),
            'select'         => array('Enumeration', 'char(50) NOT NULL'),
            'radio'          => array('Radio', 'char(10) NOT NULL'),
            'checkbox'       => array('Checkbox', 'varchar(100) NOT NULL'),
            'editor'         => array('Editor', 'text NOT NULL'),
            'picture'        => array('Upload_pic', 'int(10) UNSIGNED NOT NULL'),
            'pictures'       => array('Upload_pic_s', 'text NOT NULL'),
            'file'           => array('Upload_att', 'int(10) UNSIGNED NOT NULL'),
            'selectdata'     => array('Ass_enumeration', 'char(100) NOT NULL'),
            'selectcheckbox' => array('Enumeration_Ass_s', 'char(100) NOT NULL'),
            'group'          => array('Enumeration_Ass_group', 'char(100) NOT NULL'),
        );
        return $type ? $_type[$type][0] : $_type;
    }
    
    /**
     * @Mark:无限极分类递归函数
     * @param $catArray
     * @param int $id
     * @param string $prefix
     * @return array
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/17
     */
    function sortdata($catArray, $id = 0, $prefix = '')
    {
        static $formatCat = array();
        static $floor = 0;
        foreach ($catArray as $key => $val) {
            if ($val['pid'] == $id) {
                $str = '';
                for ($i = 0; $i < $floor; $i++) {
                    $str .= ' └─ ';
                }
                $val['char']  = $str;
                $val['floor'] = $floor;
                $formatCat[]  = $val;
                unset($catArray[$key]);
                $floor++;
                sortdata($catArray, $val['id'], $prefix);
                $floor--;
            }
        }
        return $formatCat;
    }
    
    /**
     * 字符串截取，支持中文和其他编码
     * @param string $str 需要转换的字符串
     * @param string $start 开始位置
     * @param string $length 截取长度
     * @param string $charset 编码格式
     * @param string $suffix 截断显示字符
     * @return string
     */
    function msubstr($str, $start = 0, $length, $charset = "utf-8", $suffix = true)
    {
        if (function_exists("mb_substr"))
            $slice = mb_substr($str, $start, $length, $charset);
        elseif (function_exists('iconv_substr')) {
            $slice = iconv_substr($str, $start, $length, $charset);
            if (false === $slice) {
                $slice = '';
            }
        } else {
            $re['utf-8']  = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
            $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
            $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
            $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
            preg_match_all($re[$charset], $str, $match);
            $slice = join("", array_slice($match[0], $start, $length));
        }
        return $suffix ? $slice . '...' : $slice;
    }
    
    /**
     * 格式化字节大小
     * @param  number $size 字节数
     * @param  string $delimiter 数字和单位分隔符
     * @return string            格式化后的带单位的大小
     * @author theseaer <theseaer@qq.com>
     */
    function format_bytes($size, $delimiter = '')
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
        for ($i = 0; $size >= 1024 && $i < 5; $i++)
            $size /= 1024;
        return round($size, 2) . $delimiter . $units[$i];
    }
    
    /**
     * @Mark:生成指定长度的随机字符串
     * @param int $length
     * @return string
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/11
     */
    function generate_prefix($length = 8)
    {
        $chars  = 'abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ23456789';
        $prefix = '';
        for ($i = 0; $i < $length; $i++) {
            $prefix .= $chars[mt_rand(0, strlen($chars) - 1)];
        }
        return $prefix;
    }
    
    /**
     * 根据查询字段返回某字段的排序
     * @param string $field
     * @return bool|mixed|string
     */
    function getUrlbyOrder($field = 'name')
    {
        $urlinput           = input();
        $urlinput['_order'] = input('_order') == 'desc' ? 'asc' : 'desc';
        $urlinput['_field'] = $field;
        return url('', $urlinput);
    }
    
    /**
     * @Mark:时间戳格式化
     * @param null $time
     * @param string $format
     * @return false|string
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/17
     */
    function time_format($time = NULL, $format = 'Y-m-d H:i:s')
    {
        $time = $time === NULL ? time() : intval($time);
        return date($format, $time);
    }
    
    /**
     * @Mark:返回状态选项
     * @param int $data
     * @return int
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/17
     */
    function autostatus($data = 0)
    {
        return (int)!!$data;
    }
    
    /**
     * @Mark:返回语言ID
     * @param $data
     * @return int|mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/20
     */
    function getlangid($data)
    {
        if (!isset($data)) {
            return LANG;
        } else {
            return '';
        }
    }
    
    /**
     * @Mark:返回是否永久数字
     * @param $data
     * @return false|int
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/20
     */
    function getforever($data)
    {
        if ($data == 9) {
            return 9;
        } else {
            return strtotime($data);
        }
    }
    
    /**
     * 返回用户名
     * @param string $id
     * @return string
     */
    function get_username($id = '', $fields = '')
    {
        $user = \app\member\service\Member::get_nickname($id, $fields);
        if (empty($user)) {
            return '';
        }
        return $user;
    }
    
    /**
     * @Mark:检测登录状态,返回登录id
     * @return int
     * @Author: Fancs
     * @Version 2017/6/27
     */
    function is_login()
    {
        $session = session('user_auth');
        $cookie  = cookie('user_auth');
        if (!($session && $cookie)) {
            return 0;
        } else {
            return session('user_auth_sign') == data_auth_sign($session) ? $session['uid'] : 0;
        }
    }
    
    /**
     * @Mark:检测后台管理员登录状态
     * @return int
     * @Author: yang <502204678@qq.com>
     * @Version 2017/9/7
     */
    function is_sign()
    {
        $session = \think\Session::get('admin_auth');
        $cookie  = \think\Cookie::get('admin_auth');
        if (!($session && $cookie)) {
            return 0;
        } else {
            return \think\Session::get('admin_auth_sign') == data_auth_sign($session) ? $session['uid'] : 0;
        }
    }
    
    
    /**
     * @Mark:读取后台配置项
     * @param $model  string 模块名称
     * @param $filename string 文件名称
     * @return mixed|null
     * @Author: fancs
     * @Version 2017/7/6
     */
    function get_config($model, $filename = 'index')
    {
        //获取配置项
        $Conf = realpath(APP_PATH) . DS . $model . DS . 'extra' . DS . $filename . '.php';
        $data = is_file(realpath($Conf)) ? include realpath($Conf) : null;
        return $data;
    }
    
    /**
     * @Mark:检测用户免登录状态
     * @return int
     * @Author: fancs
     * @Version 2017/7/5
     */
    function check_login()
    {
        $cookie = \think\Cookie::get('user_auth');
        $info   = \app\member\model\Member::get(['token' => $cookie['token']]);
        if ($info) {
            return $info['id'];
        }
        return 0;
    }
    
    /**
     * @Mark:生成指定长度验证码
     * @param int $length
     * @return int
     * @Author: fancs
     * @Version 2017/7/5
     */
    function generate_code($length = 6)
    {
        return rand(pow(10, ($length - 1)), pow(10, $length) - 1);
    }
    
    /**
     * 数据签名认证
     * @param  array $data 被认证的数据
     * @return string       签名
     * @author Fancs
     */
    function data_auth_sign($data)
    {
        //数据类型检测
        if (!is_array($data)) {
            $data = (array)$data;
        }
        ksort($data); //排序
        $code = http_build_query($data); //url编码并生成query字符串
        $sign = sha1($code); //生成签名
        return $sign;
    }
    
    /**
     * @Mark:订单编号
     * @param $uid
     * @return string
     * @Author: fancs
     * @Version 2017/7/5
     */
    function get_order_sn($uid)
    {
        $time = date('ymdhis', time());
        $leng = strlen($uid);
        switch ($leng) {
            case 1:
                $id = '000' . $uid;
                break;
            case 2:
                $id = '00' . $uid;
                break;
            case 3:
                $id = '0' . $uid;
                break;
            default:
                $id = $uid;
        }
        $str = $time . $id;
        return $str;
    }
    
    /**
     * @Mark:删除目录操作
     * @param $dir
     * @return bool
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/7/10
     */
    function dir_delete($dir)
    {
        //$dir = dir_path($dir);
        if (!is_dir($dir)) return FALSE;
        $handle = opendir($dir); //打开目录
        while (($file = readdir($handle)) !== false) {
            if ($file == '.' || $file == '..') continue;
            $d = $dir . DIRECTORY_SEPARATOR . $file;
            is_dir($d) ? dir_delete($d) : @unlink($d);
        }
        closedir($handle);
        return @rmdir($dir);
    }
    
    /**
     * @Mark:获取后台用户名
     * @param $admin_id
     * @Author: yang <502204678@qq.com>
     * @Version 2017/8/31
     */
    function get_admin_name($admin_id)
    {
        $username = \app\admin\model\Account::where(['id' => $admin_id])->value('username');
        return $username ? $username : 'no name';
    }
    
    /**
     * @Mark:获取行为名称
     * @param $action_id int
     * @Author: yang <502204678@qq.com>
     * @Version 2017/8/31
     * @return object
     */
    function get_action($action_id)
    {
        $res = \app\admin\model\Action::get($action_id);
        return $res;
    }
    
    /**
     * @Mark:记录行为日志，并执行该行为的规则
     * @param string $action 行为标识
     * @param string $model 触发行为的模型名
     * @param int $record_id 触发行为的记录id
     * @param int $user_id 执行行为的用户id
     * @return boolean
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/27
     */
    function action_log($action = null, $model = null, $record_id = null, $user_id = null)
    {
        //参数检查
        if (empty($action) || empty($model) || empty($record_id)) return '参数不能为空';
        empty($user_id) && $user_id = is_login();
        //查询行为,判断是否执行
        $action_info = \app\admin\model\Action::where(['name' => $action])->find();
        
        if ($action_info['status'] != 1) return '该行为被禁用或删除';
        //插入行为日志
        $data = array(
            'action_id'   => $action_info['id'],
            'id'          => $user_id,
            'action_ip'   => ip2long(get_client_ip()),
            'model'       => $model,
            'record_id'   => $record_id,
            'create_time' => time(),
        );
        //解析日志规则,生成日志备注
        if (!empty($action_info['log'])) {
            if (preg_match_all('/\[(\S+?)\]/', $action_info['log'], $match)) {
                $log['user']   = $user_id;
                $log['record'] = $record_id;
                $log['model']  = $model;
                $log['time']   = time();
                $log['data']   = array('user' => $user_id, 'model' => $model, 'record' => $record_id, 'time' => $log['time']);
                foreach ($match[1] as $value) {
                    $param = explode('|', $value);
                    if (isset($param[1])) {
                        $replace[] = call_user_func($param[1], $log[$param[0]]);
                    } else {
                        $replace[] = $log[$param[0]];
                    }
                }
                $data['remark'] = str_replace($match[0], $replace, $action_info['log']);
            } else {
                $data['remark'] = $action_info['log'];
            }
        } else {
            //未定义日志规则，记录操作url
            $data['remark'] = '操作url：' . $_SERVER['REQUEST_URI'];
        }
        
         \app\admin\model\ActionLog::create($data);
        return true;
    }
    
    /**
     * 解析行为规则
     * 规则定义 table:$table|field:$field|condition:$condition|rule:$rule[|cycle:$cycle|max:$max][;......]
     * 规则字段解释：table->要操作的数据表，不需要加表前缀；
     *              field->要操作的字段；
     *              condition->操作的条件，目前支持字符串，默认变量{$self}为执行行为的用户
     *              rule->对字段进行的具体操作，目前支持四则混合运算，如：1+score*2/2-3
     *              cycle->执行周期，单位（小时），表示$cycle小时内最多执行$max次
     *              max->单个周期内的最大执行次数（$cycle和$max必须同时定义，否则无效）
     * 单个行为后可加 ； 连接其他规则
     * @param string $action 行为id或者name
     * @param int $self 替换规则里的变量为执行用户的id
     * @return boolean|array: false解析出错 ， 成功返回规则数组
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/27
     */
    function parse_action($action, $self)
    {
        if (empty($action)) {
            return false;
        }
        
        //参数支持id或者name
        if (is_numeric($action)) {
            $map = array('id' => $action);
        } else {
            $map = array('name' => $action);
        }
        
        //查询行为信息
        $info = db('Action')->where($map)->find();
        
        if (!$info || $info['status'] != 1) {
            return false;
        }
        
        //解析规则:table:$table|field:$field|condition:$condition|rule:$rule[|cycle:$cycle|max:$max][;......]
        
        $rules  = $info['rule'];
        $rules  = str_replace('{$self}', $self, $rules);
        $rules  = explode(';', $rules);
        $return = array();
        foreach ($rules as $key => &$rule) {
            if (empty($rule))
                continue;
            $rule = explode('|', $rule);
            foreach ($rule as $k => $fields) {
                $field = empty($fields) ? array() : explode(':', $fields);
                if (!empty($field)) {
                    $return[$key][$field[0]] = $field[1];
                }
            }
            //cycle(检查周期)和max(周期内最大执行次数)必须同时存在，否则去掉这两个条件
            if (!array_key_exists('cycle', $return[$key]) || !array_key_exists('max', $return[$key])) {
                unset($return[$key]['cycle'], $return[$key]['max']);
            }
        }
        
        return $return;
    }
    
    /**
     * @Mark:执行行为
     * @param array $rules 解析后的规则数组
     * @param int $action_id 行为id
     * @param array $user_id 执行的用户id
     * @return boolean false 失败 ， true 成功
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/27
     */
    function execute_action($rules = false, $action_id = null, $user_id = null)
    {
        if (!$rules || empty($action_id) || empty($user_id)) {
            return false;
        }
        
        $return = true;
        foreach ($rules as $rule) {
            //检查执行周期
            $map                = array('action_id' => $action_id, 'user_id' => $user_id);
            $map['create_time'] = array('gt', time() - intval($rule['cycle']) * 3600);
            $exec_count         = db('ActionLog')->where($map)->count();
            if ($exec_count > $rule['max']) {
                continue;
            }
            
            //执行数据库操作
            $Model = db(ucfirst($rule['table']));
            $field = $rule['field'];
            $res   = $Model->where($rule['condition'])->setField($field, array('exp', $rule['rule']));
            
            if (!$res) {
                $return = false;
            }
        }
        return $return;
    }
    
    /**
     * @Mark:获取文件扩展名
     * @param $filename 文件名
     * @return string
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/8/8
     */
    function fileext($filename)
    {
        return strtolower(trim(substr(strrchr($filename, '.'), 1, 10)));
    }
    
    /**
     * @Mark:路径
     * @param $path
     * @return mixed|string
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/8/8
     */
    function dir_path($path)
    {
        $path = str_replace('\\', '/', $path);
        if (substr($path, -1) != '/') $path = $path . '/';
        return $path;
    }
    
    /**
     * @Mark:目录树
     * @param $path
     * @param string $exts
     * @param array $list
     * @return array
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/8/8
     */
    function dir_list($path, $exts = '', $list = array())
    {
        $path  = dir_path($path);
        $files = glob($path . '*');
        foreach ($files as $v) {
            $fileext = fileext($v);
            if (!$exts || preg_match("/\.($exts)/i", $v)) {
                $list[] = $v;
                if (is_dir($v)) {
                    $list = dir_list($v, $exts, $list);
                }
            }
        }
        return $list;
    }
    
    /**
     * @Mark:复制目录
     * @param $fromdir
     * @param $todir
     * @return bool
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/8/8
     */
    function dir_copy($fromdir, $todir)
    {
        $fromdir = dir_path($fromdir);
        $todir   = dir_path($todir);
        if (!is_dir($fromdir)) return FALSE;
        if (!is_dir($todir)) dir_create($todir);
        $list = glob($fromdir . '*');
        if (!empty($list)) {
            foreach ($list as $v) {
                $path = $todir . basename($v);
                if (is_dir($v)) {
                    dir_copy($v, $path);
                } else {
                    copy($v, $path);
                    @chmod($path, 0777);
                }
            }
        }
        return TRUE;
    }
    
    /**
     * @Mark:创建目录
     * @param $path
     * @param int $mode
     * @return bool
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/8/8
     */
    function dir_create($path, $mode = 0777)
    {
        if (is_dir($path)) return TRUE;
        $path    = dir_path($path);
        $temp    = explode('/', $path);
        $cur_dir = '';
        $max     = count($temp) - 1;
        for ($i = 0; $i < $max; $i++) {
            $cur_dir .= $temp[$i] . '/';
            if (@is_dir($cur_dir)) continue;
            @mkdir($cur_dir, $mode, true);
            @chmod($cur_dir, $mode);
        }
        return is_dir($path);
    }
    
    /**
     * @Mark:返回Child列表
     * @param $data
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/10/2
     */
    function getChild(&$data)
    {
        $nodes_found = $html = $needle = '';
        $request     = \think\Request::instance();
        //当前模块/控制器/方法
        $needle = strtolower($request->module() . '/' . $request->controller() . '/' . $request->action());
        //寻找Child所在的组
        foreach ($data as $index => $item) {
            foreach ($item as $key => $val) {
                if ($val['url'] === $needle) {
                    $nodes_found = $val['pid'];
                    break;
                }
            }
        }
        
        if (empty($data[$nodes_found])) return '';
        //按order 排序
        $tmpChild = array_sort($data[$nodes_found], 'order');
        
        //罗列子菜单项目
        foreach ($tmpChild as $k => $v) {
            $html .= '<a id="tabUser' . $k . '_link"  class="' . $v['icon'] . '" ';
            $html .= 'href="' . url('/' . $v['url']) . '">' . lang($v['title']) . '';
            $html .= '</a>';
        }
        
        $html .= '<script>';
        $html .= "highlight_subnav('tabs','" . url('/' . $needle) . "');";
        //$html .= "highlight_subnav('filetree ','".url($needle)."');";
        $html .= '</script>';
        
        return $html;
    }
    
    /**
     * @Mark:
     * @param $array为要排序的数组
     * @param $keys为要用来排序的键名
     * @param string $type默认为升序排序
     * @return array
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/10/2
     */
    function array_sort($array, $keys, $type = 'asc')
    {
        $keysvalue = $new_array = array();
        foreach ($array as $k => $v) {
            $keysvalue[$k] = $v[$keys];
        }
        if ($type == 'asc') {
            asort($keysvalue);
        } else {
            arsort($keysvalue);
        }
        reset($keysvalue);
        foreach ($keysvalue as $k => $v) {
            $new_array[$k] = $array[$k];
        }
        return $new_array;
    }
    
    /**
     * @Mark:罗列操作按钮
     * @param $data
     * @param array $params
     * @return string
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/12/8
     */
    function getButton(&$data, $params = array())
    {
        $nodes_found = $button = $needle = $i = '';
        $request     = \think\Request::instance();
        //当前模块/控制器/方法
        $needle = strtolower($request->module() . '/' . $request->controller() . '/' . $request->action());
        //寻找Child所在的组
        foreach ($data as $index => $item) {
            foreach ($item as $key => $val) {
                if ($val['url'] === $needle) {
                    $i           = $key;
                    $nodes_found = $val['pid'];
                    break;
                }
            }
        }
        
        if (!empty($data[$nodes_found][$i]['button'])) {
            //按order 排序
            $tmpButton = array_sort($data[$nodes_found][$i]['button'], '0');
            
            foreach ($tmpButton as $it => $sub) {
                if (strtoupper($sub[0]) == -1) continue;
                switch ($it) {
                    case 'Addnew':
                        $style       = $sub[2] ? 'class="' . $sub[2] . ' add" ' : 'class="add-new ajax-get add" ';
                        $param       = array_key_exists(3, $sub) && $sub[3] ? ' data-width="' . $sub[3] . '"' : '';
                        $param       .= array_key_exists(4, $sub) && $sub[4] ? ' data-height="' . $sub[4] . '"' : '';
                        $param       .= array_key_exists(5, $sub) && $sub[5] ? ' data-showbar="' . $sub[5] . '"' : '';
                        $layer_title = array_key_exists(6, $sub) && $sub[6] ? $sub[6] : '';
                        break;
                    case 'Delete':
                        $style       = $sub[2] ? 'class="' . $sub[2] . ' del" ' : 'class="copy-existing ajax-post confirm del" ';
                        $param       = array_key_exists(7, $sub) && $sub[7] ? ' target-form="' . $sub[7] . '"' : '';
                        $layer_title = $sub[6] ? 'data-layer="' . lang($sub[6]) . '"' : 'data-layer="' . lang('Batch_del') . '"';
                        break;
                    case 'Restore':
                        $style       = $sub[2] ? 'class="' . $sub[2] . ' restore" ' : 'class="ajax-post confirm restore" ';
                        $param       = array_key_exists(7, $sub) && $sub[7] ? ' target-form="' . $sub[7] . '"' : '';
                        $layer_title = $sub[6] ? 'data-layer="' . lang($sub[6]) . '"' : 'data-layer="' . lang('batch_restore') . '"';
                        break;
                    case 'Enable':
                        $style       = $sub[2] ? 'class="' . $sub[2] . '" ' : 'class="btn-refresh ajax-post" ';
                        $param       = $sub[7] ? ' target-form="' . $sub[7] . '"' : '';
                        $layer_title = $sub[6] ? 'data-layer="' . lang($sub[6]) . '"' : '';
                        break;
                    case 'Disable':
                        $style       = $sub[2] ? 'class="' . $sub[2] . '" ' : 'class="btn-danger ajax-post" ';
                        $param       = array_key_exists(7, $sub) && $sub[7] ? ' target-form="' . $sub[7] . '"' : '';
                        $layer_title = $sub[6] ? 'data-layer="' . lang($sub[6]) . '"' : '';
                        break;
                    case 'Sort':
                        $style       = $sub[2] ? 'class="' . $sub[2] . '"  id="sort"' : 'class="btn-back ajax-post" id="sort"';
                        $param       = array_key_exists(7, $sub) && $sub[7] ? ' target-form="' . $sub[7] . '"' : '';
                        $layer_title = '';
                        break;
                    case 'Newopt':
                        $style       = $sub[2] ? 'class="' . $sub[2] . ' add" ' : 'class="btn-back btn-new ajax-get" ';
                        $param       = array_key_exists(3, $sub) && $sub[3] ? ' data-width="' . $sub[3] . '"' : '';
                        $param       .= array_key_exists(4, $sub) && $sub[4] ? ' data-height="' . $sub[4] . '"' : '';
                        $param       .= array_key_exists(5, $sub) && $sub[5] ? ' data-showbar="' . $sub[5] . '"' : '';
                        $layer_title = array_key_exists(6, $sub) && $sub[6] ? $sub[6] : '';
                        break;
                    case 'Clear':
                        $style       = $sub[2] ? 'class="' . $sub[2] . '"' : 'class="add-new ajax-clear"';
                        $param       = '';
                        $layer_title = '';
                        break;
                    case 'Import':
                        $style       = array_key_exists(2, $sub) && $sub[2] ? 'class="' . $sub[2] . '" ' : 'class="btn-back ajax-get" ';
                        $param       = array_key_exists(3, $sub) && $sub[3] ? ' data-width="' . $sub[3] . '"' : '';
                        $param       .= array_key_exists(4, $sub) && $sub[4] ? ' data-height="' . $sub[4] . '"' : '';
                        $param       .= array_key_exists(5, $sub) && $sub[5] ? ' data-showbar="' . $sub[5] . '"' : '';
                        $layer_title = '';
                        break;
                    case 'Export':
                        $style       = array_key_exists(2, $sub) && $sub[2] ? 'class="' . $sub[2] . '" ' : 'class="btn-danger ajax-post" ';
                        $param       = array_key_exists(3, $sub) && $sub[3] ? ' data-width="' . $sub[3] . '"' : '';
                        $param       .= array_key_exists(4, $sub) && $sub[4] ? ' data-height="' . $sub[4] . '"' : '';
                        $param       .= array_key_exists(5, $sub) && $sub[5] ? ' data-showbar="' . $sub[5] . '"' : '';
                        $param       .= array_key_exists(7, $sub) && $sub[7] ? ' target-form="' . $sub[7] . '"' : '';
                        $layer_title = '';
                        break;
                    case 'Keysearch':  //关键字搜索 TODO
                        $style       = $sub[2] ? 'class="' . $sub[2] . '" ' : 'class="btn-back ajax-get" ';
                        $param       = array_key_exists(3, $sub) && $sub[3] ? ' data-width="' . $sub[3] . '"' : '';
                        $param       .= array_key_exists(4, $sub) && $sub[4] ? ' data-height="' . $sub[4] . '"' : '';
                        $layer_title = '';
                        break;
                    case 'Timesearch': //时间段搜索  TODO
                        $style       = $sub[2] ? 'class="' . $sub[2] . '" ' : 'class="btn-back ajax-get" ';
                        $param       = array_key_exists(3, $sub) && $sub[3] ? ' data-width="' . $sub[3] . '"' : '';
                        $param       .= array_key_exists(4, $sub) && $sub[4] ? ' data-height="' . $sub[4] . '"' : '';
                        $layer_title = '';
                        break;
                    case 'Advsearch':  //高级搜索 TODO
                        $style       = $sub[2] ? 'class="' . $sub[2] . '" ' : 'class="btn-back ajax-get" ';
                        $param       = array_key_exists(3, $sub) && $sub[3] ? ' data-width="' . $sub[3] . '"' : '';
                        $param       .= array_key_exists(4, $sub) && $sub[4] ? ' data-height="' . $sub[4] . '"' : '';
                        $layer_title = '';
                        break;
                    case 'Refresh':  //刷新
                        $style       = array_key_exists(2, $sub) && $sub[2] ? ' class="' . $sub[2] . '" ' : 'class="btn-refresh" ';
                        $param       = '';
                        $layer_title = '';
                        break;
                    default:
                        $style  = $sub[2] ? 'class="' . $sub[2] . '" ' : 'class="add-new ajax-get" ';
                        $param  = array_key_exists(3, $sub) && $sub[3] ? ' data-width="' . $sub[3] . '"' : '';
                        $param  .= array_key_exists(4, $sub) && $sub[4] ? ' data-height="' . $sub[4] . '"' : '';
                        $param  .= array_key_exists(5, $sub) && $sub[5] ? ' data-showbar="' . $sub[5] . '"' : '';
                        $param  .= array_key_exists(7, $sub) && $sub[7] ? ' target-form="' . $sub[7] . '"' : '';
                        $layer_title = array_key_exists(6, $sub) && $sub[6] ? $sub[6] : '';;
                }
                if (stripos($sub[1], 'javascript') !== false) {
                    $button .= '<a href="' . $sub[1] . '" ' . $style . ' title="' . lang($it) . '" ' . $layer_title . ' ' . $param . '>' . lang($it) . '</a>';
                } else if (empty($sub[1])) {
                    $button .= '<a href="' . url('/', $params) . '" ' . $style . '>' . lang($it) . '</a>';
                } else {
                    $button .= '<a href="' . url('/' . $sub[1], $params) . '" ' . $style . ' title="' . lang($it) . '" ' . $layer_title . ' ' . $param . '>' . lang($it) . '</a>';
                }
            }
        };
        
        return $button;
    }
    
    /**
     * @Mark:自动加载当前APP的资源文件，如css,js
     * @param $ext string 后缀
     * @param $mid string 中间路径
     * 如：admin 代表shopcmf\public\site\promotion\admin
     * mobile/default 代表shopcmf\public\site\promotion\mobile\default
     * @return string
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/12/22
     */
    function get_res($ext, $mid = 'admin')
    {
        $res    = '';
        $mid    = rtrim($mid, '/');
        $newmid = str_replace('/', '\\', $mid);
        if (strtolower(MODULE_NAME) != 'admin') {
            $respath = getcwd() . DS . APP_NAME . DS . MODULE_NAME . DS . $newmid . DS . $ext . DS;
            $reslist = glob($respath . '*.' . $ext . '');
            if ($reslist) {
                if ($ext == 'css') {
                    foreach ($reslist as $key => $item) {
                        $res .= '<link rel="stylesheet" type="text/css" href="';
                        $res .= __ROOT__ . '/' . APP_NAME . '/' . MODULE_NAME;
                        $res .= '/' . $mid . '/css/' . basename($item) . '" />';
                    }
                }
                
                if ($ext == 'js') {
                    foreach ($reslist as $key => $item) {
                        $res .= '<script type="text/javascript" src="';
                        $res .= __ROOT__ . '/' . APP_NAME . '/' . \think\Request::instance()->module();
                        $res .= '/' . $mid . '/js/' . basename($item) . '"></script>';
                    }
                }
                
            }
        }
        
        return $res;
    }
    
    /**
     * @Mark:根据数组中的值进行分组
     * @param $array
     * @return array
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/10/19
     * $_array = array(
     * array(1,11,'2016-05-18'),
     * array(2,11,'2016-05-18'),
     * array(3,22,'2016-05-18'),
     * array(4,22,'2016-05-18'),
     * array(5,33,'2016-05-19'),
     * array(6,33,'2016-05-19'),
     * array(7,44,'2016-05-19'),
     * array(8,44,'2016-05-19'),
     *
     * array(9,55,'2016-05-20'),
     * array(10,55,'2016-05-20'),
     * );
     * var_dump(array_val_chunk($_array));
     */
    function array_val_chunk($array)
    {
        $result = [];
        foreach ($array as $key => $value) {
            $result[$value[1] . $value[2]][] = $value;
        }
        $ret = [];
        //这里把简直转成了数字的，方便统一处理
        foreach ($result as $key => $value) {
            array_push($ret, $value);
        }
        return $ret;
    }
    
    /**
     * @Mark:罗列指定目录下的文件
     * @param $dir  目录
     * @param $ext  后缀
     * @return array
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/10
     */
    function list_dir_file($dir, $ext)
    {
        $dir     .= substr($dir, -1) == '/' ? '' : '/';
        $dirfile = array();
        foreach (array_map('realpath', glob($dir . '*')) as $v) {
            if (is_dir($v)) {
                $temp = array_map('realpath', glob($v . '/*.' . $ext . ''));
                if (is_array($temp)) {
                    $dirfile = array_merge($dirfile, $temp);
                }
            } else {
                $dirfile[] = $v;
            }
        }
        return $dirfile;
    }
    
    /**
     * @Mark:遍历子文件夹
     * @param $path
     * @return array
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/2/19
     */
    function list_dir_all_file($path)
    {
        $result = array();
        $queue  = array($path);
        while ($data = each($queue)) { //3
            $path = $data['value'];
            if (is_dir($path) && $handle = opendir($path)) {
                while (FALSE !== ($file = readdir($handle))) { //2
                    if ($file == '.' || $file == '..') continue 1;
                    $real_path = str_replace(DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR, $path . DIRECTORY_SEPARATOR . $file);
                    /* 包含目录写法
                    $result[] = $real_path;
                    if (is_dir($real_path))
                        $queue[] = $real_path;
                    */
                    /**
                     * 列出纯文件写法，不包含目录
                     */
                    if (is_dir($real_path)) {
                        $queue[] = $real_path;
                    } else {
                        $result[] = $real_path;
                    }
                }
            }
            closedir($handle);
        }
        
        return $result;
    }
    
    /**
     * @Mark:返回插件数组
     * @param $name 隶属分组
     * @param string $type
     * @return string
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/2/22
     */
    function get_extend_type($name)
    {
        if (empty($name)) return '';
        $extlist = $tmp_array = array();
        //$extendDb = \think\Config::get('database.prefix'). 'admin_';
        $parm = [
            'subjection' => $name,  //隶属分组
            'status'     => 1,      //插件是否启用参数
            'is_del'     => ['=', ''],
        ];
        $list = \app\common\service\Extend::getExt($parm);
        
        foreach ($list['data'] as $key => $file) {
            $extClass    = "\\" . $file['subjection'] . "\\" . $file['code'];
            $tmp_array[] = $extClass::setup();
        }
        
        foreach ($tmp_array as $key => $value) {
            $tmp_array[$key]['subjection'] = strtolower($value['subjection']);
            $tmp_array[$key]['uninstall']  = 0;
            $tmp_array[$key]['lastver']    = '';
            $tmp_array[$key]['status']     = 0;
            $tmp_array[$key]['isshow']     = 0;
            //是否安装
            if (!empty($extlist[$value['subjection'] . '_' . $value['code']])) {
                
                $issubjection = $extlist[$value['subjection'] . '_' . $value['code']]['subjection'] == $value['subjection'];
                
                $iscode = $extlist[$value['subjection'] . '_' . $value['code']]['code'] == $value['code'];
                
                if ($issubjection && $iscode) {
                    
                    $tmp_array[$key]['id'] = $extlist[$value['subjection'] . '_' . $value['code']]['id'];
                    //状态
                    $tmp_array[$key]['status']    = $extlist[$value['subjection'] . '_' . $value['code']][$value['subjection'] . '_' . $value['code']];
                    $tmp_array[$key]['isshow']    = $extlist[$value['subjection'] . '_' . $value['code']]['isshow'];
                    $tmp_array[$key]['uninstall'] = 1;
                    $tmp_array[$key]['sort']      = $extlist[$value['subjection'] . '_' . $value['code']]['sort'];
                }
            }
            
            //是否允许卸载
            $tmp_array[$key]['allow_uninstall'] = empty($extlist[$value['code']]) ? 1 : $extlist[$value['code']]['allow_uninstall'];
        }
        return $tmp_array;
    }
    
    /**
     * @Mark:输出二维码
     * @param string $str 需要输出的内容，默认为当前页面URL地址
     * @param string $logo 中间要显示的LOGO，从public目录下算起
     * @return string
     * Demo <img src="{:qrcode('', 'static/images/payments/wechat.png')}" width="115" height="115">
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/13
     */
    function qrcode($str = '', $logo = 'logo.png')
    {
        $qrCode  = new \Endroid\QrCode\QrCode();
        $currUrl = $str ? $str : \think\Request::instance()->url(true);
        $qrCode->setText($currUrl)
            ->setSize(300)
            ->setPadding(10)
            ->setErrorCorrection('high')
            ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
            ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
            ->setLogo(getcwd() . '/' . $logo)
            ->setLogoSize(80)
            ->setLabelFontSize(16)
            ->setImageType(\Endroid\QrCode\QrCode::IMAGE_TYPE_PNG)
            ->getDataUri();
        $dataUri = $qrCode->getDataUri();
        return $dataUri;
    }
    
    /**
     * @Mark:替换JS中语言变量的大小写问题
     * @param $lang
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/8
     */
    function jsup($lang)
    {
        $old = ['zh-cn', 'zh-tw'];  //需要转换的语言包变量
        if (in_array($lang, $old)) {
            $str = explode('-', $lang);
            return $str[0] . '-' . strtoupper($str[1]);
        }
        
        return $lang;
    }
    
    /**
     * @Mark:返回类函数的注释，注释必须使用@Mark:方式标注
     * @param $classname 类名
     * @param $fun  函数名
     * @return string 注释
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/12
     */
    function get_fun_mark($classname, $fun)
    {
        $class = new $classname();
        $func  = new ReflectionMethod($class, $fun);
        $Com   = $func->getDocComment();
        if (empty($Com)) return ['mark' => '', 'ver' => ''];
        $tf      = preg_match_all('/@Mark:(.*?)\n/', $Com, $tmp);
        $vf      = preg_match_all('/@Version(.*?)\n/', $Com, $ver);
        $mark    = $tf ? trim($tmp[1][0]) : '';
        $version = $vf ? trim($ver[1][0]) : '';
        return ['mark' => $mark, 'ver' => $version];
    }
    
    /**
     * @Mark:无限分类数据树形格式化
     * @param $items array 需要树化的数组
     * @return array
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/13
     * $items = array(
     * 1 => array('id' => 1, 'pid' => 0, 'name' => '江西省'),
     * 2 => array('id' => 2, 'pid' => 0, 'name' => '黑龙江省'),
     * 3 => array('id' => 3, 'pid' => 1, 'name' => '南昌市'),
     * 4 => array('id' => 4, 'pid' => 2, 'name' => '哈尔滨市'),
     * 5 => array('id' => 5, 'pid' => 2, 'name' => '鸡西市'),
     * 6 => array('id' => 6, 'pid' => 4, 'name' => '香坊区'),
     * 7 => array('id' => 7, 'pid' => 4, 'name' => '南岗区'),
     * 8 => array('id' => 8, 'pid' => 6, 'name' => '和兴路'),
     * 9 => array('id' => 9, 'pid' => 7, 'name' => '西大直街'),
     * 10 => array('id' => 10, 'pid' => 8, 'name' => '东北林业大学'),
     * 11 => array('id' => 11, 'pid' => 9, 'name' => '哈尔滨工业大学'),
     * 12 => array('id' => 12, 'pid' => 8, 'name' => '哈尔滨师范大学'),
     * 13 => array('id' => 13, 'pid' => 1, 'name' => '赣州市'),
     * 14 => array('id' => 14, 'pid' => 13, 'name' => '赣县'),
     * 15 => array('id' => 15, 'pid' => 13, 'name' => '于都县'),
     * 16 => array('id' => 16, 'pid' => 14, 'name' => '茅店镇'),
     * 17 => array('id' => 17, 'pid' => 14, 'name' => '大田乡'),
     * 18 => array('id' => 18, 'pid' => 16, 'name' => '义源村'),
     * 19 => array('id' => 19, 'pid' => 16, 'name' => '上坝村'),
     * );
     */
    function gentree($items)
    {
        foreach ($items as $item)
            $items[$item['pid']]['son'][$item['id']] = &$items[$item['id']];
        return isset($items[0]['son']) ? $items[0]['son'] : array();
    }
    
    /**
     * @Mark 判断不是一个json数据
     * @param $str
     * @return bool
     * @Author: Fancs
     * @Version 2017/5/8
     */
    function is_not_json($str)
    {
        return is_null(json_decode($str));
    }
    
    /**
     * @Mark  系统加密方法
     * @param string $data 要加密的字符串
     * @param string $key 加密密钥
     * @param int $expire 过期时间 (单位:秒)
     * @return string
     * @author Fancs
     * @Version 2017/5/9
     */
    function system_encrypt($data, $key, $expire = 0)
    {
        $key  = md5($key);
        $data = base64_encode($data);
        $x    = 0;
        $len  = strlen($data);
        $l    = strlen($key);
        $char = '';
        for ($i = 0; $i < $len; $i++) {
            if ($x == $l) $x = 0;
            $char .= substr($key, $x, 1);
            $x++;
        }
        $str = sprintf('%010d', $expire ? $expire + time() : 0);
        for ($i = 0; $i < $len; $i++) {
            $str .= chr(ord(substr($data, $i, 1)) + (ord(substr($char, $i, 1))) % 256);
        }
        return str_replace('=', '', base64_encode($str));
    }
    
    /**
     * @Mark系统解密方法
     * @param string $data 要解密的字符串 （必须是system_encrypt方法加密的字符串）
     * @param string $key 加密密钥
     * @return string
     * @author Fancs
     * @version 2017/5/9
     */
    function system_decrypt($data, $key)
    {
        $key    = md5($key);
        $x      = 0;
        $data   = base64_decode($data);
        $expire = substr($data, 0, 10);
        $data   = substr($data, 10);
        if ($expire > 0 && $expire < time()) {
            return '';
        }
        $len  = strlen($data);
        $l    = strlen($key);
        $char = $str = '';
        for ($i = 0; $i < $len; $i++) {
            if ($x == $l) $x = 0;
            $char .= substr($key, $x, 1);
            $x++;
        }
        for ($i = 0; $i < $len; $i++) {
            if (ord(substr($data, $i, 1)) < ord(substr($char, $i, 1))) {
                $str .= chr((ord(substr($data, $i, 1)) + 256) - ord(substr($char, $i, 1)));
            } else {
                $str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));
            }
        }
        return base64_decode($str);
    }
    
    /**
     * 获取客户端IP地址
     * @param integer $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
     * @return mixed
     */
    function get_client_ip($type = 0)
    {
        $type = $type ? 1 : 0;
        static $ip = NULL;
        if ($ip !== NULL) return $ip[$type];
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $pos = array_search('unknown', $arr);
            if (false !== $pos) unset($arr[$pos]);
            $ip = trim($arr[0]);
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        // IP地址合法验证
        $long = sprintf("%u", ip2long($ip));
        $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
        return $ip[$type];
    }
    
    /**
     * @Mark 获取客户端IP地址
     * @return string 10位随机数
     * @author fancs
     * @version 2017/5/12
     */
    function getRandOnlyId()
    {
        $arr = array();
        while (count($arr) < 9) {
            $arr[] = rand(1, 10);
            $arr   = array_unique($arr);
        }
        return implode("", $arr);
    }
    
    /**
     * @Mark 将IP地址变成整型存入数据库
     * @param  string $ip ip地址
     * @return int
     * @author yang
     * @version 2017/5/17
     */
    function ipToInt($ip)
    {
        $iparr = explode('.', $ip);
        $num   = 0;
        for ($i = 0; $i < count($iparr); $i++) {
            $num += intval($iparr[$i]) * pow(256, count($iparr) - ($i + 1));
        }
        return $num;
    }
    
    /**
     * @Mark 验证器
     * @param $model  模型
     * @param $data   验证的数据
     * @return \think\response\Json
     * @author Fancs
     */
    function get_validate($model, &$data)
    {
        //验证器
        $class = \think\Loader::parseClass(MODULE_NAME, 'validate', $model, false);
        //存在验证器刚执行
        if (class_exists($class)) {
            $validate = \think\Loader::validate($class);
            /*----  新增验证场景 star  修改人 fancs---*/
            if (!empty($data['scene'])) {
                $result = $validate->scene($data['scene'])->check($data);
                unset($data['scene']); //删除该字段，防止入库
            } else {
                $result = $validate->check($data);
            }
            /*----  新增验证场景 end  ---*/
            if (!$result) {
                return json(['code' => 0, 'msg' => $validate->getError()]);
            }
        }
        return false;
    }
    
    /**
     * @Mark: 获取排序地址
     * @param $field
     * @param $order
     * @return string
     * @Author: WangHuaLong
     */
    function getOrderUrl($field, $order)
    {
        $urlinput = input();
        $orders   = ['desc', 'asc'];
        if (in_array($order, $orders)) {
            $urlinput['_order'] = $order;
        } else {
            $urlinput['_order'] = 'asc';
        }
        $urlinput['_field'] = $field;
        return url('', $urlinput);
    }
    
    /**
     * @Mark: 生成图片略缩图
     * @param string $imgpath 图片的相对路径
     * @param string $size 图片的尺寸，可选 big,small,middle,thumb
     * @param bool $view 是否模板调用
     * @return bool $view 是否模板调用
     * @return string
     * @Author: WangHuaLong
     */
    function resizeImage($imgpath, $size = 'thumb', $view = false)
    {
        // 模板函数时需要重新规划图片路径前缀
        if ($view) {
            $request = \think\Request::instance();
            $base    = $request->root();
            $root    = strpos($base, '.') ? ltrim(dirname($base), DS) : $base;
            if ($root != '') {
                $root = '/' . ltrim($root, '/') . '/uploads/';
            } else {
                $root = '/uploads/';
            }
            
        } else {
            $root = '';
        }
        
        if (empty($imgpath)) return '';
        $original_path = $imgpath;
        // 获取图片格式,jpg,png 获取文件名称
        $ext  = substr(strrchr($original_path, '.'), 1);
        $name = basename($original_path, "." . $ext);
        // 图片真实路径
        $imgpath = 'public' . DS . 'uploads' . DS . $imgpath;
        $real    = realpath(ROOT_PATH . $imgpath);
        if (!is_file($real)) return '';
        $image = \think\Image::open($real);
        
        // 如果size是 100,100 的参数时
        if (strpos($size, ',') !== false) {
            $arr = explode(',', $size);
            if (is_file(dirname($real) . '/' . $name . '_' . $arr[0] . '_' . $arr[1] . '.' . $ext)) {
                if ($view) {
                    return $root . dirname($original_path) . '/' . $name . '_' . $arr[0] . '_' . $arr[1] . '.' . $ext;
                } else {
                    return dirname($original_path) . '/' . $name . '_' . $arr[0] . '_' . $arr[1] . '.' . $ext;
                }
                
            }
            $image->thumb($arr[0], $arr[1], \think\Image::THUMB_FILLED)->save(dirname($real) . '/' . $name . '_' . $arr[0] . '_' . $arr[1] . '.' . $ext);
            if ($view) {
                return $root . dirname($original_path) . '/' . $name . '_' . $arr[0] . '_' . $arr[1] . '.' . $ext;
            } else {
                return dirname($original_path) . '/' . $name . '_' . $arr[0] . '_' . $arr[1] . '.' . $ext;
            }
        }
        
        // 略缩图不存在则重新生成,big,middle,small,thumb 图片处理
        $Conf = APP_PATH . 'admin' . DS . 'extra' . DS . 'index.php';
        if (is_file($Conf)) \think\Config::load($Conf);
        switch ($size) {
            case 'big':
                $w = \think\Config::get('bigwidth') ? \think\Config::get('bigwidth') : 800;
                $h = \think\Config::get('bigheight') ? \think\Config::get('bigheight') : 800;
                break;
            case 'middle':
                $w = \think\Config::get('midwidth') ? \think\Config::get('midwidth') : 400;
                $h = \think\Config::get('midheight') ? \think\Config::get('midheight') : 400;
                break;
            case 'small':
                $w = \think\Config::get('smawidth') ? \think\Config::get('smawidth') : 58;
                $h = \think\Config::get('smaheight') ? \think\Config::get('smaheight') : 58;
                break;
            case 'thumb':
                $w = \think\Config::get('thuwidth') ? \think\Config::get('thuwidth') : 200;
                $h = \think\Config::get('thuheight') ? \think\Config::get('thuheight') : 200;
                break;
            default:
                $w = \think\Config::get('thuwidth') ? \think\Config::get('thuwidth') : 200;
                $h = \think\Config::get('thuheight') ? \think\Config::get('thuheight') : 200;
                break;
        }
        $size_name = '_' . $w . '_' . $h;
        if (!is_file(dirname($real) . '/' . $name . $size_name . '.' . $ext)) {
            $image->thumb($w, $h, \think\Image::THUMB_FILLED)->save(dirname($real) . '/' . $name . $size_name . '.' . $ext);
        }
        
        if ($view) {
            return $root . dirname($original_path) . '/' . $name . $size_name . '.' . $ext;
        } else {
            return dirname($original_path) . '/' . $name . $size_name . '.' . $ext;
        }
    }

    
