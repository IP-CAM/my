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
// | 后台首页插件  -  警示信息 Version 1.0  2016/3/14
// +----------------------------------------------------------------------
namespace app\admin\index\widget;

class Warning {
    
    /**
     * @Mark:挂件配置
     * @return array
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/8
     */
    public function config()
    {
        return [
            'title'     => 'warning',
            'order'     => 1,   //位置
            'item'      => 5,   //显示条数
        ];
    }
    
    /**
     * @Mark:输出模板数据
     * @return string
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/8
     */
    public function gethtml()
    {
        return 'left';
    }
}