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
// | Rdb.php Version 1.0  2016/3/14 数据库备份还原工具
// +----------------------------------------------------------------------
namespace app\admin\controller;

use think\Db;
use think\Request;

class Rdb extends Admin
{
    /**
     * @Mark:罗列数据库中的数据表
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/31
     */
    public function index()
    {
        $Db    = Db::connect();
        $list  = $Db->query('SHOW TABLE STATUS');
        $list  = array_map('array_change_key_case', $list);
    
        //渲染模板
        $this->assign('meta_title', lang('Rdb'));
        $this->assign('list', $list);
        return $this->fetch();
    }
    
    /**
     * @Mark:备份列表
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/31
     */
    public function backlist()
    {
        //列出备份文件列表
        $path = realpath(DATA_BACKUP_PATH);
        $flag = \FilesystemIterator::KEY_AS_FILENAME;
        $glob = new \FilesystemIterator($path,  $flag);
    
        $list = array();
        foreach ($glob as $name => $file) {
            if(preg_match('/^\d{8,8}-\d{6,6}-\d+\.sql(?:\.gz)?$/', $name)){
                $name = sscanf($name, '%4s%2s%2s-%2s%2s%2s-%d');
            
                $date = "{$name[0]}-{$name[1]}-{$name[2]}";
                $time = "{$name[3]}:{$name[4]}:{$name[5]}";
                $part = $name[6];
            
                if(isset($list["{$date} {$time}"])){
                    $info = $list["{$date} {$time}"];
                    $info['part'] = max($info['part'], $part);
                    $info['size'] = $info['size'] + $file->getSize();
                } else {
                    $info['part'] = $part;
                    $info['size'] = $file->getSize();
                }
                $extension        = strtoupper(pathinfo($file->getFilename(), PATHINFO_EXTENSION));
                $info['compress'] = ($extension === 'SQL') ? '-' : $extension;
                $info['time']     = strtotime("{$date} {$time}");
            
                $list["{$date} {$time}"] = $info;
            }
        }
    
        //渲染模板
        $this->assign('meta_title', lang('Importdatabase'));
        $this->assign('list', $list);
        return $this->fetch();
    }

    /**
     * 数据库备份/还原列表
     * @param  String $type import-还原，export-备份
     */
    public function index00($type = 'export'){
        switch ($type) {
            /* 数据还原 */
            case 'import':
                
                break;

            /* 数据备份 */
            case 'export':
                $Db    = \think\Db::connect();
                $list  = $Db->query('SHOW TABLE STATUS');
                $list  = array_map('array_change_key_case', $list);
                $title = lang('Rdb');
                break;

            default:
                $this->error(lang('Error_id'));
        }

        //渲染模板
        $this->assign('meta_title', $title);
        $this->assign('list', $list);
        return $this->fetch();
    }

    /**
     * 优化表
     * @param  String $tables 表名
     */
    public function optimize(){
        $input  = $this->request->param();
        $tables = isset($input['tables']) ? (array)$input['tables'] : '';
        empty($tables) && $this->error(lang('Appoint_db')) ;
        $Db     = Db::connect();
        if($tables) {
            if(is_array($tables)){
                $tables = implode('`,`', $tables);
                $list   = $Db->query("OPTIMIZE TABLE `{$tables}`");
                if($list){
                    $this->success(lang('Optimize_ok'));
                } else {
                    $this->error(lang('Optimize_error_retry'));
                }
            } else {
                $list = $Db->query("OPTIMIZE TABLE `{$tables}`");
                if($list){
                    $this->success(lang('Db_table')."'{$tables}'".lang('Optimize_good'));
                } else {
                    $this->error(lang('Db_table')."'{$tables}'".lang('Optimize_bad'));
                }
            }
        } else {
            $this->error(lang('Appoint_db'));
        }
    }

