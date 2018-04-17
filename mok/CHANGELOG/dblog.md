数据库增删改记录,禁止修改原数据库表的结构,从下往上记录
20170117
地址扩展
oc_address_ext.sql
买手模块
oc_buyer_blog.sql
oc_buyer_info.sql
活动
oc_topic.sql
oc_topic_category.sql
oc_topic_description.sql
oc_topic_history.sql
oc_topic_product.sql

20170111
- 商品联合选项
* /CHANGELOG/db/option_to_product

- 修改原数据库表
ALTER TABLE `oc_cart` ADD `otp_id` int(11) NOT NULL;
ALTER TABLE `oc_cart` ADD `swap_id` int(11) NOT NULL;
ALTER TABLE `oc_order_product` ADD `otp_id` int(11) NOT NULL;

20161226
- 专题系统
* /CHANGELOG/db/special

20161225
- 新增定价活动
* oc_pricing_customer.sql
* oc_pricing.sql

- 新增博客文章发布扩充
* oc_blog_ext.sql

- 新增关注，收藏
* oc_customer_attention.sql
* oc_customer_collect.sql

- 新增意见反馈
* oc_feedback.sql

- 新增品牌扩充表
* oc_manufacturer_ext.sql 

- 新增新闻中心
/CHANGELOG/db/press
* oc_press.sql
* oc_press_category.sql
* oc_press_category_description.sql
* oc_press_category_path.sql
* oc_press_category_to_layout.sql
* oc_press_category_to_store.sql
* oc_press_description.sql
* oc_press_product.sql
* oc_press_to_press_category_sql
* oc_press_to_layout.sql
* oc_press_to_store.sql
- 新增帮助中心
/CHANGELOG/db/faq
* oc_faq.sql
* oc_faq_category.sql
* oc_faq_category_description.sql
* oc_faq_category_path.sql
* oc_faq_category_to_layout.sql
* oc_faq_category_to_store.sql
* oc_faq_description.sql
* oc_faq_product.sql
* oc_faq_to_faq_category_sql
* oc_faq_to_layout.sql
* oc_faq_to_store.sql

20161216
- 增加内容管理页,blog系统
/CHANGELOG/db/blog
* oc_blog.sql
* oc_blog_category.sql
* oc_blog_category_description.sql
* oc_blog_category_path.sql
* oc_blog_category_to_layout.sql
* oc_blog_category_to_store.sql
* oc_blog_comment.sql
* oc_blog_description.sql
* oc_blog_product.sql
* oc_blog_related.sql
* oc_blog_to_blog_category.sql
* oc_blog_to_layout.sql
* oc_blog_to_store.sql

20161213
/CHANGELOG/db/marketing_activity
- 增加促销活动表,marketing activity
* oc_activity
* oc_activity_template
* oc_activity_template_description

20161209
/CHANGELOG/db/express
-增加快递公司信息表
oc_express_company
oc_express_company_to_store
-订单表添加了快递公司ID和快递单号
*oc_order 添加字段 express_company_id，express_no

20161207
/CHANGELOG/db/coupon
-增加领取优惠券关联表
*oc_customer_coupons

20161206
/CHANGELOG/db/video
-增加video表,增加发送短信记录表
* oc_information_video
/CHANGELOG/db/sms
* oc_telphone_captcha

20161205
/CHANGELOG/db/city_and_district
- 增加市,区表
* oc_city
* oc_district

20161128
/CHANGELOG/db/login_info
- 增加第三方登陆保存信息相应的表
* oc_qq_connect
* oc_weibo_connect

-增加用户信息表字段
*

20161122
/CHANGELOG/db/green_inventory
- 增加库存管理系统green inventory1.0.3相应的表
* oc_po_attribute_category
* oc_po_attribute_group
* oc_po_order
* oc_po_product
* oc_po_receive_details
* oc_po_return
* oc_po_supplier
* oc_po_supplier_group