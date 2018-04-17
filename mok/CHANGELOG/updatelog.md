功能迭代记录日志,从下往上写
20170112
新增微信登录
/catalog/controller/extension/module/weixin_login.php
/catalog/view/theme/default/template/extension/module/weixin_login.tpl
/back/controller/extension/module/weixin_login.php
/back/language/en-gb/extension/module/weixin_login.php
/back/language/zh-cn/extension/module/weixin_login.php
/back/view/template/extension/module/weixin_login.tpl
/catalog/controller/startup/weixin.php
/catalog/language/en-gb/extension/module/weixin_login.php
/catalog/language/zh-cn/extension/module/weixin_login.php

20170111
新增新人礼包
/catalog/controller/weixin/gift.php
/catalog/language/en-gb/weixin/gift.php
/catalog/language/zh-cn/weixin/gift.php
/catalog/model/weixin/gift.php

新增商品多选项功能
/vqmod/xml/option_to_product_oc2302.xml

20170110
订单
/vqmod/xml/account_order.xml

20170109
活动
/back/controller/marketing/topic.php
/back/language/en-gb/marketing/topic.php
/back/language/zh-cn/marketing/topic.php
/back/model/marketing/topic.php
/back/view/template/marketing/topic_form.tpl
/back/view/template/marketing/topic_history.tpl
/back/view/template/marketing/topic_list.tpl
/back/view/template/cms/buyer_info_list.tpl

修改结帐页面,修改controller,view,language
/catalog/controller/checkout
/catalog/language/en-gb/checkout/checkout.php
/catalog/language/zh-cn/checkout/checkout.php
/catalog/view/theme/default/image/alipay.png
/catalog/view/theme/default/template/checkout
/catalog/view/theme/default/template/weixin/checkout_success.tpl
/vqmod/xml/catalog_controller_checkout_success.xml

20170107
评论
/vqmod/xml/cart_customer.xml
/catalog/language/en-gb/weixin/review.php
/catalog/language/zh-cn/weixin/review.php

20170106
/catalog/language/en-gb/account/attention_buyer.php
/catalog/language/zh-cn/account/attention_buyer.php

20170105
买手
/back/view/template/cms/add_buyer.tpl
/catalog/model/extension/module/buyer.php

20170104
新增后台买手发布，买手管理
/back/controller/cms/buyer.php
/back/language/en-gb/cms/buyer.php
/back/language/zh-cn/cms/buyer.php
/back/view/template/cms/buyer_list.tpl
/back/model/cms/buyer.php
/back/view/template/cms/buyer_info.tpl

新增后台多图上传功能
/back/controller/common/multifilemanager.php
/back/language/english/common/multifilemanager.php
/back/view/javascript/jquery/fileupload
/back/view/javascript/summernote/opencart.js.bak
/back/view/template/common/multifilemanager.tpl
/system/library/multifileupload.php
/vqmod/xml/multifilemanager.xml

修改商品获取数量
/vqmod/xml/admin_view_catalog_product_form.ocmod.xml
/vqmod/xml/attribute.xml
/vqmod/xml/admin_product_option.xml

20170103
新增评论
/catalog/view/theme/default/template/weixin/blog_comment.tpl
/catalog/view/theme/default/template/weixin/evaluate_list.tpl
/catalog/view/theme/default/script/ok_blog_comment.js
/vqmod/xml/review.xml
/catalog/view/theme/default/template/weixin/track_order.tpl

20161230
新增错误页面,404页面,空购物车页面,
/catalog/view/theme/default/css/error.css
/catalog/view/theme/default/images/cart/cart.png
/catalog/view/theme/default/images/public/404.png
/catalog/view/theme/default/images/public/qq.png
/catalog/view/theme/default/images/public/weibo.png
/catalog/view/theme/default/images/public/weixin.png
/catalog/view/theme/default/page/empty_cart.html
/catalog/view/theme/default/page/error.html
/catalog/view/theme/default/script/ok_resize.js
/vqmod/xml/weixin_404.xml
/catalog/view/theme/default/css/empty_cart.css
/catalog/view/theme/default/template/error/empty_cart.tpl
/error
/vqmod/xml/mysqli_error.xml

