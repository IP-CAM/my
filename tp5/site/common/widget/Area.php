<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Area.php  Version 2017/9/2
// +----------------------------------------------------------------------
namespace app\common\widget;

use think\Controller;

class Area extends Controller
{
    /**
     * @Mark:地区挂件
     * @param $country
     * @param $province
     * @param $city
     * @param $district
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/2
     */
    public function choosearea($country = '', $province = '', $city = '', $district = '')
    {
        $this->assign('country', $country);
        $this->assign('province', $province);
        $this->assign('city', $city);
        $this->assign('district', $district);
        return $this->fetch(APP_PATH. 'common/view/public/choosearea.html');
    }
    
    /**
     * @Mark:显示国家列表
     * @param $id
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/2
     */
    public function country($country = '', $country_id = '')
    {
        $this->assign('country', $country);
        $this->assign('country_id', $country_id);
        return $this->fetch(APP_PATH. 'common/view/public/country.html');
    }
}