    /**
     * 修复表
     * @param  String $tables 表名
     */
    public function repair($tables = null){
        if($tables) {
            $Db   = Db::connect();
            if(is_array($tables)){
                $tables = implode('`,`', $tables);
                $list = $Db->query("REPAIR TABLE `{$tables}`");

                if($list){
                    $this->success(lang('Repair_ok'));
                } else {
                    $this->error(lang('Repair_error'));
                }
            } else {
                $list = $Db->query("REPAIR TABLE `{$tables}`");
                if($list){
                    $this->success(lang('Db_table')."'{$tables}'".lang('Repair_good'));
                } else {
                    $this->error(lang('Db_table')."'{$tables}'".lang('Repair_bad'));
                }
            }
        } else {
            $this->error(lang('Repair_appoint_db'));
        }
    }
    
    /**
     * @Mark:删除备份文件
     * @param int $time
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/1/22
     */
    public function del($time = 0){
        if($this->request->isPost()){
            foreach ((array)$_POST['ids'] as $r){
                $name  = date('Ymd-His', $r) . '-*.sql*';
                $path  = realpath(config('data_backup_path')) . DIRECTORY_SEPARATOR . $name;
                array_map("unlink", glob($path));
            }
            $this->success(lang('Backup_del_ok'));
        }
        if($time){
            $name  = date('Ymd-His', $time) . '-*.sql*';
            $path  = realpath(config('data_backup_path')) . DIRECTORY_SEPARATOR . $name;
            array_map("unlink", glob($path));
            if(count(glob($path))){
                $this->error(lang('Backup_del_fail'));
            } else {
                $this->success(lang('Backup_del_ok'));
            }
        } else {
            $this->error(lang('Error_id'));
        }
    }

    /**
     * 备份数据库
     * @param  String  $tables 表名
     * @param  Integer $id     表ID
     * @param  Integer $start  起始行数
     */
    public function export($tables = null, $id = null, $start = null){
        if($this->request->isPost() && !empty($tables) && is_array($tables)){ //初始化
            //$path = config('data_backup_path');
            $path = realpath(DATA_BACKUP_PATH);
            if(!is_dir($path)){
                mkdir($path, 0755, true);
            }
            //读取备份配置
            $config = array(
                'path'     => realpath($path) . DIRECTORY_SEPARATOR,
                'part'     => '20971520',//C('DATA_BACKUP_PART_SIZE'),
                'compress' => 1,//C('DATA_BACKUP_COMPRESS'),是否压缩
                'level'    => 9//C('DATA_BACKUP_COMPRESS_LEVEL'),
            );

            //检查是否有正在执行的任务
            $lock = "{$config['path']}backup.lock";
            if(is_file($lock)){
                $this->error(lang('Check_one_backup_thread'));
            } else {
                //创建锁文件
                file_put_contents($lock, time());
            }

            //检查备份目录是否可写
            if (!is_writeable($config['path'])) $this->error(lang('Backup_dir_error'));
            session('backup_config', $config);

            //生成备份文件信息
            $file = array(
                'name' => date('Ymd-His', time()),
                'part' => 1,
            );
            session('backup_file', $file);

            //缓存要备份的表
            session('backup_tables', $tables);

            //创建备份文件
            $Database = new \common\Database($file, $config);
            if(false !== $Database->create()){
                $tab = array('id' => 0, 'start' => 0);
                $this->success(lang('Initialize_ok'), '', array('tables' => $tables, 'tab' => $tab));
            } else {
                $this->error(lang('Initialize_error'));
            }
        } elseif ($this->request->isGet() && is_numeric($id) && is_numeric($start)) { //备份数据
            $tables = session('backup_tables');
            //备份指定表
            $Database = new \common\Database(session('backup_file'), session('backup_config'));
            $start  = $Database->backup($tables[$id], $start);
            if(false === $start){ //出错
                $this->error(lang('Backup_error'));
            } elseif (0 === $start) { //下一表
                if(isset($tables[++$id])){
                    $tab = array('id' => $id, 'start' => 0);
                    $this->success(lang('Backup_success'), '', array('tab' => $tab));
                } else { //备份完成，清空缓存
                    unlink(session('backup_config.path') . 'backup.lock');
                    session('backup_tables', null);
                    session('backup_file', null);
                    session('backup_config', null);
                    $this->success(lang('Backup_success'));
                }
            } else {
                $tab  = array('id' => $id, 'start' => $start[0]);
                $rate = floor(100 * ($start[0] / $start[1]));
                $this->success(lang('Backup_doing')."({$rate}%)", '', array('tab' => $tab));
            }

        } else { //出错
            $this->error(lang('Error_id'));
        }
    }
    