20161227
新增忘记密码
/catalog/view/theme/default/template/weixin/bound_phone.tpl
/catalog/view/theme/default/template/weixin/find_password.tpl
/vqmod/xml/forgotten_password.xml
/catalog/controller/weixin/bound_phone.php
/CHANGELOG/db/login_info/oc_qq_connect.sql
/CHANGELOG/db/order
/CHANGELOG/db/order/oc_order_product_ext.sql
/CHANGELOG/db/sms/oc_telephone_captcha.sql
/CHANGELOG/db/coupon/oc_customer_coupons.sql
/CHANGELOG/db/pricing
/CHANGELOG/db/pricing/oc_pricing.sql
/CHANGELOG/db/pricing/oc_pricing_customer.sql
/CHANGELOG/db/coupon/oc_customer_coupons.sql
/CHANGELOG/db/manufacturer
/CHANGELOG/db/manufacturer/oc_manufacturer_ext.sql
/CHANGELOG/db/attention_and_collect/oc_customer_attention.sql
/CHANGELOG/db/attention_and_collect/oc_customer_collect.sql
/CHANGELOG/db/blog/oc_blog_ext.sql

20161226
新增商品评论，买手，账户安全
/catalog/view/theme/default/template/weixin/review.tpl
/catalog/controller/weixin/review.php
/back/controller/extension/module/buyer.php
/back/language/en-gb/extension/module/buyer.php
/back/language/zh-cn/extension/module/buyer.php
/back/view/template/extension/module/buyer.tpl
/catalog/controller/extension/module/buyer.php
/catalog/view/theme/default/template/extension/module/buyer.tpl
/catalog/view/theme/default/script/ok_account_safe.js
/catalog/view/theme/default/template/weixin/modify_password.tpl
/catalog/view/theme/default/template/weixin/account_safe.tpl
/catalog/language/en-gb/extension/module/buyer.php
/catalog/language/zh-cn/extension/module/buyer.php
/catalog/view/theme/default/template/weixin/bound_phone.html
/catalog/view/theme/default/template/weixin/retrieve.html
/catalog/controller/weixin/account_safe.php
/vqmod/xml/account_safe.xml

新增搜索页面
/catalog/view/theme/default/template/weixin/search.tpl

新增专题系统
/back/controller/marketing/special.php
/back/language/en-gb/marketing/special.php
/back/language/zh-cn/marketing/special.php
/back/model/marketing/special.php
/back/view/template/marketing/special_form.tpl
/back/view/template/marketing/special_list.tpl
/back/view/template/marketing/special_history.tpl
/catalog/controller/weixin/special_list.php
/catalog/language/en-gb/weixin/special_list.php
/catalog/language/zh-cn/weixin/special_list.php
/catalog/view/theme/default/template/weixin/special_list.tpl
/catalog/model/weixin/special.php

新增专题模块
/back/controller/extension/module/special2.php
/back/language/en-gb/extension/module/special2.php
/back/language/zh-cn/extension/module/special2.php
/back/view/template/extension/module/special2.tpl
/catalog/controller/extension/module/special2.php
/catalog/controller/weixin/special.php
/catalog/language/en-gb/weixin/special.php
/catalog/language/zh-cn/weixin/special.php
/catalog/view/theme/default/template/extension/module/special2.tpl
/catalog/view/theme/default/template/weixin/category.tpl
/catalog/view/theme/default/template/weixin/special.tpl


