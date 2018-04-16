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
// | Stockget.php  Version 2017/3/16
// +----------------------------------------------------------------------
namespace app\crossbbcg\dev\hook;

class Stockget
{
    /**
     * @Mark:根据货号，编码，条码等共聚远程库存
     * @param array $Itemno
     * @return int
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/16
     */
    public function getstock($Itemno = [])
    {
        return 0;
    }
}