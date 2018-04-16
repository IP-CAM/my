            //输出框填写方式
            string  <input type=text
            number  <input type=number
            time    <input type=text
            radio   <input type=radio
            checkbox<input type=checkbox
            select  <select></select>
            html    <textarea></textarea>
            
            
            
            //基本配置项
            'config'        => array(
                //购物车类型
                'carttype' => array(
                    'title'     => 'Carttype',  //标题
                    'type'      => 'radio',     //类型
                    'validate'  => 'required',  //是否必须
                    'default'   => 'cookie',    //默认值
                    'suffix'    => '%',         //后缀
                    'length'    => '70',        //input输入框的长度
                    'option'    => [            //列出的可选值
                        'DB'      => 'db',
                        'Session' => 'session',
                        'Cookie'  => 'cookie',
                    ],
                ),
                
                //限制平台
                'platform'   => array(
                     'title'     => 'Platform',
                     'type'      => 'radio',     //类型
                     'default'   => 'wechat',    //默认值
                     'option'    => [            //列出的可选值
                        'Wechat'  => 'wechat',
                     ],
                ),
                                
                //保存类型：session,cookie,db
                'savetype' => array(
                    'title'     => 'Savetype',
                    'type'      => 'select',
                    'validate'  => 'required',
                    'default'   => '',
                    'option'    => [
                        'DB'      => 'db',
                        'Session' => 'session',
                        'Cookie'  => 'cookie',
                    ],
                ),
                //最大可容纳数量
                'maxnumber' => array(
                    'title'     => 'Maxnumber',
                    'type'      => 'number',
                    'validate'  => 'required',
                    'default'   => 10
                ),
                //保存时间
                'savetime' => array(
                    'title'     => 'Savetime',
                    'type'      => 'time',
                    'validate'  => 'required',
                    'default'   => '',
                ),