20161225
新增个人中心，活动系统
/catalog/controller/account/activities.php
/catalog/controller/account/attention_buyer.php
/catalog/controller/account/attention_manufacturer.php
/catalog/controller/account/collect_article.php
/catalog/view/theme/default/template/weixin/buyer.tpl
/catalog/view/theme/default/template/weixin/collect_article.tpl
/catalog/controller/weixin/buyer.php
/catalog/view/theme/default/template/weixin/collect_goods.tpl
/catalog/view/theme/default/template/weixin/coupon.tpl
/catalog/language/en-gb/account/activities.php
/catalog/language/en-gb/account/attention_manufacturer.php
/catalog/language/en-gb/account/collect_article.php
/catalog/view/theme/default/template/weixin/order_list.tpl
/catalog/language/en-gb/weixin/buyer.php
/catalog/view/theme/default/template/weixin/resume.tpl
/catalog/language/zh-cn/account/activities.php
/catalog/language/zh-cn/account/attention_manufacturer.php
/catalog/language/zh-cn/account/collect_article.php
/vqmod/xml/address.xml
/vqmod/xml/edit_personal_info.xml
/catalog/language/zh-cn/weixin/buyer.php
/catalog/view/theme/default/script/ok_personal_center.js
/catalog/model/account/attention_buyer.php
/catalog/model/account/attention_manufacturer.php
/catalog/model/account/collect_article.php
/vqmod/xml/order.xml
/catalog/model/weixin/buyer.php
/vqmod/xml/personal_center.xml
/catalog/view/theme/default/script/ok_addAddress_submit.js
/catalog/view/theme/default/script/ok_addFeedback.js
/catalog/view/theme/default/script/ok_bindCoupon.js
/catalog/view/theme/default/script/weui.min.js
/catalog/view/theme/default/template/information/new_feedback.tpl
/catalog/view/theme/default/template/weixin/account.tpl
/catalog/view/theme/default/template/weixin/activities.tpl
/catalog/view/theme/default/template/weixin/add_address.tpl
/catalog/view/theme/default/template/weixin/address.tpl
/catalog/view/theme/default/template/weixin/attention_buyer.tpl
/catalog/view/theme/default/template/weixin/attention_manufacturer.tpl


新增帮助中心,文章系统
/catalog/controller/faq
/catalog/controller/press
/catalog/controller/weixin/article.php
/catalog/language/en-gb/faq
/catalog/language/en-gb/press
/catalog/language/en-gb/weixin/article.php
/catalog/language/zh-cn/faq
/catalog/language/zh-cn/press
/catalog/language/zh-cn/weixin/article.php
/catalog/model/faq
/catalog/model/press
/catalog/view/theme/default/template/faq
/catalog/view/theme/default/template/press
/catalog/view/theme/default/template/weixin/article.tpl
/vqmod/xml/cms.xml


20161220 - 20161222
上传，买手，前台活动
/back/view/template/marketing/pricing_customers_info.tpl
/catalog/language/en-gb/weixin/pricing.php
/catalog/language/zh-cn/weixin/pricing.php
/catalog/view/theme/default/script/ok_join_pricing.js
/catalog/view/theme/default/template/weixin/pricing_info.tpl
/catalog/view/theme/default/template/weixin/pricing_mine.tpl

/back/language/en-gb/api
/back/language/en-gb/api/uploadify.php
/back/language/zh-cn/api/uploadify.php
/vqmod/xml/buyer.xml

修改购物车,注册页面,登录页面,短信接口,商品页面,订单页面

20161219
后台定价活动管理
/catalog/controller/weixin/pricing.php
/catalog/model/weixin/pricing.php
/back/controller/marketing/pricing.php
/back/language/en-gb/marketing/pricing.php
/back/language/zh-cn/marketing/pricing.php
/back/model/marketing/pricing.php
/back/view/template/marketing/pricing_form.tpl
/back/view/template/marketing/pricing_list.tpl
/vqmod/xml/admin_menu.xml

