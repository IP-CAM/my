    ETshop是一个成熟的，以应对当前、及未来所有一切即将出现的网络平台而开发的多用户，多任务，多平台，国际化一体的快速商用WEB应用开发框架；
    1，性能怪兽，PHP7 + ( thinphp.dll )+ Swoole，让PHP类应用性能达到最大优化
    2，前所未有的灵活性，模块化 + 全API架构，应对现在以及未来可能出现的所有电商需求；
    3，面向任何一种平台，一次开发，多端调用，包括且不局限于PC + APP + WAP + Wechat + 广告机 + ......；
    4，具备高响应，高实时特性，为支撑亿万级访问定制，量轻松应对超大并发，超高访问量以及复杂网络硬件环境；
    5，系统可满足99.9%以上的互联网开发需求，特别面向：新零售，物联网，跨境电商
    6，实时系统特性：支持执行器，队列池（自由消息、定时消息）
    7，集成应用性能监控，调用追踪；   
    
    所有权声明
        ETshop 官方网站（www.runtuer.com）属于润土（ETshop）所有
    商标声明
        "ETshop" 系本公司的注册商标，受商标法的保护，未经本公司的许可，任何他人不得以任何形式使用。
    版权声明
        本网站上刊载的署名为"ETshop"的所有内容，包括但不限于文字、图片、声音、录像、图表、标志、标识、广告、商标、商号、域名、软件、程序、版面设计、专栏目录与名称、内容分类标准以及所有信息，均受《中华人民共和国著作权法》、《中华人民共和国商标法》、《中华人民共和国专利法》及适用之国际公约中有关著作权、商标权、专利权及／或其它财产所有权法律的保护，为本公司专属所有或持有。
        他人将本网提供的内容与服务用于商业、盈利、广告性目的时，需征得本公司的许可，注明作者及文章出处，并依法向权利人支付报酬。
        本网未注明"稿件来源："ETshop"的文/图等稿件均为转载稿，本网转载出于传递更多信息之目的，并不意味着赞同其观点或证实其内容的真实性。如其他媒体、网站或个人从本网下载使用，必须保留本网注明的"稿件来源"，并自负版权等法律责任。如擅自篡改为"稿件来源：ETshop"，本网将依法追究责任。如对稿件内容有疑议，请及时与我们联系。
        本网社区、下载的部分下载内容均取自于互联网，仅供创业者下载学习之用，不得用于商业用途，须在24小时内予以删除。如本网相关下载内容涉及版权问题，请所有人与我们联系，我们将立即予以删除。
        ETshop用户在ETshop网站上发布的原创性信息与作品均为ETshop与作者共同持有版权。
        本网开设的论坛，网友可自由发表相关主题信息，但网友观点不代表本网站的意见和倾向。
        本网保留对网友在本网发布信息的编辑权及删除权。
    版权申明
        未经版权所有者明确授权，禁止发行本文档及其被实质上修改的版本。 
        未经版权所有者事先授权，禁止将此作品及其衍生作品以标准（纸质）书籍形式发行。 
        如果有兴趣再发行或再版本手册的全部或部分内容，不论修改过与否，或者有任何问题，请联系版权所有者 theseaer@qq.com。 
        对ETshop有任何疑问或者建议，请进入官方讨论区 [ http://www.runtuer.cn/topic ] 发布相关讨论。 

    PS: 有关ETshop项目及本文档的最新资料，请及时访问ETshop项目主站 http://www.runtuer.com。 
        本文档的版权归深圳市润土信息技术有限公司所有，本文档及其描述的内容受有关法律的版权保护，对本文档内容的任何形式的非法复制，泄露或散布，将导致相应的法律责任。
        
    ETshop 官方权威QQ群
        新手一群（ 开放制） 允许扯谈（已满员）
        新手二群（ 开放制） 允许扯谈（已满员）
        高级群（ 收费制）禁止闲聊
        专家群（ 邀请制）比较安静

    主要特性：
    
        规范：遵循PSR-2、PSR-4规范，Composer支持；
        平台：国际化，多终端（pc，wap，wechat，app（ios, android））支持，消息自由推送，Swoole组件定时任务，无需第三方中间件支撑，
        灵活：模块相互独立，支持各个模块及插件热插拔，模块，插件独立升级机制，具备良好的扩展能力，99%以上的业务架构需求及拓展；
        API：api接口模块实现无缝对接各种平台及数据交换，极强的扩展性；
        高性能：最少的数据库访问、按需加载及缓存机制，支持高并发，多线程，为高性能，高可用，为大流量网络应用定制开发，支持快速集群布署；
        ORM：数据读写分离，可为每个模块（APP级）及单个模型（操作组）单独配置数据库服务器，超强分布式数据库集成能力，且对分布式Redis, Memcache也提供优良的支持；
        布署：实现了内网自动发现，集群部署零配置，支持分布式事务处理，分布式消息列队，
        监控：
            系统资源监控（负载，CPU、内存、磁盘、网络），
            应用监控（响应时间、吞吐率、关键链路分析），
            容器监控（堆内存、类加载、线程池、连接器）；
        任务调度系统：
            分布式任务调度系统支持

    程序最低环境要求：
        composer
        PHP >= 7.0
        Swoole 3.0
        PDO PHP Extension
        MBstring PHP Extension
        CURL PHP Extension
        memcache
        redis
        
    扩展插件
       Deliverys			 发货&第三方发货,
       Expresss			     快递、物流查询,
       Images			     图片&文件云存储,
       Oauths			     Oauth 第三方账户,
       Payments			     支付工具插件,
       Pushs			     消息推送PC/WAP/APP,
       Refunds			     资金原路退回接口,
       Reminds			     提醒工具插件,
       Sms			         短信接口,
       Warehouses			 仓库&仓储对接接口,
       Carts			     购物车,
       Products			     商品列表,
       Orders			     订单处理,
       Seas			         海关清关接口,
       Seapays			     跨境支付插件,
       Realname			     实名认证扩展,
       Seosends			     SEO 内容推送,
       Vercode			     登录/注册验证码,
       .....更多扩展插件请咨询官方客服
    模块
        B2b2c               B2B2C平台	
        Crossbbcg           跨境BBC(集运版)
        Crossbbcr           跨境BBC(加盟版)
        Dbs                 数据库管理
        Colony              集群部署工具	
        Bigdata             大数据中心
        .....更多模块请咨询官方客服
        
    商城类模块特点：
        搜索关键词跳转到分类；
        商品按批次号出库，按距离过期日排序出货；
        支持API接口式商品数据拉取（需要有相应API权限）；
        支持商品按批次添加，导入，方便采购成本管理；
        实时库存管理，库存异常时可及时通知相关人员（邮件，短信，微信及其它可对接的消息平台）
        自动订单完成，自动生成订单评论，自动确认，自动评星；
        支持物流快递优化选择，快递物流实时派送，从物流上快人一步；
        支持FAQ无人值守回复，人工回复自由切换；
        支持交易自动分账功能，分账退款；
        支持实时、延时分账：支付款项可实时拆分到指定的财付通账户中，也可以根据实际情况自定义时间进行分账;
        支持全球上百种的支付方式；
        支持当日汇率市场对接，多国货币一键转换，支付；
        支持客户下单立即提醒，自动订单停留，自动订单推送（实时延时）；
        支持财务自动结算，自动回款，自动退款原路返回（退款）；
        超过百种营销模式，并可自定义；
        C2B功能，按需定制化销售（反向促销）
        实时/定时/延时消息推送微信，APP,SMS消息（定向，定时群发，单发），可通过插件方式无缝对接至全求各大实时通信软件；
        实时在线通讯，支持（TCP/IP百万级并发），支持各种应用层协议
        强大完善的报表系统，针对每个操作细节都有记录；
        与全球超过150家著名电商平台进行无缝对接；
        各大社交平台对接，拥有的不仅仅是第三方登录，分享；
        ......
        润土为你提供的不只是普通的商城，更是强大的推广营销管理工具，将你的运营成本降低到最低
        
    ETshop 渠道分销王
        支持招商，加盟，免费等多种方式；
        国际化支持；
        支持多终端分销（pc,wap,app(ios, android),wechat）;
        支持多级分销，多级返佣；
        支持跨境分销；
        支持线下门店，商帮，团体客户分销管理；
        支持多渠道，全球超过150家著名电商平台分销；

    目录结构
        project  应用部署目录
        ├─site           应用目录（可设置）
        │  ├─common             公共模块目录
        │  ├─index              模块目录(可更改)
        │  │  ├─config.php      模块配置文件
        │  │  ├─common.php      模块函数文件
	    │  │  ├─dev             定时任务&&消息配置目录
	    │  │  │  ├─hook         admin控制器
	    │  │  │  ├─crontab.php  定时任务配置文件
	    │  │  │  ├─messager.php 消息推送配置文件
        │  │  ├─setting.php     模块配置文件
        │  │  ├─route.php       模块路由配置
        │  │  ├─tags.php        模块行为配置
        │  │  ├─behavior        行为目录
        │  │  ├─controller      控制器目录
        │  │  │  ├─admin        admin控制器
        │  │  │  ├─api          私有api接口
        │  │  │  ├─Error.php    出错处理
        │  │  │  ├─Index.php    PC端入口
        │  │  │  └─ ...         更多控制器
        │  │  ├─event           触发器目录
        │  │  │  ├─job          消息队列
        │  │  │  │  ├─Task.php  消息队列执行文件类
        │  │  │  │  ├─...       更多的消息队列执行文件类
        │  │  │  ├─Cron.php     定时任务类
        │  │  │  ├─...          更多的定时任务执行体
        │  │  ├─lang            语言包目录
        │  │  ├─libs            私有第三方库目录
        │  │  ├─model           模型目录(数据自动完成功能实现)
        │  │  ├─schema          数据库描述文件目录
        │  │  ├─service		    公有API，核心层，统一使用静态方法，API变种实现机制，必须从model层继承
	    │  │  ├─validate        验证器目录（数据入表前的最后一次验证）
        │  │  ├─view            视图目录
        │  │  │  ├─admin        admin后台管理资源文件
        │  │  │  ├─mobile       移动端(mobile)
        │  │  │  │  ├─default   移动端(mobile)模板资源主题文件包
        │  │  │  │  └─...       更多移动端(mobile)模板主题
        │  │  │  ├─pc           PC端
        │  │  │  │  ├─default   PC端模板资源主题文件包
        │  │  │  │  └─...       更多PC模板主题
        │  │  ├─widget          挂件目录
        │  │  └─ ...            更多类库目录
        │  ├─command.php        命令行工具配置文件
        │  ├─common.php         应用公共（函数）文件
        │  ├─config.php         应用（公共）配置文件
        │  ├─database.php       数据库配置文件
        │  ├─tags.php           应用行为扩展定义文件
        │  └─route.php          路由配置文件
        ├─extend                扩展插件类库目录
        │  ├─common             公共第三方库目录
        │  ├─lang               扩展语言包目录
        │  ├─images             图片服务器扩展目录
        │  ├─sms                短信扩展插件目录
        │  │  └─ ...            更多扩展插件目录
        ├─public                WEB 部署目录（对外访问目录）
        │  ├─site               静态资源目录
        │  │  ├─admin           admin模块资源文件
        │  │  ├─cms             cms模块资源文件
        │  │  ├─member          member模块资源文件
        │  │  ├─runtuer         runtuer模块资源文件
        │  │  └─ ...            更多模块资源目录
        │  ├─static             公共静态资源存放目录(css,js,image)
        │  ├─index.php          应用入口文件
        │  ├─router.php         快速测试文件
        │  ├─readme.md          readme 说明
        │  └─.htaccess          用于 apache 的重写
        ├─runtime               应用的运行时目录
        ├─vendor                第三方类库目录（Composer）
        ├─core                  框架核心系统目录
        │  ├─lang               语言包目录
        │  ├─library            框架核心类库目录
        │  │  ├─think           Think 类库包目录
        │  │  └─traits          系统 Traits 目录
        │  ├─tpl                系统模板目录
        │  ├─.htaccess          用于 apache 的重写
        │  ├─.travis.yml        CI 定义文件
        │  ├─base.php           基础定义文件
        │  ├─composer.json      composer 定义文件
        │  ├─console.php        控制台入口文件
        │  ├─convention.php     惯例配置文件
        │  ├─helper.php         助手函数文件（可选）
        │  ├─LICENSE.txt        授权说明文件
        │  ├─phpunit.xml        单元测试配置文件
        │  ├─README.md          README 文件
        │  └─start.php          框架引导文件
        ├─build.php             自动生成定义文件（参考）
        ├─composer.json         composer 定义文件
        ├─LICENSE.txt           授权说明文件
        ├─README.md             README 文件
        ├─cmd                   命令行入口文件
        
    开发者要求
        thinkphp5.0
        MUI
        jquery-ui
        angular
        composer
        cache
        Swoole
        
     开发说明
        手动转向到移动端
        http://192.168.1.101/ETshop/public/index.php/member/index/index/__theme__/pc/__skin__/default
        输出当前页面URL的二维码
        <img src="{:qrcode()}" width="150" height="150">
        输出图片验证码
        <img src="{:captcha_src()}" alt="captcha" />
        输出
        
        api请求地址：
        http://192.168.1.101/ETshop/public/index.php/index/api.v1.index/index/dataType/json
        
        获取插件下拉
        {foreach :get_extend_type('sms') as $vo}
            <option value="{$vo.code}" data-tip="{:lang($vo.description)}" {eq name="data.sms" value="$vo.code"}selected{/eq}>{:lang($vo.name)}</option>
        {/foreach}
        
        人脸识别
        http://www.bo56.com/tclip%E4%BA%BA%E8%84%B8%E8%AF%86%E5%88%AB%E5%9B%BE%E7%89%87%E8%A3%81%E5%89%AA/#download
        
        自动路径识别
        css_path  <link rel="stylesheet" type="text/css" href="__PUBLIC__/{$css_path}/style.css" />
        js_path
        img_path
        module_path
        
        通用变量
        LANG  当前语言标识
        applist  已安装的APP列表
        module_name  当前模块名称
        controller_name 当前控制器名称
        action_name 当前动作名称
        css_path    css路径   指向public/site/appname/(admin/pc/mobile)/default/css
        js_path     js路径    指向public/site/appname/(admin/pc/mobile)/default/js
        img_path    img路径   指向public/site/appname/(admin/pc/mobile)/default/image
        module_path     module路径    带平台判断功能的URL输出
        
        API类型：
            公有api  统一定位到模块下的service中，访目录下所有类方法均需要为静态方法，将对过openapi进行映射；
            私有api  为某应用提供的专用 API接口，位于controller目录下，可多层级；拥有自己的对接key，screat
            虚拟api  不需要进行实体实现的方法类，需要有接口描述，接口说明，实为公有API的模拟；
            
        跨模块调用时请带上模块名及数据表名，如：MemberAccount 即相当于调用表：rt_member_account
        $res = Db::name('MemberAccount')->where('1=1')->select();
        
        生成原图的缩放图
        <img src="{:resizeImage('/ETshop/public/site/crossbbcg/pc/default/ad/g1.jpg', 'thumb')}" />
        参数二可选值： big  大图
                    middle 中图
                    small  小图
                    thumb  缩略图
        几项参数值配置可在：后台首页 :    站点配置  /  站点功能参数  附件设置处进行配置
        
        地区选择筛选框 仅适用于后台
        {:widget('common/Area/choosearea', ['country' => $data.country, 'province' => $data.province, 'city' => $data.city, 'district' => $data.district])}
        地区选择筛选框 country|country_id 二选一，国家名或者国家ID
        {:widget('common/Area/country', ['country|country_id' => $data.country|$data.country_id])}
        
        
        罗列国家(前后台可用)
        <script>
            var time     = '{:microtime()}';
            var country  = '{$data.country}';
        </script>
        {include file="common@public/country" /}
        
        //获取已安装的插件
        get_extend_type('expresss')
       
        API返回错误状态码一预表
        10001   请求方式出错，请更换为POST请求；
        10002   请求域名未认证
        10003   请求参数中sign不能为空
        10500   请求成功，强制返回错误

        

