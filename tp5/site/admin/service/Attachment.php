<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Attachment.php  Version 2017/7/23  附件API
// +----------------------------------------------------------------------
namespace app\admin\service;

use app\admin\model\Attachment as AttachmentModel;

class Attachment extends Service
{
    /**
     * @Mark:新增附件
     * @param array $data = [
     *   'name'          => $data['name'],
         'path'          => $data['path'],
         'size'          => $data['size'],
         'type'          => $data['type'],
         'module'        => $data['module'],
         'create_time'   => time(),
         'uid'           => $data['uid'],
         'langid'        => $data['langid'],
     * ]
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/13
     */
    static public function addpic($data)
    {
        AttachmentModel::insert([
            'name'          => $data['name'],
            'path'          => $data['path'],
            'size'          => $data['size'],
            'type'          => $data['type'],
            'module'        => $data['module'],
            'create_time'   => time(),
            'uid'           => $data['uid'],
            'langid'        => $data['langid'],
        ]);
    }
    
    /**
     * @Mark:批量删除图片
     * @param $path
     * $path = '图片路径1;图片路径2;图片路径3';
     * $path = [
     *   0 => 路径1，
     *   1 => 路径2，
     *   2 => 路径3，
     * ];
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/13
     */
    static public function delpic(&$path, $f = ',')
    {
        //数组方式传递
        if(is_array($path))
        {
        
        }
    
        //以分隔符号传递进来
        if(strpos($path, $f) !== false)
        {
        
        }
        
    }
}