新增微信支付
/back/controller/extension/payment/wxpay.php
/back/language/en-gb/extension/payment/wxpay.php
/back/language/zh-cn/extension/payment/wxpay.php
/back/view/image/payment/wxpay.png
/back/view/template/extension/payment/wxpay.tpl
/catalog/controller/extension/module/wx_slideshow.php
/catalog/controller/extension/payment/wxpay.php
/catalog/controller/extension/payment/wxpay_callback.php
/catalog/language/en-gb/extension/payment/wxpay.php
/catalog/language/zh-cn/extension/payment/wxpay.php
/catalog/model/extension/payment/wxpay.php
/catalog/view/theme/default/template/extension/payment/wxpay.tpl
/system/helper/wxpay_key
/system/helper/wxpay_key/apiclient_cert.p12
/system/helper/wxpay_key/apiclient_cert.pem
/system/helper/wxpay_key/apiclient_key.pem
/system/helper/wxpay_key/rootca.pem
/system/library/wxpay
/system/library/wxpay/qrcode_wxpay_notify.php
/system/library/wxpay/wxpayapi.php
/system/library/wxpay/wxpayconfig.php
/system/library/wxpay/wxpaydata.php
/system/library/wxpay/wxpayexception.php
/system/library/wxpay/wxpayjsapipay.php
/system/library/wxpay/wxpaynativepay.php
/system/library/wxpay/wxpaynotify.php
/system/library/wxpay/wxpaynotifycallback.php

20161216
新增反馈建议及后台处理，内容标签管理，关注系统，收藏系统，品牌系列页面
/back/controller/catalog/manufacturer.php
/catalog/controller/weixin/manufacturer.php
/catalog/language/en-gb/weixin/manufacturer.php
/catalog/language/zh-cn/weixin/manufacturer.php
/catalog/model/account/wishlist_ext.php
/catalog/model/weixin
/catalog/model/weixin/manufacturer.php
/catalog/view/theme/default/script/ok_brand.js
/catalog/view/theme/default/script/ok_manufacturer.js
/catalog/view/theme/default/template/test/wishlist.tpl
/catalog/view/theme/default/template/weixin/manufacturer_detail.tpl
/catalog/view/theme/default/template/weixin/manufacturer_list.tpl
/catalog/view/theme/default/template/weixin/manufacturer_personal.tpl
/vqmod/xml/manufacturer.xml
/vqmod/xml/collect.xml
/catalog/controller/weixin/article.php
/catalog/controller/weixin/buyer.php


