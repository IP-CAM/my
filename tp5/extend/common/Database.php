<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2012 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace common;

use think\Db;

//数据导出模型
class Database
{
    /**
     * 文件指针
     * @var resource
     */
    private $fp;
    
    /**
     * 备份文件信息 part - 卷号，name - 文件名
     * @var array
     */
    private $file;
    
    /**
     * 当前打开文件大小
     * @var integer
     */
    private $size = 0;
    
    /**
     * 备份配置
     * @var integer
     */
    private $config;
    
    /**
     * 数据库备份构造方法
     * @param array $file 备份或还原的文件信息
     * @param array $config 备份配置信息
     * @param string $type 执行类型，export - 备份数据， import - 还原数据
     */
    public function __construct($file, $config, $type = 'export')
    {
        $this->file = $file;
        $this->config = $config;
    }
    
    /**
     * 打开一个卷，用于写入数据
     * @param  integer $size 写入数据的大小
     */
    private function open($size)
    {
        if ($this->fp) {
            $this->size += $size;
            if ($this->size > $this->config['part']) {
                $this->config['compress'] ? @gzclose($this->fp) : @fclose($this->fp);
                $this->fp = null;
                $this->file['part']++;
                session('backup_file', $this->file);
                $this->create();
            }
        } else {
            $backuppath = $this->config['path'];
            $filename = "{$backuppath}{$this->file['name']}-{$this->file['part']}.sql";
            if ($this->config['compress']) {
                $filename = "{$filename}.gz";
                $this->fp = @gzopen($filename, "a{$this->config['level']}");
            } else {
                $this->fp = @fopen($filename, 'a');
            }
            $this->size = filesize($filename) + $size;
        }
    }
    
    /**
     * 写入初始数据
     * @return boolean true - 写入成功，false - 写入失败
     */
    public function create()
    {
        $sql = "-- -----------------------------\n";
        $sql .= "-- Think MySQL Data Transfer \n";
        $sql .= "-- \n";
        $sql .= "-- Host     : " . config('database')['hostname'] . "\n";
        $sql .= "-- Port     : " . config('database')['hostport'] . "\n";
        $sql .= "-- Database : " . config('database')['database'] . "\n";
        $sql .= "-- \n";
        $sql .= "-- Part : #{$this->file['part']}\n";
        $sql .= "-- Date : " . date("Y-m-d H:i:s") . "\n";
        $sql .= "-- -----------------------------\n\n";
        $sql .= "SET FOREIGN_KEY_CHECKS = 0;\n\n";
        return $this->write($sql);
    }
    
    /**
     * 写入SQL语句
     * @param  string $sql 要写入的SQL语句
     * @return boolean     true - 写入成功，false - 写入失败！
     */
    private function write($sql)
    {
        $size = strlen($sql);
        
        //由于压缩原因，无法计算出压缩后的长度，这里假设压缩率为50%，
        //一般情况压缩率都会高于50%；
        $size = $this->config['compress'] ? $size / 2 : $size;
        
        $this->open($size);
        return $this->config['compress'] ? @gzwrite($this->fp, $sql) : @fwrite($this->fp, $sql);
    }
    
    /**
     * 备份表结构
     * @param  string $table 表名
     * @param  integer $start 起始行数
     * @return boolean        false - 备份失败
     */
    public function backup($table, $start)
    {
        //备份表结构
        if (0 == $start) {
            $this->write_schame($table);
            $result = Db::query("SHOW CREATE TABLE `{$table}`");
            $sql = "\n";
            $sql .= "-- -----------------------------\n";
            $sql .= "-- Table structure for `{$table}`\n";
            $sql .= "-- -----------------------------\n";
            $sql .= "DROP TABLE IF EXISTS `{$table}`;\n";
            $sql .= trim($result[0]['Create Table']) . ";\n\n";
            if (false === $this->write($sql)) {
                return false;
            }
        }
        
        //数据总数
        $result = Db::query("SELECT COUNT(*) AS count FROM `{$table}`");
        $count = $result['0']['count'];
        
        //备份表数据
        if ($count) {
            //写入数据注释
            if (0 == $start) {
                $sql = "-- -----------------------------\n";
                $sql .= "-- Records of `{$table}`\n";
                $sql .= "-- -----------------------------\n";
                $this->write($sql);
            }
            
            //备份数据记录
            $result = Db::query("SELECT * FROM `{$table}` LIMIT {$start}, 1000");
            foreach ($result as $row) {
                $row = array_map('addslashes', $row);
                $sql = "INSERT INTO `{$table}` VALUES ('" . str_replace(array("\r", "\n"), array('\r', '\n'), implode("', '", $row)) . "');\n";
                if (false === $this->write($sql)) {
                    return false;
                }
            }
            
            //还有更多数据
            if ($count > $start + 1000) {
                return array($start + 1000, $count);
            }
        }
        
        //备份下一表
        return 0;
    }
    