    /**
     * @Mark:还原数据库
     * @param int $time
     * @param null $part
     * @param null $start
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/1/22
     */
    public function import($time = 0, $part = null, $start = null){
        if(is_numeric($time) && is_null($part) && is_null($start)){ //初始化
            //获取备份文件信息
            $name  = date('Ymd-His', $time) . '-*.sql*';
            $path  = realpath(DATA_BACKUP_PATH) . DIRECTORY_SEPARATOR . $name;
            $files = glob($path);
            $list  = array();
            foreach($files as $name){
                $basename = basename($name);
                $match    = sscanf($basename, '%4s%2s%2s-%2s%2s%2s-%d');
                $gz       = preg_match('/^\d{8,8}-\d{6,6}-\d+\.sql.gz$/', $basename);
                $list[$match[6]] = array($match[6], $name, $gz);
            }
            ksort($list);
            //检测文件正确性
            $last = end($list);
            if(count($list) === $last[0]){
                session('backup_list', $list); //缓存备份列表
                $this->success(lang('Initialize_ok'), '', array('part' => 1, 'start' => 0));
            } else {
                $this->error(lang('Backup_file_bad'));
            }
        } elseif(is_numeric($part) && is_numeric($start)) {
            $list  = session('backup_list');
            $db = new \common\Database($list[$part], array(
                'path'     => realpath(config('data_backup_path')) . DIRECTORY_SEPARATOR,
                'compress' => $list[$part][2]));

            $start = $db->import($start);

            if(false === $start){
                $this->error(lang('Reduction_error'));
            } elseif(0 === $start) { //下一卷
                if(isset($list[++$part])){
                    $data = array('part' => $part, 'start' => 0);
                    $this->success(lang('Reduction_doing')."#{$part}", '', $data);
                } else {
                    session('backup_list', null);
                    $this->success(lang('Reduction_good'));
                }
            } else {
                $data = array('part' => $part, 'start' => $start[0]);
                if($start[1]){
                    $rate = floor(100 * ($start[0] / $start[1]));
                    $this->success(lang('Reduction_doing')."#{$part} ({$rate}%)", '', $data);
                } else {
                    $data['gz'] = 1;
                    $this->success(lang('Reduction_doing')."#{$part}", '', $data);
                }
            }

        } else {
            $this->error(lang('Error_id'));
        }
    }

    /**
     * @Mark:执行SQL
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/10/16
     */
    public function excute(){
        if($this->request->isPost()){
            $sqls=explode("\n",stripcslashes($_POST['sqls']));
            foreach ((array)$sqls as $sql){
                if($sql) $r =$this->excuteQuery($sql);
            }
            if($r['result'] !=''){
                $this->success(lang('Excute_ok'));
            }else{
                $this->error(lang($r['dberror']));
            }
        }else{
			$this->assign ("meta_title", lang('Customsql'));
			return $this->fetch();
        }
    }
    
    /**
     * @Mark:执行语句
     * @param string $sql
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/1/22
     */
    public function excuteQuery($sql=''){
        if(empty($sql)) {
            $this->error(lang('Sql_empty'));
        }
        $queryType = 'INSERT|UPDATE|DELETE|REPLACE|CREATE|DROP|LOAD DATA|SELECT .* INTO|COPY|ALTER|GRANT|TRUNCATE|REVOKE|LOCK|UNLOCK';
        if (preg_match('/^\s*"?(' . $queryType . ')\s+/i', $sql)) {
            try{
                $data['result'] = Db::query($sql);
            }catch (\Exception $e){
                $data['result'] = '';
                $data['dberror'] = $e->getMessage();
            }
            $data['type'] = 'execute';
        }else {
            try{
                $data['result'] = Db::query($sql);
            }catch (\Exception $e){
                $data['result'] = '';
                $data['dberror'] = $e->getMessage();
            }
            $data['type'] = 'query';

        }
        return $data;
    }
}