新增内容管理,文章系统,blog
/back/controller/cms
/back/controller/cms/blog.php
/back/controller/cms/blog_category.php
/back/controller/cms/blog_comment.php
/back/controller/cms/blog_config.php
/back/controller/cms/faq.php
/back/controller/cms/faq_category.php
/back/controller/cms/faq_config.php
/back/controller/cms/press.php
/back/controller/cms/press_category.php
/back/controller/cms/press_config.php
/back/language/en-gb/cms
/back/language/en-gb/cms/blog.php
/back/language/en-gb/cms/blog_category.php
/back/language/en-gb/cms/blog_comment.php
/back/language/en-gb/cms/blog_config.php
/back/language/en-gb/cms/faq.php
/back/language/en-gb/cms/faq_category.php
/back/language/en-gb/cms/faq_config.php
/back/language/en-gb/cms/press.php
/back/language/en-gb/cms/press_category.php
/back/language/en-gb/cms/press_config.php
/back/language/zh-cn/cms
/back/language/zh-cn/cms/blog.php
/back/language/zh-cn/cms/blog_category.php
/back/language/zh-cn/cms/blog_comment.php
/back/language/zh-cn/cms/blog_config.php
/back/language/zh-cn/cms/faq.php
/back/language/zh-cn/cms/faq_category.php
/back/language/zh-cn/cms/faq_config.php
/back/language/zh-cn/cms/press.php
/back/language/zh-cn/cms/press_category.php
/back/language/zh-cn/cms/press_config.php
/back/model/cms
/back/model/cms/blog.php
/back/model/cms/blog_category.php
/back/model/cms/blog_comment.php
/back/model/cms/faq.php
/back/model/cms/faq_category.php
/back/model/cms/press.php
/back/model/cms/press_category.php
/back/view/template/cms
/back/view/template/cms/blog_category_form.tpl
/back/view/template/cms/blog_category_list.tpl
/back/view/template/cms/blog_comment_form.tpl
/back/view/template/cms/blog_comment_list.tpl
/back/view/template/cms/blog_config.tpl
/back/view/template/cms/blog_form.tpl
/back/view/template/cms/blog_list.tpl
/back/view/template/cms/faq_category_form.tpl
/back/view/template/cms/faq_category_list.tpl
/back/view/template/cms/faq_config.tpl
/back/view/template/cms/faq_form.tpl
/back/view/template/cms/faq_list.tpl
/back/view/template/cms/press_category_form.tpl
/back/view/template/cms/press_category_list.tpl
/back/view/template/cms/press_config.tpl
/back/view/template/cms/press_form.tpl
/back/view/template/cms/press_list.tpl
/catalog/controller/blog
/catalog/controller/blog/all.php
/catalog/controller/blog/blog.php
/catalog/controller/blog/category.php
/catalog/language/en-gb/blog
/catalog/language/en-gb/blog/all.php
/catalog/language/en-gb/blog/blog.php
/catalog/language/en-gb/blog/category.php
/catalog/language/zh-cn/blog
/catalog/language/zh-cn/blog/all.php
/catalog/language/zh-cn/blog/blog.php
/catalog/language/zh-cn/blog/category.php
/catalog/model/blog
/catalog/model/blog/blog.php
/catalog/model/blog/category.php
/catalog/model/blog/comment.php
/catalog/view/theme/default/template/blog
/catalog/view/theme/default/template/blog/all.tpl
/catalog/view/theme/default/template/blog/blog.tpl
/catalog/view/theme/default/template/blog/category.tpl
/catalog/view/theme/default/template/blog/comment.tpl

20161215
新增微信来看,来买,来玩页面,修改了模块组slideshow,featured,banner,navigation,catagory,latest
/catalog/controller/weixin
/catalog/language/en-gb/weixin
/catalog/language/zh-cn/weixin
/catalog/view/theme/default/weixin

20161213
<!--delete start-->
/back/controller/extension/module/message.php
/back/language/en-gb/extension/module/message.php
/back/language/zh-cn/extension/module/message.php
/back/view/template/extension/module/message.tpl
<!--delete end-->
/back/controller/marketing/message.php
/back/language/en-gb/marketing/message.php
/back/language/zh-cn/api
/back/language/zh-cn/marketing/message.php
/back/view/template/marketing/message.tpl

/back/controller/marketing/feedback.php
/back/language/en-gb/marketing/feedback.php
/back/language/zh-cn/marketing/feedback.php
/back/model/marketing/feedback.php
/back/view/template/marketing/feedback.tpl
/catalog/controller/information/feedback.php
/catalog/model/information/feedback.php


新增marketing activity活动专题模块,快速建立活动专题页面[完成数据库,控制器和视图未完成]
/back/controller/marketing/activity.php
/back/language/en-gb/marketing/activity.php
/back/language/zh-cn/marketing/activity.php
/back/model/marketing/activity.php
/back/view/template/marketing/activity_form.tpl
/back/view/template/marketing/activity_list.tpl
/vqmod/xml/marketing_activity.xml