    /**
     * @Mark:数据恢复
     * @param $start int 文件指针位置
     * @return array|bool|int
     * @Author: yang <502204678@qq.com>
     * @Version 2017/8/30
     */
    public function import($start)
    {
        if ($this->config['compress']) {
            $gz = gzopen($this->file[1], 'r');//打开压缩文件
            $size = 0;
        } else {
            $size = filesize($this->file[1]);//返回文件大小
            $gz = fopen($this->file[1], 'r');//打开普通文件
        }
        
        $sql = '';
        if ($start) {
            $this->config['compress'] ? gzseek($gz, $start) : fseek($gz, $start);
        }
        
        for ($i = 0; $i < 1000; $i++) {
            $sql .= $this->config['compress'] ? gzgets($gz) : fgets($gz);
            if (preg_match("/.*;$/", trim($sql))) {
                if (false !== Db::execute($sql)) {
                    $start += strlen($sql);
                } else {
                    return false;
                }
                $sql = '';
            } elseif ($this->config['compress'] ? gzeof($gz) : feof($gz)) {
                return 0;
            }
        }
        return array($start, $size);
    }
    
    /**
     * @Mark:写入模块数据库描述文件
     * @param $table string 表名
     * @Author: yang <502204678@qq.com>
     * @Version 2017/8/31
     * @return boolean
     */
    public function write_schame($table){
        //获取模块名和对应表名
        $arr = explode('_',$table);
        $module_name = $arr[1];
        unset($arr[0]);//删除表前缀
        unset($arr[1]);//删除模块名
        $table_name = implode('_',$arr);
        //查询表结构信息
        $sql = "show full fields from {$table}";
        $result_arr = Db::query($sql);
        $return_arr = [];
        foreach ($result_arr as $v) {
            $return_arr['columns'][$v['Field']] = [
                'type'=>$v['Type'],
            ];
            if(!empty($v['Key'])) $return_arr['columns'][$v['Field']]['key'] = $v['Key'];
            if(!empty($v['Extra'])) $return_arr['columns'][$v['Field']]['extra'] = $v['Extra'];
            if(!empty($v['Default'])) $return_arr['columns'][$v['Field']]['default'] = $v['Default'];
            if(!empty($v['Comment'])) $return_arr['columns'][$v['Field']]['comment'] = $v['Comment'];
        }
        //查询索引
        $index_arr = Db::query("SHOW INDEX FROM $table");
        foreach($index_arr as $v){
            if ($v['Key_name'] == 'PRIMARY') {
                $return_arr['primary'][]=$v['Column_name'];
            } else {
                $return_arr['index'][$v['Key_name']][]=$v['Column_name'];
            }
        }
        //查询表注释
        $comment_info = Db::query("SHOW TABLE STATUS WHERE `Name`='{$table}'");
        $return_arr['comment'] = $comment_info[0]['Comment'];
        //写文件
        try{
            if (file_exists(realpath(APP_PATH.$module_name) . DS . 'schema')) {
                file_put_contents(realpath(APP_PATH.$module_name) . DS . 'schema'. DS . $table_name. '.php', "<?php \n".self::getnote()."\n\nreturn ".var_export($return_arr,true).";\n");
            }
        }catch (\Exception $e){
            \think\Log::write($e->getMessage());
            return false;
        }
        return true;
    }
    
    /**
     * @Mark:为自动创建的文件添加注释
     * @param string $str
     * @return string
     * @Author: yang <502204678@qq.com>
     * @Version 2017/8/31
     */
    public static function getnote($str = 'By ShopCmf Auto Create File Version')
    {
        $days = date('Y/m/d H:i:s');
        $str = <<<EOF
# +----------------------------------------------------------------------
# | ETshop [ Rapid development framework for Cross border Mall ]
# +----------------------------------------------------------------------
# | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
# +----------------------------------------------------------------------
# | Author: yang <502204678@qq.com>
# +----------------------------------------------------------------------
# | {$str} {$days}
# +----------------------------------------------------------------------
EOF;
        return $str;
    }
    
    /**
     * 析构方法，用于关闭文件资源
     */
    public function __destruct()
    {
        $this->config['compress'] ? @gzclose($this->fp) : @fclose($this->fp);
    }
}