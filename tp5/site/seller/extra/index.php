<?php 
# +----------------------------------------------------------------------
# | ETshop [ Rapid development framework for Cross border Mall ]
# +----------------------------------------------------------------------
# | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
# +----------------------------------------------------------------------
# | Author: theseaer <theseaer@qq.com>
# +----------------------------------------------------------------------
# | By ShopCmf Auto Create File Version 2017/06/19 11:34:51
# +----------------------------------------------------------------------

return array (
  'auto_settle' => '1',
  'settleday' => '20',
  'platform_commission' => '10',
  'attpath' => 'uploads',
  'atttypes' => 'png,gif,jpg,doc.xls,zip',
  'attsize' => '20',
  'deposit' => '111',
  'accounts_auto_check' => '1',
  'freetype'=>[
      'weight'=>[
      
      ],
      'quanlity'=>[
      
      ]
  ],
  //邮费计价方式
  'fee'=>[
      //按重量
      'weight'=>[
          '1'   =>'weight',
          '2'   =>'money',
          '3'   =>'weight+money'
      ],
      //按件数
      'quantity'=>[
          '1'   =>'quantity',
          '2'   =>'money',
          '3'   =>'quantity+money'
      ],
      //按金额
      'money'=>[]
  ]
);
