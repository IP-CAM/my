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
// | Stock.php  Version 2017/3/16  库存同步处理接口，最终交由插件数据进行处理
// +----------------------------------------------------------------------
namespace app\crossbbcg\controller\api\sync;

use app\common\libs\Sync;

class Stock extends Sync
{
    /**
     * @Mark:库存同步（接收）
     * @return bool
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/16
     */
    public function syncstockchangeinfo()
    {
        return true;
    }
}