20161211
新增微信端测试首页,微信端幻灯片模块,导航模块,前端demo
add
/back/controller/extension/module/navigation.php
/back/controller/extension/module/setting_update.php
/back/controller/extension/module/wx_slideshow.php
/back/language/en-gb/extension/module/navigation.php
/back/language/en-gb/extension/module/setting_update.php
/back/language/en-gb/extension/module/wx_slideshow.php
/back/language/zh-cn/extension/module/navigation.php
/back/language/zh-cn/extension/module/setting_update.php
/back/language/zh-cn/extension/module/wx_slideshow.php
/back/view/template/extension/module/navigation.tpl
/back/view/template/extension/module/setting_update.tpl
/back/view/template/extension/module/wx_slideshow.tpl
/catalog/controller/extension/module/controller.demo
/catalog/controller/extension/module/navigation.php
/catalog/controller/extension/module/wx_slideshow.php
/catalog/controller/test/home.php
/catalog/view/theme/default/template/extension/module/navigation.tpl
/catalog/view/theme/default/template/extension/module/navigation1.tpl
/catalog/view/theme/default/template/extension/module/navigation2.tpl
/catalog/view/theme/default/template/extension/module/tpl.demo
/catalog/view/theme/default/template/extension/module/wx_slideshow.tpl
/catalog/view/theme/default/template/test/home.tpl


20161209
新增demo,加快开发速度,直接复制即可使用
add
/back/controller/extension/module/module.demo
/back/language/en-gb/extension/module/language.demo
/back/language/zh-cn/extension/module/language.demo
/back/view/template/extension/module/tpl.demo
/catalog/controller/test/controller.demo
/catalog/model/test/model.demo
/catalog/view/theme/default/template/test/tpl.demo
/vqmod/xml/vqmod_xml.demo

新增test路由,为了方便测试
add 
/catalog/model/test
/catalog/view/theme/default/template/test
/catalog/controller/test

新增快递查询
/back/controller/others/express_company.php
/back/language/en-gb/others/express_company.php
/back/language/zh-cn/others/express_company.php
/back/model/others/express_company.php
/back/view/template/others/express_company_form.tpl
/back/view/template/others/express_company_list.tpl
/back/view/template/sale/order_express.tpl
/catalog/model/others/express_company.php
/vqmod/xml/express.xml

新增seo url alias管理,管理前台的所有路由的伪静态地址
/back/controller/catalog/url_alias.php
/back/language/en-gb/catalog/url_alias.php
/back/language/zh-cn/catalog/url_alias.php
/back/view/template/catalog/url_alias_form.tpl
/back/view/template/catalog/url_alias_list.tpl
/vqmod/xml/url_alias_mannage.xml

增加了前台后台优惠券部分
add
/CHANGELOG/db/coupon/oc_customer_coupons.sql
/back/controller/extension/module/coupon.php
/back/language/en-gb/extension/module/coupon.php
/back/language/zh-cn/extension/module/coupon.php
/back/model/extension/module/coupon.php
/back/view/template/extension/module/coupon.tpl

/catalog/language/en-gb/account/coupon.php
/catalog/language/zh-cn/account/coupon.php
/catalog/model/account/coupon.php
/catalog/view/theme/default/template/account/coupon.tpl
/vqmod/xml/back_model_customer.xml
/vqmod/xml/coupon.xml
/vqmod/xml/video.xml

20161208
修改ajax订单提交页增加城市/县区
add
/catalog/model/localisation/city.php
/catalog/model/localisation/district.php


20161207

上传视频
add
/CHANGELOG/db/video/oc_information_video.sql
/back/controller/extension/module/uploadify.php
/back/view/javascript/uploadify
/back/view/javascript/uploadify/jquery.uploadify.js
/back/view/javascript/uploadify/jquery.uploadify.min.js
/back/view/javascript/uploadify/uploadify.css
/back/view/javascript/uploadify/uploadify.swf
/vqmod/xml/information.xml

/catalog/controller/extension/module/coupon.php
/catalog/model/extension/module/coupon.php

新增smtp发邮件功能
replace
/system/library/mail.php
add
/system/library/phpmailer

修改后台必须输入3个字符串的标题和描述,改动的地方在localisation下的路径
/vqmod/xml/change_validate_3to1.xml

20161206
新增video上传
/vqmod/xml/video.xml

