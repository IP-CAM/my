<?php
// +----------------------------------------------------------------------
// | RuntuerCMF
// +----------------------------------------------------------------------
// | Copyright (c) 2016/3/10 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author theseaer <theseaer@qq.com>.
// +----------------------------------------------------------------------
// | Description : 公共类库 Version 2017/2/8
// +----------------------------------------------------------------------
namespace app\common\controller;

use think\Lang;
use think\Cache;
use think\Config;
use think\Db;
use think\Controller;

class Common extends Controller
{
    public $lang;                 //语言标识
    
    //系统授权域名地址
    const LICESON_URL = 'http://runtuer.com/index.php/runtuer/index/getliceson';
    
    /**
     * @Mark:初始化
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/17
     */
    public function _initialize()
    {
        //判断是否安装
        if (!file_exists(ROOT_PATH.'install.lock')) $this->redirect('install/index/index');
        $this->lang    = $this->request->has("lang") ? $this->request->param("lang") : strtolower(Lang::detect());
        $this->jumpUrl = $this->request->url(true);
        define('LANG', $this->lang);    //模块
        define('MODULE_NAME', $this->request->module());    //控制器
        define('CONTROLLER_NAME', $this->request->controller());
        define('ACTION_NAME', $this->request->action());
        define('MODULE_PATH', realpath(APP_PATH . MODULE_NAME));
        define('IS_WAP', $this->request->isMobile());       //是否在wap浏览器
        define('IS_WECHAT', isset($_SERVER['HTTP_USER_AGENT'])?(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) ? 1 : 0 : 0);//是否在微信中
        define('IS_APP', 0);   //是否APP端
        
        //通用变量赋值到模板
        $this->assign('module_name', MODULE_NAME);
        $this->assign('controller_name', CONTROLLER_NAME);
        $this->assign('action_name', ACTION_NAME);
        
        $path = empty(MOBTPL) ? 'admin/' : MOBTPL;
        //链接远程系统获取授权信息----该代码只能在非主服务器系统开启，否则主服务器会死循环
        //$liceson = self::get_liceson_info(self::LICESON_URL);
        //$this->assign('liceson',$liceson);
        
        $this->assign('path', $path);
        $this->assign('css_path', MODULE_NAME . '/' . $path . 'css');
        $this->assign('js_path', MODULE_NAME . '/' . $path . 'js');
        $this->assign('img_path', MODULE_NAME . '/' . $path . 'image');
        $this->assign('module_path', MODULE_NAME . '/' . $path);
        //加载公共语言包
        Lang::load(realpath(APP_PATH . DS . 'common' . DS . 'lang' . DS . $this->lang . '.php'));
        
        if (!Cache::has('Modules') || !Cache::has('Menus')) $this->savecache(); //初始化缓存
        
        $Moduleslist = Cache::get('Modules');
        $this->assign('applist', $Moduleslist); //全部已安装的APP列表
        //$has = false;
        if (!in_array(ucfirst(MODULE_NAME), $Moduleslist)) {
            //模块是否安装 , 已在缓存中写入安装模块为提升性能注释掉此段 by theseaer start 2017/3/15
            /*$setup = [
                'name'      => ['=', MODULE_NAME],
                'status'    => ['=', 1],
                'is_del'    => ['=', 0],
            ];
            $xp = Db::name('module')->where($setup)->find();
            empty($xp) && $this->error(lang('Module_not_install'));*/
            $this->error(lang('Module_not_install'), 'Index/index/index');
        }
    }
    
