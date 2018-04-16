<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Seller.php  Version 1.0  2017/6/2
// +----------------------------------------------------------------------

namespace app\seller\validate;
use think\Validate;


class Store extends Validate
{
    /**
     * @Mark:验证规则
     * @var array
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/2
     */
    protected $rule = [
        ['seller_id','require|unique:Store','{%id_must}|{%seller_id_exist}'],
        ['seller_name','require|unique:Store','{%sellerName_must}|{%sellerName_unique}'],
        ['email','email|unique:Store','{%email_error}|{%email_exist}'],
        ['mobile','^1[34578]{1}\d{9}$|unique:Store','{%mobile_format_error}|{%mobile_exist}'],
        ['company','require','{%company_must}'],
        ['license_no','require','{%license_must}'],
        ['business_license','require','{%business_license_must}'],
        ['tax_registration_certificate','require','{%tax_certficate_must}'],
        ['corporate','require','{%corporate_must}'],
        ['organization_code','require','{%organization_code_must}'],
        ['province','require','{%province_must}'],
        ['city','require','{%city_must}'],
        ['district','require','{%area_must}'],
        ['address','require','{%address_must}'],
        ['after_sale_address','require','{%after_sale_address_must}'],
        ['bank','require','{%bank_must}'],
        ['bank_no','require','{%bank_no_must}'],
        ['bank_name','require','{%bank_name_must}'],
        ['bank_address','require','{%bank_address_must}'],
        ['shop_description','require','{%description_must}'],
        ['business_license_type','require','{%business_license_type_must}'],
        ['build_time','require','{%build_time_must}'],
        ['registered_assets','require','{%registered_assets_must}'],
        ['taxpayer_type','require','{%taxpayer_type_must}'],
        ['tax_code_type','require','{%tax_code_type_must}'],
        ['linkname','require','{%linkname_must}'],
        ['corporate_card_true','require','{%corporate_card_true_must}'],
        ['corporate_card_false','require','{%corporate_card_false_must}'],
        ['organization_code_date_end','require','{%organization_code_date_end_must}'],
        ['organization_code_date_start','require','{%organization_code_date_start_must}'],
        ['organization_code_img','require','{%organization_code_img_must}'],
    ];
    
    /**
     * @Mark:验证场景
     * @var array
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/2
     */
    protected $scene = [
        'edit'                  =>              ['mobile'],
        'company_info'          =>              [
            'business_license_type',
            'company',
            'license_no',
            'corporate',
            'build_time',
            'registered_assets',
            'taxpayer_type',
            'tax_code_type',
            'country',
            'province',
            'city',
            'address',
            'linkname',
            'mobile',
            'corporate_card_true',
            'corporate_card_false',
            'business_license',
            'tax_registration_certificate',
            'organization_code',
            'organization_code_date_start',
            'organization_code_date_end',
            'organization_code_img'
        ],
        'add'                   =>              [
            'seller_id',
            'seller_name',
            'business_license_type',
            'company',
            'license_no',
            'corporate',
            'build_time',
            'registered_assets',
            'taxpayer_type',
            'tax_code_type',
            'bank',
            'bank_no',
            'bank_name',
            'bank_address',
            'country',
            'province',
            'city',
            'address',
            'linkname',
            'mobile',
            'corporate_card_true',
            'corporate_card_false',
            'business_license',
            'tax_registration_certificate',
            'organization_code',
            'organization_code_date_start',
            'organization_code_date_end',
            'organization_code_img'
        ],
        'set_store'             =>              ['cash'],
    ];
}