20161205
新增市,区
add
/back/controller/localisation/city.php
/back/controller/localisation/district.php
/back/language/en-gb/localisation/city.php
/back/language/en-gb/localisation/district.php
/back/language/zh-cn/localisation/city.php
/back/language/zh-cn/localisation/district.php
/back/model/localisation/city.php
/back/model/localisation/district.php
/back/view/template/localisation/city_form.tpl
/back/view/template/localisation/city_list.tpl
/back/view/template/localisation/district_form.tpl
/back/view/template/localisation/district_list.tpl
/vqmod/xml/city_and_district.xml

20161202
新增快速注册页面
add
/catalog/controller/account/quick_register.php
/catalog/language/en-gb/account/quick_register.php
/catalog/language/zh-cn/account/quick_register.php
/catalog/model/account/quick_register.php
/catalog/view/theme/default/template/account/quick_register.tpl
/back/controller/extension/module/quick_register.php
/back/language/en-gb/extension/module/quick_register.php
/back/language/zh-cn/extension/module/quick_register.php
/back/view/template/extension/module/quick_register.tpl
/vqmod/xml/quick_register.xml

新增手机号登录功能,实现邮箱/手机号码双登录
add
/vqmod/xml/telephone_login.xml

新增live search,搜索栏自动显示搜索结果
add
/back/controller/extension/module/live_search.php
/back/language/en-gb/extension/module/live_search.php
/back/language/zh-cn/extension/module/live_search.php
/back/view/template/extension/module/live_search.tpl
/catalog/controller/product/live_search.php
/catalog/view/theme/default/image/loading.gif
/catalog/view/theme/default/stylesheet/live_search.css
/vqmod/xml/live_search.xml

新增地址优化,统一产品地址不带分类path,优化分类地址
add
/vqmod/xml/unify_product_url.xml

优化首页地址common/home => NULL
add
/vqmod/xml/no_common_home.xml



20161130
新增测试路由test/try
ignore
/catalog/controller/test
/catalog/view/theme/default/template/test
新增支付宝插件
\back\controller\extension\payment\alipay.php  
\back\controller\extension\payment\alipay_paybank.php  
\back\language\en-gb\extension\payment\alipay.php  
\back\language\en-gb\extension\payment\alipay_paybank.php  
\back\language\zh-cn\extension\payment\alipay.php  
\back\language\zh-cn\extension\payment\alipay_paybank.php  
\back\view\image\payment\alipay.png  application/octet-stream
\back\view\template\extension\payment\alipay.tpl  
\catalog\controller\extension\payment\alipay.php  
\catalog\controller\extension\payment\alipay_callback.php  
\catalog\controller\extension\payment\alipay_function.php  
\catalog\controller\extension\payment\alipay_notify.php  
\catalog\controller\extension\payment\alipay_paybank.php  
\catalog\controller\extension\payment\alipay_service.php  
\catalog\language\en-gb\extension\payment\alipay.php  
\catalog\language\zh-cn\extension\payment\alipay.php  
\catalog\model\extension\payment\alipay.php  
\catalog\model\extension\payment\alipay_paybank.php  
\catalog\view\theme\default\image\alipay.png  application/octet-stream
\catalog\view\theme\default\image\combo2.jpg  application/octet-stream
\catalog\view\theme\default\stylesheet\paybank.css  
\catalog\view\theme\default\template\extension\payment\alipay.tpl  
\catalog\view\theme\default\template\extension\payment\alipay_paybank.tpl  
\vqmod\xml\alipay.xml  


20161129
增加伪静态功能
add
/.htaccess