    /**
     * @Mark:链接远程系统获取授权信息
     * @param $url
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/10/14
     */
    public function get_liceson_info($url)
    {
        try{
            $data = [
                'domain'=>$this->request->domain(),
                'ip'=>$this->request->ip(),
                'time'=>time()
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            // post数据
            curl_setopt($ch, CURLOPT_POST, 1);
            // post的变量
            curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
            curl_setopt($ch, CURLOPT_HEADER, 0);
            //设置头部信息
            $headers = array('Content-Type:application/json; charset=utf-8','Content-Length: '.strlen(json_encode($data)));
            curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
            $liceson = curl_exec($ch);
            curl_close($ch);
        }catch (\Exception $e){
            $liceson = null;
        }
        return $liceson;
        
    }
    
    /**
     * @Mark:返回语言列表
     * @return array
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/5
     */
    static public function getLanguageList()
    {
        $languages = array(
            'af'          => array('Afrikaans', 'Afrikaans'),
            'am'          => array('Amharic', 'አማርኛ'),
            'ar'          => array('Arabic', /* Left-to-right marker "‭" */
                'العربية', 'rtl'),
            'ast'         => array('Asturian', 'Asturianu'),
            'az'          => array('Azerbaijani', 'Azərbaycanca'),
            'be'          => array('Belarusian', 'Беларуская'),
            'bg'          => array('Bulgarian', 'Български'),
            'bn'          => array('Bengali', 'বাংলা'),
            'bo'          => array('Tibetan', 'བོད་སྐད་'),
            'bs'          => array('Bosnian', 'Bosanski'),
            'ca'          => array('Catalan', 'Català'),
            'cs'          => array('Czech', 'Čeština'),
            'cy'          => array('Welsh', 'Cymraeg'),
            'da'          => array('Danish', 'Dansk'),
            'de'          => array('German', 'Deutsch'),
            'dz'          => array('Dzongkha', 'རྫོང་ཁ'),
            'el'          => array('Greek', 'Ελληνικά'),
            'en'          => array('English', 'English'),
            'en-x-simple' => array('Simple English', 'Simple English'),
            'eo'          => array('Esperanto', 'Esperanto'),
            'es'          => array('Spanish', 'Español'),
            'et'          => array('Estonian', 'Eesti'),
            'eu'          => array('Basque', 'Euskera'),
            'fa'          => array('Persian, Farsi', /* Left-to-right marker "‭" */
                'فارسی', 'rtl'),
            'fi'          => array('Finnish', 'Suomi'),
            'fil'         => array('Filipino', 'Filipino'),
            'fo'          => array('Faeroese', 'Føroyskt'),
            'fr'          => array('French', 'Français'),
            'fy'          => array('Frisian, Western', 'Frysk'),
            'ga'          => array('Irish', 'Gaeilge'),
            'gd'          => array('Scots Gaelic', 'Gàidhlig'),
            'gl'          => array('Galician', 'Galego'),
            'gsw-berne'   => array('Swiss German', 'Schwyzerdütsch'),
            'gu'          => array('Gujarati', 'ગુજરાતી'),
            'he'          => array('Hebrew', /* Left-to-right marker "‭" */
                'עברית', 'rtl'),
            'hi'          => array('Hindi', 'हिन्दी'),
            'hr'          => array('Croatian', 'Hrvatski'),
            'ht'          => array('Haitian Creole', 'Kreyòl ayisyen'),
            'hu'          => array('Hungarian', 'Magyar'),
            'hy'          => array('Armenian', 'Հայերեն'),
            'id'          => array('Indonesian', 'Bahasa Indonesia'),
            'is'          => array('Icelandic', 'Íslenska'),
            'it'          => array('Italian', 'Italiano'),
            'ja'          => array('Japanese', '日本語'),
            'jv'          => array('Javanese', 'Basa Java'),
            'ka'          => array('Georgian', 'ქართული ენა'),
            'kk'          => array('Kazakh', 'Қазақ'),
            'km'          => array('Khmer', 'ភាសាខ្មែរ'),
            'kn'          => array('Kannada', 'ಕನ್ನಡ'),
            'ko'          => array('Korean', '한국어'),
            'ku'          => array('Kurdish', 'Kurdî'),
            'ky'          => array('Kyrgyz', 'Кыргызча'),
            'lo'          => array('Lao', 'ພາສາລາວ'),
            'lt'          => array('Lithuanian', 'Lietuvių'),
            'lv'          => array('Latvian', 'Latviešu'),
            'mg'          => array('Malagasy', 'Malagasy'),
            'mk'          => array('Macedonian', 'Македонски'),
            'ml'          => array('Malayalam', 'മലയാളം'),
            'mn'          => array('Mongolian', 'монгол'),
            'mr'          => array('Marathi', 'मराठी'),
            'ms'          => array('Bahasa Malaysia', 'بهاس ملايو'),
            'my'          => array('Burmese', 'ဗမာစကား'),
            'ne'          => array('Nepali', 'नेपाली'),
            'nl'          => array('Dutch', 'Nederlands'),
            'nb'          => array('Norwegian Bokmål', 'Norsk, bokmål'),
            'nn'          => array('Norwegian Nynorsk', 'Norsk, nynorsk'),
            'oc'          => array('Occitan', 'Occitan'),
            'pa'          => array('Punjabi', 'ਪੰਜਾਬੀ'),
            'pl'          => array('Polish', 'Polski'),
            'pt-pt'       => array('Portuguese, Portugal', 'Português, Portugal'),
            'pt-br'       => array('Portuguese, Brazil', 'Português, Brasil'),
            'ro'          => array('Romanian', 'Română'),
            'ru'          => array('Russian', 'Русский'),
            'sco'         => array('Scots', 'Scots'),
            'se'          => array('Northern Sami', 'Sámi'),
            'si'          => array('Sinhala', 'සිංහල'),
            'sk'          => array('Slovak', 'Slovenčina'),
            'sl'          => array('Slovenian', 'Slovenščina'),
            'sq'          => array('Albanian', 'Shqip'),
            'sr'          => array('Serbian', 'Српски'),
            'sv'          => array('Swedish', 'Svenska'),
            'sw'          => array('Swahili', 'Kiswahili'),
            'ta'          => array('Tamil', 'தமிழ்'),
            'ta-lk'       => array('Tamil, Sri Lanka', 'தமிழ், இலங்கை'),
            'te'          => array('Telugu', 'తెలుగు'),
            'th'          => array('Thai', 'ภาษาไทย'),
            'tr'          => array('Turkish', 'Türkçe'),
            'tyv'         => array('Tuvan', 'Тыва дыл'),
            'ug'          => array('Uyghur', 'Уйғур'),
            'uk'          => array('Ukrainian', 'Українська'),
            'ur'          => array('Urdu', /* Left-to-right marker "‭" */
                'اردو', 'rtl'),
            'vi'          => array('Vietnamese', 'Tiếng Việt'),
            'xx-lolspeak' => array('Lolspeak', 'Lolspeak'),
            'zh-cn'       => array('Chinese, Simplified', '简体中文'),
            'zh'          => array('Chinese, Traditional', '繁體中文'),
        );
        asort($languages);
        return $languages;
    }
    
    /**
     * @Mark:返回语言名称
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/5
     */
    static public function getLangName()
    {
        return;
    }
    
    /**
     * @Mark:国家列表
     * @return array
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/5
     */
    static public function getContrylList()
    {
        $countries = array(
            'AC' => lang('Ascension Island'),
            'AD' => lang('Andorra'),
            'AE' => lang('United Arab Emirates'),
            'AF' => lang('Afghanistan'),
            'AG' => lang('Antigua and Barbuda'),
            'AI' => lang('Anguilla'),
            'AL' => lang('Albania'),
            'AM' => lang('Armenia'),
            'AN' => lang('Netherlands Antilles'),
            'AO' => lang('Angola'),
            'AQ' => lang('Antarctica'),
            'AR' => lang('Argentina'),
            'AS' => lang('American Samoa'),
            'AT' => lang('Austria'),
            'AU' => lang('Australia'),
            'AW' => lang('Aruba'),
            'AX' => lang('Åland Islands'),
            'AZ' => lang('Azerbaijan'),
            'BA' => lang('Bosnia and Herzegovina'),
            'BB' => lang('Barbados'),
            'BD' => lang('Bangladesh'),
            'BE' => lang('Belgium'),
            'BF' => lang('Burkina Faso'),
            'BG' => lang('Bulgaria'),
            'BH' => lang('Bahrain'),
            'BI' => lang('Burundi'),
            'BJ' => lang('Benin'),
            'BL' => lang('Saint Barthélemy'),
            'BM' => lang('Bermuda'),
            'BN' => lang('Brunei'),
            'BO' => lang('Bolivia'),
            'BQ' => lang('Caribbean Netherlands'),
            'BR' => lang('Brazil'),
            'BS' => lang('Bahamas'),
            'BT' => lang('Bhutan'),
            'BV' => lang('Bouvet Island'),
            'BW' => lang('Botswana'),
            'BY' => lang('Belarus'),
            'BZ' => lang('Belize'),
            'CA' => lang('Canada'),
            'CC' => lang('Cocos [Keeling] Islands'),
            'CD' => lang('Congo - Kinshasa'),
            'CF' => lang('Central African Republic'),
            'CG' => lang('Congo - Brazzaville'),
            'CH' => lang('Switzerland'),
            'CI' => lang('Côte d’Ivoire'),
            'CK' => lang('Cook Islands'),
            'CL' => lang('Chile'),
            'CM' => lang('Cameroon'),
            'CN' => lang('China'),
            'CO' => lang('Colombia'),
            'CP' => lang('Clipperton Island'),
            'CR' => lang('Costa Rica'),
            'CU' => lang('Cuba'),
            'CV' => lang('Cape Verde'),
            'CW' => lang('Curaçao'),
            'CX' => lang('Christmas Island'),
            'CY' => lang('Cyprus'),
            'CZ' => lang('Czech Republic'),
            'DE' => lang('Germany'),
            'DG' => lang('Diego Garcia'),
            'DJ' => lang('Djibouti'),
            'DK' => lang('Denmark'),
            'DM' => lang('Dominica'),
            'DO' => lang('Dominican Republic'),
            'DZ' => lang('Algeria'),
            'EA' => lang('Ceuta and Melilla'),
            'EC' => lang('Ecuador'),
            'EE' => lang('Estonia'),
            'EG' => lang('Egypt'),
            'EH' => lang('Western Sahara'),
            'ER' => lang('Eritrea'),
            'ES' => lang('Spain'),
            'ET' => lang('Ethiopia'),
            'FI' => lang('Finland'),
            'FJ' => lang('Fiji'),
            'FK' => lang('Falkland Islands'),
            'FM' => lang('Micronesia'),
            'FO' => lang('Faroe Islands'),
            'FR' => lang('France'),
            'GA' => lang('Gabon'),
            'GB' => lang('United Kingdom'),
            'GD' => lang('Grenada'),
            'GE' => lang('Georgia'),
            'GF' => lang('French Guiana'),
            'GG' => lang('Guernsey'),
            'GH' => lang('Ghana'),
            'GI' => lang('Gibraltar'),
            'GL' => lang('Greenland'),
            'GM' => lang('Gambia'),
            'GN' => lang('Guinea'),
            'GP' => lang('Guadeloupe'),
            'GQ' => lang('Equatorial Guinea'),
            'GR' => lang('Greece'),
            'GS' => lang('South Georgia and the South Sandwich Islands'),
            'GT' => lang('Guatemala'),
            'GU' => lang('Guam'),
            'GW' => lang('Guinea-Bissau'),
            'GY' => lang('Guyana'),
            'HK' => lang('Hong Kong SAR China'),
            'HM' => lang('Heard Island and McDonald Islands'),
            'HN' => lang('Honduras'),
            'HR' => lang('Croatia'),
            'HT' => lang('Haiti'),
            'HU' => lang('Hungary'),
            'IC' => lang('Canary Islands'),
            'ID' => lang('Indonesia'),
            'IE' => lang('Ireland'),
            'IL' => lang('Israel'),
            'IM' => lang('Isle of Man'),
            'IN' => lang('India'),
            'IO' => lang('British Indian Ocean Territory'),
            'IQ' => lang('Iraq'),
            'IR' => lang('Iran'),
            'IS' => lang('Iceland'),
            'IT' => lang('Italy'),
            'JE' => lang('Jersey'),
            'JM' => lang('Jamaica'),
            'JO' => lang('Jordan'),
            'JP' => lang('Japan'),
            'KE' => lang('Kenya'),
            'KG' => lang('Kyrgyzstan'),
            'KH' => lang('Cambodia'),
            'KI' => lang('Kiribati'),
            'KM' => lang('Comoros'),
            'KN' => lang('Saint Kitts and Nevis'),
            'KP' => lang('North Korea'),
            'KR' => lang('South Korea'),
            'KW' => lang('Kuwait'),
            'KY' => lang('Cayman Islands'),
            'KZ' => lang('Kazakhstan'),
            'LA' => lang('Laos'),
            'LB' => lang('Lebanon'),
            'LC' => lang('Saint Lucia'),
            'LI' => lang('Liechtenstein'),
            'LK' => lang('Sri Lanka'),
            'LR' => lang('Liberia'),
            'LS' => lang('Lesotho'),
            'LT' => lang('Lithuania'),
            'LU' => lang('Luxembourg'),
            'LV' => lang('Latvia'),
            'LY' => lang('Libya'),
            'MA' => lang('Morocco'),
            'MC' => lang('Monaco'),
            'MD' => lang('Moldova'),
            'ME' => lang('Montenegro'),
            'MF' => lang('Saint Martin'),
            'MG' => lang('Madagascar'),
            'MH' => lang('Marshall Islands'),
            'MK' => lang('Macedonia'),
            'ML' => lang('Mali'),
            'MM' => lang('Myanmar [Burma]'),
            'MN' => lang('Mongolia'),
            'MO' => lang('Macau SAR China'),
            'MP' => lang('Northern Mariana Islands'),
            'MQ' => lang('Martinique'),
            'MR' => lang('Mauritania'),
            'MS' => lang('Montserrat'),
            'MT' => lang('Malta'),
            'MU' => lang('Mauritius'),
            'MV' => lang('Maldives'),
            'MW' => lang('Malawi'),
            'MX' => lang('Mexico'),
            'MY' => lang('Malaysia'),
            'MZ' => lang('Mozambique'),
            'NA' => lang('Namibia'),
            'NC' => lang('New Caledonia'),
            'NE' => lang('Niger'),
            'NF' => lang('Norfolk Island'),
            'NG' => lang('Nigeria'),
            'NI' => lang('Nicaragua'),
            'NL' => lang('Netherlands'),
            'NO' => lang('Norway'),
            'NP' => lang('Nepal'),
            'NR' => lang('Nauru'),
            'NU' => lang('Niue'),
            'NZ' => lang('New Zealand'),
            'OM' => lang('Oman'),
            'PA' => lang('Panama'),
            'PE' => lang('Peru'),
            'PF' => lang('French Polynesia'),
            'PG' => lang('Papua New Guinea'),
            'PH' => lang('Philippines'),
            'PK' => lang('Pakistan'),
            'PL' => lang('Poland'),
            'PM' => lang('Saint Pierre and Miquelon'),
            'PN' => lang('Pitcairn Islands'),
            'PR' => lang('Puerto Rico'),
            'PS' => lang('Palestinian Territories'),
            'PT' => lang('Portugal'),
            'PW' => lang('Palau'),
            'PY' => lang('Paraguay'),
            'QA' => lang('Qatar'),
            'QO' => lang('Outlying Oceania'),
            'RE' => lang('Réunion'),
            'RO' => lang('Romania'),
            'RS' => lang('Serbia'),
            'RU' => lang('Russia'),
            'RW' => lang('Rwanda'),
            'SA' => lang('Saudi Arabia'),
            'SB' => lang('Solomon Islands'),
            'SC' => lang('Seychelles'),
            'SD' => lang('Sudan'),
            'SE' => lang('Sweden'),
            'SG' => lang('Singapore'),
            'SH' => lang('Saint Helena'),
            'SI' => lang('Slovenia'),
            'SJ' => lang('Svalbard and Jan Mayen'),
            'SK' => lang('Slovakia'),
            'SL' => lang('Sierra Leone'),
            'SM' => lang('San Marino'),
            'SN' => lang('Senegal'),
            'SO' => lang('Somalia'),
            'SR' => lang('Suriname'),
            'SS' => lang('South Sudan'),
            'ST' => lang('São Tomé and Príncipe'),
            'SV' => lang('El Salvador'),
            'SX' => lang('Sint Maarten'),
            'SY' => lang('Syria'),
            'SZ' => lang('Swaziland'),
            'TA' => lang('Tristan da Cunha'),
            'TC' => lang('Turks and Caicos Islands'),
            'TD' => lang('Chad'),
            'TF' => lang('French Southern Territories'),
            'TG' => lang('Togo'),
            'TH' => lang('Thailand'),
            'TJ' => lang('Tajikistan'),
            'TK' => lang('Tokelau'),
            'TL' => lang('Timor-Leste'),
            'TM' => lang('Turkmenistan'),
            'TN' => lang('Tunisia'),
            'TO' => lang('Tonga'),
            'TR' => lang('Turkey'),
            'TT' => lang('Trinidad and Tobago'),
            'TV' => lang('Tuvalu'),
            'TW' => lang('Taiwan'),
            'TZ' => lang('Tanzania'),
            'UA' => lang('Ukraine'),
            'UG' => lang('Uganda'),
            'UM' => lang('U.S. Outlying Islands'),
            'US' => lang('United States'),
            'UY' => lang('Uruguay'),
            'UZ' => lang('Uzbekistan'),
            'VA' => lang('Vatican City'),
            'VC' => lang('Saint Vincent and the Grenadines'),
            'VE' => lang('Venezuela'),
            'VG' => lang('British Virgin Islands'),
            'VI' => lang('U.S. Virgin Islands'),
            'VN' => lang('Vietnam'),
            'VU' => lang('Vanuatu'),
            'WF' => lang('Wallis and Futuna'),
            'WS' => lang('Samoa'),
            'XK' => lang('Kosovo'),
            'YE' => lang('Yemen'),
            'YT' => lang('Mayotte'),
            'ZA' => lang('South Africa'),
            'ZM' => lang('Zambia'),
            'ZW' => lang('Zimbabwe'),
        );
        // 不区分大小写自然排序.
        natcasesort($countries);
        return $countries;
    }
    
    /**
     * @Mark:返回时区列表
     * @param null $blank
     * @return array
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/5
     */
    static public function system_time_zones($blank = NULL)
    {
        $zonelist = timezone_identifiers_list();
        $zones    = $blank ? array('' => lang('- None selected -')) : array();
        foreach ($zonelist as $zone) {
            //过滤多余时区
            if (preg_match('!^((Africa|America|Antarctica|Arctic|Asia|Atlantic|Australia|Europe|Indian|Pacific)/|UTC$)!', $zone)) {
                $zones[$zone] = lang('@zone', array('@zone' => lang(str_replace('_', ' ', $zone))));
            }
        }
        // Sort the translated time zones alphabetically.
        asort($zones);
        return $zones;
    }
    
    /**
     * @Mark:写缓存
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/5
     */
    public function savecache()
    {
        //获取已安装的模块
        $map['status'] = ['=', 1];
        $map['is_del'] = ['eq', ''];
        $install       = Db::table('__ADMIN_MODULE__')->where($map)->order('sort asc')->column('name');
        $menus         = $langset = $routeset = $allinstall = $Tpllangset = [];
        $allinstall    = array_merge(Config::get('can_use_not_install'), $install);
        //后端语言包 by theseaer start 2017/7/10
        foreach ($allinstall as $key => $value) {
            //生成路由文件
            $routefile = APP_PATH . strtolower($value) . DS . 'route.php';
            if (is_file(realpath($routefile))) {
                $routeset[] = strtolower($value) . '/route';
            }
            
            //加载后端模块下的语言文件
            $langs = APP_PATH . strtolower($value) . DS . 'lang' . DS . $this->lang . '.php';
            if (is_file(realpath($langs))) {
                $tmp_langs = include realpath($langs);
            } else {
                continue;
            }
            if (empty($tmp_langs)) continue;
            
            foreach ($tmp_langs as $lk => $lv) {
                $langset[$lk] = $lv;
            }
        }
        //by theseaer end 2017/7/10
        //生成合并后的语言包
        file_put_contents(RUNTIME_PATH . 'rt_routes.php', "<?php \n" . self::getnote() . "\n\nreturn " . var_export($routeset, 1) . ";\n");
        
        if (!is_dir(RUNTIME_PATH . DS . 'lang')) {
            mkdir(RUNTIME_PATH . DS . 'lang', 0777, true);
        }
        
        //导入不必安装的模块语言包 by theseaer start 2017/1/14
        $commonLangfile = realpath(APP_PATH . 'common' . DS . 'lang' . DS . $this->lang . '.php');
        $commonLang     = is_file($commonLangfile) ? include $commonLangfile : array();
        //导入不必安装的模块语言包 by theseaer end 2017/1/14
        
        $langset = array_merge($commonLang, $langset); //合并
        
        //生成合并后的语言包(后端)
        file_put_contents(RUNTIME_PATH .
            'lang' . DS . $this->lang . '.php', "<?php \n" . self::getnote() . "\n\nreturn " . var_export($langset, 1) . ";\n");
        
        foreach ($allinstall as $key => $value) {
            //加载模块下的配置文件
            $file = realpath(APP_PATH . strtolower($value) . DS . 'setting.php');
            if (is_file($file)) {
                $tmp_setting = include $file;
            } else {
                continue;
            }
            
            if (empty($tmp_setting['admin_menu'])) continue;
            
            //显示后台菜单部分
            foreach ($tmp_setting['admin_menu'] as $k => $v) {
                $iconPath  = '/' . APP_NAME . '/' . strtolower($value) . '/';
                $menus[$k] = array(
                    'pid'        => $v[0] ? $v[0] : '0', //父节点
                    'pos'        => $v[1],               //位置
                    'url'        => $v[2],               //连接
                    'icon'       => $v[3] ? $v[3] : '',  //图标
                    'data'       => $v[4] ? $v[4] : '',  //菜单附加参数
                    'img'        => $v[0] == '' ? $iconPath . ($v[3] ? $v[3] : '') : '',  //指示图
                    'subimg'     => $v[0] != '' && $v[3] ? $iconPath . ($v[3] ? $v[3] : '') : '',
                    'order'      => $v[5] ? $v[5] : 0,  //排序
                    'permission' => $v[6] ? $v[6] : 0,  //是否受权限控制
                    'button'     => array_key_exists(7, $v) ? $v[7] : '',
                );
            }
        }
        
        cache('Modules', $allinstall); //缓存模块信息
        cache('Menus', $menus);
        
        //合并插件语言包
        $extend_lang_path = realpath(EXTEND_PATH . 'lang' . DS . $this->lang . DS);
        $langfile         = list_dir_file($extend_lang_path, 'php');
        $tmp_lang         = array();
        foreach ($langfile as $i => $lang) {
            $_langs   = include $lang;
            $tmp_lang = array_merge($tmp_lang, $_langs);
        }
        
        if (!is_dir(RUNTIME_PATH . '/lang')) {
            mkdir(RUNTIME_PATH . '/lang', 0777, true);
        }
        //定义扩展语言文件
        if (!is_file(RUNTIME_PATH . '/lang/extend_' . $this->lang . '.php')) {
            file_put_contents(RUNTIME_PATH . '/lang/extend_' . $this->lang . '.php', "<?php \n" . self::getnote() . "\n\nreturn " . var_export($tmp_lang, 1) . ";\n");
        }
    }
    
    /**
     * @Mark:为自动创建的文件添加注释
     * @param string $str
     * @return string
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/7
     */
    public static function getnote($str = 'By ShopCmf Auto Create File Version')
    {
        $days  = date('Y/m/d H:i:s');
        $Notes = <<<EOF
# +----------------------------------------------------------------------
# | ETshop [ Rapid development framework for Cross border Mall ]
# +----------------------------------------------------------------------
# | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
# +----------------------------------------------------------------------
# | Author: theseaer <theseaer@qq.com>
# +----------------------------------------------------------------------
# | {$str} {$days}
# +----------------------------------------------------------------------
EOF;
        return $Notes;
    }
    
    /**
     * @Mark:获取HTTP状态码
     * @param $url string
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/2/19
     */
    public function httpcode($url)
    {
        $ch      = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // 跳过证书检查
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  // 从证书中检查SSL加密算法是否存在
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $code;
    }
    
    /**
     * @Mark:通用短信发送
     * @param array $data
     * $data = [
     *     'type'      => 'sms',
     *     'tpl'       => 'confirm-order',
     *     'mobile'    => '13322936015',
     *     'var'       => [
     *          'vcode'       => '5248',
     *          'time'        => '60',
     *     ],
     * ]
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/29
     */
    public function sendMsg($data)
    {
        if (!isset($data['mobile']) || empty($data['mobile']))
            return ['code' => 0, 'msg' => lang('No mobile')];  //未找到手机号时报错
        //获取短信发送类
        $Conf = APP_PATH . 'admin' . DS . 'extra' . DS . 'index.php';
        Config::load($Conf);
        $_Class = '\\sms\\' . Config::get('smsclass');
        
        //缓存短信数据
        Cache::set($data['mobile'] . '@' . $data['tpl'], $data['var']['vcode'], $data['var']['time']);
        
        $content = '';
        $sendRes = $_Class::send($data['mobile'], $content);
        if ($sendRes['code']) {
            return ['code' => 1, 'msg' => lang('Send ok')];  //发送成功
        }
        return ['code' => 0, 'msg' => $sendRes['msg']];  //发送失败
    }
    
    /**
     * @Mark:
     * @param $data
     * $data = [
     *     'type'      => 'sms',
     *     'tpl'       => 'confirm-order',
     *     'mobile'    => '13322936015',
     *     'vcode'     => '5248',
     * ]
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/29
     */
    public function checkSend($data)
    {
        if (!isset($data['mobile']) ||
            empty($data['mobile']) ||
            !isset($data['tpl']) ||
            empty($data['tpl']) ||
            !isset($data['vcode']) ||
            empty($data['tpl'])
        ) return ['code' => 0, 'msg' => lang('checkSend Error')];  //验证参数出错
        
        $_Cache = Cache::get($data['mobile'] . '@' . $data['tpl']);
        if (!$_Cache) return ['code' => 0, 'msg' => lang('Vcode expire please retry')];  //过期
    }
    
}
