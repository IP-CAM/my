<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>  Version 1.0  2016/3/12
// +----------------------------------------------------------------------

/**
 * 目录，文件读写检测
 * @return array 检测数据
 */
function check_dirfile()
{
    $items = array(
        array('dir', '可写', 'success', 'static/uploads/download'),
        array('dir', '可写', 'success', 'static/uploads/picture'),
        array('dir', '可写', 'success', 'static/uploads/editor'),
    );
    
    foreach ($items as &$val) {
        $item = INSTALL_APP_PATH . $val[3];
        if ('dir' == $val[0]) {
            if (!is_writable($item)) {
                echo $item;
                if (is_dir($items)) {
                    $val[1] = '可读';
                    $val[2] = 'error';
                    session('error', true);
                } else {
                    $val[1] = '不存在';
                    $val[2] = 'error';
                    session('error', true);
                }
            }
        } else {
            if (file_exists($item)) {
                if (!is_writable($item)) {
                    $val[1] = '不可写';
                    $val[2] = 'error';
                    session('error', true);
                }
            } else {
                if (!is_writable(dirname($item))) {
                    $val[1] = '不存在';
                    $val[2] = 'error';
                    session('error', true);
                }
            }
        }
    }
    
    return $items;
}

/**
 * @Mark:解析schame文件,生成SQL语句
 * @param $data array schame文件数据数组
 * @Author: yang <502204678@qq.com>
 * @Version 2017/9/2
 * @return string
 */
function analysis_schama($data)
{
    $sql = '';
    foreach ($data['columns'] as $k => $v) {
        $sql .= "`$k` ";
        if (isset($v['extra']) && !empty($v['extra'])) {
            $sql .= getDataType($v['type'], $v['extra']);
        } else {
            $sql .= getDataType($v['type']);
        }
        if (isset($v['default'])) $sql .= ' DEFAULT ' . $v['default'];
        //if (isset($v['pkey']) === true) $sql .=' key';
        if (isset($v['autoincrement']) === true) $sql .= ' AUTO_INCREMENT ';
        if (isset($v['comment'])) $sql .= " COMMENT '" . $v['comment'] . '\'';
        $sql .= ",\n";
    }
    if (isset($data['primaryKey']) && !empty($data['primaryKey'])) $sql .= ' PRIMARY KEY (' . implode(',', (array)$data['primaryKey']) . "), \n";
    if (isset($data['index']) && !empty($data['index']) && is_array($data['index'])) {
        foreach ($data['index'] as $kk => $vv) {
            $sql .= ' KEY `' . $kk . '` (' . implode(',', (array)$vv) . "), \n";
        }
    }
    return substr($sql, 0, strripos($sql, ','));
}


function getSubDirs($dir)
{
    $subdirs = array();
    if (!$dh = opendir($dir))
        return $subdirs;
    $i = 0;
    while ($f = readdir($dh)) {
        if ($f == '.' || $f == '..')
            continue;
        //如果只要子目录名, path = $f;
        //$path = $dir.'/'.$f;
        $path        = $f;
        $subdirs[$i] = $path;
        $i++;
    }
    return $subdirs;
    
}


function testwrite( $d )
{
    $tfile = "_test.txt";
    $fp = @fopen( $d."/".$tfile, "w" );
    if ( !$fp )
    {
        return false;
    }
    fclose( $fp );
    $rs = @unlink( $d."/".$tfile );
    if ( $rs )
    {
        return true;
    }
    return false;
}


function  sql_split($sql,$tablepre) {
    
    if($tablepre != "rt_") $sql = str_replace("rt_", $tablepre, $sql);
    //$sql = preg_replace("/TYPE=(InnoDB|MyISAM|MEMORY)( DEFAULT CHARSET=[^; ]+)?/", "ENGINE=\\1 DEFAULT CHARSET=utf8",$sql);
    
    if($r_tablepre != $s_tablepre) $sql = str_replace($s_tablepre, $r_tablepre, $sql);
    $sql = str_replace("\r", "\n", $sql);
    $ret = array();
    $num = 0;
    $queriesarray = explode(";\n", trim($sql));
    unset($sql);
    foreach($queriesarray as $query)
    {
        $ret[$num] = '';
        $queries = explode("\n", trim($query));
        $queries = array_filter($queries);
        foreach($queries as $query)
        {
            $str1 = substr($query, 0, 1);
            if($str1 != '#' && $str1 != '-') $ret[$num] .= $query;
        }
        $num++;
    }
    return $ret;
}