20161128
QQ,微博,注册发送短信 
add
/back/controller/extension/extension/qq_login.php
/back/controller/extension/module/meilian.php
/back/controller/extension/module/qq_login.php
/back/controller/extension/module/weibo_login.php
/back/language/en-gb/extension/module/meilian.php
/back/language/en-gb/extension/module/qq_login.php
/back/language/en-gb/extension/module/weibo_login.php
/back/language/zh-cn/extension/module/meilian.php
/back/language/zh-cn/extension/module/qq_login.php
/back/language/zh-cn/extension/module/weibo_login.php
/back/view/template/extension/module/meilian.tpl
/back/view/template/extension/module/qq_login.tpl
/back/view/template/extension/module/weibo_login.tpl
/catalog/controller/extension/module/qq_login.php
/catalog/controller/extension/module/sms_meilian.php
/catalog/controller/extension/module/weibo_login.php
/catalog/language/en-gb/extension/module/meilian.php
/catalog/language/en-gb/extension/module/qq_login.php
/catalog/language/en-gb/extension/module/weibo_login.php
/catalog/language/zh-cn/extension/module/meilian.php
/catalog/language/zh-cn/extension/module/qq_login.php
/catalog/language/zh-cn/extension/module/weibo_login.php
/catalog/view/theme/default/image/qq_login.png
/catalog/view/theme/default/image/weibo_login.png
/catalog/view/theme/default/image/weibo_login_top.png
/catalog/view/theme/default/template/extension/module/qq_login.tpl
/catalog/view/theme/default/template/extension/module/weibo_login.tpl
/catalog/view/theme/default_BAK/image/weibo_login.png
/catalog/view/theme/default_BAK/image/weibo_login_top.png
/system/helper/mobile.php
/system/library/qq
/system/library/qq/class
/system/library/qq/class/ErrorCase.class.php
/system/library/qq/class/Oauth.class.php
/system/library/qq/class/QC.class.php
/system/library/qq/class/Recorder.class.php
/system/library/qq/class/URL.class.php
/system/library/qq/comm
/system/library/qq/comm/utils.php
/system/library/qq/qqConnectAPI.php
/system/library/weibo
/system/library/weibo/saetv2.ex.class.php
/vqmod/xml/qq_login.xml
/vqmod/xml/weibo_login.xml
 
 
 
 
添加ajax一页结帐页面
add
* \vqmod\xml\d_quickcheckout.xml
* \vqmod\xml\d_quickcheckout_fix_230.xml
* \vqmod\xml\d_quickcheckout_shopunity.xml
* \system\config\d_quickcheckout_lite.php
* \system\mbooth
* \system\library\d_compress
* \system\library\hyperlight
* \image\d_quickcheckout
* \catalog\controller\d_quickcheckout
* \catalog\controller\module
* \catalog\language\en-gb\module
* \catalog\language\zh-cn\module
* \catalog\model\d_quickcheckout
* \catalog\model\module
* \catalog\view\javascript\d_quickcheckout
* \catalog\view\theme\default\stylesheet\d_quickcheckout
* \catalog\view\theme\default\template\d_quickcheckout
* \catalog\view\theme\default\template\module
* \catalog\view\theme\default\template\checkout\d_quickcheckout.tpl
* \myback\controller\module
* \myback\language\en-gb\module
* \myback\language\zh-cn\module
* \myback\model\module
* \myback\view\javascript\shopunity
* \myback\view\stylesheet\d_quickcheckout.css
* \myback\view\stylesheet\d_quickcheckout.less
* \myback\view\stylesheet\shopunity
* \myback\view\template\module

20161122	
replace
- 修改后台admin TO back
* \back\config.php
delete
- 删除谷歌字体的链接,提高网站的访问速度
* \catalog\view\theme\default\template\common\header.tpl
* \back\view\stylesheet\stylesheet.css
add
- vqmod增加后台修改admin的字符串替换,方便以后增加其他开发者的插件
* \vqmod\xml\pathReplaces.php
- 增加库存管理系统green inventory1.0.3
* 
* \vqmod\xml\green_inventory1.0.3.xml
* \back\controller\purchase
* \back\language\en-gb\purchase
* \back\language\zh-cn\purchase
* \back\model\purchase
* \view\template\purchase
* \system\library\mail
